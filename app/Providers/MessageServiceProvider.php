<?php

namespace App\Providers;


use App\Services\Messages\SmsService;
use App\Factories\MessageSenderFactory;
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
        $this->app->singleton(MessageSenderFactory::class, function ($app) {
            return new MessageSenderFactory();
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
