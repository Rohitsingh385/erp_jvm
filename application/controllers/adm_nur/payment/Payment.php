<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends My_controller{
	public function __construct(){
		parent ::__construct();
		$this->load->model('Alam','alam');
		$this->load->library('Alam_custom','alam_custom');
		require_once 'Atompay.php';
		$this->testObject = new Atompay();
	}
	
	public function index(){
		$generate_session=$this->session->userdata('generate_session',$session);
		$regid         = $generate_session['id'];
		$amt           = $generate_session['set_amt'];
		$clientCode    = $generate_session['id'].'/2024';
		$transId = strtotime('now').rand(0,1000000);
		
		$updTrans = array(
			'transaction_id' => $transId
		);
		$this->alam->update("nursery_adm_data",$updTrans,"id='".$generate_session['id']."'");
		$mobData = $this->alam->selectA('nursery_adm_data','mobile,email',"id='".$generate_session['id']."'");
		$mobile = $mobData[0]['mobile'];
		$emaill  = (!empty($mobData[0]['email']))?$mobData[0]['email']:'jvmfee@gmail.com';
		$env = "live";
		$login = "58016";
		$pwd = "VIDYA@123";
		$product = "REGISTRATION";
		$curr = "INR";
		$name = "Nursery";
		$email = $emaill;
		//$mobile = "8789264410";
		$address = "ranchi";
		$acc = "639827";
		$reqHashKey = "816e2e1f6ec25d7e7c";
		
		$redirect_url = base_url('adm_nur/payment/Payment/redirect_payment');
		
		$this->testObject->atom_request($transId, $env, $login, $pwd, $product, $amt, $curr, $redirect_url, $clientCode, $name, $email, $mobile, $address, $acc, $reqHashKey);
		
	}
	
	public function redirect_payment(){
		//response hash key which is changed from user dashboard code
		$responseHashKey = "dae00acc31be39d9b5";
		$paymentResponse = $this->testObject->atomResponse($responseHashKey);
		if(is_array($paymentResponse)){
			if(strtolower($paymentResponse['f_code']) == 'ok'){
				
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
				$trid=$paymentResponse['mer_txn'];
				$nurd=$this->alam->selectA("nursery_adm_data",'id,mobile',"transaction_id='$trid'");
				if(sizeof($nurd)!=0){
					$session = array(
						'id' => $nurd[0]['id'],
						'mobile'=>$nurd[0]['mobile']
					);
					$this->session->set_userdata('generate_session',$session);
					$generate_session=$this->session->userdata('generate_session');
				}else{
					$session = array(
						'id' =>0,
						'mobile'=> 000000000
					);
					$this->session->set_userdata('generate_session',$session);
					$generate_session=$this->session->userdata('generate_session');
				}
				$this->alam->update("nursery_adm_data",$updData,"id='".$generate_session['id']."'");
				$message = "Dear Parent, Your transaction of Rs. ".$paymentResponse['amt']." is successful. Your registration no. is ".$generate_session['id']."/2023";
		       // $this->sms_lib->sendSms($generate_session['mobile'],$message);
				
				$data['stu_classes'] = $this->alam->selectA('student','CLASS,DISP_CLASS',"Student_Status = 'ACTIVE' GROUP BY CLASS,DISP_CLASS");
				$data['school_setting'] = $this->alam->select('school_setting','*');
				$data['school_photo'] = $this->alam->select('school_photo','*');
				$data['religion'] = $this->alam->selectA('religion','*',"status='Y' order by sorting_no");
				$data['category'] = $this->alam->selectA('category','*');
				
				$data['motherTounge'] = $this->alam_custom->motherTounge();
				$data['bloodGroup'] = $this->alam_custom->bloodGroup();
				$data['parent_qualification'] = $this->alam_custom->parent_qualification();
				$data['parent_accupation'] = $this->alam_custom->parent_accupation();
				$data['grand_parent'] = $this->alam_custom->grand_parent();
				
				$data['allData'] = $this->alam->selectA('nursery_adm_data','*,(select CAT_DESC from category where CAT_CODE=nursery_adm_data.category)category,(select Rname from religion where RNo=nursery_adm_data.religion)religion,(select CLASS_NM from classes where Class_No=nursery_adm_data.class_0)class_0,(select CLASS_NM from classes where Class_No=nursery_adm_data.class_1)class_1,(select SECTION_NAME from sections where section_no=nursery_adm_data.sec_0)sec_0,(select SECTION_NAME from sections where section_no=nursery_adm_data.sec_1)sec_1',"id='".$generate_session['id']."'");
				
				$this->load->view('nur_adm/generate_reg_pdf',$data);
				
				$html = $this->output->get_output();
				$this->load->library('pdf');
				$this->dompdf->loadHtml($html);
				$this->dompdf->setPaper('A4', 'portrait');
				$this->dompdf->render();
				$this->dompdf->stream($id.".pdf", array("Attachment"=>0));
			}else{
				$data['school_setting'] = $this->alam->select('school_setting','*');
		        $data['school_photo'] = $this->alam->select('school_photo','*');
				
				
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
				$trid=$paymentResponse['mer_txn'];
				$nurd=$this->alam->selectA("nursery_adm_data",'id,mobile',"transaction_id='$trid'");
				if(sizeof($nurd)!=0){
					$session = array(
						'id' => $nurd[0]['id'],
						'mobile'=>$nurd[0]['mobile']
					);
					$this->session->set_userdata('generate_session',$session);
					$generate_session=$this->session->userdata('generate_session');
		
				}else{
					$session = array(
						'id' => generate_session['id'],
						'mobile'=> 000000000
					);
					$this->session->set_userdata('generate_session',$session);
					$generate_session=$this->session->userdata('generate_session');
				}
			
				$this->alam->update("nursery_adm_data",$updData,"id='".$generate_session['id']."'");
				
				$data['allData'] = $this->alam->selectA('nursery_adm_data','*',"id='".$generate_session['id']."'");
				
				$transaction_id = $data['allData'][0]['transaction_id'];
				$set_amt        = $data['allData'][0]['set_amt'];
				
				$message = "Dear Parent, Your transaction of Rs. ".$set_amt." is failed.Your transaction Id is ".$transaction_id." Kindly repay.";
				//  $this->sms_lib->sendSms(generate_session['mobile'],$message);
				
				$this->load->view('nur_adm/payment_failed',$data);
			}
		}
	}
}


