<style>
    body{
        font-family: Verdana, Geneva, Tahoma, sans-serif;
    }
    #table2 {
        border-collapse: collapse;
    }

    #table3 {
        border-collapse: collapse;
    }

    #img {
        float: left;
        height: 80px;
        width: 80px;
        margin-top: 10px;
        margin-left: 20px !important;
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
        background-color: #5785c3 !important;
        color: #fff !important;
        font-size: 18px;
    }

    .tt {
        font-size: 15px;
    }

    .table>thead>tr>th,
    .table>tbody>tr>th,
    .table>tfoot>tr>th,
    .table>thead>tr>td,
    .table>tbody>tr>td,
    .table>tfoot>tr>td {
        white-space: nowrap !important;
    }
    .td{
        text-align: center;
        font-size: 14px;
    }
    p{
        font-size: 14px;
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
            <center><span style="font-size:18px !important;">Bus No. Summary Statement as on : <?php
                                                                                                $currentDate = date('Y-m-d');
                                                                                                $timestamp = strtotime($currentDate);
                                                                                                echo $new_date = date("d-m-Y", $timestamp);
                                                                                                ?></span></center>
        </td>

    </tr>

</table><br /><br /><br /><br /><br /><br />
<hr>
<br />
<table width="100%" border="1" id="table2">
    <thead>
        <tr>
            <th class='td'>Sl. No.</th>
            <th class='td'>Bus No.</th>
            <th class='td'>Total Students</th>
            <th class='td'>Total Boys</th>
            <th class='td'>Total Girls</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $grand_tot_stu = 0;
        $grand_tot_boys = 0;
        $grand_tot_girls = 0;
        $i = 1;
        foreach ($data as $key => $value) {
            $grand_tot_stu = $grand_tot_stu + $value->TOTAL;
            $grand_tot_boys = $grand_tot_boys + $value->BOYS;
            $grand_tot_girls = $grand_tot_girls + $value->GIRLS;
        ?>
            <tr>
                <td class='td'><?php echo $i; ?></td>
                <td class='td'><?php echo $value->BUS_NO; ?></td>
                <td class='td'><?php echo $value->TOTAL; ?></td>
                <td class='td'><?php echo $value->BOYS; ?></td>
                <td class='td'><?php echo $value->GIRLS; ?></td>
            </tr>
        <?php
            $i++;
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <td></td>
            <td class='td'><b style="color:red;font-weight: 900;">GRAND TOTAL</b></td>
            <td class='td'><b style="color:red;font-weight: 900;"><?php echo $grand_tot_stu; ?></b></td>
            <td class='td'><b style="color:red;font-weight: 900;"><?php echo $grand_tot_boys; ?></b></td>
            <td class='td'><b style="color:red;font-weight: 900;"><?php echo $grand_tot_girls; ?></b></td>
        </tr>
    </tfoot>
    <p>Report Printed on <?php echo date('d/m/Y h:i:sa') ?></p>
</table>