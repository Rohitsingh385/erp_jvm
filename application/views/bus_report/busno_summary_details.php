<style>
.table > thead > tr > th,
.table > tbody > tr > th,
.table > tfoot > tr > th,
.table > thead > tr > td,
.table > tbody > tr > td,
.table > tfoot > tr > td {
    white-space: nowrap !important;
  }
</style>
<form method="post" action="<?php echo base_url('Bus_report/busno_summary_pdf'); ?>" target="_blank">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-lg-12">
				
				<button class="btn pull-right"><i class="fa fa-file-pdf-o"></i> Download</button>
		</div>
	</div>
</form><br />
<table class='table table-bordered' id='example'>
	<thead>
		<tr>
			<th>Sl. No.</th>
			<th>Bus No.</th>
			<th>Total Students</th>
			<th>Total Boys</th>
			<th>Total Girls</th>
		</tr>
	</thead>
	<tbody>
		
		<?php
		$grand_tot_stu=0;
		$grand_tot_boys=0;
		$grand_tot_girls=0;
			$i=1;
			foreach($data as $key=>$value){
				  
				  $grand_tot_stu=$grand_tot_stu+$value->TOTAL;
				  $grand_tot_boys=$grand_tot_boys+$value->BOYS;
				  $grand_tot_girls=$grand_tot_girls+$value->GIRLS;
				?>
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $value->BUS_NO; ?></td>
					<td><?php echo $value->TOTAL; ?></td>
					<td><?php echo $value->BOYS; ?></td>
					<td><?php echo $value->GIRLS; ?></td>
				</tr>
				<?php
				$i++;
			}
		?>
	</tbody>
	<tfoot>
            <tr>
                <td></td>
                 <td><b style="font-size:16px;color:red;font-weight: 900;">GRAND TOTAL</b></td>
                <td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_stu;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_boys;?></b></td>
				<td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot_girls;?></b></td>
            </tr>
        </tfoot>
</table>
<script type="text/javascript">
$(document).ready(function() {
$("#msg").fadeOut(8000);
$('#example').DataTable({
	dom: 'Bfrtip',
	buttons: [
		{
			extend: 'excelHtml5',
			title: 'Bus No. Summary Report',
		},
	]
});
});

</script>