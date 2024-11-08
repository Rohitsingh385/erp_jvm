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

		$data['daily_att'] = $this->db->query("SELECT * FROM daily_emp_att WHERE EMPID='$user_id' ")->result();
		$attendance_status_by_date = [];

		foreach ($data['daily_att'] as $attendance) { 
    		$attendance_status_by_date[$attendance->DATE] = $attendance->ATT_STATUS;
    		// $attendance_status_by_date[$attendance->DATE] = $attendance->ATT_STATUS;
		}

		$data['attendance_status_by_date'] = $attendance_status_by_date;

		// $data['daily_att']=$this->db->query("SELECT ATT_STATUS FROM daily_emp_att WHERE EMPID='$user_id' ")->result();
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
			
			$wing_master=$this->db->query("SELECT WING_MASTER_ID FROM employee WHERE EMPID='$user_id'")->result();
			$wing = $wing_master[0]->WING_MASTER_ID;

			$check_data=$this->db->query("SELECT * FROM daily_emp_att WHERE EMPID='$user_id' AND DATE='$newDateFormat'")->result();

			if(!empty($check_data))
			{
				$update=$this->db->query("UPDATE daily_emp_att SET ATT_STATUS='$attendanceStatuses' WHERE EMPID='$user_id' AND DATE='$newDateFormat'");
			}
			else
			{
				$inserted = $this->db->query("INSERT INTO `daily_emp_att` (`EMPID`, `IN_TIME`, `OUT_TIME`, `DATE`,`ATT_STATUS`,`WING_MASTER_ID`) 
										VALUES ('$user_id','$inTimes','$outTimes','$newDateFormat','$attendanceStatuses','$wing')" );
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
    	if ($this->input->is_ajax_request())
		{
        $date = $this->input->post('date');
        $value = $this->input->post('value');
		$user_id = login_details['user_id']; // Replace with your actual method to get user_id
        $newDateFormat = date('Y-m-d');
		$vl=substr($value, 0, 2);
		
		if($vl == '08' || $vl == '8' )
		{
			$update=$this->db->query("UPDATE daily_emp_att SET IN_TIME='$value' WHERE EMPID='$user_id' AND DATE='$newDateFormat'");
		}
		if($vl == '14')
		{
			$update=$this->db->query("UPDATE daily_emp_att SET OUT_TIME='$value' WHERE EMPID='$user_id' AND DATE='$newDateFormat'");

		}
    
		if($update)
		{

			echo "Success"; // Return a success message to the AJAX request
		}

    	}
	}
	
}	
