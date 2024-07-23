<div class="col-md-12 grid-margin stretch-card" >
    <div class="card detail-card">

    <div class="row text-center">
        <div class="col-md-12">
            <div class="card-body" >
                <h4 class="card-title underline-css"> Nodal Uploaded Detail </h4>
            </div>
        </div>
    </div>

    <div class="row text-center" >
        <div class="col-md-12 ">
            <div class="card-body">
                <h4 class="card-title">Preliminary Report</h4>
                @if(isset($complain->preliminaryReport))
                <h5><a href="{{ route('preview.file',$complain->preliminaryReport->id) }}" target="_blank" class="text-color d-block text-truncate">View Document </a></h5>
                @else
                <h5><a href="javascript:void(0)" class="text-color d-block text-truncate">No Preliminary Report Found</a></h5>
                @endif
            </div>
        </div>
    </div>

    <!-- @if(isset($complain->preliminaryReport))
        <div class="row text-center">
            <div class="col-md-12 ">
                <div class="card-body">
                    <a href="{{ route('preview.file',$complain->preliminaryReport->id) }}" target="_blank" class="text-color d-block text-truncate">View Document
                    </a>
                </div>
            </div>
        </div>
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
    @endif -->

    <div class="row text-center">
        <div class="col-md-4 ">
            <div class="card-body">
                <h4 class="card-title">Document</h4>
            </div>
        </div>
        <div class="col-md-8 ">
            <div class="card-body">
                <h4 class="card-title">Document Description</h4>
            </div>
        </div>
    </div>

    @if( count($complain->nodalAdditionalDetails) >= 1 )

        @foreach($complain->nodalAdditionalDetails as $index => $detail)

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
                        <p class="card-description">{{ ucfirst($detail->description) }}</p>
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
