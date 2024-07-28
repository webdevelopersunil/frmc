<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Mail\SendOtp;
use Ichtrojan\Otp\Otp;
use Illuminate\View\View;
use App\Jobs\SendOtpEmail;
use Illuminate\Http\Request;
use App\Services\OtpService;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{

    protected $otpService;

    public function __construct(OtpService $otpService)
    {
        $this->otpService = $otpService;
    }

    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // dd('otpVerification 3');
        $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'email'         => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'username'      => ['required', 'string', 'unique:'.User::class],
            'dob'           => ['nullable', 'date', 'before:today'],
            'house_number'  => ['nullable','string',],
            'area'          => ['nullable','string',],
            'landmark'      => ['nullable','string',],
            'city'          => ['nullable','string',],
            'state'         => ['nullable','string',],
            'pincode'       => ['nullable','integer',],

        ]);

        $phone_otp    =   (new Otp)->generate($request->username, 'numeric', 6, 5);
        $email_otp    =   (new Otp)->generate($request->email, 'numeric', 6, 5);

        $user = User::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'username'   => $request->username,
            'address'    => $request->address,
            'password'   => Hash::make("password"),
            'phone_otp'  => $phone_otp->token,
            'email_otp'  => $email_otp->token,
        ])->assignRole('user');

        // Sending OTP to Email Address
        // Mail::to($user->email)->send(new SendOtp($otp->token));  #Priority
        
        // Sending OTP to Phone Number
        // $status = $this->otpService->sendOtp(intval($request->username), strval($phone_otp->token)); #Priority
        
        event(new Registered($user));
        
        return redirect(RouteServiceProvider::OTP.'/'.Crypt::encryptString($request->username).'/'.Crypt::encryptString($request->email));
    }

    public function store_old(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'username' => ['required', 'string', 'unique:'.User::class],
            // 'address' => ['required', 'string'],
            // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'address' => $request->address,
            // 'password' => Hash::make($request->password),
            'password' => Hash::make("password"),
        ])->assignRole('user');

        $otp    =   (new Otp)->generate($request->username, 'numeric', 6, 15);

        Mail::to($user->email)->send(new SendOtp($otp->token));
        // SendOtpEmail::dispatch($user->email, $otp->token);

        // OTP Sending
        $status = $this->otpService->sendOtp(intval($request->username), strval($otp->token));
        
        event(new Registered($user));
        
        return redirect(RouteServiceProvider::OTP.'/'.Crypt::encryptString($request->username));
        
        // Auth::login($user);
        // return redirect(RouteServiceProvider::USER);
    }

    public function confirmOtpVerification(Request $request){
        dd('otpVerification 2');
        $user   =   User::where('username',$request->username)->first();

        if($user->is_phone_verified == '0'){
            
            $status =   (new Otp)->validate($request->username, $request->otp);
            
            if ($status->status == false) {
                
                return redirect()->back()->withErrors(['otp' => 'Please enter valid OTP.']);   
            }

            $user->is_phone_verified = '1';

            $user->save();

            Auth::login($user);

            return redirect(RouteServiceProvider::USER);
        }
    }

    public function otpVerification(Request $request){
    // dd('otpVerification 1');
        $username   =   $decrypted = Crypt::decryptString($request->token);
        $email      =   $decrypted = Crypt::decryptString($request->email);
        
        $user       =   User::where(['username'=>$username, 'email'=>$email])->first();

        if($user->phone_verified == true || $user->email_verified == true){

            if (Auth::check()) {
                // If user is logged in, redirect to dashboard
                return redirect()->route('user.dashboard');
            } else {
                // If user is not logged in, redirect to login route
                return redirect()->route('login');
            }

        }else{

            $phone_verified =   $user->phone_verified;
            $email_verified =   $user->email_verified;

            return view('auth.otp_verification', compact('phone_verified','email_verified','username','email'));
        }
    }

    public function verifiedOtp(Request $request){


        $username   =   $request->username;
        $email      =   $request->email;
        $phone_otp  =   $request->phone_otp;
        $email_otp  =   $request->email_otp;


        $phoneOtpStatus =   (new Otp)->validate($username, $phone_otp);
        $emailOtpStatus =   (new Otp)->validate($email, $email_otp);

        $phoneStatus    =   (new Otp)->validate($username, $phone_otp);
        $emailStatus    =   (new Otp)->validate($email, $email_otp);

        $user       =   User::where(['username'=>$username, 'email'=>$email])->first();
        
        if ($phoneStatus->status == false) {
            
            return redirect()->back()->withErrors(['otp' => 'Please enter valid OTP.']);   
        }

        if ($emailStatus->status == false) {
            
            return redirect()->back()->withErrors(['otp' => 'Please enter valid OTP.']);   
        }

        $user->is_phone_verified = '1';
        $user->phone_verified = '1';
        $user->email_verified = '1';

        $user->save();

        // Auth::login($user);

        return redirect(RouteServiceProvider::HOME);

    }
}
