<x-guest-layout>

    <x-auth-session-status class="mb-4" :status="session('status')" />


    <div id="welcomepage">
        <div class="container">
            <div class="row" style="height: 100%;">
                <div class="col-lg-6" style="height: 100%;position: relative;padding: 0 !important;">
                    <img src="{{ asset('assets/theme/image/boat 1.png') }}" alt="" class="img-fluid welcome-img">
                    <img src="{{ asset('assets/theme/image/logo.png') }}" alt="" class="img-fluid logo-img">
                </div>
                <div class="col-lg-6" style="position: relative;">
                    <h1 class="heading login">Welcome</h1>
                    
                    <div class="row welcome-log-in">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">CPF Number</label>
                                <div class="input-container1">
                                    <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="9744448548252">
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <div class="password-label d-flex justify-content-between">
                                    <label for="exampleFormControlInput1" class="form-label">Password</label>
                                    <label for="exampleFormControlInput1" class="form-label" style="color: #A93034;text-decoration: underline;">Forgot your password ?</label>
                                </div>
                                <div class="input-container1 d-flex" style="position: relative;">
                                    <span class="input-group-text" style="position: absolute;top: 0;left: 0;height: 100%;background: transparent;border: none;">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                    <input style="padding-left: 40px;" class="form-control" id="password" name="password" placeholder="Password" value="">
                                    <span class="input-group-text" style="position: absolute;top: 0;right: 0;height: 100%;background: transparent;border: none;">
                                        <i class="fa fa-eye" id="togglePassword" style="cursor: pointer"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Remember me
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="log-in-button">
                        <a href="nodal dashnoard.html" class="btn4">Login</a>
                    </div>
                    <!-- <p class="para">Mobile Number Not Registered ? <a href="" class="register" data-bs-toggle="modal" data-bs-target="#exampleModal"> Register now</a></p> -->
                    
                    <img src="{{ asset('assets/theme/image/welcome page bottom image.png') }}" alt="" class="img-fluid bottom-img">
                    
                    <div class="button" style="margin: 120px 0;">
                        <a href="{{ route('welcome') }}" class="btn1">Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/5cac7ad27a.js" crossorigin="anonymous"></script>
    
    <script>
      const togglePassword = document.querySelector("#togglePassword");
      const password = document.querySelector("#password");

      togglePassword.addEventListener("click", function () {
        // toggle the type attribute
        const type = password.getAttribute("type") === "password" ? "text" : "password";
        password.setAttribute("type", type);
        // toggle the eye icon
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
      });
    </script>

</x-guest-layout>