 <table id="example5" class="table table-striped">
	<thead>
		<tr>
			<th><strong>Name</strong></th>
			<th><strong>Admission No.</strong></th>
			<th><strong>Roll No.</strong></th>
			<th><strong>DOB</strong></th>
			<th><strong>Father's Name</strong></th>
			<th><strong>Mother's Name</strong></th>
			<th><strong>Class/Section</strong></th>
			<th><strong>Date of Admission</strong></th>
			<th><strong>Category</strong></th>
			<th><strong>Aadhaar Card No</strong></th>
			<th><strong>Only Child</strong></th>
			<th><strong>Minority</strong></th>
			<th><strong>Gender</strong></th>
			<th><strong>Subject</strong></th>
			<th><strong>Annual Income</strong></th>
			<th><strong>Email</strong></th>
			<th><strong>Mobile</strong></th>
			<th><strong>Status</strong></th>
			<th><strong>Action</strong></th>
		</tr>
	</thead>
	<tbody id='load'>
			<?php
				foreach($ReportData as $key => $val){
					?>
						<tr>
							<td><i class="	fa fa-user-o"></i> <?php echo $val['name']; ?></td>
							<td><?php echo $val['admission_no']; ?></td>
							<td><?php echo $val['roll']; ?></td>
							<td><?php echo date('d-M-Y',strtotime($val['dob'])); ?></td>
							<td><?php echo $val['fname']; ?></td>
							<td><?php echo $val['mname']; ?></td>
						    <td><?php echo $val['class']; ?>-<?php echo $val['sec_nm']; ?></td>
						    <td><?php echo date('d-M-Y',strtotime($val['adm_date'])); ?></td>
				 			<td><?php echo $val['category']; ?></td>
				 			<td><?php echo $val['aadhaar']; ?></td>
							<td><?php if($val['child']=='1'){ echo "YES";}else{echo "NO";} ?></td>
							<td><?php if($val['minority']=='1'){ echo "YES";}else{echo "NO";} ?></td>
							<td><?php if($val['sex']=='1'){ echo "MALE";}else{echo "FEMALE";} ?></td>
							<td><?php echo @$val['SUBJECT1']."<br />".@$val['SUBJECT2']."<br />".@$val['SUBJECT3']."<br />".@$val['SUBJECT4']."<br />".@$val['SUBJECT5']; ?></td>
							<td><?php echo $val['income']; ?></td>
							<td><?php echo $val['email']; ?></td>
							<!--end new list-->
							<td><?php echo $val['mobile']; ?></td>
							<td><?php if($val['verify'] == 0){?>
								<span class="text-danger">PENDING</span>
								<?php } else{ ?>
								<span class="text-success">VERIFIED</span>
								<?php }?></td>
							<td>
								<a href="<?php echo base_url('Cbse_verify_admin/cbse_verification/viewdata/'.$val['id']); ?>" class='btn btn-info btn-xs' title='EDIT' >
								  <i class="fa fa-edit" style="color:white"></i>
								</a>
								<?php
									if($val['verify'] == 1){
								?>
								<a href="<?php echo base_url('Cbse_verify_admin/cbse_verification/Print_user_profile/'.$val['id']); ?>" class='btn btn-danger btn-xs' title='PRINT'>
								  <i class="fa fa-cloud-download" style="color:white"></i> PRINT
								</a>
								<?php }  ?>
							</td>
						</tr>
					<?php
				}
			?>
	</tbody>
</table>


<script>
$(document).ready(function() {
		$('#example5').DataTable( {
			dom: 'Bfrtip',
			buttons: 
			[
				{
					extend: 'excel',
					text: 'EXCEL',
					title: 'from '+'<?php echo $start_date; ?> to <?php echo $end_date; ?>',
					className: 'btn btn-default',
					exportOptions: {
						columns: [0, 1, 2, 3, 4, 5]
					}
				},
				{
					extend: 'pdf',
					text: 'PDF',
					title: 'from '+'<?php echo $start_date; ?> to <?php echo $end_date; ?>',
					className: 'btn btn-default',
					exportOptions: {
						columns: [0, 1, 2, 3, 4, 5]
					}
				}
			]
		} );
	} );
</script>