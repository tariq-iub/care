<?php

namespace App\Providers;

use App\Interfaces\PaymentGatewayInterface;
use App\Services\StripePaymentGateway;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(PaymentGatewayInterface::class, function ($app) {
            $paymentGateway = config('payment.gateway');
            switch ($paymentGateway) {
                case 'stripe':
                default:
                    return new StripePaymentGateway();
            }
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
