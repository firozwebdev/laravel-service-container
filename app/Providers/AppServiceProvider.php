<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Factories\MessageSenderFactory;
use App\Factories\PaymentGatewayFactory;
use App\Mixins\StrMixins;
use App\Test\Greeting;
use Illuminate\Support\Str;
use Illuminate\Routing\ResponseFactory;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {





    }

    public function boot()
    {

        // Str::macro('partNumber', function($part){
        //     return 'AB-'.substr($part,0,3).'-'.substr($part,3);
        // });
        Str::mixin(new StrMixins(), false);

        ResponseFactory::macro('errorJson',function($message='Default error message'){
            return [
                'message' => $message,
                'error' => 123
            ];
        });

        Greeting::macro('greet',function(?string $greeting='null'){
            return !is_null($greeting) 
                ? sprintf('%s, %s', $greeting, $this->name, PHP_EOL)
                : $this->sayHello();
        });
    }
}
