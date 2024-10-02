<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\PhoneUpdateRequest;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Validation\Rule;

use Ichtrojan\Otp\Otp;
use App\Services\OtpService;

class ProfileController extends Controller{

    protected $otpService;

    public function __construct(OtpService $otpService)
    {
        $this->otpService       =   $otpService;
        $this->OTP_VALID_TIME   =   config('otp.OTP_VALID_TIME');
    }
    
    public function dashboard(){
        if( Auth::user() ){
            $role   =  Auth::user()->getRoleNames()[0];
            if($role == 'user'){
                return Redirect()->route('user.dashboard');
            }if($role == 'nodal'){
                return Redirect()->route('nodal.dashboard');
            }if($role == 'fco'){
                return Redirect()->route('fco.dashboard');
            }
        }else{
            return Redirect()->route('login');
        }
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function profileSendOtp(Request $request): RedirectResponse {

        $user   =   Auth::user();
        
        // For Send Phone NUmber OTP
        if(isset($request->new_username) && $request->username_otp_verification != "true" ){

            $validatedData = $request->validate(
                [
                'new_username' => [ 'required', 'numeric', 'digits:10', 'unique:users,username' ],
                ]
            );

            // Generate OTP For Phone Number
            $phone_otp    =   (new Otp)->generate($request->new_username, 'numeric', 6, $this->OTP_VALID_TIME);
            // Sending OTP to Phone Number
            $status = $this->otpService->sendOtp(intval($request->new_username), strval($phone_otp->token));
            
            return Redirect::route('profile.edit.otp', ['source' => 'phone', 'token' => $request->new_username])->with('success', 'OTP has been sent successfully');
        }

        // For Verification of Phone Number OTP
        if(isset($request->username_otp_verification) && $request->username_otp_verification == "true" ){
            
            $status =   (new Otp)->validate($request->new_username, $request->username_otp);
            
            if($status->status){

                $user->username =   $request->new_username;
                $user->save();

                return Redirect::route('profile.edit')->with('success', 'Phone Number has been successfully updated');
            }else{
                return redirect()->back()->with(['error' => 'Please enter valid OTP.']);
            }
        }


        // For Send OTP on Email Address
        if(isset($request->new_email) && $request->email_otp_verification != "true" ){

            $validatedData = $request->validate(
                [
                    'new_email' => [ 'required', 'string', 'email', 'unique:users,email' ],
                ]
            );

            // Generate OTP For Phone Number
            $email_otp    =   (new Otp)->generate($request->new_email, 'numeric', 6, $this->OTP_VALID_TIME);
            
            // Sending OTP to Email Address
            if( config('otp.OTP_EMAIL') == TRUE ){
                Mail::to($user->email)->send(new SendOtp($email_otp->token));  #Priority
            }
            
            return Redirect::route('profile.edit.otp', ['source' => 'email', 'token' => $request->new_email])->with('success', 'OTP has been sent successfully');
        }
        // OTP Verification of Email Address
        if(isset($request->email_otp_verification) && $request->email_otp_verification == "true" ){
            
            $status =   (new Otp)->validate($request->new_email, $request->email_otp);
            
            if($status->status){

                $user->email =   $request->new_email;
                $user->save();
                
                return Redirect::route('profile.edit')->with('success', 'Email Address has been successfully updated');
            }else{
                return redirect()->back()->with(['error' => 'Please enter valid OTP.']);
            }
        }

    }

    public function profileEditOtp(Request $request): View{
        
        $user       = $request->user();
        $source     = $request->source;

        if($source=='email'){
            $new_email      =   $request->token;
            $new_username   =   "";
        }else{
            $new_username   =   $request->token;
            $new_email      =   "";
        }
        
        return view('profile.edit', compact('user', 'new_email', 'new_username','source'));
    }


    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse {
    
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            // 'email' => 'required|email|nullable|unique:users,email,' . $request->user()->id,
            'state' => 'nullable|string|max:255',
            'pincode' => 'nullable|numeric|digits:6',
            'dob' => 'nullable|date|before:today',
            'house_number' => 'nullable',
            'address' => 'nullable',
            'landmark' => 'nullable',
            'city' => 'nullable',
            
        ]);

        $user               =   $request->user();
        
        $user->name         =   $request->name;
        $user->state        =   $request->state;
        $user->pincode      =   $request->pincode;
        $user->area         =   $request->area;
        $user->dob          =   $request->dob;
        $user->house_number =   $request->house_number;
        $user->address      =   $request->address;
        $user->landmark     =   $request->landmark;
        $user->city         =   $request->city;

        // Check if the email has changed and reset email_verified_at if it has
        // if ($user->isDirty('email')) {
        //     $user->email_verified_at = null;
        // }

        $user->save();

        return Redirect::route('profile.edit')->with('success', 'Profile successfully updated');
    }



    public function updatePhone(PhoneUpdateRequest $request): RedirectResponse {

        $otp    =   (new Otp)->generate($request->phone, 'numeric', 6, $this->OTP_VALID_TIME);
        
        // OTP Sending
        $status = $this->otpService->sendOtp(intval($request->phone), strval($otp->token));

        $phone      =   $request->phone;
        $form       =   'otp_sent';
        
        return Redirect::route('profile.edit')->with(['status'=>'otp-sent','phone'=>$request->phone]);
    }

    public function otpVerification(Request $request){

        $phone  = $request->phone;

        $status =   (new Otp)->validate($request->phone, $request->otp);

        if ($status->status == false) {

            // return redirect()->back()->withErrors(['otp' => 'Please enter valid OTP.']);
            return Redirect::route('profile.edit')->with(['status'=>'otp-sent','phone'=>$request->phone, 'err'=>'failed']);
        }

        $user = Auth::user();
        $user->username = $request->phone;
        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }


    
}
