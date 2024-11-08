<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance_gen extends MY_Controller {
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Alam','alam');
	}
	
	public function index(){

		if(!in_array('viewMonthlyEmpAtten', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}

		$result = array();
		$employee = array();
		$atten = array();
		$all_weekend_date = array();
		$final_result = array();
		$current_session =$this->sumit->fetchSingleData('Session_Nm','session_master',array('Active_Status'=>1));
		$active_month = $this->sumit->fetchSingleData('*','month_master',array('active_month'=>1));
		$data['shiftList'] = $this->sumit->fetchAllData('*','shift_master',array());
		$session_year = explode('-', $current_session['Session_Nm']);
		$current_year = ($active_month['month_code'] < 4)?$session_year[1]:$session_year[0];

		if($active_month['month_code'] <= 9)
		{
			$active_month['month_code'] = '0'.$active_month['month_code'];
		}

		$total_days = cal_days_in_month(CAL_GREGORIAN, $active_month['month_code'], $current_year);
		$data['total_days'] = $total_days;
		$data['current_year'] = $current_year;
		$month = $active_month['month_code'];
		$data['current_month'] = $month;
		if(isset($_POST['search']))
		{
			$start_cycle = 1;
			$end_cycle = $total_days;
			$date = $this->input->post('selectedmonth');
			$hdesignation = $this->input->post('selectdesignation');

			$gender = $this->custom_lib->getGender();
			$leave_type = $this->custom_lib->shortLeaveRequestType();
			//getting weekend date and changing all weekend date format
			$weekend = $this->input->post('weekend');
			
			$weekend_exp = explode(',', $weekend);
			
			foreach ($weekend_exp as $key => $value) {
				$all_weekend_date[] = date('Y-m-d',strtotime($value));
			}
			
			$data['all_weekend_date'] = $weekend;

			if (login_details['ROLE_ID']==5 || login_details['ROLE_ID']==6) 
			{
				if($hdesignation>=1)
				{
						$emp_data = $this->sumit->fetchAllData("*,(SELECT print_position FROM desig WHERE Sno=employee.DESIG)print_position",'employee',"WING_MASTER_ID=(SELECT WING_MASTER_ID FROM employee WHERE EMPID='".login_details['user_id']."') AND STATUS='1' AND desig='".$hdesignation."' ORDER BY EMPID");

				}
				else{
					$emp_data = $this->sumit->fetchAllData("*,(SELECT print_position FROM desig WHERE Sno=employee.DESIG)print_position",'employee',"WING_MASTER_ID=(SELECT WING_MASTER_ID FROM employee WHERE EMPID='".login_details['user_id']."') AND STATUS='1' ORDER BY EMPID");

				}
				
			}
			else
			{
				if($hdesignation>=1)
				{
					$emp_data = $this->sumit->fetchAllData("id,EMPID,EMP_FNAME,EMP_MNAME,EMP_LNAME,SHIFT,SEX",'employee',"STATUS='1' AND desig='".$hdesignation."' ORDER BY EMPID");

				}
				else{
					$emp_data = $this->sumit->fetchAllData("id,EMPID,EMP_FNAME,EMP_MNAME,EMP_LNAME,SHIFT,SEX",'employee',"STATUS='1' ORDER BY EMPID");
				}


				
			}
			
			$holidayList = array();
			$dateList = array();
			$prev_month_year = $current_year;
			$prev_month = $active_month['month_code'];
			if($active_month['month_code']==1)
			{
				$prev_month_year= $current_year;
				$prev_month = 12;
			}
			$prev_month_total_days = cal_days_in_month(CAL_GREGORIAN, $prev_month, $prev_month_year);

			$dynamic_query = 'ep.id, ep.EMPID,ep.EMP_FNAME,ep.EMP_MNAME,ep.EMP_LNAME,(SELECT DESIG FROM desig WHERE Sno=ep.DESIG)designation';

			
			//$alreadyGenerated = $this->sumit->checkData('*','monthly_emp_atten',"att_month='$prev_month' AND att_year='$prev_month_year'");
		
		
			$leaveTableID = array();
			$insertData = array();
			for($p=$start_cycle;$p<=$prev_month_total_days;$p++)
			{
					
				$dateList[$p] = $p;
				$custom_date = date('Y-m-d',strtotime($prev_month_year.'-'.$prev_month.'-'.$p));
				$custom_date_day = date('D',strtotime($prev_month_year.'-'.$prev_month.'-'.$p));
				$dynamic_query .= ",(SELECT att_status FROM monthly_emp_atten WHERE empid=ep.EMPID AND date(att_date)='$custom_date')as'$p'";
				$dynamic_query .= ",(SELECT att_date FROM monthly_emp_atten WHERE empid=ep.EMPID AND date(att_date)='$custom_date')as"."'$p"."a'";
	$alreadyGenerated_prev = $this->alam->selectA('monthly_emp_atten','*',"att_month='$prev_month' AND att_year='$prev_month_year' LIMIT 1");
				if(sizeof($alreadyGenerated_prev) == 0)
				{
					
					$holiday_check = $this->sumit->fetchSingleData('ID,NAME','holiday_master',"date(FROM_DATE) <= '$custom_date' AND date(TO_DATE) >='$custom_date' AND APPLIED_FOR IN (0,1)");

					foreach ($emp_data as $key => $value) {
						$status = 'AB';
						$present_check = $this->sumit->fetchSingleData('SEC_TO_TIME(SUM(TIME_TO_SEC(TOTAL_DURATION))) AS TOTAL_DURATION, max(SHIFT_DURATION)SHIFT_DURATION, MAX(MIN_HRS_FULL)MIN_HRS_FULL, MAX(MIN_HRS_HALF)MIN_HRS_HALF','emp_attendance',array('EMPLOYEE_ID'=>$value['id'],'date(IN_TIME)'=>$custom_date));

						
						if(!empty($holiday_check) || $custom_date_day=='Sun')
						{
							
							if($present_check['TOTAL_DURATION']!='' || $present_check['SHIFT_DURATION']!='')
							{
								$total_work_duration = ($present_check['TOTAL_DURATION']=='')?$present_check['SHIFT_DURATION']:$present_check['TOTAL_DURATION'];
								$status = 'P';
							}
							else
							{
								if($p == $start_cycle)
								{
									$status = 'H';
								}
								else
								{
									$status = 'H';
									$holidayList[$value['EMPID']][$custom_date] = 'H';
								}
							}
						}
						else
						{
							if($present_check['TOTAL_DURATION']!='' || $present_check['SHIFT_DURATION']!='')
							{
								$total_work_duration = ($present_check['TOTAL_DURATION']=='')?$present_check['SHIFT_DURATION']:$present_check['TOTAL_DURATION'];

								$leave_check = $this->sumit->fetchSingleData('*','emp_leave_attendance',array('EMPLOYEE_ID'=>$value['EMPID'],'date(DATE_FROM) <='=>$custom_date,'date(DATE_TO) >='=>$custom_date,'STATUS'=>1));

								if(!empty($leave_check))
								{
									$leaveTableID[] = $leave_check['ID'];
									$leave_code = ($leave_check['LEAVE_TYPE'] !='')?$leave_type[$leave_check['LEAVE_TYPE']]:0;
									$status = $leave_code;
								}
								if(strtotime($total_work_duration) >= strtotime($present_check['MIN_HRS_FULL']) || strtotime($total_work_duration) > strtotime($present_check['MIN_HRS_HALF']))
								{					
									$status = 'P';
								}
								elseif(strtotime($total_work_duration) <= strtotime($present_check['MIN_HRS_HALF']))
								{
									$status = 'HD';
								}
							}
							else
							{
						
								$leave_check = $this->sumit->fetchSingleData('*','emp_leave_attendance',array('EMPLOYEE_ID'=>$value['EMPID'],'date(DATE_FROM) <='=>$custom_date,'date(DATE_TO) >='=>$custom_date,'STATUS'=>1));

								if(!empty($leave_check))
								{
									$leaveTableID[] = $leave_check['ID'];
									$leave_code = ($leave_check['LEAVE_TYPE'] !='')?$leave_type[$leave_check['LEAVE_TYPE']]:0;
									$status = $leave_code;
								}
							}
						}

						$insertData[] = array(
							'empid'		=> $value['EMPID'],
							'att_year'	=> $prev_month_year,
							'att_month'	=> $prev_month,
							'att_date'	=> $custom_date,
							'att_status'=> $status,
							'created_by'=> login_details['user_id'],
						);
					}
				}
			}
	
			for($i=1;$i<=$end_cycle;$i++)
			{
				
				$dateList[$i] = $i;
				$custom_date = date('Y-m-d',strtotime($current_year.'-'.$active_month['month_code'].'-'.$i));
				$custom_date_day = date('D',strtotime($current_year.'-'.$active_month['month_code'].'-'.$i));
				$dynamic_query .= ",(SELECT att_status FROM monthly_emp_atten WHERE empid=ep.EMPID AND date(att_date)='$custom_date')as'$i'";
					$dynamic_query .= ",(SELECT att_date FROM monthly_emp_atten WHERE empid=ep.EMPID AND date(att_date)='$custom_date')as "."'$i"."a'";
				$actm=$active_month['month_code'];
				$alreadyGenerated = $this->alam->selectA('monthly_emp_atten','*',"att_month='$actm' AND att_year='$current_year' LIMIT 1");
				if(sizeof($alreadyGenerated) == 0)
				{
				
				$holiday_check = $this->sumit->fetchSingleData('ID,NAME','holiday_master',"date(FROM_DATE) <= '$custom_date' AND date(TO_DATE) >='$custom_date' AND APPLIED_FOR IN (0,1)");
					foreach ($emp_data as $key => $value) {
						$status = 'AB';
						$present_check = $this->sumit->fetchSingleData('SEC_TO_TIME(SUM(TIME_TO_SEC(TOTAL_DURATION))) AS TOTAL_DURATION, max(SHIFT_DURATION)SHIFT_DURATION, MAX(MIN_HRS_FULL)MIN_HRS_FULL, MAX(MIN_HRS_HALF)MIN_HRS_HALF','emp_attendance',array('EMPLOYEE_ID'=>$value['id'],'date(IN_TIME)'=>$custom_date));
	
					//echo $present_check['TOTAL_DURATION']."<br/>";	
						if(!empty($holiday_check) || $custom_date_day=='Sun')
						{
							
							if($present_check['TOTAL_DURATION']!='' || $present_check['SHIFT_DURATION']!='')
							{
								$total_work_duration = ($present_check['TOTAL_DURATION']=='')?$present_check['SHIFT_DURATION']:$present_check['TOTAL_DURATION'];
								$status = 'P';
								
							}
							else
							{
						
								if($p == $start_cycle)
								{
									$status = 'H';
								}
								else
								{
									$status = 'H';
									$holidayList[$value['EMPID']][$custom_date] = 'H';
								}
							}
						}
						else
						{
							if($present_check['TOTAL_DURATION']!='0' || $present_check['SHIFT_DURATION']!='0')
							{
								$total_work_duration = ($present_check['TOTAL_DURATION']=='')?$present_check['SHIFT_DURATION']:$present_check['TOTAL_DURATION'];
								$leave_check = $this->sumit->fetchSingleData('*','emp_leave_attendance',array('EMPLOYEE_ID'=>$value['EMPID'],'date(DATE_FROM) <='=>$custom_date,'date(DATE_TO) >='=>$custom_date,'STATUS'=>1));

								if(!empty($leave_check))
								{
									$leaveTableID[] = $leave_check['ID'];
									$leave_code = ($leave_check['LEAVE_TYPE'] !='')?$leave_type[$leave_check['LEAVE_TYPE']]:0;
									$status = $leave_code;
								}
								if(strtotime($total_work_duration) >= strtotime($present_check['MIN_HRS_FULL']) || strtotime($total_work_duration) > strtotime($present_check['MIN_HRS_HALF']))
								{					
									$status = 'P';
								}
								elseif(strtotime($total_work_duration) <= strtotime($present_check['MIN_HRS_HALF']))
								{
									$status = 'HD';
								}
							}
							else
							{
								$leave_check = $this->sumit->fetchSingleData('*','emp_leave_attendance',array('EMPLOYEE_ID'=>$value['EMPID'],'date(DATE_FROM) <='=>$custom_date,'date(DATE_TO) >='=>$custom_date,'STATUS'=>1));

								if(!empty($leave_check))
								{
									$leaveTableID[] = $leave_check['ID'];
									$leave_code = ($leave_check['LEAVE_TYPE'] !='')?$leave_type[$leave_check['LEAVE_TYPE']]:0;
									$status = $leave_code;
								}
							}
						}

						$insertData[] = array(
							'empid'		=> $value['EMPID'],
							'att_year'	=> $current_year,
							'att_month'	=> $month,
							'att_date'	=> $custom_date,
							'att_status'=> $status,
							'created_by'=> login_details['user_id'],
						);
					}
				}
			}
		
			if(!empty($insertData))
			{
				$insert = $this->sumit->createMultiple('monthly_emp_atten',$insertData);
				
			}
			if(!empty($holidayList))
			{
				foreach ($holidayList as $key => $value) {
					$next_date = '';
					foreach ($value as $keys => $val) {
						if($next_date =='' || (strtotime($keys)>strtotime($next_date)))
						{
							$prev_date = date("Y-m-d", strtotime($keys . "-1 day"));
							$next_date = date("Y-m-d", strtotime($keys . "+1 day"));
							$next_date = $this->nextDateRecursiveFun($value,$next_date);
							$get_attendance = $this->sumit->fetchSingleData("(SELECT att_status FROM monthly_emp_atten WHERE empid=e.EMPID AND date(att_date)='$prev_date')prev_days,(SELECT att_status FROM monthly_emp_atten WHERE empid=e.EMPID AND date(att_date)='$next_date')next_days",'employee e',"e.EMPID='$key'");

							if(($get_attendance['prev_days'] == 'AB' || $get_attendance['prev_days'] == 'LWP') && ($get_attendance['next_days'] == 'AB' || $get_attendance['next_days'] == 'LWP'))
							{
								$this->sumit->update('monthly_emp_atten',array('att_status'=>'AB'),"empid='$key' AND date(att_date)>'$prev_date' AND date(att_date)<'$next_date'");
							}	
						}
					}
				}
			}

			if(!empty($leaveTableID))
			{
				$leaveTableIDStr = implode("','", $leaveTableID);
				$this->sumit->update('emp_leave_attendance',array('UPDATE_LOCK'=>1,'SALARY_STATUS'=>1),"ID IN ('$leaveTableIDStr')");
			}

				if($hdesignation>=1)
				{
					
					$result = $this->sumit->fetchAllData($dynamic_query,'employee as ep',"ep.STATUS='1' AND desig='".$hdesignation."' order by ep.EMPID");

				}
				else{
					$result = $this->sumit->fetchAllData($dynamic_query,'employee as ep',"ep.STATUS='1' order by ep.EMPID");
				}


			

			$data['result'] = $result;
			$data['dateList'] = $dateList;
			$chunkData = array(
				'current_month_total_days'	=> $total_days,
				'current_month'	=> $month,
				'current_year'	=> $current_year,
				'prev_month_total_days'	=> $prev_month_total_days,
				'prev_month_year'	=> $prev_month_year,
				'prev_month'	=> $prev_month,
				'start_cycle'	=> $start_cycle,
				'end_cycle'	=> $end_cycle,
			);
			$data['chunkData'] = $chunkData;
			 $start_date = date('Y-m-d',strtotime($prev_month_year.'-'.$prev_month.'-'.$start_cycle));
		    $end_date=date('Y-m-d',strtotime($current_year.'-'.$month.'-'.$end_cycle));
			
			$data['empAbsent'] = $this->attendance->getAbsentDays_new_Cal($start_date,$end_date);
		}
		$data['empdesig']=$this->attendance->get_designation_all();
		$this->render_template('salary/attendanceGeneration',$data); 
	}

	public function checkAttendanceGenerated()
	{
		$response = array();
		$emp_id = $this->input->post('emp_id');
		$year = $this->input->post('year');
		$month = $this->input->post('month');
		$empid_no = $this->input->post('empid_no');
		$custom_date = $this->input->post('selected_date');
		$response['msg'] = 1;
		$empdata = $this->alam->selectA('employee','hpl,ML,EL,CAS_LEAVE',"id='$empid_no'");
		$response['hpl']=$empdata[0]['hpl'];
		$response['ML']=$empdata[0]['ML'];
		$response['EL']=$empdata[0]['EL'];
		$response['CAS_LEAVE']=$empdata[0]['CAS_LEAVE'];
        $check_prev_data = $this->sumit->checkData('*','monthly_emp_atten',array('empid'=>$emp_id,'att_month'=>$month,'att_year'=>$year));
		//print_r($check_prev_data);
		//die;
		if($check_prev_data)
		{
				
			$response = $this->sumit->getSingleEmployee($empid_no);
			//print_r($response);
			//die();
			$response['shift'] = $this->sumit->fetchSingleData('*','shift_master',array('ID'=>$response['SHIFT']));
			$empt_att_data= $this->sumit->fetchSingleData('SEC_TO_TIME(SUM(TIME_TO_SEC(TOTAL_DURATION))) 	
			tot_duration,IN_TIME_REMARKS,OUT_TIME_REMARKS','emp_attendance',"EMPLOYEE_ID='$empid_no' AND date(IN_TIME)='$custom_date' GROUP BY
			IN_TIME_REMARKS,OUT_TIME_REMARKS");
		
			$response['IN_TIME_REMARKS']=$empt_att_data['IN_TIME_REMARKS'];
			$response['OUT_TIME_REMARKS']=$empt_att_data['OUT_TIME_REMARKS'];
			$response['tot_duration']=$empt_att_data['tot_duration'];
			$leave_arr = $this->sumit->fetchSingleData('*','emp_leave_attendance',array('EMPLOYEE_ID'=>$empid_no,'date(DATE_FROM) <='=>$custom_date,'date(DATE_TO) >='=>$custom_date));
		if(empty($leave_arr))
			 {
		 	$response['leave'] = array('STATUS'=>NULL);
			 }
			 else
			{
			 	$response['leave'] = $leave_arr;
			 }
		}
		else
		{
			$response['msg'] = 2;
		}
		echo json_encode($response);
	}
//this function is aded for update autopunching
		function checkLeaveBalance()
	{
		$emp_id = $this->input->post('employee_id');
		$leave_type = $this->input->post('pay_type_val');
		if($leave_type == 'CL')
		{
			$checkLeave = $this->sumit->checkData('CAS_LEAVE','employee',"CAS_LEAVE > 0 AND id='$emp_id'");
			$result = ($checkLeave==true)?1:2;
		}
		elseif($leave_type == 'EL')
		{
			$checkLeave = $this->sumit->checkData('EL','employee',"EL > 0 AND id='$emp_id'");
			$result = ($checkLeave==true)?1:2;
		}
		elseif($leave_type == 'HPL')
		{
			$checkLeave = $this->sumit->checkData('hpl','employee',"hpl > 0 AND id='$emp_id'");
			$result = ($checkLeave==true)?1:2;
		}
		echo json_encode($result);
	}
		function getUpdatedPresentAbsent()
	{
		$emp_id = $this->input->post('employee_id');
		$month = $this->input->post('month');
		$year = $this->input->post('year');
		$getData = $this->sumit->fetchSingleData('total_present,total_absent','monthly_emp_attend_gen',array('emp_id'=>$emp_id,'month'=>$month,'year'=>$year));
		echo json_encode($getData);
	}
	/////end autopunching new added function
	public function updateSingleDate()
	{
		$response = array();
		
		$pay_type = $this->input->post('pay_type');
		//$column_name = $this->input->post('column_name');
		//$month = $this->input->post('month');
		$year = $this->input->post('year');
		$employee_id = $this->input->post('employee_id');
		$selected_date = $this->input->post('selected_date');
		//$total_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);

		$data = array(
			"att_status" => $pay_type
		);
		$update = $this->sumit->update('monthly_emp_atten',$data,array('empid'=>$employee_id,'att_year'=>$year,'att_date'=>$selected_date));
	//echo json_encode($response);
	}

	public function nextDateRecursiveFun($value=array(),$next_date)
	{
		if(array_key_exists($next_date,$value))
		{
			$next_date = date("Y-m-d", strtotime($next_date . "+1 day"));
			if(array_key_exists($next_date,$value))
			{
				return $this->nextDateRecursiveFun($value,$next_date);
			}
			else
			{
				return $next_date;
			}
		}
		else
		{
			return $next_date;
		}
	}
}