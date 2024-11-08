
<style type="text/css">
 .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td 
  {
    color: black;
    font-size: 11px;
  }
  .table td, .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
      padding: 5px!important;
  }
  .error{
    color: red;
   }
.thead-color{
background: #337ab7 !important; color: white !important;
}
@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
@media print {
  .hide-print {
    display: none;
  }
}
.table > thead > tr > th,
.table > tbody > tr > th,
.table > tfoot > tr > th,
.table > thead > tr > td,
.table > tbody > tr > td,
.table > tfoot > tr > td {
    white-space: nowrap !important;
  }
	
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo base_url('employee/employee'); ?>">Monthly Entries</a> <i class="fa fa-angle-right"></i> Attendance Generation</li>
</ol>
  <!-- Content Wrapper. Contains page content -->
<div style="padding: 25px; background-color: white;border-top: 3px solid #5785c3;">
  <div class="row">
    <div class="col-sm-12">
      <div class="" style="padding-bottom: 20px;">
        <section class="content">
          <div class="row">
            <div class="col-sm-12">
                <div class="box box-primary">
                  <!-- /.box-header -->
                  <div class="box-body">
                    <?php if($this->session->flashdata('msg')){
                      echo $this->session->flashdata('msg');
                    } ?>
                    <form id="searchForm" method="post" action="<?= base_url('payroll/salary/attendance_gen'); ?>">
                      <div class="row">
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Month</label><span class="req"> *</span>
                            <input type="text" name="selectedmonth" id="selectedmonth" class="form-control datepicker" autocomplete="off" value="<?php echo set_value('selectedmonth'); ?>" required="">
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Designation</label>
                            <select name="selectdesignation" id="selectdesignation" class="form-control">
                              <option value="">Select</option>
                              <?php foreach($empdesig as $e){?>
                                <option value="<?php echo $e->Sno;?>"><?php echo $e->DESIG;?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-sm-3" style='display:none'>
                          <div class="form-group">
                            <label>Weekend Date</label><span class="req"> *</span> <a href="#" data-toggle="tooltip" title="You can select Multiple Weekend Date" data-placement="right"> <i class="fa fa-question-circle"></i></a>
                            <input type="text" name="weekend" class="form-control mutlidatepicker" id="weekend" autocomplete="off" value="<?php echo set_value('weekend'); ?>">
                          </div>
                        </div> 
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label></label>
                            <button type="submit" class="btn btn-success form-control search_btn" name="search" onclick="processingFun()"><i class="fa fa-search"></i> Search</button>
                          </div>
                        </div>
                      </div>
                    </form>
                    <hr>
                    <?php if(isset($result)){ ?>
                      <div class="row text-center monthly_attendance">
                        <div class="col-sm-12">
                          <strong><?php echo date('M', strtotime(date($chunkData['current_year'].'-'. $chunkData['current_month'] .'-d'))).'-'.$chunkData['current_year']; ?> Attendance Generation</strong>
                          <br>
                          Attendance Cycle From <strong><?php echo date('d-M-Y',strtotime($chunkData['start_cycle'].'-'.$chunkData['prev_month'].'-'.$chunkData['prev_month_year'])). ' </strong>To<strong> '. date('d-M-Y',strtotime($chunkData['end_cycle'].'-'.$chunkData['current_month'].'-'.$chunkData['current_year'])); ?></strong>
                        </div>
                      </div>
                      <hr>
                      <div class="row monthly_attendance">
                        <div class="col-sm-12 text-center">
                          Present : <span class="label label-success">P</span>, 
                          Half Day : <span class="label label-success">HD</span>, 
                          Leave Without Pay : <span class="label label-danger">LWP</span>, 
                          Leave : <span class="label label-info">CL, ML, EL, DDL,HPL</span>, 
                          Holiday : <span class="label label-warning">H</span>, 
                        </div>
                      </div>
                      <hr>
                      <div class="row monthly_attendance">
                        <div class="col-sm-12 text-center">
                          TWD = Total Working Days, TPD = Total Present Days
                        </div>
                      </div><hr>
                      <div  id="printableArea" class="monthly_attendance">
                          <div class="table-responsive" style="height: 500px;">
                            <table class="table table-bordered dataTable table-striped table-hover">
                              <thead>
                                <tr>
                                  <th class="text-center thead-color">EMPID</th>
                                  <th class="text-center thead-color">Employee NAME</th>                
                                  <th class="text-center thead-color">TWD</th>   
                                  <th class="text-center thead-color">TPD</th>   
                                  <?php for ($p=$chunkData['start_cycle']; $p <= $chunkData['prev_month_total_days']; $p++) { 
                                    $date = $chunkData['prev_month_year'].'-'.$chunkData['prev_month'].'-'.$p;
                                    ?>
                                    <th class="text-center thead-color"><?php echo $p.'<br> '.date("D", strtotime($date)); ?></th>
                                  <?php } ?>  
                                  <?php for ($i=1; $i <= $chunkData['end_cycle']; $i++) { 
                                    $date = $chunkData['current_year'].'-'.$chunkData['current_month'].'-'.$i;
                                    ?>
                                    <th class="text-center thead-color"><?php echo $i.'<br> '.date("D", strtotime($date)); ?></th>
                                  <?php } ?>                   
                                </tr>
                              </thead>
                              <tbody>
							 <?php
								 foreach ($result as $key => $value) { 
                                  $array_index = array_search($value['EMPID'], array_column($empAbsent, 'empid'));

                                  $total_half_day_absent = isset($empAbsent[$array_index]['half_days'])?$empAbsent[$array_index]['half_days']/2:0;

                                  $total_absent_day = isset($empAbsent[$array_index]['absent_days'])?$empAbsent[$array_index]['absent_days']:0;
                             
                                  $total_absent =  $total_half_day_absent + $total_absent_day;

                                  $total_present = $this->custom_lib->checkNoofPresentDays($chunkData['current_month_total_days'],$total_absent,$chunkData['prev_month_total_days']);
                                 ?>
                                    <tr>
                                      <td class="text-center"><?php echo $value['EMPID'];?></td>
                                      <td><?php echo strtoupper($value['EMP_FNAME'].' '.$value['EMP_MNAME'].' '.$value['EMP_LNAME']); ?></td>
                                      <td class="text-center"><?php echo $chunkData['current_month_total_days']; ?></td>
                                      <td class="text-center" id='tp<?php echo $key;?>'><?php echo $total_present; ?></td>
                                      <?php  
												// print_r($value);
												 foreach ($dateList as $keys => $val) {
										$valll=$val.'a';
											$valll=$value["$valll"];
										?>
                                        <td class="<?php echo $value['EMPID'].'_'.$valll; ?>"><?php if($value[$val] === 'P') {
									
											?>

                                            <span class='label label-success' data-toggle='tooltip' title="Present"  onclick="funApprove('<?php echo $value['EMPID'];?>','<?php echo $valll;?>','Present','<?php echo $value['id'];?>','<?php echo $key;?>')"><?php echo $value[$val]; ?></span>

                                        <?php  }elseif($value[$val] === 'HD') { ?>

                                            <span class="label label-success" data-toggle='tooltip' title="Half Day"  onclick="funApprove('<?php echo $value['EMPID'];?>','<?php echo $valll;?>','Half Day','<?php echo $value['id'];?>','<?php echo $key;?>')"><?php echo $value[$val]; ?></span>

                                        <?php  }elseif($value[$val] === 'H') { ?>

                                            <span class="label label-warning" data-toggle='tooltip' title="Holiday"  
												   onclick="funApprove('<?php echo $value['EMPID'];?>','<?php echo $valll;?>','Holiday','<?php echo $value['id'];?>','<?php echo $key;?>')"><?php echo $value[$val]; ?></span>

                                        <?php }elseif($value[$val] === 'LWP') { ?>

                                            <span class='label label-danger' data-toggle='tooltip' title="Leave Without Pay" 
												  onclick="funApprove('<?php echo $value['EMPID'];?>','<?php echo $valll;?>','Leave Without Pay','<?php echo $value['id'];?>','<?php echo $key;?>')"><?php echo $value[$val]; ?></span>

                                        <?php }elseif($value[$val] === 'EL' || $value[$val] === 'CL' || $value[$val] === 'ML' || $value[$val] === 'DDL' || $value[$val] === 'HPL') {?>

                                            <span class='label label-info' data-toggle='tooltip' title="Leave" 
												  onclick="funApprove('<?php echo $value['EMPID'];?>','<?php echo $valll;?>','Leave','<?php echo $value['id'];?>','<?php echo $key;?>')"><?php echo $value[$val]; ?></span>

                                        <?php }elseif($value[$val] === 'AB') { ?>

                                            <span class="label label-danger" data-toggle='tooltip' title="Absent"   onclick="funApprove('<?php echo $value['EMPID'];?>','<?php echo $valll;?>','Absent','<?php echo $value['id'];?>','<?php echo $key;?>')"><?php echo $value[$val]; ?></span>

                                        <?php } ?></td>
                                      <?php } ?>
                                    </tr>
                                <?php
											
											 } ?>
                              </tbody>
                            </table>   
                          </div> 
                          <br>
                      </div>
                    <?php } ?>
                  </div>
                </div>
            </div>
          </div>
          <!-- /.box -->
        </section>
      </div>
    </div>
  </div>
</div>
<br><br>

<!--edit Modal-->
<div class="modal fade" id="approvalModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background: #205dc1;color: white;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Details</h4>
      </div>
      <form id="detailsForm">
        <input type="hidden" name="empid_no_1" id="empid_no_1">
		   <input type="hidden" name="key_2" id="key_2">
		   <input type="hidden" name="employee_id" id="employee_id">
        <input type="hidden" name="selected_date_input" id="selected_date_input">
		  <input type="hidden" name="total_prasent" id="total_prasent">
		    <input type="hidden" name="total_prasent_id" id="total_prasent_id">
        <div class="modal-body">
          <table class="table table-striped table-hover table-bordered">
            <tr>
              <th>Attendance Date :</th>
              <td><span class="custom_date_modal"></span></td>
            </tr>
            <tr>
              <th>EMPID :</th>
              <td><span class="empid_modal"></span></td>
            </tr>
            <tr>
              <th>Employee Name :</th>
              <td><span class="emp_name_modal"></span></td>
            </tr>
            <tr>
              <th>Attendance Status :</th>
              <td style="background: black;color: white;"><span class="atten_status_modal"></span></td>
            </tr>
            <tr>
              <th>Minimum Working Hours For Full Day :</th>
              <td><span class="min_hour_full"></span></td>
            </tr>
            <tr>
              <th>Minimum Working Hours For Half Day :</th>
              <td><span class="min_hours_half"></span></td>
            </tr>
            <tr>
              <th>Working Hours :</th>
              <td><span class="working_hour"></span></td>
            </tr>
            <tr>
              <th>In Time Remarks :</th>
              <td><span class="in_time_remarks"></span></td>
            </tr>
            <tr>
              <th>Out Time Remarks :</th>
              <td><span class="out_time_remarks"></span></td>
            </tr>
            <tr>
              <th>CL Balance :</th>
              <td class='clr'><span class="CAS_LEAVE"></span></td>
            </tr>
            <tr>
              <th>EL Balance :</th>
              <td class='clr'><span class="EL"></span></td>
            </tr>
			   <tr>
              <th>ML Balance :</th>
              <td class='clr'><span class="ML"></span></td>
            </tr>
            <tr>
              <th>HPL Balance :</th>
              <td class='clr'><span class="hpl"></span></td>
            </tr>
          </table>
          <br>
          <div class="row"> 
            <div class="col-sm-12">
              <div class="form-group">
              <label>Pay Type</label><span class="req">*</span>
              <div class="pay_type_row">
                
              </div>
            </div>
            </div> 
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id="update_btn">Update</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

 <script type="text/javascript">

$('.dataTable').dataTable({
      "bDestroy": true,
       "ordering": false,
       "paging": false,
        dom: 'Bfrtip',
        buttons: [
            {
              extend: 'excelHtml5',
              title: 'Monthly Attendance Generation',
                            
            },
        ],
    });


var st_date = '<?php echo $current_year.'-'.$current_month.'-1'; ?>';
var end_dt = '<?php echo $current_year.'-'.$current_month.'-'.$total_days; ?>';
var startDate = new Date(st_date);
var endDate = new Date(end_dt);

$(".datepicker").datepicker({
 format: 'M-yyyy',
    autoclose: true,
    startView: "months", 
    minViewMode: "months",
   startDate: startDate,
   endDate: endDate
});


$('.mutlidatepicker').datepicker({
  multidate: true,
  format: 'dd-M-yyyy',
});


//validation
$(document).ready(function () {
    $('#detailsForm').validate({ // initialize the plugin
        rules: {
            pay_type: {
                required: true
            },
        },
        submitHandler: function (form) { // for demo 
             if ($(form).valid()) 
                 form.submit(); 
             return false; // prevent normal form posting
        }
    });
});

//validation
$(document).ready(function () {
    $('#searchForm').validate({ // initialize the plugin
        rules: {
            date: {
                required: true
            },
            weekend: {
                required: true
            },
        },
        submitHandler: function (form) { // for demo 
             if ($(form).valid()) 
                 form.submit(); 
             return false; // prevent normal form posting
        }
    });
});


$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip(); 
});

 $( document ).ajaxComplete(function() {
            // Required for Bootstrap tooltips in DataTables
            $('[data-toggle="tooltip"]').tooltip({
                "html": true,
                "delay": {"show": 10, "hide": 0},
            });
        });

 $('.select2').select2();


