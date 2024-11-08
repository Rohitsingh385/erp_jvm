<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ExamAtt_XI extends MY_controller
{

    public function __construct()
    {
        error_reporting(0);
        parent::__construct();
        $this->loggedOut();
        $this->load->model('Alam', 'alam');
    }

    public function index()
    {
        $this->render_template('exam_att/exam_att_xi');
    }


    function getSection()
    {
        $user_id = login_details['user_id'];
        $session = $this->input->post('session');
        $class = $this->input->post('val');
        $tbl = 'login_details';

        if (login_details['ROLE_ID'] == 2) {
            //  $getSecT = $this->db->query("select distinct(Section_No),(select SECTION_NAME from sections where section_no=$tbl.Section_No)secnm from $tbl where Class_No='$class' AND Class_tech_sts='1' AND Class_No <> 0 AND user_id='$user_id' order by Section_No")->result_array();
            if ($user_id == 'EMP0213') {
                $getSec = $this->db->query("select distinct(Section_No),(select SECTION_NAME from sections where section_no=$tbl.Section_No)secnm from $tbl where Class_tech_sts='1' order by Section_No")->result_array();
            } else {

                $getSec = $this->db->query("select distinct(Section_No),(select SECTION_NAME from sections where section_no=$tbl.Section_No)secnm from $tbl where Class_tech_sts='1' AND user_id='$user_id' order by Section_No")->result_array();
            }
?>
            <option value=''>Select</option>
            <?php if ($user_id == 'EMP0213') { ?>
                <option value='all'>All</option>
            <?php } ?>
            <?php
            foreach ($getSec as $val) {
            ?>
                <option value='<?php echo $val['Section_No']; ?>'><?php echo $val['secnm'] ?></option>
            <?php
            }
        } else {
            $getSec = $this->db->query("select distinct(Section_No),(select SECTION_NAME from sections where section_no=$tbl.Section_No)secnm from $tbl where Class_tech_sts='1' AND Class_No <> 0 order by Section_No")->result_array();
            ?>
            <option value=''>Select</option>
            <option value='all'>All</option>
            <?php
            foreach ($getSec as $val) {
            ?>
                <option value='<?php echo $val['Section_No']; ?>'><?php echo $val['secnm'] ?></option>
<?php
            }
        }
    }

    public function getStu()
    {

        $session = $this->input->post('session');
        $sheet = $this->input->post('val');
        $data['sheet'] = $sheet;
        $classs  = $this->input->post('classs');
        $sec     = $this->input->post('sec');

        $stu_tbl = 'student';
        $target_table = 'exam_attxi';

        $chk_sts = $this->alam->select($target_table, '*', "class=$classs and sec=$sec");
        if (empty($chk_sts)) {
            $this->db->query("INSERT INTO $target_table(`class`, `sec`, `adm_no`, `sheet_1_wd`, `sheet_1_pd`, `sheet_2_wd`, `sheet_2_pd`, `sheet_3_wd`, `sheet_3_pd`, `sheet_4_wd`, `sheet_4_pd`, `sheet_5_wd`, `sheet_5_pd`, `sheet_6_wd`, `sheet_6_pd`, `sheet_7_wd`, `sheet_7_pd`, `sheet_8_wd`, `sheet_8_pd`, `sheet_9_wd`, `sheet_9_pd`, `sheet_10_wd`, `sheet_10_pd`, `sheet_11_wd`, `sheet_11_pd`, `sheet_12_wd`, `sheet_12_pd`)
            SELECT
            CLASS,
            SEC,
            ADM_NO, 
            '',  
            '',
            '',  
            '',  
            '',  
            '',  
            '',  
            '',  
            '',  
            '',  
            '',  
            '',  
            '',  
            '',  
            '',  
            '',  
            '',  
            '',  
            '',  
            '',  
            '',  
            '',  
            '',
            ''  
            FROM $stu_tbl
            WHERE CLASS = '$classs' AND SEC = '$sec' AND Student_Status = 'ACTIVE'
            ORDER BY ROLL_NO");
        }

        //$data['get'] = $this->db->query("select ADM_NO,FIRST_NM,ROLL_NO,APR_ATT,MAY_ATT,JUNE_ATT,JULY_ATT,AUG_ATT,SEP_ATT,NOV_ATT,VL, promot from $stu_tbl where CLASS='$classs' AND SEC='$sec'  AND Student_Status='ACTIVE' order by ROLL_NO")->result_array();

        $data['get'] = $this->db->query("SELECT exam_attxi.*, student.ROLL_NO, student.FIRST_NM
        FROM student
        INNER JOIN exam_attxi
        ON student.ADM_NO = exam_attxi.adm_no
        WHERE student.CLASS = $classs AND student.SEC = $sec ORDER BY student.ROLL_NO")->result_array();

        $this->load->view('exam_att\exam_att_xi_list', $data);
    }

    function totWorkingDays()
    {
        $classs  = $this->input->post('classs');
        $sec     = $this->input->post('sec');
        $sheet    = $this->input->post('sheet');
        $enterTotWorkDays = $this->input->post('val');



        $tbl = 'exam_attxi';

        if ($sheet == 'Sheet-1') {
            $save['sheet_1_wd'] = $enterTotWorkDays;
            $sheet_no['sheet_1'] =   $sheet;
        } elseif ($sheet == 'Sheet-2') {
            $save['sheet_2_wd'] = $enterTotWorkDays;
            $sheet_no['sheet_2'] =   $sheet;
        } elseif ($sheet == 'Sheet-3') {
            $save['sheet_3_wd'] = $enterTotWorkDays;
            $sheet_no['sheet_3'] =   $sheet;
        } elseif ($sheet == 'Sheet-4') {
            $save['sheet_4_wd'] = $enterTotWorkDays;
            $sheet_no['sheet_4'] =   $sheet;
        } elseif ($sheet == 'Sheet-5') {
            $save['sheet_5_wd'] = $enterTotWorkDays;
            $sheet_no['sheet_5'] =   $sheet;
        } elseif ($sheet == 'Sheet-6') {
            $save['sheet_6_wd'] = $enterTotWorkDays;
            $sheet_no['sheet_6'] =   $sheet;
        } elseif ($sheet == 'Sheet-7') {
            $save['sheet_7_wd'] = $enterTotWorkDays;
            $sheet_no['sheet_7'] =   $sheet;
        } elseif ($sheet == 'Sheet-8') {
            $save['sheet_8_wd'] = $enterTotWorkDays;
            $sheet_no['sheet_8'] =   $sheet;
        } elseif ($sheet == 'Sheet-9') {
            $save['sheet_9_wd'] = $enterTotWorkDays;
        } elseif ($sheet == 'Sheet-10') {
            $save['sheet_10_wd'] = $enterTotWorkDays;
            $sheet_no['sheet_10'] =   $sheet;
        } elseif ($sheet == 'Sheet-11') {
            $save['sheet_11_wd'] = $enterTotWorkDays;
            $sheet_no['sheet_11'] =   $sheet;
        } elseif ($sheet == 'Sheet-12') {
            $save['sheet_12_wd'] = $enterTotWorkDays;
            $sheet_no['sheet_12'] =   $sheet;
        } else {
        }
        $this->alam->update($tbl, $save, "class='$classs' AND sec='$sec'");
        //$this->alam->update($tbl,$sheet_no, "class='$classs' AND sec='$sec'");

    }

    public function totPresentDays()
    {
        $val     = $this->input->post('val');
        $admno   = $this->input->post('admno');

        $sheet    = $this->input->post('sheet');
        $enterTotWorkDays = $val;


        $tbl = 'exam_attxi';

        if ($sheet == 'Sheet-1') {
            $save['sheet_1_pd'] = $enterTotWorkDays;
        } elseif ($sheet == 'Sheet-2') {
            $save['sheet_2_pd'] = $enterTotWorkDays;
        } elseif ($sheet == 'Sheet-3') {
            $save['sheet_3_pd'] = $enterTotWorkDays;
        } elseif ($sheet == 'Sheet-4') {
            $save['sheet_4_pd'] = $enterTotWorkDays;
        } elseif ($sheet == 'Sheet-5') {
            $save['sheet_5_pd'] = $enterTotWorkDays;
        } elseif ($sheet == 'Sheet-6') {
            $save['sheet_6_pd'] = $enterTotWorkDays;
        } elseif ($sheet == 'Sheet-7') {
            $save['sheet_7_pd'] = $enterTotWorkDays;
        } elseif ($sheet == 'Sheet-8') {
            $save['sheet_8_pd'] = $enterTotWorkDays;
        } elseif ($sheet == 'Sheet-9') {
            $save['sheet_9_pd'] = $enterTotWorkDays;
        } elseif ($sheet == 'Sheet-10') {
            $save['sheet_10_pd'] = $enterTotWorkDays;
        } elseif ($sheet == 'Sheet-11') {
            $save['sheet_11_pd'] = $enterTotWorkDays;
        } elseif ($sheet == 'Sheet-12') {
            $save['sheet_12_pd'] = $enterTotWorkDays;
        } else {
        }

        $this->alam->update($tbl, $save, "adm_no='$admno'");
    }

    public function totWorkingByStu()
    {
        $val     = $this->input->post('val');
        $admno   = $this->input->post('admno');

        $sheet    = $this->input->post('sheet');
        $enterTotWorkDays = $val;

        // echo $val;die;

        $tbl = 'exam_attxi';

        if ($sheet == 'Sheet-1') {
            $save['sheet_1_wd'] = $enterTotWorkDays;
        } elseif ($sheet == 'Sheet-2') {
            $save['sheet_2_wd'] = $enterTotWorkDays;
        } elseif ($sheet == 'Sheet-3') {
            $save['sheet_3_wd'] = $enterTotWorkDays;
        } elseif ($sheet == 'Sheet-4') {
            $save['sheet_4_wd'] = $enterTotWorkDays;
        } elseif ($sheet == 'Sheet-5') {
            $save['sheet_5_wd'] = $enterTotWorkDays;
        } elseif ($sheet == 'Sheet-6') {
            $save['sheet_6_wd'] = $enterTotWorkDays;
        } elseif ($sheet == 'Sheet-7') {
            $save['sheet_7_wd'] = $enterTotWorkDays;
        } elseif ($sheet == 'Sheet-8') {
            $save['sheet_8_wd'] = $enterTotWorkDays;
        } elseif ($sheet == 'Sheet-9') {
            $save['sheet_9_wd'] = $enterTotWorkDays;
        } elseif ($sheet == 'Sheet-10') {
            $save['sheet_10_wd'] = $enterTotWorkDays;
        } elseif ($sheet == 'Sheet-11') {
            $save['sheet_11_wd'] = $enterTotWorkDays;
        } elseif ($sheet == 'Sheet-12') {
            $save['sheet_12_wd'] = $enterTotWorkDays;
        } else {
        }

        $this->alam->update($tbl, $save, "adm_no='$admno'");
        // echo $this->db->last_query();
    }

    public function att_report()
    {
        $this->render_template('exam_att/exam_att_xi_rept');
    }

    public function getStu_report()
    {
		ini_set('max_execution_time', 0); 
        ini_set('memory_limit','2048M');
        $class = $this->input->post('class');
        $sec = $this->input->post('sec');
        $sheet = $this->input->post('sheet');

        $data['sheet'] = $sheet;
        $data['class'] = $class;
        $data['sec'] = $sec; //13

        if ($sec == 'all') {

            $data['get'] = $this->db->query("SELECT exam_attxi.*, 
        (exam_attxi.sheet_1_wd + exam_attxi.sheet_2_wd + exam_attxi.sheet_3_wd + exam_attxi.sheet_4_wd + exam_attxi.sheet_5_wd + exam_attxi.sheet_6_wd + exam_attxi.sheet_7_wd + exam_attxi.sheet_8_wd + exam_attxi.sheet_9_wd + exam_attxi.sheet_10_wd + exam_attxi.sheet_11_wd + exam_attxi.sheet_12_wd) AS toa_wd,

        (exam_attxi.sheet_1_pd + exam_attxi.sheet_2_pd + exam_attxi.sheet_3_pd + exam_attxi.sheet_4_pd + exam_attxi.sheet_5_pd + exam_attxi.sheet_6_pd + exam_attxi.sheet_7_pd + exam_attxi.sheet_8_pd + exam_attxi.sheet_9_pd + exam_attxi.sheet_10_pd + exam_attxi.sheet_11_pd + exam_attxi.sheet_12_pd) AS toa_pd,

        student.FIRST_NM, student.disp_class, student.disp_sec, student.ROLL_NO
        FROM student
        INNER JOIN exam_attxi
        ON student.ADM_NO = exam_attxi.adm_no
        WHERE exam_attxi.class = '$class' 
        ORDER BY student.SEC,student.ROLL_NO")->result_array();
        } else {

            $data['get'] = $this->db->query("SELECT exam_attxi.*, 
        (exam_attxi.sheet_1_wd + exam_attxi.sheet_2_wd + exam_attxi.sheet_3_wd + exam_attxi.sheet_4_wd + exam_attxi.sheet_5_wd + exam_attxi.sheet_6_wd + exam_attxi.sheet_7_wd + exam_attxi.sheet_8_wd + exam_attxi.sheet_9_wd + exam_attxi.sheet_10_wd + exam_attxi.sheet_11_wd + exam_attxi.sheet_12_wd) AS toa_wd,

        (exam_attxi.sheet_1_pd + exam_attxi.sheet_2_pd + exam_attxi.sheet_3_pd + exam_attxi.sheet_4_pd + exam_attxi.sheet_5_pd + exam_attxi.sheet_6_pd + exam_attxi.sheet_7_pd + exam_attxi.sheet_8_pd + exam_attxi.sheet_9_pd + exam_attxi.sheet_10_pd + exam_attxi.sheet_11_pd + exam_attxi.sheet_12_pd) AS toa_pd,

        student.FIRST_NM, student.disp_class, student.disp_sec, student.ROLL_NO
        FROM student
        INNER JOIN exam_attxi
        ON student.ADM_NO = exam_attxi.adm_no
        WHERE exam_attxi.class = '$class' AND exam_attxi.sec = '$sec'
        ORDER BY student.SEC,student.ROLL_NO")->result_array();
        }

        // echo $this->db->last_query();die;
        //echo '<pre>';
        //print_r($data);die;

        $this->load->view('exam_att\exam_att_xi_report', $data);
    }

    public function getStu_report_pdf()
    {
		ini_set('max_execution_time', 0); 
        ini_set('memory_limit','2048M');
        $class = $this->input->post('class');
        $data['sec'] = $sec = $this->input->post('sec');
        $sheet = $this->input->post('sheet');

        $data['sheet'] = $sheet;
        $data['class'] = $class;

        //echo '<pre>';
        //print_r($_POST);die;

        // $data['get'] = $this->db->query("SELECT exam_attxi.* student.FIRST_NM FROM exam_attxi WHERE class='$class' AND sec='$sec' AND $sheet_no = '$sheet'")->result_array();



         if ($sec == 'all') {

            $data['get'] = $this->db->query("SELECT exam_attxi.*, 
        (exam_attxi.sheet_1_wd + exam_attxi.sheet_2_wd + exam_attxi.sheet_3_wd + exam_attxi.sheet_4_wd + exam_attxi.sheet_5_wd + exam_attxi.sheet_6_wd + exam_attxi.sheet_7_wd + exam_attxi.sheet_8_wd + exam_attxi.sheet_9_wd + exam_attxi.sheet_10_wd + exam_attxi.sheet_11_wd + exam_attxi.sheet_12_wd) AS toa_wd,

        (exam_attxi.sheet_1_pd + exam_attxi.sheet_2_pd + exam_attxi.sheet_3_pd + exam_attxi.sheet_4_pd + exam_attxi.sheet_5_pd + exam_attxi.sheet_6_pd + exam_attxi.sheet_7_pd + exam_attxi.sheet_8_pd + exam_attxi.sheet_9_pd + exam_attxi.sheet_10_pd + exam_attxi.sheet_11_pd + exam_attxi.sheet_12_pd) AS toa_pd,

        student.FIRST_NM, student.disp_class, student.disp_sec, student.ROLL_NO
        FROM student
        INNER JOIN exam_attxi
        ON student.ADM_NO = exam_attxi.adm_no
        WHERE exam_attxi.class = '$class' 
        ORDER BY student.SEC,student.ROLL_NO")->result_array();
        } else {

            $data['get'] = $this->db->query("SELECT exam_attxi.*, 
        (exam_attxi.sheet_1_wd + exam_attxi.sheet_2_wd + exam_attxi.sheet_3_wd + exam_attxi.sheet_4_wd + exam_attxi.sheet_5_wd + exam_attxi.sheet_6_wd + exam_attxi.sheet_7_wd + exam_attxi.sheet_8_wd + exam_attxi.sheet_9_wd + exam_attxi.sheet_10_wd + exam_attxi.sheet_11_wd + exam_attxi.sheet_12_wd) AS toa_wd,

        (exam_attxi.sheet_1_pd + exam_attxi.sheet_2_pd + exam_attxi.sheet_3_pd + exam_attxi.sheet_4_pd + exam_attxi.sheet_5_pd + exam_attxi.sheet_6_pd + exam_attxi.sheet_7_pd + exam_attxi.sheet_8_pd + exam_attxi.sheet_9_pd + exam_attxi.sheet_10_pd + exam_attxi.sheet_11_pd + exam_attxi.sheet_12_pd) AS toa_pd,

        student.FIRST_NM, student.disp_class, student.disp_sec, student.ROLL_NO
        FROM student
        INNER JOIN exam_attxi
        ON student.ADM_NO = exam_attxi.adm_no
        WHERE exam_attxi.class = '$class' AND exam_attxi.sec = '$sec'
        ORDER BY student.SEC,student.ROLL_NO")->result_array();
        }

        // echo $this->db->last_query();die;

        $this->load->view('exam_att\exam_att_xi_reportpdf', $data);

        $html = $this->output->get_output();
        $this->load->library('pdf');
        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('A4', 'landscape');
        $this->dompdf->render();
        $this->dompdf->stream("Attendance.pdf", array("Attachment" => 0));
    }
}
?>