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
       
        
       


      
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
