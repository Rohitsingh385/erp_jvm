<?php
// echo '<pre>';
// print_r($getBusNoData);
// die;
?>

<style>
    .table>thead>tr>th,
    .table>tbody>tr>th,
    .table>tfoot>tr>th,
    .table>thead>tr>td,
    .table>tbody>tr>td,
    .table>tfoot>tr>td {
        white-space: nowrap !important;
    }
</style>
<form method="post" action="<?php echo base_url('bus_report/download_busnoreport'); ?>" target="_blank">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <input type="hidden" value="<?php echo $bus_no; ?>" name="stoppage_no">
            <button class="btn pull-right"><i class="fa fa-file-pdf-o"></i> Download</button>
        </div>
    </div>
</form><br />


<?php
foreach ($stu_details as $key => $value) {
    if (empty($value)) {
        continue;
    }
?>
    <table class="table table-bordered table-striped">
        <caption style="background-color: lightblue; !important;color:black;font-weight:700">&nbsp;&nbsp;Bus No: <?php echo $bus_no.'&ensp;&ensp;&ensp;Stoppage: '. $key; ?></caption>
        <thead>
            <tr>
                <th width='5%'>Sl No.</th>
                <th width='10%'>Class</th>
                <th width='10%'>Section</th>
                <th width='5%'>Roll No.</th>
                <th width='10%'>Admission No.</th>
                <th width='15%'>Student's Name</th>
                <th width='15%'>Father's Name</th>
                <th width='15%'>Contact No.</th>
                <th width='15%'>Ward Type</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($value as $val) { ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $val->DISP_CLASS; ?></td>
                    <td><?php echo $val->DISP_SEC ?></td>
                    <td><?php echo $val->ROLL_NO ?></td>
                    <td><?php echo $val->ADM_NO ?></td>
                    <td><?php echo $val->FIRST_NM ?></td>
                    <td><?php echo $val->FATHER_NM ?></td>
                    <td><?php echo $val->C_MOBILE ?></td>
                    <td><?php echo $val->WARD ?></td>
                </tr>
            <?php
                $i++;
            }
            ?>
        </tbody>
    </table>
    <br>
<?php

}
?>

<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable({
            dom: 'Bfrtip',
            ordering: false,
            buttons: [{
                extend: 'excelHtml5',
                title: 'Bus No. Wise Report."<?php echo 'busno :' . $buscode . 'section :' . $sec; ?>"'
            }, ]
        });
    });
</script>