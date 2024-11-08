<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scholarshipownedby extends MY_Controller{
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	    $this->load->model('Mymodel','dbcon');
	}
	public function scholarshipownedby(){
		$class = $this->dbcon->select('classes','*');
		$array = array(
			'class' => $class
		);
		$this->fee_template('student_report/scholarshipownedby',$array);
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
	public function find_detailsstudentinformation(){
		$class		= $this->input->post('class_name');
		$owned      = $this->input->post('Owned');
		$short_by 	= $this->input->post('short_by');
		$data['data'] = $this->dbcon->select('scholarship','*',"CLASS='$class' AND Owned_By LIKE '$owned' ORDER BY $short_by");
		$data['feehead'] = $this->dbcon->select('feehead','*');
		$data['class'] = $class;
		$data['owned'] = $owned;
		$data['short_by'] = $short_by;
		if(!empty($data['data'])){
			$this->load->view('student_report/studentscholarshipownedby',$data);
		}
		else{
			echo "<center><h1>Sorry No Student Found Availing Scholarship Facility</h1></center>";
		}
		
		
	}
	public function download_studentinformation(){
		$class		= $this->input->post('class');
		$owned 		= $this->input->post('owned');
		$short_by 	= $this->input->post('short_by');
		$data['owned'] = $owned;
		$data['school_setting'] = $this->dbcon->select('school_setting','*');
		$data['data'] = $this->dbcon->select('scholarship','*',"CLASS='$class' AND Owned_By LIKE '$owned' ORDER BY $short_by");
		$data['feehead'] = $this->dbcon->select('feehead','*');
		$this->load->view('student_report/studentscholarshipownedbyPdf',$data);
		
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A3', 'landscape');
		$this->dompdf->render();
		$this->dompdf->stream("Scholarship_Ownedby.pdf", array("Attachment"=>0));
	}
}