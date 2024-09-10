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
  <main id="main" class="main">

    <div class="pagetitle">
      <?php if($_SESSION["role"]=="Admin"){?>
      <h1>Admin Dashboard</h1>
      <?php }else{?>
      <h1>User Dashboard</h1>
      <?php }?>
  
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Total Guest</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart"></i>
                    </div>
                    <div class="ps-3">
                      <?php if($_SESSION['role']=="User"){?>
                      <h6><?php echo $totalguestCount ;?></h6>
                      <?php }else{?>
                      <h6><?php echo $totatadminguest ;?></h6>
                      <?php }?>
                      
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                <div class="card-body">
                  <h5 class="card-title">Total male Count</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="ps-3">
                      <?php if($_SESSION["role"]=="User"){ ?>
                      <h6><?php echo $maleguestCount; ?></h6>
                      <?php }else{?>
                      <h6><?php echo $maleguestCountforadmin; ?></h6>
                      <?php }?>
                      
                     
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card">

               

                <div class="card-body">
                  <h5 class="card-title">Total female count</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <?php if($_SESSION["role"]=="User"){?>
                      <h6><?php echo $femaleguestCount?></h6>
                      <?php }else{?>
                      <h6><?php echo $femaleguestCountforadmin ?></h6>
                      <?php }?>
                      
                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->

            <!-- Reports -->
            

          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">

        </div><!-- End Right side columns -->

      </div>
     
    </section>


