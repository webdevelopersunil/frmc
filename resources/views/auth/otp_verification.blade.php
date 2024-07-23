<x-guest-layout>

    <x-auth-session-status class="mb-4" :status="session('status')" />
        <div class="box-root padding-top--48 padding-bottom--24 flex-flex flex-justifyContent--center">
            <h1>
                <a href="" rel="dofollow">OTP Verification</a>
            </h1>
        </div>
        <div class="formbg-outer">

            <div class="formbg">

                <div class="formbg-inner padding-horizontal--48">

                <span class="padding-bottom--15">Please provide the 6-digit OTP received on your phone.</span>

              <form method="POST" action="{{ route('confirm.otp-verification') }}">

                    @csrf

                    <div class="field padding-bottom--24">
                        <x-input-label for="username" :value="__('Username')" />
                        <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username') ? old('username') : $username" required disabled />
                        <x-text-input type="hidden" name="username" :value="old('username') ? old('username') : $username"/>
                        <x-input-error :messages="$errors->get('username')" class="mt-2" />
                    </div>

                    <div class="field padding-bottom--24">
                    <div class="grid--50-50">
                        <x-input-label for="otp" :value="__('OTP')" />
                    </div>
                        <x-text-input id="otp" class="block mt-1 w-full"
                                        type="password"
                                        name="otp"
                                        value=""
                                        autofocus
                                        required />

                        <x-input-error :messages="$errors->get('otp')" class="mt-2" />
                    </div>

                    <div class="field field-checkbox padding-bottom--24 flex-flex align-center">
                        <label for="checkbox">
                            <a href="#">Test OTP is : {{ $otp }}</a>
                        </label>
                    </div>

                    <div class="field padding-bottom--24">
                        <input type="submit" name="submit" value="Submit">
                    </div>

                    <div class="field">
                        <a class="ssolink" href="{{ route('complainant.login') }}">Login as Complainant →</a>
                    </div>

                </form>
            </div>
        </div>
    </div>

</x-guest-layout>