function funApprove(emp_id,selected_date,status,empid_no,key)
{
	
	$('#selected_date_input').val(selected_date);
	$('#employee_id').val(emp_id);
		$('#empid_no_1').val(empid_no);
	$('#key_2').val(key);
	var total_prasent=$('#tp'+key).html();
	$('#total_prasent').val(total_prasent);
	$('#total_prasent_id').val(key);
//alert("Emp_id:"+emp_id+" date:"+selected_date+" status:"+status);
  var shift_id = $('#selected_shift_id').val();
 var month = '<?php echo $current_month; ?>';
	
var year = '<?php echo $current_year; ?>';
  $.ajax({
      url: "<?php echo base_url('payroll/salary/attendance_gen/checkAttendanceGenerated'); ?>",
      type: "POST",
      data: {emp_id:emp_id,selected_date:selected_date,shift_id:shift_id,month:month,year:year,empid_no:empid_no},
      dataType: 'json',
      beforeSend:function()
      {
        showLoader();
      },
      success: function(response){
        hideLoader();
        if(response.msg == 2)
        {
          swal({title: "Please Generate Attendance First", text: "Please Generate Attendance First", type: "info"});
        }
        else
        {
		
          $('#approvalModal').modal({
            backdrop: 'static',
            keyboard: false
          });

          $('.custom_date_modal').html(selected_date);
          $('.empid_modal').html(response.EMPID);
         
			
			
          $('.emp_name_modal').html(response.EMP_FNAME +' '+response.EMP_MNAME+' '+response.EMP_LNAME);
          $('.atten_status_modal').html(status);
			
			         $('.pay_type_row').html('<div class="form-group">'+
                '<div class="row alert">'+
                  '<div class="col-sm-4">'+
                    '<label>'+
                      '<input type="radio" class="flat-red pay_type" name="pay_type" value="P">PAID LEAVE'+
                    '</label>'+
                  '</div>'+
                  '<div class="col-sm-4">'+
                    '<label>'+
                      '<input type="radio" class="flat-red pay_type" name="pay_type" value="HD">HALF PAID LEAVE'+
                    '</label>'+
                  '</div>'+
                  '<div class="col-sm-4">'+
                    '<label>'+
                      '<input type="radio" class="flat-red pay_type" name="pay_type" value="AB">LEAVE WITHOUT PAY'+
                    '</label>'+
                  '</div>'+
              '</div>'+ '<div class="col-sm-4">'+
                    '<label>'+
                      '<input type="radio" class="flat-red pay_type" name="pay_type" value="CL">CASUAL LEAVE'+
                    '</label>'+
                  '</div>'+
              '</div>'+'<div class="col-sm-4">'+
                    '<label>'+
                      '<input type="radio" class="flat-red pay_type" name="pay_type" value="EL">EARN LEAVE'+
                    '</label>'+
                  '</div>'+
              '</div>'+'<div class="col-sm-4">'+
                    '<label>'+
                      '<input type="radio" class="flat-red pay_type" name="pay_type" value="ML">MEDICAL LEAVE'+
                    '</label>'+
                  '</div>'+
              '</div>'+
              '</div>');
         
			$('.hpl').html(response.hpl);
			$('.EL').html(response.EL);
			$('.ML').html(response.ML);
			$('.CAS_LEAVE').html(response.CAS_LEAVE);
			
          $('.in_time_remarks').html(response.IN_TIME_REMARKS);
			
          $('.out_time_remarks').html(response.OUT_TIME_REMARKS);
 	$('.min_hours_half').html(response.shift.MIN_HRS_HALF);
			$('.min_hour_full').html(response.shift.MIN_HRS_FULL);
         	$('.working_hour').html(response.tot_duration);
 
          
        }
      }
    });
}



