<form method="post" action="{{ route('user.manage.revoke.access') }}" class="mt-6 space-y-6">
        @csrf
            @method('post')

    <div class="row padding-30px">

        <div class="col-lg-12" style="padding: 15px 0;">
            <p style="color: #08AF73;">Select Nodal Officer <span style="color: #AB3336;">(Mandatory Fields)</span></p>
        </div>
        

        <div class="col-lg-4" style="padding: 0;">
            <div class="mb-3">
                
                <select class="form-control @error('username') is-invalid @enderror" name="username" id="">
                    <option disabled selected >Select Nodal Officer</option>
                    @foreach($coll['nodals'] as $nodal)
                        <option value="{{ $nodal->username }}" @if($nodal->status != "active") disabled @endif {{ old('nodal_officer') == $nodal->username ? 'selected' : '' }}>
                            <b>{{ $nodal->name }} </b>
                        </option>
                    @endforeach
                </select>
                @error('username')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>


        <div class="col-lg-3">
            <div class="mb-3">
                
                <div class="modal-footer justify-content-center" style="padding-top: 0;">
                    <button type="submit" class="button-otp"> Select </button>
                </div>
            </div>
        </div>
    </div>

</form>

        
<!-- 

    <div class="modal-footer justify-content-center" style="padding-top: 0;">
        <button type="submit" class="button-otp"> Submit </button>
    </div> -->
