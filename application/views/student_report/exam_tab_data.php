<form action=<?php  echo base_url("student_report/exam_tabulation_data_new_pdf");?> method="post">
	<input type="hidden" name="session" id="session" value="<?php echo $session;?>">
	<input type="hidden" name="cls" id="cls" value="<?php echo $cls;?>">
	<input type="hidden" name="sec" id="sec" value="<?php echo $sec;?>">
	<input type="hidden" name="exm_type" id="exm_type" value="<?php echo $exm_type;?>">
	<br>
	<button class="btn btn-success">Download</button>
</form>
<br>
<div style="padding: 5px; background-color: white" class="table-responsive" ><br/><br/>
	<table class="table table-striped table-hover datatable" border='1'>
		<thead>
		<tr>
			<th>Name</th>
			<th>Adm. No.</th>
			<th>Roll No.</th>
			
			<?php
			foreach($subjects as $kkey){
			?>
			<th><?php echo $kkey->subj_nm;?></th>
			<?php
				if($cls != 12){
			?>
			
			<?php } ?>
			<?php } ?>
			
			<th>Total</th>
			
	    </tr>
		</thead>
		<tbody>
			<?php
			
	foreach($stu_data as $kkeyo){
		$gt = 0;
	?>
		<tr>
			<th><?php echo $kkeyo['name'];?></th>
			<td><?php echo $kkeyo['adm_no'];?></td>
			<td><?php echo $kkeyo['roll_no'];?></td>
			<?php foreach($kkeyo['subjects'] as $kk){
	?>
			<td><?php echo $kk['subject_marks'];?></td>
			<?php
				if($cls != 12){
			?>	
			
			<?php } ?>	
			<?php
				$gt += ($kk['opt_code'] != '1')?$kk['hundred']:0; 
			}?>
			
			<?php
				if($cls == 14){
					$divd = 5;
					$tot=$gt/4;
				}else{
					$divd = 4;
					$tot=$gt;
				}
			?>
			<td><?php echo $gt; ?></td>
			
		</tr>
	<?php } ?>
			
	</tbody>
	</table>
</div>
<br />
<script type="text/javascript">
        $(function () {
        $('.datatable').DataTable({
          'paging'      : false,
          'lengthChange': true,
          'searching'   : true,
          'ordering'    : false,
          'info'        : true,
          'autoWidth'   : true,
          'pageLength'  : 25,
          dom: 'Bfrtip',
          buttons: [
              {
                extend: 'excelHtml5',
                title: 'EXAM WISE TABULATION SHEET <?php echo $details[0]->ExamName;?> Class <?php echo $details[0]->CLASS_NM;?>-<?php echo $details[0]->SECTION_NAME;?>',
                              
              },
			  {
                extend: 'pdfHtml5',
				title: 'EXAM WISE TABULATION SHEET <?php echo $details[0]->ExamName;?> Class <?php echo $details[0]->CLASS_NM;?>-<?php echo $details[0]->SECTION_NAME;?>',
                orientation: 'landscape',
				alignment: 'center',
				pageSize: 'A3'
              }
          ],
        })
      });
</script>