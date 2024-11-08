<html>
  <title>Report Card(IX)</title>
  <head>
    <link rel="stylesheet" href="<?php echo base_url('assets/dash_css/bootstrap.min.css'); ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	
	<style> 
	  .table > thead > tr > th,
	  .table > tbody > tr > th,
	  .table > tfoot > tr > th,
	  .table > thead > tr > td,
	  .table > tbody > tr > td,
	  .table > tfoot > tr > td {
			font-size:10px;
			padding:3px !important;
			text-align:center;
	   }
	   @media print {
		   padding-top:0px;
	   }
	   .page-break{
			page-break-before:always;
		} 
	</style>
  </head>
  
  <body>
    <?php
	  if (isset($selected_stu)) {
		$gg = 1;
		$tot_rec = count($selected_stu);
	  foreach($selected_stu as $key => $val){

		  $stu_data = $this->alam->selectA('student','ADM_NO,DISP_CLASS,CLASS,DISP_SEC,SEC,ROLL_NO,FIRST_NM,MIDDLE_NM,MOTHER_NM,FATHER_NM,BIRTH_DT,JUNE_ATT,JULY_ATT,promot',"ADM_NO='$val' AND Student_Status='ACTIVE'");
		  
		  $ADM_NO     = $stu_data[0]['ADM_NO'];
		  $DISP_CLASS = $stu_data[0]['DISP_CLASS'];
		  $CLASS      = $stu_data[0]['CLASS'];
		  $DISP_SEC   = $stu_data[0]['DISP_SEC'];
		  $SEC        = $stu_data[0]['SEC'];
		  $ROLL_NO    = $stu_data[0]['ROLL_NO'];
		  $FIRST_NM   = $stu_data[0]['FIRST_NM'];
		  $MIDDLE_NM  = $stu_data[0]['MIDDLE_NM'];
		  $MOTHER_NM  = $stu_data[0]['MOTHER_NM'];
		  $FATHER_NM  = $stu_data[0]['FATHER_NM'];
		  $BIRTH_DT   = $stu_data[0]['BIRTH_DT'];
		 $working_attendance= $stu_data[0]['JUNE_ATT'];
		  $present_day = $stu_data[0]['JULY_ATT'];
		  $promote = $stu_data[0]['promot'];
		  //attendance'
			$BIRTH_DT = date("d-M-Y", strtotime($BIRTH_DT));
		  if($working_attendance=='0')
		  {
			  $final_att = '0';
		  }
		  else
		  {
			  $final_att = number_format(($present_day/$working_attendance)*100,2);
		  }
		  
		    $grd        = $this->alam->annual_report_card_student_detail2($class,$sec,$val);
	     
		  $t1_skill_1 = $grd[0]->t1_skill_1;
		  $t1_skill_2 = $grd[0]->t1_skill_2;
		  $t1_skill_3 = $grd[0]->t1_skill_3;
		  $t1_dis_grd = $grd[0]->t1_dis_grd;
		  $t1_rmks    = $grd[0]->t1_rmks;
		  $t2_skill_1 = $grd[0]->t2_skill_1;
		  $t2_skill_2 = $grd[0]->t2_skill_2;
		  $t2_skill_3 = $grd[0]->t2_skill_3;
		  $t2_dis_grd = $grd[0]->t2_dis_grd;
		  $t2_rmks    = $grd[0]->t2_rmks;
		  
		  $t1_dis_skill_1_grd = $grd[0]->t1_dis_skill_1_grd;
		  $t1_dis_skill_2_grd = $grd[0]->t1_dis_skill_2_grd;
		  $t1_dis_skill_3_grd = $grd[0]->t1_dis_skill_3_grd;
		  $t1_dis_skill_4_grd = $grd[0]->t1_dis_skill_4_grd;
		  $t2_dis_skill_1_grd = $grd[0]->t2_dis_skill_1_grd;
		  $t2_dis_skill_2_grd = $grd[0]->t2_dis_skill_2_grd;
		  $t2_dis_skill_3_grd = $grd[0]->t2_dis_skill_3_grd;
		  $t2_dis_skill_4_grd = $grd[0]->t2_dis_skill_4_grd;
		  
		  $grd        = $this->alam->annual_report_card_student_detail2($class,$sec,$val);
	     
		  $t1_skill_1 = $grd[0]->t1_skill_1;
		  $t1_skill_2 = $grd[0]->t1_skill_2;
		  $t1_skill_3 = $grd[0]->t1_skill_3;
		  $t1_dis_grd = $grd[0]->t1_dis_grd;
		  $t1_rmks    = $grd[0]->t1_rmks;
		  $t2_skill_1 = $grd[0]->t2_skill_1;
		  $t2_skill_2 = $grd[0]->t2_skill_2;
		  $t2_skill_3 = $grd[0]->t2_skill_3;
		  $t2_dis_grd = $grd[0]->t2_dis_grd;
		  $t2_rmks    = $grd[0]->t2_rmks;
		  
		  $t1_dis_skill_1_grd = $grd[0]->t1_dis_skill_1_grd;
		  $t1_dis_skill_2_grd = $grd[0]->t1_dis_skill_2_grd;
		  $t1_dis_skill_3_grd = $grd[0]->t1_dis_skill_3_grd;
		  $t1_dis_skill_4_grd = $grd[0]->t1_dis_skill_4_grd;
		  $t2_dis_skill_1_grd = $grd[0]->t2_dis_skill_1_grd;
		  $t2_dis_skill_2_grd = $grd[0]->t2_dis_skill_2_grd;
		  $t2_dis_skill_3_grd = $grd[0]->t2_dis_skill_3_grd;
		  $t2_dis_skill_4_grd = $grd[0]->t2_dis_skill_4_grd;
		  
		  
		  $grand_total = array();
	?>
	<div style='border:3px solid #000 !important; padding:5px 20px 0px 20px;'>
	<div class='row'>
		<div class="col-sm-3 col-xs-3">
		   <br />
			<img class="pull-right" src="<?php echo base_url($school_setting[0]->SCHOOL_LOGO); ?>" style="width:100px;width:100px;margin-right:50px;">
		</div>
		<div class='col-sm-6 col-xs-6'>
		  <center>
			<?php
			  echo "<h3>".$school_setting[0]->School_Name."</h3>";
			  echo $school_setting[0]->School_Address ."<br/>";
		  echo "<b>Affiliation No. - </b>".$school_setting[0]->School_AfftNo .",<b> School Code - </b>".$school_setting[0]->School_Code ."<br />";
			  echo "<b>ACADEMIC SESSION:</b> ".$school_setting[0]->School_Session;
			  
			  echo "<h4>REPORT CARD</h4>";
			?>
		  </center>
		</div>
		<div class="col-sm-3 col-xs-3"><br />
		<img src="<?php echo base_url($School_Logo); ?>" style="width:80px;height:80px;margin-top:7px;margin-left:50px;">
		</div>
    </div>
	<div class='row'>
	  <table class='table no_border'>
		<tr>
		  <th style='text-align:left; font-size:15px;'>Admission No.</th>
		  <th><b>:</b></th>
		  <td style='text-align:left; font-size:15px;'><?php echo $ADM_NO; ?></td>
		  <th style='text-align:left; font-size:15px;'>Class - Sec</th>
		  <th><b>:</b></th>
		  <td style='text-align:left; font-size:15px;'><?php echo $DISP_CLASS ." - " . $DISP_SEC; ?></td>
		  <th style='text-align:left; font-size:15px;'>Roll No.</th>
		  <th><b>:</b></th>
		  <td style='text-align:left; font-size:15px;'><?php echo $ROLL_NO; ?></td>
		  <td></td>
		</tr>
		
		<tr>
		  <th style='text-align:left; font-size:15px;'>Student's Name </th>
		  <th><b>:</b></th>
		  <td style='text-align:left; font-size:15px;'><?php echo $FIRST_NM . " " . $MIDDLE_NM; ?></td>
		  <th style='text-align:left; font-size:15px;'>Date of Birth </th>
		  <th><b>:</b></th>
		  <td style='text-align:left; font-size:15px;'><?php echo $BIRTH_DT; ?></td>
		  <th style='text-align:left; font-size:15px;'>Attendance</th>
		  <th><b>:</b></th>
		  <td style='text-align:left; font-size:15px;'><?php echo $final_att."%"; ?></td>
		  <td></td>
		</tr>
		
		<tr>
		  <th style='text-align:left; font-size:15px;'>Mother's Name </th>
		  <th><b>:</b></th>
		  <td colspan='1' style='text-align:left; font-size:15px;'><?php echo $MOTHER_NM; ?></td>
		  <th style='text-align:left; font-size:15px;'>Father's Name </th>
		  <th><b>:</b></th>
		  <td colspan='5' style='text-align:left; font-size:15px;'><?php echo $FATHER_NM; ?></td>
		</tr>
	  </table>
	</div>
    <div class='row'>	
    <table border='1' class='table'>
	<thead style='font-weight:700'>
		<tr>
	    <td colspan='2'; rowspan='2' style="vertical-align:middle;">SUBJECT NAME</td>
		<td style='border-top:1px solid black; vertical-align:middle;' colspan='6' >PERIODIC TEST</td>
		
		<td>Avg. of Best 2 of</td>
		<td>Sub. Enrichment</td>
		  <td>Multiple</td>
		  <td>Portfolio</td>
		<td>Annual</td>
		<td>Marks</td>
		<td></td>
	  </tr>
	  <tr>
	  <tr>
	   <td style='border-top:1px solid black' colspan='2'></td>
		<td colspan='2'>PT-I</td>
		<td colspan='2'>PT-II</td>
		<td colspan='2'>PT-III</td>
		<td> (A, B & C)</td>
		<td>Activity</td>
		  <td>Assessment</td>
		  <td>Portfolio</td>
		<td>Exam</td>
		<td>Obtained</td>
		<td>Grade</td>
	  </tr>
	  <tr>
		<td style='border-top:1px solid black' colspan='2'></td>
		  
		<td style='border-top:1px solid black'>MM: 20</td>
		<td style='border-top:1px solid black'>MO: 05 <br/>[A]</td>
		<td style='border-top:1px solid black'>MM: 80</td>
		<td style='border-top:1px solid black'>MO: 05 <br/>[B]</td>
		<td style='border-top:1px solid black'>MM: 20</td>
		<td style='border-top:1px solid black'>M0: 05 <br/>[C]</td>
		<td style='border-top:1px solid black'>MM: 05 <br/><br/>[D]</td>
		  <td style='border-top:1px solid black'>MM: 05 <br/><br/>[E]</td>
		  <td style='border-top:1px solid black'>MM: 05<br/><br/> [F]</td>
		  <td style='border-top:1px solid black'>MM: 05 <br/><br/>[G]</td>
		<td style='border-top:1px solid black'>MM: 80<br/><br/> [H]</td>
		<td style='border-top:1px solid black'>100<br/><br/> [I]</td>
		<td style='border-top:1px solid black'></td>
	  </tr>
	  </thead>
	  <tbody>
	 
	    <!-- term-1 -->
		<?php
			$bestOfTwo = array();
		  $ttl=0;
		    foreach($subjectData as $key2 => $val2){
				$pt1wtgm1res = 0;
				$pt1wtgm1 = 0;
				$pt1m2 = 0;
				$pt2wtgm1res = 0;
				$pt2wtgm1 = 0;
				$pt2m2 = 0;
				$pt3wtgm1res = 0;
				$pt3wtgm1 = 0;
				$pt3m2 = 0;
				$addTwo = 0;
				$nbwtgm1res = 0;
				$nbwtgm1 = 0;
				$nbm2 = 0;
				$sewtgm1res = 0;
				$sewtgm1 = 0;
				$sem2 = 0;
				$APwtgm1res = 0;
				$APwtgm1 = 0;
				$APm2 = 0;
				$stwtgm1res = 0;
				$stwtgm1 = 0;
				$stm2 = 0;
				$subjGandTot = 0;
				$pt1m3 = 0;
				$pt2m3 = 0;
				$pt3m3 = 0;
				$nbm3 = 0;
				$sem3 = 0;
				$stm3 = 0;
				$artgr = 0;
				$musicgr=0;
				
				if($val2['opt_code'] == 2){
					$check_student_subject = $this->sumit->checkData('*','studentsubject',array('Adm_no'=>$val,'Class'=>$class,'SUBCODE'=>$val2['subject_code']));
				}else{
					 $check_student_subject = true;
				}
				
				//pt1
				
				$artgr = $this->alam->selectA('co_scholastic_grade','Grade',"SkillCode='2' AND Adm_no='$val'");
				if(empty($pt1)){					
						$artgr='-';
				}

				if(!empty($pt1)){
					$pt1m1 = $pt1[0]['M1'];
					$pt1m2 = $pt1[0]['M2'];
					$pt1m3 = $pt1[0]['M3'];
					$pt1wtgm1res = ($pt1m3*100)/$pt1m1;
					$pt1wtgm1 = ($round==1)?round(($pt1wtgm1res*5)/100):number_format(($pt1wtgm1res*5)/100,2);
				}
				
				
				
				$pt1 = $this->alam->selectA('marks','M1,M2,M3',"Term='TERM-1' AND ExamC='1' AND SCode='".$val2['subject_code']."' AND admno='$val'");
				

				if(!empty($pt1)){
					$pt1m1 = $pt1[0]['M1'];
					$pt1m2 = $pt1[0]['M2'];
					$pt1m3 = $pt1[0]['M3'];
					$pt1wtgm1res = ($pt1m3*100)/$pt1m1;
					$pt1wtgm1 = ($round==1)?round(($pt1wtgm1res*5)/100):number_format(($pt1wtgm1res*5)/100,2);
				}
				
				//pt2
				$pt2 = $this->alam->selectA('marks','M1,M2,M3',"Term='TERM-1' AND ExamC='4' AND SCode='".$val2['subject_code']."' AND admno='$val'");
			
				if(!empty($pt2)){
					$pt2m1 = isset($pt2[0]['M1'])?$pt2[0]['M1']:0;
					$pt2m2 = isset($pt2[0]['M2'])?$pt2[0]['M2']:0;
					$pt2m3 = isset($pt2[0]['M3'])?$pt2[0]['M3']:0;
					$pt2wtgm1res = ($pt2m3*100)/$pt2m1;
					$pt2wtgm1 = ($round==1)?round(($pt2wtgm1res*5)/100):number_format(($pt2wtgm1res*5)/100,2);
				}
				
				//pt3
				$pt3 = $this->alam->selectA('marks','M1,M2,M3',"Term='TERM-2' AND ExamC='8' AND SCode='".$val2['subject_code']."' AND admno='$val'");
			
				if(!empty($pt3)){
					$pt3m1 = isset($pt3[0]['M1'])?$pt3[0]['M1']:0;
					$pt3m2 = isset($pt3[0]['M2'])?$pt3[0]['M2']:0;
					$pt3m3 = isset($pt3[0]['M3'])?$pt3[0]['M3']:0;
					$pt3wtgm1res = ($pt3m3*100)/$pt3m1;
					$pt3wtgm1 = ($round==1)?round(($pt3wtgm1res*5)/100):number_format(($pt3wtgm1res*5)/100,2);
				}
					
				//avg of best of 2
				$mark = array($pt1wtgm1,$pt2wtgm1,$pt3wtgm1);
				rsort($mark);

				$mark[1] = isset($mark[1])?$mark[1]:0;
				$mark[0] = isset($mark[0])?$mark[0]:0;
				$addTwo = ($mark[1] + $mark[0])/2;
				$addTwo_vl=$addTwo;
				
				//NB
				$nb = $this->alam->selectA('marks','M1,M2,M3',"Term='TERM-2' AND ExamC='2' AND SCode='".$val2['subject_code']."' AND admno='$val'");
			
				if(!empty($nb)){
					$nbm1 = isset($nb[0]['M1'])?$nb[0]['M1']:0;
					$nbm2 = isset($nb[0]['M2'])?$nb[0]['M2']:0;
					$nbm3 = isset($nb[0]['M3'])?$nb[0]['M3']:0;
					$nbwtgm1res = ($nbm3*100)/$nbm1;
					$nbwtgm1 = ($round==1)?round(($nbwtgm1res*5)/100):number_format(($nbwtgm1res*5)/100,2);
				}
				
				//SE
				$se = $this->alam->selectA('marks','M1,M2,M3',"Term='TERM-2' AND ExamC='3' AND SCode='".$val2['subject_code']."' AND admno='$val'");
				if(!empty($se)){
					$sem1 = isset($se[0]['M1'])?$se[0]['M1']:0;
					$sem2 = isset($se[0]['M2'])?$se[0]['M2']:0;
					$sem3 = isset($se[0]['M3'])?$se[0]['M3']:0;
					$sewtgm1res = ($sem3*100)/$sem1;
					$sewtgm1 = ($round == 1)?round(($sewtgm1res*5)/100):number_format(($sewtgm1res*5)/100,2);
				}
				//echo "sem1: ".$sem1; 
				//echo "<br/>";
				//echo "sem2: ".$sem2; 
				//echo "<br/>";
				//echo "sem3: ".$sem3; 
				//echo "<br/>";
				//echo "sewtgm1res: ".$sewtgm1res; 
				//echo "<br/>";
				//echo "sewtgm1: ".$sewtgm1; 
				//echo "<br/>";
				//die;
				//AP
				$AP = $this->alam->selectA('marks','M1,M2,M3',"Term='TERM-2' AND ExamC='6' AND SCode='".$val2['subject_code']."' AND admno='$val'");
			
				if(!empty($AP)){
					$APm1 = isset($AP[0]['M1'])?$AP[0]['M1']:0;
					$APm2 = isset($AP[0]['M2'])?$AP[0]['M2']:0;
					$APm3 = isset($AP[0]['M3'])?$AP[0]['M3']:0;
					$APwtgm1res = ($APm3*100)/$APm1;
					$APwtgm1 = ($round == 1)?round(($APwtgm1res*5)/100):number_format(($APwtgm1res*5)/100,2);
				}
				
				//echo "AP1: ".$APm1; 
				//echo "<br/>";
				//echo "AP2: ".$APm2; 
				//echo "<br/>";
				//echo "AP3: ".$APm3; 
				//echo "<br/>";
				//echo "APwtgm1res: ".$APwtgm1res; 
				//echo "<br/>";
				//echo "APwtgm1: ".$APwtgm1; 
				//echo "<br/>";
				//die;
				//second term
				$st = $this->alam->selectA('marks','M1,M2,M3',"Term='TERM-2' AND ExamC='5' AND SCode='".$val2['subject_code']."' AND admno='$val'");
				
				if(!empty($st)){
					$stm1 = isset($st[0]['M1'])?$st[0]['M1']:0;
					$stm2 = isset($st[0]['M2'])?$st[0]['M2']:0;
					$stm3 = isset($st[0]['M3'])?$st[0]['M3']:0;
					$stwtgm1res = ($stm3*100)/$stm1;
					$stwtgm1 = ($round==1)?round(($stwtgm1res*80)/100):number_format(($stwtgm1res*80)/100,2);
				}
				//echo "stm1: ".$stm1; 
				//echo "<br/>";
				//echo "stm2: ".$stm2; 
				//echo "<br/>";
				//echo "stm3: ".$stm3; 
				//echo "<br/>";
				//echo "stwtgm1res: ".$stwtgm1res; 
				//echo "<br/>";
				//echo "stwtgm1: ".$stwtgm1; 
				//echo "<br/>";
				$subjGandTot = $addTwo_vl+$stwtgm1+$APwtgm1+$sewtgm1+$nbwtgm1;
				//echo "subjGandTot: ".$subjGandTot; die;
				$fin_grade = 0;
				foreach($grademaster as $key => $grade){
					if($grade->ORange >=$subjGandTot && $grade->CRange <=$subjGandTot){
						$fin_grade = $grade->Grade;
						break;
					}
				}
				
				if($check_student_subject){
					?>
					<tr>
						<td colspan='2' style='text-align:left'>
							<?php 
									if($val2['subj_nm']=='COMPUTER')
									{
										echo 'I.T.'; 
									}
									else
									{
										echo $val2['subj_nm']; 
									}
								?></td>
						<td>
							<span>
								<?php 
								if($val2['opt_code'] != 1){
									echo ($round==1)?round($pt1m3):number_format($pt1m3,2);	
									// if($val2['subject_code'] != '7'){
									// 	echo ($round==1)?round($pt1m3):number_format($pt1m3,2);	
									// }else{
									// 	echo ($round==1)?round($pt1m3/4):number_format(($pt1m3/4),2);	
									// }
								}
								?>
							</span>
						</td>
						
						<td>
							<span>
								<?php 
								if($val2['opt_code'] != 1){
									echo $pt1wtgm1; 
								}
								?>
							</span>
						</td>
						
						<td>
							<span>
								<?php 
								if($val2['opt_code'] != 1){
									echo ($round==1)?round($pt2m3):number_format($pt2m3,2);
								}
								?>
							</span>
						</td>
						
						<td>
							<span>
								<?php 
								if($val2['opt_code'] != 1){
									echo $pt2wtgm1; 
								}
								?>
							</span>	
						</td>
					<td>
							<span>
								<?php 
								if($val2['opt_code'] != 1){	
									echo $pt3m3;
									// if($val2['subject_code'] != '7'){
									// 	echo ($round==1)?round($pt3m3):number_format($pt3m3,2); 
									// }else{
									// 	echo "";
									// }
								}
								?>
							</span>
						</td>
						<td>
							<span>
								<?php 
								if($val2['opt_code'] != 1){
									echo $pt3wtgm1; 
									// if($val2['subject_code'] != '7'){
									// 	echo $pt3wtgm1; 
									// }else{
									// 	echo "";
									// }
								}
								?>
							</span>
						</td>
						
						<td>
							<span>
								<?php 
								if($val2['opt_code'] != 1){
									echo ($round==1)?round($addTwo_vl):number_format($addTwo_vl,2); 
								}
								?>
							</span>
						</td>
						
					<td>
							<span>
								<?php echo ($nbm2 != 'AB')?$nbwtgm1:'AB'; ?>
							</span>
						</td>
						
						<td>
							<span>
								<?php echo ($sem2 != 'AB')?$sewtgm1:'AB'; ?>
							</span>
						</td>
						
						<td>
							<span>
								<?php echo ($APm2 != 'AB')?$APwtgm1:'AB'; ?>
							</span>
						</td>
						
						<td>
							<span>
								<?php echo ($stm2 != 'AB')?$stwtgm1:'AB'; ?>
							</span>
						</td>
						
						<td>
							<span>
								<?php //echo ($round==1)?round($subjGandTot):number_format($subjGandTot,2); ?>

								<?php echo round($addTwo_vl)+round($stwtgm1)+round($APwtgm1)+round($sewtgm1)+round($nbwtgm1); 
					if($val2['subject_code'] != 7){
								$ttl +=round($addTwo_vl)+round($stwtgm1)+round($APwtgm1)+round($sewtgm1)+round($nbwtgm1);
					}
								?>
							</span>
						</td>
						
						<td>
							<span>
								<?php echo $fin_grade; ?>
							</span>
						</td>
					</tr>	
					<?php
				}
				
		    }
		?>	
		  
		  
		 
	 <tr>
		  
			
			<td colspan='13' style='border-top:1px solid black'><b  style='float:right;'>Grand Total &nbsp;&nbsp;&nbsp; </b></td>
		
			<td style='border-top:1px solid black'><b><?php echo $ttl;?></b></td>
			<td style='border-top:1px solid black'>
			<?php  $subjGandTot_g = $ttl/5;
			
				$fin_grade = 0;
				foreach($grademaster as $key => $grade){
					if($grade->ORange >=$subjGandTot_g && $grade->CRange <=$subjGandTot_g){
						echo "<b>".$fin_grade = $grade->Grade."</b>";
						break;
					}
				}?>
			
			</td>
		</tr>
		 <tr>
		
			
			
			<td colspan='13' style='border-top:1px solid black'><b  style='float:right;'>Overall Percentage &nbsp;&nbsp;&nbsp; </b></td>
		
			<td style='border-top:1px solid black'><b>
				<?php  $subjGandTot_per = $ttl/5;
			echo "<b>".$subjGandTot_per."%"."</b>";
				
				?>
			</b></td>
			<td>
			
			
			</td>
		</tr>
	  </tbody>
	</table>
		 <div class='row'>
		<div class='col-sm-12 col-xs-12'>
	  <table class='table' border='1'>
	    <tr>
		  <th style='text-align:center; font-size:15px;'>The grand total is excluding IT.</th>
	    </tr>
		
	  </table>
	</div>
	</div>
	  <div class='row'>
				    <div class='col-xs-12'>
					  <table class='table' border='1' style="width:100%">
						<tr >
							  <th style="vertical-align:middle; text-align: center; border: 1.5px solid black;padding: 5!important;!important">Co-Scholastic Areas :</th>
						  <th style="vertical-align:middle; text-align: center; border: 1.5px solid black;padding: 5!important;">Grade</th>
						 
						</tr>
					
						  
						
						<tr>
						 <th style='text-align:left !important'>Art</th>
						 <td style='text-align:center !important'><?php echo $grd[0]->t2_skill_2; ?></td>
						</tr>
						<tr>
						 <th style='text-align:left !important'>Music</th>
						 <td style='text-align:center !important'><?php echo $grd[0]->t2_skill_1; ?></td>
						</tr>
						  
							
						
						  
					  </table>
					</div>
					
					
				  </div>
	  <div class='row'>
		<div class='col-sm-12 col-xs-12'>
	  <table class='table' border='1'>
	    <tr>
		  <th style='text-align:left; font-size:15px;'>Promoted to/Detained to:</th>
			<th style='text-align:left; font-size:15px;'><?php { echo $promote; } 		  ?></th>
	    </tr>
		   <tr>
		  <th style='text-align:left; font-size:15px;'>New session commences from:</th>
			   <th style='text-align:left; font-size:15px;'>10-Apr-2023</th>
	    </tr>
		
	  </table>
	</div>
	</div>
	<div class='row'>
		<div class='col-sm-12 col-xs-12'>
	  <table class='table' border='1'>
	    <tr>
		  <th style='text-align:left; font-size:15px;'>Class Teacher's Remarks:</th>
	    </tr>
		<tr>
		  <td style='height:100px; font-size:13px; text-align:justify'>
		  <?php 
			if($t2_rmks !=''){
				echo $FIRST_NM.' '.$t2_rmks; 
			}
		  ?></td>
		</tr>
	  </table>
	</div>
	</div>
	</div>
	<!-- signature -->
	<div class='row sign'>
		
	
		<div class='col-sm-3 col-xs-3'><center><b><br/><br/>PARENT<br/>SIGNATURE</b></center></div>
		<div class='col-sm-3 col-xs-3'><center><b><br/><br/>CLASS TEACHER<br/>SIGNATURE</b></center></div>
		<div class='col-sm-3 col-xs-3'><center><b><br/><br/>SECTION  INCHARGE<br/>SIGNATURE</b></center></div>
		<div class='col-sm-3 col-xs-3'>
			<!--<center><br /><img style='width:50px; position:absolute; bottom: 25px;'src='<?php //echo base_url($sign); ?>'></center>-->
			<center><b><br/><br/>PRINCIPAL<br/>SIGNATURE</b></center>
		</div>
	</div>
	<!-- end signature -->
	</div>.<?php
			if($tot_rec > $gg++){?>
				<div style='page-break-after: always;'></div>
			<?php } ?>
	<?php }
	} ?>
	
</body>

</html>