// <?php
// defined('BASEPATH') OR exit('No direct script access allowed');

// class Payment extends My_controller{
// 	public function __construct(){
// 		parent ::__construct();
// 		$this->load->model('Alam','alam');
// 		$this->load->library('Alam_custom','alam_custom');
// 		// require_once 'Atompay.php';
// 		// $this->testObject = new Atompay();
// 		require_once 'GetePayInvoicePg.php';
// 		$this->testObject = new GetePayInvoicePg();
// 	}
	
// public function index()
// 	{
// 		$generate_session = $this->session->userdata('generate_session', $session);
// 		//echo '<pre>'; print_r($generate_session); echo '</pre>';die;
// 		$regid         = $generate_session['id'];
// 		$amt           = ($generate_session['set_amt'] + $generate_session['fee_amt_service']);
// 		//$clientCode    = $generate_session['adm'].'-'.$generate_session['class'].'-'.$generate_session['disp_sec'];
// 		$transId = strtotime('now') . rand(0, 1000000);

// 		$updTrans = array(
// 			'transaction_id' => $transId
// 		);
// 		$this->alam->update("temp_cbse_reg", $updTrans, "id='" . $generate_session['id'] . "'");
// 		$mobData = $this->alam->selectA('temp_cbse_reg', 'mobile,email,admission_no,class,sec,roll', "id='" . $generate_session['id'] . "'");

// 		$mobile = $mobData[0]['mobile'];
// 		$admno = $mobData[0]['admission_no'];
// 		$cls = $mobData[0]['class'];
// 		$sec = $mobData[0]['sec'];
// 		$rollno = $mobData[0]['roll'];

// 		$clientCode    = $admno . '-' . $cls . '-' . $sec . '-' . $rollno;
// 		$emaill  = (!empty($mobData[0]['email'])) ? $mobData[0]['email'] : 'jvmfee@gmail.com';
// 		// $env = "live";
// 		// $login = "58016";
// 		// $pwd = "VIDYA@123";
// 		$product = "REGISTRATION";
// 		// $curr = "INR";
// 		$name = $generate_session['name'];
// 		$email = $emaill;
// 		//$mobile = "8789264410";
// 		$address = "Ranchi";
// 		// $acc = "639827";
// 		// $reqHashKey = "816e2e1f6ec25d7e7c";
// 		//` $returnurl = base_url('parent_dashboard/Cbse_Reg/payment_new/Response');

