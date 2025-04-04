<x-app-layout>

<style>
    .nav-tabs .nav-link { color: #333; border-radius: 6px; }
    .nav-tabs { border-bottom: 0px solid #dee2e6; }
    .active { background: #28a745 !important; color: white !important; border: 1px solid #28a745 !important; }
</style>
    
    <div class="col-lg-12">
        <div class="row p-4" style="background: #fff; margin: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
            <div class="col-lg-12">


                <ul class="nav nav-tabs" >
                    <li class="nav-item">
                        <a class="nav-link @if($coll['active'] == 'registration-form') active @endif" data-toggle="tab" href="{{ route('user.manage.index', ['type' => 'registration-form']) }}">
                            Registration Form
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if($coll['active'] == 'revoke-access') active @endif" data-toggle="tab" href="{{ route('user.manage.index', ['type' => 'revoke-access']) }}">
                            Revoke Nodal Officer Access
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if($coll['active'] == 'delegate-complaints') active @endif" data-toggle="tab" href="{{ route('user.manage.index', ['type' => 'delegate-complaints']) }}">
                            Delegate Complaints to Another Nodal Officer
                        </a>
                    </li>
                </ul>


            </div>
        </div>
    </div>
            
    @include('includes/message-block')

    <div class="col-lg-12">
        <div class="row p-4" style="background: #fff; margin: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
            
            @include($coll['page'])

        </div>
    </div>

</x-app-layout>