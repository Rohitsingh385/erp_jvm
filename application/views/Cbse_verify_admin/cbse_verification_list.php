<style type="text/css">
 .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td 
  {
    color: black;
  }
   .loader {
      position: fixed;
      top: 50%;
      left: 50%;
        border: 16px solid #f3f3f3; /* Light grey */
        border-top: 16px solid #3498db; /* Blue */
        border-radius: 50%;
        width: 120px;
        height: 120px;
        animation: spin 2s linear infinite;
      }

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
  .absent {
    background-color: #ff8793;
  }
  .present {
    background-color: #a3dba2;
  }
  .late_in {
    background-color: #ffb37c;
  }
  .before_out {
    background-color: #458ac6;
    color: white;
  }
  .late_in_before_out {
    background-color: #d61515;
    color: white;
  }
  .holiday {
    background-color: #e9eda6;
  }
  div.zabuto_calendar ul.legend>span
  {
    color: black;
    font-size: 15px;
    font-weight: bold;
  }
  .error{
    color: red;
  }
</style>
	  
	 
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">CBSE STUDENT DATA</a> <i class="fa fa-angle-right"></i> VERIFICATION</li>
</ol>
  <!-- Content Wrapper. Contains page content -->
  <div class="employee-dashboard">
    <div class="" >
      <section class="content">
	  <ol class="breadcrumb">
    <li class="breadcrumb-item">CLASS IX</li>
</ol>

           <div class="row">
		
          <div class="col-lg-4 col-4" style='padding:5px;background-color:white'>
            <!-- small box -->
          <div style='padding:5px;background-color:#0099ff;color:white;'>
              <div class="inner">
                <h3><i class="fa fa-user-plus"></i>  <?php echo $fetch_record[0]['total']; ?></h3>

                <p>Total Registered Students</p>
              </div>
                <a href="<?php echo base_url('Cbse_verify_admin/cbse_verification/list_data_total'); ?>"><span class="btn btn-info" style='width:100%;'  class="small-box-footer" style='color:white'>More info <i class="fa fa-arrow-circle-right"></i></span></a>
				
		
           
          </div>
          </div>
		  
		  
          <div class="col-lg-4 col-4" style='padding:5px;background-color:white;'>
            <!-- small box -->
          <div style='padding:5px;background-color:#009900;color:white'>
            <!-- small box -->
          
              <div class="inner">
                <h3><i class="fa fa-user-plus"></i> <?php echo $fetch_record[0]['verifycnt']; ?></h3>

                <p>Verified Students</p>
              </div>
            
            <a href="<?php echo base_url('Cbse_verify_admin/cbse_verification/list_data_verified'); ?>"><span class="btn btn-success" style='width:100%;'  class="small-box-footer" style='color:white'>More info <i class="fa fa-arrow-circle-right"></i></span></a>
           
          </div>
          </div>
          <div class="col-lg-4 col-4" style='padding:5px;background-color:white'>
            <!-- small box -->
          <div style='padding:5px;background-color:#b38f00;color:white'>
            <!-- small box -->
          
              <div class="inner">
                <h3><i class="fa fa-user-plus"></i> <?php echo $fetch_record[0]['pendingcnt']; ?></h3>

                <p>Pending Verification</p>
              </div>
                   <a href="<?php echo base_url('Cbse_verify_admin/cbse_verification/list_data_pending'); ?>"><span class="btn btn-warning" style='width:100%;'  class="small-box-footer" style='color:white'>More info <i class="fa fa-arrow-circle-right"></i></span></a>
				   
    
          </div>
          </div>
          <!-- ./col -->
    
		  
	
          
        </div>
        <!-- /.box -->
      </section>
    </div>

</div><br>
  <div class="employee-dashboard">
    <div class="" >
      <section class="content">
	  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">CLASS XI</a></li>
		<a href='<?php echo base_url('Cbse_verify_admin/cbse_verification/rtgs_list_xi'); ?>'><span class='btn btn-success' style='float:right'>RTGS PAYMENT VERIFICATION</span></a>
