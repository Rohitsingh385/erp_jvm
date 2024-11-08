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
		background-color: #5785c3 !important;
		color: #fff !important;
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

	.td {
		font-size: 13px;
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
		<td colspan="2">
			<center><span style="font-size:18px !important;">Bus No Wise Student List </span></center>
		</td>
	</tr>
	<tr>
		<td colspan="2" style="text-align: right;">
			<span style="font-size:18px !important;">Trip :- <?php echo $trip; ?></span>
		</td>
	</tr>

</table>
<br /><br /><br /><br /><br /><br /><br />
<hr>
<br />


<table width="100%" border="1" id="table2">
	<thead>
		<tr>
			<th  class="td" width='4%'>Sl No.</th>
			<th  class="td" width='10%'>Admission No.</th>
			<th  class="td" width='20%'>Student's Name</th>
			<th  class="td" width='20%'>Father's Name</th>
			<th  class="td" width='5%'>Class</th>
			<th  class="td" width='5%'>Sec</th>
			<th  class="td" width='11%'>Contact No.</th>
			<th  class="td" width='20%'>Stoppage Name</th>
			<th  class="td" width='5%'>Bus No</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$i = 1;
		foreach ($getBusNoData as $key => $value) {

		?>
			<tr>
				<td class="td">
					<center><?php echo $i; ?></center>
				</td>
				<td class="td"><?php echo $value->ADM_NO; ?></td>
				<td class="td"><?php echo $value->FIRST_NM; ?></td>
				<td class="td"><?php echo $value->FATHER_NM; ?></td>
				<td class="td"><?php echo $value->DISP_CLASS; ?></td>
				<td class="td"><?php echo $value->DISP_SEC; ?></td>
				<td class="td"><?php echo $value->C_MOBILE; ?></td>
				<td class="td"><?php echo $value->stoppage; ?></td>
				<td class="td"><center><?php echo $value->BUS_NO; ?></center></td>
			</tr>
		<?php
			$i++;
		}
		?>
	</tbody>
	<p>Report Printed on <?php echo date('d/m/Y h:i:sa') ?></p>
</table>