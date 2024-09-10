<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Forgot password</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <?php $this->load->view('common/headlink') ?>
  <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>  -->
 
  

  
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
                <div class="card-body" style="width:400px">
                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Forgot Password</h5>
                  </div>

                  <form class="row g-3" method="post" action="<?php echo site_url("LoginController/forgotPassword_action") ?>">
                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Email </label>
                      <span class="text text-danger">*<?php echo form_error('username') ?></span>
                      <div class="input-group">
                        <input type="text" name="username" class="form-control" id="yourUsername"
                          value="<?php echo set_value('username') ?>">
                      </div>
                    </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Send Otp</button>
                    </div>
                   
                 
                  </form>
                </div>
              </div>

              <div class="credits">
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
              </div>

            </div>
          </div>
        </div>
      </section>
    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <?php $this->load->view("common/script") ?>
  <script src="<?php echo base_url(); ?>assets/js/toastr.js"></script>
  

  <script>
    toastr.options = {
      "closeButton": false,
      "debug": false,
      "newestOnTop": false,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "500",
      "hideDuration": "1000",
      "timeOut": "10000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
    <?php if ($this->session->flashdata('success')) { ?>
      toastr.success('<?php echo $this->session->flashdata('success'); ?>');
    <?php } ?>

    <?php if ($this->session->flashdata('warning')) { ?>
      toastr.warning('<?php echo $this->session->flashdata('warning'); ?>');
      console.log('Warning: <?php echo $this->session->flashdata('warning'); ?>');
    <?php } ?>

    <?php if ($this->session->flashdata('error')) { ?>
      toastr.error('<?php echo $this->session->flashdata('error'); ?>');
    <?php } ?>

    <?php if ($this->session->flashdata('info')) { ?>
      toastr.info('<?php echo $this->session->flashdata('info'); ?>');
    <?php } ?>
  </script>
</body>

</html>