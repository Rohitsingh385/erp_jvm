  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

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
<br/>
<div class="container">
	
	<div style='padding:5px; border:1px solid grey'>
		 <center> <h2>
       RTGS PAYMENT METHOD FOR CLASS XI 2020
      </h2></center>
	<hr/>
		  <center><div class="row" style='font-size:17px;background-color:#f2f2f2;padding:6px;margin:8px'>
		<div class="col-sm-4"><b>User Name:</b> <?php echo $user_data[0]['Sname'];?></div>
			  <div class="col-sm-4"><b>Token No.:</b> <?php echo $user_data[0]['TokenNo'];?></div>
			  <div class="col-sm-4"><b>Admission No.:</b> <?php echo $user_data[0]['AdmNo'];?></div>
			 
			  </div></center>
		
	<div class="container-fluid">

  <div class="row">
  
    <div class="col-sm-9 col-md-6 col-lg-2" >
  </div>
	    <div class="col-sm-3 col-md-6 col-lg-8" style="border:1px dotted grey">
      	
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h4 style='padding:5px;background-color:#b3d9ff;font-weight:bold'>
      SUBMIT YOUR RTGS PAYMENT DETAILS
      </h4>
    
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
<form action="<?php echo base_url('parent_dashboard/Cbse_Reg/payment/Otherpay/savemode_xi');?>"  method='POST' >
        <!-- /.box-header -->
        <div class="box-body">
		<div class='row'>
					<div class='col-md-12 '>
					<label>SELECT PAYMENT MODE</label>
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
					<div class='col-md-12 '>
					<label>TRANSACTION ID</label>
						<input type='text' class='form-control' value='' name='tr_id' required>
						
					</div>
				
		  </div>
			<div class='row'>
					<div class='col-md-12 '>
					<label>TRANSACTION DATE</label>
						<input type='text' class='form-control' value='' id='datepecker' name='t_date' required>
					</div>
				
		  </div>
			<div class='row'>
					<div class='col-md-12 '>
					
						<input type='submit' value='Submit' class='btn btn-success'>
					</div>
				
		  </div>
			
		</div>
		</form>
    <!-- /.content -->
  </div>
		</section>
 </div>
    </div>
	  
    <div class="col-sm-9 col-md-6 col-lg-2" >
  </div>
  </div>
</div>
	<br/>
	</div>

	 </div>
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <!-- /.content-wrapper -->
  
  <script>
	$("#datepecker").datepicker({
	  changeMonth: true,
      changeYear: true,
      showButtonPanel: true,
      dateFormat: 'dd-mm-yy',
	});
  </script>