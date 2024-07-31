<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'FRMC') }}</title>
        
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/theme/css/style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/theme/css/responsive/style.css') }}">
    </head>

<body>


<div id="complainant">
    <div class="container">
        <div class="row">

            <!-- Sidebar Start -->
            @include('includes.sidebar')
            <!-- Sidebar End -->

            <div class="col-lg-9" style="background: #F5F6F8;border-radius: 38px;">
                <div class="row top-heading padding-30px">
                    <div class="col-lg-6 d-flex align-items-center">
                        <h1 class="complainant-heading">Your Registered Complaints</h1>
                    </div>
                    <div class="col-lg-6 d-flex justify-content-end" style="gap: 25px;">
                        <div class="bell">
                            <a href=""><img src="{{ asset('assets/theme/image/Notification.png') }}" alt="" class="img-fluid"></a>
                            <p class="show-notification">2</p>
                        </div>
                    <div class="profile">
                        <img src="./image/profile.png" alt="" class="img-fluid">
                    </div>

                    <!-- Profile DropDown Button -->
                    <div class="profile-name d-flex justify-content-center align-items-center" style="gap: 10px;">
                        <a href="javascript:void(0)" class="d-flex justify-content-center align-items-center" style="gap: 10px;">
                            <h2 class="profile-name">Profile</h2>
                            <img src="{{ asset('assets/theme/image/down arrow.png') }}" alt="">
                        </a>
                        <div class="dropdown-menu">
                            <ul class="dropdown-list">
                                <li><a href="{{ route('profile.edit') }}">Edit Profile</a></li>
                                <li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    <a href="#" onclick="document.getElementById('logout-form').submit(); return false;">Logout</a>
                                    
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
                
            <!-- Start Page Content -->
                {{ $slot }}
            <!-- End Page Content -->

            </div>
        </div>
    </div>
</div>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"  integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


<link rel="stylesheet" type="text/css" href="{{ asset('assets/theme/css/responsive/style.css') }}">

<!-- <script src="{{ asset('assets/theme/js/responsive/script.js') }}"></script> -->


<script>
    const errorElements = document.querySelectorAll('.x-input-error');
        errorElements.forEach(element => {
            setTimeout(() => {
                element.style.display = 'none';
            }, 2000);
    });
  
    function appendAsterisk() {
        const labels = document.querySelectorAll('.redStar');
        labels.forEach(label => {
            const asterisk = document.createElement('span');
            asterisk.style.color = 'red';
            asterisk.textContent = ' *';
            label.appendChild(asterisk);
        });
    }

    function hideErrorMessages() {
        const errorElements = document.querySelectorAll('.err_mdy');
        errorElements.forEach(element => {
            setTimeout(() => {
                element.style.display = 'none';
            }, 3000);
        });
    }

  document.addEventListener('DOMContentLoaded', () => {  
      appendAsterisk();
      hideErrorMessages();
  });
    
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const profileName = document.querySelector('.profile-name');
        const dropdownMenu = document.querySelector('.dropdown-menu');

        profileName.addEventListener('click', function() {
            dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
        });
    });
</script>

</body>
</html>