 	  <table id="example5" class="table table-striped">
			<thead>
			<tr>
			  <th><strong>Name</strong></th>
			  <th><strong>DOB</strong></th>
			  <th><strong>Father's Name</strong></th>
			  <th><strong>Admission No.</strong></th>
			  <th><strong>Mobile</strong></th>
			  <th><strong>Status</strong></th>
			  <th><strong>Action</strong></th>
			</tr>
			</thead>
			<tbody>
			<?php
				foreach($ReportData as $key => $val){
					?>
						<tr>
							<td><i class="	fa fa-user-o"></i> <?php echo $val['name']; ?></td>
							<td><?php echo date('d-M-y',strtotime($val['dob'])); ?></td>
							<td><?php echo $val['fname']; ?></td>
							<td><?php echo $val['admission_no']; ?></td>
							<td><?php echo $val['mobile']; ?></td>
							<td>
								<?php
									if($val['verify'] == 0){
								?>
								<span class="text-danger">PENDING</span>
								<?php } else{ ?>
								<span class="text-success">VERIFIED</span>
								<?php }?>
								
							</td>
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