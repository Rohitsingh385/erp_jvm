<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Requisition extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->loggedOut();
        $this->load->model('Mymodel', 'dbcon');
        $this->load->model('Farheen', 'farheen');
        $this->load->model('Alam', 'alam');
    }

    public function index()
    {
        $data['item'] = $this->dbcon->select('item_group_master', '*');
        $this->render_template('acquisition/requisition', $data);
    }


    public function requisition_report()
    {
        if (isset($_POST['disp'])) {

            $user_id = login_details['user_id'];

            $item1 = $this->input->post('item1');
            $item2 = $this->input->post('item2');
            $item3 = $this->input->post('item3');
            $item4 = $this->input->post('item4');
            $item5 = $this->input->post('item5');

            $quantity1 = $this->input->post('quan1');
            $quantity2 = $this->input->post('quan2');
            $quantity3 = $this->input->post('quan3');
            $quantity4 = $this->input->post('quan4');
            $quantity5 = $this->input->post('quan5');

            $req_date = date("Y-m-d");

            if ($item1 != '' && $quantity1 != '') {
                $ins_data1 = array(
                    'item' => $item1,
                    'quantity' => $quantity1,
                    'req_by' => $user_id,
                    'req_date' => $req_date
                );
                $this->dbcon->insert('requisition_req', $ins_data1);
            }

            if ($item2 != '' && $quantity2 != '') {
                $ins_data2 = array(
                    'item' => $item2,
                    'quantity' => $quantity2,
                    'req_by' => $user_id,
                    'req_date' => $req_date
                );
                $this->dbcon->insert('requisition_req', $ins_data2);
            }

            if ($item3 != '' && $quantity3 != '') {
                $ins_data3 = array(
                    'item' => $item3,
                    'quantity' => $quantity3,
                    'req_by' => $user_id,
                    'req_date' => $req_date
                );
                $this->dbcon->insert('requisition_req', $ins_data3);
            }
            
            if ($item4 != '' && $quantity4 != '') {
                $ins_data4 = array(
                    'item' => $item4,
                    'quantity' => $quantity4,
                    'req_by' => $user_id,
                    'req_date' => $req_date
                );
                $this->dbcon->insert('requisition_req', $ins_data4);
            }

            if ($item5 != '' && $quantity5 != '') {
                $ins_data5 = array(
                    'item' => $item5,
                    'quantity' => $quantity5,
                    'req_by' => $user_id,
                    'req_date' => $req_date
                );
                $this->dbcon->insert('requisition_req', $ins_data5);
            }


            $data['data'] = $this->dbcon->select('requisition_req', $data);

            $this->load->view('acquisition/view_acquisition', $data);

            $html = $this->output->get_output();
            $this->load->library('pdf');
            $this->dompdf->loadHtml($html);
            $this->dompdf->setPaper('A4', 'potrait');
            $this->dompdf->render();
            $this->dompdf->stream("requisition_req.pdf", array("Attachment" => 0));
        }
    }

    public function item_save()
    {
    }
}
