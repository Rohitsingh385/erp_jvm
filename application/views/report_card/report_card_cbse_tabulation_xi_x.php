<style>
	 button.dt-button, div.dt-button, a.dt-button {
	  padding:2px;
  }
  .dataTables_paginate .paginate_button.current {
	 padding:2px;  
  }
	
	#examplel tr th{
	background-color:#0086b3;
		color:white !important;
		padding:8px;
	
	}

	</style>
<?php

$getSubj = $this->alam->selectA('class_section_wise_subject_allocation','subj_nm',"Class_No='$classs' AND section_no='$sec' AND applicable_exam='1'");

		?>
<table class='table' id='examplel'>
	<thead>
	<tr>
			<th>Student Name</th>
			<th>Adm. No</th>
		<th>Exam</th>
			<?php  
		foreach($getSubj as $subj){
	?>
<th><?php echo $subj['subj_nm'];?></th>
		<?php 
		
		}
		?>
		
</tr></thead>
	<tbody>
	<?php 
	
	foreach($result as $key => $value){
	?>
	<tr>
		<td><?php echo $value['FIRST_NM'];?></td>
		<td><?php echo $value['ADM_NO'];?></td>
		<td> </td>
		
		<?php  
		foreach($value['sub'] as $kki){
			
		?>
		<td> </td>
		
	
		<?
		
		}
		
		?>
		</tr>
		<tr>
			<td> </td><td> </td><td>PT-1</td>
				<?php  
		foreach($value['sub'] as $kki){
			
		?>
		<td><?php echo $kki['marks']['pt'];?>|<?php echo $kki['marks']['pt_s'];?> </td>

		<?
		
		}
		
		?>
		
	</tr>
			<tr>
			<td> </td><td> </td><td>PT-3 </td>
				<?php  
		foreach($value['sub'] as $kki){
			
		?>
		<td><?php echo $kki['marks']['pt3'];?>|<?php echo $kki['marks']['pt3_s'];?> </td>

		<?
		
		}
		
		?>
		
	</tr>
		<tr>
			<td> </td><td> </td><td>Half Yearly </td>
				<?php  
		foreach($value['sub'] as $kki){
			
		?>
		<td><?php echo $kki['marks']['half_yearly'];?>|<?php echo $kki['marks']['half_yearly_s'];?> </td>

		<?
		
		}
		
		?>
		
	</tr>
		
	<?php
	
	}
	?>
	</tbody>
</table>

<script>
$('#examplel').DataTable({
		dom: 'Bfrtip',
		ordering :false,
		buttons: [
			{
				extend: 'excelHtml5',
				title: 'Student Details',
			},
			{
				extend: 'pdfHtml5',
				title: 'Student Details',
			},
		]
	});
	</script>