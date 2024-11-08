<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hall_ticket extends MY_controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Mymodel','dbcon');
		$this->load->model('Alam','alam');
	}
    public function index(){
        $class              = login_details['Class_No'];
		$sec                = login_details['Section_No'];
		$user_id            = login_details['user_id'];
		
		//$class_data = $this->alam->selectA('class_section_wise_subject_allocation','distinct(Class_no),(select CLASS_NM from classes where Class_No=class_section_wise_subject_allocation.Class_No)classnm',"Main_Teacher_Code='$user_id'");
		$class_data = $this->alam->selectA('class_section_wise_subject_allocation ','distinct(Class_no),(select CLASS_NM from classes where Class_No=class_section_wise_subject_allocation.Class_No)classnm');
		$array = array('class_data'=>$class_data);

        $this->teacher_template('exam/hall_ticket',$array);
	}
    public function classess(){
		$user_id  = login_details['user_id'];
		$ret = '';	
		$Class_No = '';
		$ExamMode = '';
		$class = $this->input->post('val');
		
		$class_data = $this->dbcon->select('classes','Class_No,ExamMode',"Class_No='$class'");
		
		$Class_No = $class_data[0]->Class_No;
		$ExamMode = $class_data[0]->ExamMode;
		
		//$sec_data = $this->alam->selectA('class_section_wise_subject_allocation','distinct(section_no),(select SECTION_NAME from sections where section_no=class_section_wise_subject_allocation.section_no)secnm',"Main_Teacher_Code='$user_id' AND Class_No = '$class'");
		$sec_data = $this->alam->selectA('class_section_wise_subject_allocation','distinct(section_no),(select SECTION_NAME from sections where section_no=class_section_wise_subject_allocation.section_no)secnm',"Class_No = '$class'","order by section_no asc");
		
		$ret .="<option value=''>Select</option>";
		if(isset($sec_data)){
			foreach($sec_data as $data){
				 $ret .="<option value=". $data['section_no'] .">" . $data['secnm'] ."</option>";
			}
		}
		
		$array = array($ret,$Class_No,$ExamMode);
		echo json_encode($array);
	}
	
	public function section(){
		$val      = $this->input->post('val');
		$Class_No = $this->input->post('Class_No');
		
		$exm_typ_data = $this->dbcon->select('exammaster','*');
		?>
		  <option value=''>Select</option>
		<?php
		if(isset($exm_typ_data)){
			foreach($exm_typ_data as $data){
				?>
				  <option value="<?php echo $data->ExamCode; ?>"><?php echo $data->ExamName; ?></option>
				<?php
			}
		}
	}
    public function print(){
        // echo "hello";die;

		$ret = '';
		$MaxMarks = '';
		$opt_code = $this->input->post('opt_code');
		$Class_No = $this->input->post('Class_No');
		$sec      = $this->input->post('sec');
		$sortval  = $this->input->post('sortby');
		$exm_code = $this->input->post('exm_code');
		$ExamMode = $this->input->post('ExamMode');
		$subcode  = $this->input->post('subcode');
        $examname = $this->input->post('exm_typ');
		
		
		if($sortval == 'adm_no'){
			$sorting = 'ADM_NO';
		}elseif($sortval == 'stu_name'){
			$sorting = 'FIRST_NM';
		}else{
			$sorting = 'ROLL_NO';
		}

        ini_set('memory_limit', '-1');
		$data['school_setting'] = $this->sumit->fetchSingleData('*','school_setting',array('S_No'=>1));

		$current_session =$this->sumit->fetchSingleData('Session_Nm','session_master',array('Active_Status'=>1));
		$data['current_session'] = $current_session;
	    
        $data['result']=$this->db->query("select Adm_no,first_nm,disp_class,disp_sec,roll_no from student where class=$Class_No and sec=$sec and student_status='ACTIVE' order by $sorting")->result();

        // $exam_name=$this->dbcon->select("exammaster","ExamName","ExamCode=$ExamMode");

        $data['exam_name']=$examname;
        
    //    echo $this->db->last_query();die;

        $this->load->view("exam/hall_ticketpdf",$data);

        $html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'portrait');
		$this->dompdf->render();
		$this->dompdf->set_option("isPhpEnabled", true);
		$this->dompdf->stream("HallTicket.pdf", array("Attachment"=>0));

	}
}