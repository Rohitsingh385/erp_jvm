<?php 

class Autopunching extends MY_Controller
{	
	function __construct()
	{
		parent::__construct();
		$this->loggedOut();
	}

	public function index()
	{

		$data['month'] = $this->sumit->fetchAllData('*','month_master',array());
		$this->render_template('punching/autoPunching',$data);
	}

	public function createPunching()
	{
		$response = array();
		$month = $this->input->post('month');
		$current_session =$this->sumit->fetchSingleData('Session_Nm','session_master',array('Active_Status'=>1));
		$active_month = $this->sumit->fetchSingleData('*','month_master',array('active_month'=>1));
		$session_year = explode('-', $current_session['Session_Nm']);
		$current_year = $session_year[0];
		$start_cycle = 26;
		$end_cycle = 25;
		$prev_month_year = $current_year;
			$prev_month = $active_month['month_code']-1;
			if($active_month['month_code']==1)
			{
				$prev_month_year= $current_year -1;
				$prev_month = 12;
			}
			$prev_month_Last_day = cal_days_in_month(CAL_GREGORIAN, $prev_month, $prev_month_year);

		if($month < 4)
		{
			$current_year = $session_year[1];
		}
		$create = false;
		$time_compare = array();
		$time_diff = '';
		$total_days = cal_days_in_month(CAL_GREGORIAN,$month,$current_year);
		$checkAlreadyExist = $this->sumit->checkData('*','emp_attendance',"month(IN_TIME)='$month' AND year(IN_TIME)='$current_year'");
		if($checkAlreadyExist == false)
		{
			$empdata = $this->sumit->fetchAllData('*','employee',array('STATUS'=>1));
			foreach ($empdata as $key => $value) {
				$data = array();
				$shift_details = $this->sumit->fetchSingleData('*','shift_master',array('ID'=>$value['SHIFT']));
				//Code for Previous Start
				for ($i=$start_cycle; $i <= $prev_month_Last_day; $i++) { 

					$date = date('Y-m-d',strtotime($prev_month_year.'-'.$prev_month.'-'.$i));
					
					
					$dayname = date('D',strtotime($prev_month_year.'-'.$prev_month.'-'.$i));
if($dayname =='Sun'){
continue;
}
					$in_time = $date.' '.$shift_details['START_TIME'];
					$out_time =$date.' '.$shift_details['STOP_TIME'];

					$data[] = array(
						'EMPLOYEE_ID'		=> $value['id'],
						'IN_TIME'			=> $in_time,
						'IN_CHECK_DIFFER'	=> "00:00:00",
						'OUT_TIME'			=> $out_time,
						'OUT_CHECK_DIFFER'	=> "00:00:00",
						'SHIFT_MASTER_ID'	=> $value['SHIFT'],
						'SHIFT_IN_TIME'		=> $shift_details['START_TIME'],
						'SHIFT_OUT_TIME'	=> $shift_details['STOP_TIME'],
						'SHIFT_DURATION'	=> $shift_details['SHIFT_DURATION'],
						'MIN_HRS_HALF'		=> $shift_details['MIN_HRS_HALF'],
						'MIN_HRS_FULL'		=> $shift_details['MIN_HRS_FULL'],
						'TOTAL_DURATION'	=> $shift_details['SHIFT_DURATION'],
						'STATUS'			=> 2,
						'PUNCH_TYPE'		=> 1,
						'ADMIN_ID'			=> login_details['user_id'],
					);
				}
				//End code for previous
				
				//code for current month start
				
								for ($i=1; $i <= $end_cycle; $i++) { 

					$date = date('Y-m-d',strtotime($current_year.'-'.$month.'-'.$i));
					
					
					$dayname = date('D',strtotime($current_year.'-'.$month.'-'.$i));
if($dayname =='Sun'){
continue;
}
					$in_time = $date.' '.$shift_details['START_TIME'];
					$out_time =$date.' '.$shift_details['STOP_TIME'];

					$data[] = array(
						'EMPLOYEE_ID'		=> $value['id'],
						'IN_TIME'			=> $in_time,
						'IN_CHECK_DIFFER'	=> "00:00:00",
						'OUT_TIME'			=> $out_time,
						'OUT_CHECK_DIFFER'	=> "00:00:00",
						'SHIFT_MASTER_ID'	=> $value['SHIFT'],
						'SHIFT_IN_TIME'		=> $shift_details['START_TIME'],
						'SHIFT_OUT_TIME'	=> $shift_details['STOP_TIME'],
						'SHIFT_DURATION'	=> $shift_details['SHIFT_DURATION'],
						'MIN_HRS_HALF'		=> $shift_details['MIN_HRS_HALF'],
						'MIN_HRS_FULL'		=> $shift_details['MIN_HRS_FULL'],
						'TOTAL_DURATION'	=> $shift_details['SHIFT_DURATION'],
						'STATUS'			=> 2,
						'PUNCH_TYPE'		=> 1,
						'ADMIN_ID'			=> login_details['user_id'],
					);
				}
				//end code for current mnth
				
				
				
				if(!empty($data))
				{
					
					$create = $this->sumit->createMultiple('emp_attendance',$data);
					
				}
				
			}
			if($create)
			{
				$response['msg'] = '1';
			}
			else
			{
				$response['msg'] = '2';
			}
		}
		else
		{
			$response['msg'] = '3'; //already generated
		}
	echo json_encode($response);
	}
}