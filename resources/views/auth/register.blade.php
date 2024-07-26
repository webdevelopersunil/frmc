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

          <form method="POST" action="{{ route('register') }}">
            @csrf

            <h2 class="personal-heading">Personal Information </h2>
            <div class="row" style="background-color: #fff !important;">
              <div class="col-lg-6">
                <div class="mb-3">
                  <x-input-label for="exampleFormControlInput1" class="form-label redStar" :value="__('Name')" />
                  <div class="input-container input-container1">
                    <x-text-input class="form-control" id="exampleFormControlInput1" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Pritam Ghosh" />
                  </div>
                    <x-input-error :messages="$errors->get('name')" class="error-text err_mdy" />
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <x-input-label for="exampleFormControlInput1" class="form-label redStar" :value="__('Email Address')" />
                  <div class="input-container input-container2">
                    <x-text-input class="form-control" id="exampleFormControlInput1" type="email" name="email" :value="old('email')" required autocomplete="email" placeholder="Example@gmail.com" />
                  </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 err_mdy" />
                </div>
              </div>
            </div>



            <h2 class="personal-heading">Contact Information </h2>
            <div class="row" style="background-color: #fff !important;">
              <div class="col-lg-6">
                <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label redStar">Phone Number</label>
                  <div class="input-container">
                    <x-text-input type="number" class="form-control" id="exampleFormControlInput1" name="username" :value="old('username')" placeholder="7776776877" required />
                    <!-- <x-input-error :messages="$errors->get('username')" class="mt-2" /> -->
                    <div id="otpMessage" class="mt-2 "></div>
                  </div>
                </div>
              </div>
              
              <div class="col-lg-6">
                <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label" style="visibility: hidden;">Emailid</label>
                  <a href="#" class="button-otp"> <div class="button-otp"> Send OTP </div> </a>
                </div>
              </div>
            </div>


            <div class="otp mb-3">
              <div class="row">

                <div class="col-lg-6"> <p style="color: #FF0000;">Phone OTP Expires in: <span style="color: #00744A;"> 01:51</span></p> </div>

                <div class="col-lg-6 d-flex justify-content-end">
                  <img src="./image/cross.png" alt="" class="img-fluid" style="width: 18px;height: 18px;">
                </div>

                <div class="col-lg-6">
                  <div class="mb-3"> <x-text-input name="phone_otp" type="number" class="form-control" id="exampleFormControlInput1" placeholder="Enter OTP" required /> </div>
                </div>

                <div class="col-lg-4 d-flex" style="gap: 15px;">
                  <div class="mb-3"> <a href="javascript:void(0)"> <div class="button-otp"> Submit OTP </div> </a> </div>
                  
                  <div class="mb-3"> <a href=""> <div class="button-otp" style="background: #FFC700;"> Resend OTP </div> </a> </div>
                </div>

              </div>
            </div>


            <div class="otp">
              <div class="row">

                <div class="col-lg-6"> <p style="color: #FF0000;">Email OTP Expires in: <span style="color: #00744A;"> 01:51</span></p> </div>

                <div class="col-lg-6 d-flex justify-content-end">
                  <img src="./image/cross.png" alt="" class="img-fluid" style="width: 18px;height: 18px;">
                </div>

                <div class="col-lg-6">
                  <div class="mb-3"> <x-text-input name="email_otp" type="number" class="form-control" id="exampleFormControlInput1" placeholder="Enter OTP" required /> </div>
                </div>

                <div class="col-lg-4 d-flex" style="gap: 15px;">
                  <div class="mb-3"> <div class="button-otp"> <a href="javascript:void(0)">Submit OTP</a> </div> </div>

                  <div class="mb-3"> <div class="button-otp" style="background: #FFC700;"> <a href="javascript:void(0)">Resend OTP</a> </div> </div>
                </div>

              </div>
            </div>

            <!-- <h2 class="personal-heading">Others</h2>
            <div class="row" style="background-color: #fff !important;">
              <div class="col-lg-6">
                <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Date Of Birth</label>
                  <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="24/04/2001">
                </div>
              </div>
              <div class="col-lg-6"></div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Flat,House No, Building,Company</label>
                  <div class="input-container input-container3">
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Mumbai">
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Area , Street, Sector, Village</label>
                  <div class="input-container input-container3">
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Mumbai">
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Landmark</label>
                  <div class="input-container input-container3">
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Mumbai">
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Town/City</label>
                  <div class="input-container input-container3">
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Mumbai">
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">State</label>
                  <div class="input-container input-container3">
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Mumbai">
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Pin Code</label>
                  <div class="input-container1">
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter Pin Code">
                  </div>
                </div>
              </div>
            </div> -->

            <p class="modal-bottom-text">By creating an account , You agree to the <a href="" style="color: #08AF73;">Terms of service</a> & <a href="" style="color: #08AF73;">Privacy Policy</a>.</p>

            <div class="modal-footer justify-content-center" style="padding-top: 0;">
              <!-- <a href=""> <div class="button-otp"> Save </div> </a> -->
              <input type="submit" class="button-otp" name="submit" value="{{ __('Register') }}">

            </div>

          </form>
          
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
$(document).ready(function() {
    $('.button-otp').on('click', function(e) {
        e.preventDefault();
        var username = $('input[name="username"]').val();
        var email = $('input[name="email"]').val();

        $.ajax({
            url: '{{ route("send-phone-otp") }}',
            type: 'POST',
            data: {
                username  : username,
                email     : email,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    $('#otpMessage').html('<span style="color:green;">' + response.message + '</span>');
                } else {
                    $('#otpMessage').html('<span style="color:red;">' + response.message + '</span>');
                }
            },
            error: function(response) {
                $('#otpMessage').html('<span style="color:red;">' + response.responseJSON.message + '</span>');
            }
        });
    });
});
</script>
  
</x-guest-layout>