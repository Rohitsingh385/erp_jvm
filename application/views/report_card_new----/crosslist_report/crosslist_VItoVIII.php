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

			foreach ($subject_list as $key => $sub) {
				if ($sub->subject_code == 15 || $sub->subject_code == 21) { ?>
					<th colspan="2" align="center" valign="middle" scope="col"><?php echo $sub->subj_nm . ' ' . $sub->subject_code; ?></th>
				<?php
				} elseif ($sub->subject_code == 106) { ?>
					<th colspan="3" align="center" valign="middle" scope="col"><?php echo $sub->subj_nm . ' ' . $sub->subject_code; ?></th>
				<?php } else { ?>
					<th colspan="4" align="center" valign="middle" scope="col"><?php echo $sub->subj_nm . ' ' . $sub->subject_code; ?></th>
			<?php }
			}
			?>

		</tr>
		<tr>
			<td align="center" valign="middle" style="width: 3%;">SL. NO.</td>

			<td align="left" valign="middle" style="width: 5%;">ADM. NO.</td>
			<td align="left" style="width: 10%;">STU. NAME.</td>
			<?php
			foreach ($subject_list as $key => $sub) {
				if ($sub->subject_code != 15 && $sub->subject_code != 21) { ?>
					<td align="center" valign="middle" style="width: 3%;">PT</td>
				<?php } 
				if ($sub->subject_code != 15 && $sub->subject_code != 21 && $sub->subject_code != 106) { ?>
					<td align="center" valign="middle" style="width: 3%;">RT</td>
				<?php	} ?>

				<td align="center" valign="middle" style="width: 3%;">HF</td>
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
				<?php
				foreach ($subject_list as $key => $sub) {
					$pt_marks= 0;
					$rt_marks= 0;
					$marks_pt = $this->rc->get_marks_grade_for_consolidated_analysis_new($p->CLASS, $p->SEC, $sub->subject_code, $p->ADM_NO, 1);
					$marks_rt1 = $this->rc->get_marks_grade_for_consolidated_analysis_new($p->CLASS, $p->SEC, $sub->subject_code, $p->ADM_NO, 12);
					$marks_rt2 = $this->rc->get_marks_grade_for_consolidated_analysis_new($p->CLASS, $p->SEC, $sub->subject_code, $p->ADM_NO, 13);
					$marks_hf = $this->rc->get_marks_grade_for_consolidated_analysis_new($p->CLASS, $p->SEC, $sub->subject_code, $p->ADM_NO, 4);

					if ($sub->subject_code != 15 && $sub->subject_code != 21 )
					{
						$pt_marks=round($marks_pt->M3 / 2,0);
					}
					if ($sub->subject_code != 106 && $sub->subject_code != 15 && $sub->subject_code != 21)
					{
						$rt_marks=round((($marks_rt1->M3 + $marks_rt1->M3)/40) * 10 , 0) ;
					}

				?>

					<?php if ($sub->subject_code != 15 && $sub->subject_code != 21) { ?>
						<td align="center"><?php echo $pt_marks; ?></td>
					<?php  } ?>

					<?php if ($sub->subject_code != 15 && $sub->subject_code != 21 && $sub->subject_code != 106) { ?>
						<td align="center"><?php echo $rt_marks; ?></td>
					<?php	} ?>

					<td align="center"><?php echo $marks_hf->M2; ?></td>
					<td align="center"><?php echo ($pt_marks + $rt_marks + $marks_hf->M3); ?></td>
				<?php	}
				?>
			</tr>

		<?php $i++;
		}	?>

	</tbody>
</table>