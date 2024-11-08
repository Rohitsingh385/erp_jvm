
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.html">Fee Collection</a> <i class="fa fa-angle-right"></i></li>
</ol>
<style>
	.ui-datepicker-month, .ui-datepicker-year
	{
		padding : 0px;
	}
	.table,#thead,tr,td,th
    {
        text-align: center;
        color: #000!important;
    }
</style>
<div style="padding: 10px; background-color: white;  border-top:3px solid #5785c3;">
	<form id='form'>
		<div class='row'>
			<div class="col-md-4 form-group">
			
				<select name='collectiontype' id='collectiontype' class='form-control' style='display:none'>
					
					<option value='2'>Bank</option>
				</select>
			</div>
			<div class='col-md-4 form-group'>
		
				<select name='feecollectiontype' id='feecollectiontype' class='form-control' style='display:none'>
				
					<option value='All'>All Type of Collection</option>
					
				</select>
			</div>
			<div class='col-md-4 form-group'>
			
				<select class='form-control' name='collectioncounter' id='collectioncounter' style='display:none'>
					<option value='%'>All Counter</option>
				</select>
			</div>
		</div>
		<div class='row'>
			
			<div class="col-md-3 form-group">
				<label>Class</label>
				<select class="form-control" id="awt" name="awt">
					<option value="All">All</option>
					<?php foreach($class as $key){
							?>
									<option value="<?php echo $key->CLASS;?>"><?php echo $key->CLASS;?></option>
					<?php
							}?>
				</select>
			</div>
						<div class="col-md-3 form-group">
				<label>Section</label>
				<select class="form-control" id="SEC" name="SEC">
					<option value="All">All</option>
					<?php foreach($SEC as $key){
							?>
									<option value="<?php echo $key->SEC;?>"><?php echo $key->SEC;?></option>
					
					<?php
							}?>
				</select>
			</div>
			
			<div class="col-md-3 form-group">
				<label>Payment Type</label>
				<select class="form-control" id="p_type" name="p_type">
					<option value="All">All</option>
					<option value="PAID">PAID</option>
					<option value="UNPAID">UNPAID</option>
				</select>
			</div>
		</div>
		<div class="row">
			<center>
				<button class="btn btn-success">Display</button>
			</center>
		</div><br /><br />
	</form>
	<form style="display:none;" id='dreport' action='<?php echo base_url('Report/daily_report'); ?>' method='post'>
		<input type='hidden' name='ct1' id='ct1'>
		<input type='hidden' name='fct1' id='fct1'>
		<input type='hidden' name='cc1' id='cc1'>
		<input type='hidden' name='vt1' id='vt1'>
		<input type='hidden' name='sd1' id='sd1'>
		
	</form>
	<form style="display:none;" id='dmreport' action='<?php echo base_url('Report/monthly_report'); ?>' method='post'>
		<input type='hidden' name='ct2' id='ct2'>
		<input type='hidden' name='fct2' id='fct2'>
		<input type='hidden' name='cc2' id='cc2'>
		<input type='hidden' name='vt2' id='vt2'>
		<input type='hidden' name='sd2' id='sd2'>
		<input type='hidden' name='sdf2' id='sdf2'>
		
	</form>
	<div id='load_page'>
			
	</div>
</div><br />
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
<link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" />
<script>
	function dt(val)
	{
		if(val==1)
		{
			$('#datewise').show(1000);
		}
		else
		{
			$('#datewise').hide(1000);
		}
		if(val==2)
		{
			$('#monthwise').show(1000);
		}
		else
		{
			$('#monthwise').hide(1000);
		}
	}
	$("#form").on("submit", function (event) {
    event.preventDefault();
		var classs = $('#awt').val();
		var SEC = $('#SEC').val();
		var p_type = $('#p_type').val();
	
								$.ajax({
									url:"<?php echo base_url('Report/cmp_classwise'); ?>",
									type: "POST",
									data:{'class':classs,'SEC':SEC,'p_type':p_type},
									success:function(data)
									{
										$('#load_page').html(data);
										$('#load_page').show(1000);
										$('#dreport').show(1000);
										$('#dmreport').hide(1000);
									
									}
								});
					 });
		
</script>