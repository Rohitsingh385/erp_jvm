<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url(); ?>assets/admin_lte/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('father_name'); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
       <!-- <li class="header">MAIN MENU</li>
		  <!--- display none from here----------------------- >
	
        <li>
          <a href="<?php echo base_url('Parentlogin/parent_dashboard/'); ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <!--<i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
		  </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i> <span>Student Details</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('Parent_details/student_profile'); ?>"><i class="fa fa-circle-o"></i> Student Profile</a></li>
			 <li><a href="<?php echo base_url('Parent_details/stu_attendance'); ?>"><i class="fa fa-circle-o"></i>Attendance</a></li>
          </ul>
        </li>
        <li class="treeview" id='fee_summary'>
          <a href="#">
            <i class="fa fa-table"></i> <span>Fees Summary</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li id='payment_details'><a href="<?php  //echo base_url('Parent_details/pay_details'); ?>"><i class="fa fa-circle-o"></i>Payment Details</a></li>
          </ul>
        </li>
        <li>
          <a href="<?php //echo base_url('parent_dashboard/noticelist'); ?>">
            <i class="fa fa-bullhorn"></i> <span>Notice</span>
          </a>
        </li>
        <li>
          <a href="<?php //echo base_url('parent_dashboard/homeworklist'); ?>">
            <i class="fa fa-clipboard"></i> <span>Homework</span>
          </a>
        </li>
		<li class="treeview" id='fee_summary'>
          <a href="#">
            <i class="fa fa-envelope-o"></i> <span>SMS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li id='payment_details'><a href="<?php //echo base_url('parent_dashboard/sms/ComposeMessage'); ?>"><i class="fa fa-circle-o"></i>Compose Message</a></li>
            <li id='payment_details'><a href="<?php //echo base_url('parent_dashboard/sms/Inbox'); ?>"><i class="fa fa-circle-o"></i>Inbox</a></li>
			 <li id='payment_details'><a href="<?php //echo base_url(); ?>"><i class="fa fa-circle-o"></i>Sent Message</a></li>
          </ul>
        </li>
		 
		<li>
		 <a href="<?php //echo base_url('parent_dashboard/StudyTopiclist'); ?>">
			 <i class="fa fa-book"></i> <span>e-Learning</span>
		 </a>
		</li>
		
		<li>
          <a href="<?php //echo base_url('parent_dashboard/e_exam/homework/homework'); ?>">
            <i class="fa fa-clipboard"></i> <span>E-Homework</span>
          </a>
        </li>-->
		<!--<li>
			<?php
			$admn    = $this->session->userdata('adm');
			$getdata = $this->db->query("select prev_temp_class from student where ADM_NO='$admn'")->result_array();
			$prev_temp_class = $getdata[0]['prev_temp_class'];
			if($prev_temp_class=='class_v'){
				//$url='parent_dashboard/report_card/ReportCard5';
			}elseif($prev_temp_class=='class_iv'){
				//$url='parent_dashboard/report_card/ReportCard4';
			}elseif($prev_temp_class=='class_iii'){
				//$url='parent_dashboard/report_card/ReportCard3';
			}elseif($prev_temp_class=='class_ii'){
				//$url='parent_dashboard/report_card/ReportCard2';
			}elseif($prev_temp_class=='class_i'){
				//$url='parent_dashboard/report_card/ReportCard1';
			}elseif($prev_temp_class=='class_prep'){
				//$url='parent_dashboard/report_card/ReportCardPrep';
			}elseif($prev_temp_class=='class_nur'){
//$url='parent_dashboard/report_card/ReportCardNur';
			}else{
				//$url='#';
			}
			
			?>
			<a href="<?php echo base_url($url); ?>">
            <i class="fa fa-clipboard"></i> <span>Report Card</span>
          </a>
        </li>-->
		  <?php if($this->session->userdata('class_code') == 6 || $this->session->userdata('class_code') == 7 || $this->session->userdata('class_code') == 8 || $this->session->userdata('class_code') == 9 || $this->session->userdata('class_code') == 10 || $this->session->userdata('class_code') == 11 || $this->session->userdata('class_code') == 12){
	?>
	<!--<li>  <a href="<?php //echo base_url('Online_paymentcal/show_student'); ?>">
            <i class="fa fa-clipboard"></i> <span>Pay Computer Fee</span>
          </a>
        </li> -->
          <?php } ?>
		 
   <!--<li>
          <a href="<?php echo base_url('parent_dashboard/library/bookissue'); ?>">
           <i class="fa fa-book" aria-hidden="true"></i> <span>Advance Book Issue </span>
          </a>
        </li>
		 -->
		
		<!-- end of this div is display none -->
		<!-- for IX and XI-->
		  <?php
		  	if($this->session->userdata('class_code') == 11 || $this->session->userdata('class_code') == 13){
		  ?>
		  <li>
          <a href="<?php //echo base_url('parent_dashboard/Cbse_Reg/gautam/cbse_registration'); ?>">
            <i class="fa fa-clipboard"></i> <span>CBSE Registration</span>
          </a>
        </li>
		  <?php
			}	
		  ?>
		
		<!-- end for IX and XI -->
		
		<!--<li>
          <a href="<?php //echo base_url('parent_dashboard/report_card/ReportCard'); ?>">
            <i class="fa fa-clipboard"></i> <span>Report Card</span>
          </a>
        </li>-->
		<li>
          <a href="<?php echo base_url('parent_dashboard/e_exam/homework/homework'); ?>">
            <i class="fa fa-clipboard"></i> <span>E-Homework</span>
          </a>
        </li>
		<?php 
		  if($this->session->userdata('class_code') == 12 || $this->session->userdata('class_code') == 14){ ?>
		  	<li>
          <a href="<?php //echo base_url('parent_dashboard/cbse_reg_fee/Cbse_fee/cbse_registration'); ?>">
            <i class="fa fa-clipboard"></i> <span>PAY CBSE REGISTRATION FEE</span>
          </a>
       	 </li>
		  <?php } ?>
      </ul>
		  <?php 
      if( $this->session->userdata('class_code') == 14 || $this->session->userdata('class_code') == 13 || $this->session->userdata('class_code') == 12 || $this->session->userdata('class_code') == 11 || $this->session->userdata('class_code') == 10 || $this->session->userdata('class_code') == 9 || $this->session->userdata('class_code') == 8){ ?>
        <li>
          <a href="<?php //echo base_url('parent_dashboard/admitcard/Download_admitcard'); ?>">
            <i class="fa fa-clipboard"></i> <span>Admit Card</span>
          </a>
         </li>
      <?php } ?>
    </section>
    <!-- /.sidebar -->
  </aside>
