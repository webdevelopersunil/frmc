<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
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
use Illuminate\Support\Facades\DB;


class RegisteredUserController extends Controller
{

    protected $otpService;

    public function __construct(OtpService $otpService)
    {
        $this->otpService       =   $otpService;
        $this->OTP_VALID_TIME   =   config('otp.OTP_VALID_TIME');
        $this->OTP_SMS          =   config('otp.OTP_SMS');
        $this->OTP_EMAIL        =   config('otp.OTP_EMAIL');
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

        $phone_otp    =   (new Otp)->generate($request->username, 'numeric', 6, $this->OTP_VALID_TIME);
        $email_otp    =   (new Otp)->generate($request->email, 'numeric', 6, $this->OTP_VALID_TIME);

        $user = User::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'username'   => $request->username,
            'address'    => $request->address,
            'password'   => Hash::make("password"),
            'phone_otp'  => $phone_otp->token,
            'email_otp'  => $email_otp->token,
        ])->assignRole('user');

        if( $this->OTP_EMAIL == TRUE ){
            // Sending OTP to Email Address
            Mail::to($user->email)->send(new SendOtp($email_otp->token));  #Priority
        }
        
        if($this->OTP_SMS == TRUE){
            // Sending OTP to Phone Number
            $status = $this->otpService->sendOtp(intval($request->username), strval($phone_otp->token)); #Priority
        }
        
        event(new Registered($user));
        
        return redirect(RouteServiceProvider::OTP.'/'.Crypt::encryptString($request->username).'/'.Crypt::encryptString($request->email));
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

    public function otpVerification(Request $request){
    
        $username   =   $decrypted = Crypt::decryptString($request->token);
        $email      =   $decrypted = Crypt::decryptString($request->email);
        
        $user       =   User::where(['username'=>$username, 'email'=>$email])->first();

        if($user->phone_verified == true && $user->email_verified == true){

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


    public function verifiedOtp(Request $request) {

        if($request->otp === "phone") {
            $phone_otp  = $request->phone_otp;
            $otp        = $request->otp;
            $username   = $request->username;
            $email      = $request->email;
        
            $phoneStatus = (new Otp)->validate($username, $phone_otp);
        
            $user = User::where('username', $username)->where('email', $email)->first();
            
            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }
        
            if ($phoneStatus->status == false) {
                return response()->json(['error' => 'Invalid phone OTP'], 400);
            }
        
            $user->phone_verified = 1;
            $user->save();
        
            return response()->json([
                'phone_verified'    =>  $user->phone_verified,
                'message'           =>  "Provided phone number has been successfully verified",
                // 'redirect_to'       =>  route(RouteServiceProvider::HOME),
                'email_verified'    => $user->email_verified
            ]);

        } else if($request->otp === "email"){

            $email_otp  = $request->email_otp;
            $otp        = $request->otp;
            $username   = $request->username;
            $email      = $request->email;

            $emailStatus    =   (new Otp)->validate($email, $email_otp);
            $user           =   User::where('username', $username)->where('email', $email)->first();
            
            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }
        
            if ($emailStatus->status == false) {
                return response()->json(['error' => 'Invalid email OTP'], 400);
            }
        
            $user->email_verified = 1;
            $user->save();
        
            return response()->json([
                'phone_verified'    =>  $user->phone_verified,
                'message'           =>  "Provided email address has been successfully verified",
                // 'redirect_to'       =>  route(RouteServiceProvider::HOME),
                'email_verified'    =>  $user->email_verified
            ]);
        }
    }

    public function resendRegisterOtp(Request $request) {

        $username   =   $request->username;
        $email      =   $request->email;
        $check      =   $request->check;

        

        if($request->check === "phone") {

            $record     = DB::table('otps')->where('identifier', $username)->first();
            $now        = Carbon::now();
            $createdAt  = Carbon::parse($record->created_at);

            if ($record) {
                
                if ($createdAt->diffInMinutes($now) > 2) {
                    $otp = (new Otp)->generate(trim($username), 'numeric', 6, $this->OTP_VALID_TIME);
                    $status =   $this->otpService->sendOtp(intval($username), strval($otp->token));
                    $message    =   "OTP has been re-send successfully.";
                    $status     =   TRUE;

                } else {

                    $message    =   "Please wait for 2 minutes before re-send OTP.";
                    $status     =   FALSE;
                }

                return response()->json([
                    'status'            =>  $status,
                    'message'           =>  $message,
                    'target'            =>  'phone'
                ]);

            } else {
                
                return response()->json([
                    'status'            =>  FALSE,
                    'message'           =>  "Err : Not Found",
                    'target'            =>  'phone'
                ]);
            }

        }else if($request->check === "email"){
            

            $record     = DB::table('otps')->where('identifier', $email)->first();
            $now        = Carbon::now();
            $createdAt  = Carbon::parse($record->created_at);


            if ($record) {
                
                if ($createdAt->diffInMinutes($now) > 2) {

                    $email_otp    =   (new Otp)->generate($request->email, 'numeric', 6, $this->OTP_VALID_TIME);
                    Mail::to($request->email)->send(new SendOtp($email_otp->token));

                    $message    =   "Email has been re-send successfully.";
                    $status     =   TRUE;

                } else {

                    $message    =   "Please wait for 2 minutes before re-send OTP.";
                    $status     =   FALSE;
                }

                return response()->json([
                    'status'            =>  $status,
                    'message'           =>  $message,
                    'target'            =>  'email'
                ]);

            } else {
                
                return response()->json([
                    'status'            =>  FALSE,
                    'message'           =>  "Err : Not Found",
                    'target'            =>  'email'
                ]);
            }


        }
    }
    
}
