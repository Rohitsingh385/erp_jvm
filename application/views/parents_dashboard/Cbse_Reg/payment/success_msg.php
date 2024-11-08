<!DOCTYPE html>
<html lang="en">
<head>
  <title>Receipt</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <div class='row'>
	<div class='col-sm-12'>
		<table class='table'>
			<tr>
				<td>
					<center>
						<img src='assets/img/logo1.png' style='width:50px;'><br />
						<span style='font-size:18px !important;'><b>JAWAHAR VIDYA MANDIR</b></span><br />
						<span style='font-size:14px !important'>
						Shyamali, Doranda, Ranchi- 834002
						</span><br />
					</center>
				</td>
			</tr>
		</table>
		<table class='table'>
			<tr>
				<th colspan='3'><center>Provisional Admission Acknowledgement Slip<br />(Please print two copies of this slip)</center></th>
			</tr>
			<tr>
				<th>Provisional Admission Token No.</th>
				<th>:</th>
				<td><?php echo "PA".$this->session->userdata('token_no'); ?></td>
			</tr>
			<tr>
				<th>Board Roll No.</th>
				<th>:</th>
				<td><?php echo $this->session->userdata('board_roll_no'); ?></td>
			</tr>
			<tr>
				<th>School Reg. No.</th>
				<th>:</th>
				<td><?php echo $this->session->userdata('reg_no'); ?></td>
			</tr>
			<tr>
				<th>Name of the Student</th>
				<th>:</th>
				<td><?php echo $this->session->userdata('stu_name'); ?></td>
			</tr>
			<tr>
				<th>Father’s Name</th>
				<th>:</th>
				<td><?php echo $this->session->userdata('f_name'); ?></td>
			</tr>
			<tr>
				<th>Mother’s Name</th>
				<th>:</th>
				<td><?php echo $this->session->userdata('m_name'); ?></td>
			</tr>
			<tr>
				<th>Provisional Admission taken in Stream</th>
				<th>:</th>
				<td><?php echo $this->session->userdata('nwstrmnm'); ?></td>
			</tr>
			<tr>
				<th>Subject Combination</th>
				<th>:</th>
				<td><?php echo $this->session->userdata('new_choicenm'); ?></td>
			</tr>
			<tr>
				<th colspan='3' style='text-align:justify'>You have been allotted provisional admission in the above-mentioned stream and subject combination. The final stream and subject combination shall be confirmed by the school authority based on your performance in Class X Board Examination and as per the stream wise cut-off marks of the school.</th>
			</tr>
			<tr>
				<th colspan='3'><center>Admission Fee Payment Details/ Receipt</center></th>
			</tr>
			<tr>
				<th>Mode of Payment</th>
				<th>:</th>
				<td>Online Payment</td>
			</tr>
			<tr>
				<th>Atom Transaction ID</th>
				<th>:</th>
				<td><?php echo $allData[0]['mmp_txn']; ?></td>
			</tr>
			<tr>
				<th>Merchant Transaction ID</th>
				<th>:</th>
				<td><?php echo $allData[0]['transaction_id']; ?></td>
			</tr>
			<tr>
				<th>Amount Paid (in Rs.)</th>
				<th>:</th>
				<td><?php echo $this->session->userdata('fee_amt')."/-"; ?></td>
			</tr>
			<tr>
				<th colspan='3'>
					<?php
						if($allData[0]['fee_amt'] == '37560'){
							echo "(Rupees: Thirty Seven Thousand Five Hundred Sixty Only)";
						}else if($allData[0]['fee_amt'] == '14100'){
							echo "(Rupees: Fourteen Thousand One Hundred Only)";
						}else{
							echo "(Rupees: One Thousand Only)";
						}
					?>
				</th>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<th style='text-align:right'>(JVM Shyamali)</th>
			</tr>
			<tr>
				<td colspan='3' style='text-align:justify'><b>Note:</b>	After final admission the student has to submit his/her school leaving certificate, character certificate and migration certificate (if student is of  board other than CBSE) in original and attested copy of marks sheet received from the respective boards within 15 days of commencement of class otherwise the admission will stand cancelled. <b>(NOT APPLICABLE FOR INTERNAL STUDENTS OF JVM)</b></td>
			</tr>
		</table>
	</div>
  </div>
</div>

</body>
</html>
