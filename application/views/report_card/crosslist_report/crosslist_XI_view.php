<?php 
if($sec == 1)
{
	$section ='A';
}elseif($sec == 2)
{
	$section ='B';

}
?>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.html">Crosslist Report</a> <i class="fa fa-angle-right"></i></li>
</ol>
<!--four-grids here-->
<div style="padding: 10px; background-color: white; border-top:3px solid #337ab7;">
    <div class="row">

    <table style='font-size:11px;  width:100%' border='1' cellspacing='0' id='example'>
            <thead>
                <tr>
                    <th align="center" valign="middle" scope="col">&nbsp;</th>
                    <th colspan="3" align="left">STU PROFILE</th>
                    <?php
                    foreach ($subject_list as $key => $sub) { ?>
                        <th colspan="7" align="center" valign="middle" scope="col"><?php echo $sub->subj_nm ; ?></th>
                    <?php } ?>
                    <!-- <th colspan="1" align="left"></th> -->
                </tr>
                <tr>
                    <td align="center" valign="middle" style="width: 3%;">SL. NO.</td>
                    <td align="left" valign="middle" style="width: 5%;">ADM. NO.</td>
					 <td align="left" valign="middle" style="width: 5%;">ROLL No.</td>
                    <td align="left" style="width: 10%;">STUD. NAME.</td>
                    <?php
                    foreach ($subject_list as $key => $sub) { ?>
                        <td align="center" valign="middle" style="width: 3%;"><?php echo substr($sub->subj_nm,0,3) ; ?>&nbsp T-1</td>
                        <td align="center" valign="middle" style="width: 3%;"><?php echo substr($sub->subj_nm,0,3) ; ?>&nbsp UT 1</td>
					  	<td align="center" valign="middle" style="width: 3%;"><?php echo substr($sub->subj_nm,0,3) ; ?>&nbsp UT 2</td>
                        <td align="center" valign="middle" style="width: 3%;"><?php echo substr($sub->subj_nm,0,3) ; ?>&nbsp Th.</td>
                        <td align="center" valign="middle" style="width: 3%;"><?php echo substr($sub->subj_nm,0,3) ; ?>&nbsp Th. + UT.</td>
                        <td align="center" valign="middle" style="width: 3%;"><?php echo substr($sub->subj_nm,0,3) ; ?>&nbsp Pr.</td>
                        <td align="center" valign="middle" style="width: 3%;"><?php echo substr($sub->subj_nm,0,3) ; ?>&nbsp TOTAL</td>
                    <?php
                    } ?>
                    <!-- <td align="center" valign="middle" style="width: 5%;"></td> -->
                   
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
                foreach ($stu_list as $p) { ?>
                    <tr>
                        <td align="center"><?php echo $i; ?></td>
                        <td>&nbsp;<?php echo $p->ADM_NO; ?></td>
						 <td>&nbsp;<?php echo $p->ROLL_NO; ?></td>
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
                            $ut_marks1 = round((($marks_ut1->M3 / 50) * 10), 0);
                            $ut_marks2 = round((($marks_ut2->M3 / 50) * 10), 0);
                            $final_marks_ut = ($ut_marks1 > $ut_marks2) ? ($ut_marks1) : ($ut_marks2);
                            // echo $final_marks_ut;die;

                        ?>
                            <td align="center"><?php echo $term1_marks=$marks_t1->M2; ?></td>
                            <td align="center"><?php echo $ut_marks1; ?></td>
 							<td align="center"><?php echo $ut_marks2; ?></td>
                            <td align="center"><?php echo $marks_th->M3; ?></td>

                            <td align="center"><?php echo $tot=$marks_th->M3 +  $final_marks_ut; ?></td>
                            <td align="center"><?php echo $marks_pr2->M3; ?></td>
                            <td align="center"><?php echo ($tot + $term1_marks); ?></td>

                        <?php    }
                        ?>
                        <!-- <td></td> -->
                      
                    </tr>

                <?php $i++;
                }    ?>

            </tbody>
        </table>

    </div>
</div><br />

<div class="clearfix"></div>
<script>
	var sec = "<?php echo $section; ?>";
    $(document).ready(function() {
        $('#example').DataTable({
            scrollX: true,
            ordering: false,
            dom: 'Bfrtip',
            buttons: [
                {
                extend: 'excelHtml5',
                title: 'Cross List of Class : XI and Sec : ' + sec
            }
            ]
        });
    });
</script>