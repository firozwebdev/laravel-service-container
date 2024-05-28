<?php

namespace App\Services\PaymentGateway;

use App\Interfaces\AmarPayInterface;
use App\Interfaces\PaymentGatewayInterface;

class AmarPayService implements AmarPayInterface
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
        echo "<br>Charged $amount using AmarPay. <br/>";
    }

    public function refund(float $amount): void
    {
        echo "Refunded $amount using AmarPay.</br>";
    }
    
    public function exchange(float $amount): void
    {
        echo "<br>Exchanged  $amount using AmarPay.</br>";
    }
    public function contvertCurrency(float $amount): void
    {
        echo "<br>Currency convert:  $amount using AmarPay.</br>";
    }
}
