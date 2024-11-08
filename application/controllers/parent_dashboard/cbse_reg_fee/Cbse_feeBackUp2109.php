<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cbse_fee extends MY_controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('Alam','alam');
		$this->load->model('Mymodel','dbcon');
		error_reporting(0);
	}


	public function cbse_registration(){
		
		$adm_no = $this->session->userdata('adm');
			
		$std_id = $this->session->userdata('std_id');
		$class_code = $this->session->userdata('class_code');
		$data['stu_data'] = $this->dbcon->select('cbse_reg_amount','*',"AdmNo='$adm_no'");
	
	   $this->Parent_templete('parents_dashboard/cbse_reg_fee/cbse_registration',$data);
	
	}
	
	public function cbse_registration_XI(){
		
		$adm_no = $this->session->userdata('adm');
			
		$std_id = $this->session->userdata('std_id');
		$class_code = $this->session->userdata('class_code');
		$data = $this->dbcon->select('student_attendance_type','*',"class_code='$class_code'");
		$session_master = $this->dbcon->select('session_master','*',"Active_Status=1");
		
		$sections = $this->dbcon->select('sections','*');
		$temp_user_data = $this->dbcon->select('temp_cbse_reg','*',"admission_no='$adm_no'");
		
		$session_year = $session_master[0]->Session_Year;
		
		$student = $this->dbcon->show_student($std_id);
		
		$array = array(
			'data' => $data,
			'student' => $student,
			'sections'=>$sections,
			'temp_data'=>$temp_user_data
		);
		
	    $this->Parent_templete('parents_dashboard/Cbse_Reg/cbse_registration_XI',$array);
	
	}
	

		public function save_temp_student(){
		$quality=40;
		$aadhaar=$this->input->post('aadhaar');
		$sec=$this->input->post('sec');
		$roll=$this->input->post('roll');
		$name=strtoupper($this->input->post('name'));
		$fname=strtoupper($this->input->post('f_name'));
		$mname=strtoupper($this->input->post('m_name'));
		$dob=$this->input->post('dob');
		$sex=$this->input->post('sex');
		$adm_date=$this->input->post('adm_date');
		$category=$this->input->post('category');
		$lng=$this->input->post('Lng_ENG');
		$mobile=$this->input->post('mobile');
		$address=strtoupper($this->input->post('address'));
		$income=$this->input->post('income');
		$email=$this->input->post('email');
	   $minority=$this->input->post('Minority');	
	    $child=$this->input->post('M_Child');	
		$adm_no=$this->input->post('adm_no');	
		$RGN_CODE=$this->input->post('RGN_CODE');	
		$EXAM_S_CODE=$this->input->post('EXAM_S_CODE');	
		$CLASS_TEACHER=$this->input->post('CLASS_TEACHER');	
		$class=$this->input->post('class');	
			$admno=str_replace("/","-",$adm_no);
		$imgList = array();
		for($i=0; $i<count($_FILES['photo']['name']); $i++){
			if(!empty($_FILES['photo']['name'][$i])){
			$image              = $_FILES['photo']['name'][$i]; 
			$expimage           = explode('.',$image);
			$count              = count($expimage);
			$image_ext          = $expimage[$count-1];
		
			$image_name         = $admno.'_'.$class.'_'.$roll.'.'.$image_ext;
			$imagepath          = "Cbse_Reg/profile/".$image_name;
			move_uploaded_file($_FILES["photo"]["tmp_name"][$i],$imagepath);
			
		
		//$image = imagecreatefromjpeg($imagepath); 
		//imagejpeg($image,$imagepath, $quality);

			$imgList = $imagepath;
			}else{
				$imagepath  = '';
			}
		}
			$imgList_father = array();
		for($i=0; $i<count($_FILES['f_signature']['name']); $i++){
			if(!empty($_FILES['f_signature']['name'][$i])){
			$image              = $_FILES['f_signature']['name'][$i]; 
			$expimage           = explode('.',$image);
			$count              = count($expimage);
			$image_ext          = $expimage[$count-1];
			
			$image_name         = 'f_sig'.$admno.'_'.$class.'_'.$roll.'.'.$image_ext;
			$imagepath_f          = "Cbse_Reg/f_signature/".$image_name;
			move_uploaded_file($_FILES["f_signature"]["tmp_name"][$i],$imagepath_f);
					//$image = imagecreatefromjpeg($imagepath_f); 
		//imagejpeg($image,$imagepath_f, $quality);
			$imgList_father = $imagepath_f;
			}else{
				$imagepath_f  = '';
			}
		}
			$imgList_mother = array();
		for($i=0; $i<count($_FILES['m_signature']['name']); $i++){
			if(!empty($_FILES['m_signature']['name'][$i])){
			$image              = $_FILES['m_signature']['name'][$i]; 
			$expimage           = explode('.',$image);
			$count              = count($expimage);
			$image_ext          = $expimage[$count-1];
			$image_name         = 'm_sig'.$admno.'_'.$class.'_'.$roll.'.'.$image_ext;
			$imagepath_m          = "Cbse_Reg/m_signature/".$image_name;
			move_uploaded_file($_FILES["m_signature"]["tmp_name"][$i],$imagepath_m);
			//$image = imagecreatefromjpeg($imagepath_m); 
		//imagejpeg($image,$imagepath_m, $quality);
			$imgList_mother = $imagepath_m;
			}else{
				$imagepath_m  = '';
			}
		}
			
		$saveDataNotice =array(
		'RGN_CODE'=>$RGN_CODE,
		'aadhaar'=>$aadhaar,
		'EXAM_S_CODE'=>$EXAM_S_CODE,
		'adm_date'=>$adm_date,
		'CLASS_TEACHER'=>$CLASS_TEACHER,
		'sec'=>$sec,
		'roll'=>$roll,
		'name'=>$name,
		'fname'=>$fname,
		'mname'=>$mname,
		'dob'=>$dob,
		'sex'=>$sex,
		'category'=>$category,
		'minority'=>$minority,
		'lng'=>$lng,
		'mobile'=>$mobile,
		'address'=>$address,
		'income'=>$income,
		'email'=>$email,
		'child'=>$child,
		'admission_no'=>$adm_no,
		'photo'=> $imgList,
		'f_signature'=> $imgList_father,
		'm_signature'=> $imgList_mother,
		'class'=>$class
		);
		$this->alam->insert('temp_cbse_reg',$saveDataNotice);
		
		//$insertLastId = $this->db->insert_id();
		
			
    // Get image info 
		
}

	public function save_temp_student_xi(){
			$quality=40;
		$aadhaar=$this->input->post('aadhaar');
		$sec=$this->input->post('sec');
		$roll=$this->input->post('roll');
		
	$name=strtoupper($this->input->post('name'));
	
	$fname=strtoupper($this->input->post('f_name'));
		$mname=strtoupper($this->input->post('m_name'));
		$dob=$this->input->post('dob');
		$sex=$this->input->post('sex');
		$adm_date=$this->input->post('adm_date');
		$category=$this->input->post('category');

		$lng=$this->input->post('Lng_ENG');
		$mobile=$this->input->post('mobile');
		$address=strtoupper($this->input->post('address'));
		$income=$this->input->post('income');
		$email=$this->input->post('email');
	   $minority=$this->input->post('Minority');	
	    $child=$this->input->post('M_Child');	
		$adm_no=$this->input->post('adm_no');	
		$RGN_CODE=$this->input->post('RGN_CODE');	
		$EXAM_S_CODE=$this->input->post('EXAM_S_CODE');	
		$CLASS_TEACHER=strtoupper($this->input->post('CLASS_TEACHER'));	
		$subject=$this->input->post('subject');	
		$class=$this->input->post('class');	
		$stream=$this->input->post('stream');	
		$bord_name=strtoupper($this->input->post('bord_name'));	
		$bord_roll=$this->input->post('bord_roll');	
		$bord_year=$this->input->post('bord_year');	
		$admno=str_replace("/","-",$adm_no);
		if($stream =='Science'){
			if($lng == "MATHEMATICS"){
				$op=$this->input->post('subject_m');
				
				$data_s= array("ENGLISH","MATHEMATICS","PHYSICS","CHEMISTRY","PAINTING","$op");
			}else{
				$op=$this->input->post('subject_b');
				$data_s= array("ENGLISH","BIOLOGY","PHYSICS","CHEMISTRY","PAINTING","$op");
			}
			}else if($stream =='Commerce'){
				$op=$this->input->post('subject_c');
				$data_s= array("ENGLISH","ECONOMICS","BUSINESS STUDIES","ACCOUNTANCY","PAINTING","$op");
				
			}else{
				$op=$this->input->post('subject_a');
				
				$data_s= array("ENGLISH","HINDI","HISTORY","POLITICAL SCIENCE","PAINTING","$op");
			}
			
			
		$imgList = array();
		for($i=0; $i<count($_FILES['photo']['name']); $i++){
			if(!empty($_FILES['photo']['name'][$i])){
			$image              = $_FILES['photo']['name'][$i]; 
			$expimage           = explode('.',$image);
			$count              = count($expimage);
			$image_ext          = $expimage[$count-1];
			$image_name         = $admno.'_'.$class.'_'.$roll.'.'.$image_ext;
			$imagepath          = "Cbse_Reg/profile/".$image_name;
		
			move_uploaded_file($_FILES["photo"]["tmp_name"][$i],$imagepath);
			$image = imagecreatefromjpeg($imagepath); 
		imagejpeg($image,$imagepath, $quality);
			$imgList = $imagepath;
			}else{
				$imagepath  = '';
			}
		}
			$imgList_signature = array();
		for($i=0; $i<count($_FILES['f_signature']['name']); $i++){
			if(!empty($_FILES['f_signature']['name'][$i])){
			$image              = $_FILES['f_signature']['name'][$i]; 
			$expimage           = explode('.',$image);
			$count              = count($expimage);
			$image_ext          = $expimage[$count-1];
			$image_name         = 's_sig'.$admno.'_'.$class.'_'.$roll.'.'.$image_ext;
			$imagepath_s          = "Cbse_Reg/s_signature/".$image_name;
			move_uploaded_file($_FILES["f_signature"]["tmp_name"][$i],$imagepath_s);
			$image = imagecreatefromjpeg($imagepath_s); 
		imagejpeg($image,$imagepath_s, $quality);
			$imgList_signature = $imagepath_s;
			}else{
				$imagepath_s  = '';
			}
		}
			
			
		$saveDataNotice =array(
		'RGN_CODE'=>$RGN_CODE,
		'aadhaar'=>$aadhaar,
		'EXAM_S_CODE'=>$EXAM_S_CODE,
		'adm_date'=>$adm_date,
		'CLASS_TEACHER'=>$CLASS_TEACHER,
		'sec'=>$sec,
		'roll'=>$roll,
		'name'=>$name,
		'fname'=>$fname,
		'mname'=>$mname,
		'dob'=>$dob,
		'sex'=>$sex,
		'category'=>$category,
		'minority'=>$minority,
		'lng'=>$lng,
		'mobile'=>$mobile,
		'address'=>$address,
		'income'=>$income,
		'email'=>$email,
		'child'=>$child,
		'admission_no'=>$adm_no,
		'photo'=> $imgList,
		's_signature'=> $imgList_signature,
		'subject'=> serialize($data_s),
		'bord_name'=> $bord_name,	
		'bord_roll'=> $bord_roll,
		'bord_year'=> $bord_year,
			'class'=>$class,
			'stream'=>$stream
		
		);
		$this->alam->insert('temp_cbse_reg',$saveDataNotice);
		
		//$insertLastId = $this->db->insert_id();
}

