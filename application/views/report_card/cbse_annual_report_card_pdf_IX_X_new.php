<html>
<title>Report Card</title>

<head>
    <link rel="stylesheet" href="<?php echo base_url('assets/dash_css/bootstrap.min.css'); ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <style>
        .table>thead>tr>th,
        .table>tbody>tr>th,
        .table>tfoot>tr>th,
        .table>thead>tr>td,
        .table>tbody>tr>td,
        .table>tfoot>tr>td {
            font-size: 10px;
            padding: 3px !important;
            text-align: center;
        }

        @page {
            margin: 30px 10px 0px 10px;
        }

        .page-break {
            page-break-before: always;
        }

        .table1 {
            width: 100% !important;

        }

        td,
        th {
            padding-top: 8px !important;
            padding-bottom: 8px !important;
        }
    </style>
</head>

<body>
    <?php
    if (isset($result)) {
        $gg = 1;
        $tot_rec = count($result);
        foreach ($result as $key => $data) {

            // echo "<pre>";print_r($data['subject_nm']);die;
    ?>

            <div style="border:5px solid #000; padding:10px;" id='dyn_<?php echo $j; ?>'>
                <table class='table1'>
                    <tr>
                        <td>
                            <img src="<?php echo base_url($school_photo[0]->School_Logo); ?>" style="width:80px;">
                        </td>
                        <td>
                            <center><span style='font-size:22px !important;'><b><?php echo $school_setting[0]->School_Name; ?></b></span><br />
                                <span style='font-size:16px !important'><b>
                                        <?php echo $school_setting[0]->School_Address; ?></b>
                                </span><br />
                                <b style='font-size:14px !important'>ACADEMIC SESSION: <?php echo $school_setting[0]->School_Session; ?></b>
                                <br />
                                <b style='font-size:14px !important'>Affiliation No.: 3430004 || School Code: 66230</b>

                                <br />
                                <span style='font-size:12px !important'>(Website: www.jvmshyamali.com || Email id: jvmshyamali@yahoo.com)</span>

                            </center>

                        </td>
                        <td style='text-align:right'>
                            <img src="<?php echo base_url($school_photo[0]->School_Logo_RT); ?>" style="width:80px;">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <!--<span style='font-size:10px !important'>Affiliation No.-
                    <?php //echo $school_setting[0]->School_AfftNo; 
                    ?></span>-->
                        </td>
                        <td>
                            <b>
                                <center><span style='font-size:12px !important;'>REPORT CARD</span></center>
                            </b>
                        </td>
                        <!--<td style='text-align:right'><span style='font-size:10px !important'>School Code-<?php //echo $school_setting[0]->School_Code; 
                                                                                                                ?></span></td>-->
                    </tr>
                </table>
                <br>

                <table class='table1' style='font-size:10px! important;padding-top: 5px !important;'>
                    <tr>
                        <th>Admission No. :</th>
                        <td><?php echo $data['admno']; ?><input type='hidden' value='<?php echo $data['admno']; ?>' id='adm_<?php echo $j; ?>'></td>
                        <th>Class-Sec:</th>
                        <td><?php echo $data['class'] . " - " . $data['sec']; ?></td>

                    </tr>

                    <tr>
                        <th>Student's Name :</th>
                        <td><?php echo $data['stunm']; ?></td>
                        <th>Roll No.</th>
                        <td><?php echo $data['roll']; ?></td>
                    </tr>

                    <tr>
                        <th>Mother's Name :</th>
                        <td><?php echo $data['mname']; ?></td>
                        <th>Father's Name :</th>
                        <td><?php echo $data['fname']; ?></td>
                    </tr>

                    <tr>
                        <th>House :</th>
                        <td></td>
                        <th>Phone No. :</th>
                        <td><?php echo $data['mob']; ?></td>
                    </tr>

                    <tr>
                        <th>Attendance :</th>
                        <td><?php echo $data['present_days']. ' / '. $data['working_days']; ?></td>
                        <th>Date of Birth :</th>
                        <td>
                            <?php
                            $dob = date("d-M-Y", strtotime($data['dob']));
                            echo $dob;
                            ?></td>
                    </tr>

                    <!-- <tr>
                <th>Attendance :</th>
                <td></td>
                
            </tr> -->
                </table>
                <br><br>


                <table border='1' class='table'>
                    <tr style="font-weight: 700;">
                        <td style="vertical-align:middle;">SUBJECT NAME</td>
                        <td>PT-I<br>(05)<br>[A]</td>
                        <td>PT-II<br>(05)<br>[B]</td>
                        <td>PT-III<br>(05)<br>[C]</td>
                        <td>AVG. OF BEST 2 OF<br>A, B & C (05)<br>[D]</td>
                        <td>MULTIPLE<br>ASSESSMENT<br>(05)[E]</td>
                        <td>SUBJECT<br>ENRICHMENT<br>(05)[F]</td>
                        <td>PORTFOLIO<br>(05)<br>[G]</td>
                        <td>ANNUAL<br>(80)<br>[H]</td>
                        <td>TOTAL<br>(100)</td>
                        <td>GRADE</td>
                    </tr>

                    <?php
                    $termTot = 0;
                    $subTot   = 0;
                    $gt       = 0;
                    $pt1  = 0;
                    $pt2  = 0;
                    $pt3  = 0;
                    $avgpt = 0;
                    $bestpt = array();


                    foreach ($data['subject_nm'] as $key1 => $val1) {

                        $pt1 = $data['term'][1][$key1]['M3'];
                        $pt2 = $data['term'][4][$key1]['M3'];
                        $pt3 = $data['term'][8][$key1]['M3'];


                        $bestpt = array($pt1, $pt2, $pt3);
                        rsort($bestpt);
                        $avgpt = ($bestpt[0] + $bestpt[1]) / 2;

                        $termTot = ($avgpt + $data['term'][2][$key1]['M3'] + $data['term'][3][$key1]['M3'] + $data['term'][6][$key1]['M3'] + $data['term'][5][$key1]['M3']);

                        if ($key1 != '106') {
                            $gt      +=  $termTot;
                        }
                    ?>

                        <tr>
                            <td style="text-align:left;"><strong><?php echo $val1; ?></strong></td>


                            <td>
                                <center><?php echo $pt1; ?></center>
                            </td>

                            <td>
                                <center><?php echo $pt2; ?></center>
                            </td>

                            <td>
                                <center><?php echo $pt3; ?></center>
                            </td>

                            <td>
                                <center><?php echo $avgpt; ?></center>
                            </td>

                            <td>
                                <center><?php echo $data['term'][2][$key1]['M2']; ?></center>
                            </td>

                            <td>
                                <center><?php echo $data['term'][3][$key1]['M2']; ?></center>
                            </td>

                            <td>
                                <center><?php echo $data['term'][6][$key1]['M2']; ?></center>
                            </td>

                            <td>
                                <center><?php echo $data['term'][5][$key1]['M2']; ?></center>
                            </td>


                            <td>
                                <center><?php echo $termTot; ?></center>
                            </td>

                            <?php
                            foreach ($grademaster as $key => $grade) {
                                if ($grade->ORange >= $termTot && $grade->CRange <= $termTot) {
                                    $fin_grade = $grade->Grade;
                                    break;
                                }
                            }
                            ?>
                            <td>
                                <center><?php echo $fin_grade; ?></center>
                            </td>

                        </tr>

                    <?php  }

                    ?>

                    <tr>
                        <?php
                        $gingrds = $gt / 5;
                        ?>
                        <td colspan="9" style="text-align: right;">
                            GRAND TOTAL
                        </td>
                        <td>
                            <center><b><?php echo $gt; ?></b></center>
                        </td>
                        <td>
                            <?php
                            foreach ($grademaster as $key => $grade) {
                                if ($grade->ORange >= $gingrds && $grade->CRange <= $gingrds) {
                                    $gingrds = $grade->Grade;
                                    break;
                                }
                            }
                            echo "<center>" . $gingrds . "</center>";
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <?php
                        $gingrds = $gt / 5;
                        ?>
                        <td colspan='9' style="text-align: right;">
                            OVERALL PERCENTAGE
                        </td>
                        <td>
                            <center><b><?php echo number_format($gingrds, 2); ?> %</b></center>
                        </td>
                        <td></td>

                    </tr>
                    <tr>
                        <td colspan='11'>
                            <center><b>***** IT is excluded from Grand Total.</b></center>
                        </td>
                    </tr>
                </table>

                <table border='1' class="table1"  style='border-top:2px solid #000;font-size:11px! important;width:100%'>
                    <tr>
                        <th width='33%'><center>ART</center></th>
                        <th width='33%'><center>MUSIC</center></th>
                        <th width='33%'><center>GAMES</center></th>
                    </tr>
                    <tr>
                        <td><center><?php echo '&nbsp;'.$data['termskill'][2]['grade'].'&nbsp;'; ?></center></td>
                        <td><center><?php echo '&nbsp;'.$data['termskill'][1]['grade'].'&nbsp;'; ?></center></td>
                        <td><center><?php echo '&nbsp;'.$data['termskill'][3]['grade'].'&nbsp;'; ?></center></td>
                    </tr>
                </table>
                <br />
                <br />

                <div class='row'>
                    <div class='col-sm-12' style='margin-top:-22px! important'>
                        <table class='table' border='1' style='border-top:2px solid #000;font-size:11px! important;width:100%'>
                            <tr>
                                <th colspan="2" style="width: 100% !important;">
                                    <center><b>REMARKS</b></center>
                                </th>
                            </tr>
                            <tr>
                                <th colspan="2" style="width: 50% !important;height: 80px !important;">
                                </th>
                            </tr>
                            <tr>
                                <td style="width: 50% !important;text-align: left;"><b>Promoted to / Detained in</b>
                                </td>
                                <td>

                                </td>
                            </tr>
                            <tr>
                                <td style="width: 50% !important;text-align: left;"><b>NEW SESSION COMMENCES FROM: </b>03-Apr-2024</td>
                                <td>03-Apr-2024</td>
                            </tr>

                        </table>
                    </div>
                </div>
                <br>
                <br>
                <br>

                <div class='row'>
                    <div class='col-sm-12'>
                        <table class='table1' style='font-size:10px! important;'>


                            <tr>
                                <td class='sign'>
                                    <center><br /><br /><br /><br /><br /><br />Parent's Signature</center>
                                </td>
                                <td class='sign'>
                                    <center><br /><br /><br /><br /><br /><br />Class Teacher's Signature</center>
                                </td>


                                <td class='sign'>
                                    <center><img src='http://micaeduco.co.in/erp/assets/school_logo/sec_in_charge.png' style='width:80px;height:90px;'><br />Section In-charge's Signature</center>
                                </td>
                                <td class='sign'>
                                    <center><img src='http://micaeduco.co.in/erp/assets/school_logo/sjana.png' style='width:80px;height:90px;'><br />Principal's Signature</center>
                                </td>
                            </tr>

                        </table>
                        <!--<table style='border:1 !important; width: 100%' class='table' cellspacing=0;>
							<tr style='height:25px;'>
								<td style='font-size:6px; text-align:righr'><b>Published On: <?php echo date('d-M-y'); ?></b></td></tr>
						</table>-->
                    </div>
                </div>

            </div>
            <footer style='page-break-after: always;'></footer>
    <?php
        }
    }

    ?>
</body>

</html>