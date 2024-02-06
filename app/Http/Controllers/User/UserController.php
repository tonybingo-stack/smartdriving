<?php

namespace App\Http\Controllers\User;

use App\Contracts\PaymentService;
use App\Data\UserData;
use App\Entities\Address;
use App\Entities\PaymentResult;
use App\Enums\AddressType;
use App\Enums\PaymentStatus;
use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Sleep;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct(
        // private readonly PaymentService $_paymentService,
        // private readonly Repository $_configuration
    ) {
    }
    public function index() {
        return inertia('User/Profile/index');
    }
    public function pay(Request $request, string $id)
    {
        // Find User
        $user = User::find($id);
        if (!$user instanceof User) {    
            return response()->json(['status' => 'failure', 'message' => 'User not found'], 404);
        }
        

        $package = Package::find($request->input('package_id'));
        if (!$package instanceof Package) {    
            return response()->json(['status' => 'failure', 'message' => 'Package not found'], 404);
        }

        $payment = $user->createPayment([
            'description' => $package->name,
            'amount' => $package->price,
            'currency' => 'EUR',
            'address' => new Address([
                            'type' => AddressType::Person,
                            'firstName' => 'Name',
                            'lastName' => 'LastName',
                            'address' => 'Buleveradul Ion Creanga',
                            'email' => 'test@test.com',
                            'phone' => '0732123456',
                            'city' => 'Bucharest',
                            'county' => 'Sector 3',
                            'country' => 'Romania',
                            'postCode' => '101111'
            ]),
        ])->save();


        if (!$payment) {
            // Handle the case where the payment does not exist
            return response()->json(['status' => 'failure', 'message' => 'Payment not found'], 404);
        }

        // Check if this payment needs more steps
        // if (!\in_array($payment->status, $this->_configuration->get('netopia.payable_statuses'))) {
        //     throw new HttpException(403);
        // }

        // If this payment actually has an amount lower than or equal to 0, we can skip the payment
        if ($payment->amount <= 0) {
            // Update the payment status
            $this->_paymentService->executePaymentResult($payment, new PaymentResult([
                'newStatus' => PaymentStatus::Confirmed,
                'paymentId' => $payment->getKey()
            ]));

            // Redirect to the success page
            return response()->json([
                'status' => 'success',
                // 'redirect' => route('payments.ipn'), // Return the URL for redirection
                'redirect' => route('dashboard')
            ]);
        }
        // die($payment->encrypt());

        $encryptedPayment = $payment->encrypt();

        $request->session()->put('paymentInfo', $encryptedPayment);

        \Log::info('Session Payment Info Before:', ['payment' => print_r($payment, true)]);
        \Log::info('Session Payment Info Encr:', ['encryptedPayment' => print_r($encryptedPayment, true)]);

        return response()->json([
            'status' => 'success',
            'redirect' => route('payment.startpayment'), // Adjust the route name as needed
        ]);
    }
    /**
    **/
}
