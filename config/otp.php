<?php

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;

return [

    /*
    |--------------------------------------------------------------------------
    |SMS OTP Service
    |--------------------------------------------------------------------------
    |
    | OTP service used for authenticated requests to be executed. In case of
    | developer mode, it can be turned off by setting it to true or false.
    |
    */

    'OTP_SMS' => env('OTP_SMS', TRUE),


    /*
    |--------------------------------------------------------------------------
    | EMAIL OTP Service
    |--------------------------------------------------------------------------
    |
    | OTP service used for authenticated requests to be executed. In case of
    | developer mode, it can be turned off by setting it to true or false.
    |
    */

    'OTP_EMAIL' => env('OTP_EMAIL', TRUE),



    /*
    |--------------------------------------------------------------------------
    | OTP TIME VALIDATION
    |--------------------------------------------------------------------------
    |
    | OTP TIME VALIDATION used for validated time of OTP.
    |
    */

    'OTP_VALID_TIME' => env('OTP_VALID_TIME', 2),

];
