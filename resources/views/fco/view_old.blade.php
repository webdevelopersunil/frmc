<x-app-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="content-wrapper">
          <div class="row">

          <div class="card-body">
            <!-- <h4 class="card-title">Complaint Detail</h4> -->
            <div class="d-flex justify-content-end mb-3">
                <a class="btn btn-primary add-btn" href="{{ route('fco.complaints') }}"> Go Back</a>
            </div>
          </div>

            @include('includes/complain_detail')
            @include('includes/nodal_complain_detail')

          </div>
        </div>
</x-app-layout>