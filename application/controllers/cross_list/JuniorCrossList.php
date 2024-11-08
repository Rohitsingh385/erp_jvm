<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JuniorCrossList extends MY_Controller {
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Alam','alam');
	}
	
	public function index(){
		$this->render_template('cross_list/junior_cross_list');
	}
	
	public function loadSec(){
		$clas = $this->input->post('clas');
		
		if($clas == 'Nursery'){
			$table_name = 'class_nur';
		}elseif($clas == 'Prep'){
			$table_name = 'class_prep';
		}elseif($clas == 'I'){
			$table_name = 'class_i';
		}elseif($clas == 'II'){
			$table_name = 'class_ii';
		}elseif($clas == 'III'){
			$table_name = 'class_iii';
		}elseif($clas == 'IV'){
			$table_name = 'class_iv';
		}elseif($clas == 'V'){
			$table_name = 'class_v';
		}
		
		$getData = $this->alam->selectA($table_name,'distinct(SEC)',"1='1' order by SEC");
		?>
			<option value=''>Select</option>
		<?php
		foreach($getData as $key => $val){
			?>
				<option value='<?php echo $val['SEC']; ?>'><?php echo $val['SEC']; ?></option>
			<?php
		}
	}
	
	public function loadCrossList(){
		$clas = $this->input->post('clas');
		$sec  = $this->input->post('sec');
		
		$data['clas'] = $clas;
		$data['sec']  = $sec;
		
		if($clas == 'Nursery'){
			$table_name = 'class_nur';
			$data['getData'] = $this->alam->selectA($table_name,'*',"SEC='$sec' order by ROLL_NO");
			$this->load->view('cross_list/load_class_nur',$data);
		}elseif($clas == 'Prep'){
			$table_name = 'class_prep';
			$data['getData'] = $this->alam->selectA($table_name,'*',"SEC='$sec' order by ROLL_NO");
			$this->load->view('cross_list/load_class_prep',$data);
		}elseif($clas == 'I'){
			$table_name = 'class_i';
			$data['getData'] = $this->alam->selectA($table_name,'*',"SEC='$sec' order by ROLLNO");
			$this->load->view('cross_list/load_class_i',$data);
		}elseif($clas == 'II'){
			$table_name = 'class_ii';
			$data['getData'] = $this->alam->selectA($table_name,'*',"SEC='$sec' order by ROLLNO");
			$this->load->view('cross_list/load_class_ii',$data);
		}elseif($clas == 'III'){
			$table_name = 'class_iii';
			$data['getData'] = $this->alam->selectA($table_name,'*',"SEC='$sec' order by ROLLNO");
			$this->load->view('cross_list/load_class_iii',$data);
		}elseif($clas == 'IV'){
			$table_name = 'class_iv';
			$data['getData'] = $this->alam->selectA($table_name,'*',"SEC='$sec' order by ROLLNO");
			$this->load->view('cross_list/load_class_iv',$data);
		}elseif($clas == 'V'){
			$table_name = 'class_v';
			$data['getData'] = $this->alam->selectA($table_name,'*',"SEC='$sec' order by ROLLNO");
			$this->load->view('cross_list/load_class_v',$data);
		}
	}
}
