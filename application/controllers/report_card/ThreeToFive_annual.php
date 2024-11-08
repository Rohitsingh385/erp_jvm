<?php
error_reporting(0);
defined('BASEPATH') or exit('No direct script access allowed');

class ThreeToFive_annual extends MY_controller
{

	public function __construct()
	{
		parent::__construct();
		$this->loggedOut();
		$this->load->model('Alam', 'alam');
	}

	public function index()
	{
		$data['school_setting'] = $this->alam->select('school_setting', '*');
		$data['school_photo']   = $this->alam->select('school_photo', '*');
		$term = $this->input->post('term');
		$class = $this->input->post('classs');
		$sec = $this->input->post('sec');
		$round = $this->input->post('round');
		$adm_no = $this->input->post('stu_adm_no[]');

		$getSubj = $this->alam->selectA('class_section_wise_subject_allocation', "subject_code,(select SubName from subjects where SubCode=class_section_wise_subject_allocation.subject_code)subjnm", "Class_No = '$class' AND section_no = '$sec' AND applicable_exam='1' order by sorting_no");

		$getCosco = array('1','2','3','4','5');

		$result = array();
		foreach ($adm_no as $key => $val) {
			$getStu = $this->alam->selectA('student', 'ADM_NO,FIRST_NM,ROLL_NO,FATHER_NM,MOTHER_NM,C_MOBILE,DISP_CLASS,DISP_SEC,BIRTH_DT,HEIGHT,WEIGHT,JUNE_ATT,JULY_ATT', "ADM_NO='$val' AND Student_Status='ACTIVE'");

			$exam1 = array('1', '12', '4');
			$exam2 = array('1', '12', '5');

			$term1 = array();
			foreach ($exam1 as $key1 => $val1) {
				$subjname = array();
				foreach ($getSubj as $key2 => $val2) {
					
					$getMarks = $this->alam->selectA('marks', 'M1,M2,M3', "admno='$val' AND ExamC='$val1' AND SCode='" . $val2['subject_code'] . "' AND Term='TERM-1'");

					if ($round == 1) {
							$marks = round($getMarks[0]['M3'], 0);
							$marks = is_nan($marks) ? 0 : $marks;
							if ($getMarks[0]['M2'] != 'AB' && $getMarks[0]['M2'] != 'ab' && $getMarks[0]['M2'] != ''){
								$marks_m2 = round($getMarks[0]['M2'], 0);
							}else{
								$marks_m2 = $getMarks[0]['M2'];
							}
					} else {
							$marks = $getMarks[0]['M3'];
							$marks = is_nan($marks) ? 0 : $marks;						
					}

					$subjname[$val2['subject_code']] = $val2['subjnm'];
					$term1[$val1][$val2['subject_code']] = [
						'subj_code' => $val2['subject_code'],
						'subj_nm'   => $val2['subjnm'],
						'opt_code'  => $val2['opt_code'],
						'M1'        => $getMarks[0]['M1'],
						'M2'        => $marks_m2,
						'M3'        => $marks,
					];
				}
			}

			$term2 = array();
			foreach ($exam2 as $key1 => $val1) {
				foreach ($getSubj as $key2 => $val2) {
					$getMarks = $this->alam->selectA('marks', 'M1,M2,M3', "admno='$val' AND ExamC='$val1' AND SCode='" . $val2['subject_code'] . "' AND Term='TERM-2'");

					if ($round == 1) {
							$marks = round($getMarks[0]['M3'], 0);
							$marks = is_nan($marks) ? 0 : $marks;
							if ($getMarks[0]['M2'] != 'AB' && $getMarks[0]['M2'] != 'ab' && $getMarks[0]['M2'] != ''){
								$marks_m2 = round($getMarks[0]['M2'], 0);
							}else{
								$marks_m2 = $getMarks[0]['M2'];
							}
					} else {			
							$marks = $getMarks[0]['M3'];
							$marks = is_nan($marks) ? 0 : $marks;						
					}

					$subjname[$val2['subject_code']] = $val2['subjnm'];
					$term2[$val1][$val2['subject_code']] = [
						'subj_code' => $val2['subject_code'],
						'subj_nm'   => $val2['subjnm'],
						'opt_code'  => $val2['opt_code'],
						'M1'        => $getMarks[0]['M1'],
						'M2'        => $marks_m2,
						'M3'        => $marks,
					];
				}
			}

			$term1skill = array();
			foreach ($getCosco as $val3) {
				if($val3 == 3){break;}
				$getMarksCosco = $this->alam->selectA('co_scholastic_grade', 'GRADE', "adm_no='$val' AND skillcode='" . $val3 . "' AND Term='1'");
				
				$term1skill[$val3] = [
					'grade'		 => $getMarksCosco[0]['GRADE'],
				];
			}

			$term2skill = array();
			foreach ($getCosco as $val3) {
				$getMarksCosco = $this->alam->selectA('co_scholastic_grade', 'GRADE', "adm_no='$val' AND skillcode='" . $val3 . "' AND Term='2'");

				$term2skill[$val3] = [
					'grade'		 => $getMarksCosco[0]['GRADE'],
				];
			}
			
			$personalAssement = array();
			$getPersona = array('1','2','3','4','5','6');
			foreach ($getPersona as $val3) {
				$getpersonAss = $this->alam->selectA('personalityasses_grade', 'Grade', "Adm_no='$val' AND perCode='" . $val3 . "' AND Term='2'");
				//echo $this->db->last_query();die;
				$personalAssement[$val3] = [
					'grade'		 => $getpersonAss[0]['Grade'],
				];
			}

			//echo '<pre>';
			//print_r($personalAssement);die;
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
				'height'	 => $getStu[0]['HEIGHT'],
				'weight'	 => $getStu[0]['WEIGHT'],
				'working_days'=>$getStu[0]['JUNE_ATT'],
				'present_days'=>$getStu[0]['JULY_ATT'],
				'subject_nm' => $subjname,
				'term1'      => $term1,
				'term2'      => $term2,
				'term1skill' => $term1skill,
				'term2skill' => $term2skill,
				'persAssmentskill' => $personalAssement,
			];
		}

		 //echo "<pre>";
		 //print_r($result);
		 //die;
		$data['result'] = $result;
		$this->load->view('report_card/annual_report_card_cbsc_pdf_III_V', $data);
	}
}
