<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>change password</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
   
 <?php $this->load->view('common/headlink')?>

 <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" rel="stylesheet">



</head>

<body>

  <!-- ======= Header ======= -->
 <?php $this->load->view("common/header");?>

  <!-- ======= Sidebar ======= -->
 
  <?php $this->load->view("common/siderbar");?>
  <!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>User Profile</h1>
  
    </div>

    <div class="card col-6">
            <div class="card-body">
              <h5 class="card-title text-center">Change Password</h5>

              <!-- Vertical Form -->
              <form class="row g-3" method="post" Action="<?php echo site_url('UserController/changePassword_action'); ?>"
              ">
                <div class="col-12">
                
                  <div class="d-flex">
                  <label for="inputNanme4" class="form-label">Old Password</label>
                  <span class="text text-danger d-flex">* <?php echo form_error('oldpass');
                   ?>
                  </span>
                  </div>
                  <input type="password" class="form-control" 
                  value=""
                  name="oldpass" id="oldpass">

                </div>
                <div class="col-12">
                  <div class="d-flex">
                  <label for="inputEmail4" class="form-label">New Password</label>
                  <span class="text text-danger d-flex">* <?php echo form_error('newpass'); ?>
                  </span>
                  </div>

                  <input type="password" class="form-control" name="newpass"
                  value="" id="newpass">
                </div>

                <div class="col-12">
                  <div class="d-flex">
                  <label for="password" class="form-label">Repeat Password</label>
                  <span class="text text-danger d-flex">*<?php echo form_error('conpass'); ?>
                  </span>
                  </div>
                  <input type="password" class="form-control"
                  value="" id="conpass"  name="conpass">
                </div>
              
                

            </div>

            <div class="text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
              <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
            </form><!-- Vertical Form -->

          </div>

   


  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <?php $this->load->view('common/script') ?>
  <?php $this->load->view('common/logout') ?>

</body>

</html>