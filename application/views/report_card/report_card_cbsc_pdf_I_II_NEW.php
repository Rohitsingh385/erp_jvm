<html>

<head>
    <title>Report Card I-II</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url('assets/dash_css/bootstrap.min.css'); ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Laila:700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .table1 {
            width: 100%;
            margin: 0 auto;
            table-layout: fixed;
            border: none;
            text-transform: uppercase;
        }

        .table1 th,
        .table1 td {
            border: 1px solid black;
            padding: 2px;
            font-size: 12px;

        }

        td {
            text-align: left;
        }

        .title {
            font-size: 18px;
        }

        .sign {
            font-family: 'Laila', serif;
            margin-top: 30px;
            margin-right: 20px;
        }

        .grd {
            text-align: left;
        }
    </style>
</head>

<body>
    <?php

    if (isset($result)) {
        $j = 1;
        $tot_rec = count($result);
        foreach ($result as $key => $data) {

            // echo '<pre>';
            // print_r($data);
            // die;
            $sign_ct = $data['DISP_CLASS'] . '_' . $data['DISP_SEC'] . '_CT.png';
    ?>
            <div style="padding:10px;display:none ;margin-top:-20px !important;" id='dyn_<?php echo $j; ?>'>
                <div id='background' style='position: absolute;z-index: -1;min-height: 100%;min-width: 100%;opacity: 1;margin:-30px;'>
                    <center><img src="<?php echo 'assets/school_logo/NUR_PREP_NEW.jpg' ?>" width="100%" height="100%" alt="Image Not Found"></center>
                </div>

                <table class='table1' width='100%'>
                    <center>
                        <img src="<?php echo $school_photo[0]->School_Logo_RT; ?>" style="width:80px;">
                    </center>
                    <tr>
                        <!-- <td>
                            <img src="<?php //echo $school_photo[0]->School_Logo; 
                                        ?>" style="width:80px;">
                        </td> -->
                        <td>
                            <center><span style='font-size:24px !important;'><b><?php echo $school_setting[0]->School_Name; ?></b></span><br />
                                <span style='font-size:14px !important'><b>
                                        <?php echo $school_setting[0]->School_Address; ?></b>
                                </span><br />
                                <b style='font-size:12px !important'>ACADEMIC SESSION: <?php echo $school_setting[0]->School_Session; ?></b>
                                <br />
                                <b style='font-size:12px !important'>Affiliation No.: 3430004 || School Code: 66230</b>

                                <br />
                                <span style='font-size:10px !important'>(Website: www.jvmshyamali.com || Email id: jvmshyamali@yahoo.com)</span>

                            </center>

                        </td>
                        <!-- <td style='text-align:right'>
                            <img src="<?php echo $school_photo[0]->School_Logo_RT; ?>" style="width:80px;">
                        </td> -->
                    </tr>
                </table>
                <table class="table1" style='border:1px solid #000;font-size:12px;padding:3px;width:100% !important;'>
                    <tr>
                        <th style='border:1px solid #000;font-size:12px;padding:1px;'>ADM. NO. : <?php echo $data['ADM_NO']; ?><input type='hidden' value='<?php echo $data['ADM_NO']; ?>' id='adm_<?php echo $j; ?>'></th>
                        <th colspan='2' style='border:1px solid #000;font-size:12px;padding:1px;'>STUDENT'S NAME : <?php echo $data['FIRST_NM'] . " " . $data['MIDDLE_NM']; ?></th>
                        <th style='border:1px solid #000;font-size:12px;padding:1px;'>CLASS - SEC : <?php echo $data['DISP_CLASS'] . ' - ' . $data['DISP_SEC']; ?></th>
                        <th style='border:1px solid #000;font-size:12px;padding:1px;'>ROLL NO. : <?php echo $data['ROLL_NO']; ?></th>
                    </tr>
                    <tr>
                        <th colspan='5' style='border:1px solid #000;font-size:12px;padding:1px;background-color: orange;color:white;'>
                            <center>MID TERM</center>
                        </th>
                    </tr>
                    <tr>
                        <th style='border:1px solid #000;font-size:12px;padding:1px;background-color: orange;color:white;'>SUBJECT</th>
                        <th style='border:1px solid #000;font-size:12px;padding:1px;background-color: orange;color:white;'>
                            <center>F.T-1</center>
                        </th>
                        <th style='border:1px solid #000;font-size:12px;padding:1px;background-color: orange;color:white;'>
                            <center>P.T-1</center>
                        </th>
                        <th style='border:1px solid #000;font-size:12px;padding:1px;background-color: orange;color:white;'>
                            <center> MID TERM</center>
                        </th>
                        <th style='border:1px solid #000;font-size:12px;padding:1px;background-color: orange;color:white;'>
                            <center>TOTAL[100]</center>
                        </th>
                    </tr>
                    <tr>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;'><b>ENGLISH</b></td>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;'></td>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;'></td>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;'></td>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;'></td>
                    </tr>
                    <tr>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;'>READING[5]</td>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;text-align: center;'>-</td>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;text-align: center;'>-</td>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;text-align: center;'><?php echo $data['sub']['111']['marks']['hy'] ?></td>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;text-align: center;'>-</td>
                    </tr>
                    <tr>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;'>HANDWRITING [5]</td>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;text-align: center;'>-</td>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;text-align: center;'>-</td>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;text-align: center;'><?php echo $data['sub']['112']['marks']['hy']; ?></td>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;text-align: center;'>-</td>
                    </tr>
                    <tr>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;'>DICTATION[10]</td>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;text-align: center;'>-</td>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;text-align: center;'>-</td>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;text-align: center;'><?php echo $data['sub']['113']['marks']['hy']; ?></td>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;text-align: center;'>-</td>
                    </tr>
                    <tr>

                        <td style='border:1px solid #000;font-size:12px;padding:1px;'>WRITTEN WORK[60]</td>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;text-align: center;'><?php echo $data['sub']['114']['marks']['ft']; ?></td>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;text-align: center;'><?php echo $data['sub']['114']['marks']['pt']; ?></td>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;text-align: center;'><?php echo $data['sub']['114']['marks']['hy']; ?></td>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;text-align: center;'>
                            <?php
                            $grand_tot = 0;
                            $m1_hy = 0;
                            $m2_hy = 0;
                            $m3_hy = 0;
                            $m4_pt = 0;
                            $m4_ft = 0;
                            $m4_hy = 0;

                            if ($data['sub']['111']['marks']['hy'] == 'AB') {
                                $m1_hy = 0;
                            } else {
                                $m1_hy = $data['sub']['111']['marks']['hy'];
                            }

                            if ($data['sub']['112']['marks']['hy'] == 'AB') {
                                $m2_hy = 0;
                            } else {
                                $m2_hy = $data['sub']['112']['marks']['hy'];
                            }

                            if ($data['sub']['113']['marks']['hy'] == 'AB') {
                                $m3_hy = 0;
                            } else {
                                $m3_hy = $data['sub']['113']['marks']['hy'];
                            }

                            if ($data['sub']['114']['marks']['pt'] == 'AB') {
                                $m4_pt = 0;
                            } else {
                                $m4_pt = $data['sub']['114']['marks']['pt'];
                            }

                            if ($data['sub']['114']['marks']['ft'] == 'AB') {
                                $m4_ft = 0;
                            } else {
                                $m4_ft = $data['sub']['114']['marks']['ft'];
                            }

                            if ($data['sub']['114']['marks']['hy'] == 'AB') {
                                $m4_hy = 0;
                            } else {
                                $m4_hy = $data['sub']['114']['marks']['hy'];
                            }


                            echo $m1_hy + $m2_hy + $m3_hy + $m4_pt + $m4_ft + $m4_hy;
                            $grand_tot = $m1_hy + $m2_hy + $m3_hy + $m4_pt + $m4_ft + $m4_hy;
                            ?></td>
                        </td>
                    </tr>
                    <tr>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;'><b>HINDI</b></td>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;text-align: center;'></td>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;text-align: center;'></td>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;text-align: center;'></td>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;text-align: center;'></td>
                    </tr>
                    <tr>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;'>READING[5]</td>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;text-align: center;'>-</td>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;text-align: center;'>-</td>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;text-align: center;'><?php echo $data['sub']['115']['marks']['hy']; ?></td>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;text-align: center;'>-</td>
                    </tr>
                    <tr>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;'>HANDWRITING[5]</td>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;text-align: center;'>-</td>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;text-align: center;'>-</td>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;text-align: center;'><?php echo $data['sub']['116']['marks']['hy']; ?></td>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;text-align: center;'>-</td>
                    </tr>
                    <tr>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;'>DICTATION[10]</td>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;text-align: center;'>-</td>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;text-align: center;'>-</td>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;text-align: center;'><?php echo $data['sub']['117']['marks']['hy']; ?></td>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;text-align: center;'>-</td>
                    </tr>
                    <tr>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;'>WRITTEN WORK[60]</td>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;text-align: center;'><?php echo $data['sub']['118']['marks']['ft']; ?></td>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;text-align: center;'><?php echo $data['sub']['118']['marks']['pt']; ?></td>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;text-align: center;'><?php echo $data['sub']['118']['marks']['hy']; ?></td>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;text-align: center;'>
                            <?php

                            $m1_hy = 0;
                            $m2_hy = 0;
                            $m3_hy = 0;
                            $m4_pt = 0;
                            $m4_ft = 0;
                            $m4_hy = 0;

                            if ($data['sub']['115']['marks']['hy'] == 'AB') {
                                $m1_hy = 0;
                            } else {
                                $m1_hy = $data['sub']['115']['marks']['hy'];
                            }

                            if ($data['sub']['116']['marks']['hy'] == 'AB') {
                                $m2_hy = 0;
                            } else {
                                $m2_hy = $data['sub']['116']['marks']['hy'];
                            }

                            if ($data['sub']['117']['marks']['hy'] == 'AB') {
                                $m3_hy = 0;
                            } else {
                                $m3_hy = $data['sub']['117']['marks']['hy'];
                            }

                            if ($data['sub']['118']['marks']['pt'] == 'AB') {
                                $m4_pt = 0;
                            } else {
                                $m4_pt = $data['sub']['118']['marks']['pt'];
                            }

                            if ($data['sub']['118']['marks']['ft'] == 'AB') {
                                $m4_ft = 0;
                            } else {
                                $m4_ft = $data['sub']['118']['marks']['ft'];
                            }

                            if ($data['sub']['118']['marks']['hy'] == 'AB') {
                                $m4_hy = 0;
                            } else {
                                $m4_hy = $data['sub']['118']['marks']['hy'];
                            }



                            echo $m1_hy + $m2_hy + $m3_hy + $m4_pt + $m4_ft + $m4_hy;
                            $grand_tot += $m1_hy + $m2_hy + $m3_hy + $m4_pt + $m4_ft + $m4_hy;
                            ?></td>
                    </tr>
                    <tr>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;'><b>MATHEMATICS</b></td>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;'><?php ?></td>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;'><?php ?></td>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;'><?php ?></td>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;'><?php ?></td>
                    </tr>
                    <tr>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;'>TABLES[10]</td>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;text-align: center;'>-</td>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;text-align: center;'>-</td>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;text-align: center;'><?php echo $data['sub']['119']['marks']['hy']; ?></td>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;text-align: center;'>-</td>
                    </tr>
                    <tr>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;'>WRITTEN WORK</td>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;text-align: center;'><?php echo $data['sub']['120']['marks']['ft']; ?></td>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;text-align: center;'><?php echo $data['sub']['120']['marks']['pt']; ?></td>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;text-align: center;'><?php echo $data['sub']['120']['marks']['hy']; ?></td>
                        <td style='border:1px solid #000;font-size:12px;padding:1px;text-align: center;'>
                            <?php

                            $m1_hy = 0;
                            $m3_pt = 0;
                            $m3_ft = 0;
                            $m3_hy = 0;

                            if ($data['sub']['119']['marks']['hy'] == 'AB') {
                                $m1_hy = 0;
                            } else {
                                $m1_hy = $data['sub']['119']['marks']['hy'];
                            }

                            if ($data['sub']['120']['marks']['pt'] == 'AB') {
                                $m3_pt = 0;
                            } else {
                                $m3_pt = $data['sub']['120']['marks']['pt'];
                            }

                            if ($data['sub']['120']['marks']['ft'] == 'AB') {
                                $m3_ft = 0;
                            } else {
                                $m3_ft = $data['sub']['120']['marks']['ft'];
                            }

                            if ($data['sub']['120']['marks']['hy'] == 'AB') {
                                $m3_hy = 0;
                            } else {
                                $m3_hy = $data['sub']['120']['marks']['hy'];
                            }


                            echo $m1_hy + $m3_pt + $m3_ft + $m3_hy;
                            $grand_tot += $m1_hy + $m3_pt + $m3_ft + $m3_hy;
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="3" style='border:1px solid #000;font-size:12px;padding:1px;background-color: orange;color:white;'>CO-SCHOLASTIC</th>
                        <th colspan="2" style='border:1px solid #000;font-size:12px;padding:1px;background-color: orange;color:white;'>MID TERM</th>
                    </tr>
                    <tr>
                        <td colspan="3" style='border:1px solid #000;font-size:12px;padding:1px;'>DISCIPLINE</td>
                        <td colspan="2" style='border:1px solid #000;font-size:12px;padding:1px;'><?php echo $data['skill_3'] ?></td>
                    </tr>
                    <tr>
                        <td colspan="3" style='border:1px solid #000;font-size:12px;padding:1px;'>HEIGHT (in cm)</td>
                        <td colspan="2" style='border:1px solid #000;font-size:12px;padding:1px;'><?php echo $data['Height']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="3" style='border:1px solid #000;font-size:12px;padding:1px;'>WEIGHT (in kg)</td>
                        <td colspan="2" style='border:1px solid #000;font-size:12px;padding:1px;'><?php echo $data['Weight']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="3" style='border:1px solid #000;font-size:12px;padding:1px;'>ART</td>
                        <td colspan="2" style='border:1px solid #000;font-size:12px;padding:1px;'><?php echo $data['skill_2'] ?></td>
                    </tr>
                    <tr>
                        <td colspan="3" style='border:1px solid #000;font-size:12px;padding:1px;'>MUSIC</td>
                        <td colspan="2" style='border:1px solid #000;font-size:12px;padding:1px;'><?php echo $data['skill_1'] ?></td>
                    </tr>
                    <tr>
                        <td colspan="3" style='border:1px solid #000;font-size:12px;padding:1px;'>CLEANLINESS</td>
                        <td colspan="2" style='border:1px solid #000;font-size:12px;padding:1px;'><?php echo $data['skill_4'] ?></td>
                    </tr>
                    <tr>
                        <td colspan="3" style='border:1px solid #000;font-size:12px;padding:1px;'>DAILY ASSESSMENT</td>
                        <td colspan="2" style='border:1px solid #000;font-size:12px;padding:1px;'><?php echo $data['skill_5'] ?></td>
                    </tr>
                    <tr>
                        <td colspan="3" style='border:1px solid #000;font-size:12px;padding:1px;'>ATTENDANCE</td>
                        <td colspan="2" style='border:1px solid #000;font-size:12px;padding:1px;'><?php echo $data['MAY_ATT'] . ' / ' . $data['APR_ATT']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="3" style='border:1px solid #000;font-size:12px;padding:1px;'>REMARKS</td>
                        <td colspan="2" style='border:1px solid #000;font-size:12px;padding:1px;'>
                            <?php

                            $perc = 0;
                            $perc = ($grand_tot / 300) * 100;

                            if ($perc <= '35') {
                                echo "Average";
                            } else if ($perc > '35' and $perc <= '55') {
                                echo "Good";
                            } else if ($perc > '56' and $perc <= '74') {
                                echo "Very Good";
                            } else if ($perc > '75' and $perc <= '89') {
                                echo "Excellent";
                            } else {
                                echo "Outstanding";
                            }
                            ?></td>
                    </tr>
                </table>

                <br>

                <table class='table2' style='width:100%;padding:2px;font-size:12px !important;'>
                    <tr>
                        <td class='sign' width='33.3%'>
                            <center><br /><img src="<?php echo 'assets/school_logo/' . $sign_ct; ?>" width="120px" height="52px"><br />Class Teacher's Signature</center>
                        </td>
                        <td class='sign' width='33.3%'><br />
                            <center><img src="<?php echo 'assets/school_logo/SECTION_IC_NUR_II.png' ?>" width="90px" height="52px"><br />Section In-charge's Signature</center>
                        </td>
                        <td class='sign' width='33.3%'>
                            <center><br /><img src="<?php echo 'assets/school_logo/sjana.png' ?>" width="70px" height="52px"><br />Principal's Signature</center>
                        </td>
                    </tr>

                </table>

            </div>
            <?php if ($tot_rec  > $j++) { ?>
                <div style='page-break-after: always;'></div>
            <?php } ?>
    <?php
        }
    }
    ?>

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <center><img class='img-responsive' src="<?php echo base_url('assets/images/loading.gif'); ?>"></center>
                </div>
            </div>
        </div>
    </div>
    <!-- end Modal -->

</body>

</html>

<script>
    var lp = '<?php echo $j; ?>';
    var lp = lp - 1;
    $('#myModal').modal('show');
    for (var i = 1; i <= lp; i++) {
        var ab = $("#dyn_" + i).html();
        var adm = $("#adm_" + i).val();
        $.ajax({
            url: "<?php echo base_url('report_card/report_card/adpdfNur') ?>",
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
</script>