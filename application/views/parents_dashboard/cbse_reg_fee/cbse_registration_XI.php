<?php
	if(empty($this->session->userdata('token_no'))){
		redirect('Parentlogin_XI');
	}
?>

<html>
  <head>
  <title>CBSE Class XI Registration Form</title>
    <link rel="shortcut icon" href="<?php echo base_url('assets/img/logo1.png'); ?>">
    <meta charset="utf-8">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<link href='https://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="<?php echo base_url('assets/css/jquery-ui.css'); ?>">
	<script src="<?php echo base_url('assets/dash_js/jquery-2.1.4.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/dash_js/jquery-ui.js'); ?>"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	  <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>

	<style>
	span{
		color:red;
	}
	.form{
		border:1px solid #000;
		box-shadow: 0px 0px 30px 0px #e6e0e0;
        background: #f1e9e9;		
	}
	body{
		background: #211616;
		font-family: 'Merriweather', serif;
	}
	#date_input{text-indent: -500px;height:25px; width:200px;}
	</style>
  </head>
  
  <body id="top"><br /><br />

   <div class="container form"><br /><br />
     <div class="row">
	   <div class="col-sm-2"></div>
	   <div class="col-sm-8">
	   </div>
	   <div class="col-sm-2"></div>
     </div>
     <div class='row'>
        <div class='col-sm-2'>
		  <img src='<?php echo base_url('assets/img/logo1.png'); ?>' style='width:60px;'>
		</div>	 
		<div class='col-sm-8'>
		  <center> <b style="font-size:30px; line-height:85px;">JAWAHAR VIDYA MANDIR SHYAMALI</b></center>
		</div>
		 
		<div class='col-sm-2'></div>
     </div>  
	 <form id="form" method="POST" enctype="multipart/form-data">
	    <div class="col-sm-12">
			<center>
		    <h3>CBSE CLASS XI REGISTRATION FORM</h3>
		  </center>	
	    </div>
		<div class='row'>
		  <div class='col-sm-12'>
		    <label style="font-size:17px; color:#8c2525;">Student's Details</label>
		  </div>
		  <input type="hidden" name="form_sub_date" value="<?php echo date("Y-m-d"); ?>">
		</div>
		<div class='row'>
		  <div class="col-sm-6">
		    <label>Section </label>
			<input type="text" name="sec" id="sec" value="<?php echo $login_details[0]['Section']; ?>" class="form-control" readonly>
		  </div>
		  <div class="col-sm-6">
		    <label>School Reg. No. </label>
		    <input type="text" name="admno" id="admno" value="<?php echo $login_details[0]['AdmNo']; ?>" class="form-control" readonly>
		  </div>
		  
		</div><br />
        <div class='row'>		
		  <div class="col-sm-6">
		    <label>School Code </label>
		    <input type="text" name="exam_school_code" value='66230' id="exam_school_code" class="form-control" readonly>
		  </div>
		  
		  <div class="col-sm-6">
		    <label>Date of Admission in School</label>
		    <input type="text" value="<?php echo date('d-M-Y',strtotime($login_details[0]['DOA'])); ?>" name="date_of_adm" id="date_of_adm" class="form-control" readonly>
		  </div>
		  
		</div><br />
		
		<div class='row'>
		  <div class="col-sm-4">
			<label>Candidate Name</label>
			<input type="text" name="candidate_name" value="<?php echo $login_details[0]['Sname']; ?>" id="candidate_name" class="form-control" <?php if($login_details[0]['form_save_status']!='0'){echo "readonly";}else{ echo "required";}?>>
		  </div>
		  
		  <div class="col-sm-4">
		    <label>Father's Name </label>
		    <input type="text" name="father_name" id='father_name' value="<?php echo $login_details[0]['FatherName']; ?>" class="form-control" autocomplete="off" <?php if($login_details[0]['form_save_status']!='0'){echo "readonly";}else{ echo "required";}?>>
		  </div>
		  
		   <div class="col-sm-4">
		    <label>Mother's Name </label>
		    <input type="text" value="<?php echo $login_details[0]['MotherName']; ?>" name="mother_name" id="mother_name" class="form-control" autocomplete="off" <?php if($login_details[0]['form_save_status']!='0'){echo "readonly";}else{ echo "required";}?>>
		  </div>
		  
		</div><br />
		
		<div class='row'>
		  <div class="col-sm-4">
			<label>Date of Birth</label>
			<input type="text" value="<?php echo date('d-M-Y',strtotime($login_details[0]['DOB'])); ?>" name='dbo' id='dob' class='form-control'  <?php if($login_details[0]['form_save_status']!='0'){echo "disabled";}else{ echo "readonly required";}?> >
		  </div>
		  
		
			<div class='col-md-4'>
					<label>Category:</label>
						<select class='form-control' name="category" <?php if($login_details[0]['form_save_status']!='0'){echo "disabled";}else{ echo "required";}?>>
						<option value="<?php echo $login_details[0]['Category'];?>"> <?php echo $login_details[0]['Category'];?></option>
						<?php if($login_details[0]['Category'] !='GEN'){
							?>
							
						<option value="GEN"> GEN</option>
							<?php
						} if($login_details[0]['Category'] !='SC'){
							?>
							
							<option value="SC">SC</option>
						<?php	
						} if($login_details[0]['Category'] !='ST'){
							?>
							<option value="ST" >ST</option>
							<?php
							
						}if($login_details[0]['Category'] !='OBC'){
							?>
								
						<option value="OBC" >OBC</option>
							<?php
							
						}
						
						?>
						</select>
					</div>
			
		  
		   <div class="col-sm-4">
		    <label>Student Aadhaar No.</label>
		    <input type="text" name='stu_adhar_no' id='stu_adhar_no' value="<?php if($login_details[0]['AadhaarCard']!='0'){echo $login_details[0]['AadhaarCard'];} ?>" class='form-control'   maxlength="12" minlength="12" pattern="[0-9.]+" <?php if($login_details[0]['form_save_status']!='0'){echo "readonly";}else{ echo "required";}?>>
		  </div>
		  
		</div><br />
		
		<div class='row'>
		  <div class="col-sm-4">
			<label>Onliy Child </label><br />
	<input type='radio' name='only_child' value='yes' <?php if($login_details[0]['form_save_status']!='0'){echo "disabled";}?> 
				   <?php
					  if($login_details[0]['only_child']=='yes')
					  {echo "checked";}
					?>> Yes &nbsp;&nbsp;&nbsp; <input type='radio' name='only_child' value='no' <?php if($login_details[0]['form_save_status']!='0'){echo "disabled";}?> <?php 
			 	if($login_details[0]['form_save_status']=='0')
                 {echo "checked";}
				 if($login_details[0]['only_child']=='no')
				 {echo "checked";} ?>> No 
		  </div>
		  
		  <div class="col-sm-4">
		     <label>Minority</label><br />
			 <input type='radio' name='minority' value='yes' <?php if($login_details[0]['minority']=='yes'){echo "checked";}?> <?php if($login_details[0]['form_save_status']!='0'){echo "disabled";}?> >
			  Yes &nbsp;&nbsp;&nbsp; <input type='radio' <?php if($login_details[0]['form_save_status']!='0'){echo "disabled";}?> name='minority' value='no'
			 <?php 
			 	if($login_details[0]['form_save_status']=='0')
                 {echo "checked";}
				 if($login_details[0]['minority']=='no')
				 {echo "checked";} ?>> No 
		  </div>
		  
		   <div class="col-sm-4">
		    <label>Gender </label><br />
		    <?php 
				if($login_details[0]['Gender'] == 'M'){ 
					echo "MALE";
				}else{
					echo "FEMALE";
				} 
			?>
		  </div>
		  
		</div><br />
		
		<div class='row'>
		  <div class="col-sm-4">
			<label>Handicap </label><br />
			<input type='radio' name='handicap' value='yes' onclick='handicp(this.value)' <?php if($login_details[0]['form_save_status']!='0'){echo "disabled";}?>  <?php if($login_details[0]['handicap']=='yes'){echo "checked";}?>> Yes &nbsp;&nbsp;&nbsp; <input type='radio' name='handicap' value='no' <?php if($login_details[0]['form_save_status']!='0'){echo "disabled";}?> <?php 
			 	if($login_details[0]['form_save_status']=='0')
                 {echo "checked";}
				 if($login_details[0]['handicap']=='no')
				 {echo "checked";} ?> onclick='handicp(this.value)'> No 
			  
		  </div>
		    
		  <div class="col-sm-4">
			<div style='display:none' id='hc'>
			<label>Handicap Type <span>*</span></label><br />
			<select class='form-control' name='handicap_desc' id='handicap_desc' disabled>
				<option value=''>Select</option>
				<option value='NA'>Not Applicable</option>
				<option value='BB'>Blindness</option>
				<option value='BL'>Low Vision</option>
				<option value='CA'>Autism spectrum disorder</option>
				<option value='CS'>Specific Learning Disabilities</option>
				<option value='DD'>Deaf</option>
				<option value='DH'>Hard of hearing</option>
				<option value='DS'>Speech and Language Disability</option>
				<option value='HA'>Acid Attack Victims</option>
				<option value='HC'>Cerebral palsy</option>
				<option value='HD'>Dwarfism</option>
				<option value='HL'>Leprosy cured persons </option>
				<option value='HM'>Muscular Dystrophy</option>
				<option value='LA'>Permanent Physical Impairement Amputation</option>
				<option value='LE'>Permanent Physical Impairment of Extremities </option>
				<option value='LF'>PPI Club Food and Other Conditions</option>
				<option value='LL'>Spinal Cord injuries</option>
				<option value='LN'>PPI due to Chronic neurological condition</option>
				<option value='LS'>PPI of the Spine</option>
				<option value='SB'>Blood disorder</option>
				<option value='SD'>Multiple Disabilities</option>
				<option value='SM'>Mental Behaviour</option>
				<option value='SN'>Chronic Neurological Condition</option>
			</select>
			</div>
		  </div>
		  
		  <div class="col-sm-4">
		    
		  </div>
		  
		</div>
		 <br/>
		 <span style='font-size:20px;'> <b>Note:</b><span style='color:red'> All information should be as per class X Certificate.</span></span>
		 <br />
		<hr style="border: .5px solid black; ">
		
		<!--------------------------------------------------------------------------------->
		
		  
		  <div class='row'>
		  <div class='col-sm-4'>
			<div class="form-group">
			  <label>Mobile </label>
			  <input type="text" name='mobile' id='mobile' value="<?php echo $login_details[0]['Mobile']; ?>" class="form-control" <?php if($login_details[0]['form_save_status']!='0'){echo "readonly";}else{ echo "required";}?>>
			</div>
		  </div>		 
      		  
		  <div class='col-sm-4'>
			<div class="form-group">
			  <label>Email </label>
			  <input type="email" name='email' id='email' value="<?php echo $login_details[0]['Email']; ?>" class="form-control" <?php if($login_details[0]['form_save_status']!='0'){echo "readonly";}else{ echo "required";}?>>
			</div>
		  </div>
		  
		  <div class='col-sm-4'>
			<div class="form-group">
			  <label>Annual Income &nbsp;(&#8377;)(<i>of both parents</i>) <span>*</span></label>
			  <input type="number" name="annual_income" value='<?php echo $login_details[0]['annual_income']; ?>' id="annual_income" class="form-control" required <?php if($login_details[0]['form_save_status']=='1'){echo "readonly"; }else{ echo "required";} ?>>
			</div>
		  </div>
		  </div>
		  
		  <div class='row'>
		  <div class='col-sm-4'>
			<div class="form-group">
			  <label>Class X Exam Name <span>*</span></label>
				  <select name='borad_name' id='borad_name' class='form-control'  
					<?php if($login_details[0]['form_save_status']!='0'){echo "disabled";}?>>
					  <?php if($login_details[0]['form_save_status']=='0')
                 			{ 
							?>
					  <option value=''>Select</option>
					  <?php
				}else{
				?>
					<option value='<?php echo $login_details[0]['class_x_board_name'];?>'><?php echo $login_details[0]['class_x_board_name'];?></option>  <?php
					} ?>
					
					<option value='AISSE'>AISSE</option>
					<option value='ICSE'>ICSE</option>
					<option value='NIOS'>NIOS</option>
					<option value='MATRICULATION'>MATRICULATION</option>
					<option value='SECONDRY'>SECONDRY</option>
					<option value='CISCE'>CISCE</option>
				  </select>
			 </div>
		    </div>
			<div class='col-sm-2'>
				  <div class="form-group">
					 <label>Stream</label>
					 <input type="text" name='stream' id='stream' value="<?php echo $login_details[0]['FinalStream']; ?>" class='form-control' readonly>
				  </div>
			  </div>
			  
			  <div class='col-sm-6'>
				  <div class="form-group">
					<label>Subject </label>
					<input type="text" name='subject' id='subject' value="<?php echo $login_details[0]['FinalSubject']; ?>" class="form-control" readonly>
				  </div>
			  </div>
		  </div>
		  
		  <div class='row'>
			  	<div class='col-sm-4'>
				<div class="form-group">
					<label>Board Name. </label>
						  <select name='borad' id='borad' class='form-control'  
					<?php if($login_details[0]['form_save_status']!='0'){echo "disabled";}else{echo "required";}?>>
					  <?php if($login_details[0]['form_save_status']=='0')
                 		{ 
							?>
					  <option value=''>---Select---</option>
					  <?php
				}else{
	
				?>
					<option value='<?php echo $login_details[0]['Board'];?>'><?php echo $login_details[0]['Board'];?></option>  <?php
					} ?>
					
					<option value='ANDHRA PRADESH'>ANDHRA PRADESH</option>
					<option value='ASSAM'>ASSAM</option>
							  <option value='AMU'>AMU</option>
							  <option value='APOSS'>APOSS</option>
							  <option value='BOARDS'>BOARDS</option>
							  <option value='BIHAR'>BIHAR</option>
							  <option value='BVP'>BVP</option>
							  <option value='BHUTAN'>BHUTAN</option>
							  <option value='BBOSE'>BBOSE</option>
							  <option value='CBSE'>CBSE</option>
							  <option value='CBSEI'>CBSEI</option>
							  <option value='CGOS'>CGOS</option>
							  <option value='CHHATTISGARH'>CHHATTISGARH</option>
							  <option value='CGOS'>CGOS</option>
							  <option value='DEI'>DEI</option>
							  <option value='EDEXCEL'>EDEXCEL</option>
							  <option value='GOA'>GOA</option>
							  <option value='GUJARAT'>GUJARAT</option>
							  <option value='GOA'>GOA</option>
							  <option value='HARYANA'>HARYANA</option>
							  <option value='HIMACHAL PRADESH'>HIMACHAL PRADESH</option>
							  <option value='HOS'>HOS</option>
							  <option value='IB'>IB</option>
							  <option value='ICSE'>ICSE</option>
							  <option value='JAMMU & KASHMIR'>JAMMU & KASHMIR</option>
							  <option value='JMI'>JMI</option>
							  <option value='JHARKHAND'>JHARKHAND</option>
							  <option value='KERALA'>KERALA</option>
							  <option value='MAHARASHTRA'>MAHARASHTRA</option>
							  <option value='MADHYA PRADESH'>MADHYA PRADESH</option>
							  <option value='MANIPUR'>MANIPUR</option>
							  <option value='MEGHALAYA'>MEGHALAYA</option>
							  <option value='MIZORAM'>MIZORAM</option>
							  <option value='MPSOS'>MPSOS</option>
							  <option value='NAGALAND'>NAGALAND</option>
							  <option value='NIOS'>NIOS</option>
							  <option value='ODISHA'>ODISHA</option>
							  <option value='PUNJAB'>PUNJAB</option>
							  <option value='RAJASTHAN'>RAJASTHAN</option>
							  <option value='RGUKT'>RGUKT</option>
							  <option value='RSOS'>RSOS</option>
							  <option value='TAMIL NADU'>TAMIL NADU</option>
							  <option value='TRIPURA'>TRIPURA</option>
							  <option value='UTTAR PRADESH'>UTTAR PRADESH</option>
							  <option value='UTTARAKHAND'>UTTARAKHAND</option>
							  <option value='VBU'>VBU</option>
							  <option value='WEST BENGAL'>WEST BENGAL</option>
							  <option value='OTHERS'>OTHERS</option>
					</select>
				</div>
			</div>
			<div class='col-sm-4'>
				<div class="form-group">
					<label>Board Roll No. </label>
					<input type="text" name='board_roll' id='board_roll' value="<?php echo $login_details[0]['BoardRollNo']; ?>" class="form-control" <?php if($login_details[0]['form_save_status']!='0'){echo "readonly";}else{ echo "required";}?>>
				</div>
			</div>
			
			<div class='col-sm-4'>
				<div class="form-group">
					<label>Board Year </label>
					<input type="text" name='board_year' value='2020' readonly id='board_year' class="form-control">
				</div>
			</div>
		  </div>
	<br />
		<hr style="border: .5px solid black; ">
		<!------- img upload ------->
		<div class='row'>
			<div class='col-sm-4'>
					<div style='float:right'>
							<center>
							<a href="<?php echo base_url('assets/student_photo/sample_photo.pdf');?>" download target='_blank'>Sample photo</a>
							<img src='<?php echo base_url('assets/student_photo/sam_pic.PNG');?>' class='img-responsive'>
							</center>
						</div>
				<div class="form-group">
					<label>Student Photo <span>*</span></label><br />
					<div id='stu_img_view'>
						 <?php 
			 	if($login_details[0]['form_save_status']=='0')
                 { 
				?>
					<img src='<?php echo base_url("assets/student_photo/SampleJPGImage_50kbmb.jpg"); ?>' style='width:170px;'>					<?php
				 		}else{
					$img=$login_details[0]['stu_img'];
				?> 
					<img src='<?php echo base_url("$img"); ?>' style='width:170px;'>	
						<?php
						}?>
						
					</div>
					<br />
					<input type='file' name='stu_img[]' id='stu_img' onchange="img_validation(this)" 
				<?php 
			 	if($login_details[0]['form_save_status']=='0')
                 {echo " required";}else{echo "disabled";}?> >
				</div>
			</div>
			
			<div class='col-sm-4'>
				<div class="form-group">
					<label>Student Signature <span>*</span></label><br />
					<div style='width:170px; height:30px; border:1px solid #000; background:#eee' id='stu_sign_view'>
							 <?php 
			 	if($login_details[0]['form_save_status']=='0')
                 { 
				?>
					<img src=''>					<?php
				 		}else{
					$img=$login_details[0]['stu_sign'];
				?> 
					<img src='<?php echo base_url("$img"); ?>' style='width:170px; height:30px;'>	
						<?php
						}?>
					</div><br />
					<input type='file' name='stu_sign[]' id='stu_sign' onchange="img_validation(this)" <?php 
			 	if($login_details[0]['form_save_status']=='0')
                 {echo " required";}else{echo "disabled";}?>>
				</div>
			</div>
			
			<div class='col-sm-4'>
				<div class="form-group">
					<label>Father's/Mother's Signature <span>*</span></label><br />
					<div style='width:170px; height:30px; border:1px solid #000; background:#eee' id='parent_sign_view'>
								 <?php 
			 	if($login_details[0]['form_save_status']=='0')
                 { 
				?>
					<img src=''>					<?php
				 		}else{
					$img=$login_details[0]['parent_sign'];
				?> 
					<img src='<?php echo base_url("$img"); ?>' style='width:170px; height:30px;'>	
						<?php
						}?>
					</div><br />
					<input type='file' name='parent_sign[]' id='parent_sign' onchange="img_validation(this,)" <?php 
			 	if($login_details[0]['form_save_status']=='0')
                 {echo " required";}else{echo "disabled";}?>>
				</div>
			</div><br />
		  </div>
			
		<div class='row'>
			<div class="col-sm-12">
				
				<?php if($login_details[0]['form_save_status']=='0'){
				?>
					<center><button type='submit' id='sub_btn' class='btn btn-success'><i class="fa fa-refresh fa-spin" id='process' style="display:none"></i> SAVE</button>
					</center>
				<?php 
				}else{
				?>
					<?php
						if(strtolower($login_details[0]['f_code'])=='ok' && $login_details[0]['form_save_status']=='1'){
					?>
			<?php if($login_details[0]['verify']=="1")
				{
				?><span style='float:right;color:green'>Aprroved</span>
		<?php
			}?>
				<center><a href='#'>Payment Completed</a> | <a href="<?php echo base_url('parent_dashboard/Cbse_Reg/gautam/Print_user_profile_xi/'.$login_details[0]['ID']); ?>" title='PRINT' class='btn btn-danger'><i class="fa fa-print" aria-hidden="true"></i> Print</a></center>
				
				<?php } else{
					?>
					<br />
					<b style='color:red'>CBSE Registration Fee- 300&nbsp;&#8377;<br />
					Convenience Fee- 50&nbsp;&#8377;</b>
				<br />
				<hr/>
					<!--<a href='<?php //echo base_url("parent_dashboard/Cbse_reg/payment/payment"); ?>' class='btn btn-success'>Pay Now</a>-->
			<a href='<?php echo base_url('parent_dashboard/Cbse_reg/payment/otherpay/other_pay_xi'); ?>' class='btn btn-success'>RTGS Details</a>
				<br/><br/><br/>
			<center><p style='color:red'><b>Note:</b> If payment will be debited from your bank account and your payment status still have pending, please wait for 2 working days. </p></center>
				
					<?php	
					}?>
				<?php
				}
				?>
				
			</div>
		</div><br />
		</form> 	
		</div><br /><br />
  </body>
</html>

<script>
  $("#dob").datepicker({
	  changeMonth: true,
      changeYear: true,
      showButtonPanel: true,
      dateFormat: 'dd-mm-yy',
	  minDate: new Date(1999, 12, 1),
	  maxDate: new Date(2009, 11, 31)
  });
   
  function handicp(value){
	  if(value == 'yes'){
		 $("#hc").show();
		 $("#handicap_desc").prop('disabled',false);
		 $("#handicap_desc").prop('required',true);
	  }else{
		 $("#hc").hide();  
		 $("#handicap_desc").prop('disabled',true);
		 $("#handicap_desc").prop('required',false);
	  }
  }
 
 function img_validation(val){
	var id = val.id;
	if(id == 'stu_img'){
		var height='';
	}else{
		var height = 'height:30px'
	}
	
	var file_size = $('#'+id)[0].files[0].size;
	var fileInput = document.getElementById(id);
	var filePath = fileInput.value;
	var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.JPG|\.JPEG|\.PNG)$/i;
	var size = filePath.size;
	if(allowedExtensions.exec(filePath)){
		if(file_size <= '40000'){
			var vl = URL.createObjectURL(event.target.files[0]);
			$("#"+id+'_view').html("<img src='"+vl+"' style='width:170px;"+height+"'>");
		}else{
			alert('File size should be below 40 KB');
			$( "#"+id).val("");
		}
	}else{
		alert('Only image accepted!');
		$( "#"+id).val("");
	}
	
 }

$("#form").on("submit", function (event) {
    event.preventDefault();
	$("#sv_btn").prop('disabled',true);
	$("#process").show();
	var formData = new FormData(this);
    $.ajax({
			url: "<?php echo base_url('Parentlogin_XI/upd_data'); ?>",
			type: "POST",
			data:formData,
            cache:false,
            contentType: false,
            processData: false,
			success: function(data){
			$("#sub_btn").prop('disabled',false); 
			$("#process").hide();
			if(data=='1'){
			   alert('Your Registration Form has been Successfully Submitted');
			   location.reload();
			}
			}
		});
	 });
</script>