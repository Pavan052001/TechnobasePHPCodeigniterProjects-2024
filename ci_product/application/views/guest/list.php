<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Tables / Data - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->

  <?php $this->load->view('common/headlink') ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

</head>

<body>

  <!-- ======= Header ======= -->
  <?php $this->load->view('common/header') ?>

  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <?php $this->load->view('common/siderbar') ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Guests</h1>
      
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
            <form method="post" action="<?= site_url("GuestController/export")?>">
									&nbsp;<button type="submit" id="idbtn" class="btn btn-primary mt-3">Export</button>
									<input type="hidden" class="collectid " name="collectid"/>
								</form>

              <a href="<?php echo site_url('GuestController/create') ?>" class="btn btn-primary bx-pull-right me-5">Create
              </a>
              <br>
              <br>

              <!-- Table with stripped rows -->
              <form method="post" action="<?php echo site_url("GuestController/deleteall_action")?>">
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>
                      <input type="checkbox" name="checkall" onclick="check();" />
                    </th>
                    <th>Sr No.</th>
                    <th>Profile</th>
                    <th>
                      Name
                    </th>
                    <th>Email</th>
                    <th>Country</th>
                    <th>state</th>
                    <th>city </th>
                   
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($getall)): ?>
                    <?php $s = 1;
                    foreach ($getall as $row): ?>
                      <tr>
                        <td><input type="checkbox" class="guestid" name="selector[]" value="<?php echo $row->id ?>"></td>
                     <td><?php echo $s ;?></td>
                     <td><img src="<?= base_url();?>uploads/guestimage/<?= $row->photo?>" width="50px"/></td> 

                        <td><?php echo $row->name; ?></td>

                        <td><?php echo $row->email_address; ?></td>
                       
                        <td><?php echo $row->country_name;?></td>
                        <td><?php echo $row->state_name?></td>
                        <td><?php echo $row->city_name?></td>
                        
                        
                        <td>
                          <?php $status = $row->status; ?>
                          <button type="button" class="btn btn-status <?php echo ($status == 'Active') ? 'btn-success' : (($status == 'Pending') ? 'btn-warning' : 'btn-danger'); ?>" data-id="<?php echo $row->id; ?>"
                            data-status="<?php echo $status; ?>">
                            <?php echo $status; ?>
                          </button>
                        </td>

                        <td>
                          <a href="<?php echo site_url('GuestController/view/' . $row->id) ?>" class=" me-3"><i
                              class="bi bi-eye-fill"></i></a>
                          <a href="<?php echo site_url('GuestController/update/' . $row->id) ?>" class=" me-3"><i
                              class="bi bi-pencil"></i></a>
                          <a href="<?php echo site_url('GuestController/delete/' . $row->id) ?>"
                            onclick="return confirm('Do you really want to delete this record')"
                            class=""><i class="bi bi-trash"></i></a>
                        </td>

                        <!-- Add more fields as per your data structure -->
                      </tr>
                      <?php $s++; endforeach; ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="3">No users found.</td>
                    </tr>
                  <?php endif; ?>
                </tbody>
                <tfoot>
													<tr>
														<td colspan="9">
															<button type ="submit" name="deleteall" class="btn btn-danger" onclick="return confirm('Do you really want to delete selected records');">Delete All</button>
														</td>
													</tr>
								</tfoot>

              </table>
              </form>
              <div class="row">
        <div class="card col-lg-6 col-md-6 col-sm-6 col-xs-12 box">
								<form method="post" action="<?php echo site_url("GuestController/import") ?>" enctype="multipart/form-data">
									<div class="panel panel-default">						
										<div class=" panel-heading">
											  <h3 class="panel-title"> Import record </h3>
										</div>
										<div class="panel-body">  
											<div class="form-group">
												<label>Select Excel File </label>
												<div>
													<input type="file" name="file" id="file" class="form-control"/>
												</div>
											</div>	
										</div>	
										<div class="panel-footer">
											<div>&nbsp; <br/>
												<button type="submit" name="upload" value="upload" class="btn btn-success btn-sm">Import</button>
												
											</div>
										</div>									
									</div>
								</form>
								</div>
        </div>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php $this->load->view('common/footer') ?>
  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <?php $this->load->view("common/script") ?>
  <?php $this->load->view("common/logout") ?>


  


  <!-- multiple delete -->
<script>
  var checkflag = "false";
function check()
{
	 var field = document.getElementsByName('selector[]');
	if(checkflag == "false")
	{
		for(i = 0;i < field.length; i++)
		{
			 field[i].checked = true;
		}
		checkflag="true";
		return "Check All";
	}
	else
	{
		for(i=0 ;i < field.length; i++)
		{
			field[i].checked = false;
		}
		checkflag = "false";
		return "Uncheck All";
	} 
}
</script>
<script>
			$("#idbtn").click(function(){
				var ID = new Array();
				 $('.guestid').each(function(){
					 ID.push($(this).val());
				 });
				 $('.collectid').val(ID);
			});
		</script>


  <script src="<?php echo base_url(); ?>assets/js/toastr.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.btn-status').click(function() {
        var Id = $(this).data('id');
        alert(Id);

        var currentButton = $(this);
        if(confirm("You want to update user status ?? ")){

        $.ajax({
            url: "<?php echo site_url('GuestController/updateStatus'); ?>",
            type: "POST",
             data: { id:Id },
            dataType: "json",
            success: function(response) {
                if (response.status == 'success') {
                    var newStatus = response.new_status;
                    currentButton.text(newStatus);
                    if (newStatus == 'Active'){
                        currentButton.removeClass('btn-warning btn-danger').addClass('btn-success');
                        toastr.success('status update successfully!');
                    } else if (newStatus == 'Pending') {
                        currentButton.removeClass('btn-success btn-danger').addClass('btn-warning');
                        toastr.success('status update successfully!');
                      } else{
                        currentButton.removeClass('btn-success btn-warning').addClass('btn-danger');
                        toastr.success('status update successfully!');
                      }
                } else {
                    alert('Failed to update user status.');
                }
            },
            error: function() {
                alert('Error updating status.');
            }
        });
      }
    });
});
</script>
</body>

</html>