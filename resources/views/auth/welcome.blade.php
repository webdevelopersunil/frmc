<x-guest-layout>
  
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div id="welcomepage">
        <div class="container" style="height: 100%;">
            <div class="row row-back" style="height: 100%;">
                <div class="col-lg-6" style="height: 100%;position: relative;padding: 0 !important;">
                    <img src="{{ asset('assets/theme/image/welcome page image.png') }}" alt="" class="img-fluid welcome-img1">
                    <img src="{{ asset('assets/theme/image/logo.png') }}" alt="" class="img-fluid logo-img">
                </div>
                <div class="col-lg-6" style="position: relative;">
                    <h1 class="heading">Welcome to Fraud<br> Prevention Policy Portal</h1>
                    <h2 class="sub-heading">Login as a</h2>
                    <div class="button" style="margin-bottom: 120px;">
                        <a href="{{ route('login') }}" class="btn1">Complainant</a>
                        <a href="{{ route('admin') }}" class="btn1">Admin</a>
                    </div>
                    <!-- <p class="para">Mobile Number Not Registered ? <a href="" class="register"> Register now</a></p> -->
                    <div class="button down-button">
                        <a href="" class="btn1 btn2">Sitemap</a>
                        <!-- <a href="" class="btn1 btn2">Privacy & Policy</a> -->
                        <a href="" class="btn1 btn2">Terms Of Use</a>
                        <a href="" class="btn1 btn2">Privacy & Policy</a>
                    </div>
                    <img src="{{ asset('assets/theme/image/welcome page bottom image.png') }}" alt="" class="img-fluid bottom-img">
                </div>
            </div>
        </div>
    </div>

</x-guest-layout>