// 		$redirect_url = base_url('parent_dashboard/Cbse_Reg/payment_new/Payment/redirect_payment_new');

// 		$this->testObject->getpay_request($clientCode, $mobile, $amt, $name, $address, $email, $product, $transId, $redirect_url);

// 		// $this->testObject->atom_request($transId, $env, $login, $pwd, $product, $amt, $curr, $redirect_url, $clientCode, $name, $email, $mobile, $address, $acc, $reqHashKey);
// 	}

	
// 	public function redirect_payment(){
// 		//response hash key which is changed from user dashboard code
// 		$responseHashKey = "dae00acc31be39d9b5";
// 		$paymentResponse = $this->testObject->atomResponse($responseHashKey);
// 		if(is_array($paymentResponse)){
// 			if(strtolower($paymentResponse['f_code']) == 'ok'){
				
// 				$updData = array(
// 					'mmp_txn'     			 => $paymentResponse['mmp_txn'],
// 					//'transaction_id'         => $paymentResponse['mer_txn'],
// 					'amt'         			 => $paymentResponse['amt'],
// 					'bank_txn'    			 => $paymentResponse['bank_txn'],
// 					'f_code'      			 => $paymentResponse['f_code'],
// 					'bank_name'   			 => $paymentResponse['bank_name'],
// 					'auth_code'   			 => $paymentResponse['auth_code'],
// 					'ipg_txn_id'  			 => $paymentResponse['ipg_txn_id'],
// 					'merchant_id' 			 => $paymentResponse['merchant_id'],
// 					'desc'        			 => $paymentResponse['desc'],
// 					'CardNumber'  			 => $paymentResponse['CardNumber'],
// 					'response_received_time' => date('Y-m-d H:i:s')
// 				);
// 				$trid=$paymentResponse['mer_txn'];
// 				$nurd=$this->alam->selectA("nursery_adm_data",'id,mobile',"transaction_id='$trid'");
// 				if(sizeof($nurd)!=0){
// 					$session = array(
// 						'id' => $nurd[0]['id'],
// 						'mobile'=>$nurd[0]['mobile']
// 					);
// 					$this->session->set_userdata('generate_session',$session);
// 					$generate_session=$this->session->userdata('generate_session');
// 				}else{
// 					$session = array(
// 						'id' =>0,
// 						'mobile'=> 000000000
// 					);
// 					$this->session->set_userdata('generate_session',$session);
// 					$generate_session=$this->session->userdata('generate_session');
// 				}
// 				$this->alam->update("nursery_adm_data",$updData,"id='".$generate_session['id']."'");
// 				$message = "Dear Parent, Your transaction of Rs. ".$paymentResponse['amt']." is successful. Your registration no. is ".$generate_session['id']."/2023";
// 		       // $this->sms_lib->sendSms($generate_session['mobile'],$message);
				
// 				$data['stu_classes'] = $this->alam->selectA('student','CLASS,DISP_CLASS',"Student_Status = 'ACTIVE' GROUP BY CLASS,DISP_CLASS");
// 				$data['school_setting'] = $this->alam->select('school_setting','*');
// 				$data['school_photo'] = $this->alam->select('school_photo','*');
// 				$data['religion'] = $this->alam->selectA('religion','*',"status='Y' order by sorting_no");
// 				$data['category'] = $this->alam->selectA('category','*');
				
// 				$data['motherTounge'] = $this->alam_custom->motherTounge();
// 				$data['bloodGroup'] = $this->alam_custom->bloodGroup();
// 				$data['parent_qualification'] = $this->alam_custom->parent_qualification();
// 				$data['parent_accupation'] = $this->alam_custom->parent_accupation();
// 				$data['grand_parent'] = $this->alam_custom->grand_parent();
				
// 				$data['allData'] = $this->alam->selectA('nursery_adm_data','*,(select CAT_DESC from category where CAT_CODE=nursery_adm_data.category)category,(select Rname from religion where RNo=nursery_adm_data.religion)religion,(select CLASS_NM from classes where Class_No=nursery_adm_data.class_0)class_0,(select CLASS_NM from classes where Class_No=nursery_adm_data.class_1)class_1,(select SECTION_NAME from sections where section_no=nursery_adm_data.sec_0)sec_0,(select SECTION_NAME from sections where section_no=nursery_adm_data.sec_1)sec_1',"id='".$generate_session['id']."'");
				
