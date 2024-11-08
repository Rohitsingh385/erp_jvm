<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stu_list_code extends MY_controller
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
        $this->render_template('exam_att/Stu_list_code_wise');
    }

    function getSection()
    {
        $user_id = login_details['user_id'];
        $class = $this->input->post('val');
        $tbl = 'class_section_wise_subject_allocation';

        if( $user_id != 'EMP0140'){
            if (login_details['ROLE_ID'] == 2) {
                $getSecT = $this->db->query("select distinct(section_no),(select SECTION_NAME from sections where section_no=$tbl.section_no)secnm from $tbl where Class_No='$class' AND Main_Teacher_Code='$user_id' order by Section_No")->result_array();
                ?>
                <option value=''>Select</option>
                <?php
                foreach ($getSecT as $val) {
                ?>
                    <option value='<?php echo $val['section_no']; ?>'><?php echo $val['secnm']; ?></option>
                <?php
                }
            } 
        }
      
        else {
            $getSec = $this->db->query("select Section_No ,SECTION_NAME as secnm from sections")->result_array();
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

    function getSubject()
    {
        $user_id = login_details['user_id'];
        $sec = $this->input->post('val');
        $class = $this->input->post('classs');
        $tbl = 'class_section_wise_subject_allocation';

        if( $user_id != 'EMP0140'){
            if (login_details['ROLE_ID'] == 2) {
                $getSub = $this->db->query("SELECT cswsa.subject_code , subjects.SubName FROM `class_section_wise_subject_allocation` as cswsa
                INNER JOIN subjects
                ON cswsa.subject_code=subjects.SubCode
                WHERE Class_No='$class' AND section_no='$sec' AND Main_Teacher_Code='$user_id'")->result_array();
                ?>
                <option value=''>Select</option>
                <?php
                foreach ($getSub as $val) {
                ?>
                    <option value='<?php echo $val['subject_code']; ?>'><?php echo $val['SubName']; ?></option>
                <?php
                }
            }
        }
      
        
        else {
            $getSub = $this->db->query("SELECT  DISTINCT (cswsa.subject_code)Subjcode , subjects.SubName as SubName  FROM subjects
            INNER JOIN class_section_wise_subject_allocation cswsa
            ON subjects.SubCode=cswsa.subject_code
            WHERE cswsa.Class_No=$class")->result_array();
            ?>
            <option value=''>Select</option>
            <?php
            foreach ($getSub as $val) {
            ?>
                <option value='<?php echo $val['Subjcode']; ?>'><?php echo $val['SubName'] ?></option>
                <?php
            }
        }
    }

    public function getStu()
    {

        $subj_code    = $this->input->post('val');
        $classs  = $this->input->post('classs');
        $sec     = $this->input->post('sec');
        $get_sec= $this->db->query("SELECT SECTION_NAME FROM sections WHERE section_no=$sec")->result();
        $section=$get_sec[0]->SECTION_NAME;
        $get_subj= $this->db->query("SELECT SubName FROM subjects WHERE SubCode=$subj_code")->result();
        $subjects=$get_subj[0]->SubName;
       

        $get = $this->db->query("SELECT st.ADM_NO,st.FIRST_NM,st.ROLL_NO , ss.STU_subcode,ss.GROUP FROM `student` as st 
        join studentsubject_xi as ss 
        on st.ADM_NO=ss.Adm_no
        where ss.SUBCODE='$subj_code' AND ss.Class='$classs' AND ss.SEC='$sec' AND st.`CLASS`='$classs' AND st.`SEC`='$sec' AND st.`Student_Status`='ACTIVE'  ORDER BY st.ROLL_NO")->result_array();
		//echo $this->db->last_query();die;
        //echo '<pre>'; print_r($get); echo '</pre>';
        //die;
        ?>

        <table id="example" class="display nowrap" style="width:100%">
            <thead>
                <tr style="width: 25%;">
                    <th style='background:#5785c3; color:#fff!important;'>Adm. No.</th>
                    <th style='background:#5785c3; color:#fff!important;'>Name</th>
                    <th style='background:#5785c3; color:#fff!important;'>Roll No.</th>
                    <th style='background:#5785c3; color:#fff!important;'>Code</th>
					 <th style='background:#5785c3; color:#fff!important;'>Group</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($get as $key => $val) {
                ?>

                    <tr>
                        <td><?php echo $adm_no = $val['ADM_NO']; ?></td>
                        <td><?php echo $val['FIRST_NM']; ?></td>
                        <td><?php echo $val['ROLL_NO']; ?></td>
                        <td>
                            <?php
                            // echo $student_code = str_replace('/', '', $val['ADM_NO']) . $classs . $sec . $subj_code;
								echo $val['STU_subcode'];
                            //echo $student_code = md5(($val['ADM_NO']));
							//echo $student_code = $admno + 30033562;

                            ?>
                        </td>
						<td><?php echo $val['GROUP'] ?></td>
                    </tr>


                <?php

                    //$this->db->query("UPDATE studentsubject SET Student_code='$student_code' WHERE Class='$classs' AND SEC='$sec' AND SUBCODE='$subj_code' AND Adm_no='$adm_no'");
                }
                ?>
            </tbody>
        </table>

        <script>
            $(document).ready(function() {
                var printCounter = 0;


                $('#example').DataTable({
                    dom: 'Bfrtip',
                    buttons: [

                        {
                            extend: 'excel',
                            title: "Student Code of Class - <?php if($classs==13){echo 'XI';}else{echo 'XII';}; ?> & Sec - <?php echo $section; ?> & Subject - <?php echo $subjects; ?>",
                        },
                        {
                            extend: 'pdf',
                            title: "Student Code of Class - <?php if($classs==13){echo 'XI';}else{echo 'XII';}; ?> & Sec - <?php echo $section; ?> & Subject - <?php echo $subjects; ?>",
                        },
                        {
                            extend: 'print',
                            messageTop: function() {
                                printCounter++;

                                if (printCounter === 1) {
                                    return 'This is the first time you have printed this document.';
                                } else {
                                    return 'You have printed this document ' + printCounter + ' times';
                                }
                            },

                        }
                    ]
                });
            });
            <?php
        }
	
	 public function code()
    {
        $this->render_template('exam_att/dwlnd_list_code_wise');
    }
	
	 function getGroup()
    {
        $user_id = login_details['user_id'];
        $class = $this->input->post('val');
        $tbl = 'studentsubject_xi';

        if ($user_id != 'EMP0140') {
            if (login_details['ROLE_ID'] == 2) {
                $getSecT = $this->db->query("select DISTINCT(studentsubject_xi.GROUP)section_no from $tbl where Class='$class'  order by studentsubject_xi.GROUP")->result_array();
?>
                <option value=''>Select</option>
                <?php
                foreach ($getSecT as $val) {
                ?>
                    <option value='<?php echo $val['section_no']; ?>'><?php echo $val['section_no']; ?></option>
            <?php
                }
            }
        } else {
            $getSec = $this->db->query("SELECT DISTINCT studentsubject_xi.GROUP FROM `studentsubject_xi`")->result_array();
            ?>
            <option value=''>Select</option>
            <?php
            foreach ($getSec as $val) {
            ?>
                <option value='<?php echo $val['GROUP']; ?>'><?php echo $val['GROUP'] ?></option>
            <?php
            }
        }
    }
	
	     public function getStu_code()
    {

        $subj_code    = $this->input->post('val');
        $classs  = $this->input->post('classs');
        $sec     = $this->input->post('sec');

        $get_subj = $this->db->query("SELECT SubName FROM subjects WHERE SubCode=$subj_code")->result();
        $subjects = $get_subj[0]->SubName;


        $get = $this->db->query("SELECT st.DISP_SEC,st.ADM_NO,st.FIRST_NM,st.ROLL_NO , ss.STU_subcode,ss.GROUP FROM `student` as st 
        join studentsubject_xi as ss 
        on st.ADM_NO=ss.Adm_no
        where ss.SUBCODE='$subj_code' AND ss.Class='$classs' AND ss.GROUP='$sec' AND st.`CLASS`='$classs'  AND st.`Student_Status`='ACTIVE'  ORDER BY st.ROLL_NO")->result_array();
        //echo '<pre>'; print_r($get); echo '</pre>';
        //die;
    ?>

        <table id="example" class="display nowrap" style="width:100%">
            <thead>
                <tr style="width: 25%;">
                    <th style='background:#5785c3; color:#fff!important;'>Sl. No.</th>
                    <th style='background:#5785c3; color:#fff!important;'>Adm. No.</th>
                    <th style='background:#5785c3; color:#fff!important;'>Name</th>
                    <th style='background:#5785c3; color:#fff!important;'>Roll No.</th>
                    <th style='background:#5785c3; color:#fff!important;'>Sec</th>
                    <th style='background:#5785c3; color:#fff!important;'>Code</th>
                    <th style='background:#5785c3; color:#fff!important;'>Group</th>
                </tr>
            </thead>
            <tbody>
                <?php
                  $i=1;
                foreach ($get as $key => $val) {
                  
                    $code = $val['STU_subcode'];
					$first_three = substr($code, 0, 3);
					$last_one = substr($code, -1);
					$extracted = $first_three . $last_one;
                ?>

                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $adm_no = $val['ADM_NO']; ?></td>
                        <td><?php echo $val['FIRST_NM']; ?></td>
                        <td><?php echo $val['ROLL_NO']; ?></td>
                        <td><?php echo $val['DISP_SEC']; ?></td>
                        <td>
                            <?php
                            // echo $student_code = str_replace('/', '', $val['ADM_NO']) . $classs . $sec . $subj_code;
                            echo $extracted;
                            //echo $student_code = md5(($val['ADM_NO']));
                            //echo $student_code = $admno + 30033562;

                            ?>
                        </td>
                        <td><?php echo $val['GROUP'] ?></td>
                    </tr>


                <?php

$i++; //$this->db->query("UPDATE studentsubject SET Student_code='$student_code' WHERE Class='$classs' AND SEC='$sec' AND SUBCODE='$subj_code' AND Adm_no='$adm_no'");
                }
               
                ?>
            </tbody>
        </table>

        <script>
            $(document).ready(function() {
                var printCounter = 0;


                $('#example').DataTable({
                    dom: 'Bfrtip',
                    buttons: [

                        {
                            extend: 'excel',
                            title: "Student Code of Class - <?php if ($classs == 13) {
                                                                echo 'XI';
                                                            } else {
                                                                echo 'XII';
                                                            }; ?> & GROUP - <?php echo $sec; ?> & Subject - <?php echo $subjects; ?>",
                        },
                        {
                            extend: 'pdf',
                            title: "Student Code of Class - <?php if ($classs == 13) {
                                                                echo 'XI';
                                                            } else {
                                                                echo 'XII';
                                                            }; ?> & GROUP - <?php echo $sec; ?> & Subject - <?php echo $subjects; ?>",
                        },
                        {
                            extend: 'print',
                            title: "GROUP - <?php echo $sec; ?> & Subject - <?php echo $subjects; ?>",
                        }
                    ]
                });
            });
        </script>
<?php
    }



    }

