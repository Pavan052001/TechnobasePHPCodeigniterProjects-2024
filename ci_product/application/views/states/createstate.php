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
    label{
      margin-bottom: 20px;
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
     
    <section class="section">
      <div class="row">

        <div class="col-lg-8 offset-2">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title text-center">Add State</h5>

              <!-- Vertical Form -->
              <form class="row g-3" method="post" Action="<?php echo site_url('StateController/create_Action'); ?>" enctype="multipart/form-data">

              <div class="form-group">
												<div class="d-flex">
                        <label>Country</label><span class="text text-danger d-flex"> * <?= form_error('country_id')?></span>
                        <span id="name_error" class="text text-danger"></span>
                        </div>
												<div >
													<select name="country_id" id="country_id" class="form-control">
														 <option value="">--Select Country--</option>
														<?php foreach($allcountries as $countryrow){ ?>
														<option value="<?= $countryrow->id; ?>"<?= !empty($country_id) && $country_id == $countryrow->id ?'selected':''; ?>><?= $countryrow->country_name; ?></option>
														<?php } ?>
													</select>
												</div>
											</div> 
                <div class="col-12 ">
                  <div class="d-flex">
                  <label for="inputNanme4">State Name </label>
                  <span class="text text-danger d-flex">* <?php echo form_error('name');
                   ?><span id="error" class="text text-danger"></span>
                  </span>
                  </div>
                  <input type="text" class="form-control" 
                  value="<?php echo set_value('name')?>" 
                  name="name" id="name">

                </div>

                <div class="col-12">
                  
                 <div class="d-flex"> <label for="inputDate">Status</label>
                 <span class="text text-danger d-flex">* <?php echo form_error('status') ?></span>
                
                <span id="status_error" class="text text-danger"></span></div>

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

            <div class="text-center">
              <button type="submit" class="btn btn-primary" onclick="return validate();">Submit</button>
              <a href="<?php echo site_url("StateController/managelist")?>" class="btn btn-danger">Cancel</a>
            </div>
            </form><!-- Vertical Form -->

          </div>
        </div>


      </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  
  <?php $this->load->view("common/logout") ?>
  <?php $this->load->view("common/script") ?>
  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

      <?php $this->load->view("common/script") ?>
      <script src="<?php echo base_url(); ?>assets/js/toastr.js"></script>

</body>
<?php $this->load->view("common/footer") ?>
<?php $this->load->view("common/logout") ?>

<script>
  $(document).ready(function () {
    $('#name').on('input', function () {
      var countryValue = $(this).val();
      var errorMsg = '';

      // Check if the field is empty
      if (countryValue.trim() === '') {
        errorMsg = 'city field should not be empty.';
      }

      // Check if the field contains any numbers
      if (/\d/.test(countryValue)) {
        errorMsg = 'state field should not contain numbers.';
      }

      // Display the error message or remove it if no error
      $('#state-error').text(errorMsg);

      if (errorMsg !== '') {
            $('#state-error').stop(true, true).fadeIn().text(errorMsg);
        } else {
            $('#state-error').stop(true, true).fadeOut();
        }
    });

// check country

    $('#country_id').on('input', function () {
      var countryValue = $(this).val();
      var errorMsg = '';

      // Check if the field is empty
      if (countryValue.trim() === '') {
        errorMsg = 'country field should not be empty.';
      }

    
      // Display the error message or remove it if no error
      $('#country-error').text(errorMsg);

      if (errorMsg !== '') {
            $('#country-error').stop(true, true).fadeIn().text(errorMsg);
        } else {
            $('#country-error').stop(true, true).fadeOut();
        }
    });
  });

</script>

<script>

  function validate(){
    
    var name = $("#country_id").val();
    var msg = "Required";

    $("#name_error").text("");
    if(name==""){
      $("#name_error").text(msg);
      $("#country_id").focus();
      return false;
    }


    var name = $("#name").val();
  
    $("#error").text("");
    if(name==""){
      $("#error").text(msg);
      $("#name").focus();
      return false;
    }


    if($('input[name="status"]:checked').length==0){
      
      $("#status_error").text(msg);
      $(".status").focus();
      return false;

    }

  }
</script>


</html>