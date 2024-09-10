<!DOCTYPE html>
<html lang="en">
    

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Forms / Layouts - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <?php $this->load->view('common/headlink') ?>
</head>

<body>

  <!-- ======= Header ======= -->
   <?php  $this->load->view('common/header')?>
   
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
 
  <?php $this->load->view('common/siderbar')?>
  <!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Form Layouts</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Forms</li>
          <li class="breadcrumb-item active">Layouts</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">

        <div class="col-lg-8 offset-2">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">View</h5>

              <!-- Vertical Form -->
              <table class="table">
                
                <tbody>
                  <?php if (!empty($guestdata)): ?>
                    
                      <tr class="mb-4">
                        
                        <td class="text-center ">
                          <!-- <?php// if (!empty($guestdata->image)): ?> -->
                            <img src="<?php echo base_url('uploads/guestimage/'.$guestdata->photo); ?>" alt="User Image" width="100" height="100">
                            <h6>User Profile Image</h6>
                          <?php// else: ?>
                            <!-- No image available. -->
                          <?php// endif; ?>
                        </td>
                      </tr>
                      
                      <tr>
                      <th>Name :</th>
                        <td><?php echo $guestdata->name; ?></td>
                        </tr>
                        <tr>
                      <th>Email:</th>
                        <td><?php echo $guestdata->email_address; ?></td>
                        </tr>
                        <tr>
                      <th>Address :</th>
                        <td><?php echo $guestdata->address; ?></td>
                        </tr>
                        <tr>
                        <tr>
                      <th>Gender :</th>
                        <td><?php echo $guestdata->gender; ?></td>
                        </tr>
                        <tr>
                        <tr>
                      <th>Date</th>
                        <td><?php echo $guestdata->dob; ?></td>
                        </tr>
                        <th>status</th>
                        <td><?php echo $guestdata->status; ?></td>
                        </tr>
                        
                   
                  <?php else: ?>
                    <tr>
                      <td colspan="3">No users found.</td>
                    </tr>
                  <?php endif; ?>
                  <a href="<?php echo site_url('GuestController/getlist') ?>" class="btn btn-primary bx-pull-right me-5">
                back</a>
                </tbody>
                
              </table>
              </table>
             <!-- Vertical Form -->

            </div>
          </div>


        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php $this->load->view("common/footer")?>
  <?php $this->load->view("common/logout")?>
  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <?php $this->load->view("common/script") ?>
</body>

</html>