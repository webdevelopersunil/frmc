<x-guest-layout>
  
  <!-- Session Status -->
  <!-- <x-auth-session-status class="mb-4" :status="session('status')" /> -->

  <div id="welcomepage">
    <div class="container">
      <div class="row" style="height: 100%;">
        <div class="col-lg-6" style="height: 100%;position: relative;padding: 0 !important;">
          <img src="{{ asset('assets/theme/image/boat 1.png')}}" alt="" class="img-fluid welcome-img">
          <img src="{{ asset('assets/theme/image/logo.png') }}" alt="" class="img-fluid logo-img">
        </div>

        <div class="col-lg-6" style="position: relative;">
          <h1 class="heading login"> {{ __('Please confirm your new password.') }}</h1>

          
        <x-auth-session-status class="mb-4" :status="session('status')" />


        <form method="POST" action="{{ route('password.store') }}" id="send_reset_link">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <div class="row welcome-log-in">
              <div class="col-lg-12">


                <div class="mb-3 d-flex" style="gap: 15px;">
                  <P style="margin-bottom: 0.5rem;"></P>
                  <label for="email" class="form-label">Email Address</label>
                </div>
                <div class="mb-3 d-flex" style="gap: 15px;">
                    <!-- <p style="margin-bottom: 0 !important;padding: 7px;background: #fff;border: 1px solid #ccc;border-radius: 10px;"> @ </p> -->
                    <div class="input-container">
                        <x-text-input id="email" class="form-control ph-no" type="email" name="email" :value="old('email', $request->email)" required autofocus disabled />
                        <x-input-error style="color:red;" :messages="$errors->get('email')" class="mt-2" />
                    </div>
                </div>



                <div class="mb-3 d-flex" style="gap: 15px;">
                  <P style="margin-bottom: 0.5rem;"></P>
                  <label for="password" class="form-label">Password</label>
                </div>
                <div class="mb-3 d-flex" style="gap: 15px;">
                    <!-- <p style="margin-bottom: 0 !important;padding: 7px;background: #fff;border: 1px solid #ccc;border-radius: 10px;"> @ </p> -->
                    <div class="input-container">
                        <x-text-input id="password" class="form-control ph-no" type="password" name="password" required autocomplete="new-password" />
                        <x-input-error style="color:red;" :messages="$errors->get('password')" class="mt-2" />
                    </div>
                </div>


                <div class="mb-3 d-flex" style="gap: 15px;">
                  <P style="margin-bottom: 0.5rem;"></P>
                  <label for="password_confirmation" class="form-label">Confirm Password</label>
                </div>
                <div class="mb-3 d-flex" style="gap: 15px;">
                    <!-- <p style="margin-bottom: 0 !important;padding: 7px;background: #fff;border: 1px solid #ccc;border-radius: 10px;"> @ </p> -->
                    <div class="input-container">
                    <x-text-input id="password_confirmation" class="form-control ph-no"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

                    <x-input-error style="color:red;" :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                </div>
              </div>
            </div>

            <div class="log-in-button">
              <a href="Javascript:void(0)" class="btn4" data-bs-toggle="modal" data-bs-target="#exampleModal2" onclick="submitForm()" >{{ __('Reset Password') }}</a>
            </div>

          </form>

          
          <p class="para">Back To ? <a href="{{ route('admin.login') }}" class="register" > Login</a> </p>
          <img src="{{ asset('assets/theme/image/welcome page bottom image.png') }}" alt="" class="img-fluid bottom-img">

          <div class="button" style="margin-bottom: 120px;">
            <a href="{{ route('welcome') }}" class="btn1">Home</a>
          </div>

        </div>

      </div>
    </div>
  </div>

  <script>
    function submitForm() { document.getElementById('send_reset_link').submit(); }
  </script>

</x-guest-layout>