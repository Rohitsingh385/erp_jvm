<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Admit_card extends MY_Controller{
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Mymodel','dbcon');
	}
	public function show_other_report(){
		$this->fee_template('admit_card/show_report');
	}
	public function show_other_report2(){
		$class = $this->dbcon->select('classes','*');
		$sec = $this->dbcon->select('sections','*');
		$array = array(
			'class' => $class,
			'sec' => $sec
		); 
		$this->fee_template('admit_card/other_report_view',$array);
		/* $this->load->view('card/admit');
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'portrait');
		$this->dompdf->render();
		$this->dompdf->stream("report_card.pdf", array("Attachment"=>0)); */
	}
	public function find_details(){
		$class_name = $this->input->post('class_name');
		$sec_name = $this->input->post('sec_name');
		$short_by = $this->input->post('short_by');
		$student = $this->dbcon->select('student','ADM_NO,FIRST_NM,ROLL_NO',"CLASS='$class_name' AND SEC='$sec_name' AND Student_Status='ACTIVE' ORDER BY $short_by");
		$array = array(
			'student' => $student
		);
		$this->load->view('admit_card/data_table',$array);
		
	}
	public function report_generation(){
		$adm = $this->input->post('adm_no[]');
		$date = $this->input->post('date');
		foreach($adm as $adm_key){
			$data[] = $this->dbcon->icard($adm_key);
		}
		$school_setting = $this->dbcon->select('school_setting','*');
		$array = array(
			'data' => $data,
			'school_setting' => $school_setting,
			'date' => $date
		);
		$this->load->view('admit_card/admit',$array);
		
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'portrait');
		$this->dompdf->render();
		$this->dompdf->stream("Admit_card.pdf", array("Attachment"=>0));
	}


//admit card status starts
	function show_student_status() 
	{
		$class = $this->dbcon->select('classes','*');
		$sec = $this->dbcon->select('sections','*');
		$array = array(
			'class' => $class,
			'sec' => $sec
		);  
		
		$this->fee_template('admit_card/admitcard_status',$array);
	}


	public function find_details_admitcard_status()
	{
		$class_name = $this->input->post('class_name');
		$sec_name = $this->input->post('sec_name');
		$short_by = $this->input->post('short_by');
		$student = $this->dbcon->select('student','ADM_NO,FIRST_NM,ROLL_NO',"CLASS='$class_name' AND SEC='$sec_name' AND Student_Status='ACTIVE' ORDER BY Roll_No");
		$array = array(
			'student' => $student,
			'class' => $class_name,
			'sec' => $sec_name
		);
		$chk=$this->dbcon->check_class_section_status($class_name,$sec_name);
		if(!empty($chk))
		{
			$class_nm=$this->dbcon->get_class_name($class_name);
			$sec_nm=$this->dbcon->get_sec_name($sec_name);
			$data['stu_list']=$this->dbcon->get_student_details($class_nm,$sec_nm);
			

			$this->load->view('admit_card/admitcard_status_data_table_view',$data);
		}else{
			$this->load->view('admit_card/admitcard_status_data_table',$array);
		}
		
		 
	}

	function save_admitcard_status()
	{
		$adm_no=$this->input->post('hadm_mo');
		$status=$this->input->post('selstatus');

		$data['classno']=$classes=$this->input->post('class_name');
		$data['sec']=$sec=$this->input->post('sec_name');
		$data['status']='1';
		$data['created_by']=$this->session->userdata('user_id');
		$data['created_dt']=date("Y-m-d H:i:s");
		
		
		$this->db->trans_start();
		$this->dbcon->admit_card_entrystatus_tbl($data);


		$cnt=count($adm_no);
		$i=0;
		while($i<$cnt)
		{

			$p=$this->dbcon->update_student($adm_no[$i],$status[$i]);
			$i++;
		}
		$this->db->trans_complete();
		
		if ($this->db->trans_status() === FALSE)
		{
			$this->session->set_flashdata('error', 'Record Not Saved Sucessfully');
			redirect('admit_card/show_student_status',refresh);
		} 
		else
		{

			$this->session->set_flashdata('success', 'Record Saved Sucessfully');
			redirect('admit_card/show_student_status',refresh);

		}

	}

	function modify_student_status(){

		$AdmNo=$this->input->post('Admno');
		$this->db->trans_start();
		$p=$this->dbcon->update_student($AdmNo,$status='1');
		$this->db->trans_complete();
		
		if ($this->db->trans_status() === FALSE)
		{
			$this->session->set_flashdata('error', 'Record Not Saved Sucessfully');
			redirect('admit_card/show_student_status',refresh);
		} 
		else
		{

			$this->session->set_flashdata('success', 'Record Modified Sucessfully');
			redirect('admit_card/show_student_status',refresh);

		}
	}
} 