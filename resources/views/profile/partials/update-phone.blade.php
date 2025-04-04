<div class="row padding-30px">
    <div class="col-lg-12" style="padding: 15px 0;">
        <p style="color: #08AF73;">Personal Information <span style="color: #AB3336;">(*Update Your Account Profile Information & Email Address)</span></p>
    </div>
    <div class="col-lg-5" style="padding: 0;">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Name</label>
            <div class="input-container input-container1">
                <input type="text" class="form-control" id="exampleFormControlInput1" value="{{old('name', $user->name)}}" placeholder="Pritam Ghosh">
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Date of birth</label>
            <div class="input-container input-container2">
                <input type="date" class="form-control" id="exampleFormControlInput1" value="{{old('dob', $user->dob)}}">
            </div>
        </div>
    </div>
    <div class="col-lg-2">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label" style="visibility: hidden;">Emailid</label>
            <a href="">
                <div class="button-otp">
                    Send OTP
                </div>
            </a>
        </div>
    </div>

    <div class="col-lg-12" style="padding: 15px 0;">
        <p style="color: #08AF73;">Contact Information <span style="color: #AB3336;">(*Update Your Phone Number)</span></p>
    </div>

    <div class="col-lg-5" style="padding: 0;">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Current Phone Number</label>
            <div class="input-container">
                <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="7776776877">
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">New Phone Number</label>
            <div class="input-container">
                <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="">
            </div>
        </div>
    </div>

    <div class="col-lg-2">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label" style="visibility: hidden;">Emailid</label>
            <a href="">
                <div class="button-otp">
                    Send OTP
                </div>
            </a>
        </div>
    </div>

    <div class="col-lg-12" style="padding: 15px 0;">
        <p style="color: #08AF73;">Others</p>
    </div>

    <div class="col-lg-10" style="padding: 0;">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Postal Address</label>
            <div class="input-container input-container3">
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Mumbai">
            </div>
        </div>
    </div>

    <div class="col-lg-2">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label" style="visibility: hidden;">Emailid</label>
            <a href="">
                <div class="button-otp">
                    Send OTP
                </div>
            </a>
        </div>
    </div>
</div>