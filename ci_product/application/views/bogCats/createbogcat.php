<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Create city</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->

  <?php $this->load->view('common/headlink') ?>


  <style>
    label {

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
              <h5 class="card-title text-center">Add Blog Category</h5>

              <!-- Vertical Form -->
              <form class="row g-3" method="post"
                Action="<?php echo site_url('BlogCategoryController/create_action'); ?>" enctype="multipart/form-data">


                <div class="col-12 ">
                  <div class="d-flex">
                    <label>Tittle</label>
                    <span class="text text-danger d-flex">* &nbsp; <?php echo form_error('name');
                    ?><span id="blogcat-error" class=" text text-danger"></span>
                    </span>
                    <span id="name_error" class="text text-danger"></span>
                  </div>
                  <input type="text" class="form-control" value="<?php echo $name ?>" name="name" id="name">

                </div>
                
                <div class="col-12">
                  <div class="d-flex">
                    <label>Description</label>
                    <span class="text text-danger d-flex">* &nbsp; <?php echo form_error('description'); ?><span id="description-error" class="text text-danger">
                    </span>
                  </span>
                  <span id="des_error" class="text text-danger"></span>
                  </div>
                  <textarea class="form-control" name="description" id="description"
                    rows="4"><?php echo $description; ?></textarea>
                </div>

                <div class="col-12">

                  <div class="d-flex">
                    <label for="inputDate">Status</label>
                    <span class="text text-danger d-flex">* &nbsp;<?php echo form_error('status') ?></span>
                    <span id="status_error" class="text text-danger"></span>
                  </div>


                  <input class="form-check-input" type="radio" name="status" id="gridRadios1" value="Active" <?php echo $status == 'Active' ? 'checked' : '' ?>>
                  <label class="form-check-label me-2" for="status">
                    Active
                  </label>

                  <input class="form-check-input" type="radio" name="status" id="gridRadios2" value="Block" <?php echo $status == 'Block' ? 'checked' : '' ?>>
                  <label class="form-check-label" for="gridRadios2">
                    Block
                  </label>
                </div>

            </div>

            <div class="text-center">
              <button type="submit" class="btn btn-primary" onclick="return validate();">Submit</button>
              <a href="<?php echo site_url("BlogCategoryController/getAllbogcat")?>" class="btn btn-danger">Cancel</a>
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


  <script src="<?php echo base_url(); ?>assets/js/toastr.js"></script>

</body>
<?php $this->load->view("common/footer") ?>

<script>
  $(document).ready(function () {
    $('#name').on('input', function () {
      var nMEValue = $(this).val();
      var errorMsg = '';

      // Check if the field is empty
      if (nMEValue.trim() === '') {
        errorMsg = 'blog category field should not be empty.';
      }

      // Check if the field contains any numbers
      if (/\d/.test(nMEValue)) {
        errorMsg = 'Blog category field should not contain numbers.';
      }

      // Display the error message or remove it if no error
      $('#blogcat-error').text(errorMsg);

      if (errorMsg !== '') {
            $('#blogcat-error').stop(true, true).fadeIn().text(errorMsg);
        } else {
            $('#blogcat-error').stop(true, true).fadeOut();
        }
    });

    //description

    $('#description').on('input', function () {
      var nMEValue = $(this).val();
      var errorMsg = '';

      // Check if the field is empty
      if (nMEValue.trim() === '') {
        errorMsg = 'description field should not be empty.';
      }

      // Display the error message or remove it if no error
      $('#description-error').text(errorMsg);

      if (errorMsg !== '') {
            $('#description-error').stop(true, true).fadeIn().text(errorMsg);
        } else {
            $('#description-error').stop(true, true).fadeOut();
        }
    });

    //status
    $('input[name="status"]').on('change', function () {
    var statusValue = $('input[name="status"]:checked').val();
    var errorMsg = '';

    // Check if a status is selected
    if (!statusValue) {
        errorMsg = 'Please select a status.';
    }

    // Display the error message or remove it if no error
    $('#status-error').text(errorMsg);

    if (errorMsg !== '') {
        $('#status-error').stop(true, true).fadeIn().text(errorMsg);
    } else {
        $('#status-error').stop(true, true).fadeOut();
    }
});
  });

</script>


<script>
  function validate(){

    var name = $("#name").val();
    var msg = "Required";

    $("#name_error").text("");

    if(name ==""){
      $("#name_error").text(msg);
      $("#name").focus();
      return false;

    }

    var des = $("#description").val();

  $("#des_error").text('');
    if(des== ""){
      $("#des_error").text(msg);
      $("#description").focus();
      return false;

    }

    if($('input[name="status"]:checked').length==0){
      
      $("#status_error").text(msg);
      $("#status").focus();
      return false;

    }


  }
</script>

</html>