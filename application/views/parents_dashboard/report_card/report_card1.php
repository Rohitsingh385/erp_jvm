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
					
						<b><center><span style='color:#566573; font-size:18px'>ACHIEVEMENT RECORD</span></center></b>
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
					<!--<b><center><span style='color:#566573; font-size:18px'>PROGRESS REPORT</span></center></b>-->
					<b><center><span style='color:#566573; font-size:18px'>ACADEMIC SESSION: 2019-20</span></center></b>
					
				</td>
				<td style='text-align:right'>
					<span style='font-size:13px !important'>School Code-<?php echo $school_setting[0]->School_Code; ?></span>
				</td>
			</tr>
		</table><hr />
		
		<table class='table stu_details'>
			<tr>
			  <th>Registration No.</th>
			  <th>:</th>
			  <td><?php echo $stuData[0]['REGNO']; ?></td>
			  <th>Class-Sec</th>
			  <th>:</th>
			  <td><?php echo $stuData[0]['CLASS'].'-'.$stuData[0]['SEC']; ?></td>
			</tr>
			
			<tr>
			  <th>Roll No.</th>
			  <th>:</th>
			  <td><?php echo $stuData[0]['ROLLNO']; ?></td>	
			  <th>Student's Name</th>
			  <th>:</th>
			  <td><?php echo $stuData[0]['STUDENT_NAME']; ?></td>
			</tr>
			
			<tr>
			  <th>Mother's Name</th>
			  <th>:</th>
			  <td><?php echo $stuData[0]['MNAME']; ?></td>
			  <th>Father's Name</th>
			  <th>:</th>
			  <td><?php echo $stuData[0]['FNAME']; ?></td>
			</tr>
			
			<tr>
			  <th>Date of Birth</th>
			  <th>:</th>
			  <td><?php echo date('d-M-Y',strtotime($stuData[0]['DOB'])); ?></td>
			  <th>Blood Group</th>
			  <th>:</th>
			  <td><?php echo $stuData[0]['Blood_Group']; ?></td>
			</tr>
	    </table><br />
	<!-- end header -->
		<table border='1' cellspacing='0'>
			<tr>
				<th style='background:#201542; color:#fff;'><center>SUBJECTS</center></th>
				<th style='background:#201542; color:#fff;' colspan='2' align='center'>MID TERM</th>
				<th style='background:#201542; color:#fff;' colspan='2' align='center'>END TERM</th>
			</tr>
			<tr>
				<td></td>
				<td>TOTAL MARKS 100</td>
				<td>GRADES</td>
				<td>TOTAL MARKS 100</td>
				<td>GRADES</td>
			</tr>
			<!-- english -->
			<tr>
				<th style='text-align:left; background:#EAEDED;' colspan='5'>ENGLISH</th>
			</tr>
			<tr>
				<td style='background:#EAEDED;'>READING SKILLS</td>
				<td></td>
				<td><?php echo $stuData[0]['S1_T1_RS']; ?></td>
				<td></td>
				<td><?php echo $stuData[0]['S1_T2_RS']; ?></td>
				</tr>
			<tr>
				<td style='background:#EAEDED;'>SPELLINGS</td>
				<td></td>
				<td><?php echo $stuData[0]['S1_T1_SPL']; ?></td>
				<td></td>
				<td><?php echo $stuData[0]['S1_T2_SPL']; ?></td>
			</tr>
			<tr>
				<td style='background:#EAEDED;'>PROJECT</td>
				<td></td>
				<td><?php echo $stuData[0]['S1_T1_PRJ']; ?></td>
				<td></td>
				<td><?php echo $stuData[0]['S1_T2_PRJ']; ?></td>
			</tr>
			<tr>
				<td style='background:#EAEDED;'>WRITTEN WORK</td>
				<td><?php echo round($stuData[0]['S1_T1_100'], 0); ?></td>
				<td><?php echo $stuData[0]['S1_T1_GR']; ?></td>
				<td><?php echo $stuData[0]['S1_T2_100']; ?></td>
				<td><?php echo $stuData[0]['S1_T2_GR']; ?></td>
			</tr>
			<!-- end english -->
			
			<!-- hindi -->
			<tr>
				<th style='text-align:left; background:#EAEDED;' colspan='5'>HINDI</th>
			</tr>
			<tr>
				<td style='background:#EAEDED;'>READING SKILLS</td>
				<td></td>
				<td><?php echo $stuData[0]['S2_T1_RS']; ?></td>
				<td></td>
				<td><?php echo $stuData[0]['S2_T2_RS']; ?></td>
			</tr>
			<tr>
				<td style='background:#EAEDED;'>SPELLINGS</td>
				<td></td>
				<td><?php echo $stuData[0]['S2_T1_SPL']; ?></td>
				<td></td>
				<td><?php echo $stuData[0]['S2_T2_SPL']; ?></td>
			</tr>
			<tr>
				<td style='background:#EAEDED;'>PROJECT</td>
				<td></td>
				<td><?php echo $stuData[0]['S2_T1_PRJ']; ?></td>
				<td></td>                    
				<td><?php echo $stuData[0]['S2_T2_PRJ']; ?></td>
			</tr>
			<tr>
				<td style='background:#EAEDED;'>WRITTEN WORK</td>
				<td><?php echo round($stuData[0]['S2_T1_100'], 0); ?></td>
				<td><?php echo $stuData[0]['S2_T1_GR']; ?></td>
				<td><?php echo $stuData[0]['S2_T2_100']; ?></td>
				<td><?php echo $stuData[0]['S2_T2_GR']; ?></td>
			</tr>
			<!-- end hindi -->
					
			<!-- Maths -->
			<tr>
				<th style='text-align:left; background:#EAEDED;' colspan='5'>MATHEMATICS</th>
			</tr>
			<tr>
				<td style='background:#EAEDED;'>PROJECT</td>
				<td></td>
				<td><?php echo $stuData[0]['S3_T1_PRJ']; ?></td>
				<td></td>                    
				<td><?php echo $stuData[0]['S3_T2_PRJ']; ?></td>
			</tr>
			<tr>
				<td style='background:#EAEDED;'>TABLES</td>
				<td></td>
				<td><?php echo $stuData[0]['S3_T1_TBL']; ?></td>
				<td></td>
				<td><?php echo $stuData[0]['S3_T2_TBL']; ?></td>
			</tr>
			<tr>
				<td style='background:#EAEDED;'>WRITTEN WORK</td>
				<td><?php echo round($stuData[0]['S3_T1_100'], 0); ?></td>
				<td><?php echo $stuData[0]['S3_T1_GR']; ?></td>
				<td><?php echo $stuData[0]['S3_T2_100']; ?></td>
				<td><?php echo $stuData[0]['S3_T2_GR']; ?></td>
			</tr>
			<!-- end maths -->
			
			<!-- EVS -->
			<tr>
				<th style='text-align:left; background:#EAEDED;' colspan='5'>HEALTH & PHYSICAL EDUCATION</th>
			</tr>
			<tr>
				<td style='background:#EAEDED;'>PROJECT</td>
				<td></td>
				<td><?php echo $stuData[0]['S4_T1_PRJ']; ?></td>
				<td></td>                    
				<td><?php echo $stuData[0]['S4_T2_PRJ']; ?></td>
			</tr>
			<tr>
				<td style='background:#EAEDED;'>WRITTEN WORK</td>
				<td><?php echo round($stuData[0]['S4_T1_100'], 0); ?></td>
				<td><?php echo $stuData[0]['S4_T1_GR']; ?></td>
				<td><?php echo $stuData[0]['S4_T2_100']; ?></td>
				<td><?php echo $stuData[0]['S4_T2_GR']; ?></td>
			</tr>
			<!-- end HPE -->
		
			
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
			<!-- game -->
			<tr>
				<th style='text-align:left; background:#EAEDED;' colspan='3'>GAMES</th>
			</tr>
			<tr>
				<td>ENTHUSIASM</td>
				<td><?php echo $stuData[0]['S5_T1_ENT']; ?></td>
				<td><?php echo $stuData[0]['S5_T2_ENT']; ?></td>
			</tr>
			<tr>
				<td>HEIGHT (CM)</td>
				<td><?php echo $stuData[0]['S5_T1_HT']; ?></td>
				<td><?php echo $stuData[0]['S5_T2_HT']; ?></td>
			</tr>
			<tr>
				<td>WEIGHT (KG)</td>
				<td><?php echo $stuData[0]['S5_T1_WT']; ?></td>
				<td><?php echo $stuData[0]['S5_T2_WT']; ?></td>
			</tr>
			<!-- end game -->
			
			<!-- art & craft -->
			<tr>
				<th style='text-align:left; background:#EAEDED;' colspan='3'>ART & CRAFT</th>
			</tr>
			<tr>
				<td>ART & CRAFT</td>
				<td><?php echo $stuData[0]['S6_T1_ART']; ?></td>
				<td><?php echo $stuData[0]['S6_T2_ART']; ?></td>
			</tr>
			<!-- end art & craft -->
			
			<!-- music -->
			<tr>
				<th style='text-align:left; background:#EAEDED;' colspan='3'>MUSIC</th>
			</tr>
			<tr>
				<td>MUSIC</td>
				<td><?php echo $stuData[0]['S7_T1_MUSIC']; ?></td>
				<td><?php echo $stuData[0]['S7_T2_MUSIC']; ?></td>
			</tr>
			<!-- end music -->
			
			</table>
		<table style='width:100%' border='1' cellspacing='0'>
			<tr>
				<th style='background:#201542; color:#fff;' colspan='2'>REMARKS</th>
			</tr>
			<tr>
				<td>MID TERM</td>
				<td>END TERM</td>
			</tr>
			<tr>
				<td ><?php echo $stuData[0]['T1_REMARKS']; ?></td>
				<td ><?php echo $stuData[0]['T2_REMARKS']; ?></td>
			</tr>
			<tr>
				<td ><br/></td>
				<td ><br/></td>
			</tr>
			<tr>
				<td ><br/></td>
				<td ><br/></td>
			</tr>
			<tr>
				<td>Attendance: <?php echo $stuData[0]['T1_DP'].' / '.$stuData[0]['T1_TDAYS']; ?></td>
				<td>Attendance: <?php echo $stuData[0]['T2_DP'].' / '.$stuData[0]['T2_TDAYS']; ?></td>
			</tr>
			
			<tr>
				<th style='background:#201542; color:#fff;' colspan='2'>Congratulations....!!!! Promoted to <?php echo $stuData[0]['PROMOTED_CLASS']; ?></th>
			</tr>
			<tr>
				<th style='background:#201542; color:#fff;' colspan='2'>New Session Begins on: <?php echo date('d-M-y',strtotime($stuData[0]['Session_Start_Date'])); ?></th>
				</tr>
			
		</table>
		<table style="width:113%;" class='clear sign'>
			<tr>
				<td><br /><br /><br /><br /><br /></td>
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
	</body>
</html>