public function update_temp_student(){
			$quality=40;
		$aadhaar=$this->input->post('aadhaar');
		$sec=$this->input->post('sec');
		$roll=$this->input->post('roll');
		
	$name=strtoupper($this->input->post('name'));
	$class=$this->input->post('class');	
	$fname=strtoupper($this->input->post('f_name'));
		$mname=strtoupper($this->input->post('m_name'));
		$dob=$this->input->post('dob');
		$sex=$this->input->post('sex');
		$category=$this->input->post('category');

		$lng=$this->input->post('Lng_ENG');
		$mobile=$this->input->post('mobile');
		$address=strtoupper($this->input->post('address'));
		$income=$this->input->post('income');
		
		$email=$this->input->post('email');
	   $minority=$this->input->post('Minority');	
	    $child=$this->input->post('M_Child');	
		$adm_no=$this->input->post('adm_no');	
		$RGN_CODE=$this->input->post('RGN_CODE');	
		$EXAM_S_CODE=$this->input->post('EXAM_S_CODE');	
		$CLASS_TEACHER=strtoupper($this->input->post('CLASS_TEACHER'));	
		$admno=str_replace("/","-",$adm_no);
		$vrf = $this->dbcon->select('temp_cbse_reg','*',"verify=1 AND admission_no='$adm_no'");
		if(sizeof($vrf)==0){
	if($_FILES['photo']['name'][0]!=""){
		
		$imgList = array();
		for($i=0; $i<count($_FILES['photo']['name']); $i++){
			if(!empty($_FILES['photo']['name'][$i])){
			$image              = $_FILES['photo']['name'][$i]; 
			$expimage           = explode('.',$image);
			$count              = count($expimage);
			$image_ext          = $expimage[$count-1];
			$image_name         = $admno.'_'.$class.'_'.$roll.'.'.$image_ext;
			$imagepath          = "Cbse_Reg/profile/".$image_name;
			move_uploaded_file($_FILES["photo"]["tmp_name"][$i],$imagepath);
				//$image = imagecreatefromjpeg($imagepath); 
		//imagejpeg($image,$imagepath, $quality);
			$imgList = $imagepath;
			
			}else{
				$imagepath  = '';
			}
		}
	}
		
			if($_FILES['f_signature']['name'][0]!=""){
		
		$imgList_father = array();
		for($i=0; $i<count($_FILES['f_signature']['name']); $i++){
			if(!empty($_FILES['f_signature']['name'][$i])){
			$image              = $_FILES['f_signature']['name'][$i]; 
			$expimage           = explode('.',$image);
			$count              = count($expimage);
			$image_ext          = $expimage[$count-1];
			$image_name         = 'f_sig'.$admno.'_'.$class.'_'.$roll.'.'.$image_ext;
			$imagepath_f          = "Cbse_Reg/f_signature/".$image_name;
			move_uploaded_file($_FILES["f_signature"]["tmp_name"][$i],$imagepath_f);
				//	$image = imagecreatefromjpeg($imagepath_f); 
		//imagejpeg($image,$imagepath_f, $quality);
			$imgList_father = $imagepath_f;
			}else{
				$imagepath_f  = '';
			}
		}
	}
		
			if($_FILES['m_signature']['name'][0]!=""){
		
			$imgList_mother = array();
		for($i=0; $i<count($_FILES['m_signature']['name']); $i++){
			if(!empty($_FILES['m_signature']['name'][$i])){
			$image              = $_FILES['m_signature']['name'][$i]; 
			$expimage           = explode('.',$image);
			$count              = count($expimage);
			$image_ext          = $expimage[$count-1];
	        $image_name         = 'm_sig'.$admno.'_'.$class.'_'.$roll.'.'.$image_ext; 
			$imagepath_m          = "Cbse_Reg/m_signature/".$image_name;
			move_uploaded_file($_FILES["m_signature"]["tmp_name"][$i],$imagepath_m);
					//$image = imagecreatefromjpeg($imagepath_m); 
		//imagejpeg($image,$imagepath_m, $quality);
			$imgList_mother = $imagepath_m;
			}else{
				$imagepath_m  = '';
			}
		}
	}
		
			
			
		$saveDataNotice =array(
		'RGN_CODE'=>$RGN_CODE,
		'aadhaar'=>$aadhaar,
		'EXAM_S_CODE'=>$EXAM_S_CODE,
		'CLASS_TEACHER'=>$CLASS_TEACHER,
		'sec'=>$sec,
		'roll'=>$roll,
		'name'=>$name,
		'fname'=>$fname,
		'mname'=>$mname,
		'dob'=>$dob,
		'sex'=>$sex,
		'category'=>$category,
		'minority'=>$minority,
		'lng'=>$lng,
		'mobile'=>$mobile,
		'address'=>$address,
		'income'=>$income,
		'email'=>$email,
		'child'=>$child,
		'admission_no'=>$adm_no
		
		);
		
		if(isset($_POST['verify'])){
			date_default_timezone_set('Australia/Melbourne');
           $date = date('m/d/Y h:i:s a', time());
			$data=array('verify'=> $_POST['verify'],'verified_by'=>$_POST['verified_By'],'verified_date'=>$date,'verified_emp_id'=>$_POST['verified_emp_id']);
			$saveDataNotice= array_merge($data,$saveDataNotice);
		}
			if($_FILES['photo']['name'][0]!=""){
			$data=array('photo'=> $imgList);
			$saveDataNotice= array_merge($data,$saveDataNotice);
		}
		if($_FILES['f_signature']['name'][0]!=""){
			$data=array('f_signature'=> $imgList_father);
			$saveDataNotice= array_merge($data,$saveDataNotice);
		}
		if($_FILES['m_signature']['name'][0]!=""){
			$data=array('m_signature'=> $imgList_mother);
			$saveDataNotice= array_merge($data,$saveDataNotice);
		}
			
		$this->alam->update('temp_cbse_reg',$saveDataNotice,"admission_no='$adm_no'");
		}else{
			echo 1;
		}
		//$insertLastId = $this->db->insert_id();
}
public function Print_user_profile_x_xii_reprint(){
$adm_no=$this->session->userdata('adm');
$stu=$this->dbcon->select("cbse_reg_amount",'id',"AdmNo='$adm_no'");
	$_SESSION['iide']=$stu[0]->id;
	redirect('parent_dashboard/cbse_reg_fee/Cbse_fee/Print_user_profile_x_xii');
}
public function Print_user_profile_x_xii(){
if(!isset($_SESSION['iide'])){
redirect('parent_dashboard/cbse_reg_fee/Cbse_fee/cbse_registration');
}
	$id= $_SESSION['iide'];
	   $data['school_setting'] = $this->dbcon->select('school_setting','*');
	
		$data['stuData_fee'] = $this->alam->select('cbse_reg_amount',"*","id='$id'");
	 $AdmNo=$data['stuData_fee'][0]->AdmNo;
	
		$data['student_details'] = $this->alam->select('student',"*","ADM_NO='$AdmNo'");
		$this->load->view('parents_dashboard/response_fee',$data);
		//$html = $this->output->get_output();
		//$this->load->library('pdf');
		//$this->dompdf->loadHtml($html);
		//$this->dompdf->setPaper('A4', 'portrait');
		//$this->dompdf->render();
		//$this->dompdf->stream("student_proflile.pdf", array("Attachment"=>0));
}
	public function fetch_teacher(){
		$section = $this->input->post('subject_id');
	$log_det = $this->dbcon->select('login_details','emp_name',"Section_No='$section'");
		$emp_name = $log_det[0]->emp_name;
		$array = array($emp_name);
		echo json_encode($array);
	}

