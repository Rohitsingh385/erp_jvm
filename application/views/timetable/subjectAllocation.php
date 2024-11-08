<style type="text/css">
 .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td 
  {
    color: black;
    padding: 5px !important;
    font-size: 12px;
  }

    .backgroundRed{
        color: #ebddb7;
    }
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Timetable</a> <i class="fa fa-angle-right"></i> Subject Allocation</li>
</ol>
  <!-- Content Wrapper. Contains page content -->
  <div style="padding-left: 25px; background-color: white;border-top: 3px solid #5785c3;padding-top: 20px;font-size: 12px !important;">
  <div class="row">
  <div class="col-sm-12">
      <div class="" style="padding-bottom: 20px;">
        <section class="content">
          <div class="row">
            <div class="col-sm-4">
              <?php echo form_open('timetable/floorclassdistribution/create',array('role'=>'form','id'=>'createForm')); ?>
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <p class="box-title" style="font-weight: bold;">Subject Allocation for Teacher and Class / Section</p><hr>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <?php if($this->session->flashdata('msg')){ 
                      echo $this->session->flashdata('msg');
                     } ?>
                    <div class="form-group">
                      <label>Subject</label><span class="req">*</span>
                      <select class="form-control" name="subject_id" required="" id="subject_id" onchange="getTeacherList();getClassWithTeacherDetails()">
                        <option value="">Select</option>
                        <?php foreach ($subjectsList as $key => $value) { ?>
                          <option value="<?php echo $value['SubCode']; ?>"><?php echo $value['SubName']; ?></option>
                        <?php } ?>
                      </select>
                      <span class="error"><?php echo form_error('subject_id'); ?></span>
                    </div>
                    <div class="form-group">
                      <div class="form-inline">
                        <input type="radio" name="teacher_list_load" value="1" checked="" id="load_all" onclick="getTeacherList()"> <label for="load_all">Load All Teacher List</label>
                      </div>
                      <div class="form-inline">
                        <input type="radio" name="teacher_list_load" value="2" id="load_selected" onclick="getTeacherList()"> <label for="load_selected">Load Teacher By Subject Preferences</label>
                      </div>
                      <span class="error"><?php echo form_error('floor_name'); ?></span>
                    </div> 
                    <div class="form-group">
                      <label>Teacher</label><span class="req">*</span>
                      <select class="form-control select2" name="teacher_id" required="" id="teacher_id" onchange="getSubjectListinTable();">

                      </select>
                      <span class="error"><?php echo form_error('teacher_id'); ?></span>
                    </div>  
                    <div class="form-group">
                      <label>Teacher Option</label><span class="req">*</span>
                      <select class="form-control" name="teacher_option" required="" id="teacher_option">
                        <option value="1">Main Teacher</option>
                        <option value="2">Support Teacher</option>
                      </select>
                      <span class="error"><?php echo form_error('teacher_option'); ?></span>
                    </div>  
                    <div class="form-group">
                      <label>Class - Section</label><span class="req">*</span>
                      <select class="form-control select2" name="class_name_Roman" required="" id="class_name_Roman" style="width: 100%;" onchange="classWiseSubjectDetails()">
                        
                      </select>
                      <span class="error"><?php echo form_error('class_name_Roman'); ?></span>
                    </div>   

                    <div class="">
                      <div class="form-group">
                        <label>Select Other Class - Section for Merged Subject</label>
                        <select class="form-control select2" multiple="" name="combined_class">
                          
                        </select>
                      </div>  
                      <div class="form-group">
                        <label id="divtoBlink">Combined Subject List</label>
                        <select multiple="" class="form-control">
                          <option>Biology</option>
                          <option>Chemistry</option>
                          <option>Psychology</option>
                        </select>
                      </div> 
                    </div>
                  </div>
                <div class="box-footer">
                  <button type="submit" class="btn btn-black pull-right">Save</button>
                </div>
                </div>
              <?php echo form_close(); ?>
            </div>


            <div class="col-sm-4">
                <div class="box box-primary">
                  <span style="font-size: 12px !important;">
                    <span style="background: #c5c9d1 !important;">Class Teacher of Class</span> : <strong id="class_teacher_of_class"></strong><br><br>
                  </span>
                  <hr>
                  <div class="box-header with-border">
                    <p class="box-title" style="font-weight: bold;">Teacher Subject Bundle</p><hr>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table class="table table-bordered dataTable table-striped">
                      <thead style="background: #d2d6de;">
                        <tr>
                          <th style="background: #337ab7; color: white !important;">S.No.</th>
                          <th style="background: #337ab7; color: white !important;">Class</th>
                          <th style="background: #337ab7; color: white !important;">Subject</th>
                          <th style="background: #337ab7; color: white !important;">Periods</th>
                        </tr>
                      </thead>
                      <tbody id="teacher_subject_bundle">
                        
                      </tbody>
                    </table>  
                  </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="box box-primary">
                  <span style="font-size: 12px !important;">
                    <span style="background: #c5c9d1 !important;">Total Bundles </span>: <strong>55</strong><br>
                    <span style="background: #c5c9d1 !important;">Total Periods </span>: <strong>55</strong>
                  </span>
                  <hr>
                  <div class="box-header with-border">
                    <p class="box-title" style="font-weight: bold;">Class Wise Subject Details</p><hr>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body" id="class_wise_subject_details">
                    <table class="table table-bordered dataTable table-striped">
                      <thead style="background: #d2d6de;">
                        <tr>
                          <th style="background: #337ab7; color: white !important;">S.No.</th>
                          <th style="background: #337ab7; color: white !important;">Subject</th>
                          <th style="background: #337ab7; color: white !important;">Periods</th>
                          <th style="background: #337ab7; color: white !important;">Main Teacher</th>
                          <th style="background: #337ab7; color: white !important;">Support Teacher</th>
                        </tr>
                      </thead>
                    </table>    
                  </div>
                </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12">
                <div class="box box-primary">
                  <div class="box-header with-border"><hr>
                    <p class="box-title" style="font-weight: bold;">Class-Section Subject Details</p><hr>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <div class="table-responsive">
                      <table class="table table-bordered dataTable table-striped">
                        <thead style="background: #d2d6de;">
                          <tr>
                            <th style="background: #337ab7; color: white !important;">S.No.</th>
                            <th style="background: #337ab7; color: white !important;">Class</th>
                            <th style="background: #337ab7; color: white !important;">A</th>
                            <th style="background: #337ab7; color: white !important;">B</th>
                            <th style="background: #337ab7; color: white !important;">C</th>
                            <th style="background: #337ab7; color: white !important;">D</th>
                            <th style="background: #337ab7; color: white !important;">E</th>
                            <th style="background: #337ab7; color: white !important;">F</th>
                          </tr>
                        </thead>
                        <tbody>
                         
                        </tbody>
                      </table>   
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
</div><br><br>


  <script type="text/javascript">

  $(function () {
    $('.dataTable').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : false,
      'info'        : false,
      'autoWidth'   : true
    })
  });

     //validation
