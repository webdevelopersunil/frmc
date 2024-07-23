<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class OtpService{

    public function _sendOtp($mobile, $otp){
        
        // Construct the message body
        // $messageBody = "Your application has been submitted successfully for the year '.$year.'. Application No: 8786756767576. Regards, ONGC";
        $messageBody = "Your application has been submitted successfully for the year $otp. Application No: $otp. Regards, ONGC";
        
        // Construct the URL
        $url = "http://10.205.48.190:13013/cgi-bin/sendsms";
        
        // Construct the request parameters
        $params = [
            'username' => 'ongc',
            'password' => 'ongc12',
            'from' => 'ONGC',
            'to' => $mobile,
            'text' => $messageBody,
            'charset' => 'UTF-8',
            'meta-data' => '?smpp?EntityID=1001186049255234740&ContentID=1407166132500753063'
        ];

        // Send the HTTP request using GuzzleHttp Client
        $client = new Client();
        $response = $client->request('GET', $url, [
            'query' => $params
        ]);

        // Get the response body
        $responseBody = $response->getBody()->getContents();

        // Return the response body
        return $responseBody;
    }

    public function sendOtp($mobile, $otp){
    
        $otpmessage ="$otp is the OTP to access Frmc-portal. This is valid for 5 minutes.";
 
        $url = "http://10.205.48.190:13013/cgi-bin/sendsms?username=ongc&password=ongc12&from=ONGC&to=$mobile&text=".urlencode($otpmessage)."+\nRegards+Ongc&charset=UTF-8&meta-data=%3Fsmpp%3FEntityID%3D1001186049255234740%26ContentID%3D1407165363567411666";

        $status = Http::get($url);
       
    }    
}
