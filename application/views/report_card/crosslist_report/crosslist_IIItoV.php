<?php
if($term == 1){
	$trm='Term-1';
}
else{
	$trm='Term-2';
}
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
				<h1><span style="color:#02933e;font-size:24px !important;">JAWAHAR VIDYA MANDIR</span></h1>Shyamali Colony, Doranda, Ranchi-834002<br />Session- ( 2024-2025 )<br />CROSSLIST REPORT OF <?php echo $classnm[0]->CLASS_NM . '-' . $secnm[0]->SECTION_NAME; ?>&nbsp;&nbsp;<?php if($term==1){ echo 'MID TERM'; }else{ echo 'END TERM'; } ?>
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
			<th colspan="3" align="left">STU PROFILE</th>
			<?php

			foreach ($subject_list as $key => $sub) {
				if ($term == 1){
					if ($sub->subject_code != 15 && $sub->subject_code != 7) { ?>
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
			<td align="left" style="width: 5%;">GENDER</td>
			<?php
			foreach ($subject_list as $key => $sub) { ?>
				<td align="center" valign="middle" style="width: 3%;">PT</td>
				<?php 
				if($term == 1){
					if ($sub->subject_code != 15 && $sub->subject_code != 7) { ?>
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
						<td align="center"><?php echo ($marks_pt->M2 =='AB' || $marks_pt->M2 =='' || $marks_pt->M2 =='-')?$marks_pt->M2:(($sub->subject_code != 15)?$marks_pt->M2:($marks_pt->M3*2)); ?></td>
				
						<?php if ($sub->subject_code != 15 && $sub->subject_code != 7) { ?>
							<td align="center"><?php echo ($marks_rt->M2 =='AB' || $marks_rt->M2 =='' || $marks_rt->M2 =='-')?$marks_rt->M2:($marks_rt->M2/2); ?></td>
						<?php	} ?>
				
						<td align="center"><?php echo ($marks_hf->M2 =='AB' || $marks_hf->M2 =='' || $marks_hf->M2 =='-')?$marks_hf->M2:(($sub->subject_code != 15)?$marks_hf->M2:($marks_hf->M3*2)); ?></td>
				
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
		}	?>

	</tbody>
</table>