<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cbse_verification extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->loggedOut();
		$login_details = $this->session->userdata('login_details');
		$this->load->model('Mymodel','dbcon');
		$this->load->model('Gautam');
		$this->load->model('Alam','alam');
	}
	public function index()
	{
		// if(!in_array('viewEmpDashboard', permission_data))
		// {
		// 	redirect('payroll/dashboard/dashboard');
		// }	$user_id = $this->session->userdata('user_id');
		$user_id = $this->session->userdata('user_id');
		$employee = $this->sumit->fetchSingleData('id','employee',array('EMPID'=>$user_id));
		$login_data = $this->sumit->fetchSingleData('username,user_id','login_details',array('user_id'=>$user_id));
		$data['employeeData'] = $this->sumit->getSingleEmployee($employee['id']);
		$fetchtempdata = $this->Gautam->fetchtempdata();
		$fetchtempdata_xi = $this->Gautam->fetchtempdata_xi();
		$fetchtempdata_X_XII = $this->Gautam->fetchtempdata_X_XII();
		$data=array('login_data'=>$login_data,'fetch_record'=>$fetchtempdata,'fetch_record_xi'=>$fetchtempdata_xi,'fetchtempdata_X_XII'=>$fetchtempdata_X_XII);
		
		$this->render_template('cbse_verify_admin/cbse_verification_list',$data);
	}
	
	public function list_data_total()
	{
		$user_id = $this->session->userdata('user_id');
		$employee = $this->sumit->fetchSingleData('id','employee',array('EMPID'=>$user_id));
		$login_data = $this->sumit->fetchSingleData('username,user_id','login_details',array('user_id'=>$user_id));
		$data['employeeData'] = $this->sumit->getSingleEmployee($employee['id']);

	
		$stuData = $this->alam->selectA('temp_cbse_reg',"*,(select SECTION_NAME from sections where section_no=temp_cbse_reg.sec)sec_nm","class='IX'  order by name");
		$data=array('login_data'=>$login_data,'stuData'=>$stuData);
		
		$this->render_template('cbse_verify_admin/list_data_total',$data);
	}
	
	
	public function list_data_total_X_XII()
	{
		$user_id = $this->session->userdata('user_id');
		$employee = $this->sumit->fetchSingleData('id','employee',array('EMPID'=>$user_id));
		$login_data = $this->sumit->fetchSingleData('username,user_id','login_details',array('user_id'=>$user_id));
		$data['employeeData'] = $this->sumit->getSingleEmployee($employee['id']);

	
		$stuData = $this->alam->selectA('cbse_reg_amount',"*,");
		$data=array('login_data'=>$login_data,'stuData'=>$stuData);
		
		$this->render_template('cbse_verify_admin/list_data_total_X_XII',$data);
	}
	
	
