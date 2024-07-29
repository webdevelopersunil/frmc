<div class="row padding-30px">

    <div class="col-lg-12" style="padding: 15px 0;">
        <p style="color: #08AF73;">Personal Information <span style="color: #AB3336;">(*Update Your Account Profile Information & Email Address)</span></p>
    </div>

    <div class="col-lg-6" style="padding: 0;">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Name</label>
            <div class="input-container input-container1">
                <input type="text" class="form-control" id="exampleFormControlInput1" value="{{old('name', $user->name)}}" placeholder="Pritam Ghosh">
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Date of Birth</label>
            <!-- <div class="input-container input-container2"> -->
                <input type="date" class="form-control" id="exampleFormControlInput1" value="{{old('dob', $user->dob)}}">
            <!-- </div> -->
        </div>
    </div>



    <div class="col-lg-12" style="padding: 15px 0;">
        <p style="color: #08AF73;">Contact Information <span style="color: #AB3336;">(*Update Your Phone Number & Email Address)</span></p>
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
    <!-- Email Address -->
    <div class="col-lg-5" style="padding: 0;">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Emailid</label>
            <div class="input-container input-container2">
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Example@gmail.com">
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Emailid</label>
            <div class="input-container input-container2">
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Example@gmail.com">
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

    <div class="col-lg-4" style="padding: 0;">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">House Number</label>
            <!-- <div class="input-container input-container1"> -->
                <input type="text" name="house_number" class="form-control" id="exampleFormControlInput1" value="{{old('house_number', $user->house_number)}}" placeholder="HN:12 WN:34">
            <!-- </div> -->
        </div>
    </div>
    <div class="col-lg-4">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Area</label>
            <!-- <div class="input-container input-container2"> -->
                <input type="text" class="form-control" id="exampleFormControlInput1" value="{{old('area', $user->area)}}">
            <!-- </div> -->
        </div>
    </div>
    <div class="col-lg-4" style="padding: 0;">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Landmark</label>
            <!-- <div class="input-container input-container1"> -->
                <input type="text" name="landmark" class="form-control" id="exampleFormControlInput1" value="{{old('landmark', $user->landmark)}}" placeholder="landmark">
            <!-- </div> -->
        </div>
    </div>




    <div class="col-lg-4" style="padding: 0;">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">City</label>
            <!-- <div class="input-container input-container1"> -->
                <input type="text" name="city" class="form-control" id="exampleFormControlInput1" value="{{old('city', $user->city)}}" placeholder="HN:12 WN:34">
            <!-- </div> -->
        </div>
    </div>
    <div class="col-lg-4">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">State</label>
            <!-- <div class="input-container input-container2"> -->
                <input type="text" class="form-control" name="state" id="exampleFormControlInput1" value="{{old('state', $user->state)}}">
            <!-- </div> -->
        </div>
    </div>
    <div class="col-lg-4" style="padding: 0;">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Pincode</label>
            <!-- <div class="input-container input-container1"> -->
                <input type="text" name="pincode" class="form-control" id="exampleFormControlInput1" value="{{old('pincode', $user->pincode)}}" placeholder="landmark">
            <!-- </div> -->
        </div>
    </div>




    <div class="col-lg-12">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Address</label>
            <!-- <div class="input-container input-container2"> -->
                <textarea type="text" class="form-control" id="exampleFormControlInput1"  name="address" >{{old('address', $user->address)}}</textarea>
            <!-- </div> -->
        </div>
    </div>




    
    
    
</div>