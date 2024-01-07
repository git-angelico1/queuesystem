<?php

return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'finance' => [
            'driver' => 'session',
            'provider' => 'finances',
        ],
        'cashier' => [
            'driver' => 'session',
            'provider' => 'cashiers',
        ],
        'registrar' => [
            'driver' => 'session',
            'provider' => 'registrars',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
        'finances' => [
            'driver' => 'eloquent',
            'model' => App\Models\Finance::class,
        ],
        'cashiers' => [
            'driver' => 'eloquent',
            'model' => App\Models\Cashier::class,
        ],
        'registrars' => [
            'driver' => 'eloquent',
            'model' => App\Models\Registrar::class,
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
