<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bus_transport extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->loggedOut();
		error_reporting(0);
		$this->load->model('Mymodel', 'dbcon');
		$this->load->model('Common_fun', 'comm');
		$this->load->model('student_transport/student_transport_model', 'stm');
	}

	public function index()
	{
		$this->fee_template('student_transport/bus_transport_view');
	}

	public function show_student()
	{
		$data['adm_no'] = $adm_no = $this->input->post('adm_no');
		$adm_no_one = str_replace('/', '_', $adm_no);
		$student = $this->db->query("SELECT * FROM student WHERE ADM_NO = '$adm_no' AND Student_Status='ACTIVE'")->result();
		if (empty($student)) {
			$this->session->set_flashdata('error', 'Student Not Found');
			redirect('student_transport/Bus_transport');
		}
		else{
		
		$data['trans_report11']=$this->db->query("SELECT * , s.BUS_NO FROM `student_transport_facility` stf INNER JOIN stoppage s ON s.STOPNO=stf.NEW_STOPNO WHERE `ADM_NO` = '$adm_no' order by ID;")->result();

			
			
		if (empty($data['trans_report11'])) {
						
			redirect('student_transport/Bus_transport/allocate_bus_stoppage/' . $adm_no_one);
		}
			$data['trans_report'] = $this->db->query("SELECT ADM_NO,(SELECT FIRST_NM FROM STUDENT WHERE ADM_NO=stf.ADM_NO)FIRST_NM,(SELECT CONCAT(DISP_CLASS,'/',DISP_SEC) AS CLASS FROM STUDENT WHERE ADM_NO=stf.ADM_NO)CLASS_SEC,(SELECT stoppage FROM STOPPAGE WHERE STOPNO = stf.OLD_STOPNO) OLD_STOPNO,(SELECT stoppage FROM STOPPAGE WHERE STOPNO = stf.NEW_STOPNO)NEW_STOPNO,FROM_APPLICABLE_MONTH,TO_APPLICABLE_MONTH,BUS_NO,CREATED_DATE,USER_ID FROM student_transport_facility stf WHERE ADM_NO='$adm_no' ORDER BY ID")->result();
		$data['student_details'] = $student_details = $this->dbcon->select('student', '*', "ADM_NO='$adm_no'");

		$data['FIRST_NM'] = $student_details[0]->FIRST_NM;
		$data['DISP_CLASS'] = $student_details[0]->DISP_CLASS;
		$data['DISP_SEC'] = $student_details[0]->DISP_SEC;

		$data['APR_FEE'] = $student_details[0]->APR_FEE;
		$data['MAY_FEE'] = $student_details[0]->MAY_FEE;
		$data['JUN_FEE'] = $student_details[0]->JUNE_FEE;
		$data['JUL_FEE'] = $student_details[0]->JULY_FEE;
		$data['AUG_FEE'] = $student_details[0]->AUG_FEE;
		$data['SEP_FEE'] = $student_details[0]->SEP_FEE;
		$data['OCT_FEE'] = $student_details[0]->OCT_FEE;
		$data['NOV_FEE'] = $student_details[0]->NOV_FEE;
		$data['DEC_FEE'] = $student_details[0]->DEC_FEE;
		$data['JAN_FEE'] = $student_details[0]->JAN_FEE;
		$data['FEB_FEE'] = $student_details[0]->FEB_FEE;
		$data['MAR_FEE'] = $student_details[0]->MAR_FEE;
		$data['stoppage'] = $this->dbcon->select('stoppage', '*', " 1='1'order by STOPPAGE");
		$data['busno'] = $this->dbcon->select('busnomaster', '*', " 1='1'order by BusCode");	
		$monthNum = date("m");
		$monthName = date("F", mktime(0, 0, 0, $monthNum, 10));
		$data['CURR_MON'] = substr(strtoupper($monthName), 0, 3);
		$pre_row = $this->stm->stu_first_bus_stoppage_row($adm_no);
		$data['pre_rowid'] = $pre_row[0]->ID;
		$data['month_master'] = $this->dbcon->select('month_master', '*');
		$this->fee_template('student_transport/bus_transport_view', $data);
	}
	}

	public function allocate_stopage()
	{
		$adm_no = $this->input->post('adm_no');
		$MON = $this->input->post('mon_list');
		$NEW_STOPNO = $this->input->post('selstoppage');
		$BUSNO = $this->input->post('busno');
		// echo $adm_no.s$MON.$NEW_STOPNO;die;
		if ($MON == "none") {
			$this->session->set_flashdata('error', 'Please Select Month');
			redirect('student_transport/Bus_transport');
		}
		if ($NEW_STOPNO == "none") {
			$this->session->set_flashdata('error', 'Please Select Stoppage');
			redirect('student_transport/Bus_transport');
		}

		// to find current stoppage
		$trans_report = $this->dbcon->select('student_transport_facility', '*', "ADM_NO='$adm_no' order by ID");
		// echo "<pre>";
		// print_r($trans_report);die;
		if (!empty($trans_report)) {
			foreach ($trans_report as $p) {
				$old_stop = $p->NEW_STOPNO;
			}
		} else {
			$old_stop = 1;
		}
		$cnt = count($trans_report);

		for ($i = 0; $i < $cnt; $i++) {
			$rowID = $trans_report[$i]->ID;
			$rowFAM[$i] = $trans_report[$i]->FROM_APPLICABLE_MONTH;
			$rowTAM[$i] = $trans_report[$i]->TO_APPLICABLE_MONTH;
			if (!empty($trans_report[$i + 1]->FROM_APPLICABLE_MONTH)) {
				$mfam = date('m', strtotime($trans_report[$i + 1]->FROM_APPLICABLE_MONTH));
				$mfam_new = date("F", mktime(0, 0, 0, $mfam - 1, 10));

				if ($mfam_new == "March" || $mfam_new == "MARCH") {
					$mfam_new = date("F", mktime(0, 0, 0, $mfam, 10));
				}

				$monthNameNew1 = substr(strtoupper($mfam_new), 0, 3);

				$pmonth_code = $this->stm->get_month_calender((int)$mfam - 1);

				if ($pmonth_code[0]->id == "12") {

					$pmonth_code = $this->stm->get_month_calender($mfam);
				}

				$mon_code_new = $pmonth_code[0]->id;
				// echo "$monthNameNew1";die;
				$this->stm->update_transport_table($monthNameNew1, $mon_code_new, $adm_no, $rowID);
			}
		}

		//$monthNum = date("m");
		$monthNum = $MON;
		$monthName = date("F", mktime(0, 0, 0, $monthNum, 10));


		$getmaxno = $this->dbcon->max_no('student_transport_facility', 'ID');
		$max_no = $getmaxno[0]->ID + 1;

		//Previous Month Name
		//$monthNum = date("m");
		$monthNum = $MON;
		$monthName_pre = date("F", mktime(0, 0, 0, $monthNum - 1, 10));

		if ($monthName_pre == "March" || $monthName_pre == "MARCH") {
			$monthName_pre = date("F", mktime(0, 0, 0, $monthNum, 10));
		}


		$mname_pre = substr(strtoupper($monthName_pre), 0, 3);

		$pre_row = $this->stm->stu_last_bus_stoppage($adm_no);
		$pre_rowid = $pre_row[0]->ID;


		//substr(strtoupper($monthName), 0, 3);
		$pmonth_code = $this->stm->get_month_calender($monthNum - 1);

		$mon_code_new = $pmonth_code[0]->id;

	
		if ($mon_code_new == "12") {

			$pmonth_code = $this->stm->get_month_calender($monthNum);
			$mon_code_new = $pmonth_code[0]->id;
		}

		$cmonth_code = $this->stm->get_month_calender($MON);

		$mon_code_curr = $cmonth_code[0]->id;

			$adm_busstopage_details = array(
			'admno'	=> $adm_no,
			'bus_no'	=> $BUSNO,
			'stoppage_id' => $NEW_STOPNO,
			'status'	=> 1
		);
		$this->dbcon->update('transport_adm_details', $adm_busstopage_details, " admno='$adm_no' and month >= $mon_code_curr");
		$flag = 0;
		$data['ID'] = $max_no;
		$data['ADM_NO'] = $adm_no;
		$data['OLD_STOPNO'] = $old_stop;
		$data['NEW_STOPNO'] = $NEW_STOPNO;
		$data['FROM_APPLICABLE_MONTH'] = substr(strtoupper($monthName), 0, 3);
		$data['TO_APPLICABLE_MONTH'] = 'MAR';
		$data['FROM_APPLICABLE_MONTH_CODE'] = $mon_code_curr;
		$data['TO_APPLICABLE_MONTH_CODE'] = '12';
		$data['CREATED_DATE'] = date('Y-m-d');
		$data['USER_ID'] = $this->session->userdata('user_id');
		$data['BUS_NO'] = $BUSNO;
		
		// for student table
		$update_array = array(
			'STOPNO' => $NEW_STOPNO,
			'BUS_NO' => $BUSNO,
			'student_transport_facility_id' => $max_no
		);
		// for student_transport_facility	TO_APPLICABLE_MONTH field previous one	
		$update_array_pre = array(
			'TO_APPLICABLE_MONTH' => $mname_pre,
			'TO_APPLICABLE_MONTH_CODE' => $mon_code_new
		);
		// echo "<pre>";
		// print_r($pre_rowid);die;

		$this->db->trans_start();
		$this->dbcon->insert('student_transport_facility', $data);

		$this->dbcon->update('student', $update_array, "ADM_NO='$adm_no'");

		$this->dbcon->update('student_transport_facility', $update_array_pre, "ID='$pre_rowid'");
		// echo $this->db->trans_complete(); die;
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->session->set_flashdata('error', 'Record Not Saved, Please try again.');
			redirect('student_transport/Bus_transport');
		} else {
			$this->db->trans_complete();
			$this->session->set_flashdata('success', 'Record Saved Sucessfully');
			redirect('student_transport/Bus_transport');
		}
	}

	function allocate_bus_stoppage($adm_no)
	{
		$tmp = explode('_', $adm_no);
		$data['adm_no'] = $adm_no = $tmp[0] . '/' . $tmp[1];
		$student = $this->db->query("SELECT * FROM student  WHERE ADM_NO = '$adm_no'")->result();
		foreach ($student as $stu) {
			$data['ADM_NO'] = $stu->ADM_NO;
			$data['FIRST_NM'] = $stu->FIRST_NM;
			$data['FATHER_NM'] = $stu->FATHER_NM;
			$data['CORR_ADD'] = $stu->CORR_ADD;
			$data['DISP_CLASS'] = $stu->DISP_CLASS;
			$data['DISP_SEC'] = $stu->DISP_SEC;
			$data['ROLL_NO'] = $stu->ROLL_NO;
			$data['SEX'] = $stu->SEX;
		}

		$data['busno'] = $this->dbcon->select('busnomaster', '*', " 1='1'order by BusCode");
		$this->fee_template('student_transport/bus_transport_allocate', $data);
	}

	function add_student()
	{
		$data['adm_no'] = $adm_no = $this->input->post('adm_no');
		$data['stoppage'] = $this->dbcon->select('stoppage', '*', " 1='1'order by STOPPAGE");
		$this->fee_template('student_transport/bus_transport_allocate', $data);
	}
	
	function allocate_stopage_fornew()
	{
		//$adm_no=htmlentities($this->input->post('adm_no'));
		$adm_no = $this->input->post('adm_no');
		$MON = $this->input->post('mon_list');
		$NEW_STOPNO = $this->input->post('selstoppage');
		$NEW_BUSNO = $this->input->post('busno');


		if ($MON == "none") {
			$this->session->set_flashdata('error', 'Please Select Month');
			redirect('student_transport/Bus_transport');
		}
		if ($NEW_STOPNO == "none") {
			$this->session->set_flashdata('error', 'Please Select Stoppage');
			redirect('student_transport/Bus_transport');
		}

		$getmaxno = $this->dbcon->max_no('student_transport_facility', 'ID');

		$max_no = $getmaxno[0]->ID + 1;


		$monthNum = $MON;
		$monthName = date("F", mktime(0, 0, 0, $monthNum, 10));

		$cmonth_code = $this->stm->get_month_calender($MON);

		$mon_code_curr = $cmonth_code[0]->id;
			for ($i = $mon_code_curr; $i <= 12; $i++) {
			$adm_busstopage_details = array(
				'admno'	=> $adm_no,
				'bus_no'	=> $NEW_BUSNO,
				'stoppage_id' => $NEW_STOPNO,
				'month'		=> $i,
				'status'	=> 1
			);
			$this->dbcon->insert('transport_adm_details', $adm_busstopage_details);
		}
		$data['ID'] = $max_no;
		$data['ADM_NO'] = $adm_no;
		$data['OLD_STOPNO'] = '1';
		$data['NEW_STOPNO'] = $NEW_STOPNO;
		$data['FROM_APPLICABLE_MONTH'] = substr(strtoupper($monthName), 0, 3);
		$data['TO_APPLICABLE_MONTH'] = 'MAR';
		$data['FROM_APPLICABLE_MONTH_CODE'] = $mon_code_curr;
		$data['TO_APPLICABLE_MONTH_CODE'] = '12';
		$data['CREATED_DATE'] = date('Y-m-d');
		$data['USER_ID'] = $this->session->userdata('user_id');
		$data['BUS_NO'] = $NEW_BUSNO;

		// for student table
		$update_array = array(
			'stopno' => $NEW_STOPNO,
			'student_transport_facility_id' => $max_no,
			'BUS_NO' => $NEW_BUSNO
		);
		$this->db->trans_start();
		$this->dbcon->insert('student_transport_facility', $data);
		//echo $this->db->last_query();echo '<br>';
		$this->dbcon->update('student', $update_array, "ADM_NO='$adm_no'");
		// echo $this->db->last_query();echo '<br>';
		// die();
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->session->set_flashdata('error', 'Record Not Saved, Please try again.');
			redirect('student_transport/Bus_transport');
		} else {
			$this->db->trans_complete();
			$this->session->set_flashdata('success', 'Record Saved Sucessfully');
			redirect('student_transport/Bus_transport');
		}
	}

	function allocate_stopage_fornew_old()
	{

		//$adm_no=htmlentities($this->input->post('adm_no'));

		$tmp = explode('/', $this->input->post('adm_no'));

		$adm_no = $tmp[0] . '/' . $tmp[1] . '/' . $tmp[2];

		$MON = $this->input->post('mon_list');
		$NEW_STOPNO = $this->input->post('selstoppage');


		if ($MON == "none") {
			$this->session->set_flashdata('error', 'Please Select Month');
			redirect('student_transport/Bus_transport');
		}
		if ($NEW_STOPNO == "none") {
			$this->session->set_flashdata('error', 'Please Select Stoppage');
			redirect('student_transport/Bus_transport');
		}

		$getmaxno = $this->dbcon->max_no('student_transport_facility', 'ID');
		$max_no = $getmaxno[0]->ID + 1;

		$monthNum = $MON;
		$monthName = date("F", mktime(0, 0, 0, $monthNum, 10));

		$cmonth_code = $this->stm->get_month_calender($MON);

		$mon_code_curr = $cmonth_code[0]->id;

		$data['ID'] = $max_no;
		$data['ADM_NO'] = $adm_no;
		$data['OLD_STOPNO'] = '1';
		$data['NEW_STOPNO'] = $NEW_STOPNO;
		$data['FROM_APPLICABLE_MONTH'] = substr(strtoupper($monthName), 0, 3);
		$data['TO_APPLICABLE_MONTH'] = 'MAR';
		$data['FROM_APPLICABLE_MONTH_CODE'] = $mon_code_curr;
		$data['TO_APPLICABLE_MONTH_CODE'] = '12';
		$data['CREATED_DATE'] = date('Y-m-d');
		$data['USER_ID'] = $this->session->userdata('user_id');

		// for student table
		$update_array = array(
			'stopno' => $NEW_STOPNO,
			'student_transport_facility_id' => $max_no
		);
		$this->db->trans_start();
		$this->dbcon->insert('student_transport_facility', $data);
		//echo $this->db->last_query();echo '<br>';
		$this->dbcon->update('student', $update_array, "ADM_NO='$adm_no'");
		//echo $this->db->last_query();echo '<br>';
		//die();
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->session->set_flashdata('error', 'Record Not Saved, Please try again.');
			redirect('student_transport/Bus_transport');
		} else {
			$this->db->trans_complete();
			$this->session->set_flashdata('success', 'Record Saved Sucessfully');
			redirect('student_transport/Bus_transport');
		}
	}

	function del_transport()
	{
		$id = $this->input->post('id');
		$adm_no = $this->input->post('adm_no');

		$trans_report = $this->dbcon->select('student_transport_facility', '*', "ADM_NO='$adm_no' order by ID");
		$cnt = count($trans_report);

		$stu_report = $this->dbcon->select('student', '*', "ADM_NO='$adm_no'");
		$p = $stu_report[0]->student_transport_facility_id;

		if ($cnt == 1) {
			echo '1';
		}
		if ($cnt > 1) {
			if ($id == $p) {
				echo '2';
			} else {
				// echo $id;
				$this->db->trans_start();
				$t = $this->stm->select_and_insert($id);
				$p = $this->stm->del_from_bus_transport($id);
				// echo $this->db->last_query();die;
				$this->db->trans_complete();
				if ($this->db->trans_status() === FALSE) {
					$this->db->trans_rollback();
					echo '4';
				} else {
					$this->db->trans_commit();
					echo '3';
				}
			}
		}
	}

	function del_transport_old()
	{
		$id = $this->input->post('id');
		$adm_no = $this->input->post('adm_no');

		$trans_report = $this->dbcon->select('student_transport_facility', '*', "ADM_NO='$adm_no' order by ID");
		$cnt = count($trans_report);

		$stu_report = $this->dbcon->select('student', '*', "ADM_NO='$adm_no'");
		$p = $stu_report[0]->student_transport_facility_id;
		// echo "<pre>";
		// print_r($p); 
		// echo $id;
		// print_r($stu_report);
		// die;
		if ($cnt == 1) {
			echo '1';
		}
		if ($cnt > 1) {
			if ($id == $p) {
				echo '2';
			} else {
				// echo $id;
				$this->db->trans_start();
				$p = $this->stm->del_from_bus_transport($id);
				$t = $this->stm->select_and_insert($id);
				$this->db->trans_complete();
				if ($this->db->trans_status() === FALSE) {
					$this->db->trans_rollback();
					echo '4';
				} else {
					$this->db->trans_commit();
					echo '3';
				}
			}
		}
	}

	//new function

	public function get_busno()
	{
		$stopno = $this->input->post('stopno');
		$data = $this->db->query("SELECT busnomaster.BusCode, busnomaster.BusNo FROM bus_route_master LEFT JOIN busnomaster ON bus_route_master.BusCode = busnomaster.BusCode WHERE bus_route_master.STOPNO = '$stopno' ")->result();

		echo json_encode($data);
	}
	
	public function selectStoppage()
	{
		$bus_no = $this->input->post('val');
		$trip_id = $this->input->post('trip');
		$data = $this->db->query("SELECT STOPNO,
		(SELECT stoppage.STOPPAGE FROM stoppage WHERE stoppage.STOPNO=bus_route_master.STOPNO)STOPPAGE
		FROM `bus_route_master` WHERE BusCode=$bus_no AND Trip_ID =$trip_id ORDER BY bus_route_master.STOPNO")->result();
		
?>
		<option value=''>Select STOPPAGE NO</option>
		<option value='1'>NONE</option>
		<?php
		foreach ($data as $dt) {
		?>
			<option value='<?php echo $dt->STOPNO; ?>'><?php echo $dt->STOPPAGE; ?></option>
		<?php
		}
	}
	public function selectTrip()
	{
		$admno = $this->input->post('admNo');
		$data = $this->db->query("SELECT CLASS FROM `student` WHERE ADM_NO='$admno' AND Student_Status='Active'")->row_array();
		$cls_data = $data['CLASS'];

		$cls = $this->db->query("SELECT CLASS_NO,TRIP_NM,TRIP_ID FROM BUS_TRIP_MASTER")->result();

		echo "<option value=''>Select Trip</option>";
		foreach ($cls as $val) {
			$cls_arr = [];
			$cls_arr = unserialize($val->CLASS_NO);

			if (in_array($cls_data,$cls_arr)){
				
				echo "<option value='$val->TRIP_ID'>$val->TRIP_NM</option>";
			}
		}

	}

	public function selectBus()
	{
		$trip_id = $this->input->post('val');
		$data = $this->db->query("SELECT DISTINCT BusCode FROM `bus_route_master` WHERE Trip_ID='$trip_id'")->result();
		?>

		<option value=''>Select Bus</option>
		<option value='0'>No Bus</option>
		<?php
		foreach ($data as $dt) {
		?>
			<option value='<?php echo $dt->BusCode; ?>'><?php echo $dt->BusCode; ?></option>
<?php
		}
	}
}
