<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Payment_x extends My_controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Alam', 'alam');
		$this->load->library('Alam_custom', 'alam_custom');
		// require_once(APPPATH . 'controllers/parent_dashboard/Cbse_Reg/payment_new/GetePayInvoicePg.php');
		require_once 'GetePayInvoicePg.php';
		$this->testObject = new GetePayInvoicePg();
	}

	public function index()
	{
		$generate_session = $this->session->userdata('generate_session', $session);
		// echo'<pre>'; print_r($generate_session);die;
		$regid         = $generate_session['id'];
		$amt           = ($generate_session['fee_amt'] + $generate_session['fee_amt_service']);
		//$clientCode    = $generate_session['adm'].'-'.$generate_session['class'].'-'.$generate_session['disp_sec'];
		$transId = strtotime('now') . rand(0, 1000000);

		$updTrans = array(
			'Transaction_ID' => $transId
		);
		$this->alam->update("cbse_reg_amount", $updTrans, "id='" . $generate_session['id'] . "'");
		// echo $this->db->last_query();die;

		$mobData = $this->alam->selectA('cbse_reg_amount', 'AdmNo,Class_Sec,Transaction_ID,(SELECT P_MOBILE  FROM student WHERE student.ADM_NO=cbse_reg_amount.AdmNo)as mobile ', "id='" . $generate_session['id'] . "'");
		// echo '<pre>'; print_r($generate_session); echo '</pre>';die;

		$admno = $mobData[0]['AdmNo'];
		$cls = $mobData[0]['Class_Sec'];
		$mobile = $mobData[0]['mobile'];
		$transaction_ID = $mobData[0]['Transaction_ID'];

		$clientCode    = $admno . '-' . $cls;
		$emaill  = (!empty($mobData[0]['email'])) ? $mobData[0]['email'] : 'jvmfee@gmail.com';
		// $env = "live";
		// $login = "58016";
		// $pwd = "VIDYA@123";
		$product = "REGISTRATION";
		// $curr = "INR";
		$name = $generate_session['name'];
		$email = $emaill;
		//$mobile = "8789264410";
		$address = "Ranchi";
		// $acc = "639827";
		// $reqHashKey = "816e2e1f6ec25d7e7c";
		//` $returnurl = base_url('parent_dashboard/Cbse_Reg/payment_new/Response');

		$redirect_url = base_url('parent_dashboard/Cbse_Reg/payment_new/Payment_x/redirect_payment_new');

		// echo $clientCode;die;

		$this->testObject->getpay_request($clientCode, $mobile, $amt, $name, $address, $emaill, $product, $transId, $redirect_url);


		// $this->testObject->atom_request($transId, $env, $login, $pwd, $product, $amt, $curr, $redirect_url, $clientCode, $name, $email, $mobile, $address, $acc, $reqHashKey);
	}


	public function redirect_payment_new()
	{
		//response hash key which is changed from user dashboard code
		// echo "hio0";die; 
		$key = base64_decode("dQRs2XE6Q08LuPuoY2LEMQsOymFjZSJ5L1u230tceEw=");
		$iv = base64_decode("PMSpHxw1jIncUd84X3tX1g==");

		$result = $_POST['response'];
		$ciphertext_raw = hex2bin($result);
		$original_plaintext = openssl_decrypt($ciphertext_raw,  "AES-256-CBC", $key, $options = OPENSSL_RAW_DATA, $iv);
		$json = json_decode($original_plaintext);
		$json_array = json_decode($json, true);
		 //echo '<pre>';
		 //print_r($json_array);
		// die;
		if (!empty($json)) {

			if ($json_array['txnStatus'] == 'SUCCESS') {

				$updData = array(
					'Atom_Transaction_ID'     			 => $json_array['getepayTxnId'],
					// 'transaction_id'         => $json_array['mer_txn'],
					'extra1'         			 => $json_array['txnAmount'],
					'F_Code'      			 => $json_array['txnStatus'],
					// 'bank_name'   			 => $json_array['bank_name'],
					// 'auth_code'   			 => $json_array['auth_code'],
					//'ipg_txn_id'  			 => $json_array['getepayTxnId'],
					'Bank_Name' 			 => $json_array['merchantOrderNo'],
					'Payment_Mode'  			 => $json_array['paymentMode'],
					'Response_Received' => date('Y-m-d H:i:s')
				);
				$trid = $json_array['merchantOrderNo'];
				$nurd = $this->alam->selectA("cbse_reg_amount", 'id', "Transaction_ID='$trid'");
				// echo $this->db->last_query();die;

				if (sizeof($nurd) != 0) {
					$session = array(
						'id' => $nurd[0]['id'],
					);
					$this->session->set_userdata('generate_session', $session);
					$generate_session = $this->session->userdata('generate_session');
				} else {
					$session = array(
						'id' => 0
					);
					$this->session->set_userdata('generate_session', $session);
					$generate_session = $this->session->userdata('generate_session');
				}
				$this->alam->update("cbse_reg_amount", $updData, "id='" . $generate_session['id'] . "'");
				// echo $this->db->last_query();die;

				//$link = base_url('parent_dashboard/Cbse_Reg/Gautam/cbse_registration');
				// $link = base_url('parent_dashboard/cbse_reg_fee/Cbse_fee/Print_user_profile_x_xii/' . $generate_session['id']);
				$link = base_url('parent_dashboard/Cbse_Reg/Gautam/Print_user_profile_x/' . $generate_session['id']);

				//echo $link;die;
				echo "<center><h3>Payment Successfully Completed..<a href='" . $link . "'>Click For Print</a></h3></center>";
			} else {

				$data['school_setting'] = $this->alam->select('school_setting', '*');
				$data['school_photo'] = $this->alam->select('school_photo', '*');
				$updData = array(
					'mmp_txn'     			 => $json_array['getepayTxnId'],
					// 'transaction_id'         => $json_array['mer_txn'],
					'amt'         			 => $json_array['txnAmount'],
					'bank_txn'    			 => $json_array['getepayTxnId'],
					'f_code'      			 => $json_array['txnStatus'],
					// 'bank_name'   			 => $json_array['bank_name'],
					// 'auth_code'   			 => $json_array['auth_code'],
					'ipg_txn_id'  			 => $json_array['getepayTxnId'],
					'merchant_id' 			 => $json_array['1726664970602149'],
					'desc'        			 => $json_array['txnNote'],
					'CardNumber'  			 => $json_array['paymentMode'],
					'response_received_time' => date('Y-m-d H:i:s')
				);
				$trid = $json_array['getepayTxnId'];
				$nurd = $this->alam->selectA("temp_cbse_reg", 'id,mobile', "transaction_id='$trid'");
				if (sizeof($nurd) != 0) {
					$session = array(
						'id' => $nurd[0]['id'],
						'mobile' => $nurd[0]['mobile']
					);
					$this->session->set_userdata('generate_session', $session);
					$generate_session = $this->session->userdata('generate_session');
				} else {
					$session = array(
						'id' => generate_session['id'],
						'mobile' => 000000000
					);
					$this->session->set_userdata('generate_session', $session);
					$generate_session = $this->session->userdata('generate_session');
				}

				$this->alam->update("cbse_reg_amount", $updData, "id='" . $generate_session['id'] . "'");

				// $data['allData'] = $this->alam->selectA('temp_cbse_reg','*',"id='".$generate_session['id']."'");

				// $transaction_id = $data['allData'][0]['transaction_id'];
				// $set_amt        = $data['allData'][0]['set_amt'];


				// $this->load->view('nur_adm/payment_failed',$data);
				echo "<h3>Transaction failed </h3>";
			}
		} else {

			echo 'abxb'; /// remmmm
		}
	}


	public function redirect_payment()
	{
		//response hash key which is changed from user dashboard code

		$responseHashKey = "dae00acc31be39d9b5";
		$paymentResponse = $this->testObject->atomResponse($responseHashKey);
		if (is_array($paymentResponse)) {
			if (strtolower($paymentResponse['f_code']) == 'ok') {

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
				$trid = $paymentResponse['mer_txn'];
				$nurd = $this->alam->selectA("temp_cbse_reg", 'id,mobile', "transaction_id='$trid'");
				if (sizeof($nurd) != 0) {
					$session = array(
						'id' => $nurd[0]['id'],
						'mobile' => $nurd[0]['mobile']
					);
					$this->session->set_userdata('generate_session', $session);
					$generate_session = $this->session->userdata('generate_session');
				} else {
					$session = array(
						'id' => 0,
						'mobile' => 000000000
					);
					$this->session->set_userdata('generate_session', $session);
					$generate_session = $this->session->userdata('generate_session');
				}
				$this->alam->update("temp_cbse_reg", $updData, "id='" . $generate_session['id'] . "'");

				$link = base_url('parent_dashboard/Cbse_Reg/Gautam/cbse_registration');
				echo "<center><h3>Payment Successfully Completed..<a href=" . $link . ">Click For Print</a></h3></center>";
			} else {
				$data['school_setting'] = $this->alam->select('school_setting', '*');
				$data['school_photo'] = $this->alam->select('school_photo', '*');


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
				$trid = $paymentResponse['mer_txn'];
				$nurd = $this->alam->selectA("temp_cbse_reg", 'id,mobile', "transaction_id='$trid'");
				if (sizeof($nurd) != 0) {
					$session = array(
						'id' => $nurd[0]['id'],
						'mobile' => $nurd[0]['mobile']
					);
					$this->session->set_userdata('generate_session', $session);
					$generate_session = $this->session->userdata('generate_session');
				} else {
					$session = array(
						'id' => generate_session['id'],
						'mobile' => 000000000
					);
					$this->session->set_userdata('generate_session', $session);
					$generate_session = $this->session->userdata('generate_session');
				}

				$this->alam->update("temp_cbse_reg", $updData, "id='" . $generate_session['id'] . "'");

				// $data['allData'] = $this->alam->selectA('temp_cbse_reg','*',"id='".$generate_session['id']."'");

				// $transaction_id = $data['allData'][0]['transaction_id'];
				// $set_amt        = $data['allData'][0]['set_amt'];


				// $this->load->view('nur_adm/payment_failed',$data);
				echo "<h3>Transaction failed </h3>";
			}
		}
	}
}
