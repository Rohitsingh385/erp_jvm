<html>
<title>Student Profile</title>

<head>
  <link rel="stylesheet" href="<?php echo base_url('assets/dash_css/bootstrap.min.css'); ?>">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Laila:700&display=swap" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Notable' rel='stylesheet' type='text/css'>
  <style>
    .table>thead>tr>th,
    .table>tbody>tr>th,
    .table>tfoot>tr>th,
    .table>thead>tr>td,
    .table>tbody>tr>td,
    .table>tfoot>tr>td {
      font-size: 20px;
      padding: 1px !important;
      text-align: center;
    }

    @media print {
      padding-top:0px;

      footer {
        page-break-after: always;
      }
    }

    .page-break {
      page-break-before: always;
    }

    .sign {
      font-family: 'Laila', serif;
    }

    body {
      padding-left: 15px;
      padding-right: 15px;
    }

    .table,
    tr,
    td,
    th {
      border: 1px solid #000000;
      border-top: 1px solid #000 !important;
    }

    .no_border tr td,
    .no_border tr th {
      border: none !important;
    }

    .sin_no_border {
      border: none !important;
    }

    .schl_nm {
      font-family: 'Notable', sans-serif;
      color: #b6061e !important;
    }
  </style>
</head>

<body>

  <div style='border:3px solid #b6061e !important; padding:5px 20px 0px 20px;'>
    <div class='row'><br>
      <div class="col-sm-2 col-xs-2"> <img src="<?php echo $school_setting[0]->SCHOOL_LOGO; ?>" style="width:100px;"> </div>
      <div class="col-md-8 col-lg-8 col-sm-8">
        <center>
          <h5><b style="color:#000;font-weight:bold !important; text-align:center; font-size:22px;"><?php echo $school_setting[0]->School_Name; ?></b></h5>
          <h6 style="color:#000;font-weight:bold !important; text-align:center; font-size:15px;"><?php echo $school_setting[0]->School_Address; ?></h6>

          <h6 style="color:#000;font-weight:bold !important; text-align:center; font-size:13px;">Session (<?php echo $school_setting[0]->School_Session; ?>)</h6>
        </center>
      </div>

    </div>
    <div class='row'>
      <table class='table no_border'>
        <tr>
          <th style='text-align:left; font-size:12px;'>Name</th>
          <th><b>:</b></th>
          <td style='text-align:left; font-size:12px;'><?php echo $student_details[0]->STUDENT_NAME; ?></td>
          <th style='text-align:left; font-size:12px;'>Adm Date</th>
          <th><b>:</b></th>
          <td style='text-align:left; font-size:12px;'><?php $adm =  $student_details[0]->ADMISSION_DATE;
                                                        $timestampp = strtotime($adm);
                                                        echo date("d-m-Y", $timestampp);
                                                        ?></td>
          <th style='text-align:left; font-size:12px;'></th>
          <th><b></b></th>
          <td style='text-align:left; font-size:12px;'></td>

        </tr>
        <tr>
          <th style='text-align:left; font-size:12px;'>Adm No. </th>
          <th><b>:</b></th>
          <td style='text-align:left; font-size:12px;'><?php echo $student_details[0]->ADMISSION_NO; ?></td>
          <th style='text-align:left; font-size:12px;'>Adm Class</th>
          <th><b>:</b></th>
          <td style='text-align:left; font-size:12px;'><?php echo $student_details[0]->CLASS_NAME; ?></td>
          <th style='text-align:left; font-size:12px;'>Gender</th>
          <th><b>:</b></th>
          <td style='text-align:left; font-size:12px;'><?php $sx =  $student_details[0]->GENDER;
                                                        if ($sx == 2) {
                                                          echo 'Female';
                                                        } elseif ($sx == 1) {
                                                          echo 'Male';
                                                        } else {
                                                          echo '';
                                                        }
                                                        ?>
          </td>

        </tr>
        <tr>
          <th style='text-align:left; font-size:12px;'>Class-Sec</th>
          <th><b>:</b></th>
          <td colspan='1' style='text-align:left; font-size:12px;'><?php echo $student_details[0]->CURRENT_CLASS; ?>-<?php echo $student_details[0]->CURRENT_SECTION; ?></td>
          <th style='text-align:left; font-size:12px;'>Roll No.</th>
          <th><b>:</b></th>
          <td style='text-align:left; font-size:12px;'><?php echo $student_details[0]->ROLL_NO; ?></td>
          <th style='text-align:left; font-size:12px;'>Science Lab</th>
          <th><b>:</b></th>
          <td style='text-align:left; font-size:12px;'><?php $sc = $student_details[0]->SC_STATUS;
                                                        if ($sc == 1) {
                                                          echo 'YES';
                                                        } else {
                                                          echo 'NO';
                                                        }
                                                        ?></td>
        </tr>
        <tr>
          <th style='text-align:left; font-size:12px;'>DOB</th>
          <th><b>:</b></th>
          <td colspan='1' style='text-align:left; font-size:12px;'><?php $db = $student_details[0]->DATE_OF_BIRTH;
                                                                    $timestamp = strtotime($db);
                                                                    echo date("d-m-Y", $timestamp);
                                                                    ?></td>
          <th style='text-align:left; font-size:12px;'>Category</th>
          <th><b>:</b></th>
          <td style='text-align:left; font-size:12px;'><?php echo $student_details[0]->CATEGORY; ?></td>
          <th style='text-align:left; font-size:12px;'>Computer</th>
          <th><b>:</b></th>
          <td style='text-align:left; font-size:12px;'><?php $cc = $student_details[0]->COUMPUTER_STATUS;
                                                        if ($cc == 1) {
                                                          echo 'YES';
                                                        } else {
                                                          echo 'NO';
                                                        }
                                                        ?></td>
        </tr>
        <tr>
          <th style='text-align:left; font-size:12px;'>Ward Type</th>
          <th><b>:</b></th>
          <td colspan='1' style='text-align:left; font-size:12px;'><?php echo $student_details[0]->EMPLOYEE_WARD; ?></td>
          <th style='text-align:left; font-size:12px;'>Aadhar No. </th>
          <th><b>:</b></th>
          <td style='text-align:left; font-size:12px;'><?php echo $student_details[0]->AADHAR_NUMBER; ?></td>
          <th style='text-align:left; font-size:12px;'>Freeship</th>
          <th><b>:</b></th>
          <td style='text-align:left; font-size:12px;'><?php $fc = $student_details[0]->FREESHIP_STATUS;
                                                        if ($fc == 1) {
                                                          echo 'YES';
                                                        } else {
                                                          echo 'NO';
                                                        }
                                                        ?></td>
        </tr>
        <tr>
          <th style='text-align:left; font-size:12px;'>Religion</th>
          <th><b>:</b></th>
          <td colspan='1' style='text-align:left; font-size:12px;'><?php echo $student_details[0]->RELIGION; ?></td>
          <th style='text-align:left; font-size:12px;'>Blood Group</th>
          <th><b>:</b></th>
          <td style='text-align:left; font-size:12px;'><?php echo $student_details[0]->BLOOD_GROUP; ?></td>
          <th style='text-align:left; font-size:12px;'>House</th>
          <th><b>:</b></th>
          <td style='text-align:left; font-size:12px;'><?php echo $student_details[0]->HOUSE_NAME; ?></td>
        </tr>
        <tr>
          <th style='text-align:left; font-size:12px;'>Last School Name</th>
          <th><b>:</b></th>
          <td colspan='1' style='text-align:left; font-size:12px;'><?php echo $student_details[0]->LAST_SCHOOL; ?></td>
          <th style='text-align:left; font-size:12px;'>Mob No.</th>
          <th><b>:</b></th>
          <td style='text-align:left; font-size:12px;'><?php echo $student_details[0]->CROSSMOBILE; ?></td>
          <th style='text-align:left; font-size:12px;'></th>
          <th><b></b></th>
          <td style='text-align:left; font-size:12px;'></td>
        </tr>
        <tr>
          <th style='text-align:left; font-size:12px;'>Last School Add</th>
          <th><b>:</b></th>
          <td colspan='1' style='text-align:left; font-size:12px;'><?php echo $student_details[0]->LSCH_ADD; ?></td>
          <th style='text-align:left; font-size:12px;'>Bus Facility</th>
          <th><b>:</b></th>
          <td style='text-align:left; font-size:12px;'><?php echo $student_details[0]->BUSSTOPAGE; ?></td>
          <th style='text-align:left; font-size:12px;'></th>
          <th><b></b></th>
          <td style='text-align:left; font-size:12px;'></td>
        </tr>
      </table>
    </div>



    <div class='row'>
      <table class="table" style="width:100%">
        <tbody>
          <tr>
            <th style="color:#fff !important; background:#b6061e !important; font-weight:bold !important; text-align:left; font-size:13px;text-align:center;">Father's Details </th>
            <th style="color:#fff !important; background:#b6061e !important; font-weight:bold !important; text-align:left; font-size:13px;text-align:center;">Mother's Details </th>
          </tr>
          <tr>
            <th style='text-align:left; font-size:12px;'>
              <table class='table no_border'>
                <tbody>
                  <tr>
                    <th style='text-align:left; font-size:12px;'>Father's Name :</th>
                    <th style='text-align:left; font-size:12px;'><?php echo $student_details[0]->FATHERNAME; ?></th>
                  </tr>
                  <tr>
                    <th style='text-align:left; font-size:12px;'>Designation : <?php echo $student_details[0]->f_desig; ?></th>
                    <th style='text-align:left; font-size:12px;'>Education :<?php echo $student_details[0]->f_edu; ?></th>
                  </tr>
                  <tr>
                    <th style='text-align:left; font-size:12px;'>Occupation : <?php echo $student_details[0]->f_occ; ?></th>
                    <th style='text-align:left; font-size:12px;'>Monthly Income : <?php echo $student_details[0]->f_mnth_inc; ?></th>
                  </tr>
                  <tr>
                    <th style='text-align:left; font-size:12px;'>Phone :</th>
                    <th style='text-align:left; font-size:12px;'>Mob No. :<?php echo $student_details[0]->p_mbl; ?></th>
                  </tr>

                  <tr>
                    <th style='text-align:left; font-size:12px;'>Address :<?php echo $student_details[0]->p_add; ?></th>
                    <th style='text-align:left; font-size:12px;'></th>
                  </tr>
                </tbody>
              </table>
            </th>
            <th style='text-align:left; font-size:12px;'>
              <table class='table no_border'>
                <tbody>
                  <tr>
                    <th style='text-align:left; font-size:12px;'>Mother's Name :</th>
                    <th style='text-align:left; font-size:12px;'><?php echo $student_details[1]->MOTHERNAME; ?></th>
                  </tr>
                  <tr>
                    <th style='text-align:left; font-size:12px;'>Designation : <?php echo $student_details[1]->f_desig; ?></th>
                    <th style='text-align:left; font-size:12px;'>Education : <?php echo $student_details[1]->f_edu; ?></th>
                  </tr>
                  <tr>
                    <th style='text-align:left; font-size:12px;'>Occupation : <?php echo $student_details[1]->f_occ; ?></th>
                    <th style='text-align:left; font-size:12px;'>Monthly Income : <?php echo $student_details[1]->f_mnth_inc; ?></th>
                  </tr>
                  <tr>
                    <th style='text-align:left; font-size:12px;'>Phone : <?php echo $student_details[1]->p_mbl; ?></th>
                    <th style='text-align:left; font-size:12px;'>Mob No. : <?php echo $student_details[1]->p_mbl; ?></th>
                  </tr>

                  <tr>
                    <th style='text-align:left; font-size:12px;'>Address : <?php echo $student_details[1]->p_add; ?></th>
                    <th style='text-align:left; font-size:12px;'></th>
                  </tr>
                </tbody>
              </table>
            </th>
          </tr>
        </tbody>
      </table>
    </div>

    <div class='row'>
      <table class="table" style="width:100%">
        <tbody>
          <tr>
            <th style="color:#fff !important; background:#b6061e !important; font-weight:bold !important; text-align:left; font-size:13px;text-align:center;">CORRESPONDENCE ADDRESS</th>
            <th style="color:#fff !important; background:#b6061e !important; font-weight:bold !important; text-align:left; font-size:13px;text-align:center;">PERMANENT ADDRESS</th>
          </tr>
          <tr>
            <th style='text-align:left; font-size:12px;'>Address :<?php echo $student_details[0]->CROSSADD; ?></th>
            <th style='text-align:left; font-size:12px;'>Address :<?php echo $student_details[0]->PERADD; ?></th>
          </tr>
          <tr>
            <th style='text-align:left; font-size:12px;'>City :<?php echo $student_details[0]->CROSSCITY; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;State :<?php echo $student_details[0]->CROSSSTATE; ?></th>
            <th style='text-align:left; font-size:12px;'>City :<?php echo $student_details[0]->PERCITY; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;State :<?php echo $student_details[0]->PERSTATE; ?></th>
          </tr>
          <tr>
            <th style='text-align:left; font-size:12px;'>Pin code : <?php echo $student_details[0]->CROSSPIN; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Country : <?php echo $student_details[0]->CROSSNATION; ?></th>
            <th style='text-align:left; font-size:12px;'>Pin code : <?php echo $student_details[0]->PERPIN; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Country : <?php echo $student_details[0]->PERNATION; ?></th>
          </tr>
        </tbody>
      </table>
    </div>

    <div class='row'>
      <table class='table no_border'>
        <tbody>
          <tr>
            <th style="color:#fff !important; background:#b6061e !important; font-weight:bold !important; text-align:left; font-size:13px;">SUBJECT OPTED</th>
            <th style="color:#fff !important; background:#b6061e !important; font-weight:bold !important; text-align:left; font-size:13px;"></th>
          </tr>
          <tr>
            <th style='text-align:left; font-size:12px;'>1. Subject :<?php echo $student_details[0]->SUBJECT1; ?></th>
            <th style='text-align:left; font-size:12px;'>4. Subject :<?php echo $student_details[0]->SUBJECT4; ?></th>
          </tr>
          <tr>
            <th style='text-align:left; font-size:12px;'>2. Subject :<?php echo $student_details[0]->SUBJECT2; ?></th>
            <th style='text-align:left; font-size:12px;'>5. Subject :<?php echo $student_details[0]->SUBJECT5; ?></th>
          </tr>
          <tr>
            <th style='text-align:left; font-size:12px;'>3. Subject :<?php echo $student_details[0]->SUBJECT3; ?></th>
            <th style='text-align:left; font-size:12px;'>6. Subject :<?php echo $student_details[0]->SUBJECT6; ?></th>
          </tr>
        </tbody>
      </table>
    </div>

  </div>
</body>

</html>