<style type="text/css">
.dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
	line-height:0.66em;
}
</style>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo base_url(''); ?>">Notice</a> <i class="fa fa-angle-right"></i> Add Notice </li>
</ol>
  <!-- Content Wrapper. Contains page content -->
<div class='mainb' style="padding: 15px; background-color: white; border-top: 3px solid #5785c3;">
  <div class="row">
    <div class='col-sm-4'>
	    <?php
			  if($this->session->flashdata('msg')){
				  ?>
				    <div class="alert alert-success">
					   <?php echo $this->session->flashdata('msg'); ?>
					</div>
				  <?php
			  }
		?>
		<div id='load'>
		<form method='post' action='<?php echo base_url('notice/AddNotice/saveNotice'); ?>' enctype='multipart/form-data' id='myform' onsubmit='disabled()'>
		<table class='table'>
		<input type='hidden' name='date' value='<?php echo $date; ?>'>
			<tr>
				<th>Sent Type</th>
				<td>
					<select class='form-control' name='sent' required onchange='sentType(this.value)'>
						<option value=''>Select</option>
						<option value='circular'>Circular</option>
						<option value='sms'>SMS</option>
					</select>
				</td>
			</tr>
			<tr>
				<th>Category</th>
				<td>
					<select class='form-control' name='category' required onchange='cat()'>
						<option value=''>Select</option>
						<option value='School Notice'>School Notice</option>
						<option value='Complaint Notice'>Complaint Notice</option>
						<option value='Fee Defaulter'>Fee Defaulter</option>
					</select>
				</td>
			</tr>
			
			<tr>
				<th>Class</th>
				<td>
					<select class='form-control' name='class' id='cls' required onchange='clses(this.value)'>
						<option value=''>Select</option>
						<?php
							if($classData){
								foreach($classData as $key => $val){
									?>
										<option value='<?php echo $val['Class_no']; ?>'><?php echo $val['classnm']; ?></option>
									<?php
								}
							}
						?>
					</select>
				</td>
			</tr>
			
			<tr>
				<th>Section</th>
				<td>
					<select class='form-control' name='sec' id='section' required onchange='sectn(this.value)'>
						<option value=''>Select</option>
					</select>
				</td>
			</tr>
			<tr>
				<th>Notice</th>
				<td>
					<textarea class='form-control' id='txt' maxlength="150" name='notice' required rows='5'></textarea>
					<span id="chars" style='font-size:12px; color:red; display:none'>150 </span> <i style='font-size:12px; color:red; display:none' id='char'>characters remaining</i>
				</td>
			</tr>
			<tr>
				<th>Attachment</th>
				<td><input type='file' name='img' id='filePHOTO' class='form-control' accept="application/pdf, image/jpeg"></td>
			</tr>
			
			<tr>
				<th>All Students</th>
				<td>
					<input type='radio' value='1' name='selectAll' id='radioYes' onclick='SelectAll(this.value)' checked>YES
					&nbsp;&nbsp;&nbsp;
					<input value='0' name='selectAll' type='radio' onclick='SelectAll(this.value)'>NO
			    </td>
			</tr>
			
			<tr id='dropdown' style='display:none;'>
				<th></th>
				<td>
					<select id="multiselect" multiple="multiple" class='form-control' style='width:100%' name='selectParticultStu[]' disabled required>
						<option value="">Select</option>
                    </select>
				</td>
			</tr>
			
			<tr>
				<td colspan='2'><center><button class='btn btn-success btn-sm'>Send <i class="fa fa-circle-o-notch fa-spin" style='color:#fff; display:none'></i></button></center></td>
			</tr>
		</table>
		</form>
		</div>
	</div>
	
    <div class='col-sm-8'>
    <div class='table-responsive'>
	<table class='table dataTable'>
	<thead>
		<tr>
			<th style='color:#fff !important; background:#5785c3;'>Date</th>
			<th style='color:#fff !important; background:#5785c3;'>Category</th>
			<th style='color:#fff !important; background:#5785c3;'>Notice</th>
			<th style='color:#fff !important; background:#5785c3;'>Action</th>
		</tr>
	</thead>	
	<tbody>
		<?php
			foreach($noticeData as $key => $val){
				if($val['emp_id'] == $login_id){
				?>
					<tr>
						<td><?php echo $val['date']; ?></td>
						<td><?php echo $val['notice_category']; ?></td>
						<td><?php echo $val['notice']; ?></td>
						<?php
							if($val['sent_type'] == 'circular'){
						?>
							<td><a href='#' title='EDIT' onclick='edit(<?php echo $val['id']; ?>)'><i class="fa fa-pencil-square" style=' font-size:20px; color:green'></i></a></td>
						<?php } ?>
					</tr>
				<?php
				}
			}
		?>
	</tbody>	
	</table>
	</div>
	</div>
  </div>
