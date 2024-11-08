<html>
	<head>
		<title>Admit Card</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<style>
			.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
				border-top: none !important;
				line-height:15px;
				padding-top:0px;
			}
			@page { margin-top: 8px; }
			body{
				background:#eee;
			}
		</style>
	</head>
	<body>
	<div class='container'>
	<div style='border:2px solid #000; padding:10px;'>
		<table class='table'>
			<tr>
				<td><img src='<?php echo base_url("assets/school_logo/1560227769.png"); ?>' style='width:100px;'></td>
				<th><center><h3><b>JAWAHAR VIDYA MANDIR <br /><span style='font-size:15px;'>SHYAMALI, RANCHI-834002<br /><br />ADMIT CARD</span></b></h3></center></th>
				
				<td style='text-align:right;'><img src='<?php echo base_url($stuData[0]['img']); ?>' style='width:90px;'><br /></td>
			</tr>
			<tr>
				<td colspan='3'><center><strong>
					<span style='bottom: 20px; position: relative;'>Class-III Admission Test (2021-2022)<br />(PARENT'S COPY)</span>
					</strong><center>
				</td>
			</tr>
		</table>	
		<table class='table'>	
			<tr>
				<th>Name</th>
				<th>:</th>
				<td><?php echo $stuData[0]['stu_nm']; ?></td>
				<td></td>
			</tr>
			<tr>
				<th>Application No.</th>
				<th>:</th>
				<td><?php echo $stuData[0]['id'].'/2021'; ?></td>
				<td></td>
			</tr>
			<tr>
				<th>Father's Name</th>
				<th>:</th>
				<td><?php echo $stuData[0]['f_name']; ?></td>
				<td></td>
			</tr>
			<tr>
				<th>Mother's Name</th>
				<th>:</th>
				<td><?php echo $stuData[0]['m_name']; ?></td>
				<td></td>
			</tr>
			<tr>
				<th>Date of Birth</th>
				<th>:</th>
				<td><?php echo date('d-M-Y', strtotime($stuData[0]['dob'])); ?></td>
				<td></td>
			</tr>
			<tr>
				<th>Date of Examination</th>
				<th>:</th>
				<td>19th April 2021</td>
				<td></td>
			</tr>
			<tr>
				<th>Reporting Time</th>
				<th>:</th>
				<td>09:00 AM Sharp (Through Gate No.2)</td>
				<td></td>
			</tr>
			<tr>
				<th>Examination Time</th>
				<th>:</th>
				<td>09:30 AM - 10:30 AM</td>
				<td></td>
			</tr>
		</table>
		
		<table style='width:100%'>
			<tr>
				<th><br /><br /><br />Parent's Signature</th>
				<th><br /><br /><br /><center>Invigilator's Signature</center></th>
				<th style='text-align:right'><img src='<?php echo base_url("assets/logo/princ.png"); ?>'><br /> Signature of Principal</th>
				<td></td>
			</tr>
		</table>
		</div>
		</div><br />
		
		<div class='container'>
		<div style='border:2px solid #000; padding:20px;'>
		<table class='table'>
			<tr>
				<td><img src='<?php echo base_url("assets/school_logo/1560227769.png"); ?>' style='width:100px;'></td>
				<th><center><h3><b>JAWAHAR VIDYA MANDIR <br /><span style='font-size:15px;'>SHYAMALI, RANCHI-834002<br /><br />ADMIT CARD</span></b></h3></center></th>
				
				<td style='text-align:right;'><img src='<?php echo base_url($stuData[0]['img']); ?>' style='width:90px;'><br /></td>
			</tr>
			<tr>
				<td colspan='3'><center><strong>
					<span style='bottom: 20px; position: relative;'>Class-III Admission Test (2021-2022)<br />(SCHOOL'S COPY)</span> 
					</strong><center>
				</td>
			</tr>
		</table>	
		<table class='table'>	
			<tr>
				<th>Name</th>
				<th>:</th>
				<td><?php echo $stuData[0]['stu_nm']; ?></td>
				<td></td>
			</tr>
			<tr>
				<th>Application No.</th>
				<th>:</th>
				<td><?php echo $stuData[0]['id'].'/2021'; ?></td>
				<td></td>
			</tr>
			<tr>
				<th>Father's Name</th>
				<th>:</th>
				<td><?php echo $stuData[0]['f_name']; ?></td>
				<td></td>
			</tr>
			<tr>
				<th>Mother's Name</th>
				<th>:</th>
				<td><?php echo $stuData[0]['m_name']; ?></td>
				<td></td>
			</tr>
			<tr>
				<th>Date of Birth</th>
				<th>:</th>
				<td><?php echo date('d-M-Y', strtotime($stuData[0]['dob'])); ?></td>
				<td></td>
			</tr>
			<tr>
				<th>Date of Examination</th>
				<th>:</th>
				<td>19th April 2021</td>
				<td></td>
			</tr>
			<tr>
				<th>Reporting Time</th>
				<th>:</th>
				<td>09:00 AM Sharp (Through Gate No.2)</td>
				<td></td>
			</tr>
			<tr>
				<th>Examination Time</th>
				<th>:</th>
				<td>09:30 AM - 10:30 AM</td>
				<td></td>
			</tr>
		</table>
		<table style='width:100%'>
			
			<tr>
				<th><br /><br /><br />Parent's Signature</th>
				<th><br /><br /><br /><center>Invigilator's Signature</center></th>
				<th style='text-align:right'><img src='<?php echo base_url("assets/logo/princ.png"); ?>'><br /> Signature of Principal</th>
				<td></td>
			</tr>
		</table>
			
		</div>
		</div>
	</body>
</html>