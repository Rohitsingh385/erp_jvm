<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_card extends MY_controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Alam','alam');
		error_reporting(0);
	}
	
	public function index(){

		if(!in_array('viewTermWiseReportCard', permission_data)){
			redirect('payroll/dashboard/dashboard');
		}

		$this->render_template('report_card/report_card_term');
	}
	
	public function report_card($trm){

		if(!in_array('viewTermWiseReportCard', permission_data)){
			redirect('payroll/dashboard/dashboard');
		}
		
		$class_data = $this->alam->select('classes','*');
		$array  = array('trm'=>$trm,'class_data'=>$class_data);
		
		$this->render_template('report_card/report_card',$array);
	}
	
	public function report_card_annual($trm){

		if(!in_array('viewTermWiseReportCard', permission_data)){
			redirect('payroll/dashboard/dashboard');
		}
		
		$class_data = $this->alam->select('classes','*');
		$array  = array('trm'=>$trm,'class_data'=>$class_data);
		
		$this->render_template('report_card/report_card_annual',$array);
	}
	
	public function report_card_annual_VI_IX($trm){

		if(!in_array('viewTermWiseReportCard', permission_data)){
			redirect('payroll/dashboard/dashboard');
		}
		
		$class_data = $this->alam->select('classes','*');
		$array  = array('trm'=>$trm,'class_data'=>$class_data);
		
		$this->render_template('report_card/report_card_annual_VI_IX',$array);
	}
	
	public function report_card_int($trm){

		if(!in_array('viewTermWiseReportCard', permission_data)){
			redirect('payroll/dashboard/dashboard');
		}
		
		$class_data = $this->alam->select('classes','*');
		$array  = array('trm'=>$trm,'class_data'=>$class_data);
		
		$this->render_template('report_card/report_card_int',$array);
	}
	public function report_card_annual_XI($trm){

		if(!in_array('viewTermWiseReportCard', permission_data)){
			redirect('payroll/dashboard/dashboard');
		}
		
		$class_data = $this->alam->select('classes','*',"Class_No in ('13')");
		$array  = array('trm'=>$trm,'class_data'=>$class_data);
		
		$this->render_template('report_card/report_card_annual_XI',$array);
	}
	public function report_card_annual_junior(){

		if(!in_array('viewTermWiseReportCard', permission_data)){
			redirect('payroll/dashboard/dashboard');
		}
		
		$class_data = $this->alam->select('classes','*');
		$array  = array('trm'=>1,'class_data'=>$class_data);
		
		$this->render_template('report_card/report_card_annual_junior',$array);
	}
	
	public function classess_report_card(){
		$ret = '';
		$class_code = '';
		$pt_type = '';
		$exam_type = '';
		
		$class_nm = $this->input->post('val');
		$sec_data = $this->alam->select_order_by('student','distinct(DISP_SEC),SEC','DISP_SEC',"CLASS='$class_nm' AND Student_Status='ACTIVE'");
		
		$class_data = $this->alam->select('classes','*',"Class_No='$class_nm'");
		$class_code = $class_data[0]->Class_No;
		$pt_type    = $class_data[0]->PT_TYPE;
		$exam_type  = $class_data[0]->ExamMode;
		
		$ret .="<option value=''>Select</option>";
		if(isset($sec_data)){
			foreach($sec_data as $data){
				 $ret .="<option value=". $data->SEC .">" . $data->DISP_SEC ."</option>";
			}
		}
		
		$array = array($ret,$class_code,$pt_type,$exam_type);
		echo json_encode($array);
	}
	
	public function make_report_card_annual_junior(){
		ini_set('max_execution_time', 0); 
        ini_set('memory_limit','2048M');
		
		$trm        = 1;
		$classs     = $this->input->post('classs');
		$sec        = $this->input->post('sec');
		$date       = $this->input->post('date');
		$dt         = date('Y-m-d',strtotime($date));
		$round      = $this->input->post('round');
		$class_code = $this->input->post('class_code');
		$pt_type    = $this->input->post('pt_type');
		$exam_type  = $this->input->post('exam_type');
		
		$school_setting = $this->alam->select('school_setting','*');
		$stu_data = $this->alam->report_card_student_detail($trm,$classs,$sec);
		
		$download_btn = $this->alam->selectA('student','count(t2_report_card_status)cnt',"CLASS='$classs' AND SEC='$sec' AND Student_Status='ACTIVE' AND t2_report_card_status='1'");
		$cnt = $download_btn[0]['cnt'];
		
		$array = array('trm'=>$trm,'school_setting'=>$school_setting,'stu_data'=>$stu_data,'classs'=>$classs,'sec'=>$sec,'round'=>$round,'dt'=>$dt,'cnt'=>$cnt);
	    $this->load->view('report_card/report_card_list_annual_junior',$array);
	}
	
	public function make_report_card(){
		ini_set('max_execution_time', 0); 
        ini_set('memory_limit','2048M');
		
		$trm        = $this->input->post('trm');
		$classs     = $this->input->post('classs');
		$sec        = $this->input->post('sec');
		$date       = $this->input->post('date');
		$dt         = date('Y-m-d',strtotime($date));
		$round      = $this->input->post('round');
		$class_code = $this->input->post('class_code');
		$pt_type    = $this->input->post('pt_type');
		$exam_type  = $this->input->post('exam_type');
		
		$school_setting = $this->alam->select('school_setting','*');
		$stu_data = $this->alam->report_card_student_detail($trm,$classs,$sec);
		
		$download_btn = $this->alam->selectA('student','count(t1_report_card_status)cnt',"CLASS='$classs' AND SEC='$sec' AND Student_Status='ACTIVE' AND t1_report_card_status='1'");
		$cnt = $download_btn[0]['cnt'];
		
		$array = array('trm'=>$trm,'school_setting'=>$school_setting,'stu_data'=>$stu_data,'classs'=>$classs,'sec'=>$sec,'round'=>$round,'dt'=>$dt,'cnt'=>$cnt);
	    $this->load->view('report_card/report_card_list',$array);
	}
	
	
	public function make_report_card_annual(){
		ini_set('max_execution_time', 0); 
        ini_set('memory_limit','2048M');
		
		$trm        = $this->input->post('trm');
		$classs     = $this->input->post('classs');
		$sec        = $this->input->post('sec');
		$date       = $this->input->post('date');
		$dt         = date('Y-m-d',strtotime($date));
		$round      = $this->input->post('round');
		$class_code = $this->input->post('class_code');
		$pt_type    = $this->input->post('pt_type');
		$exam_type  = $this->input->post('exam_type');
		
		$school_setting = $this->alam->select('school_setting','*');
		$stu_data = $this->alam->report_card_student_detail($trm,$classs,$sec);
		
		$download_btn = $this->alam->selectA('student','count(t1_report_card_status)cnt',"CLASS='$classs' AND SEC='$sec' AND Student_Status='ACTIVE' AND t2_report_card_status='1'");
		$cnt = $download_btn[0]['cnt'];
		
		$array = array('trm'=>$trm,'school_setting'=>$school_setting,'stu_data'=>$stu_data,'classs'=>$classs,'sec'=>$sec,'round'=>$round,'dt'=>$dt,'cnt'=>$cnt);
	    $this->load->view('report_card/report_card_list_annual',$array);
	}
	
	public function make_report_card_annual_VI_IX(){
		ini_set('max_execution_time', 0); 
        ini_set('memory_limit','2048M');
		
		$trm        = $this->input->post('trm');
		$classs     = $this->input->post('classs');
		$sec        = $this->input->post('sec');
		$date       = $this->input->post('date');
		$dt         = date('Y-m-d',strtotime($date));
		$round      = $this->input->post('round');
		$class_code = $this->input->post('class_code');
		$pt_type    = $this->input->post('pt_type');
		$exam_type  = $this->input->post('exam_type');
		
		$school_setting = $this->alam->select('school_setting','*');
		$stu_data = $this->alam->report_card_student_detail($trm,$classs,$sec);
		
		$download_btn = $this->alam->selectA('student','count(t1_report_card_status)cnt',"CLASS='$classs' AND SEC='$sec' AND Student_Status='ACTIVE' AND t2_report_card_status='1'");
		$cnt = $download_btn[0]['cnt'];
		
		$array = array('trm'=>$trm,'school_setting'=>$school_setting,'stu_data'=>$stu_data,'classs'=>$classs,'sec'=>$sec,'round'=>$round,'dt'=>$dt,'cnt'=>$cnt);
	    $this->load->view('report_card/report_card_list_annual_VI_IX',$array);
	}
	
	public function make_report_card_int(){
		ini_set('max_execution_time', 0); 
        ini_set('memory_limit','2048M');
		
		$trm        = $this->input->post('trm');
		$classs     = $this->input->post('classs');
		$sec        = $this->input->post('sec');
		$date       = $this->input->post('date');
		$dt         = date('Y-m-d',strtotime($date));
		$round      = $this->input->post('round');
		$class_code = $this->input->post('class_code');
		$pt_type    = $this->input->post('pt_type');
		$exam_type  = $this->input->post('exam_type');
		
		$school_setting = $this->alam->select('school_setting','*');
		$stu_data = $this->alam->report_card_student_detail($trm,$classs,$sec);
		
		$download_btn = $this->alam->selectA('student','count(int_report_card_status)cnt,int_report_card_status',"CLASS='$classs' AND SEC='$sec' AND Student_Status='ACTIVE' AND int_report_card_status='1'");
		$cnt = $download_btn[0]['cnt'];
		$array = array('trm'=>$trm,'school_setting'=>$school_setting,'stu_data'=>$stu_data,'classs'=>$classs,'sec'=>$sec,'round'=>$round,'dt'=>$dt,'cnt'=>$cnt);
	    $this->load->view('report_card/report_card_list_int',$array);
	}
	
	
	
	
	public function make_report_card_annual_XI(){
		ini_set('max_execution_time', 0); 
        ini_set('memory_limit','2048M');
		
		$trm        = $this->input->post('trm');
		$classs     = $this->input->post('classs');
		$sec        = $this->input->post('sec');
		$date       = $this->input->post('date');
		$dt         = date('Y-m-d',strtotime($date));
		$round      = $this->input->post('round');
		$class_code = $this->input->post('class_code');
		$pt_type    = $this->input->post('pt_type');
		$exam_type  = $this->input->post('exam_type');
		
		$school_setting = $this->alam->select('school_setting','*');
		$stu_data = $this->alam->report_card_student_detail($trm,$classs,$sec);
		
		$download_btn = $this->alam->selectA('student','count(t1_report_card_status)cnt',"CLASS='$classs' AND SEC='$sec' AND Student_Status='ACTIVE' AND t1_report_card_status='1'");
		$cnt = $download_btn[0]['cnt'];
		
		$array = array('trm'=>$trm,'school_setting'=>$school_setting,'stu_data'=>$stu_data,'classs'=>$classs,'sec'=>$sec,'round'=>$round,'dt'=>$dt,'cnt'=>$cnt);
	    $this->load->view('report_card/report_card_list_annual_XI',$array);
	}
	public function dwnld($class,$sec){
		$this->load->library('zip');
		$download = $this->alam->selectA('student','ADM_NO,DISP_CLASS,DISP_SEC',"CLASS='$class' AND SEC='$sec' AND Student_Status='ACTIVE' AND t1_report_card_status='1'");
		$disp_cls = $download[0]['DISP_CLASS'];
		$disp_sec = $download[0]['DISP_SEC'];
		foreach($download as $key => $val){
			$adm = str_replace('/','-',$val['ADM_NO']);
			$this->zip->read_file('report_card/term1/'.$adm.'.pdf');
		}
		$this->zip->download($disp_cls.'-'.$disp_sec);
	}
	
	public function generatePDF_ix_x(){
		$school_setting = $this->alam->select('school_setting','*');
		$school_photo   = $this->alam->select('school_photo','*');
		$reportCardType_data = $this->alam->select('misc_table','*');
		$data['report_card_type'] = $reportCardType_data[0]->report_card_type;
		$data['grademaster'] = $this->alam->select('grademaster','*');
		$data['signature'] = $this->alam->select('signature','*');
		$adm_no = $this->input->post('stu_adm_no[]');
		$term = $this->input->post('term');
		$date = $this->input->post('date');
		$classs = $this->input->post('classs');
		$examModedata = $this->alam->select('classes','ExamMode',"Class_No='$classs'");
		$examode = $examModedata[0]->ExamMode;
		$sec = $this->input->post('sec');
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
		//end attendance //
		$examcode = array();
		$pt_all_marks = array();
		$result = array();
		if($examode == 1)//diffrentiate CBSE or CMC
		{
			if($term == 1)
			{
				$term = 'TERM-1';
				$examcode = array('1','7');
			}else
			{
				$term = 'TERM-2';
				$examcode = array('1','2','3','5');
			}
			foreach ($adm_no as $key => $value) {
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
								if($pt_type == 1)
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
									//$mark = ($all_marks[0]['M3']/$all_marks[0]['M1']) * $wetageMarks['wetage1'];
									$mark = $all_marks[0]['M3'];

									$mark = ($all_marks[0]['M2'] == 'AB' || $all_marks[0]['M2'] == '-')?$all_marks[0]['M2']:$mark;
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
						$marks['pt'] = $final_marks[0]; 
						$marks['pt_s'] = round(($final_marks[0]/20) * 10);
						// $marks['notebook'] = $final_marks[1];
						// $marks['subject_enrichment'] =$final_marks[2];
						$marks['half_yearly'] = $final_marks[1];
						$marks['half_yearly_s'] = round(($final_marks[1]/80) * 10);
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
			$this->load->view('report_card/report_card_cbse_pdf_ix_x',$data);
		}
	}
	
	
	
	public function generatePDF_ix_new(){
		error_reporting(0);
		$data['school_setting'] = $this->alam->select('school_setting','*');
		$data['school_photo']   = $this->alam->select('school_photo','*');
		$data['grademaster']    = $this->alam->select('grademaster','*');
		$data['signature']      = $this->alam->select('signature','*');
		$adm_no                 = $this->input->post('stu_adm_no');
		$term                   = $this->input->post('term');
		$date                   = $this->input->post('date');
		$classs                 = $this->input->post('classs');
		$sec                    = $this->input->post('sec');
		$round_off              = $this->input->post('round_off');
		
		$getSubj = $this->db->query("select opt_code,subject_code,(select SubName from subjects where SubCode=class_section_wise_subject_allocation.subject_code)subjnm from class_section_wise_subject_allocation where Class_No='$classs' AND section_no='$sec' AND applicable_exam='1' AND opt_code in(0,1) order by sorting_no")->result_array();
		
		$exam1 = array('8','4');
		$exam2 = array('5','8');
		
		$result = array();
		foreach($adm_no as $key => $val){
			
			$getStu = $this->alam->selectA('student','ADM_NO,ROLL_NO,FIRST_NM,FATHER_NM,MOTHER_NM,DISP_CLASS,DISP_SEC,BIRTH_DT',"CLASS='$classs' AND SEC='$sec' AND Student_Status='ACTIVE' AND ADM_NO='$val'");
			
			$term1 = array();
			$getSubj2 = $this->alam->selectA('studentsubject',"SUBCODE,(select SubName from subjects where SubCode=studentsubject.SUBCODE)subjnm,(select opt_code from class_section_wise_subject_allocation where subject_code=studentsubject.SUBCODE AND class_section_wise_subject_allocation.section_no='$sec' AND class_section_wise_subject_allocation.Class_No='$classs' AND class_section_wise_subject_allocation.applicable_exam='1')optcode2","Adm_no='$val'");
			foreach($exam1 as $key1 => $val1){
				$subjname = array();
				foreach($getSubj as $key2 => $val2){
					
					$getMarks = $this->alam->selectA('marks','M1,M2,M3',"admno='$val' AND ExamC='$val1' AND SCode='".$val2['subject_code']."' AND Term='TERM-1'");
					
					if($val2['opt_code'] != 1){
						if($val1 == 1 or $val1 == 8){
							$marks = round((($getMarks[0]['M3']/$getMarks[0]['M1']))*10);
							$marks = is_nan($marks)?0:$marks;
						}else{
							$marks = round((($getMarks[0]['M3']/$getMarks[0]['M1']))*40);
							$marks = is_nan($marks)?0:$marks;
						}
					}else{
						$marks = $getMarks[0]['M2'];
					}
					
					$subjname[$val2['subject_code']] = $val2['subjnm'];
					$term1[$val1][$val2['subject_code']] = [
						'subj_code' => $val2['subject_code'],
						'subj_nm'   => $val2['subjnm'],
						'opt_code'  => $val2['opt_code'],
						'M1'        => $getMarks[0]['M1'],
						'M2'        => $marks,
						'M3'        => $marks,
					];
				}
				
				if($getSubj2){
					$getMarks = $this->alam->selectA('marks','M1,M2,M3',"admno='$val' AND ExamC='$val1' AND SCode='".$getSubj2[0]['SUBCODE']."' AND Term='TERM-1'");
					
					if($getSubj2[0]['optcode2'] == 2){
						if($val1 == 1 or $val1 == 8){
							$marks = round((($getMarks[0]['M3']/$getMarks[0]['M1']))*10);
							$marks = is_nan($marks)?0:$marks;
						}else{
							$marks = round((($getMarks[0]['M3']/$getMarks[0]['M1']))*40);
							$marks = is_nan($marks)?0:$marks;
						}
					}
				}
				
				$subjname[$getSubj2[0]['SUBCODE']] = $getSubj2[0]['subjnm'];
				$term1[$val1][$getSubj2[0]['SUBCODE']] = [
					'subj_code' => $getSubj2[0]['SUBCODE'],
					'subj_nm'   => $getSubj2[0]['subjnm'],
					'opt_code'  => 2,
					'M1'        => $getMarks[0]['M1'],
					'M2'        => $marks,
					'M3'        => $marks,
				];
				
			}
			
			$term2 = array();
			foreach($exam2 as $key1 => $val1){
				foreach($getSubj as $key2 => $val2){
					
					$getMarks = $this->alam->selectA('marks','M1,M2,M3',"admno='$val' AND ExamC='$val1' AND SCode='".$val2['subject_code']."' AND Term='TERM-2'");
					
					if($val2['opt_code'] != 1){
						if($val1 == 1 or $val1 == 8){
							$marks = round((($getMarks[0]['M3']/$getMarks[0]['M1']))*10);
							$marks = is_nan($marks)?0:$marks;
						}else{
							$marks = round((($getMarks[0]['M3']/$getMarks[0]['M1']))*40);
							$marks = is_nan($marks)?0:$marks;
						}
					}else{
						$marks = $getMarks[0]['M2'];
					}
					
					$term2[$val1][$val2['subject_code']] = [
						'subj_code' => $val2['subject_code'],
						'subj_nm'   => $val2['subjnm'],
						'opt_code'  => $val2['opt_code'],
						'M1'        => $getMarks[0]['M1'],
						'M2'        => $marks,
						'M3'        => $marks,
					];
				}
				
				if($getSubj2){
					$getMarks = $this->alam->selectA('marks','M1,M2,M3',"admno='$val' AND ExamC='$val1' AND SCode='".$getSubj2[0]['SUBCODE']."' AND Term='TERM-2'");
					
					if($val2['opt_code'] != 1){
						if($val1 == 1 or $val1 == 8){
							$marks = round((($getMarks[0]['M3']/$getMarks[0]['M1']))*10);
							$marks = is_nan($marks)?0:$marks;
						}else{
							$marks = round((($getMarks[0]['M3']/$getMarks[0]['M1']))*40);
							$marks = is_nan($marks)?0:$marks;
						}
					}else{
						$marks = $getMarks[0]['M2'];
					}
				}
				
				$term2[$val1][$getSubj2[0]['SUBCODE']] = [
					'subj_code' => $getSubj2[0]['SUBCODE'],
					'subj_nm'   => $getSubj2[0]['subjnm'],
					'opt_code'  => 2,
					'M1'        => $getMarks[0]['M1'],
					'M2'        => $marks,
					'M3'        => $marks,
				];
				
			}
			
			$result[$getStu[0]['ADM_NO']] = [
				'admno'      => $getStu[0]['ADM_NO'],
				'roll'       => $getStu[0]['ROLL_NO'],
				'stunm'      => $getStu[0]['FIRST_NM'],
				'fname'      => $getStu[0]['FATHER_NM'],
				'mname'      => $getStu[0]['MOTHER_NM'],
				'class'      => $getStu[0]['DISP_CLASS'],
				'sec'        => $getStu[0]['DISP_SEC'],
				'dob'        => $getStu[0]['BIRTH_DT'],
				'subject_nm' => $subjname,
				'term1'      => $term1,
				'term2'      => $term2
			];
		}
		// echo "<pre>";
		// print_r($result);
		// die;
		$data['result'] = $result;
		$this->load->view('report_card/annual_report_card_ix_new',$data);
	}
	
	
	public function generatePDF_ix_x_int(){
		$school_setting = $this->alam->select('school_setting','*');
		$school_photo   = $this->alam->select('school_photo','*');
		$reportCardType_data = $this->alam->select('misc_table','*');
		$data['report_card_type'] = $reportCardType_data[0]->report_card_type;
		$data['grademaster'] = $this->alam->select('grademaster','*');
		$data['signature'] = $this->alam->select('signature','*');
		$adm_no = $this->input->post('stu_adm_no[]');
		$term = $this->input->post('term');
		$date = $this->input->post('date');
		$classs = $this->input->post('classs');
		$examModedata = $this->alam->select('classes','ExamMode',"Class_No='$classs'");
		$examode = $examModedata[0]->ExamMode;
		$sec = $this->input->post('sec');
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
		//end attendance //
		$examcode = array();
		$pt_all_marks = array();
		$result = array();
		if($examode == 1)//diffrentiate CBSE or CMC
		{
			if($term == 1)
			{
				$term = 'TERM-1';
				$examcode = array('8','4');
			}else
			{
				$term = 'TERM-2';
				$examcode = array('1','2','3','5');
			}
			foreach ($adm_no as $key => $value) {
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
					if($check_student_subject)
					{
						$sub_code = $val2['subject_code'];
						$pt_type = $val2['pt_type'];
						$final_marks = array();
						$result[$value]['sub'][$key2]['subject_name'] = $val2['subj_nm'];
						$result[$value]['sub'][$key2]['opt_code'] = $val2['opt_code'];
				foreach ($examcode as $keys => $val) {
							($val==1)?$examC="8":$examC=$val;
							$marks =array();
							$tot_per = 0;
							$all_marks = $this->sumit->fetchAllData('M1,M2,M3,ExamC','marks',"admno='$value' AND ExamC IN ($examC) AND SCode='$sub_code' AND Term='$term' AND status = '1'");
							$wetageMarks = $this->sumit->fetchSingleData('wetage2','exammaster',array('ExamCode'=>$val));
							$absent = array();
							$ab = 0;
							if($val == 1){
								$mark = array();
								if($pt_type == 1)
								{
									foreach ($all_marks as $key4 => $value4) {

										$mark[$key4] = ($value4['M3']/$value4['M1']) * 10;
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

										$mark[$key4] = ($value4['M3']/$value4['M1']) * 10;
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

										$mark[$key4] = ($value4['M3']/$value4['M1']) * 10;
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
									//$mark = ($all_marks[0]['M3']/$all_marks[0]['M1']) * $wetageMarks['wetage1'];
									$mark = $all_marks[0]['M3'];

									$mark = ($all_marks[0]['M2'] == 'AB' || $all_marks[0]['M2'] == '-')?$all_marks[0]['M2']:$mark;
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
						$marks['pt'] = $final_marks[0]; 
						$marks['pt_s'] = round(($final_marks[0]));
						// $marks['notebook'] = $final_marks[1];
						// $marks['subject_enrichment'] =$final_marks[2];
						$marks['half_yearly'] = $final_marks[1];
						$marks['half_yearly_s'] = round(($final_marks[1]));
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
			$this->load->view('report_card/report_card_cbse_pdf_ix_x_int',$data);
		}
	}
	
	public function generatePDF_annual_junior()
	{
		$school_setting = $this->alam->select('school_setting','*');
		$school_photo   = $this->alam->select('school_photo','*');
		$reportCardType_data = $this->alam->select('misc_table','*');
		$data['report_card_type'] = $reportCardType_data[0]->report_card_type;
		$data['grademaster'] = $this->alam->select('grademaster','*');
		$data['signature'] = $this->alam->select('signature','*');
		$adm_no = $this->input->post('stu_adm_no[]');
		$term = $this->input->post('term');
		$date = $this->input->post('date');
		$classs = $this->input->post('classs');
		$examModedata = $this->alam->select('classes','ExamMode',"Class_No='$classs'");
		$examode = $examModedata[0]->ExamMode;
		$sec = $this->input->post('sec');
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
		//end attendance //
		$examcode = array();
		$pt_all_marks = array();
		$result = array();
		
		$term = 'TERM-1';
				$examcode = array('4','5');
			
			foreach ($adm_no as $key => $value) {
				
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
					if($check_student_subject)
					{
						$sub_code = $val2['subject_code'];
						$pt_type = $val2['pt_type'];
						$final_marks = array();
						$result[$value]['sub'][$key2]['subject_name'] = $val2['subj_nm'];
						$result[$value]['sub'][$key2]['opt_code'] = $val2['opt_code'];

						foreach ($examcode as $keys => $val) {

							$examC=$val;
						
							$marks =array();
							$tot_per = 0;
							$all_marks = $this->sumit->fetchAllData('M1,M2,M3,ExamC','marks',"admno='$value' AND ExamC IN ($examC) AND SCode='$sub_code'  AND status = '1'");
							
							
							$wetageMarks = $this->sumit->fetchSingleData('wetage1','exammaster',array('ExamCode'=>$val));
							$absent = array();
							$ab = 0;
							if($val == 1){
								$mark = array();
								if($pt_type == 1)
								{
									
									foreach ($all_marks as $key4 => $value4) {
										if($sub_code =='15'){
										$mark[$key4] = ($value4['M3']/$value4['M1']) * 10;
										}else if($sub_code =='8'){
										$mark[$key4] = ($value4['M3']/$value4['M1']) * 100;
										}else{
										$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetageMarks['wetage1'];
										}
										
										
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
									
									foreach ($all_marks as $key4 => $value4) 
									{
										
										$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetageMarks['wetage1'];
										
										
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
										
										$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetageMarks['wetage1'];
										
										$absent[$key4] = $value4['M2'];
									}
									
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
									
									if($class == '1' || $class == '2' || $class == '3' || $class == '4'){
										$mark = ($all_marks[0]['M3']/$all_marks[0]['M1']) * 100;
									}else{
										if($sub_code =='8'){
										   $mark = ($all_marks[0]['M3']/$all_marks[0]['M1']) * 100;
										 }else{
										   $mark = ($all_marks[0]['M3']/$all_marks[0]['M1']) * $wetageMarks['wetage1'];
										 }	
									}
								
									 $mark = ($all_marks[0]['M2'] == 'AB' || $all_marks[0]['M2'] == '-')?$all_marks[0]['M2']:$mark;
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
						
						
						$marks['pt'] = 0; 
						$marks['notebook'] = 0;
						$marks['subject_enrichment'] =0;
						if($sub_code =='15'){ $marks['half_yearly'] = $final_marks[0]/2; }else{
						$marks['half_yearly'] = $final_marks[0]; };
						$pt_marks = ($marks['pt'] == 'AB' || $marks['pt'] == '-')?0:$marks['pt'];
						$notebook_marks = ($marks['notebook'] == 'AB' || $marks['notebook'] == '-')?0:$marks['notebook'];
						$se_marks = ($marks['subject_enrichment'] == 'AB' || $marks['subject_enrichment'] == '-')?0:$marks['subject_enrichment'];
						$hy_marks = ($marks['half_yearly'] == 'AB' || $marks['half_yearly'] == '-')?0:$marks['half_yearly'];

						$marks_obtained = $pt_marks + $notebook_marks + $se_marks + $hy_marks;
						$marks['marks_obtained'] = ($round_off==1)?round($marks_obtained): number_format($marks_obtained,2);
						$marks['marks_obtained_t2'] = $final_marks[1];
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
			if($class == '1' || $class == '2' || $class == '3' || $class == '4'||$class == '5' || $class == '6' || $class == '7'){
				foreach($result as $keyf => $valf){
					$this->db->query("delete from iii_v_tabulaton_save where ADM_NO='".$valf['ADM_NO']."'");
					$stu_insert = [
						'ADM_NO'     => $valf['ADM_NO'],
						'CLASS'      => $valf['CLASS'],
						'SEC'        => $valf['SEC'],
						'DISP_CLASS' => $valf['DISP_CLASS'],
						'DISP_SEC'   => $valf['DISP_SEC'],
						'ROLL_NO'    => $valf['ROLL_NO'],
						'FIRST_NM'   => $valf['FIRST_NM'],
						'MIDDLE_NM'  => $valf['MIDDLE_NM'],
						'TITLE_NM'   => $valf['TITLE_NM'],
					];
					
					$this->alam->insert('iii_v_tabulaton_save',$stu_insert);
					$last_insert_id = $this->db->insert_id();
					if(!(isset($valf['sub']) && !empty($valf['sub']))){
						continue;
					}
					$marksf = array();
					foreach($valf['sub'] as $keyf1 => $valf1){
						$marksf[] = [
							'iii_v_tabulaton_save_id' => $last_insert_id,
							'subject_name'            => $valf1['subject_name'],
							'pt'                      => $valf1['marks']['pt'],
							'half_yearly'             => $valf1['marks']['half_yearly'],
							'marks_obtained'          => $valf1['marks']['marks_obtained'],
							'grade'                   => $valf1['marks']['grade'],
						];
					}
				
					
					$this->alam->insert_multiple('iii_v_tabulaton_marks_save',$marksf);
				}
				if($class == '5' || $class == '6' || $class == '7'){
					$this->load->view('report_card/report_card_cbsc_pdf_III_V',$data);
				}elseif($class == '1' || $class == '2' || $class == '3' || $class == '4'){
					$this->load->view('report_card/report_card_cbsc_pdf_PREP_II_annual_junior',$data);
				}
			}else{
				$this->load->view('report_card/report_card_cbsc_pdf',$data);
			}
		
		
	}
		public function generatePDF_annual_mdl()
	{
		$school_setting = $this->alam->select('school_setting','*');
		$school_photo   = $this->alam->select('school_photo','*');
		$reportCardType_data = $this->alam->select('misc_table','*');
		$data['report_card_type'] = $reportCardType_data[0]->report_card_type;
		$data['grademaster'] = $this->alam->select('grademaster','*');
		$data['signature'] = $this->alam->select('signature','*');
		$adm_no = $this->input->post('stu_adm_no[]');
		$term = $this->input->post('term');
		$date = $this->input->post('date');
		$classs = $this->input->post('classs');
		$examModedata = $this->alam->select('classes','ExamMode',"Class_No='$classs'");
		$examode = $examModedata[0]->ExamMode;
		$sec = $this->input->post('sec');
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
		//end attendance //
		$examcode = array();
		$pt_all_marks = array();
		$result = array();
		
		$term = 'TERM-1';
				$examcode = array('1','4','1','5');
			
			foreach ($adm_no as $key => $value) {
				
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
					if($check_student_subject)
					{
						$sub_code = $val2['subject_code'];
						$pt_type = $val2['pt_type'];
						$final_marks = array();
						$result[$value]['sub'][$key2]['subject_name'] = $val2['subj_nm'];
						$result[$value]['sub'][$key2]['opt_code'] = $val2['opt_code'];

						foreach ($examcode as $keys => $val) {

							$examC=$val;
						if($keys ==0 || $keys ==1){
						$tearm='TERM-1';
						}else{
						$tearm='TERM-2';
						}
							$marks =array();
							$tot_per = 0;
							$all_marks = $this->sumit->fetchAllData('M1,M2,M3,ExamC','marks',"admno='$value' AND ExamC IN ($examC) AND SCode='$sub_code' AND Term='$tearm' AND status = '1'");
							$wetageMarks = $this->sumit->fetchSingleData('wetage1','exammaster',array('ExamCode'=>$val));
							$absent = array();
							$ab = 0;
							if($val == 1){
								$mark = array();
								if($pt_type == 1)
								{
									
									foreach ($all_marks as $key4 => $value4) {
										if($sub_code =='15'){
										$mark[$key4] = ($value4['M3']/$value4['M1']) * 10;
										}else if($sub_code =='8'){
										$mark[$key4] = ($value4['M3']/$value4['M1']) * 100;
										}else{
										$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetageMarks['wetage1'];
										}
										
										
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
									
									foreach ($all_marks as $key4 => $value4) 
									{
										
										$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetageMarks['wetage1'];
										
										
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
										
										$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetageMarks['wetage1'];
										
										$absent[$key4] = $value4['M2'];
									}
									
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
									
									if($class == '1' || $class == '2' || $class == '3' || $class == '4'){
										$mark = ($all_marks[0]['M3']/$all_marks[0]['M1']) * 100;
									}else{
										if($sub_code =='8'){
										   $mark = ($all_marks[0]['M3']/$all_marks[0]['M1']) * 100;
										 }else{
										   $mark = ($all_marks[0]['M3']/$all_marks[0]['M1']) * $wetageMarks['wetage1'];
										 }	
									}
								
									 $mark = ($all_marks[0]['M2'] == 'AB' || $all_marks[0]['M2'] == '-')?$all_marks[0]['M2']:$mark;
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
						
						
						$marks['pt'] = $final_marks[0]; 
						$marks['notebook'] = 0;
						$marks['subject_enrichment'] =0;
						if($sub_code =='15'){ $marks['half_yearly'] = $final_marks[1]/2; }else{
						$marks['half_yearly'] = $final_marks[1]; };
						$pt_marks = ($marks['pt'] == 'AB' || $marks['pt'] == '-')?0:$marks['pt'];
						$notebook_marks = ($marks['notebook'] == 'AB' || $marks['notebook'] == '-')?0:$marks['notebook'];
						$se_marks = ($marks['subject_enrichment'] == 'AB' || $marks['subject_enrichment'] == '-')?0:$marks['subject_enrichment'];
						$hy_marks = ($marks['half_yearly'] == 'AB' || $marks['half_yearly'] == '-')?0:$marks['half_yearly'];

						$marks_obtained = $pt_marks + $notebook_marks + $se_marks + $hy_marks;
						$marks['marks_obtained'] = ($round_off==1)?round($marks_obtained): number_format($marks_obtained,2);
						
						
							
						$marks['pt_t2'] = $final_marks[2];
						$marks['half_yearly_t2'] = $final_marks[3];
						$pt_marks2 = ($marks['pt_t2'] == 'AB' || $marks['pt_t2'] == '-')?0:$marks['pt_t2'];
						
						$hy_marks2 = ($marks['half_yearly_t2'] == 'AB' || $marks['half_yearly_t2'] == '-')?0:$marks['half_yearly_t2'];

						$marks_obtained2 = ($pt_marks2 + $hy_marks2);
						$marks['marks_obtained_t2'] = ($round_off==1)?round($marks_obtained2): number_format($marks_obtained2,2);
						$gradeData = $this->sumit->fetchSingleData('Grade,Qualitative_Norms','grademaster',"ORange >=$marks_obtained AND CRange <= $marks_obtained");
						$marks['grade'] = $gradeData['Grade'];
						
						$gradeData2 = $this->sumit->fetchSingleData('Grade,Qualitative_Norms','grademaster',"ORange >=$marks_obtained2 AND CRange <= $marks_obtained2");
						$marks['grade2'] = $gradeData2['Grade'];
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
			if($class == '1' || $class == '2' || $class == '3' || $class == '4'||$class == '5' || $class == '6' || $class == '7'){
				foreach($result as $keyf => $valf){
					$this->db->query("delete from iii_v_tabulaton_save where ADM_NO='".$valf['ADM_NO']."'");
					$stu_insert = [
						'ADM_NO'     => $valf['ADM_NO'],
						'CLASS'      => $valf['CLASS'],
						'SEC'        => $valf['SEC'],
						'DISP_CLASS' => $valf['DISP_CLASS'],
						'DISP_SEC'   => $valf['DISP_SEC'],
						'ROLL_NO'    => $valf['ROLL_NO'],
						'FIRST_NM'   => $valf['FIRST_NM'],
						'MIDDLE_NM'  => $valf['MIDDLE_NM'],
						'TITLE_NM'   => $valf['TITLE_NM'],
					];
					
					$this->alam->insert('iii_v_tabulaton_save',$stu_insert);
					$last_insert_id = $this->db->insert_id();
					if(!(isset($valf['sub']) && !empty($valf['sub']))){
						continue;
					}
					$marksf = array();
					foreach($valf['sub'] as $keyf1 => $valf1){
						$marksf[] = [
							'iii_v_tabulaton_save_id' => $last_insert_id,
							'subject_name'            => $valf1['subject_name'],
							'pt'                      => $valf1['marks']['pt'],
							'half_yearly'             => $valf1['marks']['half_yearly'],
							'marks_obtained'          => $valf1['marks']['marks_obtained'],
							'grade'                   => $valf1['marks']['grade'],
						];
					}
				
					
					$this->alam->insert_multiple('iii_v_tabulaton_marks_save',$marksf);
				}
				if($class == '5' || $class == '6' || $class == '7'){
					$this->load->view('report_card/report_card_cbsc_pdf_III_V_annual',$data);
				}elseif($class == '1' || $class == '2' || $class == '3' || $class == '4'){
					$this->load->view('report_card/report_card_cbsc_pdf_PREP_II_annual_junior',$data);
				}
			}else{
				$this->load->view('report_card/report_card_cbsc_pdf',$data);
			}
		
		
	}
	function adpdf_annual_junior(){
		$idd = $this->input->post('idd');
		$lp  = $this->input->post('lp');
		$admnoo = $this->input->post('admno');
	    $admno = str_replace("/", "-",$admnoo);
		$url=base_url('assets/dash_css/bootstrap.min.css');
		$html = '';
		$html .="<html><head><title>Report Card</title><link rel='stylesheet' href='$url'><script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js'></script><script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js'></script><link href='https://fonts.googleapis.com/css?family=Laila:700&display=swap' rel='stylesheet'>
		<style>
		 table tr th,td{
			font-size:12px!important;
			padding:3px!important;
		}
		@page { margin: 50px 12px 0px 12px; }
		.sign{
			font-family: 'Laila', serif;
			}
		</style>
	    </head><body><div style='border:5px solid #000; padding:10px;'>";
		$html .= $this->input->post('value');
	    $html .="</div></body></html>";
		
	    $this->load->library('Pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'potrait');
		$this->dompdf->render();
		$output = $this->dompdf->output();
		$path = 'report_card_annual';
		if(!is_dir($path)){
			mkdir($path,0755, true);
			file_put_contents($path.'/'.$admno .'.pdf', $output);
		}else{
			file_put_contents($path.'/'.$admno .'.pdf', $output);
		}
		$this->alam->update('student',array('t2_report_card_status' => 1),"ADM_NO='$admnoo'");
		if($idd == $lp){
			$this->session->set_userdata('ref','1');
		}
		echo $idd;
	}
	public function generatePDF_VI_VIII_T1()
	{
		error_reporting(0);
		$school_setting = $this->alam->select('school_setting','*');
		$school_photo   = $this->alam->select('school_photo','*');
		$reportCardType_data = $this->alam->select('misc_table','*');
		$data['report_card_type'] = $reportCardType_data[0]->report_card_type;
		$data['grademaster'] = $this->alam->select('grademaster','*');
		$data['signature'] = $this->alam->select('signature','*');
		$adm_no = $this->input->post('stu_adm_no[]');
		$term = $this->input->post('term');
		$date = $this->input->post('date');
		$classs = $this->input->post('classs');
		$examModedata = $this->alam->select('classes','ExamMode',"Class_No='$classs'");
		$examode = $examModedata[0]->ExamMode;
		$sec = $this->input->post('sec');
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
		//end attendance //
		$examcode = array();
		$pt_all_marks = array();
		$result = array();
		if($examode == 1)//diffrentiate CBSE or CMC
		{
			if($term == 1)
			{
				if($classs==8 || $classs==9 || $classs==10)
				{
					$term = 'TERM-1';
					$examcode = array('1','4');
				}
				elseif($classs==11 || $classs==12)
				{
					$term = 'TERM-1';
					$examcode = array('1','7');
				}
				else
				{
					$term = 'TERM-1';
					$examcode = array('4');
				}
				
			}else
			{
				$term = 'TERM-2';
				$examcode = array('1','2','3','5');
			}
			foreach ($adm_no as $key => $value) {
				
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
							
							
							
							if($classs=="5" || $classs=="6" || $classs=="7")
							{
								$wetageMarks = "100";
								//$wetageMarks = $this->sumit->fetchSingleData('wetage1','exammaster',array('ExamCode'=>$val));
							}
							else
							{
								$wetageMarks = $this->sumit->fetchSingleData('wetage1','exammaster',array('ExamCode'=>$val));
							}
							// echo $classs;
							// echo "<br/>";
							// echo $wetageMarks;

							
							$absent = array();
							$ab = 0;
							if($val == 1){
								$mark = array();
								if($pt_type == 1)
								{
									foreach ($all_marks as $key4 => $value4) {
										if($sub_code =='15'){
										$mark[$key4] = ($value4['M3']/$value4['M1']) * 10;
										}else if($sub_code =='8'){
										$mark[$key4] = ($value4['M3']/$value4['M1']) * 100;
										}else{
										//$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetageMarks['wetage1'];
											if($value4['M2']=='AB')
											{
												$mark[$key4] = 'AB';
											}
											else
											{
												$mark[$key4] = ($value4['M3']/$value4['M1']) * 10;
											}

											
											
										}
										
										
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
									foreach ($all_marks as $key4 => $value4) 
									{
										
										$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetageMarks['wetage1'];
										
										
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
										
										$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetageMarks['wetage1'];
										
										$absent[$key4] = $value4['M2'];
									}
									
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
									
									if($class == '1' || $class == '2' || $class == '3' || $class == '4'){
										$mark = ($all_marks[0]['M3']/$all_marks[0]['M1']) * 100;
									}else{
										if($sub_code =='8'){
										   $mark = ($all_marks[0]['M3']/$all_marks[0]['M1']) * 100;
										 }else{
											if($class == '8' || $class == '9' || $class == '10')
											{
												if($all_marks[0]['M2']=='AB')
												{
													$mark = 'AB';
												}
												else
												{
													$mark = ($all_marks[0]['M3']/$all_marks[0]['M1']) * 40;
												}
											}
											else
											{
											$mark = ($all_marks[0]['M3']/$all_marks[0]['M1']) * $wetageMarks['wetage1'];
											}
										 }	
									}
								
									 $mark = ($all_marks[0]['M2'] == 'AB' || $all_marks[0]['M2'] == '-')?$all_marks[0]['M2']:$mark;
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
						
	
						if($class == '8' || $class == '9' || $class == '10' || $class == '11' || $class == '12')
						{
							// $marks['pt'] = ($marks['pt'] == '')?'AB':$marks['pt']; 
							$marks['pt'] = ($final_marks[0] == 0)?'AB':$final_marks[0];
						}
						else
						{
							$marks['pt'] = 0; 
						}
						
						$marks['notebook'] = 0;
						$marks['subject_enrichment'] =0;
						if($sub_code =='15')
						{
							$marks['half_yearly'] = $final_marks[0]/2; 
						}else
						{
							$marks['half_yearly'] = $final_marks[$keys];
						};
						

						
						$pt_marks = ($marks['pt'] == 'AB' || $marks['pt'] == '-')?0:$marks['pt'];
						$notebook_marks = ($marks['notebook'] == 'AB' || $marks['notebook'] == '-')?0:$marks['notebook'];
						$se_marks = ($marks['subject_enrichment'] == 'AB' || $marks['subject_enrichment'] == '-')?0:$marks['subject_enrichment'];
						$hy_marks = ($marks['half_yearly'] == 'AB' || $marks['half_yearly'] == '-')?0:$marks['half_yearly'];

						$marks_obtained = $pt_marks + $notebook_marks + $se_marks + $hy_marks;
						$marks_obtained2 = $marks_obtained*2;
						
						$marks['marks_obtained'] = ($round_off==1)?round($marks_obtained): number_format($marks_obtained,2);
						//$gradeData = $this->sumit->fetchSingleData('Grade,Qualitative_Norms','grademaster',"ORange >=$marks_obtained AND CRange <= $marks_obtained");
						$gradeData = $this->sumit->fetchSingleData('Grade,Qualitative_Norms','grademaster',"ORange >=$marks_obtained2 AND CRange <= $marks_obtained2");
						$marks['grade'] = $gradeData['Grade'];
						$result[$value]['sub'][$key2]['marks'] = $marks;
						
					
					}
				}
			}
			$data['round_off'] = $round_off;
			$data['result']         = $result;
			// echo "<pre>";
			// print_r($result);
			//die;
			$data['school_setting'] = $school_setting;
			$data['school_photo']   = $school_photo;
			$data['trm'] = $termId;
			$data['grade_only_sub'] = $stu_data['grade_only_sub'];
			if($class == '2' || $class == '3' || $class == '4'||$class == '5' || $class == '6' || $class == '7'){
				foreach($result as $keyf => $valf){
					$this->db->query("delete from iii_v_tabulaton_save where ADM_NO='".$valf['ADM_NO']."'");
					$stu_insert = [
						'ADM_NO'     => $valf['ADM_NO'],
						'CLASS'      => $valf['CLASS'],
						'SEC'        => $valf['SEC'],
						'DISP_CLASS' => $valf['DISP_CLASS'],
						'DISP_SEC'   => $valf['DISP_SEC'],
						'ROLL_NO'    => $valf['ROLL_NO'],
						'FIRST_NM'   => $valf['FIRST_NM'],
						'MIDDLE_NM'  => $valf['MIDDLE_NM'],
						'TITLE_NM'   => $valf['TITLE_NM'],
					];
					
					$this->alam->insert('iii_v_tabulaton_save',$stu_insert);
					$last_insert_id = $this->db->insert_id();
					if(!(isset($valf['sub']) && !empty($valf['sub']))){
						continue;
					}
					$marksf = array();
					foreach($valf['sub'] as $keyf1 => $valf1){
						$marksf[] = [
							'iii_v_tabulaton_save_id' => $last_insert_id,
							'subject_name'            => $valf1['subject_name'],
							'pt'                      => $valf1['marks']['pt'],
							'half_yearly'             => $valf1['marks']['half_yearly'],
							'marks_obtained'          => $valf1['marks']['marks_obtained'],
							'grade'                   => $valf1['marks']['grade'],
						];
					}
				
					
					$this->alam->insert_multiple('iii_v_tabulaton_marks_save',$marksf);
				}
				if($class == '5' || $class == '6' || $class == '7'){
					$this->load->view('report_card/report_card_cbsc_pdf_III_V',$data);
				}elseif($class == '2' || $class == '3' || $class == '4'){
					$this->load->view('report_card/report_card_cbsc_pdf_PREP_II',$data);
				}
			}else{
				$this->load->view('report_card/report_card_cbsc_pdf_VI_VIII',$data);
			}
		}
		else
		{
			if($term == 1)
			{
				$term = 'TERM-1';
				$examcode = array('1','2','3','6','4');
			}else
			{
				$term = 'TERM-2';
				$examcode = array('1','2','3','6','5');
			}
			
			foreach ($adm_no as $key => $value) {
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
				  $data['tot_present_day'] = $attPresentData[0]->cnt;	
				}else{
				  $attPresentData = $this->alam->select('stu_attendance_entry','count(DISTINCT att_date)cnt',"class_code='$class' AND sec_code='$section' AND att_date <= '$date' AND att_status='P' AND admno='$admnum'");
				  $data['tot_present_day'] = $attPresentData[0]->cnt;		
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
							$wetageMarks = $this->sumit->fetchSingleData('wetage2','exammaster',array('ExamCode'=>$val));
							$absent = array();
							$ab = 0;
							if($val == 1){
								$mark = array();
								if($pt_type == 1)
								{
									foreach ($all_marks as $key4 => $value4) {

										
										$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetageMarks['wetage2'];
										
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

										$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetageMarks['wetage2'];
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

										$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetageMarks['wetage2'];
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

								   ($round_off==1)?$final_marks[$keys] = round($final_marks[$keys]):$final_marks[$keys] = $final_marks[$keys];
							}else{
								if(!empty($all_marks))
								{
									$mark = ($all_marks[0]['M3']/$all_marks[0]['M1']) * $wetageMarks['wetage2'];

									$mark = ($all_marks[0]['M2'] == 'AB' || $all_marks[0]['M2'] == '-')?$all_marks[0]['M2']:$mark;
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
						
						$marks['pt'] = $final_marks[0]; 
						$marks['notebook'] = $final_marks[1];
						$marks['activity'] = $final_marks[2];
						$marks['subject_enrichment'] =$final_marks[3];
						$marks['half_yearly'] = $final_marks[4];

						$pt_marks = ($marks['pt'] == 'AB' || $marks['pt'] == '-')?0:$marks['pt'];
						$notebook_marks = ($marks['notebook'] == 'AB' || $marks['notebook'] == '-')?0:$marks['notebook'];
						$activity_marks = ($marks['activity'] == 'AB' || $marks['activity'] == '-')?0:$marks['activity'];
						$se_marks = ($marks['subject_enrichment'] == 'AB' || $marks['subject_enrichment'] == '-')?0:$marks['subject_enrichment'];
						$hy_marks = ($marks['half_yearly'] == 'AB' || $marks['half_yearly'] == '-')?0:$marks['half_yearly'];

						$marks_obtained = $pt_marks + $notebook_marks + $se_marks + $hy_marks + $activity_marks;
						$marks['marks_obtained'] = ($round_off==1)?round($marks_obtained): number_format($marks_obtained,2);
						$gradeData = $this->sumit->fetchSingleData('Grade,Qualitative_Norms','grademaster',"ORange >=$marks_obtained AND CRange <= $marks_obtained");
						$marks['grade'] = $gradeData['Grade'];
						$result[$value]['sub'][$key2]['marks'] = $marks;
					}
				}
			}
			$data['round_off'] = $round_off;
			$data['result']    = $result;
			$data['school_setting'] = $school_setting;
			$data['trm'] = $termId;
			$data['grade_only_sub'] = $stu_data['grade_only_sub'];
			$this->load->view('report_card/report_card_cmc_pdf',$data);
		}
	}
	
	
	public function generatePDF_VI_VIII_T1_new(){
		$data['school_setting'] = $this->alam->select('school_setting','*');
		$data['school_photo']   = $this->alam->select('school_photo','*');
		$data['grademaster']    = $this->alam->select('grademaster','*');
		$data['signature']      = $this->alam->select('signature','*');
		$adm_no                 = $this->input->post('stu_adm_no');
		$term                   = $this->input->post('term');
		$date                   = $this->input->post('date');
		$classs                 = $this->input->post('classs');
		$sec                    = $this->input->post('sec');
		$round_off              = $this->input->post('round_off');
		
		$getSubj = $this->db->query("select opt_code,subject_code,(select SubName from subjects where SubCode=class_section_wise_subject_allocation.subject_code)subjnm from class_section_wise_subject_allocation where Class_No='$classs' AND section_no='$sec' AND applicable_exam='1' AND opt_code in(0,1) order by sorting_no")->result_array();
		
		$exam1 = array('1','4');
		$exam2 = array('1','5');
		
		$result = array();
		foreach($adm_no as $key => $val){
			$getStu = $this->alam->selectA('student','ADM_NO,ROLL_NO,FIRST_NM,FATHER_NM,MOTHER_NM,DISP_CLASS,DISP_SEC,C_MOBILE',"CLASS='$classs' AND SEC='$sec' AND Student_Status='ACTIVE' AND ADM_NO='$val'");
			
			$term1 = array();
			foreach($exam1 as $key1 => $val1){
				$subjname = array();
				foreach($getSubj as $key2 => $val2){
					
					$getMarks = $this->alam->selectA('marks','M1,M2,M3',"admno='$val' AND ExamC='$val1' AND SCode='".$val2['subject_code']."' AND Term='TERM-1'");
					if($val1 == 1){
						$marks = round((($getMarks[0]['M3']/$getMarks[0]['M1']))*10);
						$marks = is_nan($marks)?0:$marks;
					}else{
						$marks = round((($getMarks[0]['M3']/$getMarks[0]['M1']))*40);
						$marks = is_nan($marks)?0:$marks;
					}
					$subjname[$val2['subject_code']] = $val2['subjnm'];
					$term1[$val1][$val2['subject_code']] = [
						'subj_code' => $val2['subject_code'],
						'subj_nm'   => $val2['subjnm'],
						'opt_code'  => $val2['opt_code'],
						'M1'        => $getMarks[0]['M1'],
						'M2'        => $marks,
						'M3'        => $marks,
					];
				}
			}
			
			$term2 = array();
			foreach($exam2 as $key1 => $val1){
				foreach($getSubj as $key2 => $val2){
					$getMarks = $this->alam->selectA('marks','M1,M2,M3',"admno='$val' AND ExamC='$val1' AND SCode='".$val2['subject_code']."' AND Term='TERM-2'");
					if($val1 == 1){
						$marks = round((($getMarks[0]['M3']/$getMarks[0]['M1']))*10);
						$marks = is_nan($marks)?0:$marks;
					}else{
						$marks = round((($getMarks[0]['M3']/$getMarks[0]['M1']))*40);
						
						$marks = is_nan($marks)?0:$marks;
					}
					$term2[$val1][$val2['subject_code']] = [
						'subj_code' => $val2['subject_code'],
						'subj_nm'   => $val2['subjnm'],
						'opt_code'  => $val2['opt_code'],
						'M1'        => $getMarks[0]['M1'],
						'M2'        => $marks,
						'M3'        => $marks,
					];
				}
			}
			
			$result[$getStu[0]['ADM_NO']] = [
				'admno'      => $getStu[0]['ADM_NO'],
				'roll'       => $getStu[0]['ROLL_NO'],
				'stunm'      => $getStu[0]['FIRST_NM'],
				'fname'      => $getStu[0]['FATHER_NM'],
				'mname'      => $getStu[0]['MOTHER_NM'],
				'class'      => $getStu[0]['DISP_CLASS'],
				'sec'        => $getStu[0]['DISP_SEC'],
				'mob'        => $getStu[0]['C_MOBILE'],
				'subject_nm' => $subjname,
				'term1'      => $term1,
				'term2'      => $term2
			];
		}
		
		
		$this->db->query("delete from temp_class_viii_rc where class='".$getStu[0]['DISP_CLASS']."' AND sec='".$getStu[0]['DISP_SEC']."'");
		$data['result'] = $result;
		$this->load->view('report_card/report_card_cbsc_pdf_VI_VIII',$data);
		
	}
	
	public function generatePDF_VI_VIII_Annual()
	{
		error_reporting(0);
		$school_setting = $this->alam->select('school_setting','*');
		$school_photo   = $this->alam->select('school_photo','*');
		$reportCardType_data = $this->alam->select('misc_table','*');
		$data['report_card_type'] = $reportCardType_data[0]->report_card_type;
		$data['grademaster'] = $this->alam->select('grademaster','*');
		$data['signature'] = $this->alam->select('signature','*');
		$adm_no = $this->input->post('stu_adm_no[]');
		$term = $this->input->post('term');
		$date = $this->input->post('date');
		$classs = $this->input->post('classs');
		$examModedata = $this->alam->select('classes','ExamMode',"Class_No='$classs'");
		$examode = $examModedata[0]->ExamMode;
		$sec = $this->input->post('sec');
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
		//end attendance //
		$examcode = array();
		$pt_all_marks = array();
		$result = array();
		if($examode == 1)//diffrentiate CBSE or CMC
		{
			if($term == 1)
			{
				if($classs==8 || $classs==9 || $classs==10)
				{
					$term = 'TERM-1';
					$examcode = array('1','4');
					
					$termT2 = 'TERM-2';
					$examcodeT2 = array('1','5');
					$examCT2 = array('1','5');
				}
				elseif($classs==11 || $classs==12)
				{
					$term = 'TERM-1';
					$examcode = array('1','7');
				}
				else
				{
					$term = 'TERM-1';
					$examcode = array('4');
				}
				
			}else
			{
				$term = 'TERM-2';
				$examcode = array('1','2','3','5');
			}
			foreach ($adm_no as $key => $value) {
				
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
					if($check_student_subject)
					{
						$sub_code = $val2['subject_code'];
						$pt_type = $val2['pt_type'];
						$final_marks = array();
						$final_marksT2 = array();
						$result[$value]['sub'][$key2]['subject_name'] = $val2['subj_nm'];
						$result[$value]['sub'][$key2]['opt_code'] = $val2['opt_code'];
				foreach ($examcode as $keys => $val) {


							($val==1)?$examC="1,7,8":$examC=$val;
			
							$marks =array();
							$marksT2 =array();
							$tot_per = 0;
							$tot_perT2 = 0;
							$all_marks = $this->sumit->fetchAllData('M1,M2,M3,ExamC','marks',"admno='$value' AND ExamC IN ($examC) AND SCode='$sub_code' AND Term='$term' AND status = '1'");
							$all_marksT2 = $this->sumit->fetchAllData('M1,M2,M3,ExamC','marks',"admno='$value' AND ExamC IN ($examCT2) AND SCode='$sub_code' AND Term='$termT2' AND status = '1'");
							
							
							
							if($classs=="5" || $classs=="6" || $classs=="7")
							{
							
							}
							else
							{
								$wetageMarks = $this->sumit->fetchSingleData('wetage1','exammaster',array('ExamCode'=>$val));
								$wetageMarksT2 = $this->sumit->fetchSingleData('wetage1','exammaster',array('ExamCode'=>$val));
							}
					
							
							$absent = array();
							$ab = 0;
							if($val == 1){
								$mark = array();
								if($pt_type == 1)
								{
									foreach ($all_marks as $key4 => $value4) {
										if($sub_code =='15'){
										$mark[$key4] = ($value4['M3']/$value4['M1']) * 10;
										}else if($sub_code =='8'){
										$mark[$key4] = ($value4['M3']/$value4['M1']) * 100;
										}else{
										//$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetageMarks['wetage1'];
											if($value4['M2']=='AB')
											{
												$mark[$key4] = 'AB';
											}
											else
											{
												$mark[$key4] = ($value4['M3']/$value4['M1']) * 10;
											}

											
											
										}
										
										
										$absent[$key4] = $value4['M2'];
									}
									foreach ($all_marksT2 as $key4 => $value4) {
										if($sub_code =='15'){
										$markT2[$key4] = ($value4['M3T2']/$value4['M1T2']) * 10;
										}else if($sub_code =='8'){
										$markT2[$key4] = ($value4['M3T2']/$value4['M1T2']) * 100;
										}else{
										//$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetageMarks['wetage1'];
											if($value4['M2T2']=='AB')
											{
												$markT2[$key4] = 'AB';
											}
											else
											{
												$markT2[$key4] = ($value4['M3T2']/$value4['M1T2']) * 10;
											}

											
											
										}
										
										
										$absent[$key4] = $value4['M2T2'];
									}


									$absent_count = count($absent);
									$total_ab_count = array_count_values($absent);
									$total_ab_count['AB'] = (!isset($total_ab_count['AB']))?0:$total_ab_count['AB'];
									$ab = ($absent_count == $total_ab_count['AB'])?'AB':'0';
									$final_marks[$keys] = ($ab == 'AB')?$ab:number_format(max($mark),2);
									
									$absent_count = count($absent);
									$total_ab_count = array_count_values($absent);
									$total_ab_count['AB'] = (!isset($total_ab_count['AB']))?0:$total_ab_count['AB'];
									$ab = ($absent_count == $total_ab_count['AB'])?'AB':'0';
									$final_marksT2[$keys] = ($ab == 'AB')?$ab:number_format(max($markT2),2);

								}
								elseif($pt_type == 2)
								{		
									
								}
								else
								{ 
									
								}

								  $final_marks[$keys]=($round_off==1)?round($final_marks[$keys]):$final_marks[$keys];
								$final_marksT2[$keys]=($round_off==1)?round($final_marksT2[$keys]):$final_marksT2[$keys];
									
							}else{
								if(!empty($all_marks))
								{
									
									if($class == '1' || $class == '2' || $class == '3' || $class == '4'){
										$mark = ($all_marks[0]['M3']/$all_marks[0]['M1']) * 100;
									}else{
										if($sub_code =='8'){
										   $mark = ($all_marks[0]['M3']/$all_marks[0]['M1']) * 100;
										 }else{
											if($class == '8' || $class == '9' || $class == '10')
											{
												if($all_marks[0]['M2']=='AB')
												{
													$mark = 'AB';
												}
												else
												{
													$mark = ($all_marks[0]['M3']/$all_marks[0]['M1']) * 40;
												}
											}
											else
											{
											$mark = ($all_marks[0]['M3']/$all_marks[0]['M1']) * $wetageMarks['wetage1'];
											}
										 }	
									}
								
									 $mark = ($all_marks[0]['M2'] == 'AB' || $all_marks[0]['M2'] == '-')?$all_marks[0]['M2']:$mark;
								}
								
							if(!empty($all_marksT2))
								{
									
									if($class == '1' || $class == '2' || $class == '3' || $class == '4'){
										
									}else{
										if($sub_code =='8'){
										   $markT2 = ($all_marksT2[0]['M3T2']/$all_marksT2[0]['M1T2']) * 100;
										 }else{
											if($class == '8' || $class == '9' || $class == '10')
											{
												if($all_marksT2[0]['M2T2']=='AB')
												{
													$markT2 = 'AB';
												}
												else
												{
													$markT2 = ($all_marksT2[0]['M3T2']/$all_marksT2[0]['M1T2']) * 40;
												}
											}
											else
											{
											$markT2 = ($all_marksT2[0]['M3T2']/$all_marksT2[0]['M1T2']) * $wetageMarks['wetage1'];
											}
										 }	
									}
								
									 $markT2 = ($all_marksT2[0]['M2T2'] == 'AB' || $all_marksT2[0]['M2T2'] == '-')?$all_marksT2[0]['M2T2']:$markT2;
								}
								else
								{
									$markT2 = 0;
								}
								if($markT2 == 'AB' || $markT2 == '-')
								{
									$final_marksT2[$keys] = $markT2;
								}
								else
								{
									$final_marksT2[$keys] = ($round_off==1)?round($markT2): number_format($markT2,2);								
								}
								
							}
						}
						
	
						if($class == '8' || $class == '9' || $class == '10' || $class == '11' || $class == '12')
						{
							// $marks['pt'] = ($marks['pt'] == '')?'AB':$marks['pt']; 
							$marksT2['pt'] = ($final_marksT2[0] == 0)?'AB':$final_marksT2[0];
						}
						else
						{
							$marksT2['pt'] = 0; 
						}
						
						$marksT2['notebook'] = 0;
						$marksT2['subject_enrichment'] =0;
						if($sub_code =='15')
						{
							$marksT2['half_yearly'] = $final_marksT2[0]/2; 
						}else
						{
							$marksT2['half_yearly'] = $final_marksT2[$keys];
						};
						

						
						$pt_marks = ($marks['pt'] == 'AB' || $marks['pt'] == '-')?0:$marks['pt'];
						$notebook_marks = ($marks['notebook'] == 'AB' || $marks['notebook'] == '-')?0:$marks['notebook'];
						$se_marks = ($marks['subject_enrichment'] == 'AB' || $marks['subject_enrichment'] == '-')?0:$marks['subject_enrichment'];
						$hy_marks = ($marks['half_yearly'] == 'AB' || $marks['half_yearly'] == '-')?0:$marks['half_yearly'];

						$marks_obtained = $pt_marks + $notebook_marks + $se_marks + $hy_marks;
						$marks_obtained2 = $marks_obtained*2;
						
						$marks['marks_obtained'] = ($round_off==1)?round($marks_obtained): number_format($marks_obtained,2);
						//$gradeData = $this->sumit->fetchSingleData('Grade,Qualitative_Norms','grademaster',"ORange >=$marks_obtained AND CRange <= $marks_obtained");
						$gradeData = $this->sumit->fetchSingleData('Grade,Qualitative_Norms','grademaster',"ORange >=$marks_obtained2 AND CRange <= $marks_obtained2");
						$marks['grade'] = $gradeData['Grade'];
						$result[$value]['sub'][$key2]['marks'] = $marks;
						
					
					}
				}
			}
			$data['round_off'] = $round_off;
			$data['result']         = $result;
			// echo "<pre>";
			// print_r($result);
			//die;
			$data['school_setting'] = $school_setting;
			$data['school_photo']   = $school_photo;
			$data['trm'] = $termId;
			$data['grade_only_sub'] = $stu_data['grade_only_sub'];
			if($class == '2' || $class == '3' || $class == '4'||$class == '5' || $class == '6' || $class == '7'){
				foreach($result as $keyf => $valf){
					$this->db->query("delete from iii_v_tabulaton_save where ADM_NO='".$valf['ADM_NO']."'");
					$stu_insert = [
						'ADM_NO'     => $valf['ADM_NO'],
						'CLASS'      => $valf['CLASS'],
						'SEC'        => $valf['SEC'],
						'DISP_CLASS' => $valf['DISP_CLASS'],
						'DISP_SEC'   => $valf['DISP_SEC'],
						'ROLL_NO'    => $valf['ROLL_NO'],
						'FIRST_NM'   => $valf['FIRST_NM'],
						'MIDDLE_NM'  => $valf['MIDDLE_NM'],
						'TITLE_NM'   => $valf['TITLE_NM'],
					];
					
					$this->alam->insert('iii_v_tabulaton_save',$stu_insert);
					$last_insert_id = $this->db->insert_id();
					if(!(isset($valf['sub']) && !empty($valf['sub']))){
						continue;
					}
					$marksf = array();
					foreach($valf['sub'] as $keyf1 => $valf1){
						$marksf[] = [
							'iii_v_tabulaton_save_id' => $last_insert_id,
							'subject_name'            => $valf1['subject_name'],
							'pt'                      => $valf1['marks']['pt'],
							'half_yearly'             => $valf1['marks']['half_yearly'],
							'marks_obtained'          => $valf1['marks']['marks_obtained'],
							'grade'                   => $valf1['marks']['grade'],
						];
					}
				
					
					$this->alam->insert_multiple('iii_v_tabulaton_marks_save',$marksf);
				}
				if($class == '5' || $class == '6' || $class == '7'){
					$this->load->view('report_card/report_card_cbsc_pdf_III_V',$data);
				}elseif($class == '2' || $class == '3' || $class == '4'){
					$this->load->view('report_card/report_card_cbsc_pdf_PREP_II',$data);
				}
			}else{
				$this->load->view('report_card/report_card_cbsc_pdf_VI_VIII',$data);
			}
		}
		else
		{
			if($term == 1)
			{
				$term = 'TERM-1';
				$examcode = array('1','2','3','6','4');
			}else
			{
				$term = 'TERM-2';
				$examcode = array('1','2','3','6','5');
			}
			
			foreach ($adm_no as $key => $value) {
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
				  $data['tot_present_day'] = $attPresentData[0]->cnt;	
				}else{
				  $attPresentData = $this->alam->select('stu_attendance_entry','count(DISTINCT att_date)cnt',"class_code='$class' AND sec_code='$section' AND att_date <= '$date' AND att_status='P' AND admno='$admnum'");
				  $data['tot_present_day'] = $attPresentData[0]->cnt;		
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
							$wetageMarks = $this->sumit->fetchSingleData('wetage2','exammaster',array('ExamCode'=>$val));
							$absent = array();
							$ab = 0;
							if($val == 1){
								$mark = array();
								if($pt_type == 1)
								{
									foreach ($all_marks as $key4 => $value4) {

										
										$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetageMarks['wetage2'];
										
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

										$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetageMarks['wetage2'];
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

										$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetageMarks['wetage2'];
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

								   ($round_off==1)?$final_marks[$keys] = round($final_marks[$keys]):$final_marks[$keys] = $final_marks[$keys];
							}else{
								if(!empty($all_marks))
								{
									$mark = ($all_marks[0]['M3']/$all_marks[0]['M1']) * $wetageMarks['wetage2'];

									$mark = ($all_marks[0]['M2'] == 'AB' || $all_marks[0]['M2'] == '-')?$all_marks[0]['M2']:$mark;
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
						
						$marks['pt'] = $final_marks[0]; 
						$marks['notebook'] = $final_marks[1];
						$marks['activity'] = $final_marks[2];
						$marks['subject_enrichment'] =$final_marks[3];
						$marks['half_yearly'] = $final_marks[4];

						$pt_marks = ($marks['pt'] == 'AB' || $marks['pt'] == '-')?0:$marks['pt'];
						$notebook_marks = ($marks['notebook'] == 'AB' || $marks['notebook'] == '-')?0:$marks['notebook'];
						$activity_marks = ($marks['activity'] == 'AB' || $marks['activity'] == '-')?0:$marks['activity'];
						$se_marks = ($marks['subject_enrichment'] == 'AB' || $marks['subject_enrichment'] == '-')?0:$marks['subject_enrichment'];
						$hy_marks = ($marks['half_yearly'] == 'AB' || $marks['half_yearly'] == '-')?0:$marks['half_yearly'];

						$marks_obtained = $pt_marks + $notebook_marks + $se_marks + $hy_marks + $activity_marks;
						$marks['marks_obtained'] = ($round_off==1)?round($marks_obtained): number_format($marks_obtained,2);
						$gradeData = $this->sumit->fetchSingleData('Grade,Qualitative_Norms','grademaster',"ORange >=$marks_obtained AND CRange <= $marks_obtained");
						$marks['grade'] = $gradeData['Grade'];
						$result[$value]['sub'][$key2]['marks'] = $marks;
					}
				}
			}
			$data['round_off'] = $round_off;
			$data['result']    = $result;
			$data['school_setting'] = $school_setting;
			$data['trm'] = $termId;
			$data['grade_only_sub'] = $stu_data['grade_only_sub'];
			$this->load->view('report_card/report_card_cmc_pdf',$data);
		}
	}						
							
	public function generatePDF()
	{
		$school_setting = $this->alam->select('school_setting','*');
		$school_photo   = $this->alam->select('school_photo','*');
		$reportCardType_data = $this->alam->select('misc_table','*');
		$data['report_card_type'] = $reportCardType_data[0]->report_card_type;
		$data['grademaster'] = $this->alam->select('grademaster','*');
		$data['signature'] = $this->alam->select('signature','*');
		$adm_no = $this->input->post('stu_adm_no[]');
		$term = $this->input->post('term');
		$date = $this->input->post('date');
		$classs = $this->input->post('classs');
		$examModedata = $this->alam->select('classes','ExamMode',"Class_No='$classs'");
		$examode = $examModedata[0]->ExamMode;
		$sec = $this->input->post('sec');
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
		//end attendance //
		$examcode = array();
		$pt_all_marks = array();
		$result = array();
		if($examode == 1)//diffrentiate CBSE or CMC
		{
			if($term == 1)
			{
				if($classs==5 || $classs==6 || $classs==7 || $classs==8 || $classs==9 || $classs==10)
				{
					$term = 'TERM-1';
					$examcode = array('1','4','12');
				}
				elseif($classs==11 || $classs==12)
				{
					$term = 'TERM-1';
					$examcode = array('1','7');
				}
				elseif($classs==1 || $classs==2)
				{
					$term = 'TERM-1';
					$examcode = array('4');
				}
				else
				{
					$term = 'TERM-1';
					$examcode = array('1','4');
				}
				
			}else
			{
				$term = 'TERM-2';
				$examcode = array('1','2','3','5');
			}
			foreach ($adm_no as $key => $value) {
				
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
							//$str=$this->db->last_query();
							//echo $str;
							//die;
							
							
							if($classs=="5" || $classs=="6" || $classs=="7")
							{
								$wetageMarks = "100";
								$wetageMarks = $this->sumit->fetchSingleData('wetage1','exammaster',array('ExamCode'=>$val));
							}
							else
							{
								$wetageMarks = $this->sumit->fetchSingleData('wetage1','exammaster',array('ExamCode'=>$val));
							}
							// echo $classs;
							// echo "<br/>";
							// echo $wetageMarks;

							
							$absent = array();
							$ab = 0;
							if($val == 1){
								$mark = array();
								if($pt_type == 1)
								{
									foreach ($all_marks as $key4 => $value4) {
										if($sub_code =='15'){
										$mark[$key4] = ($value4['M3']/$value4['M1']) * 10;
										}else if($sub_code =='8'){
										$mark[$key4] = ($value4['M3']/$value4['M1']) * 100;
										}else{
										//$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetageMarks['wetage1'];
										if($classs=="5" || $classs=="6" || $classs=="7")
										{
											$mark[$key4] = ($value4['M3']/$value4['M1']) * 20;
										}
										else
										{
											$mark[$key4] = ($value4['M3']/$value4['M1']) * 10;
										}
											
										}
										
										
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
									foreach ($all_marks as $key4 => $value4) 
									{
										
										$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetageMarks['wetage1'];
										
										
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
										
										$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetageMarks['wetage1'];
										
										$absent[$key4] = $value4['M2'];
									}
									
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
									if($val == 12)
									{
										
										if($classs=="5" || $classs=="6" || $classs=="7")
										{
										$mark = ($all_marks[0]['M3']/$all_marks[0]['M1']) * 20;
										$mark = ($all_marks[0]['M2'] == 'AB' || $all_marks[0]['M2'] == '-')?$all_marks[0]['M2']:$mark;
										}
										else
										{
											$mark = ($all_marks[0]['M3']/$all_marks[0]['M1']) * $wetageMarks['wetage1'];
										$mark = ($all_marks[0]['M2'] == 'AB' || $all_marks[0]['M2'] == '-')?$all_marks[0]['M2']:$mark;
										}
										
									}
									if($val == 4)
									{

										if($classs=="5" || $classs=="6" || $classs=="7")
										{
										
											if($sub_code =='15' || $sub_code =='27' || $sub_code =='7')
											{
												$mark = ($all_marks[0]['M3']/$all_marks[0]['M1']) * 80;
												$mark = ($all_marks[0]['M2'] == 'AB' || $all_marks[0]['M2'] == '-')?$all_marks[0]['M2']:$mark;
											}elseif($sub_code =='8' || $sub_code =='10' || $sub_code =='18' || $sub_code =='16' || $sub_code =='22' || $sub_code =='35' || $sub_code =='36')
											{
												//echo $sub_code.'-'.$all_marks[0]['M3'];
												//echo '<br/>';
												//echo $sub_code.'-'.$all_marks[0]['M1'];
												//echo '<br/>';
												$mark = ($all_marks[0]['M3']/$all_marks[0]['M1']) * 60;
												$mark = ($all_marks[0]['M2'] == 'AB' || $all_marks[0]['M2'] == '-')?$all_marks[0]['M2']:$mark;
											}
											else
											{
												$mark = ($all_marks[0]['M3']/$all_marks[0]['M1']) * 60;
												$mark = ($all_marks[0]['M2'] == 'AB' || $all_marks[0]['M2'] == '-')?$all_marks[0]['M2']:$mark;
											}
										}
										else
										{
											if($sub_code =='15' || $sub_code =='21')
											{
												$mark = ($all_marks[0]['M3']/$all_marks[0]['M1']) * 50;
												$mark = ($all_marks[0]['M2'] == 'AB' || $all_marks[0]['M2'] == '-')?$all_marks[0]['M2']:$mark;
											}else
											{
												$mark = ($all_marks[0]['M3']/$all_marks[0]['M1']) * $wetageMarks['wetage1'];
												$mark = ($all_marks[0]['M2'] == 'AB' || $all_marks[0]['M2'] == '-')?$all_marks[0]['M2']:$mark;
											};
										}



										
										
										
										
									}
									if($class == '1' || $class == '2' || $class == '3' || $class == '4'){
										$mark = ($all_marks[0]['M3']/$all_marks[0]['M1']) * 100;
									}else{
										if($sub_code =='8'){
										   $mark = ($all_marks[0]['M3']/$all_marks[0]['M1']) * 100;
										 }else{
											if($class == '8' || $class == '9' || $class == '10')
											{

												if($sub_code =='15' || $sub_code =='21')
												{
													$mark = ($all_marks[0]['M3']/$all_marks[0]['M1']) * 50;
												}else
												{
													$mark = ($all_marks[0]['M3']/$all_marks[0]['M1']) * $wetageMarks['wetage1'];
												};
														
									
											}
											else
											{
											$mark = ($all_marks[0]['M3']/$all_marks[0]['M1']) * $wetageMarks['wetage1'];
											}
										 }	
									}
								
									 $mark = ($all_marks[0]['M2'] == 'AB' || $all_marks[0]['M2'] == '-')?$all_marks[0]['M2']:$mark;
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
						
	
						if($class == '8' || $class == '9' || $class == '10' || $class == '11' || $class == '12')
						{
							//$marks['pt'] = $marks['pt']; 
							$marks['pt'] = $final_marks[0];
							
						}
						else
						{
							$marks['pt'] = 0; 
						}
					$skill=$this->db->query("SELECT * FROM `marks_all` WHERE admno='$admnum' AND EXAMCODE='4' AND SUBJECT='$sub_code'")->result_array();

						$marks['skill'] = $skill[0]['m3'];
						$marks['notebook'] = 0;
						
						$marks['REVISION-TEST-I'] = $final_marks[2];
						$marks['pt'] = $final_marks[0];
						//$marks['subject_enrichment'] =0;
						//$marks['subject_enrichment'] = $final_marks[3];
						
						if($sub_code =='15' || $sub_code =='21')
						{
							$marks['half_yearly'] = $final_marks[1]; 
						}else
						{
							$marks['half_yearly'] = $final_marks[1];
						};
						

						
						$pt_marks = ($marks['pt'] == 'AB' || $marks['pt'] == '-')?0:$marks['pt'];
						$notebook_marks = ($marks['notebook'] == 'AB' || $marks['notebook'] == '-')?0:$marks['notebook'];
						$se_marks = ($marks['subject_enrichment'] == 'AB' || $marks['subject_enrichment'] == '-')?0:$marks['subject_enrichment'];
						$rt_marks = ($marks['REVISION-TEST-I'] == 'AB' || $marks['REVISION-TEST-I'] == '-')?"N/A":$marks['REVISION-TEST-I'];
						$hy_marks = ($marks['half_yearly'] == 'AB' || $marks['half_yearly'] == '-')?0:$marks['half_yearly'];
						$marks_obtained = $pt_marks + $notebook_marks + $se_marks + $hy_marks + $rt_marks;
						
						// echo '<br/>';
						// echo '$final_marks:--';
						// echo '<br/>';
						// echo '<pre>'; print_r($final_marks); echo '</pre>';
						// echo '<br/>';
						// echo '$marks:--';
						// echo '<br/>';
						// echo '<pre>'; print_r($marks); echo '</pre>';
						// echo '<br/>';
						// echo '$marks_obtained:-- '.$marks_obtained;
						// echo '<br/>';

						 //die;
						
						
						
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
			if($class == '2' || $class == '3' || $class == '4'||$class == '5' || $class == '6' || $class == '7'){
				foreach($result as $keyf => $valf){
					$this->db->query("delete from iii_v_tabulaton_save where ADM_NO='".$valf['ADM_NO']."'");
					$stu_insert = [
						'ADM_NO'     => $valf['ADM_NO'],
						'CLASS'      => $valf['CLASS'],
						'SEC'        => $valf['SEC'],
						'DISP_CLASS' => $valf['DISP_CLASS'],
						'DISP_SEC'   => $valf['DISP_SEC'],
						'ROLL_NO'    => $valf['ROLL_NO'],
						'FIRST_NM'   => $valf['FIRST_NM'],
						'MIDDLE_NM'  => $valf['MIDDLE_NM'],
						'TITLE_NM'   => $valf['TITLE_NM'],
					];
					
					$this->alam->insert('iii_v_tabulaton_save',$stu_insert);
					$last_insert_id = $this->db->insert_id();
					if(!(isset($valf['sub']) && !empty($valf['sub']))){
						continue;
					}
					$marksf = array();
					foreach($valf['sub'] as $keyf1 => $valf1){
						$marksf[] = [
							'iii_v_tabulaton_save_id' => $last_insert_id,
							'subject_name'            => $valf1['subject_name'],
							'pt'                      => $valf1['marks']['pt'],
							'rt'                      => $valf1['marks']['REVISION-TEST-I'],
							'half_yearly'             => $valf1['marks']['half_yearly'],
							'marks_obtained'          => $valf1['marks']['marks_obtained'],
							'grade'                   => $valf1['marks']['grade'],
						];
					}
				
					
					$this->alam->insert_multiple('iii_v_tabulaton_marks_save',$marksf);
				}
				if($class == '5' || $class == '6' || $class == '7'){
					//$this->load->view('report_card/report_card_cbsc_pdf_III_V',$data);
					$this->load->view('report_card/report_card_cbsc_pdf_III_IV_V',$data);
				}elseif($class == '1' || $class == '2'){
					$this->load->view('report_card/report_card_cbsc_pdf_PREP_II',$data);
					//
				}
				elseif( $class == '3' || $class == '4'){
					$this->load->view('report_card/report_card_cbsc_pdf_I_II',$data);
					//report_card_cbsc_pdf_I_II
				}
			}else{
			
				
				$this->load->view('report_card/report_card_cbsc_pdf',$data);
			}
		}
		else
		{
			if($term == 1)
			{
				$term = 'TERM-1';
				$examcode = array('1','2','3','6','4');
			}else
			{
				$term = 'TERM-2';
				$examcode = array('1','2','3','6','5');
			}
			
			foreach ($adm_no as $key => $value) {
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
				  $data['tot_present_day'] = $attPresentData[0]->cnt;	
				}else{
				  $attPresentData = $this->alam->select('stu_attendance_entry','count(DISTINCT att_date)cnt',"class_code='$class' AND sec_code='$section' AND att_date <= '$date' AND att_status='P' AND admno='$admnum'");
				  $data['tot_present_day'] = $attPresentData[0]->cnt;		
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
							$wetageMarks = $this->sumit->fetchSingleData('wetage2','exammaster',array('ExamCode'=>$val));
							$absent = array();
							$ab = 0;
							if($val == 1){
								$mark = array();
								if($pt_type == 1)
								{
									foreach ($all_marks as $key4 => $value4) {

										
										$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetageMarks['wetage2'];
										
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

										$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetageMarks['wetage2'];
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

										$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetageMarks['wetage2'];
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

								   ($round_off==1)?$final_marks[$keys] = round($final_marks[$keys]):$final_marks[$keys] = $final_marks[$keys];
							}else{
								if(!empty($all_marks))
								{
									$mark = ($all_marks[0]['M3']/$all_marks[0]['M1']) * $wetageMarks['wetage2'];

									$mark = ($all_marks[0]['M2'] == 'AB' || $all_marks[0]['M2'] == '-')?$all_marks[0]['M2']:$mark;
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
						
						$marks['pt'] = $final_marks[0]; 
						$marks['notebook'] = $final_marks[1];
						$marks['activity'] = $final_marks[2];
						$marks['subject_enrichment'] =$final_marks[3];
						$marks['half_yearly'] = $final_marks[4];

						$pt_marks = ($marks['pt'] == 'AB' || $marks['pt'] == '-')?0:$marks['pt'];
						$notebook_marks = ($marks['notebook'] == 'AB' || $marks['notebook'] == '-')?0:$marks['notebook'];
						$activity_marks = ($marks['activity'] == 'AB' || $marks['activity'] == '-')?0:$marks['activity'];
						$se_marks = ($marks['subject_enrichment'] == 'AB' || $marks['subject_enrichment'] == '-')?0:$marks['subject_enrichment'];
						$hy_marks = ($marks['half_yearly'] == 'AB' || $marks['half_yearly'] == '-')?0:$marks['half_yearly'];

						$marks_obtained = $pt_marks + $notebook_marks + $se_marks + $hy_marks + $activity_marks;
						$marks['marks_obtained'] = ($round_off==1)?round($marks_obtained): number_format($marks_obtained,2);
						$gradeData = $this->sumit->fetchSingleData('Grade,Qualitative_Norms','grademaster',"ORange >=$marks_obtained AND CRange <= $marks_obtained");
						$marks['grade'] = $gradeData['Grade'];
						$result[$value]['sub'][$key2]['marks'] = $marks;
					}
				}
			}
			$data['round_off'] = $round_off;
			$data['result']    = $result;
			$data['school_setting'] = $school_setting;
			$data['trm'] = $termId;
			$data['grade_only_sub'] = $stu_data['grade_only_sub'];
			$this->load->view('report_card/report_card_cmc_pdf',$data);
		}
	}
	public function generatePDF_III_V()
	{
		$school_setting = $this->alam->select('school_setting','*');
		$school_photo   = $this->alam->select('school_photo','*');
		$reportCardType_data = $this->alam->select('misc_table','*');
		$data['report_card_type'] = $reportCardType_data[0]->report_card_type;
		$data['grademaster'] = $this->alam->select('grademaster','*');
		$data['signature'] = $this->alam->select('signature','*');
		$adm_no = $this->input->post('stu_adm_no[]');
		$term = $this->input->post('term');
		$date = $this->input->post('date');
		$classs = $this->input->post('classs');
		$examModedata = $this->alam->select('classes','ExamMode',"Class_No='$classs'");
		$examode = $examModedata[0]->ExamMode;
		$sec = $this->input->post('sec');
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
		//end attendance //
		$examcode = array();
		$pt_all_marks = array();
		$result = array();
		if($examode == 1)//diffrentiate CBSE or CMC
		{
			if($term == 1)
			{
				$term = 'TERM-1';
				$examcode = array('4');
			}else
			{
				$term = 'TERM-2';
				$examcode = array('1','2','3','5');
			}
			foreach ($adm_no as $key => $value) {
				
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
								if($pt_type == 1)
								{
									
									foreach ($all_marks as $key4 => $value4) {
										if($sub_code =='15'){
										$mark[$key4] = ($value4['M3']/$value4['M1']) * 10;
										}else if($sub_code =='8'){
										$mark[$key4] = ($value4['M3']/$value4['M1']) * 100;
										}else{
										$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetageMarks['wetage1'];
										}
										
										
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
									
									foreach ($all_marks as $key4 => $value4) 
									{
										
										$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetageMarks['wetage1'];
										
										
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
										
										$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetageMarks['wetage1'];
										
										$absent[$key4] = $value4['M2'];
									}
									
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
									
									if($class == '1' || $class == '2' || $class == '3' || $class == '4'){
										$mark = ($all_marks[0]['M3']/$all_marks[0]['M1']) * 100;
									}else{
										if($sub_code =='8'){
										   $mark = ($all_marks[0]['M3']/$all_marks[0]['M1']) * 100;
										 }else{
										   $mark = ($all_marks[0]['M3']/$all_marks[0]['M1']) * $wetageMarks['wetage1'];
										 }	
									}
								
									 $mark = ($all_marks[0]['M2'] == 'AB' || $all_marks[0]['M2'] == '-')?$all_marks[0]['M2']:$mark;
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
						
						$marks['pt'] = 0; 
						$marks['notebook'] = 0;
						$marks['subject_enrichment'] =0;
						if($sub_code =='15'){ $marks['half_yearly'] = $final_marks[0]/2; }else{
						$marks['half_yearly'] = $final_marks[0]; };
						$pt_marks = ($marks['pt'] == 'AB' || $marks['pt'] == '-')?0:$marks['pt'];
						$notebook_marks = ($marks['notebook'] == 'AB' || $marks['notebook'] == '-')?0:$marks['notebook'];
						$se_marks = ($marks['subject_enrichment'] == 'AB' || $marks['subject_enrichment'] == '-')?0:$marks['subject_enrichment'];
						$hy_marks = ($marks['half_yearly'] == 'AB' || $marks['half_yearly'] == '-')?0:$marks['half_yearly'];

						$marks_obtained = $pt_marks + $notebook_marks + $se_marks + $hy_marks;
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
			if($class == '2' || $class == '3' || $class == '4'||$class == '5' || $class == '6' || $class == '7'){
				foreach($result as $keyf => $valf){
					$this->db->query("delete from iii_v_tabulaton_save where ADM_NO='".$valf['ADM_NO']."'");
					$stu_insert = [
						'ADM_NO'     => $valf['ADM_NO'],
						'CLASS'      => $valf['CLASS'],
						'SEC'        => $valf['SEC'],
						'DISP_CLASS' => $valf['DISP_CLASS'],
						'DISP_SEC'   => $valf['DISP_SEC'],
						'ROLL_NO'    => $valf['ROLL_NO'],
						'FIRST_NM'   => $valf['FIRST_NM'],
						'MIDDLE_NM'  => $valf['MIDDLE_NM'],
						'TITLE_NM'   => $valf['TITLE_NM'],
					];
					
					$this->alam->insert('iii_v_tabulaton_save',$stu_insert);
					$last_insert_id = $this->db->insert_id();
					if(!(isset($valf['sub']) && !empty($valf['sub']))){
						continue;
					}
					$marksf = array();
					foreach($valf['sub'] as $keyf1 => $valf1){
						$marksf[] = [
							'iii_v_tabulaton_save_id' => $last_insert_id,
							'subject_name'            => $valf1['subject_name'],
							'pt'                      => $valf1['marks']['pt'],
							'half_yearly'             => $valf1['marks']['half_yearly'],
							'marks_obtained'          => $valf1['marks']['marks_obtained'],
							'grade'                   => $valf1['marks']['grade'],
						];
					}
				
					
					$this->alam->insert_multiple('iii_v_tabulaton_marks_save',$marksf);
				}
				if($class == '5' || $class == '6' || $class == '7'){
					$this->load->view('report_card/report_card_cbsc_pdf_III_V',$data);
				}elseif($class == '2' || $class == '3' || $class == '4'){
					$this->load->view('report_card/report_card_cbsc_pdf_PREP_II',$data);
				}
			}else{
				$this->load->view('report_card/report_card_cbsc_pdf',$data);
			}
		}
		else
		{
			if($term == 1)
			{
				$term = 'TERM-1';
				$examcode = array('1','2','3','6','4');
			}else
			{
				$term = 'TERM-2';
				$examcode = array('1','2','3','6','5');
			}
			
			foreach ($adm_no as $key => $value) {
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
				  $data['tot_present_day'] = $attPresentData[0]->cnt;	
				}else{
				  $attPresentData = $this->alam->select('stu_attendance_entry','count(DISTINCT att_date)cnt',"class_code='$class' AND sec_code='$section' AND att_date <= '$date' AND att_status='P' AND admno='$admnum'");
				  $data['tot_present_day'] = $attPresentData[0]->cnt;		
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
							$wetageMarks = $this->sumit->fetchSingleData('wetage2','exammaster',array('ExamCode'=>$val));
							$absent = array();
							$ab = 0;
							if($val == 1){
								$mark = array();
								if($pt_type == 1)
								{
									foreach ($all_marks as $key4 => $value4) {

										
										$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetageMarks['wetage2'];
										
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

										$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetageMarks['wetage2'];
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

										$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetageMarks['wetage2'];
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

								   ($round_off==1)?$final_marks[$keys] = round($final_marks[$keys]):$final_marks[$keys] = $final_marks[$keys];
							}else{
								if(!empty($all_marks))
								{
									$mark = ($all_marks[0]['M3']/$all_marks[0]['M1']) * $wetageMarks['wetage2'];

									$mark = ($all_marks[0]['M2'] == 'AB' || $all_marks[0]['M2'] == '-')?$all_marks[0]['M2']:$mark;
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
						
						$marks['pt'] = $final_marks[0]; 
						$marks['notebook'] = $final_marks[1];
						$marks['activity'] = $final_marks[2];
						$marks['subject_enrichment'] =$final_marks[3];
						$marks['half_yearly'] = $final_marks[4];

						$pt_marks = ($marks['pt'] == 'AB' || $marks['pt'] == '-')?0:$marks['pt'];
						$notebook_marks = ($marks['notebook'] == 'AB' || $marks['notebook'] == '-')?0:$marks['notebook'];
						$activity_marks = ($marks['activity'] == 'AB' || $marks['activity'] == '-')?0:$marks['activity'];
						$se_marks = ($marks['subject_enrichment'] == 'AB' || $marks['subject_enrichment'] == '-')?0:$marks['subject_enrichment'];
						$hy_marks = ($marks['half_yearly'] == 'AB' || $marks['half_yearly'] == '-')?0:$marks['half_yearly'];

						$marks_obtained = $pt_marks + $notebook_marks + $se_marks + $hy_marks + $activity_marks;
						$marks['marks_obtained'] = ($round_off==1)?round($marks_obtained): number_format($marks_obtained,2);
						$gradeData = $this->sumit->fetchSingleData('Grade,Qualitative_Norms','grademaster',"ORange >=$marks_obtained AND CRange <= $marks_obtained");
						$marks['grade'] = $gradeData['Grade'];
						$result[$value]['sub'][$key2]['marks'] = $marks;
					}
				}
			}
			$data['round_off'] = $round_off;
			$data['result']    = $result;
			$data['school_setting'] = $school_setting;
			$data['trm'] = $termId;
			$data['grade_only_sub'] = $stu_data['grade_only_sub'];
			$this->load->view('report_card/report_card_cmc_pdf',$data);
		}
	}
	
	public function generatePDFNur(){
		$school_setting = $this->alam->select('school_setting','*');
		$school_photo   = $this->alam->select('school_photo','*');
		$reportCardType_data = $this->alam->select('misc_table','*');
		$data['report_card_type'] = $reportCardType_data[0]->report_card_type;
		$data['grademaster'] = $this->alam->select('grademaster','*');
		$data['signature'] = $this->alam->select('signature','*');
		$adm_no = $this->input->post('stu_adm_no[]');
		$term = $this->input->post('term');
		$data['term'] = $term;
		$date = $this->input->post('date');
		$classs = $this->input->post('classs');
		$examModedata = $this->alam->select('classes','ExamMode',"Class_No='$classs'");
		$examode = $examModedata[0]->ExamMode;
		$sec = $this->input->post('sec');
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
		//end attendance //
		$examcode = array();
		$pt_all_marks = array();
		$result = array();
		if($examode == 1)//diffrentiate CBSE or CMC
		{
			if($term == 1)
			{
				$term = 'TERM-1';
				$examcode = array('4');
			}else
			{
				$term = 'TERM-2';
				$examcode = array('5');
			}
			foreach ($adm_no as $key => $value) {
				
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
								if($pt_type == 1)
								{
									
									foreach ($all_marks as $key4 => $value4) {
										if($sub_code =='15'){
										$mark[$key4] = ($value4['M3']/$value4['M1']) * 10;
										}else if($sub_code =='8'){
										$mark[$key4] = ($value4['M3']/$value4['M1']) * 100;
										}else{
										$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetageMarks['wetage1'];
										}
										
										
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
									
									foreach ($all_marks as $key4 => $value4) 
									{
										
										$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetageMarks['wetage1'];
										
										
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
										
										$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetageMarks['wetage1'];
										
										$absent[$key4] = $value4['M2'];
									}
									
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
									
									if($class == '1' || $class == '2' || $class == '3' || $class == '4'){
										$mark = ($all_marks[0]['M3']/$all_marks[0]['M1']) * 100;
									}else{
										if($sub_code =='8'){
										   $mark = ($all_marks[0]['M3']/$all_marks[0]['M1']) * 100;
										 }else{
										   $mark = ($all_marks[0]['M3']/$all_marks[0]['M1']) * $wetageMarks['wetage1'];
										 }	
									}
								
									 $mark = ($all_marks[0]['M2'] == 'AB' || $all_marks[0]['M2'] == '-')?$all_marks[0]['M2']:$mark;
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
						
						$marks['pt'] = 0; 
						$marks['notebook'] = 0;
						$marks['subject_enrichment'] =0;
						if($sub_code =='15'){ $marks['half_yearly'] = $final_marks[0]/2; }else{
						$marks['half_yearly'] = $final_marks[0]; };
						$pt_marks = ($marks['pt'] == 'AB' || $marks['pt'] == '-')?0:$marks['pt'];
						$notebook_marks = ($marks['notebook'] == 'AB' || $marks['notebook'] == '-')?0:$marks['notebook'];
						$se_marks = ($marks['subject_enrichment'] == 'AB' || $marks['subject_enrichment'] == '-')?0:$marks['subject_enrichment'];
						$hy_marks = ($marks['half_yearly'] == 'AB' || $marks['half_yearly'] == '-')?0:$marks['half_yearly'];

						$marks_obtained = $pt_marks + $notebook_marks + $se_marks + $hy_marks;
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
			if($class == '1'){
				foreach($result as $keyf => $valf){
					$this->db->query("delete from iii_v_tabulaton_save where ADM_NO='".$valf['ADM_NO']."'");
					$stu_insert = [
						'ADM_NO'     => $valf['ADM_NO'],
						'CLASS'      => $valf['CLASS'],
						'SEC'        => $valf['SEC'],
						'DISP_CLASS' => $valf['DISP_CLASS'],
						'DISP_SEC'   => $valf['DISP_SEC'],
						'ROLL_NO'    => $valf['ROLL_NO'],
						'FIRST_NM'   => $valf['FIRST_NM'],
						'MIDDLE_NM'  => $valf['MIDDLE_NM'],
						'TITLE_NM'   => $valf['TITLE_NM'],
					];
					
					$this->alam->insert('iii_v_tabulaton_save',$stu_insert);
					$last_insert_id = $this->db->insert_id();
					if(!(isset($valf['sub']) && !empty($valf['sub']))){
						continue;
					}
					$marksf = array();
					foreach($valf['sub'] as $keyf1 => $valf1){
						$marksf[] = [
							'iii_v_tabulaton_save_id' => $last_insert_id,
							'subject_name'            => $valf1['subject_name'],
							'pt'                      => $valf1['marks']['pt'],
							'half_yearly'             => $valf1['marks']['half_yearly'],
							'marks_obtained'          => $valf1['marks']['marks_obtained'],
							'grade'                   => $valf1['marks']['grade'],
						];
					}
				
					
					$this->alam->insert_multiple('iii_v_tabulaton_marks_save',$marksf);
				}
				
				$this->load->view('report_card/report_card_cbsc_pdf_nur',$data);

			}
		}
	}
		public function generatePDF_XI_XII()
	{
		$school_setting = $this->alam->select('school_setting','*');
		$school_photo   = $this->alam->select('school_photo','*');
		$reportCardType_data = $this->alam->select('misc_table','*');
		$data['report_card_type'] = $reportCardType_data[0]->report_card_type;
		$data['grademaster'] = $this->alam->select('grademaster','*');
		$data['signature'] = $this->alam->select('signature','*');
		$adm_no = $this->input->post('stu_adm_no[]');
		$term = $this->input->post('term');
		$date = $this->input->post('date');
		$classs = $this->input->post('classs');
		$examModedata = $this->alam->select('classes','ExamMode',"Class_No='$classs'");
		$examode = $examModedata[0]->ExamMode;
		$sec = $this->input->post('sec');
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
		//end attendance //
		$examcode = array();
		$pt_all_marks = array();
		$result = array();
		if($examode == 1)//diffrentiate CBSE or CMC
		{
			if($term == 1)
			{
				$term = 'TERM-1';
				$examcode = array('4');
			}else
			{
				$term = 'TERM-2';
				$examcode = array('1','2','3','5');
			}
			foreach ($adm_no as $key => $value) {
				
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
				foreach ($subjectData as $key2 => $val2) {

					if($val2['opt_code'] == 2)
					{
						$check_student_subject = $this->sumit->checkData('*','studentsubject',array('Adm_no'=>$value,'Class'=>$class,'SUBCODE'=>$val2['subject_code']));
					}
					else
					{
						$check_student_subject = true;
					}
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
								if($pt_type == 1)
								{
									
									foreach ($all_marks as $key4 => $value4) {
										if($sub_code =='15'){
										$mark[$key4] = ($value4['M3']/$value4['M1']) * 10;
										}else if($sub_code =='8'){
										$mark[$key4] = ($value4['M3']/$value4['M1']) * 100;
										}else{
										$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetageMarks['wetage1'];
										}
										
										
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
									
									foreach ($all_marks as $key4 => $value4) 
									{
										
										$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetageMarks['wetage1'];
										
										
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
										
										$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetageMarks['wetage1'];
										
										$absent[$key4] = $value4['M2'];
									}
									
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
									$mark = ($all_marks[0]['M3']/$all_marks[0]['M1']) * 100;
									$mark = ($all_marks[0]['M2'] == 'AB' || $all_marks[0]['M2'] == '-')?$all_marks[0]['M2']:$mark;
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
						
						
						$marks['pt'] = 0; 
						$marks['notebook'] = 0;
						$marks['subject_enrichment'] =0;
						$marks['half_yearly'] = $final_marks[0];
						$pt_marks = ($marks['pt'] == 'AB' || $marks['pt'] == '-')?'0':$marks['pt'];
						$notebook_marks = ($marks['notebook'] == 'AB' || $marks['notebook'] == '-')?'0':$marks['notebook'];
						$se_marks = ($marks['subject_enrichment'] == 'AB' || $marks['subject_enrichment'] == '-')?0:$marks['subject_enrichment'];
						$hy_marks = ($marks['half_yearly'] == 'AB' || $marks['half_yearly'] == '-')?'0':$marks['half_yearly'];

						$marks_obtained = $pt_marks + $notebook_marks + $se_marks + $hy_marks;
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
			$this->load->view('report_card/report_card_cbsc_pdf_XI_XII',$data);
			
		}
		else
		{
			if($term == 1)
			{
				$term = 'TERM-1';
				$examcode = array('1','2','3','6','4');
			}else
			{
				$term = 'TERM-2';
				$examcode = array('1','2','3','6','5');
			}
			
			foreach ($adm_no as $key => $value) {
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
				  $data['tot_present_day'] = $attPresentData[0]->cnt;	
				}else{
				  $attPresentData = $this->alam->select('stu_attendance_entry','count(DISTINCT att_date)cnt',"class_code='$class' AND sec_code='$section' AND att_date <= '$date' AND att_status='P' AND admno='$admnum'");
				  $data['tot_present_day'] = $attPresentData[0]->cnt;		
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
							$wetageMarks = $this->sumit->fetchSingleData('wetage2','exammaster',array('ExamCode'=>$val));
							$absent = array();
							$ab = 0;
							if($val == 1){
								$mark = array();
								if($pt_type == 1)
								{
								foreach ($all_marks as $key4 => $value4) {
									$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetageMarks['wetage2'];
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

										$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetageMarks['wetage2'];
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

										$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetageMarks['wetage2'];
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

								   ($round_off==1)?$final_marks[$keys] = round($final_marks[$keys]):$final_marks[$keys] = $final_marks[$keys];
							}else{
								if(!empty($all_marks))
								{
									$mark = ($all_marks[0]['M3']/$all_marks[0]['M1']) * $wetageMarks['wetage2'];

									$mark = ($all_marks[0]['M2'] == 'AB' || $all_marks[0]['M2'] == '-')?$all_marks[0]['M2']:$mark;
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
						
						$marks['pt'] = $final_marks[0]; 
						$marks['notebook'] = $final_marks[1];
						$marks['activity'] = $final_marks[2];
						$marks['subject_enrichment'] =$final_marks[3];
						$marks['half_yearly'] = $final_marks[4];

						$pt_marks = ($marks['pt'] == 'AB' || $marks['pt'] == '-')?0:$marks['pt'];
						$notebook_marks = ($marks['notebook'] == 'AB' || $marks['notebook'] == '-')?0:$marks['notebook'];
						$activity_marks = ($marks['activity'] == 'AB' || $marks['activity'] == '-')?0:$marks['activity'];
						$se_marks = ($marks['subject_enrichment'] == 'AB' || $marks['subject_enrichment'] == '-')?0:$marks['subject_enrichment'];
						$hy_marks = ($marks['half_yearly'] == 'AB' || $marks['half_yearly'] == '-')?0:$marks['half_yearly'];

						$marks_obtained = $pt_marks + $notebook_marks + $se_marks + $hy_marks + $activity_marks;
						$marks['marks_obtained'] = ($round_off==1)?round($marks_obtained): number_format($marks_obtained,2);
						$gradeData = $this->sumit->fetchSingleData('Grade,Qualitative_Norms','grademaster',"ORange >=$marks_obtained AND CRange <= $marks_obtained");
						$marks['grade'] = $gradeData['Grade'];
						$result[$value]['sub'][$key2]['marks'] = $marks;
					}
				}
			}
			$data['round_off'] = $round_off;
			$data['result']    = $result;
			$data['school_setting'] = $school_setting;
			$data['trm'] = $termId;
			$data['grade_only_sub'] = $stu_data['grade_only_sub'];
			$this->load->view('report_card/report_card_cmc_pdf',$data);
		}
	}
	public function generatePDF_annual_XI()
	{
		$school_setting = $this->alam->select('school_setting','*');
		$school_photo   = $this->alam->select('school_photo','*');
		$reportCardType_data = $this->alam->select('misc_table','*');
		$data['report_card_type'] = $reportCardType_data[0]->report_card_type;
		$data['grademaster'] = $this->alam->select('grademaster','*');
		$data['signature'] = $this->alam->select('signature','*');
		$adm_no = $this->input->post('stu_adm_no[]');
		$term = $this->input->post('term');
		$date = $this->input->post('date');
		$classs = $this->input->post('classs');
		$examModedata = $this->alam->select('classes','ExamMode',"Class_No='$classs'");
		$examode = $examModedata[0]->ExamMode;
		$sec = $this->input->post('sec');
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
		//end attendance //
		$examcode = array();
		$pt_all_marks = array();
		$result = array();
		if($examode == 1)//diffrentiate CBSE or CMC
		{
			if($term == 1)
			{
				$term = 'TERM-1';
				$examcode = array('4','5');
			}else
			{
				$term = 'TERM-2';
				$examcode = array('1','2','3','5');
			}
			foreach ($adm_no as $key => $value) {
				
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
				foreach ($subjectData as $key2 => $val2) {

					if($val2['opt_code'] == 2)
					{
						$check_student_subject = $this->sumit->checkData('*','studentsubject',array('Adm_no'=>$value,'Class'=>$class,'SUBCODE'=>$val2['subject_code']));
					}
					else
					{
						$check_student_subject = true;
					}
					if($check_student_subject)
					{
						$sub_code = $val2['subject_code'];
						$pt_type = $val2['pt_type'];
						$final_marks = array();
						$result[$value]['sub'][$key2]['subject_name'] = $val2['subj_nm'];
						$result[$value]['sub'][$key2]['opt_code'] = $val2['opt_code'];

						foreach ($examcode as $keys => $val) {

							$examC=$val;
							if($val=='4'){
							$Tm='TERM-1';
							}else{
							$Tm='TERM-2';
							}
								
							$marks =array();
							$tot_per = 0;
							$all_marks = $this->sumit->fetchAllData('M1,M2,M3,ExamC','marks',"admno='$value' AND ExamC IN ($examC) AND SCode='$sub_code' AND Term='$Tm' AND status = '1'");
							
							
							$wetageMarks = $this->sumit->fetchSingleData('wetage1','exammaster',array('ExamCode'=>$val));
							$absent = array();
							$ab = 0;
							if($val == 1){
								$mark = array();
								if($pt_type == 1)
								{
									
									foreach ($all_marks as $key4 => $value4) {
										if($sub_code =='15'){
										$mark[$key4] = ($value4['M3']/$value4['M1']) * 10;
										}else if($sub_code =='8'){
										$mark[$key4] = ($value4['M3']/$value4['M1']) * 100;
										}else{
										$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetageMarks['wetage1'];
										}
										
										
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
									
									foreach ($all_marks as $key4 => $value4) 
									{
										
										$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetageMarks['wetage1'];
										
										
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
										
										$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetageMarks['wetage1'];
										
										$absent[$key4] = $value4['M2'];
									}
									
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
									$mark = ($all_marks[0]['M3']/$all_marks[0]['M1']) * 100;
									$mark = ($all_marks[0]['M2'] == 'AB' || $all_marks[0]['M2'] == '-')?$all_marks[0]['M2']:$mark;
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
						
						
						$marks['pt'] = 0; 
						$marks['notebook'] = 0;
						$marks['subject_enrichment'] =0;
						$marks['half_yearly'] = $final_marks[0];
						$marks['half_yearly2'] = $final_marks[1];
						$pt_marks = ($marks['pt'] == 'AB' || $marks['pt'] == '-')?'0':$marks['pt'];
						$half_yearly2 = ($marks['half_yearly2'] == 'AB' || $marks['half_yearly2'] == '-')?'0':$marks['half_yearly2'];
						$notebook_marks = ($marks['notebook'] == 'AB' || $marks['notebook'] == '-')?'0':$marks['notebook'];
						$se_marks = ($marks['subject_enrichment'] == 'AB' || $marks['subject_enrichment'] == '-')?0:$marks['subject_enrichment'];
						$hy_marks = ($marks['half_yearly'] == 'AB' || $marks['half_yearly'] == '-')?'0':$marks['half_yearly'];
						$marks['obtained']=$hy_marks+$half_yearly2;
						$marks_obtained = $pt_marks + $notebook_marks + $se_marks + $hy_marks;
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
			$this->load->view('report_card/report_card_cbsc_pdf_annual_XI',$data);
			
		}
		else
		{
			die;
			if($term == 1)
			{
				$term = 'TERM-1';
				$examcode = array('1','2','3','6','4');
			}else
			{
				$term = 'TERM-2';
				$examcode = array('1','2','3','6','5');
			}
			
			foreach ($adm_no as $key => $value) {
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
				  $data['tot_present_day'] = $attPresentData[0]->cnt;	
				}else{
				  $attPresentData = $this->alam->select('stu_attendance_entry','count(DISTINCT att_date)cnt',"class_code='$class' AND sec_code='$section' AND att_date <= '$date' AND att_status='P' AND admno='$admnum'");
				  $data['tot_present_day'] = $attPresentData[0]->cnt;		
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
							$wetageMarks = $this->sumit->fetchSingleData('wetage2','exammaster',array('ExamCode'=>$val));
							$absent = array();
							$ab = 0;
							if($val == 1){
								$mark = array();
								if($pt_type == 1)
								{
								foreach ($all_marks as $key4 => $value4) {
									$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetageMarks['wetage2'];
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

										$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetageMarks['wetage2'];
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

										$mark[$key4] = ($value4['M3']/$value4['M1']) * $wetageMarks['wetage2'];
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

								   ($round_off==1)?$final_marks[$keys] = round($final_marks[$keys]):$final_marks[$keys] = $final_marks[$keys];
							}else{
								if(!empty($all_marks))
								{
									$mark = ($all_marks[0]['M3']/$all_marks[0]['M1']) * $wetageMarks['wetage2'];

									$mark = ($all_marks[0]['M2'] == 'AB' || $all_marks[0]['M2'] == '-')?$all_marks[0]['M2']:$mark;
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
						
						$marks['pt'] = $final_marks[0]; 
						$marks['notebook'] = $final_marks[1];
						$marks['activity'] = $final_marks[2];
						$marks['subject_enrichment'] =$final_marks[3];
						$marks['half_yearly'] = $final_marks[4];

						$pt_marks = ($marks['pt'] == 'AB' || $marks['pt'] == '-')?0:$marks['pt'];
						$notebook_marks = ($marks['notebook'] == 'AB' || $marks['notebook'] == '-')?0:$marks['notebook'];
						$activity_marks = ($marks['activity'] == 'AB' || $marks['activity'] == '-')?0:$marks['activity'];
						$se_marks = ($marks['subject_enrichment'] == 'AB' || $marks['subject_enrichment'] == '-')?0:$marks['subject_enrichment'];
						$hy_marks = ($marks['half_yearly'] == 'AB' || $marks['half_yearly'] == '-')?0:$marks['half_yearly'];

						$marks_obtained = $pt_marks + $notebook_marks + $se_marks + $hy_marks + $activity_marks;
						$marks['marks_obtained'] = ($round_off==1)?round($marks_obtained): number_format($marks_obtained,2);
						$gradeData = $this->sumit->fetchSingleData('Grade,Qualitative_Norms','grademaster',"ORange >=$marks_obtained AND CRange <= $marks_obtained");
						$marks['grade'] = $gradeData['Grade'];
						$result[$value]['sub'][$key2]['marks'] = $marks;
					}
				}
			}
			$data['round_off'] = $round_off;
			$data['result']    = $result;
			$data['school_setting'] = $school_setting;
			$data['trm'] = $termId;
			$data['grade_only_sub'] = $stu_data['grade_only_sub'];
			$this->load->view('report_card/report_card_cmc_pdf',$data);
		}
	}
	
	function adpdf(){
		$idd = $this->input->post('idd');
		$lp  = $this->input->post('lp');
		$admnoo = $this->input->post('admno');
	    $admno = str_replace("/", "-",$admnoo);
		//$url= base_url('assets/dash_css/bootstrap.min.css')
		$url= "https://micaeduco.co.in/erp/assets/dash_css/bootstrap.min.css";
		$html = '';
		
		$html .="<html><head><title>Report Card</title><link rel='stylesheet' href='$url'><script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js'></script><script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js'></script><link href='https://fonts.googleapis.com/css?family=Laila:700&display=swap' rel='stylesheet'>
		<style>
		 table tr th,td{
			font-size:12px!important;
			padding:3px!important;
		}
		@page { margin: 50px 12px 0px 12px; }
		.sign{
			font-family: 'Laila', serif;
			}
		</style>
	    </head><body><div style='border:5px solid #000; padding:10px;'>";
		$html .= $this->input->post('value');
	    $html .="</div></body></html>";
		
		$this->load->library('Pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'potrait');
		$this->dompdf->render();
		$output = $this->dompdf->output();
		$path = 'report_card/term1';
		if(!is_dir($path)){
			mkdir($path,0755, true);
			file_put_contents($path.'/'.$admno .'.pdf', $output);
		}else{
			file_put_contents($path.'/'.$admno .'.pdf', $output);
		}
		$this->alam->update('student',array('t1_report_card_status' => 1),"ADM_NO='$admnoo'");
		if($idd == $lp){
			$this->session->set_userdata('ref','1');
		}
		echo $idd;
	}
	

function adpdf_annual(){
		$idd = $this->input->post('idd');
		$lp  = $this->input->post('lp');
		$admnoo = $this->input->post('admno');
	    $admno = str_replace("/", "-",$admnoo);
		$url=base_url('assets/dash_css/bootstrap.min.css');
		$html = '';
		$html .="<html><head><title>Report Card</title><link rel='stylesheet' href='$url'><script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js'></script><script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js'></script><link href='https://fonts.googleapis.com/css?family=Laila:700&display=swap' rel='stylesheet'>
		<style>
		 table tr th,td{
			font-size:12px!important;
			padding:3px!important;
		}
		@page { margin: 50px 12px 0px 12px; }
		.sign{
			font-family: 'Laila', serif;
			}
		</style>
	    </head><body><div style='border:5px solid #000; padding:10px;'>";
		$html .= $this->input->post('value');
	    $html .="</div></body></html>";
		
		$this->load->library('Pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'potrait');
		$this->dompdf->render();
		$output = $this->dompdf->output();
		$path = 'report_card/annual';
		if(!is_dir($path)){
			mkdir($path,0755, true);
			file_put_contents($path.'/'.$admno .'.pdf', $output);
		}else{
			file_put_contents($path.'/'.$admno .'.pdf', $output);
		}
		$this->alam->update('student',array('t2_report_card_status' => 1),"ADM_NO='$admnoo'");
		if($idd == $lp){
			$this->session->set_userdata('ref','1');
		}
		echo $idd;
	}
	
function adpdf_int(){
		$idd = $this->input->post('idd');
		$lp  = $this->input->post('lp');
		$admnoo = $this->input->post('admno');
	    $admno = str_replace("/", "-",$admnoo);
		$url=base_url('assets/dash_css/bootstrap.min.css');
		$html = '';
		$html .="<html><head><title>Report Card</title><link rel='stylesheet' href='$url'><script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js'></script><script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js'></script><link href='https://fonts.googleapis.com/css?family=Laila:700&display=swap' rel='stylesheet'>
		<style>
		 table tr th,td{
			font-size:12px!important;
			padding:3px!important;
		}
		@page { margin: 50px 12px 0px 12px; }
		.sign{
			font-family: 'Laila', serif;
			}
		</style>
	    </head><body><div style='border:5px solid #000; padding:10px;'>";
		$html .= $this->input->post('value');
	    $html .="</div></body></html>";
		
		$this->load->library('Pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'potrait');
		$this->dompdf->render();
		$output = $this->dompdf->output();
		$path = 'report_card/internal_assessment';
		if(!is_dir($path)){
			mkdir($path,0755, true);
			file_put_contents($path.'/'.$admno .'.pdf', $output);
		}else{
			file_put_contents($path.'/'.$admno .'.pdf', $output);
		}
		$this->alam->update('student',array('int_report_card_status' => 1),"ADM_NO='$admnoo'");
		if($idd == $lp){
			$this->session->set_userdata('ref','1');
		}
		echo $idd;
	}
	
	function adpdfNur(){
		$idd = $this->input->post('idd');
		$lp  = $this->input->post('lp');
		$admnoo = $this->input->post('admno');
	    $admno = str_replace("/", "-",$admnoo);
		$url=base_url('assets/dash_css/bootstrap.min.css');
		$html = '';
		$html .="<html><head><title>Report Card</title><link rel='stylesheet' href='$url'><script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js'></script><script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js'></script><link href='https://fonts.googleapis.com/css?family=Laila:700&display=swap' rel='stylesheet'>
		<style>
		 table tr th,td{
			font-size:12px!important;
			padding:3px!important;
		}
		@page { margin: 50px 12px 0px 12px; }
		.sign{
			font-family: 'Laila', serif;
			}
		</style>
	    </head><body><div style='border:5px solid #000; padding:10px;'>";
		$html .= $this->input->post('value');
	    $html .="</div></body></html>";
		
		$this->load->library('Pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'potrait');
		$this->dompdf->render();
		$output = $this->dompdf->output();
		$trm = $this->input->post('term');
		if($trm == 1){
			$path = 'report_card/term1';
		}else{
			$path = 'report_card_annual';
		}
		
		if(!is_dir($path)){
			mkdir($path,0755, true);
			file_put_contents($path.'/'.$admno .'.pdf', $output);
		}else{
			file_put_contents($path.'/'.$admno .'.pdf', $output);
		}
		if($trm == 1){
			$this->alam->update('student',array('t1_report_card_status' => 1),"ADM_NO='$admnoo'");
		}else{
			$this->alam->update('student',array('t2_report_card_status' => 1),"ADM_NO='$admnoo'");
		}
		if($idd == $lp){
			$this->session->set_userdata('ref','1');
		}
		echo $idd;
	}
	
	

	public function chksession(){
		if(!empty($this->session->userdata('ref'))){
			echo $this->session->userdata('ref');
			$this->session->unset_userdata('ref');
		}else{
			echo 0;
		}
	}
	public function make_report_card_tabulation($pdf=null,$trm=null,$classs=null,$sec=null,$date=null,$round=null){
		$result = array();
		$final_marks = array();
		if($pdf == null){
			$trm    = $this->input->post('trm');
			$classs = $this->input->post('classs');
			$sec    = $this->input->post('sec');
			$date   = $this->input->post('date');
			$round  = $this->input->post('round');
		}
		
		// gautam sir yaha se III to V k liye code kiya huwa hai only for displaying k liye
		if($classs == '5' || $classs=='6' || $classs == '7'){
			error_reporting(0);
			if($classs == '5'){
				$clospan = '6';
			}else if($classs == '6'){
				$clospan = '7';
			}else if($classs == '7'){
				$clospan = '8';
			}
			$results = $this->alam->selectA('iii_v_tabulaton_save','id,ADM_NO,ROLL_NO,FIRST_NM,MIDDLE_NM,TITLE_NM',"CLASS='$classs' AND SEC='$sec' order by ROLL_NO");
			$rslt = array();
			foreach($results as $key12 => $val12){
				$marksData = $this->alam->selectA('iii_v_tabulaton_marks_save','subject_name,pt,half_yearly,marks_obtained,grade',"iii_v_tabulaton_save_id='".$val12['id']."'");
				
				$rslt[] = [
					'ADM_NO'   => $val12['ADM_NO'],
					'ROLL_NO'  => $val12['ROLL_NO'],
					'FIRST_NM' => $val12['FIRST_NM'],
					'mrks'     => $marksData
				];
			}
			
			?>
				<br /><br />
				<table class='table' style='width:100%' border='1'>
					<tr>
						<th style='background:#337ab7; color:#fff !important;'>ADM NO</th>
						<th style='background:#337ab7; color:#fff !important;'>ROLL NO</th>
						<th style='background:#337ab7; color:#fff !important;'>NAME</th>
						<th style='background:#337ab7; color:#fff !important;'>EXAM</th>
						<?php
			
							foreach($marksData as $key44 => $val44){
								?>
									<th style='background:#337ab7; color:#fff !important;'><?php echo $val44['subject_name']; ?></th>
								<?php
							}
						?>
						<th style='background:#337ab7; color:#fff !important;'>TOTAL</th>
					</tr>
					<?php
						foreach($rslt as $key22 => $val22){
							?>
								<tr style='background:#eee;'>
									<td><?php echo $val22['ADM_NO']; ?></td>
									<td><?php echo $val22['ROLL_NO']; ?></td>
									<td><?php echo $val22['FIRST_NM']; ?></td>
									<td></td>
									<td colspan='<?php echo $clospan; ?>'></td>
									<td></td>
								</tr>
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td>UNIT TEST</td>
										<?php
							
											foreach($val22['mrks'] as $key33 => $val33){
												?>
													<td>
														<?php 
												if($val33['subject_name'] == 'COMPUTER' AND  $val33['pt'] == '0'){
												echo "-";
												}else{
												echo $val33['pt'];
												}
												
														?>
													</td>
												<?php
											}
										?>
									<td></td>	
								</tr>
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td>MID TERM</td>
										<?php
											foreach($val22['mrks'] as $key33 => $val33){
												?>
													<td>
														<?php
															
																echo round($val33['half_yearly']);
															
														?>
													</td>
												<?php
											}
										?>
									<td></td>	
								</tr>
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td>MARKS OBTAINED</td>
										<?php
											$tot = 0;
											foreach($val22['mrks'] as $key33 => $val33){
												if($val33['subject_name'] == 'DRAWING'){
												$tot += 0;
												}else if($val33['subject_name'] == 'COMPUTER'){
													$tot += 0;
												}else{
												$tot += $val33['marks_obtained'];
												}
					//$tot += round(($val33['subject_name'] == 'DRAWING' || $subject['subject_name']=='COMPUTER')?0:$val33['marks_obtained']);
									
									?>
													<td>
														<?php 
															echo round($val33['marks_obtained']);
														?>
													</td>
												<?php
											}
										?>
									<td><?php echo $tot; ?></td>	
								</tr>
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td>GRADE</td>
										<?php
											foreach($val22['mrks'] as $key33 => $val33){
												?>
													<td>
														<?php 
											   if($val33['subject_name'] == 'G.K'){
												
												   $grd = $val33['marks_obtained']*2;
												   
												}
												 
												else if($val33['subject_name'] =='COMPUTER')
						{
							 $grd = $val33['marks_obtained']/80*100;
						}
												else{
													$grd = $val33['marks_obtained'];
												}
															if($grd >= '91' AND $grd <= '100'){
																echo "A+";
															}else if($grd >= '75' AND $grd <= '90'){
																echo "A";
															}else if($grd >= '56' AND $grd <= '74'){
																echo "B";
															}else if($grd >= '35' AND $grd <= '55'){
																echo "C";
															}else if($grd <= '35'){
																echo "D";
															}	
												
														?>  
													</td>
												<?php
											}
										?>
										<td></td>
								</tr>
							<?php
						}
					?>
				</table>
				<br /><br />
			<?php
			
		}
		// aur yaha pe end hai
		
		$examModedata = $this->alam->select('classes','ExamMode',"Class_No='$classs'");
		$examode = $examModedata[0]->ExamMode;
		
		if($examode == 1)//diffrentiate CBSE or CMC
		{
			$term   = $trm; 
			if($trm == 1){ 
				$trm = 'TERM-1';
				$examList = $this->alam->selectA('exammaster','*',"ExamCode in('1','4')");
			}else{
				$trm = 'TERM-2';
				$examList = $this->alam->selectA('exammaster','*',"ExamCode in('1','5')");
			}
			$subjectList = $this->alam->getClassWiseSubject($trm,$classs,$sec);
			
			//for attendance //
			$stu_att_type = $this->alam->select('student_attendance_type','*',"class_code='$classs'");
			$att_type     = $stu_att_type[0]->attendance_type;
			if($att_type == 1){
				$att_data = $this->alam->select('stu_attendance_entry','count(DISTINCT att_date)cnt',"class_code='$classs' AND sec_code='$sec' AND att_date >= '$date'");
				$data['tot_working_day'] = $att_data[0]->cnt;
			}else{
				$att_data = $this->alam->select('stu_attendance_entry_periodwise','count(DISTINCT att_date)cnt',"class_code='$classs' AND sec_code='$sec' AND att_date >= '$date'");
				$data['tot_working_day'] = $att_data[0]->cnt;
			}
			//end attendance //
			
			$stu_data = $this->alam->selectA('student','ADM_NO,ROLL_NO, `CLASS`,(SELECT ExamMode FROM classes WHERE Class_No=student.CLASS)examode,DISP_CLASS,DISP_SEC,SEC,FIRST_NM,MIDDLE_NM,Height,Weight',"CLASS='$classs' AND SEC='$sec' AND Student_Status='ACTIVE' order by ROLL_NO");
			$this->alam->delete('temp_report_card');
			foreach($stu_data as $key => $val){
			$result[$val['ADM_NO']] = $val;			
			foreach($examList as $key1 => $val1){
				$subs = 1;
					$result[$val['ADM_NO']]['exmaList'][$val1['ExamCode']] = $val1['ExamName'];
					$result[$val['ADM_NO']]['wetage'][$val1['ExamCode']] = $val1['wetage1'];
					$admnum = $val['ADM_NO'];
					foreach($subjectList as $key2 => $val2){
						
						$marks = array();
						if($val2['opt_code'] == 2)
						{
							$check_student_subject = $this->sumit->checkData('*','studentsubject',array('Adm_no'=>$val['ADM_NO'],'Class'=>$classs,'SUBCODE'=>$val2['subject_code']));
						}
						else
						{
							$check_student_subject = true;
						}
						
						if($check_student_subject)
						{
							$examcodes = ($val1['ExamCode'] == 1)?array(1,7,8):array($val1['ExamCode']);
							$total_marks = 0;
							$total_mo = 0;$total_obtained_marks= 0;
							$obtained_marks = array();
							 foreach($examcodes as $key3 => $val3){

								$marksObtained = $this->alam->getMarksWithMaxMarks($val3,1,$classs,$val2["subject_code"],$trm,$val["ADM_NO"]);
								if($val3 == 1 || $val3 == 7 || $val3 == 8){
									$marksObtained['M3'] = (isset($marksObtained['M3']))?$marksObtained['M3']:0;
									$marksObtained['wetage_obt_cbse'] = (isset($marksObtained['wetage_obt_cbse']))?$marksObtained['wetage_obt_cbse']:0;
									if($val2['pt_type'] == 1){

										$marks[] = $marksObtained['wetage_obt_cbse'];
										$final_marks[$val2['subject_code']] = number_format(max($marks),2);
										$obtained_marks[] = $marksObtained['M3'];
										// $total_mo = $marksObtained['M3'] + $total_mo;
										$total_mo = max($obtained_marks);
									}elseif($val2['pt_type'] == 2){
										
										$marks = $marksObtained['wetage_obt_cbse'];
										$total_marks = $total_marks + $marks;
										$final_marks[$val2['subject_code']] = $total_marks/3;
										$total_obtained_marks += $marksObtained['M3'];
										$total_mo = $total_obtained_marks/3;
									}else{
										$marks[$val2['subject_code']][$key3] = $marksObtained['wetage_obt_cbse'];
										$obtained_marks[] = $marksObtained['M3'];
										rsort($obtained_marks);
										rsort($marks[$val2['subject_code']]);
										if(count($marks[$val2['subject_code']]) >=2)
										{
											$final_marks[$val2['subject_code']] = ($marks[$val2['subject_code']][0]+$marks[$val2['subject_code']][1])/2;
											$total_mo = ($obtained_marks[0] + $obtained_marks[1])/2;
										}
									}
									
								}else{
									$final_marks[$val2['subject_code']] = $marksObtained['wetage_obt_cbse'];
									$total_mo = $marksObtained['M2'];
								} 
								
								$total_mo = ($total_mo =='')?0:$total_mo;
								if(!($total_mo == 'AB' || $total_mo =='-'))
								{
									$total_mo = ($round == 1)?round($total_mo):$total_mo;
								}
								 
								$final_marks[$val2['subject_code']] = (!isset($final_marks[$val2['subject_code']]))?0:$final_marks[$val2['subject_code']];

								$final_marks[$val2['subject_code']] = ($round == 1)?round($final_marks[$val2['subject_code']]):number_format($final_marks[$val2['subject_code']],2);

								$result[$val['ADM_NO']]['marks'][$val1['ExamCode']][$val2['subject_code']]['wt'] = $final_marks[$val2['subject_code']];

								$result[$val['ADM_NO']]['marks'][$val1['ExamCode']][$val2['subject_code']]['mo'] = $total_mo;

								$result[$val['ADM_NO']]['marks'][$val1['ExamCode']][$val2['subject_code']]['opt_code'] = $val2['opt_code'];

								$result[$val['ADM_NO']]['marks'][$val1['ExamCode']][$val2['subject_code']]['display'] = 1;

							 } //end of exam code
						}
						else
						{
							$result[$val['ADM_NO']]['marks'][$val1['ExamCode']][$val2['subject_code']]['wt'] = 0;

							$result[$val['ADM_NO']]['marks'][$val1['ExamCode']][$val2['subject_code']]['mo'] = 0;

							$result[$val['ADM_NO']]['marks'][$val1['ExamCode']][$val2['subject_code']]['opt_code'] = 0;

							$result[$val['ADM_NO']]['marks'][$val1['ExamCode']][$val2['subject_code']]['display'] = 0;
						}
						$subs += 1;
					}
				}
				
			}
			
			
			$data['allData'] = $result;
			$data['subject_list'] = $subjectList;
			$data['grade'] = $this->alam->selectA('grademaster','CRange,ORange,Grade,Qualitative_Norms');
			$data['trm'] = $trm;
			$data['term'] = $term;
			$data['classs'] = $classs;
			$data['sec'] = $sec;
			$data['date'] = $date;
			$data['round'] = $round;
			
			if($pdf == 1){
				return $data;
			}
			// print_r("<pre>");print_r($data);exit();
		//	$this->load->view('report_card/report_card_tabulation_cbse',$data);
			$this->load->view('report_card/report_card_tabulation_cbse_III_V',$data);
		
		}
		else //for CMC
		{
		    $term   = $trm; 
			if($trm == 1){ 
				$trm = 'TERM-1';
				$examList = $this->alam->selectA('exammaster','*',"ExamCode in('1','2','3','6','4')");
			}else{
				$trm = 'TERM-2';
				$examList = $this->alam->selectA('exammaster','*',"ExamCode in('1','2','3','6','5')");
			}
			$subjectList = $this->alam->getClassWiseSubject($trm,$classs,$sec);
			
			//for attendance //
			$stu_att_type = $this->alam->select('student_attendance_type','*',"class_code='$classs'");
			$att_type     = $stu_att_type[0]->attendance_type;
			if($att_type == 1){
				$att_data = $this->alam->select('stu_attendance_entry','count(DISTINCT att_date)cnt',"class_code='$classs' AND sec_code='$sec' AND att_date >= '$date'");
				$data['tot_working_day'] = $att_data[0]->cnt;
			}else{
				$att_data = $this->alam->select('stu_attendance_entry_periodwise','count(DISTINCT att_date)cnt',"class_code='$classs' AND sec_code='$sec' AND att_date >= '$date'");
				$data['tot_working_day'] = $att_data[0]->cnt;
			}
			//end attendance //
			
			$stu_data = $this->alam->selectA('student','ADM_NO,ROLL_NO, `CLASS`,(SELECT ExamMode FROM classes WHERE Class_No=student.CLASS)examode,DISP_CLASS,DISP_SEC,FIRST_NM,MIDDLE_NM,Height,Weight',"CLASS='$classs' AND SEC='$sec' AND Student_Status='ACTIVE' order by ROLL_NO");
			$this->alam->delete('temp_report_card');
			foreach($stu_data as $key => $val){

				$result[$val['ADM_NO']] = $val;			

				foreach($examList as $key1 => $val1){
				$subs = 1;
					$result[$val['ADM_NO']]['exmaList'][$val1['ExamCode']] = $val1['ExamName'];
					$result[$val['ADM_NO']]['wetage'][$val1['ExamCode']] = $val1['wetage2'];
					$admnum = $val['ADM_NO'];
					foreach($subjectList as $key2 => $val2){
						
						$marks = array();
						if($val2['opt_code'] == 2)
						{
							$check_student_subject = $this->sumit->checkData('*','studentsubject',array('Adm_no'=>$val['ADM_NO'],'Class'=>$classs,'SUBCODE'=>$val2['subject_code']));
						}
						else
						{
							$check_student_subject = true;
						}
						
						if($check_student_subject)
						{
							$examcodes = ($val1['ExamCode'] == 1)?array(1,7,8):array($val1['ExamCode']);
							$total_marks = 0;
							$total_mo = 0;
							 foreach($examcodes as $key3 => $val3){

								$marksObtained = $this->alam->getMarksWithMaxMarks($val3,2,$classs,$val2["subject_code"],$trm,$val["ADM_NO"]);
								
								if($val3 == 1 || $val3 == 7 || $val3 == 8){
									if($val2['pt_type'] == 1){

										$marks[] = $marksObtained['wetage_obt_cmc'];
										$final_marks[$val2['subject_code']] = number_format(max($marks),2);
									}elseif($val2['pt_type'] == 2){
										
										$marks = $marksObtained['wetage_obt_cmc'];
										$total_marks = $total_marks + $marks;
										$final_marks[$val2['subject_code']] = $total_marks/3;
									}else{
										$marks[$val2['subject_code']][$key3] = $marksObtained['wetage_obt_cmc'];
										rsort($marks[$val2['subject_code']]);
										if(count($marks[$val2['subject_code']]) >=2)
										{
											$final_marks[$val2['subject_code']] = ($marks[$val2['subject_code']][0]+$marks[$val2['subject_code']][1])/2;
										}
									}
									$total_mo = $marksObtained['M3'] + $total_mo;
								}else{
									$final_marks[$val2['subject_code']] = $marksObtained['wetage_obt_cmc'];
									$total_mo = $marksObtained['M2'];
								} 
								
								$total_mo = ($total_mo =='')?0:$total_mo;
								$final_marks[$val2['subject_code']] = (!isset($final_marks[$val2['subject_code']]))?0:$final_marks[$val2['subject_code']];

								$final_marks[$val2['subject_code']] = ($round == 1)?round($final_marks[$val2['subject_code']]):number_format($final_marks[$val2['subject_code']],2);

								$result[$val['ADM_NO']]['marks'][$val1['ExamCode']][$val2['subject_code']]['wt'] = $final_marks[$val2['subject_code']];

								$result[$val['ADM_NO']]['marks'][$val1['ExamCode']][$val2['subject_code']]['mo'] = $total_mo;

								$result[$val['ADM_NO']]['marks'][$val1['ExamCode']][$val2['subject_code']]['opt_code'] = $val2['opt_code'];

								$result[$val['ADM_NO']]['marks'][$val1['ExamCode']][$val2['subject_code']]['display'] = 1;

							 }
						}
						else
						{
							$result[$val['ADM_NO']]['marks'][$val1['ExamCode']][$val2['subject_code']]['wt'] = 0;

							$result[$val['ADM_NO']]['marks'][$val1['ExamCode']][$val2['subject_code']]['mo'] = 0;

							$result[$val['ADM_NO']]['marks'][$val1['ExamCode']][$val2['subject_code']]['opt_code'] = 0;

							$result[$val['ADM_NO']]['marks'][$val1['ExamCode']][$val2['subject_code']]['display'] = 0;
						}
						$subs += 1;
					}
				}
				
			}
			
			$data['allData'] = $result;
			$data['subject_list'] = $subjectList;
			$data['grade'] = $this->alam->selectA('grademaster','CRange,ORange,Grade,Qualitative_Norms');
			$data['trm'] = $trm;
			$data['term'] = $term;
			$data['classs'] = $classs;
			$data['sec'] = $sec;
			$data['date'] = $date;
			$data['round'] = $round;
			if($pdf == 1){
				return $data;
			}	
			$this->load->view('report_card/report_card_tabulation_cmc',$data);
		}
		// echo "<pre>";
		// print_r($result);
	}
	public function make_report_card_tabulationl($pdf=null,$trm=null,$classs=null,$sec=null,$date=null,$round=null){
	
		$result = array();
		$final_marks = array();
		if($pdf == null){
			$trm    = $this->input->post('trm');
			$classs = $this->input->post('classs');
			$sec    = $this->input->post('sec');
			$date   = $this->input->post('date');
			$round  = $this->input->post('round');
		}
		
		$examModedata = $this->alam->select('classes','ExamMode',"Class_No='$classs'");
		$examode = $examModedata[0]->ExamMode;
		if($examode == 1)//diffrentiate CBSE or CMC
		{
			$term   = $trm; 
			if($trm == 1){ 
				$trm = 'TERM-1';
				$examList = $this->alam->selectA('exammaster','*',"ExamCode in('1','2','3','4')");
			}else{
				$trm = 'TERM-2';
				$examList = $this->alam->selectA('exammaster','*',"ExamCode in('1','2','3','5')");
			}
			$subjectList = $this->alam->getClassWiseSubject($trm,$classs,$sec);
			
			//for attendance //
			$stu_att_type = $this->alam->select('student_attendance_type','*',"class_code='$classs'");
			$att_type     = $stu_att_type[0]->attendance_type;
			if($att_type == 1){
				$att_data = $this->alam->select('stu_attendance_entry','count(DISTINCT att_date)cnt',"class_code='$classs' AND sec_code='$sec' AND att_date >= '$date'");
				$data['tot_working_day'] = $att_data[0]->cnt;
			}else{
				$att_data = $this->alam->select('stu_attendance_entry_periodwise','count(DISTINCT att_date)cnt',"class_code='$classs' AND sec_code='$sec' AND att_date >= '$date'");
				$data['tot_working_day'] = $att_data[0]->cnt;
			}
			//end attendance //
			
			$stu_data = $this->alam->selectA('student','ADM_NO,ROLL_NO, `CLASS`,(SELECT ExamMode FROM classes WHERE Class_No=student.CLASS)examode,DISP_CLASS,DISP_SEC,SEC,FIRST_NM,MIDDLE_NM,Height,Weight',"CLASS='$classs' AND SEC='$sec' AND Student_Status='ACTIVE' order by ROLL_NO");
			$this->alam->delete('temp_report_card');
			foreach($stu_data as $key => $val){

				$result[$val['ADM_NO']] = $val;			

				foreach($examList as $key1 => $val1){
				$subs = 1;
					$result[$val['ADM_NO']]['exmaList'][$val1['ExamCode']] = $val1['ExamName'];
					$result[$val['ADM_NO']]['wetage'][$val1['ExamCode']] = $val1['wetage1'];
					
					$admnum = $val['ADM_NO'];
					foreach($subjectList as $key2 => $val2){
					$result[$val['ADM_NO']]['SUBCODE'][$val1['ExamCode']] = $val2['subject_code'];
						$marks = array();
						if($val2['opt_code'] == 2)
						{
							$check_student_subject = $this->sumit->checkData('*','studentsubject',array('Adm_no'=>$val['ADM_NO'],'Class'=>$classs,'SUBCODE'=>$val2['subject_code']));
						}
						else
						{
							$check_student_subject = true;
						}
						
						if($check_student_subject)
						{
							$examcodes = ($val1['ExamCode'] == 1)?array(1,7,8):array($val1['ExamCode']);
							$total_marks = 0;
							$total_mo = 0;$total_obtained_marks= 0;
							$obtained_marks = array();
							 foreach($examcodes as $key3 => $val3){

								$marksObtained = $this->alam->getMarksWithMaxMarks($val3,1,$classs,$val2["subject_code"],$trm,$val["ADM_NO"]);
								if($val3 == 1 || $val3 == 7 || $val3 == 8){
									$marksObtained['M3'] = (isset($marksObtained['M3']))?$marksObtained['M3']:0;
									$marksObtained['wetage_obt_cbse'] = (isset($marksObtained['wetage_obt_cbse']))?$marksObtained['wetage_obt_cbse']:0;
									if($val2['pt_type'] == 1){

										$marks[] = $marksObtained['wetage_obt_cbse'];
										$final_marks[$val2['subject_code']] = number_format(max($marks),2);
										$obtained_marks[] = $marksObtained['M3'];
										// $total_mo = $marksObtained['M3'] + $total_mo;
										$total_mo = max($obtained_marks);
									}elseif($val2['pt_type'] == 2){
										
										$marks = $marksObtained['wetage_obt_cbse'];
										$total_marks = $total_marks + $marks;
										$final_marks[$val2['subject_code']] = $total_marks/3;
										$total_obtained_marks += $marksObtained['M3'];
										$total_mo = $total_obtained_marks/3;
									}else{
										$marks[$val2['subject_code']][$key3] = $marksObtained['wetage_obt_cbse'];
										$obtained_marks[] = $marksObtained['M3'];
										rsort($obtained_marks);
										rsort($marks[$val2['subject_code']]);
										if(count($marks[$val2['subject_code']]) >=2)
										{
											$final_marks[$val2['subject_code']] = ($marks[$val2['subject_code']][0]+$marks[$val2['subject_code']][1])/2;
											$total_mo = ($obtained_marks[0] + $obtained_marks[1])/2;
										}
									}
									
								}else{
									$final_marks[$val2['subject_code']] = $marksObtained['wetage_obt_cbse'];
									$total_mo = $marksObtained['M2'];
								} 
								
								$total_mo = ($total_mo =='')?0:$total_mo;
								if(!($total_mo == 'AB' || $total_mo =='-'))
								{
									$total_mo = ($round == 1)?round($total_mo):$total_mo;
								}
								$final_marks[$val2['subject_code']] = (!isset($final_marks[$val2['subject_code']]))?0:$final_marks[$val2['subject_code']];

								$final_marks[$val2['subject_code']] = ($round == 1)?round($final_marks[$val2['subject_code']]):number_format($final_marks[$val2['subject_code']],2);

								$result[$val['ADM_NO']]['marks'][$val1['ExamCode']][$val2['subject_code']]['wt'] = $final_marks[$val2['subject_code']];

								$result[$val['ADM_NO']]['marks'][$val1['ExamCode']][$val2['subject_code']]['mo'] = $total_mo;

								$result[$val['ADM_NO']]['marks'][$val1['ExamCode']][$val2['subject_code']]['opt_code'] = $val2['opt_code'];

								$result[$val['ADM_NO']]['marks'][$val1['ExamCode']][$val2['subject_code']]['display'] = 1;

							 } //end of exam code
						}
						else
						{
							$result[$val['ADM_NO']]['marks'][$val1['ExamCode']][$val2['subject_code']]['wt'] = 0;

							$result[$val['ADM_NO']]['marks'][$val1['ExamCode']][$val2['subject_code']]['mo'] = 0;

							$result[$val['ADM_NO']]['marks'][$val1['ExamCode']][$val2['subject_code']]['opt_code'] = 0;

							$result[$val['ADM_NO']]['marks'][$val1['ExamCode']][$val2['subject_code']]['display'] = 0;
						}
						$subs += 1;
					}
				}
				
			}
			
			$data['allData'] = $result;
			$data['subject_list'] = $subjectList;
			$data['grade'] = $this->alam->selectA('grademaster','CRange,ORange,Grade,Qualitative_Norms');
			$data['trm'] = $trm;
			$data['term'] = $term;
			$data['classs'] = $classs;
			$data['sec'] = $sec;
			$data['date'] = $date;
			$data['round'] = $round;
			if($pdf == 1){
				return $data;
			}
			// print_r("<pre>");print_r($data);exit();
			$this->load->view('report_card/report_card_tabulation_cbse',$data);
		
		}
		else //for CMC
		{
		    $term   = $trm; 
			if($trm == 1){ 
				$trm = 'TERM-1';
				$examList = $this->alam->selectA('exammaster','*',"ExamCode in('1','2','3','6','4')");
			}else{
				$trm = 'TERM-2';
				$examList = $this->alam->selectA('exammaster','*',"ExamCode in('1','2','3','6','5')");
			}
			$subjectList = $this->alam->getClassWiseSubject($trm,$classs,$sec);
			
			//for attendance //
			$stu_att_type = $this->alam->select('student_attendance_type','*',"class_code='$classs'");
			$att_type     = $stu_att_type[0]->attendance_type;
			if($att_type == 1){
				$att_data = $this->alam->select('stu_attendance_entry','count(DISTINCT att_date)cnt',"class_code='$classs' AND sec_code='$sec' AND att_date >= '$date'");
				$data['tot_working_day'] = $att_data[0]->cnt;
			}else{
				$att_data = $this->alam->select('stu_attendance_entry_periodwise','count(DISTINCT att_date)cnt',"class_code='$classs' AND sec_code='$sec' AND att_date >= '$date'");
				$data['tot_working_day'] = $att_data[0]->cnt;
			}
			//end attendance //
			
			$stu_data = $this->alam->selectA('student','ADM_NO,ROLL_NO, `CLASS`,(SELECT ExamMode FROM classes WHERE Class_No=student.CLASS)examode,DISP_CLASS,DISP_SEC,FIRST_NM,MIDDLE_NM,Height,Weight',"CLASS='$classs' AND SEC='$sec' AND Student_Status='ACTIVE' order by ROLL_NO");
			$this->alam->delete('temp_report_card');
			foreach($stu_data as $key => $val){

				$result[$val['ADM_NO']] = $val;			

				foreach($examList as $key1 => $val1){
				$subs = 1;
					$result[$val['ADM_NO']]['exmaList'][$val1['ExamCode']] = $val1['ExamName'];
					$result[$val['ADM_NO']]['wetage'][$val1['ExamCode']] = $val1['wetage2'];
					$admnum = $val['ADM_NO'];
					foreach($subjectList as $key2 => $val2){
						
						$marks = array();
						if($val2['opt_code'] == 2)
						{
							$check_student_subject = $this->sumit->checkData('*','studentsubject',array('Adm_no'=>$val['ADM_NO'],'Class'=>$classs,'SUBCODE'=>$val2['subject_code']));
						}
						else
						{
							$check_student_subject = true;
						}
						
						if($check_student_subject)
						{
							$examcodes = ($val1['ExamCode'] == 1)?array(1,7,8):array($val1['ExamCode']);
							$total_marks = 0;
							$total_mo = 0;
							 foreach($examcodes as $key3 => $val3){

								$marksObtained = $this->alam->getMarksWithMaxMarks($val3,2,$classs,$val2["subject_code"],$trm,$val["ADM_NO"]);
								
								if($val3 == 1 || $val3 == 7 || $val3 == 8){
									if($val2['pt_type'] == 1){

										$marks[] = $marksObtained['wetage_obt_cmc'];
										$final_marks[$val2['subject_code']] = number_format(max($marks),2);
									}elseif($val2['pt_type'] == 2){
										
										$marks = $marksObtained['wetage_obt_cmc'];
										$total_marks = $total_marks + $marks;
										$final_marks[$val2['subject_code']] = $total_marks/3;
									}else{
										$marks[$val2['subject_code']][$key3] = $marksObtained['wetage_obt_cmc'];
										rsort($marks[$val2['subject_code']]);
										if(count($marks[$val2['subject_code']]) >=2)
										{
											$final_marks[$val2['subject_code']] = ($marks[$val2['subject_code']][0]+$marks[$val2['subject_code']][1])/2;
										}
									}
									$total_mo = $marksObtained['M3'] + $total_mo;
								}else{
									$final_marks[$val2['subject_code']] = $marksObtained['wetage_obt_cmc'];
									$total_mo = $marksObtained['M2'];
								} 
								
								$total_mo = ($total_mo =='')?0:$total_mo;
								$final_marks[$val2['subject_code']] = (!isset($final_marks[$val2['subject_code']]))?0:$final_marks[$val2['subject_code']];

								$final_marks[$val2['subject_code']] = ($round == 1)?round($final_marks[$val2['subject_code']]):number_format($final_marks[$val2['subject_code']],2);

								$result[$val['ADM_NO']]['marks'][$val1['ExamCode']][$val2['subject_code']]['wt'] = $final_marks[$val2['subject_code']];

								$result[$val['ADM_NO']]['marks'][$val1['ExamCode']][$val2['subject_code']]['mo'] = $total_mo;

								$result[$val['ADM_NO']]['marks'][$val1['ExamCode']][$val2['subject_code']]['opt_code'] = $val2['opt_code'];

								$result[$val['ADM_NO']]['marks'][$val1['ExamCode']][$val2['subject_code']]['display'] = 1;

							 }
						}
						else
						{
							$result[$val['ADM_NO']]['marks'][$val1['ExamCode']][$val2['subject_code']]['wt'] = 0;

							$result[$val['ADM_NO']]['marks'][$val1['ExamCode']][$val2['subject_code']]['mo'] = 0;

							$result[$val['ADM_NO']]['marks'][$val1['ExamCode']][$val2['subject_code']]['opt_code'] = 0;

							$result[$val['ADM_NO']]['marks'][$val1['ExamCode']][$val2['subject_code']]['display'] = 0;
						}
						$subs += 1;
					}
				}
			}
			
			$data['allData'] = $result;
			$data['subject_list'] = $subjectList;
			$data['grade'] = $this->alam->selectA('grademaster','CRange,ORange,Grade,Qualitative_Norms');
			$data['trm'] = $trm;
			$data['term'] = $term;
			$data['classs'] = $classs;
			$data['sec'] = $sec;
			$data['date'] = $date;
			$data['round'] = $round;
			if($pdf == 1){
				return $data;
			}	
			$this->load->view('report_card/report_card_tabulation_cmc',$data);
		}
		// echo "<pre>";
		// print_r($result);
	}
	
	public function tabulation_cbse_pdf($trm,$term,$classs,$sec,$date,$round){
		ini_set('max_execution_time', 0); 
        ini_set('memory_limit','2048M');
		
		$result = $this->make_report_card_tabulation(1,$term,$classs,$sec,$date,$round);
		$data['allData'] = $result['allData'];
		$data['subject_list'] = $result['subject_list'];
		$data['grade'] = $result['grade'];
		
        $this->load->view('report_card/report_card_tabulation_cbse_pdf',$data);	
    
        $html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'landscape');
		$this->dompdf->render();
		$this->dompdf->stream("form.pdf", array("Attachment"=>0));	
	}
	
	public function tabulation_cmc_pdf($trm,$term,$classs,$sec,$date,$round){
		ini_set('max_execution_time', 0); 
        ini_set('memory_limit','2048M');
		
		$result = $this->make_report_card_tabulation(1,$term,$classs,$sec,$date,$round);
		$data['allData'] = $result['allData'];
		$data['subject_list'] = $result['subject_list'];
		$data['grade'] = $result['grade'];
		
        $this->load->view('report_card/report_card_tabulation_cmc_pdf',$data);	
    
        $html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'landscape');
		$this->dompdf->render();
		$this->dompdf->stream("form.pdf", array("Attachment"=>0));	
	}
		function adpdf_annual_XI(){
		$idd = $this->input->post('idd');
		$lp  = $this->input->post('lp');
		$admnoo = $this->input->post('admno');
	    $admno = str_replace("/", "-",$admnoo);
		$url=base_url('assets/dash_css/bootstrap.min.css');
		$html = '';
		$html .="<html><head><title>Report Card</title><link rel='stylesheet' href='$url'><script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js'></script><script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js'></script><link href='https://fonts.googleapis.com/css?family=Laila:700&display=swap' rel='stylesheet'>
		<style>
		 table tr th,td{
			font-size:12px!important;
			padding:3px!important;
		}
		@page { margin: 50px 12px 0px 12px; }
		.sign{
			font-family: 'Laila', serif;
			}
		</style>
	    </head><body><div style='border:5px solid #000; padding:10px;'>";
		$html .= $this->input->post('value');
	    $html .="</div></body></html>";
		
		$this->load->library('Pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'potrait');
		$this->dompdf->render();
		$output = $this->dompdf->output();
		$path = 'report_card_annual_XI';
		if(!is_dir($path)){
			mkdir($path,0755, true);
			file_put_contents($path.'/'.$admno .'.pdf', $output);
		}else{
			file_put_contents($path.'/'.$admno .'.pdf', $output);
		}
		$this->alam->update('student',array('t2_report_card_status' => 1),"ADM_NO='$admnoo'");
		if($idd == $lp){
			$this->session->set_userdata('ref','1');
		}
		echo $idd;
	}
}