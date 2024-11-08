<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.html">Fee Collection</a> <i class="fa fa-angle-right"></i>Installment Fee Merge Import</li>
</ol>
<style type="text/css">
  body{
   font-family: 'Aldrich', sans-serif;
  }
</style>
<?php 
if(!empty($this->session->flashdata('success'))){
	?>
	<div class="alert alert-success">
  <strong>Success!</strong> <?php echo $this->session->flashdata('success');?>
</div>
	
	<?php
	
}

?>
<?php 
if(!empty($this->session->flashdata('errore'))){
	?>
	<div class="alert alert-danger">
  <strong>Error</strong> <?php echo $this->session->flashdata('errore');?>
</div>
	
	<?php
	
}

?>

<hr/>
<!--four-grids here-->

	<div class="row">
	<form method="post" id="import_form" enctype="multipart/form-data">
		<div class="four-grids">
					<div class="col-md-4 four-grid">
						<label style='float:right'>Choose Excel File </label>
					</div>
					<div class="col-md-4 four-grid">
						<input type='file' name='file' class='form-control'>
					</div>
					<div class="col-md-4 four-grid">
						 <input type='submit' name='submit'  Value='Import' class='btn btn-success'>
					</div>
				
					<div class="clearfix"></div>
		</div>
		</form>
	</div>
	<div class="row">
	<form method="post" id="import_form" enctype="multipart/form-data">
		<div class="four-grids" >
					<div class="col-md-12 four-grid">
					
						<div id='view_excel' style='margin:10px'></div>
					</div>
					
				
					<div class="clearfix"></div>
		</div>
		</form>
	</div>
        <div class="clearfix"></div>
		<!-- /script-for sticky-nav -->
<!--inner block start here-->
<div class="inner-block">

</div>
<br />
<script>

 $('#import_form').on('submit', function(event){
  event.preventDefault();
  $.ajax({
   url:"<?php echo base_url(); ?>Excel_import",
   method:"POST",
   data:new FormData(this),
   contentType:false,
   cache:false,
   processData:false,
   success:function(data){
    $('#file').val('');
	if(data =='000'){
		alert("Invalid record..!");
	}else{
    $('#view_excel').html(data);
	}
   }
  })
 });

</script>
<!--inner block end here-->
<!--copy rights start here-->
