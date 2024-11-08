
<style>
	/*.box-header {
    color: #444;
	background-color:#3c8cbc;
    display: block;
    padding: 10px;
    position: relative;
	}*/
	
	.p_detils{
		font-size:17px !important;
	}
	.box.box-default {
    border-top-color: #3c8cbc;
}
.vl {
  border-left: 2px solid #3c8dbc;
  height: 541px;
  position: absolute;
  left: 50%;
  margin-top: 30px;
   margin-left:  57px;
  top: 0;
}
.row{
	margin-top:12px;
	
}
</style> 
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       RTGS PAYMENT DETAILS
      </h1>
    
    </section>
    <!-- Main content -->
    <section class="content">
	<?php
		if($this->session->flashdata('msg')){
			echo $this->session->flashdata('msg');
		}
	?>
      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
<form action="<?php echo base_url(' parent_dashboard/Cbse_Reg/payment/Otherpay/savemode');?>"  method='POST' >
        <!-- /.box-header -->
        <div class="box-body">
		
	
					<div class='row'>
					<div class='col-md-4 '>
					<label>Select Payment Mode</label>
						<select class='form-control' name='p_mode' required>
							<option value=''>---Select---</option>
								<option value="RTGS">RTGS</option>
								<option value='NEFT'>NEFT</option>
								<option value='BANK TRANSACTION'>BANK TRANSACTION</option>
							<option value='UPI'>UPI</option>
							
						</select>
					</div>
				
		  </div>
			
					<div class='row'>
					<div class='col-md-4 '>
					<label>TRANSACTION ID</label>
						<input type='text' class='form-control' value='' name='tr_id' required>
						
					</div>
				
		  </div>
			<div class='row'>
					<div class='col-md-4 '>
					<label>TRANSACTION DATE</label>
						<input type='text' readonly class='form-control' value='' id='datepecker' name='t_date' required>
						
					</div>
				
		  </div>
			<div class='row'>
					<div class='col-md-4 '>
					
						<input type='submit' value='Submit' class='btn btn-success'>
					</div>
				
		  </div>
			
		</div>
		</form>
    <!-- /.content -->
  </div>
		</section>
 </div>
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <!-- /.content-wrapper -->
  
  <script>
	$("#datepecker").datepicker();
  </script>