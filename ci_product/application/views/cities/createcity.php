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

          <div class="card mb-3">
            <div class="card-body">
              <h5 class="card-title text-center">Add City</h5>

              <!-- Vertical Form -->
              <form class="row g-3" method="post" Action="<?php echo site_url('CityController/create_Action'); ?>"
                enctype="multipart/form-data">

                <!-- //country -->

                <div class="form-group">
                  <div class="d-flex">
                    <label>Country</label><span class="text text-danger d-flex"> * <?= form_error('country_id') ?></span>
                    <span id="country_error" class="text text-danger"></span>
                  </div>
                  <div>
                    <select name="country_id" id="country_id" class="form-control">
                      <option value="">--Select Country--</option>
                      <?php foreach ($getAllcountry as $row) { ?>
                        <option value="<?= $row->id; ?>" <?= !empty($country_id) && $country_id == $row->id ? 'selected' : ''; ?>>
                          <?= $row->country_name; ?>
                        </option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <!-- states -->
                <div class="form-group">
                  <div class="d-flex">
                    <label>State</label><span class="text text-danger d-flex"> * <?= form_error('state_id') ?></span>
                    <span
                        id="state_error" class="text text-danger"></span>
                  </div>
                  <div>
                    <select name="state_id" id="state_id" class="form-control">
                      <option value="">--Select state--</option>
                      <?php foreach ($getallState as $row) { ?>
                        <option value="<?= $row->id; ?>" <?= !empty($state_id) && $state_id == $row->id ? 'selected' : ''; ?>>
                          <?= $row->state_name; ?>
                        </option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="col-12 ">
                  <div class="d-flex">
                    <label for="inputNanme4">City Name</label>
                    <span class="text text-danger d-flex">* <?php echo form_error('name');
                    ?><span id="city-error" class="text text-danger"></span>
                    </span>
                    <span id="name_error" class="text text-danger"></span>
                  </div>
                  <input type="text" class="form-control" value="<?php echo $city_name ?>" name="name" id="name">

                </div>

                <div class="col-12">
                  <div class="d-flex">
                    <label for="inputDate">Status</label>
                    <span class="text text-danger d-flex">*<?php echo form_error('status'); ?></span>
                    <span id="status-error" class="text text-danger"></span>
                  </div>

                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="gridRadios1" value="Active" <?php echo $status == 'Active' ? 'checked' : ''; ?>>
                    <label class="form-check-label me-2" for="gridRadios1">
                      Active
                    </label>
                  </div>

                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="gridRadios2" value="Block" <?php echo $status == 'Block' ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="gridRadios2">
                      Block
                    </label>
                  </div>
                </div>


            </div>

            <div class="text-center mb-3">
              <button type="submit" class="btn btn-primary" onclick="return validate();">Submit</button>
              <a href="<?php echo site_url("CityController/managelist") ?>" class="btn btn-danger">Cancel</a>

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
      var cityValue = $(this).val();
      var errorMsg = '';

      // Check if the field is empty
      if (cityValue.trim() === '') {
        errorMsg = 'city field should not be empty.';
      }

      // Check if the field contains any numbers
      if (/\d/.test(cityValue)) {
        errorMsg = 'city field should not contain numbers.';
      }

      // Display the error message or remove it if no error
      $('#city-error').text(errorMsg);

      if (errorMsg !== '') {
        $('#city-error').stop(true, true).fadeIn().text(errorMsg);
      } else {
        $('#city-error').stop(true, true).fadeOut();
      }
    });

    // check state

    $('#state_id').on('input', function () {
      var stateValue = $(this).val();
      var errorMsg = '';

      // Check if the field is empty
      if (stateValue.trim() === '') {
        errorMsg = 'state field should not be empty.';
      }

      // Display the error message or remove it if no error
      $('#state-error').text(errorMsg);

      if (errorMsg !== '') {
        $('#state-error').stop(true, true).fadeIn().text(errorMsg);
      } else {
        $('#state-error').stop(true, true).fadeOut();
      }
    });
  });

</script>

<script>
  $("document").ready(function () {
    $("#country_id").change(function () {
      var country_id = $(this).val();
      $.ajax({
        url: '<?php echo site_url('GuestController/getstates') ?>',
        type: 'post',
        data: { country_id: country_id },
        dataType: 'json',
        success: function (response) {
          if (response.states) {
            $("#state_id").html(response.states);
          } else {
            $("#state_id").html('<option value="">--No States Available--</option>');
          }
        },
        error: function (xhr, status, error) {
          console.error("AJAX Error: ", status, error);
        }
      });
    });
  });
</script>

<script>
  $("document").ready(function () {
    $(document).on("change", "#state_id", function () {
      var state_id = $(this).val();

      //  alert(state_id); 
      //selected state id

      $.ajax({
        url: '<?php echo site_url('GuestController/getcities') ?>',
        type: 'post',
        data: { state_id: state_id },
        dataType: 'json',
        success: function (response) {
          if (response.cities) {
            $("#city_id").html(response.cities);
          } else {
            $("#city_id").html('<option value="">--No States Available--</option>');
          }
        },
        error: function (xhr, status, error) {
          console.error("AJAX Error: ", status, error);
        }
      });

    });
  });
</script>

<script>

  function validate() {

    var msg = "Required";
    var country = $("#country_id").val();

    $("#country_error").text("");
    if (country == "") {
      $("#country_error").text(msg);
      $("#country_id").focus();
      return false;
    } 

    var state = $("#state_id").val();
       $("#state_error").text("");  // Clear any previous error message
     if (state == "") {
    // var errorMsg = "Please select a state.";  // Define the error message
    $("#state_error").text(msg);  // Set the error message
    $("#state_id").focus();  // Focus on the select box
    return false;  // Prevent form submission
}

var name = $("#name").val();
    var msg = "Required";

    if(name==""){
      $("#name_error").text(msg);
      $("#name").focus();
      return false;
    }

    if($('input[name="status"]:checked').length==0){
      
      $("#status-error").text(msg);
      $(".status").focus();
      return false;

    }



    
  }
</script>


</html>