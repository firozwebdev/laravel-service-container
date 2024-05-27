<?php

namespace App\Factories;


use InvalidArgumentException;
use Illuminate\Support\Facades\App;
use App\Interfaces\PaymentGatewayInterface;


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
           echo "Unsupported type: $type";
            throw new InvalidArgumentException("Unsupported type: $type");
        }
        echo "Supported type: $type";
        return App::make($this->services[$type]);
    }

}
