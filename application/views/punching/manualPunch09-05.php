<?php
// print_r($attendanceList);die;
?>
<style type="text/css">
  .table>thead>tr>th,
  .table>tbody>tr>th,
  .table>tfoot>tr>th,
  .table>thead>tr>td,
  .table>tbody>tr>td,
  .table>tfoot>tr>td {
    color: black;
  }

  .error {
    color: red;
  }

  .loader {
    position: fixed;
    top: 50%;
    left: 50%;
    border: 16px solid #f3f3f3;
    /* Light grey */
    border-top: 16px solid #3498db;
    /* Blue */
    border-radius: 50%;
    width: 120px;
    height: 120px;
    animation: spin 2s linear infinite;
    z-index: 999;
  }

  @keyframes spin {
    0% {
      transform: rotate(0deg);
    }

    100% {
      transform: rotate(360deg);
    }
  }

  @media print {
    .hide-print {
      display: none;
    }
  }

  .table>thead>tr>th,
  .table>tbody>tr>th,
  .table>tfoot>tr>th,
  .table>thead>tr>td,
  .table>tbody>tr>td,
  .table>tfoot>tr>td {
    color: black;
    padding: 5px !important;
    font-size: 12px;
  }

  .thead-color {
    background: #337ab7 !important;
    color: white !important;
  }

  .table>thead>tr>th,
  .table>tbody>tr>th,
  .table>tfoot>tr>th,
  .table>thead>tr>td,
  .table>tbody>tr>td,
  .table>tfoot>tr>td {
    font-size: 12px;
    padding: 5px;
    white-space: nowrap;
  }
