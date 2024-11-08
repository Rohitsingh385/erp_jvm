	<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Issuetc extends MY_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->loggedOut();
			$this->load->model('studentcertificate/certificat_model');
		}
		public function index()  
		{
			$data['sess_list']=$this->certificat_model->get_session_year();
			$data['class_list']=$this->certificat_model->get_class_list();
			$this->render_template('studentcertificate/Issuetc_view',$data);
		}
			
		
		
		function show_all_list($s = '', $c = '')
	{
		if (!empty($s)) {
			$data['syear'] = $syear = $s;
			$data['classes'] = $classes = $c;
		} else {
			$data['syear'] = $syear = $this->input->post('syear');
			$data['classes'] = $classes = $this->input->post('selclass');
		}

		if ($syear == '2023-2024') {
			$tbl = 'student';
			$tbl_one = 'student_tc';
		}
		if ($syear == '2022-2023') {
			$tbl = 'tpstudent';
			$tbl_one = 'tpstudent_tc';
		}
		if ($syear == '2021-2022') {
			$tbl = 'student';
			$tbl_one = 'student_tc';
		}
		if ($syear == '2020-2021') {
			$tbl = 'tpstudent';
			$tbl_one = 'tpstudent_tc';
		}
		$data1['session_year'] = $syear;
		$data1['class_no'] = $classes;
		$data1['table_name'] = $tbl;

		//=======================================================================
		$tmp_tcno = $this->certificat_model->get_tc_number();
		$tc_details = $this->certificat_model->get_tc_details();
				
		// echo $this->db->last_query();die();	


		$chk_status = $this->certificat_model->check_bridge_status($syear, $classes);
		if (empty($chk_status)) {
			$lid = $this->certificat_model->insert($data1);
			if ($tbl == 'student') {
				$stu_list_old = $this->certificat_model->get_student_list_old($tbl, $classes);
			}
			if ($tbl == 'tpstudent') {
				$stu_list_old = $this->certificat_model->get_student_list_old($tbl, $classes);
			}
			
			if ($classes==14){
			$status="PASSED AISSCE CBSE";	
			}else
			{$status="PASSED AISSE CBSE";
			}
			
			
			$n = count($stu_list_old);
			$i = 0;
			while ($i < $n) {

				$old_tcno = $tmp_tcno;
				$len = strlen($old_tcno);
				if ($len == 1) {
					$tcno = "000" . $old_tcno;
				} else if ($len == 2) {
					$tcno = "00" . $old_tcno;
				} else if ($len == 3) {
					$tcno = "0" . $old_tcno;
				} else {
					$tcno = $old_tcno;
				}

				$new_tcno = $tc_details[0]->tchead . $tcno . "/" . $tc_details[0]->current_year;

				$data2[$i]['adm_no'] = $stu_list_old[$i]->reg_no;
				$data2[$i]['stu_nm'] = $stu_list_old[$i]->stu_name;
				$data2[$i]['mother_nm'] = $stu_list_old[$i]->mname;
				$data2[$i]['father_nm'] = $stu_list_old[$i]->fname;
				$data2[$i]['adm_date'] = $stu_list_old[$i]->ADM_DATE;
				$data2[$i]['class_admitted'] = $stu_list_old[$i]->admit_class;
				$data2[$i]['BIRTH_DT'] = $stu_list_old[$i]->BIRTH_DT;
				$data2[$i]['left_school'] = $stu_list_old[$i]->left_school;
				$data2[$i]['studied_class'] = $stu_list_old[$i]->studying_class;
				$data2[$i]['acad_year'] = $syear;
				$data2[$i]['pass_year'] = $stu_list_old[$i]->pass_year;
				$data2[$i]['status'] = $status;
				$data2[$i]['cer_issue_date'] = $stu_list_old[$i]->certificate_date;
				$data2[$i]['nationality'] = $stu_list_old[$i]->nationality;
				$data2[$i]['create_on'] = date("Y-m-d H:i:s");
				$data2[$i]['user_id'] = $this->session->userdata('user_id');
				$data2[$i]['session_year'] = $syear;
				$data2[$i]['stu_class'] = $classes;
				$data2[$i]['remarks1'] = $stu_list_old[$i]->remarks1;
				$data2[$i]['remarks2'] = $stu_list_old[$i]->remarks2;
				$data2[$i]['tcno'] = $new_tcno;


				$i++;
				$tmp_tcno++;
			}

			$t = $this->certificat_model->insert_batch($tbl_one, $data2);
			$tt = $this->certificat_model->update_tc_number($tmp_tcno);


			$data['stu_list'] = $this->certificat_model->get_student_list($tbl_one, $syear, $classes);



			$data['sess_list'] = $this->certificat_model->get_session_year();
			$data['class_list'] = $this->certificat_model->get_class_list();
			$data['table_name'] = $tbl_one;
			$data['hclasses'] = $classes;
			$data['syear'] = $syear;
			$this->render_template('studentcertificate/Issuetc_view', $data);
		}
		//================================================================		 

		else {
			$data['stu_list'] = $this->certificat_model->get_student_list($tbl_one, $syear, $classes);
			$data['sess_list'] = $this->certificat_model->get_session_year();
			$data['class_list'] = $this->certificat_model->get_class_list();
			$data['table_name'] = $tbl_one;
			$data['hclasses'] = $classes;
			$this->render_template('studentcertificate/Issuetc_view', $data);
		}
	}


                            function show_individual($reg_no,$sess_year,$classes){
                            	$adm_no= base64_decode(urldecode($reg_no));
                            	$data['syear']=$syear=$sess_year;
                            	$data['classes']=$classes;
                            	if($syear=='2021-2022'){
                            		$tbl='student';
                            	}
                            	if($syear=='2020-2021'){
                            		$tbl='tpstudent';
                            	}
                            	$data['stu_list']=$this->certificat_model->get_student_individual($tbl,$adm_no);

                            	$data['class_list']=$this->certificat_model->get_class_list();
                            	$data['sess_list']=$this->certificat_model->get_session_year();
                            	$this->render_template('studentcertificate/Issuetc_view_individual',$data);

                            }

 public function save_individual_student()
 {

$months_list = array (1=>'January',2=>'February',3=>'March',4=>'April',5=>'May',6=>'June',7=>'July',8=>'August',9=>'September',10=>'October',11=>'November',12=>'December');
	$tbl_nm=$this->input->post('tbl_nm');

 	$con['t2']['id']=$id=$this->input->post('id');
 	$con['t2']['adm_no']=$adm_no=$this->input->post('adm_no');
 	
 	$dataS['t2']['stu_nm']=$stu_nm=$this->input->post('sname');
 	$dataS['t2']['mother_nm']=$mother_nm=$this->input->post('mname');
 	$dataS['t2']['father_nm']=$father_nm=$this->input->post('fname');
 	$dataS['t2']['adm_date']=$adm_date=date("Y-m-d", strtotime($this->input->post('doa')));
 	$dataS['t2']['class_admitted']=$class_admitted=$this->input->post('admit_class');
 	$dataS['t2']['BIRTH_DT']=$BIRTH_DT=date("Y-m-d", strtotime($this->input->post('dob')));
 	$dataS['t2']['left_school']=$left_school=date("Y-m-d", strtotime($this->input->post('lschool')));
 	$dataS['t2']['studied_class']=$studied_class=$this->input->post('sclass');
 	$dataS['t2']['acad_year']=$acad_year=$this->input->post('acad_year');
 	$dataS['t2']['pass_year']=$pass_year=$this->input->post('pass_year');
 	$dataS['t2']['status']=$status=$this->input->post('syear');
 	$dataS['t2']['cer_issue_date']=$cer_issue_date=date("Y-m-d", strtotime($this->input->post('certi_date')));
 	$dataS['t2']['nationality']=$nationality=$this->input->post('nationality');
 	$dob_tmp=explode('-',$BIRTH_DT);
 	
 	$day=$this->certificat_model->number_to_string($dob_tmp[2]);
 	//$month=$this->certificat_model->number_to_string($dob_tmp[1]);
 	$month=$months_list[(int)$dob_tmp[1]];
 	$year=$this->certificat_model->number_to_string($dob_tmp[0]);
 	$dataS['t2']['remarks1']=$day.'of '.$month.' '.$year;

// echo '<pre>';
//  	print_r($dataS);
//  	echo '</pre>';
 	$p=$this->certificat_model->update_student_record($tbl_nm,$dataS, $con);

 	echo json_encode($p);


}
		
