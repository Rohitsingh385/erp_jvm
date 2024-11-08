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
    <li class="breadcrumb-item"><a href="#">CLASS X-XII</a></li>
  
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
				
			 <th><strong>Sl. No.</strong></th>
			  <th><strong>Adm. No.</strong></th>
			
			 <th><strong>Student's Name</strong></th>
			  <th><strong>Father's Name</strong></th>
			 <th><strong>Mother's Name</strong></th>
			<th><strong>Class/Section</strong></th>
			
				<th><strong>Subject-1</strong></th>
				<th><strong>Subject-2</strong></th>
				<th><strong>Subject-3</strong></th>
				<th><strong>Subject-4</strong></th>
				<th><strong>Subject-5</strong></th>
				<th><strong>Subject-6</strong></th>
				<th><strong>Reg. Charges</strong></th>
				<th><strong>Processing Charges</strong></th>
				<th><strong>Migration Charges</strong></th>
				<th><strong>Total </strong></th>
				
				<th><strong>Tran. ID </strong></th>
				<th><strong>Atom Trans. ID </strong></th>
				<th><strong>Status </strong></th>
				<th><strong>Pay Date </strong></th>
			
			</tr>
			</thead>
			<tbody>
			<?php
				//echo '<pre>'; print_r($stuData); echo '</pre>';die;
				foreach($stuData as $key => $val){
					?>
						<tr>
							
							<td><?php echo $val['id']; ?></td>
							<td><?php echo $val['AdmNo']; ?></td>
						
							<td><?php echo $val['SName']; ?></td>
							<td><?php echo $val['FName']; ?></td>
							<td><?php echo $val['MName']; ?></td>
						    <td><?php echo $val['Class_Sec']; ?></td>
							<td><?php echo $val['Subj1']; ?></td>
							<td><?php echo $val['Subj2']; ?></td>
							<td><?php echo $val['Subj3']; ?></td>
							<td><?php echo $val['Subj4']; ?></td>
							<td><?php echo $val['Subj5']; ?></td>
							<td><?php echo $val['Subj6']; ?></td>
							
							<td><?php echo $val['Registration_Charges']; ?></td>
							<td><?php echo $val['Processing_ICard_Charges']; ?></td>
							<td><?php echo $val['Migration_Charges']; ?></td>
							<td><?php echo $val['Total']; ?></td>
							
							<td><?php echo $val['Transaction_ID']; ?></td>
							<td><?php echo $val['Atom_Transaction_ID']; ?></td>
							<td><?php echo $val['Status']; ?></td>
							<td><?php echo $val['Pay_Date']; ?></td>
							
						   
							
				 	
				<!--end new list-->
							
							
							</tr><?php
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
				title: 'CBSE LOC EXCEL',
			},
			{
				extend: 'pdfHtml5',
				title: 'CBSE LOC',
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