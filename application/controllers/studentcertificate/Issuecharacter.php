	<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Issuecharacter extends MY_Controller {

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
			$this->render_template('studentcertificate/Issuecharacter_view',$data);
		}

function show_all_list($s='',$c='')
{ 
			if(!empty($s))
			{
				$data['syear']=$syear=$s;
				$data['classes']=$classes=$c;

			}
			else{
				$data['syear']=$syear=$this->input->post('syear');
				$data['classes']=$classes=$this->input->post('selclass');

			}
			
			if($syear=='2022-2023'){
				$tbl='tpstudent';
				$tbl_one='tpstudent_tc';
				$tbl_two='tpstudent_charcert';
			}
	
			if($syear=='2021-2022'){
				$tbl='student';
				$tbl_one='student_tc';
				$tbl_two='student_charcert';
			}
			if($syear=='2020-2021'){
				$tbl='tpstudent';
				$tbl_one='tpstudent_tc';
				$tbl_two='tpstudent_charcert';
			}
	
			$data1['session_year']=$syear;
			$data1['class_no']=$classes;
			$data1['table_name']=$tbl;

$chk_status=$this->certificat_model->check_charcert_status($tbl_two,$syear,$classes);

if(empty($chk_status))
{
	$tmp_chartno=$this->certificat_model->get_char_certificate_number();
			$stu_list_old=$this->certificat_model->get_student_list($tbl_one,$syear,$classes);

			if(empty($stu_list_old))
			{
				$this->session->set_flashdata('error', 'Please Issue Transfer Certificate, first, then try again.');
		        redirect('studentcertificate/Issuecharacter',refresh);
			}


			$n=count($stu_list_old);			
			$i = 0;
			while($i<$n)
			{
			$data2[$i]['CERT_NO']='JVM-'.$tmp_chartno.'/'.$syear;
			$data2[$i]['slno']=$tmp_chartno;
			$data2[$i]['ADM_NO']=$stu_list_old[$i]->adm_no;
			$data2[$i]['S_NAME']=$stu_list_old[$i]->stu_nm;
			$data2[$i]['F_NAME']=$stu_list_old[$i]->father_nm;
			$data2[$i]['M_Name']=$stu_list_old[$i]->mother_nm;
			$data2[$i]['Adm_Date']=date("Y-m-d", strtotime($stu_list_old[$i]->adm_date));
			$data2[$i]['End_DATE']=date("Y-m-d", strtotime($stu_list_old[$i]->left_school));
			$data2[$i]['class_name']=$stu_list_old[$i]->studied_class;
			$data2[$i]['Issued_Date']='';
			$data2[$i]['duplcate_Issue']='0';
			$data2[$i]['session_year']=$syear;
			$data2[$i]['stu_class']=$classes;
			$data2[$i]['created_on']= date("Y-m-d H:i:s");
			$data2[$i]['created_by']=$this->session->userdata('user_id');
			
			$tmp=explode(' ',$stu_list_old[$i]->status);
			

			if($tmp[0]=='PASSED' && $tmp[1]=='AISSE' && $tmp[2]=='CBSE')
			{
		$data2[$i]['remark1']=$tmp[0];
		$data2[$i]['remark2']='All Indian Secondary School Examination (AISSE)';
		$data2[$i]['remark3']='Central Board of Secondary Education, New Delhi';
		$data2[$i]['remark4']=$stu_list_old[$i]->pass_year;


			}
			
	else if($tmp[0]=='PASSED' && $tmp[1]=='AISSCE' && $tmp[2]=='CBSE')
		{
		$data2[$i]['remark1']=$tmp[0];
$data2[$i]['remark2']=' All India Senior School Certificate Examination (AISSCE) ';
$data2[$i]['remark3']=' Central Board of Secondary Education, New Delhi.';
$data2[$i]['remark4']=$stu_list_old[$i]->pass_year;

			}
		else{
				$data2[$i]['remark1']='';
				$data2[$i]['remark2']='';
				$data2[$i]['remark3']='';
				$data2[$i]['remark4']='';

			}

		$months_list = array (1=>'JAN',2=>'FEB',3=>'MAR',4=>'APR',5=>'MAY',6=>'JUN',7=>'JUL',8=>'AUG',9=>'SEP',10=>'OCT',11=>'NOV',12=>'DEC');

			$tmppy=explode('-',$stu_list_old[$i]->pass_year);

			
			$mm=$months_list[(int)$tmppy[0]];

			$data2[$i]['remark5']=$mm.'-'.$tmppy[1];
			
			
			
                $i++;
                $tmp_chartno++;
            }
            // echo '<pre>';
            // print_r($data2);
            // echo '</pre>';
            // die();
            	$t=$this->certificat_model->insert_batch($tbl_two,$data2);

            	$tt=$this->certificat_model->update_charcert_number($tmp_chartno);

            	$data['stu_list']=$this->certificat_model->get_student_list($tbl_two,$syear,$classes);
                                    
             $data['sess_list']=$this->certificat_model->get_session_year();
              $data['class_list']=$this->certificat_model->get_class_list();
              $data['table_name']=$tbl_two;
              $data['hclasses']=$classes;
	$data['syear']=$syear;
              $this->render_template('studentcertificate/Issuecharacter_view',$data);

}
else
{
	$data['stu_list']=$this->certificat_model->get_student_list($tbl_two,$syear,$classes);
                                    
             $data['sess_list']=$this->certificat_model->get_session_year();
              $data['class_list']=$this->certificat_model->get_class_list();
              $data['table_name']=$tbl_two;
              $data['hclasses']=$classes;
	$data['syear']=$syear;
	
              $this->render_template('studentcertificate/Issuecharacter_view',$data);

}

			
			
}		

