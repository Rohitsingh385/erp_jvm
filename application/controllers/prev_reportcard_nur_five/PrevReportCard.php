<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PrevReportCard extends MY_controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Alam','alam');
	}
	
	public function index(){
		$data['classes'] = $this->alam->selectA('classes','*',"Class_No in(1,2,3,4,5,6,7)");
		$this->render_template('prev_reportcard_nur_five/prev_report_card_five',$data);
	}
	
	public function get_sec(){
		$class_no = $this->input->post('val');
		$secData  = $this->alam->selectA('class_section_wise_subject_allocation','distinct(section_no),(select SECTION_NAME from sections where section_no=class_section_wise_subject_allocation.section_no)secnm',"Class_No = '$class_no'")
		?>
			<option value=''>Select</option>
		<?php
		foreach($secData as $key => $val){
			?>
				<option value='<?php echo $val['secnm']; ?>'><?php echo $val['secnm']; ?></option>
			<?php
		}
	}
	
	public function getReport(){
		echo $secnm = $this->input->post('secnm');
	}
}