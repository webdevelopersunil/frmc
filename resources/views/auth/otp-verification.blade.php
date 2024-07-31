<x-guest-layout>
  
  <div id="welcomepage">
    <div class="container">
      <div class="row" style="height: 100%;">
        <div class="col-lg-6" style="height: 100%;position: relative;padding: 0 !important;">
          <img src="{{ asset('assets/theme/image/boat 1.png')}}" alt="" class="img-fluid welcome-img">
          <img src="{{ asset('assets/theme/image/logo.png') }}" alt="" class="img-fluid logo-img">
        </div>
        <div class="col-lg-6" style="position: relative;">
          <h1 class="heading login">Welcome</h1>

          <!-- Send Otp Form -->
          <form method="POST" action="{{ route('send-otp') }}" id="resendOtp"> @csrf <input type="hidden" name="username" value="{{$phone}}" > </form>

          <form method="POST" action="{{ route('login') }}" id="otp_verification">
            @csrf

            <div class="row welcome-log-in">
              <div class="col-lg-12">

                <div class="mb-3 d-flex" style="gap: 15px;">
                  <P style="margin-bottom: 0.5rem;">IND</P>
                  <label for="exampleFormControlInput1" class="form-label">Phone Number</label>
                </div>

                <div class="mb-3 d-flex" style="gap: 15px;">
                  <p style="margin-bottom: 0 !important;padding: 7px;background: #fff;border: 1px solid #ccc;border-radius: 10px;"> +91 </p>
                  <div class="input-container">
                    <!-- Phone Number Input Disabled Field -->
                    <input class="form-control ph-no" id="exampleFormControlInput1" name="username" type="number" value="{{ old('username', $phone) }}" required disabled>
                  </div>
                </div>

                <x-input-error :messages="$errors->get('username')" style="color:red;" class="mt-2 x-input-error"  />

                <div class="mb-3 d-flex" style="gap: 15px;">
                  <div class="otp mb-3" id="_otp" >
                    <div class="row">
                      <div class="col-lg-12">
                        <p style="color: #FF0000;">OTP Expires in: <span style="color: #00744A;"> 01:51</span></p> 
                      </div>
                      <div class="col-lg-6">
                        <div class="mb-3">
                          <!-- OTP Input Field -->
                          <input type="number" name="otp" max="6" min="6" class="form-control" id="exampleFormControlInput1" placeholder="Enter OTP" >
                          <input type="hidden" name="username" value="{{$phone}}" >
                        </div>
                      </div>

                      <div class="col-lg-4 d-flex" style="gap: 15px;">
                        <div class="mb-3">
                          <!-- Submit Button -->
                          <a href="javascript:void(0)" onclick="otpVerification();" > <div class="button-otp"> Submit OTP </div> </a>
                        </div>

                        <div class="mb-3">
                          <!-- OTP Resend Button -->
                          <a href="javascript:void(0)" onclick="resendOtp();"> <div class="button-otp" style="background: #FFC700;"  >  Resend OTP  </div> </a>
                        </div>
                      </div>

                      <x-input-error :messages="$errors->get('otp')" style="color:red;" class="mt-2 x-input-error"  />

                    </div>
                  </div>
                </div>
                
              </div>
            </div>

            <!-- <div class="log-in-button">
              <a href="Javascript:void(0)" class="btn4" data-bs-toggle="modal" data-bs-target="#exampleModal2" onclick="submitForm()" >Login</a>
            </div> -->

          </form>
          <!-- <p class="para">Mobile Number Not Registered ? <a  class="register" data-bs-toggle="modal" data-bs-target="#exampleModal"> Register now</a> </p> -->
          <!-- <p class="para">Mobile Number Not Registered ? <a href="{{ route('register') }}" class="register" > Register now</a> </p> -->
          <img src="{{ asset('assets/theme/image/welcome page bottom image.png') }}" alt="" class="img-fluid bottom-img">

          <div class="button" style="margin-bottom: 120px;">
            <a href="{{ route('welcome') }}" class="btn1">Home</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    function resendOtp() { document.getElementById('resendOtp').submit(); }
    function otpVerification() { document.getElementById('otp_verification').submit(); }
  </script>

</x-guest-layout>