public function rtgs_verification_ok(){
$adm = $this->input->post('adm');
$stuData = $this->alam->selectA('class_xi_other_payment',"*,(select Sname from class_xi_reg where AdmNo=class_xi_other_payment.admno)name,(select TokenNo from class_xi_reg where AdmNo=class_xi_other_payment.admno)Token","admno='$adm'");
$adm=$stuData[0]['admno'];
$trs_id=$stuData[0]['trns_id'];
  $data=array(
	'f_code'=>'Ok',
	'amt'=>'350',
	'desc'=>'RTGS',
	'transaction_id'=>$trs_id
		);
	$this->alam->update('class_xi_reg',$data,"AdmNo='$adm'");
}	
	public function rtgs_list_xi()
	{
		// if(!in_array('viewEmpDashboard', permission_data))
		// {
		// 	redirect('payroll/dashboard/dashboard');
		// }	$user_id = $this->session->userdata('user_id');
		
		$user_id = $this->session->userdata('user_id');
		$employee = $this->sumit->fetchSingleData('id','employee',array('EMPID'=>$user_id));
		$login_data = $this->sumit->fetchSingleData('username,user_id','login_details',array('user_id'=>$user_id));
		$data['employeeData'] = $this->sumit->getSingleEmployee($employee['id']);
		$stuData = $this->alam->selectA('class_xi_other_payment',"*,(select Sname from class_xi_reg where AdmNo=class_xi_other_payment.admno)name,(select f_code from class_xi_reg where AdmNo=class_xi_other_payment.admno)rtgs_status,(select TokenNo from class_xi_reg where AdmNo=class_xi_other_payment.admno)Token","(select class_xi_reg.desc from class_xi_reg where class_xi_reg.AdmNo=class_xi_other_payment.admno) = 'RTGS' ");
		$data=array('login_data'=>$login_data,'stuData'=>$stuData);
		$this->render_template('cbse_verify_admin/rtgs_xi',$data);
	}
	
	public function list_data_total_xi(){
		$user_id = $this->session->userdata('user_id');
		$employee = $this->sumit->fetchSingleData('id','employee',array('EMPID'=>$user_id));
		$login_data = $this->sumit->fetchSingleData('username,user_id','login_details',array('user_id'=>$user_id));
		$data['employeeData'] = $this->sumit->getSingleEmployee($employee['id']);

	
		$stuData = $this->alam->selectA('temp_cbse_reg',"*,(select SECTION_NAME from sections where section_no=temp_cbse_reg.sec)sec_nm,(select SUBJECT1 from student where ADM_NO=temp_cbse_reg.admission_no)SUBJECT1,(select SUBJECT2 from student where ADM_NO=temp_cbse_reg.admission_no)SUBJECT2,(select SUBJECT3 from student where ADM_NO=temp_cbse_reg.admission_no)SUBJECT3,(select SUBJECT4 from student where ADM_NO=temp_cbse_reg.admission_no)SUBJECT4,(select SUBJECT5 from student where ADM_NO=temp_cbse_reg.admission_no)SUBJECT5","class='XI' ORDER BY sec");
		$data=array('login_data'=>$login_data,'stuData'=>$stuData);
		
		$this->render_template('cbse_verify_admin/list_data_total_xi',$data);
	}
	
	public function verify_update(){
		
		if(isset($_POST['adm'])){
			date_default_timezone_set('Australia/Melbourne');
           $date = date('Y-m-d', time());
			$adm = $this->input->post('adm');
			$user_id = $this->session->userdata('user_id');
			$data=array('verify'=>1,'verified_by'=>$user_id,'verified_date'=>$date);
			$this->alam->update('class_xi_reg',$data,"AdmNo ='$adm'");
		}
	
	}
	
	
		public function list_data_verified()
	{
		// if(!in_array('viewEmpDashboard', permission_data))
		// {
		// 	redirect('payroll/dashboard/dashboard');
		// }	$user_id = $this->session->userdata('user_id');
				$user_id = $this->session->userdata('user_id');
		$employee = $this->sumit->fetchSingleData('id','employee',array('EMPID'=>$user_id));
		$login_data = $this->sumit->fetchSingleData('username,user_id','login_details',array('user_id'=>$user_id));
		$data['employeeData'] = $this->sumit->getSingleEmployee($employee['id']);
		
	
		$stuData = $this->alam->selectA('temp_cbse_reg',"*,(select SECTION_NAME from sections where section_no=temp_cbse_reg.sec)sec_nm","verify='1' AND class='IX'");
		$data=array('login_data'=>$login_data,'stuData'=>$stuData);
		
		$this->render_template('cbse_verify_admin/list_data_total',$data);
	}
		public function list_data_verified_xi()
	{
		// if(!in_array('viewEmpDashboard', permission_data))
		// {
		// 	redirect('payroll/dashboard/dashboard');
		// }	$user_id = $this->session->userdata('user_id');
				$user_id = $this->session->userdata('user_id');
		$employee = $this->sumit->fetchSingleData('id','employee',array('EMPID'=>$user_id));
		$login_data = $this->sumit->fetchSingleData('username,user_id','login_details',array('user_id'=>$user_id));
		$data['employeeData'] = $this->sumit->getSingleEmployee($employee['id']);
		
	
		$stuData = $this->alam->selectA('class_xi_reg',"*","verify='1' ORDER BY Section");
		$data=array('login_data'=>$login_data,'stuData'=>$stuData);
		
		$this->render_template('cbse_verify_admin/list_data_total_xi',$data);
	}
	
	 public function update_rtgs_data(){
	 	$adm = $this->input->post('adm');
		$stuData = $this->alam->selectA('class_xi_other_payment',"*","admno='$adm'");
		$pay_mode= $stuData[0]['pay_mode'];
		$trns_id= $stuData[0]['trns_id'];
		 $trans_date=$stuData[0]['trans_date'];
		 $dataar=array($pay_mode,$trns_id,$trans_date);
		 echo json_encode($dataar);
	 }
	
		public function update_rtgs_up(){
		$p_mode = $this->input->post('p_mode');
		$tr_id = $this->input->post('tr_id');
		$t_date = date('y-m-d',strtotime($this->input->post('t_date')));
		$adm = $this->input->post('admno');
		$save = array(
				'pay_mode' => $p_mode,
				'trns_id' => $tr_id,
				'trans_date' => $t_date
		);
		
		$aar=$this->alam->update('class_xi_other_payment',$save,"admno='$adm'");
	
	}
	public function list_data_pending()
	{
		// if(!in_array('viewEmpDashboard', permission_data))
		// {
		// 	redirect('payroll/dashboard/dashboard');
		// }	$user_id = $this->session->userdata('user_id');
				$user_id = $this->session->userdata('user_id');
		$employee = $this->sumit->fetchSingleData('id','employee',array('EMPID'=>$user_id));
		$login_data = $this->sumit->fetchSingleData('username,user_id','login_details',array('user_id'=>$user_id));
		$data['employeeData'] = $this->sumit->getSingleEmployee($employee['id']);
		$fetchtempdata = $this->Gautam->fetchtempdata();
	
		$stuData = $this->alam->selectA('temp_cbse_reg',"*,(select SECTION_NAME from sections where section_no=temp_cbse_reg.sec)sec_nm","verify='0' AND class='IX'");
		$data=array('login_data'=>$login_data,'stuData'=>$stuData);
		
		$this->render_template('cbse_verify_admin/list_data_total',$data);
	}
		public function list_data_pending_xi()
	{
		// if(!in_array('viewEmpDashboard', permission_data))
		// {
		// 	redirect('payroll/dashboard/dashboard');
		// }	$user_id = $this->session->userdata('user_id');
		$user_id = $this->session->userdata('user_id');
		$employee = $this->sumit->fetchSingleData('id','employee',array('EMPID'=>$user_id));
		$login_data = $this->sumit->fetchSingleData('username,user_id','login_details',array('user_id'=>$user_id));
		$data['employeeData'] = $this->sumit->getSingleEmployee($employee['id']);
		$fetchtempdata = $this->Gautam->fetchtempdata();
	
		$stuData = $this->alam->selectA('class_xi_reg',"*","verify='0' AND form_save_status='1' ORDER BY Section");
		$data=array('login_data'=>$login_data,'stuData'=>$stuData);
		
		$this->render_template('cbse_verify_admin/list_data_total_xi',$data);
	}
	
	public function viewdata($id){
	    $user_id = $this->session->userdata('user_id');
		$employee = $this->sumit->fetchSingleData('id','employee',array('EMPID'=>$user_id));
		$login_data = $this->sumit->fetchSingleData('username,user_id','login_details',array('user_id'=>$user_id));
		$data['employeeData'] = $this->sumit->getSingleEmployee($employee['id']);
		$fetchtempdata = $this->Gautam->fetchtempdata();
		
		$stuData = $this->alam->selectA('temp_cbse_reg',"*,(select SECTION_NAME from sections where section_no=temp_cbse_reg.sec)secnm,(select SUBJECT1 from student where ADM_NO=temp_cbse_reg.admission_no)SUBJECT1,(select SUBJECT2 from student where ADM_NO=temp_cbse_reg.admission_no)SUBJECT2,(select SUBJECT3 from student where ADM_NO=temp_cbse_reg.admission_no)SUBJECT3,(select SUBJECT4 from student where ADM_NO=temp_cbse_reg.admission_no)SUBJECT4,(select SUBJECT5 from student where ADM_NO=temp_cbse_reg.admission_no)SUBJECT5","id='$id'");

		$sections = $this->dbcon->select('login_details','Section_No,(select SECTION_NAME from sections where section_no=login_details.Section_No)secnm',"Class_No='10'");
		$data=array('login_data'=>$login_data,'temp_data'=>$stuData,'sections'=>$sections);
		
		if($stuData[0]['class'] == 'IX'){
			$this->render_template('cbse_verify_admin/user_profile',$data);
		}else{
			$this->render_template('cbse_verify_admin/user_profile_xi',$data);
		}
	}

	public function viewdata_xi($id){
	    $user_id = $this->session->userdata('user_id');
		$employee = $this->sumit->fetchSingleData('id','employee',array('EMPID'=>$user_id));
		$login_data = $this->sumit->fetchSingleData('username,user_id','login_details',array('user_id'=>$user_id));
		$data['employeeData'] = $this->sumit->getSingleEmployee($employee['id']);
		$fetchtempdata = $this->Gautam->fetchtempdata();
	
		$stuData = $this->alam->selectA('class_xi_reg',"*","ID='$id'");
		
		$data=array('login_data'=>$login_data,'temp_data'=>$stuData);
		$this->render_template('cbse_verify_admin/user_profile_xi',$data);
	}

	public function Print_user_profile($id){
	    $user_id = $this->session->userdata('user_id');
		$employee = $this->sumit->fetchSingleData('id','employee',array('EMPID'=>$user_id));
		$login_data = $this->sumit->fetchSingleData('username,user_id','login_details',array('user_id'=>$user_id));
		$data['employeeData'] = $this->sumit->getSingleEmployee($employee['id']);
		$fetchtempdata = $this->Gautam->fetchtempdata();
	
		$stuData = $this->alam->selectA('temp_cbse_reg',"*,(select SECTION_NAME from sections where section_no=temp_cbse_reg.sec)secnm","id='$id'");
		
		$data=array('login_data'=>$login_data,'temp_data'=>$stuData);
		
		$this->load->view('cbse_verify_admin/Print_user_profile',$data);
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'portrait');
		$this->dompdf->render();
		$this->dompdf->stream("student_proflile.pdf", array("Attachment"=>0));
	}

	public function Print_user_profile_xi($id){
	    $user_id = $this->session->userdata('user_id');
	
	
	
		$employee = $this->sumit->fetchSingleData('id','employee',array('EMPID'=>$user_id));
		$login_data = $this->sumit->fetchSingleData('username,user_id','login_details',array('user_id'=>$user_id));
		$data['employeeData'] = $this->sumit->getSingleEmployee($employee['id']);
		$fetchtempdata = $this->Gautam->fetchtempdata();
	
		$stuData = $this->alam->selectA('temp_cbse_reg',"*,(select SECTION_NAME from sections where section_no=temp_cbse_reg.sec)sec_nm,(select SUBJECT1 from student where ADM_NO=temp_cbse_reg.admission_no)SUBJECT1,(select SUBJECT2 from student where ADM_NO=temp_cbse_reg.admission_no)SUBJECT2,(select SUBJECT3 from student where ADM_NO=temp_cbse_reg.admission_no)SUBJECT3,(select SUBJECT4 from student where ADM_NO=temp_cbse_reg.admission_no)SUBJECT4,(select SUBJECT5 from student where ADM_NO=temp_cbse_reg.admission_no)SUBJECT5","id='$id'");
		$data=array('login_data'=>$login_data,'temp_data'=>$stuData);
		
		$this->load->view('cbse_verify_admin/Print_user_profile_xi',$data);
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'portrait');
		$this->dompdf->render();
		$this->dompdf->stream("student_proflile.pdf", array("Attachment"=>0));
	}

	public function ReportStuData(){
	 
		$val = date('Y-m-d',strtotime($this->input->post('value')));
		$class = $this->input->post('class');
		$data['valdate'] = date('Y-m-d',strtotime($this->input->post('value')));
		$data['ReportData'] = $this->alam->selectA('temp_cbse_reg','*,(select SECTION_NAME from sections where section_no=temp_cbse_reg.sec)sec_nm,(select SUBJECT1 from student where ADM_NO=temp_cbse_reg.admission_no)SUBJECT1,(select SUBJECT2 from student where ADM_NO=temp_cbse_reg.admission_no)SUBJECT2,(select SUBJECT3 from student where ADM_NO=temp_cbse_reg.admission_no)SUBJECT3,(select SUBJECT4 from student where ADM_NO=temp_cbse_reg.admission_no)SUBJECT4,(select SUBJECT5 from student where ADM_NO=temp_cbse_reg.admission_no)SUBJECT5',"date(date)='$val' AND class='$class'");
		
		if($class=="XI"){
			$this->load->view('cbse_verify_admin/loadEndDateReportWithDateRange',$data);	
		}else{
			$this->load->view('cbse_verify_admin/loadEndDateReportWithDateRange_IX',$data);
		}
	}
	
	public function ReportStuDateRange(){
		$class = $this->input->post('class');
		$start_date = date('Y-m-d',strtotime($this->input->post('start_date')));
		$data['start_date'] = date('Y-m-d',strtotime($this->input->post('start_date')));
		$end_date   = date('Y-m-d',strtotime($this->input->post('end_date')));
		$data['end_date']   = date('Y-m-d',strtotime($this->input->post('end_date')));
		$data['ReportData'] = $this->alam->selectA('temp_cbse_reg','*,(select SECTION_NAME from sections where section_no=temp_cbse_reg.sec)sec_nm,(select SUBJECT1 from student where ADM_NO=temp_cbse_reg.admission_no)SUBJECT1,(select SUBJECT2 from student where ADM_NO=temp_cbse_reg.admission_no)SUBJECT2,(select SUBJECT3 from student where ADM_NO=temp_cbse_reg.admission_no)SUBJECT3,(select SUBJECT4 from student where ADM_NO=temp_cbse_reg.admission_no)SUBJECT4,(select SUBJECT5 from student where ADM_NO=temp_cbse_reg.admission_no)SUBJECT5',"date(date) BETWEEN '$start_date' AND '$end_date' AND class='$class'");
		
		if($class=="XI"){
			$this->load->view('cbse_verify_admin/loadEndDateReportWithDateRange',$data);	
		}else{
			$this->load->view('cbse_verify_admin/loadEndDateReportWithDateRange_IX',$data);
		}
	}
	
	public function ReportStuDateRangeStatus(){
		$class = $this->input->post('class');
		$start_date      = date('Y-m-d',strtotime($this->input->post('start_date')));
		$data['start_date']      = date('Y-m-d',strtotime($this->input->post('start_date')));
		$end_date        = date('Y-m-d',strtotime($this->input->post('end_date')));
		$data['end_date']        = date('Y-m-d',strtotime($this->input->post('end_date')));
		$verified_status = $this->input->post('verified_status');
		$chkverified_status = $verified_status;
		
		if($chkverified_status == 0){
			$data['verify'] = 'NOT VERIFIED';
		}else{
			$data['verify'] = 'VERIFIED';
		}
		
		$data['ReportData'] = $this->alam->selectA('temp_cbse_reg','*,(select SECTION_NAME from sections where section_no=temp_cbse_reg.sec)sec_nm,(select SUBJECT1 from student where ADM_NO=temp_cbse_reg.admission_no)SUBJECT1,(select SUBJECT2 from student where ADM_NO=temp_cbse_reg.admission_no)SUBJECT2,(select SUBJECT3 from student where ADM_NO=temp_cbse_reg.admission_no)SUBJECT3,(select SUBJECT4 from student where ADM_NO=temp_cbse_reg.admission_no)SUBJECT4,(select SUBJECT5 from student where ADM_NO=temp_cbse_reg.admission_no)SUBJECT5',"date(date) BETWEEN '$start_date' AND '$end_date' AND verify='$verified_status' AND class='$class'");
		
		if($class=="XI"){
			$this->load->view('cbse_verify_admin/loadEndDateReportWithDateRange',$data);	
		}else{
			$this->load->view('cbse_verify_admin/loadEndDateReportWithDateRange_IX',$data);
		}
	}

}
