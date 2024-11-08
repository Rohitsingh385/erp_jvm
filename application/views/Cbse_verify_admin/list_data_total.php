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
    <li class="breadcrumb-item">CBSE STUDENT DATA<i class="fa fa-angle-right"></i> STUDENTS LIST</li>
</ol>
  <!-- Content Wrapper. Contains page content -->
  <div class="employee-dashboard">

      <section class="content">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item" onclick=" window.history.back();"><i class="fa fa-angle-double-left"></i> BACK</li>
    <li class="breadcrumb-item">CLASS IX</li>
  
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
	  <div >
		<table class='table table-striped' style="display:none">
			<tr style="font-size:16px;border:1px solid grey">
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
						<option value='2'>Rejected</option>
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
				
			 <th><strong>Name</strong></th>
			  <th><strong>Admission No.</strong></th>
			  <th><strong>Roll No.</strong></th>
			  <th><strong>DOB</strong></th>
			  <th><strong>Father's Name</strong></th>
			 <th><strong>Mother's Name</strong></th>
			<th><strong>Class/Section</strong></th>
			<th><strong>Date of Admission</strong></th>
			 <th><strong>Category</strong></th>
			<th><strong>Aadhaar Card No</strong></th>
			<th><strong>Only Child</strong></th>
				<th><strong>Minority</strong></th>
				<th><strong>Gender</strong></th>
				<th><strong>Subject</strong></th>
				<th><strong>Annual Income</strong></th>
				<th><strong>Email</strong></th>
				
			  <th><strong>Mobile</strong></th>
			  <th><strong>Status</strong></th>
			  <th><strong>Action</strong></th>
			</tr>
			</thead>
			<tbody>
			<?php
				foreach($stuData as $key => $val){
					?>
						<tr>
							
							<td><i class="	fa fa-user-o"></i> <?php echo $val['name']; ?></td>
							<td><?php echo $val['admission_no']; ?></td>
							<td><?php echo $val['roll']; ?></td>
							<td><?php echo date('d-M-Y',strtotime($val['dob'])); ?></td>
							<td><?php echo $val['fname']; ?></td>
							<td><?php echo $val['mname']; ?></td>
						    <td><?php echo $val['class']; ?>-<?php echo $val['sec']; ?></td>
						    <td><?php echo date('d-M-Y',strtotime($val['adm_date'])); ?></td>
				 			<td><?php echo $val['category']; ?></td>
				 			<td><?php echo $val['aadhaar']; ?></td>
							<td><?php if($val['child']=='1'){ echo "YES";}else{echo "NO";} ?></td>
							<td><?php if($val['minority']=='1'){ echo "YES";}else{echo "NO";} ?></td>
							<td><?php if($val['sex']=='1'){ echo "MALE";}else{echo "FEMALE";} ?></td>
				 	 <td><?php echo $val['lng']; ?></td>
			<td><?php echo $val['income']; ?></td>
				<td><?php echo $val['email']; ?></td>
				<!--end new list-->
							<td><?php echo $val['mobile']; ?></td>
							 <td><?php if($val['verify'] == 0){?>
								<span class="text-danger">PENDING</span>
								<?php } else{ ?>
								<span class="text-success">VERIFIED</span>
								<?php }?></td>
							<td>
						<a href="<?php echo base_url('Cbse_verify_admin/cbse_verification/viewdata/'.$val['id']); ?>" class='btn btn-info btn-xs' title='EDIT' >
								  <i class="fa fa-edit" style="color:white"></i>
								</a>
								<?php
									if($val['verify'] == 1){
								?>
								<a href="<?php echo base_url('Cbse_verify_admin/cbse_verification/Print_user_profile/'.$val['id']); ?>" class='btn btn-danger btn-xs' title='PRINT'>
								  <i class="fa fa-cloud-download" style="color:white"></i> PRINT
								</a>
								<?php }  ?>
								</td></tr><?php
				}
			?>
			</tbody>
		  </table>
		</div>
	  </div>
	</div>
  </div>
</section>
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
			data: {value:value,'class':'IX'},
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
			data: {start_date:start_date,end_date:end_date,'class':'IX'},
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
			data: {start_date:start_date,end_date:end_date,verified_status:verified_status,'class':'IX'},
			success:function(data){
				$("body").css({"opacity": ""})
				$(".card-body").html(data);
			}
		});
	}
  
</script>