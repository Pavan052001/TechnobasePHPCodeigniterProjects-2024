<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Forms / Layouts - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <?php $this->load->view('common/headlink') ?>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.14.0/themes/base/jquery-ui.min.css"
    integrity="sha512-F8mgNaoH6SSws+tuDTveIu+hx6JkVcuLqTQ/S/KJaHJjGc8eUxIrBawMnasq2FDlfo7FYsD8buQXVwD+0upbcA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

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

    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-8 offset-2">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title text-center">Add User</h5>
              <!-- Vertical Form -->
              <form class="row g-3" method="post" action="<?php echo site_url('UserController/create_action'); ?>"
                enctype="multipart/form-data">
                <div class="col-12 has-validation">
                  <div class="d-flex">
                    <label for="name" class="form-label">Your Name</label>
                    <span class="text text-danger d-flex">* &nbsp;<?php echo form_error('name'); ?>
                      <span id="name-error" class="text text-danger"></span></span>
                  </div>
                  <input type="text" class="form-control" value="<?php echo set_value('name') ?>" name="name" id="name"
                    onkeypress="return alphaonly(event)" />
                </div>
                <div class="col-12">
                  <div class="d-flex">
                    <label for="email" class="form-label">Email</label>
                    <span class="text text-danger  d-flex mb-2">*&nbsp;<?php echo form_error('email'); ?>
                      <span id="email-error" class="text text-danger"></span></span>
                  </div>
                  <input type="email" class="form-control" name="email" value="<?php echo set_value('email') ?>"
                    id="email">
                </div>
                <div class="col-12">
                  <div class="d-flex">
                    <label for="mobile" class="form-label">Mobile</label>
                    <span class="text text-danger d-flex">* &nbsp;<?php echo form_error('mobile'); ?>
                      <span id="add-error" class="text text-danger"></span>
                    </span>
                  </div>
                  <input type="text" class="form-control" value="<?php echo set_value('mobile') ?>" id="mobile"
                    name="mobile" onkeypress="return isNumberKey(event)" />
                </div>

                <div class="col-12">
                  <div class="d-flex">
                    <label for="date" class="form-label">Date of birth</label>
                    <span class="text text-danger d-flex">*&nbsp; <?php echo form_error('date'); ?>
                    </span>
                    <span id="date_error" class="text text-danger"></span>
                  </div>
                  <input type="text" name="date" id="dobpicker" value="<?php echo set_value('date') ?>"
                    class="form-control">
                </div>
                <div class="col-12">
                  <div class="d-flex">
                    <label for="image" class="form-label">Upload Profile</label>
                    <span class="text text-danger d-flex">*&nbsp; <?php echo form_error('image'); ?>
                      <span id="error" class="text text-danger"></span></span>
                  </div>
                  <input type="file" class="form-control" name="image" id="image">
                  <label style="font-size:12px;" class="text text-danger">Note:please upload png jpg type image</label>
                </div>
                <div class="form-group">
                  <div class="d-flex">
                    <label class="form-label">Hobbies</label><span class="text text-danger d-flex"> *&nbsp;
                      <?php echo form_error('hobby_id[]'); ?>
                      <span id="hobby-error" class="text text-danger"></span>
                    </span>
                  </div>
                  <?php
                  $checkbox_count = 0;
                  foreach ($allhobbies as $hobbyrow) { ?>
                    <input type="checkbox" name="hobby_id[]" value="<?php echo $hobbyrow->id ?>" <?php echo !empty($hobby_id) && in_array($hobbyrow->id, $hobby_id) ? 'checked' : ''; ?>>
                    <?php echo $hobbyrow->hobby_title;
                    echo " "; ?>&nbsp;
                    <?php
                    $checkbox_count++;
                    echo ($checkbox_count % 3 == 0 ? '<br>' : '');
                  } ?>
                </div>
                <div class="col-12">
                  <div class="d-flex">
                    <label for="password" class="form-label">Password</label>
                    <span class="text text-danger d-flex">*&nbsp; <?php echo form_error('password'); ?>
                    </span>
                    <span id="password-error" class="text text-danger"></span>
                  </div>
                  <input type="password" class="form-control" name="password" id="password">
                </div>
                <div class="col-12">
                  <div class="d-flex">
                    <label for="gender" class="form-label">Gender :</label>
                    <span class="text text-danger d-flex">*&nbsp; <?php echo form_error('gender'); ?>
                      <span id="gender-error" class="text text-danger"></span></span>
                  </div>

                  <input class="form-check-input" type="radio" name="gender" id="gender_male" value="male">
                  <label class="form-check-label me-2" for="gender_male">male</label>
                  <input class="form-check-input" type="radio" name="gender" id="gender_female" value="female">
                  <label class="form-check-label" for="gender_female">female</label>
                </div>
                <div class="col-12">
                  <div class="d-flex">
                    <label for="gender" class="form-label">Status :</label>
                    <span class="text text-danger d-flex">* &nbsp;<?php echo form_error('status'); ?>
                      <span id="status_error" class="text text-danger"></span></span>
                  </div>
                  <div>
                    <input class="form-check-input" type="radio" name="status" id="Active" value="male">
                    <label class="form-check-label me-2" for="Active">Active</label>
                    <input class="form-check-input" type="radio" name="status" id="Block" value="Block">
                    <label class="form-check-label" for="Block">Block</label>
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary" onclick="return validate();">Submit</button>
                  <a href="<?php echo site_url("UserController/userList") ?>" class="btn btn-danger">Cancel</a>
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
  <?php $this->load->view('common/logout') ?>
  <!-- End Footer -->
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>
  <?php $this->load->view("common/script") ?>
  <script src="<?php echo base_url(); ?>assets/js/toastr.js"></script>
  <script src="https://cdn.ckeditor.com/4.24.0-lts/standard/ckeditor.js"></script>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.14.0/jquery-ui.min.js"
  integrity="sha512-MlEyuwT6VkRXExjj8CdBKNgd+e2H+aYZOCUaCrt9KRk6MlZDOs91V1yK22rwm8aCIsb5Ec1euL8f0g58RKT/Pg=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript">
  $("document").ready(function () {

    $("#dobpicker").datepicker({
      changeMonth: true,
      changeYear: true,
      showOtherMonths: true,
      selectOtherMonths: true,
      showButtonPanel: true,
      yearRange: '1920:<?php echo date("Y"); ?>',
      maxDate: 'today'
    });
  });
