 <html>
<head> 
  <title>Group Insurance Report</title>
  <style>
    @page { margin: 120px 25px 60px 25px; }
    header { position: fixed; top: -100px; left: 0px; right: 0px;}
    #footer { position: fixed; right: 0px; bottom: 10px; text-align: right;}
        #footer .page:after { content: counter(page, decimal); }
        .table {
          border-collapse: collapse;
          font-size: 13px;
          width: 100%;
        }

        .table, th, td {
          border: 1px solid black;
        }
        .text-right{
          text-align: right;
        }
        body{
          font-family: "Arial", Helvetica, sans-serif;
        }
        .text-center{
          text-align: center;
        }
  </style>
</head>
  <body>
    <header id="header">
		<img src="<?php echo $school_setting['SCHOOL_LOGO']; ?>" width="80px" height="80px">
        <div style="text-align: center; margin-top: -70px;">
            <span style="font-size: 25px;font-weight: bold;"><?php echo $school_setting['School_Name'] ?> </span>
            <br><span><?php echo $school_setting['School_Address'] ?> </span><br>
     <br>
      <div style="text-align: center;">Group Insurance Scheme Deduction for the month of <?= strtoupper(date('F',strtotime($resultData['year'].'-'.$resultData['month_name'].'-'.'01')).', '.$resultData['year']); ?></div>
    </header>
   <div id="footer">
      <p class="page">Page </p>
    </div> 
		<br/>
    <div class="content">
      <table class="table">
          <thead>
            <tr> 
              <th class="thead-color text-center">Sl. No.</th>
              <th class="thead-color text-center">Pers. No.</th>
              <th class="thead-color text-center">Employee Name</th>
              <th class="thead-color text-center">Policy amount</th>
              <th class="thead-color text-center">Amt. (Rs.)</th>
            </tr>
          </thead>
          <tbody>
              <?php  $i = 1;
			  $total=0;
              foreach($resultData['resultList'] as $key => $value) {  ?>
                  <tr>
                    <td class="text-center"><?php echo $i++; ?></td>
                    <td class="text-center"><?php echo filter_var($value['EMPID'], FILTER_SANITIZE_NUMBER_INT); ?></td>
                    <td class="text-center"><?php echo $value['EMP_FNAME'].' '.$value['EMP_MNAME'].' '.$value['EMP_LNAME']; ?></td>
                    <td class="text-right"><?php echo $value['INSURANCE_AMT']; ?></td>
                    <td class="text-right"><?php echo number_format($value['group_insurance_amt'],2);  
					$total += $value['group_insurance_amt']; ?></td>
                  </tr>
              <?php } ?>
			  <tr >
                <td class="text-right" colspan="4" style="font-weight: bold;">Total</td>
                <td class="text-right" style="font-weight: bold;"><?php echo number_format($total,2); ?></td>
              </tr>
          </tbody>
        </table>
      </div>
  </body>
</html>