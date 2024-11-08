<?php
error_reporting(0);
?>	
<style>
	/*.box-header {
    color: #444;
	background-color:#3c8cbc;
    display: block;
    padding: 10px;
    position: relative;
	}*/
	
	.p_detils{
		font-size:17px !important;
	}
	.box.box-default {
    border-top-color: #3c8cbc;
}
.vl {
  border-left: 2px solid #3c8dbc;
  height: 541px;
  position: absolute;
  left: 50%;
  margin-top: 30px;
   margin-left:  57px;
  top: 0;
}
.row{
	margin-top:12px;
	
}
</style> 
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       PAYMENT OF CBSE REGISTRATION / EXAMINATION FEE
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Student Details</a></li>
        <li class="active">Student Profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
	
        <!-- /.box-header -->
        <div class="box-body">
		 <div class="row" >
	<!---parent_dashboard/Cbse_Reg/gautam/save_temp_student-->
			<form action="<?php echo base_url('parent_dashboard/cbse_reg_fee/Payment/Payment'); ?>" autocomplete='off' method='post' >
		
		<div class='col-md-12 col-sm-12 col-lg-112'>
			<h4><u>STUDENT DETAILS</u></h4>
				
	<table class='table'>
		<tr><td style='width:120px'><b>Name</b></td><td style='width:8px'>:</td><td><?php echo $stu_data[0]->SName;?></td></tr>
        <tr><td><b>Father Name</b></td><td style='width:8px'>:</td><td><?php echo $stu_data[0]->FName;?></td></tr>
		<tr><td><b>Mother Name</b></td><td style='width:8px'>:</td><td><?php echo $stu_data[0]->MName;?></td></tr>
		<tr><td><b>Class-Sec</b></td><td style='width:8px'>:</td><td><?php echo $stu_data[0]->Class_Sec;?></td></tr>
		<tr><td><b>Subjects</b> </td><td style='width:8px'>:</td><td><?php echo $stu_data[0]->Subj1;?>, <?php echo $stu_data[0]->Subj2;?>, <?php echo $stu_data[0]->Subj3;?>, <?php echo $stu_data[0]->Subj4;?>, <?php echo $stu_data[0]->Subj5;?>, <?php echo $stu_data[0]->Subj6;?></td></tr>
	
				</table>
				<h4><u>FEES DETAILS</u></h4>
					<table class='table'>
		<tr><td style='width:180px'><b>Registration Fees</b></td><td style='width:8px'>:</td><td>&#x20B9;<?php echo $stu_data[0]->Registration_Charges;?></td></tr>
		<tr><td style='width:180px'><b>Processing ICard Charges</b></td><td style='width:8px'>:</td><td>&#x20B9;<?php echo $stu_data[0]->Processing_ICard_Charges;?></td></tr>
		<tr><td style='width:180px'><b>Migration Charges</b></td><td style='width:8px'>:</td><td>&#x20B9;<?php echo $stu_data[0]->Migration_Charges;?></td></tr>
		<tr><td style='width:180px'><b>Practical Charges</b></td><td style='width:8px'>:</td><td>&#x20B9;<?php echo $stu_data[0]->Practical_Charges;?></td></tr>
		<tr><td style='width:180px'><b>Additional Subject Charges
</b></td><td style='width:8px'>:</td><td>&#x20B9;<?php echo $stu_data[0]->Additional_Subj_Charges;?></td></tr>
       
		
<tr style='background-color:#f2f2f2'><td><b>Total</b></td><td style='width:8px'>:</td><td><b>&#x20B9; <?php echo $stu_data[0]->Total;?></b></td></tr>
						
						<tr><td><h4><b>Note:</b></h4></td><td style='width:8px'>:</td><td><b><h4>If amount is deducted from your Bank Account, kindly wait for 24 hours for the payment to get settled. <br/>
							If you receive mail from admin@atomtech.in, kindly forward the same to School's email id jvmshyamali@yahoo.com
							<br/>
							In case of any change/addition of Subject, extra amount will be charged.</h4></b>
							</td></tr>
				</table>
				<center>
					<?php if($stu_data[0]->Status=='Success' || $stu_data[0]->F_Code=='Ok' || $stu_data[0]->F_Code=='OK'){?>
					<p style='color:green'>Payment Completed... <a href="<?php echo base_url('parent_dashboard/cbse_reg_fee/Cbse_fee/Print_user_profile_x_xii_reprint');?>">Download receipt</a></p>
					<?php }else{ ?>
			<input type='submit' value='Pay Now'>
				<?php } ?>
				</center>
					</div>
				</form>
			  </div>
			</div>
		  </div>
		</div>
		<!-- end modal -->
		
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
	 </section>
    <!-- /.content -->
  </div>
  <button type="button"  data-toggle="modal" data-target="#myModal" id='loading' style="display:none"></button>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
    
      <div class="modal-body" id='loa'>
       <p style="font-size:17px">Please Wait...</p>
      </div>
    
    </div>

  </div>
