<style type="text/css">
 
   .loader {
      position: fixed;
      top: 50%;
      left: 50%;
        border: 16px solid #f3f3f3; /* Light grey */
        border-top: 16px solid #3498db; /* Blue */
        border-radius: 50%;
        width: 120px;
        height: 120px;
        animation: spin 2s linear infinite;
      }

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
  .absent {
    background-color: #ff8793;
  }
  .present {
    background-color: #a3dba2;
  }
  .late_in {
    background-color: #ffb37c;
  }
  .before_out {
    background-color: #458ac6;
    color: white;
  }
  .late_in_before_out {
    background-color: #d61515;
    color: white;
  }
  .holiday {
    background-color: #e9eda6;
  }
  div.zabuto_calendar ul.legend>span
  {
    color: black;
    font-size: 15px;
    font-weight: bold;
  }
  .error{
    color: red;
  }
</style>
	 <style>
	.table > thead > tr > th,
	.table > tbody > tr > th,
	.table > tfoot > tr > th,
	.table > thead > tr > td,
	.table > tbody > tr > td,
	.table > tfoot > tr > td {
		white-space: nowrap !important;
	  }
	  .table > thead > tr > th,
	.table > tbody > tr > th,
	.table > tfoot > tr > th,
	.table > thead > tr > td,
	.table > tbody > tr > td,
	.table > tfoot > tr > td {
		border:1px solid grey
	  }
	  
	 button.dt-button, div.dt-button, a.dt-button {
	  padding:2px;
  }
  .dataTables_paginate .paginate_button.current {
	 padding:2px;  
  }
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">CBSE STUDENT DATA</a> <i class="fa fa-angle-right"></i> STUDENTS LIST</li>
</ol>
  <!-- Content Wrapper. Contains page content -->
  <div class="employee-dashboard">

      <section class="content">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item" onclick=" window.history.back();"><a href="#" ><i class="fa fa-angle-double-left"></i> BACK</a></li>
    <li class="breadcrumb-item"><a href="#">CLASS XI</a></li>
  
</ol>


<section class="content">
  <div class="row">
	<div class="col-12">
	  <div class="card">
		<table class='table'>
			<tr>
				<th>Start Date</th>
				<td><input type='text' id='start_date' class='form-control datepicker'onchange='startDate(this.value)' autocomplete='off'></td>
				<th>End Date</th>
				<td><input type='text' id='end_date' class='form-control datepicker'onchange='endDate()' disabled autocomplete='off'></td>
				<th>Verified Status</th>
				<td>
					<select id='verified_status' class='form-control' onchange='verifiedReportDateRange()' disabled>
						<option value=''>Select</option>
						<option value='1'>Verified</option>
						<option value='0'>Pending</option>
					
					</select>
				</td>
			</tr>
		</table>
	  </div>
	</div>
  </div>

  
  <div class="row">
	<div class="col-12">
	  <div class="card">
		<div class="card-body table-responsive">
		  <table id="example1" class="table table-striped">
			<thead>
			<tr>
				<th><strong>Stream</strong></th>
			  <th><strong>Name</strong></th>
			  <th><strong>DOB</strong></th>
			  <th><strong>ADM. No.</strong></th>
				<th><strong>Token No.</strong></th>
				<th><strong>Board Roll</strong></th>
				<th><strong>Aadhaar Card</strong></th>
				
				<th><strong>Gender</strong></th>
				<th><strong>Category</strong></th>
				<th><strong>Email</strong></th>
				<th><strong>Father Name</strong></th>
				<th><strong>Mother Name</strong></th>
				<th><strong>Address</strong></th>
				<th><strong>City</strong></th>
				<th><strong>PIN</strong></th>
				<th><strong>State</strong></th>
				<th><strong>School Name</strong></th>
				<th><strong>Board</strong></th>
				<th><strong>Passing Year</strong></th>
				<th><strong>Section</strong></th>
				<th><strong>Final Stream</strong></th>
				<th><strong>Final Subject</strong></th>
				<th><strong>Admission Date</strong></th>
				<th><strong>Only Child</strong></th>
				<th><strong>Minority</strong></th>
				<th><strong>Handi Cap</strong></th>
				<th><strong>Annual Income</strong></th>
				<th><strong>Transaction ID</strong></th>
				<th><strong>MMP TXN</strong></th>
				<th><strong>Description</strong></th>
				<th><strong>Client Code</strong></th>
			  <th><strong>Mobile</strong></th>
			  <th><strong>Pay Status</strong></th>
			  <th><strong>Verify</strong></th>
			  <th><strong>Edit</strong></th>
			</tr>
			</thead>
			<tbody id='load'>
			<?php
				
				foreach($stuData as $key => $val){
					?>
						<tr>
							
							<td> <?php echo $val['FinalStream']; ?></td>
							<td><i class="	fa fa-user-o"></i> <?php echo $val['Sname']; ?></td>
							<td><?php echo date('d-M-Y',strtotime($val['DOB'])); ?></td>
							<td><?php echo $val['AdmNo']; ?></td>
							<td><?php echo $val['TokenNo']; ?></td>
							<td><?php echo $val['BoardRollNo']; ?></td>
							<td><?php echo $val['AadhaarCard']; ?></td>
							<td><?php echo $val['Gender']; ?></td>
							<td><?php echo $val['Category']; ?></td>
							<td><?php echo $val['Email']; ?></td>
							<td><?php echo $val['FatherName']; ?></td>
							<td><?php echo $val['MotherName']; ?></td>
							<td><?php echo $val['Address']; ?></td>
							<td><?php echo $val['City']; ?></td>
							<td><?php echo $val['PIN']; ?></td>
							<td><?php echo $val['State']; ?></td>
							<td><?php echo $val['Name_School']; ?></td>
							<td><?php echo $val['Board']; ?></td>
							<td><?php echo $val['Year_of_Pass']; ?></td>
							<td><?php echo $val['Section']; ?></td>
							<td><?php echo $val['FinalStream']; ?></td>
							<td><?php echo $val['FinalSubject']; ?></td>
							<td><?php echo date('d-M-Y',strtotime($val['DOA'])); ?></td>
							<td><?php echo $val['only_child']; ?></td>
							<td><?php echo $val['minority']; ?></td>
							<td><?php echo $val['handicap']; ?></td>
							<td><?php echo $val['annual_income']; ?></td>
							<td><?php echo $val['transaction_id']; ?></td>
							<td><?php echo $val['mmp_txn']; ?></td>
							<td><?php echo $val['desc']; ?></td>
							<td><?php echo $val['TokenNo']; ?>_<?php echo $val['AdmNo']; ?>_<?php echo $val['Section']; ?></td>
							<td><?php echo $val['Mobile']; ?></td>
								<td>
								<?php
				
									if(strtolower($val['f_code'])=='ok'){
								?>
									<span class="text-success">Completed</span>
								
								<?php } else{ ?>
								<span class="text-danger"></span>
								<?php }?>
								
							</td>
							<td>
								<?php
									if($val['verify'] == 0){
								?>
								<span class="text-danger">PENDING</span>
								<?php } else{ ?>
								<span class="text-success">VERIFIED</span>
								<?php }?>
								
							</td>
							<td>
						
								
								<a href="<?php echo base_url('Cbse_verify_admin/cbse_verification/viewdata_xi/'.$val['ID']); ?>" class='btn btn-info btn-xs' title='EDIT' >
								  <i class="fa fa-edit" style="color:white"></i>
								</a>
								
									<?php
									if($val['verify'] == 1){
								?>
								<a href="<?php echo base_url('Cbse_verify_admin/cbse_verification/Print_user_profile_xi/'.$val['ID']); ?>" class='btn btn-danger btn-xs' title='PRINT'>
								  <i class="fa fa-cloud-download" style="color:white"></i> PRINT
								</a>
								<?php }  ?>
								
								
							
								
							</td>
						</tr>
					<?php
				}
			?>
			</tbody>
		  </table>
		</div>
	  </div>
	</div>
  </div>
