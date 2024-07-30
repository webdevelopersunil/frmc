@if($errors->any())
    <div class="mt-3 alert alert-primary alert-dismissible fade show" role="alert" style="background-color:#ffa4a4;" id="alert-errors">
        <span class="alert-text text-black">
            {{$errors->first()}}
        </span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <i class="fa fa-close" aria-hidden="true"></i>
        </button>
    </div>
@endif

@if(session('success'))
    <div class="m-3 alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
        <span class="alert-text text-black">
            {{ session('success') }}
        </span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <i class="fa fa-close" aria-hidden="true"></i>
        </button>
    </div>
@endif

@if(session('error'))
    <div class="m-3 alert alert-danger alert-dismissible fade show" id="alert-error" role="alert" style="background-color:#ffa4a4;">
        <span class="alert-text text-black">
            {{ session('error') }}
        </span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <i class="fa fa-close" aria-hidden="true"></i>
        </button>
    </div>
@endif

<script>
    // Hide the alert messages after 3 seconds
    setTimeout(function(){
        document.getElementById('alert-errors').style.display = 'none';
        document.getElementById('alert-success').style.display = 'none';
        document.getElementById('alert-error').style.display = 'none';
    }, 3000);
</script>
