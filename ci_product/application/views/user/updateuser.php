<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Forms / Layouts - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.14.0/themes/base/jquery-ui.min.css" integrity="sha512-F8mgNaoH6SSws+tuDTveIu+hx6JkVcuLqTQ/S/KJaHJjGc8eUxIrBawMnasq2FDlfo7FYsD8buQXVwD+0upbcA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
   <?php $this->load->view('common/header')?>
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
 
  <?php $this->load->view('common/siderbar')?>
  <!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Update user</h1>
      
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">

        <div class="col-lg-8 offset-2">

          <div class="card">
            <div class="card-body">
             

              <!-- Vertical Form -->
              <form class="row g-3" method="post" Action="<?php echo site_url('UserController/userUpdate_Action'); ?>" enctype="multipart/form-data">
                <div class="col-12 has-validation">
                  <input type="hidden" name="id" value="<?php echo $id?>">
                  <label for="inputNanme4" class="form-label">Your Name</label>
                  <span class="text text-danger">* <?php echo form_error('name');
                   ?> <span id="name-error" class="text text-danger"></span>
                  </span>
                
                  <input type="text" class="form-control" 
                 value="<?php echo $name; ?>"
                  name="name" id="inputNanme4">

                </div>
                <div class="col-12">
                  <label for="inputEmail4" class="form-label">Email</label>
                  <span class="text text-danger">* <?php echo form_error('email'); ?>
                  <span id="email-error" class="text text-danger"></span>
                  </span>

                  <input type="email" class="form-control" name="email"
                  value="<?php echo $email; ?>"
                   id="inputEmail4">
                </div>

                <div class="col-12">
                  <label for="mobile" class="form-label">Mobile</label>
                  <span class="text text-danger">* <?php echo form_error('mobile'); ?>
                  <span id="add-error" class="text text-danger"></span>
                  </span>
                  <input type="text" class="form-control"
                  value="<?php echo $number; ?>"
                   name="number">
                </div>
              
               
                <div class="col-12">
                  <label for="inputDate" class="form-label">Date of birth</label>
                  <span class="text text-danger">* <?php echo form_error('date') ?>
                  <span id="date_error" class="text text-danger"></span>
                </span>
                    <div class="col-122">
                      <input type="text" name="date"
                      id="dobpicker"
                      value="<?php echo $dob; ?>"
                       class="form-control">
                    </div>
                </div>
                <div class="col-12">
                  <label for="image" class="form-label">Upload Profile</label>
                  <span class="text text-danger">* <?php echo form_error('image') ?>
                  </span>
                    <input type="file" class="form-control" name="image" id="image" placeholder="">
                    <img width="100px" src="<?php echo base_url('uploads/userimage/').$image?>">
                    
                </div>

                <div class="form-group">
												<label class="form-label">Hobbies</label><span class="text text-danger"> * <?php ?><span id="hobby-error" class="text text-danger"></span></span><br/>
													<?php $checkbox_count=0;
													foreach($allhobbies as $hobbyrow) {?>		
														<input type="checkbox" name="hobby_id[]" value=" <?= $hobbyrow->id?>" <?= !empty($hobby_id) && in_array($hobbyrow->id,$hobby_id)?'checked':''; ?>> <?= $hobbyrow->hobby_title; echo " "; ?>&nbsp;
													<?php	$checkbox_count++;
														echo($checkbox_count%3==0?'<br>':'');
													}?>
											</div>	

                <div class="col-12">
                  <label for="inputDate" class="form-label">gender </label>
                  <span class="text text-danger">* <?php echo form_error('gender') ?>
                  <span id="gender-error" class="text text-danger"></span></span>

                  <input class="form-check-input" type="radio" name="gender"
                  <?php echo $gender=='Male'?'checked':" " ?>

                   id="gridRadios1" value="Male">
                  <label class="form-check-label me-2" for="gender">
                    male
                  </label>

                  <input class="form-check-input" type="radio" name="gender"
                   <?php echo $gender=='Female'?'checked':" " ?>
               
                  id="gridRadios2" value="Female">
                  <label class="form-check-label" for="gridRadios2">
                    female
                  </label>
                </div>

                <!-- dib -->

                <div class="col-12">
                  <label for="inputDate" class="form-label">status :</label>
                  <span class="text text-danger">* <?php echo form_error('status') ?>
                  <span id="status-error" class="text text-danger"></span></span>

                  <input class="form-check-input" type="radio" name="status"
                   id="gridRadios3" value="Active"  <?php echo $status=='Active'?'checked':" " ?>>
                  <label class="form-check-label me-2" for="gender">
                    Active
                  </label>

                  <input class="form-check-input" type="radio" name="status"
               
                  id="gridRadios4" value="Block"  <?php echo $status=='Block'?'checked':" " ?>>
                  <label class="form-check-label" for="gridRadios2">
                    Block
                  </label>
                
                </div>

            </div>

            <div class="text-center">
              <button type="submit" class="btn btn-primary">Update</button>
              <a href="<?php echo site_url("UserController/userList")?>" class="btn btn-danger">Cancel</a>
            </div>
            </form><!-- Vertical Form -->

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
  function isNumberKey(evt) {
  var charCode = (evt.which) ? evt.which : evt.keyCode
  if (charCode > 31 && (charCode < 48 || charCode > 57))
    return false;
  return true;
}


//name
function alphaonly(evt){
  var charCode = (evt.which) ? evt.which : evt.keyCode
  if (charCode > 31 && (charCode < 65 || charCode > 122))
    return false;
  return true;

}
</script>

<script>

    function validate(){
        var name = $("#name").val();
        var errorMsg = 'Required';
        
    
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

        var address =$("#mobile").val();
        $("#add-error").text("");
        if(address==""){
            $("#add-error").text(errorMsg);
            $("#mobile").focus();
            return false;
           
        }

      

        var state =$("#date").val();
        $("#date_error").text("");
        if(state==""){
            $("#date_error").text(errorMsg);
            $("#date").focus();
            return false;
        }

       
      
        $("#hobby-error").text("");
        if($('input[name="hobby_id[]"]:checked').length == 0){
            $("#hobby-error").text(errorMsg);
            $("#hobby").focus();
            return false;

        }
        $("#gender-error").text("");
        if($('input[name="gender"]:checked').length == 0){
            $("#gender-error").text(errorMsg);
            $(".gender").focus();
            return false;

        }

        if($('input[name="status"]:checked').length == 0){
            $("#status-error").text(errorMsg);
            $(".status").focus();
            return false;

        }

        var pass = $("#password").val();
        if(pass==""){
          $("#password-error").text(errormserrorMsg);
          $("#password").focus();
          return false;
        }


    }
</script>

</html>