<?php

if (!function_exists('formatDate')) {
    function    formatDate($date, $format = 'd-m-Y')
    {
        return \Carbon\Carbon::parse($date)->format($format);
    }
}

if (!function_exists('generateUniqueCode')) {
    function    generateUniqueCode($length = 10)
    {
        return substr(md5(uniqid(mt_rand(), true)), 0, $length);
    }
}


if (!function_exists('getRegisteredRolesNo')){
    
    function    getRegisteredRolesNo(){
        return [
            'Nodal' =>  753159,
            'FRMC'  => 456753
        ];
    }
}