<?php if ($SEX == 1) {
	$gender =  'MALE';
} else {
	$gender = 'FEMALE';
}; ?>
<style type="text/css">
	.table>thead>tr>th,
	.table>tbody>tr>th,
	.table>tfoot>tr>th,
	.table>thead>tr>td,
	.table>tbody>tr>td,
	.table>tfoot>tr>td {
		color: black;
	}
</style>
<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="#">Student Transport</a> <i class="fa fa-angle-right"></i> Allocate Student Transport</li>
</ol>
<div style="padding-left: 25px; background-color: white;padding-top: 5px;padding-top: 20px;">
	<div class="row">
		<div class="col-sm-12">

			<div class="row">
				<!-- student details div -->
				<div class="col-sm-6">
					<form>
						<p><b>Student Details</b></p>
						<hr>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label id="name-label" for="name">NAME</label>
									<input type="text" name="name" id="name" class="form-control" readonly value="<?php echo $FIRST_NM; ?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label id="name-label" for="name">ADM NO.</label>
									<input type="text" name="name" id="name" class="form-control" readonly value="<?php echo $ADM_NO; ?>">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label id="name-label" for="name">CLASS</label>
									<input type="text" name="name" id="name" class="form-control" readonly value="<?php echo $DISP_CLASS; ?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label id="name-label" for="name">SEC</label>
									<input type="text" name="name" id="name" class="form-control" readonly value="<?php echo $DISP_SEC; ?>">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label id="name-label" for="name">MOBILE NO.</label>
									<input type="text" name="name" id="name" class="form-control" readonly value="<?php echo $P_MOBILE; ?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label id="name-label" for="name">ROLL NO.</label>
									<input type="text" name="name" id="name" class="form-control" readonly value="<?php echo $ROLL_NO; ?>">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label id="name-label" for="name">FATHER NAME</label>
									<input type="text" name="name" id="name" class="form-control" readonly value="<?php echo $FATHER_NM; ?>">
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label id="name-label" for="name">GENDER</label>
									<input type="text" name="name" id="name" class="form-control" readonly value="<?php echo $gender; ?>">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>ADDRESS</label>
									<textarea id="comments" class="form-control" readonly name="comment"> <?php echo $CORR_ADD; ?></textarea>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<button type="button" class="btn btn-success" id="allocate_btn" onclick="allocate()">
									Allocate Stoppage
								</button>
								<br>
							</div>
						</div>

						<br>
					</form>
				</div>

				<!-- Alloctae  div -->
				<div class="col-sm-6" id="allocate_" style="display:none; border-left: 1px solid #5785c3;">
					<p><b>Allocate Stoppage</b></p>
					<hr>
					<form method="post" action="<?php echo base_url('student_transport/Bus_transport/allocate_stopage_fornew'); ?>">
						<input type="hidden" name="adm_no" id="adm_no" value="<?php echo $adm_no; ?>" class="form-control">
						<div class="row">
							<div class="col-md-10">
								<div class="form-group">
									<label id="name-label" for="name">MONTH</label>
									<select class='form-control' name='mon_list' id="mon_list" onchange="selectMonth()">
										<option value="none" selected="selected">Choose Month</option>
										<option value="04">APR</option>
										<option value="05">MAY</option>
										<option value="06">JUN</option>
										<option value="07">JUL</option>
										<option value="08">AUG</option>
										<option value="09">SEP</option>
										<option value="10">OCT</option>
										<option value="11">NOV</option>
										<option value="12">DEC</option>
										<option value="01">JAN</option>
										<option value="02">FEB</option>
										<option value="03">MAR</option>

									</select>
								</div>
							</div>

							<div class="col-md-10">
								<div class="form-group">
									<label id="name-label" for="name" id="trip">TRIP</label>
									<select class="form-control" name="trip" id="trip" onchange="selectBus(this.value)">
										<option value="none">Select Trip</option>
										<option value="1">Senior</option>
										<option value="2">Junior</option>
										<option value="3">General</option>
									</select>
								</div>
							</div>

						</div>

						<div class="row">

							<div class="col-md-10">
								<div class="form-group">
									<label id="name-label" for="name">BUS NO</label>
									<select class="form-control" name="busno" id="busno" onchange="selectStoppage(this.value)">
										<option value="none">Select Bus</option>

										<?php
										if ($busno) {

											foreach ($busno as $p) {
										?>
												<option value="<?php echo $p->BusCode; ?>"><?php echo $p->BusNo; ?></option>
										<?php
											}
										}
										?>
									</select>
								</div>
							</div>

							<div class="col-md-10">
								<div class="form-group">
									<label id="name-label" for="name">STOPPAGE</label>
									<select class="form-control" name="selstoppage" id="selstoppage">
										<option value="none">Select Stoppage</option>
									</select>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-4">

								<br>
							</div>
						</div>

						<div class="row">
							<div class="col-md-4">
								<button type="submit" class="btn btn-success">Submit</button>
								<br>
							</div>
						</div>
					</form>
				</div>

			</div>
		</div>
	</div>
</div>
<br>

<script>
	function allocate() {
		// $('#allocate_').show();
		$("#allocate_").fadeIn(1000);
		$('#allocate_btn').prop('disabled', true);
	}

	function selectStoppage(val) {
		var trip = $("#trip").val();
		$.ajax({
			url: '<?php echo base_url('student_transport/Bus_transport/selectStoppage') ?>',
			type: "POST",
			data: {
				val: val,
				trip: trip
			},
			success: function(data) {
				$("#selstoppage").html(data);
			},
		})
	}

	function selectMonth() {
		var admNo = $('#adm_no').val();
		//alert(admNo);
		$.ajax({
			url: '<?php echo base_url('student_transport/Bus_transport/selectTrip') ?>',
			type: "POST",
			data: {
				admNo: admNo
			},
			success: function(data) {
				$("#trip").html(data);
			},
		})
	}

	function selectBus(val) {
		$.ajax({
			url: '<?php echo base_url('student_transport/Bus_transport/selectBus') ?>',
			type: "POST",
			data: {
				val: val
			},
			success: function(data) {
				$("#busno").html(data);
			},
		})
	}
	
</script>