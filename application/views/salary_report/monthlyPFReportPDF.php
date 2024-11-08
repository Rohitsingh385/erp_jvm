<html>
<head>
    <title>Monthly PF Report</title>
    <style>
        @page {
            margin: 120px 25px 60px 10px;
        }

        header {
            position: fixed;
            top: -100px;
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

        .table {
            border-collapse: collapse;
            font-size: 10px;
            white-space: nowrap;
            width: 100%;
        }

        .table,
        th,
        td {
            border: 1px solid black;
        }

        .name {
            text-align: left;
        }

        .text-center {
            text-align: center;
            /* font-weight: bold; */
        }

        .text-right {
            text-align: right;
        }

        .thead-color {
            background: #abb0ac !important;
            border-color: black !important;
        }
    </style>
</head>

<body>
    <header id="header">
        <img src="<?php echo $school_setting['SCHOOL_LOGO']; ?>" width="80px" height="80px">
        <div style="text-align: center; margin-top: -70px;">
            <span style="font-size: 25px;font-weight: bold;"><?php echo $school_setting['School_Name'] ?> </span>
            <br><span><?php echo $school_setting['School_Address'] ?> </span><br>
            <span>Monthly PF Report(<?php echo date('F', strtotime($year . '-' . $month . '-1')) . '-' . $year; ?>)</span>
        </div>
    </header>
    <hr>
    <div id="content">
        <table class="table">
            <thead id="header-fixed">
                <tr>
                    <th class="thead-color"></th>
                    <th class="thead-color"></th>
                    <th class="thead-color"></th>
                    <th class="thead-color" colspan="4"><center>Wages</center></th>
                    <th class="thead-color" colspan="4"><center>Contibution<br> Remitted</center></th>
                    <th class="thead-color"></th>
                    <th class="thead-color"></th>
                </tr>
                <tr>
                    <th class="thead-color">Sl. No. </th>
                    <th class="thead-color">UAN Number</th>
                    <th class="thead-color">UAN<br>Repository</th>
                    <th class="thead-color">Gross</th>
                    <th class="thead-color">EPF</th>
                    <th class="thead-color">EPS</th>
                    <th class="thead-color">EDLI</th>
                    <th class="thead-color">EPF<br> Cont.<br> Remitted</th>
                    <th class="thead-color">EPS<br>Cont.<br>Remitted</th>
                    <th class="thead-color">EPF<br>EPS<br>Diff<br>Remitted</th>
                    <th class="thead-color">NCP Days</th>
                    <th class="thead-color">Refunds</th>
                    <th class="thead-color">VPF</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_gross=0;
                $total_epf=0;
                $total_eps=0;
                $total_edli=0;
                $total_epfcont=0;
                $total_epfcont=0;
                $total_diff=0;
                $total_vpf=0;
                $i=1;
                foreach ($resultList as $key => $value) { 
                    $eps_wages = 0; ?>
                    <tr>
                        <td class="text-center"><?php echo $i; ?></td>
                        <td><?php echo $value['UANNO']; ?></td>
                        <td><?php echo $value['EMP_FNAME'] . ' ' . $value['EMP_MNAME'] . ' ' . $value['EMP_LNAME']; ?></td>
                        <td class="text-right"><?php echo $epf_wages = $value['gross_salary']; ?></td>
                        <td class="text-right"><?php echo number_format($value['basic_salary'] + $value['da_pay'] + $value['arrear_basic'] + $value['arrear_da'], 0); ?></td>
                        <td class="text-right"><?php

                                                if ($value['pension_applied'] == 1 && $epf_wages != 0) {
                                                    if ($value['basic_salary'] > 15000) {
                                                        echo $eps_wages = "15000";
                                                    } else {
                                                        echo $eps_wages = $value['basic_salary'];
                                                    }
                                                } else {
                                                    echo $eps_wages;
                                                } ?>
                        </td>
                        <td class="text-right"><?php echo $eps_wages; ?></td>
                        <td class="text-right"><?php echo $epf_cont = $value['pf_own_deduct']; ?></td>
                        <td class="text-right"><?php if ($value['pension_applied'] == 1) {
                                                    echo $eps_cont = round(($eps_wages * $value['pension_rate']) / 100);
                                                } else {
                                                    echo $eps_cont = 0;
                                                } ?></td>
                        <td class="text-right"><?php echo $epf_cont - $eps_cont; ?></td>
                        <td class="text-right"><?php echo $value['total_working_days'] - $value['total_present']; ?></td>
                        <!-- <td class="text-right"><?php //echo 0; 
                                                    ?></td> -->
                        <td class="text-right"><?php echo 0; ?></td>
                        <td class="text-right"><?php echo $value['vpf_deduct']; ?></td>
                    </tr>
                <?php
            $total_gross += $value['gross_salary'];
            $total_epf +=$value['basic_salary'] + $value['da_pay'] + $value['arrear_basic'] + $value['arrear_da'];
            $total_eps += $eps_wages;
            $total_edli += $eps_wages;
            $total_epfcont += $epf_cont;
            $total_epscont += $eps_cont;
            $total_diff += $epf_cont - $eps_cont;            
            $total_vpf += $value['vpf_deduct'];
            $i++;
            } ?>
                <tr>
                    <td class="text-right" colspan="3" style="font-weight: bold;">Total</td>
                    <td class="text-right" style="font-weight: bold;"><?php echo number_format($total_gross,0); ?></td>
                    <td class="text-right" style="font-weight: bold;"><?php echo number_format($total_epf,0); ?></td>
                    <td class="text-right" style="font-weight: bold;"><?php echo number_format($total_eps,0); ?></td>
                    <td class="text-right" style="font-weight: bold;"><?php echo number_format($total_edli,0); ?></td>
                    <td class="text-right" style="font-weight: bold;"><?php echo number_format($total_epfcont,0); ?></td>
                    <td class="text-right" style="font-weight: bold;"><?php echo number_format($total_epscont,0); ?></td>
                    <td class="text-right" style="font-weight: bold;"><?php echo number_format($total_diff,0); ?></td>
                    <td></td>
                    <td></td>
                    <td class="text-right" style="font-weight: bold;"><?php echo number_format($total_vpf,0); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <br>
</body>
