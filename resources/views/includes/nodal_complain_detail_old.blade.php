<div class="col-md-12 grid-margin stretch-card" >
    <div class="card">

    <div class="row text-center">
        <div class="col-md-12">
            <div class="card-body" >
                <h4 class="card-title underline-css"  > Nodal Uploaded Detail </h4>
            </div>
        </div>
    </div>

    <div class="row text-center" >
        <div class="col-md-12 ">
            <div class="card-body">
                <h4 class="card-title">Preliminary Report</h4>
            </div>
        </div>
    </div>

    @if(isset($complain->preliminaryReport))
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
                    <div class="alert alert-primary" role="alert">
                        No Documents Found
                    </div>
                </div>
            <div class="col-md-1"></div>
        </div>
    @endif

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

            <div class="row text-center">
                <div class="col-md-4 ">
                    <div class="card-body">
                        <!-- <h4 class="card-title">Document</h4> -->
                        <a href="{{ route('preview.file',$detail->file->id) }}" target="_blank" class="text-color d-block text-truncate"> 
                        <span> #{{$index+1}}</span>  View Document
                        </a>
                    </div>
                </div>
                <div class="col-md-8 ">
                    <div class="card-body">
                        <!-- <h4 class="card-title">Document Description</h4> -->
                        <p class="card-description">{{$detail->description}}</p>
                    </div>
                </div>
            </div>

        @endforeach
    @else
        <div class="row text-center">
            <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="alert alert-primary" role="alert">
                        No Documents Found
                    </div>
                </div>
            <div class="col-md-1"></div>
        </div>
    @endif
    </div>
</div>




<!-- Modal -->
<div class="modal fade" id="showMoreModal" tabindex="-1" role="dialog" aria-labelledby="showMoreModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showMoreModalLabel">Full Description</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body  ">
                <p>{{ $complain->description }}</p>
            </div>
        </div>
    </div>
</div>