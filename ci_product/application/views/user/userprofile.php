<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - NiceAdmin Bootstrap Template</title>
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
    <table class="table">
                
                <tbody>
                  <?php // if (!empty($guest)): ?>
                    <?php // foreach ($guest as $users): ?>
                      <tr class="mb-4">
                        
                        <td class="text-center ">
                          <?php if (!empty($image)): ?>
                            <img src="<?php echo base_url('uploads/userimage/' .$image); ?>" alt="User Image" width="100" height="100">
                          <?php else: ?>
                            No image available.
                          <?php endif; ?>
                        </td>
                      </tr>
                      
                      <tr>
                      <th>Name</th>
                        <td><?php echo $name; ?></td>
                        </tr>
                        <tr>
                      <th>Email</th>
                        <td><?php echo $email; ?></td>
                        </tr>
                        <tr>
                     
                        <tr>
                      <th>Mobile Number:</th>
                        <td><?php echo $number; ?></td>
                        </tr>
                        <tr>
                      <th>Gender</th>
                        <td><?php echo $gender; ?></td>
                        </tr>
                      
                        <tr>
                      <th>Date of birth</th>
                        <td><?php echo $dob; ?></td>
                        </tr>
                        
                    <?php // endforeach; ?>
                  <?php // else: ?>
                   
                  <?php // endif; ?>

                </tbody>
               
              </table>

            <div class="text-center">
              <a type="submit" class="btn btn-primary">back</a>
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
      
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <?php $this->load->view('common/script') ?>
  <?php $this->load->view('common/logout') ?>

</body>

</html>