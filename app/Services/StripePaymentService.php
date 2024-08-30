<?php

namespace App\Services;

use Stripe\Stripe;
use Stripe\PaymentIntent;
use Exception;

class StripePaymentService implements PaymentServiceInterface
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    public function createPaymentIntent(array $data)
    {
        try {
            return PaymentIntent::create($data);
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function confirmPayment(string $clientSecret, array $paymentData)
    {
        try {
            $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));
            return $stripe->paymentIntents->confirm(
                $clientSecret,
                ['payment_method' => $paymentData['payment_method']]
            );
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function handlePaymentException(\Exception $exception): string
    {
        return $exception->getMessage();
    }
}
