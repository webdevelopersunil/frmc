<x-app-layout>

<div style="margin-top: 50px;" ></div>

<div class="row padding-15px" style="background: #fff;margin: 0 20px;">
<!-- <div class="col-lg-12" style="padding: 15px 0;"> -->
    <p style="color: #08AF73;">Additional Information <span style="color: #AB3336;">(*Document & Document Description)</span></p>
<!-- </div> -->

    <div class="row padding-30px">
      <!-- Error Section Start Here 'message-block' -->
          @include('includes/message-block')
      <!-- Error Section Ends Here -->
        <form class="form-control" action="{{ route('user.complaint.update') }}" method="post" enctype="multipart/form-data" id="registerComplaintForm">

          @csrf
          <input type="hidden" value="{{$complain->id}}" name="complaint_id" >
          <x-input-error :messages="$errors->get('description')" style="color:red;" class="mt-2 err_mdy" />
            <div id="rowContainer" class="row padding-30px">
                <div class="row dub-row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="exampleInputUsername1" class="form-label">Document <span style="color: #AB3336;">(*Max document size: 15 MB)</span></label>
                            <input type="file" class="form-control" name="document[]" id="exampleInputUsername1" required placeholder="file">
                            <x-input-error :messages="$errors->get('document.*')" style="color:red;" class="mt-2 err_mdy" />
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="exampleInputUsername1">Document Description</label>
                            <textarea name="additional_detail[]" class="form-control" id="exampleInputUsername1" cols="30" rows="2" required></textarea>
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

            <div style="margin-top: 20px;" ></div>

            <div class="modal-footer justify-content-center" style="padding-top: 0;">
                <a href="{{ route('user.complaint.view',$complain->id) }}" data-bs-dismiss="modal">
                    <div class="button-otp" style="background: transparent;border: 1px solid #000;color: #5A5A5A;"> Cancel </div>
                </a>
                <input class="button-otp" type="submit" value="Update"  >
            </div>
        </form>

        <div style="margin-top: 20px;" ></div>

        <!-- <div class="modal-footer justify-content-center" style="padding-top: 0;">
            <a href="{{ route('user.complaints') }}" data-bs-dismiss="modal">
                <div class="button-otp" style="background: transparent;border: 1px solid #000;color: #5A5A5A;"> Cancel </div>
            </a>
            <input class="button-otp" type="submit" value="Update"  >
        </div> -->

        <div style="margin-top: 10px;" ></div>

        @include('user/includes/complain_detail')
    </div>
</div>


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

          var selectedValue = document.getElementById('departmentSelect').value;
          var othersInput = document.getElementById('others-show');

          if (selectedValue === 'Others') {
              othersInput.disabled = false;
              
          } else {
              othersInput.disabled = true;
          }
        }
    </script>

</x-app-layout>