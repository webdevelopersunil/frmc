<x-app-layout>

    <div class="row padding-15px" style="background: #fff;margin: 0 20px;">

        <div class="col-lg-12 d-flex justify-content-between align-items-center" style="margin: 20px 0;">
            <h3 class="profile-name">{{ucfirst($user->roles[0]['name'])}} Profile</h3>
        </div>

        <!-- Error Section Start Here 'message-block' -->
        @include('includes/message-block')
        <!-- Error Section Ends Here -->

        <div class="col-lg-12">
            @include('fco.profile.includes.detail-form')
        </div>

        <div class="modal-footer justify-content-center" style="padding-top: 0;">
            <a href="javascript:void(0)" onclick=" document.getElementById('formSubmitProfileUpdate').submit(); " >
                <div class="button-otp"> 
                    Submit
                </div>
            </a>
        </div>
        
    </div>


    <!-- @if(auth()->user()->hasRole('user') ) -->
    <!-- @endif -->
    <div class="row padding-15px" style="background: #fff;margin: 0 20px;">
        <div class="col-lg-12 d-flex justify-content-between align-items-center" style="margin: 20px 0;">
            <h3 class="profile-name">Update Email & Phone Number</h3>
        </div>

        <div class="col-lg-12">
            @include('fco.profile.includes.contact-form')
        </div>

        <div class="modal-footer justify-content-center" style="padding-top: 0;">
            <a href="javascript:void(0)" onclick=" document.getElementById('formSubmitProfileUpdate').submit(); " >
                <div class="button-otp"> 
                    Submit
                </div>
            </a>
        </div>
    </div>

</x-app-layout>
