<style>
    body {
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        margin: 2%;
    }

    .border-primary {
        border-radius: 25px;
        border: 1px solid;
    }

    .card-header {
        text-align: center;
        margin-top: -30px;
        font-weight: 700;
        font-size: 13px;

    }

    .card-title {
        text-align: center;
    }

    .container {
        width: 100%;
    }

    .card1 {
        width: 45% !important;
        height: 20%;
        float: left;
        font-size: 10px;
        padding-bottom: 10px;
    }

    .card2 {
        width: 45% !important;
        height: 20%;
        float: right;
        font-size: 10px;
        padding-bottom: 10px;
    }

    .card-body {
        width: 100%;
        padding-left: 10px;
        margin-left: 5%;
        font-size: 10px;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
    }

    .img {
        margin-top: 15px;
        margin-left: 15px;
    }

    .blank {
        height: 20% !important;
    }

    .heading {
        text-align: center;
        font-weight: 600;
    }

    .footer {
        margin-left: 10%;
    }

    pre {
        font-family: Verdana, Geneva, Tahoma, sans-serif;

    }
</style>
<?php

$i = 0;
$j = 1;
?>

<div class="container">
    <?php
    foreach ($result as $key => $val) { ?>
        <?php if ($i % 2 == 0) { ?>
            <div class="card1 border-primary float-left " style="width: 45%;">
                <div class="img">
                    <img src="<?php echo $school_setting['SCHOOL_LOGO']; ?>" width="40px" height="40px">
                </div>
                <div class="card-header">
                    <?php echo $school_setting['School_Name'] ?>
                </div>
                <br>
                <div class="heading">
                    <u>HALL TICKET - <?php echo $exam_name . "&nbsp;(" . $school_setting['School_Session'] . ")"; ?></u>
                </div>
                <br>
                <table class="card-body">
                    <tr>
                        <td style="width: 100%;">
                            Name - <u><?php echo $val->first_nm;  ?></u>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Class - <u><?php echo $val->disp_class; ?></u>
                        </td>
                        <td>
                            Sec - <u><?php echo $val->disp_sec;  ?></u>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Regn. Id- <u><?php echo $val->Adm_no;  ?></u>
                        </td>
                        <td>
                            Roll No.- <u><?php echo $val->roll_no;  ?></u>
                        </td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr style="width:100%">
                        <td style="width:50%;text-align:left">
                            SIGN C.T.
                        </td>
                        <td style="width:50%;text-align:left">
                            SEC.IN-CHARGE
                        </td>
                    </tr>
                </table>
            </div>
        <?php  } else { ?>
            <div class="card2 border-primary float-right" style="width: 45%;">
                <div class="img">
                    <img src="<?php echo $school_setting['SCHOOL_LOGO']; ?>" width="40px" height="40px">
                </div>
                <div class="card-header">
                    <?php echo $school_setting['School_Name'] ?>
                </div>
                <br>
                <div class="heading">
                    <u>HALL TICKET - <?php echo $exam_name . "&nbsp;(" . $school_setting['School_Session'] . ")"; ?></u>
                </div>
                <br>
                <table class="card-body">
                    <tr>
                        <td style="width: 100%;">
                            Name - <u><?php echo $val->first_nm;  ?></u>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Class - <u><?php echo $val->disp_class; ?></u>
                        </td>
                        <td>
                            Sec - <u><?php echo $val->disp_sec;  ?></u>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Regn. Id- <u><?php echo $val->Adm_no;  ?></u>
                        </td>
                        <td>
                            Roll No.- <u><?php echo $val->roll_no;  ?></u>
                        </td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr style="width:100%">
                        <td style="width:50%;text-align:left">
                            SIGN C.T.
                        </td>
                        <td style="width:50%;text-align:left">
                            SEC.IN-CHARGE
                        </td>
                    </tr>
                </table>
            </div>
        <?php }

        if ($j % 2 == 0) { ?>
            <br><br>
            <div class="blank"></div>
        <?php }
        if ($j % 8 == 0) { ?>

            <div style="page-break-after:always;"></div>
        <?php }
        $i++;
        $j++; ?>
    <?php } ?>
</div>