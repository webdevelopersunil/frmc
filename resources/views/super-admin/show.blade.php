<x-app-layout>

<div style="margin-top: 50px;" ></div>

<!-- Error Section Start Here 'message-block' -->
    @include('includes/message-block')
<!-- Error Section Ends Here -->

<form class="form-control" action="{{ route('user.role.update',$token) }}" method="post" enctype="multipart/form-data" id="registerComplaintForm">

    @csrf
    @method('PATCH')

    <input type="hidden" name="id" value="{{$token}}">

    <div class="row padding-30px">
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">User Name</label>
                <div class="input-container1">
                    <input type="text" class="form-control placeholder-green-color" name="complain_no" readonly="TRUE" id="exampleFormControlInput1" placeholder="{{ $user->name }}" required>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">CPF Number</label>
                <div class="input-container1">
                    <input type="text" class="form-control placeholder-green-color" name="complain_no" readonly="TRUE" id="exampleFormControlInput1" placeholder="{{ $user->cpfNo }}" required>
                </div>
            </div>
        </div>
    </div>

    <div class="row padding-30px">
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Roles</label>
                <div class="input-container1">
                    <select class="form-control placeholder-green-color" name="role" required>
                        <option selected disabled>Please Select</option>
                        @if(!empty($roles)  && count($roles) >= 1)
                            @foreach($roles as $role)
                                <option value="{{$role->id}}" @if($currentRole == $role->name) SELECTED @endif >{{ ucfirst($role->name) }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <x-input-error :messages="$errors->get('work_centre')" style="color:red;" class="mt-2 err_mdy" />
            </div>
        </div>

        <!-- <div class="col-lg-4">
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
        </div> -->
    </div>


    <div class="modal-footer justify-content-center" style="padding-top: 0;">
        <a href="{{ route('user.roles.list',) }}" data-bs-dismiss="modal">
            <div class="button-otp" style="background: transparent;border: 1px solid #000;color: #5A5A5A;">
                Cancel
            </div>
        </a>

        <a href="javascript:void(0)" onclick="document.getElementById('registerComplaintForm').submit();" data-bs-dismiss="modal">
            <div class="button-otp" style="background: green; #08AF73: 1px solid #000;color: white;">
                Update
            </div>
        </a>
        <!-- <button type="submit" class="btn btn-success mr-2 add-btn">Submit</button> -->
    </div>
</form>

</x-app-layout>