public function Print_user_profile($id){
	  
		$stuData = $this->alam->selectA('temp_cbse_reg',"*,(select SECTION_NAME from sections where section_no=temp_cbse_reg.sec)secnm","id='$id'");
		$data=array('temp_data'=>$stuData);
		
		$this->load->view('cbse_verify_admin/Print_user_profile',$data);
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'portrait');
		$this->dompdf->render();
		$this->dompdf->stream("student_proflile.pdf", array("Attachment"=>0));
}

	public function update_temp_student_xi(){
			$quality=40;
		$aadhaar=$this->input->post('aadhaar');
		$sec=$this->input->post('sec');
		$roll=$this->input->post('roll');
		
	$name=strtoupper($this->input->post('name'));
	
	$fname=strtoupper($this->input->post('f_name'));
		$mname=strtoupper($this->input->post('m_name'));
		$dob=$this->input->post('dob');
		$sex=$this->input->post('sex');
		$category=$this->input->post('category');

		$lng=$this->input->post('Lng_ENG');
		$mobile=$this->input->post('mobile');
		$address=strtoupper($this->input->post('address'));
		$income=$this->input->post('income');
		
		$email=$this->input->post('email');
	   $minority=$this->input->post('Minority');	
	    $child=$this->input->post('M_Child');	
		$adm_no=$this->input->post('adm_no');	
		$RGN_CODE=$this->input->post('RGN_CODE');	
		$EXAM_S_CODE=$this->input->post('EXAM_S_CODE');	
		$CLASS_TEACHER=$this->input->post('CLASS_TEACHER');
		
		$class=strtoupper($this->input->post('class'));	
			
		$bord_name=strtoupper($this->input->post('bord_name'));	
		$bord_roll=$this->input->post('bord_roll');	
		$bord_year=$this->input->post('bord_year');
        $admno=str_replace("/","-",$adm_no);
		$vrf = $this->dbcon->select('temp_cbse_reg','*',"verify=1 AND admission_no='$adm_no'");
		if(sizeof($vrf)==0){		
	if($_FILES['photo']['name'][0]!=""){
		
		$imgList = array();
		for($i=0; $i<count($_FILES['photo']['name']); $i++){
			if(!empty($_FILES['photo']['name'][$i])){
			$image              = $_FILES['photo']['name'][$i]; 
			$expimage           = explode('.',$image);
			$count              = count($expimage);
			$image_ext          = $expimage[$count-1];
			$image_name         = $admno.'_'.$class.'_'.$roll.'.'.$image_ext;
			$imagepath          = "Cbse_Reg/profile/".$image_name;
			move_uploaded_file($_FILES["photo"]["tmp_name"][$i],$imagepath);
				$image = imagecreatefromjpeg($imagepath); 
		imagejpeg($image,$imagepath, $quality);
			$imgList = $imagepath;
			}else{
				$imagepath  = '';
			  }
		    }
	     }
		if($_FILES['f_signature']['name'][0]!=""){
		
		$imgList_father = array();
		for($i=0; $i<count($_FILES['f_signature']['name']); $i++){
			if(!empty($_FILES['f_signature']['name'][$i])){
			$image              = $_FILES['f_signature']['name'][$i]; 
			$expimage           = explode('.',$image);
			$count              = count($expimage);
			$image_ext          = $expimage[$count-1];
			$image_name         = 's_sig'.$admno.'_'.$class.'_'.$roll.'.'.$image_ext;
			$imagepath_s          = "Cbse_Reg/s_signature/".$image_name;
			move_uploaded_file($_FILES["f_signature"]["tmp_name"][$i],$imagepath_s);
				$image = imagecreatefromjpeg($imagepath_s); 
		imagejpeg($image,$imagepath_s, $quality);
			$imgList_father = $imagepath_s;
			}else{
				$imagepath_s  = '';
			}
		}
	}
		$saveDataNotice =array(
		'RGN_CODE'=>$RGN_CODE,
		'aadhaar'=>$aadhaar,
		'EXAM_S_CODE'=>$EXAM_S_CODE,
		'CLASS_TEACHER'=>$CLASS_TEACHER,
		'sec'=>$sec,
		'roll'=>$roll,
		'name'=>$name,
		'fname'=>$fname,
		'mname'=>$mname,
		'dob'=>$dob,
		'sex'=>$sex,
		'category'=>$category,
		'minority'=>$minority,
		'lng'=>$lng,
		'mobile'=>$mobile,
		'address'=>$address,
		'income'=>$income,
		'email'=>$email,
		'child'=>$child,
		'admission_no'=>$adm_no,
	
		'bord_name'=> $bord_name,	
		'bord_roll'=> $bord_roll,
		'bord_year'=> $bord_year,
			'class'=>$class
			
		
		);
		
		if(isset($_POST['verify'])){
			date_default_timezone_set('Australia/Melbourne');
           $date = date('m/d/Y h:i:s a', time());
			$data=array('verify'=> $_POST['verify'],'verified_by'=>$_POST['verified_By'],'verified_date'=>$date,'verified_emp_id'=>$_POST['verified_emp_id']);
			$saveDataNotice= array_merge($data,$saveDataNotice);
		}
		
		if(isset($_POST['stream'])){
			//$subject=$this->input->post('subject');	
			if($_POST['stream'] !=""){
				$stream=$this->input->post('stream');
					if($stream =='Science'){
			if($lng == "MATHEMATICS"){
				$op=$this->input->post('subject_m');
				
				$data_s= array("ENGLISH","MATHEMATICS","PHYSICS","CHEMISTRY","PAINTING","$op");
			}else{
				$op=$this->input->post('subject_b');
				$data_s= array("ENGLISH","BIOLOGY","PHYSICS","CHEMISTRY","PAINTING","$op");
			}
			}else if($stream =='Commerce'){
				$op=$this->input->post('subject_c');
				$data_s= array("ENGLISH","ECONOMICS","BUSINESS STUDIES","ACCOUNTANCY","PAINTING","$op");
				
			}else{
				$op=$this->input->post('subject_a');
				
				$data_s= array("ENGLISH","HINDI","HISTORY","POLITICAL SCIENCE","PAINTING","$op");
			}
			
			$data=array('subject'=> serialize($data_s),'stream'=> $stream);
		
			$saveDataNotice= array_merge($data,$saveDataNotice);
			}
		}
		
			if($_FILES['photo']['name'][0]!=""){
			$data=array('photo'=> $imgList);
			$saveDataNotice= array_merge($data,$saveDataNotice);
		}
		if($_FILES['f_signature']['name'][0]!=""){
			$data=array('s_signature'=> $imgList_father);
			$saveDataNotice= array_merge($data,$saveDataNotice);
		}
	
		$this->alam->update('temp_cbse_reg',$saveDataNotice,"admission_no='$adm_no'");
		}else{
			echo 1;
		}
		//$insertLastId = $this->db->insert_id();
}
 
}