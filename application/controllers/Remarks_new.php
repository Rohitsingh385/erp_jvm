<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Remarks_new extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->loggedOut();
        $this->load->model('Alam', 'alam');
    }

    public function index()
    {

        $array['class_data'] = $this->alam->select('classes', '*');

        $this->render_template('marks_entry/remarks_term_new', $array);
        // $this->load->view('marks_entry/remarks_term_new',$array);
    }

  
    public function classess()
    {
        $ret = '';
        $class_nm = $this->input->post('val');
        $sec_data = $this->alam->select_order_by('student', 'distinct(DISP_SEC),SEC', 'DISP_SEC', "CLASS='$class_nm' AND Student_Status='ACTIVE'");

        $log_sec_no = login_details['Section_No'];

        $ret .= "<option value=''>Select</option>";
        if (isset($sec_data)) {
            foreach ($sec_data as $data) {
                if ($log_sec_no == $data->SEC) {
                    $ret .= "<option value=" . $data->SEC . ">" . $data->DISP_SEC . "</option>";
                } else {
                    $ret .= "<option value=" . $data->SEC . ">" . $data->DISP_SEC . "</option>";
                }
            }
        }

        $array = array($ret);
        echo json_encode($array);
    }

    public function stu_list()
    {
        $classs = $this->input->post('classs');
        $sec    = $this->input->post('sec');
        $trm    = $this->input->post('trm');

        $remarks_data = $this->alam->remarks_data($classs, $sec, $trm);

?>
        <table class='table'>
            <tr>
                <!-- <th style="background:#5785c3; color:#fff!important; width:100px"><input type="checkbox" name="chkall" onchange="checkAll()" disabled> Select</th> -->
                <th style="background:#5785c3; color:#fff!important; width:100px">Adm No.</th>
                <th style="background:#5785c3; color:#fff!important; width:100px">Name</th>
                <th style="background:#5785c3; color:#fff!important; width:100px">Roll</th>
                <th style="background:#5785c3; color:#fff!important; width:100%">Remarks</th>
            </tr>
            <?php
            if ($remarks_data) {
                $i = 1;
                foreach ($remarks_data as $rmks_data) {
            ?>
                    <tr>

                        <td>
                            <?php echo $rmks_data->ADM_NO; ?>

                        </td>
                        <td><?php echo $rmks_data->FIRST_NM; ?></td>
                        <td><?php echo $rmks_data->ROLL_NO; ?></td>
                        <td><textarea class='form-control' name="rmrks[<?php echo $rmks_data->ADM_NO; ?>]" id="rmrks_<?php echo $rmks_data->ADM_NO; ?>" rows='2'><?php echo $rmks_data->remarks; ?></textarea></td>
                    </tr>
            <?php
                    $i++;
                }
            }
            ?>
        </table>
<?php
    }


    public function remarks_save()
    {
        $rmrks = $this->input->post('rmrks');
        $current_date_time = date("Y-m-d");
        $user_id = login_details['user_id'];
        foreach ($rmrks as $admNo => $remarks) {
            $insdata = array(
                'ADM_NO' => $admNo,
                'TERM'   => 'TERM-1',
                'REMARKS' => $remarks,
                'created_at' => $current_date_time,
                'user_id'    => $user_id
            );
            $upddata = array(
                'REMARKS' => $remarks,
                'created_at' => $current_date_time,
                'user_id'    => $user_id
            );

            $checkrmk = $this->db->query("SELECT * from remarks where adm_no='$admNo'")->row();

            if ($checkrmk) {
                $responce1= $this->db->update('remarks', $upddata, "adm_no='$admNo'");
            } else {
                $responce1= $this->db->insert('remarks', $insdata);
            }
        }
        if ($responce1) {
            echo "<script type='text/javascript'> 
                      alert('Saved successfully');
                      window.location.href = '" . base_url('Remarks_new/index') . "';
                  </script>";
            exit; // To prevent further execution
        }
        
    }
}
