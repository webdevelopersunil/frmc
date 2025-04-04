<?php

namespace App\Services;

use Auth;
use App\Models\User;
use App\Models\Complain;
use App\Models\WorkCenter;
use App\Services\OtpService;
use App\Mail\FcoComplainMail;
use App\Mail\UserComplainMail;
use App\Mail\ComplainUpdateMail;
use App\Mail\NodalComplainMail;
use Illuminate\Support\Facades\Mail;


class NotificationService {

    protected $complain;
    protected $action;
    protected $nodal;
    protected $complainant;
    protected $complainant_detail;
    protected $fco;
    protected $c_user;
    protected $otpService;
    protected $OTP_SMS;
    protected $OTP_EMAIL;

    public function __construct($complain, $action) {

        $this->c_user           =   Auth::user();
        $this->otpService       =   new OtpService;
        $this->OTP_SMS          =   config('otp.OTP_SMS');
        $this->OTP_EMAIL        =   config('otp.OTP_EMAIL');

        // Store complain and action
        $this->complain         =   $complain;
        $this->action           =   $action;

        // Fetch nodal officer info
        $work_center            =   WorkCenter::find($this->complain->work_centre_id);

        $this->nodal            =   $this->userInfo($work_center->nodal_officer_id);    //user[] && role
        $this->complainant      =   $this->userInfo($this->complain->complainant_id);   //user[] && role
        $this->fco              =   $this->userInfo(4); //user[] && role

        $this->complainant_detail     =   ['name'=>$this->complainant['user']->name,'phone'=>$this->complainant['user']->phone,'email'=>$this->complainant['user']->email];
        
    }

    protected function userInfo($id) {

        $data           =   array();
        $data['user']   =   User::where('id', $id)->select('name', 'username', 'phone','email')->first();
        $data['role']   =   (new User())->getCurrentRole($id);

        return $data;
    }

    protected function sendEmail($recipient, $mailClass, $name) {

        if ($this->OTP_EMAIL == TRUE && filter_var($recipient->email, FILTER_VALIDATE_EMAIL)) {
            Mail::to($recipient->email)->send(
                // new $mailClass($this->complain, $this->action, $this->complainant['user'], $this->nodal['user'], $name)
                new $mailClass($this->complain, $this->action, $this->complainant['user'], $this->nodal['user'], $this->fco['user'], $name)
            );
        }
    }

    protected function sendSMS($phone, $status) {

        if ($this->OTP_SMS == TRUE && is_numeric($phone)) {
            $this->otpService->smsNotification(intval($phone), $this->complain->complain_no, $status);
        }
    }

    public function userComplainCreate() {

        // Sending Emails
        // $this->sendEmail($this->nodal['user'], UserComplainMail::class, $this->nodal['user']->name);
        // $this->sendEmail($this->fco['user'], UserComplainMail::class, $this->fco['user']->name);
        $this->sendEmail($this->complainant['user'], UserComplainMail::class, $this->complainant['user']->name);

        // Sending SMS
        $this->sendSMS($this->nodal['user']->phone, "CREATED");
        $this->sendSMS($this->fco['user']->phone, "CREATED");
        $this->sendSMS($this->complainant['user']->username, "CREATED");
    }

    public function userComplainUpdate() {

        // Sending Emails
        // $this->sendEmail($this->nodal['user'], ComplainUpdateMail::class, $this->nodal['user']->name);
        // $this->sendEmail($this->fco['user'], ComplainUpdateMail::class, $this->fco['user']->name);
        $this->sendEmail($this->complainant['user'], ComplainUpdateMail::class, $this->complainant['user']->name);

        // Sending SMS
        $this->sendSMS($this->complainant['user']->username, "UPDATED");
        $this->sendSMS($this->nodal['user']->phone, "UPDATED");
        $this->sendSMS($this->fco['user']->phone, "UPDATED");
    }

    public function nodalDocumentUpdate() {

        // Sending Emails
        // $this->sendEmail($this->nodal['user'], NodalComplainMail::class, $this->nodal['user']->name);
        // $this->sendEmail($this->fco['user'], NodalComplainMail::class, $this->fco['user']->name);
        $this->sendEmail($this->complainant['user'], NodalComplainMail::class, $this->complainant['user']->name);

        // Sending SMS
        $this->sendSMS($this->complainant['user']->username, "NODAL_UPDATED");
        $this->sendSMS($this->nodal['user']->phone, "NODAL_UPDATED");
        $this->sendSMS($this->fco['user']->phone, "NODAL_UPDATED");
    }

    public function fcoDocumentUpload() {

        // Sending Emails
        // $this->sendEmail($this->nodal['user'], FcoComplainMail::class, $this->nodal['user']->name);
        // $this->sendEmail($this->fco['user'], FcoComplainMail::class, $this->fco['user']->name);
        $this->sendEmail($this->complainant['user'], FcoComplainMail::class, $this->complainant['user']->name);

        // Sending SMS
        $this->sendSMS($this->complainant['user']->username, "FCO_UPDATED");
        $this->sendSMS($this->nodal['user']->phone, "FCO_UPDATED");
        $this->sendSMS($this->fco['user']->phone, "FCO_UPDATED");
    }

    public function fcoWorkCenterUpdate() {

        // Sending Emails
        // $this->sendEmail($this->nodal['user'], FcoComplainMail::class, $this->nodal['user']->name);
        // $this->sendEmail($this->fco['user'], FcoComplainMail::class, $this->fco['user']->name);
        $this->sendEmail($this->complainant['user'], FcoComplainMail::class, $this->complainant['user']->name);

        // Sending SMS
        $this->sendSMS($this->complainant['user']->username, "FCO_WORK_CENTER_UPDATED");
        $this->sendSMS($this->nodal['user']->phone, "FCO_WORK_CENTER_UPDATED");
        $this->sendSMS($this->fco['user']->phone, "FCO_WORK_CENTER_UPDATED");
    }
    
}
