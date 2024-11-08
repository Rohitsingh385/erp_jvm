<?php
error_reporting(0);
//print_r($login_data);

	
	    $Class_teacher="";
		$photo = "";
		$lng="Hindi";
		$f_signature = "";
		$m_signature = "";
		$child = 0;
		$Minority = 0;
			$income = "";
        $FATHERNAME = $temp_data[0]['fname'];
		$name = $temp_data[0]['name'];
		$ADM_NO = $temp_data[0]['admission_no'];
		$mobile = $temp_data[0]['mobile'];
		$email = $temp_data[0]['email'];
		$Address = $temp_data[0]['address'];
		$ROLL_NO = $temp_data[0]['roll'];
		$DATE_OF_BIRTH = $temp_data[0]['dob'];
		$GENDER = $temp_data[0]['sex'];
		$CATEGORY = $temp_data[0]['category'];
	    $AADHAR_NUMBER = $temp_data[0]['aadhaar'];
	    $MOTHERNAME = $temp_data[0]['mname'];
		$DISP_SEC = $temp_data[0]['secnm'];
		$Class_teacher = $temp_data[0]['CLASS_TEACHER'];
		$photo = $temp_data[0]['photo'];
		$f_signature = $temp_data[0]['f_signature'];
		$m_signature = $temp_data[0]['m_signature'];
		$child = $temp_data[0]['child'];
		$Minority = $temp_data[0]['minority'];
		$lng = $temp_data[0]['lng'];
		$income =$temp_data[0]['income'];	
		$verify =$temp_data[0]['verify'];	
		$verified_By =$temp_data[0]['verified_by'];	
		$verified_date =$temp_data[0]['verified_date'];	
		
		$SUBJECT1 =$temp_data[0]['SUBJECT1'];
		$SUBJECT2 =$temp_data[0]['SUBJECT2'];	
		$SUBJECT3 =$temp_data[0]['SUBJECT3'];	
		$SUBJECT4 =$temp_data[0]['SUBJECT4'];	
		$SUBJECT5 =$temp_data[0]['SUBJECT5'];	
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
      <h1>
       CBSE REGISTRATION FORM VERIFICATION FOR CLASS XI
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content" style="padding: 10px; background-color: white;  border-top:3px solid #5785c3;">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Student Details</h3>

         <div class="box-tools ">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" onclick=" window.history.back();"><i class="fa fa-arrow-left"></i> Back</button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
		 <div class="row">
		
			 <form  autocomplete='off' id='nur_form' enctype='multipart/form-data'>
		
			<div class='col-md-12 col-sm-12 col-lg-112'>
			<div style="border:1px solid grey;padding:8px">
				<div class='row'  >
					<div class='col-md-4 '>
					<label>Section:</label>
				
							<select class='form-control' name='sec' required <?php if($verify == 1){echo "readonly";}?> onchange="fetchTeach(this.value)">
						<?php if(sizeof($temp_data)==0)
						{
							?>
							
						<option value="">---Select---</option>
						
							<?php
						}
						
						$sl="";
						foreach($sections as $key){
							
							?>
							<option value="<?php echo $key->Section_No;?>" <?php echo $sl; if($DISP_SEC == $key->secnm && sizeof($temp_data)!=0){echo "selected";} ?>> <?php echo $key->secnm;?></option>
							<?php
							
						}
						?>
					
						</select>
					</div>
					<div class='col-md-4'>
					<label>Roll No.:</label>
					<input type="number" value='<?php echo $ROLL_NO; ?>' name='roll' class="form-control" required <?php if($verify == 1){echo "disabled";}?>>
					
					</div>
					<div class='col-md-4'>
					<label>Admission No.:</label>
					<input type="text" name="adm_no" value='<?php echo $ADM_NO; ?>' class="form-control" required readonly>
					<input type="hidden" name="class" value='IX' class="form-control" required >
					</div>
					
				</div>
				<div class='row'>
					<div class='col-md-4 '>
					<label>Region Code:</label>
						<input type="text" name="RGN_CODE" value='Patna' class="form-control" required readonly>
					</div>
					<div class='col-md-4'>
					<label>Exam School Code:</label>
						<input type="text" name="EXAM_S_CODE" value='66230' class="form-control" required readonly>
					</div>
					<div class='col-md-4' style='visibility:hidden'>
					<label>Class Teacher:</label>
					<input type="text" name="CLASS_TEACHER" id="teacher" style = "text-transform:uppercase;" value='<?php echo $Class_teacher;?>' class="form-control" required <?php if($verify == 1){echo "disabled";}?>>
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
						<input type="date" name="dob" value='<?php echo $DATE_OF_BIRTH;?>' class="form-control" required readonly>
					</div>
				
				
						<div class='col-md-4'>
					<label>Category:</label>
						<select class='form-control' name="category" required <?php if($verify == 1){echo "disabled";}?>>
						<option value="<?php echo $CATEGORY;?>"> <?php echo $CATEGORY;?></option>
						<?php if($CATEGORY !='GEN'){
							?>
							
						<option value="GEN"> GEN</option>
							<?php
						} if($CATEGORY !='SC'){
							?>
							
							<option value="SC">SC</option>
						<?php	
						} if($CATEGORY !='ST'){
							?>
							<option value="ST" >ST</option>
							<?php
							
						}if($CATEGORY !='OBC'){
							?>
								
						<option value="OBC" >OBC</option>
							<?php
							
						}
						
						?>
						</select>
					</div>
						<div class='col-md-4'>
				
					
					<label>Aadhaar Card No.:</label>
						<input type="text" name='aadhaar' value='<?php echo $AADHAR_NUMBER;?>' class="form-control"  maxlength="12" pattern="[0-9.]+" required <?php if($verify == 1){echo "disabled";}?>>
						
					<br/>
					
					</div>
					</div>
					</div>
					<br/>
						<div style="border:1px solid grey;padding:8px">
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
					<li> <input type="radio" name="Minority" value='1'  <?php if($Minority == 1){echo "checked";}?> <?php if($verify == 1){echo "disabled";}?> >&nbsp;&nbsp; Yes </li>
					<li> 	<input type="radio" name="Minority" value='0' <?php if($Minority == 0){echo "checked";}?> <?php if($verify == 1){echo "disabled";}?>> &nbsp;&nbsp; No</li>
					</ul>
					</div>
						<div class='col-md-4 '>
					<label>Gender:</label>
					<ul style='list-style:none'>
					<li> <input type="radio" name="sex" value='1'  <?php if($GENDER == 1){echo "checked";}?> readonly>&nbsp;&nbsp; MALE</li>
					<li> <input type="radio" name="sex" value='2' <?php if($GENDER == 2){echo "checked";}?> readonly> &nbsp;&nbsp;FEMALE</li>
					</ul>
					</div>
					</div>
					</div>
					<br/>
					
						<div style="border:1px solid grey;padding:8px">
					<div class='row' >
					 <div class='col-md-4'>
					<label>Subject:</label>
						<?php echo @$SUBJECT1."<br />".@$SUBJECT2."<br />".@$SUBJECT3."<br />".@$SUBJECT4."<br />".@$SUBJECT5; ?>
					</div>
					<div class='col-md-4'>
				
					<label>Mobile:</label>
						<input type="text" name="mobile" value='<?php echo $mobile;?>' maxlength="10" pattern="[0-9.]+" class="form-control" required <?php if($verify == 1){echo "disabled";}?>>
					<br/>
					
					<label>Email:</label>
						<input type="email" name='email' style = "text-transform:lowercase;" value='<?php echo $email;?>' class="form-control" required <?php if($verify == 1){echo "disabled";}?>>
					
					</div>
					
					<div class='col-md-4'>
				
						<label>Annual Income:</label>
						<input type="text" name="income" value='<?php echo $income;?>' maxlength="10" pattern="[0-9.]+" class="form-control"  required <?php if($verify == 1){echo "disabled";}?>>
							<br/>
					<label>Address:</label>
					<textarea class='form-control' name="address" required <?php if($verify == 1){echo "disabled";}?>><?php echo $Address;?></textarea>
				    </div>
				</div>
				</div>
				
					<br/>
					<div style="border:1px solid grey;padding:8px">
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
				?>" onclick="window.location='<?php echo base_url($f_signature);?>';" style="width:100%;height:30px;border:1px solid grey"></div>
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
				?> " onclick="window.location='<?php echo base_url($m_signature);?>';" style="width:100%;height:30px;border:1px solid grey"></div>
							<div class='col-md-4'><input type="file" name="m_signature[]" id="m_s" <?php if(sizeof($temp_data)==0){echo "required";}?> <?php if($verify == 1){echo "disabled";}?>></div>
							</div>
						</div>
						<div class='col-md-6'>
						
						<div style="margin-left:50px">
						<div id='photo_view' style='height:150px; width:160px;'>
						<img class="img-thumbnail" src='<?php 
				if($photo == null){
					echo base_url('assets/student_photo/default.jpg');
				}else{
					echo base_url($photo);
				}
				?>' onclick="window.location='<?php echo base_url($photo);?>';" style='height:150px; width:160px; '>
				</div>
				
				<div style="border:1px solid grey;padding:5px;width:160px;font-size:11px;font-weight:bold">Candidate's colour photo in school uniform with name of the student as per school record. <a href="<?php echo base_url('assets/student_photo/sample_photo.pdf');?>" download target='_blank'>Sample photo</a></div>
				<br/>
				<input type='file' name="photo[]" id="photo"  <?php if(sizeof($temp_data)==0){echo "required";}?> <?php if($verify == 1){echo "disabled";}?>>
					</div>
					</div>
					</div>
					</div>
					<br/>
					
					<input type="hidden" value="<?php echo $login_data['username'];?>" name="verified_By">
					<input type="hidden" value="<?php echo $login_data['user_id'];?>" name="verified_emp_id">
						<?php
 if(sizeof($temp_data)!=0){
	 ?>
	<a href="<?php echo base_url('parent_dashboard/Cbse_Reg/gautam/Print_user_profile/'.$ide); ?>" class='btn btn-danger' title='PRINT'><i class="fa fa-print" aria-hidden="true"></i> Print</a> 
<?php }
			 if(sizeof($temp_data)==0){?>
					<button class="btn btn-success"  style='float:right'> <span class="glyphicon glyphicon-floppy-save"></span> Save</button>
					<?php }else{?><button class="btn btn-success"  style='float:right' <?php if($verify == 1){echo "disabled";}?> ><i class="fa fa-refresh" aria-hidden="true"></i> Update</button>
					<?php if($verify==0){
						?>
						<label class="checkbox-inline" style='padding:8px;padding-left:28px;float:right;margin-right:20px'><input type="checkbox" value="1" name='verify' style='font-size:22px' id="verify" >Approve </label>
						
						<?php
						
					}else{
						?><label class="checkbox-inline" style='padding:8px;padding-left:28px;float:right;margin-right:20px;color:green;'><input type="checkbox"  style='font-size:22px' checked disabled>Approved </label>
						<label class="checkbox-inline" style='padding:8px; padding-left:28px;float:right;margin-right:20px;color:'>  Verified By <strong> <?php echo $verified_By;?></strong><br/><sup><?php echo $verified_date;?></sup></label>
						
						
						<?php
						
					}?>
					
						<?php
					}?>
					

				</div>
				</form>
				
			</div>
          </div>
        </div>
    
	
        <!-- /.box-body -->
    
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
  
  
  	$("#nur_form").on("submit", function (event) {
		
    event.preventDefault();
	//$("#sv_btn").prop('',true);
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
				//alert("success...");
				  $('#loa').html("<p style='font-size:17px;color:green'>Record updated successfully...!!!</p>");
				//window.location="<?php echo base_url('adm_nur/Adm_nur/payNow'); ?>";
				//setTimeout(function(){ $("#loading").click(); }, 1000);
				window.location="";
				$( "#f_s" ).val("");
				$( "#photo" ).val("");
				$( "#m_s" ).val("");
				
				
 if($("#verify").is(':checked'))
    
document.getElementById("verify").disabled = true;
			$("#verify").html("Approved");		
			
		}
	 });
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
   </script>
  <!-- /.content-wrapper -->