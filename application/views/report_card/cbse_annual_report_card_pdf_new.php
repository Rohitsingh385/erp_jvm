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
		body {
			font-size: 8px ! important;
		}

		@page {
			margin: 30px 10px 0px 10px;
		}

		.sign {
			font-family: 'Laila', serif;
		}

		.table1 {
			width: 100% !important;
			padding: 5px !important;
		}
		td,th{
			padding: 5px !important;
		}
	</style>
</head>

<body>
	<?php

	if (isset($result)) {

		// echo "<pre>";print_r($result);die;
		$j = 1;
		$tot_rec = count($result);
		foreach ($result as $key => $data) {
	?>
			<div style="border:5px solid #000; padding:10px;" id='dyn_<?php echo $j; ?>'>
				<table class='table1'>
					<tr>
						<td>
							<img src="<?php echo base_url($school_photo[0]->School_Logo); ?>" style="width:80px;">
						</td>

						<td >
							<center><span style='font-size:22px !important;'><b><?php echo $school_setting[0]->School_Name; ?></b></span><br />
								<span style='font-size:13px !important'><b>
										<?php echo $school_setting[0]->School_Address; ?></b>
								</span><br />
								<b style='font-size:12px !important;'>ACADEMIC SESSION: <?php echo $school_setting[0]->School_Session; ?></b>
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
				<br>

				<table class='table1' style='font-size:10px! important;padding-top: 5px !important;'>
					<tr>
						<th>Admission No. :</th>
						<td><?php echo $data['admno']; ?><input type='hidden' value='<?php echo $data['admno']; ?>' id='adm_<?php echo $j; ?>'></td>
						<th>Class-Sec:</th>
						<td><?php echo $data['class'] . " - " . $data['sec']; ?></td>

					</tr>

					<tr>
						<th>Student's Name :</th>
						<td><?php echo $data['stunm']; ?></td>
						<th>Roll No.</th>
						<td><?php echo $data['roll']; ?></td>
					</tr>

					<tr>
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
					</tr>

					<tr>
						<th>Attendance :</th>
						<td><?php echo $data['present_days']. ' / '. $data['working_days']; ?></td>
						<th>Date of Birth :</th>
						<td>
							<?php
							$dob = date("d-M-Y", strtotime($data['dob']));
							echo $dob;
							?></td>
					</tr>

					<!-- <tr>
						<th>Attendance :</th>
						<td></td>
						
					</tr> -->
				</table>
				<br><br>

				<table class='table' border='1' style='font-size:10px! important;'>
					<tr>
						<th rowspan='2' style="width: 15% !important;">
							<center>SUBJECT</center>
						</th>
						<th colspan="2" style="width: 10% !important;">
							<center>REVISION<br>TEST</center>
						</th>
						<th colspan="2" style="width: 10% !important;">
							<center>PERIODIC<br>TEST-1</center>
						</th>
						<th style="width: 7.5% !important;">
							<center>MID TERM</center>
						</th>
						<th style="width: 5% !important;">
							<center>HY<br />TOTAL</center>
						</th>
						<th colspan="2" style="width: 10% !important;">
							<center>REVISION<br>TEST</center>
						</th>
						<th colspan="2" style="width: 10% !important;">
							<center>PERIODIC<br>TEST-2</center>
						</th>
						<th style="width: 7.5% !important;">
							<center>ANNUAL<br /> EXAM</center>
						</th>
						<th style="width: 5% !important;">
							<center>ANNUAL<br />TOTAL</center>
						</th>
						<th style="width: 5% !important;">
							<center>GRAND TOTAL</center>
						</th>
						<th rowspan='2' style="width: 5% !important;">
							<center>GRADE</center>
						</th>
					</tr>
					<tr style="font-size: 9px;">
						<th>
							<center>40</center>
						</th>
						<th>
							<center>10<br />[A]</center>
						</th>
						<th>
							<center>20</center>
						</th>
						<th>
							<center>10<br /> [B]</center>
						</th>
						<th>
							<center>80<br /> [C]</center>
						</th>
						<th>
							<center>100<br /> [D]</center>
						</th>
						<th>
							<center>20</center>
						</th>
						<th>
							<center>10<br /> [E]</center>
						</th>
						<th>
							<center>20</center>
						</th>
						<th>
							<center>10<br /> [F]</center>
						</th>
						<th>
							<center>80<br /> [G]</center>
						</th>
						<th>
							<center>100<br /> [H]</center>
						</th>
						<th>
							<center>100<br />[D + H]/2</center>
						</th>
					</tr>
					<?php
					$term1Tot = 0;
					$term2Tot = 0;
					$subTot   = 0;
					$gt       = 0;
					$revtest1  = 0;
					$revtest2  = 0;

					foreach ($data['subject_nm'] as $key1 => $val1) {

						$term1Tot = ($data['term1'][1][$key1]['M3'] + $data['term1'][4][$key1]['M4'] + round(($data['term1'][12][$key1]['M3'] + $data['term1'][13][$key1]['M3']) / 4, 0));

						$term2Tot = ($data['term2'][7][$key1]['M3'] + $data['term2'][5][$key1]['M4'] + round(($data['term2'][16][$key1]['M3']) / 2, 0));

						if ($key1 == 15 || $key1 == 21) {
							$subTot   = ($term1Tot + $term2Tot);
						} else {
							$subTot   = round(($term1Tot + $term2Tot) / 2, 0);
						}

						if ($key1 != '106' && $key1 != '15' && $key1 != '21') {
							$gt      +=  $subTot;
						}
					?>
						<tr>
							<td style="text-align:left;"><?php echo $val1; ?></td>

							<!------------------MID TERM START----------------------->

							<?php
							if ($key1 == 106 || $key1 == 15 || $key1 == 21) {
							?>
								<td colspan="2"></td>
							<?php } else {
							?>
								<td>
									<center><?php echo ($data['term1'][12][$key1]['M4'] + $data['term1'][13][$key1]['M4']); ?></center>
								</td>

								<td>
									<center><?php echo round(($data['term1'][12][$key1]['M3'] + $data['term1'][13][$key1]['M3']) / 4, 0); ?></center>
								</td>

							<?php
							}
							if ($key1 == 106) {
							?>
								<td colspan="2">
									<center><?php echo $data['term1'][1][$key1]['M4'] . ' / 20';  ?></center>
								</td>

							<?php } elseif ($key1 == 15 || $key1 == 21) {
							?>
								<td colspan="2"></td>
							<?php
							} else {
							?>
								<td>
									<center><?php echo $data['term1'][1][$key1]['M4']; ?></center>
								</td>
								<td>
									<center><?php echo ($data['term1'][1][$key1]['M3']); ?></center>
								</td>

							<?php }


							if ($key1 == 15 || $key1 == 21) {
							?>
								<td>
									<center><?php echo $data['term1'][4][$key1]['M4'] . ' / 50'; ?></center>
								</td>
							<?php } else {
							?>
								<td>
									<center><?php echo $data['term1'][4][$key1]['M4']; ?></center>
								</td>
							<?php }
							?>


							<td>
								<center><?php

										if ($key1 != 15 && $key1 != 21) {
											echo $term1Tot;
										}

										?></center>
							</td>
							<!------------------MID TERM END----------------------->


							<!------------------END TERM START----------------------->
							<?php
							if ($key1 == 106 || $key1 == 15 || $key1 == 21) {
							?>
								<td colspan="2"></td>
							<?php } else {
							?>
								<td>
									<center><?php echo ($data['term2'][16][$key1]['M4']); ?></center>
								</td>

								<td>
									<center><?php echo round(($data['term2'][16][$key1]['M3']) / 2, 0); ?></center>
								</td>

							<?php
							}
							if ($key1 == 106) {
							?>
								<td colspan="2">
									<center><?php echo $data['term2'][7][$key1]['M4'] . ' / 20'; ?></center>
								</td>

							<?php } elseif ($key1 == 15 || $key1 == 21) {
							?>
								<td colspan="2"></td>
							<?php
							} else {
							?>
								<td>
									<center><?php echo $data['term2'][7][$key1]['M4']; ?></center>
								</td>
								<td>
									<center><?php echo ($data['term2'][7][$key1]['M3']); ?></center>
								</td>

							<?php }


							if ($key1 == 15 || $key1 == 21) {
							?>
								<td>
									<center><?php echo $data['term2'][5][$key1]['M4'] . ' / 50'; ?></center>
								</td>
							<?php } else {
							?>
								<td>
									<center><?php echo $data['term2'][5][$key1]['M4']; ?></center>
								</td>
							<?php }
							?>


							<td>
								<center><?php

										if ($key1 != 15 && $key1 != 21) {
											echo $term2Tot;
										}

										?></center>
							</td>

							<!------------------END TERM END----------------------->

							<td>
								<center><?php
								if ($key1 != 15 && $key1 != 21) {								
								echo $subTot; 								
								}else{
									echo $subTot.' / 100'; 
								}
								?>
								
							</center>
							</td>
							<?php
							foreach ($grademaster as $key => $grade) {
								if ($grade->ORange >= $subTot && $grade->CRange <= $subTot) {
									$fin_grade = $grade->Grade;
									break;
								}
							}
							?>
							<td>
								<center><?php echo $fin_grade; ?></center>
							</td>
						</tr>
					<?php
					}
					?>

					<tr>
						<?php
						$gingrds = $gt / 6;
						?>
						<td colspan='13' style="text-align: right !important;">
							GRAND TOTAL
						</td>
						<td>
							<center><b><?php echo $gt; ?></b></center>
						</td>
						<?php
						// insert query for class viii
						
						?>
						<td>
							<?php
							foreach ($grademaster as $key => $grade) {
								if ($grade->ORange >= $gingrds && $grade->CRange <= $gingrds) {
									$gingrds = $grade->Grade;
									break;
								}
							}
							echo "<center>" . $gingrds . "</center>";
							?>
						</td>
					</tr>
					<tr>
						<?php
						$gingrds = $gt / 6;
						?>
						
						<td colspan='13' style="text-align: right;">
							OVERALL GRAND TOTAL PERCENTAGE
						</td>
						<td>
							<center><b><?php echo number_format($gingrds, 2); ?> %</b></center>
						</td>
						<td></td>

					</tr>
					<tr>
						<td colspan='15'>
							<center>***** GK, Moral Science and IT are excluded from grand total.</center>
						</td>
					</tr>
				</table>

				
				<table border='1' class="table1"  style='border-top:2px solid #000;font-size:11px! important;width:100%'>
                    <tr>
                        <th width='33%'><center>ART</center></th>
                        <th width='33%'><center>MUSIC</center></th>
                        <th width='33%'><center>GAMES</center></th>
                    </tr>
                    <tr>
                        <td><center><?php echo '&nbsp;'.$data['term2skill'][2]['grade'].'&nbsp;'; ?></center></td>
                        <td><center><?php echo '&nbsp;'.$data['term2skill'][1]['grade'].'&nbsp;'; ?></center></td>
                        <td><center><?php echo '&nbsp;'.$data['term2skill'][3]['grade'].'&nbsp;'; ?></center></td>
                    </tr>
                </table>
                <br />
                <br />



				<br /><br />
				<div class='row'>
					<div class='col-sm-12' style='margin-top:-22px! important'>
						<table class='table' border='1' style='border-top:2px solid #000;font-size:11px! important;width:100%'>
							<tr>
								<th colspan="2" style="width: 100% !important;">
									<center><b>REMARKS</b></center>
								</th>
							</tr>
							<tr>
								<th style="width: 50% !important;height: 70px !important;">
									<b>MID TERM : </b>
								</th>
								<th style="width: 50% !important;height: 70px !important;">
									<b>END TERM : </b>
								</th>
							</tr>
							<tr>
								<td style="width: 50% !important;"><b>Promoted to / Detained in</b>
									<br />
								</td>
								<td style="width: 50% !important;"><b>NEW SESSION COMMENCES FROM: </b>03-Apr-2024</td>
							</tr>

						</table>
					</div>
				</div>
				<!-- <div class='row'>
					<div class='col-sm-12' style='margin-top:-22px! important'>
						<table class='table' border='1' style='border-top:2px solid #000;font-size:11px! important;margin-top:-30px! important'>
							<tr>
								<td><b>Promoted to / Detained in</b>
									<br />
								</td>
								<td><b>NEW SESSION COMMENCES FROM: </b>12-Apr-2024</td>
							</tr>
						</table>
					</div>
				</div> -->


				<div class='row'>
					<div class='col-sm-12'>
						<table class='table' style='font-size:10px! important;'>


							<tr>
								<td class='sign'>
									<center><br /><br /><br /><br /><br /><br />Parent's Signature</center>
								</td>
								<td class='sign'>
									<center><br /><br /><br /><br /><br /><br />Class Teacher's Signature</center>
								</td>


								<td class='sign'>
									<center><br /><br /><br /><br /><br /><br />Section In-charge's Signature</center>
								</td>
								<td class='sign'>
									<center><img src='http://micaeduco.co.in/erp/assets/school_logo/sjana.png' style='width:80px;height:90px;'><br />Principal's Signature</center>
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
			<footer style='page-break-after: always;'></footer>
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

<!--<script>
	var lp = '<?php echo $j; ?>';
	var lp = lp-1;
	$('#myModal').modal('show');
	for(var i=1; i<=lp; i++){
		var ab  = $("#dyn_"+i).html();
		var adm = $("#adm_"+i).val();
		$.ajax({	
		 url:"<?php echo base_url('report_card/report_card/adpdf') ?>",
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
</script>-->