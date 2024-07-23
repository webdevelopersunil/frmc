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
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'username' => ['required', 'string', 'unique:'.User::class],
            'address' => ['required', 'string'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'address' => $request->address,
            'password' => Hash::make($request->password),
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
}
