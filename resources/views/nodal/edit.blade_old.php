<x-app-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="content-wrapper">  
      <div class="row">

        <div class="card-body">
          <div class="d-flex justify-content-end mb-3">
              <a class="btn add-btn" href="{{ route('nodal.complaints') }}"> Go Back</a>
          </div>
        </div>
        
        @include('includes/complain_detail')
        
        @include('includes/nodal_complain_detail')

        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title underline-css">Updation by Nodal Officer</h4>

              <br>

              <!-- Error Section Start Here 'message-block' -->
                @include('includes/message-block')
              <!-- Error Section Ends Here -->

              <form class="forms-sample" action="{{ route('nodal.complaint.update') }}" method="post" enctype="multipart/form-data">

                    @csrf
                    
                <input type="hidden" value="{{$list_id}}" name="id">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputUsername1">Preliminary Report</label>
                            <input type="file" {{ isset($complain->preliminaryReport->id) ? '' : 'required' }} class="form-control" name="preliminary_report" id="exampleInputUsername1" placeholder="file">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputUsername1">Uploaded Preliminary Report</label>
                            @if( isset($complain->preliminaryReport->id) )
                                <a href="{{ route('preview.file',$complain->preliminaryReport->id) }}" target="_blank" class="text-color d-block text-truncate">
                                  View Uploaded Preliminary Report
                                </a>
                            @else
                                <a href="#" class="text-danger d-block text-truncate">
                                    No Report Found
                                </a>
                            @endif
                            <!-- <input type="file" required class="form-control" name="preliminary_report" id="exampleInputUsername1" placeholder="file"> -->
                        </div>
                    </div>
                </div>
                
                <br><br>
                
                <h5 class="card-title">Other Related Documents</h5>
                
                <div id="rowContainer">
                  <div class="row dub-row">
                      <div class="col-md-5">
                          <div class="form-group">
                              <label for="exampleInputUsername1">Document</label>
                              <input type="file" class="form-control"  name="files[]" id="exampleInputUsername1" placeholder="file">
                          </div>
                      </div>
                      <div class="col-md-5">
                          <div class="form-group">
                              <label for="exampleInputUsername1">Document Description</label>
                              <textarea class="form-control" id="exampleInputUsername1" name="details[]" cols="30" rows="2"></textarea>
                          </div>
                      </div>
                      <div class="col-md-2">
                          <div class="form-group button-here ">
                              <label for="exampleInputUsername1">&nbsp;&nbsp;</label>
                              <input type="button" class="form-control addRowBtn add-btn btn btn-primary" value="Add">
                          </div>
                      </div>
                  </div>
                </div>                  

                <button type="submit" style="color:white; border:none;" class="btn add-btn mr-2">Submit</button>
                <a href="{{ route('nodal.complaints') }}" class="btn btn-light">Cancel</a>

              </form>
            </div>
          </div>
        </div>
        
      </div>
    </div>
        
    <script>

        document.addEventListener('DOMContentLoaded', function() {
          document.querySelector('.addRowBtn').addEventListener('click', function() {
            var row = document.querySelector('.dub-row');
            var newRow = row.cloneNode(true);
            
            newRow.querySelector('.addRowBtn').remove();

            var removeBtn = document.createElement('input');
            removeBtn.setAttribute('type', 'button');
            removeBtn.setAttribute('class', 'form-control removeRowBtn btn btn-danger');
            removeBtn.setAttribute('value', 'Remove');
            removeBtn.addEventListener('click', function() {
                newRow.remove();
            });

            newRow.querySelector('.button-here').appendChild(removeBtn);
            document.getElementById('rowContainer').appendChild(newRow);

          });
        });

    </script>

</x-app-layout>