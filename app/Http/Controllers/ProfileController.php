<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\PhoneUpdateRequest;
use App\Http\Requests\ProfileUpdateRequest;

use Ichtrojan\Otp\Otp;
use App\Services\OtpService;

class ProfileController extends Controller{

    protected $otpService;

    public function __construct(OtpService $otpService)
    {
        $this->otpService = $otpService;
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

        $otp    =   (new Otp)->generate($request->phone, 'numeric', 6, 15);
        
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
