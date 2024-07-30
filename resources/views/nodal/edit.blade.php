<x-app-layout>

<div style="margin-top: 50px;" ></div>

<div class="row padding-15px" style="background: #fff;margin: 0 20px;">
    <div class="row padding-30px">

    <!-- Error Section Start Here 'message-block' -->
    @include('includes/message-block')
    <!-- Error Section Ends Here -->

      <form class="forms-sample" action="{{ route('nodal.complaint.update') }}" id="nodalComplainUpdate" method="post" enctype="multipart/form-data">
        @csrf            
        <input type="hidden" value="{{$list_id}}" name="id">

        <div id="rowContainer" class="row padding-30px">

          <div class="col-lg-12">
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Preliminary Report</label>
                <div class="input-container1">

                  <input type="file" 
                    class="form-control placeholder-green-color" 
                    id="exampleFormControlInput1" 
                    {{ isset($complain->preliminaryReport->id) ? '' : 'required' }}
                    name="preliminary_report" 
                    placeholder="file">

                </div>
            </div>
          </div>

          <div style="margin-top: 50px;" ></div>

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
                      <textarea name="additional_detail[]" class="form-control placeholder-green-color" id="exampleInputUsername1" cols="30" rows="2" placeholder="Enter document description"></textarea>
                  </div>
              </div>
              <div class="col-md-2">
                  <div class="form-group button-here">
                      <label for="exampleInputUsername1">&nbsp;&nbsp;</label>
                      <input type="button" class="form-control addRowBtn btn btn-primary add-btn" style="background: transparent;border: 1px solid #000;color: #5A5A5A;" value="Add">
                  </div>
              </div>
              <div style="margin-top: 10px;" ></div>
          </div>

        </div>

        <div class="modal-footer justify-content-center" style="padding-top: 0;">
            <a href="{{ route('user.nodal.view',$list_id) }}" data-bs-dismiss="modal">
                <div class="button-otp" style="background: transparent;border: 1px solid #000;color: #5A5A5A;">
                    Cancel
                </div>
            </a>
            <a href="javascript:void(0);" onclick="document.getElementById('nodalComplainUpdate').submit();" > <div class="button-otp"> Submit </div> </a>
        </div>

      </form>

      <div style="margin-top: 50px;" ></div>
      
      @include('nodal.includes.preliminary_reports')
      @include('nodal/includes/complain_detail')

    </div>
</div>

<script>
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