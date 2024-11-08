<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Adm_stu extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->loggedOut();
        $this->load->model('Mymodel', 'dbcon');
        $this->load->model('Alam', 'alam');
        $this->load->library('Alam_custom', 'alam_custom');
    }

    public function stu_details()
    {
        $this->fee_template('student_details/adm_stu_details');
    }

    public function get_details()
    {

        $class = $this->input->post('classs');

        if ($class == 'nur') {
            $data['getStuData'] = $this->dbcon->selectA('nursery_adm_data', "stu_nm,id,registration_1,mobile,f_name,m_name", "adm_status=0 AND verified_status=1 and mo>10");
        } elseif ($class == 'iii') {
            $data['getStuData'] = $this->dbcon->selectA('three_adm_data', "stu_nm,id,registration_1,mobile,f_name,m_name", "adm_status=0");
        } else {
            $data['getStuData'] = $this->dbcon->selectA('nursery_adm_data', "stu_nm,id,registration_1,mobile,f_name,m_name", "adm_status=0");
        }

        $data['class'] = $class;
        if (!empty($data['getStuData'])) {
            $this->load->view('student_details/adm_stu_details_view', $data);
        } else {
            echo "<center><h1>No Record Found !</h1></center>";
        }
       
    }

    public function goToStuPage()
    {

        $user_id = login_details['user_id'];
        $id = $this->input->post('id');
        $class = $this->input->post('class');
        $adm_no = strtoupper($this->input->post('admno'));
        $exp = explode("/", $adm_no);
        $student_id = $exp[0] . '-' . $exp[1];

        if ($class == 'iii') {
            $data_base = 'three_adm_data';
            $adm_cls = '5';
            $cls = '5';
            $disp_cls = 'III';
        }
        if ($class == 'nur') {
            $data_base = 'nursery_adm_data';
            $adm_cls = '1';
            $cls = '1';
            $disp_cls = 'NURSERY';
        }
        if ($class == 'xi') {
            $data_base = 'nursery_adm_data';
            $adm_cls = '13';
            $cls = '13';
            $disp_cls = 'XI';
        }
        $get = $this->dbcon->selectA($data_base, "*", "id='$id'");

        $name1 = $get[0]['stuofjvm_0'];
        $name2 = $get[0]['stuofjvm_1'];

        $save = array(
            'STUDENTID ' => $student_id,
            'ADM_DATE '  => date('Y-m-d'),
            'ADM_NO '    => $adm_no,
            'BIRTH_DT '  => $get[0]['dob'],
            'FIRST_NM '  => $get[0]['stu_nm'],
            'BLOOD_GRP ' => $get[0]['blood_group'],
            'CATEGORY '  => $get[0]['category'],
            'SEX'        => $get[0]['gender'],
            'NATION'     => 'INDIAN', 
            //'EMP_WARD'   => $get[0][''], 
            'FATHER_NM'  => $get[0]['f_name'],
            'MOTHER_NM'  => $get[0]['m_name'],
            'ADM_CLASS'  => $adm_cls,
            'ADM_SEC'    => '16',
            'P_MOBILE'   => $get[0]['mobile'],
            'P_EMAIL'    => $get[0]['email'],
            'CORR_ADD'   => $get[0]['residentail_add'] . '' . $get[0]['pin_code'],
            'C_CITY'     => $get[0]['p_district'],
            'C_STATE'    => $get[0]['p_state'],
            // 'C_NATION'   => $get[0]['p_country'], 
            'C_PIN'      => $get[0]['pin_code'],
            'C_MOBILE'   => $get[0]['mobile'],
            'C_EMAIL'    => $get[0]['email'],
            'HOUSE_CODE' => $get[0]['dob'],
            'CLASS'      => $cls,
            'DISP_CLASS' => $disp_cls,
            'SEC'        => '1',
            'DISP_SEC'   => 'A',
            'ROLL_NO'    => '0', 
            //'BUS_NO'     => '', 
            //'STOPNO'     => '', 
            //'FREESHIP'   => '', 
            'religion'   => $get[0]['religion'],
            'Bus_Book_No'   => $get[0]['aadhaar_no'],
            'Student_Status'  => 'ACTIVE',
            'student_image'   => $get[0]['img'],
            'Parent_password' => '2021',
        );

        $this->alam->insert('student', $save);

        $fatOccu       = $this->alam_custom->parent_accupation();
        $parentFathSave = array(
            'STDID' => $student_id,
            'OCCUPATION' => $fatOccu[$get[0]['f_accupation']],
            // 'DESIG' => $get[0]['f_desig'],
            // 'MTH_INCOME' => $get[0]['f_tot_income'],
            'ED_QUA' => $fatOccu[$get[0]['f_qualification']],
            'PTYPE' => 'F'
        );
        $this->alam->insert('parents', $parentFathSave);

        $motOccu       = $this->alam_custom->parent_accupation();
        $parentMothSave = array(
            'STDID' => $student_id,
            'OCCUPATION' => $motOccu[$get[0]['m_accupation']],
            // 'DESIG' => $get[0]['m_desig'],
            // 'MTH_INCOME' => $get[0]['m_tot_income'],
            'ED_QUA' => $motOccu[$get[0]['m_qualification']],
            'PTYPE' => 'M',
        );
        $this->alam->insert('parents', $parentMothSave);

        if ($name1 != '' || $name2 != '') {
            $childisht = array(
                'StId'  => $student_id,
                'AdmNo' => $adm_no,

                'Name1' => $name1,
                'Adm1'  => $get[0]['registration_0'],

                'Name2' => $name2,
                'Adm1'  => $get[0]['registration_1'],

            );
        } else {
            $childisht = array(
                'StId'  => $student_id,
                'AdmNo' => $adm_no,
            );
        }

        $this->alam->insert('childhist', $childisht);

        $student_transport_facility = array(
            'ADM_NO'    => $adm_no,
            'OLD_STOPNO'    => '1',
            'NEW_STOPNO'    => '1',
            'FROM_APPLICABLE_MONTH'    => 'APR',
            'TO_APPLICABLE_MONTH'    => 'MAR',
            'FROM_APPLICABLE_MONTH_CODE'    => '1',
            'TO_APPLICABLE_MONTH_CODE'    => '12',
            'CREATED_DATE'    => date('Y-m-d'),
            'USER_ID'    => $user_id,
        );
        $this->alam->insert('student_transport_facility', $student_transport_facility);

        $this->alam->update($data_base, array('adm_status' => '1'), "id='$id'");
        redirect('Student_details/update_student_details/' . $student_id);
    }
}
