<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="#">Edit Bus Trip Master</a> <i class="fa fa-angle-right"></i></li>
</ol>
<!--four-grids here-->
<div style="padding: 10px; background-color: white">
	<div class='col-sm-12'>
		<a href="<?php echo base_url('Bus_trip_master/index'); ?>" class='btn btn-danger pull-right'>BACK</a><br /><br /><br />
	</div>
	<form action="<?php echo base_url('Bus_trip_master/trip_update'); ?>" method="post">
		<table class="table table-bordered" id="class_table">
			<tr>
				<td><b>Trip Name</b></td>
				<td><input type="text" ID="TN" oninput="checkdata(this.value)" pattern="[A-Za-z]{2,-}" name="tn" required name="stop_name" class="form-control" value="<?php echo $bus_master[0]->Trip_Nm; ?>"></td>
			</tr>
			<tr>
				<td><b>Select Class</b></td>
				<td>
					<select class="form-control" multiple="multiple" name="cls[]" id="cls" required="true" style="border-bottom: 1px solid black;">
						<option value="">Select Class</option>
						<?php foreach ($classdata as $cls) {
							$trip_class = unserialize($bus_master[0]->Class_No);
							$selected = in_array($cls->Class_No, $trip_class) ? 'selected' : '';
						?>
							<option value="<?php echo $cls->Class_No ?>" <?php echo $selected; ?>><?php echo $cls->CLASS_NM; ?></option>
						<?php } ?>
					</select>
				</td>
			</tr>

		

			<tr>
				<input type="hidden" name="id" value="<?php echo $bus_master[0]->Trip_ID; ?>">
			</tr>
			<tr>
				<td colspan='2' align='center'><input type="submit" name="class_save" value="UPDATE" class="btn btn-success"></td>
			</tr>
		</table>
	</form>
</div><br /><br />
<div class="clearfix"></div>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- script-for sticky-nav -->
<script type="text/javascript">
	$("#cls").select2();

	function checkdata(val) {
		if (val == "") {
			Command: toastr["info"]("Please Enter Trip Name", "Warning")

			toastr.options = {
				"closeButton": true,
				"debug": true,
				"newestOnTop": false,
				"progressBar": true,
				"positionClass": "toast-top-right",
				"preventDuplicates": true,
				"onclick": null,
				"showDuration": "300",
				"hideDuration": "1000",
				"timeOut": "5000",
				"extendedTimeOut": "1000",
				"showEasing": "swing",
				"hideEasing": "linear",
				"showMethod": "fadeIn",
				"hideMethod": "fadeOut"
			}
		}
		else {
			$.ajax({
				url: "<?php echo base_url('Bus_trip_master/checkdata'); ?>",
				method: "POST",
				data: {
					val: val
				},
				success: function(data) {
					if (data == 1) {
						$('#TN').val("");
						Command: toastr["info"]("Please Enter Another Trip Name This Name Is Already Exist.", "Warning")

						toastr.options = {
							"closeButton": true,
							"debug": true,
							"newestOnTop": false,
							"progressBar": true,
							"positionClass": "toast-top-right",
							"preventDuplicates": true,
							"onclick": null,
							"showDuration": "300",
							"hideDuration": "1000",
							"timeOut": "5000",
							"extendedTimeOut": "1000",
							"showEasing": "swing",
							"hideEasing": "linear",
							"showMethod": "fadeIn",
							"hideMethod": "fadeOut"
						}
					}
				}
			});
		}
	}
</script>
<!-- /script-for sticky-nav -->
<!--inner block start here-->
<div class="inner-block">

</div>
<!--inner block end here-->
<!--copy rights start here-->

<script>
	$(document).ready(function() {
		$('#class_table').DataTable();
	});
</script>