</section>
</div>

        <!-- /.box -->
</section>


<br>

<script type="text/javascript">

$('.datepicker').datepicker({
	    format: 'dd-M-yyyy',
	    autoclose:true,
	});
  // $("#example1").DataTable();
  $('#example1').DataTable({
		dom: 'Bfrtip',
		ordering :false,
		buttons: [
			{
				extend: 'excelHtml5',
				title: 'Student Details',
			},
			{
				extend: 'pdfHtml5',
				title: 'Student Details',
			},
		]
	});
   $( document).ajaxComplete(function() {
      // Required for Bootstrap tooltips in DataTables
      $('[data-toggle="tooltip"]').tooltip({
          "html": true,
          "delay": {"show": 10, "hide": 0},
      });
  });
  $("#stulist_menu").addClass('active');
	
	function startDate(value){
		$("body").css({"opacity": "0.5"})
		$("#end_date").prop('disabled',false);
		$.ajax({
			url: "<?php echo base_url('Cbse_verify_admin/cbse_verification/ReportStuData'); ?>",
			type: "POST",
			data: {value:value,'class':'XI'},
			success:function(data){
				$("body").css({"opacity": ""})
				$(".card-body").html(data);
			}
		});
	}
	
	function endDate(){
		$("body").css({"opacity": "0.5"})
		$("#verified_status").prop('disabled',false)
		var start_date = $("#start_date").val();
		var end_date   = $("#end_date").val();
		$.ajax({
			url: "<?php echo base_url('Cbse_verify_admin/cbse_verification/ReportStuDateRange'); ?>",
			type: "POST",
			data: {start_date:start_date,end_date:end_date,'class':'XI'},
			success:function(data){
				$("body").css({"opacity": ""})
				$(".card-body").html(data);
			}
		});
	}
	
	function verifiedReportDateRange(){
		$("body").css({"opacity": "0.5"})
		var start_date      = $("#start_date").val();
		var end_date        = $("#end_date").val();
		var verified_status = $("#verified_status").val();
		$.ajax({
			url: "<?php echo base_url('Cbse_verify_admin/cbse_verification/ReportStuDateRangeStatus'); ?>",
			type: "POST",
			data: {start_date:start_date,end_date:end_date,verified_status:verified_status,'class':'XI'},
			success:function(data){
				$("body").css({"opacity": ""})
				$(".card-body").html(data);
			}
		});
	}
</script>