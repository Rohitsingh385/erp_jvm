<?php
class Myattendance extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->loggedOut();
	}

	public function index()
	{
		$month = date('m'); //09
		$year = date('Y');  //2023

		if (isset($_POST['search'])) {
			$month_year = $this->input->post('month'); //Aug-2023
			$month = date('m', strtotime($month_year)); //08
			$year = date('Y', strtotime($month_year)); //2023
		}


		$user_id = login_details['user_id']; //EMP0290
		$employee_details = $this->sumit->fetchSingleData('*', 'employee', array('EMPID' => $user_id));

		$total_days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year); //31
		$result = array();

		for ($i = 1; $i <= $total_days_in_month; $i++) {

			$date = date('Y-m-d', strtotime($year . '-' . $month . '-' . $i)); //for 1st iteration 2023-09-01

			if (strtotime(date('Y-m-d')) >= strtotime($date)) {
				$getAttendance = $this->attendance->getMyAttendance_new($employee_details['id']);
				$daily_emp_atten = $this->attendance->daily_Attendance_new($employee_details['EMPID'], $date);
				$result[$i] = array(
					'date' => $date,
					'attendance' => $getAttendance,
					'daily_emp_atten' => $daily_emp_atten
				);
			}
		}

		$data['shortLeaveTypeList'] = $this->custom_lib->shortLeaveRequestType();
		$data['result'] = $result;
		// echo '<pre>';
		// print_r($result);
		// die;
		$data['user_id'] = $user_id;
		$data['leaveReasonList'] = $this->custom_lib->getLeaveReason();
		$data['employee_details'] = $employee_details;
		$this->render_template('principal_dashboard/myAttendance', $data);
	}
	
	
	public function attendance_outtime()
	{
		$month = date('m'); //09
		$year = date('Y');  //2023

		if (isset($_POST['search'])) {
			$month_year = $this->input->post('month'); //Aug-2023
			$month = date('m', strtotime($month_year)); //08
			$year = date('Y', strtotime($month_year)); //2023
		}


		$user_id = login_details['user_id']; //EMP0290
		$employee_details = $this->sumit->fetchSingleData('*', 'employee', array('EMPID' => $user_id));

		$total_days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year); //31
		$result = array();
		for ($i = 1; $i <= $total_days_in_month; $i++) {

			$date = date('Y-m-d', strtotime($year . '-' . $month . '-' . $i)); //for 1st iteration 2023-09-01
			if (strtotime(date('Y-m-d')) >= strtotime($date)) {
				$getAttendance = $this->attendance->getMyAttendance_new($employee_details['id']);
				$daily_emp_atten = $this->attendance->daily_Attendance_new($employee_details['EMPID'], $date);
				$result[$i] = array(
					'date' => $date,
					'attendance' => $getAttendance,
					'daily_emp_atten' => $daily_emp_atten
				);
			}
		}

		$data['shortLeaveTypeList'] = $this->custom_lib->shortLeaveRequestType();
		$data['result'] = $result;
		// echo '<pre>';
		// print_r($result);
		// die;
		$data['user_id'] = $user_id;
		$data['leaveReasonList'] = $this->custom_lib->getLeaveReason();
		$data['employee_details'] = $employee_details;
		$this->render_template('principal_dashboard/myAttendance_out_time', $data);
		// $this->load->view('principal_dashboard/myAttendance_out_time', $data);
	}

	public function indexx()
	{
		$month = date('m'); //08
		$year = date('Y');  //2023

		if (isset($_POST['search'])) {
			$month_year = $this->input->post('month'); //Aug-2023
			$month = date('m', strtotime($month_year)); //08
			$year = date('Y', strtotime($month_year)); //2023
		}


		$user_id = login_details['user_id']; //EMP0290
		$employee_details = $this->sumit->fetchSingleData('*', 'employee', array('EMPID' => $user_id));

		$total_days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year); //31
		$result = array();

		for ($i = 1; $i <= $total_days_in_month; $i++) {

			$date = date('Y-m-d', strtotime($year . '-' . $month . '-' . $i)); //for 1st iteration 2023-08-0

			if (strtotime(date('Y-m-d')) >= strtotime($date)) {
				// $getAttendance = $this->attendance->getMyAttendance($date,$employee_details['id']);
				$getAttendance = $this->attendance->getMyAttendance_new($employee_details['id']);
				$result[$i] = array(
					'date' => $date,
					'attendance' => $getAttendance
				);
			}
		}

		foreach ($result as $key => $value) {
			$date = date('Y-m-d', strtotime($year . '-' . $month . '-' . $key));

			$attendance = $this->attendance->getMyAttendance_new($employee_details['id']);
			$daily_attendance = $this->attendance->getDailyAttendance($user_id, $date);

			if ($daily_attendance) {
				$result[$key] = array(
					'date' => $date,
					'attendance' => $daily_attendance
				);
			} else {
				$result[$key] = array(
					'date' => $date,
					'attendance' => $attendance
				);
			}
		}

		// echo '<pre>';
		// print_r($result);
		// die;

		$data['attendance_status_by_date'] = $attendance_status_by_date;
		$data['shortLeaveTypeList'] = $this->custom_lib->shortLeaveRequestType();
		$data['result'] = $result;
		$data['user_id'] = $user_id;
		$data['leaveReasonList'] = $this->custom_lib->getLeaveReason();
		$data['employee_details'] = $employee_details;
		$this->render_template('principal_dashboard/myAttendance', $data);
	}

	public function save_()
	{
		if ($this->input->is_ajax_request()) {

			$dates = $this->input->post('dates');
			$user_id = $this->input->post('user_id');
			$inTimes = $this->input->post('in_times');
			$outTimes = $this->input->post('out_times');
			$attendanceStatuses = $this->input->post('attendance_statuses');
			$newDateFormat = date('Y-m-d', strtotime($dates));

			$wing_master = $this->db->query("SELECT WING_MASTER_ID ,ROLE_ID,DESIG,SHIFT FROM employee WHERE EMPID='$user_id'")->result();
			$wing = $wing_master[0]->WING_MASTER_ID;
			$role_id = $wing_master[0]->ROLE_ID;
			$desig_id = $wing_master[0]->DESIG;
			$shift_id = $wing_master[0]->SHIFT;


			$check_data = $this->db->query("SELECT * FROM daily_emp_att WHERE EMPID='$user_id' AND DATE='$newDateFormat'")->result();
		

			if (!empty($check_data)) {
				$update = $this->db->query("UPDATE daily_emp_att SET ATT_STATUS='$attendanceStatuses' , wing_id='$wing' , role_id='$role_id' , desig_id='$desig_id' ,shift_id='$shift_id' WHERE EMPID='$user_id' AND DATE='$newDateFormat'");
			} else {

				$inserted = $this->db->query("INSERT INTO `daily_emp_att` (`EMPID`,`IN_TIME`,`OUT_TIME`,`DATE`,`ATT_STATUS`,`wing_id`,`role_id`,`desig_id`,`Approve_by_Sec_Ic`,`Approve_by_principal`,`Approve_by_hr`,`shift_id`) 
																	VALUES ('$user_id','$inTimes','$outTimes','$newDateFormat','$attendanceStatuses','$wing','$role_id','$desig_id','','','','$shift_id')");
				
			}

			

			if ($inserted || $update) {
				$response['msg'] = 1;
			} else {
				$response['msg'] = 0;
			}

			// Send the response back to the JavaScript
			echo json_encode($response);
		}
	}

	public function save_edited_values()
	{
		if ($this->input->is_ajax_request()) {
			$date = $this->input->post('date');
			$value = $this->input->post('value');
			$user_id = login_details['user_id'];
			$newDateFormat = date('Y-m-d');
			$vl = substr($value, 0, 2);

			if ($vl == '08' || $vl == '8') {
				$update = $this->db->query("UPDATE daily_emp_att SET IN_TIME='$value' WHERE EMPID='$user_id' AND DATE='$newDateFormat'");
			}
			if ($vl == '14') {
				$update = $this->db->query("UPDATE daily_emp_att SET OUT_TIME='$value' WHERE EMPID='$user_id' AND DATE='$newDateFormat'");
			}

			if ($update) {

				echo "Success";
			}
		}
	}

public function updateATT()
	{
		// echo '<pre>';print_r($_POST);die;
		$emp_id = $this->input->post('emp_id');
		$dt = $this->input->post('dt');
		$newDateFormat = date('Y-m-d', strtotime($dt));
		$column_name = $this->input->post('column_name');
		$cell_value = $this->input->post('cell_value');

		if ($column_name == 'IN_TIME') {
			$att_status = 'IN_TIME_ATT';
		} else {
			$att_status = 'OUT_TIME_ATT';
		}
		$wing_master = $this->db->query("SELECT WING_MASTER_ID ,ROLE_ID,DESIG,SHIFT FROM employee WHERE EMPID='$emp_id'")->result();
		$wing = $wing_master[0]->WING_MASTER_ID;
		$role_id = $wing_master[0]->ROLE_ID;
		$desig_id = $wing_master[0]->DESIG;
		$shift_id = $wing_master[0]->SHIFT;

		$checkExist = $this->sumit->checkData('*', 'daily_emp_att', "EMPID='$emp_id' AND DATE='$newDateFormat'");
		// print_r($checkExist);die;
		$data = array(
			$column_name => $cell_value,
			"EMPID" => $emp_id,
			"date"  => $newDateFormat,
			"wing_id" => $wing,
			"role_id" => $role_id,
			"desig_id" => $desig_id,
			"shift_id" => $shift_id,
			$att_status => 'P'
		);

		if ($checkExist == '1') {
			$this->sumit->update('daily_emp_att', $data, "EMPID='$emp_id' and DATE='$newDateFormat'");
		} else {
			$this->sumit->createData('daily_emp_att', $data);
		}
		// echo $this->db->last_query();
		echo json_encode(1);
	}
}