</script>

<script>
  $(document).ready(function () {
    $('#name').on('input', function () {
      var nameValue = $(this).val();
      var errorMsg = '';

      // Validate the name (e.g., only letters and spaces are allowed)
      var namePattern = /^[a-zA-Z\s]*$/;

      if (nameValue.trim() === ' ') {
        errorMsg = 'Name field should not be empty.';
      } else if (!namePattern.test(nameValue)) {
        errorMsg = 'Name should only contain letters and spaces.';
      }

      // Display the error message or remove it if no error
      $('#name-error').text(errorMsg);

      if (errorMsg !== '') {
        $('#name-error').stop(true, true).fadeIn().text(errorMsg);
      } else {
        $('#name-error').stop(true, true).fadeOut();
      }
    });

    //email

    $('#email').on('input', function () {
      var nameValue = $(this).val();
      var errorMsg = '';

      // Validate the name (e.g., only letters and spaces are allowed)


      if (nameValue.trim() === '') {
        errorMsg = 'email field should not be empty.';
      }

      // Display the error message or remove it if no error
      $('#email-error').text(errorMsg);

      if (errorMsg !== '') {
        $('#email-error').stop(true, true).fadeIn().text(errorMsg);
      } else {
        $('#email-error').stop(true, true).fadeOut();
      }
    });

    //image

    $('#image').on('change', function () {
      var file = this.files[0];
      var errorMsg = '';

      // Check if the file is selected
      if (!file) {
        errorMsg = 'Image should not be empty.';
      } else {
        // Check the file type
        var fileType = file.type;
        var validTypes = ['image/jpeg', 'image/png', 'image/jpg'];

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

<script>
  function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
      return false;
    return true;
  }


  //name
  function alphaonly(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 65 || charCode > 122))
      return false;
    return true;

  }
</script>

<script>

  function validate() {
    var name = $("#name").val();
    var errorMsg = 'Required';


    if (name == "") {

      $("#name-error").text(errorMsg);
      $("#name").focus();
      return false;
    }


    var email = $("#email").val();
    if (email == "") {
      $("#email-error").text(errorMsg);
      $("#email").focus();
      return false;
    }

    var address = $("#mobile").val();
    $("#add-error").text("");
    if (address == "") {
      $("#add-error").text(errorMsg);
      $("#mobile").focus();
      return false;

    }


    var state = $("#dobpicker").val();
    $("#date_error").text("");
    if (state == "") {
      $("#date_error").text(errorMsg);
      $("#dobpicker").focus();
      return false;
    }

    var image = $("#image").val();
    $("#error").text("");
    if (image == "") {
      $("#error").text(errorMsg);
      $("#image").focus();
      return false;
    }

    var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
    if (!allowedExtensions.exec(image)) {
      $("#error").text("Please upload files having extensions .jpeg/.jpg/.png only.");
      $("#image").focus();

      return false;
    }

    $("#hobby-error").text("");
    if ($('input[name="hobby_id[]"]:checked').length == 0) {
      $("#hobby-error").text(errorMsg);
      $("#hobby").focus();
      return false;

    }

    $("#gender_error").text("");
    if ($('input[name="gender"]:checked').length == 0) {
      $("#gender-error").text(errorMsg);
      $(".gender").focus();
      return false;

    }

    $("#status_error").text("");
    if ($('input[name="status"]:checked').length == 0) {
      $("#status-error").text(errorMsg);
      $(".status").focus();
      return false;

    }

    var pass = $("#password").val();
    if (pass === "") {
      var errorMsg = "Password is required."; // Define the error message
      $("#password-error").text(errorMsg);  // Show the error message in the span with id "password-error"
      $("#password").focus();  // Set focus to the password field
      return false;  // Prevent form submission
    } else {
      $("#password-error").text('');  // Clear any previous error message if the field is valid
      return true;  // Allow form submission if valid
    }

  }


</script>

<!-- date picker -->

<script>

</script>

</html>