<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'facebook' => [
        'client_id' => env('FACEBOOK_CLIENT_ID', '477754179997530'),
        'client_secret' => env('FACEBOOK_CLIENT_SECRET', 'd2c7bd30a0f9f204e8e9c5753842ef3b'),
        'redirect' =>  env('FACEBOOK_REDIRECT_URL', 'https://orse.herokuapp.com/login/facebook/callback'),
    ],

    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID', '175378593514-ivhvt1a925j44pk7lgo20up1thlsajg5.apps.googleusercontent.com'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET', 'VsJdKLbH-ltGgCdaXdX3eFV-'),
        'redirect' => env('GOOGLE_REDIRECT_URL', 'https://orse.herokuapp.com/login/google/callback'),
    ],
];
