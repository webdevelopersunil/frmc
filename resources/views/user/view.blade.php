<x-app-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="content-wrapper">  
      <div class="row">
        <div class="card-body">
          <div class="d-flex justify-content-end mb-3">
              <a class="btn add-btn" href="{{ route('user.complaints') }}"> Go Back</a>
          </div>
        </div>
        @include('includes/complain_detail')
      </div>
    </div>
       
</x-app-layout>