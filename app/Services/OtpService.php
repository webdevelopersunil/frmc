<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OtpService {

    
    /**
     * The OTP enabled flag.
     *
     * @var bool
     */
    private bool $phoneOtpEnabled;

    /**
     * Create a new service instance.
     *
     * @return void
     */
    public function __construct() {

        $this->phoneOtpEnabled = config('otp.OTP_SMS');
    }

    /**
     * Send OTP to the given mobile number.
     *
     * @param string $mobile
     * @param string $otp
     * @return \Illuminate\Http\Client\Response|bool
     */

    public function sendOtp(string $mobile, string $otp){
        
        if ($this->phoneOtpEnabled == TRUE) {

            $otpMessage =   "$otp is the OTP to access Frmc-portal. This is valid for 5 minutes.";
            $url        =   "http://10.205.48.190:13013/cgi-bin/sendsms";
            $username   =   "ongc";
            $password   =   "ongc12";
            $from       =   "ONGC";
            $to         =   $mobile;
            $metaD      =   "+\nRegards+Ongc&charset=UTF-8&meta-data=%3Fsmpp%3FEntityID%3D1001186049255234740%26ContentID%3D1407165363567411666";

            $q          =   $url."?username=".$username."&password=".$password."&from=".$from."&to=".$mobile."&text=".urlencode($otpMessage).$metaD;

            return Http::get($q);
        }

        return false;
    }


    public function notifyOtp(string $mobile, string $otp){
        
        if ($this->phoneOtpEnabled == TRUE) {

            $otpMessage =   "$otp is the OTP to access Frmc-portal. This is valid for 5 minutes.";
            $url        =   "http://10.205.48.190:13013/cgi-bin/sendsms";
            $username   =   "ongc";
            $password   =   "ongc12";
            $from       =   "ONGC";
            $to         =   $mobile;
            $metaD      =   "+\nRegards+Ongc&charset=UTF-8&meta-data=%3Fsmpp%3FEntityID%3D1001186049255234740%26ContentID%3D1407165363567411666";

            $q          =   $url."?username=".$username."&password=".$password."&from=".$from."&to=".$mobile."&text=".urlencode($otpMessage).$metaD;

            return Http::get($q);
        }

        return false;
    }

    function smsNotification($phoneNumber, $ticketNumber, $status) {
        
        // Construct the full URL
        $url = "http://10.205.48.190:13013/cgi-bin/sendsms?username=ongc&password=ongc12&from=ONGC&to=$phoneNumber&text=Your%20Complaint%20has%20been%20register%20with%20ticket%20no.%20$ticketNumber%20and%20status%20is%20$status.%20Regards%20ONGC&charset=UTF-8&meta-data=%3Fsmpp%3FEntityID%3D1001186049255234740%26ContentID%3D1407166814975984061";
        
    
        // Send the HTTP GET request
        $response = file_get_contents($url);
    
        // Return the response
        return $response;
    }

}
