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
      <h1>Lead Stages</h1>
     
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
            <form method="post" action="<?= site_url("LeadStageController/export")?>">
									&nbsp;<button type="submit" id="idbtn" class="btn btn-primary mt-3">Export</button>
									<input type="hidden" class="collectid " name="collectid"/>
								</form>

              <a href="<?php echo site_url('LeadStageController/create') ?>" class="btn btn-primary bx-pull-right me-5">create
              </a>
              <br>
              <br>

              <!-- Table with stripped rows -->
           <form method="post" action="<?php echo site_url("LeadStageController/deleteall_action")?>">
           <table class="table datatable">
                <thead>
                  <tr>
                    <th>
                      <input type="checkbox" name="checkall" onclick="check();" />
                    </th>
                    <th>Sr No.</th>
                    <th>
                      Lead Stages
                    </th>
                   
                    <th>Description</th>
                               
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($getlist)): ?>
                    <?php $s = 1;
                    foreach ($getlist as $row): ?>
                      <tr>
                        <td><input type="checkbox" class="stageid" name="selector[]" value="<?php echo $row->id ?>"></td>
                     <td><?php echo $s ;?></td>
                        <td><?php echo $row->s_title; ?></td>
                    

                        <td><?php echo $row->description; ?></td>

                        <td>
                          <?php $status = $row->status; ?>
                          <button class="btn btn-status <?php echo ($status == 'Active') ? 'btn-success' : (($status == 'Pending') ? 'btn-warning' : 'btn-danger'); ?>" data-id="<?php echo $row->id; ?>"
                            data-status="<?php echo $status; ?>">
                            <?php echo $status; ?>
                          </button>
                        </td>

                        <td>
                         
                          <a href="<?php echo site_url('LeadStageController/update/' . $row->id) ?>" class=" me-3"><i
                              class="bi bi-pencil"></i></a>
                          <a href="<?php echo site_url('LeadStageController/delete/' . $row->id) ?>"  onclick="return confirm('Do you really want to delete this record')"
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
              <!-- End Table with stripped rows -->

              <div class="row">
        <div class="card col-lg-6 col-md-6 col-sm-6 col-xs-12 box">
								<form method="post" action="<?php echo site_url("LeadStageController/import") ?>" enctype="multipart/form-data">
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

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php $this->load->view('common/footer') ?>
  <?php $this->load->view('common/logout') ?>
  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <?php $this->load->view("common/script") ?>


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
				 $('.stageid').each(function(){
					 ID.push($(this).val());
				 });
				 $('.collectid').val(ID);
			});
		</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>