<x-app-layout>

    <div class="row padding-15px" style="background: #fff;margin: 0 20px;">

        <div class="col-lg-12 d-flex justify-content-between align-items-center" style="margin: 20px 0;">
            <h3 class="profile-name">Update Profile</h3>
        </div>

        <!-- Error Section Start Here 'message-block' -->
        @include('includes/message-block')
        <!-- Error Section Ends Here -->

        <div class="col-lg-12">
            @include('profile.partials.update-profile-information-form')
        </div>

        <div class="modal-footer justify-content-center" style="padding-top: 0;">
            <a href="">
                <div class="button-otp"> 
                    Submit
                </div>
            </a>
        </div>
        
    </div>
</x-app-layout>
