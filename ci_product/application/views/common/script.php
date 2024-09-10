<!-- Vendor JS Files -->
<script   src="<?php echo base_url() ?>assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/chart.js/chart.umd.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/echarts/echarts.min.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/quill/quill.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
 

  <script src="<?php echo base_url() ?>assets/js/main.js"></script>

  <script src="<?php echo base_url() ?>assets/js/jquary.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/toastr.js"></script>

  <script>
    var myModal = document.getElementById('myModal')
var myInput = document.getElementById('myInput')

myModal.addEventListener('shown.bs.modal', function () {
  myInput.focus()
})
</script>

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