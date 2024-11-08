<br><br>
<table id="example" class="display nowrap" style="width:100%">
    <thead>
        <tr>
            <th style='background:#337ab7; color:#fff !important;'>Adm. No.</th>
            <th style='background:#337ab7; color:#fff !important;'>Student Name</th>
            <th style='background:#337ab7; color:#fff !important;'>Class-Sec</th>
            <th style='background:#337ab7; color:#fff !important;'>Roll No.</th>
            <th style='background:#337ab7; color:#fff !important;'>Remarks</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($data as $data) {
        ?>
            <tr>
                <td><?php echo $data->ADM_NO; ?></td>
                <td><?php echo $data->FIRST_NM . ' ' . $data->MIDDLE_NM; ?></td>
                <td><?php echo $data->DISP_CLASS . '-' . $data->DISP_SEC; ?></td>
                <td><?php echo $data->ROLL_NO; ?></td>
                <td><?php echo $data->REMARKS ?></td>

            </tr>
        <?php
        }
        ?>
    </tbody>
</table>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.5/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
<script>
    $(function() {
        
        new DataTable('#example', {
            dom: 'Bfrtip',
            buttons: [{
                extend: 'excelHtml5',
                title: 'Remarks of Class XI- : ' 
            }]
        });
    });
</script>