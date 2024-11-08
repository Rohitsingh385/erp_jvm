<html>
  <head>
  <title>Registration Form</title>
    <link rel="shortcut icon" href="<?php echo base_url('assets/img/logo1.png'); ?>">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<style>
	span{
		color:red;
	}
	.form{
		border:1px solid #000;
		box-shadow: 0px 0px 30px 0px;
        background: #f1e9e9;		
	}
	table tr th,td{
		font-size:14.5px!important;
		padding:5px!important;
	}
	@page { margin: 12px 20px 0px 12px; }
	</style>
  </head>
  
  <body>
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
	  $bord_pass_year = $temp_data[0]['bord_pass_year'];
	  $bord_name = $temp_data[0]['bord_name'];
	  $bord_roll = $temp_data[0]['bord_roll'];
	  
	  
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
		$admission_date =$temp_data[0]['adm_date'];	
		$fee_amt =$temp_data[0]['fee_amt'];	
		$fee_amt_service =$temp_data[0]['fee_amt_service'];	
		$transaction_id =$temp_data[0]['transaction_id'];
	  	$class =$temp_data[0]['class'];
	  $Penum=$temp_data[0]['Penum'];
	    $subj1 =$temp_data[0]['subj1'];
	  $subj2 =$temp_data[0]['subj2'];
	  $subj3 =$temp_data[0]['subj3'];
	  $subj4 =$temp_data[0]['subj4'];
	  $subj5 =$temp_data[0]['subj5'];
	   $subj6 =$temp_data[0]['lng'];
	  $secnm =$temp_data[0]['sec'];
