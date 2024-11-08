<style>
  table tr td,th{
	  color:#000 !important;
	  padding-right:0px !important;
  }
  .table > thead > tr > th,
  .table > tbody > tr > th,
  .table > tfoot > tr > th,
  .table > thead > tr > td,
  .table > tbody > tr > td,
  .table > tfoot > tr > td {
    white-space: nowrap !important;
	font-size:12px;
	padding:2px !important;
  }
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.html">Previous Report Card Five</a> <i class="fa fa-angle-right"></i></li>
</ol>
<!--four-grids here-->
<div style="padding-left: 25px; background-color: white; border-top:3px solid #337ab7;">
	<br />
	<div>
		<div class='col-sm-6'>
			<form id='form'>
			<table class='table'>
				<tr>
					<td>
						<b>Class</b>
						<select name='classes' class='form-control' onchange='classes(this.value)'>
							<option value=''>Select</option>
							<?php
								foreach($classes as $key => $val){
									?>
										<option value="<?php echo $val['Class_No']; ?>"><?php echo $val['CLASS_NM']; ?></option>
									<?php
								}
							?>
						</select>
					</td>
					
					<td>
						<b>Section</b>
						<select name='classes' class='form-control' id='sec'>
							<option value=''>Select</option>
						</select>
					</td>
				</tr>
				<tr>
					<td><button class='btn btn-success btn-btn-success btn-sm'>Search</button></td>
				</tr>
			</table>
			</form>
		</div>
	</div>
	
	<div class='row'>
		<div class='col-sm-12'>
		   <div id='load_data'></div>
		</div>
	</div><br />
	
</div><br />

<div class="clearfix"></div>
<!-- script-for sticky-nav -->
<script>
$

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
function classes(val){
  $.post("<?php echo base_url('prev_reportcard_nur_five/PrevReportCard/get_sec'); ?>",{val:val},function(data){
	  $("#sec").html(data);
  });
}

// $("#form").on("submit", function (event) {
    // event.preventDefault();
    // $.ajax({
		// url: "<?php echo base_url('prev_reportcard_nur_five/PrevReportCard/getReport'); ?>",
		// type: "POST",
		// data: $("#form").serialize(),
		// success: function(data){
			// alert(data);
		// }
	// });
 // });
</script>