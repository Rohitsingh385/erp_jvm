<!DOCTYPE html>
<html>

<head>
    <title>Generated Receipt</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <style type="text/css">
        @Media Print {
            #prl {
                display: none
            }
        }

        body #body {
            position: relative;
            top: 5px;
            margin: 10px;
        }

        .table_data {
            position: relative;
            top: -47px;
        }

            {
            padding: 0px;
            margin: 0px;
        }

        #box1 {
            margin-left: 5%;
            width: 70%;
            height: 10%;

        }

        #box2 {
            float: right;
            width: 48%;

        }

        #box3 {
            margin-left: 5%;
            width: 70%;
            height: 10%;


        }

        button {}

        img {
            float: left;
        }

        .table_heading {
            position: relative;
            left: 9px;
            top: 5px;
            padding: 10px;
            margin: 10px;
            line-height: 180%;
        }

        .heading {
            font-weight: bold;
            font-size: 13px;
            line-height: 180%;
        }

        .address {
            position: relative;
            top: -11px;
            font-size: 13px;
            line-height: 180%;
            /*left: -198px;*/
        }

        .telaff {
            font-size: 13px;
            position: relative;
            top: -22px;
        }

        .webemail {
            font-size: 13px;
            position: relative;
            top: -34px;
        }

        .feecopy {
            font-size: 14px;
            position: relative;
            top: -43px;
            left: 40px;
        }

        #sysbill {

            font-size: 12px;
        }

        #printing_button {
            position: relative;
            top: 10%;
        }

        @page {
            size: auto;
            /* auto is the initial value */
            margin-top: 6px;
            /* this affects the margin in the printer settings */
            margin-bottom: 0;
            margin-right: 20px;
            margin-left: 20px;
        }

        .table1 .tr1 .td1 {
            font-weight: bold;
            padding-top: 2px;
            font-size: 12px;
        }

        .table_main,
        tr,
        td {
            padding-top: 5px;
            padding-bottom: 5px;
        }

        .table1 {
            margin-left: 4px;
            margin-right: 2px;
        }

        .table_main,
        .tr_main,
        .td_main {
            text-align: center;
            font-size: 12px;
            font-weight: bold;
        }

        .fee_data {
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div id="body">
        <?php
        $today_date = date('Y-m-d');
        $school_logo = $school_setting[0]->SCHOOL_LOGO;
        $school_name = $school_setting[0]->School_Name;
        $school_add = $school_setting[0]->School_Address;
        $school_phone = $school_setting[0]->School_PhoneNo;
        $school_aff = $school_setting[0]->School_AfftNo;
        $school_web = $school_setting[0]->School_Webaddress;
        $school_email = $school_setting[0]->School_Email;
        $stuu_name = $student_details[0]->FIRST_NM . '' . $student_details[0]->MIDDLE_NM;
        $stu_admno = $student_details[0]->ADM_NO;
        $stu_class = $student_details[0]->DISP_CLASS;
        $stu_sec = $student_details[0]->DISP_SEC;
        $father_name = $student_details[0]->FATHER_NM;
        $mother_name = $student_details[0]->MOTHER_NM;
        $TOTAL = $stuData_fee[0]->Total;
        $order_status = $stuData_fee[0]->Status;


        //$order_status ='Success';
        $RECT_NO = $stuData_fee[0]->Receipt_No;
        $RECT_DATE = $stuData_fee[0]->Pay_Date;
        $number = $TOTAL;
        $no = round($number);
        $point = round($number - $no, 2) * 100;
        $hundred = null;
        $digits_1 = strlen($no);
        $i = 0;
        $str = array();
        $words = array(
            '0' => '',
            '1' => 'One',
            '2' => 'Two',
            '3' => 'Three',
            '4' => 'Four',
            '5' => 'Five',
            '6' => 'Six',
            '7' => 'Seven',
            '8' => 'Eight',
            '9' => 'Nine',
            '10' => 'Ten',
            '11' => 'Eleven',
            '12' => 'Twelve',
            '13' => 'Thirteen',
            '14' => 'Fourteen',
            '15' => 'Fifteen',
            '16' => 'Sixteen',
            '17' => 'Seventeen',
            '18' => 'Eighteen',
            '19' => 'Nineteen',
            '20' => 'Twenty',
            '30' => 'Thirty',
            '40' => 'Forty',
            '50' => 'Fifty',
            '60' => 'Sixty',
            '70' => 'Seventy',
            '80' => 'Eighty',
            '90' => 'Ninety'
        );
        $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
        while ($i < $digits_1) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += ($divider == 10) ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str[] = ($number < 21) ? $words[$number] .
                    " " . $digits[$counter] . $plural . " " . $hundred
                    :
                    $words[floor($number / 10) * 10]
                    . " " . $words[$number % 10] . " "
                    . $digits[$counter] . $plural . " " . $hundred;
            } else $str[] = null;
        }
        $str = array_reverse($str);
        $result = implode('', $str);
        $points = ($point) ?
            "." . $words[$point / 10] . " " .
            $words[$point = $point % 10] : '';
        $amtinword = "Rupees " . $result . "Only" /* . $points . " Paise" */;


        if ($order_status != '') {

        ?>

            <div id="box1">
                <img src="https://micaeduco.co.in/erp/assets/school_logo/1560227769.png" height="73px" width="78px;">
                <div class="table_heading">
                    <span class="heading">JAWAHAR VIDYA MANDIR, SHYAMALI</span><br>
                    <span class="address">Shyamali Colony, Doranda, Ranchi-834002</span><br>
<span class="address">Session: 2024-2025</span><br>
                    
					<span class="telaff"> Affiliation No.: 3430004</span><span class="telaff"> ||  School Code: 66230 </span><br>

                    <span class="webemail" style='margin-left:60px'>Website: www.jvmshyamali.com/</span><span class="webemail"> ||  Email ID: jvmshyamali@yahoo.com</span> --><br>

                </div>
                <table class="table_data" width="100%" border="1" class="trable_main">
                    <tr>
                        <td colspan="3">
                            <table width="100%" class="table1">
                                <tr class="tr1">
                                    <td class="td1">Receipt No.:</td>
                                    <td class="td1"><?php echo $RECT_NO; ?></td>
                                    <td class="td1">Receipt Date:</td>
                                    <td class="td1"><?php echo date('d-M-Y', strtotime($RECT_DATE)); ?></td>
                                </tr>
                                <tr class="tr1">
                                    <td class="td1">Adm No.:</td>
                                    <td class="td1"><?php echo $stu_admno; ?></td>
                                    <td class="td1">Class/Sec:</td>
                                    <td class="td1"><?php echo $stu_class . "/" . $stu_sec; ?></td>
                                </tr>
                                <tr class="tr1">
                                    <td class="td1">Student Name:</td>
                                    <td class="td1" colspan="3"><?php echo $stuu_name; ?></td>
                                </tr>
                                <tr class="tr1">
                                    <td class="td1">Father's Name:</td>
                                    <td class="td1"><?php echo $father_name; ?></td>
                                    <td class="td1">Transaction ID:</td>
                                    <td class="td1"><?php echo $stuData_fee[0]->Transaction_ID; ?></td>
                                </tr>

                                <tr class="tr1">
                                    <td class="td1">Fee For:</td>
                                    <td class="td1">CBSE REGISTRATION FEE</td>
                                    <td class="td1">Payment Mode:</td>
                                    <td class="td1">ONLINE</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr class="tr_main">
                        <td width="2%" class="td_main">Sl.No</td>
                        <td class="td_main">Description</td>
                        <td width="22%" class="td_main">Amount (&#8377;)</td>
                    </tr>

                    <tr>
                        <td width="2%">
                            <center>1</center>
                        </td>
                        <td class='td_main_data'> Registration Charges</td>
                        <td width="22%"><span style='float:right;font-size: 12px;'>&#x20B9; <?php echo $stuData_fee[0]->Registration_Charges; ?></span></td>
                    </tr>
                    <tr>
                        <td width="2%">
                            <center>2</center>
                        </td>
                        <td class='td_main_data'> Processing ICard Charges</td>
                        <td width="22%"><span style='float:right;font-size: 12px;'>&#x20B9; <?php echo $stuData_fee[0]->Processing_ICard_Charges; ?></span></td>
                    </tr>
                    <tr>
                        <td width="2%">
                            <center>3</center>
                        </td>
                        <td class='td_main_data'> Migration Charges</td>
                        <td width="22%"><span style='float:right;font-size: 12px;'>&#x20B9; <?php echo $stuData_fee[0]->Migration_Charges; ?></span></td>
                    </tr>
                    <tr>
                        <td width="2%">
                            <center>4</center>
                        </td>
                        <td class='td_main_data'> Practical Charges</td>
                        <td width="22%"><span style='float:right;font-size: 12px;'>&#x20B9; <?php echo $stuData_fee[0]->Practical_Charges; ?></span></td>
                    </tr>
                    <tr>
                        <td width="2%">
                            <center>5</center>
                        </td>
                        <td class='td_main_data'>Additional Subj Charges</td>
                        <td width="22%"><span style='float:right;font-size: 12px;'>&#x20B9; <?php echo $stuData_fee[0]->Additional_Subj_Charges; ?></span> </td>
                    </tr>
                    <tr class="tr_main">
                        <td colspan="2" class="td_main" style=" padding-right:5px;"><?php echo $amtinword; ?><span style='float:right'> Total Amount (&#8377;)</span></td>
                        <td class="td_main" style="text-align:right; padding-right:3px;">&#x20B9; <?php echo $stuData_fee[0]->Total; ?></td>
                    </tr>
                    <tr class="tr_main">
                        <td colspan="2" style='text-align:left;padding:8px'><br />
                            <p>
                                If amount is deducted from your Bank Account, kindly wait for 24 hours for the payment to get settled.<br />
                                If you receive mail from admin@atomtech.in, kindly forward the same to School's email id jvmshyamali@yahoo.com<br />
                                In case of any change/addition of Subject, extra amount will be charged.</p>
                        </td>
                        <td style="padding-top:15px;"></td>
                    </tr>
                </table>

            </div>
        <?php
        } else {

        ?>
            <div id="box3">
                     
                <div class="table_heading">
                    <span class="telaff"><center><strong>JAWAHAR VIDYA MANDIR, SHYAMALI</strong></center></span><br>
                    <span class="telaff"><center>Shyamali Colony, Doranda, Ranchi-834002</center></span><br>
					<span class="telaff"><center>Session: 2024-2025</center></span><br>
                    <center><span class="telaff"> Affiliation No.: 3430004</span><span class="telaff"> ||  School Code: 66230 </span>
					</center><br>
                    <center><span class="telaff">Website: www.jvmshyamali.com/</span><span class="webemail"> ||  Email ID: jvmshyamali@yahoo.com</span></center> <br>

                </div>

                </div><br>
                <table class="table_data" width="100%" border="1" class="trable_main">

                    <tr>
                        <td colspan="3">
                            <table width="100%" class="table1">
                                <tr class="tr1">
                                    <td class="td1">Date:</td>
                                    <td class="td1"><?php echo $today_date; ?></td>

                                </tr>
                                <tr class="tr1">
                                    <td class="td1">Adm No:</td>
                                    <td class="td1"><?php echo $stu_admno; ?></td>
                                    <td class="td1">Class/Sec:</td>
                                    <td class="td1"><?php echo $stu_class . "/" . $stu_sec; ?></td>
                                </tr>
                                <tr class="tr1">
                                    <td class="td1">Student Name:</td>
                                    <td class="td1" colspan="3"><?php echo $stuu_name; ?></td>
                                </tr>
                                <tr class="tr1">
                                    <td class="td1">Father Name:</td>
                                    <td class="td1"><?php echo $father_name; ?></td>
                                    <td class="td1">Transaction ID:</td>
                                    <td class="td1"><?php echo $stuData_fee[0]->Transaction_ID; ?></td>
                                </tr>

                                <tr class="tr1">
                                    <td class="td1">Fee For:</td>
                                    <td class="td1">CBSE REGISTRATION FEE</td>
                                    <td class="td1">Payment Mode:</td>
                                    <td class="td1"><?php echo 'ONLINE'; ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table width="100%" style="text-align: center; padding: 0px;">
                                <tr class="fee_data">
                                    <br><br><br>
                                    <td class="fee_data">
                                        <?php if ($stuData_fee[0]->F_Code == 'SUCCESS') { ?>
                                            <h4 style="color:green;">Your Transaction is Success!!!!!!</h4>
                                        <?php } else { ?>
                                            <h4 style="color:red;">Your Transaction is Failed!!!!!!</h4>
                                        <?php } ?>
                                    </td>
                                    <br><br><br>
                                </tr>

                            </table>
                        </td>
                    </tr>

                </table>

            </div>
        <?php

        }

        ?>
    </div>


    <div style="position: relative;  margin-left: 10%;" id='prl'>
        <button class="btn btn-primary" id="printing_button" onclick="window.print()">PRINT</button>&nbsp;<a class="btn btn-danger" id="print_cancel" href="<?php echo base_url('parent_dashboard/cbse_reg_fee/Cbse_fee/cbse_registration') ?>">BACK</a>
    </div>
    <br>
    <br>


</body>

</html>