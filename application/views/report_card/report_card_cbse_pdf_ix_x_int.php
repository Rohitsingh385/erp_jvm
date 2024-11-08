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
				  <div style="border:5px solid #000; display:none" id='dyn_<?php echo $j;?>'>
					<table style='border:none !important;' class='table'>
						<tr>
							<td>
								<br /><br /><img src="<?php echo $school_photo[0]->School_Logo_RT; ?>" style="width:124px;">
							</td>
							<td>
								<center><span style='font-size:25px !important;'><?php echo $school_setting[0]->School_Name; ?></span><br />
								<span style='font-size:16px !important'>
								<?php echo $school_setting[0]->School_Address; ?>
								</span><br />
								<b>ACADEMIC SESSION: <?php echo $school_setting[0]->School_Session; ?></b>
									<br />
								<b>(Affiliated to CBSE, New Delhi)</b>
									<br />
									<b>
								(Website: www.jvmshyamali.com)<br />(Email id: jvmshyamali@yahoo.com)</b>
									
								</center>
								
							</td>
							<td style='text-align:right'>
								<br /><img src="<?php echo $school_photo[0]->School_Logo; ?>" style="width:100px; margin-top: 16px;">
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
					
					<!--<tr>
					  <th>Date of Birth :</th>
					  <td colspan='2'><?php //echo date('d-M-Y',strtotime($data['BIRTH_DT'])); ?></td>
					  <th>Attendance :</th>
					  <td colspan='2'><?php //echo $tot_present_day; ?><?php //echo $tot_working_day; ?></td>
					</tr>-->
					  
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
					  
				  </table>
				  
				  <table class='table' border='1' style='border-top:2px solid #000;'>
				    <tr>
					  <th>Scholastic Areas :</th>
					  <th colspan='4'><center><?php if($trm == 1){echo "FIRST ";}else{echo "SECOND ";}?>TERMINAL EXAMINATION</center></th>
					</tr>
					<tr>
					  <th style="width:300px;">Subject Name</th>
					  <th><center> INTERNAL ASSESSMENT <br /> (10) </center></th>
					  <!--<th><center> NOTEBOOK <br /> (05)</center></th>
					  <th><center> SUBJECT ENRICHMENT <br /> (05)</center></th>-->
					  <th><center> TERM-I <br /> (40) </center></th>
						<th><center> TERM-I TOTAL <br /> (50) </center></th>
					  <!--<th><center> </center></th>-->
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
					  <!--<td>
					  <?php //if($subject['opt_code'] != 1) { ?>
					   <center><?php //echo $subject['marks']['pt_s']; ?></center>
					  <?php //} ?> 
					  </td>-->
					  <!--<td>
					  <?php //if($subject['opt_code'] != 1) { ?>
					   <center><?php //echo $subject['marks']['notebook']; ?></center>
					  <?php //} ?> 
					  </td>
					  <td>
					  <?php //if($subject['opt_code'] != 1) { ?>
					   <center><?php //echo $subject['marks']['subject_enrichment']; ?></center>
					  <?php //} ?> 
					  </td>-->
					  <td>
					  <?php if($subject['opt_code'] != 1) { ?>
					   <center><?php echo $subject['marks']['half_yearly']; ?></center>
					  <?php } ?> 
					  </td>
					  <!--<td>
					  <?php //if($subject['opt_code'] != 1) { ?>
					   <center><?php //echo $subject['marks']['half_yearly_s']; ?></center>
					  <?php //} ?> 
					  </td>-->
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
					if($subject['subject_name'] != 'INFORMATION TECHNOLOGY'){
					  $grnd_tot += $subject['marks']['marks_obtained']; 
                      $i +=1;					  
					}
					$grd = $grnd_tot/$i;
					$grd = ($round_off==1)?round($grd): number_format($grd,2);
					?>
					<?php } ?>
					
					<tr>
					  <th></th>
					  <th colspan='2' style="text-align:right">Grand Total</th>
					  <td><center><?php echo $grnd_tot; ?></center></td>
						<td></td>
					</tr>
				  </table>
				  
				  
				  <div class='row'>
				    <div class='col-xs-8'>
					  <table class='table' border='1' style="width:100%">
						<!--<tr>
						  <th>Co-Scholastic Areas :</th>
						  <th style='text-align:center'>Grade</th>
						</tr>
						<tr>
						 <th>Work Education (or Pre-Vocational Education)</th>
						 <td style='text-align:center'><?php echo $data['skill_1']; ?></td>
						</tr>
						<tr>
						 <th>Art Education</th>
						 <td style='text-align:center'><?php echo $data['skill_2']; ?></td>
						</tr>
						<tr>
						 <th>Health & Physical Education</th>
						 <td style='text-align:center'><?php echo $data['skill_3']; ?></td>
						</tr>
						<?php //if($report_card_type == 1){ ?>
						<tr>
						  <td></td>
						  <th style='text-align:center'>Grade</th>
						</tr>
						<tr>
						  <th>Discipline</th>
						  <td style='text-align:center'><?php echo $data['dis_grd']; ?></td>
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
						//} ?>
						<!--<tr>
						  <td colspan='2' style='height:50px;'><b>Class Teacher's Remarks</b><br /><?php //echo $data['FIRST_NM'] ." ". $data['rmks']; ?></td>
						</tr>-->
					  </table>
					</div>
					
					
				    <!--<div class='col-xs-4'>
					  <div class='row'>
					    <div class='col-sm-12'>
						  <table>
						    <tr>
							  <td colspan='2' style="text-align:center; font-weight:bold">INSTRUCTIONS</td>
						    </tr>
							<tr>
							  <td colspan='2' style="text-align:center; font-weight:bold">Grading Scale for Scholastic Areas</td>
						    </tr>
							<tr>
							  <th style="text-align:center;">Marks Range</th>
							  <th style="text-align:center;">Grade</th>
							</tr>
							<tr>
							  <td style="text-align:center;">91 - 100</td>
							  <td style="text-align:center;">A1</td>
							</tr>
							<tr>
							  <td style="text-align:center;">81 - 90</td>
							  <td style="text-align:center;">A2</td>
							</tr>
							<tr>
							  <td style="text-align:center;">71 - 80</td>
							  <td style="text-align:center;">B1</td>
							</tr>
							<tr>
							  <td style="text-align:center;">61 - 70</td>
							  <td style="text-align:center;">B2</td>
							</tr>
							<tr>
							  <td style="text-align:center;">51 - 60</td>
							  <td style="text-align:center;">C1</td>
							</tr>
							<tr>
							  <td style="text-align:center;">41 - 50</td>
							  <td style="text-align:center;">C2</td>
							</tr>
							<tr>
							  <td style="text-align:center;">33 - 40</td>
							  <td style="text-align:center;">D</td>
							</tr>
							<tr>
							  <td style="text-align:center;">32 & Below</td>
							  <td style="text-align:center;">E</td>
							</tr>
						  </table>
						</div>
					  </div>
					</div>-->
				  </div>
					  
					  <table class="table" border='1' style='border-top:2px solid #000;'>
					<tr>
						<td colspan='9' style="text-align:center; font-weight:bold">INSTRUCTIONS</td>
					</tr>
					<tr>
						<td colspan='9' style="text-align:center; font-weight:bold">Grading Scale for Scholastic Areas</td>
					</tr>
					<tr>
						<th style="text-align:center;">Marks Range</th>
						<td style="text-align:center;">91 - 100</td>
						<td style="text-align:center;">81 - 90</td>
						<td style="text-align:center;">71 - 80</td>
						<td style="text-align:center;">61 - 70</td>
						<td style="text-align:center;">51 - 60</td>
						<td style="text-align:center;">41 - 50</td>
						<td style="text-align:center;">33 - 40</td>
						<td style="text-align:center;">32 & Below</td>
					</tr>
					<tr>
						<th style="text-align:center;">Grade</th>
						<td style="text-align:center;">A1</td>
						<td style="text-align:center;">A2</td>
						<td style="text-align:center;">B1</td>
						<td style="text-align:center;">B2</td>
						<td style="text-align:center;">C1</td>
						<td style="text-align:center;">C2</td>
						<td style="text-align:center;">D</td>
						<td style="text-align:center;">E</td>
					</tr>
				</table>
					  
					  
					  <br/>
				  <div class='row'>
				    <div class='col-sm-12'>
				    <table class='table'>					  
					  <tr>
						 <td class='sign'><center><br /><br /><br /><br /><br /><br />Parent's Signature</center></td>
						 <td class='sign'><center><br /><br /><br /><br /><br /><br />Class Teacher's Signature</center></td>
						 <td class='sign'><center><br /><img src='assets/school_logo/sec_in_charge.png' style='width:100px;'><br />Section In-charge's Signature</center></td>
						 <td class='sign'><center><br /><img src='assets/school_logo/sjana.png' style='width:100px;'><br />Principal's Signature</center></td>
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
		 url:"<?php echo base_url('report_card/report_card/adpdf_int')?>",
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