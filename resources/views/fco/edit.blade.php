<x-app-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="content-wrapper">
          <div class="row">

          <div class="card-body">
            <!-- <h4 class="card-title">Complaint Detail</h4> -->
            <div class="d-flex justify-content-end mb-3">
                <a class="btn btn-primary add-btn" href="{{ route('fco.complaints') }}"> Go Back</a>
            </div>
          </div>

            @include('includes/complain_detail')
            @include('includes/nodal_complain_detail')

            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Updation by the office of FCO</h4>

                  <div class="d-flex justify-content-end mb-3">
                      <a class="btn add-btn" style="color:white; border:none;" href="{{ route('fco.change.work.centre',$list_id) }}">Change Work Centre</a>
                  </div>
                  
                  <br>

                  <!-- Error Section Start Here 'message-block' -->
                    @include('includes/message-block')
                  <!-- Error Section Ends Here -->
                  
                  <form class="forms-sample" action="{{ route('fco.complaint.update') }}" method="post">

                      @csrf
                    <input type="hidden" value="{{$list_id}}" name="id">
                  
                    <!-- <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                              <label for="exampleInputUsername1">Nodel Officer</label>
                              <select class="form-control form-control-lg" id="exampleFormControlSelect1" name="nodal_officer">
                                <option value="Nodal Officer" selected >Nodal Officer</option>
                              </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                              <label for="exampleInputUsername1">Work Centre</label>
                              <select class="form-control form-control-lg" name="work_centre" id="exampleFormControlSelect1" required>
                                <option selected disabled >Please Select</option>  
                                <option value="Delhi" {{ $complain->work_centre == "Delhi" ? 'selected' : '' }}>Delhi</option>
                                <option value="Dehradun" {{ $complain->work_centre == "Dehradun" ? 'selected' : '' }} >Dehradun</option>
                                <option value="Mumbai"{{ $complain->work_centre == "Mumbai" ? 'selected' : '' }} >Mumbai</option>
                                <option value="Ahmedabad" {{ $complain->work_centre == "Ahmedabad" ? 'selected' : '' }} >Ahmedabad</option>
                              </select>
                          </div>
                        </div>
                    </div> -->

                    <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                              <label for="exampleInputUsername1">Complaint Status</label>
                              <select name="complaint_status" class="form-control form-control-lg" id="exampleFormControlSelect1" >
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

                    <br> <br>
                    <h5 class="card-title">Updation by the office of FCO</h5>
                    <br><br>
                    <div id="rowContainer">
                      <div class="row dub-row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="exampleInputUsername1">Public – Visible to all users</label>
                                  <textarea class="form-control" id="exampleInputUsername1" name="public" cols="30" rows="4">{{ isset($detailedStatus->public) ? $detailedStatus->public : null }}</textarea>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="exampleInputUsername1">Private – Visible to only the users associated with the office of FCO</label>
                                  <textarea class="form-control" id="exampleInputUsername1" name="private" cols="30" rows="4">{{ isset($detailedStatus->private) ? $detailedStatus->private : null }}</textarea>
                              </div>
                          </div>
                        </div>
                    </div>  

                    <button type="submit" style="color:white; border:none;" class="btn add-btn mr-2">Submit</button>
                    <a href="{{ route('fco.complaints') }}" class="btn btn-light">Cancel</a>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
</x-app-layout>