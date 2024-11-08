<table class="table table-bordered dataTable table-striped">
	<thead style="background: #d2d6de;">
		<tr>
			<th style="background: #337ab7; color: white !important;" class="text-center">S. No</th>
			<th style="background: #337ab7; color: white !important;">Stoppage Name</th>
			<th style="background: #337ab7; color: white !important;">Bus No</th>
			<th style="background: #337ab7; color: white !important;">Trip</th>
			<th style="background: #337ab7; color: white !important;">Preference</th>
			<th style="background: #337ab7; color: white !important;">Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$i = 1;
		foreach ($busstoppagedetails as $key => $value) {
		?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php if (!empty($value->STOPPAGE)) {
						echo $value->STOPPAGE;
					} else {
						echo "N/A";
					} ?></td>
				<td><?php echo $value->BusCode; ?></td>
				<td><?php echo $value->Trip_Nm; ?></td>
				<td><?php if ($value->Prefer_ID == 1) {
						echo "Boys";
					} elseif ($value->Prefer_ID == 2) {
						echo "Girls";
					} elseif ($value->Prefer_ID == 3) {
						echo "Co.Ed";
					} ?></td>
				<td>
					<a title='EDIT' href='<?php echo base_url('Add_bus_route/edit_details/' . $value->Route_Id); ?>'><i class="fa fa-pencil-square-o" aria-hidden="true" style='color:black;font-size:16px;'></i></a>&emsp;&emsp;
					<a title='DELETE' href='javascript:void(0);' onclick="checkdata(<?php echo $value->Route_Id . ',' . $value->STOPNO . ',' . $value->BusCode . ',' . $value->trip_ID; ?>)"><i class="fa fa-trash-o " aria-hidden="true" style='color:red;font-size:16px;'></i></a>
				</td>
			</tr>
		<?php
			$i++;
		}
		?>
	</tbody>
</table>

<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

<script>
	function checkdata(routeid, stopno, buscode, trip) {
		$.ajax({
			url: "<?php echo base_url('Add_bus_route/delete_add_route_bus'); ?>",
			type: "POST",
			data: {
				routeid: routeid,
				stopno: stopno,
				buscode: buscode,
				trip: trip
			},
			success: function(data) {
				if (data == 1) {
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
				}
				else {
					Command: toastr["success"]("Stoppage Deleted From Corresponding Route", "Success")

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
					load_data();
				}
			}
		});
	}

	function load_data() {
		var vehicleno = $('#vehicleno').val();
		var preference = $("#preference").val();
		var trip_id = $("#tripid").val();
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
</script>