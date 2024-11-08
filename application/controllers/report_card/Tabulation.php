<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tabulation extends MY_controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Alam','alam');
	}
	
	public function term1XTabulation(){
		$school_setting = $this->alam->select('school_setting','*');
		$school_photo   = $this->alam->select('school_photo','*');
		$reportCardType_data = $this->alam->select('misc_table','*');
		$data['report_card_type'] = $reportCardType_data[0]->report_card_type;
		$data['grademaster'] = $this->alam->select('grademaster','*');
		$data['signature'] = $this->alam->select('signature','*');
		//$term = $this->input->post('term');
		$term =1;
		$date = $this->input->post('date');
		$classs = $this->input->post('classs');
		$examModedata = $this->alam->select('classes','ExamMode',"Class_No='$classs'");
		$examode = $examModedata[0]->ExamMode;
		$sec = $this->input->post('sec');
		$data['sec'] =$sec;
		$data['classs'] =$classs;
		$adm_no = $this->alam->selectA('student','ROLL_NO,FIRST_NM,ADM_NO',"CLASS='$classs' AND SEC='$sec'");
		
		$termId = $term;
		$round_off = $this->input->post('round_off');
		//for attendance //
		$stu_att_type = $this->alam->select('student_attendance_type','*',"class_code='$classs'");
		$att_type     = $stu_att_type[0]->attendance_type;
		if($att_type == 1){
			$att_data = $this->alam->select('stu_attendance_entry','count(DISTINCT att_date)cnt',"class_code='$classs' AND sec_code='$sec' AND att_date <= '$date'");
			$data['tot_working_day'] = $att_data[0]->cnt;
		}else{
			$att_data = $this->alam->select('stu_attendance_entry_periodwise','count(DISTINCT att_date)cnt',"class_code='$classs' AND sec_code='$sec' AND att_date <= '$date'");
			$data['tot_working_day'] = $att_data[0]->cnt;
		}
		$termId = $term;
		//end attendance //
		$examcode = array();
		$pt_all_marks = array();
		$result = array();
		if($examode == 1)//diffrentiate CBSE or CMC
		{
			if($term == 1)
			{
				$term = 'TERM-1';
				$examcode = array('1','4','8');
			}else
			{
				$term = 'TERM-2';
				$examcode = array('1','2','3','5');
			}
			
			foreach ($adm_no as $key => $valu) {
				  $value= $valu['ADM_NO'];
				$stu_data = $this->alam->studentDetailsByAdmissionNo($value,$termId);
				$result[$value] = $stu_data;
				$admnum  = $stu_data['ADM_NO'];
				$class   = $stu_data['CLASS'];
				$section = $stu_data['SEC'];
				$skill_1 = $stu_data['skill_1'];
				$skill_2 = $stu_data['skill_2'];
				$skill_3 = $stu_data['skill_3'];
				$dis_grd = $stu_data['dis_grd'];
				$diskill_1 = $stu_data['diskill_1'];
				$diskill_2 = $stu_data['diskill_2'];
				$diskill_3 = $stu_data['diskill_3'];
				$diskill_4 = $stu_data['diskill_4'];
				$rmks    = $stu_data['rmks'];
				$subjectData = $this->alam->getClassWiseSubject($term,$class,$section);
			
				//for attendance //
				if($att_type == 1){
				  $attPresentData = $this->alam->select('stu_attendance_entry','count(DISTINCT att_date)cnt',"class_code='$class' AND sec_code='$section' AND att_date <= '$date' AND att_status in('P','HD') AND admno='$admnum'");
				  $data['tot_present_day'] = $att_data[0]->cnt;	
				}else{
				  $attPresentData = $this->alam->select('stu_attendance_entry','count(DISTINCT att_date)cnt',"class_code='$class' AND sec_code='$section' AND att_date <= '$date' AND att_status='P' AND admno='$admnum'");
				  $data['tot_present_day'] = $att_data[0]->cnt;		
				}
				//end attendance //
				foreach ($subjectData as $key2 => $val2) {
				if($val2['opt_code'] == 2)
					{
						$check_student_subject = $this->sumit->checkData('*','studentsubject',array('Adm_no'=>$value,'Class'=>$class,'SUBCODE'=>$val2['subject_code']));
					}
					else
					{
						$check_student_subject = true;
					}
					$check_student_subject = true;
					if($check_student_subject)
					{
						$sub_code = $val2['subject_code'];
						$pt_type = $val2['pt_type'];
						$final_marks = array();
						$result[$value]['sub'][$key2]['subject_name'] = $val2['subj_nm'];
						$result[$value]['sub'][$key2]['opt_code'] = $val2['opt_code'];
				foreach ($examcode as $keys => $val) {
							($val==1)?$examC="1,7,8":$examC=$val;
							$marks =array();
							$tot_per = 0;
							$all_marks = $this->sumit->fetchAllData('M1,M2,M3,ExamC','marks',"admno='$value' AND ExamC IN ($examC) AND SCode='$sub_code' AND Term='$term' AND status = '1'");
				
							$wetageMarks = $this->sumit->fetchSingleData('wetage1','exammaster',array('ExamCode'=>$val));
							$absent = array();
							$ab = 0;
							if($val == 1){
								$mark = array();
								if(1 == 1)
								{
									foreach ($all_marks as $key4 => $value4) {

										$mark[$key4] = ($value4['M3']/$value4['M1']) * 20;
										$absent[$key4] = $value4['M2'];
									}
									$absent_count = count($absent);
									$total_ab_count = array_count_values($absent);
									$total_ab_count['AB'] = (!isset($total_ab_count['AB']))?0:$total_ab_count['AB'];
									$ab = ($absent_count == $total_ab_count['AB'])?'AB':'0';
									
									$final_marks[$keys] = ($ab == 'AB')?$ab:number_format(max($mark),2);

								}
								elseif($pt_type == 2)
								{						
									foreach ($all_marks as $key4 => $value4) {

										$mark[$key4] = ($value4['M3']/$value4['M1']) * 20;
										$tot_per = $tot_per + $mark[$key4];
										$absent[$key4] = $value4['M2'];
									}
									$absent_count = count($absent);
									$total_ab_count = array_count_values($absent);
									$total_ab_count['AB'] = (!isset($total_ab_count['AB']))?0:$total_ab_count['AB'];
									$ab = ($absent_count == $total_ab_count['AB'])?'AB':'0';
									$final_marks[$keys] = ($ab == 'AB')?$ab:number_format($tot_per/3,2);
								}
								else
								{
									foreach ($all_marks as $key4 => $value4) {

										$mark[$key4] = ($value4['M3']/$value4['M1']) * 20;
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
									$final_marks[$keys] = ($ab == 'AB')?$ab:number_format($two_sum/2,2);
								}

								  $final_marks[$keys]=($round_off==1)?round($final_marks[$keys]):$final_marks[$keys];
							}else{
								if(!empty($all_marks))
								{
									if($class== 12){
										$mark = $all_marks[0]['M3'];

									$mark = ($all_marks[0]['M2'] == 'AB' || $all_marks[0]['M2'] == '-')?$all_marks[0]['M2']:$mark;
									}else{
										$mark = ($all_marks[0]['M3']/$all_marks[0]['M1']) * $wetageMarks['wetage1'];

									$mark = ($all_marks[0]['M2'] == 'AB' || $all_marks[0]['M2'] == '-')?$all_marks[0]['M2']:$mark;
									}
								
								}
								else
								{
									$mark = 0;
								}
								if($mark == 'AB' || $mark == '-')
								{
									$final_marks[$keys] = $mark;
								}
								else
								{
									$final_marks[$keys] = ($round_off==1)?round($mark): number_format($mark,2);								
								}
								
							}
					}
						$final_marks_cnf_pt=($final_marks[0]=='AB' || $final_marks[0]=='' || $final_marks[0]==0)?0:$final_marks[0];
						$final_marks_cnf=($final_marks[1]=='AB' || $final_marks[1]=='' || $final_marks[1]==0)?0:$final_marks[1];
						$final_marks_cnf_pt3=($final_marks[2]=='AB' || $final_marks[2]=='' || $final_marks[2]==0)?0:$final_marks[2];
						$marks['pt'] = round($final_marks[0]); 
						$marks['pt_s'] = round(($final_marks_cnf_pt/20) * 10);
						// $marks['notebook'] = $final_marks[1];
						// $marks['subject_enrichment'] =$final_marks[2];
						$marks['half_yearly'] = round($final_marks[1]);
						
						$marks['half_yearly_s'] = round(($final_marks_cnf/80) * 10);
						
						$marks['pt3'] = round($final_marks[2]);
						
						$marks['pt3_s'] = round($final_marks_cnf_pt3/2);
						
						$pt_marks = ($marks['pt'] == 'AB' || $marks['pt'] == '-')?0:$marks['pt'];
						//$notebook_marks = ($marks['notebook'] == 'AB' || $marks['notebook'] == '-')?0:$marks['notebook'];
						//$se_marks = ($marks['subject_enrichment'] == 'AB' || $marks['subject_enrichment'] == '-')?0:$marks['subject_enrichment'];
						$hy_marks = ($marks['half_yearly'] == 'AB' || $marks['half_yearly'] == '-')?0:$marks['half_yearly'];
						$marks_obtained = $pt_marks + $hy_marks;
						$marks['marks_obtained'] = ($round_off==1)?round($marks_obtained): number_format($marks_obtained,2);
						$gradeData = $this->sumit->fetchSingleData('Grade,Qualitative_Norms','grademaster',"ORange >=$marks_obtained AND CRange <= $marks_obtained");
						$marks['grade'] = $gradeData['Grade'];
						$result[$value]['sub'][$key2]['marks'] = $marks;
					}
				}
			}
			$data['round_off'] = $round_off;
			$data['result']         = $result;
			$data['school_setting'] = $school_setting;
			$data['school_photo']   = $school_photo;
			$data['trm'] = $termId;
			
			
			$data['grade_only_sub'] = $stu_data['grade_only_sub'];
			$this->load->view('report_card/report_card_cbse_tabulation_xi_x',$data);
		}
	}
}