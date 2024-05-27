<?php

return [
    'bikash' => App\Services\PaymentGateway\BikashService::class,
    'nagad' => App\Services\PaymentGateway\NagadService::class,
    'stripe' => App\Services\PaymentGateway\Stripe::class,
];
