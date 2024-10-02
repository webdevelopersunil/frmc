<?php

namespace App\Services;

use Auth;
use App\Models\User;
use App\Models\Complain;
use App\Models\WorkCenter;
use App\Services\OtpService;
use App\Mail\FcoComplainMail;
use App\Mail\UserComplainMail;
use App\Mail\NodalComplainMail;
use Illuminate\Support\Facades\Mail;


class NotificationService{

    public function __construct() {

        $this->c_user           =   Auth::user();
        $this->otpService       =   new OtpService;
        $this->OTP_SMS          =   config('otp.OTP_SMS');
        $this->OTP_EMAIL        =   config('otp.OTP_EMAIL');
    }

    public function userInfo($id){
        $data           =   array();
        $data['user']   =   User::where('id', $id)->select('name', 'username', 'phone','email')->first();
        $data['role']   =   (new User())->getCurrentRole($id);

        return $data;
    }
 
    // Sending Mail and SMS to USER,NODAL,FCO
    public function userComplain($complain, $action) :bool {
        
        $complain_no        =   $complain->complain_no;
        $complainant_id     =   $complain->complainant_id;
        
        // Nodal Officer Information
        $work_center        =   WorkCenter::find($complain->work_centre_id);
        $nodal              =   $this->userInfo($work_center->nodal_officer_id); //user[] && role
        $nodal_email        =   $nodal['user']->email;
        $nodal_name         =   $nodal['user']->name;
        $nodal_phone         =   $nodal['user']->phone;
        
        // Complainant User Information
        $complainant        =   $this->userInfo($complainant_id); //user[] && role
        $complainant_name   =   $complainant['user']->name;
        $complainant_email  =   $complainant['user']->email;
        $complainant_phone  =   $complainant['user']->phone;
        $complainant_user               =   [ 
                                    'name' => $complainant['user']->name, 
                                    'phone' => $complainant_phone,
                                    'email' => $complainant['user']->email 
                                ];
        
        // FCO Officer Information
        $fco                =   $this->userInfo(4); //user[] && role
        $fco_email          =   $fco['user']->email;
        $fco_name           =   $fco['user']->name;
        $fco_phone          =   $fco['user']->phone;

        // Test Purpose Credentials
        // $nodal_email    =   "sunikumar300@gmail.com";
        // $fco_email      =   "boobaebub@gmail.com";

        
        if( $action == "CREATED" ){



            if($this->OTP_EMAIL == TRUE){

                if(filter_var($nodal_email, FILTER_VALIDATE_EMAIL)) { // To Nodal
                    Mail::to($nodal_email)->send(new UserComplainMail($complain, $action, $complainant_user, $nodal['user'], $nodal_name));
                }
                if(filter_var($fco_email, FILTER_VALIDATE_EMAIL)) { // To FCO
                    Mail::to($fco_email)->send(new UserComplainMail($complain, $action, $complainant_user, $nodal['user'], $fco_name));
                }
                if(filter_var($complainant_email, FILTER_VALIDATE_EMAIL)) { // To User
                    Mail::to($complainant_email)->send(new UserComplainMail($complain, $action, $complainant_user, $nodal['user'], $complainant_name));
                }
            }

            if($this->OTP_SMS == TRUE){

                $this->otpService->smsNotification( intval($nodal_phone), $complain_no, "CREATED"); // Nodal
                $this->otpService->smsNotification( intval($fco_phone), $complain_no, "CREATED"); // Fco
                $this->otpService->smsNotification( intval($complainant_phone), $complain_no, "CREATED"); // Complainant
            }
            

            

        }else if( $action == "UPDATED" ){


            
            if($this->OTP_EMAIL == TRUE){

                if(filter_var($nodal_email, FILTER_VALIDATE_EMAIL)) { // To Nodal
                    Mail::to($nodal_email)->send(new UserComplainMail($complain, $action, $complainant_user, $nodal['user'], $nodal_name));
                }
                if(filter_var($fco_email, FILTER_VALIDATE_EMAIL)) { // To Fco
                    Mail::to($fco_email)->send(new UserComplainMail($complain, $action, $complainant_user, $nodal['user'], $fco_name));
                }
                if(filter_var($fco_email, FILTER_VALIDATE_EMAIL)) { // To User
                    Mail::to($fco_email)->send(new UserComplainMail($complain, $action, $complainant_user, $nodal['user'], $complainant_name));
                }
            }
            
            if($this->OTP_SMS == TRUE){
                
                $this->otpService->smsNotification( intval($nodal_phone), $complain_no, "UPDATED"); // Nodal
                $this->otpService->smsNotification( intval($fco_phone), $complain_no, "UPDATED"); // Fco
                $this->otpService->smsNotification( intval($complainant_phone), $complain_no, "UPDATED"); // Complainant
            }



        }else if( $action == "NODAL_UPDATED" ){


            
            if($this->OTP_EMAIL == TRUE){

                if(filter_var($nodal_email, FILTER_VALIDATE_EMAIL)) { // To Nodal
                    Mail::to($nodal_email)->send(new NodalComplainMail($complain, $action, $complainant_user, $nodal['user'], $nodal_name));
                }
                if(filter_var($fco_email, FILTER_VALIDATE_EMAIL)) { // To Fco
                    Mail::to($fco_email)->send(new NodalComplainMail($complain, $action, $complainant_user, $nodal['user'], $fco_name));
                }
                if(filter_var($fco_email, FILTER_VALIDATE_EMAIL)) { // To User
                    Mail::to($fco_email)->send(new NodalComplainMail($complain, $action, $complainant_user, $nodal['user'], $complainant_name));
                }
            }

            if($this->OTP_SMS == TRUE){

                $this->otpService->smsNotification( intval($nodal_phone), $complain_no, "NODAL_UPDATED"); // Nodal
                $this->otpService->smsNotification( intval($fco_phone), $complain_no, "NODAL_UPDATED"); // Fco
                $this->otpService->smsNotification( intval($complainant_phone), $complain_no, "NODAL_UPDATED"); // Complainant
            }




        }else if( $action == "FCO_UPDATED" ){


            if($this->OTP_EMAIL == TRUE){   // MAIL Notification
                if(filter_var($nodal_email, FILTER_VALIDATE_EMAIL)) { // To Nodal
                    Mail::to($nodal_email)->send(new FcoComplainMail($complain, $action, $complainant_user, $nodal['user'], $nodal_name));
                }
                if(filter_var($fco_email, FILTER_VALIDATE_EMAIL)) { // To Fco
                    Mail::to($fco_email)->send(new FcoComplainMail($complain, $action, $complainant_user, $nodal['user'], $fco_name));
                }
                if(filter_var($fco_email, FILTER_VALIDATE_EMAIL)) { // To User
                    Mail::to($fco_email)->send(new FcoComplainMail($complain, $action, $complainant_user, $nodal['user'], $complainant_name));
                }                
            }

            if($this->OTP_SMS == TRUE){ // SMS Notification
                $this->otpService->smsNotification( intval($nodal_phone), $complain_no, "FCO_UPDATED"); // Nodal
                $this->otpService->smsNotification( intval($fco_phone), $complain_no, "FCO_UPDATED"); // Fco
                $this->otpService->smsNotification( intval($complainant_phone), $complain_no, "FCO_UPDATED"); // Complainant
            }



        }else if( $action == "FCO_WORK_CENTER_UPDATED" ){


            if($this->OTP_EMAIL == TRUE){   // MAIL Notification
                if(filter_var($nodal_email, FILTER_VALIDATE_EMAIL)) { // To Nodal
                    Mail::to($nodal_email)->send(new FcoComplainMail($complain, $action, $complainant_user, $nodal['user'], $nodal_name));
                }
                if(filter_var($fco_email, FILTER_VALIDATE_EMAIL)) { // To Fco
                    Mail::to($fco_email)->send(new FcoComplainMail($complain, $action, $complainant_user, $nodal['user'], $fco_name));
                }
                if(filter_var($fco_email, FILTER_VALIDATE_EMAIL)) { // To User
                    Mail::to($fco_email)->send(new FcoComplainMail($complain, $action, $complainant_user, $nodal['user'], $complainant_name));
                }                
            }

            if($this->OTP_SMS == TRUE){

                $this->otpService->smsNotification( intval($nodal_phone), $complain_no, "FCO_WORK_CENTER_UPDATED"); // Nodal
                $this->otpService->smsNotification( intval($fco_phone), $complain_no, "FCO_WORK_CENTER_UPDATED"); // Fco
                $this->otpService->smsNotification( intval($complainant_phone), $complain_no, "FCO_WORK_CENTER_UPDATED"); // Complainant
            }


        }

        
        return TRUE;
    }
    
}
