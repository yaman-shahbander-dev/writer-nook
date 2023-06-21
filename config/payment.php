<?php

return [
    'stripe' => [
        'secret_key' => env('STRIPE_SECRET'),
        'public_key' => env('STRIPE_KEY')
    ],
    'cashier' => [
        'currency' => env('CASHIER_CURRENCY', 'usd')
    ]
];
