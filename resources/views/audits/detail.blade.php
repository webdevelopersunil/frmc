<x-app-layout>

    <div style="margin-top: 50px;" ></div>
    
    <div class="row padding-15px" style="background: #fff;margin: 0 20px;">
    
        <!-- Error Section Start Here 'message-block' -->
        @include('includes/message-block')
        <!-- Error Section Ends Here -->
    
        <div class="row padding-30px">
        
            <div class="col-lg-4">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">User Name</label>
                    <div class="input-container1">
                        <input type="text" class="form-control placeholder-green-color" value="{{ ucfirst($user->name) }}" id="exampleFormControlInput1" disabled >
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">CPF Number</label>
                    <div class="input-container1">
                        <input type="text" class="form-control placeholder-green-color" value="{{ ucfirst($user->cpfNo) }}" readonly id="exampleFormControlInput1" disabled>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Email</label>
                    <div class="input-container1">
                        <input type="text" class="form-control placeholder-green-color" value="{{ ucfirst($user->email) }}" readonly id="exampleFormControlInput1" disabled >
                    </div>
                </div>
            </div>
                    
            </div>

            <div class="row padding-30px">
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Phone Number</label>
                        <div class="input-container1">
                            <input type="text" class="form-control placeholder-green-color" value="{{ ucfirst($user->phone) }}" readonly id="exampleFormControlInput1" disabled>
                        </div>
                    </div>
                </div>
            
                {{-- <div class="col-lg-4">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Role</label>
                        <div class="input-container1">
                            <input type="text" readonly class="form-control placeholder-green-color" id="exampleFormControlInput1"
                            placeholder="newnew">
                        </div>
                    </div>
                </div> --}}
            
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Updated On</label>
                        <div class="input-container1">
                            <input type="text" class="form-control placeholder-green-color" value="{{ \Carbon\Carbon::parse($audit->created_at)->format('d F Y') }}" id="exampleFormControlInput1" disabled readonly >
                        </div>
                    </div>
                </div>
            </div>


            <div class="row padding-30px">
                <div class="col-lg-12" style="background: #02AC6F; padding: 15px; border-radius: 13px; color: #fff;">
                    <p class="text-center description-part">Old Changes</p>
                    <hr>
                    <div class="text-center">
                        @if(is_array($audit->old_values))
                            <ul class="list-unstyled">
                                @foreach($audit->old_values as $key => $value)
                                    <li><strong>{{ ucfirst($key) }}:</strong> {{ is_array($value) ? json_encode($value) : $value }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p>{{ $audit->old_values }}</p>
                        @endif
                    </div>
                </div>
            </div>

            
            <div class="row padding-30px">
                <div class="col-lg-12" style="background: #02AC6F; padding: 15px; border-radius: 13px; color: #fff;">
                    <p class="text-center description-part">New Changes</p>
                    <hr>
                    <div class="text-center">
                        @if(is_array($audit->new_values))
                            <ul class="list-unstyled">
                                @foreach($audit->new_values as $key => $value)
                                    <li><strong>{{ ucfirst($key) }}:</strong> {{ is_array($value) ? json_encode($value) : $value }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p>{{ $audit->new_values }}</p>
                        @endif
                    </div>
                </div>
            </div>
            

    
            <div class="modal-footer justify-content-center" style="padding-top: 0;">
                {{-- <a href="{{ route('fco.complaints') }}" data-bs-dismiss="modal">
                    <div class="button-otp" style="background: transparent;border: 1px solid #000;color: #5A5A5A;">
                        Cancel 
                    </div>
                </a> --}}
                <a href="{{ route('audit') }}"> <div class="button-otp"> Go Back </div> </a>
            </div>
        </div>
    </div>
    
    </x-app-layout>