//update 
 $("#update_btn").on("click", function(event){
  $("#detailsForm").validate();
  if ($('#detailsForm').valid())
  {
	  
  var pay_type = $("input[name='pay_type']:checked").val();
	  
 // var shift_id = $('#selected_shift_id').val();
	
  var employee_id = $('#employee_id').val();
	
  var selected_date = $('#selected_date_input').val();
	  var update_type_id=employee_id+'_'+selected_date;
 // var sel_date = new Date(selected_date);
 //var column_name = sel_date.getDate();
  //var month = '<?php //echo $current_month; ?>';
	 
  var year = '<?php echo $current_year; ?>';
 // var leave_attendance_id = $('#leave_attendance_id').val();
    event.preventDefault();
     $.ajax({
      url: "<?php echo base_url('payroll/salary/attendance_gen/updateSingleDate'); ?>",
      type: "POST",
      data: {year:year,pay_type:pay_type,employee_id:employee_id,selected_date:selected_date},
      //dataType: 'json',
       beforeSend:function()
        {
          showLoader();
        },
      success: function(response){
		  	  
		 hideLoader();
		var  empid_no_1=$('#empid_no_1').val();
	    var  key_2=$('#key_2').val();
		  
   	    var  total_prasent=parseFloat($('#total_prasent').val());
	    var total_prasent_id = $('#total_prasent_id').val();
		  var atten_status_modal = $('.atten_status_modal').html();
		
		  if(pay_type=='AB'){
			   if(atten_status_modal =="Halp Day"){
					   total_prasent=total_prasent-0.5;
					  }else{
						  total_prasent=total_prasent-1;
					  }
		  
		  }else if(pay_type=='HD'){
			  
			    if(atten_status_modal =="Absent"){
				 total_prasent=total_prasent+0.5;
				 }
			   else if(atten_status_modal =="Halp Day"){
				 total_prasent=total_prasent;
				 }else{
				  total_prasent=total_prasent-0.5;
				 }
		  }else{
			  if(atten_status_modal =="Absent"){
				 total_prasent=total_prasent+1;
				 }
			   if(atten_status_modal =="Halp Day"){
				  
				 total_prasent=total_prasent+0.5;
				  
				    
				 }
			  
		   
		  }
		  $("#tp"+total_prasent_id).html(total_prasent);
		  if(pay_type =='AB'){
		  $("."+update_type_id).html('<span class="label label-danger" data-toggle="tooltip" title="Absent" onclick="funApprove('+"'"+employee_id+"'"+','+"'"+selected_date+"'"+','+"'Absent'"+','+"'"+empid_no_1+"'"+','+"'"+key_2+"'"+')">AB</span>');
		  }else if(pay_type =='P'){
		   $("."+update_type_id).html('<span class="label label-success" data-toggle="tooltip" title="Prasent"  onclick="funApprove('+"'"+employee_id+"'"+','+"'"+selected_date+"'"+','+"'Prasent'"+','+"'"+empid_no_1+"'"+','+"'"+key_2+"'"+')">P</span>');
		  }
		  else if(pay_type =='HD'){
		 $("."+update_type_id).html('<span class="label label-success" data-toggle="tooltip" title="Halp Day"  onclick="funApprove('+"'"+employee_id+"'"+','+"'"+selected_date+"'"+','+"'Halp Day'"+','+"'"+empid_no_1+"'"+','+"'"+key_2+"'"+')">HD</span>');
		  }
		   else if(pay_type =='CL' || pay_type =='EL' || pay_type =='ML' || pay_type =='HPL'){
			$("."+update_type_id).html('<span class="label label-info" data-toggle="tooltip" title="Leave"  onclick="funApprove('+"'"+employee_id+"'"+','+"'"+selected_date+"'"+','+"'Leave'"+','+"'"+empid_no_1+"'"+','+"'"+key_2+"'"+')">'+pay_type+'</span>');
			   
		  }else
		  { 
	$("."+update_type_id).html('<span class="label label-danger" data-toggle="tooltip" title="Holiday"  onclick="funApprove('+"'"+employee_id+"'"+','+"'"+selected_date+"'"+','+"'Holiday'"+','+"'"+empid_no_1+"'"+','+"'"+key_2+"'"+')">'+pay_type+'</span>');
			  
		  }
		    $('#approvalModal').modal('hide');
		  
		}
    });
   }
});

 function processingFun()
 {
    $('#searchForm').validate();
    if($('#searchForm').valid())
    {
      showLoader();
    }
 }

document.onreadystatechange = function () {
  var state = document.readyState
  if (state == 'interactive') {
       showLoader();
  } else if (state == 'complete') {
      setTimeout(function(){
         hideLoader();
      },1000);
  }
}
  </script>