<html>
  <head>
    <title>Report Card III-V</title>
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
								<b>ACADEMIC SESSION: <?php echo $school_setting[0]->School_Session; ?></b>
									<br />
								<b>(Affiliated to CBSE, New Delhi)</b>
									<br />
								
									
									
									<span style='font-size:10px !important'>(Website: www.jvmshyamali.com || Email id: jvmshyamali@yahoo.com)</span>
								
									
								</center>
								
							</td>
							<td style='text-align:right'>
								<br /><img src="<?php echo $school_photo[0]->School_Logo; ?>" style="width:90px; margin-top: 16px;">
							</td>
						</tr>
						<tr>
							<td>
							<span style='font-size:13px !important'>Affiliation No.-
							<?php echo $school_setting[0]->School_AfftNo; ?></span>
							</td>
							<td>
							<b><center><span style='font-size:16px !important;'>REPORT CARD</span></center></b>
							</td>
							<td style='text-align:right'><span style='font-size:13px !important'>School Code-<?php echo $school_setting[0]->School_Code; ?></span></td>
						</tr>
					</table>
				  
				  <table class='table'>
				    <tr>
					  <th>Admission No. :</th>
					  <td><?php echo $data['admno']; ?><input type='hidden' value='<?php echo $data['admno']; ?>' id='adm_<?php echo $j;?>'></td>
					  <th>Class-Sec:</th>
					  <td><?php echo $data['class'] ." - " . $data['sec']; ?></td>
					  <th>Roll No.</th>
					  <td><?php echo $data['roll']; ?></td>
				    </tr>
					
					<tr>
					  <th>Student's Name :</th>
					  <td colspan='5'><?php echo $data['name']; ?></td>
					</tr>
					
					<tr>
					  <th>Mother's Name :</th>
					  <td colspan='5'><?php echo $data['mname']; ?></td>
					</tr>
					
					<tr>
					  <th>Father's Name :</th>
					  <td colspan='5'><?php echo $data['fname']; ?></td>
					</tr>
					
					<tr>
					  <th>House :</th>
					  <td colspan='3'></td>
					  <th>Phone No. :</th>
					  <td><?php echo $data['mob']; ?></td>
					</tr>
					
					<tr>
					  <th>Address :</th>
					  <td colspan='5'></td>
					</tr>
				  </table>
				  
				  <table class='table' border='1' style='border-top:2px solid #000;'>
				    <tr>
					  <th>SCHOLASTIC AREAS :</th>
					  <th colspan='2'><center>FIRST TERMINAL EXAMINATION</center></th>
					</tr>
					<tr>
					  <th style="width:300px;">Subject Name</th>
					  <th><center> MARKS OBTAINED <br /> (100)</center></th>
					  <th><center> GRADE </center> </th>
					</tr>
					<?php
						
						foreach($data['subj'] as $key1 => $val1){
							?>
								<tr>
									<th><?php echo $val1['subjnm']; ?></th>
									<td><center><?php echo ($key1 != 8)?$val1['M3']:''; ?></center></td>
									<td>
										<center>
											<?php 
												if($val1['subjnm'] == 'DRAWING'){
													if($val1['grade'] == 'D'){
														echo '-';
													}else{
														echo $val1['grade'];
													}
												}else{
													echo $val1['grade'];
												}
												
											?>
										</center>
									</td>
								</tr>
							<?php
						}
					?>
					<tr>
						<th>GRAND TOTAL</th>
						<td><center><?php echo $data['tot']; ?></center></td>
						<?php
							if($data['class']=='III'){
								$totg = $data['tot']/4.5;
							}elseif($data['class']=='IV'){
								$totg = $data['tot']/5.5;
							}elseif($data['class']=='V'){
								$totg = $data['tot']/6.5;
							}
						?>
						<td>
							<?php
								if($totg >= '91' AND $totg <= '100'){
									echo  "<center>A+</center>";
								}else if($totg >= '75' AND $totg <= '90'){
									echo "<center>A</center>";
								}else if($totg >= '56' AND $totg <= '74'){
									echo "<center>B</center>";
								}else if($totg >= '35' AND $totg <= '55'){
									echo "<center>C</center>";
								}else if($totg <= '35'){
									echo "<center>D</center>";
								}
							?>
						</td>
					</tr>
				  </table>
				  
				 
				  <div class='row'>
				    <div class='col-xs-12'>
					  <table class='table' border='1' style='border-top:2px solid #000;'>
						<tr>
						  <th><center>Class Teacher's Remarks</center></th>
						</tr>
						<tr>
							<td>
								<?php
									if($totg <= '35'){
										echo "<center>verage</center>";
									}else if($totg > '35' AND $totg <= '55'){
										echo "<center>Good</center>";
									}else if($totg > '56' AND $totg <= '74'){
										echo "<center>Very Good</center>";
									}else if($totg > '75' AND $totg <= '89'){
										echo "<center>Excellent</center>";
									}else{
										echo "<center>Outstanding</center>";
									}
								?>
							</td>
						</tr>
					  </table>
					</div>
					</div>
					
						<div class='row'>		
						<div class='col-sm-12'>	
						<table class='table' border='1' style='border-top:2px solid #000;'>
							<tr>
								<th colspan='5'><center>INSTRUCTIONS</center></th>
							</tr>
							<tr>
								<td colspan='5'><center>Grading Scale for Scholastic Areas</center></td>
							</tr>
							<tr>
								<th><center>91 - 100</center></th>
								<th><center>75 - 90</center></th>
								<th><center>56 - 74</center></th>
								<th><center>35 - 55</center></th>
								<th><center>35 & Below</center></th>
							</tr>
							<tr>
								<td><center>A+</center></td>
								<td><center>A</center></td>
								<td><center>B</center></td>
								<td><center>C</center></td>
								<td><center>D</center></td>
							
							</tr>
					    </table>
						</div>
						</div>
					
				  <div class='row'>
				    <div class='col-sm-12'>
				    <table class='table'>
					   <tr>
						 <td class='sign'><center><br /><br /><br /><br />Parent's Signature</center></td>
						 <td class='sign'><center><br /><br /><br /><br />Class Teacher's Signature</center></td>
						 <td class='sign'><center><br /><img src='assets/school_logo/section_iii_v.png' style='width:100px;'><br />Section In-Charge's Signature</center></td>
						 <td class='sign'><center><br /><br /><img src='assets/school_logo/sjana2.png' style='width:100px;'><br />Principal's Signature</center></td>
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
		 url:"<?php echo base_url('report_card/report_card/adpdf')?>",
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