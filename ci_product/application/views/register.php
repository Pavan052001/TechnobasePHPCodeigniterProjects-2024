<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Register</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- head links -->

  <?php $this->load->view('common/headlink') ?>

  <link href="<?php echo base_url() ?>assets/css/style.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/css/toastr.css" rel="stylesheet">

  <style>
    label{
      margin-bottom: 30px;
    }
  </style>
  
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8 col-md-8 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="<?php echo base_url();?>assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block">User</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Create an User Account</h5>
                    <p class="text-center small">Enter your personal details to create account</p>
                  </div>

                  <form class="row g-3" action="<?php echo site_url('LoginController/registerAction');?>" method="post" enctype="multipart/form-data">

                    <div class="col-12">
                      <div class="d-flex">
                      <label class="" for="yourName" class="form-label">Name&nbsp;</label>
                      <span class="text text-danger d-flex">*&nbsp; <?php echo form_error('name');?> </span>
                      
                      </div>
                      <input type="text" name="name" class="form-control" id="yourName">
                    </div>

                    <div class="col-12">
                      <div class="d-flex">
                      <label for="yourEmail" class="form-label">Email&nbsp;</label>
                      <span class="text text-danger d-flex">* &nbsp;<?php echo form_error('email');?></span>
                      </div>
                      
                      <input type="email" name="email" class="form-control" id="yourEmail">
                      <!-- <div class="invalid-feedback">Please enter a valid Email address!</div> -->
                    </div>

                    <div class="col-12">
                      <div class="d-flex">
                      <label for="yourPassword" class="form-label">Password&nbsp;</label>
                      <span class="text text-danger d-flex">*&nbsp; <?php echo form_error('password');?></span>
                      </div>
                      
                      <input type="password" name="password" class="form-control" id="yourPassword">
                      <!-- <div class="invalid-feedback">Please enter your password!</div> -->
                    </div>

                    <div class="col-12">
                      <div class="d-flex">
                      <label for="confirmPassword" class="form-label">Confirm Password&nbsp;</label>
                      <span class="text text-danger d-flex">*&nbsp; <?php echo form_error('confirm_password');?></span>
                      </div>
                      
                      <input type="password" name="confirm_password" class="form-control" id="confirmPassword">
                      <!-- <div class="invalid-feedback">Please confirm your password!</div> -->
                    </div>
                    <div class="col-12">
                      <div class="d-flex">
                      <label for="mobile" class="form-label">Mobile&nbsp;</label>
                  <span class="text text-danger d-flex">*&nbsp; <?php echo form_error('mobile'); ?>
                  </span>
                      </div>
                  
                  <input type="number" class="form-control"
                  value="<?php echo set_value('mobile')?>"  name="mobile">
                </div>
                <div class="col-12">
                  <div class="d-flex">
                  <label for="inputAddress" class="form-label">Address&nbsp;</label>
                  <span class="text text-danger d-flex">*&nbsp; <?php echo form_error('address'); ?>
                  </span>
                  </div>
                  
                  <input type="text" class="form-control"
                  value="<?php echo set_value('address')?>" 
                   name="address" id="inputAddress" placeholder="1234">
                </div>
                




                <div class="col-12">
                  <div class="d-flex">
                  <label for="inputDate" class="form-label">Date of birth&nbsp;</label>
                  <span class="text text-danger d-flex">*&nbsp; <?php echo form_error('date') ?></span>
                  </div>
                  
                    <div class="col-sm-10">
                      <input type="date" name="date"
                      value="<?php echo set_value('date')?>" 
                       class="form-control">
                    </div>
                </div>
                <div class="col-12">
                  <label for="image" class="form-label">Upload Profile</label>
                  <span class="text text-danger">* <?php echo form_error('image') ?>
                    <input type="file" class="form-control" name="image" id="image" placeholder="1234">
                </div>

                <div class="col-12 mb-3">
                  <div class="d-flex">
                  <legend class="col-form-label col-sm-2 pt-0">hobbies :&nbsp;</legend>
                  <span class="text text-danger d-flex">*&nbsp; <?php echo form_error('hobby[]')?></span>
                  </div>
                  
                  <div class="col-12">

                    <input class="form-check-input" type="checkbox" value="singing" id="gridCheck2" name="hobby[]">
                    singing
                    <input class="form-check-input" type="checkbox" value="playing" id="gridCheck2" name="hobby[]">
                    playing
                    <input class="form-check-input" type="checkbox" value="dancing" id="gridCheck2" name="hobby[]">
                    dancing


                  </div>
                </div>

                
                <div class="col-12">
                  <div class="d-flex">
                  <label for="inputDate" class="form-label">gender :&nbsp;</label>
                  <span class="text text-danger d-flex">*&nbsp; <?php echo form_error('gender') ?></span>
                  </div>
                  

                  <input class="form-check-input" type="radio" name="gender" id="gridRadios1" value="male">
                  <label class="form-check-label me-2" for="gender">
                    male
                  </label>

                  <input class="form-check-input" type="radio" name="gender" id="gridRadios2" value="female">
                  <label class="form-check-label" for="gridRadios2">
                    female
                  </label>
                </div>

                    <div class="col-12">
                      <div class="form-check">
                      <span class="text text-danger">* <?php echo form_error('terms');?></span>
                        <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms">
                        
                        <label class="form-check-label" for="acceptTerms">I agree and accept the <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">terms and conditions</a></label>
                        <div class="invalid-feedback">You must agree before submitting.</div>
                      </div>
                    </div>
                    <div class="col-12" style="margin-left: 137px">
                      <button class="btn btn-primary w-25" type="submit">Create Account</button>
                      <a class="btn btn-danger w-25" href="<?php echo site_url('UserLogin/index')?>"  type="submit">Cancel</a>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Already have an account? <a href="<?php echo site_url('LoginController/login')?>">Log in</a></p>
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

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Terms and Conditions Modal -->
  <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="termsModalLabel">Terms and Conditions</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <textarea class="form-control" rows="20" readonly>
TERMS AND CONDITIONS
-------------------

1. Introduction
Welcome to [Your Company] ("Company", "we", "our", "us")! 
These Terms of Service ("Terms", "Terms of Service") govern your use of our website located at [website URL] (together or individually "Service") operated by [Your Company].

2. Accounts
When you create an account with us, you must provide us with information that is accurate, complete, and current at all times. Failure to do so constitutes a breach of the Terms, which may result in immediate termination of your account on our Service.

3. Content
Our Service allows you to post, link, store, share and otherwise make available certain information, text, graphics, videos, or other material ("Content"). You are responsible for the Content that you post to the Service, including its legality, reliability, and appropriateness.

4. Termination
We may terminate or suspend your account immediately, without prior notice or liability, for any reason whatsoever, including without limitation if you breach the Terms.

5. Changes
We reserve the right, at our sole discretion, to modify or replace these Terms at any time. If a revision is material, we will try to provide at least 30 days notice prior to any new terms taking effect. What constitutes a material change will be determined at our sole discretion.

[Your Company] Terms and Conditions were created with the help of the [Terms and Conditions Generator].

6. Contact Us
If you have any questions about these Terms, please contact us at [contact information].
          </textarea>
        </div>
      </div>
    </div>
  </div>

  <!-- Vendor JS Files -->
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
