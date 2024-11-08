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
	 <style>
	 table tr th,td{
		font-size:14px!important;
		padding:15px!important;
	}
	@page { margin: 250px 12px 0px 12px; }
	
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
								<br /><br /><img src="<?php echo $school_photo[0]->School_Logo; ?>" style="width:100px; margin-top: -7px;">
							</td>
							<td>
								<center><span style='font-size:25px !important;'><?php echo $school_setting[0]->School_Name; ?></span><br /
								>
								<span style='font-size:18px !important'>
								<?php echo $school_setting[0]->School_Address; ?>
								</span><br />
								<b>ACADEMIC SESSION: <?php echo $school_setting[0]->School_Session; ?></b>
								</center>
								
							</td>
							<td style='text-align:right'>
								<br /><img src="<?php echo $school_photo[0]->School_Logo_RT; ?>" style="width:124px;">
							</td>
						</tr>
						<tr>
							<td>
							<span style='font-size:13px !important'>Affiliation No.-
							<?php echo $school_setting[0]->School_AfftNo; ?></span>
							</td>
							<td>
							<b><center><span style='font-size:16px !important;'>REPORT CARD</span></center></b>
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
					  <td colspan='3'></td>
					  <th>Phone No. :</th>
					  <td><?php echo $data['C_MOBILE']; ?></td>
					</tr>
					
					<tr>
					  <th>Address :</th>
					  <td colspan='5'></td>
					</tr>
					
					<!--<tr>
					  <th>Date of Birth :</th>
					  <td colspan='2'><?php //echo $data['BIRTH_DT']; ?></td>
					  <th>Attendance :</th>
					  <td colspan='2'><?php //echo $tot_present_day; ?><?php //echo $tot_working_day; ?></td>
					</tr>-->
				  </table>
				  
				  <table class='table' border='1' style='border-top:2px solid #000;'>
				    <tr>
					  <th>Scholastic Areas :</th>
					  <th colspan='4'><center><?php if($trm == 1){echo "FIRST ";}else{echo "SECOND ";}?>TERMINAL EXAMINATION</center></th>
					</tr>
					<tr>
					  <th style="width:300px;">Subject Name</th>
						<?php
							if($data['DISP_CLASS'] =='III'||$data['DISP_CLASS'] =='IV'||$data['DISP_CLASS'] =='V'){?>
								<th><center> UNIT TEST <br />(20)</center></th>
							<?php }
							else
							{
								?><th><center> PERIODIC TEST <br /> (20)</center></th>
						<?php }?>
								
					  <!--<th><center> PERIODIC TEST <br /> (20)</center></th>-->
					  <?php
							if($data['DISP_CLASS'] =='III'||$data['DISP_CLASS'] =='IV'||$data['DISP_CLASS'] =='V'){?>
								<th><center> MID TERM <br />(80)</center></th>
							<?php }
							else
							{
								?><th><center> HALF YEARLY <br /> (80)</center></th><?php }?>
					  <th><center> MARKS OBTAINED <br /> (100)</center></th>
					  <th><center> GRADE </center> </th>
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
					   <center><?php echo $subject['marks']['half_yearly']; ?></center>
					  <?php } ?> 
					  </td>
					  <td>
					  <?php if($subject['opt_code'] != 1){ ?>
					  <center><?php echo $subject['marks']['marks_obtained']; ?></center>
					  <?php }elseif($subject['opt_code'] == 1 && $grade_only_sub == 0){
						  ?>
						<center><?php echo $subject['marks']['marks_obtained']; ?></center>  
						<?php
					  } ?>
					  </td>
					  <td><center><?php echo $subject['marks']['grade']; ?></center></td>
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
					  <th>(<?php echo $grd; ?> %)</th>
					  <th colspan='2' style="text-align:right">Grand Total</th>
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
					  <td><center><?php echo $fin_grade; ?><center></td>
					</tr>
				  </table>
				  
				 
				  <div class='row'>
				    <div class='col-xs-12'>
					  <table class='table' border='1' style='border-top:2px solid #000;'>
						   <?php
							//if($data['DISP_CLASS'] =='III'||$data['DISP_CLASS'] =='IV'||$data['DISP_CLASS'] =='V'){
						   ?>
								
							<?php //}
							//else
							//{
								?>
						
						<!--<tr>
						  <th>Co-Scholastic Areas :</th>
						  <th style='text-align:center'>Grade</th>
						</tr>
						<tr>
						 <th>Work Education (or Pre-Vocational Education)</th>
						 <td style='text-align:center'><?php //echo $data['skill_1']; ?></td>
						</tr>
						<tr>
						 <th>Art Education</th>
						 <td style='text-align:center'><?php //echo $data['skill_2']; ?></td>
						</tr>
						<tr>
						 <th>Health & Physical Education</th>
						 <td style='text-align:center'><?php //echo $data['skill_3']; ?></td>
						</tr>
						<?php //if($report_card_type == 1){ ?>
						<tr>
						  <td></td>
						  <th style='text-align:center'>Grade</th>
						</tr>
						<tr>
						  <th>Discipline</th>
						  <td style='text-align:center'><?php //echo $data['dis_grd']; ?></td>
						</tr>
						<?php //}else{
							?>
							<tr>
							  <th><h4>Discipline</h4></th>
							  <th style='text-align:center'>Grade</th>
							</tr>
							<tr>
							  <td>Attendance</td>
							  <td><center><?php //echo $data['diskill_1']; ?></center></td>
							</tr>
							<tr>
							  <td>Sincerity</td>
							  <td><center><?php //echo $data['diskill_2']; ?></center></td>
							</tr>
							<tr>
							  <td>Behaviour</td>
							  <td><center><?php //echo $data['diskill_3']; ?></center></td>
							</tr>
							<tr>
							  <td>Values</td>
							  <td><center><?php //echo $data['diskill_4']; ?></center></td>
							</tr>-->
							<?php
						//} ?><?php //}?>
						<tr>
						  <th><center>Class Teacher's Remarks</center></th>
						</tr>
						<tr>
							<td>
								<center>
									
									<?php
							if($data['DISP_CLASS'] =='III'||$data['DISP_CLASS'] =='IV'||$data['DISP_CLASS'] =='V'){?>
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
							<?php }
							else
							{
								?><?php
										if($grd <= '33'){
											echo "Work Hard";
										}else if($grd > '33' AND $grd <= '60'){
											echo "Can Do Better";
										}else if($grd > '60' AND $grd <= '80'){
											echo "Good";
										}else{
											echo "Very Good";
										}
									?>
						<?php }?>
									
									
									
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
						<div class='row'>		
						<div class='col-sm-12'>	
							<?php
							if($data['DISP_CLASS'] =='III'||$data['DISP_CLASS'] =='IV'||$data['DISP_CLASS'] =='V'){?>
								<table class='table' border='1' style='border-top:2px solid #000;'>
							<tr>
								<th colspan='5'><center>INSTRUCTIONS</center></th>
							</tr>
							<tr>
								<td colspan='5'><center>Grading Scale for Scholastic Areas</center></td>
							</tr>
							<tr>
								<th><center>91 - 100</center></th>
								<th><center>75 - 90</center></th>
								<th><center>56 - 74</center></th>
								<th><center>35 - 55</center></th>
								<th><center>35 & Below</center></th>
							</tr>
							<tr>
								<td><center>A+</center></td>
								<td><center>A</center></td>
								<td><center>B</center></td>
								<td><center>C</center></td>
								<td><center>D</center></td>
							
							</tr>
					    </table>
							<?php }
							else
							{
								?><table class='table' border='1' style='border-top:2px solid #000;'>
							<tr>
								<th colspan='8'><center>INSTRUCTIONS</center></th>
							</tr>
							<tr>
								<td colspan='8'><center>Grading Scale for Scholastic Areas</center></td>
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
				  <br /><br />
				  <div class='row'>
				    <div class='col-sm-12'>
				    <table class='table'>
					  <!--<tr>
					  <?php
					    //foreach($signature as $key=> $val){
							//if($val->SIGNATURE != '-'){
					  ?>
					    <td class='sign'>
						<center><?php //echo $val->SIGNATURE; ?></center></td>
						<?php //}} ?>	
					  </tr>-->
					  
					   <tr>
						 <td class='sign'><center>Parent's Signature</center></td>
						 <td class='sign'><center>Class Teacher's Signature</center></td>
						 <td class='sign'><center>Section In-charge's Signature</center></td>
						 <td class='sign'><center>Principal's Signature</center></td>
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