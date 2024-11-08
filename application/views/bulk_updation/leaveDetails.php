<br>
<style type="text/css">
  .thead-color{
   background: #bac9e2 !important;
  }
</style>
  <div class="employee-dashboard">
    <div class="row"> 
            <div class="col-sm-12">
              <div class="panel panel-default" style="background: #3278ab !important;font-size: 13px">
                <div class="panel-heading"><i class="fa fa-search"></i> Search Criteria</div>
                <div class="" style="background: white !important;border:1px solid #3278ab;padding: 20px;">
                  <form class="form-inline" action="<?php echo base_url('bulk_updation/leaveDetails'); ?>" method="post" autocomplete="off">
              <div class="form-group">
                <label>Employee Type:</label><span class="req"> *</span>
                <select class="form-control" name="employeetype" required>
                  <option value="">Select</option>
                  <?php foreach ($employeeType as $key => $value) { ?>
                    <option value="<?php echo $key; ?>" <?php if(set_value('employeetype')==$key){ echo "selected"; } ?>><?php echo $value; ?></option>
                  <?php } ?>
                </select>
              </div>
              <button type="submit" class="btn btn-success" name="search"><i class="fa fa-search"></i> Search</button>
            </form>
                </div>
            </div>
            </div>
        </div>

    <?php if(isset($employeeList)) { ?>
      <div class="row"> 
          <div class="col-sm-12">
            <div class="panel panel-default" style="background: #3278ab !important;color: white;font-size: 13px">
              <div class="panel-heading"><i class="fa fa-edit"></i> Employee Leave Updation</div>
              <div class="table-responsive" style="background: white !important;border:1px solid #3278ab;color: white;"><br />
                  <table class='table table-bordered table-striped dataTable'>
                    <thead>
                      <tr>
                        <th class="thead-color text-center">Employee ID</th>
                        <th class="thead-color text-center">Name</th>
                        <th class="thead-color text-center">Desi.</th>
                        <th class="thead-color text-center">Date Of Joining</th>
                        <th class="thead-color text-center">Date of Birth</th>
                        <th class="thead-color text-center">CL</th>
                        <th class="thead-color text-center">EL</th>
                        <th class="thead-color text-center">ML</th>
                        <th class="thead-color text-center">HPL</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($employeeList as $key => $value) { ?>
                        <tr>
                          <td class="text-center"><?php echo $value['EMPID']; ?></td>
                          <td class="text-center"><?php echo $value['EMP_FNAME'] . ' ' .$value['EMP_MNAME'].' ' .$value['EMP_LNAME'] ; ?></td>
						  <td class="text-center"><?php echo $value['DESIG']; ?></td>
                          <td class="text-center"><?php echo date("d-M-Y", strtotime($value['D_O_J'])); ?></td>
                          <td class="text-center"><?php echo date("d-M-Y", strtotime($value['D_O_B'])); ?></td>
                          <td class="text-center contenteditable"><?php echo $value['CAS_LEAVE']; ?></td>
                          <td class="text-center contenteditable"><?php echo $value['EL']; ?></td>
                          <td class="text-center contenteditable"><?php echo $value['ML']; ?></td>
                          <td class="text-center contenteditable"><?php echo $value['hpl']; ?></td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
              </div>
          </div>
          </div>
      </div>
    <?php } ?>
    </div>




<br>

<script type="text/javascript">
     $(function () {
		$('.dataTable').dataTable({    
			dom: 'Bfrtip',
			paging: false,
			buttons: [
				{
					extend: 'excelHtml5',
					title: 'Excel',
					text:'Export to excel'
				}
			]
		});
	  });
</script>