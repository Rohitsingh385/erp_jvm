<style type="text/css">
    @page {
        margin: 50px 60px 60px 60px;
    }

    header {
        position: fixed;
        top: -20px;
        left: 0px;
        right: 0px;
    }

    #footer {
        position: fixed;
        right: 0px;
        bottom: 10px;
        text-align: right;
    }

    #footer .page:after {
        content: counter(page, decimal);
    }

    .thead-color {
        background: #337ab7 !important;
        color: white !important;
        text-align: center !important;
    }

    #div1 {
        /* display: inline-block; */
        float: left;
        width: 48%;
    }

    #div2 {
        float: right;
        width: 48%;
    }

    .table,tr,td {
        /* border-collapse: collapse; */
        font-size: 13px;
        width: 100%;
        border: 0.5px solid;
        border-spacing: 0px;
    }

    /* .table,
    th,
    td {
        border: 1px solid black;
    } */

    .text-right {
        text-align: right;
    }

    body {
        font-family: "Arial", Helvetica, sans-serif;
    }

    .text-center {
        text-align: center;
    }
    /* #table1{
        border: 1px solid black;
    } */
    

</style>

<body>
    <header id="header">
        <br>
        <img src="<?php echo $school_setting['SCHOOL_LOGO']; ?>" width="80px" height="80px">
        <div style="text-align: center; margin-top: -80px;">
            <span style="font-size: 25px;font-weight: bold;"><?php echo $school_setting['School_Name'] ?> </span>
            <br><span><?php echo $school_setting['School_Address'] ?> </span><br>
            <div style="text-align: center;">Consolidated Report for the month of <?= strtoupper(date('F', strtotime($year . '-' . $month . '-' . '01')) . ', ' . $year); ?></div>
    </header>
    <div id="footer">
        <!-- <p class="page">Page </p> -->
    </div>
    <br>
    <div class="content">
        <div class="main_div">
            <hr>
            <div id="div1">
                <table id="table1" class="table table-bordered table-striped">
                    <thead id="header-fixed">
                        <tr>
                            <th class="thead-color">Earning Head</th>
                            <th class="thead-color">Amount Rs.</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        $keys1 = array_keys($result['earning']);
                        foreach ($keys1 as $key => $value) {; ?>
                            <tr style="<?php if ($value == 'TOT EARNING') {
                                            echo "border-top:2px solid;border-bottom:2px solid; font-weight:700";
                                        } else {
                                            echo "";
                                        } ?>;">
                                <td style="text-align:center;"><?php echo $value;  ?></td>
                                <td style="text-align:right;"><?php echo number_format($result['earning'][$value],2); ?></td>
                            </tr>
                        <?php
                        } ?>

                    </tbody>
                </table>
            </div>
            <div id="div2">
                <table id="table2" class="table table-bordered table-striped">
                    <thead id="header-fixed">
                        <tr>
                            <th class="thead-color">Deduction Head</th>
                            <th class="thead-color">Amount Rs.</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        $keys2 = array_keys($result['deduction']);
                        foreach ($keys2 as $key => $value) {; ?>
                            <tr style="<?php if ($value == 'TOT DEDUCTION') {
                                            echo "border-top:2px solid;border-bottom:2px solid; font-weight:700";
                                        } else {
                                            echo "";
                                        } ?>;">
                                <td style="text-align:center;"><?php echo $value;  ?></td>
                                <td style="text-align:right;"><?php echo number_format($result['deduction'][$value],2); ?></td>
                            </tr>
                        <?php
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>

                        <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
        <div id="div3">
            <table id="table3" class="table table-bordered table-striped" style="font-weight: 700;width:100%">
                <tr>
                    <td>Net Pay : TOT EARNING - TOT DEDUCTION = <?php echo number_format($result['earning']['TOT EARNING'] - $result['deduction']['TOT DEDUCTION'], 0) ?></td>
                </tr>
            </table>
            <br>
            <table id="table3" class="table table-bordered table-striped" style="font-weight: 700;width:100%">
                <tr>
                    <td style="width:40%;">EPF :</td>
                    <td style="width:60%;"><?php echo number_format($result['data']['EPFF']); ?></td>
                </tr>
                <tr>
                    <td style="width:40%;">EPS :</td>
                    <td style="width:60%;"><?php echo number_format($result['data']['EPSS']); ?></td>
                </tr>
            </table>
            <br>
            <table id="table3" class="table table-bordered table-striped" style="font-weight: 700;width:100%">
                <tr>
                    <td style="width:40%;">EPF Subscribers :</td>
                    <td style="width:60%;"><?php echo number_format($result['data']['EPF COUNT']); ?></td>
                </tr>
                <tr>
                    <td style="width:40%;">EPS Subscribers :</td>
                    <td style="width:60%;"><?php echo number_format($result['data']['EPS COUNT']); ?></td>
                </tr>
            </table>
        </div>
    </div>
    <br/><br/><br/><br/><br/><br/><br/><br/>
    <span>CHECKED BY</span>
    <span style="float: right;">PRINCIPAL</span>
</body>