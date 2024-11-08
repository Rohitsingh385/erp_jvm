<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ward_report extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->loggedOut();
		$this->load->model('Mymodel', 'dbcon');
	}

	public function ward_report_emp()
	{
		$eward = $this->dbcon->select('eward', '*');
		//$sec = $this->dbcon->select('sections','*');
		$sec = $this->dbcon->select('student', 'DISP_SEC as SECTION_NAME,(select section_no from sections where SECTION_NAME=student.DISP_SEC)section_no', "1='1' group by DISP_SEC");
		$array = array(
			'eward' => $eward,
			'sec' => $sec
		);
		$this->fee_template('ward_report/ward_report_emp', $array);
		// $this->load->view('ward_report/ward_report_emp', $array);
	}



	public function find_details_sw()
	{
		$eward = $this->input->post('eward');
		$session = $this->input->post('sesion');
		
			$student = $this->dbcon->select('student', '*', "EMP_WARD='$eward' AND Student_Status='ACTIVE' and disp_class not like '%PASS%' and disp_sec<>'Z'  and disp_sec<>'TC'  and disp_sec<>'LT' and ADM_NO LIKE '%$session%' order by class,sec");
		

		$array = array(
			'student' => $student
		);
		$this->load->view('ward_report/show_awad_data_table_sw', $array);
	}

	public function pdf_sw($eward)
	{
		
		$eward = $this->uri->segment(3);

		$ward = substr($eward, 0, 1);
		$session = substr($eward, 1); 
		//ini_set('max_execution_time', 0);
		//ini_set('memory_limit', -1);
		//$student = $this->dbcon->select('student', '*', "EMP_WARD='$eward' AND Student_Status='ACTIVE'and disp_class not like '%PASS%' and disp_sec<>'Z'  and disp_sec<>'TC'  and disp_sec<>'LT' order by class,sec");
		$student = $this->dbcon->select('student', '*', "EMP_WARD='$ward' AND Student_Status='ACTIVE' and disp_class not like '%PASS%' and disp_sec<>'Z'  and disp_sec<>'TC'  and disp_sec<>'LT' and ADM_NO LIKE '%$session%' order by class,sec");

		$school_setting = $this->dbcon->select('school_setting', '*');
		$array = array(
			'student' => $student,
			'school_setting' => $school_setting,

		);
		$this->load->view('ward_report/show_awad_data_table_pdf_sw', $array);

		//$html = $this->output->get_output();
		//$this->load->library('pdf');
		//$this->dompdf->loadHtml($html);
		//$this->dompdf->setPaper('A4', 'landscape');
		//$this->dompdf->render();
		//$this->dompdf->stream("report_card.pdf", array("Attachment"=>0));

	}
}
