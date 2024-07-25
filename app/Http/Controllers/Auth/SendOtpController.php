<?php

namespace App\Http\Controllers\Auth;

use Ichtrojan\Otp\Otp;
use App\Services\OtpService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;

class SendOtpController extends Controller
{
    protected $otpService;

    public function __construct(OtpService $otpService)
    {
        $this->otpService = $otpService;
    }

    public function sendOtp(Request $request)
    {
        // Define validation rules
        $rules = [
            'username' => 'required|numeric|exists:users,username', // Check if username exists in the users table
        ];

        // Validate the request data
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $phone = $request->username;
        $otp = (new Otp)->generate($phone, 'numeric', 6, 15);

        $this->otpService->sendOtp(intval($phone), strval($otp->token));

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



    // public function otpVerification(Request $request){

    //     $username   =   $decrypted = Crypt::decryptString($request->token);

    //     $isVerified =   User::where('username',$username)->first('is_phone_verified');

    //     if($isVerified->is_phone_verified == '1'){

    //         if (Auth::check()) {
    //             // If user is logged in, redirect to dashboard
    //             return redirect()->route('user.dashboard');
    //         } else {
    //             // If user is not logged in, redirect to login route
    //             return redirect()->route('login');
    //         }

    //     }else{

    //         $otp        =   DB::table('otps')->where('identifier', $username)->value('token');
            
    //         return view('auth.otp_verification', compact('username','otp'));
    //     }
        
    // }
}
