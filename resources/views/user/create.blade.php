<x-app-layout>

<div style="margin-top: 50px;" ></div>

<!-- Error Section Start Here 'message-block' -->
    @include('includes/message-block')
<!-- Error Section Ends Here -->

<form class="form-control" action="{{ route('user.complaint.store') }}" method="post" enctype="multipart/form-data" id="registerComplaintForm">
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
                <label for="exampleFormControlInput1" class="form-label" >Description of Complaint <span style="color:red;" >*</span> </label>
                <div class="input-container1">
                    <textarea class="form-control placeholder-green-color" name="description" placeholder="Description of Complaint" id="exampleFormControlInput1" required cols="30" rows="4">{{old('description')}}</textarea>
                </div>
                <x-input-error :messages="$errors->get('description')" style="color:red;" class="mt-2 err_mdy" />
            </div>
        </div>
    </div>


    <div class="row padding-30px">
        <div class="col-lg-4">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">ONGC Work Centre <span style="color:red;" >*</span></label>
                <div class="input-container1">
                    <select class="form-control placeholder-green-color" name="work_centre" id="workCentreSelect" required>
                        <option selected disabled>Please Select</option>    
                            @if($workCenters->isNotEmpty())
                                @foreach($workCenters as $index => $workCenter)
                                    <option @if(old('work_centre') == $workCenter->id ) SELECTED @endif  value="{{ $workCenter->id }}">{{ $workCenter->name }}</option>
                                @endforeach
                            @endif
                    </select>
                </div>
                <x-input-error :messages="$errors->get('work_centre')" style="color:red;" class="mt-2 err_mdy" />
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Department/Section <span style="color:red;" >*</span></label>
                <div class="input-container1">
                    <select name="department_section" class="form-control placeholder-green-color" id="departmentSelect" onchange="handleSelectChange()" required>
                        <option SELECTED disabled>Please Select</option>
                        @if($centerDepartment->isNotEmpty())
                            @foreach($centerDepartment as $index => $department)
                                <option @if(old('department_section') == $department->work_center_id ) SELECTED @endif data-work-center-id="{{ $department->work_center_id }}" value="{{$department->id}}" >{{ $department->name }}</option>
                            @endforeach
                        @endif

                    </select>
                </div>
                <x-input-error :messages="$errors->get('department_section')" style="color:red;" class="mt-2 err_mdy" />
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Department (If clicked Others)</label>
                <div class="input-container1">
                    <input type="text" name="other_section" id="others-show" disabled value="{{old('other_section')}}" class="form-control placeholder-green-color" placeholder="Department/Section">
                </div>
                <x-input-error :messages="$errors->get('other_section')" style="color:red;" class="mt-2 err_mdy" />
            </div>
        </div>
    </div>


    <div class="row padding-30px">
        <div class="col-lg-12">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Against Whom <span style="color:red;" >*</span></label>
                <div class="input-container1">
                    <input type="text" name="against_persons" value="{{ old('against_persons') }}" required>
                </div>
                <x-input-error :messages="$errors->get('against_persons')" style="color:red;" class="mt-2 err_mdy" />
            </div>
        </div>
    </div>

    <div id="rowContainer" class="row padding-30px">
        <div class="row dub-row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="exampleInputUsername1" class="form-label">Document <span style="color: #AB3336;">(*Max document size: 15 MB)</span></label>
                    <input type="file" class="form-control" name="document[]" id="exampleInputUsername1" placeholder="file">
                    <x-input-error :messages="$errors->get('document.*')" style="color:red;" class="mt-2 err_mdy" />
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

        <a href="javascript:void(0)" onclick="document.getElementById('registerComplaintForm').submit();" data-bs-dismiss="modal">
            <div class="button-otp" style="background: green; #08AF73: 1px solid #000;color: white;">
                Submit
            </div>
        </a>
        <!-- <button type="submit" class="btn btn-success mr-2 add-btn">Submit</button> -->
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

                // Clear the file input and textarea before appending
                newRow.querySelector('input[type="file"]').value = '';
                newRow.querySelector('textarea[name="additional_detail[]"]').value = '';

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
            var departmentSelect = document.getElementById('departmentSelect');
            var selectedText = departmentSelect.options[departmentSelect.selectedIndex].text;
            var othersInput = document.getElementById('others-show');

            if (selectedText === 'Other') {
                othersInput.disabled = false;
            } else {
                othersInput.disabled = true;
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            
            const workCentreSelect = document.getElementById('workCentreSelect');
            const departmentSelect = document.getElementById('departmentSelect');
            const allOptions = departmentSelect.querySelectorAll('option');
            var othersInput = document.getElementById('others-show');

            workCentreSelect.addEventListener('change', function () {
                const selectedWorkCentreId = this.value;
                othersInput.value = "";
                othersInput.disabled = true;
                // Reset department select to default
                departmentSelect.value = '';

                // Show or hide options based on selected work centre
                allOptions.forEach(option => {
                    if (option.disabled) return; // skip the placeholder option
                    if (option.dataset.workCenterId === selectedWorkCentreId) {
                        option.style.display = 'block';
                    } else {
                        option.style.display = 'none';
                    }
                });
            });

            // Trigger the change event when the page loads to set the initial state
            workCentreSelect.dispatchEvent(new Event('change'));
        });

    </script>
    

</x-app-layout>