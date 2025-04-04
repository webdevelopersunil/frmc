<!-- Phone Number Section Start-->

<form method="post" action="{{ route('profile.send.otp') }}" id="formSubmitProfileUpdate" class="mt-6 space-y-6">
    @csrf
    @method('post')

    <div class="row padding-30px">

        <div class="col-lg-12" style="padding: 15px 0;">
            <p style="color: #08AF73;">Contact Information <span style="color: #AB3336;">(*Update Your Phone Number & Email Address)</span></p>
        </div>

        <div class="col-lg-5" style="padding: 0;">
            <div class="mb-3">
                <label for="exampleFormControlInput9" class="form-label">Phone Number</label>
                <div class="input-container input-container1">
                    <input type="number" class="form-control" id="exampleFormControlInput9" name="username" placeholder="{{old('username', $user->username)}}" disabled readable>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="mb-3">
                <label for="exampleFormControlInput2" class="form-label">New Phone Number</label>
                    <input type="number" name="new_username" class="form-control" id="exampleFormControlInput2" placeholder="1234567890" value="{{ old('new_username', isset($new_username) ? $new_username : '') }}">
                <x-input-error class="mt-2" :messages="$errors->get('new_username')" />
            </div>
        </div>

        <div class="col-lg-2">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label" style="visibility: hidden;">Emailid</label>
                <input type="submit" name="Send Otp" value="Send OTP" class="button-otp" >
                <!-- <a href="javascript:void(0);" onclick="document.getElementById('phoneNumberOtp').submit();">
                    <div class="button-otp">Send OTP</div>
                </a> -->
            </div>
        </div>


        @if( isset($new_username) && $new_username != "" && $source == "phone")
            <div class="col-lg-5" style="padding: 0;">
                <div class="mb-3">
                    <label for="otpVerificationPhone" class="form-label">OTP <span style="color: #AB3336;">(*Please enter the OTP for your phone number )</span> </label>
                    <div class="input-container input-container4">
                        <input type="number" class="form-control" id="otpVerificationPhone" name="username_otp" required placeholder="0123456" >
                        <input type="hidden" name="username_otp_verification" value="true" >
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="mb-3">
                    <label for="exampleFormControlInput3" class="form-label" style="visibility: hidden;">Emailid </label>
                    <input type="submit" name="Send Otp" value="Submit OTP" class="button-otp" >
                </div>
            </div>
        @endif

    </div>
</form>








<!-- Email Address Section Start-->
<form method="post" action="{{ route('profile.send.otp') }}" class="mt-6 space-y-6">
    @csrf
    @method('post')

    <div class="row padding-30px">

        <div class="col-lg-5" style="padding: 0;">
            <div class="mb-3">
                <label for="exampleFormControlInput4" class="form-label">Email Address</label>
                <div class="input-container input-container1">
                    <input type="email" class="form-control" id="exampleFormControlInput4" name="email" placeholder="{{old('email', $user->email)}}" disabled readable>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="mb-3">
                <label for="exampleFormControlInput5" class="form-label">New Email Address</label>
                <input type="email" class="form-control" id="exampleFormControlInput5" placeholder="Example@gmail.com" name="new_email" value="{{old('new_email', isset($new_email) ? $new_email : '')}}" >
                <x-input-error class="mt-2" :messages="$errors->get('new_email')" />
            </div>
        </div>

        <div class="col-lg-2">
            <div class="mb-3">
                <label for="exampleFormControlInput3" class="form-label" style="visibility: hidden;">Emailid</label>
                <input type="submit" name="Send Otp" value="Send OTP" class="button-otp" >
                <!-- <a href="javascript:void(0);" onclick="document.getElementById('phoneNumberOtp').submit();">
                    <div class="button-otp">Send OTP</div>
                </a> -->
            </div>
        </div>
        
        @if( isset($new_email) && $new_email != "" && $source == "email")
            <div class="col-lg-5" style="padding: 0;">
                <div class="mb-3">
                    <label for="otpVerification" class="form-label">OTP <span style="color: #AB3336;">(*Please enter the OTP for your Email Address number )</span> </label>
                    <div class="input-container input-container4">
                        <input type="number" class="form-control" id="otpVerification" name="email_otp" required placeholder="0123456" >
                        <input type="hidden" name="email_otp_verification" value="true" >
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="mb-3">
                    <label for="exampleFormControlInput3" class="form-label" style="visibility: hidden;">Emailid </label>
                    <input type="submit" name="Send Otp" value="Submit OTP" class="button-otp" >
                </div>
            </div>
        @endif

    </div>
</form>
<!-- Email Address Section End-->