<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Excel</a> <i class="fa fa-angle-right"></i></li>
</ol>
<!--four-grids here-->
<div style="padding-left: 25px; background-color: white">
	<div class="row">
		<form id='form'>
			<div class='col-sm-4'>
				<label>Class</label>
				<select name='class' class='form-control' required>
					<option value=''>Select</option>
					<option value='VIII'>VIII</option>
				</select>
			</div>
			
			<div class='col-sm-4'>
				<label>Sec</label>
				<select name='sec' class='form-control' required>
					<option value=''>Select</option>
					<?php
						foreach($getSec as $key => $val){
							?>
								<option value='<?php echo $val['sec']; ?>'><?php echo $val['sec']; ?></option>
							<?php
						}
					?>
				</select>
			</div>
			
			<div class='col-sm-4'>
				<br />
				<button type='submit' class='btn btn-success'>SEARCH</button>
			</div>
		</form>
	</div>
	
	
	<br /><br /><br />
	<div class='row'>
		<div class='com-sm-12'>
			<div id='load'></div>
		</div>
	</div>
	<br />
</div><br /><br />

<div class="clearfix"></div>
                   
	
<!-- script-for sticky-nav -->
<script>
$(document).ready(function() {
	 var navoffeset=$(".header-main").offset().top;
	 $(window).scroll(function(){
		var scrollpos=$(window).scrollTop(); 
		if(scrollpos >=navoffeset){
			$(".header-main").addClass("fixed");
		}else{
			$(".header-main").removeClass("fixed");
		}
	 });
	 
});
</script>
		<!-- /script-for sticky-nav -->
<!--inner block start here-->
<div class="inner-block">

</div>
<!--inner block end here-->
<!--copy rights start here-->

<script>
$("#form").on("submit", function (event) {
    event.preventDefault();
    $.ajax({
		url: "<?php echo base_url('report_card/export_excel/fetchData'); ?>",
		type: "POST",
		data: $("#form").serialize(),
		success: function(data){
			$("#load").html(data);
		}
	});
 });
</script>
