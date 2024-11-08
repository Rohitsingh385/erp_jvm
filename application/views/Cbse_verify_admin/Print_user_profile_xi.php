<?php

if(sizeof($temp_data)==0){
	echo "<center><h1>Opps Somthing Went Wrong...!! </h1></center>";
die;
}
?>

<html>
  <head>
  <title>CBSE Board Exam Registration Form</title>
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
  
  <body >
 
    <div class='row'>
      <div class='col-sm-3'></div>
	   <div class='col-sm-6' style="margin-left:-50px">
			<center><h3>Data for CBSE Registration for Class XI 2021 </h3></center>
			</div>
		<br/>
	   <div class='col-sm-3 ' style='float:right' ><img  src='<?php 
				if($temp_data[0]['stu_img'] == null){
					echo base_url('assets/student_photo/default.jpg');
				}else{
					echo $temp_data[0]['stu_img'];
				}
				?>' style='width:95px;height:120px;border:2px dotted white'></div>
    </div>

   <br/>
	
    <table class="table" >
	  <tr>
	    <th colspan='4' style="background:#eee;"><u>Student Details</u></th>
	  </tr>
	  <tr>
	    <th>Name:-</th>
	    <td style="text-align:left; width:200px;"><?php echo $temp_data[0]['Sname']; ?></td>
		<th style="text-align:left">Date of Birth </th>
	    <td style="text-align:left"><?php echo date("d-M-Y", strtotime($temp_data[0]['DOB'])); ?></td>
	  </tr>
	  <tr>
	    <th>Aadhaar Card No.:-</th>
	    <td style="text-align:left"><?php echo $temp_data[0]['AadhaarCard']; ?></td>
		<th style="text-align:left">Gender:-</th>
	    <td style="text-align:left"><?php if($temp_data[0]['Gender']== 'M'){echo "Male";}else{ echo "Female";}?></td>
	  </tr>
	  <tr>
	    <th>Category:-</th>
	    <td style="text-align:left"><?php echo $temp_data[0]['Category']; ?></td>
		<th style="text-align:left">Email Id:-</th>
	    <td style="text-align:left"><?php echo $temp_data[0]['Email']; ?></td>
	  </tr>

	  <tr>
	    <th>Father's Name:-</th>
	    <td style="text-align:left"><?php echo $temp_data[0]['FatherName']; ?></td>
	    <th>Mother's Name:-</th>
	    <td style="text-align:left"><?php echo $temp_data[0]['MotherName']; ?></td>
	  </tr>
	 
	 
	  <tr style='display:none'>
	    <th>Address:-</th>
	    <td style="text-align:left" colspan='3'></td>
		
	  </tr>
	 <tr>
	    <th>Section:-</th>
	    <td style="text-align:left"><?php echo $temp_data[0]['Section']; ?></td>
		<th>Board Roll No.:-</th>
	    <td style="text-align:left"><?php echo $temp_data[0]['BoardRollNo'];?></td>
		
	  </tr>
	  	
	  
	   <tr>
	   <th>School Reg. No.:-</th>
	    <td style="text-align:left"><?php echo $temp_data[0]['AdmNo']; ?></td>
		<th>Date of Admission in school:-</th>
	    <td style="text-align:left"><?php 
		$newDate = date("d-M-Y", strtotime($temp_data[0]['DOA'])); echo $newDate; ?></td>
		
	  </tr>
	   <tr >
 <th>Class X Board Name:-</th>
	    <td style="text-align:left" colspan='3'> <?php echo $temp_data[0]['Board'];?></td>
	 </tr>
	     <tr style='display:none' >
	   <th>Region Code:-</th>
	    <td style="text-align:left">Patna</td>
		
		<th>School Code:-</th>
	    <td style="text-align:left"><?php echo "08281"; ?></td>
		
	  </tr>
	 
	  
	   <tr>
	   
	 
	    <td colspan='2'>
		<label> Stream:   </label> &nbsp;&nbsp;&nbsp;<?php echo $temp_data[0]['FinalStream'];?> </td>
	
		
			<td>
		      <label><b>Subject:</b></label><br/>
			  
		 <?php echo $temp_data[0]['FinalSubject'];?>
		
		   </td>
	
		   <td>
			</td>
		</tr>
	    <tr>
	   <th>Student's Sig.:-</th>
	    <td ><img src="<?php 
				if($temp_data[0]['stu_sign'] == null){
					echo base_url('assets/student_photo/signature_defoult.jpg');
				}else
				{
					echo $temp_data[0]['stu_sign'];
				}?>" style="width:150px;height:25px"></td>
			  <th>Father's/Mother's Sig.:-</th>
			<td ><img src="<?php 
				if($temp_data[0]['parent_sign'] == null){
					echo base_url('assets/student_photo/signature_defoult.jpg');
				}else
				{
					echo $temp_data[0]['parent_sign'];
				}?>" style="width:150px;height:25px"></td>
	
		
	  </tr>
	 
	  
	 
	
	  
	  
    </table>

	<table class="table">
	 <tr>
	    <th colspan='4' style="background:#eee;"><u>Payment Details</u></th>
	  </tr>
	  
	  <tr>
	    <th>Amount</th>
		<td><?php echo 'Reg. Ch.-300/- <br /> ID Card+Photo+Pro. Ch.-100/-<br /> Tot. <b>'.($fee_amt + $fee_amt_service).'.00/-</b>'; ?></td>
		<th>Transaction id</th>
		<td><?php echo $transaction_id; ?></td>
	  </tr>	
	
	  <tr>
	   
		
		  
	    <td colspan='4'>
		<br/>
		<br/>
	
		<label>&nbsp;&nbsp;&nbsp; <u>Verified and checked by</u></label>
		<br/>
		<br/>
		<br/>
		
		<br/>
		<center><b>Class Teacher: ____________________ &nbsp;&nbsp;&nbsp; Office: ____________________&nbsp;&nbsp;&nbsp;Date: ____________________</b></center></td>
	  </tr>
	</table>

  </body>
</html>