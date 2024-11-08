
<style>
 button.dt-button, div.dt-button, a.dt-button {
	  padding:2px;
  }
  .dataTables_paginate .paginate_button.current {
	 padding:2px;  
  }
</style>
<table class="table table-bordered dataTablea table-striped">
  <thead style="background: #d2d6de;">
    <tr>
      <th style="background: #337ab7; color: white !important;" class="text-center">S. No</th>
      <th style="background: #337ab7; color: white !important;">Admission No</th>
      <th style="background: #337ab7; color: white !important;">Student Name</th>
      <th style="background: #337ab7; color: white !important;">Class/sec</th>
      <th style="background: #337ab7; color: white !important;">Stoppage</th>
      <th style="background: #337ab7; color: white !important;">Trip</th>
      <th style="background: #337ab7; color: white !important;">Prefrence</th>
      <th style="background: #337ab7; color: white !important;">Bus No</th>
      <th style="background: #337ab7; color: white !important;">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
		$i=1;
		foreach($busstoppagedetails as $key=>$value){
			?>
			<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $value->admno; ?></td>
					<td><?php echo $value->FIRST_NM;  ?></td>
					<td><?php echo $value->CLASS; ?>-<?php echo $value->SEC; ?> </td>
					<td><?php echo $value->STOPPAGE;  ?></td>
					<td><?php echo $value->Trip_Nm;  ?></td>
					<td><?php echo $value->Trip_Nm; ?></td>
					<td><?php echo $value->BusNo; ?></td>
					<td><?php if($value->preference_id==1){echo "Boys";}elseif($value->preference_id==2){echo "Girls";}elseif($value->preference_id==3){echo "Co.Ed";} ?></td>
					
				</tr>
			<?php
			$i++;
		}
	?>
  </tbody>
</table>  
<script> 
$( document ).ready(function() {
   $('.dataTablea').DataTable({
		dom: 'Bfrtip',
		ordering :false,
		buttons: [
			{
				extend: 'excelHtml5',
				title: 'Student Details',
			},
			{
				extend: 'pdfHtml5',
				title: 'Student Details',
			},
		]
	});
});

</script> 