<x-guest-layout>
  
  <!-- Session Status -->
  <x-auth-session-status class="mb-4" :status="session('status')" />

  <div id="welcomepage">
    <div class="container">
      <div class="row" style="height: 100%;">

        <div class="col-lg-5" style="height: 100%;position: relative;padding: 0 !important;">
          <img src="{{ asset('assets/theme/image/boat 1.png')}}" alt="" class="img-fluid welcome-img">
          <img src="{{ asset('assets/theme/image/logo.png') }}" alt="" class="img-fluid logo-img">
        </div>

        <div class="col-lg-7" style="position: relative;">
          <h1 class="heading login">Welcome</h1>

            <h2 class="personal-heading">Contact Information </h2>
            <div class="row" style="background-color: #fff !important;">
              <div class="col-lg-6">
                <div class="mb-3">
                  <x-input-label for="exampleFormControlInput1" class="form-label redStar" :value="__('Phone Number')" />
                  <div class="input-container">
                  <x-text-input type="number" class="form-control" id="exampleFormControlInput1" name="username" disabled :value="old('username', $username)" />
                    <x-input-error :messages="$errors->get('username')" style="color:red;" class="mt-2 err_mdy" />
                    
                  </div>
                </div>
              </div>

              <div class="col-lg-6">
                <div class="mb-3">
                  <x-input-label for="exampleFormControlInput1" class="form-label redStar" :value="__('Email Address')" />
                  <div class="input-container input-container2">
                  <input class="form-control" id="exampleFormControlInput1" type="email" name="email" value="{{ old('email', $email) }}" autocomplete="email" disabled />
                  </div>
                </div>
              </div>
            </div>

            
            










            <input type="hidden" value="{{$username}}" name="username">
<input type="hidden" value="{{$email}}" name="email">
<input type="hidden" value="phone" name="otp">

@if($phone_verified != 1)
<div class="otp mb-3" id="phone_otp_Section" >
    <div class="row">
        <div class="col-lg-6">
            <p style="color: #FF0000;">Phone OTP Expires in: <span style="color: #00744A;">01:51</span></p>
        </div>
        <div class="col-lg-6 d-flex justify-content-end">
            <img src="./image/cross.png" alt="" class="img-fluid" style="width: 18px;height: 18px;">
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <x-text-input name="phone_otp" type="number" required class="form-control" id="exampleFormControlInput1" placeholder="Enter OTP" />
            </div>
        </div>
        <div class="col-lg-4 d-flex" style="gap: 15px;">
            <div class="mb-3">
                <a href="javascript:void(0)" id="submit-phone-otp" onclick="submitPhoneOtp();">
                    <div class="button-otp">Submit OTP</div>
                </a>
            </div>
            <div class="mb-3">
                <a href="">
                    <div class="button-otp" style="background: #FFC700;">Resend OTP</div>
                </a>
            </div>
        </div>
        <div class="col-lg-12">
            <div id="otp-message"></div>
        </div>
    </div>
</div>
@endif

@if($email_verified != 1)
<div class="otp mb-3" id="email_otp_Section" >
    <div class="row">
        <div class="col-lg-6">
            <p style="color: #FF0000;">Email OTP Expires in: <span style="color: #00744A;">01:51</span></p>
        </div>
        <div class="col-lg-6 d-flex justify-content-end">
            <img src="./image/cross.png" alt="" class="img-fluid" style="width: 18px;height: 18px;">
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <x-text-input name="email_otp" required type="number" class="form-control" id="exampleFormControlInput1" placeholder="Enter OTP" />
            </div>
        </div>
        <div class="col-lg-4 d-flex" style="gap: 15px;">
            <div class="mb-3">
                <a href="javascript:void(0)" id="submit-email-otp" onclick="submitEmailOtp();">
                    <div class="button-otp">Submit OTP</div>
                </a>
            </div>
            <div class="mb-3">
                <a href="javascript:void(0)">
                    <div class="button-otp" style="background: #FFC700;">Resend OTP</div>
                </a>
            </div>    
        </div>
        <div class="col-lg-12">
          <div id="email-message"></div>
        </div>
    </div>
