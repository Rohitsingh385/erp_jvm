<style>
	.table > thead > tr > th,
	.table > tbody > tr > th,
	.table > tfoot > tr > th,
	.table > thead > tr > td,
	.table > tbody > tr > td,
	.table > tfoot > tr > td {
		white-space: nowrap !important;
	  }
	  
	  .table thead tr th {
		  background:#337ab7;
		  color:#fff !important;
	  }
</style>
<div class='table-responsive'>
<table class='table' border='1' cellspacing='0' id='example'>
	<thead>
	<tr>
		<th>Student Name</th>
		<th>Roll No.</th>
		<th>Reg. No.</th>
		<th>Father's Name</th>
		<th>Mother's Name</th>
		<th>Term</th>
		<th>English Speaking Skills</th>
		<th>English Creative Writing</th>
		<th>English Project</th>
		<th>English Written Work</th>
		<th>English Grade</th>
		<th>English Highest Marks</th>
		<th>Hindi Speaking Skills</th>
		<th>Hindi Creative Writing</th>
		<th>Hindi Project</th>
		<th>Hindi Written Work</th>
		<th>Hindi Grade</th>
		<th>Hindi Highest Marks</th>
		<th>Mathematics Activity</th>
		<th>Mathematics Table</th>
		<th>Mathematics Written Work</th>
		<th>Mathematics Grade</th>
		<th>Mathematics Highest Marks</th>
		<th>Environmental Science Activity</th>
		<th>Environmental Science Written Work</th>
		<th>Environmental Science Grade</th>
		<th>Environmental Science Highest Marks</th>
		<th>General Knowledge Written Work </th>
		<th>General Knowledge Grade</th>
		<th>General Knowledge Highest Marks</th>
		<th>Computer Written Work </th>
		<th>Computer Grade</th>
		<th>Computer Highest Marks</th>
		<th>Discipline</th>
		<th>Height (cm)</th>
		<th>Weight (kg)</th>
		<th>Art & Craft</th>
		<th>Music</th>
		<th>Remarks</th>
		<th>Attendance</th>
		<th>Promoted Class</th>
	</tr>
	</thead>
	<tbody>
		<?php
			foreach($getData as $key => $val){
				?>
					<tr>
						<td><?php echo $val['STUDENT_NAME']; ?></td>
						<td><?php echo $val['ROLLNO']; ?></td>
						<td><?php echo $val['REGNO']; ?></td>
						<td><?php echo $val['FNAME']; ?></td>
						<td><?php echo $val['MNAME']; ?></td>
						<td>Term 1</td>
						<td><?php echo $val['S1_T1_SS']; ?></td>
						<td><?php echo $val['S1_T1_CW']; ?></td>
						<td><?php echo $val['S1_T1_PRJ']; ?></td>
						<td><?php echo $val['S1_T1_WW']; ?></td>
						<td><?php echo $val['S1_T1_GR']; ?></td>
						<td><?php echo $val['S1_T1_HM']; ?></td>
						<td><?php echo $val['S2_T1_SS']; ?></td>
						<td><?php echo $val['S2_T1_CW']; ?></td>
						<td><?php echo $val['S2_T1_PRJ']; ?></td>
						<td><?php echo $val['S2_T1_WW']; ?></td>
						<td><?php echo $val['S2_T1_GR']; ?></td>
						<td><?php echo $val['S2_T1_HM']; ?></td>
						<td><?php echo $val['S4_T1_ACT']; ?></td>
						<td><?php echo $val['S4_T1_TAB']; ?></td>
						<td><?php echo $val['S4_T1_WW']; ?></td>
						<td><?php echo $val['S4_T1_GR']; ?></td>
						<td><?php echo $val['S4_T1_HM']; ?></td>
						<td><?php echo $val['S5_T1_ACT']; ?></td>
						<td><?php echo $val['S5_T1_WW']; ?></td>
						<td><?php echo $val['S5_T1_GR']; ?></td>
						<td><?php echo $val['S5_T1_HM']; ?></td>
						<td><?php echo $val['S6_T1_WW']; ?></td>
						<td><?php echo $val['S6_T1_GR']; ?></td>
						<td><?php echo $val['S6_T1_HM']; ?></td>
						<td><?php echo $val['S7_T1_WW']; ?></td>
						<td><?php echo $val['S7_T1_GR']; ?></td>
						<td><?php echo $val['S7_T1_HM']; ?></td>
						<td><?php echo $val['S8_T1_DIS']; ?></td>
						<td><?php echo $val['S8_T1_HT']; ?></td>
						<td><?php echo $val['S8_T1_WT']; ?></td>
						<td><?php echo $val['S9_T1_GR']; ?></td>
						<td><?php echo $val['S10_T1_GR']; ?></td>
						<td><?php echo $val['REMARKS_MID']; ?></td>
						<td><?php echo $val['T1_DP'].'/'.$val['T1_TDAYS']; ?></td>
						<td><?php echo $val['PROMOTED_CLASS']; ?></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td>Term 2</td>
						<td><?php echo $val['S1_T2_SS']; ?></td>
						<td><?php echo $val['S1_T2_CW']; ?></td>
						<td><?php echo $val['S1_T2_PRJ']; ?></td>
						<td><?php echo $val['S1_T2_WW']; ?></td>
						<td><?php echo $val['S1_T2_GR']; ?></td>
						<td><?php echo $val['S1_T2_HM']; ?></td>
						<td><?php echo $val['S2_T2_SS']; ?></td>
						<td><?php echo $val['S2_T2_CW']; ?></td>
						<td><?php echo $val['S2_T2_PRJ']; ?></td>
						<td><?php echo $val['S2_T2_WW']; ?></td>
						<td><?php echo $val['S2_T2_GR']; ?></td>
						<td><?php echo $val['S2_T2_HM']; ?></td>
						<td><?php echo $val['S4_T2_ACT']; ?></td>
						<td><?php echo $val['S4_T2_TAB']; ?></td>
						<td><?php echo $val['S4_T2_WW']; ?></td>
						<td><?php echo $val['S4_T2_GR']; ?></td>
						<td><?php echo $val['S4_T2_HM']; ?></td>
						<td><?php echo $val['S5_T2_ACT']; ?></td>
						<td><?php echo $val['S5_T2_WW']; ?></td>
						<td><?php echo $val['S5_T2_GR']; ?></td>
						<td><?php echo $val['S5_T2_HM']; ?></td>
						<td><?php echo $val['S6_T2_WW']; ?></td>
						<td><?php echo $val['S6_T2_GR']; ?></td>
						<td><?php echo $val['S6_T2_HM']; ?></td>
						
						<td><?php echo $val['S7_T2_WW']; ?></td>
						<td><?php echo $val['S7_T2_GR']; ?></td>
						<td><?php echo $val['S7_T2_HM']; ?></td>
						
						<td><?php echo $val['S8_T2_DIS']; ?></td>
						<td><?php echo $val['S8_T2_HT']; ?></td>
						<td><?php echo $val['S8_T2_WT']; ?></td>
						<td><?php echo $val['S9_T2_GR']; ?></td>
						<td><?php echo $val['S10_T2_GR']; ?></td>
						<td><?php echo $val['REMARKS_ANNUAL']; ?></td>
						<td><?php echo $val['T2_DP'].'/'.$val['T2_TDAYS']; ?></td>
					</tr>
				<?php
			}
		?>
	</tbody>
</table>
</div>

<script>
	$('#example').DataTable({
		dom: 'Bfrtip',
		ordering :false,
		buttons: [
			{
				extend: 'excelHtml5',
				title: 'Student Details',
			}
		]
	});
</script>