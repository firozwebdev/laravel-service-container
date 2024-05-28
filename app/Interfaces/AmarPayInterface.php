<?php

namespace App\Interfaces;

use App\Interfaces\PaymentGatewayInterface;

interface AmarPayInterface extends PaymentGatewayInterface
{

    public function exchange(float $amount): void;
}
