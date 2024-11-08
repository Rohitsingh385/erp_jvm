<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bus_report extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->loggedOut();
		$this->load->model('Mymodel', 'dbcon');
	}
	public function show_report()
	{
		$this->fee_template('bus_report/show_report');
	}

	public function stoppage_wise()
	{
		$stoppage = $this->db->query("SELECT STOPNO,STOPPAGE from stoppage")->result();
		$trip = $this->db->query("SELECT TRIP_ID,TRIP_NM FROM bus_trip_master")->result();

		$array = array(
			'stoppage' => $stoppage,
			'trip'		=> $trip
		);
		$this->fee_template('bus_report/stoppage', $array);
	}
	
	public function bus_amt()
	{
		$val = $this->input->post('val');
		
		
		$data = $this->db->query("SELECT AMT FROM `stop_amt` where STOP_NO='$val'")->result();
		?>
		<?php
		foreach ($data as $dt) {
		?>
			<option value='<?php echo $dt->AMT; ?>'><?php echo $dt->AMT; ?></option>
		<?php
		}
	}

	public function stoppage_details()
	{
		$stoppage		= $this->input->post('stoppage_name');
		$trip			= $this->input->post('trip_name');
		$amt		= $this->input->post('amt');
		//$data = $this->db->query("select ADM_NO,FIRST_NM,FATHER_NM,C_MOBILE,DISP_CLASS,DISP_SEC,ROLL_NO from student where STOPNO='$stoppage' AND Student_status='ACTIVE' order by FIRST_NM")->result();
		
		$data = $this->db->query("select ADM_NO,FIRST_NM,FATHER_NM,C_MOBILE,DISP_CLASS,DISP_SEC,ROLL_NO,BUS_NO from student inner join bus_route_master on student.STOPNO=bus_route_master.STOPNO where student.STOPNO='$stoppage' AND Student_status='ACTIVE' and bus_route_master.trip_id=$trip order by FIRST_NM")->result();
		
		
		$array = array(
			'stoppage' => $stoppage,
			'data' => $data,
			'amt' => $amt,
			'trip_id' => $trip
		);

		if (!empty($data)) {
			$this->load->view('bus_report/stoppage_details', $array);
		} else {
			echo "<center><h1>Sorry No Student</h1></center>";
		}
	}
	
	public function download_busreport()
	{
		$stoppage		= $this->input->post('stoppage');
		$trip_id		= $this->input->post('trip');
		$amt		= $this->input->post('amt');
		$stop_name = $this->db->query("select STOPPAGE from stoppage where STOPNO='$stoppage'")->result();
		$stoppagae_name = $stop_name[0]->STOPPAGE;
		$school_setting = $this->dbcon->select('school_setting', '*');
		$data = $this->db->query("select ADM_NO,FIRST_NM,FATHER_NM,C_MOBILE,DISP_CLASS,DISP_SEC,ROLL_NO,BUS_NO from student where STOPNO='$stoppage' AND Student_status='ACTIVE' order by CLASS,FIRST_NM")->result();

		$array = array(
			'school_setting' => $school_setting,
			'data' => $data,
			'stoppage_name' => $stoppagae_name,
			'amt' => $amt,
			'trip_id'=>$trip_id
		);
		//echo '<pre>';
		//print_r($_POST);die;

		$this->load->view('bus_report/stoppage_pdf', $array);

		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'landscape');
		$this->dompdf->render();
		$this->dompdf->stream("Bus_Stoppage.pdf", array("Attachment" => 0));
	}
	
	public function download_busreport_bus_no()
	{
		$buscode = $this->input->post('buscode');
		$trip = $this->input->post('trip');
		// $buscode = $buscode-1;
		$school_setting = $this->dbcon->select('school_setting', '*');
		if ($trip != 'All') {
			$cls = $this->db->query("SELECT CLASS_NO FROM `bus_trip_master` WHERE TRIP_ID = $trip")->result();
		}

		$clsss = implode("','", unserialize($cls[0]->CLASS_NO));


		if ($buscode == 'All') {

			if ($trip == 'All') {
				$data = $this->db->query("select s.adm_no,s.first_nm,s.father_nm,s.disp_class,s.disp_sec,s.c_mobile,s.stopno,st.stoppage,s.BUS_NO from student s inner join stoppage st on s.stopno=st.STOPNO where s.BUS_NO!='' order by st.stopno;")->result();
			} else {
				$data = $this->db->query("select s.adm_no,s.first_nm,s.father_nm,s.disp_class,s.disp_sec,s.c_mobile,s.stopno,st.stoppage,s.BUS_NO from student s inner join stoppage st on s.stopno=st.STOPNO where s.bus_no!='' and s.class in ('$clsss') order by st.stopno")->result();
			}
		} else {

			if ($trip == 'All') {
				$data = $this->db->query("select s.BUS_NO,s.adm_no,s.first_nm,s.father_nm,s.disp_class,s.disp_sec,s.c_mobile,s.stopno,st.stoppage from student s inner join stoppage st on s.stopno=st.STOPNO where s.BUS_NO=$buscode")->result();
			} else {
				$data = $this->db->query("select s.BUS_NO,s.adm_no,s.first_nm,s.father_nm,s.disp_class,s.disp_sec,s.c_mobile,s.stopno,st.stoppage from student s inner join stoppage st on s.stopno=st.STOPNO where s.BUS_NO=$buscode and s.class in ('$clsss')")->result();
			}
		}


		$array = [
			'bus_no' => $buscode,
			'buscode' => $buscode,
			'getBusNoData' => $data,
			'trip'	=> $trip,
			'school_setting'=>$school_setting
		];

		$this->load->view('bus_report/busno_details_pdf', $array);
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'landscape');
		$this->dompdf->render();
		$this->dompdf->stream("Bus_Stoppage.pdf", array("Attachment" => 0));
	}
	
	public function student_busfacility()
	{
		$class = $this->dbcon->select('classes', '*');
		$sec = $this->dbcon->select('sections', '*');
		$array = array(
			'class' => $class,
			'sec' => $sec
		);
		$this->fee_template('bus_report/stu_busfacility', $array);
	}

	public function stu_buslist()
	{
	
		$class		= $this->input->post('class_name');
		$sec 		= $this->input->post('sec_name');

		if ($class == 'All' && $sec == 'All') {
			$data = $this->db->query("select stu.ADM_NO,stu.FIRST_NM,stu.FATHER_NM,stu.C_MOBILE,stu.DISP_CLASS,stu.DISP_SEC,stu.ROLL_NO,stu.STOPNO,stu.BUS_NO,(select STOPPAGE from stoppage where stu.STOPNO=STOPNO) stopname,stu.STOPNO,(SELECT AMT from stop_amt where stu.STOPNO=STOP_NO) stp_amt from student as stu where stu.STOPNO>1 AND stu.Student_status='ACTIVE' order by FIRST_NM")->result();

		} elseif ($sec == 'All') {
			$data = $this->db->query("select stu.ADM_NO,stu.FIRST_NM,stu.FATHER_NM,stu.C_MOBILE,stu.DISP_CLASS,stu.DISP_SEC,stu.ROLL_NO,stu.STOPNO,stu.BUS_NO,(select STOPPAGE from stoppage where stu.STOPNO=STOPNO) stopname,stu.STOPNO,(SELECT AMT from stop_amt where stu.STOPNO=STOP_NO) stp_amt from student as stu where stu.CLASS='$class' AND stu.STOPNO>1 AND stu.Student_status='ACTIVE' order by FIRST_NM")->result();
		} else {
			$data = $this->db->query("select stu.ADM_NO,stu.FIRST_NM,stu.FATHER_NM,stu.C_MOBILE,stu.DISP_CLASS,stu.DISP_SEC,stu.ROLL_NO,stu.STOPNO,stu.BUS_NO,(select STOPPAGE from stoppage where stu.STOPNO=STOPNO) stopname,stu.STOPNO,(SELECT AMT from stop_amt where stu.STOPNO=STOP_NO) stp_amt from student as stu where stu.CLASS='$class' AND stu.SEC='$sec' AND stu.STOPNO>1 AND stu.Student_status='ACTIVE' order by FIRST_NM")->result();
		}
		


		$array = array(
			'data' => $data,
			'class' => $class,
			'sec' => $sec,
		);

		if (!empty($data)) {
			$this->load->view('bus_report/student_listshow', $array);
		} else {
			echo "<center><h1>Sorry No Student</h1></center>";
		}
	}

	

	
	
	public function download_bus_stulistreport()
	{
		$class		= $this->input->post('classs');
		$sec		= $this->input->post('secc');

		$school_setting = $this->dbcon->select('school_setting', '*');

		if ($class == 'All' && $sec == 'All') {
			$data = $this->db->query("select stu.ADM_NO,stu.FIRST_NM,stu.FATHER_NM,stu.C_MOBILE,stu.DISP_CLASS,stu.DISP_SEC,stu.ROLL_NO,stu.STOPNO,stu.BUS_NO,(select STOPPAGE from stoppage where stu.STOPNO=STOPNO) stopname,stu.STOPNO,(SELECT AMT from stop_amt where stu.STOPNO=STOP_NO) stp_amt from student as stu where stu.STOPNO>1 AND stu.Student_status='ACTIVE' order by FIRST_NM")->result();
		} elseif ($sec == 'All') {
			$data = $this->db->query("select stu.ADM_NO,stu.FIRST_NM,stu.FATHER_NM,stu.C_MOBILE,stu.DISP_CLASS,stu.DISP_SEC,stu.ROLL_NO,stu.STOPNO,stu.BUS_NO,(select STOPPAGE from stoppage where stu.STOPNO=STOPNO) stopname,stu.STOPNO,(SELECT AMT from stop_amt where stu.STOPNO=STOP_NO) stp_amt from student as stu where stu.CLASS='$class' AND stu.STOPNO>1 AND stu.Student_status='ACTIVE' order by FIRST_NM")->result();
		} else {
			$data = $this->db->query("select stu.ADM_NO,stu.FIRST_NM,stu.FATHER_NM,stu.C_MOBILE,stu.DISP_CLASS,stu.DISP_SEC,stu.ROLL_NO,stu.STOPNO,stu.BUS_NO,(select STOPPAGE from stoppage where stu.STOPNO=STOPNO) stopname,stu.STOPNO,(SELECT AMT from stop_amt where stu.STOPNO=STOP_NO) stp_amt from student as stu where stu.CLASS='$class' AND stu.SEC='$sec' AND stu.STOPNO>1 AND stu.Student_status='ACTIVE' order by FIRST_NM")->result();
		}

		$array = array(
			'school_setting' => $school_setting,
			'data' => $data,
			'class' => $class,
			'sec' => $sec,
		);

		$this->load->view('bus_report/bus_stulist_pdf', $array);

		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'landscape');
		$this->dompdf->render();
		$this->dompdf->stream("Bus_FacilityList.pdf", array("Attachment" => 0));
	}

	public function stoppage_summary()
	{

		$this->fee_template('bus_report/stoppage_summary');
	}

	public function stoppage_summary_data()
	{

		$data = $this->db->query("SELECT distinct STOPNO,(select STOPPAGE from stoppage where stu.STOPNO=STOPNO) stopname,(SELECT AMT from stop_amt where stu.STOPNO=STOP_NO) stp_amt,(SELECT COUNT(*) FROM student WHERE student.STOPNO=stu.STOPNO AND student.STOPNO>1 AND Student_Status='ACTIVE')TOTALSTUDENT,(SELECT COUNT(*) FROM student WHERE student.STOPNO=stu.STOPNO AND student.sex=1 AND student.STOPNO>1 AND Student_Status='ACTIVE')MALE,(SELECT COUNT(*) FROM student WHERE student.STOPNO=stu.STOPNO AND student.sex=2 AND student.STOPNO>1 AND Student_Status='ACTIVE')FEMALE FROM `student` stu where stu.Student_status='ACTIVE' AND stu.STOPNO>1")->result();
		$array = array(

			'data' => $data,

		);

		if (!empty($data)) {
			$this->load->view('bus_report/stoppage_summary_details', $array);
		} else {
			echo "<center><h1>Sorry No Student</h1></center>";
		}
	}

	public function stoppage_summary_pdfold()
	{

		$school_setting = $this->dbcon->select('school_setting', '*');
		$data = $this->db->query("SELECT distinct STOPNO,(select STOPPAGE from stoppage where stu.STOPNO=STOPNO) stopname,(SELECT AMT from stop_amt where stu.STOPNO=STOP_NO) stp_amt,(SELECT COUNT(*) FROM student WHERE student.STOPNO=stu.STOPNO AND student.STOPNO>1 AND Student_Status='ACTIVE')TOTALSTUDENT,(SELECT COUNT(*) FROM student WHERE student.STOPNO=stu.STOPNO AND student.sex=1 AND student.STOPNO>1 AND Student_Status='ACTIVE')MALE,(SELECT COUNT(*) FROM student WHERE student.STOPNO=stu.STOPNO AND student.sex=2 AND student.STOPNO>1 AND Student_Status='ACTIVE')FEMALE FROM `student` stu where stu.Student_status='ACTIVE' AND stu.STOPNO>1")->result();

		$array = array(
			'school_setting' => $school_setting,
			'data' => $data,

		);

		$this->load->view('bus_report/stoppage_summary_pdf', $array);

		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A3', 'landscape');
		$this->dompdf->render();
		$this->dompdf->stream("Stoppage_Summary.pdf", array("Attachment" => 0));
	}

	public function find_sec()
	{
		$val = $this->input->post('val');
		$data = $this->dbcon->select_distinct('student', 'DISP_SEC,SEC', "CLASS='$val' AND Student_Status='ACTIVE'");
		?>
		<option value=''>Select</option>
		<option value='All'>All Section</option>
		<?php
		foreach ($data as $dt) {
		?>
			<option value='<?php echo $dt->SEC; ?>'><?php echo $dt->DISP_SEC; ?></option>
		<?php
		}
	}

	public function student_bus_card()
	{
		$class = $this->dbcon->select('classes', '*');
		$sec = $this->dbcon->select('sections', '*');
		$bus = $this->dbcon->select('busnomaster', '*');
		$array = array(
			'class' => $class,
			'sec' => $sec,
			'bus'	=> $bus,
		);
		// echo "<pre>";
		// print_r($array);die;
		$this->fee_template('bus_report/stu_buspasscard', $array);
	}

	public function stu_bus_pass_list()
	{
		$class		= $this->input->post('class_name');
		$sec 		= $this->input->post('sec_name');
		$bus_number = $this->input->post('bus_number');
		$bus_pass   = $this->input->post('bus_pass');
		$buss_code = $this->db->query("select BusCode from busnomaster where BusNo='$bus_number'")->result();
		$busCode = $buss_code[0]->BusCode;
		if ($bus_pass == 1) {
			$data = $this->db->query("select stu.ADM_NO,stu.FIRST_NM,stu.FATHER_NM,stu.C_MOBILE,stu.DISP_CLASS,stu.DISP_SEC,stu.ROLL_NO,stu.STOPNO,(select STOPPAGE from stoppage where stu.STOPNO=STOPNO) stopname,stu.STOPNO,(SELECT AMT from stop_amt where stu.STOPNO=STOP_NO) stp_amt from student as stu where stu.stopno='$busCode' AND stu.STOPNO>1 AND stu.Student_status='ACTIVE' order by FIRST_NM")->result();

			// echo "<pre>"; print_r($data);die;

			$array = array(
				'data' => $data,
				'class' => $class,
				'sec' => $sec,
			);
			if (!empty($data)) {
				$this->load->view('bus_report/stu_buspasslist', $array);
			} else {
				echo "<center><h1>Sorry No Student</h1></center>";
			}
		}
		if ($bus_pass == 2) {
			$data = $this->db->query("select stu.ADM_NO,stu.FIRST_NM,stu.FATHER_NM,stu.C_MOBILE,stu.DISP_CLASS,stu.DISP_SEC,stu.ROLL_NO,stu.STOPNO,(select STOPPAGE from stoppage where stu.STOPNO=STOPNO) stopname,stu.STOPNO,(SELECT AMT from stop_amt where stu.STOPNO=STOP_NO) stp_amt from student as stu where stu.CLASS='$class' AND stu.SEC='$sec' AND stu.STOPNO>1 AND stu.Student_status='ACTIVE' order by FIRST_NM")->result();

			$array = array(
				'data' => $data,
				'class' => $class,
				'sec' => $sec,
			);
			if (!empty($data)) {
				$this->load->view('bus_report/stu_buspasslist', $array);
			} else {
				echo "<center><h1>Sorry No Student</h1></center>";
			}
		}
	}
	
	public function busno_wise()
	{
		// $data['busno'] = $this->db->query("SELECT DISTINCT(bus_no) FROM stoppage order by bus_no asc")->result();

		$data['busno'] = $this->db->query("SELECT DISTINCT (BusNo)  as  BusNo , BusCode as bus_no FROM `busnomaster` ORDER BY BusCode;")->result();

		$data['trip'] = $this->db->query("SELECT TRIP_ID,TRIP_NM FROM bus_trip_master")->result();

		$this->render_template('bus_report/busno', $data);
	}

	
	public function busno_details()
	{
		$buscode = $this->input->post('stoppage_name');
		$trip = $this->input->post('trip_name');
		// $buscode = $buscode-1;

		if ($trip != 'All') {
			$cls = $this->db->query("SELECT CLASS_NO FROM `bus_trip_master` WHERE TRIP_ID = $trip")->result();
		}

		$clsss = implode("','", unserialize($cls[0]->CLASS_NO));


		if ($buscode == 'All') {

			if ($trip == 'All') {
				$data = $this->db->query("select s.adm_no,s.first_nm,s.father_nm,s.disp_class,s.disp_sec,s.c_mobile,s.stopno,st.stoppage,s.BUS_NO from student s inner join stoppage st on s.stopno=st.STOPNO where s.BUS_NO!='' order by st.stopno;")->result();
			} else {
				$data = $this->db->query("select s.adm_no,s.first_nm,s.father_nm,s.disp_class,s.disp_sec,s.c_mobile,s.stopno,st.stoppage,s.BUS_NO from student s inner join stoppage st on s.stopno=st.STOPNO where s.bus_no!='' and s.class in ('$clsss') order by st.stopno")->result();
			}
		} else {

			if ($trip == 'All') {
				$data = $this->db->query("select s.BUS_NO,s.adm_no,s.first_nm,s.father_nm,s.disp_class,s.disp_sec,s.c_mobile,s.stopno,st.stoppage from student s inner join stoppage st on s.stopno=st.STOPNO where s.BUS_NO=$buscode")->result();
			} else {
				$data = $this->db->query("select s.BUS_NO,s.adm_no,s.first_nm,s.father_nm,s.disp_class,s.disp_sec,s.c_mobile,s.stopno,st.stoppage from student s inner join stoppage st on s.stopno=st.STOPNO where s.BUS_NO=$buscode and s.class in ('$clsss')")->result();
			}
		}


		$array = [
			'bus_no' => $buscode,
			'buscode' => $buscode,
			'getBusNoData' => $data,
			'trip'			=>$trip
		];

		$this->load->view('bus_report/busno_details', $array);
	}
	
	public function student_busno_summary()
	{
		$data = $this->dbcon->select('STOPPAGE', 'DISTINCT(BUS_NO)BUS_NO,count(STOPPAGE)cnt,', "BUS_NO!='' and BUS_NO!='-' group by BUS_NO");
		$alldata = array();
		foreach ($data as $key) {
			$bsno = $key->BUS_NO;
			$stop = '';
			$data2 = $this->dbcon->select('STOPPAGE', 'STOPNO', "BUS_NO='$bsno'");
			foreach ($data2 as $Key2) {
				$stop .= "'" . $Key2->STOPNO . "',";
			}
			$stop .= "'0'";
			$group_a = $this->dbcon->select('student', 'count(ADM_NO)cnt', "1='1' and STOPNO in ($stop) and DISP_CLASS in ('VI','VII','VIII') and Student_status='ACTIVE'");
			$group_b = $this->dbcon->select('student', 'count(ADM_NO)cnt', "1='1' and STOPNO in ($stop) and DISP_CLASS in ('IX','X') and Student_status='ACTIVE'");
			$group_c = $this->dbcon->select('student', 'count(ADM_NO)cnt', "1='1' and STOPNO in ($stop) and DISP_CLASS in ('XI','XII') and Student_status='ACTIVE'");
			$group_m = $this->dbcon->select('student', 'count(ADM_NO)cnt', "1='1' and STOPNO in ($stop) and SEX='1' and Student_status='ACTIVE'");
			$group_f = $this->dbcon->select('student', 'count(ADM_NO)cnt', "1='1' and STOPNO in ($stop) and SEX='2' and Student_status='ACTIVE'");
			$group_a = (sizeof($group_a) != 0) ? $group_a[0]->cnt : 0;
			$group_b = (sizeof($group_b) != 0) ? $group_b[0]->cnt : 0;
			$group_c = (sizeof($group_c) != 0) ? $group_c[0]->cnt : 0;
			$group_m = (sizeof($group_m) != 0) ? $group_m[0]->cnt : 0;
			$group_f = (sizeof($group_f) != 0) ? $group_f[0]->cnt : 0;
			$tot_stu = $group_a + $group_b + $group_c;
			$mrg = array('bus_no' => $bsno, 'stoppage' => $key->cnt, 'tot_stu' => $tot_stu, 'group_a' => $group_a, 'group_b' => $group_b, 'group_c' => $group_c, 'group_m' => $group_m, 'group_f' => $group_f);

			$alldata[] = $mrg;
		}
		$all['alldata'] = $alldata;
		$all['school_setting'] = $this->dbcon->select('school_setting', '*');
		$this->render_template('bus_report/stu_busno_summary', $all);
	}

	public function student_busno()
	{
		$data['BUS_NO'] = $this->dbcon->select('STOPPAGE', 'DISTINCT(BUS_NO)BUS_NO', "BUS_NO!=''");
		$this->render_template('bus_report/stu_busno', $data);
	}

	public function stu_data_bus()
	{
		$bno = $this->input->post('b_no');
		$data = $this->dbcon->select('STOPPAGE', 'STOPPAGE,STOPNO', "BUS_NO ='$bno'");
		foreach ($data as $key) {
			$stop_nm = $key->STOPPAGE;
			$stop_no = $key->STOPNO;
			$data = $this->dbcon->select('student', 'FIRST_NM,TITLE_NM,MIDDLE_NM,ADM_NO,DISP_CLASS,DISP_SEC,C_MOBILE', "STOPNO ='$stop_no' and Student_status='ACTIVE'");
			$ddl = array('stop_nm' => $stop_nm, 'stu_data' => $data);
			$record[$stop_no] = $ddl;
		}
		$mydata['school_setting'] = $this->dbcon->select('school_setting', '*');
		$mydata['stu_busno'] = $record;
		$mydata['bs_no'] = $bno;


		$this->load->view('bus_report/stu_busno_data', $mydata);
	}

	public function updateBusByStu()
	{
		$bus_code = $this->input->post('val');
		$type     = $this->input->post('type');
		$admno    = $this->input->post('admno');
		if ($type == 1) {
			$upd = array(
				'arrival_bus_code' => $bus_code
			);
		} else {
			$upd = array(
				'departure_bus_code' => $bus_code
			);
		}

		$this->dbcon->update('student', $upd, "ADM_NO='$admno'");
	}

	public function getBusReport($bus_code)
	{
		$data['data'] = $this->db->query("select ADM_NO,FIRST_NM,FATHER_NM,C_MOBILE,DISP_CLASS,DISP_SEC,ROLL_NO,arrival_bus_code,(select BusNo from busnomaster where BusCode=student.arrival_bus_code)arrival,departure_bus_code,(select BusNo from busnomaster where BusCode=student.departure_bus_code)departure from student where STOPNO='$bus_code' AND Student_status='ACTIVE' order by DISP_CLASS,DISP_SEC,ROLL_NO")->result_array();
		$this->load->view('bus_report/bus_report_new', $data);
	}

	public function generate_bus_pass()
	{
		echo "<script> window.print();</script>";
		$chekedstudent = $this->input->post('chekedstudent');
		// echo "<pre>";print_r($chekedstudent);die;
		$cnt_adm = '';
		foreach ($chekedstudent as $key) {
			$cnt_adm .= "'$key',";
		}
		$cnt_adm .= "'0'";
		$data['schoolData'] = $this->alam->selectA('school_setting', '*');
		$data['getData'] = $this->alam->selectA('student', 'student_image,ADM_NO,FIRST_NM,DISP_CLASS,DISP_SEC,FATHER_NM,BLOOD_GRP,(select STOPPAGE from stoppage where STOPNO=student.STOPNO)STOPNO,(select bus_no from bus_no_naster where id=student.arrival_bus_code)arrival_bus_code,(select bus_no from bus_no_naster where id=student.departure_bus_code)departure_bus_code,C_MOBILE,P_MOBILE,CORR_ADD,C_CITY,C_STATE,C_PIN', "ADM_NO in ($cnt_adm) order by (FIRST_NM)");
		// echo"<pre>";
		// print_r($data);die;
		$this->load->view('bus_report/stu_buspass', $data);

		// $html = $this->output->get_output();
		// $this->load->library('pdf');
		// $this->dompdf->loadHtml($html);
		// $this->dompdf->setPaper('A4', 'portrait');
		// $this->dompdf->render();
		// $this->dompdf->stream("Student-icard.pdf", array("Attachment"=>0));
	}
		public function busno_stu_details()
	{

		$data['busno'] = $this->db->query("SELECT DISTINCT (BusNo)  as  BusNo , BusCode as bus_no FROM `busnomaster` ORDER BY BusCode;")->result();

		$data['trip'] = $this->db->query("SELECT TRIP_ID,TRIP_NM FROM bus_trip_master")->result();

		$this->render_template('bus_report/busno_stu_details', $data);
	}
	public function busno_studetails()
	{

		$buscode = $this->input->post('stoppage_name');
		
		$stopno = $this->db->query("SELECT stopno,(select stoppage from stoppage where bus_route_master.stopno = stopno) as stop_nm FROM bus_route_master where buscode = $buscode")->result();

		foreach ($stopno as $stop_details) {
			$data['stu_details'][$stop_details->stop_nm] = $this->db->query("SELECT DISP_CLASS,DISP_SEC, ADM_NO,FIRST_NM,ROLL_NO,P_MOBILE,eward.HOUSENAME FROM STUDENT INNER JOIN eward ON eward.HOUSENO= student.EMP_WARD  WHERE STOPNO = $stop_details->stopno")->result();
		}

		$data['bus_no'] = $buscode;

		$this->load->view('bus_report/busno_stu', $data);
	}
	
	public function busno_summary()
	{
		$this->fee_template('bus_report/busno_summary');
	}

	public function busno_summary_data()
	{

		$data = $this->db->query("SELECT BUS_NO, ( SELECT COUNT(BUS_NO) FROM STUDENT WHERE stu.BUS_NO=BUS_NO ) AS TOTAL, ( SELECT COUNT(BUS_NO) FROM STUDENT WHERE stu.BUS_NO=BUS_NO and SEX = 1 ) AS BOYS , ( SELECT COUNT(BUS_NO) FROM STUDENT WHERE stu.BUS_NO=BUS_NO and SEX = 2 ) AS GIRLS FROM STUDENT stu WHERE BUS_NO!='' and Student_Status='ACTIVE' group by BUS_NO")->result();
		$array = array(

			'data' => $data,

		);

		if (!empty($data)) {
			$this->load->view('bus_report/busno_summary_details', $array);
		} else {
			echo "<center><h1>Sorry No Student</h1></center>";
		}
	}

	public function stoppage_summary_pdf()
	{

		$school_setting = $this->dbcon->select('school_setting', '*');
		$data = $this->db->query("SELECT distinct STOPNO,(select STOPPAGE from stoppage where stu.STOPNO=STOPNO) stopname,(SELECT AMT from stop_amt where stu.STOPNO=STOP_NO) stp_amt,(SELECT COUNT(*) FROM student WHERE student.STOPNO=stu.STOPNO AND student.STOPNO>1 AND Student_Status='ACTIVE')TOTALSTUDENT,(SELECT COUNT(*) FROM student WHERE student.STOPNO=stu.STOPNO AND student.sex=1 AND student.STOPNO>1 AND Student_Status='ACTIVE')MALE,(SELECT COUNT(*) FROM student WHERE student.STOPNO=stu.STOPNO AND student.sex=2 AND student.STOPNO>1 AND Student_Status='ACTIVE')FEMALE FROM `student` stu where stu.Student_status='ACTIVE' AND stu.STOPNO>1")->result();

		$array = array(
			'school_setting' => $school_setting,
			'data' => $data,

		);

		$this->load->view('bus_report/stoppage_summary_pdf', $array);

		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'landscape');
		$this->dompdf->render();
		$this->dompdf->stream("Stoppage_Summary.pdf", array("Attachment" => 0));
	}
	
	public function busno_summary_pdf()
	{

		$school_setting = $this->dbcon->select('school_setting', '*');
		$data = $this->db->query("SELECT BUS_NO, ( SELECT COUNT(BUS_NO) FROM STUDENT WHERE stu.BUS_NO=BUS_NO ) AS TOTAL, ( SELECT COUNT(BUS_NO) FROM STUDENT WHERE stu.BUS_NO=BUS_NO and SEX = 1 ) AS BOYS , ( SELECT COUNT(BUS_NO) FROM STUDENT WHERE stu.BUS_NO=BUS_NO and SEX = 2 ) AS GIRLS FROM STUDENT stu WHERE BUS_NO!='' and Student_Status='ACTIVE' group by BUS_NO")->result();

		$array = array(
			'school_setting' => $school_setting,
			'data' => $data,

		);

		$this->load->view('bus_report/busno_summary_pdf', $array);

		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'potrait');
		$this->dompdf->render();
		$this->dompdf->stream("Bus_no_Summary.pdf", array("Attachment" => 0));
	}
	
	public function download_busnoreport()
	{
	
		$buscode = $this->input->post('stoppage');
		$data['school_setting'] = $this->dbcon->select('school_setting', '*');
		if($buscode == 'All'){
			$stopno = $this->db->query("SELECT stopno,(select stoppage from stoppage where bus_route_master.stopno = stopno) as stop_nm FROM bus_route_master")->result();
		}else{
			$stopno = $this->db->query("SELECT stopno,(select stoppage from stoppage where bus_route_master.stopno = stopno) as stop_nm FROM bus_route_master where buscode = $buscode")->result();

		}
		
		foreach ($stopno as $stop_details) {
			$data['stu_details'][$stop_details->stop_nm] = $this->db->query("SELECT DISP_CLASS,DISP_SEC, ADM_NO,FIRST_NM,ROLL_NO,P_MOBILE,eward.HOUSENAME FROM STUDENT INNER JOIN eward ON eward.HOUSENO= student.EMP_WARD  WHERE STOPNO = $stop_details->stopno")->result();
		}
		//echo '<pre>';
		//print_r($data);die;
		$data['bus_no'] = $buscode;

		
		$this->load->view('bus_report/bus_no_report_pdf', $data);

		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'landscape');
		$this->dompdf->render();
		$this->dompdf->stream("Bus_No.pdf", array("Attachment" => 0));
	}

}
