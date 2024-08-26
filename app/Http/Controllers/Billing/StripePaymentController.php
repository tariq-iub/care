<?php

namespace App\Http\Controllers\Billing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class StripePaymentController extends Controller
{
    public function showPaymentForm()
    {
        return view('payment.billing.index');
    }
    public function createPaymentIntent(Request $request)
    {
        Stripe::setApiKey(config('stripe.secret'));

        $amount = 100; // $1.00 in cents

        $paymentIntent = PaymentIntent::create([
            'amount' => $amount,
            'currency' => 'usd',
            'payment_method_types' => ['card'],
        ]);

        // Get the client secret from the PaymentIntent
        $clientSecret = $paymentIntent->client_secret;

        return response()->json([
            'clientSecret' => $clientSecret,
        ]);
    }
}
