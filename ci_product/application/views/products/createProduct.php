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
        label {
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
            <h1>Form Layouts</h1>

        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">

                <div class="col-lg-8 offset-2">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-center">Add Product</h5>

                            <!-- Vertical Form -->
                            <form class="row g-3" method="post"
                                Action="<?php echo site_url('ProductController/create_action'); ?>"
                                enctype="multipart/form-data">

                                <div class="col-12">
                                    <div class="d-flex">
                                        <label>Product sub-category</label>
                                        <span
                                            class="text text-danger d-flex">*<?php echo form_error("subcategory_id"); ?></span>
                                        <span id="sub_error" class="text text-danger"></span>
                                    </div>
                                    <select class="form-control" name="subcategory_id" id="subcategory_id">
                                        <option value="">--Select product sub-category--</option>
                                        <?php foreach ($getAlldata as $row) { ?>
                                            <option value="<?= $row->id; ?>" <?php echo !empty($subcategory_id) && $subcategory_id == $row->id ? 'selected' : ''; ?>>
                                                <?= $row->subcategory_name; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-12 ">
                                    <div class="d-flex">
                                        <label for="inputNanme4">Product Name</label>
                                        <span class="text text-danger d-flex">* &nbsp; <?php echo form_error('name');
                                        ?>
                                        </span>
                                        <span id="name_error" class="text text-danger"></span>
                                    </div>
                                    <input type="text" class="form-control" value="<?php echo $name ?>" name="name"
                                        id="name">

                                </div>
                                <div class="col-12 ">
                                    <div class="d-flex">
                                        <label for="inputNanme4">Description</label>
                                        <span class="text text-danger d-flex">* &nbsp; <?php echo form_error('description');
                                        ?>
                                        </span>
                                        <span id="des_error" class="text text-danger"></span>
                                    </div>
                                    <input type="text" class="form-control"
                                        value="<?php echo set_value('description') ?>" name="description"
                                        id="description">

                                </div>
                                <div class="col-12 ">
                                    <div class="d-flex">
                                        <label for="inputNanme4">Price</label>
                                        <span class="text text-danger d-flex">* &nbsp; <?php echo form_error('price');
                                        ?>
                                        </span>
                                        <span id="price_error" class="text text-danger"></span>
                                    </div>
                                    <input type="text" class="form-control" value="<?php echo $price; ?>" name="price"
                                        id="price" onkeypress="return isNumberKey(event)">

                                </div>

                                <div class="col-12 ">
                                    <div class="d-flex">
                                        <label for="inputNanme4">product Image</label>
                                        <span class="text text-danger d-flex">* &nbsp; <?php echo form_error('image');
                                        ?>
                                        </span>
                                        <span id="error" class="text text-danger"></span>
                                    </div>
                                    <input type="file" class="form-control" value="<?php echo set_value('image') ?>"
                                        name="image" id="image">
                                    <label style="font-size:12px;" class="text text-danger">Note:please upload png jpg
                                        type image</label>

                                </div>

                                <div class="col-12">
                                    <div class="d-flex">
                                        <label for="inputDate">Status</label>
                                        <span class="text text-danger d-flex">* &nbsp;
                                            <?php echo form_error('status') ?></span>

                                            <span id="status_error" class=" text text-danger"></span>
                                    </div>

                                    <input class="form-check-input" type="radio" name="status" id="gridRadios1"
                                        value="Active" <?php echo $status == 'Active' ? 'checked' : '' ?>>
                                    <label class="form-check-label me-2" for="status">
                                        Active
                                    </label>

                                    <input class="form-check-input" type="radio" name="status" id="gridRadios2"
                                        value="Block" <?php echo $status == 'Block' ? 'checked' : ''; ?> <label
                                        class="form-check-label" for="gridRadios2">
                                    Block
                                    </label>
                                </div>

                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary" onclick="return validate()">Submit</button>
                            <a href="<?php echo site_url("ProductController/manageproducts") ?>"
                                class="btn btn-danger">Cancel</a>
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
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "500",
        "hideDuration": "1000",
        "timeOut": "10000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    <?php if ($this->session->flashdata('success')) { ?>
        toastr.success('<?php echo $this->session->flashdata('success'); ?>');
    <?php } ?>

    <?php if ($this->session->flashdata('warning')) { ?>
        toastr.warning('<?php echo $this->session->flashdata('warning'); ?>');
        console.log('Warning: <?php echo $this->session->flashdata('warning'); ?>');
    <?php } ?>

    <?php if ($this->session->flashdata('error')) { ?>
        toastr.error('<?php echo $this->session->flashdata('error'); ?>');
    <?php } ?>

    <?php if ($this->session->flashdata('info')) { ?>
        toastr.info('<?php echo $this->session->flashdata('info'); ?>');
    <?php } ?>
</script>

<script>
    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }

    function validate() {

        var name = $("#name").val();
        var msg = "Required";

        $("#name_error").text("");
        if (name == "") {

            $("#name_error").text(msg);
            $("#name").focus();
            return false;
        }

        var sub = $("#subcategory_id").val();

        $("#sub_error").text('');
        if (sub == "") {
            $("#sub_error").text(msg);
            $("#subcategory_id").focus();
            return false;
        }

        var des = $("#description").val();
        $("#des_error").text("");
        if (des == "") {
            $("#des_error").text(msg);
            $("#description").focus();
            return false;
        }


        var proce = $("#price").val();
        $("#price_error").text("");
        if (proce == "") {
            $("#price_error").text(msg);
            $("#price").focus();
            return false;
        }


        var image =$("#image").val();
        $("#error").text("");
        if(image == ""){
            $("#error").text(msg);
            $("#image").focus();
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

</html>