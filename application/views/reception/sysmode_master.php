<style>
label{
	font-size:12px;
	font-weight: bold !important;
}
table{
	padding-right:20px;
}
button.dt-button, div.dt-button, a.dt-button {
	line-height:0.66em;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
	line-height:0.66em;
}
.table > thead > tr > th,
.table > tbody > tr > th,
.table > tfoot > tr > th,
.table > thead > tr > td,
.table > tbody > tr > td,
.table > tfoot > tr > td {
    white-space: nowrap !important;
 }
</style>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.html">Mode Type</a> <i class="fa fa-angle-right"></i></li>
</ol>

<div style="padding-top:20px; padding-left: 25px; background-color: white; border-top:3px solid #337ab7;">
	<div class='row'>
		<div class='col-sm-4'>
		    <?php
			  if($this->session->flashdata('success')){
				  ?>
				    <div class="alert alert-success">
					   <?php echo $this->session->flashdata('success'); ?>
					</div>
				  <?php
			  }
			?>
			<div id='load'>
			<form action="<?php echo base_url('reception/Sysmode_master/save_modetype'); ?>" method='post' autocomplete='off'>
			  <div class="form-group">
				<label>Entry Mode:</label>
				<input type="text" class="form-control" name="mode_type" id="mode_type" style='text-transform: uppercase;' required maxlength="20" onkeypress='return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode == 32 || event.charCode == 46 || event.charCode == 47' onkeyup="dupval(this.value)">
				<label id='ss' style='color:red;'></label>
			  </div>
			  <button type="submit" class="btn btn-success">Save</button>
			</form>
			</div>
		</div>
		<div class='col-sm-8' style='padding-right:20px;'>
		    <div class='table-responsive'>
			<table class='table' id='example'>
			<thead>
				<tr>
					<th style='background:#337ab7; color:#fff !important;'>Sl no.</th>
					<th style='background:#337ab7; color:#fff !important;'>Mode Type</th>
					<th style='background:#337ab7; color:#fff !important;'>Action</th>
				</tr>
			</thead>	
			<tbody>	
				<?php
				$i = 1;
					foreach($modetype as $key => $val){
						?>
							<tr>
								<td><?php echo $i; ?></td>
								<td style='text-transform: uppercase;'><?php echo $val->mode_type; ?></td>
								<td><a href='#' onclick="masterEdit(<?php echo $val->id; ?>,'<?php echo $val->mode_type; ?>')"><i class="fa fa-pencil-square" style=' font-size:20px; color:green'></i></a></td>
							</tr>
						<?php
						$i++;
					}
				?>
			</tbody>	
			</table>
			</div>
		</div>
	</div><br />
</div><br />

<script>
$(".alert").fadeOut(3000);
$('#example').DataTable({
        dom: 'Bfrtip',
        buttons: [
			/* {
                extend: 'copyHtml5',
				title: 'Daily Collection Reports',
               
            }, */
			{
                extend: 'excelHtml5',
				title: 'Visitor Type Reports',
                
            },
			/* {
                extend: 'csvHtml5',
				title: 'Daily Collection Reports',
                
            }, */
			{
                extend: 'pdfHtml5',
				title: 'Visitor Type Reports',
                
            },
        ]
    });
	
	function masterEdit(id,mode_type){
		$.post("<?php echo base_url('reception/Sysmode_master/edit'); ?>",{id:id,mode_type:mode_type},function(data){
			$("#load").html(data);
		});
	}
	
	function dupval(val){
		
	  var mode_type = val;
	  
	  $.ajax({
		url:'<?php echo base_url('reception/Sysmode_master/dupval'); ?>',
		type: "POST",
		dataType:'json',
		data: {mode_type:mode_type},
		success: function(data)
        {
          var a=data.msg;
		  if(a=='S')
                {
                  
                  $('#ss').text('Mode Type already exists!!');
				  $('#ss').fadeIn().delay(2000).fadeOut();
				  $("#mode_type").val('');
                 
                }
		  
		}, 
	});
}
</script>