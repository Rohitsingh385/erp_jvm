<?php
error_reporting(0);
if ($details_fetch) {
    $department = $details_fetch[0]['department'];
    $appointment_date = $details_fetch[0]['appointment_date'];
    $appointment_time = $details_fetch[0]['appointment_time'];
    $concerned_person = $details_fetch[0]['concerned_person'];
    $name = $details_fetch[0]['name'];
    $purpose = $details_fetch[0]['purpose'];
    $visitor_type = $details_fetch[0]['visitor_type'];
    $EMP_NAME = $details_fetch[0]['EMP_NAME'];
    $mobile = $details_fetch[0]['mobile_no'];
    $photgraph = $details_fetch[0]['photgraph'];
}

?>
<!DOCTYPE html>
<html>

<head>
    <title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.0.js"></script>
    <style media="print">
        body {
            margin: 0px !important;
            padding: 0px !important;
        }

        #border {
            width: 100%;
            height: 100%;
            padding: 5px 20px 0px 20px;
            border: solid 3px black;
        }

        #image {
            height: 80px;
            width: 75px;
            margin-top: 60px;
        }

        #heading {
            float: right;
        }

        #content {
            border: solid 1px black;
            border-radius: 10px;
        }

        .text-content {
            text-align: right;
        }

        @page {
            margin-top: 100px;
            margin-bottom: 0;
            margin-right: 10px;
            margin-left: 10px;
        }

        .f-s {
            font-size: 20px;
        }
    </style>
</head>

<body>

    <div class="container-fluid my-5">

        <div id="border" style="border: 1px solid black;">
            <div class="row">
                <table style='width:100%;border: none'>
                    <tr style="text-align: center;">
                        <td style="width:20%"> <img style="margin-top:5px" src="<?php echo $school_setting[0]->SCHOOL_LOGO;  ?>" id="image" height="80px;" width="75px;"> </td>
                        <td style="width:60%"><?php echo "<b style='font-size:18px;'>" . $school_setting[0]->School_Name . "</b><br/>" . $school_setting[0]->School_Address; ?></td>
                        <td style="width:20%"><img style="margin-top:10px" src="<?php echo $photgraph; ?>" id="image" height="80px;" width="75px;"> </td>
                    </tr>
                    <tr style="text-align: center;">
                        <td style="width:20%"></td>
                        <td style="width:60%">SCHOOL COPY</td>
                        <td style="width:20%"></td>
                    </tr>
                </table>
            </div>

            <table class="table">
                <tr>
                    <td class="f-s" style="text-align: justify;">
                        <b><i>Department :</b></i> &nbsp;&nbsp; <?php echo $department; ?>
                    </td>
                    <td class="f-s" style="text-align: justify;">
                        <b><i>Appointment Date:</b></i>&nbsp;&nbsp; <?php echo $appointment_date; ?>
                    </td>
                </tr>
                <tr>
                    <td class="f-s" style="text-align: left; ">
                        <b><i>Appointment Time:</b></i> &nbsp;&nbsp; <?php echo $appointment_time; ?>
                    </td>
                    <td class="f-s" style="text-align: justify;">
                        <b><i>Concerned Person:</b></i> &nbsp; <?php echo $EMP_NAME; ?>
                    </td>
                </tr>
                <tr>
                    <td class="f-s" style="text-align: left; ">
                        <b><i>Name :</b></i>&nbsp; <?php echo $name; ?>
                    </td>
                    <td class="f-s" style="text-align: justify;">
                        <b><i>Purpose :</b></i>&nbsp; <?php echo $purpose; ?>
                    </td>
                </tr>
                <tr>
                    <td class="f-s" style="text-align: left; ">
                        <b><i>Visitor Type :</b></i>&nbsp; <?php echo $visitor_type; ?>
                    </td>
                    <td class="f-s" style="text-align: left; ">
                        <b><i>Mobile No : </b></i>&nbsp; <?php echo $mobile; ?>
                    </td>
                </tr>
            </table>
        </div>

        <hr>
     
        <div id="border" style="border: 1px solid black;">
            <div class="row">
                <table style='width:100%;border: none'>
                    <tr style="text-align: center;">
                        <td style="width:20%"> <img style="margin-top:5px" src="<?php echo $school_setting[0]->SCHOOL_LOGO;  ?>" id="image" height="80px;" width="75px;"> </td>
                        <td style="width:60%"><?php echo "<b style='font-size:18px;'>" . $school_setting[0]->School_Name . "</b><br/>" . $school_setting[0]->School_Address; ?></td>
                        <td style="width:20%"><img style="margin-top:10px" src="<?php echo $photgraph; ?>" id="image" height="80px;" width="75px;"> </td>
                    </tr>
                    <tr style="text-align: center;">
                        <td style="width:20%"></td>
                        <td style="width:60%">VISITOR COPY</td>
                        <td style="width:20%"></td>
                    </tr>
                </table>
            </div>
            <table class="table">
                <tr>
                    <td class="f-s" style="text-align: justify;">
                        <b><i>Department :</b></i> &nbsp;&nbsp; <?php echo $department; ?>
                    </td>
                    <td class="f-s" style="text-align: justify;">
                        <b><i>Appointment Date:</b></i> &nbsp;&nbsp; <?php echo $appointment_date; ?>
                    </td>
                </tr>
                <tr>
                    <td class="f-s" style="text-align: left; ">
                        <b><i>Appointment Time:</b></i> &nbsp;&nbsp; <?php echo $appointment_time; ?>
                    </td>
                    <td class="f-s" style="text-align: justify;">
                        <b><i>Concerned Person:</b></i> &nbsp; <?php echo $EMP_NAME; ?>
                    </td>
                </tr>
                <tr>
                    <td class="f-s" style="text-align: left; ">
                        <b><i>Name :</b></i>&nbsp; <?php echo $name; ?>
                    </td>
                    <td class="f-s" style="text-align: justify;">
                        <b><i>Purpose :</b></i>&nbsp; <?php echo $purpose; ?>
                    </td>
                </tr>
                <tr>
                    <td class="f-s" style="text-align: left; ">
                        <b><i>Visitor Type :</b></i>&nbsp; <?php echo $visitor_type; ?>
                    </td>
                    <td class="f-s" style="text-align: left; ">
                        <b><i>Mobile No :</b></i>&nbsp; <?php echo $mobile; ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>