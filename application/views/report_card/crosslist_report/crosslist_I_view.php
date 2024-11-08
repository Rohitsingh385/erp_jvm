<style>
	/* html * {
		font-size: 11px !important;

		color: #000 !important;
		font-family: Arial !important;
	} */
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.html">Crosslist Report</a> <i class="fa fa-angle-right"></i></li>
</ol>
<!--four-grids here-->
<div style="padding: 10px; background-color: white; border-top:3px solid #337ab7;">
    <div class="row">
       
        <table style='font-size:11px;  width:100%' border='1' cellspacing='0' id="example">
            <thead>
                <tr>
                    <th align="center" valign="middle" scope="col">&nbsp;</th>
                    <th colspan="2" align="left">STU PROFILE</th>
                    <th colspan="5" align="center" valign="middle" scope="col">ENGLISH</th>
                    <th colspan="5" align="center" valign="middle" scope="col">HINDI</th>
                    <th colspan="5" align="center" valign="middle" scope="col">MATHEMATICS</th>
                    <th colspan="5" align="center" valign="middle" scope="col">EVS<br></th>
                    <th colspan="5" align="center" valign="middle" scope="col">GK<br></th>
					<th colspan="1"></th>
                </tr>
                <tr>
                    <td align="center" valign="middle" style="width: 3%;">SL. NO.</td>

                    <td align="left" valign="middle" style="width: 5%;">ADM. NO.</td>
                    <td align="left" style="width: 10%;">STU. NAME.</td>
                    <td align="center" valign="middle" style="width: 3%;">PT</td>
                    <td align="center" valign="middle" style="width: 3%;">NB</td>
                    <td align="center" valign="middle" style="width: 3%;">SE</td>
                    <td align="center" valign="middle" style="width: 3%;">HF</td>
                    <td align="center" valign="middle" style="width: 3%;">TOTAL</td>
                    <td align="center" valign="middle" style="width: 3%;">PT</td>
                    <td align="center" valign="middle" style="width: 3%;">NB</td>
                    <td align="center" valign="middle" style="width: 3%;">SE</td>
                    <td align="center" valign="middle" style="width: 3%;">HF</td>
                    <td align="center" valign="middle" style="width: 3%;">TOTAL</td>
                    <td align="center" valign="middle" style="width: 3%;">PT</td>
                    <td align="center" valign="middle" style="width: 3%;">NB</td>
                    <td align="center" valign="middle" style="width: 3%;">SE</td>
                    <td align="center" valign="middle" style="width: 3%;">HF</td>
                    <td align="center" valign="middle" style="width: 3%;">TOTAL</td>
                    <td align="center" valign="middle" style="width: 3%;">PT</td>
                    <td align="center" valign="middle" style="width: 3%;">NB</td>
                    <td align="center" valign="middle" style="width: 3%;">SE</td>
                    <td align="center" valign="middle" style="width: 3%;">HF</td>
                    <td align="center" valign="middle" style="width: 3%;">TOTAL</td>
                    <td align="center" valign="middle" style="width: 3%;">PT</td>
                    <td align="center" valign="middle" style="width: 3%;">NB</td>
                    <td align="center" valign="middle" style="width: 3%;">SE</td>
                    <td align="center" valign="middle" style="width: 3%;">HF</td>
                    <td align="center" valign="middle" style="width: 3%;">TOTAL</td>
					 <td align="center" valign="middle" style="width: 5%;">SIGNATURE</td>


                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
                foreach ($stu_list as $p) {

                    $marks11 = $this->rc->get_marks_grade_for_consolidated_analysis_new($p->CLASS, $p->SEC, 1, $p->ADM_NO, 1);
                    $marks12 = $this->rc->get_marks_grade_for_consolidated_analysis_new($p->CLASS, $p->SEC, 1, $p->ADM_NO, 2);
                    $marks13 = $this->rc->get_marks_grade_for_consolidated_analysis_new($p->CLASS, $p->SEC, 1, $p->ADM_NO, 3);
                    $marks14 = $this->rc->get_marks_grade_for_consolidated_analysis_new($p->CLASS, $p->SEC, 1, $p->ADM_NO, 4);

                    $marks21 = $this->rc->get_marks_grade_for_consolidated_analysis_new($p->CLASS, $p->SEC, 2, $p->ADM_NO, 1);
                    $marks22 = $this->rc->get_marks_grade_for_consolidated_analysis_new($p->CLASS, $p->SEC, 2, $p->ADM_NO, 2);
                    $marks23 = $this->rc->get_marks_grade_for_consolidated_analysis_new($p->CLASS, $p->SEC, 2, $p->ADM_NO, 3);
                    $marks24 = $this->rc->get_marks_grade_for_consolidated_analysis_new($p->CLASS, $p->SEC, 2, $p->ADM_NO, 4);

                    $marks31 = $this->rc->get_marks_grade_for_consolidated_analysis_new($p->CLASS, $p->SEC, 3, $p->ADM_NO, 1);
                    $marks32 = $this->rc->get_marks_grade_for_consolidated_analysis_new($p->CLASS, $p->SEC, 3, $p->ADM_NO, 2);
                    $marks33 = $this->rc->get_marks_grade_for_consolidated_analysis_new($p->CLASS, $p->SEC, 3, $p->ADM_NO, 3);
                    $marks34 = $this->rc->get_marks_grade_for_consolidated_analysis_new($p->CLASS, $p->SEC, 3, $p->ADM_NO, 4);

                    $marks91 = $this->rc->get_marks_grade_for_consolidated_analysis_new($p->CLASS, $p->SEC, 9, $p->ADM_NO, 1);
                    $marks92 = $this->rc->get_marks_grade_for_consolidated_analysis_new($p->CLASS, $p->SEC, 9, $p->ADM_NO, 2);
                    $marks93 = $this->rc->get_marks_grade_for_consolidated_analysis_new($p->CLASS, $p->SEC, 9, $p->ADM_NO, 3);
                    $marks94 = $this->rc->get_marks_grade_for_consolidated_analysis_new($p->CLASS, $p->SEC, 9, $p->ADM_NO, 4);

                    $marks81 = $this->rc->get_marks_grade_for_consolidated_analysis_new($p->CLASS, $p->SEC, 12, $p->ADM_NO, 1);
                    $marks82 = $this->rc->get_marks_grade_for_consolidated_analysis_new($p->CLASS, $p->SEC, 12, $p->ADM_NO, 2);
                    $marks83 = $this->rc->get_marks_grade_for_consolidated_analysis_new($p->CLASS, $p->SEC, 12, $p->ADM_NO, 3);
                    $marks84 = $this->rc->get_marks_grade_for_consolidated_analysis_new($p->CLASS, $p->SEC, 12, $p->ADM_NO, 4);

                ?>

                    <tr>
                        <td align="center"><?php echo $i; ?></td>
                        <td>&nbsp;<?php echo $p->ADM_NO; ?></td>
                        <td>&nbsp;<?php echo $p->FIRST_NM; ?></td>
                        <td align="center"><?php echo $marks11->M2; ?></td>
                        <td align="center"><?php echo $marks12->M2; ?></td>
                        <td align="center"><?php echo $marks13->M2; ?></td>
                        <td align="center"><?php echo $marks14->M2; ?></td>
                        <td align="center"><?php echo ($marks11->M3 + $marks12->M3 + $marks13->M3 + $marks14->M3); ?></td>
                        <td align="center"><?php echo $marks21->M2; ?></td>
                        <td align="center"><?php echo $marks22->M2; ?></td>
                        <td align="center"><?php echo $marks23->M2; ?></td>
                        <td align="center"><?php echo $marks24->M2; ?></td>
                        <td align="center"><?php echo ($marks21->M3 + $marks22->M3 + $marks23->M3 + $marks24->M3); ?></td>
                        <td align="center"><?php echo $marks31->M2; ?></td>
                        <td align="center"><?php echo $marks32->M2; ?></td>
                        <td align="center"><?php echo $marks33->M2; ?></td>
                        <td align="center"><?php echo $marks34->M2; ?></td>
                        <td align="center"><?php echo ($marks31->M3 + $marks32->M3 + $marks33->M3 + $marks34->M3); ?></td>
                        <td align="center"><?php echo $marks91->M2; ?></td>
                        <td align="center"><?php echo $marks92->M2; ?></td>
                        <td align="center"><?php echo $marks93->M2; ?></td>
                        <td align="center"><?php echo $marks94->M2; ?></td>
                        <td align="center"><?php echo ($marks91->M3 + $marks92->M3 + $marks93->M3 + $marks94->M3); ?></td>
                        <td align="center"><?php echo $marks81->M2; ?></td>
                        <td align="center"><?php echo $marks82->M2; ?></td>
                        <td align="center"><?php echo $marks83->M2; ?></td>
                        <td align="center"><?php echo $marks84->M2; ?></td>
                        <td align="center"><?php echo ($marks81->M3 + $marks82->M3 + $marks83->M3 + $marks84->M3); ?></td>
						<td align="center"></td>
                    </tr>

                <?php $i++;
                }    ?>

            </tbody>
        </table>

    </div>
</div><br />

<div class="clearfix"></div>



<script>
    $(document).ready(function() {
    $('#example').DataTable( {
		scrollX: true,
        dom: 'Bfrtip',
        buttons: [
             'csv', 'excel'
        ]
    } );
} );
</script>