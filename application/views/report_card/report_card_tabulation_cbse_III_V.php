<style>
.table > thead > tr > th,
.table > tbody > tr > th,
.table > tfoot > tr > th,
.table > thead > tr > td,
.table > tbody > tr > td,
.table > tfoot > tr > td {
    white-space: nowrap !important;
	font-size:12px;
	padding:2px !important;
  }
</style>
<br />
<div class='table-responsive'>


<a target='_blank' href="<?php echo base_url('report_card/Report_card/tabulation_cbse_pdf/'.$trm.'/'.$term.'/'.$classs.'/'.$sec.'/'.$date.'/'.$round); ?>" class='btn btn-info'> <i class="fa fa-file-pdf-o"></i> PDF </a>

<button type='submit' class='btn btn-success' form='temp_save'><i class="fa fa-floppy-o" title='SAVE'></i></button><br /><br />

<form action='<?php echo base_url('report_card/Report_card_temp_save/save_temp_tbl'); ?>' method='post' id='temp_save'>
<table class='table' border='1'>
  <tr>
   <thead>
    <th style='background:#337ab7; color:#fff !important'>Adm No</th>
    <th style='background:#337ab7; color:#fff !important'>Stu Name</th>
    <th style='background:#337ab7; color:#fff !important'>Roll Name</th>
    <th style='background:#337ab7; color:#fff !important'>Exam Name</th>
	<?php
	  foreach($subject_list as $key => $subjdata){
		  $array_session['subj_nm_arr']=$subjdata['subj_nm'];
		?>
		 <th style='background:#337ab7; color:#fff !important; text-align:center'><?php echo $subjdata['subj_nm']; ?><br /><span style='font-size:8px;'>(MO | WT)</span></th>
		 <input type='hidden' name='subj_nm[]' value='<?php echo $subjdata['subj_nm']; ?>'>
		<?php
	  }
	?>
	<th style='background:#337ab7; color:#fff !important'>Max Marks</th>
	<th style='background:#337ab7; color:#fff !important'>Total Marks</th>
	<th style='background:#337ab7; color:#fff !important'>Total Percent</th>
	<th style='background:#337ab7; color:#fff !important'>Grade</th>
	<!--<th style='background:#337ab7; color:#fff !important'>Attendance</th>-->
   </thead>	
  </tr>
  <tbody>
  <tr>
  <input type='hidden' name='term' value='<?php echo $trm; ?>'>
    <?php
	 
	  foreach($allData as $key => $data){
		
		   //for attendance //
		   $admnum = $data['ADM_NO'];
		  
		   //$this->session->set_userdata('array_session',$allData);
		//  echo "<pre>";
		//  print_r($allData[$admnum]);
	     // die;
		   $stu_att_type = $this->alam->select('student_attendance_type','*',"class_code='$classs'");
		   $att_type     = $stu_att_type[0]->attendance_type;
		   if($att_type == 1){
			  $attPresentData = $this->alam->select('stu_attendance_entry','count(DISTINCT att_date)cnt',"class_code='$classs' AND sec_code='$sec' AND att_date >= '$date' AND att_status in('P','HD') AND admno='$admnum'");
			  
			  $tot_present_day = $attPresentData[0]->cnt;
							  
			}else{
			  $attPresentData = $this->alam->select('stu_attendance_entry_periodwise','count(DISTINCT att_date)cnt',"class_code='$classs' AND sec_code='$sec' AND att_date >= '$date' AND att_status='P' AND admno='$admnum'");
			  $tot_present_day = $attPresentData[0]->cnt;		
			}
			//end attendance //
		  $array_session['first_nm_arr']=$data['FIRST_NM'];
		  $array_session['roll_no_arr']=$data['ROLL_NO'];
		  $array_session['class_arr']=$data['DISP_CLASS'];
		  $array_session['sec_arr']=$data['DISP_SEC'];
		  $array_session['adm_arr']=$data['ADM_NO'];
		  ?>
		    <tr>
			  <td><?php echo $data['ADM_NO']; ?><input type='hidden' name='adm_no[]' value='<?php echo $data['ADM_NO']; ?>'></td>
			  <td><?php echo $data['FIRST_NM']; ?><input type='hidden' name='first_nm[]' value='<?php echo $data['FIRST_NM']; ?>'></td>
			  <td><?php echo $data['ROLL_NO']; ?><input type='hidden' name='roll_no[]' value='<?php echo $data['ROLL_NO']; ?>'>
			  <input type='hidden' name='class[]' value='<?php echo $data['DISP_CLASS']; ?>'>
			  <input type='hidden' name='sec[]' value='<?php echo $data['DISP_SEC']; ?>'>
			  </td>
			  <td colspan='12'></td>
			  <td>
			    <?php
				  $fin_wtg = array();
				  $totExamWetArr = 0;
				  $totMarksObtArr = 0;
		
				  foreach($data['exmaList'] as $key1 => $examdata){
					  	if($examdata=='NOTEBOOK' || $examdata=='SUBJECT_ENRICHMENT'){
					continue;
					}
					  ?>
					    <tr>
						  <td colspan='4' style='text-align:right'><?php echo $examdata; ?></td>
						   <?php
						        $i = 0;
						        $tot_wtg = 0;
								$totExamWet = 0;
								$tot_percent = 0;
								$optt_code = array();
								$is_display = array();
					  
								foreach($data['marks'][$key1] as $key2 => $mrks){
									$subcode= $key2;
									$i = $i + 1;
									if(!isset($fin_wtg[$i]))
									{
										$fin_wtg[$i] = 0;
									}

									$optt_code[$i] = $mrks['opt_code'];
									$is_display[$i] = $mrks['display'];

									if($mrks['opt_code'] != 1 && $mrks['display'] == 1){ //check for sub_option(2)
									  $tot_wtg += $mrks['wt'];
								      $totExamWet = $data['wetage'][$key1] + $totExamWet;
									if($subcode==15){
										if($mrks['mo']!='AB' || $mrks['mo'] !='-'){
										$mo=$mrks['mo'];
									}else{
										$mo=$mrks['mo'];
									}
									if($mrks['wt']!='AB' || $mrks['wt'] !='-'){
									$wt=round($mrks['wt']/2);
									}else{
									$wt=$mrks['wt'];
									}
									
									}else{
									$mo=$mrks['mo'];
									$wt=$mrks['wt'];
									}	

									?>
									<td>
									   <?php echo $mo; ?>
									</td>

									<?php 
									$fin_wtg[$i] += $wt;
									}else{ 
									$fin_wtg[$i] += $wt;
									?>
									  <td><?php echo $mo ?></td>
									<?php 	
									}
								}
							?>
						  <td><?php echo $totExamWet; 
						  $totExamWetArr += $totExamWet;
						  ?></td>	
						  <td><?php echo $tot_wtg;
						  $totMarksObtArr += $tot_wtg;
						  ?></td>	
						  <td><?php
					  
					  
					 echo $tot_percent = number_format($tot_wtg * 100 / $totExamWet,2); 
							  
							  ?></td>
                          <td>
						    <?php
							  foreach($grade as $key3 => $val3){
								if($val3['ORange'] >=$tot_percent && $val3['CRange'] <=$tot_percent){
								//echo $val3['Grade'];
									
									if($tot_percent >= '91' AND $tot_percent <= '100'){
										echo "A+";
									}else if($tot_percent >= '75' AND $tot_percent <= '90'){
										echo "A";
									}else if($tot_percent >= '56' AND $tot_percent <= '74'){
										echo "B";
									}else if($tot_percent >= '35' AND $tot_percent <= '55'){
										echo "C";
									}else if($tot_percent <= '35'){
										echo "D";
									}
							
								break;
							    }
							  }
							?>
						  </td>
					    </tr>
					  <?php
				  }
				?>
			  </td>
		    </tr>
			<tr>
			  <td colspan='4' style='text-align:right'>Total</td>
			  <?php
		  
		  
			    foreach($fin_wtg as $key4 => $val4){
					$array_session['tot_mo_arr'][$data['ADM_NO']]=$val4;
					?>
					  <td><?php echo $val4; ?><input type='hidden' name='tot_mo[<?php echo $data['ADM_NO']; ?>][]' value='<?php echo $val4; ?>'></td>
					<?php
				}
			  ?>
			  <td><?php echo $totExamWetArr; ?></td>
			  <td style='background:#ece0e0;'><?php echo $totMarksObtArr; 
			  $fper = ($totMarksObtArr * 100)/ $totExamWetArr;
			  $array_session['tot_wet_mrk_arr']=$totMarksObtArr;
			  $array_session['tot_per_arr']=number_format($fper,2);
		  
			  ?>
			  <input type='hidden' name='tot_wet_mrk[]' value='<?php echo $totMarksObtArr; ?>'>
			  </td>
			  <td><?php echo number_format($fper,2); ?>
			  <input type='hidden' name='tot_per[]' value='<?php echo number_format($fper,2); ?>'>
			  </td>
			  <td>
			 
				  
			  <?php
			   foreach($grade as $key5 => $val5){
				if($val5['ORange'] >=$fper && $val5['CRange'] <=$fper){
				//echo $val5['Grade'];
					if($fper >= '91' AND $fper <= '100'){
										echo "A+";
						$ggdd= "A+";
									}else if($fper >= '75' AND $fper <= '90'){
										echo "A";
						$ggdd= "A";
									}else if($fper >= '56' AND $fper <= '74'){
										echo "B";
						$ggdd= "B";
									}else if($fper >= '35' AND $fper <= '55'){
										echo "C";
						$ggdd= "C";
									}else if($fper <= '35'){
										echo "D";
						$ggdd= "D";
									}
					 $array_session['tot_grd_arr']=$ggdd;
				?>
				<input type='hidden' name='tot_grd[]' value='<?php echo $ggdd; ?>'>
				<?php
				break;
				}
			   }
			  ?>
				  
				  
			  </td>
			</tr>
			<tr>
			  <td colspan='4' style='text-align:right'>Grade</td>
			  <?php
			    foreach($fin_wtg as $key5 => $val5){
					?>
					  <td>
					    <?php
						if($is_display[$key5] == 1){
						   foreach($grade as $key6 => $val6){
							if($val6['ORange'] >=$val5 && $val6['CRange'] <=$val5){
							//echo $val6['Grade'];
								if($val5 >= '91' AND $val5 <= '100'){
										echo "A+";
									$ggd= "A+";
									}else if($val5 >= '75' AND $val5 <= '90'){
										echo "A";
									$ggd= "A";
									}else if($val5 >= '56' AND $val5 <= '74'){
										echo "B";
										$ggd= "B";
									}else if($val5 >= '35' AND $val5 <= '55'){
										echo "C";
										$ggd= "C";
									}else if($val5 <= '35'){
									echo "D";
									$ggd= "D";
									}
								$array_session['grd_arr'][$data['ADM_NO']]=$ggd;
							?>
							  <input type='hidden' name='grd[<?php echo $data['ADM_NO']; ?>][]' value='<?php echo $ggd; ?>'>
							<?php
							break;
							}
						   }
						}else{
							echo '-';
							$array_session['grd_arr'][$data['ADM_NO']]='-';
							?>
							  <input type='hidden' name='grd[<?php echo $data['ADM_NO']; ?>][]' value='-'>
							  <?php
						}
						?>
					  </td>
					<?php
				}
			  ?>
			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>
			  <!--<td><?php //echo $tot_present_day."/".$tot_working_day; 
				  
				  // $array_session['attendance_arr']=$tot_present_day."/".$tot_working_day;
				  ?>
			  <input type='hidden' name='attendance[]' value='<?php //echo $tot_present_day."/".$tot_working_day; ?>'>
			  </td>-->
			</tr>
		  <?php
		  $array_data[]=$array_session;
		  
	  }
	  $this->session->set_userdata('array_session',$array_data);
	?> 
  </tr>
  </tbody>	
</table>
</form>
</div>