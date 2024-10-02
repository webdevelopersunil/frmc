<x-app-layout>

<div style="margin-top: 50px;" ></div>

<div class="row padding-15px" style="background: #fff;margin: 0 20px;">

    <!-- Error Section Start Here 'message-block' -->
    @include('includes/message-block')
    <!-- Error Section Ends Here -->

    <div class="row padding-30px">
    
        @include('user/includes/complain_detail')

        @include('nodal.includes.preliminary_reports')

        @include('nodal/includes/complain_detail')

        <div class="modal-footer justify-content-center" style="padding-top: 0;">
            <a href="{{ route('frmc.complaints') }}" data-bs-dismiss="modal">
                <div class="button-otp" style="background: transparent;border: 1px solid #000;color: #5A5A5A;">
                    Cancel 
                </div>
            </a>
            <!-- <a href="{{ route('fco.complaint.edit',$complain->id) }}"> <div class="button-otp"> Edit </div> </a> -->
        </div>
    </div>
</div>

</x-app-layout>