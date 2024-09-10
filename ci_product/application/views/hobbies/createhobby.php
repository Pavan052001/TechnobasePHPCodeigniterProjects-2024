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
  <style>
    .form-label{
      margin-bottom: 25px;
    }
  </style>
</head>

<body>

  <!-- ======= Header ======= -->
  <?php $this->load->view('common/header') ?>
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->

  <?php $this->load->view('common/siderbar') ?>
  <!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">

        <div class="col-lg-8 offset-2">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title text-center">Add hobby</h5>

              <!-- Vertical Form -->
              <form class="row g-3" method="post" Action="<?php echo site_url('HobbieController/createHobby_action'); ?>"
              enctype="multipart/form-data">

                <div class="col-12 ">
                        <div class="d-flex">
                            <label for="inputNanme4" class="form-label">Hobby </label>
                            <span class="text text-danger d-flex">* <?php echo form_error('hobby'); ?>
                            <span id="hobby_error" class="text-danger"></span></span>
                            
                        </div>
                        <input type="text" class="form-control" 
                        value="<?php echo set_value('hobby')?>" 
                        name="hobby" id="hobby" onkeypress="return alphaonly(event)"/>
                    </div>

        
                <div class="col-12">
                 <div class="d-flex">
                 <label for="inputDate" class="form-label">Status</label>
                 <span class="text text-danger d-flex">* &nbsp;<?php echo form_error('status') ?></span>
                 <span id="status_error" class="text text-danger"></span>
                 </div>

                  <input class="form-check-input" type="radio" name="status" id="gridRadios1" value="Active">
                  <label class="form-check-label me-2" for="status">
                    Active
                  </label>

                  <input class="form-check-input" type="radio" name="status" id="gridRadios2" value="Block">
                  <label class="form-check-label" for="gridRadios2">
                    Block
                  </label>
                </div>

            </div>

            <div class="text-center mb-4">
              <button type="submit" class="btn btn-primary" onclick="return validate();">Submit</button>
              <a href="<?php echo site_url("HobbieController/hobbylist")?>" class="btn btn-danger">Cancel</a>
            </div>
            </form><!-- Vertical Form -->

          </div>
        </div>


      </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php $this->load->view("common/footer") ?>
  
  <?php $this->load->view("common/logout") ?>
  <?php $this->load->view("common/script") ?>
  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

    
      <script src="<?php echo base_url(); ?>assets/js/toastr.js"></script>

</body>

<script>

function validate(){

  var errormag = "Required";
  var name = $("#hobby").val();
  $("#hobby_error").text("");
  if(name==""){
    $("#hobby_error").text(errormag);
    $("#hobby").focus();
    return false;
  }

  if($('input[name="status"]:checked').length==0){
      
      $("#status_error").text(errormag);
      $(".status").focus();
      return false;

    }

}
</script>

<script>
  //name
function alphaonly(evt){
  var charCode = (evt.which) ? evt.which : evt.keyCode
  if (charCode > 31 && (charCode < 65 || charCode > 122))
    return false;
  return true;

}
</script>




</html>