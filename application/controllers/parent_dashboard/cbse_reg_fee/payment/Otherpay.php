<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Otherpay extends My_controller{
		public function __construct(){
		parent:: __construct();
		$this->load->model('Alam','alam');
		$this->load->model('Mymodel','dbcon');
	}
	
	public function index(){
		 $this->Parent_templete('parents_dashboard/Cbse_Reg/otherpay');
	}
	public function other_pay_xi(){
		$adm = $this->session->userdata('adm_no');
		$userdata['user_data']=$this->alam->selectA('class_xi_reg','Sname,TokenNo,AdmNo',"AdmNo='$adm'");
		$this->load->view('parents_dashboard/Cbse_Reg/otherpay_xi',$userdata);
		
	}
	
	public function savemode(){
		$p_mode = $this->input->post('p_mode');
		$tr_id = $this->input->post('tr_id');
		$t_date = date('y-m-d',strtotime($this->input->post('t_date')));
		$adm = $this->session->userdata('adm');
		
		$save = array(
				'admno' => $adm,
				'pay_mode' => $p_mode,
				'trns_id' => $tr_id,
				'trans_date' => $t_date
		);
		
		$aar=$this->alam->selectA('class_ix_other_payment','id',"admno='$adm'");
		if(sizeof($aar)==0){
		$this->alam->insert('class_ix_other_payment',$save);
		$this->session->set_flashdata('msg',"<div class='alert alert-success'><strong>Success!</strong> Save Successfully..! </div>");
		redirect('parent_dashboard/Cbse_Reg/payment/Otherpay');
		}else{
		$this->session->set_flashdata('msg',"<div class='alert alert-danger'>
  <strong>Sorry!</strong> You have allready submited your Details
</div>");
		redirect('parent_dashboard/Cbse_Reg/payment/Otherpay');
		}
	}
	
	
		public function savemode_xi(){
		$p_mode = $this->input->post('p_mode');
		$tr_id = $this->input->post('tr_id');
		$t_date = date('y-m-d',strtotime($this->input->post('t_date')));
		$adm = $this->session->userdata('adm_no');
		$save = array(
				'admno' => $adm,
				'pay_mode' => $p_mode,
				'trns_id' => $tr_id,
				'trans_date' => $t_date
		);
		
		$aar=$this->alam->selectA('class_xi_other_payment','id',"admno='$adm'");
		if(sizeof($aar)==0){
		$this->alam->insert('class_xi_other_payment',$save);
		$this->session->set_flashdata('msg',"<div class='alert alert-success'><strong>Success!</strong> Save Successfully..! </div>");
		redirect('parent_dashboard/Cbse_Reg/payment/otherpay/other_pay_xi');
		}else{
		$this->session->set_flashdata('msg',"<div class='alert alert-danger'>
  <strong>Sorry!</strong> You have allready submited your Details
</div>");
		redirect('parent_dashboard/Cbse_Reg/payment/otherpay/other_pay_xi');
		}
	}
	
	
}