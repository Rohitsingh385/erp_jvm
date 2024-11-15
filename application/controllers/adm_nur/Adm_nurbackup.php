<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Adm_nur extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Alam', 'alam');
		$this->load->library('Alam_custom', 'alam_custom');
	}

	public function index()
	{

		$data['stu_classes'] = $this->alam->selectA('student', 'CLASS,DISP_CLASS', "Student_Status = 'ACTIVE' GROUP BY CLASS,DISP_CLASS");
		$data['school_setting'] = $this->alam->select('school_setting', '*');
		$data['school_photo'] = $this->alam->select('school_photo', '*');
		$data['religion'] = $this->alam->selectA('religion', '*', "status='Y' order by sorting_no");
		$data['category'] = $this->alam->selectA('category', '*');
		$data['motherTounge'] = $this->alam_custom->motherTounge();
		$data['bloodGroup'] = $this->alam_custom->bloodGroup();
		$data['parent_qualification'] = $this->alam_custom->parent_qualification();
		$data['parent_accupation'] = $this->alam_custom->parent_accupation();
		$data['father_accupation'] = $this->alam_custom->father_accupation();
		$data['mother_accupation'] = $this->alam_custom->mother_accupation();
		$data['grand_parent'] = $this->alam_custom->grand_parent();
		// echo '<pre>';print_r($data);die;
		$this->load->view('nur_adm/admForm', $data);
	}

	function atom_respons()
	{
		if (isset($_GET['VERIFIED'])) {
			$status = $_GET['VERIFIED'];
			$order_id = $_GET['MerchantTxnID'];
			$saveDAta = array(
				'status' => $status,
				'order_id' => $order_id
			);
			$this->alam->insert('atom_test', $saveDAta);
			if ($_GET['VERIFIED'] == 'SUCCESS') {
				$datta = array(
					'mmp_txn' => $_GET['AtomTxnId'],
					//'transaction_id'         => $paymentResponse['mer_txn'],
					'amt'         			 => $_GET['AMT'],
					'bank_txn'    			 => $_GET['BID'],
					'f_code'      			 => 'Ok',
					'bank_name'   			 => $_GET['BankName'],
					'auth_code'   			 => '',
					'ipg_txn_id'  			 => $_GET['MerchantTxnID'],
					'mer_txn' 				 => $_GET['MerchantTxnID'],
					'merchant_id' 			 => $_GET['MerchantID'],
					'desc'        			 => $_GET['VERIFIED'],
					'CardNumber'  			 => $_GET['CardNumber'],
					'response_received_time' => date('Y-m-d H:i:s')
				);
				$mid = $_GET['MerchantTxnID'];
				$this->alam->update('nursery_adm_data', $datta, "transaction_id='$mid'");
			}
		}

		if (isset($_POST['VERIFIED'])) {
			$status = $_POST['VERIFIED'];
			$order_id = $_POST['MerchantTxnID'];
			$saveDAta = array(
				'status' => $status,
				'order_id' => $order_id
			);
			$this->alam->insert('atom_test', $saveDAta);
			if ($_POST['VERIFIED'] == 'SUCCESS') {
				$datta = array(
					'mmp_txn' => $_POST['AtomTxnId'],
					//'transaction_id'         => $paymentResponse['mer_txn'],
					'amt'         			 => $_POST['AMT'],
					'bank_txn'    			 => $_POST['BID'],
					'f_code'      			 => 'Ok',
					'bank_name'   			 => $_POST['BankName'],
					'auth_code'   			 => '',
					'ipg_txn_id'  			 => $_POST['MerchantTxnID'],
					'mer_txn' 				 => $_POST['MerchantTxnID'],
					'merchant_id' 			 => $_POST['MerchantID'],
					'desc'        			 => $_POST['VERIFIED'],
					'CardNumber'  			 => $_POST['CardNumber'],
					'response_received_time' => date('Y-m-d H:i:s')
				);
				$mid = $_POST['MerchantTxnID'];
				$this->alam->update('nursery_adm_data', $datta, "transaction_id='$mid'");
			}
		}
	}


	function Getsec()
	{
		$classes = $this->input->post('classes');
		$secData = $this->alam->selectA("student", "SEC,DISP_SEC", "CLASS='$classes' GROUP BY SEC,DISP_SEC");
?>
		<option value=''>Select</option>
		<?php
		foreach ($secData as $key => $val) {
		?>
			<option value='<?php echo $val['SEC']; ?>'><?php echo $val['DISP_SEC']; ?></option>
<?php
		}
	}

	public function checkData()
	{
		$stu_nm = trim(strtoupper($this->input->post('stu_nm')));
		$dob    = date('Y-m-d', strtotime($this->input->post('dob')));
		$mobile = $this->input->post('mobile');
		//$stuDatacnt = $this->alam->selectA('nursery_adm_data','count(*)cnt',"stu_nm='$stu_nm' AND dob='$dob' AND mobile='$mobile'");
		$stuDatacnt = $this->alam->selectA('nursery_adm_data', 'count(*)cnt', "dob='$dob' AND mobile='$mobile'");

		//$str=$this->db->last_query();
		//echo $str;
		//die;
		$stuData = $this->alam->selectA('nursery_adm_data', 'id,mobile', "stu_nm='$stu_nm' AND dob='$dob' AND mobile='$mobile'");

		$cnt = $stuDatacnt[0]['cnt'];
		$un  = $stuData[0]['id'];
		$pwd = $stuData[0]['mobile'];
		$array = array($cnt, $un, $pwd);
		echo json_encode($array);
	}

	function saveNurAdmRecord()
	{

		$grnd_prnt = ($this->input->post('grnd_prnt') == 'NO') ? 'OTHERS' : 'YES';
		$stu_name = $this->input->post('stu_nm');
		$first_name = strtoupper(explode(' ', $stu_name)[0]);

		$imagepath = '';
		if (!empty($_FILES['img']['name'])) {
			$image = $_FILES['img']['name'];
			$image_ext = pathinfo($image, PATHINFO_EXTENSION);
			$image_name = $first_name . '.' . $image_ext;
			$imagepath = "assets/nur_adm_img/" . $image_name;
			move_uploaded_file($_FILES["img"]["tmp_name"], $imagepath);
		}

		$upload_path = './assets/nur_adm_docs/';

		$file_fields = [
			'filedob',
			'filefadhar',
			'filefgovdoc',
			'fileftranfer',
			'filefalumni',
			'filemadhar',
			'filemtranfer',
			'filemgovdoc',
			'filemalumni',
			'singlpdoc',
			'filesibling',
			'filesibling1',
			'grndprntpdf',
			'resproof',
			'perproof'
		];

		$uploaded_files = [];
		foreach ($file_fields as $field) {
			$uploaded_files[$field] = $this->upload_pdf($field, $upload_path);
		}

		$saveData = [
			'stu_nm' => strtoupper($this->input->post('stu_nm')),
			'dob' => date('Y-m-d', strtotime($this->input->post('dob'))),
			'gender' => $this->input->post('gender'),
			'category' => $this->input->post('category'),
			'aadhaar_no' => $this->input->post('aadhaar_no'),
			'mother_tounge' => strtoupper($this->input->post('mother_tounge')),
			'religion' => strtoupper($this->input->post('religion')),
			'blood_group' => $this->input->post('blood_group'),
			'img' => $imagepath,
			'prev_skool' => strtoupper($this->input->post('prev_skool')),
			'skoolname' => strtoupper($this->input->post('skoolname')),
			'classname' => strtoupper($this->input->post('classname')),
			'classname'          => strtoupper($this->input->post('classname')), //
			'f_name'             => strtoupper($this->input->post('f_name')),
			'f_qualification'    => strtoupper($this->input->post('f_qualification')),
			'f_accupation'       => strtoupper($this->input->post('f_accupation')),
			'f_gov_job'          => strtoupper($this->input->post('f_gov_job')),
			'fbranch_select'     => strtoupper($this->input->post('fbranch_select')), //
			'f_jbo_transferable' => strtoupper($this->input->post('f_jbo_transferable')),
			'f_alumini'          => strtoupper($this->input->post('f_alumini')),
			'f_year_leaving'     => $this->input->post('f_year_leaving'),
			'f_reg_no'           => $this->input->post('f_reg_no'),
			'm_name'             => strtoupper($this->input->post('m_name')),
			'm_qualification'    => strtoupper($this->input->post('m_qualification')),
			'm_accupation'       => strtoupper($this->input->post('m_accupation')),
			'm_gov_job'          => strtoupper($this->input->post('m_gov_job')),
			'mbranch_select'     => strtoupper($this->input->post('mbranch_select')), //
			'm_jbo_transferable' => $this->input->post('m_jbo_transferable'),
			'm_alumini'          => $this->input->post('m_alumini'),
			'm_year_leaving'     => $this->input->post('m_year_leaving'),
			'm_reg_no'           => $this->input->post('m_reg_no'),
			'no_of_son'          => $this->input->post('no_of_son'),
			'no_of_daughters'    => $this->input->post('no_of_daughters'),
			'single_parent'      => $this->input->post('single_parent'),
			'father_or_mother'   => strtoupper($this->input->post('father_or_mother')),
			'grnd_prnt' => $grnd_prnt,
			'grand_parent' => strtoupper($this->input->post('grand_parent')),
			'stuofjvm_0' => strtoupper($this->input->post('stuofjvm_0')),
			//'grand_parent'       => strtoupper($this->input->post('grand_parent')),
			'stuofjvm_0'         => strtoupper($this->input->post('stuofjvm_0')),
			'class_0'            => $this->input->post('class_0'),
			'sec_0'              => $this->input->post('sec_0'),
			'registration_0'     => $this->input->post('registration_0'),
			'stuofjvm_1'         => strtoupper($this->input->post('stuofjvm_1')),
			'class_1'            => $this->input->post('class_1'),
			'sec_1'              => $this->input->post('sec_1'),
			'registration_1'     => $this->input->post('registration_1'),
			'residentail_add'    => strtoupper($this->input->post('residentail_add')),
			'pin_code'           => $this->input->post('pin_code'),
			'distance'           => $this->input->post('distance'),
			//'phone_residence'    => $this->input->post('phone_residence'),
			'mobile'             => $this->input->post('mobile'),
			'email'              => $this->input->post('email'),
			'p_residentail_add'  => strtoupper($this->input->post('p_residentail_add')),
			'p_pin_code'         => $this->input->post('p_pin_code'),
			//'p_phone_residence'  => $this->input->post('p_phone_residence'),
			//'p_mobile'           => $this->input->post('p_mobile'),
			'set_amt'            => '2000.00',
			'filedob' => $uploaded_files['filedob'],
			'filefadhar' => $uploaded_files['filefadhar'],
			'filefgovdoc' => $uploaded_files['filefgovdoc'],
			'fileftranfer' => $uploaded_files['fileftranfer'],
			'filefalumni' => $uploaded_files['filefalumni'],
			'filemadhar' => $uploaded_files['filemadhar'],
			'filemtranfer' => $uploaded_files['filemtranfer'],
			'filemalumni' => $uploaded_files['filemalumni'],
			'singlpdoc' => $uploaded_files['singlpdoc'],
			'filesibling' => $uploaded_files['filesibling'],
			'filesibling1' => $uploaded_files['filesibling1'],
			'grndprntpdf' => $uploaded_files['grndprntpdf'],
			'resproof' => $uploaded_files['resproof'],
			'perproof' => $uploaded_files['perproof']
		];

		// Save to database
		$this->alam->insert('nursery_adm_data', $saveData);


		// echo '<pre>';
		// print_r($saveData);
		// echo $this->db->last_query();
		// die;
		$last_id = $this->db->insert_id();
		$last_reg_id = sprintf("%04d", $last_id);

		$regData = $this->alam->selectA('nursery_adm_data', 'id,dob,stu_nm,mobile,img,set_amt,verified_status,f_code', "id='$last_reg_id'");

		$session = array(
			'id'              => $regData[0]['id'],
			'name'            => $regData[0]['stu_nm'],
			'img'             => $regData[0]['img'],
			'set_amt'         => $regData[0]['set_amt'],
			'verified_status' => $regData[0]['verified_status'],
			'mobile'          => $regData[0]['mobile'],
			'f_code'          => $regData[0]['f_code'],
			'role'            => 'APPLICANT'
		);

		$this->session->set_userdata('generate_session', $session);
	}

	function upload_pdf($file_input_name, $upload_path, $file_key = '', $config = null)
	{

		$CI = &get_instance();

		$stu_name = $this->input->post('stu_nm');
		$first_name = strtoupper(explode(' ', $stu_name)[0]);

		$CI->load->library('upload');


		if ($config === null) {
			$config = [
				'upload_path'   => $upload_path,
				'allowed_types' => 'pdf',
				'max_size'      => 10240,
				'file_name'     => time() . mt_rand() . '.pdf',
			];
		}


		$CI->upload->initialize($config);

		echo 'Upload Path: ' . $upload_path . '<br>';

		if (!empty($_FILES[$file_input_name]['name'])) {

			if ($CI->upload->do_upload($file_input_name)) {

				$upload_data = $CI->upload->data();
				return $upload_path . $upload_data['file_name']; // Retu
			} else {

				echo "Error uploading file " . $file_input_name . ": " . $CI->upload->display_errors();
				return '';
			}
		}


		return '';
	}





	public function payNow()
	{
		$generate_session = $this->session->userdata('generate_session');
		$data['school_setting'] = $this->alam->select('school_setting', '*');
		$data['school_photo'] = $this->alam->select('school_photo', '*');

		$message = "Dear Parent, Your application is successfully submitted. Your username is " . $generate_session['id'] . "/2025 & password is " . $generate_session['mobile'];
		$this->sms_lib->sendSms($generate_session['mobile'], $message);
		$data['allData'] = $this->alam->selectA('nursery_adm_data', '*', "id='" . $generate_session['id'] . "'");
		// echo '<pre>';print_r($data);
		$this->load->view('nur_adm/payNow', $data);
	}
}
