<br />
 <table class="table table-bordered" id="example">
	<thead>
		<tr>
			<th>Sl. No.</th>
		
			<th>Adm. No.</th>
			<th>Student Name</th>
			<th>Class</th>
			<th>Section</th>
			<th>Father Name</th>
			<th>Phone No.</th>
	
			
		</tr>
	</thead>
	<tbody>
	<?php
		if($student){
			$i = 1;
			foreach($student as $data_key){
				?>
					<tr>
						<td><?php echo $i; ?></a></td>
					
						<td><?php echo $data_key->ADM_NO; ?></td>				
						<td><?php echo $data_key->FIRST_NM; ?></td>
							<td><?php echo $data_key->DISP_CLASS; ?></td>
							<td><?php echo $data_key->DISP_SEC; ?></td>
						<td><?php echo $data_key->FATHER_NM; ?></td>
						<td><?php echo $data_key->C_MOBILE; ?></td>
				
						
						
					</tr>
				<?php
				$i++;
			}
		}
	?>
	</tbody>
 </table>
</div>
<div class="inner-block"></div>
<script type="text/javascript">
$(document).ready(function() {
$("#msg").fadeOut(8000);
$('#example').DataTable({
	dom: 'Bfrtip',
	buttons: [
		{
			extend: 'excelHtml5',
			title: 'Award List',
		},
		{
			extend: 'csvHtml5',
			title: 'Award List',
		},
	]
});
});

</script>