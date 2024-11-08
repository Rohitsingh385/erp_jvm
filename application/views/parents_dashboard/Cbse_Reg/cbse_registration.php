<?php
error_reporting(0);
	$cat=$this->db->query('Select * from category')->result();
	$Class_teacher="";
		$photo = "";
		$lng="Hindi";
		$f_signature = "";
		$m_signature = "";
		$child = 0;
		$Minority = 0;
		$verify=0;
		$ROLL_NO="";
$Penum="";
		$income = "";
		$verified_By ="";
if(sizeof($temp_data)==0){
	if($student){
		//echo '<pre>'; print_r($student); echo '</pre>';die;
		$f_name = $student[0]->FATHERNAME;
		$class_nm = $student[0]->CURRENT_CLASS;
		$ADM_DATE = $student[0]->ADMISSION_DATE;
		$name = $student[0]->STUDENT_NAME;
		$ADM_NO = $student[0]->ADMISSION_NO;
		$mobile = $student[0]->CROSSMOBILE;
		$email = "";
		$Address = $student[0]->CROSSADD;
		$STUDENTID = $student[0]->ID;
		$ADM_DATE = $student[0]->ADMISSION_DATE;
		$DATE_OF_BIRTH = $student[0]->DATE_OF_BIRTH;
		$ROLL_NO = $student[0]->ROLL_NO;
		$GENDER = $student[0]->GENDER;
		$CATEGORY = $student[0]->CATEGORY;
		$HOUSE_NAME = $student[0]->HOUSE_NAME;
		$EMPLOYEE_WARD = $student[0]->EMPLOYEE_WARD;
		$DISP_CLASS = $student[0]->CURRENT_CLASS;
		$DISP_SEC = $student[0]->CURRENT_SECTION;
		$current_class = $student[0]->CLASS_NAME;
		$current_sec = $student[0]->SECTION_NAME;
		$BLOOD_GROUP = $student[0]->BLOOD_GROUP;
		$BUSSTOPAGE = $student[0]->BUSSTOPAGE;
		$BUS_NUMBER = $student[0]->BUS_NUMBER;
		$AADHAR_NUMBER = $student[0]->AADHAR_NUMBER;
		$FATHERNAME = $student[0]->FATHERNAME;
		$MOTHERNAME = $student[0]->MOTHERNAME;
		$RELIGION = $student[0]->RELIGION;
		$CORR_ADD = $student[0]->CROSSADD;
		$C_CITY = $student[0]->CROSSCITY;
		$C_PIN = $student[0]->CROSSPIN;
		$C_STATE = $student[0]->CROSSSTATE;
		$C_NATION = $student[0]->CROSSNATION;
		$PERM_ADD = $student[0]->PERADD;
		$P_CITY = $student[0]->PERCITY;
		$P_STATE = $student[0]->PERSTATE;
		$P_NATION = $student[0]->PERNATION;
		$P_PIN = $student[0]->PERPIN;
		$SEC = $student[0]->SEC;
		$SUBJECT1 = $student[0]->SUBJECT1;
		$SUBJECT2 = $student[0]->SUBJECT2;
		$SUBJECT3 = $student[0]->SUBJECT3;
		$SUBJECT4 = $student[0]->SUBJECT4;
		$SUBJECT5 = $student[0]->SUBJECT5;
		$SUBJECT6 = $student[0]->SUBJECT6;
		$student_image = $student[0]->STUDENT_IMAGE;
		$classec = $DISP_CLASS."/".$DISP_SEC;
		$adm_classec = $current_class."/".$current_sec;
		$date = date('d-m-y',strtotime($ADM_DATE));
		$dateofbirth = date('d-M-y',strtotime($DATE_OF_BIRTH));
		$Penum="";
	}
	}
	else{
		//echo '<pre>'; print_r($temp_data); echo '</pre>';die;
		$class_nm= $temp_data[0]->class;
		$verified_By = $temp_data[0]->verified_by;
		$FATHERNAME = $temp_data[0]->fname;
		$name = $temp_data[0]->name;
		$Penum=$temp_data[0]->Penum;
		$ADM_NO = $temp_data[0]->admission_no;
		$ADM_DATE = $temp_data[0]->adm_date;
		$mobile = $temp_data[0]->mobile;
		$email = $temp_data[0]->email;
		$Address = $temp_data[0]->address;
		$ROLL_NO = $temp_data[0]->roll;
		$DATE_OF_BIRTH = $temp_data[0]->dob;
		$GENDER = $temp_data[0]->sex;
		$CATEGORY = $temp_data[0]->category;
	    $AADHAR_NUMBER = $temp_data[0]->aadhaar;
	    $MOTHERNAME = $temp_data[0]->mname;
		$DISP_SEC = $temp_data[0]->sec;
		$Class_teacher = $temp_data[0]->CLASS_TEACHER;
		$photo = $temp_data[0]->photo;
		$f_signature = $temp_data[0]->f_signature;
		$m_signature = $temp_data[0]->m_signature;
		$child = $temp_data[0]->child;
		$Minority = $temp_data[0]->minority;
		$lng = $temp_data[0]->lng;
		$income =$temp_data[0]->income;
		$verify =$temp_data[0]->verify;
		$ide =$temp_data[0]->id;
		$f_code =$temp_data[0]->f_code;
		$bord_name=$temp_data[0]->bord_name;
		$bord_roll=$temp_data[0]->bord_roll;
		$bord_pass_year=$temp_data[0]->bord_pass_year;
		$SUBJECT1 = $student[0]->SUBJECT1;
		$SUBJECT2 = $student[0]->SUBJECT2;
		$SUBJECT3 = $student[0]->SUBJECT3;
		$SUBJECT4 = $student[0]->SUBJECT4;
		$SUBJECT5 = $student[0]->SUBJECT5;
		$SUBJECT6 = $student[0]->SUBJECT6;
		
		
	}

