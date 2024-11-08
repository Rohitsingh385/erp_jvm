<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Online_paymentcal extends MY_Controller{
	public function __construct(){     
		parent:: __construct();
	    $this->load->model('Farheen','farheen');
	}
	public function show_student()
	{
		
		$adm_no=$this->session->userdata('adm');
		$student_data = $this->farheen->select('student','*',"ADM_NO='$adm_no'");
		$chkpay = $this->farheen->select('online_transaction','order_status',"ADM_NO='$adm_no' AND order_status='Success'");
		
		$this->session->set_userdata('billing_name',$student_data[0]->FIRST_NM);
		$this->session->set_userdata('billing_address',$student_data[0]->CORR_ADD);
		$this->session->set_userdata('billing_city',$student_data[0]->C_CITY);
		$this->session->set_userdata('billing_state',$student_data[0]->C_STATE);
		$this->session->set_userdata('billing_zip',$student_data[0]->C_PIN);
		$this->session->set_userdata('billing_country',$student_data[0]->C_NATION);
		$this->session->set_userdata('billing_tel',$student_data[0]->C_MOBILE);
		$this->session->set_userdata('billing_email',$student_data[0]->C_EMAIL);
	    $session 	  = $this->farheen->select('session_master','*',"Active_Status='1'");
		$payment_mode = $this->farheen->select('payment_mode','*');
		$bank		  = $this->farheen->select('bank_master','*');
		$ward_emp=$student_data[0]->EMP_WARD;
		if($ward_emp==1){
		$wardnm='AMOUNT';
		}elseif($ward_emp==2){
		$wardnm='EMP';
		}
		elseif($ward_emp==3){
		$wardnm='CCL';
		}
		elseif($ward_emp==4){
		$wardnm='SPL';
		}
		elseif($ward_emp==5){
		$wardnm='EXT';
		}
		elseif($ward_emp==6){
		$wardnm='INTERNAL';
		}
		$class=$student_data[0]->CLASS;
		
		$amot = $this->farheen->select('fee_clw',"$wardnm","fh='6' AND cl='$class'");
		$amt=$amot[0]->$wardnm;
		
		$this->session->set_userdata('total_amountt',$amt);
		
		$array = array(
				'student_details' => $student_data,
				'amount'=>$amt,
			'chk_pay'=>$chkpay
					);
			$this->Parent_templete('parents_dashboard/onpay_details',$array);
		}
	
	public function payment()
	{
		
		$adm_no = $this->session->userdata('adm');
		$this->session->set_userdata('merchant_id','338590');
		$this->session->set_userdata('currency','INR');
		$this->session->set_userdata('ffms','COMPUTER FEE');
		$this->session->set_userdata('redirect_url','http://micaeduco.co.in/erp/Onparent_details/respon');
		$this->session->set_userdata('cancel_url','http://micaeduco.co.in/erp/Onparent_details/pay_details');
		$this->session->set_userdata('language','EN');
		$tid = strtotime('now').rand(0,1000);
		$this->session->set_userdata('tid',$tid);
		//$adm_no = $this->session->userdata('adm_no');
		$data['tid'] = $this->session->userdata('tid');
		$data['adm_no'] = $this->session->userdata('adm');
		$data['total_amountt'] = $this->session->userdata('total_amountt');
		$data['merchant_id'] = $this->session->userdata('merchant_id');
		$data['currency'] = $this->session->userdata('currency');
		$data['redirect_url'] = $this->session->userdata('redirect_url');
		$data['cancel_url'] = $this->session->userdata('cancel_url');
		$data['billing_name'] = $this->session->userdata('billing_name');
		$data['billing_address'] = $this->session->userdata('billing_address');
		$data['billing_city'] = $this->session->userdata('billing_city');
		$data['billing_state'] = $this->session->userdata('billing_state');
		$data['billing_zip'] = $this->session->userdata('billing_zip');
		$data['billing_country'] = $this->session->userdata('billing_country');
		$data['billing_tel'] = $this->session->userdata('billing_tel');
		if($this->session->userdata('billing_email') !='N/A'){
		$data['billing_email'] = $this->session->userdata('billing_email');
		}
		
		 $stu_detail = $this->db->query("select * from student where ADM_NO='$adm_no' and Student_Status='ACTIVE' AND MAR_ATT='0'")->result();
		if(sizeof($stu_detail) !=0){
		$today_date = date('Y-m-d H:i:s');
		$ins_data = array(
			'order_id' => $tid,
			'merchant_id' => $data['merchant_id'],
			'pay_amount' => $data['total_amountt'],
			'trans_date' => $today_date,
			'payment_status' => 'req_sent',
			'STU_NAME' => $stu_detail[0]->FIRST_NM.' '.$stu_detail[0]->MIDDLE_NM,
			'STUDENTID' => $stu_detail[0]->STUDENTID,
			'ADM_NO' => $adm_no,
			'CLASS' => $stu_detail[0]->DISP_CLASS,
			'SEC' => $stu_detail[0]->DISP_SEC,
			'ROLL_NO' => $stu_detail[0]->ROLL_NO,
			'PERIOD' => 'COMPUTER FEE',
			'TOTAL' => $data['total_amountt'],
			'fee1' => 0,
			'fee2' => 0,
			'fee3' => 0,
			'fee4' => 0,
			'fee5' => 0,
			'fee6' => $data['total_amountt'],
			'fee7' => 0,
			'fee8' => 0,
			'fee9' => 0,
			'fee10' => 0,
			'fee11' => 0,
			'fee12' => 0,
			'fee13' => 0,
			'fee14' => 0,
			'fee15' => 0,
			'fee16' => 0,
			'fee17' => 0,
			'fee18' => 0,
			'fee19' => 0,
			'fee20' => 0,
			'fee21' => 0,
			'fee22' => 0,
			'fee23' => 0,
			'fee24' => 0,
			'fee25' => 0,
			'Session_Year'=>2020,
		    'Collection_Mode' => 3,
			'Payment_Mode' => 'ONLINE',
			'Bank_Name' => 'CC Avenue',
            'User_Id'         => $adm_no,
             'CHQ_NO' => $tid,
             'Narr' => 'N/A',
             'TAmt' => 0,
             'Fee_Book_No' => 0,
			);
		
		$this->farheen->insert('online_transaction',$ins_data);
		$this->Parent_templete('paykit/ccavRequestHandler');
		}else{
		echo "<center><h1>Already paid</h1></center>";
		}
	}
}