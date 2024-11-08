<style>
	body{
		font-family: Verdana, Geneva, Tahoma, sans-serif;
	}
	#table2 {
		border-collapse: collapse;
	}
	#table3 {
		border-collapse: collapse;
	}
	#img{
		float:left;
		height:80px;
		width:80px;
		margin-left: 150px !important;
	}
	#tp-header{
		font-size:24px;
	}
	#mid-header{
		font-size:20px;
	}
	#last-header{
		font-size:18px;
	}
	.th{
		font-size:13px;
	}
	.tt{
		font-size:13px;
	}
	.table > thead > tr > th,
.table > tbody > tr > th,
.table > tfoot > tr > th,
.table > thead > tr > td,
.table > tbody > tr > td,
.table > tfoot > tr > td {
    white-space: nowrap !important;
  }
	
</style>
<img src="<?php echo $school_setting[0]->SCHOOL_LOGO; ?>" id="img">
<table width="100%" style="float:right;">
	<tr>
		<td id="tp-header"><center><?php echo $school_setting[0]->School_Name; ?></center></td>
	</tr>
	<tr>
		<td id="mid-header"><center><?php echo $school_setting[0]->School_Address; ?></center></td>
	</tr>
	<tr>
		<td id="last-header"><center>SESSION (<?php echo $school_setting[0]->School_Session; ?>)</center></td>
	</tr>
	<tr>
		<td><center><span style="font-size:18px !important;">List of Students with Bus Facility for :
			<?php
			if($class == 'All' && $sec == 'All')
			{
			   echo 'All Class Section';
			}
			elseif($sec == 'All')
			{
			   $ss = 'All Section';
			  echo $data[0]->DISP_CLASS; ?>-<?php echo $ss; 
			}
			else
			{
			 echo $data[0]->DISP_CLASS; ?>-<?php echo $data[0]->DISP_SEC; 
			}
			?>
			
			</span></center></td>
		
	</tr>
	
</table><br /><br /><br /><br /><br /><br /><br />
<hr>
<br />
<table width="100%" border="1" id="table2">
	<thead>
		<tr>
			<th class="th" width='5%'>Sl No.</th>
		    <th class="th" width='10%'>Admission No.</th>
			<th class="th" width='20%'>Student's Name</th>
			<th class="th" width='5%'>Class</th>
			<th class="th" width='5%'>Sec</th>
			<th class="th" width='5%'>Roll No.</th>
	        <th class="th" width='10%'>Contact No.</th>
			<th class="th" width='20%'>Stoppage's Name</th>
			<th class="th" width='5%'>Bus No.</th>
			<th class="th" width='5%'>Amount</th>
		</tr>
		
	</thead>
	<tbody>
		<?php
			$i=1;
			foreach($data as $key=>$value){
				?>
				<tr>
					<td class="tt"><center><?php echo $i; ?></center></td>
				    <td class="tt"><?php echo $value->ADM_NO; ?></td>
					<td class="tt"><?php echo $value->FIRST_NM; ?></td>
					<td class="tt"><?php echo $value->DISP_CLASS; ?></td>
					<td class="tt"><?php echo $value->DISP_SEC; ?></td>
					<td class="tt"><?php echo $value->ROLL_NO; ?></td>
					<td class="tt"><?php echo $value->C_MOBILE; ?></td>
					<td class="tt"><?php echo $value->stopname; ?></td>
					<td class="tt"><center><?php echo $value->BUS_NO; ?></center></td>
					<td class="tt"><?php echo $value->stp_amt; ?></td>
				</tr>
				<?php
				$i++;
			}
		?>
	</tbody>
	<p>Report Printed on <?php echo date('d/m/Y h:i:sa') ?></p>
</table>