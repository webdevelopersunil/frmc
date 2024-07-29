<x-app-layout>


<div class="row top-heading padding-30px">
    <div class="col-lg-6 d-flex align-items-center">
        <h1 class="complainant-heading">Your Registered Complaints</h1>
    </div>

    <div class="col-lg-6 d-flex justify-content-end" style="gap: 25px;">
        <div class="bell">
            <a href=""><img src="{{ asset('assets/theme/image/Notification.png') }}" alt="" class="img-fluid"></a>
            <p class="show-notification">2</p>
        </div>
        <div class="profile">
            <img src="{{ asset('assets/theme/image/profile.png') }}" alt="" class="img-fluid">
        </div>
        <div class="profile-name d-flex justify-content-center align-items-center" style="gap: 10px;">
            <a href="profile.html" class="d-flex justify-content-center align-items-center" style="gap: 10px;">
            <h2 class="profile-name ">Profile Name</h2>
            <img src="{{ asset('assets/theme/image/down arrow.png') }}" alt="">
            </a>
        </div>
    </div>
</div>

<div style="margin-top: 50px;" ></div>

<!-- Error Section Start Here 'message-block' -->
    @include('includes/message-block')
<!-- Error Section Ends Here -->

<form class="form-control" action="{{ route('user.complaint.store') }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="row padding-30px">
        <div class="col-lg-12">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Complaint Number</label>
                <div class="input-container1">
                    <input type="text" class="form-control placeholder-green-color" name="complain_no" readonly="TRUE" id="exampleFormControlInput1" value="{{ $complainNo }}" required>
                </div>
            </div>
        </div>
    </div>

    <div class="row padding-30px">
        <div class="col-lg-12">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Description of Complaint</label>
                <div class="input-container1">
                    <textarea class="form-control placeholder-green-color" name="description" placeholder="Description of Complaint" id="exampleFormControlInput1" required cols="30" rows="4"></textarea>
                </div>
                <x-input-error :messages="$errors->get('description')" style="color:red;" class="mt-2 err_mdy" />
            </div>
        </div>
    </div>

    <div class="row padding-30px">
        <div class="col-lg-4">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">ONGC Work Centre</label>
                <div class="input-container1">
                    <select class="form-control placeholder-green-color" name="work_centre" id="workCentreSelect" required>
                        <option selected disabled>Please Select</option>
                        @if($workCenters->isNotEmpty())
                            @foreach($workCenters as $index => $workCenter)
                                <option value="{{ $workCenter->id }}">{{ $workCenter->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <x-input-error :messages="$errors->get('work_centre')" style="color:red;" class="mt-2 err_mdy" />
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Department/Section</label>
                <div class="input-container1">
                    <select name="department_section" class="form-control placeholder-green-color" id="departmentSelect" onchange="handleSelectChange()" required>
                        <option selected disabled>Please Select</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
                <x-input-error :messages="$errors->get('department_section')" style="color:red;" class="mt-2 err_mdy" />
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Department (If clicked Others)</label>
                <div class="input-container1">
                    <input type="text" name="department_section_other" id="others-show" disabled class="form-control placeholder-green-color" placeholder="Department/Section">
                </div>
                <x-input-error :messages="$errors->get('department_section_other')" style="color:red;" class="mt-2 err_mdy" />
            </div>
        </div>
    </div>

    <div class="row padding-30px">
        <div class="col-lg-12">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Against Whom</label>
                <div class="input-container1">
                    <input type="text" name="against_persons" class="form-control placeholder-green-color" id="exampleFormControlInput1" placeholder="Against Users names" required>
                </div>
                <x-input-error :messages="$errors->get('against_persons')" style="color:red;" class="mt-2 err_mdy" />
            </div>
        </div>
    </div>

    <div id="rowContainer" class="row padding-30px">
        <div class="row dub-row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="exampleInputUsername1" class="form-label">Document</label>
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
                <div class="form-group button-here">
                    <label for="exampleInputUsername1">&nbsp;&nbsp;</label>
                    <input type="button" class="form-control addRowBtn btn btn-primary add-btn" style="background: transparent;border: 1px solid #000;color: #5A5A5A;" value="Add">
                </div>
            </div>
        </div>
    </div>

    <div class="modal-footer justify-content-center" style="padding-top: 0;">
        <a href="{{ route('user.dashboard') }}" data-bs-dismiss="modal">
            <div class="button-otp" style="background: transparent;border: 1px solid #000;color: #5A5A5A;">
                Cancel
            </div>
        </a>
        <button type="submit" class="btn btn-primary mr-2 add-btn">Submit</button>
    </div>
</form>



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