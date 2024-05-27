<?php

namespace App\Interfaces;


use App\Interfaces\PaymentGatewayInterface;


interface StripeInterface extends PaymentGatewayInterface
{
    public function withdraw(float $amount) : void;
}
