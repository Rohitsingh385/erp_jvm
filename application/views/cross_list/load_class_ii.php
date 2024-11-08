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
		<th>English Reading Skills</th>
		<th>English Speaking Skills</th>
		<th>English Project</th>
		<th>English Total (100)</th>
		<th>English Grade</th>
		<th>Hindi Reading Skills</th>
		<th>Hindi Speaking Skills</th>
		<th>Hindi Project</th>
		<th>Hindi Total (100)</th>
		<th>Hindi Grade</th>
		<th>Mathematics Project</th>
		<th>Mathematics Table</th>
		<th>Mathematics Total (100)</th>
		<th>Mathematics Grade</th>
		<th>Health & Physical Education Project</th>
		<th>Health & Physical Education Total (100)</th>
		<th>Health & Physical Education Grade</th>
		<th>Games Enthusiasm</th>
		<th>Height (cm)</th>
		<th>Weight (kg)</th>
		<th>Art & Craft: Art</th>
		<th>Art & Craft: Music</th>
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
						<td><?php echo $val['S1_T1_RS']; ?></td>
						<td><?php echo $val['S1_T1_SPL']; ?></td>
						<td><?php echo $val['S1_T1_PRJ']; ?></td>
						<td><?php echo $val['S1_T1_100']; ?></td>
						<td><?php echo $val['S1_T1_GR']; ?></td>
						<td><?php echo $val['S2_T1_RS']; ?></td>
						<td><?php echo $val['S2_T1_SPL']; ?></td>
						<td><?php echo $val['S2_T1_PRJ']; ?></td>
						<td><?php echo $val['S2_T1_100']; ?></td>
						<td><?php echo $val['S2_T1_GR']; ?></td>
						<td><?php echo $val['S3_T1_PRJ']; ?></td>
						<td><?php echo $val['S3_T1_TBL']; ?></td>
						<td><?php echo $val['S3_T1_100']; ?></td>
						<td><?php echo $val['S3_T1_GR']; ?></td>
						<td><?php echo $val['S4_T1_PRJ']; ?></td>
						<td><?php echo $val['S4_T1_100']; ?></td>
						<td><?php echo $val['S4_T1_GR']; ?></td>
						<td><?php echo $val['S5_T1_ENT']; ?></td>
						<td><?php echo $val['S5_T1_HT']; ?></td>
						<td><?php echo $val['S5_T1_WT']; ?></td>
						<td><?php echo $val['S6_T1_ART']; ?></td>
						<td><?php echo $val['S7_T1_MUSIC']; ?></td>
						<td><?php echo $val['T1_REMARKS']; ?></td>
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
						<td><?php echo $val['S1_T2_RS']; ?></td>
						<td><?php echo $val['S1_T2_SPL']; ?></td>
						<td><?php echo $val['S1_T2_PRJ']; ?></td>
						<td><?php echo $val['S1_T2_100']; ?></td>
						<td><?php echo $val['S1_T2_GR']; ?></td>
						<td><?php echo $val['S2_T2_RS']; ?></td>
						<td><?php echo $val['S2_T2_SPL']; ?></td>
						<td><?php echo $val['S2_T2_PRJ']; ?></td>
						<td><?php echo $val['S2_T2_100']; ?></td>
						<td><?php echo $val['S2_T2_GR']; ?></td>
						<td><?php echo $val['S3_T2_PRJ']; ?></td>
						<td><?php echo $val['S3_T2_TBL']; ?></td>
						<td><?php echo $val['S3_T2_100']; ?></td>
						<td><?php echo $val['S3_T2_GR']; ?></td>
						<td><?php echo $val['S4_T2_PRJ']; ?></td>
						<td><?php echo $val['S4_T2_100']; ?></td>
						<td><?php echo $val['S4_T2_GR']; ?></td>
						<td><?php echo $val['S5_T2_ENT']; ?></td>
						<td><?php echo $val['S5_T2_HT']; ?></td>
						<td><?php echo $val['S5_T2_WT']; ?></td>
						<td><?php echo $val['S6_T2_ART']; ?></td>
						<td><?php echo $val['S7_T2_MUSIC']; ?></td>
						<td><?php echo $val['T2_REMARKS']; ?></td>
						<td><?php echo $val['T2_DP'].'/'.$val['T2_TDAYS']; ?></td>
						<td><?php echo $val['PROMOTED_CLASS']; ?></td>
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