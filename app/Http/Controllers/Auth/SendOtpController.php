<?php

namespace App\Http\Controllers\Auth;

use Ichtrojan\Otp\Otp;
use App\Services\OtpService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;

class SendOtpController extends Controller
{
    protected $otpService;

    public function __construct(OtpService $otpService){

        $this->otpService       =   $otpService;
        $this->OTP_VALID_TIME   =   config('otp.OTP_VALID_TIME');
    }

    // Send OTP While Login User
    public function sendOtp(Request $request){

        $rules = [
            'username' => 'required|numeric|exists:users,username', // Check if username exists in the users table
        ];

        // Validate the request data
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $phone = $request->username;
        $otp = (new Otp)->generate(trim($phone), 'numeric', 6, $this->OTP_VALID_TIME);

        $status =   $this->otpService->sendOtp(intval($phone), strval($otp->token));

        $status = 'otp-sent';

        // return Redirect::route('login')->with(['status' => 'otp-sent', 'phone' => $phone]);

    
        return Redirect::route('otp',Crypt::encryptString($phone));
    }



    public function otpVerificationForm(Request $request){
        
        $phone  =   Crypt::decryptString($request->token);

        return view('auth.otp-verification', compact('phone'));
    }

    public function otpVerification(Request $request){

        // Define validation rules
        $rules = [
            'otp' => 'required|numeric',
        ];

        // Validate the request data
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

    }


    public function sendPhoneOtp(Request $request){

        // Validate if phone number is already existed
        $isUsernameFound = User::where('username', $request->input('username'))->first();
        if ($isUsernameFound) {
            return response()->json([
                'success' => false,
                'message' => "Phone number already registered",
            ], 400);
        }

        // Validate if email address is already existed
        $isUserEmailFound = User::where('email', $request->input('email'))->first();
        if ($isUserEmailFound) {
            return response()->json([
                'success' => false,
                'message' => "Email address already registered",
            ], 400);
        }
    
        $phone_otp = (new Otp)->generate($request->input('username'), 'numeric', 6, $this->OTP_VALID_TIME);
        // Send Otp to Un-registered phone number
        $status = $this->otpService->sendOtp(intval($request->input('username')), strval($phone_otp->token));
        
        $email_otp = (new Otp)->generate($request->input('email'), 'numeric', 6, $this->OTP_VALID_TIME);

    
        // Simulate OTP sending logic
        // $this->otpService->sendOtp(intval($username), strval($otp->token));
    
        return response()->json([
            'success' => true,
            'message' => 'OTP sent successfully!',
        ]);
    }
    

}
