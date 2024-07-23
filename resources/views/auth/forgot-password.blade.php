<x-guest-layout>
  
  <div class="box-root padding-top--48 padding-bottom--24 flex-flex flex-justifyContent--center">
    <h1>
      <a href="" rel="dofollow">Password Recovery</a>
    </h1>
  </div>
  
  <div class="formbg-outer">
    <div class="formbg">
      <div class="formbg-inner padding-horizontal--48">

        <span class="padding-bottom--15">
            {{ __('Forgot your password?') }}
        </span><br>

        <span class="padding-bottom--15" style="font-size:16px; font-weight:300;" >
            {{ __('No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </span><br>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

          <div class="field padding-bottom--24">
                <x-input-label for="email" :value="__('Email Address')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
          </div>


          <div class="field padding-bottom--24">
            <input type="submit" name="submit" value="{{ __('Email Password Reset Link') }}">
          </div>

          <div class="field">
            <a class="ssolink" href="{{ route('complainant.login') }}">← Back to Login</a>
          </div>

        </form>

      </div>
    </div>

  </div>

</x-guest-layout>
