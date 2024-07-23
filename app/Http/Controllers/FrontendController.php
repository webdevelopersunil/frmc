<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class FrontendController extends Controller{
    
    public function index(){

        // return view('welcome');
        return redirect('login');
    }

    public function adminLogin(){

        return view('auth.login');
    }

    public function complainantLogin(){

        return view('auth.user_login');
    }

    public function otpVerification(Request $request){

        $username   =   $decrypted = Crypt::decryptString($request->token);

        $isVerified =   User::where('username',$username)->first('is_phone_verified');

        if($isVerified->is_phone_verified == '1'){

            if (Auth::check()) {
                // If user is logged in, redirect to dashboard
                return redirect()->route('user.dashboard');
            } else {
                // If user is not logged in, redirect to login route
                return redirect()->route('login');
            }

        }else{

            $otp        =   DB::table('otps')->where('identifier', $username)->value('token');
            
            return view('auth.otp_verification', compact('username','otp'));
        }
        
    }
}