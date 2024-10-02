<x-app-layout>

<div style="margin-top: 50px;" ></div>

<div class="row padding-15px" style="background: #fff;margin: 0 20px;">
    <div class="row padding-30px">

    <!-- Error Section Start Here 'message-block' -->
    @include('includes/message-block')
    <!-- Error Section Ends Here -->

        <div class="modal-footer" style="padding-top: 0;">

            <a href="{{ route('fco.change.work.centre',$list_id) }}" data-bs-dismiss="modal">
                <div class="button-otp" style="background: transparent;border: 1px solid #000;color: #5A5A5A;">
                    Work Center
                </div>
            </a>
            
        </div>

      <form class="forms-sample" action="{{ route('fco.complaint.update') }}" id="nodalComplainUpdate" method="post">

        @csrf
        <input type="hidden" value="{{$list_id}}" name="id">

        <div id="rowContainer" class="row padding-30px">

          <div class="col-lg-12">
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Complaint Status</label>
                <div class="input-container1">
                  <select name="complaint_status" class="form-control" id="exampleFormControlSelect1" >
                    <option SELECTED DISABLED >Please Select</option>
                    @foreach ( $complainStatus as $index => $status )
                      <option {{ $complain->complaint_status_id == $status->id ? 'selected' : '' }} value="{{ $status->id }}">{{$status->name}}</option>
                    @endforeach
                  </select>
              </div>
            </div>
          </div>

          <div style="margin-top: 50px;" ></div>
          
          <div class="row dub-row">
            <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputUsername1">
                    <p style="color: #08AF73;">Private <span style="color: #AB3336;">(*Visible to only the users associated with the office of FCO)</span></p>
                  </label>
                  <textarea class="form-control" id="exampleInputUsername1" name="private" cols="30" rows="2">{{ isset($detailedStatus->private) ? $detailedStatus->private : null }}</textarea>
                </div>
            </div>
            <!-- <div class="col-lg-12" style="padding: 15px 0;">
              <p style="color: #08AF73;">Contact Information <span style="color: #AB3336;">(*Update Your Phone Number & Email Address)</span></p>
            </div> -->
            <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputUsername1">
                    <p style="color: #08AF73;">Public  <span style="color: #AB3336;">(*Visible to all users)</span></p>
                  </label>
                  <textarea class="form-control" id="exampleInputUsername1" name="public" cols="30" rows="2">{{ isset($detailedStatus->public) ? $detailedStatus->public : null }}</textarea>
                </div>
            </div>
            <div style="margin-top: 10px;" ></div>
          </div>

        </div>

        <div class="modal-footer justify-content-center" style="padding-top: 0;">
            <a href="{{ route('fco.complaints') }}" data-bs-dismiss="modal">
                <div class="button-otp" style="background: transparent;border: 1px solid #000;color: #5A5A5A;">
                    Cancel
                </div>
            </a>
            <a href="javascript:void(0);" onclick="document.getElementById('nodalComplainUpdate').submit();" > <div class="button-otp"> Submit </div> </a>
        </div>

      </form>

      <div style="margin-top: 50px;" ></div>
      
      @include('nodal.includes.preliminary_reports')
      @include('nodal/includes/complain_detail')

    </div>
</div>


</x-app-layout>