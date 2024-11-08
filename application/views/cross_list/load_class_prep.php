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
		<th>Reg No.</th>
		<th>Father's Name</th>
		<th>Mother's Name</th>
		<th>Term</th>
		<th>English Written</th>
		<th>English Conversation</th>
		<th>English Oral</th>
		<th>Mathematics Written</th>
		<th>Mathematics Oral</th>
		<th>Hindi Written</th>
		<th>Hindi Conversation</th>
		<th>Hindi Oral</th>
		<th>Drawing</th>
		<th>Social & Moral Achievement Cleanliness</th>
		<th>Social & Moral Achievement Punctuality</th>
		<th>Social & Moral Achievement Discipline</th>
		<th>Social & Moral Achievement Creativity</th>
		<th>Social & Moral Achievement Class-work</th>
		<th>Social & Moral Achievement Home-work</th>
		<th>Specific Participation</th>
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
						<td><?php echo $val['ROLL_NO']; ?></td>
						<td><?php echo $val['REGNO']; ?></td>
						<td><?php echo $val['FNAME']; ?></td>
						<td><?php echo $val['MNAME']; ?></td>
						<td>Term 1</td>
						<td><?php echo $val['S1_T1_WR']; ?></td>
						<td><?php echo $val['S1_T1_CON']; ?></td>
						<td><?php echo $val['S1_T1_ORAL']; ?></td>
						<td><?php echo $val['S2_T1_WR']; ?></td>
						<td><?php echo $val['S2_T1_ORAL']; ?></td>
						<td><?php echo $val['S3_T1_WR']; ?></td>
						<td><?php echo $val['S3_T1_CON']; ?></td>
						<td><?php echo $val['S3_T1_ORAL']; ?></td>
						<td><?php echo $val['S4_T1_GR']; ?></td>
						<td><?php echo $val['S5_T1_CLE']; ?></td>
						<td><?php echo $val['S5_T1_PUN']; ?></td>
						<td><?php echo $val['S5_T1_DIS']; ?></td>
						<td><?php echo $val['S5_T1_CRE']; ?></td>
						<td><?php echo $val['S5_T1_CW']; ?></td>
						<td><?php echo $val['S5_T1_HW']; ?></td>
						<td><?php echo $val['SP_PART']; ?></td>
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
						<td><?php echo $val['S1_T1_WR']; ?></td>
						<td><?php echo $val['S1_T2_CON']; ?></td>
						<td><?php echo $val['S1_T2_ORAL']; ?></td>
						<td><?php echo $val['S2_T2_WR']; ?></td>
						<td><?php echo $val['S2_T2_ORAL']; ?></td>
						<td><?php echo $val['S3_T2_WR']; ?></td>
						<td><?php echo $val['S3_T2_CON']; ?></td>
						<td><?php echo $val['S3_T2_ORAL']; ?></td>
						<td><?php echo $val['S4_T2_GR']; ?></td>
						<td><?php echo $val['S5_T2_CLE']; ?></td>
						<td><?php echo $val['S5_T2_PUN']; ?></td>
						<td><?php echo $val['S5_T2_DIS']; ?></td>
						<td><?php echo $val['S5_T2_CRE']; ?></td>
						<td><?php echo $val['S5_T2_CW']; ?></td>
						<td><?php echo $val['S5_T2_HW']; ?></td>
						<td></td>
						<td><?php echo $val['T2_REMARKS']; ?></td>
						<td><?php echo $val['T2_DP'].'/'.$val['T2_TDAYS']; ?></td>
						<td></td>
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