</style>
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="#">Human Resource</a> <i class="fa fa-angle-right"></i> Daily Employee Attendance</li>
</ol>
<iframe src="<?php echo base_url('start_link_connect.aspx'); ?>" style="display: none;"></iframe>
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
					
                  <!--<a href="#" class="btn btn-black" onclick="addManualPunch()"><i class="fa fa-plus"></i> Add Manual Punch</a> -->

                  

                  <form method="post" action="<?php echo base_url('punching/manualpunch'); ?>">
                    <div class="row">
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Date</label><span class="req">*</span>
                          <input type="text" name="time_from" class="form-control datepicker" value="<?php echo set_value('time_from'); ?>" data-date-end-date="0d" autocomplete="off">
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="form-group">
                          <label></label>
                          <button class="btn btn-success form-control" type="submit" name="search"><i class="fa fa-search"></i> Search</button>
                        </div>
                      </div>
                    </div>
                    <hr>
                  </form>

                  <center>
                    <a href="<?php echo base_url('punching/manualpunch/pdfReport/' . $date); ?>" class="btn btn-success"><i class="fa fa-file-pdf-o"></i> View Report</a>
                  </center><br>

                  <div id="printableArea">

                    <div style="font-size: 12px;">
                      <label style="position: absolute;right: 0px;">
                        <label style="background-color: #d9534f !important;padding: 4px 6px !important; border: none !important;text-shadow: none !important;font-weight: 300 !important;border-radius: 4px !important;display: inline !important; padding: .2em .6em .3em !important; font-size: 75% !important;font-weight: bold !important;    line-height: 1 !important; color: #fff !important;text-align: center !important; white-space: nowrap !important;    vertical-align: baseline !important;">Late IN / Before OUT</label>
                        <label style="background-color: #f0ad4e !important;padding: 4px 6px !important; border: none !important;text-shadow: none !important;font-weight: 300 !important;border-radius: 4px !important;display: inline !important; padding: .2em .6em .3em !important; font-size: 75% !important;font-weight: bold !important;    line-height: 1 !important; color: #fff !important;text-align: center !important; white-space: nowrap !important;    vertical-align: baseline !important;">Before IN / After OUT</label>
                        <label style="background-color: #5cb85c !important;padding: 4px 6px !important; border: none !important;text-shadow: none !important;font-weight: 300 !important;border-radius: 4px !important;display: inline !important; padding: .2em .6em .3em !important; font-size: 75% !important;font-weight: bold !important;    line-height: 1 !important; color: #fff !important;text-align: center !important; white-space: nowrap !important;    vertical-align: baseline !important;">Right Time</label>
                      </label>
                    </div>

                    <hr>

                    <div class="table-responsive">
                      <table class="table table-bordered dataTable">
                        <thead style="background: #d2d6de;">
                          <tr>
							 <th style="background: #337ab7 !important; color: white !important;">Slno.</th>
                            <th style="background: #337ab7 !important; color: white !important;">Attendance <br> Status</th>
                            <th style="background: #337ab7 !important; color: white !important;">EMP ID</th>
                            <th style="background: #337ab7 !important; color: white !important;">EMP Name</th>
							  
                            <th style="background: #337ab7 !important; color: white !important;">Start Time</th>
							<th style="background: #337ab7 !important; color: white !important;">End Time</th>
							  
                            <th style="background: #337ab7 !important; color: white !important;">Date</th>
                            <th style="background: #337ab7 !important; color: white !important;">In Time</th>
                            <th style="background: #337ab7 !important; color: white !important;">IN Status</th>
                            <th style="background: #337ab7 !important; color: white !important;">Out Time</th>
                            <th style="background: #337ab7 !important; color: white !important;">Out Status</th>
                           
                            <th style="background: #337ab7 !important; color: white !important;">Work <br> Duration (W.D)</th>
                           
                            <!-- <th style="background: #337ab7 !important; color: white !important;">Total W.D</th> -->
                          </tr>
                        </thead>

                        <tbody>

                          <?php $i=1; foreach ($attendanceList as $key => $val) { ?>

                            <tr>
								
								<td><?php echo $i; ?></td>

                              <td>
                                <select name="select_id" class="form-control select" onchange="updateAttt('<?php echo $val['EMPID']; ?>');">
                                  <option value="">Select</option>
                                  <option value="P" <?php if ($val['ATT_STATUS'] == 'P') echo 'selected'; ?>>Present</option>
                                  <option value="AB" <?php if ($val['ATT_STATUS'] == 'AB') echo 'selected'; ?>>Absent</option>
                                  <option value="HD" <?php if ($val['ATT_STATUS'] == 'HD') echo 'selected'; ?>>Halfday</option>
                                </select>
                              </td>

                              <td class="contenteditable" contenteditable="true" onblur="updateAtt('EMPID','<?php echo $val['EMPID']; ?>')" id="EMPID_<?php echo $val['EMPID']; ?>"><?php echo $val['EMPID']; ?></td>


                              <td><?php echo $val['EMP_FNAME'] . ' ' . $val['EMP_MNAME'] . ' ' . $val['EMP_LNAME']; ?></td>
								
                              <td><?php echo $val['START_TIME']; ?></td>
								<td><?php echo $val['STOP_TIME']; ?></td>

                              <td class="dt" id="dt"><?php echo $date; ?></td>

                              <td class="contenteditable" contenteditable="true" onblur="updateAtt('IN_TIME','<?php echo $val['EMPID']; ?>')" id="IN_TIME_<?php echo $val['EMPID']; ?>"><?php echo $val['IN_TIME']; ?></td>



                              <td>
                                <?php
                                if (!empty($val['IN_TIME'])) {
                                  $inTime = new DateTime($val['IN_TIME']);
                                  $expectedInTime = new DateTime($val['START_TIME']); // Define the expected in-time here
                                  if ($inTime > $expectedInTime) {
                                    echo "Late In";
                                  } elseif ($inTime < $expectedInTime) {
                                    echo "Before In";
                                  } else {
                                    echo "On Time";
                                  }
                                }
                                ?>
                              </td>

                              <td class="contenteditable" contenteditable="true" onblur="updateAtt('OUT_TIME','<?php echo $val['EMPID'] ?>')" id="OUT_TIME_<?php echo $val['EMPID']; ?>"><?php echo $val['OUT_TIME']; ?></td> <!-- 14:30:00-->

                              <td>
                                <?php
                                if (!empty($val['OUT_TIME'])) {
                                  $inTime = new DateTime($val['OUT_TIME']);
                                  $expectedInTime = new DateTime($val['STOP_TIME']); // Define the expected in-time here
                                  if ($inTime > $expectedInTime) {
                                    echo "After Out";
                                  } elseif ($inTime < $expectedInTime) {
                                    echo "Before Out";
                                  } else {
                                    echo "On Time";
                                  }
                                }
                                ?>
                              </td>

                             

                              <td>
                                <?php
                                $inTime = new DateTime($val['IN_TIME']);
                                $outTime = new DateTime($val['OUT_TIME']);
                                $interval = $inTime->diff($outTime);
                                echo $interval->format('%H:%I' . ' hrs');
                                ?>
                              </td>

                             
                            </tr>

                          <?php $i++; } ?>

                        </tbody>

                      </table>
                    </div>
                    
                  </div>
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

