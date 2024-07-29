<div class="col-lg-4">
            <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Complaint Number</label>
            <div class="input-container1">
                <input type="text" class="form-control placeholder-green-color" id="exampleFormControlInput1" disabled placeholder="{{ $complain->complain_no }}">
            </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Against Whom</label>
                <div class="input-container1">
                    <input type="text" class="form-control placeholder-green-color" readonly id="exampleFormControlInput1"
                    placeholder="{{ ucfirst($complain->against_persons) }}">
                </div>
            </div>
        </div>
        <!-- <div class="col-lg-6">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Complaint Title</label>
                <div class="input-container1">
                    <input type="text" class="form-control placeholder-green-color" id="exampleFormControlInput1" placeholder="Horem ipsum dolor sit amet, consectetur adipiscing elit.">
                </div>
            </div>
        </div> -->
        </div>
        <div class="row padding-30px">
        <div class="col-lg-12" style="background: #02AC6F;padding: 15px;border-radius: 13px;color: #fff;">
            <p class="text-center">Description of Complaint</p>
            <hr>
            <p class="text-center">
                @if( $complain->description == "" )
                    {{ __('No Description Found') }}
                @else
                    {{ Str::limit(ucfirst($complain->description), 800) }} 
                    @if(strlen($complain->description) > 800)
                        &nbsp;&nbsp;<a href="#" class="text-color">see more</a>
                    @endif
                @endif
            </p>
        </div>
        </div>
        <div class="row padding-30px">
        <div class="col-lg-4">
            <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">ONGC Work Centre</label>
            <div class="input-container1">
                <input type="text" class="form-control placeholder-green-color" readonly id="exampleFormControlInput1"
                placeholder="{{ ucfirst($complain->work_centre) }}">
            </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Department/Section</label>
            <div class="input-container1">
                <input type="text" readonly class="form-control placeholder-green-color" id="exampleFormControlInput1"
                placeholder="{{ ucfirst($complain->department_section) }}">
            </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Others</label>
            <div class="input-container1">
                <input type="text" class="form-control placeholder-green-color" id="exampleFormControlInput1"
                placeholder="Mumbai">
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
                    @if( count($complain->userAdditionalDetails) != 0 )
                        @foreach($complain->userAdditionalDetails as $index => $detail)
                            <tr>
                                <td style="border-top-left-radius: 10px;border-bottom-left-radius: 10px;">
                                    <span> <a href="{{ route('preview.file',$detail->file->id) }}" target="_blank" style="color: #02AC6F;" > 
                                        <img src="{{ asset('assets/theme/image/Document.png') }}" alt="">
                                            {{ $complain->complain_no }}
                                    </a> </span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($complain->created_at)->format('d F Y') }}</td>
                                <td style="border-top-right-radius: 10px;border-bottom-right-radius: 10px;">
                                    {{ Str::limit(ucfirst($detail->description), 800) }}
                                </td>
                            </tr>
                            <tr style="height: 15px;"></tr>

                        @endforeach
                    @else
                        <tr>
                            <td colspan="3" style="text-align:center;" >No Record Found</td>
                        </tr> <tr style="height: 15px;"></tr>
                    @endif
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