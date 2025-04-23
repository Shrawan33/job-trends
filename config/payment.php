<?php

return [
    'gateway' => 'CCAvenue', // Making this option for implementing multiple gateways in future

    'testMode' => env('CCAVENUE_TEST_MODE', true), // True for Testing the Gateway [For production false]

    'ccavenue' => [ // CCAvenue Parameters
        'merchantId' => env('CCAVENUE_MERCHANT_ID', ''),
        'accessCode' => env('CCAVENUE_ACCESS_CODE', ''),
        'workingKey' => env('CCAVENUE_WORKING_KEY', ''),
        'redirectUrl' => env('CCAVENUE_REDIRECT_URL', 'payment/success'),
        'cancelUrl' => env('CCAVENUE_CANCEL_URL', 'payment/cancel'),
        'currency' => env('CCAVENUE_CURRENCY', 'INR'),
        'language' => env('CCAVENUE_LANGUAGE', 'EN'),
    ],

    'remove_csrf_check' => [
        'payment/response',
    ],
    

];
