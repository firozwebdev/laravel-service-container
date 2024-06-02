<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Factories\PaymentGatewayFactory;
use App\Interfaces\PaymentGatewayInterface;
use App\Services\PaymentGateway\NagadService;
use App\Services\PaymentGateway\BikashService;

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(PaymentGatewayFactory::class, function ($app) {
            return new PaymentGatewayFactory();
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
