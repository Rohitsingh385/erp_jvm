<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bus_incharge_entry extends MY_controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Mymodel','dbcon');
	}
	public function bus_incharge(){
		$array['data'] = $this->dbcon->select('bus_incharge_master','*');
		$this->fee_template('transport_management/incharge_master/incharge_master',$array);
	}
	public function edit_busincharge($id){
		$array['data'] = $this->dbcon->select('bus_incharge_master','*',"Incharge_Id='$id'");
		$this->fee_template('transport_management/incharge_master/edit_incharge',$array);
	}
	public function insert_data(){
		$name = strtoupper($this->input->post('incharge_name'));
		$ph_no = $this->input->post('incharge_phone');
		
		$data = $this->dbcon->max_no('bus_incharge_master','Incharge_Id');
		$max_no = $data[0]->Incharge_Id + 1;
		
		$array = array(
			'Incharge_Id' => $max_no,
			'Incharge_nm' => $name,
			'Incharge_ph_no' => $ph_no
		);
		$this->dbcon->insert('bus_incharge_master',$array);
		$this->session->set_flashdata('msg',"Successfully Added");
		redirect('Bus_incharge_entry/bus_incharge');
	}
	public function incharge_update(){
		$incharge_name = strtoupper($this->input->post('incharge_name'));
		$incharge_phone = $this->input->post('incharge_phone');
		$upd_id = $this->input->post('upd_id');
		
		$update_data = array(
			'Incharge_nm' => $incharge_name,
			'Incharge_ph_no' => $incharge_phone,
		);
		if($this->dbcon->update('bus_incharge_master',$update_data,"Incharge_Id='$upd_id'")){
			$this->session->set_flashdata('msg',"Successfully Updated");
			redirect('Bus_incharge_entry/bus_incharge');
		}
		else{
			$this->session->set_flashdata('msg',"Failed Updated");
			redirect('Bus_incharge_entry/bus_incharge');
		}
		
	}
	public function validate_number(){
		$number = $this->input->post('val');
		$data = $this->dbcon->select('bus_incharge_master','Incharge_ph_no',"Incharge_ph_no='$number'");
		echo count($data);
		
		
	}
	public function checkdata(){
		$number = $this->input->post('val');
		$data = $this->dbcon->select('bus_incharge_master','Incharge_ph_no',"Incharge_ph_no='$number'");
		echo count($data);
	}
	
	public function stoppage_cat_master()
	{
		//$data['stoppage_group'] = $this->custom_lib->Stoppage_group();
		$data['StoppageGroup'] = $this->dbcon->select('stoppage_category_master', '*');
		$this->fee_template('transport_management/stoppage_master/stoppage_master', $data);
	}
	public function Select_desc()
	{
		$group = $this->input->post('val');
		$stoppage_desc = $this->custom_lib->Stoppage_dec();

		if (array_key_exists($group, $stoppage_desc)) {
			$description = $stoppage_desc[$group]['description'];
			$amount = $stoppage_desc[$group]['amount'];
			$response = array(
				'description' => $description,
				'amount' => $amount
			);
			echo json_encode($response);
		} else {
			echo '';
		}
	}

	public function save_stoppage()
	{
		$group = $this->input->post('group');
		$desc = $this->input->post('desc');
		$amt = $this->input->post('amt');
		$ins_data = array(
			'Stoppage_Group' => $group,
			'Descriptionn' => $desc,
			'Amt' => $amt
		);
		$this->dbcon->insert('stoppage_category_master', $ins_data);
		$this->session->set_flashdata('msg', "Successfully Added");
		redirect('Bus_incharge_entry/stoppage_cat_master');
	}

	public function CheckGroup()
	{
		$group = $this->input->post('val');
		$chk_data = $this->db->query("SELECT * FROM `stoppage_category_master` WHERE Stoppage_Group='$group'")->result();
		if (!empty($chk_data)) {
			echo 1;
		} else {
			echo 2;
		}
	}

	public function delete_stoppage()
	{
		$group = $this->input->post('group');
		$desc = $this->input->post('desc');
		$amt = $this->input->post('amt');
		$chk_data = $this->db->query("DELETE  FROM `stoppage_category_master` WHERE Stoppage_Group='$group'");
		if ($chk_data) {
			echo 1;
		} else {
			echo 2;
		}
	}
	public function edit_details()
	{
		$group = $this->input->post('group');
		$desc = $this->input->post('desc');
		$amt = $this->input->post('amt');
		$chk_data = $this->db->query("SELECT * FROM `stoppage_category_master` WHERE Stoppage_Group='$group'")->result();
	}
	public function edit_stoppage()
	{
		if (isset($_POST['Cancel'])) {
			redirect('Bus_incharge_entry/stoppage_cat_master');
		} else {
			$group = $this->input->post('group1');
			$desc = $this->input->post('desc1');
			$amt = $this->input->post('amt1');
			$data = $this->db->query("UPDATE stoppage_category_master SET Amt = '$amt' , Descriptionn = '$desc' WHERE stoppage_category_master.Stoppage_Group = '$group'");
			$stop_amt = array(
				'APR_FEE' => $amt,
				'MAY_FEE' => $amt,
				'JUN_FEE' => $amt,
				'JUL_FEE' => $amt,
				'AUG_FEE' => $amt,
				'SEP_FEE' => $amt,
				'OCT_FEE' => $amt,
				'NOV_FEE' => $amt,
				'DEC_FEE' => $amt,
				'JAN_FEE' => $amt,
				'FEB_FEE' => $amt,
				'MAR_FEE' => $amt,
				'AMT' => $amt,
				'StoppageGroup' => $group
			);
	
			$stoppage = array(
				'stopamt' => $amt,
				'StoppageGroup' => $group
			);
			
			
			$this->dbcon->update('stop_amt',$stop_amt,"StoppageGroup = '$group'");
			$this->dbcon->update('stoppage',$stoppage,"StoppageGroup = '$group'");
			if ($data) {
				$this->session->set_flashdata('edit', "Successfully Updated");
				redirect('Bus_incharge_entry/stoppage_cat_master');
			}
		}
	}
}