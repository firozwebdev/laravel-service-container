<?php

namespace App\Providers;


use App\Services\Messages\SmsService;
use App\Services\Messages\EmailService;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\MessageSenderInterface;

class MessageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        app()->bind(MessageSenderInterface::class, function ($app) {
            return collect([
                'email' => app(EmailService::class),
                'sms' => app(SmsService::class)
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
