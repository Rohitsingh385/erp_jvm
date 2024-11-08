<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Marks_entry extends MY_controller
{

	public function __construct()
	{
		parent::__construct();
		$this->loggedOut();
		$this->load->model('Mymodel', 'dbcon');
		$this->load->model('Alam', 'alam');
	}

	public function index()
	{
		$report_card_permission = $this->alam->selectA('report_card_permission', '*');
		$t1 = $report_card_permission[0]['term1'];
		$t2 = $report_card_permission[0]['term2'];
		$mock_exam = $report_card_permission[0]['mock_exam'];

		$array = array('t1' => $t1, 't2' => $t2, 'mock_exam' => $mock_exam);
		$this->teacher_template('marks_entry/marks_entry', $array);
	}


	public function half_year()
	{
		$class              = login_details['Class_No'];
		$sec                = login_details['Section_No'];
		$user_id            = login_details['user_id'];
		$role_id            = login_details['ROLE_ID'];
		
		if($class == 1 || $class == 2 || $class == 3 || $class == 4){
			$class_data = $this->alam->selectA('class_section_wise_subject_allocation', 'distinct(Class_no),(select CLASS_NM from classes where Class_No=class_section_wise_subject_allocation.Class_No)classnm', "");
		}
		else{
			if($role_id=='4' || $role_id=='6' || $role_id=='1' || $role_id=='5' || $role_id=='10' || $role_id=='12' || $role_id=='2')
			{
				$class_data = $this->alam->selectA('class_section_wise_subject_allocation', 'distinct(Class_no),(select CLASS_NM from classes where Class_No=class_section_wise_subject_allocation.Class_No)classnm', "");
			}
			else
			{
				$class_data = $this->alam->selectA('class_section_wise_subject_allocation', 'distinct(Class_no),(select CLASS_NM from classes where Class_No=class_section_wise_subject_allocation.Class_No)classnm', "Main_Teacher_Code='$user_id'");
		//$str=$this->db->last_query();
//echo $str;
//die;
			}
		}
		


		// $class_data = $this->alam->selectA('class_section_wise_subject_allocation ','distinct(Class_no),(select CLASS_NM from classes where Class_No=class_section_wise_subject_allocation.Class_No)classnm ');

		// $class_data = $this->alam->select_order_by('class_section_wise_subject_allocation ', 'distinct(Class_no),(select CLASS_NM from classes where Class_No=class_section_wise_subject_allocation.Class_No)classnm ', 'Class_no');

		// echo '<pre>';
		// print_r($class_data);
		// die;
		$array = array('class_data' => $class_data,'user_id' => $user_id);

		$this->teacher_template('marks_entry/half_yearly', $array);
	}

	public function mock_exam()
	{
		$class              = login_details['Class_No'];
		$sec                = login_details['Section_No'];
		$user_id            = login_details['user_id'];


		$class_data = $this->alam->selectA('class_section_wise_subject_allocation', 'distinct(Class_no),(select CLASS_NM from classes where Class_No=class_section_wise_subject_allocation.Class_No)classnm', "Main_Teacher_Code='$user_id'");

		

		// $class_data = $this->alam->selectA('class_section_wise_subject_allocation ','distinct(Class_no),(select CLASS_NM from classes where Class_No=class_section_wise_subject_allocation.Class_No)classnm ');

		// $class_data = $this->alam->select_order_by('class_section_wise_subject_allocation ', 'distinct(Class_no),(select CLASS_NM from classes where Class_No=class_section_wise_subject_allocation.Class_No)classnm ', 'Class_no');

		// echo '<pre>';
		// print_r($class_data);
		// die;

		$array = array('class_data' => $class_data);

		$this->teacher_template('marks_entry/mock_exam', $array);
	}

	public function classess()
	{
		$user_id  = login_details['user_id'];
		$ret = '';
		$Class_No = '';
		$ExamMode = '';
		$class = $this->input->post('val');

		$class_data = $this->dbcon->select('classes', 'Class_No,ExamMode', "Class_No='$class'");

		$Class_No = $class_data[0]->Class_No;
		$ExamMode = $class_data[0]->ExamMode;
		$role_id  = login_details['ROLE_ID'];

		//$sec_data = $this->alam->selectA('class_section_wise_subject_allocation','distinct(section_no),(select SECTION_NAME from sections where section_no=class_section_wise_subject_allocation.section_no)secnm',"Main_Teacher_Code='$user_id' AND Class_No = '$class'");

		if($Class_No == 13 || $Class_No == 14){	
			$sec_data = $this->alam->select_order_by('class_section_wise_subject_allocation', 'distinct(section_no),(select SECTION_NAME from sections where section_no=class_section_wise_subject_allocation.section_no)secnm', "section_no", "Class_No = '$class'");
		}
		else if ($Class_No == 1 || $Class_No == 2 || $Class_No == 3 || $Class_No == 4){
			$sec_data = $this->alam->select_order_by('class_section_wise_subject_allocation', 'distinct(section_no),(select SECTION_NAME from sections where section_no=class_section_wise_subject_allocation.section_no)secnm', "section_no", "Class_No = '$class'");
		}
		else{
			if($role_id=='4' || $role_id=='6' || $role_id=='1' || $role_id=='5' || $role_id=='10' || $role_id=='12' || $role_id=='2')
			{
				$sec_data = $this->alam->select_order_by('class_section_wise_subject_allocation', 'distinct(section_no),(select SECTION_NAME from sections where section_no=class_section_wise_subject_allocation.section_no)secnm', "section_no", "Class_No = '$class'");
			}else{
				$sec_data = $this->alam->select_order_by('class_section_wise_subject_allocation', 'distinct(section_no),(select SECTION_NAME from sections where section_no=class_section_wise_subject_allocation.section_no)secnm', "section_no", "Class_No = '$class' AND Main_Teacher_Code='$user_id'");
			}
		}
		
	
		
		
		// echo $this->db->last_query();die;

		$ret .= "<option value=''>Select</option>";
		if (isset($sec_data)) {

			foreach ($sec_data as $data) {
				//echo '<pre>'; print_r($data); echo '</pre>';die;
				$ret .= "<option value=" . $data->section_no . ">" . $data->secnm . "</option>";
			}
		}

		$array = array($ret, $Class_No, $ExamMode);
		echo json_encode($array);
	}
	
	public function classess_exam_wise_tbl()
	{
		$user_id  = login_details['user_id'];
		$ret = '';
		$Class_No = '';
		$ExamMode = '';
		$class = $this->input->post('val');

		$class_data = $this->dbcon->select('classes', 'Class_No,ExamMode', "Class_No='$class'");

		$Class_No = $class_data[0]->Class_No;
		$ExamMode = $class_data[0]->ExamMode;

		//$sec_data = $this->alam->selectA('class_section_wise_subject_allocation','distinct(section_no),(select SECTION_NAME from sections where section_no=class_section_wise_subject_allocation.section_no)secnm',"Main_Teacher_Code='$user_id' AND Class_No = '$class'");

		$sec_data = $this->alam->select_order_by('class_section_wise_subject_allocation', 'distinct(section_no),(select SECTION_NAME from sections where section_no=class_section_wise_subject_allocation.section_no)secnm', "section_no", "Class_No = '$class'");
		// echo $this->db->last_query();die;

		$ret .= "<option value=''>Select</option>";
		if (isset($sec_data)) {

			foreach ($sec_data as $data) {
				//echo '<pre>'; print_r($data); echo '</pre>';die;
				$ret .= "<option value=" . $data->section_no . ">" . $data->secnm . "</option>";
			}
		}

		$array = array($ret, $Class_No, $ExamMode);
		echo json_encode($array);
	}

	public function classess3()
	{
		$user_id  = login_details['user_id'];
		$ret = '';
		$Class_No = '';
		$ExamMode = '';
		$class = $this->input->post('val');

		$class_data = $this->dbcon->select('classes', 'Class_No,ExamMode', "Class_No='$class'");

		$Class_No = $class_data[0]->Class_No;
		$ExamMode = $class_data[0]->ExamMode;

		//$sec_data = $this->alam->selectA('class_section_wise_subject_allocation','distinct(section_no),(select SECTION_NAME from sections where section_no=class_section_wise_subject_allocation.section_no)secnm',"Main_Teacher_Code='$user_id' AND Class_No = '$class'");

		$user_sub = $this->db->query("select subject_code from class_xii_subject_with_teacher where teacher_code='$user_id'")->result_array();

		$subj_code='';
		
		foreach ($user_sub as $val){
			$subj_code = $subj_code  . $val['subject_code'] .",";
		}
		$subj_code = trim($subj_code,',');

		// echo $subj_code ;die;

		$sec_data = $this->alam->select_order_by('class_section_wise_subject_allocation', 'distinct(section_no),(select SECTION_NAME from sections where section_no=class_section_wise_subject_allocation.section_no)secnm', "section_no", "Class_No = '$class' AND subject_code in ($subj_code)");


		// $sec_data = $this->db->query("SELECT DISTINCT(disp_sec),SEC FROM `student` WHERE Student_Status='Active' AND CLASS=14 AND (SUBJECT4 LIKE ('$user_sub[0]->subject%') or SUBJECT5 LIKE ('$user_sub[0]->subject%')) order by sec")->result();


		$ret .= "<option value=''>Select</option>";
		if (isset($sec_data)) {

			foreach ($sec_data as $data) {
				//echo '<pre>'; print_r($data); echo '</pre>';die;
				$ret .= "<option value=" . $data->section_no . ">" . $data->secnm . "</option>";
			}
		}

		$array = array($ret, $Class_No, $ExamMode);
		echo json_encode($array);
	}

	public function section()
	{
		$val      = $this->input->post('val');
		$Class_No = $this->input->post('Class_No');
		$user_id            = login_details['user_id'];
		// echo $user_id;die;
		$exm_typ_data = $this->dbcon->select('maxmarks', 'DISTINCT(ExamCode),(select ExamName from exammaster where ExamCode=maxmarks.ExamCode)examnm', "ClassCode='$Class_No' AND Term = 'TERM-1'");

		if($user_id == 'EMP0140'){
			?>
		<option value=''>Select</option>
		<?php
			if (isset($exm_typ_data)) {
			foreach ($exm_typ_data as $data) {
				 ?>
					<option value="<?php echo $data->ExamCode; ?>"><?php echo $data->examnm; ?></option>
				<?php
				
			}
		}
		}else{
			?>
		<option value=''>Select</option>
		<?php
			if (isset($exm_typ_data)) {
			foreach ($exm_typ_data as $data) {
				if($data->ExamCode != '15'){ ?>
					<option value="<?php echo $data->ExamCode; ?>"><?php echo $data->examnm; ?></option>
				<?php
				}
			}
		}
		}	
	}
	public function section3()
	{
		$val      = $this->input->post('val');
		$Class_No = $this->input->post('Class_No');

		$exm_typ_data = $this->dbcon->select('maxmarks', 'DISTINCT(ExamCode),(select ExamName from exammaster where ExamCode=maxmarks.ExamCode)examnm', "ClassCode='$Class_No' AND Term = 'TERM-1'");
		//echo $this->db->last_query();die;
		?>

		<option value=''>Select</option>
		<?php
		if (isset($exm_typ_data)) {
			foreach ($exm_typ_data as $data) {
				if ($data->ExamCode == 14) { ?>
					<option value="<?php echo $data->ExamCode; ?>"><?php echo $data->examnm; ?></option>
		<?php }
			}
		}
	}

	public function subject()
	{
		$ret     = '';
		$subcode = '';

		$user_id  = login_details['user_id'];
		$role_id  = login_details['ROLE_ID'];
		$ExamCode  = $this->input->post('ExamCode');
		$Class_No  = $this->input->post('Class_No');
		$sec       = $this->input->post('sec');
		$ExamMode  = $this->input->post('ExamMode');

		//$sub_data = $this->dbcon->half_year_subject($ExamCode,$Class_No,$ExamMode);
		
		if($Class_No == 13){
			if($user_id =='EMP0140' || $user_id =='EMP0177'){
				$sub_data = $this->db->query("select distinct (cswsa.subject_code) as subject_code ,cst.SUBJECT as subjnm ,cswsa.opt_code from class_section_wise_subject_allocation cswsa inner join class_xii_subject_with_teacher as cst on cswsa.subject_code=cst.SUBJECT_CODE where cswsa.Class_No=$Class_No and cswsa.section_no=$sec")->result_array();
			}else{
				$sub_data = $this->db->query("select distinct (cswsa.subject_code) as subject_code ,cst.SUBJECT as subjnm ,cswsa.opt_code from class_section_wise_subject_allocation cswsa inner join class_xii_subject_with_teacher as cst on cswsa.subject_code=cst.SUBJECT_CODE where cswsa.Class_No=$Class_No and cswsa.section_no=$sec and cst.TEACHER_CODE='$user_id'")->result_array();
			}
		}
		else{
			if($Class_No == 3 || $Class_No == 4){
				$sub_data = $this->alam->selectA('class_section_wise_subject_allocation', 'distinct(subject_code),(select SubName from subjects where SubCode=class_section_wise_subject_allocation.subject_code)subjnm,opt_code,subject_code', "Class_No = '$Class_No' AND section_no = '$sec' and applicable_exam=1");
			}
			else
			{
				if($role_id =='6' || $role_id =='4' || $role_id == '12' || $role_id == '2'){
					$sub_data = $this->alam->selectA('class_section_wise_subject_allocation', 'distinct(subject_code),(select SubName from subjects where SubCode=class_section_wise_subject_allocation.subject_code)subjnm,opt_code,subject_code', "Class_No = '$Class_No' AND section_no = '$sec' and applicable_exam=1");
				}else{
					$sub_data = $this->alam->selectA('class_section_wise_subject_allocation', 'distinct(subject_code),(select SubName from subjects where SubCode=class_section_wise_subject_allocation.subject_code)subjnm,opt_code,subject_code', "Main_Teacher_Code='$user_id' AND Class_No = '$Class_No' AND section_no = '$sec'");
				}
			}
						
		}

		// $sub_data = $this->alam->selectA('class_section_wise_subject_allocation', 'distinct(subject_code),(select SubName from subjects where SubCode=class_section_wise_subject_allocation.subject_code)subjnm,opt_code,subject_code,sorting_no', "Class_No = '$Class_No' AND section_no = '$sec' AND applicable_exam = '1' AND Main_Teacher_Code ='$user_id' order by sorting_no");
		// echo $this->db->last_query();die;

		$subcode .= $sub_data[0]['subject_code'];
		$ret .= "<option value=''>Select</option>";
		if (isset($sub_data)) {
			foreach ($sub_data as $data) {
				$ret .= "<option value=" . $data['opt_code'] . " data-id=" . $data['subject_code'] . ">" . $data['subjnm'] . "</option>";
			}
		}

		$array = array($ret, $subcode);
		echo json_encode($array);
	}

	public function subject3()
	{
		$ret     = '';
		$subcode = '';

		$user_id  = login_details['user_id'];

		$ExamCode  = $this->input->post('ExamCode');
		$Class_No  = $this->input->post('Class_No');
		$sec       = $this->input->post('sec');
		$ExamMode  = $this->input->post('ExamMode');

		//$sub_data = $this->dbcon->half_year_subject($ExamCode,$Class_No,$ExamMode);

		//$sub_data = $this->alam->selectA('class_section_wise_subject_allocation','distinct(subject_code),(select SubName from subjects where SubCode=class_section_wise_subject_allocation.subject_code)subjnm,opt_code,subject_code',"Main_Teacher_Code='$user_id' AND Class_No = '$Class_No' AND section_no = '$sec'");

		// $sub_data = $this->alam->selectA('class_xii_subject_with_teacher as cst', "distinct(subject_code),subject,(select opt_code from class_section_wise_subject_allocation cswsa where cswsa.subject_code = cst.SUBJECT_CODE and cswsa.class_no=$Class_No and cswsa.section_no=$sec) as opt_code", "Teacher_Code ='$user_id' order by subject_code");

		$sub_data = $this->db->query("select cswsa.subject_code,cst.SUBJECT,cswsa.opt_code from class_section_wise_subject_allocation cswsa inner join class_xii_subject_with_teacher as cst on cswsa.subject_code=cst.SUBJECT_CODE where cswsa.Class_No=$Class_No and cswsa.section_no=$sec and cst.TEACHER_CODE='$user_id'")->result_array();

		// echo $this->db->last_query();die;

		$subcode .= $sub_data[0]['subject_code'];
		$ret .= "<option value=''>Select</option>";
		if (isset($sub_data)) {
			foreach ($sub_data as $data) {
				$ret .= "<option value=" . $data['opt_code'] . " data-id=" . $data['subject_code'] . ">" . $data['SUBJECT'] . "</option>";
			}
		}

		$array = array($ret, $subcode);
		echo json_encode($array);
	}

	public function stu_list()
	{
		$ret = '';
		$MaxMarks = '';
		$opt_code = $this->input->post('opt_code');
		$Class_No = $this->input->post('Class_No');
		$sec      = $this->input->post('sec');
		$sortval  = $this->input->post('sortval');
		$exm_code = $this->input->post('exm_code');
		$ExamMode = $this->input->post('ExamMode');
		$subcode  = $this->input->post('subcode');
		//echo '<pre>';
		//print_r($_POST);die;
		$mx_mrk   = $this->dbcon->select('maxmarks', 'MaxMarks', "ExamCode='$exm_code' AND Term='TERM-1' AND teacher_code='$subcode' AND ClassCode='$Class_No' AND ExamMode='$ExamMode'");
		if (!empty($mx_mrk)) {
			$MaxMarks .= "Max Marks " . $mx_mrk[0]->MaxMarks;
		} else {
			$MaxMarks .= "Max Marks " . '0';
		}

		if ($sortval == 'adm_no') {
			$sorting = 'ADM_NO';
		} elseif ($sortval == 'stu_name') {
			$sorting = 'FIRST_NM';
		} else {
			$sorting = 'ROLL_NO';
		}
		//echo $opt_code;
		if ($opt_code != 2) {
			$stu_tbl_data = $this->dbcon->half_year_stu_tbl_list($Class_No, $sec, $sorting, $exm_code, $subcode, $opt_code);
			
			$ret .= "<table class='table'>
			    <th style='background:#5785c3; color:#fff!important;'>Admission No.</th>
			    <th style='background:#5785c3; color:#fff!important;'>Name</th>
			    <th style='background:#5785c3; color:#fff!important;'>Roll No.</th>
			    <th style='background:#5785c3; color:#fff!important;'>Marks</th>";

			if (isset($stu_tbl_data)) {
				$i = 1;
				foreach ($stu_tbl_data as $data) {
					$ret .= "<tr>";
					$ret .= "<td>" . $data->ADM_NO . "</td>";
					$ret .= "<td style='display:none'><input type='text' id='adm_" . $i . "' value=" . $data->ADM_NO . "></td>";
					$ret .= "<td>" . $data->FIRST_NM . "</td>";
					$ret .= "<td>" . $data->ROLL_NO . "</td>";
					$ret .= "<td style='display:none'><input type='text' id='tmarks_" . $i . "' value=" . $data->mrks2 . "></td>";
					
					if ($subcode == 21 && ($Class_No == '8' || $Class_No == '9' || $Class_No == '10')) {
						$ret .= "<td><input type='text' onkeypress='return event.charCode >= 97 && event.charCode <= 101 || event.charCode == 107 || event.charCode == 49 || event.charCode == 43 || event.charCode >= 65 && event.charCode <= 69' onchange='marksformsc(this)' maxlength='5' id='marks_" . $i . "' value=" . $data->mrks2 . "></td>";
					} else {
						$ret .= "<td><input type='text' onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46 || event.charCode == 97 || event.charCode == 98 || event.charCode == 65 || event.charCode == 66' onchange='marks(this)' maxlength='5' id='marks_" . $i . "' value=" . $data->mrks2 . "></td>";
					}
					
					$ret .= "</tr>";
					$i++;
				}
				$ret .= "<tr>";
				$ret .= "<td>";
				$ret .= '<button class="btn btn-success" onclick=approve("' . $Class_No . '","' . $sec . '","' . $sorting . '","' . $exm_code . '","' . $subcode . '","t1","' . $opt_code . '")>Verify Marks</button>';
				$ret .= "</td>";
				$ret .= "</tr>";
			}
			$ret .= "</table>";
			$array = array($ret, $MaxMarks);
			echo json_encode($array);
		} else {
			if($Class_No == 13){
				$stu_tbl_data = $this->dbcon->half_year_stusub_tbl_list13($Class_No, $sec, $sorting, $exm_code, $subcode);
				//echo $this->db->last_query();die;
			}else{
				$stu_tbl_data = $this->dbcon->half_year_stusub_tbl_list($Class_No, $sec, $sorting, $exm_code, $subcode);
			}
			
			$ret .= "<table class='table'>
			    <th style='background:#5785c3; color:#fff!important;'>Admission No.</th>
			    <th style='background:#5785c3; color:#fff!important;'>Name</th>
			    <th style='background:#5785c3; color:#fff!important;'>Roll No.</th>
			    <th style='background:#5785c3; color:#fff!important;'>Marks</th>";

			if (isset($stu_tbl_data)) {
				$i = 1;
				foreach ($stu_tbl_data as $data) {
					$ret .= "<tr>";
					$ret .= "<td>" . $data->ADM_NO . "</td>";
					$ret .= "<td style='display:none'><input type='text' id='adm_" . $i . "' value=" . $data->ADM_NO . "></td>";
					$ret .= "<td>" . $data->FIRST_NM . "</td>";
					$ret .= "<td>" . $data->ROLL_NO . "</td>";
					$ret .= "<td style='display:none'><input type='text' id='tmarks_" . $i . "' value=" . $data->mrks2 . "></td>";
					
					if ($subcode == 21 && ($Class_No == '8' || $Class_No == '9' || $Class_No == '10')) {
						$ret .= "<td><input type='text' onkeypress='return event.charCode >= 97 && event.charCode <= 101 || event.charCode == 107 || event.charCode == 49 || event.charCode == 43 || event.charCode >= 65 && event.charCode <= 69' onchange='marksformsc(this)' maxlength='5' id='marks_" . $i . "' value=" . $data->mrks2 . "></td>";
					} else {
						$ret .= "<td><input type='text' onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46 || event.charCode == 97 || event.charCode == 98 || event.charCode == 65 || event.charCode == 66' onchange='marks(this)' maxlength='5' id='marks_" . $i . "' value=" . $data->mrks2 . "></td>";
					}
					
					$ret .= "</tr>";
					$i++;
				}
				$ret .= "<tr>";
				$ret .= "<td>";
				$ret .= '<button class="btn btn-success" onclick=approve("' . $Class_No . '","' . $sec . '","' . $sorting . '","' . $exm_code . '","' . $subcode . '","t1","' . $opt_code . '")>Verify Marks</button>';
				$ret .= "</td>";
				$ret .= "</tr>";
			}
			$ret .= "</table>";
			$array = array($ret, $MaxMarks);
			echo json_encode($array);
		}
	}

	public function stu_list3()
	{
		$ret = '';
		$MaxMarks = '';
		 $opt_code = $this->input->post('opt_code');
		 $Class_No = $this->input->post('Class_No');
		 $sec      = $this->input->post('sec');
		 $sortval  = $this->input->post('sortval');
		 $exm_code = $this->input->post('exm_code');
		 $ExamMode = $this->input->post('ExamMode');
		 $subcode  = $this->input->post('subcode');

		$mx_mrk   = $this->dbcon->select('maxmarks', 'MaxMarks', "ExamCode='$exm_code' AND Term='TERM-1' AND teacher_code='$subcode' AND ClassCode='$Class_No' AND ExamMode='$ExamMode'");
		if (!empty($mx_mrk)) {
			$MaxMarks .= "Max Marks " . $mx_mrk[0]->MaxMarks;
		} else {
			$MaxMarks .= "Max Marks " . '0';
		}

		if ($sortval == 'adm_no') {
			$sorting = 'ADM_NO';
		} elseif ($sortval == 'stu_name') {
			$sorting = 'FIRST_NM';
		} else {
			$sorting = 'ROLL_NO';
		}

		if ($opt_code != 2) {
			$stu_tbl_data = $this->dbcon->half_year_stu_tbl_list($Class_No, $sec, $sorting, $exm_code, $subcode, $opt_code);
			// $str=$this->db->last_query();
			// echo $str;
			// die;
			$ret .= "<table class='table'>
			    <th style='background:#5785c3; color:#fff!important;'>Admission No.</th>
			    <th style='background:#5785c3; color:#fff!important;'>Name</th>
			    <th style='background:#5785c3; color:#fff!important;'>Roll No.</th>
			    <th style='background:#5785c3; color:#fff!important;'>Marks</th>";

			if (isset($stu_tbl_data)) {
				$i = 1;
				foreach ($stu_tbl_data as $data) {
					$ret .= "<tr>";
					$ret .= "<td>" . $data->ADM_NO . "</td>";
					$ret .= "<td style='display:none'><input type='text' id='adm_" . $i . "' value=" . $data->ADM_NO . "></td>";
					$ret .= "<td>" . $data->FIRST_NM . "</td>";
					$ret .= "<td>" . $data->ROLL_NO . "</td>";
					$ret .= "<td style='display:none'><input type='text' id='tmarks_" . $i . "' value=" . $data->mrks2 . "></td>";
					$ret .= "<td><input type='text' onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46 || event.charCode == 97 || event.charCode == 98 || event.charCode == 65 || event.charCode == 66' onchange='marks(this)' maxlength='5' id='marks_" . $i . "' value=" . $data->mrks2 . "></td>";
					$ret .= "</tr>";
					$i++;
				}
				$ret .= "<tr>";
				$ret .= "<td>";
				$ret .= '<button class="btn btn-success" onclick=approve("' . $Class_No . '","' . $sec . '","' . $sorting . '","' . $exm_code . '","' . $subcode . '","t1","' . $opt_code . '")>Verify Marks</button>';
				$ret .= "</td>";
				$ret .= "</tr>";
			}
			$ret .= "</table>";
			$array = array($ret, $MaxMarks);
			echo json_encode($array);
		} else {
			$stu_tbl_data = $this->dbcon->half_year_stusub_tbl_list($Class_No, $sec, $sorting, $exm_code, $subcode);
			// $str=$this->db->last_query();
			// echo $str;
			// die;
			$ret .= "<table class='table'>
			    <th style='background:#5785c3; color:#fff!important;'>Admission No.</th>
			    <th style='background:#5785c3; color:#fff!important;'>Name</th>
			    <th style='background:#5785c3; color:#fff!important;'>Roll No.</th>
			    <th style='background:#5785c3; color:#fff!important;'>Marks</th>";

			if (isset($stu_tbl_data)) {
				$i = 1;
				foreach ($stu_tbl_data as $data) {
					$ret .= "<tr>";
					$ret .= "<td>" . $data->ADM_NO . "</td>";
					$ret .= "<td style='display:none'><input type='text' id='adm_" . $i . "' value=" . $data->ADM_NO . "></td>";
					$ret .= "<td>" . $data->FIRST_NM . "</td>";
					$ret .= "<td>" . $data->ROLL_NO . "</td>";
					$ret .= "<td style='display:none'><input type='text' id='tmarks_" . $i . "' value=" . $data->mrks2 . "></td>";
					$ret .= "<td><input type='text' onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46 || event.charCode == 97 || event.charCode == 98 || event.charCode == 65 || event.charCode == 66' onchange='marks(this)' maxlength='5' id='marks_" . $i . "' value=" . $data->mrks2 . "></td>";
					$ret .= "</tr>";
					$i++;
				}
				$ret .= "<tr>";
				$ret .= "<td>";
				$ret .= '<button class="btn btn-success" onclick=approve("' . $Class_No . '","' . $sec . '","' . $sorting . '","' . $exm_code . '","' . $subcode . '","t1","' . $opt_code . '")>Verify Marks</button>';
				$ret .= "</td>";
				$ret .= "</tr>";
			}
			$ret .= "</table>";
			$array = array($ret, $MaxMarks);
			echo json_encode($array);
		}
	}
	
	
	public function sv_nd_upd()
	{
		$user_id  = login_details['user_id'];
		$adm_no   = $this->input->post('adm_no');
		$exm_typ  = $this->input->post('exm_typ');
		$subcode  = $this->input->post('subcode');
		$classs   = $this->input->post('classs');
		$sec      = $this->input->post('sec');
		$entr_val = strtoupper($this->input->post('entr_val'));
		$mxm      = $this->input->post('mxm');

		$chk_data = $this->dbcon->select('marks', 'count(*)cnt', "admno='$adm_no' AND ExamC='$exm_typ' AND SCode='$subcode' AND Term='TERM-1' AND Classes='$classs' AND Sec='$sec'");
		$cnt = $chk_data[0]->cnt;
		if ($cnt != 0) {
			$upd_data = array(
				'M1' => $mxm,
				'M2' => ($entr_val == '') ? '-' : $entr_val,
				'M3' => ($entr_val == '') ? '-' : $entr_val,
			);

			$this->dbcon->update('marks', $upd_data, "admno='$adm_no' AND ExamC='$exm_typ' AND SCode='$subcode' AND Term='TERM-1' AND Classes='$classs' AND Sec='$sec'");
			//echo $this->db->last_query();
			//echo "Data Update Successfully";
		} else {
			echo "insert";
			$ins_data = array(
				'admno'   => $adm_no,
				'ExamC'   => $exm_typ,
				'SCode'   => $subcode,
				'M1'      => $mxm,
				'M2'      => ($entr_val == '') ? '-' : $entr_val,
				'M3'      => ($entr_val == '') ? '-' : $entr_val,
				'Classes' => $classs,
				'Sec'     => $sec,
				'Term'    => 'TERM-1',
				'Teacher_code' => $user_id
			);

			$this->dbcon->insert('marks', $ins_data);
			echo "Data Insert Successfully";
		}
	}
	
	public function sv_nd_upd_for_msc()
	{
		$user_id  = login_details['user_id'];
		$adm_no   = $this->input->post('adm_no');
		$exm_typ  = $this->input->post('exm_typ'); //4
		$subcode  = $this->input->post('subcode'); //21
		$classs   = $this->input->post('classs'); //8,9,10
		$sec      = $this->input->post('sec'); //1
		$entr_val = strtoupper($this->input->post('entr_val')); //grade i.e a,b,c..
		$mxm      = $this->input->post('mxm'); //50
		// echo '<pre>';
		// print_r($_POST);
		// die;
		$chk_data = $this->dbcon->select('marks', 'count(*)cnt', "admno='$adm_no' AND ExamC='$exm_typ' AND SCode='$subcode' AND Term='TERM-1' AND Classes='$classs' AND Sec='$sec'");
		$cnt = $chk_data[0]->cnt;
		if ($cnt != 0) {
			$upd_data = array(
				'M1' => 0,
				'M2' => ($entr_val == '') ? '-' : $entr_val,
				'M3' => ($entr_val == '') ? '-' : $entr_val,
			);

			$this->dbcon->update('marks', $upd_data, "admno='$adm_no' AND ExamC='$exm_typ' AND SCode='$subcode' AND Term='TERM-1' AND Classes='$classs' AND Sec='$sec'");
			//echo $this->db->last_query();
			//echo "Data Update Successfully";
		} else {
			echo "insert";
			$ins_data = array(
				'admno'   => $adm_no,
				'ExamC'   => $exm_typ,
				'SCode'   => $subcode,
				'M1'      => 0,
				'M2'      => ($entr_val == '') ? '-' : $entr_val,
				'M3'      => ($entr_val == '') ? '-' : $entr_val,
				'Classes' => $classs,
				'Sec'     => $sec,
				'Term'    => 'TERM-1',
				'Teacher_code' => $user_id
			);

			$this->dbcon->insert('marks', $ins_data);
			echo "Data Insert Successfully";
		}
	}

	public function second_term()
	{
		$log_cls_no = login_details['Class_No'];
		$log_sec_no = login_details['Section_No'];
		$user_id    = login_details['user_id'];

		//$class_data = $this->alam->selectA('class_section_wise_subject_allocation','distinct(Class_no),(select CLASS_NM from classes where Class_No=class_section_wise_subject_allocation.Class_No)classnm',"Main_Teacher_Code='$user_id'");
		$class_data = $this->alam->select_order_by('class_section_wise_subject_allocation ', 'distinct(Class_no),(select CLASS_NM from classes where Class_No=class_section_wise_subject_allocation.Class_No)classnm ', 'Class_no');


		$array = array('class_data' => $class_data);


		$this->teacher_template('marks_entry/second_term', $array);
	}

	public function classess2()
	{
		$user_id    = login_details['user_id'];
		$log_sec_no = login_details['Section_No'];
		$ret = '';
		$Class_No = '';
		$ExamMode = '';
		$class = $this->input->post('val');

		$class_data = $this->dbcon->select('classes', 'Class_No,ExamMode', "Class_No='$class'");

		$Class_No = $class_data[0]->Class_No;
		$ExamMode = $class_data[0]->ExamMode;

		//$sec_data = $this->alam->selectA('class_section_wise_subject_allocation','distinct(section_no),(select SECTION_NAME from sections where section_no=class_section_wise_subject_allocation.section_no)secnm',"Main_Teacher_Code='$user_id' AND Class_No = '$class'");
		$sec_data = $this->alam->selectA('class_section_wise_subject_allocation', 'distinct(section_no),(select SECTION_NAME from sections where section_no=class_section_wise_subject_allocation.section_no)secnm', "Class_No = '$class'");

		$ret .= "<option value=''>Select</option>";
		if (isset($sec_data)) {
			foreach ($sec_data as $data) {
				//if($log_sec_no == $data['section_no']){
				$ret .= "<option value=" . $data['section_no'] . ">" . $data['secnm'] . "</option>";
				//}
			}
		}

		$array = array($ret, $Class_No, $ExamMode);
		echo json_encode($array);
	}

	public function section2()
	{
		$val      = $this->input->post('val');
		$Class_No = $this->input->post('Class_No');

		$exm_typ_data = $this->dbcon->select('maxmarks', 'distinct(ExamCode),(select ExamName from exammaster where ExamCode=maxmarks.ExamCode)examnm', "ClassCode='$Class_No' AND Term = 'TERM-2'");
		?>
		<option value=''>Select</option>
		<?php
		if (isset($exm_typ_data)) {
			foreach ($exm_typ_data as $data) {
		?>
				<option value="<?php echo $data->ExamCode; ?>"><?php echo $data->examnm; ?></option>
		<?php
			}
		}
	}

	public function subject2()
	{
		$ret     = '';
		$subcode = '';

		$user_id  = login_details['user_id'];
		$role_id  = login_details['ROLE_ID'];
		$ExamCode  = $this->input->post('ExamCode');
		$Class_No  = $this->input->post('Class_No');
		$sec       = $this->input->post('sec');
		$ExamMode  = $this->input->post('ExamMode');

		//$sub_data = $this->dbcon->half_year_subject2($ExamCode,$Class_No,$ExamMode);

		//$sub_data = $this->alam->selectA('class_section_wise_subject_allocation','distinct(subject_code),(select SubName from subjects where SubCode=class_section_wise_subject_allocation.subject_code)subjnm,opt_code,subject_code',"Main_Teacher_Code='$user_id' AND Class_No = '$Class_No' AND section_no = '$sec'");
		
		//echo $Class_No;die;
		
			if ($Class_No == '13') {
			$sub_data = $this->db->query("SELECT DISTINCT(ss.SUBCODE)as subject_code,(select SubName from subjects where SubCode=ss.SUBCODE)subjnm ,ss.optcode as opt_code,ss.SUBCODE as subject_code FROM new_studentsubject_xi as ss WHERE `Class` = '$Class_No' AND `sec` = '$sec';")->result_array();
		} else {
			if ($role_id == '6' || $role_id == '4') {
				if ($Class_No == 13) {
					$sub_data = $this->db->query("select distinct (cswsa.subject_code) as subject_code ,cst.SUBJECT as subjnm ,cswsa.opt_code from class_section_wise_subject_allocation cswsa inner join class_xii_subject_with_teacher as cst on cswsa.subject_code=cst.SUBJECT_CODE where cswsa.Class_No=$Class_No and cswsa.section_no=$sec")->result_array();
				} else {
					$sub_data = $this->alam->selectA('class_section_wise_subject_allocation', 'distinct(subject_code),(select SubName from subjects where SubCode=class_section_wise_subject_allocation.subject_code)subjnm,opt_code,subject_code', "Class_No = '$Class_No' AND section_no = '$sec' AND applicable_exam = '1'");
				}
			} else {
				$sub_data = $this->alam->selectA('class_section_wise_subject_allocation', 'distinct(subject_code),(select SubName from subjects where SubCode=class_section_wise_subject_allocation.subject_code)subjnm,opt_code,subject_code', "Class_No = '$Class_No' AND section_no = '$sec' AND applicable_exam = '1'");
			}
		}
		

		$subcode .= $sub_data[0]['subject_code'];
		$ret .= "<option value=''>Select</option>";
		if (isset($sub_data)) {
			foreach ($sub_data as $data) {
				$ret .= "<option value=" . $data['opt_code'] . " data-id=" . $data['subject_code'] . ">" . $data['subjnm'] . "</option>";
			}
		}

		$array = array($ret, $subcode);
		echo json_encode($array);
	}

	public function stu_list2()
	{
		$ret = '';
		$MaxMarks = '';
		$opt_code = $this->input->post('opt_code');
		$Class_No = $this->input->post('Class_No');
		$sec      = $this->input->post('sec');
		$sortval  = $this->input->post('sortval');
		$exm_code = $this->input->post('exm_code');
		$ExamMode = $this->input->post('ExamMode');
		$subcode  = $this->input->post('subcode');

		$mx_mrk   = $this->dbcon->select('maxmarks', 'MaxMarks', "ExamCode='$exm_code' AND Term='TERM-2' AND teacher_code='$subcode' AND ClassCode='$Class_No' AND ExamMode='$ExamMode'");

		if (!empty($mx_mrk)) {
			$MaxMarks .= "Max Marks " . $mx_mrk[0]->MaxMarks;
		} else {
			$MaxMarks .= "Max Marks " . '0';
		}


		if ($sortval == 'adm_no') {
			$sorting = 'ADM_NO';
		} elseif ($sortval == 'stu_name') {
			$sorting = 'FIRST_NM';
		} else {
			$sorting = 'ROLL_NO';
		}

		if ($opt_code != 2) {
			$stu_tbl_data = $this->dbcon->half_year_stu_tbl_list2($Class_No, $sec, $sorting, $exm_code, $subcode, $opt_code);

			$ret .= "<table class='table'>
			    <th style='background:#5785c3; color:#fff!important;'>Admission No.</th>
			    <th style='background:#5785c3; color:#fff!important;'>Name</th>
			    <th style='background:#5785c3; color:#fff!important;'>Roll No.</th>
			    <th style='background:#5785c3; color:#fff!important;'>Marks</th>";

			if (isset($stu_tbl_data)) {
				$i = 1;
				foreach ($stu_tbl_data as $data) {
					$ret .= "<tr>";
					$ret .= "<td>" . $data->ADM_NO . "</td>";
					$ret .= "<td style='display:none'><input type='text' id='adm_" . $i . "' value=" . $data->ADM_NO . "></td>";
					$ret .= "<td>" . $data->FIRST_NM . "</td>";
					$ret .= "<td>" . $data->ROLL_NO . "</td>";
					$ret .= "<td style='display:none'><input type='text' id='tmarks_" . $i . "' value=" . $data->mrks2 . "></td>";
					$ret .= "<td><input type='text' onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46 || event.charCode == 97 || event.charCode == 98 || event.charCode == 65 || event.charCode == 66' onchange='marks(this)' maxlength='5' id='marks_" . $i . "' value=" . $data->mrks2 . "></td>";
					$ret .= "</tr>";
					$i++;
				}
				$ret .= "<tr>";
				$ret .= "<td>";
				$ret .= '<button class="btn btn-success" onclick=approve("' . $Class_No . '","' . $sec . '","' . $sorting . '","' . $exm_code . '","' . $subcode . '","t2","' . $opt_code . '")>Verify Marks</button>';
				$ret .= "</td>";
				$ret .= "</tr>";
			}
			$ret .= "</table>";

			$array = array($ret, $MaxMarks);
			echo json_encode($array);
		} else {
			$stu_tbl_data = $this->dbcon->half_year_stusub_tbl_list2($Class_No, $sec, $sorting, $exm_code, $subcode);

			$ret .= "<table class='table'>
			    <th style='background:#5785c3; color:#fff!important;'>Admission No.</th>
			    <th style='background:#5785c3; color:#fff!important;'>Name</th>
			    <th style='background:#5785c3; color:#fff!important;'>Roll No.</th>
			    <th style='background:#5785c3; color:#fff!important;'>Marks</th>";

			if (isset($stu_tbl_data)) {
				$i = 1;
				foreach ($stu_tbl_data as $data) {
					$ret .= "<tr>";
					$ret .= "<td>" . $data->ADM_NO . "</td>";
					$ret .= "<td style='display:none'><input type='text' id='adm_" . $i . "' value=" . $data->ADM_NO . "></td>";
					$ret .= "<td>" . $data->FIRST_NM . "</td>";
					$ret .= "<td>" . $data->ROLL_NO . "</td>";
					$ret .= "<td style='display:none'><input type='text' id='tmarks_" . $i . "' value=" . $data->mrks2 . "></td>";
					$ret .= "<td><input type='text' onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46 || event.charCode == 97 || event.charCode == 98 || event.charCode == 65 || event.charCode == 66' onchange='marks(this)' maxlength='5' id='marks_" . $i . "' value=" . $data->mrks2 . "></td>";
					$ret .= "</tr>";
					$i++;
				}
				$ret .= "<tr>";
				$ret .= "<td>";
				$ret .= '<button class="btn btn-success" onclick=approve("' . $Class_No . '","' . $sec . '","' . $sorting . '","' . $exm_code . '","' . $subcode . '","t2","' . $opt_code . '")>Verify Marks</button>';
				$ret .= "</td>";
				$ret .= "</tr>";
			}
			$ret .= "</table>";

			$array = array($ret, $MaxMarks);
			echo json_encode($array);
		}
	}

	public function sv_nd_upd2()
	{
		$user_id  = login_details['user_id'];
		$adm_no   = $this->input->post('adm_no');
		$exm_typ  = $this->input->post('exm_typ');
		$subcode  = $this->input->post('subcode');
		$classs   = $this->input->post('classs');
		$sec      = $this->input->post('sec');
		$entr_val = strtoupper($this->input->post('entr_val'));
		$mxm      = $this->input->post('mxm');

		$chk_data = $this->dbcon->select('marks', 'count(*)cnt', "admno='$adm_no' AND ExamC='$exm_typ' AND SCode='$subcode' AND Term='TERM-2' AND Classes='$classs' AND Sec='$sec'");
		$cnt = $chk_data[0]->cnt;
		if ($cnt != 0) {
			$upd_data = array(
				'M1' => $mxm,
				'M2' => ($entr_val == '') ? '-' : $entr_val,
				'M3' => ($entr_val == '') ? '-' : $entr_val,
				'status' => '1',
			);

			$this->dbcon->update('marks', $upd_data, "admno='$adm_no' AND ExamC='$exm_typ' AND SCode='$subcode' AND Term='TERM-2' AND Classes='$classs' AND Sec='$sec'");
			echo "Data Update Successfully";
		} else {
			$ins_data = array(
				'admno'   => $adm_no,
				'ExamC'   => $exm_typ,
				'SCode'   => $subcode,
				'M1'      => $mxm,
				'M2'      => ($entr_val == '') ? '-' : $entr_val,
				'M3'      => ($entr_val == '') ? '-' : $entr_val,
				'Classes' => $classs,
				'Sec'     => $sec,
				'Term'    => 'TERM-2',
				'Teacher_code' => $user_id
			);

			$this->dbcon->insert('marks', $ins_data);
			echo "Data Insert Successfully";
		}
	}

	function verifyMarks()
	{
		$Class_No = $this->input->post('Class_No');
		$sec      = $this->input->post('sec');
		$sorting  = $this->input->post('sorting');
		$exm_code = $this->input->post('exm_code');
		$subcode  = $this->input->post('subcode');
		$opt_code = $this->input->post('opt_code');
		$trm  = $this->input->post('trm');

		if ($trm == 't1') {
			$stu_tbl_data = $this->dbcon->half_year_stu_tbl_list($Class_No, $sec, $sorting, $exm_code, $subcode, $opt_code);
			foreach ($stu_tbl_data as $key => $val) {
				$admno = $val->ADM_NO;
				$data = array(
					'status' => 1
				);
				$this->alam->update('marks', $data, "admno='$admno' AND ExamC='$exm_code' AND SCode='$subcode' AND Term='TERM-1'");
			}
		} else {
			$stu_tbl_data = $this->dbcon->half_year_stu_tbl_list2($Class_No, $sec, $sorting, $exm_code, $subcode, $opt_code);
			foreach ($stu_tbl_data as $key => $val) {
				$admno = $val->ADM_NO;
				$data = array(
					'status' => 1
				);
				$this->alam->update('marks', $data, "admno='$admno' AND ExamC='$exm_code' AND SCode='$subcode' AND Term='TERM-1'");
			}
		}
		?>
		<table class='table'>
			<tr>
				<th>Name</th>
				<th>Roll</th>
				<th>Marks</th>
			</tr>
			<?php
			foreach ($stu_tbl_data as $key => $val) {
			?>
				<tr>
					<td><?php echo $val->FIRST_NM; ?></td>
					<td><?php echo $val->ROLL_NO; ?></td>
					<td><?php echo $val->mrks2; ?></td>
				</tr>
			<?php
			}
			?>
		</table>
<?php
	}
}
