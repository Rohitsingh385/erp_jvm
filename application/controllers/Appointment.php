<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Appointment extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        // $this->loggedOut();
        $this->load->model('Mymodel', 'dbcon');
    }

    public function index()
    {
        $data['department'] = $this->db->query("SELECT * FROM `role_master`")->result();
        $this->load->view('appointment/appointment_view', $data);
    }
    
    public function selectConcPer()
    {

        $dept = $this->input->post('val');

        $dept_concPer = $this->db->query("SELECT EMPID,concat_ws(' ',EMP_FNAME,EMP_MNAME,EMP_LNAME)AS EMP_NAME FROM `employee` WHERE ROLE_ID='$dept'")->result_array();

?>

        <option value="">Select</option>

        <?php
        foreach ($dept_concPer as $key => $val) {
        ?>
            <option value="<?php echo $val['EMPID'] ?>"> <?php echo $val['EMP_NAME']; ?></option>
<?php
        }
    }
    public function save_()
    {
        if (isset($_POST['submit'])) {
            $dept = $this->input->post('dept');
            $appointment_date = $this->input->post('appointment_date');

            $appointment_time = $this->input->post('appointment_time');
            $conPer = $this->input->post('conPer');
            $name = $this->input->post('name');
            $mobNo = $this->input->post('mobNo');
            $email = $this->input->post('email');
            $purpose = $this->input->post('purpose');
            $vistor = $this->input->post('vistor');
            $add = $this->input->post('add');

            if (isset($_FILES['document']['name']) && !empty($_FILES['document']['name'])) {
                if (!file_exists('assets/appointment')) {
                    mkdir('assets/appointment', 0777, true);
                }
                $image_name = $_FILES['document']['name'];
                $temp = explode(".", $image_name);
                $newfilename = round(microtime(true)) . '.' . end($temp);
                $imagepath = "assets/appointment/" . $newfilename;
                move_uploaded_file($_FILES["document"]["tmp_name"], $imagepath);
                $ins_data['photgraph'] = $imagepath;
            }
			else{
				$imagepath='';
			}

            
            $ins_data = array(
                'department' => $dept,
                'appointment_date'     => $appointment_date,
                'appointment_time' => $appointment_time,
                'concerned_person'    => $conPer,
                'name'   => $name,
                'mobile_no' => $mobNo,
                'email_id'     => $email,
                'address' => $add,
                'purpose'    => $purpose,
                'visitor_type'   => $vistor,
                'photgraph'  => $imagepath
            );

          
            $this->dbcon->insert('appointment', $ins_data);

            $id = $this->db->query("SELECT max(id)id from appointment")->result();
            $id_ = $id[0]->id;

            $school_setting = $this->dbcon->select('school_setting', '*');

            $details_fetch = $this->db->query("SELECT * ,
            (SELECT concat_ws(' ',emp.EMP_FNAME,emp.EMP_MNAME,emp.EMP_LNAME)AS EMP_NAME FROM employee emp WHERE emp.EMPID=apt.concerned_person)EMP_NAME,
            (SELECT role_master.NAME FROM role_master WHERE role_master.ID=apt.department)department
            FROM appointment apt WHERE apt.id='$id_'")->result_array();


            $details_array = array(
                'details_fetch' => $details_fetch,
                'school_setting' => $school_setting
            );

            $this->load->view('appointment/appointment_pdf', $details_array);

            $html = $this->output->get_output();
            $this->load->library('pdf');
            $this->dompdf->loadHtml($html);
            $this->dompdf->setPaper('A4', 'potrait');
            $this->dompdf->render();
            $this->dompdf->stream("Appointment.pdf", array("Attachment" => 0));
        }
    }
}
