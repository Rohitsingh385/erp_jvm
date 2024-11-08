<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sqtmaster extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->loggedOut();
	}
	public function index()
	{
		
		$data['sqt_details'] = $this->sumit->fetchAllData('*','qtr_master',array());
        
		$this->render_template('payroll_master/viewQTR_master',$data);

	}


    public function updateSQT()
	{
		
		$column_name = $this->input->post('column_name');
		$emp_id = $this->input->post('emp_id');
		$cell_value = $this->input->post('cell_value');
        

		// $checkExist = $this->sumit->checkData('*','qtr_master',"EMPLOYEE_ID='$emp_id'");
		$data = array(
			'ID'=> $emp_id,
			$column_name => $cell_value,
		);
        $this->sumit->update('qtr_master',$data,"ID='$emp_id'");
		
		echo json_encode(1);
	}

    public function add()
    {
        $sqtft = $this->input->post('sqtft');
		$rent = $this->input->post('rent');
		$sec = $this->input->post('sec');
		$garage = $this->input->post('garage');

        // $checkExist = $this->sumit->checkData('*','qtr_master',"EMPLOYEE_ID='$emp_id'");
		$data = array(
			'SQFT' => $sqtft,
			'RENT' => $rent,
			'SECURITY' => $sec,
			'GARAGE' => $garage,
		);

        $this->sumit->insert('qtr_master',$data);
        redirect('payroll/master/Sqtmaster'); 
    }
}