// 				$this->load->view('nur_adm/generate_reg_pdf',$data);
				
// 				$html = $this->output->get_output();
// 				$this->load->library('pdf');
// 				$this->dompdf->loadHtml($html);
// 				$this->dompdf->setPaper('A4', 'portrait');
// 				$this->dompdf->render();
// 				$this->dompdf->stream($id.".pdf", array("Attachment"=>0));
// 			}else{
// 				$data['school_setting'] = $this->alam->select('school_setting','*');
// 		        $data['school_photo'] = $this->alam->select('school_photo','*');
				
				
// 				$updData = array(
// 					'mmp_txn'     			 => $paymentResponse['mmp_txn'],
// 					//'transaction_id'         => $paymentResponse['mer_txn'],
// 					'amt'         			 => $paymentResponse['amt'],
// 					'bank_txn'    			 => $paymentResponse['bank_txn'],
// 					'f_code'      			 => $paymentResponse['f_code'],
// 					'bank_name'   			 => $paymentResponse['bank_name'],
// 					//'auth_code'   			 => $paymentResponse['auth_code'],
// 					//'ipg_txn_id'  			 => $paymentResponse['ipg_txn_id'],
// 					'merchant_id' 			 => $paymentResponse['merchant_id'],
// 					'desc'        			 => $paymentResponse['desc'],
// 					//'CardNumber'  			 => $paymentResponse['CardNumber'],
// 					'response_received_time' => date('Y-m-d H:i:s')
// 				);
// 				$trid=$paymentResponse['mer_txn'];
// 				$nurd=$this->alam->selectA("nursery_adm_data",'id,mobile',"transaction_id='$trid'");
// 				if(sizeof($nurd)!=0){
// 					$session = array(
// 						'id' => $nurd[0]['id'],
// 						'mobile'=>$nurd[0]['mobile']
// 					);
// 					$this->session->set_userdata('generate_session',$session);
// 					$generate_session=$this->session->userdata('generate_session');
		
// 				}else{
// 					$session = array(
// 						'id' => generate_session['id'],
// 						'mobile'=> 000000000
// 					);
// 					$this->session->set_userdata('generate_session',$session);
// 					$generate_session=$this->session->userdata('generate_session');
// 				}
			
// 				$this->alam->update("nursery_adm_data",$updData,"id='".$generate_session['id']."'");
				
// 				$data['allData'] = $this->alam->selectA('nursery_adm_data','*',"id='".$generate_session['id']."'");
				
// 				$transaction_id = $data['allData'][0]['transaction_id'];
// 				$set_amt        = $data['allData'][0]['set_amt'];
				
// 				$message = "Dear Parent, Your transaction of Rs. ".$set_amt." is failed.Your transaction Id is ".$transaction_id." Kindly repay.";
// 				//  $this->sms_lib->sendSms(generate_session['mobile'],$message);
				
// 				$this->load->view('nur_adm/payment_failed',$data);
// 			}
// 		}
// 	}
// 	public function redirect_payment_new()
// 	{
// 		//response hash key which is changed from user dashboard code

// 		$key = base64_decode("JoYPd+qso9s7T+Ebj8pi4Wl8i+AHLv+5UNJxA3JkDgY=");
// 		$iv = base64_decode("hlnuyA9b4YxDq6oJSZFl8g==");

// 		$result = $_POST['response'];
// 		$ciphertext_raw = hex2bin($result);
// 		$original_plaintext = openssl_decrypt($ciphertext_raw,  "AES-256-CBC", $key, $options = OPENSSL_RAW_DATA, $iv);
// 		$json = json_decode($original_plaintext);
// 		$json_array = json_decode($json, true);

// 		// echo '<pre>';
// 		// print_r($json_array);die;

// 		if (!empty($json)) {

// 			if ($json_array['txnStatus'] == 'SUCCESS') {

