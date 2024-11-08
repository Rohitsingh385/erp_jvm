<br>
<style type="text/css">
	.thead-color {
		background: #bac9e2 !important;
	}
</style>

<div class="employee-dashboard">
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default" style="background: #3278ab !important;font-size: 13px">
				<div class="panel-heading"><i class="fa fa-search"></i> Search Criteria</div>
				<div class="" style="background: white !important;border:1px solid #3278ab;padding: 20px;">
					<form class="form-inline" action="<?php echo base_url('payroll/dashboard/myattendance'); ?>" method="post" autocomplete="off">
						<div class="form-group">
							<label>Month:</label><span class="req"> *</span>
							<input type="text" class="form-control datepicker" name="month" required="" value="<?php echo set_value('month'); ?>">
						</div>
						<button type="submit" class="btn btn-success" name="search"><i class="fa fa-search"></i> Search</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default" style="background: #3278ab !important;color: white;font-size: 13px">
				<div class="panel-heading"><i class="fa fa-calendar"></i> My Attendance
					<div class="pull-right">
						<label class="label label-danger">Late In / Before Out</label>
						<label class="label label-warning">Late Out / Before In</label>
						<label class="label label-success">Right Time</label>
					</div>
				</div>

				<form id='form_id' method="POST">
					<div class="table-responsive" style="background: white !important;border:1px solid #3278ab;color: white;">
						<table class='table table-bordered table-striped'>
							<thead>
								<tr>
									<th class="text-center thead-color">Date</th>
									<th class="text-center thead-color">In Time</th>
									<!--<th class="text-center thead-color">Out Time</th> -->
									<th class="text-center thead-color">Status</th>
								</tr>
							</thead>
							
							
							<tbody>
								<?php foreach ($result as $key => $value) { ?>
									<tr>
										<td class="text-center">
											<?php $date = date('d-M-Y', strtotime($value['date'])); ?>
											<input type="hidden" name="dates" id="dates" value="<?php echo $date; ?>">
											<input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">
											<?php echo $date; ?>
										</td>

										<!-- Handle IN_TIME and OUT_TIME when daily_emp_atten is not empty -->
										<?php if (!empty($value['daily_emp_atten'])) { ?>
											<td class="text-center">
												<input type="hidden" name="in_times" value="<?php echo $value['daily_emp_atten']['IN_TIME'] ?>">
												<span class="contenteditable" contenteditable="true" onblur="updateAtt('IN_TIME', '<?php echo $date; ?>')" id="IN_TIME_<?php echo $date; ?>"><?php echo $value['daily_emp_atten']['IN_TIME']; ?></span>
											</td>

											<!-- <td class="text-center">
												<input type="hidden" name="out_times" value="<?php echo $value['daily_emp_atten']['OUT_TIME'] ?>">
												<span class="contenteditable" contenteditable="true" onblur="updateAtt('OUT_TIME', '<?php echo $date; ?>')" id="OUT_TIME_<?php echo $date; ?>"><?php echo $value['daily_emp_atten']['OUT_TIME']; ?></span>
											</td> -->
										<?php } else { ?>
											<!-- Handle IN_TIME and OUT_TIME when daily_emp_atten is empty -->
											<td class="text-center">
												<input type="hidden" name="in_times" value="<?php echo $value['attendance']['START_TIME'] ?>">
												<span class="contenteditable" contenteditable="true" onblur="updateAtt('IN_TIME', '<?php echo $date; ?>')" id="IN_TIME_<?php echo $date; ?>"><?php echo $value['attendance']['START_TIME']; ?></span>
											</td>

											<!-- <td class="text-center">
												<input type="hidden" name="out_times" value="<?php echo $value['attendance']['STOP_TIME'] ?>">
												<span class="contenteditable" contenteditable="true" onblur="updateAtt('OUT_TIME', '<?php echo $date; ?>')" id="OUT_TIME_<?php echo $date; ?>"><?php echo $value['attendance']['STOP_TIME']; ?></span>
											</td> -->
										<?php } ?>

										<?php if (!empty($value['daily_emp_atten'])) { ?>
                                            <td class="text-center">
                                            <select class="form-control" name="attendance_statuses" id="attendance_statuses" onchange="update_outtime(this.value);" <?php if (strtotime($value['date']) < strtotime(date('Y-m-d'))) { echo 'disabled';} ?>>
                                                <option value="AB" <?php if ($value['daily_emp_atten']['OUT_TIME_ATT'] == 'AB') { echo 'selected'; } ?>>Absent</option>
                                                <option value="P" <?php if ($value['daily_emp_atten']['OUT_TIME_ATT'] == 'P') { echo 'selected'; } ?>>Present</option>
                                            </select>
                                        </td>
                                        <?php } else { ?>
                                        <td class="text-center">
                                            <select class="form-control" name="attendance_statuses" id="attendance_statuses" onchange="update_outtime(this.value);" <?php if (strtotime($value['date']) < strtotime(date('Y-m-d'))) { echo 'disabled';} ?>>
                                                <option value="AB" <?php if ($value['attendance']['OUT_TIME_ATT'] == 'AB') { echo 'selected'; } ?>>Absent</option>
                                                <option value="P" <?php if ($value['attendance']['OUT_TIME_ATT'] == 'P') { echo 'selected'; } ?>>Present</option>
                                            </select>
                                        </td>
                                        <?php } ?>
									</tr>
								<?php } ?>
							</tbody>

							<tfoot>
								<tr>
									<td colspan="5" class="text-right">
										<button class="btn btn-success" onclick="showSendForApproval()"><i class="fa fa-send"></i> Send For Approval</button>
									</td>
								</tr>
							</tfoot>

						</table>
					</div>
				</form>

			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="myModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background: #205dc1;color: white;">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Remarks Details - (<span class="datehead"></span>)</h4>
			</div>
			<form id="createForm">
				<input type="hidden" name="date" class="datehead">
				<input type="hidden" name="remarks_type" class="remarks_type">
				<input type="hidden" name="emp_id" value="<?php echo $employee_details['id']; ?>">
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label>Remarks</label><span class="req">*</span>
								<textarea name="remarks" id="remarks_deails" class="form-control"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-success" id="save_btn">Save</button>
					<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>



