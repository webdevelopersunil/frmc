@php
    $currentRoute = Route::currentRouteName();
@endphp

<div class="col-lg-3" style="position: relative;background: linear-gradient(0deg, #EC9A9B, #EFFFF6);">
    <div class="top-logo-img">
        <img src="{{ asset('assets/theme/image/logo.png') }}" alt="" class="img-fluid" style="width: 167px;">
    </div>
    <div class="com-button-left-img" style="position: absolute;left: 0;top: 248px;">
        <img src="{{ asset('assets/theme/image/complainant left img.png') }}" alt="">
    </div>
    

    <!-- User Links -->
    @if(auth()->user()->hasRole('user'))
        <div class="com-button" style="position: absolute;right: 0;top: 248px; background:{{ Route::is('user.dashboard') ? '' : 'none' }}; ">
            <a href="{{ route('user.dashboard') }}" style="text-decoration: none; color: #000; /* Change color to your preference */" alt="">
                <span style="font-size: 20px;">Complaint List</span>
            </a>
        </div>
    @endif
    <!-- User Links -->


    <!-- Nodal Officer Links -->
    @if(auth()->user()->hasRole('nodal'))
        <div class="com-button" style="position: absolute;right: 0;top: 150px; background:{{ Route::is('nodal.dashboard') ? '' : 'none' }}; ">
            <a href="{{ route('nodal.dashboard') }}" style="color: #000;"><img src="{{ asset('assets/theme/image/Content.png') }}" alt="">
                <span style="font-size: 20px;">Dashboard</span>
            </a>
        </div>

        <div class="com-button" style="position: absolute;right: 0;top: 248px; background:{{ Route::is('nodal.complaints') ? '' : 'none' }};">
            <a href="{{ route('nodal.complaints') }}" style="color: #000;"><img src="{{ asset('assets/theme/image/Content.png') }}"  alt="">
                <span style="font-size: 20px;">Complaint List</span>
            </a>
        </div>
    @endif
    <!-- Nodal Officer Links -->



    <!-- Nodal Officer Links -->
    @if(auth()->user()->hasRole('fco'))
        <div class="com-button" style="position: absolute; right: 0; top: 150px;  background:{{ Route::is('fco.dashboard') ? '' : 'none' }}; ">
            <a href="{{ route('fco.dashboard') }}" style="color: #000;"><img src="{{ asset('assets/theme/image/Content.png') }}" alt="">
                <span style="font-size: 20px;">Dashboard</span>
            </a>
        </div>

        <div class="com-button" style="position: absolute;right: 0;top: 248px; background:{{ Route::is('fco.complaints') ? '' : 'none' }}; ">
            <a href="{{ route('fco.complaints') }}" style="color: #000;"><img src="{{ asset('assets/theme/image/Content.png') }}"  alt="">
                <span style="font-size: 20px;">Complaint List</span>
            </a>
        </div>
    @endif
    <!-- Nodal Officer Links -->


    <div class="down-img">
        <img src="{{ asset('assets/theme/image/complainant left down img.png') }}" alt="">
    </div>
</div>