</div>
<br /><br />


<!-- /.modal -->
<script type="text/javascript">
   $(".alert").fadeOut(3000);
   $('.dt').datepicker({ format: 'dd-M-yyyy',autoclose: true });
   $("#multiselect").select2();
	
   $(function () {
    $('.dataTable').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : true,
      aaSorting: [[0, 'asc']]
    })
  });
  
  $("#filePHOTO").change(function(){
		var file_size = $('#filePHOTO')[0].files[0].size;
		var ext = $('#filePHOTO').val().split('.').pop().toLowerCase();
			if(file_size > 900000 || !(ext == 'png' || ext == 'PNG' || ext == 'jpg' || ext == 'JPG' || ext == 'jpeg' || ext == 'JPEG' || ext == 'PDF' || ext == 'pdf')){
				$.toast({
					heading: 'Error',
					text: 'File size must be less than 100kb and only allowed jpg,jpeg,png format',
					showHideTransition: 'slide',
					icon: 'error',
					position: 'top-right',
				});
				$("#filePHOTO").val('');
			$(".file_upload1").css("border-color","#FF0000");
				return false;
			}
		return true;
	});
  
  function SelectAll(value){
	  if(value == 0){
		$("#dropdown").show();
		$("#multiselect").prop('disabled',false);
		$("#multiselect").prop('required',true);
	  }else{
		$("#dropdown").hide();    
		$("#multiselect").prop('disabled',true);
		$("#multiselect").prop('required',false);
	  }
  }
  
  function edit(id){
	  $.post("<?php echo base_url('notice/AddNotice/noticeEdit'); ?>",{id:id},function(data){
		  $("#load").html(data);
	  });
  }
	
  var maxLength = 150;
	$('textarea').keyup(function() {
	  var length = $(this).val().length;
	  var length = maxLength-length;
	  $('#chars').text(length);
	});
	
	function sentType(val){
		$("#txt").val('');
		if(val == 'sms'){
			$("#txt").attr('maxlength','150');
			$("#chars").show();
			$("#char").show();
		}else{
			$("#txt").attr('maxlength','10000');
			$("#chars").hide();
			$("#char").hide();
		}
	}	
	
	function disabled(){
	  $('.btn').attr('disabled',true);
	  $('.fa-spin').show();
  }
  
  function clses(val){
	  $.post("<?php echo base_url('notice/AddNotice/loadSec'); ?>",{class_id:val},function(data){
		  $("#section").html(data);
	  });
  }
  
  function cat(){
	$('.btn').attr('disabled',false);
	  $('.fa-spin').hide();  
  }
  
  function sectn(){
	  $("#dropdown").hide();
	  $("#radioYes").prop("checked", true);
	  var cls     = $("#cls").val();
	  var section = $("#section").val();
	  $.post("<?php echo base_url('notice/AddNotice/loadClassSecStu'); ?>",{cls:cls,section:section},function(data){
		  $("#multiselect").html(data);
	  });
  }
</script>