?>
<style>
	/*.box-header {
    color: #444;
	background-color:#3c8cbc;
    display: block;
    padding: 10px;
    position: relative;
	}*/
	
	.p_detils{
		font-size:17px !important;
	}
	.box.box-default {
    border-top-color: #3c8cbc;
}
.vl {
  border-left: 2px solid #3c8dbc;
  height: 541px;
  position: absolute;
  left: 50%;
  margin-top: 30px;
   margin-left:  57px;
  top: 0;
}
.row{
	margin-top:12px;
	
}
</style> 
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     
		  
		  <?php 
		  		if($this->session->userdata('class_code') == 13)
				{
					?>
			 <h1>CBSE REGISTRATION FORM VERIFICATION FOR CLASS XI </h1>
		<?php
			}else{
				?>
				 <h1>CBSE REGISTRATION FORM VERIFICATION FOR CLASS IX </h1>
				
				<?php
			}
			?>
		  
		  
		 
      
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Student Details</a></li>
        <li class="active">Student Profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
		<?php if($verify == 1){
			?>
			<?php echo "<h4 style='color:green'><i class='glyphicon glyphicon-ok'></i> Approved </h4>";
			
			}else{
				?>
				 <h3 class="box-title">Student Details</h3>
				
				<?php
			}
			?>
         

          
        </div>
        <!-- /.box-header -->
        <div class="box-body">
		 <div class="row" >
		 <?php if(sizeof($temp_data)==0){
			 ?>
			<form action="<?php echo base_url('parent_dashboard/Cbse_Reg/gautam/save_temp_student'); ?>" autocomplete='off' class='nur_form' method='post' enctype='multipart/form-data'>
		 <?php }else{
			 ?>
			 <form action="<?php echo base_url('parent_dashboard/Cbse_Reg/gautam/update_temp_student'); ?>" autocomplete='off' class='nur_form' method='post' enctype='multipart/form-data'>
			 <?php
		 }
		?>
		<input type="hidden" name="adm_date" value='<?php echo $ADM_DATE; ?>' class="form-control" required >
		<input type="hidden" name="class" value='<?php echo $class_nm; ?>' class="form-control" required >
		
			<div class='col-md-12 col-sm-12 col-lg-112'>
				<div class='row'>
					<div class='col-md-4 '>
					<label>Section.:</label>
				<input type="text" name="sec" value='<?php echo $DISP_SEC; ?>' class="form-control" required readonly>
						
			<!--<select class='form-control' name='sec' required <?php echo "readonly";?> onchange="fetchTeach(this.value)" id='secc'>
					
						<?php
						
						//$sl="";
						//foreach($sections as $key){
							
							?>
							<option value="<?php //echo $key->Section_No;?>" <?php //echo $sl; if($DISP_SEC == $key->secnm){echo "selected";}?>> <?php //echo $key->secnm;?></option>
							<?php
							
						//}
						?>
					
						</select>-->
					</div>
					<div class='col-md-4'>
					<label>Roll No.:</label>
					<input type="number" value='<?php if($ROLL_NO != 0){ echo $ROLL_NO;} ?>' name='roll' class="form-control" required <?php echo "readonly";?>>
					
					</div>
					<div class='col-md-4'>
					<label>School Reg No.:</label>
					<input type="text" name="adm_no" value='<?php echo $ADM_NO; ?>' class="form-control" required readonly>
					
					</div>
					
				</div>
				<div class='row'>
					<div class='col-md-4 '>
					<label style='display:none'>Region Code:</label>
						<input type="hidden" name="RGN_CODE" value='Patna' class="form-control" >
					</div>
					<div class='col-md-4 '>
					<label>Date of Admission:</label>
						<input type="text" value='<?php echo date("d-M-Y",strtotime($ADM_DATE));?>' class="form-control" required readonly>
						<input type="hidden" name="admdate" value='<?php echo $ADM_DATE;?>' class="form-control" >
					</div>
				
					<div class='col-md-4'>
					<label>Exam School Code:</label>
						<input type="text" name="EXAM_S_CODE" value='66230' class="form-control" required readonly>
					</div>
					<div class='col-md-4'>
					<label style='display:none'>Class Teacher:</label>
					<input type="hidden" name="CLASS_TEACHER"  id="teacher" value='<?php echo $Class_teacher;?>' class="form-control" style = "text-transform:uppercase;"  <?php if($verify == 1){echo "";}?>>
					</div>
					</div>
					
						<div class='row'>
					<div class='col-md-4 '>
					<label>Candidate Name:</label>
						<input type="text" name="name" value='<?php echo $name;?>' class="form-control" required readonly>
					</div>
					<div class='col-md-4'>
					<label>Father's Name:</label>
						<input type="text" name="f_name" value='<?php echo $FATHERNAME;?>' class="form-control" required readonly>
					</div>
				
						<div class='col-md-4'>
					<label>Mother's Name:</label>
						<input type="text" name="m_name" value='<?php echo $MOTHERNAME;?>' class="form-control" required readonly>
					</div>
					</div>

					<div class='row'>
					<div class='col-md-4 '>
					<label>Date of Birth:</label>
						<input type="text" value='<?php echo date("d-M-Y",strtotime($DATE_OF_BIRTH));?>' class="form-control" required readonly>
						<input type="hidden" name="dob" value='<?php echo $DATE_OF_BIRTH;?>' class="form-control" >
					</div>
				
				
						<div class='col-md-4'>
					<label>Category:</label>
						<select class='form-control' name="category" required <?php echo "readonly";?>>
						<option value="<?php echo $CATEGORY;?>"> <?php echo $CATEGORY;?></option>
					
						</select>
					</div>
						<div class='col-md-4'>
				
					
					<label>Student Aadhaar No.:*</label>
						<input type="text" name='aadhaar' value='<?php echo $AADHAR_NUMBER;?>' class="form-control"  id="adr" maxlength="12" pattern="[0-9.]+" required <?php if($verify == 1){echo "readonly";}?>>
						
					<br/>
					
					</div>
						
						
					</div>
				
			<div class='row'>
				  <?php 
		  		if($this->session->userdata('class_code') == 13)
				{
					?>
			 <div class='col-md-4 '>
					<label>Name of Board (appeared in Class X):</label>
						<input type="text" name="bord_name" value='<?php echo $bord_name;?>' class="form-control" required>
					</div>
					<div class='col-md-4'>
					<label>Board's Roll No. (as in Class X): In case of ICSE Board, Enter UNIQUE ID:</label>
						<input type="text" name="bord_roll" value='<?php echo $bord_roll;?>' class="form-control" required>
						<label></label>
					</div>
				
						<div class='col-md-4 '>
					<label>Class Xth Pasing Year:</label>
						<input type="text" name="bord_pass_year" value='<?php echo $bord_pass_year;?>' class="form-control" required>
					</div>
		<?php
			}else{
				?>
				 
				
				<?php
			}
			?>
		  
			</div>
					
				
				
				
					
					
				
				
				
					<hr/>
						<div class='row' >
					<div class='col-md-4 '>
					
					<label>Only Child:</label>
							<ul style='list-style:none'>
					<li> <input type="radio" name="M_Child" value='1'  <?php if($child == 1){echo "checked";}?> <?php if($verify == 1){echo "disabled";}?>>&nbsp;&nbsp; Yes </li>
					<li> 	<input type="radio" name="M_Child" value='0' <?php if($child == 0){echo "checked";}?> <?php if($verify == 1){echo "disabled";}?>> &nbsp;&nbsp; No</li>
					</ul>
					</div>
						<div class='col-md-4 '>
					 <label>Minority:</label>
							<ul style='list-style:none'>
					<li> <input type="radio" name="Minority" value='1'  <?php if($Minority == 1){echo "checked";}?> <?php if($verify == 1){echo "disabled";}?>>&nbsp;&nbsp; Yes </li>
					<li> 	<input type="radio" name="Minority" value='0' <?php if($Minority == 0){echo "checked";}?> <?php if($verify == 1){echo "disabled";}?>> &nbsp;&nbsp; No</li>
					</ul>
				
					</div>
						<div class='col-md-4 '>
					<label>Gender:</label>
					<ul style='list-style:none'>
					<li> <input type="radio" name="sex" value='1'  <?php if($GENDER == 1){echo "checked";}?> <?php if($verify == 1){echo "disabled";}?>>&nbsp;&nbsp; MALE</li>
					<li> <input type="radio" name="sex" value='2' <?php if($GENDER == 2){echo "checked";}?> <?php if($verify == 1){echo "disabled";}?>> &nbsp;&nbsp;FEMALE</li>
					</ul>
					</div>
					</div>
					<hr/>
					
					<div class='row' >
					<?php
						if($this->session->userdata('class_code') == 11){
					?>
					<div class='col-md-4'>
						<label>Subject:</label>
							<ul style='list-style:none'>
								<li>1 <input type="checkbox" value='ENGLISH LANGUAGE AND LITERATURE (184)'  checked disabled> ENGLISH LANGUAGE AND LITERATURE (184)</li>
								<li>2  LANGUAGE II
									<br/>
									<div style="margin-left:8px">
										<input type="radio" value='HINDI (002)'  name="Lng_ENG" <?php if($lng == 'HINDI (002)'){echo "checked";}?> <?php if($verify == 1){echo "disabled";}?> id='hin'>&nbsp;&nbsp;HINDI (002) 
										&nbsp;&nbsp;<input type="radio" value='SANSKRIT COMMUNICATIVE (119)'  name="Lng_ENG" <?php if($lng == 'SANSKRIT (122)'){echo "checked";}?> <?php if($verify == 1){echo "disabled";}?> id='sns'>&nbsp;&nbsp;SANSKRIT COMMUNICATIVE (119)
									</div>
								</li>
								
								<li>3 <input type="checkbox" value='MATHEMATICS (041)'  checked disabled>&nbsp;&nbsp; MATHEMATICS (041)</li>
								<li>4 <input type="checkbox" value='SCIENCE (086)'  checked disabled>&nbsp;&nbsp; SCIENCE (086)</li>
								<li>5 <input type="checkbox" value='SOCIAL SCIENCE (087)'  checked disabled>&nbsp;&nbsp; SOCIAL SCIENCE (087)</li>
								<li>6 <input type="checkbox" value='ADDITIONAL: AI (417)'  checked disabled>&nbsp;&nbsp; ADDITIONAL: AI (417)</li>
							</ul>
					</div>
					<?php } elseif($this->session->userdata('class_code') == 13) { ?>
					<div class='col-md-4'>
						<label>Subject:</label>
						<ul style='list-style:none'>
							<li>1 <input type="checkbox" value='<?php echo $SUBJECT1; ?>'  checked disabled>&nbsp;&nbsp; <?php echo $SUBJECT1; ?></li>
							<li>2 <input type="checkbox" value='<?php echo $SUBJECT2; ?>'  checked disabled>&nbsp;&nbsp; <?php echo $SUBJECT2; ?></li>
							<li>3 <input type="checkbox" value='<?php echo $SUBJECT3; ?>'  checked disabled>&nbsp;&nbsp; <?php echo $SUBJECT3; ?></li>
							<li>4 <input type="checkbox" value='<?php echo $SUBJECT4; ?>'  checked disabled>&nbsp;&nbsp; <?php echo $SUBJECT4; ?></li>
							<li>5 <input type="checkbox" value='<?php echo $SUBJECT5; ?>'  checked disabled>&nbsp;&nbsp; <?php echo $SUBJECT5; ?></li>
						</ul>
					</div>	
						
					
					<?php } ?>
					
						<!-- change -->
									<div class='col-md-4'>
										<label>Optional subject:</label>
										<select class='form-control' name="optsub" required <?php echo "readonly"; ?>>
											<option value="">Select...</option>
											<?php foreach ($dropdown_options as $value => $label): ?>
												<option value="<?= $value ?>"><?= $label ?></option>
											<?php endforeach; ?>

										</select>
									</div>

					<div class='col-md-4'>
				
					<label>Mobile:*</label>
						<input type="text" readonly name="mobile" value='<?php echo $mobile;?>' maxlength="10" pattern="[0-9.]+" class="form-control" required <?php if($verify == 1){echo "disabled";}?>>
					<br/>
					
					<label>Email:*</label>
						<input type="email" name='email'  id="email" style = "text-transform:lowercase;" value='<?php echo $email;?>' class="form-control" required <?php if($verify == 1){echo "disabled";}?>>
					
					</div>
					
					<div class='col-md-4'>
				
						<label>Total Annual Income of both the Parents:</label>
						<input type="number" name="income" value='<?php echo $income;?>' class="form-control"  required <?php if($verify == 1){echo "disabled";}?>>
							<br/>
						
						
						<label style='display:none'>PE Number:</label>
						<input type="hidden" name='Penum'  id="Penum" style = "display:none;text-transform:uPPercase;" value='PE Number' class="form-control" value="PE Number" <?php if($verify == 1){echo "disabled";}?>>
					
					</div>
						
						
						
					<label style='display:none'>Address:</label>
					
						<input type='hidden' name='address' value="<?php echo $Address;?>">
				    </div>
				</div>
					<hr/>
						<div class='row'>
						<div class='col-md-6'>
							<label>Parent's Signature:</label><br/>
							<div class='row'>
							<div class='col-md-4'>Father</div>
							<div class='col-md-4' id="fs_view"><img src="
							
							<?php 
				if($f_signature == null){
					echo base_url('assets/student_photo/signature_defoult.jpg');
				}else{
					echo base_url($f_signature);
				}
				?>" style="width:100%;height:30px;border:1px solid grey"></div>
							<div class='col-md-4'><input type="file" name="f_signature[]" id="f_s" <?php if(sizeof($temp_data)==0){echo "required";}?> <?php if($verify == 1){echo "disabled";}?>></div>
							</div>
							<div class='row'>
							<div class='col-md-4'>Mother</div>
							<div class='col-md-4' id="ms_view"><img src="<?php 
				if($m_signature == null){
					echo base_url('assets/student_photo/signature_defoult.jpg');
				}else{
					echo base_url($m_signature);
				}
				?>" style="width:100%;height:30px;border:1px solid grey"></div>
							<div class='col-md-4'><input type="file" name="m_signature[]" id="m_s" <?php if(sizeof($temp_data)==0){echo "required";}?> <?php if($verify == 1){echo "disabled";}?> ></div>
							</div>
						</div>
						<div class='col-md-6'>
						
						<div style="margin-left:50px">
						<div style='float:right'>
							<center>
							<a href="<?php echo base_url('assets/student_photo/sample_photo.pdf');?>" download target='_blank'>Sample photo</a>
							<img src='<?php echo base_url('assets/student_photo/sam_pic.PNG');?>' class='img-responsive'>
							</center>
						</div>
						<div id='photo_view' style='height:150px; width:160px;'>
						<a href="<?php echo base_url('assets/student_photo/sample_photo.pdf');?>" download target='_blank'> <img class="img-thumbnail" src='<?php 
				if($photo == null){
					echo base_url('assets/student_photo/default_cr.jpg');
				}else{
					echo base_url($photo);
				}
				?>' style='height:150px; width:160px; '></a>
				</div>
				
				<div style="border:1px solid grey;padding:5px;width:160px;font-size:11px;font-weight:bold">Candidate's colour photo in school uniform with name of the student as per school record with date of photograph. </div>
				<br/>
				<input type='file' name="photo[]" id="photo"  <?php if(sizeof($temp_data)==0){echo "required";}?> <?php if($verify == 1){echo "disabled";}?>>
					</div>
					</div>
					</div>
					<br/>
				<br/>
				<div class='row'>
						<div class='col-md-12'>
							<label>NOTE: Candidate's photograph should be colour photo in school uniform with name of the student as per school record with date of photograph and size should be less than 40 KB.</label>
							</div>
					</div>
				<br/>
				<br/>
				<div class='row'>
						<div class='col-md-12'>
							<label><input type="checkbox" checked disabled>&nbsp;&nbsp;We hereby declare that above information are correct. The School or CBSE will not be responsible for any mistake in the data entered by the student / parent during CBSE registration.</label>
							</div>
					</div>
					<?php
 if(sizeof($temp_data)!=0){
	
	if($f_code != 'SUCCESS'){
	?>
	
<a href="<?php echo base_url('parent_dashboard/Cbse_Reg/gautam/payNow/'); ?>" class='btn btn-success' title='PRINT'><i class="fa fa-credit-card" aria-hidden="true"></i> Pay Now</a>
	<?php } else { ?>
	<a href="<?php echo base_url('parent_dashboard/Cbse_Reg/gautam/Print_user_profile/'.$ide); ?>" class='btn btn-danger' title='PRINT'><i class="fa fa-print" aria-hidden="true"></i> Print</a>
	<?php } ?>
<?php }
 if($verify == 0){
					if(sizeof($temp_data)==0){ ?>
					
<button class="btn btn-success"  style='float:right'> <span class="glyphicon glyphicon-floppy-save"></span> Save</button>
					
					<?php }else{ 
						if($f_code != 'Ok'){
					?>
					<!--<button class="btn btn-success"  style='float:right;display:none' ><span class="	glyphicon glyphicon-refresh"></span> Update</button>-->
					
					
					<!--<button type='button' class="btn btn-success" data-toggle="modal" data-target="#myModalpayment" style='display:none'><i class="fa fa-inr"></i> Payment</button>-->
					<?php }else{
						?>
							<!--<button type='button' class="btn btn-success" disabled>Payment Completed</button>-->
						<?php
					} ?>
							
					
						
							<?php
							
					}
					}else{
						
						?>
						<label class="checkbox-inline" style='padding:8px; padding-left:28px;float:right;margin-right:20px;color:'>  Verified By <strong> <?php echo $verified_By;?></strong><br/><sup><?php echo $verified_date;?></sup></label>
				
						<?php
					}
					?>
				</div>
				</form>
			</div>
          </div>
        </div>
		
		
		<!-- Modal -->
		<div id="myModalpayment" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
		  <div class="modal-dialog modal-sm">
			<div class="modal-content">
			  <div class="modal-body" style='border:3px solid #000;'>
				<div class='row'>
					<h2><center>PAYMENT MODE</center></h2>
					<div class='col-sm-12'>
						<input type='radio' value='online' name='payment_type'> &nbsp;&nbsp; Online <br />
						<input type='radio' value='other' name='payment_type'> &nbsp;&nbsp; Other<br /><br />
						
						<center><button type='button' id='btn' class='btn btn-success btn-sm' onclick='paymentType()'><i class="fa fa-circle-o-notch fa-spin" id='process' style='display:none'></i> Pay Now</button></center>
					</div>
				</div>
			  </div>
			</div>
		  </div>
		</div>
		<!-- end modal -->
		
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
	 </section>
    <!-- /.content -->
  </div>
  <button type="button"  data-toggle="modal" data-target="#myModal" id='loading' style="display:none"></button>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
    
      <div class="modal-body" id='loa'>
       <p style="font-size:17px">Please Wait...</p>
      </div>
    
    </div>

  </div>
