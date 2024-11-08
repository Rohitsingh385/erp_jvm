<?php
// echo '<pre>';
// print_r($subject_list);
// die;
?>
<style>
    html * {
        font-size: 11px !important;

        color: #000 !important;
        font-family: Arial !important;
    }
</style>

<table style="width:100%">
    <tr>
        <td>
            <center><img src="assets/school_logo/cbse_logo.jpg" style="margin-left:5%; width:83px;"></center>
        </td>
        <td>
            <center>
                <h1><span style="color:#02933e;font-size:24px !important;">JAWAHAR VIDYA MANDIR</span></h1>Shyamali Colony, Doranda, Ranchi-834002<br />Session- ( 2023-2024 )<br />CROSSLIST REPORT OF <?php echo $classnm[0]->CLASS_NM . '-' . $secnm[0]->SECTION_NAME; ?>
            </center>
        </td>
        <td>
            <center><img src="assets/school_logo/jvm.png" style="margin-left:5%; width:83px;"></center>
        </td>
    </tr>
</table>
<?php
?>
<table style='font-size:11px;  width:100%' border='1' cellspacing='0'>
    <thead>
        <tr>
            <th align="center" valign="middle" scope="col">&nbsp;</th>
            <th colspan="2" align="left">STU PROFILE</th>
            <?php
            foreach ($subject_list as $key => $sub) { ?>
                <th colspan="4" align="center" valign="middle" scope="col"><?php echo $sub->subj_nm ; ?></th>
            <?php } ?>
            <!-- <th colspan="1" align="left"></th> -->
        </tr>
        <tr>
            <td align="center" valign="middle" style="width: 3%;">SL. NO.</td>
            <td align="left" valign="middle" style="width: 5%;">ADM. NO.</td>
            <td align="left" style="width: 10%;">STU. NAME.</td>
            <?php
            foreach ($subject_list as $key => $sub) { ?>
                <td align="center" valign="middle" style="width: 3%;">T-1</td>
                <td align="center" valign="middle" style="width: 3%;">Th.</td>
                <td align="center" valign="middle" style="width: 3%;">Pr.</td>
                <td align="center" valign="middle" style="width: 3%;">TOTAL</td>
            <?php
            } ?>
            <!-- <td align="center" valign="middle" style="width: 5%;"></td> -->
            <!-- <td align="center" valign="middle" style="width: 5%;"></td> -->
        </tr>
    </thead>
    <tbody>
        <?php $i = 1;
        foreach ($stu_list as $p) { ?>
            <tr>
                <td align="center"><?php echo $i; ?></td>
                <td>&nbsp;<?php echo $p->ADM_NO; ?></td>
                <td>&nbsp;<?php echo $p->FIRST_NM; ?></td>
                <?php
                foreach ($subject_list as $key => $sub) {
                    $pt_marks = 0;
                    $rt_marks = 0;
                    $marks_t1 = $this->rc->get_marks_grade_for_consolidated_analysis_new($p->CLASS, $p->SEC, $sub->subject_code, $p->ADM_NO, 4);
                    $marks_th = $this->rc->get_marks_grade_for_consolidated_analysis_new($p->CLASS, $p->SEC, $sub->subject_code, $p->ADM_NO, 15);
                    $marks_pr2 = $this->rc->get_marks_grade_for_consolidated_analysis_new($p->CLASS, $p->SEC, $sub->subject_code, $p->ADM_NO, 18);
                    $marks_ut1 = $this->rc->get_marks_grade_for_consolidated_analysis_new($p->CLASS, $p->SEC, $sub->subject_code, $p->ADM_NO, 10);
                    $marks_ut2 = $this->rc->get_marks_grade_for_consolidated_analysis_new($p->CLASS, $p->SEC, $sub->subject_code, $p->ADM_NO, 11);
                    // echo $this->db->last_query();die;
                    $ut_marks1 = round((($marks_ut1->M3 / 50)*10),0);
                    //echo $ut_marks1.'<br>';
                    $ut_marks2 = round((($marks_ut2->M3 /50) * 10),0);
                   // echo $ut_marks2.'<br>';
                    $final_marks_ut=($ut_marks1>$ut_marks2)?($ut_marks1) : ($ut_marks2);
                
                ?>
                    <td align="center"><?php echo $marks_t1->M2; ?></td>
                    <td align="center"><?php echo $marks_th->M3 +  $final_marks_ut; ?></td>
                    <td align="center"><?php echo $marks_pr2->M3; ?></td>
                    <td align="center"><?php echo ($marks_th->M3 + $marks_pr2->M3 + $final_marks_ut); ?></td>
                <?php    } 
                ?>
                <!-- <td></td> -->
                <!-- <td></td> -->
            </tr>

        <?php $i++;
        }    ?>

    </tbody>
</table>