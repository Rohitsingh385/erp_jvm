
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.html">Crosslist Report</a> <i class="fa fa-angle-right"></i></li>
</ol>
<!--four-grids here-->
<div style="padding: 10px; background-color: white; border-top:3px solid #337ab7;">
	<div class="row">
		<form target="_blank" action="<?php echo base_url('report_card/CrossList/Tabulation'); ?>" method="post">
			<div class='col-sm-3'>
				<label>Class</label><br />
				<select class='form-control' name='class' required onchange='getSec(this.value)'>
					<option value="">Select</option>
					<!--<option value="2">PREP</option>
					<option value="3">I</option>
					<option value="4">II</option>-->
					<option value="5">III</option>
					<option value="6">IV</option>
					<option value="7">V</option>
					<option value="8">VI</option>
					<option value="9">VII</option>
					<option value="10">VIII</option>
					<option value="11">IX</option>
					<option value="12">X</option>
					<?php if ($user_id == EMP0140 || $user_id == EMP0177){ ?>
					<option value="13">XI</option>
					<?php } ?>
				</select>
			</div>
			<div class='col-sm-3'>
				<label>Section</label><br />
				<select class='form-control' id='sec' name='sec' required>
					<option value="">Select</option>
				</select>
			</div>
			<div class='col-sm-3'>
				<label>Term</label><br />
				<select class='form-control' name='term' required readonly>
					<option value="">Select</option>
					<option value="1" selected>TERM-1</option>
					<option value="2">TERM-2</option>
				</select>
			</div>
			<div class='col-sm-3'>
				<label style='visibility:hidden'>Term</label><br />
				<input type="submit" name='save' class='btn btn-success'>
				<input type="submit" name='view' value='view' class='btn btn-warning'>
			</div>
		</form>
	</div>
</div><br />

<div class="clearfix"></div>

<script>
	function getSec(val){
		$.ajax({
			url: "<?php echo base_url('report_card/CrossList/getSection'); ?>",
			type: "POST",
			data: {val:val},
			success: function(ret){
				$("#sec").html(ret);
			}
		});
	}
</script>