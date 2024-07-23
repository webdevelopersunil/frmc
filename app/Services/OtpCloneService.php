<?php

namespace App\Services;

use GuzzleHttp\Client;

class OtpService{

    public function sendOtp($mobile, $year, $applicationNo){
        
        // Construct the message body
        $messageBody = "Your application has been submitted successfully for the year $year. Application No: $applicationNo. Regards, ONGC";
        
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
}
