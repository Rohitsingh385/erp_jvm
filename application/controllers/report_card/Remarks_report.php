<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Remarks_report extends MY_controller
{


    public function index()
    {
        $data['user_id'] = login_details['user_id'];
        //echo $user_id;die;
        $this->render_template('report_card/remarks_report', $data);
    }
    public function Show_remarks()
    {
        $class = $this->input->post('class');
        $sec = $this->input->post('sec');
        $result = $this->input->post('result');
        if ($result == 'all') {
            $data['data'] = $this->db->query("SELECT *,(SELECT FIRST_NM FROM student where student.ADM_NO = remarks_xi.ADM_NO)FIRST_NM,
        (SELECT ROLL_NO FROM student where student.ADM_NO = remarks_xi.ADM_NO)ROLL_NO,
        (SELECT DISP_SEC FROM student where student.ADM_NO = remarks_xi.ADM_NO)DISP_SEC,
        (SELECT DISP_CLASS FROM student where student.ADM_NO = remarks_xi.ADM_NO)DISP_CLASS
         FROM remarks_xi WHERE CLASS='$class' and SEC='$sec'")->result();
            $this->load->view('report_card/result_remarks_report', $data);
        } else {
            $data['data'] = $this->db->query("SELECT *,(SELECT FIRST_NM FROM student where student.ADM_NO = remarks_xi.ADM_NO)FIRST_NM,
        (SELECT ROLL_NO FROM student where student.ADM_NO = remarks_xi.ADM_NO)ROLL_NO,
        (SELECT DISP_SEC FROM student where student.ADM_NO = remarks_xi.ADM_NO)DISP_SEC,
        (SELECT DISP_CLASS FROM student where student.ADM_NO = remarks_xi.ADM_NO)DISP_CLASS
         FROM remarks_xi WHERE CLASS='$class' and SEC='$sec' and REMARKS like '%$result%'")->result();
            $this->load->view('report_card/result_remarks_report', $data);
        }
    }
}