<br>
<?php
$current_session_year = explode('-', schoolData['School_Session']);
$start_date = $current_session_year[0] . '-04-01';
$end_date = $current_session_year[1] . '-03-31';
?>
<script type="text/javascript">
	function showRemarksModal(date, remarks_type) {
		$('.datehead').text(date);
		$('.datehead').val(date);
		$('.remarks_type').val(remarks_type);
		$.ajax({
			url: "<?php echo base_url('payroll/dashboard/emp_dashboard/getRemarks'); ?>",
			type: "POST",
			data: {
				date: date,
				remarks_type: remarks_type,
				emp_id: '<?php echo $employee_details["id"]; ?>'
			},
			dataType: 'json',
			success: function(response) {

				if (response != 1) {
					var remarks = (remarks_type == 1) ? response.IN_TIME_REMARKS : response.OUT_TIME_REMARKS;
					$('#remarks_deails').val(remarks);
				}
				$('#myModal').modal({
					keyboard: false,
					backdrop: "static"
				});
			}
		});
	}

	var startDate = new Date('<?php echo $start_date; ?>');
	var endDate = new Date('<?php echo $end_date; ?>');

	$(".datepicker").datepicker({
		format: 'M-yyyy',
		autoclose: true,
		startView: "months",
		minViewMode: "months",
		startDate: startDate,
		endDate: endDate
	});

	$("#save_btn").on("click", function(event) {
		$("#createForm").validate();
		if ($('#createForm').valid()) {
			event.preventDefault();
			$.ajax({
				url: "<?php echo base_url('payroll/dashboard/emp_dashboard/updateRemarks'); ?>",
				type: "POST",
				data: $("#createForm").serialize(),
				dataType: 'json',
				beforeSend: function() {
					$('.loader').show();
					$('body').css('opacity', '0.5');
				},
				success: function(response) {
					$('.loader').hide();
					$('body').css('opacity', '1.0');
					if (response.msg == 1) {
						$('#createForm')[0].reset();
						$('#myModal').modal('hide');
						swal({
							title: "Remarks Updated Successfully",
							text: "Remarks Updated Successfully",
							type: "success"
						}, );
					} else {
						swal("Failed !");
					}
				}
			});
		}
	});

	$("#form_id").on("submit", function(event) {

		event.preventDefault();
		$.ajax({
			url: "<?php echo base_url('payroll/dashboard/Myattendance/save_'); ?>",
			type: "POST",
			data: $("#form_id").serialize(),
			dataType: 'json',


			success: function(response) {

				if (response.msg == 1) {
					$('#createForm')[0].reset();
					$('#myModal').modal('hide');
					swal({
						title: "Updated Successfully",
						text: "Updated Successfully",
						type: "success"
					}, );
				} else {
					swal("Failed !");
				}
			}
		});
	});

	function updateAtt(column_name, dte) {

		var cell_value = $('#' + column_name + '_' + dte).text();
		var dt = dte;
		var emp_id= $('#user_id').val();

		// alert(emp_id);
		$.ajax({
			url: '<?php echo base_url('payroll/dashboard/Myattendance/updateATT'); ?>',
			data: {
				column_name: column_name,
				emp_id: emp_id,
				dt: dt,
				cell_value: cell_value
			},
			method: "post",
			dataType: "json",
			success: function() {
				$.toast({
					heading: 'Success',
					text: 'Saved Successfully',
					showHideTransition: 'slide',
					icon: 'success',
					position: 'top-right',
				});
			}
		});
	}


	$(document).ready(function() {
		$(".editable").on("input", function() {
			var newValue = $(this).text();
			var date = $(this).data("date");
			var hiddenInput = $(this).closest("td").find("input[type='hidden']");
			hiddenInput.val(newValue);

			// Save the changes using AJAX
			$.ajax({
				url: "<?php echo base_url('payroll/dashboard/Myattendance/save_edited_values'); ?>",
				type: "POST",
				data: {
					date: date,
					value: newValue
				},
				success: function(response) {
					console.log("Changes saved successfully");
				},
				error: function() {
					console.log("Error while saving changes");
				}
			});
		});
	});
</script>