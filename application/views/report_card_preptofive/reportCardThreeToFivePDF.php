<html>
	<head>
		<link href='https://fonts.googleapis.com/css?family=Bungee+Inline' rel='stylesheet' type='text/css'>
		<title>Report Card</title>
		<style>
			table{
				width:100%;
			}
			table tr td,th{
				text-align:center;
				font-size:12px;
			}
			.page_break { page-break-before: always; }
			@page { margin: 0px;}
            body { margin: 0px 15px 0px 15px;}
			.stu_details{
				text-align:left !important;
				font-size:16px !important;
			}
			.clear{ 
				clear:both
			}
			.school_name{
				font-family: 'Bungee Inline', cursive;
				color:#201542;
			}
			.sign td{
				font-family: 'Bungee Inline', cursive;
			}
		</style>
	</head>
	<body>
	<?php
	    $j = 1;
	    $tot_rec = count($admno);
		foreach($admno as $key => $val){
			$stuData = $this->alam->selectA('student','ADM_NO,FIRST_NM,BIRTH_DT,DISP_CLASS,DISP_SEC,ROLL_NO,FATHER_NM,MOTHER_NM',"ADM_NO='$val'");
	?>
	<!-- header -->
		<table style='border:none !important;'>
			<tr>
				<td style='text-align:left'>
					<img src="<?php echo $school_photo[0]->School_Logo; ?>" style="width:120px;">
				</td>
				<td>
					<center><span style='font-size:25px !important;' class='school_name'><?php echo $school_setting[0]->School_Name; ?></span><br /
					>
					<span style='font-size:18px !important;'>
					<?php echo $school_setting[0]->School_Address; ?>
					</span><br />
					<b>ACADEMIC SESSION: <?php echo $school_setting[0]->School_Session; ?></b>
					</center>
				</td>
				<td style='text-align:right'>
					<img src="<?php echo $school_photo[0]->School_Logo_RT; ?>" style="width:120px;">
				</td>
			</tr>
			<tr>
				<td style='text-align:left'>
					<span style='font-size:13px !important'>Affiliation No.-
					<?php echo $school_setting[0]->School_AfftNo; ?></span>
				</td>
				<td>
					<b><center><span style='color:#566573; font-size:18px'>PROGRESS REPORT</span></center></b>
				</td>
				<td style='text-align:right'>
					<span style='font-size:13px !important'>School Code-<?php echo $school_setting[0]->School_Code; ?></span>
				</td>
			</tr>
		</table><hr />
		
		<table class='table stu_details'>
			<tr>
			  <th>Admission No.</th>
			  <th>:</th>
			  <td><?php echo $stuData[0]['ADM_NO']; ?></td>
			  <th>Class-Sec</th>
			  <th>:</th>
			  <td><?php echo $stuData[0]['DISP_CLASS'] ." - " . $stuData[0]['DISP_SEC']; ?></td>
			</tr>
			
			<tr>
			  <th>Roll No.</th>
			  <th>:</th>
			  <td><?php echo $stuData[0]['ROLL_NO']; ?></td>	
			  <th>Student's Name</th>
			  <th>:</th>
			  <td><?php echo $stuData[0]['FIRST_NM']; ?></td>
			</tr>
			
			<tr>
			  <th>Mother's Name</th>
			  <th>:</th>
			  <td><?php echo $stuData[0]['MOTHER_NM']; ?></td>
			  <th>Father's Name</th>
			  <th>:</th>
			  <td><?php echo $stuData[0]['FATHER_NM']; ?></td>
			</tr>
			
			<tr>
			  <th>Date of Birth</th>
			  <th>:</th>
			  <td><?php echo date('d-M-y',strtotime($stuData[0]['BIRTH_DT'])); ?></td>
			  <th>Attendance</th>
			  <th>:</th>
			  <td></td>
			</tr>
	    </table><br />
	<!-- end header -->
		<table border='1' cellspacing='0'>
			<tr>
				<th style='background:#201542; color:#fff;'><center>SUBJECTS</center></th>
				<th style='background:#201542; color:#fff;' colspan='3' align='center'>MID TERM</th>
				<th style='background:#201542; color:#fff;' colspan='3' align='center'>END TERM</th>
			</tr>
			<tr>
				<td></td>
				<td>TOTAL MARKS 100</td>
				<td>GRADES</td>
				<td>HIGHEST</td>
				<td>TOTAL MARKS 100</td>
				<td>GRADES</td>
				<td>HIGHEST</td>
			</tr>
			<?php
				foreach($subjData as $key1 => $val1){
					$subject_code = $val1['subject_code'];
					?>
						<tr>
							<th style='text-align:left; background:#EAEDED;' colspan='7'><?php echo $val1['subjnm']; ?></th>
						</tr>
					<?php
					$skillDataT1 = $this->alam->reportCardThreeToFive($Class_No,$sec,$val,$subject_code);
					foreach($skillDataT1 as $key2 => $val2){
						$skill_id = $val2['id'];
						//for subject wise highest marks
						$higestDataT1 = $this->alam->selectA('marks_all','MAX(CAST(m2 AS UNSIGNED))higest1',"class_code='$Class_No' AND sec_code='$sec' AND term='1' AND subject='$subject_code' and subject_skill='$skill_id'");
						$higestT1 = $higestDataT1[0]['higest1'];
						
						//for term one
						$exmcode1_m2_t1 = ($val2['exmcode1_m2_t1'] != 'AB' && $val2['exmcode1_m2_t1'] != '')?$val2['exmcode1_m2_t1']:0;
						$exmcode2_m2_t1 = ($val2['exmcode2_m2_t1'] != 'AB' && $val2['exmcode2_m2_t1'] != '')?$val2['exmcode2_m2_t1']:0;
						$exmcode3_m2_t1 = ($val2['exmcode3_m2_t1'] != 'AB' && $val2['exmcode2_m2_t1'] != '')?$val2['exmcode3_m2_t1']:0;
						$exmcode4_m2_t1 = ($val2['exmcode4_m2_t1'] != 'AB' && $val2['exmcode4_m2_t1'] != '')?$val2['exmcode4_m2_t1']:0;
						$m2 = ($exmcode1_m2_t1+$exmcode2_m2_t1+$exmcode3_m2_t1)/2;
						$finM2 = $m2+$exmcode4_m2_t1;
						//end term one
						
						//for subject wise highest marks
						$higestDataT2 = $this->alam->selectA('marks_all','MAX(CAST(m2 AS UNSIGNED))higest2',"class_code='$Class_No' AND sec_code='$sec' AND term='2' AND subject='$subject_code' and subject_skill='$skill_id'");
						$higestT2 = $higestDataT2[0]['higest2'];
						
						//for term two
						$exmcode1_m2_t2 = ($val2['exmcode1_m2_t2'] != 'AB' && $val2['exmcode1_m2_t2'] != '')?$val2['exmcode1_m2_t2']:0;
						$exmcode2_m2_t2 = ($val2['exmcode2_m2_t2'] != 'AB' && $val2['exmcode2_m2_t2'] != '')?$val2['exmcode2_m2_t2']:0;
						$exmcode3_m2_t2 = ($val2['exmcode3_m2_t2'] != 'AB' && $val2['exmcode3_m2_t2'] != '')?$val2['exmcode3_m2_t2']:0;
						$exmcode5_m2_t2 = ($val2['exmcode5_m2_t2'] != 'AB' && $val2['exmcode5_m2_t2'] != '')?$val2['exmcode5_m2_t2']:0;
						$m2t2 = ($exmcode1_m2_t2+$exmcode2_m2_t2+$exmcode3_m2_t2)/2;
						$finM2t2 = $m2t2+$exmcode5_m2_t2;
						//end term two
						?>
							<tr>
								<td style='background:#EAEDED;'><?php echo $val2['skill_name']; ?></td>
								<td>
									<?php 
									echo $term1marks = ($round==1)?round($finM2):number_format($finM2,2); 
									?>
								</td>
								
								<?php
									if($val1['subject_code'] != 37){ 
										if(90 <= $term1marks && 100 >= $term1marks){
											echo "<td style='background:".$color['A+']."'>A+</td>";
										}else if(75 <= $term1marks && 89 >= $term1marks){
											echo "<td style='background:".$color['A']."'>A</td>";
										}else if(56 <= $term1marks && 74 >= $term1marks){
											echo "<td style='background:".$color['B']."'>B</td>";
										}else if(35 <= $term1marks && 55 >= $term1marks){
											echo "<td style='background:".$color['C']."'>C</td>";
										}else{
											echo "<td style='background:".$color['D']."'>D</td>";
										}
									}
								?>
								<td><?php echo $higestT1; ?></td>
								<td>
									<?php 
										echo $term2marks = ($round==1)?round($finM2t2):number_format($finM2t2,2);								
									?>
								</td>
								
								
								<?php
									if($val1['subject_code'] != 37){
										if(90 <= $term2marks && 100 >= $term2marks){
											echo "<td style='background:".$color['A+']."'>A+</td>";
										}else if(75 <= $term2marks && 89 >= $term2marks){
											echo "<td style='background:".$color['A']."'>A</td>";
										}else if(56 <= $term2marks && 74 >= $term2marks){
											echo "<td style='background:".$color['B']."'>B</td>";
										}else if(35 <= $term2marks && 55 >= $term2marks){
											echo "<td style='background:".$color['C']."'>C</td>";
										}else{
											echo "<td style='background:".$color['D']."'>D</td>";
										}
									}	
								?>
								<td><?php echo $higestT2; ?></td>
							</tr>
						<?php
					}
				}
			?>
		</table>
		
		<table style='width:100%' border='1' cellspacing='0'>
			<tr>
				<th style='background:#201542; color:#fff;' colspan='3'>CO-SCHOLASTIC AREA</th>
			</tr>
			<tr>
				<td>Subjects</td>
				<td>MID TERM</td>
				<td>END TERM</td>
			</tr>
			<?php
				foreach($subjDataGrd as $keyGrd => $valGrd){
					$subject_codeGrd = $valGrd['subject_code'];
					?>
						<tr>
							<th style='text-align:left; background:#EAEDED;' colspan='3'><?php echo $valGrd['subjnm']; ?></th>
						</tr>
					<?php
					$skillDataGrad = $this->alam->reportCardThreeToFiveGrade($Class_No,$sec,$val,$subject_codeGrd);
					foreach($skillDataGrad as $keyGrd1 => $valGrd1){
						?>
							<tr>
								<td><?php echo $valGrd1['skill_name']; ?></td>
								<td style='background:<?php echo $color[$valGrd1['grdT1']]?>'><?php echo $valGrd1['grdT1']; ?></td>
								<td style='background:<?php echo $color[$valGrd1['grdT2']]?>'><?php echo $valGrd1['grdT2']; ?></td>
							</tr>
						<?php
					}
				}
			?>
		</table>
		<?php
			$remarksT1 = $this->alam->selectA('remarks','Remarks',"ADM_NO='$val' and TERM='TERM-1'");
			$remksT1 = isset($remarksT1[0]['Remarks'])?$remarksT1[0]['Remarks']:'';
			$remarksT2 = $this->alam->selectA('remarks','Remarks',"ADM_NO='$val' and TERM='TERM-2'");
			$remksT2 = isset($remarksT2[0]['Remarks'])?$remarksT2[0]['Remarks']:'';
		?>
		<table style='width:100%;' border='1' cellspacing='0'>
			<tr>
				<th style='background:#201542; color:#fff;' colspan='2'>REMARKS</th>
			</tr>
			<tr>
				<td style='width:50%; height:80px;'><?php echo $remksT1; ?></td>
				<td style='width:50%;'><?php echo $remksT2; ?></td>
			</tr>
		</table><br />
		<label><b>Congratulations!! Promoted to Class ............................................</b></label>
		<label><b>New Session Begins on ..........................................</b></label>
		<table style="width:113%;" class='clear sign'>
			<tr>
				<td><br /><br /></td>
			</tr>
			<tr>
				<?php
					foreach($signature as $key => $val){
						if($key != 3){
						?>
							<td style="text-align:left;"><?php echo $val['SIGNATURE']; ?></td>
						<?php
						}
					}
				?>
			</tr>
		</table>
		<?php if($tot_rec  > $j++) { ?>
	    <div style='page-break-after: always;'></div>
	    <?php } ?>
		<?php } ?>
	</body>
</html>