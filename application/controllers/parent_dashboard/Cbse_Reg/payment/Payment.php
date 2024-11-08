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
		$regid  = (int)$this->session->userdata('token_no');
		//$reg_amt     = $this->session->userdata('fee_amt');
		//$conv_amt    = $this->session->userdata('conven_amt');
		$reg_amt     = '300';
		$conv_amt    = '100';
		$amt = $reg_amt+$conv_amt;
		
		$transId = strtotime('now').rand(0,1000);
		$transId = $transId.'11';
		
		$updTrans = array(
			'transaction_id' => $transId
		);
		
		$this->dbcon->update("class_xi_reg",$updTrans,"ID='$regid'");
		
		
		$env = "live";
		$login = "58016";
		$pwd = "VIDYA@123";
		$product = "REGISTRATION";
		$curr = "INR";
		$name = $this->session->userdata('stu_name');
		$email = $this->session->userdata('email');
		$mobile = $this->session->userdata('f_mob');
		$address = "Ranchi";
		$acc = "639827";
		$reqHashKey = "816e2e1f6ec25d7e7c";
		
		$clientCode         = $this->session->userdata('token').'_'.$this->session->userdata('adm_no').'_'.$this->session->userdata('sec');
		$transLog = array(
			'ClientCode' => $clientCode,
			'MerchantTxnID' => $transId,
			'Amount' => $amt
		);
		$this->dbcon->insert('xi_payment_log_2020',$transLog);
	    $this->session->set_userdata('reg_id',$regid);
		$redirect_url = base_url('parent_dashboard/Cbse_reg/payment/Payment/redirect_payment');
		$this->testObject->atom_request($transId, $env, $login, $pwd, $product, $amt, $curr, $redirect_url, $clientCode, $name, $email, $mobile, $address, $acc, $reqHashKey);
	}
	
	public function redirect_payment(){
		$regidd = $this->session->userdata('reg_id');
		$responseHashKey = "dae00acc31be39d9b5";
		$paymentResponse = $this->testObject->atomResponse($responseHashKey);
		if(is_array($paymentResponse)){
			if(strtolower($paymentResponse['f_code']) == 'ok' && $regidd != ''){
				$updData = array(
					'mmp_txn'     			 => $paymentResponse['mmp_txn'],
					//'transaction_id'         => $paymentResponse['mer_txn'],
					'amt'         			 => $paymentResponse['amt'],
					'bank_txn'    			 => $paymentResponse['bank_txn'],
					'f_code'      			 => $paymentResponse['f_code'],
					'bank_name'   			 => $paymentResponse['bank_name'],
					'auth_code'   			 => $paymentResponse['auth_code'],
					'ipg_txn_id'  			 => $paymentResponse['ipg_txn_id'],
					'merchant_id' 			 => $paymentResponse['merchant_id'],
					'desc'        			 => $paymentResponse['desc'],
					'CardNumber'  			 => $paymentResponse['CardNumber'],
					'response_received_time' => date('Y-m-d H:i:s')
				);
				$this->dbcon->update("class_xi_reg",$updData,"ID='$regidd'");
				redirect('parent_dashboard/Cbse_Reg/gautam/Print_user_profile_xi/'.$regidd);
				
			}else{
				$updData = array(
					'mmp_txn'     			 => $paymentResponse['mmp_txn'],
					//'transaction_id'         => $paymentResponse['mer_txn'],
					'amt'         			 => $paymentResponse['amt'],
					'bank_txn'    			 => $paymentResponse['bank_txn'],
					'f_code'      			 => $paymentResponse['f_code'],
					'bank_name'   			 => $paymentResponse['bank_name'],
					//'auth_code'   			 => $paymentResponse['auth_code'],
					//'ipg_txn_id'  			 => $paymentResponse['ipg_txn_id'],
					'merchant_id' 			 => $paymentResponse['merchant_id'],
					'desc'        			 => $paymentResponse['desc'],
					//'CardNumber'  			 => $paymentResponse['CardNumber'],
					'response_received_time' => date('Y-m-d H:i:s')
				);
				
				
				$this->dbcon->update("class_xi_reg",$updData,"ID='$regidd'");
				$data['allData'] = $this->dbcon->selectA('class_xi_reg','*',"ID='$regidd'");
				
				$transaction_id = $data['allData'][0]['transaction_id'];
				$set_amt        = $data['allData'][0]['fee_amt'];
				
				$data['allData'] = $this->dbcon->selectA('class_xi_reg','*',"ID='$regidd'");
				
				$this->load->view('parents_dashboard/Cbse_Reg/payment/payment_failed',$data);
			}
			
			$transLog = array(
				'MerchantTxnID'  => $paymentResponse['mer_txn'],
				'AtomTxnID'      => $paymentResponse['bank_txn'],
				'Amount_receive' => $paymentResponse['amt'],
				'BankName'       => $paymentResponse['bank_name'],
				'TxnStatus'      => $paymentResponse['f_code'],
				//'CardNumber'     => ($paymentResponse['CardNumber']!='')?$paymentResponse['CardNumber']:'',
				'Description'    => $paymentResponse['desc'],
				'resp_rece_date' => date('Y-m-d H:i:s')
			);
			$this->dbcon->update('xi_payment_log_2020',$transLog,"MerchantTxnID='".$paymentResponse['mer_txn']."'");
		}
	}
}