?>

    <div class='row'>
       <div class='col-sm-3'><center><img src="https://micaeduco.co.in/erp/assets/school_logo/1560227769().jpg" style='width:130px;'></center></div>
	   <div class='col-sm-6' style="margin-left:-50px"><br/><center><h4><b>CENTRAL BOARD OF SECONDARY EDUCATION</b></h4></center>
			  <?php 
		  		if($class == 'IX')
				{
					?>
			<center><p>Registration form for Class IX Registration Year:2024 </p></center>
		<?php
			}else{
				?>
				 <center><p>Registration form for Class XI Registration Year:2024 </p></center>
				
				<?php
			}
			?>
		  
		   
		   
		   
		   
		  
			</div>
 <div class='col-sm-3' ><img  src='<?php 
				if($photo == null){
					echo 'https://micaeduco.co.in/erp/assets/student_photo/default.jpg';
				}else{
					echo base_url($photo);
				}
				?>' style='width:95px;height:120px;border:2px solid white'></div>
    </div>

   <br/>
	
    <table class="table">
	  
	  <tr>
	    <th colspan='4' style="background:#eee;"><u>Student Details</u></th>
	  </tr>
	  <tr>
	    <th>Name:-</th>
	    <td style="text-align:left; width:200px;"><?php echo $name; ?></td>
		<th style="text-align:left">Date of Birth </th>
	    <td style="text-align:left"><?php 
		$DATE_OF_BIRTH = date("d-m-Y", strtotime($DATE_OF_BIRTH)); echo $DATE_OF_BIRTH; ?></td>
	  </tr>
	  
	  <tr>
	    <th>Father's Name:-</th>
	    <td style="text-align:left"><?php echo $FATHERNAME; ?></td>
	    <th>Mother's Name:-</th>
	    <td style="text-align:left"><?php echo $MOTHERNAME; ?></td>
	  </tr>
	  <tr>
	    <th>Student Aadhaar No.:-</th>
	    <td style="text-align:left"><?php echo $AADHAR_NUMBER; ?></td>
		<th style="text-align:left">Gender:-</th>
	    <td style="text-align:left"><?php if($GENDER == 1){echo "Male";}else{ echo "Female";}?></td>
	  </tr>
	  <tr>
	    <th>Category:-</th>
	    <td style="text-align:left"><?php echo $CATEGORY; ?></td>
		<th style="text-align:left">Email Id:-</th>
	    <td style="text-align:left"><?php echo $email; ?></td>
	  </tr>

	 
	 
	  <tr style='display:none'>
	    <th>Address:-</th>
	    <td style="text-align:left" colspan='3'><?php echo $Address; ?></td>
		
	  </tr>
	 
	 
	  
	 
	  <tr>
	    <th>Section:-</th>
	    <td style="text-align:left"><?php echo $secnm; ?></td>
		<th>Roll No.:-</th>
	    <td style="text-align:left"><?php echo $ROLL_NO; ?></td>
		
	  </tr>
	  	
	  
	   <tr>
	   <th>School Reg. No.:-</th>
	    <td style="text-align:left"><?php echo $ADM_NO; ?></td>
		<th>Date of Adm.:-</th>
	    <td style="text-align:left"><?php 
		$newDate = date("d-m-Y", strtotime($admission_date)); echo $newDate; ?></td>
		
	  </tr>
		
		
		
	   <tr style='display:none'>
	   <th>Class Teacher:-</th>
	    <td style="text-align:left" colspan='3'><?php echo $Class_teacher; ?></td>
		
	
		
	  </tr>
	  
	     <tr>
	   <!--<th style='display:none'>Region Code:-</th>
	    <td style="text-align:left;display:none">Patna</td>-->
		
		<th>School Code:-</th>
	    <td style="text-align:left"><?php echo "66230"; ?></td>
		<th>Mobile No:-</th>
	    <td style="text-align:left"><?php echo $mobile; ?></td>
	  </tr>
		<tr>
	   <th></th>
	    <td style="text-align:left"></td>
		<th></th>
	    <td style="text-align:left"></td>
		
	  </tr>
		 <?php 
		  		if($class == 'IX')
				{
					?>
			
		<?php
			}else{
				?>
				 <tr>
	   <!--<th style='display:none'>Region Code:-</th>
	    <td style="text-align:left;display:none">Patna</td>-->
		
		<th>Board's Name:-</th>
			 
	    <td style="text-align:left"><?php echo $bord_name; ?></td>
		<th>Board's Roll No.:-</th>
	    <td style="text-align:left"><?php echo $bord_roll; ?></td>
	  </tr>
	 
	    <tr>
	   <!--<th style='display:none'>Region Code:-</th>
	    <td style="text-align:left;display:none">Patna</td>-->
		
		<th>Board Passing Year:-</th>
			 
	    <td style="text-align:left"><?php echo $bord_pass_year; ?></td>
		
	  </tr>
				
				<?php
			}
			?>
		  
		
	     
	   <tr>
	   
	   <th><br/>Subject Details:-</th>
	
	    <td style="text-align:left" colspan='3'><ul style='list-style:none'>
		   <br/>
	   <br/>
			 <?php 
		  		if($class == 'IX')
				{
					?>
			<li>1 &nbsp;&nbsp; ENGLISH LANGUAGE AND LITERATURE (184)</li>
					<li>2  &nbsp;&nbsp; LANGUAGE II : <?php echo $lng;?>
					
					</li>
					
					<li>3 &nbsp;&nbsp; MATHEMATICS (041)</li>
					<li>4 &nbsp;&nbsp; SCIENCE (086)</li>
					<li>5 &nbsp;&nbsp; SOCIAL SCIENCE (087)</li>
					<li>6 &nbsp;&nbsp; ADDITIONAL: AI (417)</li></ul>
		<?php
			}else{
				?>
				<ul>
					<li><b>Optional Subject:  &nbsp;&nbsp; <?php echo strtoupper($subj6); ?></b><li>
					<!--<li>2 &nbsp;&nbsp; <?php //echo $subj2;?></li>
					<li>3 &nbsp;&nbsp; <?php //echo $subj3;?></li>
					<li>4 &nbsp;&nbsp; <?php// echo $subj4;?></li>
					<li>5 &nbsp;&nbsp; <?php//echo $subj5;?></li>-->
					</ul>
				
				<?php
			}
			?>
			
					</td>
		
	
		
	  </tr>
	    <tr>
	   <th>Father's Signature :-</th>
	  <td style="text-align:left"><img src="<?php 
				if($f_signature == null){
					echo 'https://micaeduco.co.in/erp/assets/student_photo/signature_defoult.jpg';
				}else
				{
					echo base_url($f_signature);
				}?>" style="width:100px;height:25px"></td>
		
		  <th>Mother's Signature :- </th>
	    <td style="text-align:left"><img src="<?php 
				if($m_signature == null){
					echo 'https://micaeduco.co.in/erp/assets/student_photo/signature_defoult.jpg';
				}else
				{
					echo base_url($m_signature);
				}?>" style="width:100px;height:25px"></td>
		
	  </tr>
	  
	  <tr>
	    <th colspan='4' style="background:#eee;"><u>Payment Details</u></th>
	  </tr>
	  
	  <tr>
	    <th>Amount</th>
		<td><?php echo 'Reg. Ch.-300/- <br /> ID Card+Photo+Pro. Ch.-100/-<br /> Tot. <b>'.($fee_amt + $fee_amt_service).'.00/-</b>'; ?></td>
		<th>Transaction id</th>
		<td><?php echo $transaction_id; ?></td>
	  </tr>	
	
	  
	  
    </table>

	<div>We hereby declare that above information are correct. The School or CBSE will not be responsible for any mistake in the data entered by the student / parent during CBSE registration. </div>
	  
	<table class="table">
	
	  <tr>
	   
		
	    <td colspan='4'>
		
		<br/>
		<label>&nbsp;&nbsp;&nbsp; Verified and checked by</label>
		<br/>
		<br/>
		<br/>
		<br/>
		<center><b>Class Teacher: ____________________ &nbsp;&nbsp;&nbsp; Office: ____________________&nbsp;&nbsp;&nbsp;Date: ____________________</b></center></td>
	  </tr>
	</table>

  </body>
</html>