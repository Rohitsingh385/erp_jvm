<html>

<head>
	<title>Report Card III-V</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="<?php echo base_url('assets/dash_css/bootstrap.min.css'); ?>">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Laila:700&display=swap" rel="stylesheet">
	<style>
		.table>thead>tr>th,
		.table>tbody>tr>th,
		.table>tfoot>tr>th,
		.table>thead>tr>td,
		.table>tbody>tr>td,
		.table>tfoot>tr>td {
			font-size: 10px;
			padding: 3px !important;
			text-align: center;
		}

		@page {
			margin: 15px 10px 0px 10px;
		}

		.page-break {
			page-break-before: always;
		}

		.table1 {
			width: 100% !important;

		}

		td,
		th {
			padding-top: 3px !important;
			padding-bottom: 3px !important;
		}
	</style>
</head>

<body>
	<?php

	if (isset($result)) {

		// echo '<pre>';print_r($result);die;
		// echo 'mmon';die;
		$j = 1;
		$tot_rec = count($result);
		foreach ($result as $key => $data) {
	?>
			<div style="border:5px solid #000; padding:10px;" id='dyn_<?php echo $j; ?>'>

				<!-- <table style='border:none !important; width: 100%' class='table' cellspacing=0;>
						<tr>
							<td>
								<br /><br /><img src="<?php echo $school_photo[0]->School_Logo_RT; ?>" style="width:124px;">
							</td>
							<td>
								<center><span style='font-size:25px !important;'><?php echo $school_setting[0]->School_Name; ?></span><br />
								<span style='font-size:18px !important'>
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
								<br /><img src="<?php echo $school_photo[0]->School_Logo; ?>" style="width:90px; margin-top: 16px;">
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
					</table> -->
				<table class='table1'>
					<tr>
						<td>
							<img src="<?php echo base_url($school_photo[0]->School_Logo); ?>" style="width:80px;">
						</td>
						<td>
							<center><span style='font-size:24px !important;'><b><?php echo $school_setting[0]->School_Name; ?></b></span><br />
								<span style='font-size:14px !important'><b>
										<?php echo $school_setting[0]->School_Address; ?></b>
								</span><br />
								<b style='font-size:12px !important'>ACADEMIC SESSION: <?php echo $school_setting[0]->School_Session; ?></b>
								<br />
								<b style='font-size:12px !important'>Affiliation No.: 3430004 || School Code: 66230</b>

								<br />
								<span style='font-size:10px !important'>(Website: www.jvmshyamali.com || Email id: jvmshyamali@yahoo.com)</span>

							</center>

						</td>
						<td style='text-align:right'>
							<img src="<?php echo base_url($school_photo[0]->School_Logo_RT); ?>" style="width:80px;">
						</td>
					</tr>
					<tr>
						<td>
							<!--<span style='font-size:10px !important'>Affiliation No.-
                    <?php //echo $school_setting[0]->School_AfftNo; 
					?></span>-->
						</td>
						<td>
							<b>
								<center><span style='font-size:12px !important;'>REPORT CARD</span></center>
							</b>
						</td>
						<!--<td style='text-align:right'><span style='font-size:10px !important'>School Code-<?php //echo $school_setting[0]->School_Code; 
																												?></span></td>-->
					</tr>
				</table>

				<table class='table1' style='font-size:10px! important;padding-top: 5px !important;'>
					<tr>
						<th>Admission No. :</th>
						<td><?php echo $data['admno']; ?><input type='hidden' value='<?php echo $data['admno']; ?>' id='adm_<?php echo $j; ?>'></td>
						<th>Class-Sec:</th>
						<td><?php echo $data['class'] . " - " . $data['sec']; ?></td>
						<th>Roll No.</th>
						<td><?php echo $data['roll']; ?></td>
					</tr>

					<tr>
						<th>Student's Name :</th>
						<td><?php echo $data['stunm']; ?></td>
						<th>Mother's Name :</th>
						<td><?php echo $data['mname']; ?></td>
						<th>Father's Name :</th>
						<td><?php echo $data['fname']; ?></td>
					</tr>

					<tr>
						<th>House :</th>
						<td></td>
						<th>Phone No. :</th>
						<td><?php echo $data['mob']; ?></td>
						<th>Date of Birth :</th>
						<td>
							<?php
							$dob = date("d-M-Y", strtotime($data['dob']));
							echo $dob;
							?></td>
					</tr>

					<tr>
						<th>Attendance :</th>
						<td><?php echo $data['present_days'].' / '.$data['working_days']; ?></td>
						<th>Height (cm):</th>
						<td><?php echo $data['height']; ?></td>
						<th>Weight (kg):</th>
						<td><?php echo $data['weight']; ?></td>
						
					</tr>

					<!-- <tr>
                <th>Attendance :</th>
                <td></td>
                
            </tr> -->
				</table>
				<!-- <br><br> 
				<br>-->
				<table class='table' border='1' style='border-top:2px solid #000; width: 100%;margin-top: 10px;' cellspacing=0;>
					<tr>
						<th style="font-size:12px !important;border:#000 1px solid !important">SCHOLASTIC AREAS :</th>
						<th colspan='4' style="font-size:12px !important;border:#000 1px solid !important">
							<center>MID-TERM EXAMINATION</center>
						</th>
						<th colspan='4' style="font-size:12px !important;border:#000 1px solid !important">
							<center>END-TERM EXAMINATION</center>
						</th>
					</tr>
					<tr>
						<th style="width:300px;vertical-align: middle;font-size:10px !important;border:#000 1px solid !important" >SUBJECT NAME</th>
						<th style="font-size:10px !important;border:#000 1px solid !important">
							<center> UNIT TEST <br /> (20)</center>
						</th>
						<th style="font-size:10px !important;border:#000 1px solid !important">
							<center> REVISION TEST <br /> (20) </center>
						</th>
						<th style="font-size:10px !important;border:#000 1px solid !important">
							<center> MID TERM <br /> (60)</center>
						</th>
						<th style="font-size:10px !important;border:#000 1px solid !important">
							<center> TOTAL </center> (100)
						</th>
						<th style="font-size:10px !important;border:#000 1px solid !important">
							<center> UNIT TEST <br /> (20)</center>
						</th>
						<th style="font-size:10px !important;border:#000 1px solid !important">
							<center> REVISION TEST <br /> (20) </center>
						</th>
						<th style="font-size:10px !important;border:#000 1px solid !important">
							<center> ANNUAL TERM <br /> (60)</center>
						</th>
						<th style="font-size:10px !important;border:#000 1px solid !important">
							<center> TOTAL </center> (100)
						</th>
						<th style="font-size:10px !important;border:#000 1px solid !important">
							<center> GRAND TOTAL </center> (200)
						</th>
					</tr>
					<?php
					$grandtot = 0;
					$perc = 0;
					$term1tot = 0;
					$term2tot = 0;
					$subTot = 0;
					foreach ($data['subject_nm'] as $key1 => $val1) {

						
						$term1tot = $data['term1'][1][$key1]['M3'] + $data['term1'][12][$key1]['M3'] + $data['term1'][4][$key1]['M3'];
						$term2tot = $data['term2'][1][$key1]['M3'] + $data['term2'][12][$key1]['M3'] + $data['term2'][5][$key1]['M3'];

						$subtot = $term1tot + $term2tot;	
						$grandtot += $subtot;


						?>
						<tr >
							<td style="text-align:left;border:#000 1px solid !important" width='15%'><strong><?php echo $val1; ?></strong></td>


							<td width='9.4%' style="font-size: 10px !important;border:#000 1px solid !important">
								<center><?php echo $data['term1'][1][$key1]['M2']; ?></center>
							</td>

							<td width='9.4%' style="font-size: 10px !important;border:#000 1px solid !important">
								<center><?php echo $data['term1'][12][$key1]['M2']; ?></center>
							</td>

							<td width='9.4%' style="font-size: 10px !important;border:#000 1px solid !important">
								<center><?php
								if ($key1 == 27 || $key1 == 106 || $key1 == 15 || $key1 == 7) {
									echo $data['term1'][4][$key1]['M2'].' / 80'; ?><?php
								}else{
									echo $data['term1'][4][$key1]['M2']; ?><?php
								} ?>
								</center>
							</td>

							<td width='9.4%' style="font-size: 10px !important;border:#000 1px solid !important">
								<center><?php echo $term1tot; ?></center>
							</td>

							<td width='9.4%' style="font-size: 10px !important;border:#000 1px solid !important">
								<center><?php echo $data['term2'][1][$key1]['M2']; ?></center>
							</td>

							<td width='9.4%' style="font-size: 10px !important;border:#000 1px solid !important">
								<center><?php echo $data['term2'][12][$key1]['M2']; ?></center>
							</td>

							<td width='9.4%' style="font-size: 10px !important;border:#000 1px solid !important">
								<center><?php
								if ($key1 == 27 || $key1 == 106 || $key1 == 15 || $key1 == 7) {
									echo $data['term2'][5][$key1]['M2'].' / 80'; ?><?php
								}else{
									echo $data['term2'][5][$key1]['M2']; ?><?php
								} ?>
								</center>
								
							</td>

							<td width='9.4%' style="font-size: 10px !important;border:#000 1px solid !important">
								<center><?php echo $term2tot; ?></center>
							</td>

							<td width='9.4%' style="font-size: 10px !important;border:#000 1px solid !important">
								<center><?php echo $subtot; ?></center>
							</td>

						</tr>
					<?php
					}
					?>
					<tr>
						<th colspan="9" style="text-align: right;">GRAND TOTAL</th>
						<td>
							<center><?php echo $grandtot; ?></center>
						</td>
					</tr>
					<?php

					if ($data['class'] == 'III') {
						$perc = round($grandtot / 10,2);
					} elseif ($data['class'] == 'IV') {
						$perc = round($grandtot / 12,2);
					} else {
						$perc = round($grandtot / 14,2);
					}
					?>
					<tr>
						<th colspan="9" style='text-align: right;'>PERCENTAGE</th>
						<td>
							<center><?php echo $perc; ?></center>
						</td>
					</tr>
				</table>


				<table border='1' class="table1" style='border-top:0px solid #000;font-size:10px! important;width:100%'>
					<tr>
						<th colspan="7" width='70%'><b>
								<center>CO-SCHOLASTIC GRADES</center>
							</b></th>
						<th colspan="2" width='30%'><b>
								<center>PERSONALITY ASSESSMENT</center>
							</b></th>
					</tr>
					<tr>
						<th colspan="2" width='10%'>
							<center>ART</center>
						</th>
						<th colspan="2" width='10%'>
							<center>MUSIC</center>
						</th>
						<th rowspan="2" width='10%'>
							<center>DISCIPLINE</center>
						</th>
						<th rowspan="2" width='10%'>
							<center>PARENT'S <br> CO-OPERATION</center>
						</th>
						<th rowspan="2" width='10%'>
							<center>NEATNESS</center>
						</th>
						<th width='15%'>
							<center>CONFIDENCE</center>
						</th>
						<td width='15%'><center><?php echo '&nbsp;'.$data['persAssmentskill'][1]['grade'].'&nbsp;'; ?></center></td>
					</tr>
					<tr>
						<th>
							<center>MID TERM</center>
						</th>
						<th>
							<center>END TERM</center>
						</th>
						<th>
							<center>MID TERM</center>
						</th>
						<th>
							<center>END TERM</center>
						</th>
						<th>
							<center>CARE OF BELONGINGS</center>
						</th>
						<td width='15%'><center><?php echo '&nbsp;'.$data['persAssmentskill'][2]['grade'].'&nbsp;'; ?></center></td>
					</tr>
					<tr>
						<td><center><?php echo '&nbsp;'.$data['term1skill'][2]['grade'].'&nbsp;'; ?></center></td>
						<td><center><?php echo '&nbsp;'.$data['term2skill'][2]['grade'].'&nbsp;'; ?></center></td>
						<td><center><?php echo '&nbsp;'.$data['term1skill'][1]['grade'].'&nbsp;'; ?></center></td>
						<td><center><?php echo '&nbsp;'.$data['term2skill'][1]['grade'].'&nbsp;'; ?></center></td>
						<td><center><?php echo '&nbsp;'.$data['term2skill'][3]['grade'].'&nbsp;'; ?></center></td>
						<td><center><?php echo '&nbsp;'.$data['term2skill'][5]['grade'].'&nbsp;'; ?></center></td>
						<td><center><?php echo '&nbsp;'.$data['term2skill'][4]['grade'].'&nbsp;'; ?></center></td>
						<th>
							<center>HYGIENE</center>
						</th>
						<td>
							<center><?php echo '&nbsp;'.$data['persAssmentskill'][3]['grade'].'&nbsp;'; ?></center>
						</td>
					</tr>
					<tr>
						<td colspan="7"></td>
						<th>
							<center>RESILIENCE</center>
						</th>
						<td>
							<center><center><?php echo '&nbsp;'.$data['persAssmentskill'][4]['grade'].'&nbsp;'; ?></center></center>
						</td>
					</tr>
					<tr>
						<th colspan="7" rowspan="2" height='30px' style="text-align: left;vertical-align: top;">CLASS TEACHER'S REMARKS : <span style="font-size: 11px;font-weight:bold;font-family:Verdana"><?php if($perc >= 95 && $perc<=100 ){ echo 'Excellent !'; }elseif( $perc >= 90 && $perc<95 ){ echo 'Very Good !'; }elseif( $perc >= 80 && $perc<90 ){ echo 'Good, Keep it up !'; }elseif( $perc >= 60 && $perc<80 ){ echo 'Can do better.'; }elseif( $perc >= 50 && $perc<60 ){ echo 'Needs to improve.'; }else{ echo 'More concentration needed.'; } ?></span></th>
						<th>
							<center>REGULARITY & PUNCTUALITY</center>
						</th>
						<td>
							<center><center><?php echo '&nbsp;'.$data['persAssmentskill'][5]['grade'].'&nbsp;'; ?></center></center>
						</td>
					</tr>
					<tr>
						<th>
							<center>TEAM SPIRIT</center>
						</th>
						<td>
							<center><center><?php echo '&nbsp;'.$data['persAssmentskill'][6]['grade'].'&nbsp;'; ?></center></center>
						</td>
					</tr>
				</table>
				<br>
				<div class='row'>
					<div class='col-sm-12' style='margin-top:-22px! important'>
						<table class='table' border='1' style='border-top:2px solid #000;font-size:11px! important;width:100%'>

							<tr>
								<td style="width: 50% !important;text-align: left;"><b>PROMOTED TO :</b>
								</td>
								<td>

								</td>
							</tr>
							<tr>
								<td style="width: 50% !important;text-align: left;"><b>NEW SESSION COMMENCES FROM: </b></td>
								<td>03-Apr-2024</td>
							</tr>

						</table>
					</div>
					<?php
					if ($data['class'] == 'III'){ ?>
						<br><br><br><br>
					<?php }elseif($data['class'] == 'IV'){ ?>
						<br><br><br>
					<?php }
					?>
					<div class='row'>
						<div class='col-sm-12'>
							<table class='table1' style='font-size:10px! important;'>


								<tr>
									<td class='sign'>
										<center><br /><br /><br /><br /><br /><br />Parent's Signature</center>
									</td>
									<td class='sign'>
										<center><br /><br /><br /><br /><br /><br />Class Teacher's Signature</center>
									</td>


									<td class='sign'>
										<center><img src='http://micaeduco.co.in/erp/assets/school_logo/section_ic_iii_v-ot.png' style='width:60px;height:70px;'><br />Section In-charge's Signature</center>
									</td>
									<td class='sign'>
										<center><img src='http://micaeduco.co.in/erp/assets/school_logo/sjana.png' style='width:60px;height:70px;'><br />Principal's Signature</center>
									</td>
								</tr>

							</table>
							<!--<table style='border:1 !important; width: 100%' class='table' cellspacing=0;>
							<tr style='height:25px;'>
								<td style='font-size:6px; text-align:righr'><b>Published On: <?php echo date('d-M-y'); ?></b></td></tr>
						</table>-->
						</div>
					</div>
				</div>
			</div>
				<?php if ($tot_rec < $j++) { ?>
					<div style='page-break-after: always;'></div>
				<?php } ?>
		<?php
		}
	}
		?>

</body>

</html>