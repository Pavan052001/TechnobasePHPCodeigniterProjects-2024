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
    .form-label {
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
      <h1>Update Hobbies</h1>

    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">

        <div class="col-lg-8 offset-2">

          <div class="card">
            <div class="card-body">


              <!-- Vertical Form -->
              <form class="row g-3" method="post"
                Action="<?php echo site_url('HobbieController/updateHobby_Action'); ?>" enctype="multipart/form-data">
                <div class="col-12">
                  <div class="d-flex">
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <label for="inputNanme4" class="form-label">Hobby</label>
                    <span class="text text-danger d-flex">*
                      <span id="hobby-error" class="text-danger"><?php echo form_error('hobby'); ?></span>
                    </span>
                    
                  </div>
                  <input type="text" class="form-control" value="<?php echo $hobby_title ?>" name="hobby" id="hobby">
                </div>

                <div class="col-12">
                  <label for="inputDate" class="form-label">Status</label>
                  <span class="text text-danger">* <?php echo form_error('status') ?></span>

                  <input class="form-check-input" type="radio" name="status" id="gridRadios1" value="Active"
                    <?= !empty($status) && $status == 'Active' ? 'checked' : ''; ?>>
                  <label class="form-check-label me-2" for="status">
                    Active
                  </label>

                  <input class="form-check-input" type="radio" name="status" id="gridRadios2" value="Block"
                    <?= !empty($status) && $status == 'Block' ? 'checked' : ''; ?>>
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
    $('#hobby').on('input', function () {
      var hobbyValue = $(this).val();
      var errorMsg = '';

      // Check if the field is empty
      if (hobbyValue.trim() === '') {
        errorMsg = 'Hobby field should not be empty.';
      }

      // Check if the field contains any numbers
      if (/\d/.test(hobbyValue)) {
        errorMsg = 'Hobby field should not contain numbers.';
      }

      // Display the error message or remove it if no error
      $('#hobby-error').text(errorMsg);

      if (errorMsg === '') {
        $('#hobby-error').text('');
      }
    });
  });
</script>

<script>
  function validate(){

var errormag = "Required";
var name = $("#hobby").val();
$("#hobby-error").text("");
if(name==""){
  $("#hobby-error").text(errormag);
  $("#hobby").focus();
  return false;
}

if($('input[name="status"]:checked').length==0){
    
    $("#status_error").text("");
    $(".status").focus();
    return false;

  }

}
</script>
</script>

</html>