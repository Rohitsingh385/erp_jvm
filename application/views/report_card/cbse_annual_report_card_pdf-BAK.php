<html>
  <title>Report Card</title>
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
			padding:1px !important;
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
		  $working_attendance= $stu_data[0]['JULY_ATT'];
		  $present_day = $stu_data[0]['JUNE_ATT'];
		  //attendance
		  $final_att = number_format(($present_day/$work_day)*100,2);
		 
		
		  
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
		   <img class="pull-right" src="<?php echo base_url($School_Logo); ?>" style="width:100px;">
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
		<div class="col-sm-3 col-xs-3">
		  <img src="<?php echo base_url($school_setting[0]->SCHOOL_LOGO); ?>" style="width:100px;">
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
		  <td style='text-align:left; font-size:15px;'><?php //echo $final_att."%"; ?></td>
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
	<thead>
	  <tr>
		<th>Scholastic Areas:</th>
		<th  colspan='4'>Term-I (100 Marks)</th>
		<th colspan='4'>Term-II (100 Marks)</th>
		<th colspan='4'>Term-I+Term-II (100 Marks)</th>
		
	  </tr>
	  <tr>
	    <td>Subject Name</td>
		<td>PERIODIC TEST-I (20)</td>
		<td>MID TERM (80)</td>
		<td>HALF YEARLY TOTAL (100)</td>
		<td>GRADE</td>
		
		<td>PERIODIC TEST-II (20)</td>
		<td>ANNUAL EXAM (80)</td>
		<td>ANNUAL TOTAL (100)</td>
		<td>GRADE</td>
		<td>GRAND TOTAL (100)</td>
		<td>GRADE</td>
	  </tr>
	  </thead>
	  <tbody>
	  <tr>
	    <!-- term-1 -->
		  <?php
		    $mo = '';
			$subj_mrks = array();
			$fin_tot_mo_tot = 0;
		    foreach($subjectData as $key2 => $val2){
			    $subj_code = $val2['subject_code'];
				$pt_type   = $val2['pt_type'];
				if($val2['opt_code'] == 2){
					
					$check_student_subject = $this->sumit->checkData('*','studentsubject',array('Adm_no'=>$val,'Class'=>$class,'SUBCODE'=>$val2['subject_code']));
				}else{
					
					 $check_student_subject = true;
				}
				$final_marks = array();
				if($check_student_subject){
                   $examcodeT1 = array('1','4');
                   $examcodeT2 = array('1','5');
				   
                   foreach($examcodeT1 as $key3 => $val3){

                   	$examC = ($val3==1)?"1,7,8":$val3;
					$wetageData = $this->alam->selectA('exammaster','wetage1',"ExamCode = '$val3'");
					$wetage1 = $wetageData[0]['wetage1'];
					
					$marksData = $this->alam->selectA('marks','*',"admno = '$val' AND Term = 'TERM-1' AND Classes = '$CLASS' AND ExamC IN ($examC) AND SCode = '$subj_code'");
					$mark   = array();
					$absent = array();
					if($val3 == 1){
					//check PT//
					if($pt_type == 1){
						foreach ($marksData as $key4 => $value4) {

							$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetage1;
							$absent[$key4] = $value4['M2'];
						}
						$absent_count = count($absent);
						$total_ab_count = array_count_values($absent);
						$total_ab_count['AB'] = (!isset($total_ab_count['AB']))?0:$total_ab_count['AB'];
						$ab = ($absent_count == $total_ab_count['AB'])?'AB':'0';
						$final_marks[$key3] = ($ab == 'AB')?$ab:number_format(max($mark),2);

					}
					elseif($pt_type == 2){						
						foreach ($marksData as $key4 => $value4) {

							$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetage1;
							$tot_per = $tot_per + $mark[$key4];
							$absent[$key4] = $value4['M2'];
						}
						$absent_count = count($absent);
						$total_ab_count = array_count_values($absent);
						$total_ab_count['AB'] = (!isset($total_ab_count['AB']))?0:$total_ab_count['AB'];
						$ab = ($absent_count == $total_ab_count['AB'])?'AB':'0';
						$final_marks[$key3] = ($ab == 'AB')?$ab:number_format($tot_per/3,2);
					}
					else{
						foreach ($marksData as $key4 => $value4) {

							$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetage1;
							$absent[$key4] = $value4['M2'];
						}
						
						rsort($mark);
						$mark[1] = isset($mark[1])?$mark[1]:0;
						$mark[0] = isset($mark[0])?$mark[0]:0;
						$two_sum = $mark[0] + $mark[1];
						$absent_count = count($absent);
						$total_ab_count = array_count_values($absent);
						$total_ab_count['AB'] = (!isset($total_ab_count['AB']))?0:$total_ab_count['AB'];
						$ab = ($absent_count == $total_ab_count['AB'])?'AB':'0';
						$final_marks[$key3] = ($ab == 'AB')?$ab:number_format($two_sum/2,2);
					}

					$mo=($round==1)?round($final_marks[$key3]):$final_marks[$key3];
				    //end check PT//
					}else{
						if(!empty($marksData)){
							$M2 = $marksData[0]['M2'];
							$M3 = $marksData[0]['M3'];
							$M1 = $marksData[0]['M1'];
							//$mo = ($M2 == 'AB' || $M2 == '-')?$M2:(($round==1)?round(number_format(($M3/$M1)*$wetage1,2)):number_format(($M3/$M1)*$wetage1,2));
							if($val2['opt_code'] == 1){
								$mo = ($M2 == 'AB' || $M2 == '-')?$M2:($M3/$M1)*$wetage1;
							}else{
								$mo = ($M2 == 'AB' || $M2 == '-')?$M2:(($round==1)?round(number_format(($M3/$M1)*$wetage1,2)):number_format(($M3/$M1)*$wetage1,2));
							}
						}else{
							$mo = 0;
						}
					}
                    $subj_mrks[$val][$subj_code]['sub'] = $val2['subj_nm'];
					
                    $subj_mrks[$val][$subj_code]['mrks'][$val3] =  $mo;
					
				   }
                
                   //t2//
				foreach($examcodeT2 as $key3 => $val3){

                   	$examC = ($val3==1)?"1,7,8":$val3;
					$wetageData = $this->alam->selectA('exammaster','wetage1',"ExamCode = '$val3'");
					$wetage1 = $wetageData[0]['wetage1'];
					
					$marksData = $this->alam->selectA('marks','*',"admno = '$val' AND Term = 'TERM-2' AND Classes = '$CLASS' AND ExamC IN ($examC) AND SCode = '$subj_code'");
					//echo $this->db->last_query()."<br /><br />";
					$mark   = array();
					$absent = array();
					if($val3 == 1){
					//check PT//
					if($pt_type == 1){
						foreach ($marksData as $key4 => $value4) {

							$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetage1;
							$absent[$key4] = $value4['M2'];
						}
						$absent_count = count($absent);
						$total_ab_count = array_count_values($absent);
						$total_ab_count['AB'] = (!isset($total_ab_count['AB']))?0:$total_ab_count['AB'];
						$ab = ($absent_count == $total_ab_count['AB'])?'AB':'0';
						$final_marks[$key3] = ($ab == 'AB')?$ab:number_format(max($mark),2);

					}
					elseif($pt_type == 2){						
						foreach ($marksData as $key4 => $value4) {

							$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetage1;
							$tot_per = $tot_per + $mark[$key4];
							$absent[$key4] = $value4['M2'];
						}
						$absent_count = count($absent);
						$total_ab_count = array_count_values($absent);
						$total_ab_count['AB'] = (!isset($total_ab_count['AB']))?0:$total_ab_count['AB'];
						$ab = ($absent_count == $total_ab_count['AB'])?'AB':'0';
						$final_marks[$key3] = ($ab == 'AB')?$ab:number_format($tot_per/3,2);
					}
					else{
						foreach ($marksData as $key4 => $value4) {

							$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetage1;
							$absent[$key4] = $value4['M2'];
						}
						
						rsort($mark);
						$mark[1] = isset($mark[1])?$mark[1]:0;
						$mark[0] = isset($mark[0])?$mark[0]:0;
						$two_sum = $mark[0] + $mark[1];
						$absent_count = count($absent);
						$total_ab_count = array_count_values($absent);
						$total_ab_count['AB'] = (!isset($total_ab_count['AB']))?0:$total_ab_count['AB'];
						$ab = ($absent_count == $total_ab_count['AB'])?'AB':'0';
						$final_marks[$key3] = ($ab == 'AB')?$ab:number_format($two_sum/2,2);
					}

					$mo=($round==1)?round($final_marks[$key3]):($final_marks[$key3]);
				    //end check PT//
					}else{
						if(!empty($marksData)){
							$M2 = $marksData[0]['M2'];
							$M3 = $marksData[0]['M3'];
							$M1 = $marksData[0]['M1'];
							//$mo = ($M2 == 'AB' || $M2 == '-')?$M2:(($round==1)?round(number_format(($M3/$M1)*$wetage1,2)):number_format(($M3/$M1)*$wetage1,2));
							if($val2['opt_code'] == 1){
								$mo = ($M2 == 'AB' || $M2 == '-')?$M2:($M3/$M1)*$wetage1;
							}else{
								$mo = ($M2 == 'AB' || $M2 == '-')?$M2:(($round==1)?round(number_format(($M3/$M1)*$wetage1,2)):number_format(($M3/$M1)*$wetage1,2));
							}
						}else{
							$mo = 0;
						}
					}
                    $subj_mrks[$val][$subj_code]['sub'] = $val2['subj_nm'];
					
                    $subj_mrks[$val][$subj_code]['mrkss'][$val3] =  $mo;
					
				   }
                   //end t2//				   
				}
				
		    }
            // echo "<pre>";
			// print_r($subj_mrks);
			foreach($subj_mrks as $key4 => $val4){
				foreach($subjectData as $key2 => $val2){
					if($val2['opt_code'] == 2){
						
						$check_student_subject = $this->sumit->checkData('*','studentsubject',array('Adm_no'=>$val,'Class'=>$class,'SUBCODE'=>$val2['subject_code']));
					}else{
						
						 $check_student_subject = true;
					}
					if($check_student_subject){
						?>
						 <tr>
						   <td><?php echo $val4[$val2['subject_code']]['sub']; ?></td>
						   <?php
						     $tot_moo = 0;
							 foreach($val4[$val2['subject_code']]['mrks'] as $key5 => $val5){
								 ?>
								  <td><?php echo ($val2['opt_code'] != 1)?$val5:'';
								  $val5=($val5=='AB' || $val5=='-')?0:$val5; ?></td>
								 <?php
								 
								//$tot_moo += ($round==1)?round($val5):$val5;
								if($val2['opt_code'] == 1){
									$tot_moo += ($val5*100)/80;
								}else{
									$tot_moo += ($round==1)?round($val5):number_format($val5,2);
								}
								
							 }
						   ?>
						<td><?php echo $tot_moo; 
						  $grand_total[$val]['t1'] = isset($grand_total[$val]['t2'])?$grand_total[$val]['t1']:0;
						  $grand_total[$val]['t1'] += ($val2['opt_code'] != 1)?$tot_moo:0;
						   ?></td>
						   <?php
						        $fin_grade = 0;
								foreach($grademaster as $key => $grade){
									if($grade->ORange >=$tot_moo && $grade->CRange <=$tot_moo){
										$fin_grade = $grade->Grade;
										break;
									}
								}
						   ?>
						   <td><?php echo $fin_grade; ?></td>
						    <!-- end term-1 -->
						   
						   
						   <!-- term-2 -->
						   <?php
						     $tot_mo = 0;
							 foreach($val4[$val2['subject_code']]['mrkss'] as $key5 => $val5){
								 if($key2 == 6 && $val5 == 0){
									if($DISP_CLASS == 'VI' || $DISP_CLASS == 'VII' || $DISP_CLASS == 'VIII'){	
									 echo "<td></td>";
									}else{
										?>
											<td><?php echo ($val2['opt_code'] != 1)?$val5:'';
											$val5=($val5=='AB' || $val5=='-')?0:$val5; ?></td>
										<?php
									}
								 }else{
								 ?>
								  <td><?php echo ($val2['opt_code'] != 1)?$val5:'';
								  $val5=($val5=='AB' || $val5=='-')?0:$val5; ?></td>
								 <?php
								 }
								//$tot_mo += ($round==1)?round($val5):$val5;
								if($val2['opt_code'] == 1){
									$tot_mo += ($val5*100)/80;
								}else{
									if($DISP_CLASS == 'VI' || $DISP_CLASS == 'VII' || $DISP_CLASS == 'VIII'){
										$tot_mo += ($val2['subject_code'] != '7')?round($val5):round(($val5/80)*100);
									}else{
										$tot_mo += round($val5);
									}
								}
								
							 }
						   ?>
						   <td><?php echo $tot_mo;
						   $grand_total[$val]['t2'] = isset($grand_total[$val]['t2'])?$grand_total[$val]['t2']:0;
						   $grand_total[$val]['t2'] += ($val2['opt_code'] != 1)?$tot_mo:0;
						   ?></td>
						   <?php
						        $fin_grade = 0;
								foreach($grademaster as $key => $grade){
									if($grade->ORange >=$tot_mo && $grade->CRange <=$tot_mo){
										$fin_grade = $grade->Grade;
										break;
									}
								}
						   ?>
						   <td><?php echo $fin_grade; ?></td>
						   <?php
						     $fin_tot_mo = ($tot_moo + $tot_mo)/2;
						     $fin_tot_mo_tot += ($val2['opt_code'] != 1)?round(($tot_moo + $tot_mo)/2):0;
						   ?>
						   <td><?php echo ($round==1)?round($fin_tot_mo):number_format($fin_tot_mo,2); ?></td>
						   <td>
						    <?php
						     $fin_grade = 0;
								foreach($grademaster as $key => $grade){
									if($grade->ORange >=$fin_tot_mo && $grade->CRange <=$fin_tot_mo){
										$fin_grade = $grade->Grade;
										break;
									}
								}
								echo $fin_grade;
						    ?>
						   </td>
						   <!-- end term-2 -->
						   
						   
						 </tr>
						<?php
					}
				}
			}
			?>
								
	  </tr>
	  <tr>
		  <td colspan='3' style='text-align:right'><b>Grand Total</b></td>
	    <td><?php echo ($round == 1)?round($grand_total[$val]['t1']):number_format($grand_total[$val]['t1'],2); ?></td>
	    <td>
			<?php
			$grandTotT1 = $grand_total[$val]['t1']/$cnt_opt;
			 $fin_grade = 0;
				foreach($grademaster as $key => $grade){
					if($grade->ORange >=$grandTotT1 && $grade->CRange <=$grandTotT1){
						$fin_grade = $grade->Grade;
						break;
					}
				}
				echo $fin_grade;
			?>
		</td>
	    <td colspan='2'></td>
	    <td><?php echo ($round == 1)?round($grand_total[$val]['t2']):number_format($grand_total[$val]['t2'],2); ?></td>
	    <td>
			<?php
			$grandTotT2 = $grand_total[$val]['t2']/$cnt_opt;
			 $fin_grade = 0;
				foreach($grademaster as $key => $grade){
					if($grade->ORange >=$grandTotT2 && $grade->CRange <=$grandTotT2){
						$fin_grade = $grade->Grade;
						break;
					}
				}
				echo $fin_grade;
			?>
		</td>
	    <td><?php echo ($round==1)?round($fin_tot_mo_tot):number_format($fin_tot_mo_tot,2); ?></td>
	    <td>
			<?php
			$grandTotT1T2 = $fin_tot_mo_tot/$cnt_opt;
			 $fin_grade = 0;
				foreach($grademaster as $key => $grade){
					if($grade->ORange >=$grandTotT1T2 && $grade->CRange <=$grandTotT1T2){
						$fin_grade = $grade->Grade;
						break;
					}
				}
				echo $fin_grade;
			?>
		</td>
	  </tr>	
		
	  </tbody>
	</table>
	  <div class='row'>
		<div class='col-sm-12 col-xs-12'>
	  <table class='table' border='1'>
	    <tr>
		  <th style='text-align:center; font-size:15px;'>The grand total is excluding GK, MORAL SCIENCE and IT.</th>
	    </tr>
		
	  </table>
	</div>
	</div>
	  
	  <div class='row'>
		<div class='col-sm-12 col-xs-12'>
	  <table class='table' border='1'>
	    <tr>
		  <th style='text-align:left; font-size:15px;'>Promoted to/Detained to:</th>
			<th style='text-align:left; font-size:15px;'></th>
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
		  <td style='height:86px; font-size:13px; text-align:justify'>
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
		<br/>
		<br/>
		<br/>
		<div class='col-sm-3 col-xs-3'><center><br /><b>SIGNATURE <br/>PARENT</b></center></div>
		<div class='col-sm-3 col-xs-3'><center><br /><b>SIGNATURE <br/>CLASS TEACHER</b></center></div>
		<div class='col-sm-3 col-xs-3'><center><br /><b>SIGNATURE <br/>SECTION  INCHARGE</b></center></div>
		<div class='col-sm-3 col-xs-3'>
			<!--<center><br /><img style='width:50px; position:absolute; bottom: 25px;'src='<?php //echo base_url($sign); ?>'></center>-->
			<center><br /><b>SIGNATURE <br/>PRINCIPAL</b></center>
		</div>
	</div>
	<!-- end signature -->
	</div><br />
	<footer class='page-break'>
	</footer>
	<?php } ?>
	</div>
  </body>
</html>