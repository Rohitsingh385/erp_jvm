<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Arrear_bulk extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->loggedOut();
		$this->load->model("Alam", "alam");
	}
	public function index()
	{

		if (!in_array('editDeductionBulk', permission_data)) {
			redirect('payroll/dashboard/dashboard');
		}

		$current_session = $this->sumit->fetchSingleData('Session_Nm', 'session_master', array('Active_Status' => 1));
		$active_month = $this->sumit->fetchSingleData('*', 'month_master', array('active_month' => 1));
		$session_year = explode('-', $current_session['Session_Nm']);
		$current_year = $session_year[0];

		if ($active_month['month_code'] < 4) {
			$current_year = $session_year[1];
		}

		$total_days = cal_days_in_month(CAL_GREGORIAN, $active_month['month_code'], $current_year);

		// $prev_month_year = $current_year;
		// $prev_month = $active_month['month_code'] - 1;
		// if ($active_month['month_code'] == 1) {
		// 	$prev_month_year = $current_year - 1;
		// 	$prev_month = 12;
		// }

		$data['current_year'] = $current_year;
		$data['current_month'] = $active_month['month_code'];
		$data['total_days'] = $total_days;
		$data['month_year'] = '00-0000';
		if (isset($_POST['month_year'])) {
			$data['month_year'] = $this->input->post('month_year');
			$time = strtotime($_POST['month_year']);
			$month = date("m", $time);
			$year = date("Y", $time);
			$data['employeeList'] = $this->alam->selectA('pay_control_arrear', '*,(select CONCAT_WS(" ",EMP_FNAME,EMP_MNAME,EMP_LNAME) AS EMP_FNAME from employee where ID=pay_control_arrear.EMPLOYEE_ID)EMP_NAME', "month='$month' AND year='$year'");
			if (sizeof($data['employeeList']) == 0) {
				$allup = $this->alam->selectA('pay_control', '*');
				foreach ($allup as $kky) {
					$EMPLOYEE_ID = $kky['EMPLOYEE_ID'];
					$EMPID = $kky['EMPID'];
					$datains = array(
						'EMPLOYEE_ID' => $EMPLOYEE_ID,
						'EMPID' => $EMPID,
						'month' => $month,
						'year' => $year
					);
					$this->alam->insert('pay_control_arrear', $datains);
				}
				//$data['employeeList'] = $this->alam->selectA('pay_control_arrear', '*,(select EMP_FNAME from employee where EMPID=pay_control_arrear.EMPID)EMP_NAME', "month='$month' AND year='$year'");
			}
		} else {
			$data['employeeList'] = array();
		}

		$this->render_template('bulk_updation/arrear_bulk', $data);
	}

	public function updateDeduction()
	{
		$column_name = $this->input->post('column_name');
		$emp_id = $this->input->post('emp_id');
		$cell_value = $this->input->post('cell_value');

		$checkExist = $this->sumit->checkData('*', 'pay_control', "ID='$emp_id'");
		$data = array(
			'ID' => $emp_id,
			$column_name => $cell_value,
		);
		if ($checkExist == true) {
			$this->sumit->update('pay_control', $data, "ID='$emp_id'");
		} else {
			$this->sumit->createData('pay_control', $data);
		}
		echo json_encode(1);
	}
	public function updateDeduction_both()
	{
		$column_name = $this->input->post('column_name');
		$emp_id = $this->input->post('emp_id');
		$cell_value = $this->input->post('cell_value');
		$month_year = $this->input->post('month_year');
		$time = strtotime($month_year);
		$month = date("m", $time);
		$year = date("Y", $time);
		$checkExist = $this->sumit->checkData('*', 'pay_control', "EMPLOYEE_ID='$emp_id'");
		$checkExist_arr = $this->sumit->checkData('*', 'pay_control_arrear', "EMPLOYEE_ID='$emp_id'  AND month='$month' AND year='$year' ");
		$data = array(
			$column_name => $cell_value,
		);

		if ($checkExist == true) {
			$this->sumit->update('pay_control', $data, "EMPLOYEE_ID='$emp_id'");
		}

		if ($checkExist_arr == true) {
			$this->sumit->update('pay_control_arrear', $data, "EMPLOYEE_ID='$emp_id' AND month='$month' AND year='$year'");
		}

		echo json_encode(1);
	}
}
