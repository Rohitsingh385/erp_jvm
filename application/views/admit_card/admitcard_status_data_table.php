 <br />
 <form method="post" action="<?php echo base_url('Admit_card/save_admitcard_status'); ?>">
  
 
  <input type="hidden" name="class_name" value="<?php echo $class;?>">
  <input type="hidden" name="sec_name" value="<?php echo $sec;?>">
 <table class="table table-bordered" id="example">
	<thead>
		<tr>
			
			<th>Sl No.</th>
			<th>Admission No.</th>
			<th>Roll No.</th>
			<th>Student Name</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php
		if($student){
			$i = 1;
			foreach($student as $data_key){
				?>
					<tr>
						
						<td><?php echo $i; ?></a></td>
						<td><?php echo $data_key->ADM_NO; ?>
<input type="hidden" name="hadm_mo[]" value="<?php echo $data_key->ADM_NO;?>">							

						</td>
						<td><?php echo $data_key->ROLL_NO; ?></td>
						<td><?php echo $data_key->FIRST_NM; ?></td>
						<td><select class="form-control" name="selstatus[]" id="selstatus">
					
					<option value="1">Permitted</option>
					<option value="0">Not Permitted</option>
					
				</select></td>
					</tr>
				<?php
				$i++;
			}
		}
	?>
	</tbody>
 </table>
 <div class="row">
			<div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
				<center>
					<button type="submit" class="btn btn-success">Save</button>
				</center>
			</div>
		</div>
 </form>
</div>
<div class="inner-block"></div>
