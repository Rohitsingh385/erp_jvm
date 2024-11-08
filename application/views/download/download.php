<br />
<select onchange="dwnld(this.value)" class='form-control'>
	<option value=''>Select</option>
	<?php
		foreach($secData as $key => $val){
			?>
				<option value='<?php echo $val['sec']; ?>'><?php echo $val['sec']; ?></option>
			<?php
		}
	?>
</select>
<br /><br />

<script>
	function dwnld(value){
		$.ajax({
			url: "<?php echo base_url('download/profile_download'); ?>",
			type: "POST",
			data: {value:value},
			success: function(res){
				//alert(res);
			} 
		});
	}
</script>