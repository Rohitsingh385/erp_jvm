<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PayrollMain extends MY_controller{
	
	public function __construct(){
		parent:: __construct();
		$this->load->model('Alam','alam');
	}
	
	public function index(){
		$this->render_template('payroll_new/index');
	}
	
	public function search(){
		$textarea = $this->input->post('textarea');
		$que = $this->db->query($textarea)->result_array();
		echo "<pre>";
		print_r($que);
	}
}