// 				$updData = array(
// 					'mmp_txn'     			 => $json_array['getepayTxnId'],
// 					// 'transaction_id'         => $json_array['mer_txn'],
// 					'amt'         			 => $json_array['txnAmount'],
// 					'bank_txn'    			 => $json_array['getepayTxnId'],
// 					'f_code'      			 => $json_array['txnStatus'],
// 					// 'bank_name'   			 => $json_array['bank_name'],
// 					// 'auth_code'   			 => $json_array['auth_code'],
// 					'ipg_txn_id'  			 => $json_array['getepayTxnId'],
// 					'merchant_id' 			 => $json_array['merchantOrderNo'],
// 					'desc'        			 => $json_array['txnNote'],
// 					'CardNumber'  			 => $json_array['paymentMode'],
// 					'response_received_time' => date('Y-m-d H:i:s')
// 				);
// 				$trid = $json_array['merchantOrderNo'];
// 				$nurd = $this->alam->selectA("temp_cbse_reg", 'id,mobile', "transaction_id='$trid'");
// 				// echo $this->db->last_query();die;
// 				if (sizeof($nurd) != 0) {
// 					$session = array(
// 						'id' => $nurd[0]['id'],
// 						'mobile' => $nurd[0]['mobile']
// 					);
// 					$this->session->set_userdata('generate_session', $session);
// 					$generate_session = $this->session->userdata('generate_session');
// 				} else {
// 					$session = array(
// 						'id' => 0,
// 						'mobile' => 000000000
// 					);
// 					$this->session->set_userdata('generate_session', $session);
// 					$generate_session = $this->session->userdata('generate_session');
// 				}
// 				$this->alam->update("temp_cbse_reg", $updData, "id='" . $generate_session['id'] . "'");

// 				//$link = base_url('parent_dashboard/Cbse_Reg/Gautam/cbse_registration');
// 				$link = base_url('parent_dashboard/Cbse_Reg/Gautam/Print_user_profile/' . $generate_session['id']);

// 				echo "<center><h3>Payment Successfully Completed..<a href='" . $link . "'>Click For Print</a></h3></center>";
// 			} else {

// 				$data['school_setting'] = $this->alam->select('school_setting', '*');
// 				$data['school_photo'] = $this->alam->select('school_photo', '*');


// 				$updData = array(
// 					'mmp_txn'     			 => $json_array['getepayTxnId'],
// 					// 'transaction_id'         => $json_array['mer_txn'],
// 					'amt'         			 => $json_array['txnAmount'],
// 					'bank_txn'    			 => $json_array['getepayTxnId'],
// 					'f_code'      			 => $json_array['txnStatus'],
// 					// 'bank_name'   			 => $json_array['bank_name'],
// 					// 'auth_code'   			 => $json_array['auth_code'],
// 					'ipg_txn_id'  			 => $json_array['getepayTxnId'],
// 					'merchant_id' 			 => $json_array['1726664970602149'],
// 					'desc'        			 => $json_array['txnNote'],
// 					'CardNumber'  			 => $json_array['paymentMode'],
// 					'response_received_time' => date('Y-m-d H:i:s')
// 				);
// 				$trid = $json_array['getepayTxnId'];
// 				$nurd = $this->alam->selectA("temp_cbse_reg", 'id,mobile', "transaction_id='$trid'");
// 				if (sizeof($nurd) != 0) {
// 					$session = array(
// 						'id' => $nurd[0]['id'],
// 						'mobile' => $nurd[0]['mobile']
// 					);
// 					$this->session->set_userdata('generate_session', $session);
// 					$generate_session = $this->session->userdata('generate_session');
// 				} else {
// 					$session = array(
// 						'id' => generate_session['id'],
// 						'mobile' => 000000000
// 					);
// 					$this->session->set_userdata('generate_session', $session);
// 					$generate_session = $this->session->userdata('generate_session');
// 				}

// 				$this->alam->update("temp_cbse_reg", $updData, "id='" . $generate_session['id'] . "'");

// 				// $data['allData'] = $this->alam->selectA('temp_cbse_reg','*',"id='".$generate_session['id']."'");

// 				// $transaction_id = $data['allData'][0]['transaction_id'];
// 				// $set_amt        = $data['allData'][0]['set_amt'];


// 				// $this->load->view('nur_adm/payment_failed',$data);
// 				echo "<h3>Transaction failed </h3>";
// 			}
// 		} else {

// 			echo 'abxb'; /// remmmm
// 		}
// 	}
// }