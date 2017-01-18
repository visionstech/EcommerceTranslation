<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
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

    'facebook' => [
        'client_id' => '389640714716084',
        'client_secret' => 'a035462d6d3ebba3ec845c67d9921972',
        'redirect' => url('/').'/dashboard/callback',
    ],
    
    'google' => [
        'client_id' => '929571555917-qbd0e7sntl7e4un8lr2u7pbh4r86k7ql.apps.googleusercontent.com',
        'client_secret' => '6OYWPXhFLVhZF9P0uHFs18tt-p',
        'redirect' => url('/').'/dashboard/callback',
    ],
];
