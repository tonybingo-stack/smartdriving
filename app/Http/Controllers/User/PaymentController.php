<?php

namespace App\Http\Controllers\User;

use App\Models\Package;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function index() {
        return inertia("User/Payment/index");
    }
    public function startPayment(Request $request)
    {

        $paymentInfo = $request->session()->get('paymentInfo');


        // Clear the session data after retrieving
        session()->forget('paymentInfo');
    
        if (!$paymentInfo) {
            // Handle the case where there is no payment info
            // For example, redirect back or show an error message
        }
    
        return Inertia::render('Payment/StartPayment', [
            'payment' => $paymentInfo
        ]);
    }
}
