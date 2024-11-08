<style>
	#table2 {
		border-collapse: collapse;
	}
	#img{
		float:left;
		height:130px;
		width:130px;
	}
	#tp-header{
		font-size:16px;
		font-weight:bold
	}
	#mid-header{
		font-size:14px;
		font-weight:bold
	}
	#last-header{
		font-size:12px;
		font-weight:bold
	}
	.th{
		background-color: #5785c3 !important;
		color : #fff !important;
	}
	td{padding:5px;height:30px;font-size:10px;font-family: Verdana,Geneva,sans-serif; }
	th{padding:5px;background-color:#e6e6e6;font-weight:bold}
	
</style>
<table width="100%" style="float:right;">
	<tr>
		<td id="tp-header"><center><?php echo $school_setting[0]->School_Name; ?><center></td>
	</tr>
	<tr>
		<td id="mid-header"><center><?php echo $school_setting[0]->School_Address; ?><center></td>
	</tr>
	<tr>
		<td id="last-header"><center>SESSION (<?php echo $school_setting[0]->School_Session; ?>)<center></td>
	</tr>
</table><br /><br /><br /><br /><br /><br /><br />
<center>Ward Category Report</center>
<hr>
<br />
<table width="100%" border='1' id="table2">
	<thead>
		<tr>
			<th >Sl. No.</th>
			<th>Adm. No.</th>
			<th>Student Name</th>
			<th>Class</th>
			<th>Section</th>
			<th>Father Name</th>
			<th>Phone No</th>
		
		</tr>
	</thead>
	<tbody>
		<?php
			$i =1;
		 foreach($student as $data_key){
			 ?>
			 <tr>
				 <td><?php echo $i; ?></a></td>
						<td><?php echo $data_key->ADM_NO; ?></td>
					    <td><?php echo $data_key->FIRST_NM; ?></td>
						<td><?php echo $data_key->DISP_CLASS; ?></td>
				        <td><?php echo $data_key->DISP_SEC; ?></td>
						<td><?php echo $data_key->FATHER_NM; ?></td>
						<td><?php echo $data_key->C_MOBILE; ?></td>
				</tr>
			 <?php
			 $i++;
		 }
		?>
	</tbody>
</table>