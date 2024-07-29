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
                
                <!-- Start Page Content -->
                    {{ $slot }}
                <!-- End Page Content -->

            </div>
        </div>
    </div>
</div>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"  integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

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

</body>
</html>