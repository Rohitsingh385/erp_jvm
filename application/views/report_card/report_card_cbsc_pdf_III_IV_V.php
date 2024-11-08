<html>
  <head>
    <title>Report Card</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url('assets/dash_css/bootstrap.min.css'); ?>">
   <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>-->
	  
    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>-->
	  
	<script src="https://micaeduco.co.in/erp/assets/css/jquery.min.js"></script>
	<script src="https://micaeduco.co.in/erp/assets/css/bootstrap.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Laila:700&display=swap" rel="stylesheet">
	<style>
	  table tr th,td{
		font-size:14px!important;
		padding:12px!important;
	}
	@page { margin: 3px 6px 0px 6px; }
	
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
				$sign_fname = $data['DISP_CLASS'].'_'.$data['DISP_SEC'].'_CT.png'; 
				//echo $sign_fname;die;
				 //echo '<br/>';
				// echo '$data:--';
				// echo '<br/>';
				// echo '<pre>'; print_r($data); echo '</pre>';
				// echo '<br/>';
				?>
				  <div style="border:2px solid #000; padding:5px; display:none" id='dyn_<?php echo $j;?>'>
				  
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
								
								<b>(Affiliated to CBSE, New Delhi)</b>
									<br />
								<span style='font-size:10px !important'>(Website: www.jvmshyamali.com || Email id: jvmshyamali@yahoo.com)</span><br /><br />
									<b>ACADEMIC SESSION: <?php echo $school_setting[0]->School_Session; ?></b>
									
									
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
					  <td colspan='2'><?php echo $data['ADM_NO']; ?><input type='hidden' value='<?php echo $data['ADM_NO']; ?>' id='adm_<?php echo $j;?>'></td>
					  <th>Class-Sec:</th>
					  <td colspan='2'><?php echo $data['DISP_CLASS'] ." - " . $data['DISP_SEC']; ?></td>
					  <th>Roll No.</th>
					  <td colspan='1'><?php echo $data['ROLL_NO']; ?></td>
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
					  <td colspan='2'></td>
					  <th>Phone No. :</th>
					  <td colspan='2'><?php echo $data['C_MOBILE']; ?></td>
					  <th>Date of Birth :</th>
					   
					  <td colspan='1'>
						<?php 
						$dob= date("d-M-Y", strtotime($data['BIRTH_DT']));
					  	echo $dob; 
					  ?></td>
					</tr>
					
					<tr>
					  <th>Height (in Cm) :</th>
					  <td colspan='2'><?php echo $data['Height'];?><input type='hidden' value='<?php echo $data['ADM_NO']; ?>' id='adm_<?php echo $j;?>'></td>
					  <th>Weight (in Kg) :</th>
					  <td colspan='2'><?php echo $data['Weight']; ?></td>
					  <th>Attendance</th>
					  <td colspan='1'><?php echo $data['MAY_ATT']; ?>/<?php echo $data['APR_ATT']; ?></td>
				    </tr>
					
					
				  </table>
				  
				  <table class='table' border='0.5' style='border-top:0.5px solid #000;'>
				    <tr>
					  <th>SCHOLASTIC AREA</th>
					  <th colspan='4'><center><?php if($trm == 1){echo "FIRST ";}else{echo "SECOND ";}?>TERMINAL EXAMINATION</center></th>
					</tr>
					<tr>
					  <th style="width:300px;">Subject Name</th>
						<?php
							if($data['DISP_CLASS'] =='III'||$data['DISP_CLASS'] =='IV'||$data['DISP_CLASS'] =='V'){?>
								<th><center> UNIT TEST <br /> (20)</center></th>
							<?php }
							else
							{
								?><th><center> PERIODIC TEST <br /> (10)</center></th>
						<?php }?>
						
						<?php
							if($data['DISP_CLASS'] =='III'||$data['DISP_CLASS'] =='IV'||$data['DISP_CLASS'] =='V'){?>
								<th><center> REVISION TEST  <br />(10)</center></th>
							<?php }
							else
							{
								?><th><center> REVISION TEST <br /> (10)</center></th>
						<?php }?>
								
					  <!--<th><center> PERIODIC TEST <br /> (20)</center></th>-->
					  <?php
							if($data['DISP_CLASS'] =='III'||$data['DISP_CLASS'] =='IV'||$data['DISP_CLASS'] =='V'){?>
								<th><center> MID TERM <br /> (70)</center></th>
							<?php }
							else
							{
								?><th><center> HALF YEARLY  <br />(80)</center></th><?php }?>
					  <th><center> MARKS OBT. <br /> (100)</center></th>
					 
					</tr>
					<?php
					  $grnd_tot = 0;
					  $i = 0;
					?>
					<?php foreach($data['sub'] as $subject){ ?>
					<tr>
					  <th><?php echo $subject['subject_name']; ?></th>
					  <td>
					  <?php if($subject['opt_code'] != 1) { ?>
					   <center><?php echo $subject['marks']['pt']; ?></center>
					  <?php } ?> 
					  </td>
					 <td>
					  <?php if($subject['opt_code'] != 1) { ?>

					   <center><?php 
						if($subject['subject_name']=='COMPUTER' || $subject['subject_name']=='G.K')
						{
							echo "-"; 
						}
						else
						{
							echo $subject['marks']['REVISION-TEST-I']; 
						}
						
						?></center>
					  <?php } ?> 
					  </td>
						
						<td>
					  <?php if($subject['opt_code'] != 1) { ?>
					   <center><?php 
						if($subject['subject_name']=='COMPUTER' || $subject['subject_name']=='G.K')
						{
							echo $subject['marks']['half_yearly'].'/80'; 
							
						}
						else
						{
							echo $subject['marks']['half_yearly']; 	
						}
						
						?></center>
					  <?php } ?> 
					  </td>
					  <td>
					  <?php if($subject['opt_code'] != 1){ ?>
					  <center>
						<?php 
							echo $subject['marks']['marks_obtained'];
						?></center>
					  <?php }elseif($subject['opt_code'] == 1 && $grade_only_sub == 0){
						  ?>
						<center><?php 
						if($subject['subject_name']=='INFORMATION TECHNOLOGY')
					  {
						echo $subject['marks']['marks_obtained'];
					  }	
					  elseif($subject['subject_name']=='COMPUTER' || $subject['subject_name']=='G.K')
					  {					
						echo $subject['marks']['marks_obtained'].'/80';
					  }
					 ?></center>  
						<?php
					  } ?>
					  </td>
					  
					</tr>
					<?php
					if($subject['opt_code'] != 1){
					  $grnd_tot += $subject['marks']['marks_obtained']; 
                      $i +=1;					  
					}
					$grd = $grnd_tot/$i;
					$grd = ($round_off==1)?round($grd): number_format($grd,2);
					?>
					<?php } ?>
					
					<tr>
					  <th></th>
					  <th colspan='3' style="text-align:right">Grand Total</th>
					  <td><center><?php echo $grnd_tot; ?></center></td>
					  <?php
					    $fin_grade = 0;
						foreach($grademaster as $key => $grade){
							if($grade->ORange >=$grd && $grade->CRange <=$grd){
								$fin_grade = $grade->Grade;
								break;
							}
						}
					  ?>
					 
					</tr>
					<tr>
					  <th></th>
					  <th colspan='3' style="text-align:right">Overall Percentage</th>
					  <td><center><?php echo $grd; ?> %</center></td>
					  <?php
					    $fin_grade = 0;
						foreach($grademaster as $key => $grade){
							if($grade->ORange >=$grd && $grade->CRange <=$grd){
								$fin_grade = $grade->Grade;
								break;
							}
						}
					  ?>
					 
					</tr>
				  </table>
				  
				 
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
								<th colspan='5'><center>CO-SCHOLASTIC AREA</center></th>
							</tr>
						
							<tr>
								
								<th><center>MUSIC</center></th>
								<th><center>ART & CRAFT</center></th>
								<th><center>DISCIPLINE</center></th>
								<th><center>NEATNESS</center></th>
								<th><center>PARENT'S CO-OPERATION</center></th>
							
							</tr>
							<tr>
								<td><center><?php echo $data['skill_1']; ?></center></td>
								<td><center><?php echo $data['skill_2']; ?></center></td>
								<td><center><?php echo $data['skill_3']; ?></center></td>
								<td><center><?php echo $data['skill_4']; ?></center></td>
								<td><center><?php echo $data['skill_5']; ?></center></td>
							
							
							</tr>



						<?php //if($report_card_type == 1){ ?>
						
						
						<?php //}else{
							?>
							
							
							
							
							
							<?php
						//} ?><?php //}?>
						
					  </table>
					</div>
					</div>
					<?php
							//if($data['DISP_CLASS'] =='III'||$data['DISP_CLASS'] =='IV'||$data['DISP_CLASS'] =='V'){?>
								
							<?php //}
							//else
							//{
								?>
						<div class='row'>		
						<div class='col-sm-12'>	
						<table class='table'>
						
						<tr>
							<td>
								<center>
									
									<?php
							if($data['DISP_CLASS'] =='III'||$data['DISP_CLASS'] =='IV'||$data['DISP_CLASS'] =='V'){?>
								<?php
										if($grd <= '35'){
											echo "Class Teacher's Remarks: Average";
										}else if($grd > '35' AND $grd <= '55'){
											echo "Class Teacher's Remarks: Good";
										}else if($grd > '56' AND $grd <= '74'){
											echo "Class Teacher's Remarks: Very Good";
										}else if($grd > '75' AND $grd <= '89'){
											echo "Class Teacher's Remarks: Excellent";
										}else{
											echo "Class Teacher's Remarks: Outstanding";
										}
									?>
							<?php }
							else
							{
								?><?php
										if($grd <= '33'){
											echo "Class Teacher's Remarks: Work Hard";
										}else if($grd > '33' AND $grd <= '60'){
											echo "Class Teacher's Remarks: Can Do Better";
										}else if($grd > '60' AND $grd <= '80'){
											echo "Class Teacher's Remarks: Good";
										}else{
											echo "Class Teacher's Remarks: Very Good";
										}
									?>
						<?php }?>
									
									
									
								</center>
							</td>
						</tr>
							</table>
							<?php
							if($data['DISP_CLASS'] =='III'||$data['DISP_CLASS'] =='IV'||$data['DISP_CLASS'] =='V'){?>
								<table class='table' border='0.5' style='border-top:0.5px solid #000;'>
							
						
					    </table>
							<?php }
							else
							{
								?><table class='table' border='0.5' style='border-top:0.5px solid #000;'>
							<tr>
								<th colspan='8'><center>INSTRUCTIONS: Grading Scale for Scholastic Areas</center></th>
							</tr>
						
							<tr>
								<th><center>91 - 100</center></th>
								<th><center>81 - 90</center></th>
								<th><center>71 - 80</center></th>
								<th><center>61 - 70</center></th>
								<th><center>51 - 60</center></th>
								<th><center>41 - 50</center></th>
								<th><center>33 - 40</center></th>
								<th><center>32 & Below</center></th>
							</tr>
							<tr>
								<td><center>A1</center></td>
								<td><center>A2</center></td>
								<td><center>B1</center></td>
								<td><center>B2</center></td>
								<td><center>C1</center></td>
								<td><center>C2</center></td>
								<td><center>D</center></td>
								<td><center>E</center></td>
							</tr>
					    </table>
						<?php }?>
							
					    
						</div>
						</div>
					<?php //} ?>
				  <div class='row'>
				    <div class='col-sm-12'>
				    <table class='table'>
					 
					  
					   <tr>
						 <td class='sign'><center><br /><br /><br /><br />Parent's Signature</center></td>
						 <td class='sign'><br /><center><img src="<?php echo 'assets/school_logo/'.$sign_fname; ?>" width='50px' height='50px'><br />Class Teacher's Signature</center></td>
						 <td class='sign'><br /><center><img src='assets/school_logo/section_ic_iii_v.png'><br />Section In-charge's Signature</center></td>
						 <td class='sign'><center><br /><img src='assets/school_logo/sjana_iii_v.png' ><br />Principal's Signature</center></td>
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