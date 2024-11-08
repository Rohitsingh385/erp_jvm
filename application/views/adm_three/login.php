<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
	<link rel="shortcut icon" href="<?php echo site_url('assets_nur/img/favicon.ico') ?>" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900" rel="stylesheet"> 
    <link href="<?php echo site_url() ?>assets_nur/css/style.css" type="text/css" rel="stylesheet" />
    <link href="<?php echo site_url() ?>assets_nur/css/media.css" type="text/css" rel="stylesheet" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css"/>
	<link href='https://fonts.googleapis.com/css?family=Bungee+Inline:400' rel='stylesheet' type='text/css'>
	
	<style>
		.login-div .full input {
			margin-right: 17px !important;
		}
		a:hover{
			color:red;
			text-decoration: underline;
			font-weight:bold;
		}
		.heading-div p{
			font-family: 'Bungee Inline', cursive;
		}
		body{
			background-image: url(<?php echo base_url('assets_nur/image/jvm_bgg.jpg'); ?>);
			background-repeat: no-repeat;
            background-size: 100% 100%;
		}
		html {
			height: 100%
		}
		.login-div {
			opacity: 0.9 !important;
		}
	</style>
</head>

<body>
    <div class="wrapper">
       <div class="clearfix"></div>
       <div class="login-div">
          <div class="log-div"><img src="<?php echo site_url() ?>assets_nur/image/jvm1.png" height="100px"></div>
          <div class="heading-div">           
            <p style='font-size:20px;'>REGISTERED APPLICANT LOGIN</p>
          </div>
		  <form id="form" autocomplete='off'>
          <div class="form-div clearfix">
            <div class="field">
				<div class="form-field">
				<label class="id" for="id"></label>
				<input type="text" name="username" id="username" maxlength="50" placeholder="Username" required class="validate" onchange='usernamee(this.value)'>
				</div>
            </div>
            <div class="field">
				<div class="form-field">
				<label class="pass" for="pass"></label>
				<input type="password" name="password" id="password" required placeholder="Password" class="validate" onchange='uname()' maxlength='10'>
				</div>
            </div>
			
			<!--<div class="field" id="otp" style='display:none;'>
				<div class="form-field">
				<label class="pass" for="otp"></label>
				<input disabled type="text" name="otp" maxlength="20" required placeholder="OTP" id='otp_text' maxlength='6'>
				</div>
            </div>-->
          </div>
          <div class="full">
            <div class="full">
				<input type="submit" value="Login">
			</div><br />
			<!--<center><span style='font-size:25px !important; color:red'><b>New Applicant <a href='<?php echo base_url('adm_three/Adm_nur'); ?>'>Click Here<a/></b></span></center>-->
          </div>
		  </form>
		  <div style='text-align:justify; background:red; padding:8px; color:#fff; border-radius:8px;'>	
		  <b>NOTE:-</b><label>Dear Parent,Due to the prevailing situation of COVID-19 pandemic the school will be unable to conduct offline admission test for admission in class III. Hence, it has been decided that the admission test will conducted in online mode only. <br />Before the final test a mock test will be conducted once, to give a practice for admission test which will not be considered for the preparation of merit list. <br />The marks scored in the Admission test will be considered for the preparation of the merit list. The dates and timing for Mock test and admission test are given below:
<br />Mock Test (Practice test) 	: 20.04.2021 from 10:30 AM to 10:50 AM<br />
Admission Test (Final)		: 23.04.2021 from 10:30 AM to 11:10 AM
<br />
			  <center><a href='<?php echo base_url('assets/logo/CLASS_III_ANNX_I.pdf'); ?>' target='_blank' style='color:white; font-size:18px;'>Notice Online Exam</a>
			  <br/>
			  <a href='<?php echo base_url('assets/logo/CLASS_III_ANNX_II.pdf'); ?>' target='_blank' style='color:white; font-size:18px;'>Annexure II</a></center>
<!--
You are requested to read the requirements and instructions given in Annexure 1 & Annexure 2 properly. The admission test will be conducted once only. For details please visit our website www.jvmshyamali.com--></label>
			  	  
				  </div>
		    <br />
	  <br />
		  
       </div>
    </div>
    <script src="<?php echo site_url() ?>assets_nur/js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>
</body>
</html>

<script>
$("#form").on("submit", function (event) {
    event.preventDefault();
    $.ajax({
		url: "<?php echo base_url('adm_three/Admin/login'); ?>",
		type: "POST",
		data: $("#form").serialize(),
		success: function(data){
			if(data == 0){
				$.toast({
					heading: 'Error',
					text: 'Useranme or Password Incorrect',
					showHideTransition: 'slide',
					icon: 'error',
					position: 'top-right',
				});	
				$("#username").val('');
				$("#password").val('');
				//$("#otp_text").val('');
			}else{
				window.location.href="<?php echo base_url('adm_three/Admin/dashboard'); ?>";
			}
		}
	});
 });
 
 // function usernamee(username){
	 // if(username != 'admin' && username != 'admin1' && username != 'admin2'){
		 // $("#otp").show();
		 // $("#otp_text").prop('disabled',false); 
	 // } 
 // }
 
 // function uname(){
	 // var username = $("#username").val();
	 // var password = $("#password").val();
	 // if(username != 'admin' && username != 'admin1' && username != 'admin2'){
		 // $.ajax({
			 // url : "<?php echo base_url('adm_three/Admin/chkThenOtp'); ?>",
			 // type: "POST",
			 // data: {username:username,password:password},
			 // success :function(data){
				 // if(data == 1){
					 // alert('OTP sent to your Registered Mobile Number');
					 // $("#otp").show();
					 // $("#otp_text").prop('disabled',false);
					 
				 // }else{
					 // $.toast({
						// heading: 'Error',
						// text: 'Useranme or Password Incorrect',
						// showHideTransition: 'slide',
						// icon: 'error',
						// position: 'top-right',
					// });	
					// $("#username").val('');
					// $("#password").val('');
					// $("#otp_text").val('');
					// $("#otp").hide();
					// $("#otp_text").prop('disabled',true);
				 // }
			 // }
		 // });
	 // }
 // }
</script>