function generatepdf($tbl,$classes){

$doc_ids=$this->certificat_model->get_student_list_withoutsyear($tbl,$classes);
$row=0;
foreach($doc_ids as $p)
{
	$data['stu_list_all'][$row]['adm_no']=$p->adm_no;
	$data['stu_list_all'][$row]['stu_nm']=$p->stu_nm;
	$data['stu_list_all'][$row]['mother_nm']=$p->mother_nm;
	$data['stu_list_all'][$row]['father_nm']=$p->father_nm;
	$data['stu_list_all'][$row]['adm_date']=$p->adm_date;
	$data['stu_list_all'][$row]['class_admitted']=$p->class_admitted;
	$data['stu_list_all'][$row]['BIRTH_DT']=$p->BIRTH_DT;
	$data['stu_list_all'][$row]['left_school']=$p->left_school;
	$data['stu_list_all'][$row]['studied_class']=$p->studied_class;
	$data['stu_list_all'][$row]['acad_year']=$p->acad_year;
	$data['stu_list_all'][$row]['pass_year']=$p->pass_year;
	$data['stu_list_all'][$row]['status']=$p->status;
	$data['stu_list_all'][$row]['cer_issue_date']=$p->cer_issue_date;
	$data['stu_list_all'][$row]['nationality']=$p->nationality;
	$data['stu_list_all'][$row]['remarks1']=$p->remarks1;
	$data['stu_list_all'][$row]['tcno']=$p->tcno;

$row++;
}

	$this->load->view('studentcertificate/issuetc_view_pdf',$data);
	$html = $this->output->get_output();
	$this->load->library('pdf'); 
	 ob_start();
	$this->dompdf->loadHtml($html);
	$this->dompdf->setPaper('A4', 'portrait');
	$this->dompdf->render();
	$this->dompdf->stream("student_tc_report.pdf", array("Attachment"=>1));


}
		
	function update_lastschooldate(){
	$lstdate=$this->input->post('ldate');
	$hclassr=$this->input->post('cls');
	$syear=$this->input->post('year');
			
		
		if ($syear == '2023-2024') {
			$tbl_one = 'student_tc';
		}
		if ($syear == '2022-2023') {
			$tbl_one = 'tpstudent_tc';
		}
		if ($syear == '2021-2022') {
			$tbl_one = 'student_tc';
		}
		if ($syear == '2020-2021') {
			$tbl_one = 'tpstudent_tc';
		}
	
	$lstschdate=date("Y-m-d", strtotime($lstdate));
	$sql=$this->db->query("UPDATE $tbl_one SET left_school = '$lstschdate' where stu_class=$hclassr and session_year='$syear'");
	// $sql = $this->db->update('student_tc','left_school='.$lstdate.'','stu_class='.$hclassr.' and session_year='.$syear.'');
	
}
function update_passedyear(){
	$passyear=$this->input->post('passyear');
	$hclassr=$this->input->post('cls');
	$syear=$this->input->post('year');
	$len=strlen($passyear);
	$passingyear=substr($passyear,3,$len-1);
	
	if ($syear == '2023-2024') {
			$tbl_one = 'student_tc';
		}
		if ($syear == '2022-2023') {
			$tbl_one = 'tpstudent_tc';
		}
		if ($syear == '2021-2022') {
			$tbl_one = 'student_tc';
		}
		if ($syear == '2020-2021') {
			$tbl_one = 'tpstudent_tc';
		}

	$sql=$this->db->query("UPDATE $tbl_one SET pass_year = '$passingyear' where stu_class=$hclassr and session_year='$syear'");
	// $sql = $this->db->update('student_tc','left_school='.$lstdate.'','stu_class='.$hclassr.' and session_year='.$syear.'');

	
}
function update_issuedate(){
	$issuedate=$this->input->post('issuedate');
	$hclassr=$this->input->post('cls');
	$syear=$this->input->post('year');
	
	if ($syear == '2023-2024') {
			$tbl_one = 'student_tc';
		}
		if ($syear == '2022-2023') {
			$tbl_one = 'tpstudent_tc';
		}
		if ($syear == '2021-2022') {
			$tbl_one = 'student_tc';
		}
		if ($syear == '2020-2021') {
			$tbl_one = 'tpstudent_tc';
		}

	$certissuedate=date("Y-m-d", strtotime($issuedate));

	$sql=$this->db->query("UPDATE $tbl_one SET cer_issue_date = '$certissuedate' where stu_class=$hclassr and session_year='$syear'");
	// $sql = $this->db->update('student_tc','left_school='.$lstdate.'','stu_class='.$hclassr.' and session_year='.$syear.'');
	echo $this->db->last_query();die;
}
	
		
		
		

		function download_range()
		{
			$tbl=$this->input->post('tbl_nmr');
			$classes=$this->input->post('hclassr');
			$admn_no1=$this->input->post('adm_no_one');
			$admn_no2=$this->input->post('adm_no_two');
			$syear=$this->input->post('syear');


$doc_ids=$this->certificat_model->get_student_list_inrange_new($tbl,$classes,$admn_no1,$admn_no2,$syear);

$row=0;
foreach($doc_ids as $p)
{
	$data['stu_list_all'][$row]['adm_no']=$p->adm_no;
	$data['stu_list_all'][$row]['stu_nm']=$p->stu_nm;
	$data['stu_list_all'][$row]['mother_nm']=$p->mother_nm;
	$data['stu_list_all'][$row]['father_nm']=$p->father_nm;
	$data['stu_list_all'][$row]['adm_date']=$p->adm_date;
	$data['stu_list_all'][$row]['class_admitted']=$p->class_admitted;
	$data['stu_list_all'][$row]['BIRTH_DT']=$p->BIRTH_DT;
	$data['stu_list_all'][$row]['left_school']=$p->left_school;
	$data['stu_list_all'][$row]['studied_class']=$p->studied_class;
	$data['stu_list_all'][$row]['acad_year']=$p->acad_year;
	$data['stu_list_all'][$row]['pass_year']=$p->pass_year;
	$data['stu_list_all'][$row]['status']=$p->status;
	$data['stu_list_all'][$row]['cer_issue_date']=$p->cer_issue_date;
	$data['stu_list_all'][$row]['nationality']=$p->nationality;
	$data['stu_list_all'][$row]['remarks1']=$p->remarks1;
	$data['stu_list_all'][$row]['tcno']=$p->tcno;

$row++;
}

	$this->load->view('studentcertificate/issuetc_view_pdf',$data);
	$html = $this->output->get_output();
	$this->load->library('pdf'); 
	 ob_start();
	$this->dompdf->loadHtml($html);
	$this->dompdf->setPaper('A4', 'portrait');
	$this->dompdf->render();
	$this->dompdf->stream("student_tc_report.pdf", array("Attachment"=>0));



		}

}

