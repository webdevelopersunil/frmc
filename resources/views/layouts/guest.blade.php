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
</head>

<body>

    {{ $slot }}

  <!-- modal Create Profile -->
  <div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Create Profile</h5>
          <a href="" data-bs-dismiss="modal" aria-label="Close">
            <img src="./image/cross.png" alt="">
          </a>
        </div>
        <div class="modal-body">
          <form action="">
            <h2 class="personal-heading">Personal Information </h2>
            <div class="row" style="background-color: #fff !important;">
              <div class="col-lg-6">
                <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Name</label>
                  <div class="input-container input-container1">
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Pritam Ghosh">
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Emailid</label>
                  <div class="input-container input-container2">
                    <input type="email" class="form-control" id="exampleFormControlInput1"
                      placeholder="Example@gmail.com">
                  </div>
                </div>
              </div>
            </div>
            <h2 class="personal-heading">Contact Information </h2>
            <div class="row" style="background-color: #fff !important;">
              <div class="col-lg-6">
                <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Phone Number</label>
                  <div class="input-container">
                    <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="7776776877">
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label" style="visibility: hidden;">Emailid</label>
                  <a href="">
                    <div class="button-otp">
                      Send OTP
                    </div>
                  </a>
                </div>
              </div>
            </div>
            <div class="otp mb-3">
              <div class="row">
                <div class="col-lg-6">
                  <p style="color: #FF0000;">OTP Expires in: <span style="color: #00744A;"> 01:51</span></p>
                </div>
                <div class="col-lg-6 d-flex justify-content-end">
                  <img src="./image/cross.png" alt="" class="img-fluid" style="width: 18px;height: 18px;">
                </div>
                <div class="col-lg-6">
                  <div class="mb-3">
                    <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="Enter OTP">
                  </div>
                </div>
                <div class="col-lg-4 d-flex" style="gap: 15px;">
                  <div class="mb-3">
                    <a href="">
                      <div class="button-otp">
                        Submit OTP
                      </div>
                    </a>
                  </div>
                  <div class="mb-3">
                    <a href="">
                      <div class="button-otp" style="background: #FFC700;">
                        Resend OTP
                      </div>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="otp">
              <div class="row">
                <div class="col-lg-6">
                  <p style="color: #FF0000;">OTP Expires in: <span style="color: #00744A;"> 01:51</span></p>
                </div>
                <div class="col-lg-6 d-flex justify-content-end">
                  <img src="./image/cross.png" alt="" class="img-fluid" style="width: 18px;height: 18px;">
                </div>
                <div class="col-lg-6">
                  <div class="mb-3">
                    <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="Enter OTP">
                  </div>
                </div>
                <div class="col-lg-4 d-flex" style="gap: 15px;">
                  <div class="mb-3">
                    <div class="button-otp">
                      <a href="">Submit OTP</a>
                    </div>
                  </div>
                  <div class="mb-3">
                    <div class="button-otp" style="background: #FFC700;">
                      <a href="">Resend OTP</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <h2 class="personal-heading">Others</h2>
            <div class="row" style="background-color: #fff !important;">
              <div class="col-lg-6">
                <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Date Of Birth</label>
                  <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="24/04/2001">
                </div>
              </div>
              <div class="col-lg-6"></div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Flat,House No, Building,Company</label>
                  <div class="input-container input-container3">
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Mumbai">
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Area , Street, Sector, Village</label>
                  <div class="input-container input-container3">
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Mumbai">
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Landmark</label>
                  <div class="input-container input-container3">
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Mumbai">
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Town/City</label>
                  <div class="input-container input-container3">
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Mumbai">
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">State</label>
                  <div class="input-container input-container3">
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Mumbai">
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Pin Code</label>
                  <div class="input-container1">
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter Pin Code">
                  </div>
                </div>
              </div>
            </div>
            <p class="modal-bottom-text">By creating an account , You agree to the <a href=""
                style="color: #08AF73;">Terms of service</a> & <a href="" style="color: #08AF73;">Privacy Policy</a>.
            </p>

          </form>
        </div>
        <div class="modal-footer justify-content-center" style="padding-top: 0;">
          <a href="">
            <div class="button-otp">
              Save
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- modal 2 Confirm OTP -->
  <div class="modal" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirm OTP</h5>
          <a href="" data-bs-dismiss="modal" aria-label="Close">
            <img src="./image/cross.png" alt="">
          </a>
        </div>
        <div class="modal-body">
          <p style="font-size: 20px;">Please enter OTP , sent on your mobile number</p>
          <form action="">
            <div class="otp mb-3">
              <div class="row">
                <div class="col-lg-12">
                  <p style="color: #FF0000;">OTP Expires in: <span style="color: #00744A;"> 01:51</span></p>
                </div>
                <div class="col-lg-6">
                  <div class="mb-3">
                    <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="Enter OTP">
                  </div>
                </div>
                <div class="col-lg-4 d-flex" style="gap: 15px;">
                  <div class="mb-3">
                    <a href="Complainant.html">
                      <div class="button-otp">
                        Submit OTP
                      </div>
                    </a>
                  </div>
                  <div class="mb-3">
                    <a href="">
                      <div class="button-otp" style="background: #FFC700;">
                        Resend OTP
                      </div>
                    </a>
                  </div>
                </div>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>