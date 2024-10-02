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
        
</div>


<div class="row padding-30px">
    <div class="col-lg-12" style="background: #02AC6F;padding: 15px;border-radius: 13px;color: #fff;">
        <p class="text-center description-part">Description of Complaint</p>
        <hr>
        <p class="text-center">
            @if( $complain->description == "" )
                {{ __('No Description Found') }}
            @elseif(strlen($complain->description) > 800)
                
                <span class="description-truncated">
                    <!-- Display the first 800 characters -->
                    {{ Str::limit(ucfirst($complain->description), 800) }}
                </span>
                <span class="description-content" style="display: none;">
                    <!-- Display the full description -->
                    {{ ucfirst($complain->description) }}
                </span>
                <a href="javascript:void(0);" id="toggle-description" class="text-color" style="color:black;">. ..See More</a>

            @else
            
                {{ $complain->description }}

            @endif

        </p>
    </div>
</div>


<div class="row padding-30px">
    <div class="col-lg-4">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">ONGC Work Centre</label>
            <div class="input-container1">
                <input type="text" class="form-control placeholder-green-color" readonly id="exampleFormControlInput1" placeholder="{{ ucfirst($complain->workCenter->name) }}">
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Department/Section</label>
            <div class="input-container1">
                <input type="text" readonly class="form-control placeholder-green-color" id="exampleFormControlInput1"
                placeholder="{{ ucfirst($complain->centerDepartment->name) }}">
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Others</label>
            <div class="input-container1">
                <input type="text" class="form-control placeholder-green-color" id="exampleFormControlInput1" disabled readonly placeholder="{{ ucfirst($complain->other_section) }}" >
            </div>
        </div>
    </div>
</div>

<div class="row padding-30px" style="padding-top: 5px;padding-bottom: 5px;">
    <div class="col-lg-3">
        <p>Complaint Status</p>
        <p style="color: #02AC6F;">{{ ucfirst($complain->ComplaintStatus->name) }}</p>
    </div>
    <div class="col-lg-4">
        <p>ONGC Comments</p>
        <p style="color: #02AC6F;"> {{ $complain->public_status ? ucfirst($complain->public_status) : __('---') }} </p>
    </div>
</div>



<div class="accordion col-lg-12" id="accordionExample">
    <div class="accordion-item mb-3">
        <h2 class="accordion-header">
        <button class="accordion-button" type="button" data-bs-toggle="collapse"
            style="background: #02AC6F; color: #fff;" data-bs-target="#collapseThree" aria-expanded="true"
            aria-controls="collapseThree">
            User Uploaded Document's
        </button>
        </h2>
        <div id="collapseThree" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                
                <div class="col-lg-12">
                    <table class="table complainant-view-table">
                        <thead>
                            <tr>
                                <th style="text-align:center;" >Documents</th>
                                <th style="text-align:center;" >Upload Date & Time</th>
                                <th style="text-align:center;" >Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if( count($complain->userAdditionalDetails) != 0 )
                                @foreach($complain->userAdditionalDetails as $index => $detail)
                                <tr style="text-align:center;" >
                                    <td style="border-top-left-radius: 10px;border-bottom-left-radius: 10px; width: 150px;">
                                        <span>
                                            <a href="{{ route('preview.file',$detail->file->id) }}" target="_blank" style="color: #02AC6F;">
                                                <img src="{{ asset('assets/theme/image/Document.png') }}" alt="">
                                                {{ $complain->complain_no }}
                                            </a>
                                        </span>
                                    </td>
                                    <td style="width: 200px; text-align:center; ">
                                        {{ \Carbon\Carbon::parse($detail->created_at)->format('d F Y, h:i A') }}
                                    </td>
                                    <td style="border-top-right-radius: 10px;border-bottom-right-radius: 10px; width: 500px; text-align:center; ">
                                        {{ Str::limit(ucfirst($detail->description), 800) }}
                                    </td>
                                </tr>
                                <tr style="height: 15px;"></tr>

                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3" style="text-align:center;" >No Record Found</td>
                                </tr>
                                <tr style="height: 15px;"></tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleLink = document.getElementById('toggle-description');
    const fullDescription = document.querySelector('.description-content');
    const truncatedDescription = document.querySelector('.description-truncated');

    // Check if the elements exist
    if (!toggleLink || !fullDescription || !truncatedDescription) {
        console.error('Missing elements for toggling description');
        return;
    }

    // Initially hide the full description and show only truncated description
    fullDescription.style.display = 'none';

    // Handle click event to toggle description
    toggleLink.addEventListener('click', function(event) {
        event.preventDefault();

        if (fullDescription.style.display === 'none') {
            // Show full description and change link text
            fullDescription.style.display = 'inline';
            truncatedDescription.style.display = 'none';
            toggleLink.textContent = '. ..See Less';
        } else {
            // Show truncated description and change link text
            fullDescription.style.display = 'none';
            truncatedDescription.style.display = 'inline';
            toggleLink.textContent = '. ..See More';
        }
    });
});
</script>
