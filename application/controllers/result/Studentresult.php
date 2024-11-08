<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Studentresult extends MY_Controller{
	public function __construct(){
		parent:: __construct();
		//$this->loggedOut();
	    $this->load->model('Mymodel','dbcon');
		$this->load->model('Alam','alam');
			 
	}
	public function index()
	{

	$adm=$this->session->userdata['adm'];

	//$data['stu_details']=$this->srm->get_student_details($adm);
	
	//$this->Parent_templete('parents_dashboard/result/studentresult_view',$data);

			$adm=str_replace("-","/",$adm);
		$ddt=$this->alam->selectA("student",'ADM_NO,FIRST_NM,MIDDLE_NM,TITLE_NM,FATHER_NM,MOTHER_NM,ROLL_NO,CLASS,SEC,DISP_CLASS,DISP_SEC',"ADM_NO='$adm'");
		$class=$ddt[0]['CLASS'];
		$SEC=$ddt[0]['SEC'];
		$studentsub=$this->alam->selectA("marks","M2,(select SubName from subjects where SubCode=marks.SCode)SubName","admno='$adm' AND Classes='$class' AND Sec='$SEC' AND ExamC='1' and Term='TERM-1' order by SCode asc");
		$data=array('studata'=>$ddt,'subject'=>$studentsub);
		
		$this->load->view('parents_dashboard/PT1_202122',$data);


	}

}	 