function save_individual_student()
{

	$tbl_nm=$this->input->post('tbl_nm');
	$con['t2']['id']=$id=$this->input->post('id');
 	$con['t2']['adm_no']=$adm_no=$this->input->post('adm_no');

 	$dataS['t2']['Issued_Date']=date("Y-m-d", strtotime($this->input->post('certi_date')));


 	$p=$this->certificat_model->update_student_record($tbl_nm,$dataS, $con);

 	echo json_encode($p);

}

function generatepdf($tbl,$classes,$syear){

$doc_ids=$this->certificat_model->get_student_list_withoutsyear_new($tbl,$classes,$syear);
$row=0;
foreach($doc_ids as $p)
{
	$data['stu_list_all'][$row]['CERT_NO']=$p->CERT_NO;
	$data['stu_list_all'][$row]['slno']=$p->slno;
	$data['stu_list_all'][$row]['S_NAME']=$p->S_NAME;
	$data['stu_list_all'][$row]['F_NAME']=$p->F_NAME;
	$data['stu_list_all'][$row]['M_Name']=$p->M_Name;
	$data['stu_list_all'][$row]['Issued_Date']=$p->Issued_Date;
	$data['stu_list_all'][$row]['remark1']=$p->remark1;
	$data['stu_list_all'][$row]['remark2']=$p->remark2;
	$data['stu_list_all'][$row]['remark3']=$p->remark3;
	$data['stu_list_all'][$row]['remark5']=$p->remark5;
$row++;
}

	$this->load->view('studentcertificate/issuecharacter_view_pdf',$data);
	$html = $this->output->get_output();
	$this->load->library('pdf'); 
	 ob_start();
	$this->dompdf->loadHtml($html);
	$this->dompdf->setPaper('A4', 'portrait');
	$this->dompdf->render();
	$this->dompdf->stream("student_charcert_report.pdf", array("Attachment"=>1));


}

			function download_range()
		{
			$tbl = $this->input->post('tbl_nmr');
			$classes = $this->input->post('hclassr');
			$admn_no1 = $this->input->post('adm_no_one');
			$admn_no2 = $this->input->post('adm_no_two');
				$syear=$this->input->post('syear');

			$doc_ids = $this->certificat_model->get_student_list_inrange_new($tbl, $classes, $admn_no1, $admn_no2,$syear);

			$row = 0;
			foreach ($doc_ids as $p) {

				$data['stu_list_all'][$row]['ID'] = $p->id;
				$data['stu_list_all'][$row]['CERT_NO'] = $p->CERT_NO;
				$data['stu_list_all'][$row]['ADM_NO'] = $p->ADM_NO;
				$data['stu_list_all'][$row]['S_NAME'] = $p->S_NAME;
				$data['stu_list_all'][$row]['M_Name'] = $p->M_Name;
				$data['stu_list_all'][$row]['F_NAME'] = $p->F_NAME;
				$data['stu_list_all'][$row]['adm_date'] = $p->Adm_Date;
				$data['stu_list_all'][$row]['class_admitted'] = $p->class_admitted;
				$data['stu_list_all'][$row]['BIRTH_DT'] = $p->BIRTH_DT;
				$data['stu_list_all'][$row]['left_school'] = $p->End_DATE;
				$data['stu_list_all'][$row]['studied_class'] = $p->class_name;
				$data['stu_list_all'][$row]['acad_year'] = $p->session_year;
				$data['stu_list_all'][$row]['pass_year'] = $p->pass_year;
				$data['stu_list_all'][$row]['status'] = $p->status;
				$data['stu_list_all'][$row]['Issued_Date'] = $p->Issued_Date;
				$data['stu_list_all'][$row]['nationality'] = $p->nationality;
				$data['stu_list_all'][$row]['remark5'] = $p->remark5;
				$data['stu_list_all'][$row]['remark1'] = $p->remark1;
				$data['stu_list_all'][$row]['remark2'] = $p->remark2;
				$data['stu_list_all'][$row]['remark3'] = $p->remark3;
				$data['stu_list_all'][$row]['tcno'] = $p->tcno;

				$row++;
			}

			$this->load->view('studentcertificate/issuecharacter_view_pdf', $data);


			// $this->load->view('studentcertificate/issuetc_view_pdf', $data);
			$html = $this->output->get_output();
			$this->load->library('pdf');
			ob_start();
			$this->dompdf->loadHtml($html);
			$this->dompdf->setPaper('A4', 'portrait');
			$this->dompdf->render();
			$this->dompdf->stream("student_tc_report.pdf", array("Attachment" => 0));
		}
