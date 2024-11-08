<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SuccessTransReport extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ajax_model', 'ajax');
        $this->load->model('Alam', 'alam');
        $this->load->library('Alam_custom', 'alam_custom');
        $this->loggedOutNurAdmForm();
    }

    public function index()
    {
        // echo "jhjk";die;
        $this->nurseryAdmissionAdminTemplate('nur_adm/admin/successTransList');
    }
    public function index_api()
    {
        // echo "<pre>";print_r($_POST);die;
        $postData = $this->input->post();
        $data = $this->ajax->fetchTransData($postData);
        echo json_encode($data);
    }

    public function downloadTransactionPDF()
    {
        $verified_status = $this->input->post('verified_status');
        $user_session_id = generate_session['id'];
        $data['user_details'] = $user_details = $this->alam->selectA('nur_reg_user', '*', "id='$user_session_id'");
        $user_id = $user_details[0]['updpermission_status'];
        $data['school_setting'] = $this->alam->selectA('school_setting', '*');

        if ($user_id == 1) {
            $data['stuData'] = $this->alam->selectA('nur_adm_new', '*', "(pay_trans_id_final != '' OR pay_trans_id_final != 'NULL') AND pay_trans_date_final != 'NULL' AND rcv_amt_final > 0");
            $data['nur_reg_user'] = $this->alam->selectA('nur_reg_user', '*', "id='$user_session_id'");
        }
        // echo "<pre>";print_r($data);die;

        $this->load->view('nur_adm/admin/stu_trans_list_pdf', $data);

        $html = $this->output->get_output();
        $this->load->library('pdf');
        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('A4', 'portrait');
        $this->dompdf->render();
        $this->dompdf->stream("admissiion_form.pdf", array("Attachment" => 0));
    }
}
