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
            <h1>Update Blogs</h1>
           
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">

                <div class="col-lg-8 offset-2">

                    <div class="card">
                        <div class="card-body">
                            <!-- <h5 class="card-title text-center">update Blog Category</h5> -->

                            <!-- Vertical Form -->
                            <form class="row g-3" method="post"
                                Action="<?php echo site_url('BlogsController/update_action'); ?>"
                                enctype="multipart/form-data">


                                <div class="form-group">
                                   <div class="d-flex">
                                   <label>select Blog-category</label><span class="text text-danger d-flex"> *
                                   <?= form_error('blogcat_id') ?>
                                   <span class="text text-danger" id="error"></span>
                                </span>
                                   </div>
                                    <div>
                                        <select name="blogcat_id" id="blogcat_id" class="form-control">
                                            <option value="">--Select blog category--</option>
                                            <?php foreach ($getblogcat as $row) { ?>
                                                <option value="<?= $row->id; ?>" <?= !empty($blogcat_id) && $blogcat_id == $row->id ? 'selected' : ''; ?>>
                                                    <?= $row->title; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 ">
                                    <div class="d-flex">
                                        <label>Blog Title</label>
                                        <span class="text text-danger d-flex">* <?php echo form_error('name');
                                        ?><span id="name-error" class="text text-danger"></span>
                                        </span>
                                    </div>
                                    <input type="hidden" name="id" value="<?php echo $id?>">
                                    <input type="text" class="form-control" value="<?php echo $name ?>" name="name"
                                        id="name">

                                </div>
                                <div class="col-12">
                                    <div class="d-flex">
                                        <label>Content</label>
                                        <span class="text text-danger d-flex">* <?php echo form_error('content'); ?>
                                            <span id="content-error" class="text-text-danger"></span>
                                        </span>
                                    </div>
                                    <textarea class="form-control" name="content" id="content"
                                        rows="4"><?php echo $content; ?></textarea>
                                </div>
                                </div>

                                <div class="col-12 ms-4 ">
                                    <div class="d-flex">
                                        <label">image</label>
                                        <span class="text text-danger">* <?php echo form_error('image');
                                        ?><span id="image-error" class="text text-danger"></span>
                                     </span>
                                    </div>
                                    <input type="file" class="form-control" value="<?php echo $file ?>"
                                        name="image" id="image">
                                        <img width="50px" src="<?php echo base_url("uploads/blogsimage/").$image;?>">

                                </div>


                                <div class="col-12">

                                    <div class="d-flex">
                                        <label class="ms-4">Status</label>
                                        <span class="text text-danger d-flex">*<?php echo form_error('status') ?></span>
                                    </div>
                                    <input class="form-check-input" type="radio" name="status" id="gridRadios1"
                                        value="Active" <?php echo $status == 'Active' ? 'checked' : '' ?>>
                                    <label class="form-check-label me-2" for="status">
                                        Active
                                    </label>

                                    <input class="form-check-input" type="radio" name="status" id="gridRadios2"
                                        value="Block" <?php echo $status == 'Block' ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="gridRadios2">
                                        Block
                                    </label>
                                </div>

                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="<?php echo site_url("BlogsController/getalldata")?>" class="btn btn-danger">Cancel</a>
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
            var nameValue = $(this).val();
            var errorMsg = '';

            // Validate the name (e.g., only letters and spaces are allowed)
            var namePattern = /^[a-zA-Z\s]*$/;

            if (nameValue.trim() === '') {
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

        //content

        $('#content').on('input', function () {
            var nMEValue = $(this).val();
            var errorMsg = '';

            // Check if the field is empty
            if (nMEValue.trim() === '') {
                errorMsg = 'content field should not be empty.';
            }

            // Display the error message or remove it if no error
            $('#content-error').text(errorMsg);

            if (errorMsg !== '') {
                $('#content-error').stop(true, true).fadeIn().text(errorMsg);
            } else {
                $('#content-error').stop(true, true).fadeOut();
            }
        });

        //blog category

        $('#blogcat_id').on('input', function () {
            var nMEValue = $(this).val();
            var errorMsg = '';

            // Check if the field is empty
            if (nMEValue.trim() === '') {
                errorMsg = 'cotegory field field should not be empty.';
            }

            // Display the error message or remove it if no error
            $('#error').text(errorMsg);

            if (errorMsg !== '') {
                $('#error').stop(true, true).fadeIn().text(errorMsg);
            } else {
                $('#error').stop(true, true).fadeOut();
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


        //image

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