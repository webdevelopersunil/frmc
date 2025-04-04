
<form method="post" action="{{ route('profile.update') }}" id="formSubmitProfileUpdate" class="mt-6 space-y-6">
    @csrf
    @method('patch')

    <div class="row padding-30px">
        <div class="col-lg-12" style="padding: 15px 0;">
            <p style="color: #08AF73;">Personal Information <span style="color: #AB3336;">(*Update Your Account Profile Information & Email Address)</span></p>
        </div>

        <div class="col-lg-6" style="padding: 0;">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Name</label>
                <div class="input-container input-container1">
                    <input type="text"  name="name" class="form-control" id="exampleFormControlInput1" value="{{old('name', $user->name)}}">
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Date of Birth</label>
                <!-- <div class="input-container input-container2"> -->
                    <input type="date" class="form-control" name="dob" id="exampleFormControlInput1" value="{{old('dob', $user->dob)}}">
                <!-- </div> -->
                <x-input-error class="mt-2" :messages="$errors->get('dob')" />
            </div>
        </div>






        <div class="col-lg-12" style="padding: 15px 0;">
            <p style="color: #08AF73;">Contact Information <span style="color: #AB3336;">(*Phone Number & Email Address)</span></p>
        </div>
        <div class="col-lg-6" style="padding: 0;">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Phone Number</label>
                <div class="input-container input-container1">
                    <input type="number" class="form-control" id="exampleFormControlInput1" value="{{old('name', $user->username)}}" disabled readonly>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="exampleFormControlInput5" class="form-label">Email Address</label>
                <div class="input-container input-container2">
                    <input type="email" class="form-control" id="exampleFormControlInput5" value="{{old('email', $user->email)}}" disabled readonly>
                </div>
            </div>
        </div>





        
        <div class="col-lg-12" style="padding: 15px 0;">
            <p style="color: #08AF73;">Others</p>
        </div>

        <div class="col-lg-12">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Address</label>
                <!-- <div class="input-container input-container2"> -->
                    <textarea type="text" class="form-control" id="exampleFormControlInput1"  name="address" >{{old('address', $user->address)}}</textarea>
                <!-- </div> -->
                <x-input-error class="mt-2" :messages="$errors->get('address')" />
            </div>
        </div>



        <div class="col-lg-4" style="padding: 0;">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">House Number</label>
                <!-- <div class="input-container input-container1"> -->
                    <input type="text" name="house_number" class="form-control" id="exampleFormControlInput1" value="{{old('house_number', $user->house_number)}}" placeholder="HN:12 WN:34">
                <!-- </div> -->
                <x-input-error class="mt-2" :messages="$errors->get('house_number')" />
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Area</label>
                <!-- <div class="input-container input-container2"> -->
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="area" value="{{old('area', $user->area)}}" placeholder="New Delhi" >
                <!-- </div> -->
                <x-input-error class="mt-2" :messages="$errors->get('area')" />
            </div>
        </div>
        <div class="col-lg-4" style="padding: 0;">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Landmark</label>
                <!-- <div class="input-container input-container1"> -->
                    <input type="text" name="landmark" class="form-control" id="exampleFormControlInput1" value="{{old('landmark', $user->landmark)}}" placeholder="landmark">
                <!-- </div> -->
                <x-input-error class="mt-2" :messages="$errors->get('landmark')" />
            </div>
        </div>





        <div class="col-lg-4" style="padding: 0;">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">City</label>
                <!-- <div class="input-container input-container1"> -->
                    <input type="text" name="city" class="form-control" id="exampleFormControlInput1" value="{{old('city', $user->city)}}" placeholder="New Delhi" >
                <!-- </div> -->
                <x-input-error class="mt-2" :messages="$errors->get('city')" />
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">State</label>
                <!-- <div class="input-container input-container2"> -->
                    <input type="text" class="form-control" name="state" id="exampleFormControlInput1" value="{{old('state', $user->state)}}" placeholder="New Delhi" >
                <!-- </div> -->
                <x-input-error class="mt-2" :messages="$errors->get('state')" />
            </div>
        </div>
        <div class="col-lg-4" style="padding: 0;">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Pincode</label>
                <!-- <div class="input-container input-container1"> -->
                    <input type="text" name="pincode" class="form-control" id="exampleFormControlInput1" value="{{old('pincode', $user->pincode)}}" placeholder="123456">
                <!-- </div> -->
                <x-input-error class="mt-2" :messages="$errors->get('pincode')" />
            </div>
        </div>

    </div>

</form>