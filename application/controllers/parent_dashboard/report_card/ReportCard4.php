<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReportCard4 extends MY_controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('Alam','alam');
		if(empty($this->session->userdata('adm'))){
			redirect('parentlogin');
		}
	}

	public function index(){
		$admno                  = $this->session->userdata('adm'); 
		$class                  = $this->session->userdata('class_code');
		$sec                    = $this->session->userdata('sec_code');
		
		$getPrevClass =$this->alam->selectA('student','prev_temp_class',"ADM_NO='$admno'");
		$table = $getPrevClass[0]['prev_temp_class'];
					
		$data['signature']      = $this->alam->selectA('signature','*');
		$data['school_setting'] = $this->alam->select('school_setting','*');
		$data['school_photo']   = $this->alam->select('school_photo','*');
		$data['color']          = $this->custom_lib->reportCardGardeColorOneTofive();
		$data['stuData']        = $this->alam->selectA($table,'*',"REGNO='$admno'");
		// echo "<pre>";
		// print_r($data['stuData']);die;
		
		$this->load->view('parents_dashboard/report_card/report_card4',$data);
		
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'potrait');
		$this->dompdf->render();
		$this->dompdf->stream("report_card.pdf", array("Attachment"=>0));
	}
}