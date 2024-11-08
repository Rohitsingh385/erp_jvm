<html>
  <head>
    <title>Report Card</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url('assets/dash_css/bootstrap.min.css'); ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Laila:700&display=swap" rel="stylesheet">
	<style>
	 table tr th,td{
		font-size:14px!important;
		padding:15px!important;
	}
	@page { margin: 50px 12px 0px 12px; }
	
	.sign{
		font-family: 'Laila', serif;
	}
	</style>
  </head>
  
  <body>
	  <?php
	 
		if(isset($result)){
			$j = 1;
			$tot_rec = count($result);
			foreach($result as $key => $data){
				?>
				  <div style="border:5px solid #000; padding:10px; display:none" id='dyn_<?php echo $j;?>'>
				  
				  <table style='border:none !important;' class='table'>
						<tr>
							<td>
								<br /><br /><img src="<?php echo $school_photo[0]->School_Logo_RT; ?>" style="width:110px;">
							</td>
							<td>
								<center><span style='font-size:21px !important;'><?php echo $school_setting[0]->School_Name; ?></span><br />
								<span style='font-size:14px !important'>
								<?php echo $school_setting[0]->School_Address; ?>
								</span><br />
								<b>ACADEMIC SESSION: <?php echo $school_setting[0]->School_Session; ?></b>
									<br />
								<b>(Affiliated to CBSE, New Delhi)</b>
									<br />
								<span style='font-size:10px !important'>(Website: www.jvmshyamali.com || Email id: jvmshyamali@yahoo.com)</span>
									
								</center>
								
							</td>
							<td style='text-align:right'>
								<br /><img src="<?php echo $school_photo[0]->School_Logo; ?>" style="width:90px; margin-top: 15px;">
							</td>
						</tr>
						<tr>
							<td>
							<span style='font-size:13px !important'>Affiliation No.-
							<?php echo $school_setting[0]->School_AfftNo; ?></span>
							</td>
							<td>
							<center><span style='font-size:13px !important;'><strong>REPORT CARD </strong></span></center>
							</td>
							<td style='text-align:right'><span style='font-size:13px !important'>School Code-<?php echo $school_setting[0]->School_Code; ?></span></td>
						</tr>
					</table>
				  
				  <table class='table'>
				    <tr>
					  <th>Admission No. :</th>
					  <td><?php echo $data['ADM_NO']; ?><input type='hidden' value='<?php echo $data['ADM_NO']; ?>' id='adm_<?php echo $j;?>'></td>
					  <th>Class-Sec:</th>
					  <td><?php echo $data['DISP_CLASS'] ." - " . $data['DISP_SEC']; ?></td>
					  <th>Roll No.</th>
					  <td><?php echo $data['ROLL_NO']; ?></td>
				    </tr>
					
					<tr>
					  <th>Student's Name :</th>
					  <td colspan='5'><?php echo $data['FIRST_NM'] . " " . $data['MIDDLE_NM']; ?></td>
					</tr>
					
					<tr>
					  <th>Mother's Name :</th>
					  <td colspan='5'><?php echo $data['MOTHER_NM']; ?></td>
					</tr>
					
					<tr>
					  <th>Father's Name :</th>
					  <td colspan='5'><?php echo $data['FATHER_NM']; ?></td>
					</tr>
					
					<tr>
					  <th>House :</th>
					  <td ></td>
					  <th>Phone No. :</th>
					  <td><?php echo $data['C_MOBILE']; ?></td>
					  <th>Date of Birth :</th>
					  <td>
						<?php 
						$dob= date("d-M-Y", strtotime($data['BIRTH_DT']));
					  	echo $dob; 
					  ?></td>
					</tr>
					
					
					<tr>
						<th>Height (in CM) :</th>
						<td ><?php //echo $data['ADM_NO']; 
										?><input type='hidden' value='<?php echo $data['ADM_NO']; ?>' id='adm_<?php echo $j; ?>'></td>
						<th>Weight (in KG) :</th>
						<td ><?php //echo $data['DISP_CLASS'] ." - " . $data['DISP_SEC']; 
										?></td>
						<th>Attendance :</th>
						<td ><?php //echo $data['ROLL_NO']; 
										?></td>
					</tr>
				  </table>
				  <br/>
				  <table class='table' border='1' style='border-top:2px solid #000;'>
				    <tr>
					  <th colspan="3">Scholastic Areas :</th>
					</tr>
					<tr>
					  <th style="width:300px;" rowspan="2">Subject </th>					
					  <th colspan="2"><center> MID TERM</center></th>
					</tr>
					<tr>
						<th><center>WRITTEN</center></th>
						<th><center>ORAL</center></th>
					</tr>

					<?php
					  $grnd_tot = 0;
					  $i = 0;
					?>
					<?php
					foreach($data['sub'] as $subject){ ?>
					<tr>
					  <th><?php echo $subject['subject_name']; ?></th>
					  <td>
					  <center><?php echo $subject['marks']['skill1']; ?></center>
					</td>
					  <td>
						
						<center><?php echo $subject['marks']['skill2']; ?></center>  
					  </td>
					  
					</tr>
					<?php } ?>
					
				  </table>
				  
					  <br />
				  <div class='row'>
				    <div class='col-xs-12'>
					  <table class='table' border='0.5' style='border-top:0.5px solid #000;'>
						   <?php
							//if($data['DISP_CLASS'] =='III'||$data['DISP_CLASS'] =='IV'||$data['DISP_CLASS'] =='V'){
						   ?>
								
							<?php //}
							//else
							//{
								?>
						
					

						<tr>
								<th colspan='4'><center>CO-SCHOLASTIC AREA</center></th>
							</tr>
						
							<tr>
								
								<th><center>DRAWING</center></th>
								<th><center>PUNCTUALITY</center></th>
								<th><center>CARE OF BELONGINGS</center></th>
								<th><center>DISCIPLINE</center></th>
								
							</tr>
							<tr>
								
								<td><center> <?php echo "&nbsp;".$data['skill_1']."&nbsp;"; ?> </center></td>
								<td><center> <?php echo "&nbsp;".$data['skill_2']."&nbsp;"; ?> </center></td>
								<td><center> <?php echo "&nbsp;".$data['skill_3']."&nbsp;"; ?> </center></td>
								<td><center> <?php echo "&nbsp;".$data['skill_4']."&nbsp;"; ?> </center></td>
								
							</tr>

					  </table>
					</div>
					</div>

					  <br/>
				  <div class='row'>
				    <div class='col-xs-12'>
					  <table class='table' border='1' style='border-top:2px solid #000;'>
						   
						<tr>
						  <th><center>Class Teacher's Remarks</center></th>
						</tr>
						<tr>
							<td>
								<center>
									
									<?php
										if($grd <= '35'){
											echo "Average";
										}else if($grd > '35' AND $grd <= '55'){
											echo "Good";
										}else if($grd > '56' AND $grd <= '74'){
											echo "Very Good";
										}else if($grd > '75' AND $grd <= '89'){
											echo "Excellent";
										}else{
											echo "Outstanding";
										}
									?>
									
									
								</center>
							</td>
						</tr>
					  </table>
					</div>
					</div>
					<?php
							//if($data['DISP_CLASS'] =='III'||$data['DISP_CLASS'] =='IV'||$data['DISP_CLASS'] =='V'){?>
								
							<?php //}
							//else
							//{
								?>
						
					<?php //} ?>
					  <br/><br/><br/>
				  <div class='row'>
					<div class='col-sm-12'>
						<table class='table'>


							<tr>
								<td class='sign'>
									<center><br /><br /><br /><br />Parent's Signature</center>
								</td>
								<td class='sign'>
									<center><br /><br /><br /><br />Class Teacher's Signature</center>
								</td>
								<td class='sign'><br />
									<center><img src='assets/school_logo/section_incharge_prenur_ii.png' width="90px" height="52px"><br />Section In-charge's Signature</center>
								</td>
								<td class='sign'>
									<center><br /><img src='assets/school_logo/sjana.png' width="70px" height="52px"><br />Principal's Signature</center>
								</td>
							</tr>

						</table>
					</div>
				</div>
				  </div>
				  <?php if($tot_rec  > $j++) {?>
				  <div style='page-break-after: always;'></div>
				  <?php } ?>
				<?php
			}
		}
	  ?>
	  
	   <!-- Modal -->
		<div id="myModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-body">
				<center><img class='img-responsive' src="<?php echo base_url('assets/images/loading.gif'); ?>"></center>
			  </div>
			</div>
		  </div>
		</div>
	  <!-- end Modal -->
	  
  </body>
</html>

<script>
	var lp = '<?php echo $j; ?>';
	var lp = lp-1;
	$('#myModal').modal('show');
	for(var i=1; i<=lp; i++){
		var ab  = $("#dyn_"+i).html();
		var adm = $("#adm_"+i).val();
		$.ajax({	
		 url:"<?php echo base_url('report_card/report_card/adpdf')?>",
		 data:{'value':ab,'idd':i,'admno':adm,'lp':lp},
		 type:"POST",
		 success:function(data){
		 if(lp == data){
			$('#myModal').modal('hide');
			window.top.close();
			}
		 }	
		 });
	}	
</script>