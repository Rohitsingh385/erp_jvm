  
  <?php if($this->session->userdata('class_code') == 6 || $this->session->userdata('class_code') == 7 || $this->session->userdata('class_code') == 8 ||$this->session->userdata('class_code') == 9 || $this->session->userdata('class_code') == 10 || $this->session->userdata('class_code') == 11 || $this->session->userdata('class_code') == 12){
  }else{
  echo"<center>You can't access this page....!!</center>";
	  die;
  }
	

  error_reporting(0);
	if($student_details){
		$stu_img = $student_details[0]->student_image;
		$stu_name = $student_details[0]->FIRST_NM;
		$stu_adm = $student_details[0]->ADM_NO;
		$stu_roll = $student_details[0]->ROLL_NO;
		$stu_class = $student_details[0]->DISP_CLASS;
		$stu_sec = $student_details[0]->DISP_SEC;
		$marr_att = $student_details[0]->MAR_ATT;
	}
	
  ?>
  <style>
	.profile-user-img {
		height: 110px;
		}
		.box.box-primary {
		border-top-color: #faa21c;
		}
		#pd{
			cursor:pointer;
		}
		tr:nth-child(even) {
		background-color: #dddddd;
		}
		.th{
			background-color:#222e33;
			color:white;
		}
		.label{
			font-size:12px;
			cursor:pointer;
		}
		.loader{
			position: fixed;
			z-index: 999;
			top: 30%;
			left: 50%;
			display:none;
		}
		/* The container */
.container {
  display: block;
  position: relative;
  padding-left: 29px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 20px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
}

/* On mouse-over, add a grey background color */
.container:hover input ~ .checkmark {
  background-color: #2196F3;
}

/* When the checkbox is checked, add a blue background */
.container input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}
.container input ~ .checkmark {
  background-color: #ccc;
}
/* Show the checkmark when checked */
.container input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.container .checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
  </style>
	
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
	<section class="content-header">
      <h1>
       Fees Details
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Fees Summary</a></li>
        <li><a href="#">Payment Details</a></li>
        <li class="active">Payment Summary</li>
      </ol>
    </section>
		
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <?php
				 if($stu_img==null OR $stu_img=='N/A'){
					 ?>
					 <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url('assets/student_photo/default.jpg'); ?>" alt="User profile picture">
					 <?php
				 }else{
					?>
					<img class="profile-user-img img-responsive img-circle" src="<?php echo base_url($stu_img); ?>" alt="User profile picture">
					<?php
				 }
				?>
				<h3 class="profile-username text-center"><?php echo $stu_name; ?></h3>
				<ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Admission Number</b> <a class="pull-right"><?php echo $stu_adm; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Roll Number</b> <a class="pull-right"><?php echo $stu_roll; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Class</b> <a class="pull-right"><?php echo $stu_class; ?></a>
                </li>
				<li class="list-group-item">
                  <b>Section</b> <a class="pull-right"><?php echo $stu_sec; ?></a>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Payment Details</a></li>
            </ul>
            <div class="tab-content">
            <div class="active tab-pane" id="activity">
			<form method="POST" action="<?php echo base_url('Online_paymentcal/payment'); ?>">
                <ul class="list-group list-group-unbordered">
					<li class="list-group-item">
						<b>COMPUTER FEE </b> <a class="pull-right"><i class="fa fa-rupee"></i> <?php echo $amount;?></a>
                    </li>
					
					<li class="list-group-item">
						<b>GRAND TOTAL</b> <a class="pull-right"><i class="fa fa-rupee"></i> <?php echo $amount;?></a>
					</li>
					
					<li class="list-group-item">
					<?php if($marr_att == '0'){
	
	if(sizeof($chk_pay)==0){
?>
						<center><button class='btn btn-success' type='submit' name='sub' id='sub'>CONFIRM PAYMENT</button>&nbsp;&nbsp;&nbsp;
							
						
						<?php
	}else{
	?>
			<span style='color:green;font-size:18px'>Pending (wait for 24 working hours) &nbsp;&nbsp;  </span>&nbsp;&nbsp;&nbsp;				
							
							<?php
	}
		
								}else{
										?>
 							<span style='color:green;font-size:18px'>Payment Completed <i class="glyphicon glyphicon-ok"></i>&nbsp;&nbsp;  (<a href='#' onclick="download_rct('<?php echo $marr_att;?>')"> Download Receipt</a>)</span>&nbsp;&nbsp;&nbsp;
						
						<?php
								}?>	
						<a class='btn btn-success btn-sm' href='<?php echo base_url('Parentlogin/parent_dashboard'); ?>'>GO BACK</a>
						
						
						
						
						
							<p style='color:red;margin:8px;font-size:18px;text-align:justify'><b>Note:</b> Dear Parent, If receipt is not generated after successful payment of your ward's Computer Fee, kindly wait for 24 hours, it will automatically get updated in your ward's dashboard !</p>
						
						
						
						
						
						
						
						</center>
					</li>
				</ul>
				
				<input type="hidden" name='adm_no' value='<?php echo $stu_adm; ?>'>
			
			</form>
            </div>
            <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<script>
	function download_rct(rect_no){
	
			$.ajax({
			type: "POST",
			url: "<?php echo base_url('Parent_details/rect_download'); ?>",
			data: {rect_no:rect_no},
			success:function(data){
					
				if(data==1){
					window.setTimeout(function() {
					window.location.href = "<?php echo base_url('Parent_details/report_data'); ?>";
						}, 1000);
				}
				else{
					alert('! Sorry No Data Found');
				}
				},
			});
	}
	</script>
