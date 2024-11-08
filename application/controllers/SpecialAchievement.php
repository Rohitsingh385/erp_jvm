<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SpecialAchievement extends MY_controller
{

    public function __construct()
    {
        parent::__construct();
        $this->loggedOut();
        $this->load->model('Alam', 'alam');
    }

    public function index()
    {
        $this->render_template('SpecialAchievement/special_achievement');
    }

    function getClass()
    {
        $user_id = login_details['user_id'];
        $session    = $this->input->post('val');
       $tbl = 'login_details';

        if (login_details['ROLE_ID'] == 2) {
            $getClassT = $this->db->query("select Class_No,(select CLASS_NM from classes where Class_No=$tbl.Class_No)classnm from $tbl where user_id='$user_id'")->result_array();
            $class_id = $getClassT[0]['Class_No'];
            $classnm = $getClassT[0]['classnm'];

?>
            <option value=''>Select</option>
            <option value='<?php echo $class_id; ?>'><?php echo $classnm; ?></option>
        <?php
        } else {
            $getClass = $this->db->query("SELECT DISTINCT(Class_No),(select CLASS_NM from classes where Class_No=$tbl.Class_No)classnm FROM $tbl WHERE Class_tech_sts='1' AND Class_No <> 0 ORDER BY Class_No")->result_array();
        ?>
            <option value=''>Select</option>
            <?php
            foreach ($getClass as $val) {
            ?>
                <option value='<?php echo $val['Class_No']; ?>'><?php echo $val['classnm'] ?></option>
            <?php
            }
        }
    }

    function getSection()
    {
        $user_id = login_details['user_id'];
        $session = $this->input->post('session');
        $class = $this->input->post('val');
        $tbl = 'login_details';
      
        if (login_details['ROLE_ID'] == 2) {
            $getSecT = $this->db->query("select distinct(Section_No),(select SECTION_NAME from sections where section_no=$tbl.Section_No)secnm from $tbl where Class_No='$class' AND Class_tech_sts='1' AND Class_No <> 0 AND user_id='$user_id' order by Section_No")->result_array();
            ?>
            <option value=''>Select</option>
            <?php
            foreach ($getSecT as $val) {
            ?>
                <option value='<?php echo $val['Section_No']; ?>'><?php echo $val['secnm']; ?></option>
            <?php
            }
        } else {
            $getSec = $this->db->query("select distinct(Section_No),(select SECTION_NAME from sections where section_no=$tbl.Section_No)secnm from $tbl where Class_tech_sts='1' AND Class_No <> 0 order by Section_No")->result_array();
            ?>
            <option value=''>Select</option>
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
        $data['term'] = $term    = $this->input->post('val');
        $classs  = $this->input->post('classs');
        $sec     = $this->input->post('sec');
        $stu_tbl = 'student';
      

        // $data['get_stu'] = $get_stu = $this->db->query("select ADM_NO,FIRST_NM,ROLL_NO,(select remarks_master_id from stu_remarks where admno=$stu_tbl.ADM_NO AND term='$term')remarkpoint from $stu_tbl where CLASS='$classs' AND SEC='$sec' and student_status='ACTIVE' order by ROLL_NO")->result_array();
        $data['get_stu'] = $get_stu = $this->db->query("select ADM_NO,FIRST_NM,ROLL_NO from $stu_tbl where CLASS='$classs' AND SEC='$sec' and student_status='ACTIVE' order by ROLL_NO asc")->result_array();
            //$str=$this->db->last_query();
           // echo $str;
           // echo '<pre>'; print_r($data); echo '</pre>';
            //die;

        $this->load->view('SpecialAchievement/special_achievement_stu_list', $data);
    }

    function saveAchievement()
    {
        // echo "<pre>";print_r($_POST);die;
        $user_id = login_details['user_id'];
        $val   = strtoupper($this->input->post('val'));
        $admno = $this->input->post('admno');
        $term  = 'TERM-2';

        $get     = $this->alam->selectA('student', 'promot', "adm_no='$admno'");
        // echo $this->db->last_query();
      //  echo "<pre>";print_r($get);die;
        $cnt = count($get);
        // echo $cnt;
        // die;
        if ($cnt == 0) {
            $save['promot'] = $val;
            $save['adm_no'] = $admno;
           

            $this->alam->insert('student', $save);
        } else {
            $save['promot'] = $val;
            $this->alam->update('student', $save, "adm_no='$admno'");
        }
    }
}
