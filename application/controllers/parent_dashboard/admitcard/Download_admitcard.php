<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Download_admitcard extends MY_controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('Mymodel','dbcon');

	}
	public function index() {
		
	$class_code=$this->session->userdata('class_code');
	$sec_code=$this->session->userdata('sec_code');
	$adm=$this->session->userdata('adm');

	$class_nm=$this->dbcon->get_class_name($class_code);
	$sec_nm=$this->dbcon->get_sec_name($sec_code);

	$class_sec=$class_nm.'-'.$sec_nm;
	$data['status']=$this->dbcon->get_student_status($adm,$class_sec);

	// echo '<pre>';
	// print_r($data['status']);
	// die();
		//echo $class_nm;
		//die;
		if($class_nm='VI' || $class_nm='VII' || $class_nm='VIII' || $class_nm='IX' || $class_nm='X')
		{
			$this->Parent_templete('parents_dashboard/admitcard/download_admitcard_view_VI_X',$data);
		}
		else
		{
			$this->Parent_templete('parents_dashboard/admitcard/download_admitcard_view',$data);
		}
		
	
		
    }   
    function download_pdf(){

 //    $class_code=$this->input->post('class_code');
	// $sec_code=$this->input->post('sec_code');
	// $adm=$this->input->post('adm');

	// $class_nm=$this->dbcon->get_class_name($class_code);
	// $sec_nm=$this->dbcon->get_sec_name($sec_code);

	// $class_sec=$class_nm.'-'.$sec_nm;
	// $data['status']=$this->dbcon->get_student_status($adm,$class_sec);
	// $this->load->view('parents_dashboard/admitcard/download_admitcard_pdf',$data);
	
	// $html = $this->output->get_output();
	// $this->load->library('pdf');
	// $this->dompdf->loadHtml($html);
	// $this->dompdf->setPaper('A4', 'portrait');
	// $this->dompdf->render();
	// $this->dompdf->stream("Admit_card.pdf", array("Attachment"=>1));
	
	$adm = $this->input->post('adm');
	$data = $this->dbcon->icard($adm);	
	$school_setting = $this->dbcon->select('school_setting','*');
	$admit_card=$this->dbcon->get_admit_card($adm );
		


		$array = array(
			'data' => $data,
			'school_setting' => $school_setting,
			'date' => 'FIRST TERMINAL EXAMINATION',
			'admit_card'=>$admit_card
			
		);

		$this->load->view('parents_dashboard/admitcard/download_admitcard_pdf',$array);
	
	$html = $this->output->get_output();
	$this->load->library('pdf');
	$this->dompdf->loadHtml($html);
	$this->dompdf->setPaper('A4', 'portrait');
	$this->dompdf->render();
	$this->dompdf->stream("Admit_card.pdf", array("Attachment"=>1));
		


    }
	
	
	 function download_pdf_VI_X(){

	$adm = $this->input->post('adm');
	$data = $this->dbcon->icard($adm);	
	$school_setting = $this->dbcon->select('school_setting','*');
	$admit_card=$this->dbcon->get_admit_card($adm );
		


		$array = array(
			'data' => $data,
			'school_setting' => $school_setting,
			'date' => 'FIRST TERMINAL EXAMINATION',
			'admit_card'=>$admit_card
			
		);

		$this->load->view('parents_dashboard/admitcard/download_admitcard_pdf_VI_X',$array);
	
	$html = $this->output->get_output();
	$this->load->library('pdf');
	$this->dompdf->loadHtml($html);
	$this->dompdf->setPaper('A4', 'portrait');
	$this->dompdf->render();
	$this->dompdf->stream("Admit_card.pdf", array("Attachment"=>1));
		


    }

}
 
