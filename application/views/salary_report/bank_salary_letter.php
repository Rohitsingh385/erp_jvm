<?php

$dtFormatted = date('d-m-Y', strtotime($dt));

$number = $net_pay; //43727.75
// $number = 43727.75;

$no = floor($number);
$point = round($number - $no, 2) * 100;
$hundred = null;
$digits_1 = strlen($no);
$i = 0;
$str = array();

$words = array(
  '0' => '', '1' => 'One', '2' => 'Two',
  '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
  '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
  '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
  '13' => 'Thirteen', '14' => 'Fourteen',
  '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
  '18' => 'Eighteen', '19' => 'Nineteen', '20' => 'Twenty',
  '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
  '60' => 'Sixty', '70' => 'Seventy',
  '80' => 'Eighty', '90' => 'Ninety'
);

$digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');

while ($i < $digits_1) {
  $divider = ($i == 2) ? 10 : 100;
  $number = floor($no % $divider);
  $no = floor($no / $divider);
  $i += ($divider == 10) ? 1 : 2;

  if ($number) {
    $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
    if ($point != 0) {
      $hundred = ($counter == 1 && $str[0]) ? ' ' : null;
    } else {
      $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
    }
    $str[] = ($number < 21) ? $words[$number] .
      " " . $digits[$counter] . $plural . " " . $hundred
      :
      $words[floor($number / 10) * 10]
      . " " . $words[$number % 10] . " "
      . $digits[$counter] . $plural . " " . $hundred;
  } else $str[] = null;
}


$number = $net_pay; // Replace with your numeric value
// $number = 43727.75;

$no = floor($number); // Get the integer part
$point = round($number - $no, 2) * 100; // Get the two-digit decimal part

// ... (rest of your code)

$points = ($point) ? " and " . $words[floor($point / 10) * 10] . " " . $words[$point % 10] : '';



// $points = ($point) ? "." . $words[floor($point / 10) * 10] . " " . $words[$point % 10] : '';

// $amtinword = "Rupees " . $result . "Only" . $points . " Paise";

$str = array_reverse($str);
$result = implode('', $str);

// $points = ($point) ? "." . $words[$point / 10] . " " . $words[$point = $point % 10] : '';

if ($point != 0) {
  $amtinword = "Rupees " . $result . $points . " Paise Only";
} else {
  $amtinword = "Rupees " . $result . $points . " Only";
}

?>
<html>

<head>
  <style>
    @page {
      margin: 20px 25px 30px 35px;
    }

    #footer {
      position: fixed;
      right: 0px;
      bottom: 20px;
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

    .text-right {
      text-align: right;
    }

    .text-center {
      text-align: center;
    }

    .thead-color {
      background: #e5e5e5 !important;
      border-color: black !important;
    }

    .content {
      line-height: 2;
    }

    .border-none {
      border: none;
    }
  </style>

<body>
  <!-- <div id="header">
    <h1>Widgets Express</h1>
  </div> -->
  <div id="footer">
    <p style="float: left;"> Bank Salary Letter for <?php echo strtoupper(date('F', strtotime($current_year . '-' . $current_month . '-1'))) . ' ' . $current_year; ?></p>
    <p class="page" style="float: right;">Page </p>
  </div>

  <div style="clear: all;"></div>
  <div id="content">
    <table style="width: 100%;border: none;font-size: 16px;">
      <tr>
        <td class="border-none" width="60px"><img src="<?php echo $school_setting['SCHOOL_LOGO']; ?>" width="80px" height="80px"></td>
        <td class="border-none text-center"><span style="font-weight: bold;font-size:24px"><?php echo $school_setting['School_Name'] ?> </span><br><span><?php echo $school_setting['School_Address'] ?> </span><br>
          <?php echo "Bank Salary Letter For : " . date('M', strtotime($current_year . '-' . $current_month . '-1')) . '-' . $current_year; ?></td>
        <td class="border-none" width="15%"></td>
      </tr>
    </table>
    <div>
      <br>
      <br>
      <strong><span style="margin-left:70%"> Dated: ____/____/20____</span></strong><br>
      <p>To
        <br>The Branch Manager
        <br><?php echo $school_setting['BkName'] . '<br>' . $school_setting['BkBranch']; ?>
        <br>
      </p>
      <br>
      <strong>Sub. : Salary letter for the month of <?php echo strtoupper(date('F', strtotime($current_year . '-' . $current_month . '-1'))) . ' ' . $current_year; ?>.</strong>
      <br>
      <p>Dear Sir/Madam,</p>

      <p class="content">Please find the enclosed herewith an Account Payee
        Cheque No. <span style="border-bottom: 2px dotted black; font-style :bold"><?php echo $cheq_no; ?></span>
        dated <span style="border-bottom: 2px dotted black; font-style :bold"><?php echo $dtFormatted; ?></span>
        for Rs <span style="border-bottom: 2px dotted black; font-style :bold"><?php echo number_format($net_pay, 2, '.', ',') . '<br/>(' . $amtinword . ')'; ?> </span></p>
      <p>Kindly credit the same in the personal account of the staff as per the list given below & oblidge.</p>

    </div><br>
    <table class="table" style="width: 100%;">
      <thead>
        <tr>
          <th class="text-center thead-color" style="width: 7%;font-size:14px;">S.No</th>
          <th class="thead-color text-center" style="width: 13%;font-size:14px;">Employee ID</th>
          <th class="thead-color text-center" style="width: 20%;font-size:14px;">Employee Name</th>
          <th class="text-center thead-color" style="width: 30%;font-size:14px;">Bank A/C</th>
          <th class="text-right thead-color" style="width: 30%;font-size:14px;">Payable Amount</th>
        </tr>
      </thead>
      <tbody>
        <?php

        $total_amt = 0;
        foreach ($payslipData as $key => $value) {  ?>
          <tr>
            <td class="text-center" style="text-align: center;font-size:14px;"><?php echo $key + 1; ?></td>
            <td class="text-center" style="font-size:14px;"><?php echo filter_var($value['EMPID'], FILTER_SANITIZE_NUMBER_INT); ?></td>
            <td style="padding-left: 5px;font-size:14px;"><?php echo $value['EMP_FNAME'] . ' ' . $value['EMP_MNAME'] . ' ' . $value['EMP_LNAME']; ?></td>
            <td class="text-center" style="font-size:14px;"><?php echo $value['BANK_AC_NO']; ?></td>
            <td class="text-center" style="text-align: right;font-size:14px;"><?php echo number_format((float)$value['payable_amt'], 2, '.', ''); ?></td>
          </tr>
        <?php $total_amt = $total_amt + $value['payable_amt'];
        } ?>
        <tr>
          <td colspan="4" class="text-right thead-color" style="font-size:14px;"><b>Grand Total</b></td>
          <td class="text-right thead-color" style="font-size:14px;"><b><?php echo number_format((float)$total_amt, 2, '.', ''); ?></b></td>
        </tr>
      </tbody>
      <tfoot>

      </tfoot>
    </table>

    <table style="width: 100%; margin-top: 50px;">
      <tr>
        <th style="border: none;padding-left: 600px;"><br /></th>
      </tr>
      <tr>
        <th style="border: none;padding-left: 600px;"><br /></th>
      </tr>

      <tr>
        <th style="border: none; padding-left: 600px;">Principal</th>
      </tr>
    </table>

  </div>
</body>

</html>