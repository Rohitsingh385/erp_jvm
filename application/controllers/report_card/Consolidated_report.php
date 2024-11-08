<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consolidated_report extends MY_Controller {

        public function __construct()
        { 
                parent::__construct();
                $this->loggedOut();
                $this->load->model('Alam','alam');
                error_reporting(0);
        }
        public function index()
        {
                $data['class_data'] = $this->alam->select('classes','*',"class_no in (8,9,10)");
                
                $this->render_template('report_card/consolidated_report_view',$data);
        }
        public function get_student()
        {


          $class_no=  $this->input->post('classs');
          $sec=  $this->input->post('sec');

          $getClass = $this->alam->selectA('classes','CLASS_NM',"Class_No='$class_no'");
          $data['CLASS_NM'] = $getClass[0]['CLASS_NM'];

          $getSec      = $this->alam->selectA('sections','SECTION_NAME',"section_no='$sec'");
          $data['SECTION_NAME'] = $getSec[0]['SECTION_NAME'];

          $data['student_data']=$this->alam->select('student','*',"CLASS='$class_no' and SEC='$sec' and Student_Status='ACTIVE'");


          $this->load->view('report_card/consolidated_report_view_pdf',$data);

          //$html = $this->output->get_output();
         // $this->load->library('pdf');
        //  $this->dompdf->loadHtml($html);
         // $this->dompdf->setPaper('A3', 'landscape');
         // $this->dompdf->render();
         // $this->dompdf->stream("tabulation.pdf", array("Attachment"=>0));




  }
}
