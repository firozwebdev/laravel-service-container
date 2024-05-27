<?php

namespace App\Services\PaymentGateway;
use App\Interfaces\PaymentGatewayInterface;
use App\Interfaces\StripeInterface;

class Stripe implements StripeInterface
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
    
    public function withdraw(float $amount): void
    {
        echo "Withdrawl $amount using Stripe.";
    }
}
