
<div class='row'>
	<div class='col-md-12 col-xl-12 col-sm-12'>
		<div style='overflow:auto;'>
			<table id='example'>
				<thead>
					<tr>
						<th style='color:white!important;'>S.NO</th>
						<th style='color:white!important;'>Receipt Number</th>
						<th style='color:white!important;'>Receipt Date</th>
						<th style='color:white!important;'>Student Name</th>
						<th style='color:white!important;'>Adm No</th>
						<th style='color:white!important;'>Class/Sec</th>
						<th style='color:white!important;'>Roll No</th>
						<th style='color:white!important; width:30%!important;'>Fee For</th>
						<th style='color:white!important;'>Total Amount</th>
					<th style='color:white!important;'>Payment Mode</th>
						<th style='color:white!important;'>Transaction ID</th>
					</tr>
				</thead>
				<tbody>
					<?php
						
							$i=1;
							$total_g=0;
							foreach($data1 as $data_type)
							{
								
								$total_g +=$data_type->TOTAL;
								?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $data_type->RECT_NO; ?></td>
									<td><?php echo date('d-M-Y',strtotime($data_type->RECT_DATE)); ?></td>
									<td><?php echo $data_type->STU_NAME; ?></td>
									<td><?php echo $data_type->ADM_NO; ?></td>
									<td><?php echo $data_type->CLASS."/".$data_type->SEC; ?></td>
									<td><?php echo $data_type->ROLL_NO; ?></td>
									<td style='width:50%;'><?php echo $data_type->PERIOD; ?></td>
									<td><?php echo $data_type->TOTAL; ?></td>
									<td><?php echo $data_type->Payment_Mode; ?></td>
									<td><?php echo $data_type->CHQ_NO; ?></td>
									
								</tr>
								<?php
								$i++;
							}
						
					?>
						
				</tbody>
				<tr style='background-color:#005c99;'>
								
									<td colspan='9'><b style='float:right;color:white'>TOTAL FEE</b></td>
									<td colspan='2'><b  style='color:white;'><?php echo $total_g;?></b></td>
									
								</tr><tfooter>
				</tfooter>
			</table>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
    $('#example').DataTable({
        dom: 'Bfrtip',
        buttons: [
			/* {
                extend: 'copyHtml5',
				title: 'Daily Collection Reports',
               
            }, */
			{
                extend: 'excelHtml5',
				title: 'Daily Collection Reports',
                
            },
			/* {
                extend: 'csvHtml5',
				title: 'Daily Collection Reports',
                
            }, */
			/* {
                extend: 'pdfHtml5',
				title: 'Daily Collection Reports',
                
            }, */
        ]
    });
 });
</script>