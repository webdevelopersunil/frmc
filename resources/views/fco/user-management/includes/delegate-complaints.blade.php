<form method="post" action="{{ route('user.manage.delegate.complaints') }}" class="mt-6 space-y-6">
    @csrf
    @method('post')

    <div class="row padding-30px">
        <div class="col-lg-12" style="padding: 15px 0;">
        <p style="color: #08AF73;">List of Revoked Nodal Offices <span style="color: #AB3336;">(Mandatory Fields)</span></p>
        </div>

        <div class="col-lg-5" >
            <div class="mb-3">
                <select class="form-control @error('username') is-invalid @enderror" name="username">
                    <option selected disabled>Please Select Nodal Officer</option>
                    @foreach($coll['nodals'] as $nodal)
                        <option value="{{ $nodal['username'] }}" {{ isset($coll['username']) && $nodal['username'] == $coll['username'] ? 'selected' : '' }}>
                            {{ $nodal['name'] }}
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
                <button type="submit" class="btn btn-primary ms-2" style="background-color: #3b914e; border-color: #9fc7a7; border-radius: 7px;" >Retrieve Complaints</button>
            </div>
        </div>
        
</form>






@if( isset($coll['progress']) )


<form method="post" action="{{ route('user.manage.delegate.complaints.to.nodal') }}" class="mt-6 space-y-6">
    @csrf
    @method('post')

    <br>

    <div class="col-lg-12" style="padding: 15px 0;">
        <p style="color: #08AF73;">Select New User to delegates complaints to selected new nodal officers </p>
    </div>

    <div class="row padding-30px">
        
        <div class="col-lg-2" style="padding: 0;">
            <div class="mb-3">
                <label class="form-label">Total Pending</label>
                <input type="number" readonly name="pending" class="form-control @error('name') is-invalid @enderror" value="{{ $coll['progress'] }}">
            </div>
        </div>

        <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Work Centre</label>
                <input type="text" readonly name="work_center" class="form-control" value="{{ $nodal->workCenter->name }}">
                <input type="hidden" name="work_center_id" value="{{$nodal->workCenter->id}}">
                <input type="hidden" name="old_username" value="{{$nodal->username}}">
            </div>
        </div>

        
        <div class="col-lg-4" >
            <label class="form-label">Delegates pending complaints <span style="color: #AB3336;">*</span></label>
            <select class="form-control @error('nodal_officer') is-invalid @enderror" name="nodal_officer" >
                <option selected disabled>Please Select Nodal Officer</option>
                @foreach($coll['a_nodals'] as $nodal)
                    <option value="{{ $nodal['username'] }}">
                        {{ $nodal['name'] }}
                    </option>
                @endforeach
            </select>
            @error('nodal_officer')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror    
        </div>


        <div class="col-lg-2">
            <div class="mb-3">
                <button type="submit" class="button-otp"> Submit </button>
            </div>
        </div>


    </div>

</form>

@endif