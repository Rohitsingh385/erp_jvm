<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gautam extends MY_controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Alam', 'alam');
		$this->load->model('Mymodel', 'dbcon');
		error_reporting(0);
	}

	public function cbse_registration()
	{
		$generate_session = $this->session->userdata('generate_session');

		$adm_no = $this->session->userdata('adm');
		$std_id = $this->session->userdata('std_id');
		$class_code = $this->session->userdata('class_code');
		$data = $this->dbcon->select('student_attendance_type', '*', "class_code='$class_code'");
		$session_master = $this->dbcon->select('session_master', '*', "Active_Status=1");
		if ($class_code == 11) {
			$sections = $this->dbcon->select('login_details', 'Section_No,(select SECTION_NAME from sections where section_no=login_details.Section_No)secnm', "Class_No='11' order by Section_No");
		} else {
			$sections = $this->dbcon->select('login_details', 'Section_No,(select SECTION_NAME from sections where section_no=login_details.Section_No)secnm', "Class_No='13' order by Section_No");
		}
		$temp_user_data = $this->dbcon->select('temp_cbse_reg', '*,(select SECTION_NAME from sections where section_no=temp_cbse_reg.sec)secnm', "admission_no='$adm_no'");

		$session_year = $session_master[0]->Session_Year;
		
		$student = $this->dbcon->show_student($std_id);

		//echo '<pre>'; print_r($student); die;
		//chnage 1
		$subj1=$student[0]->SUBJECT1;
		$subj2=$student[0]->SUBJECT2;
		$subj3=$student[0]->SUBJECT3;
		$subj4=$student[0]->SUBJECT4;
		$subj5=$student[0]->SUBJECT5;
		$subj6=$student[0]->SUBJECT6;

		$student_subjects = array_filter([$subj1,$subj2,$subj3,$subj4,$subj5,$subj6]);

		//$str=$this->db->last_query();
		//echo $str;
		//die;
		// echo '<pre>'; print_r($student_subjects);die;
			// chnage 2
			
			$dropdown_options = [];
			if (in_array('PHYSICS', $student_subjects)) {
				$dropdown_options = [
					'phe' => 'PHE (048)',
					'painting' => 'Painting (049)'
				];
			}
			if (in_array('ACCOUNTANCY', $student_subjects)) {
				$dropdown_options = array_merge($dropdown_options, [
					'phe' => 'PHE (048)',
					'painting' => 'Painting (049)',

					'entrepreneurship' => 'Entrepreneurship (066)',
				]);
			}
			if (in_array('HISTORY', $student_subjects)) {
				$dropdown_options = array_merge($dropdown_options, [
					'phe' => 'PHE (048)',
					'painting' => 'Painting (049)',
					'sociology' => 'Sociology (039)'

				]);
			}
			// echo '<pre>'; print_r($dropdown_options); die;
			
		$array = array(
			'data' => $data,
			'student' => $student,
			'sections' => $sections,
			'temp_data' => $temp_user_data,
			'dropdown_options' => $dropdown_options 
		);

	
		// echo '<pre>'; print_r($array); echo '</pre>';die;
		$session_array = array(
			'token_no' => !empty($temp_user_data[0]->id) ? $temp_user_data[0]->id : '',
			'fee_amt'  => !empty($temp_user_data[0]->fee_amt) ? $temp_user_data[0]->fee_amt : 0,
			'stu_name' => !empty($temp_user_data[0]->name) ? $temp_user_data[0]->name : '',
			'email'    => !empty($temp_user_data[0]->email) ? $temp_user_data[0]->email : '',
			'f_mob'    => !empty($temp_user_data[0]->mobile) ? $temp_user_data[0]->mobile : '',
			'class'    => !empty($temp_user_data[0]->class) ? $temp_user_data[0]->class : '',
			'sec'    =>   !empty($temp_user_data[0]->secnm) ? $temp_user_data[0]->secnm : '',
			'roll'     => !empty($temp_user_data[0]->roll) ? $temp_user_data[0]->roll : '',
			'adm_no'   => $adm_no,
		);

		$session = array(
			'adm'             => $adm_no,
			'id'              => $temp_user_data[0]->id,
			'name'            => $temp_user_data[0]->name,
			'class'           => $temp_user_data[0]->class,
			'sec'             => $temp_user_data[0]->sec,
			'disp_sec'        => $temp_user_data[0]->disp_sec,
			'roll'            => $temp_user_data[0]->roll,
			'set_amt'         => $temp_user_data[0]->fee_amt,
			'fee_amt_service' => $temp_user_data[0]->fee_amt_service,
			'mobile'          => $temp_user_data[0]->mobile,
			'f_code'          => $temp_user_data[0]->f_code
		);
		$this->session->set_userdata('generate_session', $session);

		$this->session->set_userdata($session_array);

		$this->Parent_templete('parents_dashboard/Cbse_Reg/cbse_registration', $array);
	}
	//1
	public function cbse_registration121()
	{
		$generate_session = $this->session->userdata('generate_session');

		$adm_no = $this->session->userdata('adm');
		$std_id = $this->session->userdata('std_id');
		$class_code = $this->session->userdata('class_code');
		$data = $this->dbcon->select('student_attendance_type', '*', "class_code='$class_code'");
		$session_master = $this->dbcon->select('session_master', '*', "Active_Status=1");
		if ($class_code == 11) {
			$sections = $this->dbcon->select('login_details', 'Section_No,(select SECTION_NAME from sections where section_no=login_details.Section_No)secnm', "Class_No='11' order by Section_No");
		} else {
			$sections = $this->dbcon->select('login_details', 'Section_No,(select SECTION_NAME from sections where section_no=login_details.Section_No)secnm', "Class_No='13' order by Section_No");
		}
		$temp_user_data = $this->dbcon->select('temp_cbse_reg', '*,(select SECTION_NAME from sections where section_no=temp_cbse_reg.sec)secnm', "admission_no='$adm_no'");

		$session_year = $session_master[0]->Session_Year;

		$student = $this->dbcon->show_student($std_id);
		//$str=$this->db->last_query();
		//echo $str;
		//die;

		$array = array(
			'data' => $data,
			'student' => $student,
			'sections' => $sections,
			'temp_data' => $temp_user_data
		);
		//echo '<pre>'; print_r($data); echo '</pre>';die;
		$session_array = array(
			'token_no' => !empty($temp_user_data[0]->id) ? $temp_user_data[0]->id : '',
			'fee_amt'  => !empty($temp_user_data[0]->fee_amt) ? $temp_user_data[0]->fee_amt : 0,
			'stu_name' => !empty($temp_user_data[0]->name) ? $temp_user_data[0]->name : '',
			'email'    => !empty($temp_user_data[0]->email) ? $temp_user_data[0]->email : '',
			'f_mob'    => !empty($temp_user_data[0]->mobile) ? $temp_user_data[0]->mobile : '',
			'class'    => !empty($temp_user_data[0]->class) ? $temp_user_data[0]->class : '',
			'sec'    =>   !empty($temp_user_data[0]->secnm) ? $temp_user_data[0]->secnm : '',
			'roll'     => !empty($temp_user_data[0]->roll) ? $temp_user_data[0]->roll : '',
			'adm_no'   => $adm_no,
		);

		$session = array(
			'adm'             => $adm_no,
			'id'              => $temp_user_data[0]->id,
			'name'            => $temp_user_data[0]->name,
			'class'           => $temp_user_data[0]->class,
			'sec'             => $temp_user_data[0]->sec,
			'disp_sec'        => $temp_user_data[0]->disp_sec,
			'roll'            => $temp_user_data[0]->roll,
			'set_amt'         => $temp_user_data[0]->fee_amt,
			'fee_amt_service' => $temp_user_data[0]->fee_amt_service,
			'mobile'          => $temp_user_data[0]->mobile,
			'f_code'          => $temp_user_data[0]->f_code
		);

		$this->session->set_userdata('generate_session', $session);

		$this->session->set_userdata($session_array);

		$this->Parent_templete('parents_dashboard/Cbse_Reg/cbse_registration', $array);
	}

	//2
	public function payNow()
	{

		$generate_session = $this->session->userdata('generate_session');

		if (empty($generate_session)) {
			$adm_no = $this->session->userdata('adm');
			$getData = $this->alam->selectA('temp_cbse_reg', '*,(select SECTION_NAME from sections where section_no=temp_cbse_reg.sec)disp_sec', "admission_no='$adm_no'");
			$session = array(
				'adm'             => $getData[0]['admission_no'],
				'id'              => $getData[0]['id'],
				'name'            => $getData[0]['name'],
				'class'           => $getData[0]['class'],
				'sec'             => $getData[0]['sec'],
				'disp_sec'        => $getData[0]['disp_sec'],
				'roll'            => $getData[0]['roll'],
				'set_amt'         => $getData[0]['fee_amt'],
				'fee_amt_service' => $getData[0]['fee_amt_service'],
				'mobile'          => $getData[0]['mobile'],
				'f_code'          => $getData[0]['f_code']
			);
			// echo '<pre>';
			// print_r($session);
			// echo '</pre>';
			$this->session->set_userdata('generate_session', $session);
		}

		$data['school_setting'] = $this->alam->select('school_setting', '*');
		$data['school_photo'] = $this->alam->select('school_photo', '*');
		$data['allData'] = $this->alam->selectA('temp_cbse_reg', '*', "id='" . $generate_session['id'] . "'");
		//die;
		$this->load->view('parents_dashboard/Cbse_Reg/payment/payNow', $data);
	}
	
	

	public function cbse_registration_XI()
	{

		$adm_no = $this->session->userdata('adm');

		$std_id = $this->session->userdata('std_id');
		$class_code = $this->session->userdata('class_code');
		$data = $this->dbcon->select('student_attendance_type', '*', "class_code='$class_code'");
		$session_master = $this->dbcon->select('session_master', '*', "Active_Status=1");

		$sections = $this->dbcon->select('sections', '*');
		$temp_user_data = $this->dbcon->select('temp_cbse_reg', '*', "admission_no='$adm_no'");

		$session_year = $session_master[0]->Session_Year;

		$student = $this->dbcon->show_student($std_id);

		$array = array(
			'data' => $data,
			'student' => $student,
			'sections' => $sections,
			'temp_data' => $temp_user_data
		);

		$this->Parent_templete('parents_dashboard/Cbse_Reg/cbse_registration_XI', $array);
	}


	public function save_temp_student()
	{
		$quality = 40;
		$aadhaar = $this->input->post('aadhaar');
		$sec = $this->input->post('sec');
		$roll = $this->input->post('roll');
		$Penum = strtoupper($this->input->post('Penum'));
		$name = strtoupper($this->input->post('name'));
		$fname = strtoupper($this->input->post('f_name'));
		$mname = strtoupper($this->input->post('m_name'));
		$dob = $this->input->post('dob');
		$sex = $this->input->post('sex');
		$adm_date = $this->input->post('adm_date');
		$category = $this->input->post('category');
		$lng = $this->input->post('optsub');
		$mobile = $this->input->post('mobile');
		$address = strtoupper($this->input->post('address'));
		$bord_name = strtoupper($this->input->post('bord_name'));
		$bord_roll = strtoupper($this->input->post('bord_roll'));
		$income = $this->input->post('income');
		$email = $this->input->post('email');
		$minority = $this->input->post('Minority');
		$child = $this->input->post('M_Child');
		$adm_no = $this->input->post('adm_no');
		$RGN_CODE = $this->input->post('RGN_CODE');
		$EXAM_S_CODE = $this->input->post('EXAM_S_CODE');
		$CLASS_TEACHER = $this->input->post('CLASS_TEACHER');
		$class = $this->input->post('class');
		$admno = str_replace("/", "-", $adm_no);
		$imgList = array();
		for ($i = 0; $i < count($_FILES['photo']['name']); $i++) {
			if (!empty($_FILES['photo']['name'][$i])) {
				$image              = $_FILES['photo']['name'][$i];
				$expimage           = explode('.', $image);
				$count              = count($expimage);
				$image_ext          = $expimage[$count - 1];

				$image_name         = $admno . '_' . $class . '_' . $roll . '.' . $image_ext;
				$imagepath          = "Cbse_Reg/profile/" . $image_name;
				move_uploaded_file($_FILES["photo"]["tmp_name"][$i], $imagepath);


				//$image = imagecreatefromjpeg($imagepath); 
				//imagejpeg($image,$imagepath, $quality);

				$imgList = $imagepath;
			} else {
				$imagepath  = '';
			}
		}
		$imgList_father = array();
		for ($i = 0; $i < count($_FILES['f_signature']['name']); $i++) {
			if (!empty($_FILES['f_signature']['name'][$i])) {
				$image              = $_FILES['f_signature']['name'][$i];
				$expimage           = explode('.', $image);
				$count              = count($expimage);
				$image_ext          = $expimage[$count - 1];

				$image_name         = 'f_sig' . $admno . '_' . $class . '_' . $roll . '.' . $image_ext;
				$imagepath_f          = "Cbse_Reg/f_signature/" . $image_name;
				move_uploaded_file($_FILES["f_signature"]["tmp_name"][$i], $imagepath_f);
				//$image = imagecreatefromjpeg($imagepath_f); 
				//imagejpeg($image,$imagepath_f, $quality);
				$imgList_father = $imagepath_f;
			} else {
				$imagepath_f  = '';
			}
		}
		$imgList_mother = array();
		for ($i = 0; $i < count($_FILES['m_signature']['name']); $i++) {
			if (!empty($_FILES['m_signature']['name'][$i])) {
				$image              = $_FILES['m_signature']['name'][$i];
				$expimage           = explode('.', $image);
				$count              = count($expimage);
				$image_ext          = $expimage[$count - 1];
				$image_name         = 'm_sig' . $admno . '_' . $class . '_' . $roll . '.' . $image_ext;
				$imagepath_m          = "Cbse_Reg/m_signature/" . $image_name;
				move_uploaded_file($_FILES["m_signature"]["tmp_name"][$i], $imagepath_m);
				//$image = imagecreatefromjpeg($imagepath_m); 
				//imagejpeg($image,$imagepath_m, $quality);
				$imgList_mother = $imagepath_m;
			} else {
				$imagepath_m  = '';
			}
		}

		$saveDataNotice = array(
			'RGN_CODE' => $RGN_CODE,
			'aadhaar' => $aadhaar,
			'EXAM_S_CODE' => $EXAM_S_CODE,
			'adm_date' => $adm_date,
			'CLASS_TEACHER' => $CLASS_TEACHER,
			'sec' => $sec,
			'roll' => $roll,
			'name' => $name,
			'fname' => $fname,
			'mname' => $mname,
			'dob' => $dob,
			'sex' => $sex,
			'category' => $category,
			'minority' => $minority,
			'lng' => $lng,
			'mobile' => $mobile,
			'address' => $address,
			'income' => $income,
			'email' => $email,
			'child' => $child,
			'admission_no' => $adm_no,
			'bord_name' => $bord_name,
			'bord_roll' => $bord_roll,
			'photo' => $imgList,
			'f_signature' => $imgList_father,
			'm_signature' => $imgList_mother,
			'Penum' => $Penum,
			'class' => $class
		);
		$this->alam->insert('temp_cbse_reg', $saveDataNotice);

		$insertLastId = $this->db->insert_id();

		$getData = $this->alam->selectA('temp_cbse_reg', '*,(select SECTION_NAME from sections where section_no=temp_cbse_reg.sec)disp_sec', "id='$insertLastId'");

		$session = array(
			'adm'             => $getData[0]['admission_no'],
			'id'              => $getData[0]['id'],
			'name'            => $getData[0]['name'],
			'class'           => $getData[0]['class'],
			'sec'             => $getData[0]['sec'],
			'disp_sec'        => $getData[0]['disp_sec'],
			'roll'            => $getData[0]['roll'],
			'set_amt'         => $getData[0]['fee_amt'],
			'fee_amt_service' => $getData[0]['fee_amt_service'],
			'mobile'          => $getData[0]['mobile'],
			'f_code'          => $getData[0]['f_code']
		);

		$this->session->set_userdata('generate_session', $session);
		redirect('parent_dashboard/Cbse_Reg/gautam/payNow');
	}



	public function save_temp_student_xi()
	{
		$quality = 40;
		$aadhaar = $this->input->post('aadhaar');
		$sec = $this->input->post('sec');
		$roll = $this->input->post('roll');

		$name = strtoupper($this->input->post('name'));

		$fname = strtoupper($this->input->post('f_name'));
		$mname = strtoupper($this->input->post('m_name'));
		$dob = $this->input->post('dob');
		$sex = $this->input->post('sex');
		$adm_date = $this->input->post('adm_date');
		$category = $this->input->post('category');
		$Penum = $this->input->post('category');
		$lng = $this->input->post('Lng_ENG');
		$mobile = $this->input->post('mobile');
		$address = strtoupper($this->input->post('address'));
		$income = $this->input->post('income');
		$email = $this->input->post('email');
		$minority = $this->input->post('Minority');
		$child = $this->input->post('M_Child');
		$adm_no = $this->input->post('adm_no');
		$RGN_CODE = $this->input->post('RGN_CODE');
		$EXAM_S_CODE = $this->input->post('EXAM_S_CODE');
		$CLASS_TEACHER = strtoupper($this->input->post('CLASS_TEACHER'));
		$subject = $this->input->post('subject');
		$class = $this->input->post('class');
		$stream = $this->input->post('stream');
		$bord_name = strtoupper($this->input->post('bord_name'));
		$bord_roll = $this->input->post('bord_roll');
		$bord_year = $this->input->post('bord_year');
		$admno = str_replace("/", "-", $adm_no);
		if ($stream == 'Science') {
			if ($lng == "MATHEMATICS") {
				$op = $this->input->post('subject_m');

				$data_s = array("ENGLISH", "MATHEMATICS", "PHYSICS", "CHEMISTRY", "PAINTING", "$op");
			} else {
				$op = $this->input->post('subject_b');
				$data_s = array("ENGLISH", "BIOLOGY", "PHYSICS", "CHEMISTRY", "PAINTING", "$op");
			}
		} else if ($stream == 'Commerce') {
			$op = $this->input->post('subject_c');
			$data_s = array("ENGLISH", "ECONOMICS", "BUSINESS STUDIES", "ACCOUNTANCY", "PAINTING", "$op");
		} else {
			$op = $this->input->post('subject_a');

			$data_s = array("ENGLISH", "HINDI", "HISTORY", "POLITICAL SCIENCE", "PAINTING", "$op");
		}


		$imgList = array();
		for ($i = 0; $i < count($_FILES['photo']['name']); $i++) {
			if (!empty($_FILES['photo']['name'][$i])) {
				$image              = $_FILES['photo']['name'][$i];
				$expimage           = explode('.', $image);
				$count              = count($expimage);
				$image_ext          = $expimage[$count - 1];
				$image_name         = $admno . '_' . $class . '_' . $roll . '.' . $image_ext;
				$imagepath          = "Cbse_Reg/profile/" . $image_name;

				move_uploaded_file($_FILES["photo"]["tmp_name"][$i], $imagepath);
				$image = imagecreatefromjpeg($imagepath);
				imagejpeg($image, $imagepath, $quality);
				$imgList = $imagepath;
			} else {
				$imagepath  = '';
			}
		}
		$imgList_signature = array();
		for ($i = 0; $i < count($_FILES['f_signature']['name']); $i++) {
			if (!empty($_FILES['f_signature']['name'][$i])) {
				$image              = $_FILES['f_signature']['name'][$i];
				$expimage           = explode('.', $image);
				$count              = count($expimage);
				$image_ext          = $expimage[$count - 1];
				$image_name         = 's_sig' . $admno . '_' . $class . '_' . $roll . '.' . $image_ext;
				$imagepath_s          = "Cbse_Reg/s_signature/" . $image_name;
				move_uploaded_file($_FILES["f_signature"]["tmp_name"][$i], $imagepath_s);
				$image = imagecreatefromjpeg($imagepath_s);
				imagejpeg($image, $imagepath_s, $quality);
				$imgList_signature = $imagepath_s;
			} else {
				$imagepath_s  = '';
			}
		}


		$saveDataNotice = array(
			'RGN_CODE' => $RGN_CODE,
			'aadhaar' => $aadhaar,
			'EXAM_S_CODE' => $EXAM_S_CODE,
			'adm_date' => $adm_date,
			'CLASS_TEACHER' => $CLASS_TEACHER,
			'sec' => $sec,
			'roll' => $roll,
			'name' => $name,
			'fname' => $fname,
			'mname' => $mname,
			'dob' => $dob,
			'sex' => $sex,
			'category' => $category,
			'minority' => $minority,
			'lng' => $lng,
			'Penum' => $Penum,
			'mobile' => $mobile,
			'address' => $address,
			'income' => $income,
			'email' => $email,
			'child' => $child,
			'admission_no' => $adm_no,
			'photo' => $imgList,
			's_signature' => $imgList_signature,
			'subject' => serialize($data_s),
			'bord_name' => $bord_name,
			'bord_roll' => $bord_roll,
			'bord_year' => $bord_year,
			'class' => $class,
			'stream' => $stream

		);
		$this->alam->insert('temp_cbse_reg', $saveDataNotice);

		//$insertLastId = $this->db->insert_id();
	}

	public function update_temp_student()
	{
		$quality = 40;
		$aadhaar = $this->input->post('aadhaar');
		$sec = $this->input->post('sec');
		$roll = $this->input->post('roll');

		$name = strtoupper($this->input->post('name'));
		$class = $this->input->post('class');
		$fname = strtoupper($this->input->post('f_name'));
		$mname = strtoupper($this->input->post('m_name'));
		$dob = $this->input->post('dob');
		$sex = $this->input->post('sex');
		$category = $this->input->post('category');

		$lng = $this->input->post('optsub');
		$mobile = $this->input->post('mobile');
		$address = strtoupper($this->input->post('address'));
		$income = $this->input->post('income');

		$email = $this->input->post('email');
		$minority = $this->input->post('Minority');
		$child = $this->input->post('M_Child');
		$adm_no = $this->input->post('adm_no');
		$RGN_CODE = $this->input->post('RGN_CODE');
		$EXAM_S_CODE = $this->input->post('EXAM_S_CODE');
		$CLASS_TEACHER = strtoupper($this->input->post('CLASS_TEACHER'));
		$admno = str_replace("/", "-", $adm_no);
		$vrf = $this->dbcon->select('temp_cbse_reg', '*', "verify=1 AND admission_no='$adm_no'");
		if (sizeof($vrf) == 0) {
			if ($_FILES['photo']['name'][0] != "") {

				$imgList = array();
				for ($i = 0; $i < count($_FILES['photo']['name']); $i++) {
					if (!empty($_FILES['photo']['name'][$i])) {
						$image              = $_FILES['photo']['name'][$i];
						$expimage           = explode('.', $image);
						$count              = count($expimage);
						$image_ext          = $expimage[$count - 1];
						$image_name         = $admno . '_' . $class . '_' . $roll . '.' . $image_ext;
						$imagepath          = "Cbse_Reg/profile/" . $image_name;
						move_uploaded_file($_FILES["photo"]["tmp_name"][$i], $imagepath);
						//$image = imagecreatefromjpeg($imagepath); 
						//imagejpeg($image,$imagepath, $quality);
						$imgList = $imagepath;
					} else {
						$imagepath  = '';
					}
				}
			}

			if ($_FILES['f_signature']['name'][0] != "") {

				$imgList_father = array();
				for ($i = 0; $i < count($_FILES['f_signature']['name']); $i++) {
					if (!empty($_FILES['f_signature']['name'][$i])) {
						$image              = $_FILES['f_signature']['name'][$i];
						$expimage           = explode('.', $image);
						$count              = count($expimage);
						$image_ext          = $expimage[$count - 1];
						$image_name         = 'f_sig' . $admno . '_' . $class . '_' . $roll . '.' . $image_ext;
						$imagepath_f          = "Cbse_Reg/f_signature/" . $image_name;
						move_uploaded_file($_FILES["f_signature"]["tmp_name"][$i], $imagepath_f);
						//	$image = imagecreatefromjpeg($imagepath_f); 
						//imagejpeg($image,$imagepath_f, $quality);
						$imgList_father = $imagepath_f;
					} else {
						$imagepath_f  = '';
					}
				}
			}

			if ($_FILES['m_signature']['name'][0] != "") {

				$imgList_mother = array();
				for ($i = 0; $i < count($_FILES['m_signature']['name']); $i++) {
					if (!empty($_FILES['m_signature']['name'][$i])) {
						$image              = $_FILES['m_signature']['name'][$i];
						$expimage           = explode('.', $image);
						$count              = count($expimage);
						$image_ext          = $expimage[$count - 1];
						$image_name         = 'm_sig' . $admno . '_' . $class . '_' . $roll . '.' . $image_ext;
						$imagepath_m          = "Cbse_Reg/m_signature/" . $image_name;
						move_uploaded_file($_FILES["m_signature"]["tmp_name"][$i], $imagepath_m);
						//$image = imagecreatefromjpeg($imagepath_m); 
						//imagejpeg($image,$imagepath_m, $quality);
						$imgList_mother = $imagepath_m;
					} else {
						$imagepath_m  = '';
					}
				}
			}



			$saveDataNotice = array(
				'RGN_CODE' => $RGN_CODE,
				'aadhaar' => $aadhaar,
				'EXAM_S_CODE' => $EXAM_S_CODE,
				'CLASS_TEACHER' => $CLASS_TEACHER,
				'sec' => $sec,
				'roll' => $roll,
				'name' => $name,
				'fname' => $fname,
				'mname' => $mname,
				'dob' => $dob,
				'sex' => $sex,
				'category' => $category,
				'minority' => $minority,
				'lng' => $lng,
				'mobile' => $mobile,
				'address' => $address,
				'income' => $income,
				'email' => $email,
				'child' => $child,
				'admission_no' => $adm_no

			);

			if (isset($_POST['verify'])) {
				date_default_timezone_set('Australia/Melbourne');
				$date = date('m/d/Y h:i:s a', time());
				$data = array('verify' => $_POST['verify'], 'verified_by' => $_POST['verified_By'], 'verified_date' => $date, 'verified_emp_id' => $_POST['verified_emp_id']);
				$saveDataNotice = array_merge($data, $saveDataNotice);
			}
			if ($_FILES['photo']['name'][0] != "") {
				$data = array('photo' => $imgList);
				$saveDataNotice = array_merge($data, $saveDataNotice);
			}
			if ($_FILES['f_signature']['name'][0] != "") {
				$data = array('f_signature' => $imgList_father);
				$saveDataNotice = array_merge($data, $saveDataNotice);
			}
			if ($_FILES['m_signature']['name'][0] != "") {
				$data = array('m_signature' => $imgList_mother);
				$saveDataNotice = array_merge($data, $saveDataNotice);
			}

			$this->alam->update('temp_cbse_reg', $saveDataNotice, "admission_no='$adm_no'");
		} else {
			echo 1;
		}
		//$insertLastId = $this->db->insert_id();
	}

	public function Print_user_profile_xi($id)
	{
		// 		echo $id;
		$stuData = $this->alam->selectA('temp_cbse_reg', "*", "id='$id'");
		// 		echo $this->db->last_query();
		$data = array('temp_data' => $stuData);
		// echo'<pre>';print_r($data);die;
		$this->load->view('cbse_verify_admin/Print_user_profile_xi', $data);
		// $html = $this->output->get_output();
		// $this->load->library('pdf');
		// $this->dompdf->loadHtml($html);
		// $this->dompdf->setPaper('A4', 'portrait');
		// $this->dompdf->render();
		// $this->dompdf->stream("student_proflile.pdf", array("Attachment" => 0));
	}

	public function fetch_teacher()
	{
		$section = $this->input->post('subject_id');
		$log_det = $this->dbcon->select('login_details', 'emp_name', "Section_No='$section'");
		$emp_name = $log_det[0]->emp_name;
		$array = array($emp_name);
		echo json_encode($array);
	}

	public function Print_user_profile($id)
	{
		// $id = $this->input->get('id');
		// echo $id;die;
		$stuData = $this->alam->selectA('temp_cbse_reg', "*", "id='$id'");
		// $this->db->query("SELECT * FROM `temp_cbse_reg` where id='$id'")->result();
		// echo $this->db->last_query();die;
		$data = array('temp_data' => $stuData);

		 //$stuData = $this->alam->selectA('temp_cbse_reg', "*,(select SECTION_NAME from sections where section_no=temp_cbse_reg.sec)secnm, (select SUBJECT1 from student where ADM_NO=temp_cbse_reg.admission_no)subj1, (select  SUBJECT2 from student where ADM_NO=temp_cbse_reg.admission_no)subj2, (select SUBJECT3 from student where ADM_NO=temp_cbse_reg.admission_no)subj3, (select SUBJECT4 from student where ADM_NO=temp_cbse_reg.admission_no)subj4, (select SUBJECT5 from student where ADM_NO=temp_cbse_reg.admission_no)subj5, (select SUBJECT6 from student where ADM_NO=temp_cbse_reg.admission_no)subj6", "id='$id'");

		$this->load->view('cbse_verify_admin/Print_user_profile', $data);
		// $html = $this->output->get_output();
		// $this->load->library('pdf');
		// $this->dompdf->loadHtml($html);
		// $this->dompdf->setPaper('A4', 'portrait');
		// $this->dompdf->render();
		// $this->dompdf->stream("student_proflile.pdf", array("Attachment" => 0));
	}

	public function Print_user_profile_x($id)
	{
		// $id = $this->input->get('id');
		// echo $id;die;
		$stuData = $this->alam->selectA('cbse_reg_amount', "*", "id='$id'");
		// $this->db->query("SELECT * FROM `temp_cbse_reg` where id='$id'")->result();
		// echo $this->db->last_query();die;
		$data = array('temp_data' => $stuData);
		$data['stuData_fee'] = $this->alam->select('cbse_reg_amount', "*", "id='$id'");
		$AdmNo = $data['stuData_fee'][0]->AdmNo;

		$data['student_details'] = $this->alam->select('student', "*", "ADM_NO='$AdmNo'");
		// $stuData = $this->alam->selectA('temp_cbse_reg', "*,(select SECTION_NAME from sections where section_no=temp_cbse_reg.sec)secnm, (select SUBJECT1 from student where ADM_NO=temp_cbse_reg.admission_no)subj1, (select  SUBJECT2 from student where ADM_NO=temp_cbse_reg.admission_no)subj2, (select SUBJECT3 from student where ADM_NO=temp_cbse_reg.admission_no)subj3, (select SUBJECT4 from student where ADM_NO=temp_cbse_reg.admission_no)subj4, (select SUBJECT5 from student where ADM_NO=temp_cbse_reg.admission_no)subj5", "id='$id'");

		$this->load->view('cbse_verify_admin/Print_user_profile_x', $data);
		// $html = $this->output->get_output();
		// $this->load->library('pdf');
		// $this->dompdf->loadHtml($html);
		// $this->dompdf->setPaper('A4', 'portrait');
		// $this->dompdf->render();
		// $this->dompdf->stream("student_proflile.pdf", array("Attachment" => 0));
	}
	
	public function update_temp_student_xi()
	{
		$quality = 40;
		$aadhaar = $this->input->post('aadhaar');
		$sec = $this->input->post('sec');
		$roll = $this->input->post('roll');

		$name = strtoupper($this->input->post('name'));

		$fname = strtoupper($this->input->post('f_name'));
		$mname = strtoupper($this->input->post('m_name'));
		$dob = $this->input->post('dob');
		$sex = $this->input->post('sex');
		$category = $this->input->post('category');

		$lng = $this->input->post('Lng_ENG');
		$mobile = $this->input->post('mobile');
		$address = strtoupper($this->input->post('address'));
		$income = $this->input->post('income');

		$email = $this->input->post('email');
		$minority = $this->input->post('Minority');
		$child = $this->input->post('M_Child');
		$adm_no = $this->input->post('adm_no');
		$RGN_CODE = $this->input->post('RGN_CODE');
		$EXAM_S_CODE = $this->input->post('EXAM_S_CODE');
		$CLASS_TEACHER = $this->input->post('CLASS_TEACHER');

		$class = strtoupper($this->input->post('class'));

		$bord_name = strtoupper($this->input->post('bord_name'));
		$bord_roll = $this->input->post('bord_roll');
		$bord_year = $this->input->post('bord_year');
		$admno = str_replace("/", "-", $adm_no);
		$vrf = $this->dbcon->select('temp_cbse_reg', '*', "verify=1 AND admission_no='$adm_no'");
		if (sizeof($vrf) == 0) {
			if ($_FILES['photo']['name'][0] != "") {

				$imgList = array();
				for ($i = 0; $i < count($_FILES['photo']['name']); $i++) {
					if (!empty($_FILES['photo']['name'][$i])) {
						$image              = $_FILES['photo']['name'][$i];
						$expimage           = explode('.', $image);
						$count              = count($expimage);
						$image_ext          = $expimage[$count - 1];
						$image_name         = $admno . '_' . $class . '_' . $roll . '.' . $image_ext;
						$imagepath          = "Cbse_Reg/profile/" . $image_name;
						move_uploaded_file($_FILES["photo"]["tmp_name"][$i], $imagepath);
						$image = imagecreatefromjpeg($imagepath);
						imagejpeg($image, $imagepath, $quality);
						$imgList = $imagepath;
					} else {
						$imagepath  = '';
					}
				}
			}
			if ($_FILES['f_signature']['name'][0] != "") {

				$imgList_father = array();
				for ($i = 0; $i < count($_FILES['f_signature']['name']); $i++) {
					if (!empty($_FILES['f_signature']['name'][$i])) {
						$image              = $_FILES['f_signature']['name'][$i];
						$expimage           = explode('.', $image);
						$count              = count($expimage);
						$image_ext          = $expimage[$count - 1];
						$image_name         = 's_sig' . $admno . '_' . $class . '_' . $roll . '.' . $image_ext;
						$imagepath_s          = "Cbse_Reg/s_signature/" . $image_name;
						move_uploaded_file($_FILES["f_signature"]["tmp_name"][$i], $imagepath_s);
						$image = imagecreatefromjpeg($imagepath_s);
						imagejpeg($image, $imagepath_s, $quality);
						$imgList_father = $imagepath_s;
					} else {
						$imagepath_s  = '';
					}
				}
			}
			$saveDataNotice = array(
				'RGN_CODE' => $RGN_CODE,
				'aadhaar' => $aadhaar,
				'EXAM_S_CODE' => $EXAM_S_CODE,
				'CLASS_TEACHER' => $CLASS_TEACHER,
				'sec' => $sec,
				'roll' => $roll,
				'name' => $name,
				'fname' => $fname,
				'mname' => $mname,
				'dob' => $dob,
				'sex' => $sex,
				'category' => $category,
				'minority' => $minority,
				'lng' => $lng,
				'mobile' => $mobile,
				'address' => $address,
				'income' => $income,
				'email' => $email,
				'child' => $child,
				'admission_no' => $adm_no,

				'bord_name' => $bord_name,
				'bord_roll' => $bord_roll,
				'bord_year' => $bord_year,
				'class' => $class


			);

			if (isset($_POST['verify'])) {
				date_default_timezone_set('Australia/Melbourne');
				$date = date('m/d/Y h:i:s a', time());
				$data = array('verify' => $_POST['verify'], 'verified_by' => $_POST['verified_By'], 'verified_date' => $date, 'verified_emp_id' => $_POST['verified_emp_id']);
				$saveDataNotice = array_merge($data, $saveDataNotice);
			}

			if (isset($_POST['stream'])) {
				//$subject=$this->input->post('subject');	
				if ($_POST['stream'] != "") {
					$stream = $this->input->post('stream');
					if ($stream == 'Science') {
						if ($lng == "MATHEMATICS") {
							$op = $this->input->post('subject_m');

							$data_s = array("ENGLISH", "MATHEMATICS", "PHYSICS", "CHEMISTRY", "PAINTING", "$op");
						} else {
							$op = $this->input->post('subject_b');
							$data_s = array("ENGLISH", "BIOLOGY", "PHYSICS", "CHEMISTRY", "PAINTING", "$op");
						}
					} else if ($stream == 'Commerce') {
						$op = $this->input->post('subject_c');
						$data_s = array("ENGLISH", "ECONOMICS", "BUSINESS STUDIES", "ACCOUNTANCY", "PAINTING", "$op");
					} else {
						$op = $this->input->post('subject_a');

						$data_s = array("ENGLISH", "HINDI", "HISTORY", "POLITICAL SCIENCE", "PAINTING", "$op");
					}

					$data = array('subject' => serialize($data_s), 'stream' => $stream);

					$saveDataNotice = array_merge($data, $saveDataNotice);
				}
			}

			if ($_FILES['photo']['name'][0] != "") {
				$data = array('photo' => $imgList);
				$saveDataNotice = array_merge($data, $saveDataNotice);
			}
			if ($_FILES['f_signature']['name'][0] != "") {
				$data = array('s_signature' => $imgList_father);
				$saveDataNotice = array_merge($data, $saveDataNotice);
			}

			$this->alam->update('temp_cbse_reg', $saveDataNotice, "admission_no='$adm_no'");
		} else {
			echo 1;
		}
		//$insertLastId = $this->db->insert_id();
	}
}
