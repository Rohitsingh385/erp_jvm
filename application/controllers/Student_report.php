<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_report extends MY_Controller{
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	    $this->load->model('Mymodel','dbcon');
	}
	public function show_studentpanel(){
		$this->fee_template('student_report/show_report');
	}
	public function studentinformation(){
		$class = $this->dbcon->select('classes','*');
		$sec = $this->dbcon->select('sections','*');
		$array = array(
			'class' => $class,
			'sec' => $sec
		);
		$this->fee_template('student_report/studentinformation',$array);
	}
	
	public function exam_tabulation_new(){
		$exam['exam'] = $this->dbcon->select('exammaster','*');
		$this->render_template('student_report/exam_tab_new',$exam);
	}





public function exam_tabulation_data_new(){
		$session		= $this->input->post('session');
		$data['session']    = $session;
	
		$class		    = $this->input->post('class');
		$data['cls']    = $class;
	
		$sec		    = $this->input->post('sec');
		$data['sec']    = $sec;
	
		$exm_type		= $this->input->post('exm_type');
		$data['exm_type']    = $exm_type;
	
		$data['details'] = $this->dbcon->select('exammaster',"ExamName,(select CLASS_NM from classes where Class_No='$class')CLASS_NM,(select SECTION_NAME from sections where section_no='$sec')SECTION_NAME","ExamCode='$exm_type'");
		
		
		$data['school_setting'] = $this->dbcon->select('school_setting','*');
		if($session=='2020-2021'){
		    $st_tbl='student_2021';
			$mks='marks';
			$class_section='class_section_wise_subject_allocation';
			$max='maxmarks';
		}else{
		    $st_tbl='student';
			$mks='marks';
			$class_section='class_section_wise_subject_allocation';
			$max='maxmarks';
		}
		
		$stu_data = $this->dbcon->select($st_tbl,'ROLL_NO,FIRST_NM,MIDDLE_NM,TITLE_NM,ADM_NO',"CLASS='$class' and SEC='$sec' and Student_status='ACTIVE' order by ROLL_NO asc");
		
			if ($class == 13) {
			$subject = $this->db->query("SELECT DISTINCT(new_studentsubject_xi.SUBCODE)subject_code,subjects.SubName as subj_nm FROM `new_studentsubject_xi`
			JOIN subjects ON subjects.SubCode=new_studentsubject_xi.SUBCODE
			WHERE Class=$class AND SEC=$sec")->result();
			$data['subjects'] = $subject;
		} else {
			$subject = $this->dbcon->select($class_section, 'subject_code,subj_nm,opt_code', "Class_No='$class' and section_no='$sec' and applicable_exam ='1' order by sorting_no");
			$data['subjects'] = $subject;
		}
		
		foreach($stu_data as $keyy){
			$admno=$keyy->ADM_NO;
			$name=$keyy->FIRST_NM;
			
			foreach($subject as $skey){
				
				$subject_code=$skey->subject_code;
				$opt_code=$skey->opt_code;
				
				$marks = $this->dbcon->select($mks,'sum(M3) as mm',"SCode='$subject_code' and ExamC='$exm_type' and admno='$admno'");
				
				$mm = $this->dbcon->select($max,'MaxMarks',"ClassCode='$class' AND ExamCode='$exm_type' AND teacher_code='$subject_code' AND TERM='TERM-1'");
				
				if($class == 14){
					//@$hundred = round(($marks[0]->mm/$mm[0]->MaxMarks)*100);
					@$hundred = round(($marks[0]->mm));	
				}else{
					@$hundred = round(($marks[0]->mm));	
				}
				
				$det[$subject_code] = array('subject_nm'=>$skey->subj_nm,'subject_marks'=>$marks[0]->mm,'hundred'=>$hundred,'opt_code'=>$opt_code);	
			}
			
			$data['stu_data'][$admno] = array('adm_no'=>$admno,'roll_no'=>$keyy->ROLL_NO,'name'=>$name,'subjects'=>$det);
	    }
		
		$this->load->view('student_report/exam_tab_data',$data);
	}
	
	public function exam_tabulation_data_new_pdf()
	{
		$session		= $this->input->post('session');

		$class		    = $this->input->post('cls');
		$data['cls']    = $class;

		$sec		    = $this->input->post('sec');
		$data['sec']    = $sec;

		$exm_type		= $this->input->post('exm_type');
		$data['exm_type'] = $exm_type;

		$data['details'] = $this->dbcon->select('exammaster', "ExamName,(select CLASS_NM from classes where Class_No='$class')CLASS_NM,(select SECTION_NAME from sections where section_no='$sec')SECTION_NAME", "ExamCode='$exm_type'");


		$data['school_setting'] = $this->dbcon->select('school_setting', '*');
		if ($session == '2020-2021') {
			$st_tbl = 'student_2021';
			$mks = 'marks';
			$class_section = 'class_section_wise_subject_allocation';
			$max = 'maxmarks';
		} else {
			$st_tbl = 'student';
			$mks = 'marks';
			$class_section = 'class_section_wise_subject_allocation';
			$max = 'maxmarks';
		}

		$stu_data = $this->dbcon->select($st_tbl, 'ROLL_NO,FIRST_NM,MIDDLE_NM,TITLE_NM,ADM_NO', "CLASS='$class' and SEC='$sec' and Student_status='ACTIVE' order by ROLL_NO asc");

			if ($class == 13) {
			$subject = $this->db->query("SELECT DISTINCT(new_studentsubject_xi.SUBCODE)subject_code,subjects.SubName as subj_nm FROM `new_studentsubject_xi`
			JOIN subjects ON subjects.SubCode=new_studentsubject_xi.SUBCODE
			WHERE Class=$class AND SEC=$sec")->result();
			$data['subjects'] = $subject;
		} else {
			$subject = $this->dbcon->select($class_section, 'subject_code,subj_nm,opt_code', "Class_No='$class' and section_no='$sec' and applicable_exam ='1' order by sorting_no");
			$data['subjects'] = $subject;
		}

		foreach ($stu_data as $keyy) {
			$admno = $keyy->ADM_NO;
			$name = $keyy->FIRST_NM;

			foreach ($subject as $skey) {

				$subject_code = $skey->subject_code;
				$opt_code = $skey->opt_code;

				$marks = $this->dbcon->select($mks, 'sum(M3) as mm', "SCode='$subject_code' and ExamC='$exm_type' and admno='$admno'");

				$mm = $this->dbcon->select($max, 'MaxMarks', "ClassCode='$class' AND ExamCode='$exm_type' AND teacher_code='$subject_code' AND TERM='TERM-1'");

				if ($class == 14) {
					//@$hundred = round(($marks[0]->mm/$mm[0]->MaxMarks)*100);
					@$hundred = round(($marks[0]->mm));
				} else {
					@$hundred = round(($marks[0]->mm));
				}

				$det[$subject_code] = array('subject_nm' => $skey->subj_nm, 'subject_marks' => $marks[0]->mm, 'hundred' => $hundred, 'opt_code' => $opt_code);
			}

			$data['stu_data'][$admno] = array('adm_no' => $admno, 'roll_no' => $keyy->ROLL_NO, 'name' => $name, 'subjects' => $det);
		}

		$this->load->view('student_report/exam_tab_data_pdf', $data);
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A3', 'landscape');
		$this->dompdf->render();
		$this->dompdf->stream("examwisetabulation.pdf", array("Attachment" => 0));
	}
	
	public function find_sec(){
		$val = $this->input->post('val');
		$data = $this->dbcon->select_distinct('student','DISP_SEC,SEC',"CLASS='$val' AND Student_Status='ACTIVE'");
		?>
		  <option value=''>Select</option>
		<?php
		foreach($data as $dt){
			?>
			  <option value='<?php echo $dt->SEC; ?>'><?php echo $dt->DISP_SEC; ?></option>
			<?php
		}
	}
	public function find_detailsstudentinformation(){
		$class		= $this->input->post('class_name');
		$sec 		= $this->input->post('sec_name');
		$short_by 	= $this->input->post('short_by');
		$data['data'] = $this->dbcon->student_information($class,$sec,$short_by);
		$data['class'] = $class;
		$data['sec'] = $sec;
		$data['short_by'] = $sec;
		if(!empty($data['data'])){
			$this->load->view('student_report/studentdetailsshow',$data);
		}
		else{
			echo "<center><h1>Sorry No Student</h1></center>";
		}
		
		
	}
	public function download_studentinformation(){
		$class		= $this->input->post('class');
		$sec 		= $this->input->post('sec');
		$short_by 	= $this->input->post('short_by');
		$data['school_setting'] = $this->dbcon->select('school_setting','*');
		$data['data'] = $this->dbcon->student_information($class,$sec,$short_by);
		$this->load->view('student_report/studentinformationPdf',$data);
		
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A3', 'landscape');
		$this->dompdf->render();
		$this->dompdf->stream("Student_Information.pdf", array("Attachment"=>0));
	}
}