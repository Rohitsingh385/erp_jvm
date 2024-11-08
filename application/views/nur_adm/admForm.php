<!DOCTYPE HTML>
<?php  $date_now = date("Y-m-d");
	if ($date_now <= '2024-12-22') {
	}else{
	?>
	<center>Oops Time is over!!!!</center>  
 
<?php
		exit;
	}?>
<html>
	<head>
		<title>Registration Form</title>
        <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="<?php echo base_url('assets/dash_css/bootstrap-datepicker.min.css'); ?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/dash_css/bootstrap.min.css'); ?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/dash_css/font-awesome.css'); ?>">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css"/>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
		<script src="<?php echo base_url('assets/dash_js/jquery-2.1.4.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/dash_js/bootstrap.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/dash_js/bootstrap-datepicker.min.js'); ?>"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script>
		<style>
		    label span{
				color:red;
				font-weight:bold;
			}
			fieldset.scheduler-border {
				border: 1px groove #ddd !important;
				padding: 0 1.4em 1.4em 1.4em !important;
				margin: 0 0 1.5em 0 !important;
				-webkit-box-shadow:  0px 0px 0px 0px #000;
						box-shadow:  0px 0px 0px 0px #000;
			}
			legend.scheduler-border {
				font-size: 1.2em !important;
				font-weight: bold !important;
				text-align: left !important;
				width:inherit; /* Or auto */
                padding:0 10px; /* To give a bit of padding on the left and right */
                border-bottom:none;
			}
			.main{
				background:#e1fcf7;
				padding:10px;
			}
			body{
				background:#000;
				font-family: Verdana,Geneva,sans-serif !important; 
			}
			input,select,textarea{
				text-transform: uppercase
			}
		</style>
	</head>
	<body><br />
		<div class='container'>
		<div class='main'>
			<!-- header -->
			<table class='table'>
				<tr>
					<td>
						<center>
							<img src="<?php echo base_url($school_photo[0]->School_Logo_RT); ?>" style="width:100px;" class='img-responsive'>
							<span style='font-size:25px !important;'><?php echo $school_setting[0]->School_Name; ?></span><br /
							>
							<span style='font-size:18px !important'>
							Shyamali, Doranda Ranchi- 834002
							</span><br />
							<b><center><span style='font-size:16px !important;'>NURSERY APPLICATION FORM (for session 2025-2026)</span></center></b>
						</center>
					</td>
				</tr>
			</table>
		    <!-- end header -->
			<form autocomplete='off' id='nur_form' enctype='multipart/form-data'>
			<fieldset class="scheduler-border">
			<legend class="scheduler-border">APPLICANT DETAILS</legend>
			<div class='row'>
				<div class='col-sm-4'>
					<div class="form-group">
						<label>Applicant's Name <span>*</span></label>
						<input type="text" class="form-control" name='stu_nm' id='stu_nm' pattern="^[a-zA-Z][\sa-zA-Z]*" onkeypress='return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode == 32 || event.charCode == 46' required onchange='blnk()'>
					</div>
				</div>
				<div class='col-sm-4'>
					<div class="form-group">
						<label>Date of Birth <span>*</span></label>(<i style='font-size:11px; color:#000;'>Should be 01-04-2020 to 31-03-2021</i>)
						<input type="text" class="form-control datepicker" name='dob' id='dob'  onchange='blnk()' required>
					</div>
				</div>
				<div class='col-sm-4'>
					<div class="form-group">
						<label>Gender <span>*</span></label>
						<select class="form-control" name='gender' required>
							<option value=''>Select</option>
							<option value='1'>Male</option>
							<option value='2'>Female</option>
						</select>
					</div>
				</div>
			
				<div class='col-sm-4'>
					<div class="form-group">
						<label>Physically Challenged</label>
						<select class="form-control" name='phy_challenged' required>
							<option value=''>Select</option>
							<option value='Y'>YES</option>
							<option value='N' selected>NO</option>
						</select>
					</div>
				</div>
				<div class='col-sm-4'>
					<div class="form-group">
						<label>Category <span>*</span></label>
						<select class="form-control" name='category' required>
							<option value=''>Select</option>
							<?php
								foreach($category as $key => $val){
									?>
										<option value='<?php echo $val['CAT_CODE']; ?>'><?php echo $val['CAT_DESC']; ?></option>
									<?php
								}
							?>
						</select>
					</div>
				</div>
				<div class='col-sm-4'>
					<div class="form-group">
						<label>Aadhaar No. </label>
						<input type="number" class="form-control" id='aadhaar_no' name='aadhaar_no' onkeypress="if(this.value.length==12) { return false;}" min='0' onchange='no_validate(12,this)'>
					</div>
				</div>	
			
				<div class='col-sm-4'>
					<div class="form-group">
						<label>Mother Tongue <span>*</span></label>
						<select class="form-control" name='mother_tounge' required>
							<option value=''>Select</option>
							<?php
								foreach($motherTounge as $key => $val){
							?>
							<option value='<?php echo $key; ?>'><?php echo $val; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class='col-sm-4'>
					<div class="form-group">
						<label>Religion <span>*</span></label>
						<select class="form-control" name='religion' required>
							<option value=''>Select</option>
							<?php
								foreach($religion as $key => $val){
									?>
										<option value='<?php echo $val['RNo']; ?>'><?php echo $val['Rname']; ?></option>
									<?php
								}
							?>
						</select>
					</div>
				</div>
			
				<div class='col-sm-4'>
					<div class="form-group">
						<label>Blood Group <span>*</span></label>
						<select class="form-control" name='blood_group' required>
							<option value=''>Select</option>
							<?php
								foreach($bloodGroup as $key => $val){
							?>
							<option value='<?php echo $key; ?>'><?php echo $val; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>

				<div class='col-sm-4'>
					<div class="form-group">
						<label>Photograph <span>*</span></label>
						<input type='file' id='filePHOTO' name='img' class='form-control file_upload1' required onchange='img_validate()'>
						<span style='font-size:10.5px;'><i><b>File size must be less than 100kb allowed format JPG,JPEG,PNG only</b></i></span>
					</div>
				</div>	
			</div>
			</fieldset>
			
			<fieldset class="scheduler-border">
				<legend class="scheduler-border">PARENT'S DETAILS</legend>
					<div class='row'>	
						
						<div class='col-sm-6'>
							<fieldset class="scheduler-border">
								<legend class="scheduler-border">FATHER'S DETAILS</legend>
								<div class='col-sm-12'>
									<div class="form-group">
										<label>Name <span>*</span></label>
										<input type="text" pattern="^[a-zA-Z][\sa-zA-Z]*" class="form-control" name='f_name' onkeypress='return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode == 32 || event.charCode == 46' required>
									</div>
								</div>
								
								<div class='col-sm-12'>
									<div class="form-group">
										<label>Qualification <span>*</span></label>
										<select class="form-control" name='f_qualification' required>
											<option value=''>Select</option>
											<?php
												foreach($parent_qualification as $key => $val){
											?>
											<option value='<?php echo $key; ?>'><?php echo $val; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								
								<div class='col-sm-6'>
									<div class="form-group">
										<label>Occupation <span>*</span></label>
										<select class="form-control" name='f_accupation' required>
											<option value=''>Select</option>
											<?php
												foreach($parent_accupation as $key => $val){
											?>
											<option value='<?php echo $key; ?>'><?php echo $val; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								
								<div class='col-sm-6'>
									<div class="form-group">
										<label>Govt. Job</label>
										<select class="form-control" name='f_gov_job' required>
											<option value='Y'>YES</option>
											<option value='N' selected>NO</option>
										</select>
									</div>
								</div>
								
								<div class='col-sm-6'>
									<div class="form-group">
										<label>Govt. Job Transferable</label>
										<select class="form-control" name='f_jbo_transferable'>
										    <option value='Y'>YES</option>
											<option value='N' selected>NO</option>
										</select>
									</div>
								</div>
								
								<div class='col-sm-6'>
									<div class="form-group">
										<label>JVM Alumni</label>
										<select class="form-control" name='f_alumini' onchange="alumini(this.value,'F')">
											<option value='Y'>YES</option>
											<option value='N' selected>NO</option>
										</select>
									</div>
								</div>
								
								<div id='f_hideShow' style='display:none'>
								<div class='col-sm-6'>
									<div class="form-group">
										<label>Year of Passing <span>*</span></label>
										<input type="text" class="form-control" name='f_year_leaving' id='f_year_leaving' required disabled>
									</div>
								</div>
								
								<div class='col-sm-6'>
									<div class="form-group">
										<label>Reg. No.</label>
										<input type="text" class="form-control" name='f_reg_no' id='f_reg_no' onkeypress='return event.charCode >= 47 && event.charCode <= 57' maxlength='9' disabled>
									</div>
								</div>
								</div>
							</fieldset>	
						</div>
						
						<div class='col-sm-6'>
							<fieldset class="scheduler-border">
								<legend class="scheduler-border">MOTHER'S DETAILS</legend>
								<div class='col-sm-12'>
									<div class="form-group">
										<label>Name <span>*</span></label>
										<input type="text" pattern="^[a-zA-Z][\sa-zA-Z]*" class="form-control" name='m_name' onkeypress='return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode == 32 || event.charCode == 46' required>
									</div>
								</div>
								
								<div class='col-sm-12'>
									<div class="form-group">
										<label>Qualification <span>*</span></label>
										<select class="form-control" name='m_qualification' required>
											<option value=''>Select</option>
											<?php
												foreach($parent_qualification as $key => $val){
											?>
											<option value='<?php echo $key; ?>'><?php echo $val; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								
								<div class='col-sm-6'>
									<div class="form-group">
										<label>Occupation <span>*</span></label>
										<select class="form-control" name='m_accupation' required>
											<option value=''>Select</option>
											<?php
												foreach($parent_accupation as $key => $val){
											?>
											<option value='<?php echo $key; ?>'><?php echo $val; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								
								<div class='col-sm-6'>
									<div class="form-group">
										<label>Govt. Job</label>
										<select class="form-control" name='m_gov_job'>
											<option value='Y'>YES</option>
											<option value='N' selected>NO</option>
										</select>
									</div>
								</div>
								
								<div class='col-sm-6'>
									<div class="form-group">
										<label>Govt. Job Transferable</label>
										<select class="form-control" name='m_jbo_transferable'>
										    <option value='Y'>YES</option>
											<option value='N' selected>NO</option>
										</select>
									</div>
								</div>
								
								<div class='col-sm-6'>
									<div class="form-group">
										<label>JVM Alumni</label>
										<select class="form-control" name='m_alumini' onchange="alumini(this.value,'M')">
											<option value='Y'>YES</option>
											<option value='N' selected>NO</option>
										</select>
									</div>
								</div>
								
								<div id='m_hideShow' style='display:none'>
								<div class='col-sm-6'>
									<div class="form-group">
										<label>Year of Passing <span>*</span></label>
										<input type="text" class="form-control" name='m_year_leaving' id='m_year_leaving' required disabled>
									</div>
								</div>
								
								<div class='col-sm-6'>
									<div class="form-group">
										<label>Reg. No.</label>
										<input type="text" class="form-control" name='m_reg_no' id='m_reg_no' onkeypress='return event.charCode >= 47 && event.charCode <= 57' maxlength='9' disabled>
									</div>
								</div>
								</div>
							</fieldset>	
						</div>
					</div>
					
					<div class='row'>
					    <div class='col-sm-6'>
					    <fieldset class="scheduler-border">
						<legend class="scheduler-border">SIBLING DETAILS <span style='font-size:12px;'>(Studying in this school)</span></legend>
						<div class='col-sm-6'>
							<div class="form-group">
								<label>No. of Sons</label>
								<input type="number" class="form-control" name='no_of_son' id='no_of_son' onkeypress="if(this.value.length==1) { return false;}" min='0' max='9' oninput='sibling()'>
							</div>
						</div>
						<div class='col-sm-6'>
							<div class="form-group">
								<label>No. of Daughters</label>
								<input type="number" class="form-control" name='no_of_daughters' id='no_of_daughters' onkeypress="if(this.value.length==1) { return false;}" min='0' max='9' oninput='sibling()'>
							</div>
						</div>
						</fieldset>
						</div>
						<div class='col-sm-6'>	
							<fieldset class="scheduler-border">
							<legend class="scheduler-border">OTHER DETAILS</legend>
							<div class='col-sm-6'>
								<div class="form-group">
									<label>Single Parent</label>
									<select class="form-control" name='single_parent' onchange='single_parents(this.value)'>
										<option value='Y'>YES</option>
										<option value='N' selected>NO</option>
									</select>
								</div>
							</div>
							<div class='col-sm-6'>
								<div class="form-group">
									<label>Father/Mother </label>
									<select class="form-control" id='fatormot' name='father_or_mother' disabled required>
										<option value=''>Select</option>
										<option value='Father'>Father</option>
										<option value='Mother'>Mother</option>
									</select>
								</div>
							</div>
						    </fieldset>	
						</div>
						
						<div class='col-sm-12'>
						<fieldset class="scheduler-border">
							<legend class="scheduler-border">BROTHER & SISTER <span style='font-size:12px;'>(Own Brother/Sister presently studying in JVM School)</span></legend>
							<?php
								for($i=0; $i<2; $i++){
							?>
							<div class='col-sm-3'>
								<div class="form-group">
									<label>Name of Student</label>
									<input type='text' pattern="^[a-zA-Z][\sa-zA-Z]*" class="form-control" id='stuofjvm_<?php echo $i; ?>' name='stuofjvm_<?php echo $i; ?>' oninput='stuof(this)' onkeypress='return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode == 32 || event.charCode == 46' disabled>
								</div>
							</div>
							<div class='col-sm-3'>
								<div class="form-group">
									<label>Class</label>
									<select class="form-control" id='classes_<?php echo $i; ?>' name='class_<?php echo $i; ?>' disabled onchange='classes(this)' required>
										<option value=''>Select</option>
										<?php
											foreach($stu_classes as $key => $val){
												?>
													<option value='<?php echo $val['CLASS']?>'><?php echo $val['DISP_CLASS']?></option>
												<?php
											}
										?>
									</select>
								</div>
							</div>
							<div class='col-sm-3'>
								<div class="form-group">
									<label>Sec</label>
									<select class="form-control" id='sec_<?php echo $i; ?>' name='sec_<?php echo $i; ?>' disabled required>
										<option value=''>Select</option>
									</select>
								</div>
							</div>
							<div class='col-sm-3'>
								<div class="form-group">
									<label>Reg. No.</label>
									<input type="text" class="form-control" id='reg_<?php echo $i; ?>' name='registration_<?php echo $i; ?>' disabled onkeypress='return event.charCode >= 47 && event.charCode <= 57' maxlength='9' required>
								</div>
							</div>
							<?php } ?>
							<span style='color:red'>* <b>Note:- </b><i>(Cousin are not allowed)</i></span>
						</fieldset>
						</div>
					</div>
					
					<div class='row'>
					<div class='col-sm-9'>
						<label>Whether Grand Parent worked/working in JVM/MECON/SAIL Units at Ranchi. <br/>(Related original certificate to be submitted in hardcopy issued by Personnel Department of MECON/SAIL units at Ranchi).</label><br/>
						<input type='radio' name='grnd_prnt' value='YES' onclick="grnd_prntt('Y')"> YES <input type='radio' name='grnd_prnt' value='NO' onclick="grnd_prntt('N')" checked> NO 
					</div>
					<div class='col-sm-3' id='grp_prnts' style='display:none;'>
						<div class="form-group">
							<label>Grand Parent </label>
							<select class="form-control" name='grand_parent' id='grand_parent'>
								<?php
									foreach($grand_parent as $key => $val){
										if($key == 4){
										?>
											<option value='<?php echo $key; ?>'><?php echo $val; ?></option>
										<?php
										}
									}
								?>
							</select>
						</div>
					</div>
					</div>
				</fieldset>
				
				<div class='row'>	
					<div class='col-sm-6'>
						<fieldset class="scheduler-border">
							<legend class="scheduler-border">RESIDENTIAL ADDRESS</legend>
							<div class='col-sm-12'>
								<div class="form-group">
									<label>Address (of Ranchi Only) <span>*</span></label>
									<textarea required class="form-control" name='residentail_add' id='residentail_add' rows='4'></textarea>
								</div>
							</div>
							
							
							<div class='col-sm-6'>
								<div class="form-group">
									<label>PIN Code <span>*</span></label>
									<input type="number" class="form-control" name='pin_code' id='pin_code' onkeypress="if(this.value.length==6) { return false;}" min='0' required onchange='no_validate(6,this)'>
								</div>
							</div>
							
							<!--<div class='col-sm-6'>
								<div class="form-group">
									<label>Phone Residence</label>
									<input type="number" class="form-control" name='phone_residence' id='phone_residence' onkeypress="if(this.value.length==11) { return false;}" min='0'>
								</div>
							</div>-->
							<div class='col-sm-6'>
								<div class="form-group">
									<label>Mobile <span>*</span></label>
									<input type="number" class="form-control" name='mobile' id='mobile' onkeypress="if(this.value.length==10) { return false;}" min='0' required onchange='no_validate(10,this)'>
								</div>
							</div>
							<div class='col-sm-6'>
								<div class="form-group">
									<label>Email Id (Preferable)</label>
									<input type="email" class="form-control" name='email' id='email' onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode >= 64 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode == 95|| event.charCode == 46'  style='text-transform: lowercase'>
								</div>
							</div>
							<div class='col-sm-12'>
								<div class="form-group">
									<label>Distance of residence from school in KM<span>*</span></label>
									<input type="text" class="form-control" name='distance' min='0' id='distance' onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46' maxlength='4' required>
								</div>
							</div>	
						</fieldset>	
					</div>
					
					<div class='col-sm-6'>
						<fieldset class="scheduler-border" style='height:420px !important;'>
							<legend class="scheduler-border">PERMANENT ADDRESS</legend>
							<div class='col-sm-12'>
								<div class="form-group">
									<label>Address <span>*</span> <input type='checkbox' name='chk' onclick='sameAs()'><i style='font-size:12px;'> (If same as Residential address)</i></label>
									<textarea required class="form-control" name='p_residentail_add' id='p_residentail_add' rows='4'></textarea>
								</div>
							</div>
							
							
							<div class='col-sm-6'>
								<div class="form-group">
									<label>PIN Code <span>*</span> </label>
									<input type="number" class="form-control" name='p_pin_code' id='p_pin_code' onkeypress="if(this.value.length==6) { return false;}" min='0' required onchange='no_validate(6,this)'>
								</div>
							</div>
							
							<!--<div class='col-sm-6'>
								<div class="form-group">
									<label>Phone Residence</label>
									<input type="number" class="form-control" name='p_phone_residence' id='p_phone_residence' onkeypress="if(this.value.length==11) { return false;}" min='0'>
								</div>
							</div>
							<div class='col-sm-6'>
								<div class="form-group">
									<label>Mobile <span>*</span></label>
									<input type="number" class="form-control" name='p_mobile' id='p_mobile' onkeypress="if(this.value.length==10) { return false;}" min='0' required onchange='no_validate(10,this)'>
								</div>
							</div>-->
						</fieldset>	
					</div>
				</div>
				<div class='row'>
					<div class='col-sm-12'>
						<p style='text-align:justify'><input type='checkbox' id='check' onchange='checkExist()' required> I/We hereby certify that the above information provided by me/us is correct. I/We understand that if the information is found to be incorrect or false, my ward shall be automatically debarred from selection/admission process without any correspondence in this regard. I/We also understand that the application/registration/short listing does not guarantee admission to my ward. I/We accept the process of admission undertaken by the School and I/We will abide by the decision taken by the School authorities.</p>
					</div>
				</div>
				<div class='row'>
					<div class='col-sm-12'>
						<center><button class='btn btn-success' id='sv_btn'><i class="fa fa-circle-o-notch fa-spin" style='display:none' id='process'></i> SUBMIT</button></center>
					</div>
				</div>
			</form>
		</div>
		</div><br />
	</body>
</html>

<script type="text/javascript">
	$('.datepicker').datepicker({
	    format: 'dd-MM-yyyy',
	    autoclose:true,
		startDate: "01-APR-2019",
		endDate: "31-MAR-2020"
	});
	
	$('#f_year_leaving').datepicker({
	    format: 'yyyy',
	    autoclose:true,
		startView: "years", 
        minViewMode: "years",
		endDate: "today"
	});
	
	$('#m_year_leaving').datepicker({
	    format: 'yyyy',
	    autoclose:true,
		startView: "years", 
        minViewMode: "years",
		endDate: "today"
	});
	
	function sibling(){
		var no_of_son       = $("#no_of_son").val();
		var no_of_daughters = $("#no_of_daughters").val();
		var add = Number(no_of_son)+Number(no_of_daughters);
		if(add >= 1){
			$("#stuofjvm_0").prop('disabled',false);
			$("#stuofjvm_1").prop('disabled',false);
		}else{
			$("#stuofjvm_0").prop('disabled',true);
			$("#stuofjvm_1").prop('disabled',true);
		}
	}
	
	function grnd_prntt(val){
		if(val == 'Y'){
			$("#grp_prnts").show();
			$("#grand_parent").html("<option value=''>Select</option><?php foreach($grand_parent as $key => $val){ if($key != 4){  ?><option value='<?php echo $key; ?>'><?php echo $val; ?></option><?php } } ?>");
		}else{
			$("#grp_prnts").hide();
			$("#grand_parent").html("<option value=''>Select</option><?php foreach($grand_parent as $key => $val){ if($key == 4){  ?><option value='<?php echo $key; ?>'><?php echo $val; ?></option><?php } } ?>");
		}
	}
	
	function alumini(val,gen){
		if(gen == 'F' && val == 'Y'){
			$("#f_hideShow").show();
			$("#f_year_leaving").prop('disabled',false);
			$("#f_reg_no").prop('disabled',false);
		}else if(gen == 'M' && val == 'Y'){
			$("#m_hideShow").show();
			$("#m_year_leaving").prop('disabled',false);
			$("#m_reg_no").prop('disabled',false);
		}else if(gen == 'F' && val == 'N'){
			$("#f_hideShow").hide();
			$("#f_year_leaving").prop('disabled',true);
			$("#f_reg_no").prop('disabled',true);
		}else{
			$("#m_hideShow").hide();
			$("#m_year_leaving").prop('disabled',true);
			$("#m_reg_no").prop('disabled',true);
		}
	}
	
	function stuof(val){
		var str = val.id;
		var splt = str.split("_");
		var fin_id = splt[1];
		var stuofjvm = $("#stuofjvm_"+fin_id).val();
		if(stuofjvm != ''){
			$("#classes_"+fin_id).prop('disabled',false);
		    $("#reg_"+fin_id).prop('disabled',false);	
		    $("#sec_"+fin_id).prop('disabled',false);	
		}else{
			$("#classes_"+fin_id).prop('disabled',true);
		    $("#reg_"+fin_id).prop('disabled',true);
		    $("#sec_"+fin_id).prop('disabled',true);
		}
	}
	
	function classes(val){
		var str = val.id;
		var splt = str.split("_");
		var fin_id = splt[1];
		var classes = $("#classes_"+fin_id).val();
		$.post("<?php echo base_url('adm_nur/Adm_nur/Getsec'); ?>",{classes:classes},function(data){
			$("#sec_"+fin_id).html(data);
		});
	}
	
	function single_parents(val){
		if(val == 'Y'){
			$("#fatormot").prop('disabled',false);
		}else{
			$("#fatormot").prop('disabled',true);
		}
	}
	
	function no_validate(req_no,id){
		var dyn_id = id.id;
		if(dyn_id == 'mobile'){
			$("#email").val('');
		}
		var count = $("#"+dyn_id).val().length;
		if(count != req_no){
			$("#"+dyn_id).val('');
			$("#"+dyn_id).focus();
			$.toast({
				heading: 'Error',
				text: 'Enter Valid Entry',
				showHideTransition: 'slide',
				icon: 'error',
				position: 'top-right',
			});
		}
	}
	
	function sameAs(){
		var residentail_add = $("#residentail_add").val();
		var pin_code = $("#pin_code").val();
		var distance = $("#distance").val();
		var phone_residence = $("#phone_residence").val();
		var phone_ofc = $("#phone_ofc").val();
		var mobile = $("#mobile").val();
		
		var ckbox = $('input[name=chk]').is(':checked')
		if(ckbox == true){
			$("#p_residentail_add").text(residentail_add);
			$("#p_pin_code").val(pin_code);
			$("#p_distance").val(distance);
			$("#p_phone_residence").val(phone_residence);
			$("#p_phone_ofc").val(phone_ofc);
			$("#p_mobile").val(mobile);
		}else{
			$("#p_residentail_add").text('');
			$("#p_pin_code").val('');
			$("#p_distance").val('');
			$("#p_phone_residence").val('');
			$("#p_phone_ofc").val('');
			$("#p_mobile").val('');
		}
	}
	
	$("#filePHOTO").change(function(){
		$(".file_upload1").css("border-color","#F0F0F0");
		var file_size = $('#filePHOTO')[0].files[0].size;
		var ext = $('#filePHOTO').val().split('.').pop().toLowerCase();
			if(file_size > 100000 || !(ext == 'png' || ext == 'PNG' || ext == 'jpg' || ext == 'JPG' || ext == 'jpeg' || ext == 'JPEG')){
				$.toast({
					heading: 'Error',
					text: 'File size must be less than 100kb allowed format JPG,JPEG,PNG only',
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
	
	function checkExist(){
		var stu_nm = $("#stu_nm").val();
		var dob    = $("#dob").val();
		var mobile = $("#mobile").val();
		$.ajax({
			url: "<?php echo base_url('adm_nur/Adm_nur/checkData'); ?>",
			type: "POST",
			data: {stu_nm:stu_nm,dob:dob,mobile:mobile},
			success: function(data){
				var fill = $.parseJSON(data);
				if(fill[0] > 0){
					$("#stu_nm").val('');
					$("#dob").val('');
					$("#mobile").val('');
					swal({
						title: 'You are already registered...!!!',
						html: 'Username '+fill[1]+'/2024 & Password '+fill[2],
						type: 'error',
						showConfirmButton: true,
						showCancelButton: false,
						confirmButtonText:  'OK',
						cancelButtonText:  '',
						animation:  true,
						allowEscapeKey:  false,
						confirmButtonColor: '#BDBF37',
						cancelButtonColor: '#f27474',
						timer:  0,
						allowOutsideClick:  false
					}).then(function(){
					window.location = "<?php echo base_url('adm_nur/Admin') ?>";
					});
				}
			}
		});
	}
	
	function blnk(){
		$("#email").val('');
	}
	
	$("#nur_form").on("submit", function (event) {
    event.preventDefault();
	$("#sv_btn").prop('disabled',true);
	$("#process").show();
	var formData = new FormData(this);
    $.ajax({
			url: "<?php echo base_url('adm_nur/Adm_nur/saveNurAdmRecord'); ?>",
			type: "POST",
			data:formData,
            cache:false,
            contentType: false,
            processData: false,
			success: function(data){
				window.location="<?php echo base_url('adm_nur/Adm_nur/payNow'); ?>";
			}
		});
	 });
</script>
<script>
    $("#dob").keydown(function(e){
        e.preventDefault();
    });
</script>