<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Monthly_payment extends MY_controller{
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	    $this->load->model('Mymodel','dbcon');
	}
	public function monthly_pay_details()
	{
		$adm_no    		= $this->input->post('adm_no');
		$ward_type 		= $this->input->post('ward_type');
		$bsn       		= $this->input->post('bsn');
		$bsa       		= $this->input->post('bsa');
		$ffm	   		= $this->input->post('ffm');
		$totalamount 	= $this->input->post('totalamount');
		$feehead1   	= $this->input->post('feehead1');
		$feehead2       = $this->input->post('feehead2');
		$feehead3		= $this->input->post('feehead3');
		$feehead4       = $this->input->post('feehead4');
		$feehead5		= $this->input->post('feehead5');
		$feehead6		= $this->input->post('feehead6');
		$feehead7		= $this->input->post('feehead7');
		$feehead8		= $this->input->post('feehead8');
		$feehead9		= $this->input->post('feehead9');
		$feehead10		= $this->input->post('feehead10');
		$feehead11		= $this->input->post('feehead11');
		$feehead12		= $this->input->post('feehead12');
		$feehead13		= $this->input->post('feehead13');
		$feehead14		= $this->input->post('feehead14');
		$feehead15		= $this->input->post('feehead15');
		$feehead16		= $this->input->post('feehead16');
		$feehead17		= $this->input->post('feehead17');
		$feehead18		= $this->input->post('feehead18');
		$feehead19		= $this->input->post('feehead19');
		$feehead20		= $this->input->post('feehead20');
		$feehead21		= $this->input->post('feehead21');
		$feehead22		= $this->input->post('feehead22');
		$feehead23		= $this->input->post('feehead23');
		$feehead24		= $this->input->post('feehead24');
		$feehead25		= $this->input->post('feehead25');
		$pay_mod		= $this->input->post('pay_mod');
		$month[0] 	   	= $this->input->post('apr');
		$month[1]      	= $this->input->post('may');
		$month[2]       = $this->input->post('jun');
		$month[3]       = $this->input->post('jul');
		$month[4]       = $this->input->post('aug');
		$month[5]       = $this->input->post('sep');
		$month[6]       = $this->input->post('oct');
		$month[7]      	= $this->input->post('nov');
		$month[8]       = $this->input->post('dec');
		$month[9]       = $this->input->post('jan');
		$month[10]      = $this->input->post('feb');
		$month[11]      = $this->input->post('mar');
		// student details //
		$student_details = $this->dbcon->select('student','*',"ADM_NO='$adm_no'");
		@$stu_name  = $student_details[0]->FIRST_NM;
		@$STUDENTID = $student_details[0]->STUDENTID;
		@$stu_class = $student_details[0]->DISP_CLASS;
		@$stu_sec   = $student_details[0]->DISP_SEC;
		@$ROLL_NO   = $student_details[0]->ROLL_NO;
		@$MON_FEE[0]   = $student_details[0]->APR_FEE;
		@$MON_FEE[1]   = $student_details[0]->MAY_FEE;
		@$MON_FEE[2]   = $student_details[0]->JUNE_FEE;
		@$MON_FEE[3]   = $student_details[0]->JULY_FEE;
		@$MON_FEE[4]   = $student_details[0]->AUG_FEE;
		@$MON_FEE[5]   = $student_details[0]->SEP_FEE;
		@$MON_FEE[6]   = $student_details[0]->OCT_FEE;
		@$MON_FEE[7]   = $student_details[0]->NOV_FEE;
		@$MON_FEE[8]   = $student_details[0]->DEC_FEE;
		@$MON_FEE[9]   = $student_details[0]->JAN_FEE;
		@$MON_FEE[10]   = $student_details[0]->FEB_FEE;
		@$MON_FEE[11]   = $student_details[0]->MAR_FEE;
		// student details fetching done //
		
		// getting current session year details //
		 $session_master = $this->dbcon->select('session_master','*',"Active_Status='1'");
		 $Session_Year = $session_master[0]->Session_Year;
		// end of fetching current session year //
		
		if($pay_mod=='CASH')
		 {
		 	$chqcard = "N/A";
		 	$bank_details = "N/A";
		 }
		 elseif($pay_mod=='CARD SWAP')
		 {
		 	$chqcard = $this->input->post('card_name');
		 	$bank_details = $this->input->post('bank_name');
		 }
		 elseif($pay_mod=='CHEQUE')
		 {
		 	$chqcard = $this->input->post('chque_name');
		 	$bank_details = $this->input->post('bank_name');
		 }
		 else
		 {

		 }
		 $User_Id = $this->session->userdata('user_id');
		 $master = $this->dbcon->select('master','*',"User_ID='$User_Id' AND Collection_Type='1'");
		 $CounterNo = $master[0]->CounterNo;
		 $recptNumeric = $this->dbcon->recpt_numeric_Details($CounterNo);
		 $increase_part = $recptNumeric[0]->MAX_NUMBER;
		 $increase_part = sprintf("%06d", $increase_part);
		 $rcpt_no = $CounterNo.$increase_part;
		 
		 foreach($month as $key=>$value){
			if(!empty($value)){
				$recpt_daycoll[] = $rcpt_no;
				$stu_recpt[] = $rcpt_no;
			}else{
				$recpt_daycoll[] = 'N/A';
				$stu_recpt[] = $MON_FEE[$key];
			}
		}
		$data = array(
				'APR_FEE' => $stu_recpt[0],
				'MAY_FEE' => $stu_recpt[1],
				'JUNE_FEE' => $stu_recpt[2],
				'JULY_FEE' => $stu_recpt[3],
				'AUG_FEE' => $stu_recpt[4],
				'SEP_FEE' => $stu_recpt[5],
				'OCT_FEE' => $stu_recpt[6],
				'NOV_FEE' => $stu_recpt[7],
				'DEC_FEE' => $stu_recpt[8],
				'JAN_FEE' => $stu_recpt[9],
				'FEB_FEE' => $stu_recpt[10],
				'MAR_FEE' => $stu_recpt[11]
			);
		
		$daycall = array(
			'RECT_NO'         => $rcpt_no,
			'RECT_DATE'       => date("Y-m-d"),
			'STU_NAME'        => $stu_name,
			'STUDENTID'       => $STUDENTID,
			'ADM_NO'          => $adm_no,
			'CLASS'           => $stu_class,
			'SEC'		      => $stu_sec,
			'ROLL_NO'         => $ROLL_NO,
			'PERIOD'          => $ffm,
			'TOTAL'           => $totalamount,
			'Fee1'            => $feehead1,
			'Fee2'            => $feehead2,
			'Fee3'            => $feehead3,
			'Fee4'		      => $feehead4,
			'Fee5'            => $feehead5,
			'Fee6'            => $feehead6,
			'Fee7'            => $feehead7,
			'Fee8'            => $feehead8,
			'Fee9'            => $feehead9,
			'Fee10'           => $feehead10,
			'Fee11'           => $feehead11,
			'Fee12'           => $feehead12,
			'Fee13'           => $feehead13,
			'Fee14'           => $feehead14,
			'Fee15'           => $feehead15,
			'Fee16'           => $feehead16,
			'Fee17'           => $feehead17,
			'Fee18'           => $feehead18,
			'Fee19'           => $feehead19,
			'Fee20'           => $feehead20,
			'Fee21'           => $feehead21,
			'Fee22'           => $feehead22,
			'Fee23'           => $feehead23,
			'Fee24'           => $feehead24,
			'Fee25'           => $feehead25,
			'APR_FEE'	      => $recpt_daycoll[0],
			'MAY_FEE'	      => $recpt_daycoll[1],
			'JUNE_FEE'	      => $recpt_daycoll[2],
			'JULY_FEE'	      => $recpt_daycoll[3],
			'AUG_FEE'	      => $recpt_daycoll[4],
			'SEP_FEE'         => $recpt_daycoll[5],
			'OCT_FEE'         => $recpt_daycoll[6],
			'NOV_FEE'         => $recpt_daycoll[7],
			'DEC_FEE'         => $recpt_daycoll[8],
			'JAN_FEE'         => $recpt_daycoll[9],
			'FEB_FEE'         => $recpt_daycoll[10],
			'MAR_FEE'         => $recpt_daycoll[11],
			'CHQ_NO'          => $chqcard,
			'Narr'            => "N/A",
			'TAmt'            => 0,
			'Fee_Book_No' 	  => "N/A",
			'Collection_Mode' => 1,
			'User_Id'         => $User_Id,
			'Payment_Mode'    => $pay_mod,
			'Bank_Name'       => $bank_details,
			'Pay_Date'        => date("Y-m-d"),
			'Session_Year'    => $Session_Year,
			'FORM_NO'    => 'N/A'
		);
		// echo "<pre>";
		// print_r($daycall);
		// print_r($data);
		// exit;
		if($this->dbcon->insert('daycoll',$daycall) && $this->dbcon->update('student',$data,"ADM_NO='$adm_no'"))
		{
			
		 	$school_details = $this->dbcon->select('school_setting','*');
		 	$receipt_details = $this->dbcon->select('daycoll','*',"RECT_NO='$rcpt_no'");
		 	$feehead1 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='1'");
			$feehead2 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='2'");
			$feehead3 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='3'");
			$feehead4 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='4'");
			$feehead5 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='5'");
			$feehead6 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='6'");
			$feehead7 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='7'");
			$feehead8 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='8'");
			$feehead9 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='9'");
			$feehead10 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='10'");
			$feehead11 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='11'");
			$feehead12 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='12'");
			$feehead13 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='13'");
			$feehead14 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='14'");
			$feehead15 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='15'");
			$feehead16 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='16'");
			$feehead17 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='17'");
			$feehead18 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='18'");
			$feehead19 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='19'");
			$feehead20 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='20'");
			$feehead21 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='21'");
			$feehead22 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='22'");
			$feehead23 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='23'");
			$feehead24 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='24'");
			$feehead25 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='25'");

		 	$report_data = array(
		 		'school_setting' => $school_details,
		 		'receipt_details' =>$receipt_details,
		 		'feehead1' => $feehead1,
				'feehead2' => $feehead2,
				'feehead3' => $feehead3,
				'feehead4' => $feehead4,
				'feehead5' => $feehead5,
				'feehead6' => $feehead6,
				'feehead7' => $feehead7,
				'feehead8' => $feehead8,
				'feehead9' => $feehead9,
				'feehead10' => $feehead10,
				'feehead11' => $feehead11,
				'feehead12' => $feehead12,
				'feehead13' => $feehead13,
				'feehead14' => $feehead14,
				'feehead15' => $feehead15,
				'feehead16' => $feehead16,
				'feehead17' => $feehead17,
				'feehead18' => $feehead18,
				'feehead19' => $feehead19,
				'feehead20' => $feehead20,
				'feehead21' => $feehead21,
				'feehead22' => $feehead22,
				'feehead23' => $feehead23,
				'feehead24' => $feehead24,
				'feehead25' => $feehead25,
				'student_details' => $student_details,
				'bsn'	    => $bsn
		 	);
		 	$this->load->view('Fee_collection/monthly_collection_online_report',$report_data);
		}
	}
}