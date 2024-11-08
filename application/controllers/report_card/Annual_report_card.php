<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Annual_report_card extends MY_controller
{

	public function __construct()
	{
		parent::__construct();
		$this->loggedOut();
		$this->load->model('Alam', 'alam');
		error_reporting(0);
	}

	public function index()
	{
		if (!in_array('viewTermWiseReportCard', permission_data)) {
			redirect('payroll/dashboard/dashboard');
		}
		$data['class_data'] = $this->alam->select('classes', '*', "class_no in (8,9,10,11,12)");
		$this->render_template('report_card/annual_report_card', $data);
	}

	public function classess_report_card()
	{
		$ret = '';
		$class_code = '';
		$pt_type = '';
		$exam_type = '';

		$class_nm = $this->input->post('val');
		$sec_data = $this->alam->select_order_by('student', 'distinct(DISP_SEC),SEC', 'DISP_SEC', "CLASS='$class_nm' AND Student_Status='ACTIVE'");

		$class_data = $this->alam->select('classes', '*', "Class_No='$class_nm'");
		$class_code = $class_data[0]->Class_No;
		$pt_type    = $class_data[0]->PT_TYPE;
		$exam_type  = $class_data[0]->ExamMode;

		$ret .= "<option value=''>Select</option>";
		if (isset($sec_data)) {
			foreach ($sec_data as $data) {
				$ret .= "<option value=" . $data->SEC . ">" . $data->DISP_SEC . "</option>";
			}
		}

		$array = array($ret, $class_code, $pt_type, $exam_type);
		echo json_encode($array);
	}

	public function make_report_card()
	{
		$trm        = $this->input->post('trm');
		$classs     = $this->input->post('classs');
		$sec        = $this->input->post('sec');
		$date       = $this->input->post('date');
		$dt         = date('Y-m-d', strtotime($date));
		$round      = $this->input->post('round');
		$class_code = $this->input->post('class_code');
		$pt_type    = $this->input->post('pt_type');
		$exam_type  = $this->input->post('exam_type');
		//echo $exam_type;die;
		$school_setting = $this->alam->select('school_setting', '*');
		$stu_data = $this->alam->annual_report_card_student_detail_new($classs, $sec);
		//echo $this->db->last_query();die;

		$array = array('trm' => $trm, 'school_setting' => $school_setting, 'stu_data' => $stu_data, 'classs' => $classs, 'sec' => $sec, 'round' => $round, 'dt' => $dt);

		$this->load->view('report_card/annual_report_card_list', $array);
	}

	public function generatePDF()
	{
		$class         = $this->input->post('classs');
		$dispClassData = $this->alam->selectA('classes', 'CLASS_NM', "Class_No='$class'");
		$DISP_CLASS    = $dispClassData[0]['CLASS_NM'];
		$sec           = $this->input->post('sec');
		$round_off     = $this->input->post('round_off');
		$examModeData  = $this->alam->selectA('classes', 'ExamMode', "Class_No='$class'");
		$examMode      = $examModeData[0]['ExamMode'];
		$school_photo = $this->alam->selectA('school_photo', '*');
		$data['School_Logo'] = $school_photo[0]['School_Logo'];

		$countOptData = $this->alam->selectA('class_section_wise_subject_allocation', 'count(subject_code)cnt', "Class_No='$class' AND opt_code in (0,2) AND section_no='$sec' AND applicable_exam='1'");
		if ($class == 8 || $class == 9 || $class == 10) {
			$data['cnt_opt'] = '6';
		} else if ($class == 11) {
			$data['cnt_opt'] = '5';
		} else {
			$data['cnt_opt'] = $countOptData[0]['cnt'];
		}

		if ($class == '11') { //chk for IX class
			if ($examMode == 1) { //for cbse
				$data['class']          = $class;
				$data['DISP_CLASS']     = $DISP_CLASS;
				$data['sec']            = $sec;
				$data['round']          = $round_off;
				$data['selected_stu']   = $this->input->post('stu_adm_no[]');
				$data['grademaster']    = $this->alam->select('grademaster', '*');
				$data['subjectData']    = $this->alam->getClassWiseSubject(1, $class, $sec);
				$data['school_setting'] = $this->alam->select('school_setting', '*');
				$this->load->view('report_card/cbse_annual_report_card_pdf_IX', $data);
			} else { //for cmc
				echo "CMC Work in Progress";
			}
		} elseif ($class == '12') { //chk for X class
			if ($examMode == 1) { //for cbse
				$data['class']          = $class;
				$data['DISP_CLASS']     = $DISP_CLASS;
				$data['sec']            = $sec;
				$data['round']          = $round_off;
				$data['selected_stu']   = $this->input->post('stu_adm_no[]');
				$data['grademaster']    = $this->alam->select('grademaster', '*');
				$data['subjectData']    = $this->alam->getClassWiseSubject(1, $class, $sec);
				$data['school_setting'] = $this->alam->select('school_setting', '*');
				$this->load->view('report_card/cbse_annual_report_card_pdf_X', $data);
			} else { //for cmc
				echo "CMC Work in Progress";
			}
		} else {
			if ($examMode == 1) { //for cbse
				$data['class']          = $class;
				$data['DISP_CLASS']     = $DISP_CLASS;
				$data['sec']            = $sec;
				$data['round']          = $round_off;
				$data['selected_stu']   = $this->input->post('stu_adm_no[]');
				$adm_no					= $this->input->post('stu_adm_no[]');
				$data['grademaster']    = $this->alam->select('grademaster', '*');
				$data['subjectData']    = $this->alam->getClassWiseSubject(1, $class, $sec);
				$data['school_setting'] = $this->alam->select('school_setting', '*');
				$data['school_photo']   = $this->alam->select('school_photo', '*');
				// $this->load->view('report_card/cbse_annual_report_card_pdf',$data);
			} else { //for cmc
				echo "CMC Work in Progress";
			}
		}
	}

	public function generatePDF_new()
	{
		$class         = $this->input->post('classs');
		$dispClassData = $this->alam->selectA('classes', 'CLASS_NM', "Class_No='$class'");
		$DISP_CLASS    = $dispClassData[0]['CLASS_NM'];
		$sec           = $this->input->post('sec');
		$round_off     = $this->input->post('round_off');
		$examModeData  = $this->alam->selectA('classes', 'ExamMode', "Class_No='$class'");
		$examMode      = $examModeData[0]['ExamMode'];
		$school_photo = $this->alam->selectA('school_photo', '*');
		$data['School_Logo'] = $school_photo[0]['School_Logo'];

		$countOptData = $this->alam->selectA('class_section_wise_subject_allocation', 'count(subject_code)cnt', "Class_No='$class' AND opt_code in (0,2) AND section_no='$sec' AND applicable_exam='1'");
		if ($class == 8 || $class == 9 || $class == 10) {
			$data['cnt_opt'] = '6';
		} else if ($class == 11) {
			$data['cnt_opt'] = '5';
		} else {
			$data['cnt_opt'] = $countOptData[0]['cnt'];
		}

		if ($class == '11' || $class == '12') { //chk for IX class and X class
			if ($examMode == 1) { //for cbse
				$data['class']          = $class;
				$data['DISP_CLASS']     = $DISP_CLASS;
				$data['sec']            = $sec;
				$data['round']          = $round_off;
				$data['selected_stu']   = $this->input->post('stu_adm_no[]');
				$adm_no 				= $this->input->post('stu_adm_no[]');
				$data['grademaster']    = $this->alam->select('grademaster', '*');
				$data['subjectData']    = $this->alam->getClassWiseSubject(1, $class, $sec);
				$data['school_setting'] = $this->alam->select('school_setting', '*');
				$data['school_photo']	= $this->alam->select('school_photo','*');
				// $this->load->view('report_card/cbse_annual_report_card_pdf_IX',$data);

				$getSubj = $this->db->query("select opt_code,subject_code,(select SubName from subjects where SubCode=class_section_wise_subject_allocation.subject_code)subjnm from class_section_wise_subject_allocation where Class_No='$class' AND section_no='$sec' AND applicable_exam='1' AND opt_code in(0,1,2) order by sorting_no")->result_array();

				$getCosco = $this->db->query("SELECT * FROM `co_scholastic`")->result_array();

				$exam = array('1', '4', '8', '2', '3', '6', '5');


				$result = array();
				foreach ($adm_no as $key => $val) {
					$getStu = $this->alam->selectA('student', 'ADM_NO,ROLL_NO,FIRST_NM,FATHER_NM,MOTHER_NM,DISP_CLASS,DISP_SEC,C_MOBILE,BIRTH_DT,JUNE_ATT,JULY_ATT', "CLASS='$class' AND SEC='$sec' AND Student_Status='ACTIVE' AND ADM_NO='$val'");

					$optsubj = $this->db->query("SELECT subcode FROM `studentsubject` where adm_no = '$val'")->row_array();

					// echo "<pre>";print_r($optsubj['subcode']);die;

					$term = array();
					foreach ($exam as $key1 => $val1) {
						$subjname = array();
						foreach ($getSubj as $key2 => $val2) {

							if($val2['opt_code'] != 2 || $val2['subject_code'] == $optsubj['subcode']){
								$getMarks = $this->alam->selectA('marks', 'M1,M2,M3', "admno='$val' AND ExamC='$val1' AND SCode='" . $val2['subject_code'] . "'");
							if ($val1 == 1 || $val1 == 8 || $val1 == 4 || $val1 == 2 || $val1 == 3 || $val1 == 6) {
								if($getMarks[0]['M2']=='AB')
								{
									$marks = 'AB';
								}
								else
								{
									$marks = round((($getMarks[0]['M3'] / $getMarks[0]['M1'])) * 5);
									$marks = is_nan($marks) ? 0 : $marks;
								}
							}  elseif ($val1 == 5) {
								if($getMarks[0]['M2']=='AB')
								{
									$marks = 'AB';
								}
								else
								{
									$marks = $getMarks[0]['M3'];
									$marks = is_nan($marks) ? 0 : $marks;
								}
								
							} else {
								$marks = round((($getMarks[0]['M3'] / $getMarks[0]['M1'])) * 5);
								$marks = is_nan($marks) ? 0 : $marks;
							}
							$subjname[$val2['subject_code']] = $val2['subjnm'];
							$term[$val1][$val2['subject_code']] = [
								'subj_code' => $val2['subject_code'],
								'subj_nm'   => $val2['subjnm'],
								'opt_code'  => $val2['opt_code'],
								'M1'        => $getMarks[0]['M1'],
								'M2'        => $marks,
								'M3'        => $marks,
								'M4'		=> $getMarks[0]['M3'],
							];
							}

							
						}
					}

					$termskill = array();
					foreach ($getCosco as $key3 => $val3) {
						$getMarksCosco = $this->alam->selectA('co_scholastic_grade', 'Grade', "adm_no='$val' AND skillcode='" . $val3['SkillID'] . "'");

						$termskill[$val3['SkillID']] = [
							'skill_code' => $val3['SkillID'],
							'skill_name' =>	 $val3['SkillNm'],
							'grade'		 => $getMarksCosco[0]['Grade'],
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
						'mob'        => $getStu[0]['C_MOBILE'],
						'dob'		 => $getStu[0]['BIRTH_DT'],
						'working_days'=>$getStu[0]['JUNE_ATT'],
						'present_days'=>$getStu[0]['JULY_ATT'],
						'subject_nm' => $subjname,
						'term'       => $term,
						'termskill'	 => $termskill,
					];
				}
				$data['result'] = $result;
				
				$this->load->view('report_card/cbse_annual_report_card_pdf_IX_X_new', $data);
			} else { //for cmc
				echo "CMC Work in Progress";
			}
		} else {
			if ($examMode == 1) { //for cbse
				$data['class']          = $class;
				$data['DISP_CLASS']     = $DISP_CLASS;
				$data['sec']            = $sec;
				$data['round']          = $round_off;
				$data['selected_stu']   = $this->input->post('stu_adm_no[]');
				$adm_no					= $this->input->post('stu_adm_no[]');
				$data['grademaster']    = $this->alam->select('grademaster', '*');
				$data['subjectData']    = $this->alam->getClassWiseSubject(1, $class, $sec);
				$data['school_setting'] = $this->alam->select('school_setting', '*');
				$data['school_photo']   = $this->alam->select('school_photo', '*');
				// $this->load->view('report_card/cbse_annual_report_card_pdf',$data);

				$getSubj = $this->db->query("select opt_code,subject_code,(select SubName from subjects where SubCode=class_section_wise_subject_allocation.subject_code)subjnm from class_section_wise_subject_allocation where Class_No='$class' AND section_no='$sec' AND applicable_exam='1' AND opt_code in(0,1) order by sorting_no")->result_array();

				$getCosco = $this->db->query("SELECT * FROM `co_scholastic`")->result_array();

				$exam1 = array('1', '4', '12', '13');
				$exam2 = array('7', '5', '16', '17');

				$result = array();
				foreach ($adm_no as $key => $val) {
					$getStu = $this->alam->selectA('student', 'ADM_NO,ROLL_NO,FIRST_NM,FATHER_NM,MOTHER_NM,DISP_CLASS,DISP_SEC,C_MOBILE,BIRTH_DT,JUNE_ATT,JULY_ATT', "CLASS='$class' AND SEC='$sec' AND Student_Status='ACTIVE' AND ADM_NO='$val'");

					$term1 = array();
					foreach ($exam1 as $key1 => $val1) {
						$subjname = array();
						foreach ($getSubj as $key2 => $val2) {

							$getMarks = $this->alam->selectA('marks', 'M1,M2,M3', "admno='$val' AND ExamC='$val1' AND SCode='" . $val2['subject_code'] . "' AND Term='TERM-1'");
							if ($val1 == 1) {
								if ($val2['subject_code'] != 106) {
									$marks = round((($getMarks[0]['M3'] / $getMarks[0]['M1'])) * 10);
									$marks = is_nan($marks) ? 0 : $marks;
								} else {
									$marks = $getMarks[0]['M3'];
									$marks = is_nan($marks) ? 0 : $marks;
								}
							} elseif ($val1 == 12 || $val1 == 13) {
								$marks = round((($getMarks[0]['M3'] / $getMarks[0]['M1'])) * 20);
								$marks = is_nan($marks) ? 0 : $marks;
							} else {
								$marks = round((($getMarks[0]['M3'] / $getMarks[0]['M1'])) * 40);
								$marks = is_nan($marks) ? 0 : $marks;
							}
							$subjname[$val2['subject_code']] = $val2['subjnm'];
							$term1[$val1][$val2['subject_code']] = [
								'subj_code' => $val2['subject_code'],
								'subj_nm'   => $val2['subjnm'],
								'opt_code'  => $val2['opt_code'],
								'M1'        => $getMarks[0]['M1'],
								'M2'        => $marks,
								'M3'        => $marks,
								'M4'		=> $getMarks[0]['M3'],
							];
						}
					}

					$term2 = array();
					foreach ($exam2 as $key1 => $val1) {
						foreach ($getSubj as $key2 => $val2) {
							$getMarks = $this->alam->selectA('marks', 'M1,M2,M3', "admno='$val' AND ExamC='$val1' AND SCode='" . $val2['subject_code'] . "' AND Term='TERM-2'");
							if ($val1 == 7) {
								if ($val2['subject_code'] != 106) {
									$marks = round((($getMarks[0]['M3'] / $getMarks[0]['M1'])) * 10);
									$marks = is_nan($marks) ? 0 : $marks;
								} else {
									$marks = $getMarks[0]['M3'];
									$marks = is_nan($marks) ? 0 : $marks;
								}
							}elseif ($val1 == 16) {
								$marks = round((($getMarks[0]['M3'] / $getMarks[0]['M1'])) * 20);
								$marks = is_nan($marks) ? 0 : $marks;
							}	
							else {
								$marks = round((($getMarks[0]['M3'] / $getMarks[0]['M1'])) * 40);

								$marks = is_nan($marks) ? 0 : $marks;
							}
							$term2[$val1][$val2['subject_code']] = [
								'subj_code' => $val2['subject_code'],
								'subj_nm'   => $val2['subjnm'],
								'opt_code'  => $val2['opt_code'],
								'M1'        => $getMarks[0]['M1'],
								'M2'        => $marks,
								'M3'        => $marks,
								'M4'		=> $getMarks[0]['M3'],
							];
						}
					}

					$term1skill = array();
					foreach ($getCosco as $key3 => $val3) {
						$getMarksCosco = $this->alam->selectA('co_scholastic_grade', 'GRADE', "adm_no='$val' AND skillcode='" . $val3['SkillID'] . "' AND Term='1'");

						$term1skill[$val3['SkillID']] = [
							'skill_code' => $val3['SkillID'],
							'skill_name' =>	 $val3['SkillNm'],
							'grade'		 => $getMarksCosco[0]['Grade'],
						];
					}

					$term2skill = array();
					foreach ($getCosco as $key3 => $val3) {
						$getMarksCosco = $this->alam->selectA('co_scholastic_grade', 'Grade', "adm_no='$val' AND skillcode='" . $val3['SkillID'] . "' AND Term='2'");
				

						$term2skill[$val3['SkillID']] = [
							'skill_code' => $val3['SkillID'],
							'skill_name' =>	 $val3['SkillNm'],
							'grade'		 => $getMarksCosco[0]['Grade'],
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
						'mob'        => $getStu[0]['C_MOBILE'],
						'dob'		 => $getStu[0]['BIRTH_DT'],
						'working_days'=>$getStu[0]['JUNE_ATT'],
						'present_days'=>$getStu[0]['JULY_ATT'],
						'subject_nm' => $subjname,
						'term1'      => $term1,
						'term2'      => $term2,
						'term1skill' => $term1skill,
						'term2skill' => $term2skill,
					];
				}
				$data['result'] = $result;
				//echo '<pre>';
				//print_r($data);die;
				$this->load->view('report_card/cbse_annual_report_card_pdf_new', $data);
			} else { //for cmc
				echo "CMC Work in Progress";
			}
		}
	}
}
