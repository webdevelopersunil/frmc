<x-app-layout>

<div style="margin-top: 50px;" ></div>

<div class="row padding-15px" style="background: #fff;margin: 0 20px;">
    <div class="row padding-30px">

    <!-- Error Section Start Here 'message-block' -->
    @include('includes/message-block')
    <!-- Error Section Ends Here -->

      <form class="forms-sample" action="{{ route('fco.complaint.update') }}" id="nodalComplainUpdate" method="post">

        @csrf
        <input type="hidden" value="{{$list_id}}" name="id">

        <div id="rowContainer" class="row padding-30px">

          <div class="col-lg-12">
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Complaint Status</label>
                <div class="input-container1">

                  <select name="complaint_status" class="form-control" id="exampleFormControlSelect1" >
                    <option {{ $complain->complaint_status == "With Nodal Officer" ? 'selected' : '' }} value="With Nodal Officer" >With Nodal Officer</option>
                    <option {{ $complain->complaint_status == "With FCO" ? 'selected' : '' }} value="With FCO" >With FCO</option>
                    <option {{ $complain->complaint_status == "Under FRMC deliberations for Closure/Investigation" ? 'selected' : '' }} value="Under FRMC deliberations for Closure/Investigation" >Under FRMC deliberations for Closure/Investigation</option>
                    <option {{ $complain->complaint_status == "Under Investigation" ? 'selected' : '' }} value="Under Investigation" >Under Investigation</option>
                    <option {{ $complain->complaint_status == "Fraud Not Established after FRMC Deliberation" ? 'selected' : '' }} value="Fraud Not Established after FRMC Deliberation">Fraud Not Established after FRMC Deliberation</option>
                    <option {{ $complain->complaint_status == "Fraud Established after FRMC Deliberation" ? 'selected' : '' }} value="Fraud Established after FRMC Deliberation">Fraud Established after FRMC Deliberation</option>
                    <option {{ $complain->complaint_status == "Fraud Established after FRMC Deliberationas" ? 'selected' : '' }} value="Fraud Established after FRMC Deliberationas">Fraud Established after FRMC Deliberationas</option>
                    <option {{ $complain->complaint_status == "Withdrawn – to be ignored" ? 'selected' : '' }} value="Withdrawn – to be ignored">Withdrawn – to be ignored</option>
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