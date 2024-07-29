<x-app-layout>
<div style="margin-top: 50px;" ></div>


<div class="row padding-15px" style="background: #fff;margin: 0 20px;">
    <div class="row padding-30px">
        @include('user/includes/complain_detail')

        <div style="margin-top: 50px;" ></div>

        @include('nodal/includes/complain_detail')

        <div class="modal-footer justify-content-center" style="padding-top: 0;">
            <a href="{{ route('nodal.dashboard') }}" data-bs-dismiss="modal">
                <div class="button-otp" style="background: transparent;border: 1px solid #000;color: #5A5A5A;">
                    Cancel
                </div>
            </a>
            <a href="javascript:void(0)" onclick="submitCurrentForm()"> <div class="button-otp"> Edit </div> </a>
        </div>
    </div>
</div>


</x-app-layout>