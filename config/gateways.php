<?php

return [
    'bikash' => App\Services\PaymentGateway\BikashService::class,
    'nagad' => App\Services\PaymentGateway\NagadService::class,
    'amarpay' => App\Services\PaymentGateway\AmarPayService::class,
    'stripe' => App\Services\PaymentGateway\StripeService::class,
];
