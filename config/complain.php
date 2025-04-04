<?php

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;

return [

    /*
    |--------------------------------------------------------------------------
    |complaint statuses
    |--------------------------------------------------------------------------
    |  1 | With FCO                                           
    |  2 | With Nodal Officer                                 
    |  3 | Under FRMC deliberations for Closure/Investigation 
    |  4 | Under Investigation                                
    |  5 | Fraud Not Established – Complaint archived         
    |  6 | Fraud Established – Complaint archived             
    |  7 | Withdrawn – to be ignored                          
    */

    /*
    |--------------------------------------------------------------------------
    |Complaint Closed Whcih Have Status
    |--------------------------------------------------------------------------
    */

    'CMP_CLOSED' => [5,6,7],

];
