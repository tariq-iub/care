<?php

namespace App\Services;

interface PaymentServiceInterface
{
    public function createPaymentIntent(array $data);

    public function confirmPayment(string $clientSecret, array $paymentData);

    public function handlePaymentException(\Exception $exception): string;
}
