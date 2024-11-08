<?php
if($term == 1){
	$trm='Term-1';
}
else{
	$trm='Term-2';
}
?>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.html">Crosslist Report</a> <i class="fa fa-angle-right"></i></li>
</ol>
<!--four-grids here-->
<div style="padding: 10px; background-color: white; border-top:3px solid #337ab7;" >
    <div class="row">
        <?php
        ?>
        <table style='font-size:11px;  width:100%' border='1' cellspacing='0' id="example">
            <thead>
                <tr>
                    <th align="center" valign="middle" scope="col">&nbsp;</th>
                    <th colspan="3" align="left">STU PROFILE</th>
                    <?php

                    foreach ($subject_list as $key => $sub) {
                        if ($term == 1){
					if ($sub->subject_code != 15 && $sub->subject_code != 7 &&  $sub->subject_code != 27) { ?>
						<th colspan="4" align="center" valign="middle" scope="col"><?php echo $sub->subj_nm; ?></th>
						<?php
					} else { ?>
						<th colspan="3" align="center" valign="middle" scope="col"><?php echo $sub->subj_nm; ?></th>
					<?php } 
				}else{
					if ($sub->subject_code != 15 && $sub->subject_code != 7) { ?>
						<th colspan="4" align="center" valign="middle" scope="col"><?php echo $sub->subj_nm; ?></th>
						<?php
					} else { ?>
						<th colspan="3" align="center" valign="middle" scope="col"><?php echo $sub->subj_nm; ?></th>
					<?php } 
				}
					
			 }
			?>


                </tr>
                <tr>
                    <td align="center" valign="middle" style="width: 3%;">SL. NO.</td>

                    <td align="left" valign="middle" style="width: 5%;">ADM. NO.</td>
                    <td align="left" style="width: 10%;">STU. NAME.</td>
                    <td align="left" style="width: 10%;">GENDER</td>

                    <?php
                    foreach ($subject_list as $key => $sub) { ?>
                        <td align="center" valign="middle" style="width: 3%;">PT</td>
                        <?php
if($term == 1){
					if ($sub->subject_code != 15 && $sub->subject_code != 7 && $sub->subject_code != 27) { ?>
					<td align="center" valign="middle" style="width: 3%;">RT</td>
				<?php	} 
				}else{
					if ($sub->subject_code != 15 && $sub->subject_code != 7) { ?>
					<td align="center" valign="middle" style="width: 3%;">RT</td>
				<?php	} 
				}?>
                        <td align="center" valign="middle" style="width: 3%;">TE</td>
                        <td align="center" valign="middle" style="width: 3%;">TOTAL</td>
                    <?php
                    } ?>

                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
                foreach ($stu_list as $p) { ?>
                    <tr>
                        <td align="center"><?php echo $i; ?></td>
                        <td>&nbsp;<?php echo $p->ADM_NO; ?></td>
                        <td>&nbsp;<?php echo $p->FIRST_NM; ?></td>
                        <td>&nbsp;<?php echo $p->GENDER; ?></td>
						<?php
                        if($term == 1){
					foreach ($subject_list as $key => $sub) {
						$marks_pt = $this->rc->get_marks_grade_for_consolidated_analysis_new_iii($p->CLASS, $p->SEC, $sub->subject_code, $p->ADM_NO, 1,$trm);
						$marks_rt = $this->rc->get_marks_grade_for_consolidated_analysis_new_iii($p->CLASS, $p->SEC, $sub->subject_code, $p->ADM_NO, 12,$trm);
						$marks_hf = $this->rc->get_marks_grade_for_consolidated_analysis_new_iii($p->CLASS, $p->SEC, $sub->subject_code, $p->ADM_NO, 4,$trm);
					?>
						<td align="center"><?php echo ($marks_pt->M2 =='AB' || $marks_pt->M2 =='' || $marks_pt->M2 =='-')?$marks_pt->M2:(($sub->subject_code != 15)?round($marks_pt->M2,0):round(($marks_pt->M3)*2,0)); ?></td>
						<?php if ($sub->subject_code != 15 && $sub->subject_code != 7 && $sub->subject_code != 27) { ?>
							<td align="center"><?php echo ($marks_rt->M2 =='AB' || $marks_rt->M2 =='' || $marks_rt->M2 =='-')?$marks_rt->M2:round(($marks_rt->M2/2),0); ?></td>
						<?php	} ?>
						<td align="center"><?php echo ($marks_hf->M2 =='AB' || $marks_hf->M2 =='' || $marks_hf->M2 =='-')?$marks_hf->M2:(($sub->subject_code != 15)?round($marks_hf->M2,0):round(($marks_hf->M3)*2,0)); ?></td>
				
						<td align="center"><?php echo round(((($sub->subject_code != 15)?$marks_pt->M3:$marks_pt->M3*2) + ($marks_rt->M3/2) + (($sub->subject_code != 15)?$marks_hf->M3:$marks_hf->M3*2)),0); ?></td>
					<?php	}
				}else{
					foreach ($subject_list as $key => $sub) {
						$marks_pt = $this->rc->get_marks_grade_for_consolidated_analysis_new_iii($p->CLASS, $p->SEC, $sub->subject_code, $p->ADM_NO, 1,$trm);
						$marks_rt = $this->rc->get_marks_grade_for_consolidated_analysis_new_iii($p->CLASS, $p->SEC, $sub->subject_code, $p->ADM_NO, 12,$trm);
						$marks_hf = $this->rc->get_marks_grade_for_consolidated_analysis_new_iii($p->CLASS, $p->SEC, $sub->subject_code, $p->ADM_NO, 5,$trm);
					?>
						<td align="center"><?php echo ($marks_pt->M2 =='AB' || $marks_pt->M2 =='' || $marks_pt->M2 =='-')?$marks_pt->M2:round($marks_pt->M2,0); ?></td>
						<?php if ($sub->subject_code != 15 && $sub->subject_code != 7) { ?>
							<td align="center"><?php echo ($marks_rt->M2 =='AB' || $marks_rt->M2 =='' || $marks_rt->M2 =='-')?$marks_rt->M2:round($marks_rt->M2,0); ?></td>
						<?php	} ?>
						<td align="center"><?php echo ($marks_hf->M2 =='AB' || $marks_hf->M2 =='' || $marks_hf->M2 =='-')?$marks_hf->M2:round($marks_hf->M2,0); ?></td>
						<td align="center"><?php echo round(($marks_pt->M3 + $marks_rt->M3 + $marks_hf->M3),0); ?></td>
					<?php	}
				}

				
				?>
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
        $('#example').DataTable({
			scrollX: true,
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel'
            ]
        });
    });
</script>