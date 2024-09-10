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
              <h5 class="card-title text-center">Add Country</h5>

              <!-- Vertical Form -->
              <form class="row g-3" method="post" Action="<?php echo site_url('CountryController/create_Action'); ?>" enctype="multipart/form-data">
                <div class="col-12 ">
                  <div class="d-flex">
                  <label for="inputNanme4" class="form-label">Country Name </label>
                  <span class="text text-danger d-flex">* <?php echo form_error('name');
                   ?><span id="country-error" class="text text-danger"></span>
                  </span>
                  <span id="name_error" class="text text-danger"></span>
                  </div>
                  <input type="text" class="form-control" 
                  value="<?php echo set_value('name')?>" 
                  name="name" id="name">
                 

                </div>

                <div class="col-12 ">
                  <div class="d-flex">
                  <label for="inputNanme4" class="form-label">Country Code </label>
                  <span class="text text-danger d-flex">* <?php echo form_error('code');
                   ?>  <span id="countryCode-error" class="text-danger"></span>
                  </span>
                  <span id="Code-error" class="text-danger"></span>
                  </div>
                  <input type="text" class="form-control" 
                  value="<?php echo set_value('code')?>" 
                  name="code" id="code">

                </div>

                <div class="col-12 ">
                  <div class="d-flex">
                  <label for="inputNanme4" class="form-label">Country Flag </label>
                  <span class="text text-danger d-flex">* <?php echo form_error('image');
                   ?> 
                  </span>
                  <span id="error" class=" text text-danger"></span>
                  </div>
                  <input type="file" class="form-control" 
                  value="<?php echo set_value('image')?>" 
                  name="image" id="image">
                  <label class="text text-danger">Note:Only jpg or png formate allow</label>

                </div>

        
                <div class="col-12">
                  <div class="d-flex">
                  <label for="inputDate" class="form-label">Status</label>
                  <span class="text text-danger d-flex">* <?php echo form_error('status') ?></span>
                  <span id="status_error" class="text text-danger"></span>
                  </div>
                 

                  <input class="form-check-input" type="radio" name="status" id="status" value="Active" <?php echo set_value("status")=='Active'?'checked':""?>>
                  <label class="form-check-label me-2" for="status">
                    Active
                  </label>

                  <input class="form-check-input" type="radio" name="status" id="gridRadios2" value="Block" <?php echo set_value("status")=='Block'?'checked':""?>>
                  <label class="form-check-label" for="gridRadios2">
                    Block
                  </label>
                </div>

            </div>

            <div class="text-center mb-4">
              <button type="submit" class="btn btn-primary" onclick="return validate();">Submit</button>
              <a href="<?php echo site_url("CountryController/countrylist")?>" class="btn btn-danger">Cancel</a>
            </div>
            </form><!-- Vertical Form -->

          </div>
        </div>


      </div>
      </div>
      <?php $this->load->view("common/logout") ?>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  
 
  <?php $this->load->view("common/script") ?>
  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>


</body>
<?php $this->load->view("common/footer") ?>
<?php $this->load->view("common/logout") ?>



<script>

  function validate(){

    var name = $("#name").val();
    var msg = "Required";

    if(name==""){
      $("#name_error").text(msg);
      $("#name").focus();
      return false;
    }

    var image =$("#image").val();
        $("#error").text("");
        if(image == ""){
            $("#error").text(msg);
            $("#image").focus();
            return false;
        }

        $("#countryCode-error").text();
        var code =$("#code").val();
        if(code==""){
          $("#Code-error").text(msg);
            $("#code").focus();
            return false;
        }

        var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
        if(!allowedExtensions.exec(image)){
            $("#error").text("Please upload files having extensions .jpeg/.jpg/.png only.");
            $("#image").focus();
          
            return false;
        }

    if($('input[name="status"]:checked').length==0){
      
      $("#status_error").text(msg);
      $("#status").focus();
      return false;

    }

   

   
  }
</script>
<script>
  $(document).ready(function () {
    $('#name').on('input', function () {
      var countryValue = $(this).val();
      var errorMsg = '';

      // Check if the field is empty
      if (countryValue.trim() === '') {
        errorMsg = 'country field should not be empty.';
      }

      // Check if the field contains any numbers
      if (/\d/.test(countryValue)) {
        errorMsg = 'country field should not contain numbers.';
      }

      // Display the error message or remove it if no error
      $('#country-error').text(errorMsg);

      if (errorMsg !== '') {
            $('#country-error').stop(true, true).fadeIn().text(errorMsg);
        } else {
            $('#country-error').stop(true, true).fadeOut();
        }
    });

    // country code

    $('#code').on('input', function() {
        var countryCode = $(this).val();
        var errorMsg = '';

        // Regular expression for a valid country code (e.g., +1, +44, +1234)
        var countryCodePattern = /^\+\d{1,4}$/;

        // Check if the field is empty
        if (countryCode.trim() === '') {
            errorMsg = 'Country code should not be empty.';
        }
        // Check if the country code format is valid
        else if (!countryCodePattern.test(countryCode)) {
            errorMsg = 'Invalid country code. Format: + followed by 1 to 4 digits.';
        }

        // Display the error message or remove it if no error
        if (errorMsg !== '') {
            $('#countryCode-error').stop(true, true).fadeIn().text(errorMsg);
        } else {
            $('#countryCode-error').stop(true, true).fadeOut();
        }
    });


    //country flag

    $('#image').on('change', function() {
        var file = this.files[0];
        var errorMsg = '';

        // Check if the file is selected
        if (!file) {
            errorMsg = 'Image should not be empty.';
        } else {
            // Check the file type
            var fileType = file.type;
            var validTypes = ['image/jpeg', 'image/png','image/jpg'];
            
            if ($.inArray(fileType, validTypes) === -1) {
                errorMsg = 'Only JPG,JPEG and PNG  formats are allowed.';
            }
        }

        // Display the error message or remove it if no error
        if (errorMsg !== '') {
            $('#image-error').stop(true, true).fadeIn().text(errorMsg);
        } else {
            $('#image-error').stop(true, true).fadeOut();
        }
    });

    
  });

</script>

</html>