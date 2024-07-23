<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use LdapRecord\Container;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'password' => 'required|string',
        ];

        if ($this->has('cpfNo')) {
            // If 'cpfNo' is present, validate 'cpfNo' and 'password'
            $rules['cpfNo'] = 'required|string';
        } elseif ($this->has('phone')) {
            // If 'phone' is present, validate 'phone' and 'password'
            $rules['phone'] = 'required|string';
        }

        return $rules;
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        $cpfNo      =   $this->input('cpfNo');
        $phone      =   $this->input('phone');
        $password   =   $this->input('password');

        if( $this->input('username') ){

            dd($this->input('username'));

        }else if( $this->input('cpfNo') && $this->input('cpfNo') != NULL ){


                $user       =   User::where('cpfNo', $cpfNo)->first();
                if($user == null){
                    $connection = Container::getConnection('default');
                    $record = $connection->query()->findBy('samaccountname', $cpfNo );
                    if(!$record) {
                        // User not found, throw validation exception
                        throw ValidationException::withMessages([
                            'cpfno' => trans('auth.user_not_found'),
                        ]);
                    }else{
                        $user = User::create([
                            'name' => $record['name'][0],
                            'email' => $record['mail'][0],
                            'cpfNo' => $cpfNo,
                            // 'username' => $request->username,
                            'password' => Hash::make($password),
                        ]);
                    }
                }

                // Attempt LDAP authentication
                if (! Auth::attempt(['cpfno' => $cpfNo, 'password' => $password])) {
                    RateLimiter::hit($this->throttleKey());

                    throw ValidationException::withMessages([
                        'cpfNo' => trans('auth.failed'),
                    ]);
                }


        }else if( $this->input('phone') != NULL ){

            // User authentication with phone
            if (! Auth::attempt(['phone' => $phone, 'password' => $password])) {
                RateLimiter::hit($this->throttleKey());

                throw ValidationException::withMessages([
                    'phone' => trans('auth.failed'),
                ]);
            }

        }
        
        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'phone' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->input('email')).'|'.$this->ip());
    }
}
