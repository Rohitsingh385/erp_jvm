<style>
	body {
		font-family: Verdana, Geneva, Tahoma, sans-serif;
	}

	#table2 {
		border-collapse: collapse;
	}

	#table3 {
		border-collapse: collapse;
	}

	#img {
		float: left;
		height: 80px;
		width: 80px;
	}

	#tp-header {
		font-size: 24px;
	}

	#mid-header {
		font-size: 20px;
	}

	#last-header {
		font-size: 18px;
	}

	.th {
		font-size: 13px;
	}

	.tt {
		font-size: 13px;
	}

	.table>thead>tr>th,
	.table>tbody>tr>th,
	.table>tfoot>tr>th,
	.table>thead>tr>td,
	.table>tbody>tr>td,
	.table>tfoot>tr>td {
		white-space: nowrap !important;
	}
</style>
<img src="<?php echo $school_setting[0]->SCHOOL_LOGO; ?>" id="img">
<table width="100%" style="float:right;">
	<tr>
		<td id="tp-header">
			<center><?php echo $school_setting[0]->School_Name; ?><center>
		</td>
	</tr>
	<tr>
		<td id="mid-header">
			<center><?php echo $school_setting[0]->School_Address; ?><center>
		</td>
	</tr>
	<tr>
		<td id="last-header">
			<center>SESSION (<?php echo $school_setting[0]->School_Session; ?>)<center>
		</td>
	</tr>
	<tr>
		<td>
			<center><span style="font-size:18px !important;">Bus Stoppage Summary Statement as on : <?php
																									$currentDate = date('Y-m-d');
																									$timestamp = strtotime($currentDate);
																									echo $new_date = date("d-m-Y", $timestamp);
																									?></span></center>
		</td>

	</tr>

</table><br /><br /><br /><br /><br /><br /><br />
<hr>
<br />
<table width="100%" border="1" id="table2">
	<thead>
		<tr>
			<th class="th" width='5%'>Sl No.</th>
			<th class="th" width='5%'>Bus No.</th>
			<th class="th" width='35%'>Stoppage Name</th>
			<th class="th" width='10%'>Bus Fare(Rs.)</th>
			<th class="th" width='10%'>Total Students</th>
			<th class="th" width='10%'>Total Boys</th>
			<th class="th" width='10%'>Total Girls</th>
			<th class="th" width='15%'>Total Amount(Rs.)</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$grand_tot_stu = 0;
		$grand_tot_boys = 0;
		$grand_tot_girls = 0;
		$grand_tot_amt = 0;
		$i = 1;
		foreach ($data as $key => $value) {
			$tot = $value->TOTALSTUDENT;
			$amt = $value->stp_amt;
			$tot_amt =  ($tot * $amt);
			$tot_boys = $value->MALE;
			$tot_girls = $value->FEMALE;
			$grand_tot_stu = $grand_tot_stu + $tot;
			$grand_tot_boys = $grand_tot_boys + $tot_boys;
			$grand_tot_girls = $grand_tot_girls + $tot_girls;
			$grand_tot_amt = $grand_tot_amt + $tot_amt;

		?>
			<tr>
				<td class="tt"><center><?php echo $i; ?></center></td>
				<td class="tt"><center><?php echo  $value->BUS_NO; ?></center></td>
				<td class="tt"><?php echo $value->stopname; ?></td>
				<td class="tt"><center><?php echo $value->stp_amt; ?>/-<center></td>
				<td class="tt"><center><?php echo $value->TOTALSTUDENT; ?><center></td>
				<td class="tt"><center><?php echo $value->MALE; ?><center></td>
				<td class="tt"><center><?php echo $value->FEMALE; ?><center></td>
				<td class="tt"><center><?php echo $tot_amt; ?>/-<center></td>
			</tr>
		<?php
			$i++;
		}
		?>
	</tbody>
	<tfoot>
		<tr>
			<td class="tt"></td>
			<td class="tt" colspan="3"><b style="color:red;font-weight: 900;">GRAND TOTAL</b></td>
			<td class="tt"><center><b style="color:red;font-weight: 900;"><?php echo $grand_tot_stu; ?></b></center></td>
			<td class="tt"><center><b style="color:red;font-weight: 900;"><?php echo $grand_tot_boys; ?></b></center></td>
			<td class="tt"><center><b style="color:red;font-weight: 900;"><?php echo $grand_tot_girls; ?></b></center></td>
			<td class="tt"><center><b style="color:red;font-weight: 900;"><?php echo $grand_tot_amt; ?>/-</b></center></td>
		</tr>
	</tfoot>
	<p>Report Printed on <?php echo date('d/m/Y h:i:sa') ?></p>
</table>