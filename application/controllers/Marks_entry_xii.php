<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Marks_entry_xii extends MY_controller
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

		$this->teacher_template('marks_entry_xii/marks_entry_xxii', $array);
		// $this->load->view('marks_entry_xii/marks_entry_xxii', $array);
	}
	public function theory()
	{
		$class              = login_details['Class_No'];
		$sec                = login_details['Section_No'];
		$user_id            = login_details['user_id'];

		$class_data = $this->alam->selectA('class_section_wise_subject_allocation', 'distinct(Class_no),(select CLASS_NM from classes where Class_No=class_section_wise_subject_allocation.Class_No)classnm', "Main_Teacher_Code='$user_id'");

		$array = array('class_data' => $class_data);

		$this->teacher_template('marks_entry_xii/theory_exam', $array);
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

		$user_sub = $this->db->query("select subject_code from class_xii_subject_with_teacher where teacher_code='$user_id'")->result_array();

		$subj_code = '';

		foreach ($user_sub as $val) {
			$subj_code = $subj_code  . $val['subject_code'] . ",";
		}
		$subj_code = trim($subj_code, ',');


		// $sec_data = $this->alam->select_order_by('class_section_wise_subject_allocation', 'distinct(section_no),(select SECTION_NAME from sections where section_no=class_section_wise_subject_allocation.section_no)secnm', "section_no", "Class_No = '$class' AND subject_code in ($subj_code)");

		if($user_id == 'EMP0140'){
			$sec_data = $this->db->query("SELECT DISTINCT stuSubj_xi.GROUP as secnm  FROM studentsubject_xi as stuSubj_xi WHERE stuSubj_xi.Class='$class'")->result();
		}else{
			
			$sec_data = $this->db->query("SELECT DISTINCT stuSubj_xi.GROUP as secnm  FROM studentsubject_xi as stuSubj_xi WHERE stuSubj_xi.SUBCODE IN ($subj_code) AND stuSubj_xi.Class='$class'")->result();
		}

		// echo $this->db->last_query();die;
		$ret .= "<option value=''>Select</option>";
		if (isset($sec_data)) {

			foreach ($sec_data as $data) {
				//echo '<pre>'; print_r($data); echo '</pre>';die;
				$ret .= "<option value=" . $data->secnm . ">" . $data->secnm . "</option>";
			}
		}

		$array = array($ret, $Class_No, $ExamMode);
		echo json_encode($array);
	}
	public function section()
	{
		$val      = $this->input->post('val');
		$Class_No = $this->input->post('Class_No');

		$exm_typ_data = $this->dbcon->select('maxmarks', 'DISTINCT(ExamCode),(select ExamName from exammaster where ExamCode=maxmarks.ExamCode)examnm', "ClassCode='$Class_No' AND Term = 'TERM-1'");
		// echo $this->db->last_query();die;
?>
		<option value=''>Select</option>
		<?php
		if (isset($exm_typ_data)) {
			foreach ($exm_typ_data as $data) {
				if ($data->ExamCode == 15) { ?>
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

		$ExamCode  = $this->input->post('ExamCode');
		$Class_No  = $this->input->post('Class_No');
		$sec       = $this->input->post('sec');
		$ExamMode  = $this->input->post('ExamMode');

		//$sub_data = $this->db->query("select cswsa.subject_code,cst.SUBJECT,cswsa.opt_code from class_section_wise_subject_allocation cswsa inner join class_xii_subject_with_teacher as cst on cswsa.subject_code=cst.SUBJECT_CODE where cswsa.Class_No=$Class_No and cswsa.section_no=$sec and cst.TEACHER_CODE='$user_id'")->result_array();

			if($user_id == 'EMP0140'){
			$sub_data = $this->db->query("SELECT DISTINCT (stu_xi.SUBCODE)subject_code , stu_xi.OPTCODE  , class_xii_subject_with_teacher.SUBJECT as SUBJECT  FROM studentsubject_xi as stu_xi
			INNER JOIN class_xii_subject_with_teacher ON stu_xi.SUBCODE=class_xii_subject_with_teacher.SUBJECT_CODE
			WHERE stu_xi.GROUP='$sec' AND Class='$Class_No'")->result_array();
		}else{
			$sub_data = $this->db->query("SELECT DISTINCT (stu_xi.SUBCODE)subject_code , stu_xi.OPTCODE ,class_xii_subject_with_teacher.TEACHER_CODE , class_xii_subject_with_teacher.SUBJECT as SUBJECT  FROM studentsubject_xi as stu_xi
			INNER JOIN class_xii_subject_with_teacher ON stu_xi.SUBCODE=class_xii_subject_with_teacher.SUBJECT_CODE
			WHERE stu_xi.GROUP='$sec' AND Class='$Class_No' AND class_xii_subject_with_teacher.TEACHER_CODE='$user_id'")->result_array();
		}

		// echo $this->db->last_query();die;

		// echo $this->db->last_query();die;

		$subcode .= $sub_data[0]['subject_code'];
		$ret .= "<option value=''>Select</option>";
		if (isset($sub_data)) {
			foreach ($sub_data as $data) {
				$ret .= "<option value=" . $data['OPTCODE'] . " data-id=" . $data['subject_code'] . ">" . $data['SUBJECT'] . "</option>";
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

		$exm_code = $this->input->post('exm_code');
		$ExamMode = $this->input->post('ExamMode');
		$subcode  = $this->input->post('subcode');
		// echo '<pre>';
		// print_r($_POST);
		// die;

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
			$stu_tbl_data = $this->dbcon->half_year_stusub_tbl_list_xii($Class_No, $sec, $exm_code, $subcode, $opt_code);

			$ret .= "<table class='table'>
			<th style='background:#5785c3; color:#fff!important;'>Studennt code</th>
			<th style='background:#5785c3; color:#fff!important;'>Marks</th>";

			if (isset($stu_tbl_data)) {
				$i = 1;
				foreach ($stu_tbl_data as $data) {
					$code = $data->STU_subcode;
					$first_three = substr($code, 0, 3);
					$last_one = substr($code, -1);
					$extracted = $first_three . $last_one; 
					$ret .= "<tr>";
					$ret .= "<td >" . $data->ADM_NO . "</td>";
					$ret .= "<td style='display:none'><input type='text' id='adm_" . $i . "' value=" . $data->ADM_NO . "></td>";
					$ret .= "<td style='display:none'>" . $data->FIRST_NM . "</td>";
					$ret .= "<td>" . $extracted . "</td>";
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
			$stu_tbl_data = $this->dbcon->half_year_stusub_tbl_list_xii($Class_No, $sec, $exm_code, $subcode);
			// echo $this->db->last_query();die;

			$ret .= "<table class='table'>
			   
			    <th style='background:#5785c3; color:#fff!important;'>Student code</th>
			    <th style='background:#5785c3; color:#fff!important;'>Marks</th>";

			if (isset($stu_tbl_data)) {
				$i = 1;
				foreach ($stu_tbl_data as $data) {
					$code = $data->STU_subcode;
					$first_three = substr($code, 0, 3);
					$last_one = substr($code, -1);
					$extracted = $first_three . $last_one; 
					$ret .= "<tr>";
					$ret .= "<td style='display:none'>" . $data->ADM_NO . "</td>";

					$ret .= "<td style='display:none'><input type='text' id='adm_" . $i . "' value=" . $data->ADM_NO . "></td>";
					$ret .= "<td style='display:none'>" . $data->FIRST_NM . "</td>";

					$ret .= "<td>" . $extracted . "</td>";


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
		// echo '<pre>';
		// print_r($_POST);
		// die;
		$get_sec = $this->db->query("SELECT ss.SEC FROM `studentsubject_xi` as ss WHERE ss.Adm_no='$adm_no' AND ss.GROUP='$sec' AND ss.Class ='$classs' AND ss.SUBCODE='$subcode'")->result();
		$sec_no = $get_sec[0]->SEC;
		//echo $sec_no;die;
		$chk_data = $this->dbcon->select('marks', 'count(*)cnt', "admno='$adm_no' AND ExamC='$exm_typ' AND SCode='$subcode' AND Term='TERM-1' AND Classes='$classs' AND Sec='$sec_no'");
		$cnt = $chk_data[0]->cnt;
		if ($cnt != 0) {
			$upd_data = array(
				'M1' => $mxm,
				'M2' => ($entr_val == '') ? '-' : $entr_val,
				'M3' => ($entr_val == '') ? '-' : $entr_val,
			);

			$this->dbcon->update('marks', $upd_data, "admno='$adm_no' AND ExamC='$exm_typ' AND SCode='$subcode' AND Term='TERM-1' AND Classes='$classs' AND Sec='$sec_no'");
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
				'Sec'     => $sec_no,
				'Term'    => 'TERM-1',
				'Teacher_code' => $user_id
			);
			// echo '<pre>';
			// print_r($ins_data);
			// die;
			$this->dbcon->insert('marks', $ins_data);
			echo "Data Insert Successfully";
		}
	}

	function verifyMarks()
	{
		$Class_No = $this->input->post('Class_No');
		$sec      = $this->input->post('sec');
		$exm_code = $this->input->post('exm_code');
		$subcode  = $this->input->post('subcode');
		$opt_code = $this->input->post('opt_code');
		$trm  = $this->input->post('trm');
		// echo '<pre>';
		// print_r($_POST);die;
		if ($trm == 't1') {
			$stu_tbl_data = $this->dbcon->half_year_stu_tbl_list2_xii($Class_No, $sec, $exm_code, $subcode, $opt_code);
			// echo $this->db->last_query();die;
			foreach ($stu_tbl_data as $key => $val) {
				$admno = $val->ADM_NO;
				$data = array(
					'status' => 1
				);
				$this->alam->update('marks', $data, "admno='$admno' AND ExamC='$exm_code' AND SCode='$subcode' AND Term='TERM-1'");
			}
		} else {
			$stu_tbl_data = $this->dbcon->half_year_stu_tbl_list2_xii($Class_No, $sec, $exm_code, $subcode, $opt_code);
			// echo $this->db->last_query();die;
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
				<th>Student Code</th>
				
				<th>Marks</th>
			</tr>
			<?php
			foreach ($stu_tbl_data as $key => $val) {
				$code = $val->STU_subcode;
				$first_three = substr($code, 0, 3);
				$last_one = substr($code, -1);
				$extracted = $first_three . $last_one;
			?>
				<tr>
					<td><?php echo $extracted; ?></td>
					
					<td><?php echo $val->mrks2; ?></td>
				</tr>
			<?php
			}
			?>
		</table>
<?php
	}
}
