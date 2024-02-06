<?php

namespace App\Services;

use Carbon\Carbon;
use App\Contracts\PaymentService;
use App\Entities\{Address, EncryptedPayment, PaymentResult};
use App\Enums\PaymentStatus;
use App\Events\PaymentStatusChangedEvent;
use App\Exceptions\{ConfigurationException, NetopiaException};
use App\Models\Payment;
use App\Traits\Billable;
use Exception;
use Illuminate\Contracts\Config\Repository as ConfigurationRepository;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Log\LogManager;
use Netopia\Payment\Invoice;
use Netopia\Payment\Request\{Card, PaymentAbstract};
use SoapClient;
use SoapFault;
use stdClass;
use Throwable;
use function in_array;
use const WSDL_CACHE_NONE;

/**
 * @template TBillable
 * @extends PaymentService<TBillable>
 */
class DefaultPaymentService extends PaymentService
{
    /**
     * Default {@link PaymentService} implementation.
     *
     * @param ConfigurationRepository $_configuration
     * @param LogManager $_logManager
     * @param UrlGenerator $_urlGenerator
     * @param Dispatcher $_eventDispatcher
     */
    public function __construct(
        private readonly ConfigurationRepository $_configuration,
        private readonly LogManager $_logManager,
        private readonly UrlGenerator $_urlGenerator,
        private readonly Dispatcher $_eventDispatcher
    ) {
        parent::__construct($this->_configuration);
    }

    /**
     * Execute a Netopia payment.
     *
     * @param Payment $payment
     * @throws Exception
     * @return EncryptedPayment
     */
    public function generateEncryptedPayment(Payment $payment): EncryptedPayment
    {
        $paymentRequest = new Card();
        $paymentRequest->signature = $this->_configuration->get('netopia.signature'); //signature - generated by mobilpay.ro for every merchant account
        $paymentRequest->orderId = $payment->getKey(); // order_id should be unique for a merchant account
        $paymentRequest->confirmUrl = $this->_urlGenerator->route('payments.ipn'); // is where mobilPay redirects the client once the payment process is finished and is MANDATORY
        $paymentRequest->returnUrl = $this->_urlGenerator->route('payments.success'); // is where mobilPay will send the payment result and is MANDATORY
        $paymentRequest->type = PaymentAbstract::PAYMENT_TYPE_CARD;

        // Invoices info
        $paymentRequest->invoice = new Invoice();
        $paymentRequest->invoice->currency = $payment->currency;
        $paymentRequest->invoice->amount = (string) $payment->amount;
        $paymentRequest->invoice->tokenId = $this->extractPaymentBillableToken($payment);
        $paymentRequest->invoice->details = $payment->description;

        if ($payment->billing_address instanceof Address) {
            // Billing Info
            $paymentRequest->invoice->setBillingAddress($payment->billing_address->toPaymentAddress());
        }

        if ($payment->shipping_address instanceof Address) {
            // Shipping Info
            $paymentRequest->invoice->setShippingAddress($payment->shipping_address->toPaymentAddress());
        }

        $this->_logManager->debug('Encrypted payment', [
            $paymentRequest
        ]);

        // dd($paymentRequest, $this->certificatePath);

        // encrypting
        $paymentRequest->encrypt($this->certificatePath);

        /**
         * Send the following data to NETOPIA Payments server
         * Method : POST
         * URL : $paymentUrl.
         */
        $envKey = $paymentRequest->getEnvKey();
        $data = $paymentRequest->getEncData();

        return new EncryptedPayment($this->baseUrl, $envKey, $data, );
    }

    /**
     * Decrypt a Netopia payment.
     *
     * @param string $environment
     * @param string $data
     * @throws Exception
     * @return PaymentResult
     */
    public function decryptPayment(string $environment, string $data): PaymentResult
    {
        // Decrypt the payment result data
        $paymentData = Card::factoryFromEncrypted($environment, $data, $this->secretKeyPath);

        // Determine the new payment status
        if ((int) $paymentData->objPmNotify->errorCode === 0) {
            $status = match ($paymentData->objPmNotify->action) {
                'confirmed' => PaymentStatus::Confirmed,
                'paid_pending', 'confirmed_pending' => PaymentStatus::Pending,
                'paid' => PaymentStatus::Preauthorized,
                'canceled' => PaymentStatus::Cancelled,
                'credit' => PaymentStatus::Refunded,
            };
        } else {
            $status = PaymentStatus::Rejected;
        }

        $this->_logManager->debug('Decrypted payment', [
            'payment' => $paymentData,
            'notify' => $paymentData->objPmNotify,
            'errorCode' => $paymentData->objPmNotify->errorCode,
            'action' => $paymentData->objPmNotify->action,
            'status' => $status,
        ]);

        // Build and return the result
        return new PaymentResult([
            'newStatus' => $status,
            'paymentId' => $paymentData->orderId,
            'transactionReference' => $paymentData->objPmNotify->rrn,
            'errorCode' => $paymentData->objPmNotify->errorCode,
            'errorText' => $paymentData->objPmNotify->errorMessage,
            'cardMasked' => $paymentData->objPmNotify->pan_masked,
            'tokenId' => $paymentData->objPmNotify->token_id,
            'tokenExpiresAt' => $paymentData->objPmNotify->token_expiration_date
        ]);
    }

    /**
     * Extract the token id that matches this payment's billable entity.
     *
     * @param Payment $payment
     * @return string|null
     */
    private function extractPaymentBillableToken(Payment $payment): string|null
    {
        if ($payment->billable) {
            if (in_array(Billable::class, class_uses_recursive($payment->billable), true)) {
                /** @var Billable $billable */
                $billable = $payment->billable;

                if ($billable->netopia_token) {
                    if (!$billable->netopia_token_expires_at || $billable->netopia_token_expires_at->isFuture()) {
                        return $billable->netopia_token;
                    }
                }
            }
        }

        return null;
    }


    /**
     * Update the status of the given {@link $payment payment}.
     *
     * @param Payment $payment
     * @param PaymentResult $paymentResult
     * @throws Throwable
     * @return void
     */
    public function executePaymentResult(Payment $payment, PaymentResult $paymentResult): void
    {
        // Remember the old status
        $oldStatus = $payment->status;

        // Update the payment status
        $payment->status = $paymentResult->newStatus;

        // Save used card details
        $usedCard = [
            'masked_number' => $paymentResult->cardMasked,
            'token_id' => $paymentResult->tokenId,
            'token_expires_at' => $paymentResult->tokenExpiresAt,
        ];
        $usedCard = array_filter($usedCard, fn (mixed $item) => !!$item);

        if (!empty($usedCard)) {
            $cardDetails = $payment->usedCard()->updateOrCreate([], $usedCard);
            $payment->card_details_id = $cardDetails->getKey();
        }

        // Save the changes applied on the payment model
        $payment->saveOrFail();

        // Emit the new status event
        $this->_eventDispatcher->dispatch(new PaymentStatusChangedEvent($payment, $oldStatus, $paymentResult->newStatus, $paymentResult));
    }
}
