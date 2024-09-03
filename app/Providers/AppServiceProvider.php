<?php

namespace App\Providers;

use App\Contracts\SubscriptionServiceInterface;
use App\Services\CashierSubscriptionService;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(SubscriptionServiceInterface::class, function ($app) {
            return new CashierSubscriptionService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }
}
