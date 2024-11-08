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
			background-color: #ffffff;
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
						<td  class="school_name" style="font-family:Verdana;font-size:16px"><center><?php echo $school_setting[0]->School_Name; ?></center></td>
						<td rowspan="3" style="font-family:Verdana;font-size:11px"><center><img class="img" src="<?php echo $school_setting[0]->SCHOOL_LOGO; ?>"></center></td>
					</tr>
					<tr>
						<td style="font-family:Verdana;font-size:14px"><center><?php echo $school_setting[0]->School_Address; ?></center></td>
					</tr>
					<tr>
						<td style="font-family:Verdana;font-size:11px"><center>Session: <?php echo $school_setting[0]->School_Session; ?>
							<br/></center>
							<span style="font-family:Verdana;font-size:14px"><center>ADMIT CARD</center></span>
							</td>
					</tr>
					<tr>
						
						
					</tr>
				</table>
			</div>
			<div class="i-body">
				<!--<center><span class="std_icard" style="font-family:Verdana;font-size:13px;font-weight:bold">ADMIT CARD</span></center>-->
				<table cellspacing="0" cellpadding="0" width="100%"  class="mid_table">
					<tr>
						
						<td style="font-family:Verdana;font-size:11px"><br/>Exam Name</td>
						<!--<td colspan="4" style="font-family:Verdana;font-size:11px"><br/>: <?php //echo $date; ?></td>-->
						<td colspan="4" style="font-family:Verdana;font-size:11px"><br/>: ANNUAL EXAMINATION 2022-23</td>
					</tr>
					<tr>
							<td style="font-family:Verdana;font-size:11px"><br/>Reg. No.</td>
							<td style="font-family:Verdana;font-size:11px"><br/>: <?php echo $data->ADM_NO; ?></td>
							<td style="font-family:Verdana;font-size:11px"><br/>D.O.B.</td>
							<td style="font-family:Verdana;font-size:11px"><br/>: <?php echo date('d-m-Y',strtotime($data->BIRTH_DT)); ?></td>
							<td colspan="2" rowspan="5" style="font-family:Verdana;font-size:13px"><?php
							 
								if($data->student_image == null){
									?>
									<img src="assets/student_photo/admitcard_pic.jpg" class="photo">
								
									<?php
								}
								else{
									?>
									<img src="<?php echo $data->student_image; ?>" class="photo">
								<br/>
								
								
									<?php
								}
							?></td>
						
						
						</tr>
				
						<tr>
							<td style="font-family:Verdana;font-size:11px"><br/>Student Name</td>
							<td colspan="3" style="font-family:Verdana;font-size:11px"><br/>: <?php echo $data->FIRST_NM; ?></td>
							
						</tr>
						<tr>
							<td style="font-family:Verdana;font-size:11px"><br/>Class-Sec</td>
							<td style="font-family:Verdana;font-size:11px"><br/>: <?php echo $data->DISP_CLASS."-".$data->DISP_SEC; ?></td>
							<td style="font-family:Verdana;font-size:11px"><br/>Roll No.</td>
							<td style="font-family:Verdana;font-size:11px"><br/>: <?php  if($data->ROLL_NO == null){
								echo "N/A";
							}else{
								echo $data->ROLL_NO;
							}
							?></td>
						</tr>
						<tr>
							<td style="font-family:Verdana;font-size:11px"><br/>Father Name</td>
							<td style="font-family:Verdana;font-size:11px"><br/>: <?php echo $data->FATHER_NM; ?></td>
							<td style="font-family:Verdana;font-size:11px"><br/>Mother Name</td>
							<td style="font-family:Verdana;font-size:11px"><br/>: <?php echo $data->MOTHER_NM; ?></td>
						</tr>
						<br/>
					
				</table>
				
					<center>
						<div class='row'>
   
   	<div class="col-md-12 ">
	 <div class='table-responsive'>
     <table class='table dataTable' style="width:100%" cellspacing="30" cellpadding="20">
		<thead>
			<tr>
				
				<th style='background:#ffaf6e; color:#000000; !important'>&nbsp;</th>
				<th style='background:#ffaf6e; color:#000000; !important'>DATE</th>
				<th style='background:#ffaf6e; color:#000000; !important'>DAY</th>
				<th style='background:#ffaf6e; color:#000000; !important'>SUBJECT</th>
				<th style='background:#ffaf6e; color:#000000; !important'>INVIGILATOR SIGNATURE</th>
				
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
								<td><?php echo date("d-m-Y", strtotime($p->edate)); ?></td>
								<td><?php echo $p->eday ; ?></td>
								<td><?php echo $p->esub ; ?></td>
								<td>&nbsp;<br/></td>
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
				
			</div>
			<center>
				<div class="i-footer">
					
			<p style='background:#ffaf6e; color:#000000; !important'>IMPORTANT INSTRUCTIONS</p>
		</div>
	<div class="row">
		<div class="col-md-12 ">
		<div class="i-body">
		<table class='table' style="width:100%" >

		<tbody>
				<tr>
					<td>a)</td>
					<td>The classes will remain suspended on 17-Feb-2023 (Fri) afetr G.K./COMPUTER Exam.</td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>b)</td>
					<td>Question Paper of all Subjects comprises 80 Marks each.</td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>c)</td>
					<td>Duration of each examination will be of 3 hours only.</td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>1.</td>
					<td>REPORTING TO SCHOOL</td>
					<td>:</td>
					<td>08:00 AM</td>
				</tr>
				<tr>
					<td>2.</td>
					<td>REPORTING TO EXAMINATION HALL</td>
					<td>:</td>
					<td>08:15 AM</td>
				</tr>
				<tr>
					<td>3.</td>
					<td>DISTRIBUTION OF ANSWER SHEET</td>
					<td>:</td>
					<td>08:20 AM</td>
				</tr>
					<tr>
					<td>4.</td>
					<td>DISTRIBUTION OF QUESTION PAPER</td>
					<td>:</td>
					<td>08:30 AM</td>
				</tr>
					<tr>
					<td>5.</td>
					<td>EXAMINATION STARTS</td>
					<td>:</td>
					<td>08:45 AM</td>
				</tr>
					<tr>
					<td>6.</td>
					<td>EXAMINATION ENDS</td>
					<td>:</td>
					<td>11:45 AM</td>
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
						<td><span><center></center></span></td>
						<td></td>
						<td><span><center><img src="assets/school_logo/sjana2.png" class="pri_sign"></center></span></td>
					</tr>
					<br/>
					<tr>
						<td><center>Parent's SIGNATURE</center></td>
						<td><center>Class Teacher's SIGNATURE</center></td>
						<td><span><center>Principal's SIGNATURE</center></span></td>
					</tr>
				</table>
			</div>
					
		</div>
	</div>
	
			
</div>
</body>
</html>
