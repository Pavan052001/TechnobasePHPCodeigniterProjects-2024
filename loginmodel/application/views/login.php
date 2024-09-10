<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Pages / Login - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?php echo base_url(); ?>assets/img/favicon.png" rel="icon">
  <link href="<?php echo base_url(); ?>assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <?php $this->load->view("common/headlink"); ?>

  <!-- Template Main CSS File -->
  <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/css/toastr.css" rel="stylesheet">


</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="<?php echo base_url(); ?>assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block">NiceAdmin</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body" style="width:450px">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                    <p class="text-center small">Enter your username & password to login</p>
                  </div>

                  <form class="row g-3 " action="<?php echo site_url("LoginController/loginAction") ?>" method="post">

                    <div class="col-12">
                      <div class="d-flex">
                        <label for="yourUsername" class="form-label">Username</label>
                        <span class="text text-danger d-flex">* &nbsp;<?php echo form_error("username") ?></span>
                      </div>

                      <input type="text" name="username" class="form-control" id="yourUsername"
                        value="<?php echo set_value("username") ?>">

                    </div>

                    <div class="col-12" style="position: relative;">
                    <div class="d-flex">
                      <label for="yourPassword" class="form-label">Password</label>
                     
                      <span class="text text-danger d-flex">* &nbsp;<?php echo form_error("password") ?></span>
                      </div>
                      <input type="password" name="password" class="form-control" id="yourPassword">
                      <span id="togglePassword"
                        style="position: absolute; right: 17px; top: 50%; transform: translateY(-50%); cursor: pointer; display: none; margin-top:15px">
                        <i class="fa fa-eye" id="eyeIcon"></i>
                      </span>
                     
                    </div>


                    <div class="col-12 mb-3">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                        <a style="margin-left:150px"
                          href="<?php echo site_url("LoginController/forgotpassword") ?>"><i>forgot password</i></a>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Login</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Don't have account? <a
                          href="<?php echo site_url("LoginController/register") ?>">Create an account</a></p>
                    </div>
                  </form>

                </div>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->

  <?php $this->load->view("common/script") ?>

  <!-- Template Main JS File -->
  <script src="<?php echo base_url(); ?>assets/js/main.js"></script>

  <script src="<?php echo base_url(); ?>assets/js/toastr.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


  <script>
    const passwordField = document.getElementById('yourPassword');
    const togglePassword = document.getElementById('togglePassword');

    passwordField.addEventListener('input', function () {
      if (passwordField.value.length > 0) {
        togglePassword.style.display = 'inline';
      } else {
        togglePassword.style.display = 'none';
      }
    });

    togglePassword.addEventListener('click', function () {
      // Toggle the type attribute between 'password' and 'text'
      const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordField.setAttribute('type', type);

      // Toggle the eye slash icon
      const eyeIcon = document.getElementById('eyeIcon');
      eyeIcon.classList.toggle('fa-eye-slash');
    });

  </script>

  <script>
    $(document).ready(function(){
    $("#email").on('input', function(){
        var email = $(this).val();
        var errorMsg = "Please enter a valid email address.";
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        // Clear previous error message
        $("#email-error").text("");

        // Check if the input is a valid email format
        if(!emailPattern.test(email)){
            $("#email-error").text(errorMsg);
        }
    });
});


  </script>

</body>

</html>