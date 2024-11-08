
<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="index.html">Consolidated Report</a> <i class="fa fa-angle-right"></i></li>
</ol>
<br>
<!--four-grids here-->
<div class="container">
	<div class="row">
		<div class='col-md-8'>
			
			<form method="post" target="_blank" action="<?php echo base_url('report_card/consolidated_report/get_student'); ?>" autocomplete='off'> 				
				<table class="table" style='margin-top:-40px;'>
					<tr>
						<th>Class</th> 
						<td>
							<select class="form-control" onchange="classes(this.value)" name='classs' id="classs" required>
								<option value=''>Select</option>
								<?php
								if(isset($class_data)){
									foreach($class_data as $data){
										?>
										<option value="<?php echo $data->Class_No; ?>"><?php echo $data->CLASS_NM; ?></option>
										<?php
									}
								}
								?>
							</select>
						</td>

						<th>Sec</th>
						<td>
							<select class="form-control" name="sec" id="sec" onchange="secc(this.value)" required>
								<option value=''>Select</option>
							</select>
						</td>




					</tr>


					<tr>
						<td colspan='11' align='center'><button type="submit" class='btn btn-success buttonload'>

						SUBMIT</button></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</div><br />

<div class="clearfix"></div>
<!-- script-for sticky-nav -->

<?php if(!empty($student_data)){?>
Hello

<?php } ?>
<script>



	function classes(val){
		$.post("<?php echo base_url('report_card/Annual_report_card/classess_report_card'); ?>",{val:val},function(data){
			var fill = $.parseJSON(data);
			$("#sec").html(fill[0]); 
			$("#class_code").val(fill[1]);
			$("#pt_type").val(fill[2]);
			$("#exam_type").val(fill[3]);
		});
	}


</script>