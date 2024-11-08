<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admit Card</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<style>
	*{
		text-transform: uppercase;
	}
	body{
		margin : 0px;
	}
	html{
		margin-top : 15px;
		margin-bottom : 0px;
		}
	@page {
    		size: auto;   / auto is the initial value /
    		margin-top: 10px !important;    / this affects the margin in the printer settings /
    		margin-bottom: 0;
    		margin-right: 20px;
    		margin-left: 20px;
		}
		.img{
			height: 50px;
			width: 60px;
			margin-top: 5px;
			margin-left:10px;
		}
		table,tr,td{
			padding:0px;
			margin:0px;
			font-size: 9px;
			font-weight: bold;
		}
		.school_session{
			position: absolute;
			font-size: 11px;
			top: 32px;
			left: 70px;
		}
		.school_name{
			color: black;
			font-size: 12px;
		}
		.std_icard{
			font-size: 12px;
			font-weight: bold;
		}
		.photo{
			height: 70px;
			width: 65px;
			margin: 0px 0px 0px 10px;
			border: solid 1px black;
			padding: 10px;
		}
		.header{
			background-color: #ffaf6e;
			border-top: solid 1px black;
			border-right: solid 1px black;
			border-left: solid 1px black;
		}
		.i-body{
			border-right: solid 1px black;
			border-left: solid 1px black;
			padding: 1px;
		}
		.i-footer{
			background-color: #ffaf6e;
			padding: 1px;
			border-bottom: solid 1px black;
			border-right: solid 1px black;
			border-left: solid 1px black;
		}
		.pri{
			float: right;
		}
		.pri_sign{
			height: 30px;
			width: 80px;
		}
		.mid_table{
			margin-left:20px;
		}
