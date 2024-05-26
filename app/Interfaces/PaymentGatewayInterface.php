<?php

namespace App\Interfaces;

interface PaymentGatewayInterface
{
    public function charge(float $amount): void;

    public function refund(float $amount): void;
}
