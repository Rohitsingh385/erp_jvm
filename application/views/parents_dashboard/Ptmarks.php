<?php
error_reporting(0);
	if($studata)
	{
		$adm=$studata[0]['ADM_NO'];
		$name=$studata[0]['FIRST_NM']." ".$studata[0]['MIDDLE_NM']." ".$studata[0]['TITLE_NM'];
		$FATHER_NM=$studata[0]['FATHER_NM'];
		$MOTHER_NM=$studata[0]['MOTHER_NM'];
		$ROLL_NO=$studata[0]['ROLL_NO'];
		$CLASS=$studata[0]['DISP_CLASS'];
		$SEC=$studata[0]['DISP_SEC'];
		
		
	}

?>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<style>
	/*.box-header {
    color: #444;
	background-color:#3c8cbc;
    display: block;
    padding: 10px;
    position: relative;
	}*/
	td{padding:8px}
	.p_detils{
		font-size:17px !important;
	}
	.box.box-default {
    border-top-color: #3c8cbc;
}
}
</style>
  <!-- Content Wrapper. Contains page content -->
<br/><br/>
  <div class="content-wrapper container" style='background-color:#e6faff; padding:20px; border:1px solid #bfbfbf'>
    <!-- Content Header (Page header) -->
 

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
      
        <!-- /.box-header -->
        <div class="box-body">
			<center>
				<img src="http://micaeduco.co.in/erp/assets/school_logo/1560227769.png" height="150px">
				<h2>JAWAHAR VIDYA MANDIR, SHYAMALI</h2>
				<h4>Shyamali Colony, Doranda Ranchi-834002</h4>
				<h5>ACADEMIC SESSION: 2020-2021</h5>
				<h6>(Affiliated to CBSE, New Delhi)</h6>
			</center>
          <div class="row">
		<br/><br/>
			<div class='col-md-12 col-sm-12 col-lg-12'>
				<div class='row'>
					<div class='col-md-6' style='background-color:#e6faff'>
						<h4>STUDENT DETAILS</h4>
						<hr/>
						<table class='table'>
							<tr><td><strong>Admission No.:</strong></td><td><?php echo $adm;?></td></tr>
							<tr><td><strong>Student Name:</strong></td><td><?php echo $name;?></td></tr>
							<tr><td><strong>Father Name:</strong></td><td><?php echo $FATHER_NM;?></td></tr>
							<tr><td><strong>Mother Name:</strong></td><td><?php echo $MOTHER_NM;?></td></tr>
							<tr><td><strong>Class-Sec:</strong></td><td><?php echo $CLASS.'-'.$SEC;?></td></tr>
							
							</table>
						
						
					</div>
					<div class='col-md-6' >
						<h4>PT-3 MARKS SHEET</h4>
						<hr/>
				<table class='table'>
					<tr style='color:white; background-color:#00ace6'>
					<th>Subject Name</th><th>Marks</th>
						</tr>
					<?php
					foreach($subject as $key){
					?>
							<tr><td><strong><?php echo $key['SubName'];?></strong></td><td><?php echo $key['M2'];?></td></tr>
					
				<?php }	?>
							
						</table>
			</div>
				</div>
				
			</div>
          </div>
		
          <!-- /.row -->
        </div>
		 
        <!-- /.box-body -->
      </div>
		
		 <center><span class='btn btn-danger' onclick="window.print();">Print</span></center>
      <!-- /.box -->
	  
	