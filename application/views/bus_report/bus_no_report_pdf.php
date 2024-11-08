<style>
    body {
        font-family: Verdana, Geneva, Tahoma, sans-serif;
    }

    #table2 {
        border-collapse: collapse;
        font-size: 13px;
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
        font-size: 13px;
    }

    .tt {
        font-size: 13px;
    }

    .table>thead>tr>th,
    .table>tbody>tr>th,
    .table>tfoot>tr>th,
    .table>thead>tr>td,
    .table>tbody>tr>td,
    .table>tfoot>tr>td {
        white-space: nowrap !important;
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
        <td>
            <center><span style="font-size:18px !important;">List Of Students Coming from Bus No : <?php echo $bus_no; ?></span></center>
        </td>

    </tr>

</table><br /><br /><br /><br /><br /><br />
<hr>
<br />

<?php
foreach ($stu_details as $key => $value) {
    if (empty($value)) {
        continue;
    }
?> <table width="100%">
        <tr>
            <td width='33%' style="text-align: left;font-weight:700;">Bus No.: <?php echo $bus_no; ?></td>
            <td width='33%' style="text-align: center;font-weight:700;">Stoppage: <?php echo $key; ?></td>
            <td width='33%' style="text-align: left;"></td>
        </tr>
    </table>
    <table width="100%" border="1" id="table2">

        <thead>
            <tr>
                <th width='5%'>Sl No.</th>
                <th width='5%'>Class</th>
                <th width='5%'>Sec</th>
                <th width='5%'>Roll No.</th>
                <th width='10%'>Admission No.</th>
                <th width='20%'>Student's Name</th>
                <th width='20%'>Father's Name</th>
                <th width='10%'>Contact No.</th>
                <th width='20%'>Ward Type</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($value as $val) { ?>
                <tr>
                    <td>
                        <center><?php echo $i; ?></center>
                    </td>
                    <td><?php echo $val->DISP_CLASS; ?></td>
                    <td><?php echo $val->DISP_SEC ?></td>
                    <td>
                        <center><?php echo $val->ROLL_NO ?></center>
                    </td>
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