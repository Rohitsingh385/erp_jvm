<table class="table" id="example">
    <thead>
        <tr>
            <th style="background-color:#5785c3;">Sl No.</th>
            <th style="background-color:#5785c3;">Adm No.</th>
            <th style="background-color:#5785c3;">Student Name</th>
            <th style="background-color:#5785c3;">Roll No</th>
            <th style="background-color:#5785c3;">Class</th>
            <th style="background-color:#5785c3;">Section</th>
            <th style="background-color:#5785c3;">Marks</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        foreach ($topper_data as $key) {
        ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $key->admno; ?></td>
                <td><?php echo $key->FIRST_NM; ?></td>
                <td><?php echo $key->ROLL_NO; ?></td>
                <td><?php echo $key->DISP_CLASS; ?></td>
                <td><?php echo $key->DISP_SEC; ?></td>
                <td><?php echo $key->M3; ?></td>
            </tr>
        <?php $i++;
        }  ?>
    </tbody>
</table>
<script>
    $(document).ready(function() {
	var subj = "<?php echo $subjectname; ?>";
	var exam = "<?php echo $examname; ?>";
		
        $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: [
            {
                extend: 'csv',
                title: 'Topper List '+subj+' '+exam
            },
            {
                extend: 'excel',
                title: 'Topper List '+subj+' '+exam
            }
        ]
        });
    });
</script>