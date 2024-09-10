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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.14.0/themes/base/jquery-ui.min.css" integrity="sha512-F8mgNaoH6SSws+tuDTveIu+hx6JkVcuLqTQ/S/KJaHJjGc8eUxIrBawMnasq2FDlfo7FYsD8buQXVwD+0upbcA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                            <h5 class="card-title text-center">Add Guest</h5>

                            <!-- Vertical Form -->
                            <form id="form" class="row g-3" method="post"
                                Action="<?php echo site_url('GuestController/create_action'); ?>"
                                enctype="multipart/form-data">
                                <div class="col-12">
                                    <div class="d-flex">
                                        <label for="inputNanme4" class="form-label">Your Name</label>
                                        <span class="text text-danger d-flex">* &nbsp;<?php echo form_error('name');
                                        ?><span id="name-error" class="text text-danger"></span>
                                        </span>

                                    </div>
                                    <input type="text" class="form-control" value="<?php echo set_value('name') ?>"
                                        name="name" id="name">

                                </div>
                                <div class="col-12">
                                    <div class="d-flex">
                                        <label for="inputEmail4" class="form-label">Email</label>
                                        <span class="text text-danger d-flex">*&nbsp; <?php echo form_error('email'); ?><span id="email-error" class="text text-danger"></span>
                                        </span>

                                    </div>
                                    <input type="email" class="form-control" name="email"
                                        value="<?php echo set_value('email') ?>" id="email">
                                </div>

                                <div class="col-12">
                                    <div class="d-flex">
                                        <label for="inputAddress" class="form-label">Address</label>
                                        <span class="text text-danger d-flex">*&nbsp;
                                            <?php echo form_error('address'); ?>
                                        <span id="add-error" class="text text-danger"></span></span>
                                    </div>
                                    <textarea class="form-control" name="address" id="address"
                                        placeholder=""><?php echo set_value('address'); ?></textarea>
                                </div>

                                <div class="form-group">
												<label>About Guest</label><span class="text text-danger"> * <?= form_error('details_about_guest')?></span> 
												<textarea class="form-control form-control-user ckeditor" name="details_about_guest" placeholder="Details about guest" autocomplete="off">
                                                    <?php echo !empty($details_about_guest)?$details_about_guest:'';?></textarea>
											</div>

                                <div class="form-group">
                                    <div class="d-flex">
                                        <label class="form-label">Country</label><span class="text text-danger d-flex">
                                            *&nbsp;
                                            <?= form_error('country_id'); ?><span id="country_error" class="text text-danger"></span></span>
                                    </div>
                                    <div>
                                        <select name="country_id" id="country_id" class="form-control selectSearch">
                                            <option value="">--Select Country--</option>
                                            <?php foreach ($getallcountry as $row) { ?>
                                                <option value="<?= $row->id; ?>" <?= !empty($country_id) && ($country_id == $row->id) ? 'selected' : ''; ?>><?= $row->country_name; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="d-flex">
                                        <label class="form-label">State</label><span class="text text-danger d-flex"> *&nbsp;
                                            <?= form_error('state_id'); ?>
                                        <span id="state_error" class="text text-danger"></span></span>
                                    </div>
                                    <div id="box">
                                        <select name="state_id" id="state_id" class="form-control      selectSearch">
                                            <option value="">--Select State--</option>
                                             <?php foreach ($getallstates as $row) { ?>
                                                <option value="<?= $row->id; ?>" <?= !empty($state_id) && ($state_id == $row->id) ? 'selected' : ''; ?>><?= $row->state_name; ?>
                                                </option>
                                            <?php } ?> 

                                        </select>


                                    </div>

                                </div>

                                <div class="form-group">
                                    <div class="d-flex">
                                        <label class="form-label">City</label><span class="text text-danger d-flex"> *&nbsp;
                                            <?= form_error('city_id'); ?>
                                        <span id="city_error" class="text text-danger"></span></span>
                                    </div>
                                    <div>
                                        <select name="city_id" id="city_id" class="form-control selectSearch">
                                            <option value="">--Select City--</option>
                                           
                                             <?php foreach ($allcities as $row) { ?>
                                                <option value="<?= $row->id; ?>" <?= !empty($city_id) && ($city_id == $row->id) ? 'selected' : ''; ?>><?= $row->city_name; ?>
                                                </option>
                                            <?php } ?> 
                                            

                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex">
                                        <label for="inputDate" class="form-label">Date of birth</label>
                                        <span class="text text-danger d-flex">*&nbsp; <?php echo form_error('date') ?>
                                    <span id="date_error" class="text text-danger"></span></span>
                                    </div>
                                    <div class="col-12">
                                        <input type="text" name="date" id="dobpicker"
                                            value="<?php echo set_value('date') ?>" class="form-control">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="d-flex">
                                        <label for="image" class="form-label">Upload Profile</label>
                                        <span class="text text-danger d-flex">* <?php echo form_error('image') ?><span id="image-error" class="text-danger d-flex"></span><span id="error" class="text-danger d-flex"></span>
                                        </span>
                                    </div>
                                    <input type="file" class="form-control" name="image" id="image" >
                                    <label style="font-size:12px;" class="text text-danger">Note:please upload png jpg type image</label>
                                </div>

                                <div class="form-group">
                                    <div class="d-flex">
                                        <label class="">Hobbies</label><span class="text text-danger d-flex"> *&nbsp;
                                            <?= form_error('hobby_id[]'); ?><span id="hobby-error" class="text text-danger"></span>
                                        
                                        </span>
                                    </div><br />
                                    <?php $checkbox_count = 0;
                                    foreach ($allhobbies as $hobbyrow) { ?>
                                        <input type="checkbox" id="hobby" name="hobby_id[]" value="<?= $hobbyrow->id ?>"
                                            <?= !empty($hobby_id) && in_array($hobbyrow->id, $hobby_id) ? 'checked' : ''; ?>>
                                        <?= $hobbyrow->hobby_title; ?>
                                        <?php $checkbox_count++;
                                        echo ($checkbox_count % 3 == 0 ? '<br>' : '');
                                    } ?>
                                </div>


                                <div class="col-12">
                                    <div class="d-flex">
                                        <label for="inputDate" class="form-label">gender :</label>
                                        <span class="text text-danger d-flex">*
                                            <?php echo form_error('gender') ?>
                                        <span id="gender-error" class="text text-danger"></span></span>

                                    </div>
                                    <input class="form-check-input" type="radio" name="gender" id="gridRadios1"
                                        value="Male" <?php echo  $gender=="Male"?"checked":""?>>
                                    <label class="form-check-label me-2" for="gender">
                                        male
                                    </label>

                                    <input class="form-check-input" type="radio" name="gender" id="gridRadios2"
                                        value="Female"<?php $gender=="Female"?"checked":""?>>
                                    <label class="form-check-label" for="gridRadios2">
                                        female
                                    </label>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex">
                                        <label for="inputDate" class="form-label">Status</label>
                                        <span class="text text-danger d-flex">*&nbsp;
                                            <?php echo form_error('status') ?></span>
                                    </div>

                                    <input class="form-check-input" type="radio" name="status" id="gridRadios1"
                                        value="Active" <?php echo $status == 'Active' ? '' : 'checked' ?>>
                                    <label class="form-check-label me-2" for="status">
                                        Active
                                    </label>

                                    <input class="form-check-input" type="radio" name="status" id="gridRadios2"
                                        value="Block" <?php echo $status == 'Block' ? '' : 'checked' ?>>
                                    <label class="form-check-label" for="gridRadios2">
                                        Block
                                    </label>
                                </div>

                        </div>

                        <div class="text-center">
                            <button type="submit" style="margin-bottom:20px" onclick="return validate();" class="btn me-2 btn-primary" >Submit</button>
                            <a style="margin-bottom:20px" href="<?php echo site_url("GuestController/getlist")?>" class="btn btn-danger">Cancel</a>
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
    <script src="<?= base_url('assets/ckeditor/ckeditor.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/toastr.js"></script>

</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.14.0/jquery-ui.min.js" integrity="sha512-MlEyuwT6VkRXExjj8CdBKNgd+e2H+aYZOCUaCrt9KRk6MlZDOs91V1yK22rwm8aCIsb5Ec1euL8f0g58RKT/Pg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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

    function validate(){
        var name = $("#name").val();
        var errorMsg = 'Required';
        
        var namePattern = /^[a-zA-Z\s]*$/;
        if(name==""){
         
             $("#name-error").text(errorMsg);
             $("#name").focus();
            return false;   
        }
        

        var email =$("#email").val();
        if(email==""){
            $("#email-error").text(errorMsg);
            $("#email").focus();
            return false;
        }

        var address =$("#address").val();
        $("#add-error").text("");
        if(address==""){
            $("#add-error").text(errorMsg);
            $("#address").focus();
            return false;
           
        }

        var country =$("#country_id").val();
        $("#country_error").text("");
        if(country==""){
            $("#country_error").text(errorMsg);
            $("#country_id").focus();
            return false;
        }

        var state =$("#state_id").val();
        $("#state_error").text("");
        if(state==""){
            $("#state_error").text(errorMsg);
            $("#state_id").focus();
            return false;
        }

        var state =$("#city_id").val();
        $("#city_error").text("");
        if(state==""){
            $("#city_error").text(errorMsg);
            $("#city_id").focus();
            return false;
        }

        var state =$("#dobpicker").val();
        $("#date_error").text("");
        if(state==""){
            $("#date_error").text(errorMsg);
            $("#dobpicker").focus();
            return false;
        }

        var image =$("#image").val();
        $("#error").text("");
        if(image == ""){
            $("#error").text(errorMsg);
            $("#image").focus();
            return false;
        }

        var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
        if(!allowedExtensions.exec(image)){
            $("#error").text("Please upload files having extensions .jpeg/.jpg/.png only.");
            $("#image").focus();
          
            return false;
        }
      

        if($('input[name="hobby_id[]"]:checked').length == 0){
            $("#hobby-error").text(errorMsg);
            $("#hobby").focus();
            return false;

        }

        if($('input[name="gender"]:checked').length == 0){
            $("#gender-error").text(errorMsg);
            $(".gender").focus();
            return false;

        }


    }
</script>


<script>
    $(document).ready(function(){
    $("#name").on('input', function(){
        var name = $(this).val();
        var errorMsg = "Only letters are allowed.";
        
        // Clear previous error message
        $("#name-error").text("");

        // Check if the input contains numbers
        if(/[^a-zA-Z\s]/.test(name)){
            $("#name-error").text(errorMsg);
            $(this).val(name.replace(/[^a-zA-Z\s]/g, '')); // Remove invalid characters
        }
    });
});


$(document).ready(function(){
    $("#email").on('input', function(){
        var email = $(this).val();
        var errorMsg = "Please enter a valid email address.";
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        // Clear previous error message
        $("#email-error").text("");

        // Check if the input is a valid email format
        if(!emailPattern.test(email)){
            $("#email-error").text(errorMsg);
        }
    });
});

</script>




</html>