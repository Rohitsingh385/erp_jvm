<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LeaveDetails extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->loggedOut();
	}
	
	public function index(){
		if(isset($_POST['search'])){
			$employeetype = $this->input->post('employeetype');
			$data['employeeList'] = $this->sumit->fetchAllData('*,(select DESIG from desig where Sno=employee.DESIG)DESIG','employee',array('STATUS'=>1,'STAFF_TYPE'=>$employeetype));
		}
		$data['employeeType'] = $this->custom_lib->getStaffType();
		$this->render_template('bulk_updation/leaveDetails',$data);
	}

	public function updateLeave(){
		$column_name = $this->input->post('column_name');
		$emp_id = $this->input->post('emp_id');
		$cell_value = $this->input->post('cell_value');
		$update = $this->sumit->update('employee',array($column_name=>$cell_value),array('id'=>$emp_id));
		echo json_encode($update);
	}
}
