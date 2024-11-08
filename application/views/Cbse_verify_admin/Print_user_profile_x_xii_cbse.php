<?php

if(sizeof($temp_data)==0){
	echo "<center><h1>Opps Somthing Went Wrong...!! </h1></center>";
die;
}
?>

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
  
  <body >
 
    <div class='row'>
      <div class='col-sm-3'></div>
	   <div class='col-sm-6' style="margin-left:-50px">
			<center><h3>PAY CBSE REGISTRATION FEE </h3></center>
			</div>
		<br/>
	  
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
	    <th>Class-Section:-</th>
	    <td style="text-align:left"><?php echo $temp_data[0]['Section']; ?></td>
		<th>Roll No.:-</th>
	    <td style="text-align:left"><?php echo $temp_data[0]['BoardRollNo'];?></td>
		
	  </tr>
	
	  
    </table>

  </body>
</html>