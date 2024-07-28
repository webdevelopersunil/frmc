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






<div class="row padding-30px">
    <div class="col-lg-6">
        <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Complaint Number</label>
        <div class="input-container1">
            <input type="text" class="form-control placeholder-green-color" id="exampleFormControlInput1" disabled placeholder="CMPL 10099009N">
        </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Complaint Title</label>
        <div class="input-container1">
            <input type="text" class="form-control placeholder-green-color" id="exampleFormControlInput1" placeholder="Horem ipsum dolor sit amet, consectetur adipiscing elit.">
        </div>
        </div>
    </div>
    </div>
    <div class="row padding-30px">
    <div class="col-lg-12" style="background: #02AC6F;padding: 15px;border-radius: 13px;color: #fff;">
        <p class="text-center">Description of Complaint</p>
        <hr>
        <p class="text-center">Lorem ipsum dolor sit amet consectetur. Pellentesque viverra dignissim mauris
        habitasse mi facilisis. Porttitor mattis pretium egestas tincidunt consectetur porta proin tincidunt.
        </p>
    </div>
    </div>
    <div class="row padding-30px">
    <div class="col-lg-3">
        <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">ONGC Work Centre</label>
        <div class="input-container1">
            <input type="text" class="form-control placeholder-green-color" id="exampleFormControlInput1"
            placeholder="Mumbai">
        </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Department/Section</label>
        <div class="input-container1">
            <input type="text" class="form-control placeholder-green-color" id="exampleFormControlInput1"
            placeholder="Mumbai">
        </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Others</label>
        <div class="input-container1">
            <input type="text" class="form-control placeholder-green-color" id="exampleFormControlInput1"
            placeholder="Mumbai">
        </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Against Whom</label>
        <div class="input-container1">
            <input type="text" class="form-control placeholder-green-color" id="exampleFormControlInput1"
            placeholder="NODAL Officer">
        </div>
        </div>
    </div>
    </div>




    <div class="row padding-30px">
    <div class="col-lg-12">
        <table class="table complainant-view-table">
        <thead>
            <tr>
            <th>Documents Uploaded by complainant</th>
            <th>Upload Date & Time</th>
            <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <td style="border-top-left-radius: 10px;border-bottom-left-radius: 10px;"><img
                src="./image/Document.png" alt=""><span>CMPL 10099009N</span></td>
            <td>23rd May 2024 ||3:00 PM</td>
            <td style="border-top-right-radius: 10px;border-bottom-right-radius: 10px;">Horem ipsum dolor sit
                amet, consectetur adipis</td>
            </tr>
            <tr style="height: 15px;"></tr>
            <tr>
            <td style="border-top-left-radius: 10px;border-bottom-left-radius: 10px;"><img
                src="./image/Document.png" alt=""><span>CMPL 10099009N</span></td>
            <td>23rd May 2024 ||3:00 PM</td>
            <td style="border-top-right-radius: 10px;border-bottom-right-radius: 10px;">Horem ipsum dolor sit
                amet, consectetur adipis</td>
            </tr>
            <tr style="height: 15px;"></tr>
            <tr>
            <td style="border-top-left-radius: 10px;border-bottom-left-radius: 10px;"><img
                src="./image/Document.png" alt=""><span>CMPL 10099009N</span></td>
            <td>23rd May 2024 ||3:00 PM</td>
            <td style="border-top-right-radius: 10px;border-bottom-right-radius: 10px;">Horem ipsum dolor sit
                amet, consectetur adipis</td>
            </tr>
        </tbody>
        </table>
    </div>
    </div>
    <div class="row padding-30px" style="padding-top: 5px;padding-bottom: 5px;">
    <div class="col-lg-3">
        <p>Complaint Status</p>
        <p style="color: #02AC6F;">Closed</p>
    </div>
        <div class="col-lg-4">
            <p>ONGC Comments</p>
            <p style="color: #02AC6F;">Closed as per MOM attached</p>
        </div>
    </div>



    <div style="margin-top: 50px;" ></div>

    <div class="modal-footer justify-content-center" style="padding-top: 0;">
        <a href="{{ route('user.dashboard') }}" data-bs-dismiss="modal">
            <div class="button-otp" style="background: transparent;border: 1px solid #000;color: #5A5A5A;">
                Cancel
            </div>
        </a>
        <a href="javascript:void(0)" onclick="submitCurrentForm()"> <div class="button-otp"> Edit </div> </a>

    </div>



</x-app-layout>