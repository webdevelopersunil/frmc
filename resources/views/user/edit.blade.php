<x-app-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

      
      <div class="content-wrapper">
        <div class="row">
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Registration of Complainant</h4>
                <p class="card-description" onclick="window.location=''" > otp confirmation </p>

                <form class="forms-sample" action="" >

                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="exampleInputUsername1">Complaint No.</label>
                              <input type="text" class="form-control" readonly="TRUE" value="CM001NO65" id="exampleInputUsername1" placeholder="Username">
                          </div>
                      </div>
                    <div class="col-md-6">
                      <div class="form-group">
                          <label for="exampleInputUsername1">Date of Complaint</label>
                          <input type="date" class="form-control" id="exampleInputUsername1">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                      <div class="col-md-12">
                          <div class="form-group">
                              <label for="exampleInputUsername1">Description of Complaint</label>
                              <textarea name="" class="form-control" id="exampleInputUsername1" cols="30" rows="4"></textarea>
                          </div>
                    </div>
                  </div>

                  <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputUsername1">Department/Section</label>
                            <select onchange="toggleOtherInput()" class="form-control form-control-lg" id="departmentSelect">
                              <option>Department 1</option>
                              <option>Department 2</option>
                              <option value="Others" >Others</option>
                            </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputUsername1"> Department/Section </label>
                            <input type="text" id="others-show" disabled class="form-control" id="exampleInputUsername1" placeholder="Department/Section">
                        </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputUsername1">Against Whom</label>
                            <input type="text" class="form-control" value="user 1, User 2" id="exampleInputUsername1" placeholder="Against Users names">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputUsername1">ONGC Work Centre</label>
                            <select class="form-control form-control-lg" id="exampleFormControlSelect1">
                              <option>ONGC Work Centre 1</option>
                              <option>ONGC Work Centre 2</option>
                            </select>
                        </div>
                      </div>
                  </div>

                  <!-- Additional Input -->
                  
                  <div id="rowContainer">
                    <div class="row dub-row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="exampleInputUsername1">Document</label>
                                <input type="file" class="form-control" id="exampleInputUsername1" placeholder="file">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="exampleInputUsername1">Additional Detail</label>
                                <textarea name="" class="form-control" id="exampleInputUsername1" cols="30" rows="2"></textarea>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group button-here ">
                                <label for="exampleInputUsername1">&nbsp;&nbsp;</label>
                                <input type="button" class="form-control addRowBtn btn btn-primary" value="Add">
                            </div>
                        </div>
                    </div>
                  </div> 

                  <button type="submit" class="btn btn-primary mr-2">Submit</button>
                  <button class="btn btn-light">Cancel</button>

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

    </script>


</x-app-layout>