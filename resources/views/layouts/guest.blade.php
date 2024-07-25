<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <!-- Custom Css and Responsive Css -->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/theme/css/style.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/theme/css/responsive/style.css') }}">
  
  <title> {{ config('app.name', 'Laravel') }} </title>

  <style>
    .error-text {
    color: red;
    font-weight: bold;
    margin-top: 8px; /* Adjust the margin as needed */
}

  </style>
</head>

<body>

    {{ $slot }}


  
  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

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



  document.addEventListener('DOMContentLoaded', () => {  
      appendAsterisk();
      hideErrorMessage();
  });
    
</script>
  

</body>
</html>