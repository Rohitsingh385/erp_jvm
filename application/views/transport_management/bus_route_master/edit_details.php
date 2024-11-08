<?php
// echo "<pre>";
// print_r($student);
?>
<style type="text/css">
	thead {
		background-color: lightblue;
		color: white;
		font-size: 14px;
		font-weight: 700;
	}

	table {
		font-size: 14px;
	}
</style>
<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="#">Bus Route Master</a> <i class="fa fa-angle-right"></i>Edit Bus Route</li>
</ol>
<!-- Content Wrapper. Contains page content -->
<div style="padding-left: 25px; background-color: white;padding-top: 5px;padding-top: 20px;">
	<?php
	if ($this->session->flashdata('msg')) :
	?>
		<div class="alert alert-success" role="alert" id="msg">
			<strong><?php echo $this->session->flashdata('msg'); ?></strong>
		</div>
	<?php endif; ?>
	<div class="row">
		<div class="col-sm-12">
			<form id='updateform' method='POST'>
				<input type='hidden' id='BusCode' value='<?php echo $bus_route_details[0]->BusCode; ?>'>
				<input type='hidden' id='Trip_ID' value='<?php echo $bus_route_details[0]->Trip_ID; ?>'>
				<input type='hidden' id='Prefer_ID' value='<?php echo $bus_route_details[0]->Prefer_ID; ?>'>
				<table class="table table-bordered" id="class_table">
					<tr>
						<td><b>Vehicle No.</b></td>
						<td> <input type="text" id='vehicle_no' class="form-control" value="<?php echo $bus_route_details[0]->BusNo; ?> " readonly></td>
					</tr>
					<tr>
						<td><b>No. of seats</b></td>
						<td> <input type="text" id='seats_no' class="form-control" value="<?php echo $bus_route_details[0]->seats; ?> " readonly></td>
					</tr>
					<tr>
						<td><b>Trip</b></td>
						<td>
							<select name='trip' id='trip' class='form-control' required>
								<option value=''>select</option>
								<?php
								foreach ($trip_master as $key1 => $value1) {
								?>
									<option <?php if ($value1->Trip_ID == $bus_route_details[0]->Trip_ID) {
												echo "selected";
											} ?> value='<?php echo $value1->Trip_ID; ?>'><?php echo $value1->Trip_Nm; ?></option>
								<?php
								}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td><b>Preference</b></td>
						<td>
							<select name='preference' id='preference' required class='form-control'>
								<option value=''>select</option>
								<option <?php if ($bus_route_details[0]->Prefer_ID == 1) {
											echo "selected";
										} ?> value='1'>Boys</option>
								<option <?php if ($bus_route_details[0]->Prefer_ID == 2) {
											echo "selected";
										} ?> value='2'>Girls</option>
								<option <?php if ($bus_route_details[0]->Prefer_ID == 3) {
											echo "selected";
										} ?> value='3'>Co.Ed</option>
							</select>
						</td>
					</tr>
					<tr>
						<td><b>Stoppage</b></td>
						<td>
							<select name='stoppage' required id='stoppage' onchange='checkstoppagesameornot(this.value)' class='form-control'>
								<option value=''>select</option>
								<?php
								foreach ($stoppage as $key => $value) {
								?>
									<option <?php if ($value->STOPNO == $bus_route_details[0]->STOPNO) {
												echo "selected";
											} ?> value='<?php echo $value->STOPNO; ?>'><?php echo $value->STOPPAGE; ?></option>
								<?php
								}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<input type="hidden" name="id" value="<?php echo $bus_route_details[0]->Route_Id; ?>">
					</tr>
					<tr>
						<td colspan='2' align='center'><a href='<?php echo base_url('Add_bus_route/index'); ?>' class='btn btn-danger'>BACK</a>&nbsp;<button type="submit" id='class_save' name="class_save" class="btn btn-success">UPDATE</button>&nbsp;
						<td>
					</tr>
				</table>
			</form>
			<!-- <div class="col-md-3 form-group">
				<button class='btn btn-danger' name="viewtype" id="month_wise" value="<?php echo COUNT($student); ?>" onclick="dt(this.value)">Delete</button>
			</div> -->
			<!-- <div class="col-md-6 form-group">
				<div id="monthwise" style="display: none;">
					<div class="row">

						<h1 id='sdm'>
							<font color="red">Allocate bus to ALL Student first then delete:</font>
						</h1>

					</div>
				</div>
			</div>
			<div class='col-sm-2'>
				<a href="<?php echo base_url('student_transport/Bus_transport'); ?>" class='btn btn-warning pull-right'>update by student</a><br /><br /><br />
			</div> -->
		</div>

		<div class="col-sm-12">
			<br>
			<center style="background-color: lightblue;border-top:1px solid black">
				<caption>Student Details</caption>
			</center>
			<table class="table table-bordered table-striped" id="example" width='100%'>
				<thead>
					<tr>
						<th>Sl no.</th>
						<th>Admission No</th>
						<th>Student Name</th>
						<th>Class/sec</th>
						<th>Stoppage</th>
						<th>Bus no</th>
						<th>Stop no</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					foreach ($student as $value) {
					?> <tr>
							<td><?php echo $i; ?></td>
							<td><?php echo $value->ADM_NO; ?></td>
							<td><?php echo $value->FIRST_NM; ?></td>
							<td><?php echo $value->DISP_CLASS . "/" . $value->DISP_SEC; ?></td>
							<td><?php echo $value->stopnm ?></td>
							<td><?php echo $value->BUS_NO ?></td>
							<td><?php echo $value->STOPNO ?></td>
						</tr>
					<?php
						$i++;
					}
					?>
				</tbody>
			</table>
		</div>
	</div><br /><br />
	<div class="clearfix"></div>
	<!-- script-for sticky-nav -->
	<script>
		$(document).ready(function() {
			var navoffeset = $(".header-main").offset().top;
			$(window).scroll(function() {
				var scrollpos = $(window).scrollTop();
				if (scrollpos >= navoffeset) {
					$(".header-main").addClass("fixed");
				} else {
					$(".header-main").removeClass("fixed");
				}
			});
		});
	</script>
	<!-- /script-for sticky-nav -->
	<!--inner block start here-->
	<div class="inner-block"></div>
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
	<link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
	<link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" />
	<!-- <script type="text/javascript">
		$("#msg").fadeOut(8000);
		$(document).ready(function() {
			// alert("JKL");
			// var radioValue = $("input[name='prev_due']:checked").val();
			// alert(radioValue);
			stud_details($("input[name='prev_due']:checked").val());
			$("input[name='prev_due']").change(function() {
				stud_details(this.value);
			});
			/* For Export Buttons available inside jquery-datatable "server side processing" - Start
- due to "server side processing" jquery datatble doesn't support all data to be exported
- below function makes the datatable to export all records when "server side processing" is on */
			// function newexportaction(e, dt, button, config) {
			// 	var self = this;
			// 	var oldStart = dt.settings()[0]._iDisplayStart;
			// 	dt.one('preXhr', function(e, s, data) {
			// 		// Just this once, load all data from the server...
			// 		data.start = 0;
			// 		data.length = 2147483647;
			// 		dt.one('preDraw', function(e, settings) {
			// 			// Call the original action function
			// 			if (button[0].className.indexOf('buttons-copy') >= 0) {
			// 				$.fn.dataTable.ext.buttons.copyHtml5.action.call(self, e, dt, button, config);
			// 			} else if (button[0].className.indexOf('buttons-excel') >= 0) {
			// 				$.fn.dataTable.ext.buttons.excelHtml5.available(dt, config) ?
			// 					$.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config) :
			// 					$.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
			// 			} else if (button[0].className.indexOf('buttons-csv') >= 0) {
			// 				$.fn.dataTable.ext.buttons.csvHtml5.available(dt, config) ?
			// 					$.fn.dataTable.ext.buttons.csvHtml5.action.call(self, e, dt, button, config) :
			// 					$.fn.dataTable.ext.buttons.csvFlash.action.call(self, e, dt, button, config);
			// 			} else if (button[0].className.indexOf('buttons-pdf') >= 0) {
			// 				$.fn.dataTable.ext.buttons.pdfHtml5.available(dt, config) ?
			// 					$.fn.dataTable.ext.buttons.pdfHtml5.action.call(self, e, dt, button, config) :
			// 					$.fn.dataTable.ext.buttons.pdfFlash.action.call(self, e, dt, button, config);
			// 			} else if (button[0].className.indexOf('buttons-print') >= 0) {
			// 				$.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
			// 			}
			// 			dt.one('preXhr', function(e, s, data) {
			// 				// DataTables thinks the first item displayed is index 0, but we're not drawing that.
			// 				// Set the property to what it was before exporting.
			// 				settings._iDisplayStart = oldStart;
			// 				data.start = oldStart;
			// 			});
			// 			// Reload the grid with the original page. Otherwise, API functions like table.cell(this) don't work properly.
			// 			setTimeout(dt.ajax.reload, 0);
			// 			// Prevent rendering of the full data to the DOM
			// 			return false;
			// 		});
			// 	});
			// 	// Requery the server with the new one-time export settings
			// 	dt.ajax.reload();
			// };
			//For Export Buttons available inside jquery-datatable "server side processing" - End

			function stud_details() {
				$('#example').DataTable({
					'ajax': {
						'url': '<?= base_url() ?>Student_details/Student_master_ajax',
						'method': 'post',
						'data': {
							val: val,
							// etc..
						},
					},
					'columns': [{
							data: 'sl'
						},
						{
							data: 'STUDENTID'
						},
						{
							data: 'ADM_NO'
						},
						{
							data: 'FIRST_NM'
						},
						{
							data: 'DISP_CLASS',
						},
						{
							data: 'DISP_SEC',
						},
						{
							data: 'stop_nm',
						},
						{
							data: 'bus_no',
						},
						{
							data: 'stopno',
						}
					],

					dom: 'Bfrtip',
					buttons: [{
							extend: 'copyHtml5',
							title: 'Student Details',
							exportOptions: {
								columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
							},
							"action": newexportaction
						},
						{
							extend: 'excelHtml5',
							title: 'Student Details',
							exportOptions: {
								columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
							},
							"action": newexportaction
						},
						{
							extend: 'csvHtml5',
							title: 'Student Details',
							exportOptions: {
								columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
							},
							"action": newexportaction
						},
						{
							extend: 'pdfHtml5',
							title: 'Student Details',
							orientation: 'landscape',
							exportOptions: {
								columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
							},
							"action": newexportaction
						},
					]
				});
			}
		});
	</script> -->

	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>


	<script type="text/javascript">
		$(document).ajaxComplete(function() {
			$('.example').DataTable({
				'paging': false,
				'lengthChange': false,
				'searching': true,
				'ordering': false,
				'info': true,
				'autoWidth': true,
				'pageLength': 25,
				"destroy": true,
			});
		});


		$("#updateform").submit(function(e) {
			var cnt = "<?php echo count($student); ?>";
			if (cnt > 0) {
				e.preventDefault();

				Command: toastr["error"]("Student Exists! Kindly Reallocate Student First", "Warning")

				toastr.options = {
					"closeButton": true,
					"debug": true,
					"newestOnTop": false,
					"progressBar": true,
					"positionClass": "toast-top-right",
					"preventDuplicates": true,
					"onclick": null,
					"showDuration": "300",
					"closeDuration": "1000",
					"timeOut": "5000",
					"extendedTimeOut": "1000",
					"showEasing": "swing",
					"hideEasing": "linear",
					"showMethod": "fadeIn",
					"hideMethod": "fadeOut"
				}
				return false;

			} else {
				$.ajax({
					url: "<?php echo base_url('Add_bus_route/saveupdate'); ?>",
					type: "POST",
					data: $("#updateform").serialize(),
					success: function(response) {
						location.href('Add_bus_route/index');
					}
				});
			}
		});

		// function checkstu(cnt) {
		// 	if (cnt > 0) {
		// 		Command: toastr["error"]("Student Exists! Kindly Reallocate Student First", "Warning")

		// 		toastr.options = {
		// 			"closeButton": true,
		// 			"debug": true,
		// 			"newestOnTop": false,
		// 			"progressBar": true,
		// 			"positionClass": "toast-top-right",
		// 			"preventDuplicates": true,
		// 			"onclick": null,
		// 			"showDuration": "300",
		// 			"closeDuration": "1000",
		// 			"timeOut": "5000",
		// 			"extendedTimeOut": "1000",
		// 			"showEasing": "swing",
		// 			"hideEasing": "linear",
		// 			"showMethod": "fadeIn",
		// 			"hideMethod": "fadeOut"
		// 		}
		// 		return false;
		// 	}
		// 	else {
		// 		method='POST' action="<?php echo base_url('Add_bus_route/saveupdate'); ?>" 
		// 		return true;
		// 	}
		// }

		function dt(val) {
			if (val > 0) {
				$('#monthwise').show(1000);
			} else {
				alert("Delete Confirm");
				var route_Id = <?php echo $bus_route_details[0]->Route_Id; ?>;
				var vehical_no = $('#vehicle_no').val();
				var trip = $('#trip').val();
				var preference = $('#preference').val();
				var stoppage = $('#stoppage').val();
				$.ajax({
					url: "<?php echo base_url('Add_bus_route/delete_add_route_bus'); ?>",
					type: "POST",
					data: {
						'route_Id': route_Id,
						'vehical_no': vehical_no,
						'trip': trip,
						'preference': preference,
						'stoppage': stoppage
					},
					success: function(response) {
						alert(response);

					}
				});
			}
		}
		$(document).ajaxComplete(function() {
			$('.dataTable').DataTable({
				'paging': false,
				'lengthChange': false,
				'searching': true,
				'ordering': false,
				'info': true,
				'autoWidth': true,
				'pageLength': 25,
				"destroy": true,
			});
		});
		$(document).ready(function() {
			$('#createForm').validate({ // initialize the plugin 

				submitHandler: function(form) { // for demo 
					if ($(form).valid())
						form.submit();
					return false; // prevent normal form posting
				}
			});
		});

		function checkstoppagesameornot(val) {
			var BusCode = $('#BusCode').val();
			var Trip_ID = $('#Trip_ID').val();
			var Prefer_ID = $('#Prefer_ID').val();
			$.ajax({
				url: '<?php echo base_url('Add_bus_route/getdetailsmatch'); ?>',
				data: {
					BusCode: BusCode,
					Trip_ID: Trip_ID,
					Prefer_ID: Prefer_ID,
					val: val
				},
				method: "post",
				//dataType:"json",
				success: function(response) {
					if (response >= 1) {
						alert("This stoppage is already assign in selected trip and selected preference");
						$('#stoppage option[value=""]').prop('selected', true);
					}
				}
			});
		}

		function gettripmaster() {
			var vehicleno = $('#vehicleno').val();
			var div_data = '<option value="">Select</option>';
			if (vehicleno != '') {
				$.ajax({
					url: '<?php echo base_url('Add_bus_route/gettripid'); ?>',
					data: {
						vehicleno: vehicleno
					},
					method: "post",
					dataType: "json",
					success: function(response) {
						$.each(response, function(key, val) {
							div_data += '<option value="' + val.Trip_ID + '">' + val.Trip_Nm + '</option>';
						});
						$('#tripid').html(div_data);
					}
				});
			} else {
				$('#tripid').html(div_data);
			}
		}

		function getpreference() {
			var trip_id = $("#tripid").val();
			var div_data = '<option value="">Select</option>';
			if (trip_id != '') {
				div_data += '<option value="3">Co.Ed</option>';
				$('#preference').html(div_data);
			} else {
				$('#preference').html(div_data);
			}
		}

		function getstoppage() {
			var vehicleno = $('#vehicleno').val();
			var preference = $("#preference").val();
			var trip_id = $("#tripid").val();
			var div_data = '<option value="">Select</option>';
			if (preference != '') {
				$.ajax({
					url: '<?php echo base_url('Add_bus_route/getbusstoppage'); ?>',
					data: {
						preference: preference
					},
					method: "post",
					dataType: "json",
					success: function(response) {
						$.each(response, function(key, val) {
							div_data += '<option value="' + val.STOPNO + '">' + val.STOPPAGE + '</option>';
						});
						$('#stoppage').html(div_data);
						$.ajax({
							url: '<?php echo base_url('Add_bus_route/getallbusdetails'); ?>',
							data: {
								preference: preference,
								vehicleno: vehicleno,
								trip_id: trip_id
							},
							method: "post",
							success: function(secondresponse) {
								$("#showbusdetails").html(secondresponse);
							}
						});
					}
				});
			} else {
				$('#stoppage').html(div_data);
			}
		}
	</script>