</div>
  <script>

 var dspc_code = $('#secc').val();
	
  var dspc = '<?php echo $DISP_SEC;?>';
	 fetchTeach(dspc_code);
	  	if( 'A' == dspc || 'B' == dspc){
			$("#sns").prop("disabled", false);
			$("#sns").prop("checked", true);
			$("#hin").attr("disabled", true);
		}else{
			$("#hin").prop("disabled", false);
			$("#hin").prop("checked", true);
			$("#sns").attr("disabled", true);
		}
	  
	   function fetchTeach(data){
		   
		var lang=data;
		if( 1 == lang || 2 == lang){
			$("#sns").prop("disabled", false);
			$("#sns").prop("checked", true);
			$("#hin").attr("disabled", true);
		}else{
			$("#hin").prop("disabled", false);
			$("#hin").prop("checked", true);
			$("#sns").attr("disabled", true);
		}
	  $.post("<?php echo base_url('parent_dashboard/Cbse_Reg/gautam/fetch_teacher'); ?>",{subject_id:data},function(data){
		$fillData = $.parseJSON(data);
		$("#teacher").val($fillData[0]);
	
		
	});
  }
  $(".nur_form").on("submit", function (event) {
		
    event.preventDefault();
	//$("#sv_btn").prop('',true);
	
	var uu=$("#adr").val();
	var email=$("#email").val();
	 uu=uu.length;

	if(uu==12){
		$("#loading").click();
	var formData = new FormData(this);
    $.ajax({
			url: "<?php if(sizeof($temp_data)==0){ echo base_url('parent_dashboard/Cbse_Reg/gautam/save_temp_student');} else{ echo base_url('parent_dashboard/Cbse_Reg/gautam/update_temp_student'); } ?>",
			type: "POST",
			data:formData,
            cache:false,
            contentType: false,
            processData: false,
			success: function(data){
				if(data=='1'){
				swal("Verified your Form!", " You can't update your details!");
				//window.location="<?php echo base_url('adm_nur/Adm_nur/payNow'); ?>";
				setTimeout(function(){window.location=""; }, 1000);
					
				}else{
				//alert("success...");
				  $('#loa').html("<p style='font-size:17px;color:green'>Record updated successfully...!!!</p>");
				  swal("Good job!", "Record updated successfully!", "success");
				//window.location="<?php echo base_url('adm_nur/Adm_nur/payNow'); ?>";
				window.location="";
				//setTimeout(function(){ $("#loading").click(); window.location=""; }, 1000);
				$( "#f_s" ).val("");
				$( "#photo" ).val("");
				$( "#m_s" ).val("");
					
			}
			}
		});
	}else{
	swal("Check your Aadhaar No!", " Please Enter your valid Aadhaar no!");
	}
	 });
	 </script>
	   <script>
   $( "#photo" ).change(function(){
 
var fileInput = document.getElementById('photo');
	
    var filePath = fileInput.value;
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.JPG|\.JPEG|\.PNG)$/i;
    if(allowedExtensions.exec(filePath)){
		
var vl = URL.createObjectURL(event.target.files[0]);
  $("#photo_view").html("<center><img src='"+vl+"' style='width:100%;height:100px'></center>");
 
    }else{

alert('Only image accepted!');
$( "#photo" ).val("");
}
 });
   
      $( "#f_s" ).change(function(){
 

         var fileInput = document.getElementById('f_s');
    var filePath = fileInput.value;
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.JPG|\.JPEG|\.PNG)$/i;
    if(allowedExtensions.exec(filePath)){
var vl = URL.createObjectURL(event.target.files[0]);
  $("#fs_view").html("<img src='"+vl+"' style='width:100%;height:30px'>");
  
 
    }else{

alert('Only image accepted!');
$( "#f_s" ).val("");
}


   });
        $( "#m_s" ).change(function(){
 

         var fileInput = document.getElementById('m_s');
    var filePath = fileInput.value;
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.JPG|\.JPEG|\.PNG)$/i;
    if(allowedExtensions.exec(filePath)){
var vl = URL.createObjectURL(event.target.files[0]);
  $("#ms_view").html("<img src='"+vl+"' style='width:100%;height:30px'>");
  
 
    }else{

alert('Only image accepted!');
$( "#m_s" ).val("");
}


});



   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <!-- /.content-wrapper -->