<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
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
        app()->bind(PaymentGatewayInterface::class, function ($app) {
            return collect([
                'bikash' => app(BikashService::class),
                'nagad' => app(NagadService::class)
            ]); 
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