<div class="modal fade" id="addManualPunchModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background: #205dc1;color: white;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Manual Punching</h4>
      </div>
      <form id="addManualPunchForm" class="form-horizontal">
        <div class="modal-body">
          <div class="form-group">
            <label class="control-label col-sm-3">Designation:</label>
            <div class="col-sm-9">
              <select class="form-control" name="designation" id="designation" onchange="getEmployee()">
                <option value="">Select Designation</option>
                <?php foreach ($designation as $key => $value) { ?>
                  <option value="<?php echo $value['Sno']; ?>"><?php echo $value['DESIG']; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-3">Employee:</label>
            <div class="col-sm-9">
              <select class="form-control select2" id="employee" name="employee" style="width: 100%;" onchange="clearTimeandDate()">

              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-3">Time (in 24 hours) :</label>
            <div class="col-sm-9">
              <input type="text" class="form-control clockpicker" id="in_time" name="time" readonly="">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-3">Date :</label>
            <div class="col-sm-9">
              <input type="text" class="form-control datepicker" id="in_date" name="date" data-date-end-date="0d" onchange="checkHoliday();checkMonthlyAttendanceGenerated();" autocomplete="off">
              <span class="date_msg" style="display: none;">
                <div class="alert alert-warning">Today is Holiday.</div>
              </span>
              <div class="alert alert-danger warning_msg_div" style="display: none;"><span class="warning_msg"></span></div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id="save_btn">Save</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<br>
<div class="loader"></div>
<script type="text/javascript">
  $('.loader').hide();

  $(function() {
    $('.dataTable').DataTable({
      'paging': true,
      'lengthChange': false,
      'searching': true,
      'ordering': true,
      'info': false,
      'autoWidth': true,
      'pageLength': 50,
      aaSorting: [
        [0, 'asc']
      ]
    })
  });

  //Flat red color scheme for iCheck
  $('input[type="radio"].flat-red, input[type="radio"].flat-red').iCheck({
    checkboxClass: 'icheckbox_flat-green',
    radioClass: 'iradio_flat-green'
  });

  //Date picker
  $('.datepicker').datepicker({
    format: 'dd-M-yyyy',
    autoclose: true,
    orientation: "bottom",
    todayHighlight: true,
  });

  $('.clockpicker').clockpicker({
    placement: 'bottom',
    align: 'left',
    autoclose: true,

  });


  function addManualPunch() {
    $('#addManualPunchModal').modal({
      backdrop: 'static',
      keyboard: false
    });
  }


  //validation
  $(document).ready(function() {
    $('#addManualPunchForm').validate({ // initialize the plugin
      rules: {
        designation: {
          required: true
        },
        employee: {
          required: true
        },
        date: {
          required: true,
        },
        time: {
          required: true
        },
      },
      submitHandler: function(form) { // for demo 
        if ($(form).valid())
          form.submit();
        return false; // prevent normal form posting
      }
    });
  });

  function checkHoliday() {
    var in_date = $('#in_date').val();
    $.ajax({
      url: '<?php echo base_url('punching/manualpunch/checkHolidayDate'); ?>',
      type: "POST",
      data: {
        in_date: in_date
      },
      dataType: 'json',
      beforeSend: function() {
        $('.loader').show();
        $('body').css('opacity', '0.5');
      },
      success: function(response) {
        $('.loader').hide();
        $('body').css('opacity', '1.0');
        var date = new Date(in_date);
        if (date.getDay() == 0) {
          $('.date_msg').show();
        } else {
          if (response.message == 1) {
            $('.date_msg').show();
          } else {
            $('.date_msg').hide();
          }
        }
      }
    });
  }



  //this function checks that monthly attendance generated for this date or this month or not if generated then punching not allowed
  function checkMonthlyAttendanceGenerated() {
    var in_date = $('#in_date').val();
    var emp_id = $('#employee').val();
    $.ajax({
      url: '<?php echo base_url('punching/manualpunch/checkMonthlyAttendanceGenerated'); ?>',
      type: "POST",
      data: {
        in_date: in_date,
        emp_id: emp_id
      },
      dataType: 'json',
      beforeSend: function() {
        $('.loader').show();
        $('body').css('opacity', '0.5');
      },
      success: function(response) {
        $('.loader').hide();
        $('body').css('opacity', '1.0');
        if (response.message == 1) {
          $('.warning_msg_div').show();
          $('.warning_msg').html('Monthly Attendance Generated That&rsquo;s why You are not able for manual punching');
          $('#save_btn').hide();
        } else {
          $('.warning_msg_div').hide();
          $('#save_btn').show();
        }
      }
    });
  }

  $(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
  });

  //creating new shift
  $("#save_btn").on("click", function(event) {
    $("#addManualPunchForm").validate();
    if ($('#addManualPunchForm').valid()) {
      var time_check = $('.time_check').val();
      var url = '<?php echo base_url('punching/manualpunch/create'); ?>';
      event.preventDefault();
      $.ajax({
        url: url,
        type: "POST",
        data: $("#addManualPunchForm").serialize(),
        dataType: 'json',
        beforeSend: function() {
          $('.loader').show();
          $('body').css('opacity', '0.5');
        },
        success: function(response) {
          $('.loader').hide();
          $('body').css('opacity', '1.0');
          if (response.msg == 1 || response.msg == 3) {
            $('#addManualPunchForm')[0].reset();
            $('#addManualPunchModal').modal('hide');
            if (response.msg == 1) {
              swal({
                  title: "Attendance Marked Successfully",
                  text: "Attendance Marked Successfully",
                  type: "success"
                },
                function() {
                  location.reload();
                }
              );
            } else {
              swal({
                  title: "Attendance Marked Successfully",
                  text: "Attendance Marked Successfully",
                  type: "success"
                },
                function() {
                  location.reload();
                }
              );
            }

          } else {
            swal({
              title: "Creation Failed!",
              text: "Creation Failed!",
              type: "error"
            });
          }
        }
      });
    }
  });

  function clearTimeandDate() {
    $('#in_date').val('');
    $('#in_time').val('');
  }

  function getEmployee() {
    var div_data = "<option value=''>Select Employee</option>";
    var designation = $('#designation').val();
    $.ajax({
      url: "<?php echo base_url('punching/manualpunch/getEmployee'); ?>",
      data: {
        designation: designation
      },
      type: "POST",
      dataType: 'json',
      beforeSend: function() {
        $('.loader').show();
        $('body').css('opacity', '0.5');
      },
      success: function(result) {
        $('.loader').hide();
        $('body').css('opacity', '1.0');
        $.each(result, function(key, val) {
          if (val.EMP_MNAME != null) {
            div_data += "<option value='" + val.id + "'>" + val.EMPID + ' ' + val.EMP_FNAME + ' ' + val.EMP_MNAME + ' ' + val.EMP_LNAME + "</option>";

          } else {
            div_data += "<option value='" + val.id + "'>" + val.EMPID + ' ' + val.EMP_FNAME + ' ' + val.EMP_LNAME + "</option>";

          }



        });
        $('#employee').html(div_data);
      }
    });
  }

  function updateAtt(column_name, emp_id) {

    var cell_value = $('#' + column_name + '_' + emp_id).text();
    var dt = $('#dt').text();

    // alert(dt);
    $.ajax({
      url: '<?php echo base_url('punching/Manualpunch/updateATT'); ?>',
      data: {
        column_name: column_name,
        emp_id: emp_id,
        dt: dt,
        cell_value: cell_value
      },
      method: "post",
      dataType: "json",
      success: function() {
        $.toast({
          heading: 'Success',
          text: 'Saved Successfully',
          showHideTransition: 'slide',
          icon: 'success',
          position: 'top-right',
        });
      }
    });
  }

  $('.select2').select2();
	
	  function updateAttt(empid) {
  
    var selectValue = document.querySelector("select[name='select_id']").value;
    var dt = $('#dt').text();
     
    // alert(selectValue);

    $.ajax({
      url: '<?php echo base_url('punching/Manualpunch/updateATTT'); ?>',
      data: {
        selectValue,selectValue,
        dt: dt,
        empid: empid
      },
      method: "post",
      dataType: "json",
      success: function() {
        $.toast({
          heading: 'Success',
          text: 'Saved Successfully',
          showHideTransition: 'slide',
          icon: 'success',
          position: 'top-right',
        });
      }
    });

  }
  
</script>
<script type="text/javascript">
  function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
  }
</script>