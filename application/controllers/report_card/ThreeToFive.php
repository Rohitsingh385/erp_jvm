<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ThreeToFive extends MY_controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Alam','alam');
	}
	
	public function index(){
		$data['school_setting'] = $this->alam->select('school_setting','*');
		$data['school_photo']   = $this->alam->select('school_photo','*');
		$term = $this->input->post('term');
		$class = $this->input->post('classs');
		$sec = $this->input->post('sec');
		$round = $this->input->post('round');
		$adm_no = $this->input->post('stu_adm_no[]');
		
		$getSubj = $this->alam->selectA('class_section_wise_subject_allocation',"subject_code,(select SubName from subjects where SubCode=class_section_wise_subject_allocation.subject_code)subjnm","Class_No = '$class' AND section_no = '$sec' AND applicable_exam='1' order by sorting_no");
		
		$result = array();
		foreach($adm_no as $key => $val){
			$getStuDet=$this->alam->selectA('student','ADM_NO,FIRST_NM,ROLL_NO,FATHER_NM,MOTHER_NM,C_MOBILE,DISP_CLASS,DISP_SEC',"ADM_NO='$val' AND Student_Status='ACTIVE'");
			$subjdet = array();
			$tot = 0;
			foreach($getSubj as $key1 => $val1){
				$getMarks = $this->alam->selectA('marks','M1,M2,M3',"admno='$val' AND ExamC='4' AND SCode='".$val1['subject_code']."'");
				$M1 = !empty($getMarks[0]['M1'])?$getMarks[0]['M1']:0;
				$M2 = !empty($getMarks[0]['M2'])?$getMarks[0]['M2']:0;
				$M3 = !empty($getMarks[0]['M3'])?($round == 1)?round($getMarks[0]['M3']):number_format($getMarks[0]['M3'],2):0;
				if($val1['subject_code'] != 8){
					$tot += $M3;
				}
				$per = ($M3*100)/$M1;
				if($per >= '91' AND $per <= '100'){
					$grade =  "A+";
				}else if($per >= '75' AND $per <= '90'){
					$grade = "A";
				}else if($per >= '56' AND $per <= '74'){
					$grade = "B";
				}else if($per >= '35' AND $per <= '55'){
					$grade = "C";
				}else if($per <= '35'){
					$grade = "D";
				}
				
				$subjdet[$val1['subject_code']] = [
					'subjnm' => $val1['subjnm'],
					'M1' => $M1,
					'M2' => $M2,
					'M3' => $M3,
					'grade' => $grade
				];
			}
			$result[] = [
				'admno' => $getStuDet[0]['ADM_NO'],
				'name'  => $getStuDet[0]['FIRST_NM'],
				'mname' => $getStuDet[0]['MOTHER_NM'],
				'fname' => $getStuDet[0]['FATHER_NM'],
				'roll'  => $getStuDet[0]['ROLL_NO'],
				'class' => $getStuDet[0]['DISP_CLASS'],
				'sec'   => $getStuDet[0]['DISP_SEC'],
				'mob'   => $getStuDet[0]['C_MOBILE'],
				'subj'  => $subjdet,
				'tot'   => ($round==1)?round($tot):number_format($tot,2)
			];
		}
		
		// echo "<pre>";
		// print_r($result);
		// die;
		$data['result'] = $result;
		$this->load->view('report_card/report_card_cbsc_pdf_III_V',$data);
	}
}