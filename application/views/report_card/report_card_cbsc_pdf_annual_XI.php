<html>
  <head>
    <title>Report Card</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url('assets/dash_css/bootstrap.min.css'); ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Laila:700&display=swap" rel="stylesheet">
	<style>
	 <style>
	 table tr th,td{
		font-size:14px!important;
		padding:15px!important;
	}
	@page { margin: 50px 12px 0px 12px; }
	
	.sign{
		font-family: 'Laila', serif;
	}
	</style>
  </head>
  
  <body>
	  <?php
	 
		if(isset($result)){
			$j = 1;
			$tot_rec = count($result);
			foreach($result as $key => $data){
				?>
				  <div style="border:5px solid #000; padding:10px; display:none" id='dyn_<?php echo $j;?>'>
				  <table style='border:none !important;' class='table'>
						<tr>
							<td>
								<br /><br /><img src="<?php echo $school_photo[0]->School_Logo_RT; ?>" style="width:124px;">
							</td>
							<td>
								<center><span style='font-size:25px !important;'><?php echo $school_setting[0]->School_Name; ?></span><br />
								<span style='font-size:18px !important'>
								<?php echo $school_setting[0]->School_Address; ?>
								</span><br />
																<b>(Affiliated to CBSE, New Delhi)</b>
									<br />
								<b>(Website: www.jvmshyamali.com) <br/> (Email id: jvmshyamali@yahoo.com)</b>
									
								</center>
								
							</td>
							<td style='text-align:right'>
								<br /><img src="<?php //echo $school_photo[0]->School_Logo; ?>" style="width:100px; margin-top: 16px;">
							</td>
						</tr>
					  <tr>
						   <td>
							  
						  </td>
						  
						  <td>
							  <b><center>
								<span style='font-size:13px !important;'>
								REPORT CARD
								</span>
								
								</center></b>
						  </td>
						   <td>
							  
						  </td>
					  </tr>
						<tr>
							<td>
							<span style='font-size:13px !important'>Affiliation No.-
							<?php echo $school_setting[0]->School_AfftNo; ?></span>
							</td>
							<td>
							<b><center>
								<span style='font-size:13px !important;'>
								ACADEMIC SESSION: <?php echo $school_setting[0]->School_Session; ?>
								</span>
								
								</center></b>
							</td>
							<td style='text-align:right'><span style='font-size:13px !important'>School Code-<?php echo $school_setting[0]->School_Code; ?></span></td>
						</tr>
					</table>
				  
				  <table class='table'>
				    <tr>
					  <th>Admission No. :</th>
					  <td><?php echo $data['ADM_NO']; ?><input type='hidden' value='<?php echo $data['ADM_NO']; ?>' id='adm_<?php echo $j;?>'></td>
					  <th>Class-Sec:</th>
					  <td><?php echo $data['DISP_CLASS'] ." - " . $data['DISP_SEC']; ?></td>
					  <th>Roll No.</th>
					  <td><?php echo $data['ROLL_NO']; ?></td>
				    </tr>
					
					<tr>
					  <th>Student's Name :</th>
					  <td colspan='5'><?php echo $data['FIRST_NM'] . " " . $data['MIDDLE_NM']; ?></td>
					</tr>
					
					<tr>
					  <th>Mother's Name :</th>
					  <td colspan='5'><?php echo $data['MOTHER_NM']; ?></td>
					</tr>
					
					<tr>
					  <th>Father's Name :</th>
					  <td colspan='5'><?php echo $data['FATHER_NM']; ?></td>
					</tr>
					
					
				  </table>
				  
				  <table class='table' border='1' style='border-top:2px solid #000;'>
				    <tr>
					  <th colspan='4'><center> </center></th>
					  
					</tr>
					<tr>
					  <th style="width:300px;">Subject Name</th>
				
					  <th><center> TERM - 1   (100)</center></th>
						<th><center> Annual Term   (100)</center></th>
					  <th><center> Total (200)</center></th>
					</tr>
					<?php
					  $grnd_tot = 0;
					  $i = 0;
				$T_half_yearly2=0;
				$T_obtained =0;
					?>
					<?php foreach($data['sub'] as $subject){ ?>
					<tr>
					  <th><?php echo $subject['subject_name']; ?></th>
					  
					 
					  <td>
						 <center> <?php echo $subject['marks']['half_yearly']; ?></center>
					
					  </td>
						  <td>
						 <center> <?php echo $subject['marks']['half_yearly2']; ?></center>
					
					  </td>
					  
						 <td>
						 <center> <?php echo $subject['marks']['obtained']; ?></center>
					 </td>
					</tr>
					<?php
					if($subject['opt_code'] != 1){
					  $grnd_tot += $subject['marks']['marks_obtained']; 
						 $T_half_yearly2 += $subject['marks']['half_yearly2']; 
						 $T_obtained += $subject['marks']['obtained']; 
                      $i +=1;					  
					}
				
															$grd='E'
					?>
					<?php } ?>
					  	<tr>
							<td> <center> Total </center></td>
						<td> <center><b> <?php echo $grnd_tot;?> </b></center></td>
						<td> <center> <b><?php echo $T_half_yearly2;?></b></center></td>
						<td> <center> <b><?php echo $T_obtained;?></b></center></td>
					  </tr>
					
				  </table>
				  
				 
				  <div class='row'>
				    <div class='col-xs-12'>
					  <table class='table' border='1' style='border-top:2px solid #000;'>
						
						<tr>
						  <th><center>* This is a system generated report hence does not require signature.</center></th>
						</tr>
						
						 <tr>
							 <td style='font-size:6px; text-align:right'><b>Published On: <?php echo date('d-M-y');?></b></td>
						</tr>
					  </table>
					</div>
					</div>
					
				  
				  </div>
				  <?php if($tot_rec  > $j++) {?>
				  <div style='page-break-after: always;'></div>
				  <?php } ?>
				<?php
			}
		}
	  ?>
	  
	   <!-- Modal -->
		<div id="myModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-body">
				<center><img class='img-responsive' src="<?php echo base_url('assets/images/loading.gif'); ?>"></center>
			  </div>
			</div>
		  </div>
		</div>
	  <!-- end Modal -->
	  
  </body>
</html>

<script>
	var lp = '<?php echo $j; ?>';
	var lp = lp-1;
	$('#myModal').modal('show');
	for(var i=1; i<=lp; i++){
		var ab  = $("#dyn_"+i).html();
		
		var adm = $("#adm_"+i).val();
		$.ajax({	
		 url:"<?php echo base_url('report_card/report_card/adpdf_annual_XI')?>",
		 data:{'value':ab,'idd':i,'admno':adm,'lp':lp},
		 type:"POST",
		 success:function(data){
			if(lp == data){
			$('#myModal').modal('hide');
			window.top.close();
			}
		 }	
		 });
	}	
</script>