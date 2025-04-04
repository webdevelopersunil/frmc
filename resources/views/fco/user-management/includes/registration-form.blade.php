<form method="post" action="{{ route('user.manage.registration.form') }}" class="mt-6 space-y-6">
    @csrf
    @method('post')

    <div class="row padding-30px">
        <div class="col-lg-12" style="padding: 15px 0;">
            <p style="color: #08AF73;">Personal Details <span style="color: #AB3336;">(Mandatory Fields)</span></p>
        </div>






        <div class="col-lg-3" style="padding: 0;">
            <div class="mb-3">
                <label class="form-label">Name <span style="color: #AB3336;">*</span> </label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                @error('name')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-lg-3">
            <div class="mb-3">
                <label class="form-label">Date of Birth <span style="color: #AB3336;">*</span> </label>
                <input type="date" class="form-control @error('dob') is-invalid @enderror" name="dob" value="{{ old('dob') }}">
                @error('dob')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>



        <div class="col-lg-3" style="padding: 0;">
            <div class="mb-3">
                <label class="form-label">Username <span style="color: #AB3336;">*</span> </label>
                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}">
                @error('username')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-lg-3">
            <div class="mb-3">
                <label class="form-label">User Role <span style="color: #AB3336;">*</span> </label>
                <select class="form-control @error('role') is-invalid @enderror" name="role">
                    <option disabled selected>Select Role</option>
                    <option value="nodal" {{ old('role') == 'nodal' ? 'selected' : '' }}>Nodal</option>
                    <option value="frmc_user" {{ old('role') == 'frmc_user User' ? 'selected' : '' }}>FRMC User</option>
                </select>
                @error('role')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>



        <!-- <div class="col-lg-12" style="padding: 15px 0;">
            <p style="color: #08AF73;">Contact Information <span style="color: #AB3336;">(Mandatory Fields)</span></p>
        </div> -->

        <div class="col-lg-3" style="padding: 0;">
            <div class="mb-3">
                <label class="form-label">Phone Number <span style="color: #AB3336;">*</span> </label>
                <input type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}">
                @error('phone')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-lg-3">
            <div class="mb-3">
                <label class="form-label">Email Address <span style="color: #AB3336;">*</span> </label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                @error('email')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>




        <div class="col-lg-3" style="padding: 0;">
        <div class="mb-3">
                <label class="form-label">Password <span style="color: #AB3336;">*</span></label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                
                @error('password')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-lg-3">
        <div class="mb-3">
                <label class="form-label">Confirm Password <span style="color: #AB3336;">*</span></label>
                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation">
                
                @error('password_confirmation')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>



        <div class="col-lg-12" style="padding: 15px 0;">
            <p style="color: #08AF73;">Others Details <span style="color: #AB3336;">(Non-Mandatory Fields)</span></p>
        </div>

        <div class="col-lg-12" style="padding: 0;">
            <div class="mb-3">
                <label class="form-label">Address</label>
                <textarea class="form-control @error('address') is-invalid @enderror" name="address">{{ old('address') }}</textarea>
                @error('address')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-lg-4" style="padding: 0;">
            <div class="mb-3">
                <label class="form-label">House Number</label>
                <input type="text" name="house_number" class="form-control @error('house_number') is-invalid @enderror" value="{{ old('house_number') }}">
                @error('house_number')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Area</label>
                <input type="text" class="form-control @error('area') is-invalid @enderror" name="area" value="{{ old('area') }}">
                @error('area')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-lg-4" style="padding: 0;">
            <div class="mb-3">
                <label class="form-label">Landmark</label>
                <input type="text" name="landmark" class="form-control @error('landmark') is-invalid @enderror" value="{{ old('landmark') }}">
                @error('landmark')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-lg-4" style="padding: 0;">
            <div class="mb-3">
                <label class="form-label">City</label>
                <input type="text" name="city" class="form-control @error('city') is-invalid @enderror" value="{{ old('city') }}">
                @error('city')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">State</label>
                <input type="text" class="form-control @error('state') is-invalid @enderror" name="state" value="{{ old('state') }}">
                @error('state')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-lg-4" style="padding: 0;">
            <div class="mb-3">
                <label class="form-label">Pincode</label>
                <input type="number" name="pincode" class="form-control @error('pincode') is-invalid @enderror" value="{{ old('pincode') }}">
                @error('pincode')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="modal-footer justify-content-center" style="padding-top: 0;">
        <button type="submit" class="button-otp"> Submit </button>
    </div>
</form>
