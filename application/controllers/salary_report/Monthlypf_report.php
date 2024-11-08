<?php 

class Monthlypf_report extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->loggedOut();
	}

	public function index()
	{
		if(!in_array('viewMonthlyPFReport', permission_data))
		{
			redirect('payroll/dashboard/dashboard');
		}
		
		$data['title'] = "PF Statement";
		if(isset($_POST['search']))
		{
			$resultList = array();
			$date = $this->input->post('date');
			$month = date('m',strtotime($date));
			$year = date('Y',strtotime($date));
			$data['month'] = $month;
			$data['year'] = $year;
			$check_data = $this->sumit->checkData('id','payslip_dbo',array('payslip_month'=>$month,'payslip_year'=>$year));
			if($check_data)
			{
				$resultList = $this->Salary_Model->getMonthlyPFStatement($year,$month);
				$this->session->set_userdata('monthlypfpdf',$resultList);
			}
			else
			{
				$this->session->set_flashdata('msg','<div class="alert alert-info">Payslip not generated for this month.</div>');
			}
			$data['resultList'] = $resultList;
		}
		$this->render_template('salary_report/monthlyPFReport',$data);
	}
	public function generatePDFReport($year,$month){

		$data['school_setting'] = $this->sumit->fetchSingleData('*','school_setting',array('S_No'=>1));

		$current_session =$this->sumit->fetchSingleData('Session_Nm','session_master',array('Active_Status'=>1));
		$data['current_session'] = $current_session;
		$data['month'] = $month;
		$data['year'] = $year;
		$data['resultList'] = $this->session->userdata('monthlypfpdf');

		$this->load->view('salary_report/monthlyPFReportPDF',$data);

		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'portrait');
		$this->dompdf->render();
		$this->dompdf->set_option("isPhpEnabled", true);
		$this->dompdf->stream("monthlypfpdf.pdf", array("Attachment"=>0));
	}
}