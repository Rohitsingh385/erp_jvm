<style>
  table tr td,th{
	  color:#000 !important;
	  padding-top:0px !important;
  }
  .table-striped > tbody > tr:nth-of-type(odd) {
    background-color: #eee;
  }
</style>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">EXAM WISE TABULATION SHEET</a>
</ol>

<div style="padding: 5px; background-color: white"><br/><br/>
	<form  id='form'>
  <div class="row" style='margin-top: -35px;'>
	  
	<div class="col-sm-2">
	  <label>Session</label>
	  <select class="form-control" onchange="sessions(this.value)" id="session" name='session'>
		  <option value=''>Select</option>
		   <option value='2024-2025'>2024-2025</option>
	  </select>
   </div>
   
 
   
	<div class="col-sm-2">
	  <label>Class</label>
	  <select class="form-control" onchange="classes(this.value)" id="classs" name='class'>
		  <option value=''>Select</option>
		   <option value='1'>NURSERY</option>
		   <option value='2'>PREP</option>
		   <option value='3'>I</option>
		   <option value='4'>II</option>
		   <option value='5'>III</option>
		   <option value='6'>IV</option>
		   <option value='7'>V</option>
		   <option value='8'>VI</option>
		   <option value='9'>VII</option>
		   <option value='10'>VIII</option>
		   <option value='11'>IX</option>
		   <option value='12'>X</option>
		   <option value='13'>XI</option>
		   <option value='14'>XII</option>
	  </select>
	
   </div>
   <div class="col-sm-2">
	  <label>Sec</label>
	  <select class="form-control" name="sec" id="sec" >
		  <option value=''>Select</option>
	  </select>
   </div>	  
   <div class="col-sm-3">  
	  <label>Exam Type</label>
	  <select class="form-control" id="exm_type" name="exm_type">
		  <option value=''>--Select--</option>
		  <?php
		  foreach($exam as $key){
		  ?>
			  <option value='<?php echo  $key->ExamCode;?>'><?php echo $key->ExamName;?></option>
			  <?php
		  }
		  ?>
		  
	  </select>
   </div>
 
   <div class="col-sm-2"><br />
	<input type='submit' class='btn btn-success pull-right' value='Display'>
   </div>
  </div>
</form>
<!-- end marks modal -->
	<div id='report_view'>
		</div>
</div>
<br /><br />
<div class="clearfix"></div>
                   
	
<!-- script-for sticky-nav -->
		<script>
		$(document).ready(function() {
			 var navoffeset=$(".header-main").offset().top;
			 $(window).scroll(function(){
				var scrollpos=$(window).scrollTop(); 
				if(scrollpos >=navoffeset){
					$(".header-main").addClass("fixed");
				}else{
					$(".header-main").removeClass("fixed");
				}
			 });
			 
		});
		</script>
		<!-- /script-for sticky-nav -->
<!--inner block start here-->
<div class="inner-block">

</div>
<!--inner block end here-->
<!--copy rights start here-->

<script>
   function sessions(){
	  var session = $("#session").val();
	  
	  $.post("<?php echo base_url('Marks_entry/session'); ?>",{session:session},function(data){
		  $("#classs").html(data);
	  });
  }	
  

  function classes(val){
	  
		  $("#type").html("<option value=''>Select</option><option value='T'>Theory</option><option value='P'>Practical</option>")
	 
	  var session = $("#session").val();
	  $.post("<?php echo base_url('Marks_entry/classess_exam_wise_tbl'); ?>",{val:val,session:session},function(data){
		  var fill = $.parseJSON(data);
		  $("#sec").html(fill[0]);
		  $("#Class_No").val(fill[1]);
		  $("#ExamMode").val(fill[2]);
	  });
  }
  
 
$("#form").on("submit", function (event) {
	$('body').css('opacity','0.4');
    event.preventDefault();
    $.ajax({
		url: "<?php echo base_url('student_report/exam_tabulation_data_new');?>",
		type: "POST",
		data: $("#form").serialize(),
		success: function(data){
			$('#report_view').html(data);
			$('body').css('opacity','0.9');
		}
	});
 });
  


</script>