function update_issuedate(){
	$issuedate=$this->input->post('issuedate');
	$hclassr=$this->input->post('cls');
	$syear=$this->input->post('year');

	$certissuedate=date("Y-m-d", strtotime($issuedate));

	$sql=$this->db->query("UPDATE tpstudent_charcert SET issued_date = '$certissuedate' where stu_class=$hclassr and session_year='$syear'");
	// $sql = $this->db->update('student_tc','left_school='.$lstdate.'','stu_class='.$hclassr.' and session_year='.$syear.'');
	
}



// 		function show_all_list_pdf(){

// 			$data['syear']=$syear=$this->input->post('syear');
// 			$data['classes']=$classes=$this->input->post('selclass');

// 			if($syear=='2021-2022'){
// 				$tbl='student';
// 				$tbl_one='student_tc';
// 			}
// 			if($syear=='2020-2021'){
// 				$tbl='tpstudent';
// 				$tbl_one='tpstudent_tc';
// 			}
// 			$data1['session_year']=$syear;
// 			$data1['class_no']=$classes;
// 			$data1['table_name']=$tbl;

// $doc_ids=$this->certificat_model->get_student_list_withoutsyear($tbl_one,$classes);
// $row=0;
// foreach($doc_ids as $p)
// {
// 	$data['stu_list_all'][$row]['adm_no']=$p->adm_no;
// 	$data['stu_list_all'][$row]['stu_nm']=$p->stu_nm;
// 	$data['stu_list_all'][$row]['mother_nm']=$p->mother_nm;
// 	$data['stu_list_all'][$row]['father_nm']=$p->father_nm;
// 	$data['stu_list_all'][$row]['adm_date']=$p->adm_date;
// 	$data['stu_list_all'][$row]['class_admitted']=$p->class_admitted;
// 	$data['stu_list_all'][$row]['BIRTH_DT']=$p->BIRTH_DT;
// 	$data['stu_list_all'][$row]['left_school']=$p->left_school;
// 	$data['stu_list_all'][$row]['studied_class']=$p->studied_class;
// 	$data['stu_list_all'][$row]['acad_year']=$p->acad_year;
// 	$data['stu_list_all'][$row]['pass_year']=$p->pass_year;
// 	$data['stu_list_all'][$row]['status']=$p->status;
// 	$data['stu_list_all'][$row]['cer_issue_date']=$p->cer_issue_date;
// 	$data['stu_list_all'][$row]['nationality']=$p->nationality;
// 	$data['stu_list_all'][$row]['remarks1']=$p->remarks1;
// 	$data['stu_list_all'][$row]['tcno']=$p->tcno;

// $row++; 
// }

// 	$this->load->view('studentcertificate/issuecharacter_view_pdf',$data);
// 	$html = $this->output->get_output();
// 	$this->load->library('pdf'); 
// 	 ob_start();
// 	$this->dompdf->loadHtml($html);
// 	$this->dompdf->setPaper('A4', 'portrait');
// 	$this->dompdf->render();
// 	$this->dompdf->stream("student_cc_report.pdf", array("Attachment"=>1));


// 		}


}

