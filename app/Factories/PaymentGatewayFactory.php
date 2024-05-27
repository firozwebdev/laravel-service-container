<?php

namespace App\Factories;


use InvalidArgumentException;
use Illuminate\Support\Facades\App;
use App\Interfaces\PaymentGatewayInterface;
use App\Interfaces\StripeInterface;

class PaymentGatewayFactory
{
   
    protected $services;

    public function __construct()
    {
        $this->services = config('gateways');
    }

    public function create(string $type): PaymentGatewayInterface
    {
       
        if (!isset($this->services[$type])) {
           
            throw new InvalidArgumentException("Unsupported type: $type");
        }
       
        return App::make($this->services[$type]);
    }

    public function createStripeService(): StripeInterface
    {
        return App::make(StripeInterface::class);
    }

}
