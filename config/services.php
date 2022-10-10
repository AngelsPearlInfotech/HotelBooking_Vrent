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
    'google' => [
        'client_id' => '396445384655-q6pkg3s990dlvairppsjm9g66jjag01s.apps.googleusercontent.com',
        'client_secret' => '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',
         'redirect' => 'http://localhost/vRent3.3/googleAuthenticate',
      ], 

      'facebook' => [
        'client_id' => '833153091152358', //USE FROM FACEBOOK DEVELOPER ACCOUNT
        'client_secret' => '28b2054fcc9cd7d6c0467947b51600be', //USE FROM FACEBOOK DEVELOPER ACCOUNT
        //'redirect' => 'https://examplelaravel8.test/facebook/callback/'
    ],
      
];


