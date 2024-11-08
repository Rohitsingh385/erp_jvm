<?php error_reporting(0); ?>
<div class="container">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Student Transport</a> <i class="fa fa-angle-right"></i></li>
	</ol>



	<div class="alert alert-danger" role="alert">
		Student is not availing transport facility,Want to Add then proceed.<br><br>
	</div>
	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
		Allocate Stoppage
	</button>



	<!-- model -->
	<!-- The Modal -->
	<form method="post" action="<?php echo base_url('student_transport/Bus_transport/allocate_stopage_fornew'); ?>">
		<div class="modal" id="myModal">
			<div class="modal-dialog">
				<div class="modal-content">

					<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title">Allocate Stoppage and Bus No</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>

					<!-- Modal body -->
					<div class="modal-body">

						<div class="row">
							<div class="col-md-3">
								<CENTER>MONTH</CENTER>
							</div>
							<div class="col-md-6">
								<select class='form-control' name='mon_list' id="mon_list">
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

						<div class="row">
							<div class="col-md-3">
								<CENTER>BUS NO</CENTER>
							</div>
							<div class="col-md-6">

							</div>
							<input type="hidden" name="adm_no" id="adm_no" value="<?php echo $adm_no; ?>" class="form-control">
							<div class="col-md-6 col-sm-6 col-lg-6 col-xl-6 form-group">

								<select class="form-control" name="busno" id="busno">
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
						
						<!-- trip -->
						<div class="row">
							<div class="col-md-3">
								<CENTER>Select Trip</CENTER>
							</div>
							<div class="col-md-6">

							</div>
							<div class="col-md-6 col-sm-6 col-lg-6 col-xl-6 form-group">

								<select class="form-control" name="trip" id="trip" onchange="selectStoppage(this.value)">
									<option value="none">Select Trip</option>
									<option value="1">Senior</option>
									<option value="2">Junior</option>
									<option value="3">General</option>
								</select>
							</div>

						</div>

						<div class="row">
							<div class="col-md-3">
								<CENTER>STOPPAGE</CENTER>
							</div>
							<div class="col-md-6">

							</div>
							<input type="hidden" name="adm_no" id="adm_no" value="<?php echo $adm_no; ?>" class="form-control">
							<div class="col-md-6 col-sm-6 col-lg-6 col-xl-6 form-group">

								<select class="form-control" name="selstoppage" id="selstoppage">
									<option value="none">Select Bus</option>


								</select>
							</div>
						</div>
					</div>

					<!-- Modal footer -->
					<div class="modal-footer">
						<button type="submit" class="btn btn-success">Submit</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					</div>

				</div>
			</div>
		</div>
	</form>

	<script>
		 function selectStoppage(val) {
	  var busno = $("#busno").val();
			 //alert(busno);
    $.ajax({
      url: '<?php echo base_url('student_transport/Bus_transport/selectStoppage') ?>',
      type: "POST",
      data: {
        val: val,
		  busno: busno
      },

      success: function(data) {
        $("#selstoppage").html(data);
      },

    })
  }

	</script>