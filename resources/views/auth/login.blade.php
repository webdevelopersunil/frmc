<x-guest-layout>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="box-root padding-top--48 padding-bottom--24 flex-flex flex-justifyContent--center">
        <h1 style="text-align: center;">
            <img src="https://presentations.gov.in/wp-content/uploads/2020/06/ONGC-Preview.png" class="logo-image mr-2" alt="logo">
            <a href="" rel="dofollow">FRMC</a>
        </h1>
    </div>

    <div class="formbg-outer">

        <div class="formbg">

            <div class="formbg-inner padding-horizontal--48">
            <span class="padding-bottom--15">Sign in to your account</span>

            <form method="POST" action="{{ route('login') }}">

                @csrf

                <div class="field padding-bottom--24">
                    <x-input-label for="username" :value="__('CPF No')" />
                    <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username') ? old('username') : 'nodal_officer'" required autofocus />
                    <x-input-error :messages="$errors->get('username')" class="mt-2" />
                </div>

                <div class="field padding-bottom--24">
                <div class="grid--50-50">
                    <x-input-label for="password" :value="__('Password')" />
                        <!-- <div class="reset-pass">
                            <a href="#">Forgot your password?</a>
                        </div> -->
                </div>

                    <x-text-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    value="password"
                                    required autocomplete="current-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="field field-checkbox padding-bottom--24 flex-flex align-center">
                    <label for="checkbox">
                        <input type="checkbox" name="checkbox"> Remember me
                    </label>
                </div>

                <div class="field padding-bottom--24">
                    <input type="submit" name="submit" value="Login">
                </div>

                <div class="field">
                    <a class="ssolink" href="{{ route('login') }}">Login as Complainant →</a>
                </div>

            </form>
        </div>
    </div>

</x-guest-layout>