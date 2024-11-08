<style>
	html *
{
	font-size: 11px !important;

   color: #000 !important;
   font-family: Arial !important;
}
</style>
<table style="width:100%"> 
	<tr>
		<td><center><img src="assets/school_logo/cbse_logo.jpg" style="margin-left:5%; width:83px;"></center></td>
		<td><center><h1><span style="color:#02933e;font-size:24px !important;">TENDER HEART SCHOOL</span></h1>TUPUDANA, RANCHI<br/>Session- ( 2023-2024 )<br />CROSSLIST REPORT OF <?php echo $classnm[0]->CLASS_NM.'-'.$secnm[0]->SECTION_NAME; ?></center></td>
		<td><center><img src="assets/school_logo/common_logo.png" style="margin-left:5%; width:83px;"></center></td>
	</tr>
</table>
<table style='font-size:11px;  width:100%' border='1' cellspacing='0'>
	<thead>
	<tr>
      <th align="center" valign="middle" scope="col">&nbsp;</th>
      <th colspan="2" align="left">STU PROFILE</th>
      <th colspan="5" align="center" valign="middle" scope="col">ENGLISH</th>
      <th colspan="5" align="center" valign="middle" scope="col">HINDI</th>
      <th colspan="5" align="center" valign="middle" scope="col">MATHEMATICS</th>
      <th colspan="5" align="center" valign="middle" scope="col">EVS</th>
      <th colspan="5" align="center" valign="middle" scope="col">COMP</th>
      <th colspan="5" align="center" valign="middle" scope="col">GK<br></th>
		<th colspan="1"><br></th>
    </tr>
    <tr>
      <td align="center" valign="middle" style="width: 3%;">SL. NO.</td>
      
      <td align="left" valign="middle" style="width: 5%;" >ADM. NO.</td>
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
      <td align="center" valign="middle" style="width: 3%;">PT</td>
      <td align="center" valign="middle" style="width: 3%;">NB</td>
      <td align="center" valign="middle" style="width: 3%;">SE</td>
      <td align="center" valign="middle" style="width: 3%;">HF</td>
      <td align="center" valign="middle" style="width: 3%;">TOTAL</td>
		 <td align="center" valign="middle" style="width: 5%;"></td>


    </tr>
	</thead>
	<tbody> 
		<?php $i=1;
				foreach($stu_list as $p)
				{

						$marks11=$this->rc->get_marks_grade_for_consolidated_analysis_new($p->CLASS, $p->SEC,1,$p->ADM_NO,1);
						$marks12=$this->rc->get_marks_grade_for_consolidated_analysis_new($p->CLASS, $p->SEC,1,$p->ADM_NO,2);
						$marks13=$this->rc->get_marks_grade_for_consolidated_analysis_new($p->CLASS, $p->SEC,1,$p->ADM_NO,3);
						$marks14=$this->rc->get_marks_grade_for_consolidated_analysis_new($p->CLASS, $p->SEC,1,$p->ADM_NO,4);

						$marks21=$this->rc->get_marks_grade_for_consolidated_analysis_new($p->CLASS, $p->SEC,2,$p->ADM_NO,1);
						$marks22=$this->rc->get_marks_grade_for_consolidated_analysis_new($p->CLASS, $p->SEC,2,$p->ADM_NO,2);
						$marks23=$this->rc->get_marks_grade_for_consolidated_analysis_new($p->CLASS, $p->SEC,2,$p->ADM_NO,3);
						$marks24=$this->rc->get_marks_grade_for_consolidated_analysis_new($p->CLASS, $p->SEC,2,$p->ADM_NO,4);

						$marks31=$this->rc->get_marks_grade_for_consolidated_analysis_new($p->CLASS, $p->SEC,3,$p->ADM_NO,1);
						$marks32=$this->rc->get_marks_grade_for_consolidated_analysis_new($p->CLASS, $p->SEC,3,$p->ADM_NO,2);
						$marks33=$this->rc->get_marks_grade_for_consolidated_analysis_new($p->CLASS, $p->SEC,3,$p->ADM_NO,3);
						$marks34=$this->rc->get_marks_grade_for_consolidated_analysis_new($p->CLASS, $p->SEC,3,$p->ADM_NO,4);

						$marks91=$this->rc->get_marks_grade_for_consolidated_analysis_new($p->CLASS, $p->SEC,9,$p->ADM_NO,1);
						$marks92=$this->rc->get_marks_grade_for_consolidated_analysis_new($p->CLASS, $p->SEC,9,$p->ADM_NO,2);
						$marks93=$this->rc->get_marks_grade_for_consolidated_analysis_new($p->CLASS, $p->SEC,9,$p->ADM_NO,3);
						$marks94=$this->rc->get_marks_grade_for_consolidated_analysis_new($p->CLASS, $p->SEC,9,$p->ADM_NO,4);

						$marks71=$this->rc->get_marks_grade_for_consolidated_analysis_new($p->CLASS, $p->SEC,10,$p->ADM_NO,1);
						$marks72=$this->rc->get_marks_grade_for_consolidated_analysis_new($p->CLASS, $p->SEC,10,$p->ADM_NO,2);
						$marks73=$this->rc->get_marks_grade_for_consolidated_analysis_new($p->CLASS, $p->SEC,10,$p->ADM_NO,3);
						$marks74=$this->rc->get_marks_grade_for_consolidated_analysis_new($p->CLASS, $p->SEC,10,$p->ADM_NO,4);

						$marks81=$this->rc->get_marks_grade_for_consolidated_analysis_new($p->CLASS, $p->SEC,12,$p->ADM_NO,1);
						$marks82=$this->rc->get_marks_grade_for_consolidated_analysis_new($p->CLASS, $p->SEC,12,$p->ADM_NO,2);
						$marks83=$this->rc->get_marks_grade_for_consolidated_analysis_new($p->CLASS, $p->SEC,12,$p->ADM_NO,3);
						$marks84=$this->rc->get_marks_grade_for_consolidated_analysis_new($p->CLASS, $p->SEC,12,$p->ADM_NO,4);
							
					?>
			
		<tr>
		<td align="center"><?php echo $i;?></td>
			<td>&nbsp;<?php echo $p->ADM_NO;?></td>
			<td>&nbsp;<?php echo $p->FIRST_NM;?></td>
			<td align="center"><?php echo $marks11->M2;?></td>
			<td align="center"><?php echo $marks12->M2;?></td>
			<td align="center"><?php echo $marks13->M2;?></td>
			<td align="center"><?php echo $marks14->M2;?></td>
            <td align="center"><?php echo ($marks11->M3+$marks12->M3+$marks13->M3+$marks14->M3); ?></td>
			<td align="center"><?php echo $marks21->M2;?></td>
			<td align="center"><?php echo $marks22->M2;?></td>
			<td align="center"><?php echo $marks23->M2;?></td>
			<td align="center"><?php echo $marks24->M2;?></td>
            <td align="center"><?php echo ($marks21->M3+$marks22->M3+$marks23->M3+$marks24->M3); ?></td>
			<td align="center"><?php echo $marks31->M2;?></td>
			<td align="center"><?php echo $marks32->M2;?></td>
			<td align="center"><?php echo $marks33->M2;?></td>
			<td align="center"><?php echo $marks34->M2;?></td>
            <td align="center"><?php echo ($marks31->M3+$marks32->M3+$marks33->M3+$marks34->M3); ?></td>
			<td align="center"><?php echo $marks91->M2;?></td>
			<td align="center"><?php echo $marks92->M2;?></td>
			<td align="center"><?php echo $marks93->M2;?></td>
			<td align="center"><?php echo $marks94->M2;?></td>
            <td align="center"><?php echo ($marks91->M3+$marks92->M3+$marks93->M3+$marks94->M3); ?></td>
			<td align="center"><?php echo $marks71->M2;?></td>
			<td align="center"><?php echo $marks72->M2;?></td>
			<td align="center"><?php echo $marks73->M2;?></td>
			<td align="center"><?php echo $marks74->M2;?></td>
            <td align="center"><?php echo ($marks71->M3+$marks72->M3+$marks73->M3+$marks74->M3); ?></td>
			<td align="center"><?php echo $marks81->M2;?></td>
			<td align="center"><?php echo $marks82->M2;?></td>
			<td align="center"><?php echo $marks83->M2;?></td>
			<td align="center"><?php echo $marks84->M2;?></td>
            <td align="center"><?php echo ($marks81->M3+$marks82->M3+$marks83->M3+$marks84->M3); ?></td>
			<td align="center"></td>
			
    </tr>
					
			<?php $i++;
			 
			}	?>
		
	</tbody>
</table>
