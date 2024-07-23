<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  
  <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="csrf-token" content="{{ csrf_token() }}">

      <title>{{ config('app.name', 'FRMC') }}</title>

      @vite(['resources/css/app.css', 'resources/js/app.js'])
      <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
      <link rel="stylesheet" href="{{ asset('assets/vendors/feather/feather.css') }}">
      <link rel="stylesheet" href="{{ asset('assets/css/vertical-layout-light/style.css') }}">
      
      <link rel="stylesheet" href="{{ asset('assets/css/custom-table.css') }}">
      <!-- Themify Icon -->
        <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
      <!-- Themify Icon -->
  </head>

<body>

  <div class="container-scroller">

    @include('includes/navbar') <!-- Start Navigation Bar -->
    
    <div class="container-fluid page-body-wrapper">

        @include('includes/sidebar')<!-- Start Sidebar Menu List -->
      
      <div class="main-panel">
        
        {{ $slot }} <!-- Start Page Content -->
        
        @include('includes/footer') <!-- Start Footer Content -->

      </div> <!-- main-panel ends -->      
    </div> <!-- page-body-wrapper ends -->
  </div>

    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>
    
</body>
</html>