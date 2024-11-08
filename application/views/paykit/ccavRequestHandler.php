<html>
<head>
<title> Non-Seamless-kit</title>
</head>
<body>
<center>

<?php include('Crypto.php')?>
<?php 

	error_reporting(0);
	
	$merchant_data ='338590';
	$working_key='20CA315CF21F12A94C9FB150BA3A4C52';//Shared by CCAVENUES
	$access_code='AVMM03IB16BP02MMPB';//Shared by CCAVENUES
	
	/* foreach ($_POST as $key => $value){
		$merchant_data.=$key.'='.$value.'&';
	} */
	
	$merchant_data.='tid='.$this->session->userdata('adm').'&';
	$merchant_data.='merchant_id='.$this->session->userdata('merchant_id').'&';
    $merchant_data.='order_id='.$this->session->userdata('tid').'&';
    $merchant_data.='amount='.$this->session->userdata('total_amountt').'&';
    $merchant_data.='currency=INR'.'&';
    $merchant_data.='redirect_url='.$this->session->userdata('redirect_url').'&';
    $merchant_data.='cancel_url='.$this->session->userdata('cancel_url').'&';
    $merchant_data.='language='.$this->session->userdata('language').'&';
	$merchant_data.='delivery_name='.$this->session->userdata('ffms').'&';
	
	$merchant_data.='billing_name='.$this->session->userdata('billing_name').'&';
	$merchant_data.='billing_address='.$this->session->userdata('billing_address').'&';
	$merchant_data.='billing_city='.$this->session->userdata('billing_city').'&';
	$merchant_data.='billing_state='.$this->session->userdata('billing_state').'&';
	$merchant_data.='billing_zip='.$this->session->userdata('billing_zip').'&';
	$merchant_data.='billing_country='.$this->session->userdata('billing_country').'&';
	$merchant_data.='billing_tel='.$this->session->userdata('billing_tel').'&';
	if($this->session->userdata('billing_email') !='N/A'){
	$merchant_data.='billing_tel='.$this->session->userdata('billing_email').'&';
	}
		

	
	$encrypted_data=encrypt($merchant_data,$working_key); 
?>
<form method="post" name="redirect" action="https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction"> 
<?php

echo "<input type=hidden name=encRequest value=$encrypted_data>";
echo "<input type=hidden name=access_code value=$access_code>";

?>
</form>
</center>
<script language='javascript'>document.redirect.submit();</script>
</body>
</html>

