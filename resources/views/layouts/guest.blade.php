<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> {{ config('app.name', 'Laravel') }} </title>
    <!-- @vite(['resources/css/app.css', 'resources/js/app.js']) -->
  <link rel="shortcut icon" href="https://cdn.samco.in/images/nuovo//nifty-500/INE213A01029.png" />
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/guest-style.css') }}">
  <style>
    .bg-pic {
        background-image: url("{{ asset('assets/images/bg/4.jpg') }}");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat; 
    }
  </style>
</head>

<body>
    <div class="login-root bg-pic" >
        <div class="box-root flex-flex flex-direction--column" style="min-height: 100vh;flex-grow: 1;">
            <div class="box-root padding-top--24 flex-flex flex-direction--column" style="flex-grow: 1; z-index: 9;">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>

</html>