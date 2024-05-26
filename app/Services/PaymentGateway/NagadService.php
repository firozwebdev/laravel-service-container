<?php

namespace App\Services\PaymentGateway;
use App\Interfaces\PaymentGatewayInterface;

class NagadService implements PaymentGatewayInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function charge(float $amount): void
    {
        echo "Charged $amount using Nagad.";
    }

    public function refund(float $amount): void
    {
        echo "Refunded $amount using Nagad.";
    }
}