<div class="row">
<div class="col-6">
  <div class="card">
  <h5 class="mx-auto mt-2">Latest 5 Male Guest</h5>
      
              <table class="table datatable myTable1">
                <thead>
                  <tr>
                   
                    <th>Sr No.</th>
                   
                    <th>
                      Name
                    </th>
                    <th>Address</th>
                    
                    <th>Status</th>
                   
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($maleguest)): ?>
                    <?php $s = 1;
                    foreach ($maleguest as $row): ?>
                      <tr>
                     <td><?php echo $s ;?></td>
                    

                        <td><?php echo $row->name; ?></td>

                        <td><?php echo $row->address; ?></td>
                        <td>
                          <?php $status = $row->status; ?>
                          <button class="btn btn-status <?php echo ($status == 'Active') ? 'btn-success' : (($status == 'Pending') ? 'btn-warning' : 'btn-danger'); ?>" data-id="<?php echo $row->id; ?>"
                            data-status="<?php echo $status; ?>">
                            <?php echo $status; ?>
                          </button>
                        </td>


                        <!-- Add more fields as per your data structure -->
                      </tr>
                      <?php $s++; endforeach; ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="3">No users found.</td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
           
    </div>
  </div>
  <div class="col-6">
    
  <div class="card">
  <h5 class="mx-auto mt-2">5 Female Guest</h5>
   
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>Sr No.</th>
                    <th>
                      Name
                    </th>
                    <th>Address</th>
                    
                    <th>Status</th>
                   
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($femaleguest)): ?>
                    <?php $s = 1;
                    foreach ($femaleguest as $row): ?>
                     <td><?php echo $s; ?></td>
                        <td><?php echo $row->name; ?></td>

                        <td><?php echo $row->address; ?></td>
                        <td>
                          <?php $status = $row->status; ?>
                          <button class="btn btn-status <?php echo ($status == 'Active') ? 'btn-success' : (($status == 'Pending') ? 'btn-warning' : 'btn-danger'); ?>" data-id="<?php echo $row->id; ?>"
                            data-status="<?php echo $status; ?>">
                            <?php echo $status; ?>
                          </button>
                        </td>

                        <!-- Add more fields as per your data structure -->
                      </tr>
                      <?php $s++; endforeach; ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="3">No users found.</td>
                    </tr>
                  <?php endif; ?>
                </tbody>
               
              </table>
          
    </div>
  </div>

  <?php if($_SESSION["role"]=="Admin"){?>
    <div class="col-6">
  <div class="card">
  <h5 class="mx-auto mt-2">Latest 5 Active User</h5>
      
              <table class="table datatable mytable1" id="mytable3">
                <thead>
                  <tr>
                   
                    <th>Sr No.</th>
                   
                    <th>
                      Name
                    </th>
                    <th>email</th>
                    
                    <th>Status</th>
                   
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($activeuser)): ?>
                    <?php $s = 1;
                    foreach ($activeuser as $row): ?>
                      <tr>
                       
                     <td><?php echo $s ;?></td>
                    

                        <td><?php echo $row->name; ?></td>

                        <td><?php echo $row->email; ?></td>
                        <td>
                          <?php $status = $row->status; ?>
                          <button class="btn btn-status <?php echo ($status == 'Active') ? 'btn-success' : (($status == 'Pending') ? 'btn-warning' : 'btn-danger'); ?>" data-id="<?php echo $row->id; ?>"
                            data-status="<?php echo $status; ?>">
                            <?php echo $status; ?>
                          </button>
                        </td>


                        <!-- Add more fields as per your data structure -->
                      </tr>
                      <?php $s++; endforeach; ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="3">No users found.</td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
           
    </div>
  </div>
  <div class="col-6">
  <div class="card">
  <h5 class="mx-auto mt-2">Latest 5 Block Users</h5>
      
              <table class="table datatable myTable1">
                <thead>
                  <tr>
                   
                    <th>Sr No.</th>
                   
                    <th>
                      Name
                    </th>
                    <th>email</th>
                    
                    <th>Status</th>
                   
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($blockeuser)): ?>
                    <?php $s = 1;
                    foreach ($blockeuser as $row): ?>
                      <tr>
                        
                      <td><?php echo $s ;?></td>
                        <td><?php echo $row->name; ?></td>

                        <td><?php echo $row->email; ?></td>
                        <td>
                          <?php $status = $row->status; ?>
                          <button class="btn btn-status <?php echo ($status == 'Active') ? 'btn-success' : (($status == 'Pending') ? 'btn-warning' : 'btn-danger'); ?>" data-id="<?php echo $row->id; ?>"
                            data-status="<?php echo $status; ?>">
                            <?php echo $status; ?>
                          </button>
                        </td>


                        <!-- Add more fields as per your data structure -->
                      </tr>
                      <?php $s++; endforeach; ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="3">No users found.</td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
           
    </div>
  </div>
  <div class="col-6">
  <div class="card">
  <h5 class="mx-auto mt-2">Latest 5 Pending Users</h5>
      
              <table id="myTable2" class="table datatable myTable1">
                <thead>
                  <tr>
                    
                    <th>Sr No.</th>
                   
                    <th>
                      Name
                    </th>
                    <th>email</th>
                    
                    <th>Status</th>
                   
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($pendingeuser)): ?>
                    <?php $s = 1;
                    foreach ($pendingeuser as $row): ?>
                      <tr>
                     <td><?php echo $s ;?></td>
                    

                        <td><?php echo $row->name; ?></td>

                        <td><?php echo $row->email; ?></td>
                        <td>
                          <?php $status = $row->status; ?>
                          <button class="btn btn-status <?php echo ($status == 'Active') ? 'btn-success' : (($status == 'Pending') ? 'btn-warning' : 'btn-danger'); ?>" data-id="<?php echo $row->id; ?>"
                            data-status="<?php echo $status; ?>">
                            <?php echo $status; ?>
                          </button>
                        </td>


                        <!-- Add more fields as per your data structure -->
                      </tr>
                      <?php $s++; endforeach; ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="3">No users found.</td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
           
    </div>
  </div>

    <?php }?>
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
    <?php $this->load->view('common/logout')?>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <?php $this->load->view('common/script') ?>

 

</body>
<script>
    $(document).ready(function () {
      $('.myTable1').DataTable();
      
    }

    );
  </script>

</html>