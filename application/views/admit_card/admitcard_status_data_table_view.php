 <br />
   

  
 <table class="table table-bordered" id="example">
	<thead>
		<tr>
			
			<th>Sl No.</th>
			<th>Admission No.</th>
			<th>Roll No.</th>
			<th>Student Name</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php
		if($stu_list){
			$i = 1;
			foreach($stu_list as $data_key){
				?>
					<tr>
						
						<td><?php echo $i; ?></a></td>
						<td><?php echo $data_key->AdmNo; ?></td>
						<td><?php echo $data_key->ROLL_NO; ?></td>
						<td><?php echo $data_key->SName; ?></td>
						<td><?php echo ($data_key->sts=='0')?'Not Permitted':'Permitted'; ?></td>
						<?php if($data_key->sts=='0'){ ?>
<td>
    <?php 
echo form_open('Admit_card/modify_student_status');
echo form_hidden('Admno', $data_key->AdmNo);
?>
<center>
<input type="submit" class="btn btn-primary" value="Modify">
 </center>
 <?php echo form_close(); ?>
 </td>						


					<?php } else { ?>
						<td><span class="label label-success">All Ready Permitted</span></td>
					<?php } ?>
					</tr>
				<?php
				$i++;
			}
		}
	?>
	</tbody>
 </table>
 

</div>
<div class="inner-block"></div>
