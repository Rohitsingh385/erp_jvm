<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Topper_10 extends MY_controller
{

    public function __construct()
    {
        parent::__construct();
        $this->loggedOut();
        $this->load->model('Alam', 'alam');
        $this->load->model('Result_common', 'rc');
        $this->load->model('Mymodel', 'dbcon');
    }

    public function index()
    {
        $class = $this->dbcon->select('classes', '*');
        $sec = $this->dbcon->select('sections', '*');
       // $exammaster = $this->dbcon->select('exammaster', '*', 'ExamCode IN(1,2,3,4,14)');
        $array = array(
            'class' => $class,
            'sec' => $sec
        );
        $this->render_template('report_card/topper_report/class_sec', $array);
    }

    public function getSub()
    {
        $class = $this->input->post('val');
        $getSub = $this->alam->selectA('class_section_wise_subject_allocation', "DISTINCT(subject_code),Subject_Name_Dispaly", "Class_No='$class'");
        //  echo $this->db->last_query();die;
        ?>
        <option value="">Select</option>
        <?php
        foreach ($getSub as $key => $val) {
        ?>
            <option value="<?php echo $val['subject_code']; ?>"><?php echo $val['Subject_Name_Dispaly']; ?></option>
        <?php
        }
    }

	 public function Select_Exam()
    {
		$user_id=login_details['user_id'];
        $class = $this->input->post('cls');
        if($class == 130){
			if($user_id == 'EMP0140'){
			 $exammaster = $this->dbcon->select('exammaster', '*', 'ExamCode IN(15,18)');
			}
        }else{
            $exammaster = $this->dbcon->select('exammaster', '*', 'ExamCode IN(1,2,3,4,14)');
        }
        //  echo $this->db->last_query();die;
        ?>
        <option value="">Select</option>
        <?php
        foreach ($exammaster as $key => $val) {
        ?>
            <option value="<?php echo $val->ExamCode; ?>"><?php echo $val->ExamName; ?></option>
        <?php
        }
		
    }
	
    public function find_details()
    {
        $class_name = $this->input->post('class_name');
        $subj_name = $this->input->post('sub');
        $exam_type = $this->input->post('exam_type');
        $term = $this->input->post('term');
        $topper_data = $this->dbcon->topper_10($exam_type,$subj_name,$class_name,$term);
       
        $data['topper_data'] = $topper_data;
		$examname = $this->dbcon->select('exammaster','examname'," examcode=$exam_type");
		$subjectname = $this->dbcon->select('subjects','subname',"subcode=$subj_name");
		$data['subjectname'] =$subjectname[0]->subname;
		$data['examname'] =$examname[0]->examname;

        if (!empty($data['topper_data'])) {
            $this->load->view('report_card/topper_report/find_details', $data);
        } else {
            echo "<center><h1>Sorry No Data Found</h1></center>";
        }
    }
	 public function index1()
    {
        $class = $this->dbcon->select('classes', '*');
        $sec = $this->dbcon->select('sections', '*');
       // $exammaster = $this->dbcon->select('exammaster', '*', 'ExamCode IN(1,2,3,4,14)');
        $array = array(
            'class' => $class,
            'sec' => $sec
        );
        $this->render_template('report_card/topper_report/class_sec1', $array);
    }

    public function getSub1()
    {
        $class = $this->input->post('val');
        $getSub = $this->alam->selectA('class_section_wise_subject_allocation', "DISTINCT(subject_code),Subject_Name_Dispaly", "Class_No='$class'");
        //  echo $this->db->last_query();die;
        ?>
        <option value="">Select</option>
        <?php
        foreach ($getSub as $key => $val) {
        ?>
            <option value="<?php echo $val['subject_code']; ?>"><?php echo $val['Subject_Name_Dispaly']; ?></option>
        <?php
        }
    }

	 public function Select_Exam1()
    {
		$user_id=login_details['user_id'];
        $class = $this->input->post('cls');
        if($class == 13){
			if($user_id == 'EMP0140'){
			 $exammaster = $this->dbcon->select('exammaster', '*', 'ExamCode IN(15,18)');
			}
        }else{
            $exammaster = $this->dbcon->select('exammaster', '*', 'ExamCode IN(1,2,3,4,14)');
        }
        //  echo $this->db->last_query();die;
        ?>
        <option value="">Select</option>
        <?php
        foreach ($exammaster as $key => $val) {
        ?>
            <option value="<?php echo $val->ExamCode; ?>"><?php echo $val->ExamName; ?></option>
        <?php
        }
		
    }
	
    public function find_details1()
    {
        $class_name = $this->input->post('class_name');
        $subj_name = $this->input->post('sub');
        $exam_type = $this->input->post('exam_type');
        $term = $this->input->post('term');
        $topper_data = $this->dbcon->topper_10($exam_type,$subj_name,$class_name,$term);
       
        $data['topper_data'] = $topper_data;
		$examname = $this->dbcon->select('exammaster','examname'," examcode=$exam_type");
		$subjectname = $this->dbcon->select('subjects','subname',"subcode=$subj_name");
		$data['subjectname'] =$subjectname[0]->subname;
		$data['examname'] =$examname[0]->examname;

        if (!empty($data['topper_data'])) {
            $this->load->view('report_card/topper_report/find_details1', $data);
        } else {
            echo "<center><h1>Sorry No Data Found</h1></center>";
        }
    }
}
