<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'directmail' => [
        'app_key'    => env('DIRECT_MAIL_APP_KEY'),
        'app_secret' => env('DIRECT_MAIL_APP_SECRET'),
        'region'     => 'cn-beijing',
        'account'    => [
            'alias' => env('DIRECT_MAIL_ACCOUNT_ALIAS'),
            'name' => env('DIRECT_MAIL_ACCOUNT_NAME'),
        ]
    ],

];
