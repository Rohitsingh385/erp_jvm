<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Report Card Term</a> <i class="fa fa-angle-right"></i></li>
</ol>
<!--four-grids here-->
		<div style="padding-left: 25px; background-color: white">
		<div class="row">
		<div class="four-grids">
			<div class="col-md-3 four-grid">
				<a href="<?php echo base_url('report_card/Report_card/report_card/'. 1); ?>">
					<div class="four-agileits">
						<div class="icon">
							<i class="fas fa-rupee-sign" style="font-size:30px; color: #fff;"></i>
						</div>
						<div class="four-text">
							<center><img src="<?php echo base_url('assets/logo/marks_entry_icon.png'); ?>" class="img-responsive" style="width:30px;"></center>
							<h3>TERM 1</h3>
						</div>
						
					</div>
				</a>
			</div>
			<div class="col-md-3 four-grid">
				<a href="<?php echo base_url('report_card/Report_card/report_card/'. 2); ?>">
				<div class="four-agileinfo">
					<div class="icon">
						<i class="fas fa-rupee-sign" style="font-size:30px; color: #fff;"></i>
					</div>
					<div class="four-text">
					     <center><img src="<?php echo base_url('assets/logo/marks_entry_icon.png'); ?>" class="img-responsive" style="width:30px;"></center>
						<h3>TERM 2</h3>
					</div>
					
				</div></a>
			</div>
				<div class="col-md-3 four-grid">
				<a href="<?php echo base_url('report_card/Report_card/report_card_annual_junior'); ?>">
				<div class="four-agileinfo">
					<div class="icon">
						<i class="fas fa-rupee-sign" style="font-size:30px; color: #fff;"></i>
					</div>
					<div class="four-text">
					     <center><img src="<?php echo base_url('assets/logo/marks_entry_icon.png'); ?>" class="img-responsive" style="width:30px;"></center>
						<h3>Annual Report Card</h3>
					</div>
					
				</div></a>
			</div>
			<?php if($user_id == EMP0140 || $user_id == EMP0177) { ?>

				<div class="col-md-3 four-grid">
				<a href="<?php echo base_url('report_card/Report_card/report_card_annual_XI/'. 1); ?>">
					<div class="four-agileits">
						<div class="icon">
							<i class="fas fa-rupee-sign" style="font-size:30px; color: #fff;"></i>
						</div>
						<div class="four-text">
							<center><img src="<?php echo base_url('assets/logo/marks_entry_icon.png'); ?>" class="img-responsive" style="width:30px;"></center>
							<h3>ANNUAL REPORT CARD (XI)</h3>
						</div>
						
					</div>
				</a>
			</div>
			
			<?php } ?>
			
			
			<div class="clearfix"></div>
		</div>
		</div>
	</div><br /><br />







<div style="padding-left: 25px; background-color: white">
		<div class="row">
		<div class="four-grids">
			<div class="col-md-3 four-grid">
				<a href="<?php echo base_url('report_card/Report_card/report_card_int/'. 1); ?>">
					<div class="four-agileits">
						<div class="icon">
							<i class="fas fa-rupee-sign" style="font-size:30px; color: #fff;"></i>
						</div>
						<div class="four-text">
							<center><img src="<?php echo base_url('assets/logo/marks_entry_icon.png'); ?>" class="img-responsive" style="width:30px;"></center>
							<h3>Internal Assessment (IX)</h3>
						</div>
						
					</div>
				</a>
			</div>
				<div class="col-md-3 four-grid">
				<a href="<?php echo base_url('report_card/Report_card/report_card_annual/'. 1); ?>">
					<div class="four-agileits">
						<div class="icon">
							<i class="fas fa-rupee-sign" style="font-size:30px; color: #fff;"></i>
						</div>
						<div class="four-text">
							<center><img src="<?php echo base_url('assets/logo/marks_entry_icon.png'); ?>" class="img-responsive" style="width:30px;"></center>
							<h3>ANNUAL TERM (III-V)</h3>
						</div>
						
					</div>
				</a>
			</div>
			
			<div class="col-md-3 four-grid">
				<a href="<?php echo base_url('report_card/Report_card/report_card_annual_VI_IX/'. 1); ?>">
					<div class="four-agileits">
						<div class="icon">
							<i class="fas fa-rupee-sign" style="font-size:30px; color: #fff;"></i>
						</div>
						<div class="four-text">
							<center><img src="<?php echo base_url('assets/logo/marks_entry_icon.png'); ?>" class="img-responsive" style="width:30px;"></center>
							<h3>ANNUAL TERM (VI-X)</h3>
						</div>
						
					</div>
				</a>
			</div>
			
			<div class="col-md-3 four-grid">
				<a href="<?php echo base_url('report_card/export_excel/'); ?>">
					<div class="four-agileits">
						<div class="icon">
							<i class="fas fa-rupee-sign" style="font-size:30px; color: #fff;"></i>
						</div>
						<div class="four-text">
							<center><img src="<?php echo base_url('assets/logo/marks_entry_icon.png'); ?>" class="img-responsive" style="width:30px;"></center>
							<h3>Export Excel (VIII)</h3>
						</div>
						
					</div>
				</a>
			</div>
			
				
				
			
			<div class="clearfix"></div>
		</div>
		</div>
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
$(document).ready( function () {
    $('#class_table').DataTable();
} );
</script>