</div>
@endif















            <p class="modal-bottom-text">By creating an account , You agree to the <a href="" style="color: #08AF73;">Terms of service</a> & <a href="" style="color: #08AF73;">Privacy Policy</a>.</p>

            <div class="modal-footer justify-content-center" style="padding-top: 0;">
              <!-- <a href=""> <div class="button-otp"> Save </div> </a> -->
              <!-- <input type="submit" class="button-otp" name="submit" value="{{ __('Register') }}"> -->

            </div>

          
          <!-- <p class="para">Mobile Number Not Registered ? <a  class="register" data-bs-toggle="modal" data-bs-target="#exampleModal"> Register now</a> </p> -->
          <p class="para">Mobile Number Already Registered ? <a href="{{ route('login') }}" class="register" > Login now</a> </p>
          <img src="{{ asset('assets/theme/image/welcome page bottom image.png') }}" alt="" class="img-fluid bottom-img">

          <div class="button" style="margin-bottom: 120px;">
            <a href="{{ route('welcome') }}" class="btn1">Home</a>
          </div>

        </div>
        

      </div>
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
      function submitPhoneOtp() {
        var phoneOtp = document.querySelector('input[name="phone_otp"]').value;
        var emailOtp = document.querySelector('input[name="email_otp"]').value;
        var username = document.querySelector('input[name="username"]').value;
        var email = document.querySelector('input[name="email"]').value;

        $.ajax({
            url: '{{ route('verified.otp') }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                phone_otp: phoneOtp,
                otp: "phone",
                username: username,
                email: email
            },
            success: function(response) {

                let messageDiv = document.getElementById('otp-message');
                if (response.phone_verified) {
                    messageDiv.innerHTML = '<p style="color: green;">' + response.message + '</p>';
                    document.querySelector('input[name="phone_otp"]').disabled = true;
                    document.querySelector('#submit-phone-otp').style.display = 'none';

                    setTimeout(function() {
                        document.querySelector('#phone_otp_Section').style.display = 'none';
                    }, 2000);
                    
                } else {
                    messageDiv.innerHTML = '<p style="color: red;">' + response.message + '</p>';
                }
                if (response.phone_verified == 1 && response.email_verified == 1) {
                  window.location.href = '{{route('login')}}';
                }
            },
            error: function(xhr) {
                let messageDiv = document.getElementById('otp-message');
                let errorMessage = 'An error occurred. Please try again.';
                if (xhr.responseJSON && xhr.responseJSON.error) {
                    errorMessage = xhr.responseJSON.error;
                }
                messageDiv.innerHTML = '<p style="color: red;">' + errorMessage + '</p>';
            }
        });

      }

      function submitEmailOtp() {

        var emailOtp = document.querySelector('input[name="email_otp"]').value;
        var username = document.querySelector('input[name="username"]').value;
        var email = document.querySelector('input[name="email"]').value;

        $.ajax({
            url: '{{ route('verified.otp') }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                email_otp : emailOtp,
                username  : username,
                otp       : "email",
                email     : email
            },
            success: function(response) {

              let messageDiv = document.getElementById('email-message');

                if (response.phone_verified) {
                    messageDiv.innerHTML = '<p style="color: green;">' + response.message + '</p>';
                    document.querySelector('input[name="email_otp"]').disabled = true;
                    document.querySelector('#submit-phone-otp').style.display = 'none';

                    setTimeout(function() {
                        document.querySelector('#email_otp_Section').style.display = 'none';
                    }, 2000);
                } else {
                    messageDiv.innerHTML = '<p style="color: green;">' + response.message + '</p>';
                }
                
                if (response.phone_verified == 1 && response.email_verified == 1) {
                    window.location.href = '{{route('login')}}';
                }
            },
            error: function(xhr) {
                let messageDiv = document.getElementById('email-message');
                let errorMessage = 'An error occurred. Please try again.';
                if (xhr.responseJSON && xhr.responseJSON.error) {
                    errorMessage = xhr.responseJSON.error;
                }
                messageDiv.innerHTML = '<p style="color: red;">' + errorMessage + '</p>';
            }
        });
      }

    </script>
</x-guest-layout>