$(document).ready(function () {

    $('#createForm').validate({ // initialize the plugin
        rules: {
            room_no: {
                remote: {
                url: '<?php echo base_url('timetable/floorclassdistribution/checkRoomNo'); ?>',
                type: "post",
                data: {
                  floor_name: function() {
                    return $( "#floor_name" ).val();
                  },
                  wing_name: function() {
                    return $( "#wing_name" ).val();
                  },
                  room_no: function() {
                    return $( "#room_no" ).val();
                  }
                }
              },
            },
        },
        submitHandler: function (form) { // for demo 
             if ($(form).valid()) 
                 form.submit(); 
             return false; // prevent normal form posting
        }
    });
});


$('.select2').select2();


function getTeacherList()
{
  var subject_id = $('#subject_id').val();
  var teacher_list_load = $('input[name="teacher_list_load"]:checked').val();
  var div_data = '<option value="">Select</option>';
  if(subject_id != '')
  {
    $.ajax({
      url:'<?php echo base_url('timetable/subjectallocation/getTeacherList'); ?>',
      method:"post",
      data:{subject_id:subject_id,teacher_list_load:teacher_list_load},
      dataType:"json",
      success:function(response)
      {
        $.each(response,function(key,val){
          div_data += '<option value="'+val.EMPID+'">'+val.EMPID+' - '+val.EMP_FNAME+' '+val.EMP_MNAME+' '+val.EMP_LNAME+'</option>';
        });
        $('#teacher_id').html(div_data);
      }
    });
  }
  else
  {
    $('#teacher_id').html(div_data);
  }
  getClassListBySubject();
}

function getSubjectListinTable()
{
  var teacher_id = $('#teacher_id').val();
  getClassTeacherClassDetails(teacher_id);
  $.ajax({
    url:'<?php echo base_url('timetable/subjectallocation/getSubjectListByTeacherinTable'); ?>',
    method:"POST",
    data:{teacher_id:teacher_id},
    success:function(response)
    {
      $('#teacher_subject_bundle').html(response);
    }
  });
}

function getClassTeacherClassDetails(teacher_id)
{
  $.ajax({
    url:'<?php echo base_url('timetable/subjectallocation/getClassTeacherClassDetails'); ?>',
    method:"POST",
    data:{teacher_id:teacher_id},
    success:function(response)
    {
      $('#class_teacher_of_class').html(response);
    }
  });
}

function getClassListBySubject()
{
  var subject_id = $('#subject_id').val();
  var div_data = '<option value="">Select</option>';
  if(subject_id != '')
  {
    $.ajax({
      url:'<?php echo base_url('timetable/subjectallocation/getClassListBySubject'); ?>',
      method:"POST",
      data:{subject_id:subject_id},
      dataType:"json",
      success:function(response)
      {
          $.each(response,function(key,val){
              div_data += '<option value="'+val.Class_Sec_SubCode+'">'+val.Class_name_Roman+'</option>';
            });
            $('#class_name_Roman').html(div_data);
      }
    });
  }
  else
  {
    $('#class_name_Roman').html(div_data);
  }
}

function classWiseSubjectDetails()
{
  var class_sec_subcode = $('#class_name_Roman').val();
  var subject_id = $('#subject_id').val();

  $.ajax({
    url: '<?= base_url('timetable/subjectallocation/getSubjectDataByClassSecSubcode'); ?>',
    data:{class_sec_subcode:class_sec_subcode,subject_id:subject_id},
    method:"POST",
    success:function(response)
    {
      $('#class_wise_subject_details').html(response);
    }
  });
}

function getClassWithTeacherDetails()
{
  var subject_id = $('#subject_id').val();

  // $.ajax({
  //   url: '<?= base_url('timetable/subjectallocation/getClassWithTeacherDetails'); ?>',
  //   data:{subject_id:subject_id},
  //   method:"POST",
  //   success:function(response)
  //   {
  //     $('#class_wise_subject_details').html(response);
  //   }
  // });
}

   setInterval(function(){
        $("#divtoBlink").toggleClass("backgroundRed");
     },500)

  </script>