</style>
<body>
<div class="container">

		<div class="row">
		<div class="col-sm-12 col-lg-12 col-md-12">
			<div class="header">
				<table cellspacing="0" cellpadding="0" width="100%">
					<tr>
						<td rowspan="3" style="font-family:Verdana;font-size:11px"><img class="img" src="<?php echo $school_setting[0]->SCHOOL_LOGO; ?>"></td>
						<td class="school_name" style="font-family:Verdana;font-size:16px"><center><?php echo $school_setting[0]->School_Name; ?></center></td>
						<td rowspan="3" style="font-family:Verdana;font-size:13px"><center>ADMIT CARD</center></td>
					</tr>
					<tr>
						<td style="font-family:Verdana;font-size:14px"><center><?php echo $school_setting[0]->School_Address; ?></center></td>
					</tr>
					<tr>
						<td style="font-family:Verdana;font-size:11px"><center>Session (<?php echo $school_setting[0]->School_Session; ?>)</center></td>
					</tr>
				</table>
			</div>
			<div class="i-body">
				<!--<center><span class="std_icard" style="font-family:Verdana;font-size:13px;font-weight:bold">ADMIT CARD</span></center>-->
				<table cellspacing="0" cellpadding="0" width="100%"  class="mid_table">
					<tr>
						<td style="font-family:Verdana;font-size:11px">Exam Name</td>
						<td colspan="4" style="font-family:Verdana;font-size:10px">: <?php echo $date; ?></td>
					</tr>
					<tr>
							<td style="font-family:Verdana;font-size:11px">Adm. No.</td>
							<td style="font-family:Verdana;font-size:10px">: <?php echo $data->ADM_NO; ?></td>
							<td style="font-family:Verdana;font-size:11px">D.O.B.</td>
							<td style="font-family:Verdana;font-size:10px">: <?php echo date('d-m-Y',strtotime($data->BIRTH_DT)); ?></td>
							<td colspan="2" rowspan="5" style="font-family:Verdana;font-size:13px"><?php
							 
								if($data->student_image == null){
									?>
									<img src="assets/student_photo/default.jpg" class="photo">
									<?php
								}
								else{
									?>
									<img src="<?php echo $data->student_image; ?>" class="photo">
									<?php
								}
							?></td>
						</tr>
						<tr>
							<td style="font-family:Verdana;font-size:11px">Student Name</td>
							<td colspan="3" style="font-family:Verdana;font-size:10px">: <?php echo $data->FIRST_NM; ?></td>
							
						</tr>
						<tr>
							<td style="font-family:Verdana;font-size:11px">Class-Sec</td>
							<td style="font-family:Verdana;font-size:10px">: <?php echo $data->DISP_CLASS."-".$data->DISP_SEC; ?></td>
							<td style="font-family:Verdana;font-size:11px">Roll No.</td>
							<td style="font-family:Verdana;font-size:10px">: <?php  if($data->ROLL_NO == null){
								echo "N/A";
							}else{
								echo $data->ROLL_NO;
							}
							?></td>
						</tr>
						<tr>
							<td style="font-family:Verdana;font-size:11px">Father Name</td>
							<td style="font-family:Verdana;font-size:10px">: <?php echo $data->FATHER_NM; ?></td>
							<td style="font-family:Verdana;font-size:11px">Mother Name</td>
							<td style="font-family:Verdana;font-size:10px">: <?php echo $data->MOTHER_NM; ?></td>
						</tr>
						<tr>
							<td style="font-family:Verdana;font-size:11px">Address</td>
							<td colspan="5" style="font-family:Verdana;font-size:10px">: <?php
								if($data->CORR_ADD==null){
									echo "N/A";
								}else{
									if(strlen($data->CORR_ADD)>70)
									{
										echo substr($data->CORR_ADD,0,70);
									}
									else
									{
										echo $data->CORR_ADD;
									}
								}
							?></td>
						</tr>
					
				</table>
				<BR><BR>
					<center>
						<div class='row'>
   
   	<div class="col-md-12 ">
	 <div class='table-responsive'>
     <table class='table dataTable' style="width:100%">
		<thead>
			<tr>
				<th style='background:#ffaf6e; color:#000000; !important'>&nbsp;</th>
					<th style='background:#ffaf6e; color:#000000; !important'>&nbsp;</th>
				<th style='background:#ffaf6e; color:#000000; !important'>DATE</th>
				<th style='background:#ffaf6e; color:#000000; !important'>DAY</th>
				<th style='background:#ffaf6e; color:#000000; !important'>SUBJECT</th>
				
			</tr>
		</thead>
		<tbody>
			<?php
				if(!empty($admit_card)){
					$i=1;
					foreach($admit_card as $p){
						?>
							<tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td><?php echo date("d-m-Y", strtotime($p->edate)); ?></td>
								<td><?php echo $p->eday ; ?></td>
								<td><?php echo $p->esub ; ?></td>
								
							</tr>
						<?php $i++;
					}
				}
			?>
		</tbody>
     </table>
	 </div>
   </div>
  </div>
					</center>
					<BR>
			</div>
			<center>
				<div class="i-footer">
			<p>IMPORTANT INSTRUCTIONS: CLASS 12</p>
		</div>
	<div class="row">
		<div class="col-md-12 ">
		<div class="i-body">
		<table class='table' style="width:100%">

		<tbody>
				<tr>
					<td>1.</td>
					<td>REPORTING TO SCHOOL</td>
					<td>:</td>
					<td>7:00 AM</td>
				</tr>
				<tr>
					<td>2.</td>
					<td>REPORTING TO EXAMINATION HALL</td>
					<td>:</td>
					<td>7:30 AM</td>
				</tr>
				<tr>
					<td>3.</td>
					<td>ANSWER PAPER DISTRIBUTION</td>
					<td>:</td>
					<td>7:40 AM</td>
				</tr>
					<tr>
					<td>4.</td>
					<td>QUESTION PAPER DISTRIBUTION</td>
					<td>:</td>
					<td>7:45 AM</td>
				</tr>
					<tr>
					<td>5.</td>
					<td>QUESTION PAPER READING TIME</td>
					<td>:</td>
					<td>7:45 AM - 8:00 AM</td>
				</tr>
					<tr>
					<td>6.</td>
					<td>EXAMINATION STARTS</td>
					<td>:</td>
					<td>8:00 AM</td>
				</tr>
				<tr>
					<td>7.</td>
					<td>EXAMINATION ENDS</td>
					<td>:</td>
					<td>11:00 AM</td>
				</tr>
						
		</tbody>
     </table>
   </div>
		</div>
	</div>
	</center>
			<div class="i-footer">
				<table cellspacing="0" cellpadding="0" width="100%">
					<tr>
						<td><span><center><img src="assets/school_logo/section_incharge_xii.png" class="pri_sign"></center></span></td>
						<td></td>
						<td><span><center><img src="assets/school_logo/sjana2.png" class="pri_sign"></center></span></td>
					</tr>
					<tr>
						<td><center>Section Incharge</center></td>
						<td><center></center></td>
						<td><span><center>Principal Sign</center></span></td>
					</tr>
				</table>
			</div>
		</div>
	</div><br /><br />
	
			
</div>
</body>
</html>
