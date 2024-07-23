<div class="col-md-12 grid-margin stretch-card" >
    <div class="card">

    <div class="row text-center">
        <div class="col-md-12">
            <div class="card-body" style="border-bottom: 1px solid blue;" >
                <h4 class="card-title"  > FCO Uploaded Detail </h4>
            </div>
        </div>
    </div>

    <div class="row text-center" >
        <div class="col-md-6 ">
            <div class="card-body">
                <h4 class="card-title">Complaint Status</h4>
            </div>
        </div>
        <div class="col-md-6 ">
            <div class="card-body">
            {{$complain->complaint_status}}
            </div>
        </div>
    </div>

    <div class="row text-center">
        <div class="col-md-6 ">
            <div class="card-body">
                <h4 class="card-title">Public – Visible to all users</h4>
            </div>
        </div>
        <div class="col-md-6 ">
            <div class="card-body">
                <h4 class="card-title">Private – Visible to only the users associated with the office of FCO</h4>
            </div>
        </div>
    </div>

    <div class="row text-center">
        <div class="col-md-6 ">
            <div class="card-body">
                <h6>
                    {{ isset($detailedStatus->public) ? '1. '.ucfirst($detailedStatus->public) : '' }}
                </h6>
            </div>
        </div>
        <div class="col-md-6 ">
            <div class="card-body">
                <h6 class="card-body">
                    {{ isset($detailedStatus->private) ? '1. '.ucfirst($detailedStatus->private) : ''}}
                </h6>
            </div>
        </div>
    </div>

    <!-- <div class="row text-center">
        <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="alert alert-primary" role="alert">
                    No Documents Found
                </div>
            </div>
        <div class="col-md-1"></div>
    </div> -->
    

    </div>
</div>