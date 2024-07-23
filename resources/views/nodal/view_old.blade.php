<x-app-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

      
      <div class="content-wrapper">
        <div class="row">
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Complaint Detail</h4>
                <!-- <p class="card-description" onclick="window.location=''" > otp confirmation </p> -->

                <div class="d-flex justify-content-end mb-3">
                    <a class="btn btn-primary add-btn" href="{{ route('nodal.complaints') }}"> Go Back</a>
                </div>
                
                <br>


                <div class="col-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="card-body">
                          <h4 class="card-title"> Complaint Number </h4>
                            <p class="card-description">{{ $complain->complain_no }} <button type="button" class="btn btn-link">Copy</button> </p>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="card-body">
                          <h4 class="card-title"> Department/Section </h4>
                          <p class="card-description"> {{ $complain->department_section }} </p>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="card-body">
                          <h4 class="card-title"> ONGC Work Centre </h4>
                          <p class="card-description"> {{ $complain->work_centre }} </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <form class="forms-sample" action="" method="" >
                    
                  <div class="row">
                      <div class="col-md-12">
                          <div class="form-group">
                              <label for="exampleInputUsername1">Complaint No.</label>
                              <input type="text" name="complain_no" class="form-control" readonly="TRUE" value="{{ $complain->complain_no }}" disabled id="exampleInputUsername1">
                          </div>
                      </div>
                    <!-- <div class="col-md-6">
                      <div class="form-group">
                          <label for="exampleInputUsername1">Date of Complaint</label>
                          <input type="date" class="form-control" id="exampleInputUsername1">
                      </div>
                    </div> -->
                  </div>

                  <div class="row">
                      <div class="col-md-12">
                          <div class="form-group">
                              <label for="exampleInputUsername1">Description of Complaint</label>
                              <textarea disabled name="description" class="form-control" id="exampleInputUsername1" cols="30" rows="4">{{$complain->description}}</textarea>
                          </div>
                    </div>
                  </div>

                  <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputUsername1"> Department/Section </label>
                            <input type="text"  name="department_section_other" value="{{ $complain->department_section }}" id="others-show" disabled class="form-control" id="exampleInputUsername1" placeholder="Department/Section" required>
                        </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputUsername1">Against Whom</label>
                            <input type="text" disabled name="against_persons" class="form-control" value="{{$complain->against_persons}}" id="exampleInputUsername1" placeholder="Against Users names" required>
                        </div>
                      </div>
                  </div>

                  <br>
                  <h4>User Additional Details</h4>
                  <br>
                  @if( count($complain->userAdditionalDetails) >= 1 )
                  
                    @foreach($complain->userAdditionalDetails as $index => $detail)
                      <div id="rowContainer">
                        <div class="row dub-row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Document</label>
                                    <a href="{{ route('preview.file',$detail->file->id) }}" target="_blank" class="text-color d-block text-truncate"> 
                                    <span> #{{$index+1}}</span>  View Document
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Document Description</label>
                                    <textarea disabled name="" class="form-control" id="exampleInputUsername1" cols="30" rows="2">{{$detail->description}}</textarea>
                                </div>
                            </div>
                        </div>
                      </div>

                    @endforeach

                  @else
                    <div class=" text-center font-weight-bold" role="alert">No detail found</div>
                  @endif


                  <br>
                    <h4>Preliminary Report</h4>
                  <br>

                  @if( $complain->preliminaryReport != null )

                    <a href="{{ route('preview.file',$complain->preliminaryReport->id) }}" target="_blank" class="text-color d-block text-truncate"> 
                      View Preliminary Report
                    </a>

                  @else

                  <div class="alert alert-warning text-center" role="alert">No preliminary report found</div>

                  @endif

                  <br>
                  <br>
                    <h4>Other Related Documents</h4>
                  <br>

                  @if( count($complain->nodalAdditionalDetails) >= 1 )

                    @foreach($complain->nodalAdditionalDetails as $index => $detail)
                      <div id="rowContainer">
                        <div class="row dub-row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Document</label>
                                    <a href="{{ route('preview.file',$detail->file) }}" target="_blank" class="text-color d-block text-truncate"> 
                                      <span> #{{$index+1}}</span>  View Document
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="exampleInputUsername1"> Document Detail</label>
                                    <textarea class="form-control" disabled id="exampleInputUsername1" cols="30" rows="4">{{ $detail->description }}</textarea>
                                </div>
                            </div>
                        </div>
                      </div>
                    @endforeach

                    @else
                      <div class="alert alert-warning text-center" role="alert">No other related documents found</div>
                    @endif

                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
</x-app-layout>