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
		margin-left: 150px !important;
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
		font-size: 14px;
	}

	.tt {
		font-size: 14px;
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
<table width="100%">
	<tr>
		<td id="tp-header" colspan="2">
			<center><?php echo $school_setting[0]->School_Name; ?><center>
		</td>
	</tr>
	<tr>
		<td id="mid-header" colspan="2">
			<center><?php echo $school_setting[0]->School_Address; ?><center>
		</td>
	</tr>
	<tr>
		<td id="last-header" colspan="2">
			<center>SESSION (<?php echo $school_setting[0]->School_Session; ?>)<center>
		</td>
	</tr>
	<tr>
		<td colspan="3">
			<center><span style="font-size:18px !important;">Stoppage Wise Student List </span></center>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			&nbsp;
		</td>
	</tr>
	<tr>
		<td style='width:20%;font-size:18px !important;text-align:center'>Bus Fare:- <?php echo $amt; ?> Rs Only/-</td>
		<td style='width:60%;font-size:18px !important;text-align:center'>Stoppage:- <?php echo $stoppage_name ?></td>
		<td style='width:20%;font-size:18px !important;text-align:center'>Trip:- <?php if ($trip_id == 1) {
																						echo 'SENIOR';
																					} elseif ($trip_id == 2) {
																						echo 'JUNIOR';
																					} else {
																						echo 'L.K.G / U.K.G';
																					} ?></td>
	</tr>
</table>
<hr>
<br />

<table width="100%" border="1" id="table2">
	<thead>
		<tr>
			<th class="th" style="width:5%">Sl No.</th>
			<th class="th" style="width:10%">Admission No.</th>
			<th class="th" style="width:20%">Student Name</th>
			<th class="th" style="width:20%">Father's Name</th>
			<th class="th" style="width:5%">Class</th>
			<th class="th" style="width:5%">Section</th>
			<th class="th" style="width:5%">Roll No.</th>
			<th class="th" style="width:10%">Contact No.</th>
			<th class="th" style="width:5%">Bus No.</th>
		</tr>

	</thead>
	<tbody>
		<?php
		$i = 1;
		foreach ($data as $key => $value) {
		?>
			<tr>
				<td class="tt" style="text-align: center;"><?php echo $i; ?></td>
				<td class="tt"><?php echo $value->ADM_NO; ?></td>
				<td class="tt"><?php echo $value->FIRST_NM; ?></td>
				<td class="tt"><?php echo $value->FATHER_NM; ?></td>
				<td class="tt"><?php echo $value->DISP_CLASS; ?></td>
				<td class="tt"><?php echo $value->DISP_SEC; ?></td>
				<td class="tt" style="text-align: center;"><?php echo $value->ROLL_NO; ?></td>
				<td class="tt"><?php echo $value->C_MOBILE; ?></td>
				<td class="tt" style="text-align: center;"><?php echo $value->BUS_NO; ?></td>
			</tr>
		<?php
			$i++;
		}
		?>
	</tbody>
	<footer>
		<p>Report Printed on <?php echo date('d/m/Y h:i:sa') ?></p>
	</footer>

</table>