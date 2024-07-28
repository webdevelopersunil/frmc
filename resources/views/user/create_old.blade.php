<x-app-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

      <div class="content-wrapper">
        <div class="row">
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">New Complaint</h4>
                <br>
                
                <!-- Error Section Start Here 'message-block' -->
                    @include('includes/message-block')
                <!-- Error Section Ends Here -->

                <form class="forms-sample" action="{{ route('user.complaint.store') }}" method="post" enctype="multipart/form-data"> 

                    @csrf

                  <div class="row">
                      <div class="col-md-12">
                          <div class="form-group">
                              <label for="exampleInputUsername1">Complaint No.</label>
                              <input type="text" name="complain_no" class="form-control" readonly="TRUE" value="{{$complainNo}}" id="exampleInputUsername1" required >
                          </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-12">
                          <div class="form-group">
                              <label for="exampleInputUsername1">Description of Complaint</label>
                              <textarea name="description" class="form-control" id="exampleInputUsername1" required cols="30" rows="4">Description of Complaint</textarea>
                          </div>
                    </div>
                  </div>

                    <div class="row">
                      <div class="col-md-4">
                          <div class="form-group">
                              <label for="exampleInputUsername1">ONGC Work Centre</label>
                              <select class="form-control form-control-lg" name="work_centre" id="workCentreSelect" required>

                                    <option selected disabled>Please Select</option>  
                                    @if($workCenters->isNotEmpty())
                                        @foreach($workCenters as $index => $workCenter)
                                            <option value="{{ $workCenter->id }}">{{ $workCenter->name }}</option>
                                        @endforeach
                                    @endif
                              </select>
                          </div>
                      </div>

                      <div class="col-md-4">
                          <div class="form-group">
                              <label for="exampleInputUsername1">Department/Section</label>
                              <select name="department_section" class="form-control form-control-lg" id="departmentSelect" onchange="handleSelectChange()" required>
                                  <option selected disabled>Please Select</option>
                                  <option value="Others" >Others</option>
                              </select>
                          </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputUsername1"> Department (If clicked Others) </label>
                            <input type="text" name="department_section_other" id="others-show" disabled class="form-control" id="exampleInputUsername1" placeholder="Department/Section" required>
                        </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputUsername1">Against Whom</label>
                            <input type="text" name="against_persons" class="form-control" value="user 1, User 2" id="exampleInputUsername1" placeholder="Against Users names" required>
                        </div>
                      </div>
                  </div>

                  <br>

                  <!-- Additional Input -->
                  
                <div id="rowContainer">
                    <div class="row dub-row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="exampleInputUsername1">Document</label>
                                <input type="file" class="form-control" name="document[]" id="exampleInputUsername1" placeholder="file">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="exampleInputUsername1">Document Description</label>
                                <textarea name="additional_detail[]" class="form-control" id="exampleInputUsername1" cols="30" rows="2"></textarea>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group button-here ">
                                <label for="exampleInputUsername1">&nbsp;&nbsp;</label>
                                <input type="button" class="form-control addRowBtn btn btn-primary add-btn" value="Add">
                            </div>
                        </div>
                    </div>
                </div> 

                  <button type="submit" class="btn btn-primary mr-2 add-btn">Submit</button>
                    <a class="btn btn-light" href="{{ route('user.complaints') }}">Cancel</a>

                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->


    <script>
        
        function toggleOtherInput() {
            var selectElement = document.getElementById("departmentSelect");
            var otherInput = document.getElementById("others-show");
            if (selectElement.value === "Others") {
                otherInput.disabled = false;
            } else {
                otherInput.disabled = true;
            }
        }
        // Need to remove
        document.addEventListener('DOMContentLoaded', function() {
          document.querySelector('.addRowBtn').addEventListener('click', function() {
              var row = document.querySelector('.dub-row');
              var newRow = row.cloneNode(true);
              
              // Remove the "Add" button from the cloned row
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

        function handleSelectChange() {

          var selectedValue = document.getElementById('departmentSelect').value;
          var othersInput = document.getElementById('others-show');

          if (selectedValue === 'Others') {
              othersInput.disabled = false;
              
          } else {
              othersInput.disabled = true;
          }
        }
    </script>
    <script>
        
        const workCentreOptions = {

            '1': ['Delhi Department 1', 'Delhi Department 2'],
            '3': ['Dehradun Department 1', 'Dehradun Department 2'],
            '2': ['Mumbai Department 1', 'Mumbai Department 2'],
            '4': ['Ahmedabad Department 1', 'Ahmedabad Department 2']
        };

        // Function to update department options based on selected work centre
        function updateDepartmentOptions() {

            const workCentreSelect = document.getElementById('workCentreSelect');
            const departmentSelect = document.getElementById('departmentSelect');
            const selectedWorkCentre = workCentreSelect.value;

            var othersInput = document.getElementById('others-show');
            othersInput.disabled = true;

            // Clear existing options
            departmentSelect.innerHTML = '<option selected disabled>Please Select</option>';

            // Add options based on selected work centre
            workCentreOptions[selectedWorkCentre].forEach(option => {
                const optionElement = document.createElement('option');
                optionElement.value = option;
                optionElement.textContent = option;
                departmentSelect.appendChild(optionElement);
                // departmentSelect.appendChild('<option value="Others" >Others</option>');
            });

            var othersOption = document.createElement('option');
            othersOption.value = 'Others';
            othersOption.textContent = 'Others';
            departmentSelect.appendChild(othersOption);
            
        }

        // Event listener to update department options when work centre is changed
        document.getElementById('workCentreSelect').addEventListener('change', updateDepartmentOptions);

        // Initial call to update department options based on default selected work centre
        updateDepartmentOptions();
    </script>


</x-app-layout>