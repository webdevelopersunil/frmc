<x-app-layout>

<div style="margin-top: 50px;" ></div>

<div class="row padding-15px" style="background: #fff;margin: 0 20px;">
    <div class="row padding-30px">

    <!-- Error Section Start Here 'message-block' -->
    @include('includes/message-block')
    <!-- Error Section Ends Here -->

      <form class="forms-sample" action="{{ route('fco.complaint.work-centre.update') }}" id="nodalComplainUpdate" method="post">

        @csrf
        <input type="hidden" value="{{$complain->id}}" name="id">
        <div id="rowContainer" class="row padding-30px">

          <div class="col-lg-12">
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Work Center's</label>
                <div class="input-container1">
                  <select name="work_center_id" class="form-control" id="exampleFormControlSelect1" >
                    <option SELECTED DISABLED >Please Select</option>
                    @foreach ( $work_centers as $index => $center )
                      <option {{ $complain->workCenter->id == $center->id ? 'selected' : '' }} value="{{ $center->id }}">{{$center->name}}</option>
                    @endforeach
                  </select>
              </div>
            </div>
          </div>

          <div style="margin-top: 50px;" ></div>
       
        </div>

        <div class="modal-footer justify-content-center" style="padding-top: 0;">

            <a href="{{ route('fco.complaint.view',$complain->id) }}" data-bs-dismiss="modal">
                <div class="button-otp" style="background: transparent;border: 1px solid #000;color: #5A5A5A;">
                    Cancel
                </div>
            </a>
            <a href="javascript:void(0);" onclick="document.getElementById('nodalComplainUpdate').submit();" > <div class="button-otp"> Submit </div> </a>
        </div>

      </form>

    </div>
</div>


</x-app-layout>