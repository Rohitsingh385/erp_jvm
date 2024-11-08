<html>

<head>
    <title>Report Card NUR-PREP</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url('assets/dash_css/bootstrap.min.css'); ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Laila:700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        .table1 {
            width: 80%;
            padding: 2px;
        }

        td {
            text-align: center;
        }

        .table2 {
            border: 1px solid #000 !important;
            padding: 2px !important;
        }

        .title {
            font-size: 18px;
        }

        .sign {
            font-family: 'Laila', serif;
        }

        .grd {
            text-align: left;
            font-size: 12px;
        }


        /*#background {
			position: absolute;
			z-index: -1;
			display: block;
			min-height: 50%;
			min-width: 50%;
			opacity: 1;
			
		}*/
    </style>
</head>

<body>
    <?php
    if (isset($result)) {
        $j = 1;
        $tot_rec = count($result);
        foreach ($result as $key => $data) {
            // echo '<pre>';print_r($data);die;
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
                            <img src="<?php //echo $school_photo[0]->School_Logo; ?>" style="width:80px;">
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
                <br />

                <table style='width:100%;border:1px solid #000;padding:2px;font-size:14px !important;'>
                    <tr>
                        <td colspan="3" style="font-size: 20px !important; text-align: center; font-weight:700;background-color: orange;color:white;">PROGRESS REPORT</td>
                    </tr>
                    <tr>
                        <input type='hidden' value='<?php echo $data['ADM_NO']; ?>' id='adm_<?php echo $j; ?>'>
                        <th>ADMISSION NO. : <?php echo $data['ADM_NO']; ?></th>
                        <th><b>NAME : </b><?php echo $data['FIRST_NM'] . " " . $data['MIDDLE_NM']; ?></th>
                        <th><b>Roll No : </b><?php echo $data['ROLL_NO']; ?></th>
                    </tr>
                    <tr>
                        <td style="text-align: center; padding:2px;border:1px solid #000;background-color: orange;color:white;"><b>SUBJECT</b></td>
                        <td style="text-align: center; padding:2px;border:1px solid #000;background-color: orange;color:white;"><b>MID TERM</b></td>
                        <td style="text-align: center; padding:2px;border:1px solid #000;background-color: orange;color:white;"><b>GRADES</b></td>
                    </tr>
                    <tr>
                        <th style="padding:2px;border:1px solid #000;"><b>ENGLISH</b></th>
                        <td style="padding:2px;border:1px solid #000;"></td>
                        <td rowspan="18" style="padding:2px;border:1px solid #000;">
                            <p class="grd"><b>A+ :OUTSTANDING</b></p><br>
                            <p class="grd"><b>A :EXCELLENT</b></p><br>
                            <p class="grd"><b>B :VERY GOOD</b></p><br>
                            <p class="grd"><b>C :GOOD</b></p><br>
                            <p class="grd"><b>D :SCOPE FOR <br>IMPROVEMENT</b></p>
                        </td>
                    </tr>
                    <tr style="padding:2px;border:1px solid #000;">
                        <td style="padding:2px;border:1px solid #000;"> WRITTEN</td>
                        <td style="padding:2px;border:1px solid #000;"><?php echo $data['sub'][0]['marks']['skill1']; ?></td>
                    </tr>
                    <tr style="padding:2px;border:1px solid #000;">
                        <td style="padding:2px;border:1px solid #000;">ORAL</td>
                        <td style="padding:2px;border:1px solid #000;"><?php echo $data['sub'][0]['marks']['skill2']; ?></td>

                    </tr>
                    <tr style="padding:2px;border:1px solid #000;">
                        <th style="padding:2px;border:1px solid #000;"><b>HINDI</b></th>
                        <td style="padding:2px;border:1px solid #000;"></td>

                    </tr>
                    <tr style="padding:2px;border:1px solid #000;">
                        <td style="padding:2px;border:1px solid #000;"> WRITTEN</td>
                        <td style="padding:2px;border:1px solid #000;"><?php echo $data['sub'][1]['marks']['skill1']; ?></td>

                    </tr>
                    <tr style="padding:2px;border:1px solid #000;">
                        <td style="padding:2px;border:1px solid #000;"> ORAL</td>
                        <td style="padding:2px;border:1px solid #000;"><?php echo $data['sub'][1]['marks']['skill2']; ?></td>

                    </tr>
                    <tr style="padding:2px;border:1px solid #000;">
                        <th style="padding:2px;border:1px solid #000;"><b>MATHEMATICS</b></th>
                        <td style="padding:2px;border:1px solid #000;"></td>

                    </tr>
                    <tr style="padding:2px;border:1px solid #000;">
                        <td style="padding:2px;border:1px solid #000;"> WRITTEN</td>
                        <td style="padding:2px;border:1px solid #000;"><?php echo $data['sub'][2]['marks']['skill1']; ?></td>

                    </tr>
                    <tr style="padding:2px;border:1px solid #000;">
                        <td style="padding:2px;border:1px solid #000;"> ORAL</td>
                        <td style="padding:2px;border:1px solid #000;"><?php echo $data['sub'][2]['marks']['skill2']; ?></td>

                    </tr>
                    <tr style="padding:2px;border:1px solid #000;">
                        <th style="padding:2px;border:1px solid #000;"><b>DRAWING</b></th>
                        <td style="padding:2px;border:1px solid #000;"><?php echo $data['sub'][3]['marks']['skill1']; ?></td>

                    </tr>
                    <tr style="padding:2px;border:1px solid #000;">
                        <th style="padding:2px;border:1px solid #000;"><b>ATTENDANCE</b></th>
                        <td style="padding:2px;border:1px solid #000;"><?php echo $data['MAY_ATT'] . ' / ' . $data['APR_ATT']; ?></td>

                    </tr>
                    <tr style="padding:2px;border:1px solid #000;">
                        <th style="padding:2px;border:1px solid #000;"><b>HEIGHT (in cm)</b></th>
                        <td style="padding:2px;border:1px solid #000;"><?php echo $data['Height']; ?></td>

                    </tr>
                    <tr style="padding:2px;border:1px solid #000;">
                        <th style="padding:2px;border:1px solid #000;"><b>WEIGHT (in kg)</b></th>
                        <td style="padding:2px;border:1px solid #000;"><?php echo $data['Weight']; ?></td>

                    </tr>
                    <tr style="padding:2px;border:1px solid #000;">
                        <th style="padding:2px;border:1px solid #000;background-color: orange;color:white;"><b>CO-SCHOLASTIC</b></th>
                        <td style="padding:2px;border:1px solid #000;background-color: orange;color:white;"><b>MID TERM</b></td>

                    </tr>
                    <tr style="padding:2px;border:1px solid #000;">
                        <th style="padding:2px;border:1px solid #000;"><b>DISCIPLINE</b></th>
                        <td style="padding:2px;border:1px solid #000;"><?php echo $data['skill_1'] ?></td>

                    </tr>
                    <tr style="padding:2px;border:1px solid #000;">
                        <th style="padding:2px;border:1px solid #000;"><b>CLEANLINESS</b></th>
                        <td style="padding:2px;border:1px solid #000;"><?php echo $data['skill_2'] ?></td>

                    </tr>
                    <tr style="padding:2px;border:1px solid #000;">
                        <th style="padding:10px;border:1px solid #000;"><b>DAILY ASSESSMENT</b></th>
                        <td style="padding:2px;border:1px solid #000;"><?php echo $data['skill_2'] ?></td>

                    </tr>
                    <tr style="padding:2px;border:1px solid #000;">
                        <th style="padding:30px;border:1px solid #000;"><b>REMARKS</b></th>
                        <td style="padding:2px;border:1px solid #000;"><?php echo $data['rmks']; ?></td>

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
            url: "<?php echo base_url('report_card/report_card/adpdfNur'); ?>",
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