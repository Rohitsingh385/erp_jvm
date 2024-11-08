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
    <li class="breadcrumb-item">Student Record <i class="fa fa-angle-right"></i> RTGS PAYMENT LIST</li>
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
		<div class="card-body table-responsive">
		  <table id="example1" class="table table-striped">
			<thead>
			<tr>
			  <th><strong>S.No.</strong></th>
			  <th><strong>Name</strong></th>
			  <th><strong>Token No.</strong></th>
			  <th><strong>Admission No</strong></th>
			  <th><strong>Payment Mode</strong></th>
			  <th><strong>Transaction Id</strong></th>
				  <th><strong>Transection Date</strong></th>
				 <th><strong>Verify status</strong></th>
			  <th><strong>Verify Now</strong></th>
			</tr>
			</thead>
			<tbody id='load'>
			<?php
				$i=1;
				foreach($stuData as $key => $val){
					$ts=$val['rtgs_status']; 
				
					?>
						<tr class='<?php echo $val['id']; ?>' style="<?php if(strtolower($ts)=="ok"){echo 'opacity:0.5';}?>">
							<td> <?php echo $i; ?></td>
							<td><i class="	fa fa-user-o"></i> <?php echo $val['name']; ?></td>
							<td> <?php echo $val['Token']; ?></td>
							<td><?php echo $val['admno']; ?></td>
							<td> <?php echo $val['pay_mode']; ?></td>
							<td><?php echo $val['trns_id']; ?></td>
							<td><?php echo date('d-M-y',strtotime($val['trans_date'])); ?></td>
							<td><?php echo $ts;?> </td>
							<td><button class='btn btn-success btn<?php echo $val['id'];?>'
					<?php if(strtolower($ts)=="ok"){?> disabled <?php } else{ ?>  onclick="update_rtgs('<?php echo $val['admno']; ?>',<?php echo $val['id']; ?>)" <?php } ?>>Verify Now</button><button class='btn btn-info' data-toggle="modal" data-target="#myModal" onclick="update_rtgs_up('<?php echo $val['admno']; ?>')">Edit</button></td>
						</tr>
					<?php
					$i++;
				}
			?>
			</tbody>
		  </table>
		</div>
	  </div>
	</div>
  </div>
</section>


<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
	  <form id='form_update'>
    <div class="modal-content">
		
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit your RTGS Status</h4>
      </div>
      <div class="modal-body">
		
		  	<label>SELECT PAYMENT MODE</label>
						<select class='form-control' name='p_mode' id='type' required>
							<option value=''>---Select---</option>
								<option value="RTGS">RTGS</option>
								<option value='NEFT'>NEFT</option>
								<option value='BANK TRANSACTION'>BANK TRANSACTION</option>
							<option value='UPI'>UPI</option>
							
						</select><br/>
		  <label>Transaction Id</label>
        <input type='text' id='trans_id' name='tr_id' class='form-control' required><br/>
		   <label>Transaction Date</label>
        <input type='text'  id='trans_date' name='t_date' class='form-control datepicker' readonly required>
		   <input type='hidden'  id='admno' name='admno' required>
      </div>
      <div class="modal-footer">
		  <input type="submit" class="btn btn-success" value='Save' style='float:left'>
		
        <span  class="btn btn-default" data-dismiss="modal">Close</span>
      </div>
    </div>
  </form>
  </div>
	  
</div>

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
	
	function update_rtgs(adm,id){
		$("body").css({"opacity": "0.5"})
		$.ajax({
			url: "<?php echo base_url('Cbse_verify_admin/cbse_verification/rtgs_verification_ok'); ?>",
			type: "POST",
			data: {adm:adm},
			success:function(data){
				$("body").css({"opacity": ""});
				$("."+id).css({"opacity": "0.5"});
			location.reload();
			}
		});
	}
	
	function update_rtgs_up(adm){
		
		$("body").css({"opacity": "0.5"})
		$.ajax({
			url: "<?php echo base_url('Cbse_verify_admin/cbse_verification/update_rtgs_data'); ?>",
			type: "POST",
			data: {adm:adm},
			success:function(data){
				var bb= $.parseJSON(data);
				$('#type').val(bb[0]);
				$('#trans_id').val(bb[1]);
				$('#trans_date').val(bb[2]);
				$('#admno').val(adm);
				$("body").css({"opacity": ""});
			
			//location.reload();
			}
		});
	}
	
	$("#form_update").on("submit", function (event) {
    event.preventDefault();
	$("body").css({"opacity": "0.5"})
		
	var formData = new FormData(this);
    $.ajax({
			url: "<?php echo base_url('Cbse_verify_admin/cbse_verification/update_rtgs_up'); ?>",
			type: "POST",
			data:formData,
            cache:false,
            contentType: false,
            processData: false,
			success: function(data){
				location.reload();
			}
		});
	 });
	
</script>
		    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>