</div>
  <script>

 var dspc_code = $('#secc').val();
	
  var dspc = '<?php echo $DISP_SEC;?>';
	 fetchTeach(dspc_code);
	  	if( 'A' == dspc || 'B' == dspc){
			$("#sns").prop("disabled", false);
			$("#sns").prop("checked", true);
			$("#hin").attr("disabled", true);
		}else{
			$("#hin").prop("disabled", false);
			$("#hin").prop("checked", true);
			$("#sns").attr("disabled", true);
		}
	  
	   function fetchTeach(data){
		   
		var lang=data;
		if( 1 == lang || 2 == lang){
			$("#sns").prop("disabled", false);
			$("#sns").prop("checked", true);
			$("#hin").attr("disabled", true);
		}else{
			$("#hin").prop("disabled", false);
			$("#hin").prop("checked", true);
			$("#sns").attr("disabled", true);
		}
	  $.post("<?php echo base_url('parent_dashboard/Cbse_Reg/gautam/fetch_teacher'); ?>",{subject_id:data},function(data){
		$fillData = $.parseJSON(data);
		$("#teacher").val($fillData[0]);
	
		
	});
  }
  $(".nur_form").on("submit", function (event) {
		
    event.preventDefault();
	//$("#sv_btn").prop('',true);
	
	var uu=$("#adr").val();
	var email=$("#email").val();
	 uu=uu.length;

	if(uu==12){
		$("#loading").click();
	var formData = new FormData(this);
    $.ajax({
			url: "<?php if(sizeof($temp_data)==0){ echo base_url('parent_dashboard/Cbse_Reg/gautam/save_temp_student');} else{ echo base_url('parent_dashboard/Cbse_Reg/gautam/update_temp_student'); } ?>",
			type: "POST",
			data:formData,
            cache:false,
            contentType: false,
            processData: false,
			success: function(data){
				if(data=='1'){
				swal("Verified your Form!", " You can't update your details!");
				//window.location="<?php echo base_url('adm_nur/Adm_nur/payNow'); ?>";
				setTimeout(function(){window.location=""; }, 1000);
					
				}else{
				//alert("success...");
				  $('#loa').html("<p style='font-size:17px;color:green'>Record updated successfully...!!!</p>");
				  swal("Good job!", "Record updated successfully!", "success");
				//window.location="<?php echo base_url('adm_nur/Adm_nur/payNow'); ?>";
				window.location="";
				//setTimeout(function(){ $("#loading").click(); window.location=""; }, 1000);
				$( "#f_s" ).val("");
				$( "#photo" ).val("");
				$( "#m_s" ).val("");
					
			}
			}
		});
	}else{
	swal("Check your Aadhaar No!", " Please Enter your valid Aadhaar no!");
	}
	 });
	 </script>
	   <script>
   $( "#photo" ).change(function(){
 
var fileInput = document.getElementById('photo');
	
    var filePath = fileInput.value;
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.JPG|\.JPEG|\.PNG)$/i;
    if(allowedExtensions.exec(filePath)){
		
var vl = URL.createObjectURL(event.target.files[0]);
  $("#photo_view").html("<center><img src='"+vl+"' style='width:100%;height:100px'></center>");
 
    }else{

alert('Only image accepted!');
$( "#photo" ).val("");
}
 });
   
      $( "#f_s" ).change(function(){
 

         var fileInput = document.getElementById('f_s');
    var filePath = fileInput.value;
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.JPG|\.JPEG|\.PNG)$/i;
    if(allowedExtensions.exec(filePath)){
var vl = URL.createObjectURL(event.target.files[0]);
  $("#fs_view").html("<img src='"+vl+"' style='width:100%;height:30px'>");
  
 
    }else{

alert('Only image accepted!');
$( "#f_s" ).val("");
}


   });
        $( "#m_s" ).change(function(){
 

         var fileInput = document.getElementById('m_s');
    var filePath = fileInput.value;
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.JPG|\.JPEG|\.PNG)$/i;
    if(allowedExtensions.exec(filePath)){
var vl = URL.createObjectURL(event.target.files[0]);
  $("#ms_view").html("<img src='"+vl+"' style='width:100%;height:30px'>");
  
 
    }else{

alert('Only image accepted!');
$( "#m_s" ).val("");
}


});


function paymentType(paymentType){
	var radio = $("input[name='payment_type']:checked").val();
	if(radio != undefined){
		if(radio == 'online'){
			$("#process").show();
			$("#btn").prop('disabled',true)	;
			window.location="<?php echo base_url('parent_dashboard/Cbse_reg/payment/payment'); ?>";
		}else{
			$("#process").show();
			$("#btn").prop('disabled',true)	;
			window.location="<?php echo base_url('parent_dashboard/Cbse_reg/payment/otherpay'); ?>";
			$("#process").hide();	
		}
	}else{
		alert('Please Choose Any One Mode');
	}
}


   </script>
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <!-- /.content-wrapper -->