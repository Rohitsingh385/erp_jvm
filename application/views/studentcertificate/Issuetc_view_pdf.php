<!-- <div>

    <br><br>
    <br><br>
    <br><br>
    <br>
</div> -->
<?php
if (isset($stu_list_all)) {
    $j = 1;
    $tot_rec = count($stu_list_all);

    foreach ($stu_list_all as $stu_list) { ?>
        <div class="parent">

        </div>
        <div>
            <p class="a" align="center">( Affiliated to CBSE-New Delhi, Code-CBSE/Affl./3430004 )<br>SHYAMALI, RANCHI - 834002, JHARKHAND</p>
            <h3>
                <center><span style="color:#000000;font-family: Verdana, Geneva, Tahoma, sans-serif !important;"><u>SCHOOL LEAVING CERTIFICATE</u></span></center>
            </h3>
            <table align="right" width="25%" class="thick">
                <tr>
                    <td>No.-<?php echo $stu_list['tcno']; ?></td>

                </tr>
            </table><br><br>

            <table width="100%">
                <tr>
                    <td>1. Registration No.</td>
                    <td>:</td>
                    <td class="thick"><?php echo $stu_list['adm_no']; ?></td>
                </tr>

                <tr>
                    <td>2. Student's Name </td>
                    <td>:</td>
                    <td class="thick"><?php echo $stu_list['stu_nm']; ?></td>
                </tr>
                <tr>
                    <td>3. Mother's Name</td>
                    <td>:</td>
                    <td class="thick"><?php echo $stu_list['mother_nm']; ?></td>
                </tr>
                <tr>
                    <td>4. Father's Name</td>
                    <td>:</td>
                    <td class="thick"><?php echo $stu_list['father_nm']; ?></td>
                </tr>
                <tr>
                    <td>5. Date of Admission</td>
                    <td>:</td>
                    <td class="thick"><?php echo date("d-m-Y", strtotime($stu_list['adm_date'])); ?></td>
                </tr>
                <tr>
                    <td>6. Class in which admitted</td>
                    <td>:</td>
                    <td class="thick"><?php echo $stu_list['class_admitted']; ?></td>
                </tr>
                <tr>
                    <td>7. Date of Birth</td>
                    <td>:</td>
                    <td class="thick"><?php echo date("d-m-Y", strtotime($stu_list['BIRTH_DT'])); ?><br><?php echo $stu_list['remarks1']; ?></td>
                </tr>
                <tr>
                    <td>8. Date on which student left the school</td>
                    <td>:</td>
                    <td class="thick"><?php echo date("d-m-Y", strtotime($stu_list['left_school'])); ?></td>
                </tr>
                <tr>
                    <td>9. Class in which stuent studied</td>
                    <td>:</td>
                    <td class="thick"><?php echo $stu_list['studied_class']; ?></td>
                </tr><br />
                <tr>
                    <td>10. Academic Year</td>
                    <td>:</td>
                    <td class="thick"><?php echo $stu_list['acad_year']; ?></td>
                </tr>
                <tr>
                    <td>11. Passing Year</td>
                    <td>:</td>
                    <td class="thick"><?php echo $stu_list['pass_year']; ?></td>
                </tr>
                <?php
                $p = explode('_', $stu_list['status']);
                $pstatus = $p[0] . ' ' . $p[1] . ' ' . $p[2];
                ?>
                <tr>
                    <td>12. Status </td>
                    <td>:</td>
                    <td class="thick"><?php echo strtoupper($pstatus); ?></td>
                </tr>
                <tr>
                    <td>13. Certificate Issue Date </td>
                    <td>:</td>
                    <td class="thick"><?php echo date("d-m-Y", strtotime($stu_list['cer_issue_date'])); ?></td>

                </tr>
                <tr>
                    <td>14. Nationality </td>
                    <td>:</td>
                    <td class="thick"><?php echo $stu_list['nationality']; ?></td>
                </tr>
            </table>
            <table STYLE="margin-left:350%;" class="thick">
                <tr>
                    <td>PRINCIPAL</td>
                </tr>
            </table>
        </div>
        <?php
        if ($tot_rec > $j++) { ?>
            <div style="page-break-before: always;">
<br>
            </div>
<?php }
    }
} ?>

<style type="text/css">
    .parent {
        margin: 30px auto 0 auto;
        width: 100px;
        height: 120px;
    }

    td {
		font-family: Verdana, Geneva, Tahoma, sans-serif !important;
        padding-top: 10px;
        padding-bottom: 10px;
    }

    h1 {
        font-size: 30px;
    }

    TD {

        font-family: Verdana, Geneva, Tahoma, sans-serif !important;
        font-size: 15px;

    }

    .thick {
        font-family: Verdana, Geneva, Tahoma, sans-serif !important;
        font-size: 14px;
        font-weight: bold;
    }

    body {
        padding-top: 10px;
        padding-right: 30px;
        padding-bottom: 10px;
        padding-left: 30px;
    }

    p {
        font-family: Verdana, Geneva, Tahoma, sans-serif !important;
        font-size: 15px;
    }

    .a {
        font-family: Verdana, Geneva, Tahoma, sans-serif !important;
        font-stretch: 150%;

    }
</style>
<style>
    .line {
        line-height: 1.9;
        text-align: justify;
        text-justify: inter-word;
    }
</style>