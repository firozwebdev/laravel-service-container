<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Factories\MessageSenderFactory;
use App\Factories\PaymentGatewayFactory;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(MessageSenderFactory::class, function ($app) {
            return new MessageSenderFactory();
        });
        
        $this->app->singleton(PaymentGatewayFactory::class, function ($app) {
            return new PaymentGatewayFactory();
        });

        // No need to bind each service individually; the factory will resolve them using the config file
    }

    public function boot()
    {
        //
    }
}
