<html>

<head>
    <title>Report Card</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url('assets/dash_css/bootstrap.min.css'); ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Laila:700&display=swap" rel="stylesheet">
    <style>
        table tr th,
        td {
            font-size: 14px !important;
            padding: 3px !important;
        }

        @page {
            margin: 50px 20px 0px 20px !important;
        }

        .sign {
            font-family: 'Laila', serif;
        }

        .table1 {
            width: 100% !important;

        }

        .table1 {
            border-top: 0px !important;
            font-family: Verdana;
            padding: 5px !important;
        }
    </style>
</head>

<body>
    <?php
    if (isset($result)) {
        $j = 1;
        $tot_rec = count($result);
        foreach ($result as $key => $data) {
    ?>
            <div style="padding:10px;" id='dyn_<?php echo $j; ?>'>
                <table style='border:none !important; width:100%; border-top:0px !important' class='table1'>

                    <!-- <tr>
                        <td style="width: 25%;">
                            <br /><br /><img src="<?php echo $school_photo[0]->School_Logo_RT; ?>" style="width:100px;">
                        </td>

                        <td style="width: 50%;">
                            <center><span style='font-size:25px !important;'><?php echo $school_setting[0]->School_Name; ?></span><br />
                                <span style='font-size:18px !important'>
                                    <?php echo $school_setting[0]->School_Address; ?>
                                </span><br />
                                <b>(Affiliated to CBSE, New Delhi)</b>
                                <br />
                                <b>(Website: www.jvmshyamali.com) <br /> (Email id: jvmshyamali@yahoo.com)</b>

                            </center>
                        </td>

                        <td style='text-align:right; width:25%;'>
                            <br /><img src="<?php //echo $school_photo[0]->School_Logo;
                                            ?>" style="width:100px; margin-top: 16px;">
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <b>
                                <center>
                                    <span style='font-size:13px !important;'> REPORT CARD </span>
                                </center>
                            </b>
                        </td>
                        <td>
                        </td>
                    </tr> -->
                    <br><br><br><br><br><br><br><br>

                    <tr>
                        <td>
                            <span style='font-size:13px !important'>
                                <?php //echo $school_setting[0]->School_AfftNo; 
                                ?></span>
                        </td>
                        <td>
                            <b>
                                <center>
                                    <span style='font-size:13px !important;'>
                                        ACADEMIC SESSION: <?php echo $school_setting[0]->School_Session; ?>
                                    </span>

                                </center>
                            </b>
                        </td>
                        <td style='text-align:right'><span style='font-size:13px !important'><?php //echo $school_setting[0]->School_Code; 
                                                                                                ?></span></td>
                    </tr>

                </table>
                <br />

                <table class='table1' style="border: none !important;">
                    <tr>
                        <td>Admission No.&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo '<b>' . $data['ADM_NO'] . '</b>'; ?><input type='hidden' value='<?php echo $data['ADM_NO']; ?>' id='adm_<?php echo $j; ?>'></td>

                        <td>Class-Sec&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo '<b>' . $data['DISP_CLASS'] . " - " . $data['DISP_SEC'] . '</b>'; ?></td>
                        <td></td>
                        <td></td>

                    </tr>

                    <tr>
                        <td>Student's Name :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo '<b>' . $data['FIRST_NM'] . " " . $data['MIDDLE_NM'] . '</b>'; ?></td>
                        <td>Roll No.&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo '<b>' . $data['ROLL_NO'] . '</b>';; ?></td>
                        <td></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td>Mother's Name&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo '<b>' . $data['MOTHER_NM'] . '<b>'; ?></td>
                        <td colspan='5'></td>
                    </tr>

                    <tr style='border-bottom:0px !important'>
                        <td>Father's Name&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo '<b>' . $data['FATHER_NM'] . '<b>'; ?></td>
                        <td colspan='5'></td>

                    </tr>

                </table>
                <br />
                <center>
                    <table class='table' border='2px'>

                        <tr>
                            <th width='20%' rowspan="3" style="vertical-align: middle;"> SUBJECT NAME</th>
                            <th colspan="2" rowspan="2" width='17.6%' style="vertical-align: middle;">
                                <center>TERM - I </center>
                            </th>
                            <th colspan="5" width='44%' style='border-bottom:1px solid black !important'>
                                <center>TERM - II </center>
                            </th>
                            <th width='8.8%' rowspan="3" style="vertical-align: middle;">
                                <center> Grand Total</center>
                            </th>
                        </tr>

                        <tr>
                            <th colspan="2" width='17.6%'>
                                <center> Theory</center>
                            </th>
                            <th colspan="2" width='17.6%'>
                                <center> Practical</center>
                            </th>
                            <th width='8.8%' rowspan="2" style="vertical-align: middle;">
                                <center> Total Marks Obt.</center>
                            </th>
                            <!-- <th width='8.8%'></th> -->
                        </tr>
                        <tr>

                            <th>
                                <center>Max. Marks</center>
                            </th>
                            <th>
                                <center>Marks Obt.</center>
                            </th>

                            <th>
                                <center>Max. Marks</center>
                            </th>
                            <th>
                                <center>Marks Obt.</center>
                            </th>

                            <th>
                                <center>Max. Marks</center>
                            </th>
                            <th>
                                <center>Marks Obt.</center>
                            </th>

                        </tr>
                        <?php
                        $chk_marks = 0;
                        $grnd_tot = 0;
                        $i = 0;
                        $T_half_yearly2 = 0;
                        $T_obtained = 0;
                        $T_obtained_th_ut = 0;
                        ?>
                        <?php foreach ($data['sub'] as $subject) { ?>
                            <tr>
                                <th><?php echo $subject['subject_name']; ?></th>
                                <td>
                                    <center> 100</center>
                                </td>
                                <td>
                                    <center> <?php if($subject['marks']['half_yearly'] == '' || $subject['marks']['half_yearly'] == '-'){
                                        echo 'AB';
                                    }  else {
                                        echo $subject['marks']['half_yearly'];
                                    }?></center>
                                </td>
                                <td>
                                    <center> <?php if ($subject['subject_code'] == 24 || $subject['subject_code'] == 6 || $subject['subject_code'] == 33 || $subject['subject_code'] == 38 || $subject['subject_code'] == 4 || $subject['subject_code'] == 105 || $subject['subject_code'] == 42) {
                                                    echo '70';
                                                } else {
                                                    echo '80';
                                                }; ?></center>
                                </td>
                                <td>
                                    <center>
                                        <?php



                                        echo  $subject['marks']['theory'];

                                        ?>
                                    </center>
                                </td>

                                <td>
                                    <center> <?php if ($subject['subject_code'] == 24 || $subject['subject_code'] == 6 || $subject['subject_code'] == 33 || $subject['subject_code'] == 38 || $subject['subject_code'] == 4 || $subject['subject_code'] == 105 || $subject['subject_code'] == 42) {
                                                    echo '30';
                                                } else {
                                                    echo '20';
                                                }; ?></center>
                                </td>

                                <td>
                                    <center>
                                        <?php
                                        
                                        echo  $subject['marks']['practical'];

                                        ?>
                                    </center>
                                </td>
                                <td>
                                    <center> <?php echo $subject['marks']['obtained_th']; ?></center>
                                </td>

                                <td>
                                    <center><?php echo ($subject['marks']['theory'] + $subject['marks']['practical'] + $subject['marks']['half_yearly']); ?></center>
                                </td>
                            </tr>
                            <?php
                            if ($subject['opt_code'] != 1) {
                                $grnd_tot += $subject['marks']['marks_obtained'];
                                $T_half_yearly2 += $subject['marks']['half_yearly2'];
                                $T_obtained += $subject['marks']['obtained_th'];
                                // $T_obtained += $chk_marks1+$chk_marks;
                                $T_obtained_th_ut +=  $subject['marks']['theory'];
                                // $T_obtained_th_ut +=  $chk_marks;
                                $T_obtained_practical +=  $subject['marks']['practical'];

                                $i += 1;
                            }
                            $grd = 'E'
                            ?>
                        <?php }
                        ?>

                        <tr>
                            <td>
                                <center> Total </center>
                            </td>

                            <td></td>

                            <td>
                                <center><b> <?php echo $grnd_tot; ?> </b></center>
                            </td>

                            <td></td>

                            <td>
                                <center> <b><?php //echo $T_obtained_th_ut;  
                                            ?></b></center>
                            </td>

                            <td></td>

                            <td>
                                <center><b><?php //echo $T_obtained_practical; 
                                            ?></b></center>
                            </td>

                            <td>
                                <center> <b><?php echo $T_obtained; ?></b></center>
                            </td>
                            <td><center> <b><?php echo $T_obtained + $grnd_tot; ?></b></center></td>
                        </tr>

                    </table>
                </center>
                <div class='row'>
                    <div class='col-xs-12'>
                        <table>
                            <tr>
                                <th>
                                    RESULT: <?php echo $data['rsult']; ?>
                                </th>
                            </tr>
                            <tr>

                            </tr>
                        </table>
                    </div>
                </div>

                <br><br><br><br>

                <div class='row'>
                    <div class='col-sm-12'>
                        <table class='table1' style='font-size:10px! important; width:100%'>
                            <tr>
                                <td style="border: none;width:33.3%">
                                    <center>
                                        <br /><br /><br /><b>Class Teacher</b>
                                    </center>
                                </td>
                                <td style="border: none;width:33.3%">
                                    <center>
                                        <img src="<?php echo base_url('assets/school_logo/section_in_inc_xi.png') ?>" style='width:120px;height:50px'><br /><b>Section In-charge</b>
                                    </center>
                                </td>
                                <td style="border: none;width:33.3%">
                                    <center>
                                        <img src="<?php echo base_url('assets/school_logo/ppl_sign_stamp.png') ?>" style='width:100px;height:50px'><br /><b>Principal</b>
                                    </center>
                                </td>


                            </tr>
                        </table>
                        <!--<table style='border:1 !important; width: 100%' class='table' cellspacing=0;>
							<tr style='height:25px;'>
								<td style='font-size:6px; text-align:righr'><b>Published On: <?php echo date('d-M-y'); ?></b></td></tr>
						</table>-->
                    </div>
                </div>

                <!-- <div class='row'>
                    <div class='col-xs-12'>
                        <table class='table' border='1' style='border-top:2px solid #000;'>

                            <tr>
                                <td style='font-size:6px; text-align:right'><b>Published On: <?php echo date('d-M-y'); ?></b></td>
                            </tr>
                        </table>
                    </div>
                </div> -->


            </div>
            <?php if ($tot_rec  > $j++) { ?>
                <div style='page-break-after: always;'></div>
            <?php } ?>
    <?php
        }
    }
    ?>

    <!-- Modal -->
    <!-- <div id="myModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <center><img class='img-responsive' src="<?php echo base_url('assets/images/loading.gif'); ?>"></center>
                    </div>
                </div>
            </div>
        </div> -->
    <!-- end Modal -->

</body>

</html>

<!-- <script>
    var lp = '<?php //echo $j; 
                ?>';
    var lp = lp - 1;
    $('#myModal').modal('show');
    for (var i = 1; i <= lp; i++) {
        var ab = $("#dyn_" + i).html();

        var adm = $("#adm_" + i).val();
        $.ajax({
            url: "<?php //echo base_url('report_card/report_card/adpdf_annual_XI') 
                    ?>",
            data: {
                'value': ab,
                'idd': i,
                'admno': adm,
                'lp': lp
            },
            type: "POST",
            success: function(data) {
                if (lp == data) {
                    $('#myModal').modal('hide');
                    window.top.close();
                }
            }
        });
    }
</script> -->