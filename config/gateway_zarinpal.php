<?php

return [

    /**
     *  driver class namespace.
     */
    'driver' => Omalizadeh\MultiPayment\Drivers\Zarinpal\Zarinpal::class,

    /**
     *  gateway configurations.
     */
    'main' => [
        'authorization_token' => '', // optional, used only to refund payments (can be created from zarinpal panel)
        'merchant_id' => 'XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX',
        'callback_url' => 'http://localhost:8000/',
        'mode' => 'sandbox', // supported values: sandbox, normal, zaringate
        'description' => 'payment using zarinpal',
    ],
    'other' => [
        'authorization_token' => '',
        'merchant_id' => 'XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX',
        'callback_url' => 'http://localhost:8000/',
        'mode' => 'sandbox',
        'description' => 'payment using zarinpal',
    ],
];
