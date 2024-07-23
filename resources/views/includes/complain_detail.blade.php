<div class="col-md-12 grid-margin stretch-card " >
    <div class="card detail-card">

    <div class="row text-center">
        <div class="col-md-12">
            <div class="card-body" >
                <h4 class="card-title underline-css"  > Complaint Detail </h4>
            </div>
        </div>
    </div>
    
    <div class="row text-center">

        <div class="col-md-3">
            <div class="card-body">
                <h4 class="card-title"> Complaint Number </h4>
                <label class="complain-no" >{{ $complain->complain_no }}</label>
            </div>
        </div>
        <div class="col-md-3">
        <div class="card-body">
            <h4 class="card-title"> Department/Section </h4>
            <label class="card-description"> {{ ucfirst($complain->department_section) }} </p>
        </div>
        </div>
        <div class="col-md-3">
        <div class="card-body">
            <h4 class="card-title"> ONGC Work Centre </h4>
            <p class="card-description"> {{ ucfirst($complain->work_centre) }} </p>
        </div>
        </div>
        <div class="col-md-3">
            <div class="card-body">
                <h4 class="card-title"> Against Whom </h4>
                <p class="card-description">{{ ucfirst($complain->against_persons) }}</p>
            </div>
        </div>
    </div>

    <div class="row text-center ">
        <div class="col-md-12">
            <div class="card-body ">
                <h4 class="card-title">Description of Complaint</h4>
                <p class="card-description complain-detail-description" id="complaintDescription">
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
    </div>

    <div class="row text-center">
        <div class="col-md-4 ">
            <h4 class="card-title">Document</h4>
        </div>
        <div class="col-md-8 ">
            <h4 class="card-title">Document Description</h4>
        </div>
    </div>

    @if( count($complain->userAdditionalDetails) >= 1 )
        @foreach($complain->userAdditionalDetails as $index => $detail)
            <div class="row text-center loop-document-detail">
                <div class="col-md-4 ">
                    <div class="card-body">
                        <a href="{{ route('preview.file',$detail->file->id) }}" target="_blank" class="text-color d-block text-truncate"> 
                        <span> #{{$index+1}}</span>  View Document
                        </a>
                    </div>
                </div>
                <div class="col-md-8 ">
                    <div class="card-body">
                        <p class="card-description ">{{ Str::limit(ucfirst($detail->description), 800) }}
                            @if(strlen($detail->description) > 800)
                                &nbsp;&nbsp;<a href="#" class="text-color">see more</a>
                            @endif
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="row text-center">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="alert text-css404" role="alert">
                    No Documents Found
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
    @endif
    </div>
</div>