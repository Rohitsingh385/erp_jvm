

<style>
	label {
		font-size: 12px;
		font-weight: bold !important;
	}

	table {
		padding-right: 20px;
	}

	button.dt-button,
	div.dt-button,
	a.dt-button {
		line-height: 0.66em;
	}

	.dataTables_wrapper .dataTables_paginate .paginate_button.current,
	.dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
		line-height: 0.66em;
	}

	.table>thead>tr>th,
	.table>tbody>tr>th,
	.table>tfoot>tr>th,
	.table>thead>tr>td,
	.table>tbody>tr>td,
	.table>tfoot>tr>td {
		white-space: nowrap !important;
	}
</style>

<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="index.html">Book Master</a> <i class="fa fa-angle-right"></i></li>
</ol>

<div style="padding-top:20px; padding-left: 25px; background-color: white; border-top:3px solid #337ab7;">
	<div class='row'>
		<div class='col-sm-12'>
			<a href='<?php echo base_url('library/BookMaster/saveBookMaster'); ?>' class='btn btn-success'>Add New</a>
		</div>
	</div><br />

	<div class='row'>
		<div class='col-sm-12' style='padding-right:20px;'>
			<div class='table-responsive'>
				<table class='table' id='example'>
					<thead>
						<tr>
							<th style='background:#337ab7; color:#fff !important;'>Sl. No.</th>
							<th style='background:#337ab7; color:#fff !important;'>Accession No.</th>
							<th style='background:#337ab7; color:#fff !important;'>Book Name</th>
							<th style='background:#337ab7; color:#fff !important;'>Author</th>
							<th style='background:#337ab7; color:#fff !important;'>Publisher</th>
							<th style='background:#337ab7; color:#fff !important;'>Edition</th>
							<th style='background:#337ab7; color:#fff !important;'>Action</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div><br />
</div><br />

<script>
	$(".alert").fadeOut(3000);

	function rackMasterEdit(rack_id, rack_nm, rack_from, rack_to, rack_desc) {
		$.post("<?php echo base_url('library/RackMaster/edit'); ?>", {
			rack_id: rack_id,
			rack_nm: rack_nm,
			rack_from: rack_from,
			rack_to: rack_to,
			rack_desc: rack_desc
		}, function(data) {
			$("#load").html(data);
		});
	}
</script>

<script>
	$(document).ready(function() {
		var table = $('#example').DataTable({
			"processing": true,
			"serverSide": true,			
			"ajax": {
				"url": "<?php echo base_url('library/BookMaster/api_BookMaster'); ?>",
				"method": "POST",
			},
			"columns": [
				{
					"data": "id"
				},
				{
					"data": "accno"
				},
				{
					"data": "BNAME"
				},
				{
					"data": "AUTHOR"
				},
				{
					"data": "PUBLISHER"
				},
				{
					"data": "EDITION"
				},
				{
                    "data": "action",
                    orderable: false
                }
			]
		});
	});
</script>