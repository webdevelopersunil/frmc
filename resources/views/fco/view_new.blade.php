<x-app-layout>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="content-wrapper">

        <div class="d-flex justify-content-end mb-3">
            <a class="btn btn-primary" href="{{ route('fco.complaints') }}"> Go Back</a>
        </div>

        <div class="row">

            @include('includes/complain_detail')

            @include('includes/nodal_complain_detail')
            
            @include('includes/fco_complain_detail')

        </div>

    </div>

</x-app-layout>