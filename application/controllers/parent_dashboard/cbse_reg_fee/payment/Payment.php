<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_controller{
	public function __construct(){
		parent ::__construct();
		$this->load->model('Mymodel','dbcon');
		require_once 'Atompay.php';
		$this->testObject = new Atompay();
		error_reporting(0);
	}
	
	public function index(){
		$admno  =$this->session->userdata('adm');
		
		
		$transId = strtotime('now').rand(0,1000);
		$transId = $transId.'11';
		
		$updTrans = array(
			'Transaction_ID' => $transId
		);
		
			$cnfif=$this->dbcon->select("cbse_reg_amount",'id',"AdmNo='$admno' AND Status='Success'");
		$cnfif_log=$this->dbcon->select("cbse_reg_amount_log",'id',"AdmNo='$admno' AND F_Code='Ok'");
		
		if(sizeof($cnfif) !=0 || sizeof($cnfif_log) !=0){
		echo"<center><h3>Sorry you have already paid Fee.</h3></center>";
			die;
		}
		
		$this->dbcon->update("cbse_reg_amount",$updTrans,"AdmNo='$admno'");
		$stu_details_student=$this->dbcon->select("student",'C_EMAIL,C_MOBILE',"ADM_NO='$admno'");
		$stu_details_reg=$this->dbcon->select("cbse_reg_amount",'*',"AdmNo='$admno'");
		$env = "live";
		$login = "58016";
		$pwd = "VIDYA@123";
		$product = "REGISTRATION";
		$curr = "INR";
		$name = $stu_details_reg[0]->SName;
		$clssec = $stu_details_reg[0]->Class_Sec;
		$amt = $stu_details_reg[0]->Total;
		$email = $stu_details_student->C_EMAIL;
		$mobile = $stu_details_student->C_MOBILE;
		$clientCode=$admno.'-'.$clssec;
		$address = "Ranchi";
		$acc = "639827";
		$reqHashKey = "816e2e1f6ec25d7e7c";
		$this->session->set_userdata('reg_id',$admno);
		$redirect_url = base_url('parent_dashboard/Cbse_reg_fee/payment/Payment/redirect_payment');
		$this->testObject->atom_request($transId, $env, $login, $pwd, $product, $amt, $curr, $redirect_url, $clientCode, $name, $email, $mobile, $address, $acc, $reqHashKey);
	}
	
	public function redirect_payment(){
		//$regidd = $this->session->userdata('reg_id');
		$responseHashKey = "dae00acc31be39d9b5";
		$paymentResponse = $this->testObject->atomResponse($responseHashKey);
		if(is_array($paymentResponse)){
			$order_id=$paymentResponse['mer_txn'];
			
			$data_stu=$this->dbcon->select("cbse_reg_amount",'AdmNo,Class_Sec,id',"Transaction_ID='$order_id'");
			$max_r=$this->dbcon->select("cbse_reg_amount",'max(extra1)cntt',"1='1'");
				$updData1 = array(
					'AdmNo'=>$data_stu[0]->AdmNo,
					'Class_Sec'=>$data_stu[0]->Class_Sec,
					'Atom_Transaction_ID'     			 => $paymentResponse['mmp_txn'],
					'Transaction_ID'  => $paymentResponse['mer_txn'],
					'amt'         			 => $paymentResponse['amt'],
					//'bank_txn'    			 => $paymentResponse['bank_txn'],
					'F_Code'      			 => $paymentResponse['f_code'],
					'Bank_Name'   			 => $paymentResponse['bank_name'],
					//'auth_code'   			 => $paymentResponse['auth_code'],
					//'ipg_txn_id'  			 => $paymentResponse['ipg_txn_id'],
					//'merchant_id' 			 => $paymentResponse['merchant_id'],
					//'desc'        			 => $paymentResponse['desc'],
					//'CardNumber'  			 => $paymentResponse['CardNumber'],
				
					'Status'=>'',
					'Pay_Date' => date('Y-m-d H:i:s')
				);
				$this->dbcon->insert("cbse_reg_amount_log",$updData1);
			
			if(strtolower($paymentResponse['f_code']) == 'ok'){
				$recpt=$max_r[0]->cntt+1;
				$recpt='CBSE'.str_pad($recpt, 4, '0', STR_PAD_LEFT);
				$updData = array(
					'Atom_Transaction_ID'     			 => $paymentResponse['mmp_txn'],
					//'transaction_id'         => $paymentResponse['mer_txn'],
					//'amt'         			 => $paymentResponse['amt'],
					//'bank_txn'    			 => $paymentResponse['bank_txn'],
					'F_Code'      			 => $paymentResponse['f_code'],
					'Receipt_No'      			 => $recpt,
					'Bank_Name'   			 => $paymentResponse['bank_name'],
					//'auth_code'   			 => $paymentResponse['auth_code'],
					//'ipg_txn_id'  			 => $paymentResponse['ipg_txn_id'],
					//'merchant_id' 			 => $paymentResponse['merchant_id'],
					//'desc'        			 => $paymentResponse['desc'],
					//'CardNumber'  			 => $paymentResponse['CardNumber'],
					'Payment_Mode'=>'ONLINE',
					'Status'=>'Success',
					'Pay_Date' => date('Y-m-d H:i:s')
				);
				$this->dbcon->update("cbse_reg_amount",$updData,"Transaction_ID='$order_id'");
				
				$_SESSION['iide']=$data_stu[0]->id;
				redirect('parent_dashboard/cbse_reg_fee/Cbse_fee/Print_user_profile_x_xii');
				
			}else{
				$_SESSION['iide']=$data_stu[0]->id;
			
			redirect('parent_dashboard/cbse_reg_fee/Cbse_fee/Print_user_profile_x_xii');
				
				
			}
			
		
		}
	}
}