</ol>
         
		  <div class="row">
		
          <div class="col-lg-4 col-4" style='padding:5px;background-color:white'>
            <!-- small box -->
          <div style='padding:5px;background-color:#0099ff;color:white;'>
              <div class="inner">
                <h3><i class="fa fa-user-plus"></i> <?php echo $fetch_record_xi[0]['total']; ?></h3>

                <p>Total Registered Students</p>
              </div>
            
            <span class="btn btn-info" style='width:100%;'>  <a href="<?php echo base_url('Cbse_verify_admin/cbse_verification/list_data_total_xi'); ?>" class="small-box-footer" style='color:white'>More info <i class="fa fa-arrow-circle-right"></i></a></span>
           
          </div>
          </div>
		  
		  
          <div class="col-lg-4 col-4" style='padding:5px;background-color:white;'>
            <!-- small box -->
          <div style='padding:5px;background-color:#009900;color:white'>
            <!-- small box -->
          
              <div class="inner">
                <h3><i class="fa fa-user-plus"></i> <?php echo $fetch_record_xi[0]['verifycnt']; ?></h3>

                <p>Verified Students</p>
              </div>
            
            <span class="btn btn-success" style='width:100%;'>  <a href="<?php echo base_url('Cbse_verify_admin/cbse_verification/list_data_verified_xi'); ?>" class="small-box-footer" style='color:white'>More info <i class="fa fa-arrow-circle-right"></i></a></span>
           
          </div>
          </div>
          <div class="col-lg-4 col-4" style='padding:5px;background-color:white'>
            <!-- small box -->
          <div style='padding:5px;background-color:#b38f00;color:white'>
            <!-- small box -->
          
              <div class="inner">
                <h3><i class="fa fa-user-plus"></i> <?php echo $fetch_record_xi[0]['pendingcnt']; ?></h3>

                <p>Pending Verification</p>
              </div>
            
            <span class="btn btn-warning" style='width:100%;'>  <a href="<?php echo base_url('Cbse_verify_admin/cbse_verification/list_data_pending_xi'); ?>" class="small-box-footer" style='color:white'>More info <i class="fa fa-arrow-circle-right"></i></a></span>
           
          </div>
          </div>
          <!-- ./col -->
    
		  </div>
        <!-- /.box -->
      </section>
    </div>

</div>

<br>

<div class="employee-dashboard">
    <div class="" >
      <section class="content">
	  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">CLASS X & XII</a></li>
</ol>

           <div class="row">
		
          <div class="col-lg-4 col-4" style='padding:5px;background-color:white'>
            <!-- small box -->
          <div style='padding:5px;background-color:#0099ff;color:white;'>
              <div class="inner">
                <h3><i class="fa fa-user-plus"></i>  <?php echo $fetchtempdata_X_XII[0]['total']; ?></h3>

                <p>Total Registered Students</p>
              </div>
                <a href="<?php //echo base_url('Cbse_verify_admin/cbse_verification/list_data_total_X_XII'); ?>"><span class="btn btn-info" style='width:100%;'  class="small-box-footer" style='color:white'>More info <i class="fa fa-arrow-circle-right"></i></span></a>
				
		
           
          </div>
          </div>
		  
		  
          <div class="col-lg-4 col-4" style='padding:5px;background-color:white;'>
            <!-- small box -->
          <div style='padding:5px;background-color:#009900;color:white'>
            <!-- small box -->
          
              <div class="inner">
                <h3><i class="fa fa-user-plus"></i> <?php echo $fetchtempdata_X_XII[0]['verifycnt']; ?></h3>

                <p>Verified Students</p>
              </div>
            
            <a href="<?php //echo base_url('Cbse_verify_admin/cbse_verification/list_data_verified'); ?>"><span class="btn btn-success" style='width:100%;'  class="small-box-footer" style='color:white'>More info <i class="fa fa-arrow-circle-right"></i></span></a>
           
          </div>
          </div>
          <div class="col-lg-4 col-4" style='padding:5px;background-color:white'>
            <!-- small box -->
          <div style='padding:5px;background-color:#b38f00;color:white'>
            <!-- small box -->
          
              <div class="inner">
                <h3><i class="fa fa-user-plus"></i> <?php echo $fetchtempdata_X_XII[0]['pendingcnt']; ?></h3>

                <p>Pending Verification</p>
              </div>
                   <a href="<?php //echo base_url('Cbse_verify_admin/cbse_verification/list_data_pending'); ?>"><span class="btn btn-warning" style='width:100%;'  class="small-box-footer" style='color:white'>More info <i class="fa fa-arrow-circle-right"></i></span></a>
				   
    
          </div>
          </div>
          <!-- ./col -->
    
		  
	
          
        </div>
        <!-- /.box -->
      </section>
    </div>

</div><br>


<script type="text/javascript">

   $( document).ajaxComplete(function() {
      // Required for Bootstrap tooltips in DataTables
      $('[data-toggle="tooltip"]').tooltip({
          "html": true,
          "delay": {"show": 10, "hide": 0},
      });
  });
</script>