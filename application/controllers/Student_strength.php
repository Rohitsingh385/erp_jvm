<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_strength extends MY_Controller{
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	    $this->load->model('Mymodel','dbcon');
	}
	public function show_strenght(){
		$class = $this->dbcon->select('classes','*');
		$sec = $this->dbcon->select('sections','*');
		$array = array(
			'class' => $class,
			'sec' => $sec
			);
		$this->fee_template('class_report/student_strength',$array);
	}
	public function student_strenghth_class(){
		$rel = $this->dbcon->select('religion','*');
		$cat = $this->dbcon->select('category','*');
		$wardd = $this->dbcon->select('eward','*');
		$all_data = $this->dbcon->classwise_strength();
		$array = array(
			'cat'			=> $cat,
			'rel'			=> $rel,
			'wardd'			=> $wardd,
			'all_data'		=> $all_data
		);
		$this->load->view('class_report/class_wise_strength',$array);
	}
	public function class_wise_pdf(){
		$rel = $this->dbcon->select('religion','*');
		$cat = $this->dbcon->select('category','*');
		$wardd = $this->dbcon->select('eward','*');
		$school_setting = $this->dbcon->select('school_setting','*');
		$all_data = $this->dbcon->classwise_strength();
		$array = array(
			'school_setting' => $school_setting,
			'cat'			=> $cat,
			'rel'			=> $rel,
			'wardd'			=> $wardd,
			'all_data'		=> $all_data
		);
		$this->load->view('class_report/class_wise_strength_pdf',$array);
	}
	public function student_strenghth_all(){
		clearstatcache();
		$religion = $this->input->post('religion');
		$category = $this->input->post('category');
		$ward = $this->input->post('ward');
		$rel = $this->dbcon->select('religion','*');
		$cat = $this->dbcon->select('category','*');
		$wardd = $this->dbcon->select('eward','*');
		$all_data = $this->dbcon->all_strength();
		
		$array= array(
			'all_data'		=> $all_data,
			'religion' 		=> $religion,
			'category'	 	=> $category,
			'ward' 			=> $ward,
			'cat'			=> $cat,
			'rel'			=> $rel,
			'wardd'			=> $wardd
		);
		// echo "<pre>";
		// print_r($array);
		// exit;
		$this->load->view('class_report/all_class_wise_strength',$array);
		
	}
	public function all_class_wise_pdf(){
		clearstatcache();
		$rel = $this->dbcon->select('religion','*');
		$cat = $this->dbcon->select('category','*');
		$wardd = $this->dbcon->select('eward','*');
		$school_setting = $this->dbcon->select('school_setting','*');
		$all_data = $this->dbcon->all_strength();
		
		$array= array(
			'all_data'		=> $all_data,
			'cat'			=> $cat,
			'rel'			=> $rel,
			'wardd'			=> $wardd,
			'school_setting'=> $school_setting
		);
		$this->load->view('class_report/all_class_wise_strength_pdf',$array);
	}
	//----------------
	public function category_count(){
		$class = $this->dbcon->select('classes','*');
		$sec = $this->dbcon->select('sections','*');
		$array = array(
			'class' => $class,
			'sec' => $sec
			);
		// $this->fee_template('class_report/category_count',$array);
		$this->fee_template('class_report/category_count',$array);
	}

	public function show_details(){
		$ses=$this->input->post('ses');
		$cls=$this->input->post('cls');
		$data['data'] = $this->dbcon->classwise_strength_session($ses,$cls);
		// echo $this->db->last_query();
		$this->load->view('class_report/category_count_view',$data);
	}
	//-----------------
	public function student_count(){
		$class = $this->dbcon->select('classes','*');
		$sec = $this->dbcon->select('sections','*');
		$array = array(
			'class' => $class,
			'sec' => $sec
			);
		// $this->fee_template('class_report/category_count',$array);
		$this->fee_template('class_report/student_count',$array);
		// $this->load->view('class_report/student_count',$array);
	}
	public function find_sec(){
		$val = $this->input->post('val');
		$data = $this->dbcon->select_distinct('student','DISP_SEC,SEC',"CLASS='$val' AND Student_Status='ACTIVE'");
		?>
		  <option value=''>Select Section</option>
		<?php
		foreach($data as $dt){
			?>
			  <option value='<?php echo $dt->SEC; ?>'><?php echo $dt->DISP_SEC; ?></option>
			<?php
		}
	}
	public function student_details(){
		$ses=$this->input->post('ses');
		$data=$this->db->query("SELECT CLASS,DISP_CLASS,(SELECT COUNT(*) FROM student WHERE student.CLASS=st.CLASS AND Student_Status='ACTIVE')TOTALSTUDENT");
		// echo $this->db->last_query();
		$this->load->view('class_report/student_count_view',$data);
	}
	//-----------------------------

	//*********************************************** /
	public function clsregistar(){
		$class = $this->dbcon->select('classes','*');
		$sec = $this->dbcon->select('sections','*');
		$array = array(
			'class' => $class,
			'sec' => $sec
			);
		// $this->fee_template('class_report/category_count',$array);
		$this->fee_template('class_report/student_registar',$array);
		// $this->load->view('class_report/student_registar',$array);
	}
	public function stu_registar_detial(){
		$ses=$this->input->post('ses');
		$sec=$this->input->post('sec');
		$classs=$this->input->post('cls');
		// echo $sec;die;
		$student = $this->dbcon->select('student st','ADM_NO,ROLL_NO,FIRST_NM,BIRTH_DT,FATHER_NM,MOTHER_NM,ADM_DATE,(SELECT CLASS_NM FROM classes WHERE classes.Class_No=st.ADM_CLASS)ADM_CLASS_id,(SELECT stoppage FROM stoppage WHERE stoppage.STOPNO=st.STOPNO)other_stop',"CLASS='$classs' AND SEC='$sec' AND Student_Status='ACTIVE' ORDER BY ROLL_NO");
		$array = array(
			'student' => $student
		);
		// echo $this->db->last_query();die;
		$this->load->view('class_report/stu_registar_detial',$array);
	}
	//*********************************************** /
}