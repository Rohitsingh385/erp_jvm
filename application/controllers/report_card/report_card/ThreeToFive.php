<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ThreeToFive extends MY_controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Alam','alam');
	}
	
	public function index(){
		
		$term = $this->input->post('term');
		$classs = $this->input->post('classs');
		$sec = $this->input->post('sec');
		$adm_no = $this->input->post('stu_adm_no[]');
		
		$getStuDet=$this->alam->selectA('student','ADM_NO,FIRST_NM,TITLE_NM,ROLL_NO',"CLASS='$classes' AND SEC='$sec' AND Student_Status='ACTIVE'");
		
		$getSubj = $this->alam->selectA('class_section_wise_subject_allocation',"distinct(subject_code),subject_code,(select SubName from subjects where SubCode=class_section_wise_subject_allocation.subject_code)subjnm","Class_No = '$class' AND section_no = '$sec' AND opt_code in (0,1)");
		
		foreach($adm_no as $key => $val){
			echo "<pre>";
			print_r($val)
		}
	}
}