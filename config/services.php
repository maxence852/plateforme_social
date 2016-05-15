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
        //bonne 'redirect' => 'http://tfe.plateformesocial.be:8080/tfe/plateforme_social/public/auth/facebook/callback',
        //'redirect' => 'http://localhost:8080/tfe/plateforme_social/public/login/auth/facebook/callback',
        'redirect' => 'http://tfe.plateformesocial.be:8080/tfe/plateforme_social/public/callback',
    ],
    'twitter' => [
        'client_id' => 'Zl4racsgjGmag7YHhdFseOcvb ',
        'client_secret' => 'fbCG9bf9Z0ll2DGTrrgvBDZi9XDsw3PBY9TnoVHbJq9Yqo2gYk',
        'redirect' => 'http://tfe.plateformesocial.be:8080/tfe/plateforme_social/public/auth/twitter/callback',
    ],

    'google' => [
    'client_id' => '812905169796-jlmohop2u01ho858h43v7pc0augjqorn.apps.googleusercontent.com',
    'client_secret' => 'H7B_QYJtwDb_nnbWEbPCiCA0',
    'redirect' => 'http://tfe.plateformesocial.be:8080/tfe/plateforme_social/public/auth/google/callback',
],



];
