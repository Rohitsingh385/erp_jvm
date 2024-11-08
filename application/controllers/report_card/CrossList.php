<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CrossList extends MY_controller
{

	public function __construct()
	{
		parent::__construct();
		$this->loggedOut();
		$this->load->model('Alam', 'alam');
		$this->load->model('Result_common', 'rc');
	}

	public function index()
	{
		$data['user_id']=login_details['user_id'];
		//echo $user_id;die;
		$this->render_template('report_card/crosslist_report/cross_list_list',$data);
	}

	public function getSection()
	{
		$class = $this->input->post('val');
		$getSec = $this->alam->selectA('student', "distinct(SEC),DISP_SEC", "CLASS='$class' order by DISP_SEC");
?>
		<option value="">Select</option>
		<?php
		foreach ($getSec as $key => $val) {
		?>
			<option value="<?php echo $val['SEC']; ?>"><?php echo $val['DISP_SEC']; ?></option>
<?php
		}
	}

	public function Tabulation()
	{
		error_reporting(0);
		if (isset($_POST['view'])){
			$data['class'] = $class = $this->input->post('class');
			$data['sec'] = $sec   = $this->input->post('sec');
			$data['term']=$term   = $this->input->post('term');
			$getSec = $this->alam->selectA('student', "distinct(SEC),DISP_SEC", "SEC='$sec' order by DISP_SEC");
			
			$data['section']=$getSec[0]['DISP_SEC'];
			
			$data['classnm'] = $this->alam->select('classes', 'CLASS_NM', "Class_No='$class'");
			$data['secnm'] = $this->alam->select('sections', 'SECTION_NAME', "section_no='$sec'");
			$data['subject_list'] = $this->rc->get_subject_list_class_section_wise_consolidated($class, $sec);

			$data['stu_list'] = $this->rc->get_student_list_class_section_wise($class, $sec);

			$this->db->query("DELETE FROM marks_temp");
			$this->db->query("INSERT INTO marks_temp SELECT * from marks where classes='$class' and sec='$sec'");

			if ($class == 3) {
				$this->render_template('report_card/crosslist_report/crosslist_I_view', $data);
			} elseif ($class == 4) {
				$this->render_template('report_card/crosslist_report/crosslist_II_view', $data);
			} elseif ($class == 5 || $class == 6 || $class == 7) {
				$this->render_template('report_card/crosslist_report/crosslist_IIItoV_view', $data);
			} elseif ($class == 8 || $class == 9 || $class == 10) {
				$this->render_template('report_card/crosslist_report/crosslist_VItoVIII_view', $data);
				}
			elseif ($class == 13) {
				$this->render_template('report_card/crosslist_report/crosslist_XI_view', $data);
			}
			
		}
		
		if (isset($_POST['save']))
		{
			$data['class'] = $class = $this->input->post('class');
		$data['sec'] = $sec   = $this->input->post('sec');
		$data['term']=$term   = $this->input->post('term');

		$data['classnm'] = $this->alam->select('classes', 'CLASS_NM', "Class_No='$class'");
		$data['secnm'] = $this->alam->select('sections', 'SECTION_NAME', "section_no='$sec'");
		$data['subject_list'] = $this->rc->get_subject_list_class_section_wise_consolidated($class, $sec);

		$data['stu_list'] = $this->rc->get_student_list_class_section_wise($class, $sec);
		
		$this->db->query("DELETE FROM marks_temp");
		$this->db->query("INSERT INTO marks_temp SELECT * from marks where classes='$class' and sec='$sec'");
		
		if ($class == 3) {
			$this->load->view('report_card/crosslist_report/crosslist_I', $data);
		}elseif ($class == 4) {
			$this->load->view('report_card/crosslist_report/crosslist_II', $data);
		}elseif ($class == 5 || $class == 6 || $class==7) {
			$this->load->view('report_card/crosslist_report/crosslist_IIItoV', $data);
		}elseif ($class == 8 || $class == 9 || $class == 10 ) {
			$this->load->view('report_card/crosslist_report/crosslist_VItoVIII', $data);
		}elseif ($class == 11 || $class == 12) {
			$this->load->view('report_card/crosslist_report/crosslist_IXtoX', $data);
		} elseif ($class == 13) {
				$this->load->view('report_card/crosslist_report/crosslist_XI', $data);
		}

		 $html = $this->output->get_output();
		 $this->load->library('pdf');
		 $this->dompdf->loadHtml($html);
		 $this->dompdf->setPaper('A3', 'landscape');
		 $this->dompdf->render();
		 $this->dompdf->stream("tabulation.pdf", array("Attachment" => 0));
			
		}
		
	}

}
