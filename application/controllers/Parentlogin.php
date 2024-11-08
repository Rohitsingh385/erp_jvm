<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parentlogin extends MY_controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('Mymodel','dbcon');
		$this->load->model('Alam','alam');
		error_reporting(0);
	}
	
	public function index(){
		$data['schoolData'] = $this->sumit->fetchSingleData('*','school_setting',array('S_No'=>1));
		$this->load->view('parent/index',$data);
	}
	
	public function loggedIn(){
		$adm = $this->input->post('user_id');
		$pass = $this->input->post('password');
		
		$data_count = $this->dbcon->checkData('*','student',array('ADM_NO'=>$adm,'Parent_password'=>$pass));
		$school = $this->dbcon->select('school_setting','*');
		if($data_count){
			$login_details = $this->dbcon->select('student','*',array('ADM_NO'=>$adm,'Parent_password'=>$pass));
			
			$student_id = $login_details[0]->STUDENTID;
			$student_adm = $login_details[0]->ADM_NO;
			$student_status = $login_details[0]->Student_Status;
			
			if($student_status == "ACTIVE"){
				$c_mobliedata = $login_details[0]->C_MOBILE;
				$this->session->set_userdata('std_id',$student_id);
				$this->session->set_userdata('school_logo',$school[0]->SCHOOL_LOGO);
				$this->session->set_userdata('school_Name',$school[0]->School_Name);
				
				if($c_mobliedata == null || $c_mobliedata == 'N/A' || $c_mobliedata == 'n/a'){
					$father_details = $this->dbcon->select('parents','*',array('STDID'=>$student_id,'PTYPE'=>'F'));
					
					$this->session->set_userdata('c_moblie',$login_details[0]->C_MOBILE);
					$this->session->set_userdata('adm',$student_adm);
					$this->session->set_userdata('class_code',$login_details[0]->CLASS);
					
					$this->session->set_userdata('sec_code',$login_details[0]->SEC);
					$this->session->set_userdata('father_name',$login_details[0]->FATHER_NM);
					$this->session->set_userdata('father_occu',$father_details[0]->OCCUPATION);
					
					redirect('Parentlogin/parent_dashboard');
					//redirect('Parentlogin/update_details');
				}else{
					$father_details = $this->dbcon->select('parents','*',array('STDID'=>$student_id,'PTYPE'=>'F'));
					
					$this->session->set_userdata('c_moblie',$login_details[0]->C_MOBILE);
					$this->session->set_userdata('adm',$student_adm);
					$this->session->set_userdata('class_code',$login_details[0]->CLASS);
					
					$this->session->set_userdata('sec_code',$login_details[0]->SEC);
					$this->session->set_userdata('father_name',$login_details[0]->FATHER_NM);
					$this->session->set_userdata('father_occu',$father_details[0]->OCCUPATION);
					
					redirect('Parentlogin/parent_dashboard');
				}
				//redirect('Parentlogin/parent_dashboard');
				//redirect('Parentlogin/verify_opt');
			}
			else{
				$this->session->set_flashdata('msg','<div style="text-align:center; font-size:18px;" class="text-danger">STUDENT ID IS DEACTIVATED !</div>');
				redirect('Parentlogin/index');
			}
			
		}else{
			$this->session->set_flashdata('msg','<div style="text-align:center; font-size:18px;" class="text-danger">Admission And Password Is Incorrect !</div>');
			redirect('Parentlogin/index');
		}
	}
	
	public function logout(){
		$this->session->unset_userdata('school_Name');
		$this->session->unset_userdata('school_logo');
		$this->session->unset_userdata('father_name');
		$this->session->unset_userdata('adm');
		$this->session->unset_userdata('father_occu');
		$this->session->unset_userdata('std_id');
		$this->session->unset_userdata('class_code');
		$this->session->unset_userdata('sec_code');
		redirect('Parentlogin/index');
	}
	public function update_details(){
		$this->load->view('update_details/update_details');
	}
	public function send_otp(){
		$school_name = $this->session->userdata('school_Name');
		$data = $this->input->post();
		$this->session->set_userdata('input_data',$data);
		$six_digitOtp_number = mt_rand(100000, 999999);
		$this->session->set_userdata('first_otp',$six_digitOtp_number);
		$msg = $school_name.' '.$six_digitOtp_number.' is your Verification Code. Pls do not share with anyone. We will not ask for your code in anyway';
		$this->sms_lib->sendSMS($data['number'],$msg);
		$this->load->view('update_details/otp_verify');
	}
	public function verify_otp(){
		$gen_otp = $this->session->userdata('first_otp');
		$data = $this->session->userdata('input_data');
		$std_id = $this->session->userdata('std_id');
		$recive_otp = $this->input->post('otp');
		if($gen_otp == $recive_otp){
			$array = array(
				'P_MOBILE' => $data['number'],
				'P_EMAIL' => $data['email'],
				'C_MOBILE' => $data['number'],
				'C_EMAIL' => $data['email'],
			);
			$array1 = array(
				'MOBILE' => $data['number'],
				'EMAIL' => $data['email'],
			);
			
			$this->dbcon->update('student',$array,"STUDENTID='$std_id'");
			$this->dbcon->update('parents',$array1,"STDID='$std_id'");
			$this->session->set_flashdata('msg','<div style="text-align:center; font-size:18px;" class="text-danger">Details Updated Successfully Please Login !</div>');
			redirect('Parentlogin/index');
			$this->session->sess_destroy();
		}else{
			$this->session->set_flashdata('msg','<div style="text-align:center; font-size:18px;" class="text-danger">OTP ERROR RETRY</div>');
			redirect('Parentlogin/index');
			$this->session->sess_destroy();
		}
	}
	public function parent_dashboard(){
		$adm_no = $this->session->userdata('adm');
		$std_id = $this->session->userdata('std_id');
		$class_code = $this->session->userdata('class_code');
		$data = $this->dbcon->select('student_attendance_type','*',"class_code='$class_code'");
		$present_day = $this->dbcon->select('stu_attendance_entry','count(*)Present',"admno='$adm_no' AND att_status='P'");
		$absent_day = $this->dbcon->select('stu_attendance_entry','count(*)Absent',"admno='$adm_no' AND att_status='A'");
		$half_day = $this->dbcon->select('stu_attendance_entry','count(*)Halfday',"admno='$adm_no' AND att_status='HD'");
		$session_master = $this->dbcon->select('session_master','*',"Active_Status=1");
		$session_year = $session_master[0]->Session_Year;
		$start_date = $session_year."-04-01";
		$year = date('Y');
		$month = date('m');
		$day = cal_days_in_month(CAL_GREGORIAN,$month,$year);
		$end_date = $year."-".$month."-".$day;
		$period_wise_att = $this->dbcon->period_wise_data($adm_no,$start_date,$end_date);

		$noticeList = $this->notice_model->getNoticeDetails("admno='$adm_no' ORDER BY id DESC");
		
		$homeworkList = $this->notice_model->gethomeworkDetails("admno='$adm_no' AND homework_status='N' ORDER BY id DESC");
		
		$elearning = $this->notice_model->getElearningDetails("admno='$adm_no' ORDER BY id DESC limit 10");
		
		$student = $this->dbcon->show_student($std_id);
		$reportCard = $this->db->query("select ADM_NO,t1_report_card_status,t2_report_card_status, int_report_card_status from student where ADM_NO='$adm_no'")->result_array();
		$adm = $adm_no;
		$array = array(
			'data' => $data,
			'present_day' => $present_day,
			'absent_day' => $absent_day,
			'half_day' => $half_day,
			'period_wise_att' => $period_wise_att,
			'noticeList' => $noticeList,
			'homeworkList' => $homeworkList,
			'student' => $student,
			'elearning' => $elearning,
			'adm' => $adm,
			'reportCard' => $reportCard,
		);
		$this->Parent_templete('parents_dashboard/index',$array);
	}
	public function profileview(){
		$student_id = $this->session->userdata("std_id");
		$student_adm = $this->session->userdata("adm");
		$student_details = $this->dbcon->selectSingleData('student','*',"ADM_NO='$student_adm'");
		$father_details = $this->dbcon->selectSingleData('parents','*',array('STDID'=>$student_id,'PTYPE'=>'F'));
		$array = array(
			'father_details' => $father_details,
			'student'	=> $student_details
		);
		$this->Parent_templete('parents_dashboard/profile',$array);
	}
	public function Ptmarks($adm){
	$adm=str_replace("-","/",$adm);
		$ddt=$this->alam->selectA("student",'ADM_NO,FIRST_NM,MIDDLE_NM,TITLE_NM,FATHER_NM,MOTHER_NM,ROLL_NO,CLASS,SEC,DISP_CLASS,DISP_SEC',"ADM_NO='$adm' AND Student_Status='ACTIVE'");
		$class=$ddt[0]['CLASS'];
		$SEC=$ddt[0]['SEC'];
		
		
		$studentsub=$this->alam->selectA("marks","M1,M2,(select SubName from subjects where SubCode=marks.SCode)SubName","admno='$adm' AND Classes='$class' AND Sec='$SEC' AND ExamC='1', TERM='TERM-1', order by SCode asc");
		
		$data=array('studata'=>$ddt,'subject'=>$studentsub);
		
		$this->load->view('parents_dashboard/Ptmarks',$data);
	}
	
	public function UT1($adm){
	$adm=str_replace("-","/",$adm);
		$ddt=$this->alam->selectA("student",'ADM_NO,FIRST_NM,MIDDLE_NM,TITLE_NM,FATHER_NM,MOTHER_NM,ROLL_NO,CLASS,SEC,DISP_CLASS,DISP_SEC',"ADM_NO='$adm'");
		$class=$ddt[0]['CLASS'];
		$SEC=$ddt[0]['SEC'];
		$studentsub=$this->alam->selectA("marks","M2,(select SubName from subjects where SubCode=marks.SCode)SubName","admno='$adm' AND Classes='$class' AND Sec='$SEC' AND ExamC='10' and Term='TERM-1' order by SCode asc");
		$data=array('studata'=>$ddt,'subject'=>$studentsub);
		
		$this->load->view('parents_dashboard/PT1_202122',$data);
	}
	
	public function UT1_UT2($adm){
	$adm=str_replace("-","/",$adm);
		$ddt=$this->alam->selectA("student",'ADM_NO,FIRST_NM,MIDDLE_NM,TITLE_NM,FATHER_NM,MOTHER_NM,ROLL_NO,CLASS,SEC,DISP_CLASS,DISP_SEC',"ADM_NO='$adm'");
		$class=$ddt[0]['CLASS'];
		$SEC=$ddt[0]['SEC'];
		//$studentsub=$this->alam->selectA("marks","M2,(select SubName from subjects where SubCode=marks.SCode)SubName, ","admno='$adm' AND Classes='$class' AND Sec='$SEC' AND ExamC='4' and Term='TERM-1' order by SCode asc");
			
		
	$studentsub=$this->db->query("select M2, (select M2 from marks mo_pt where admno='$adm' AND Classes='$class' AND Sec='$SEC' AND ExamC='11' and Term='TERM-1' and scode=mo_hf.SCode) mo_pt1,(select SubName from subjects where SubCode=mo_hf.SCode)SubName from marks mo_hf where admno='$adm' AND Classes='$class' AND Sec='$SEC' AND ExamC='10' and Term='TERM-1' order by SCode asc")->result_array();

		$data=array('studata'=>$ddt,'subject'=>$studentsub);
		//echo '<pre>'; print_r($data); echo '</pre>';die;	
		
		$this->load->view('parents_dashboard/UT1_UT2',$data);
	}
	
	public function PT1_202122($adm){
	$adm=str_replace("-","/",$adm);
		$ddt=$this->alam->selectA("student",'ADM_NO,FIRST_NM,MIDDLE_NM,TITLE_NM,FATHER_NM,MOTHER_NM,ROLL_NO,CLASS,SEC,DISP_CLASS,DISP_SEC',"ADM_NO='$adm'");
		$class=$ddt[0]['CLASS'];
		$SEC=$ddt[0]['SEC'];
		$studentsub=$this->alam->selectA("marks","M2,(select SubName from subjects where SubCode=marks.SCode)SubName","admno='$adm' AND Classes='$class' AND Sec='$SEC' AND ExamC='1' and Term='TERM-1' order by id asc");
		$data=array('studata'=>$ddt,'subject'=>$studentsub);
		
		$this->load->view('parents_dashboard/PT1_202122',$data);
	}
	
	
	
		public function marks_term2($adm){
	$adm=str_replace("-","/",$adm);
		$ddt=$this->alam->selectA("student",'ADM_NO,FIRST_NM,MIDDLE_NM,TITLE_NM,FATHER_NM,MOTHER_NM,ROLL_NO,CLASS,SEC,DISP_CLASS,DISP_SEC',"ADM_NO='$adm'");
		$class=$ddt[0]['CLASS'];
		$SEC=$ddt[0]['SEC'];
		$studentsub=$this->alam->selectA("marks","M2,(select SubName from subjects where SubCode=marks.SCode)SubName","admno='$adm' AND Classes='$class' AND Sec='$SEC' AND ExamC='2' AND Term='TERM-2'");
		$data=array('studata'=>$ddt,'subject'=>$studentsub);
		
		$this->load->view('parents_dashboard/marks_term2',$data);
	}
	
	public function holidaycalender(){
		$this->Parent_templete('parents_dashboard/holiday_calender');
	}
	public function holiday_details(){
	
	$year = $_REQUEST['year'];
	$month = $_REQUEST['month'];

	$total_days = cal_days_in_month(CAL_GREGORIAN,$month,$year);
	$endDate = $year.'-'.$month.'-'.$total_days;
	$startDate = $year.'-'.$month.'-1';
	$atten_arr = array();
	 $holidayList = $this->sumit->fetchAllData('*','holiday_master',array('date(FROM_DATE) >='=>$startDate,'date(TO_DATE) <='=>$endDate));
		foreach ($holidayList as $key => $value) {
			$start_date = $value['FROM_DATE'];
			$end_date = $value['TO_DATE'];

			for($i = $start_date; $i <= $end_date; $i++)
			{
				$atten_arr[] = array(
					"date" => date("Y-m-d", strtotime($i)),
					"badge"	=> false,
					"classname" => "holiday",
					"title"		=> $value['NAME'],
				);
			}
			
		}
		echo json_encode(json_decode(json_encode($atten_arr)));
	}
	
}