<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Create Blog</title>
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
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">

                <div class="col-lg-8 offset-2">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-center">Add Blog </h5>

                            <!-- Vertical Form -->
                            <form class="row g-3" method="post"
                                Action="<?php echo site_url('BlogsController/create_action'); ?>"
                                enctype="multipart/form-data">


                                <div class="form-group">
                                    <div class="d-flex">
                                        <label class="label-form">Blog-category</label><span
                                            class="text text-danger d-flex"> *&nbsp;
                                            <?= form_error('blogcat_id') ?>
                                            <span id="error" text text-danger></span></span>
                                    </div>
                                    <div>
                                        <select name="blogcat_id" id="blogcat_id" class="form-control">
                                            <option value="">--Select blog category--</option>
                                            <?php foreach ($getblogcat as $row) { ?>
                                                <option value="<?= $row->id; ?>" <?= !empty($blogcat_id) && $blogcat_id == $row->id ? 'selected' : ''; ?>>
                                                    <?= $row->title; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 ">
                                    <div class="d-flex">
                                        <label>Blog Title</label>
                                        <span class="text text-danger d-flex">*&nbsp; <?php echo form_error('name');
                                        ?><span id="name-error" class="text text-danger"></span>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" value="<?php echo $name ?>" name="name"
                                        id="name">

                                </div>
                                <div class="col-12">
                                    <div class="d-flex">
                                        <label>Content</label>
                                        <span class="text text-danger d-flex">*&nbsp;
                                            <?php echo form_error('content'); ?>
                                            <span id="content_error" class="text-text-danger"></span>
                                        </span>
                                    </div>
                                    <textarea class="form-control" name="content" id="content"
                                        rows="4"><?php echo $content; ?></textarea>
                                </div>

                                <div class="col-12 ">
                                    <div class="d-flex">
                                        <label>image</label>
                                        <span class="text text-danger d-flex">*&nbsp; <?php echo form_error('image');
                                        ?><span id="image_error" class="text-text-danger"></span>
                                    </div>
                                    <input type="file" class="form-control" name="image" id="image" />
                                    <label style="font-size:12px;" class="text text-danger">Note:please upload png jpg type image</label>

                                </div>


                                <div class="col-12">

                                    <div class="d-flex">
                                        <label>Status</label>
                                        <span class="text text-danger d-flex">* &nbsp<?php echo form_error('status') ?> <span class="text text-danger d-flex">
                                    
                                    </span>
                                    </div>
                                    <input class="form-check-input" type="radio" name="status" id="gridRadios1"
                                        value="Active" <?php echo $status == 'Active' ? 'checked' : '' ?>>
                                    <label class="form-check-label me-2" for="status">
                                        Active
                                    </label>

                                    <input class="form-check-input" type="radio" name="status" id="gridRadios2"
                                        value="Block" <?php echo $status == 'Block' ? 'checked' : '' ?>>
                                    <label>
                                        Block
                                    </label>
                                </div>

                        </div> 

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary" onclick="return validate();">Submit</button>
                            <a href="<?php echo site_url("BlogsController/getalldata") ?>"
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


    <script src="<?php echo base_url(); ?>assets/js/toastr.js"></script>

</body>
<?php $this->load->view("common/footer") ?>




<script>
    function validate() {

        var errormsg = "Required";


        var blogcat_id = $("#blogcat_id").val();
        $("#blogcat_id").text();
        if (blogcat_id == "") {
            $("#error").text(errormsg);
            $("#blogcat_id").focus();
            return false;
        }

        var name = $("#name").val();
        $("#name").text("");
        if (name == "") {
            $("#name-error").text(errormsg);
            $("#name").focus();
            return false;
        }

        

        var content = $("#content").val();
        $("#content_error").text("");
        if (content == "") {
            $("#content_error").text(errormsg);
            $("#content").focus();
            return false;
        }

        var image = $("#image").val();
        $("#image_error").text("");

        $("#image_error").text("");
        if (image == "") {
            $("#image_error").text(errormsg);
            $("#image").focus();
            return false;
        }

        var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
        if (!allowedExtensions.exec(image)) {
            $("#image_error").text("Please upload files having extensions .jpeg/.jpg/.png only.");
            $("#image").focus();

            return false;
        }

        if($('input[name="status"]:checked').length == 0){
            $("#status-error").text(errorMsg);
            $(".status").focus();
            return false;

        }

    }
</script>

<script>
    $(document).ready(function () {
        $("#name").on('input', function () {
            var name = $(this).val();
            var errorMsg = "Only letters are allowed.";

            // Clear previous error message
            $("#name-error").text("");

            // Check if the input contains numbers
            if (/[^a-zA-Z\s]/.test(name)) {
                $("#name-error").text(errorMsg);
                $(this).val(name.replace(/[^a-zA-Z\s]/g, '')); // Remove invalid characters
            }
        });
    });



</script>


</html>