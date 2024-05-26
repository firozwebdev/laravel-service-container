<?php

namespace App\Providers;

use App\Interfaces\MessageSenderInterface;
use App\Interfaces\PaymentGatewayInterface;

use App\Interfaces\ResponseInterface;

use App\Services\EmailService;
use App\Services\PaymentGateway\BikashService;

use App\Services\PaymentGateway\NagadService;
use App\Services\ResponseService;

use App\Services\SmsService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        app()->bind(MessageSenderInterface::class, function ($app) {
            return collect([
                'email' => app(EmailService::class),
                'sms' => app(SmsService::class)
            ]); 
        });
        
        app()->bind(PaymentGatewayInterface::class, function ($app) {
            return collect([
                'bikash' => app(BikashService::class),
                'nagad' => app(NagadService::class)
            ]); 
        });


        app()->singleton(ResponseInterface::class, ResponseService::class);
        // app()->singleton(Response::class, function($app){
        //     return collect([
        //         'response' => app(ResponseService::class),
        //     ]); 
        // });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
