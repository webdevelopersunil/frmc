<x-guest-layout>

  <div class="box-root padding-top--48 padding-bottom--24 flex-flex flex-justifyContent--center">
      <h1 style="text-align: center;">
          <img src="https://presentations.gov.in/wp-content/uploads/2020/06/ONGC-Preview.png" class="logo-image mr-2" alt="logo">
          <a href="" rel="dofollow">FRMC</a>
      </h1>
  </div>

  <div class="formbg-outer">
    <div class="formbg">
      <div class="formbg-inner padding-horizontal--48">

        <!-- <span class="padding-bottom--15">Sign up with your details.</span> -->

        <form method="POST" action="{{ route('register') }}">

          @csrf

          <div class="field padding-bottom--24">
              <x-input-label for="name" :value="__('Name')" />
              <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
              <x-input-error :messages="$errors->get('name')" class="mt-2" />
          </div>


          <div class="field padding-bottom--24">
              <x-input-label for="email" :value="__('Email')" />
              <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" />
              <x-input-error :messages="$errors->get('email')" class="mt-2" />
          </div>

          <div class="field padding-bottom--24">
              <x-input-label for="username" :value="__('Mobile Number')" />
              <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required />
              <x-input-error :messages="$errors->get('username')" class="mt-2" />
          </div>

          <div class="field padding-bottom--24">
              <x-input-label for="address" :value="__('Address')" />
              <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required autocomplete="address" />
              <x-input-error :messages="$errors->get('address')" class="mt-2" />
          </div>

          <div class="field padding-bottom--24">
              <x-input-label for="password" :value="__('Password')" />
              <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
              <x-input-error :messages="$errors->get('password')" class="mt-2" />
          </div>

          <div class="field padding-bottom--24">
              <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
              <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
              <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
          </div>

          
          <div class="field field-checkbox padding-bottom--24 flex-flex align-center">
              <div class="reset-pass">
                <a href="{{ route('password.request') }}">Forgot your password?</a>
              </div>
          </div>

          <div class="field padding-bottom--24">
            <input type="submit" name="submit" value="{{ __('Register') }}">
          </div>

          <div class="field">
            <a class="ssolink" href="{{ route('login') }}">← Login as Admin</a>
          </div>

        </form>
          <!-- For Footer Information Links -->
          @include('includes/footer_links')
      </div>
    </div>

    
    
  </div>

</x-guest-layout>
