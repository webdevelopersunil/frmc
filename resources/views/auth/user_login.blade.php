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
          <h1 class="heading login">Welcome</h1>






          <form method="POST" action="{{ route('send-otp') }}" id="login">
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
                    <x-text-input class="form-control ph-no" id="exampleFormControlInput1" type="number" name="username" :value="old('username') ? old('username') : session('phone')" placeholder="9744448548252" required autofocus />
                  </div>
                </div>
                
                <x-input-error :messages="$errors->get('username')" style="color:red;" class="mt-2 x-input-error"  />

              </div>
            </div>

            <div class="log-in-button">
              <a href="Javascript:void(0)" class="btn4" data-bs-toggle="modal" data-bs-target="#exampleModal2" onclick="submitForm()" >Login</a>
            </div>

          </form>

          
          <p class="para">Mobile Number Not Registered ? <a href="{{ route('register') }}" class="register" > Register now</a> </p>
          <img src="{{ asset('assets/theme/image/welcome page bottom image.png') }}" alt="" class="img-fluid bottom-img">

          <div class="button" style="margin-bottom: 120px;">
            <a href="{{ route('welcome') }}" class="btn1">Home</a>
          </div>

        </div>

      </div>
    </div>
  </div>

  <script>
    function submitForm() { document.getElementById('login').submit(); }
  </script>

</x-guest-layout>