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
		table tr th,
		td {
			font-size: 14px !important;
			padding: 12px !important;
		}

		@page {
			margin: 3px 6px 0px 6px;
		}

		.sign {
			font-family: 'Laila', serif;
		}
	</style>
</head>

<body>
	<?php

	if (isset($result)) {
		$j = 1;
		$tot_rec = count($result);
		foreach ($result as $key => $data) {

			//echo '<br/>';
			// echo '$data:--';
			// echo '<br/>';
			// echo '<pre>'; print_r($data); echo '</pre>';
			// echo '<br/>';
	?>
			<div style="border:2px solid #000; padding:5px; display:none" id='dyn_<?php echo $j; ?>'>

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
						<td colspan='2'><?php echo $data['ADM_NO']; ?><input type='hidden' value='<?php echo $data['ADM_NO']; ?>' id='adm_<?php echo $j; ?>'></td>
						<th>Class-Sec:</th>
						<td colspan='2'><?php echo $data['DISP_CLASS'] . " - " . $data['DISP_SEC']; ?></td>
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
							$dob = date("d-M-Y", strtotime($data['BIRTH_DT']));
							echo $dob;
							?></td>
					</tr>

					<tr>
						<th>Height (in CM) :</th>
						<td colspan='2'><?php //echo $data['ADM_NO']; 
										?><input type='hidden' value='<?php echo $data['ADM_NO']; ?>' id='adm_<?php echo $j; ?>'></td>
						<th>Weight (in KG) :</th>
						<td colspan='2'><?php //echo $data['DISP_CLASS'] ." - " . $data['DISP_SEC']; 
										?></td>
						<th>Attendance</th>
						<td colspan='1'><?php //echo $data['ROLL_NO']; 
										?></td>
					</tr>


				</table>

				<table class='table' border='0.5' style='border-top:0.5px solid #000;'>
					<tr>
						<th>SCHOLASTIC AREA</th>
						<th colspan='5'>
							<center><?php if ($trm == 1) {
										echo "FIRST ";
									} else {
										echo "SECOND ";
									} ?>TERMINAL EXAMINATION</center>
						</th>
					</tr>
					<tr>
						<th style="width:300px;">Subject Name</th>
						<th>
							<center>ORAL / PROJECT</center>
						<th>
							<center> REVISION TEST + <br /> UNIT TEST-I (20)</center>


						<th>
							<center> MID-TERM <br /> (80)</center>
						</th>
						<th>
							<center> TOTAL <br /> (100)</center>
						</th>
						<th>
							<center> GRADE </center>
						</th>

					</tr>
					<?php
					$grnd_tot = 0;
					$i = 0;
					?>
					<?php foreach ($data['sub'] as $subject) { ?>
						<tr>
							<th><?php echo $subject['subject_name']; ?></th>
							<td>
								<center><?php echo $subject['marks']['skill']; ?></center>
							</td>
							<td>
								<?php if ($subject['opt_code'] != 1) { ?>
									<center><?php echo $subject['marks']['pt']; ?></center>
								<?php } ?>
							</td>

							<td>
								<?php if ($subject['opt_code'] != 1) { ?>
									<center><?php
											echo $subject['marks']['half_yearly'];

											?></center>
								<?php } ?>
							</td>
							<td>
								<?php if ($subject['opt_code'] != 1) { ?>
									<center>
										<?php
										echo $subject['marks']['marks_obtained'];
										?></center>
								<?php } elseif ($subject['opt_code'] == 1 && $grade_only_sub == 0) {
								?>
									<center><?php

											echo $subject['marks']['marks_obtained'];

											?></center>
								<?php
								} ?>
							</td>

							<td>
								<center>


									<?php
									if ($subject['marks']['marks_obtained'] <= '35') {
										echo "D";
									} else if ($subject['marks']['marks_obtained'] > '35' and $subject['marks']['marks_obtained'] <= '55') {
										echo "C";
									} else if ($subject['marks']['marks_obtained'] > '56' and $subject['marks']['marks_obtained'] <= '74') {
										echo "B";
									} else if ($subject['marks']['marks_obtained'] > '75' and $subject['marks']['marks_obtained'] <= '89') {
										echo "A";
									} else {
										echo "A+";
									}
									?>
								</center>																																																																																							
							</td>


						</tr>
						<?php
						if ($subject['opt_code'] != 1) {
							$grnd_tot += $subject['marks']['marks_obtained'];
							$i += 1;
						}
						$grd = $grnd_tot / $i;
						$grd = ($round_off == 1) ? round($grd) : number_format($grd, 2);
						?>
					<?php } ?>

					<tr>

						<th colspan='5' style="text-align:right">Grand Total</th>
						<td>
							<center><?php echo $grnd_tot; ?></center>
						</td>
						<?php
						$fin_grade = 0;
						foreach ($grademaster as $key => $grade) {
							if ($grade->ORange >= $grd && $grade->CRange <= $grd) {
								$fin_grade = $grade->Grade;
								break;
							}
						}
						?>

					</tr>
					<tr>

						<th colspan='5' style="text-align:right">Overall Percentage</th>
						<td>
							<center><?php echo $grd; ?> %</center>
						</td>
						<?php
						$fin_grade = 0;
						foreach ($grademaster as $key => $grade) {
							if ($grade->ORange >= $grd && $grade->CRange <= $grd) {
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
								<th colspan='4'>
									<center>CO-SCHOLASTIC AREA</center>
								</th>
							</tr>

							<tr>

								<th>
									<center>MUSIC</center>
								</th>
								<th>
									<center>ART & CRAFT</center>
								</th>
								<th>
									<center>DISCIPLINE</center>
								</th>
								<th>
									<center>NEATNESS</center>
								</th>


							</tr>
							<tr>
								<td>
									<center><?php echo $data['skill_1']; ?>&nbsp;</center>
								</td>
								<td>
									<center><?php echo $data['skill_2']; ?>&nbsp;</center>
								</td>
								<td>
									<center><?php echo $data['skill_3']; ?>&nbsp;</center>
								</td>
								<td>
									<center><?php echo $data['skill_4']; ?>&nbsp;</center>
								</td>



							</tr>



							<?php //if($report_card_type == 1){ 
							?>


							<?php //}else{
							?>





							<?php
							//} 
							?><?php //}
								?>

						</table>
					</div>
				</div>
				<?php
				//if($data['DISP_CLASS'] =='III'||$data['DISP_CLASS'] =='IV'||$data['DISP_CLASS'] =='V'){
				?>

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
										if ($data['DISP_CLASS'] == 'III' || $data['DISP_CLASS'] == 'IV' || $data['DISP_CLASS'] == 'V') { ?>
											<?php
											if ($grd <= '35') {
												echo "Class Teacher's Remarks: Average";
											} else if ($grd > '35' and $grd <= '55') {
												echo "Class Teacher's Remarks: Good";
											} else if ($grd > '56' and $grd <= '74') {
												echo "Class Teacher's Remarks: Very Good";
											} else if ($grd > '75' and $grd <= '89') {
												echo "Class Teacher's Remarks: Excellent";
											} else {
												echo "Class Teacher's Remarks: Outstanding";
											}
											?>
											<?php } else {
											?><?php
												if ($grd <= '35') {
													echo "Class Teacher's Remarks: Average";
												} else if ($grd > '35' and $grd <= '55') {
													echo "Class Teacher's Remarks: Good";
												} else if ($grd > '56' and $grd <= '74') {
													echo "Class Teacher's Remarks: Very Good";
												} else if ($grd > '75' and $grd <= '89') {
													echo "Class Teacher's Remarks: Excellent";
												} else {
													echo "Class Teacher's Remarks: Outstanding";
												}
												?>
										<?php } ?>



									</center>
								</td>
							</tr>
						</table>
						<?php
						if ($data['DISP_CLASS'] == 'III' || $data['DISP_CLASS'] == 'IV' || $data['DISP_CLASS'] == 'V') { ?>
							<table class='table' border='0.5' style='border-top:0.5px solid #000;'>


							</table>
						<?php } else {
						?>
						<?php } ?>


					</div>
				</div>
				<?php //} 
				?>
				<br />
				<br />
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
									<center><img src='assets/school_logo/section_incharge_prenur_ii.png' width="90px" height="50px"><br />Section In-charge's Signature</center>
								</td>
								<td class='sign'>
									<center><br /><img src='assets/school_logo/sjana.png' width="70px" height="50px"><br />Principal's Signature</center>
								</td>
							</tr>

						</table>
					</div>
				</div>
			</div>
			<?php if ($tot_rec  > $j++) { ?>
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
	var lp = lp - 1;
	$('#myModal').modal('show');
	for (var i = 1; i <= lp; i++) {
		var ab = $("#dyn_" + i).html();
		var adm = $("#adm_" + i).val();
		$.ajax({
			url: "<?php echo base_url('report_card/report_card/adpdf') ?>",
			data: {
				'value': ab,
				'idd': i,
				'admno': adm,
				'lp': lp
			},
			type: "POST",
			success: function(data) {
				if (lp == data) {
					$('#myModal').modal('hide');
					window.top.close();
				}
			}
		});
	}
</script>