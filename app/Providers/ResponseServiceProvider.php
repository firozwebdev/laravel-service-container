<?php

namespace App\Providers;

use App\Services\ResponseService;
use App\Interfaces\ResponseInterface;
use Illuminate\Support\ServiceProvider;

class ResponseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        app()->singleton(ResponseInterface::class, ResponseService::class);
        // app()->singleton(Response::class, function($app){
        //     return collect([
        //         'response' => app(ResponseService::class),
        //     ]); 
        // });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
