<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\PaymentServiceInterface;
use App\Services\StripePaymentService;
use App\Services\PayPalPaymentService;

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(PaymentServiceInterface::class, function ($app) {
            $paymentGateway = config('payment.gateway');
            switch ($paymentGateway) {
                case 'paypal':
                    return new PayPalPaymentService();
                case 'stripe':
                default:
                    return new StripePaymentService();
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
