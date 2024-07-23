<x-app-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />


    <div class="content-wrapper">
          <div class="row">


            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Updation by the office of FCO</h4>
                  
                  <br>

                  <!-- Error Section Start Here 'message-block' -->
                  @include('includes/message-block')
                  <!-- Error Section Ends Here -->
                  
                  <form class="forms-sample" action="{{ route('fco.complaint.work-centre.update') }}" method="post">

                      @csrf
                    <input type="hidden" value="{{$complain->id}}" name="id">
                  
                    <div class="row">
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
                    </div>

                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                    <a href="{{ route('fco.complaints') }}" class="btn btn-light">Cancel</a>
                  </form>
                </div>
              </div>
            </div>
                    
            
            
          </div>
        </div>
</x-app-layout>