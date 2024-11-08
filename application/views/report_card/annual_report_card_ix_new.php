<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<style>
	@page{
		margin: 2mm 2mm 2mm 2mm;
	}
</style>

<?php
	$i=1;
	foreach($result as $key => $val){
		?>
			<div style='border:1px solid #000; padding:8px;'>
				<div class="col-sm-3 col-xs-3">
				   <img class="pull-right" src="<?php echo base_url($school_setting[0]->SCHOOL_LOGO); ?>" style="width:130px; margin-right: 45px">
				</div>
				<div class='col-sm-6 col-xs-6'>
				  <center>
					<?php
					  echo "<h3>".$school_setting[0]->School_Name."</h3>";
					  echo $school_setting[0]->School_Address ."<br/>";
				  
					 
					  echo "<b>Affiliation No. - </b>".$school_setting[0]->School_AfftNo .",<b> School Code - </b>".$school_setting[0]->School_Code ."<br />";
		
										
					  echo "<span style='font-size:11px;'>(Website: www.jvmshyamali.com || Email id: jvmshyamali@yahoo.com)</span>"."<br >";
				  
				      echo "<b>ACADEMIC SESSION:</b> ".$school_setting[0]->School_Session;
					  echo "<h4>REPORT CARD</h4>";
					?>
				  </center>
				</div>
				<div class="col-sm-3 col-xs-3">
				  <img src="<?php echo base_url($school_photo[0]->School_Logo); ?>" style="width:100px; margin-top: 10px;margin-left: 45px;">
				</div>
			  
			 <table border='1' class='table'>
				<tr>
				  <th style='text-align:left; font-size:15px;'>Admission No. :</th>
				  <td style='text-align:left; font-size:15px;'><?php echo $val['admno']; ?></td>
				  <th style='text-align:left; font-size:15px;'>Class-Sec:</th>
				  <td style='text-align:left; font-size:15px;'><?php echo $val['class'] ." - " . $val['sec']; ?></td>
				  <th style='text-align:left; font-size:15px;'>Roll No.:</th>
				  <td style='text-align:left; font-size:15px;'><?php echo $val['roll']; ?></td>
				</tr>
				
				<tr>
				  <th style='text-align:left; font-size:15px;'>Student's Name :</th>
				  <td colspan='5' style='text-align:left; font-size:15px;'><?php echo $val['stunm']; ?></td>
				</tr>
				
				<tr>
				  <th style='text-align:left; font-size:15px;'>Mother's Name :</th>
				  <td colspan='5' style='text-align:left; font-size:15px;'><?php echo $val['mname']; ?></td>
				</tr>
				
				<tr>
				  <th style='text-align:left; font-size:15px;'>Father's Name :</th>
				  <td colspan='5' style='text-align:left; font-size:15px;'><?php echo $val['fname']; ?></td>
				</tr>
				
				<tr>
				  <th style='text-align:left; font-size:15px;'>Date of Birth :</th>
				  <td colspan='2' style='text-align:left; font-size:15px;'><?php echo $val['dob']; ?></td>
				  <th style='text-align:left; font-size:15px;'>Phone No. :</th>
				  <td colspan='2'><?php echo $data['mob']; ?></td>
					
				</tr>
			</table>
			
			<table class='table' border='1' style='font-size:12px! important;margin-top:-30px! important'>
				<tr>
					<th rowspan='2'><center>SUBJECT</center></th>
					<th colspan='3'><center>TERM-1</center></th>
					<th colspan='3'><center>TERM-2</center></th>
					<th><center>GRAND TOTAL</center></th>
					<th rowspan='2'><center>GRADE</center></th>
				</tr>
				<tr>
					<th><center>INTERNAL ASSESSMENT<br />10 (A)</center></th>
					<th><center>TERM-1 <br />(40) (B)</center></th>
					<th><center>TOTAL 50 <br />(C)(A+B)</center></th>
					<th><center>INTERNAL ASSESSMENT<br />10 (D)</center></th>
					<th><center>TERM-2 <br />(40) (E)</center></th>
					<th><center>TOTAL 50 <br />(F)(D+E)</center></th>
					<th><center>100 <br />(C+F)</center></th>
				</tr>
				<?php
					$ab = 0;
					$de = 0;
					$tot = 0;
					$subTot = 0;
					$per = 0;
					foreach($val['subject_nm'] as $key1 => $val1){
						$ab = ($val['term1'][8][$key1]['M3']+$val['term1'][4][$key1]['M3']); 
						$de = ($val['term2'][8][$key1]['M3']+$val['term2'][5][$key1]['M3']); 
						$tot = ($ab+$de); 
						if($val['term1'][8][$key1]['opt_code'] != 1){
							$subTot += $tot;
						}
						$per = number_format($subTot/5,2);
						if($val1=='SANSKRIT' || $val1=='HINDI')
						{
							?>
							<tr id='skd<?php echo $i; ?>'>
								<td><?php echo $val1; ?></td>
								<td><center><?php echo $val['term1'][8][$key1]['M2']; ?></center></td>
								<td><center><?php echo $val['term1'][4][$key1]['M2']; ?></center></td>
								<td><center><?php echo $ab; ?></center></td>
								
								<td><center><?php echo $val['term2'][8][$key1]['M2']; ?></center></td>
								<td><center><?php echo $val['term2'][5][$key1]['M2']; ?></center></td>
								<td><center><?php echo $de; ?></center></td>
								<td><center><?php echo $tot; ?></center></td>
								<td>
									<?php
										foreach($grademaster as $key => $grade){
											if($grade->ORange >=$tot && $grade->CRange <=$tot){
											 $gingrds = $grade->Grade;
												break;
											}
										}
										echo "<center>".$gingrds."</center>";
									?>
								</td>
							</tr>
							<script>
								var sk="<?php echo $i; ?>";
								var sd=$('#skd'+sk).html();
								$('#sdd'+sk).html(sd);
								$('#skd'+sk).css('display','none');	
							</script>
						<?php }else{ ?>
							<tr>
								<td><?php echo $val1; ?></td>
								<td><center><?php echo $val['term1'][8][$key1]['M2']; ?></center></td>
								<td><center><?php echo $val['term1'][4][$key1]['M2']; ?></center></td>
								<td><center><?php echo $ab; ?></center></td>
								
								<td><center><?php echo $val['term2'][8][$key1]['M2']; ?></center></td>
								<td><center><?php echo $val['term2'][5][$key1]['M2']; ?></center></td>
								<td><center><?php echo $de; ?></center></td>
								<td><center><?php echo $tot; ?></center></td>
								<td>
									<?php
										foreach($grademaster as $key => $grade){
											if($grade->ORange >=$tot && $grade->CRange <=$tot){
											 $gingrds = $grade->Grade;
												break;
											}
										}
										echo "<center>".$gingrds."</center>";
									?>
								</td>
							</tr>
						<?php
						}
						if($val1=='ENGLISH'){
							?>
								<tr id='sdd<?php echo $i ?>'> </tr>
							<?php
						}
					
					}
					
				?>
				<tr>
					<td colspan='6'></td>
					<td><center><b>GRAND TOTAL</b></center></td>
					<td><center><b><?php echo $subTot; ?></b></center></td>
					<td>
						<center>
							<b>
								<?php 
									foreach($grademaster as $key => $grade){
										if($grade->ORange >=$per && $grade->CRange <=$per){
										 $gingrd = $grade->Grade;
											break;
										}
									}
									echo "<center>".$gingrd."</center>";
								?>
							</b>
						</center>
					</td>
				</tr>
				<tr>
					<td colspan='6'> </td>
					<td><center><b>OVERALL PERCENTAGE</b></center></td>
					<td><center><b><?php echo $per; ?> %</b></center></td>
					<td>
						
					</td>
				</tr>
			</table>
				<div class='row' >		
					<div class='col-sm-12' style='margin-top:-22px! important'>	
					<table class='table' border='1' style='border-top:2px solid #000;font-size:11px! important;margin-top:-30px! important'>
						<tr>
							<th><center><b>REMARKS</b></center>
							<br/>
							</th>
							
						</tr>
						
					</table>
					</div>
					</div>
				<table class='table' border='1' style='border-top:2px solid #000;font-size:11px! important;margin-top:-30px! important'>
						<tr>
							<td style='width:50%'><b>Promoted to / Detained in</b>
							<br/>
							</td>
							<td  style='width:50%'><b>NEW SESSION COMMENCES FROM: </b>12-Apr-2022</td>
						</tr>
					</table>
			<div class='row'>
					<div class='col-sm-12'>
					<table class='table' style='font-size:10px! important;'>
					  
					  
					   <tr>
						 <td class='sign'><center><br /><br />Parent's Signature</center></td>
						 <td class='sign'><center><br /><br />Class Teacher's Signature</center></td>
						 
						   
						   <td class='sign'><center><img src='http://micaeduco.co.in/erp/assets/school_logo/sec_in_charge.png' style='width:100px;'><br />Section In-charge's Signature</center></td>
						<td class='sign'><center><img src='http://micaeduco.co.in/erp/assets/school_logo/sjana2.png' style='width:100px;'><br />Principal's Signature</center></td>
					  </tr>
					  
					</table>
						<!--<table style='border:1 !important; width: 100%' class='table' cellspacing=0;>
							<tr style='height:25px;'>
								<td style='font-size:6px; text-align:righr'><b>Published On: <?php echo date('d-M-y');?></b></td></tr>
						</table>-->
					</div>
					</div>
			</div>
			<footer style='page-break-after: always;'></footer>
		<?php
		$i++;
	}
?>