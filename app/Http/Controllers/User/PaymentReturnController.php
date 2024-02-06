<?php

namespace App\Http\Controllers\User;

use App\Contracts\PaymentService;
use App\Models\Payment;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\Eloquent\{ModelNotFoundException};
use Illuminate\Http\{Request, Response as PlainResponse};
use Inertia\Inertia;
use Throwable;

class PaymentReturnController
{
    /**
     * PaymentReturnController constructor method.
     */
    public function __construct(private readonly ResponseFactory $_responseFactory)
    {
    }

 
    public function success()
    {
        return Inertia::render('User/Payment/ConfirmPayment'); // route for payment success
    }

    /**
     * Process a Netopia payment result.
     *
     * @param Request $request
     * @param PaymentService $paymentService
     * @throws ModelNotFoundException
     * @throws Throwable
     * @return PlainResponse
     */
    public function ipn(Request $request, PaymentService $paymentService): PlainResponse
    {
        // Decrypt the IPN data
        $ipn = $paymentService->decryptPayment($request->get('env_key'), $request->get('data'));


        // If the IPN has no order id attached, no payment can be associated
        if ($ipn->paymentId === null) {
            throw new ModelNotFoundException();
        }

        // Find the payment this notification is for
        /** @var Payment $payment */
        $payment = Payment::query()->findOrFail($ipn->paymentId);

        // Update the payment status
        $paymentService->executePaymentResult($payment, $ipn);

        // Return a payment result XML
        return $this->_responseFactory->view('netopia/ipn', [
            'result' => $ipn
        ])->withHeaders([
            'Content-Type' => 'application/xml'
        ]);
    }
}
