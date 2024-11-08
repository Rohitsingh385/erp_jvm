<?php
 if($data){
	$STOPNO = $data[0]->STOPNO; 
	$STOPPAGE = $data[0]->STOPPAGE;
 }
?>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Edit Bus Master</a> <i class="fa fa-angle-right"></i></li>
</ol>
<!--four-grids here-->
		<div style="padding: 10px; background-color: white; border-top:3px solid #5785c3;">
        <div class='col-sm-12'>		
		  <a href="<?php echo base_url('Fees_master/Bus_Stoppage_Master'); ?>" class='btn btn-danger pull-right'>BACK</a><br /><br /><br />
        </div>
		  <form action="<?php echo base_url('Fees_master/busmaster_update'); ?>" method="post">
		  <table class="table table-bordered" id="class_table">
			<tr>
				<td colspan="2"><b>Stoppage Name</b></td>
				<td colspan="2"><input type="text" required name="stop_name" class="form-control" value="<?php echo $STOPPAGE; ?>"></td>
				<td colspan='2'><b>Enter Stoppage Group</b></td>
				<td colspan='2'>
					 <select name="group" id="group" onkeypress='return isAlpha(event)' oninput="this.value = this.value.toUpperCase()" required class="form-control" required class="form-select" onchange="amt(this.value)">
						 <option>Select</option>
						<?php foreach($stoppage_category_master as $group_stpg){ ?>
						<option value="<?php echo $group_stpg->Stoppage_Group; ?>" <?php if($data[0]->StoppageGroup == $group_stpg->Stoppage_Group) echo "selected"; ?>><?php echo $group_stpg->Stoppage_Group; ?>
</option>
						<?php } ?>
					 </select>
				</td>
			</tr>
			<tr>
				<td><b>Apr</b></td>
				<td><input type="number" onblur="fillval()" onkeypress='return isNumber(event)' min='0' <?php if ($STOPNO == 1) {
																												echo "readonly";
																											} ?> required id="Apr" name="Apr" class="form-control" value="<?php echo $data[0]->APR_FEE; ?>"></td>

				<td><b>May</b></td>
				<td><input type="number" <?php if ($STOPNO == 1) {
												echo "readonly";
											} ?> min='0' required id="May" name="May" class="form-control" value="<?php echo $data[0]->MAY_FEE; ?>"></td>

				<td><b>Jun</b></td>
				<td><input type="number" <?php if ($STOPNO == 1) {
												echo "readonly";
											} ?> min='0' required id="Jun" name="Jun" class="form-control" value="<?php echo  $data[0]->JUN_FEE; ?>"></td>

				<td><b>Jul</b></td>
				<td><input type="number" <?php if ($STOPNO == 1) {
												echo "readonly";
											} ?> min='0' required id="Jul" name="Jul" class="form-control" value="<?php echo  $data[0]->JUL_FEE; ?>"></td>
			</tr>
			<tr>
				<td><b>Aug</b></td>
				<td><input type="number" <?php if ($STOPNO == 1) {
												echo "readonly";
											} ?> min='0' required id="Aug" name="Aug" class="form-control" value="<?php echo  $data[0]->AUG_FEE; ?>"></td>

				<td><b>Sep</b></td>
				<td><input type="number" <?php if ($STOPNO == 1) {
												echo "readonly";
											} ?> min='0' required id="Sep" name="Sep" class="form-control" value="<?php echo  $data[0]->SEP_FEE; ?>"></td>

				<td><b>Oct</b></td>
				<td><input type="number" <?php if ($STOPNO == 1) {
												echo "readonly";
											} ?> min='0' required id="Oct" name="Oct" class="form-control" value="<?php echo  $data[0]->OCT_FEE; ?>"></td>

				<td><b>Nov</b></td>
				<td><input type="number" <?php if ($STOPNO == 1) {
												echo "readonly";
											} ?> min='0' required id="Nov" name="Nov" class="form-control" value="<?php echo  $data[0]->NOV_FEE; ?>"></td>
			</tr>
			<tr>
				<td><b>Dec</b></td>
				<td><input type="number" <?php if ($STOPNO == 1) {
												echo "readonly";
											} ?> min='0' required id="Dec" name="Dec" class="form-control" value="<?php echo  $data[0]->DEC_FEE; ?>"></td>

				<td><b>Jan</b></td>
				<td><input type="number" <?php if ($STOPNO == 1) {
												echo "readonly";
											} ?> min='0' required id="Jan" name="Jan" class="form-control" value="<?php echo  $data[0]->JAN_FEE; ?>"></td>

				<td><b>Feb</b></td>
				<td><input type="number" <?php if ($STOPNO == 1) {
												echo "readonly";
											} ?> min='0' required id="Feb" name="Feb" class="form-control" value="<?php echo  $data[0]->FEB_FEE; ?>"></td>

				<td><b>Mar</b></td>
				<td><input type="number" <?php if ($STOPNO == 1) {
												echo "readonly";
											} ?> min='0' required id="Mar" name="Mar" class="form-control" value="<?php echo  $data[0]->MAR_FEE; ?>"></td>
			</tr>
			<tr>
				<input type="hidden" name="id" value="<?php echo $STOPNO; ?>">
			</tr>
			<tr>
				<td colspan='2' align='center'><input type="submit" name="class_save" value="UPDATE" class="btn btn-success"></td>
			</tr>
		</table>
		  </form>
		</div><br /><br />
        <div class="clearfix"></div>
                   
	
<!-- script-for sticky-nav -->
		<script>
				function amt(val) {
		$.ajax({
			url: "<?php echo base_url('Fees_master/stoppage_amt'); ?>",
			type: "POST",
			data: {
				val: val
			},
			success: function(data) {
				var amount = JSON.parse(data);
				$('#Apr').val(amount);
				$('#May').val(0);
				$('#Jun').val(amount);
				$('#Jul').val(amount);
				$('#Aug').val(amount);
				$('#Sep').val(amount);
				$('#Oct').val(amount);
				$('#Nov').val(amount);
				$('#Dec').val(amount);
				$('#Jan').val(amount);
				$('#Feb').val(amount);
				$('#Mar').val(amount);
			},
		});
	}
			function fillval() {
		let apr = $('#Apr').val();
		$('#May').val(apr);
		$('#Jun').val(apr);
		$('#Jul').val(apr);
		$('#Aug').val(apr);
		$('#Sep').val(apr);
		$('#Oct').val(apr);
		$('#Nov').val(apr);
		$('#Dec').val(apr);
		$('#Jan').val(apr);
		$('#Feb').val(apr);
		$('#Mar').val(apr);
	}

	function isNumber(evt) {
		evt = (evt) ? evt : window.event;
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode > 31 && (charCode < 48 || charCode > 57)) {
			return false;
		}
		return true;
	}
			function isAlpha(evt) {
		evt = (evt) ? evt : window.event;
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode > 31 && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122)) {
			return false;
		}
		return true;
	}
		$(document).ready(function() {
			 var navoffeset=$(".header-main").offset().top;
			 $(window).scroll(function(){
				var scrollpos=$(window).scrollTop(); 
				if(scrollpos >=navoffeset){
					$(".header-main").addClass("fixed");
				}else{
					$(".header-main").removeClass("fixed");
				}
			 });
			 
		});
		</script>
		<!-- /script-for sticky-nav -->
<!--inner block start here-->
<div class="inner-block">

</div>
<!--inner block end here-->
<!--copy rights start here-->

<script>
$(document).ready( function () {
    $('#class_table').DataTable();
	
} );
</script>
