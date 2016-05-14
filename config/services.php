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

    'mandrill' => [
        'secret' => env('MANDRILL_SECRET'),
    ],

    'ses' => [
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => App\User::class,
        'key'    => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'facebook' => [
        'client_id' => '1597541063890879',
        'client_secret' => 'a220401dc4a770f78b9f55d002303ef7',
        'redirect' => 'http://tfe.plateformesocial.be:8080/tfe/plateforme_social/public/auth/facebook/callback',
        //'redirect' => 'http://localhost:8080/tfe/plateforme_social/public/login/auth/facebook/callback',
    ],

    'google' => [
    'client_id' => '812905169796-jlmohop2u01ho858h43v7pc0augjqorn.apps.googleusercontent.com',
    'client_secret' => 'H7B_QYJtwDb_nnbWEbPCiCA0',
    'redirect' => 'http://localhost:8080/callback/google',
],

    'github' => [
    'client_id' => '494aa8ea9a75cd865ea4',
    'client_secret' => 'a78eb611151dd01e3657c4906d4a530ef707f019',
    'redirect' => 'http://localhost:8080/tfe/plateforme_social/public/login/github',
],


];
