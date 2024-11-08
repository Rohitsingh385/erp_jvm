<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
	.table>thead>tr>th,
	.table>tbody>tr>th,
	.table>tfoot>tr>th,
	.table>thead>tr>td,
	.table>tbody>tr>td,
	.table>tfoot>tr>td {
		white-space: nowrap !important;
	}

	@media (max-width: 768px) {

		.table th:nth-child(6),
		.table th:nth-child(7) {
			display: none;
		}
	}

	@media (max-width: 768px) {
		.select-wrapper {
			text-align: center;
		}

		.select-wrapper select {
			width: 100%;
			/* Make the select full width on small screens */
		}
	}
</style>
<!-- 
<form method="post" action="<?php echo base_url('Hostel_management/download_studentinformation'); ?>">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-lg-12">
			<input type="hidden" value="<?php echo $class; ?>" name="class">
			<input type="hidden" value="<?php echo $sec; ?>" name="sec">
			<button class="btn pull-right"><i class="fa fa-file-pdf-o"></i> Download</button>
		</div>
	</div>
</form><br /> -->

<form method="post" id="form" action="<?php echo base_url("Hostel_management/save_studentinformation") ?>">
	<div class="table-responsive">
		<table class="table" id="example">
			<thead>
				<tr>
					<th>Sl No.</th>
					<th>Class</th>
					<th>GEN</th>
					<th>OBC</th>
					<th>OTH</th>
					<th>SC</th>
					<th>ST</th>
					<th>Cat 6</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$i = 1;
				foreach ($data as $key => $value) {
				?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $value->DISP_CLASS; ?></td>
						<td><?php echo $value->CAT1; ?></td>
						<td><?php echo $value->CAT2; ?></td>
						<td><?php echo $value->CAT3; ?></td>
						<td><?php echo $value->CAT4; ?></td>
						<td><?php echo $value->CAT5; ?></td>
						<td><?php echo $value->CAT6; ?></td>
					</tr>
				<?php
					$i++;
				}
				?>
			</tbody>
		</table>
	</div>

	
</form>


<script type="text/javascript">

	
</script>