    <div class="row ">
  <button type="button" class="btn btn-success float-right" onclick="window.location='<?php echo site_url("studentcertificate/Issuetc/show_all_list/".$syear.'/'.$classes);?>'">Back</button>
    </div>

<div class="row">
    <div class="col-md-12">


        <?php echo form_open('studentcertificate/issuetc/save_individual_student'); ?>

        <div class="box box-solid box-primary">
            <?php echo form_close(); ?>
            <div class="box-header">
                <h3 class="box-title"></h3>
            </div>
            <div class="box-body">
                <div class="row col-md-offset-2">
                    <div class="col-md-4 form-group ">
                        <label>Registration Number</label>

                    </div>
                    <div class="col-md-4 form-group">

                        <input type="text" name="admn_no" id="admn_no" class="form-control" value="<?php echo $stu_list->reg_no;?> " readonly >
                    </div>
                </div>
                 <div class="row col-md-offset-2">
                    <div class="col-md-4 form-group ">
                        <label>Student's Name</label>

                    </div>
                    <div class="col-md-4 form-group">

                        <input type="text" name="stu_name" id="stu_name" class="form-control" value="<?php echo $stu_list->stu_name;?> " >
                    </div>
                </div>

                 <div class="row col-md-offset-2">
                    <div class="col-md-4 form-group ">
                        <label>Mother's Name</label>

                    </div>
                    <div class="col-md-4 form-group">

                        <input type="text" name="mname" id="mname" class="form-control" value="<?php echo $stu_list->mname;?> " >
                    </div>
                </div>

                 <div class="row col-md-offset-2">
                    <div class="col-md-4 form-group ">
                        <label>Father's Name</label>

                    </div>
                    <div class="col-md-4 form-group">

                        <input type="text" name="fname" id="fname" class="form-control" value="<?php echo $stu_list->fname;?> " >
                    </div>
                </div>

                 <div class="row col-md-offset-2">
                    <div class="col-md-4 form-group ">
                        <label>Date of Admission</label>

                    </div>
                    <div class="col-md-4 form-group">

                        <input type="text" name="admn_dt" id="admn_dt" class="form-control" value="<?php echo date("d-m-Y", strtotime($stu_list->ADM_DATE));;?> " >
                    </div>
                </div>

                <div class="row col-md-offset-2">
                    <div class="col-md-4 form-group ">
                        <label>Class in which admitted</label>

                    </div>

                    <div class="col-md-4 form-group">

                        <!-- <input type="text" name="admit_class" id="admit_class" class="form-control" value="<?php echo $stu_list->admit_class;?> " > -->

                        <select name='admit_class' id='admit_class' class='form-control' >
                  <option value=''>Select</option>
                  <?php
                  foreach($class_list as $data){
                              ?>
                              <option value='<?php echo $data->Class_No; ?>'><?php echo $data->CLASS_NM; ?></option>
                              <?php 
                        }
                  ?>
                </select>
                    </div>
                </div>

                <div class="row col-md-offset-2">
                    <div class="col-md-4 form-group ">
                        <label>Date of Birth</label>

                    </div>
                    <div class="col-md-4 form-group">

                        <input type="text" name="stu_dob" id="stu_dob" class="form-control" value="<?php echo date("d-m-Y", strtotime($stu_list->BIRTH_DT));?> " >
                    </div>
                </div>

                <div class="row col-md-offset-2">
                    <div class="col-md-4 form-group ">
                        <label>Date on which student left the school</label>

                    </div>
                    <div class="col-md-4 form-group">

                        <input type="text" name="left_school" id="left_school" class="form-control" value="<?php echo $stu_list->left_school;?> " >
                    </div>
                </div>

                 <div class="row col-md-offset-2">
                    <div class="col-md-4 form-group ">
                        <label>Class in which student studied</label>

                    </div>
                    <div class="col-md-4 form-group">

                        <!-- <input type="text" name="studying_class" id="studying_class" class="form-control" value="<?php echo $stu_list->studying_class;?> " > -->
                        <select name='studying_class' id='studying_class' class='form-control' >
                  
                  <?php
                  foreach($class_list as $data){
                    //echo $data->Class_No;echo '<br>';
                    
                              ?>
                              <option value="<?php echo $data->Class_No; ?>" <?php if ($data->CLASS_NM == $stu_list->studying_class) { echo ' selected="selected"'; } ?>> <?php echo $data->CLASS_NM; ?> </option>
                              <?php 
                        }
                  ?>
                  
                </select>

                    </div>
                </div>

                 <div class="row col-md-offset-2">
                    <div class="col-md-4 form-group ">
                        <label>Academic Year</label>

                    </div>
                    <div class="col-md-4 form-group">
                        <select name='acad_year' id='acad_year' class='form-control' >
                  <option value=''>Select</option>
                  <?php
                  foreach($sess_list as $data){
                              ?>
                              <option value='<?php echo $data->Session_Nm; ?>'><?php echo $data->Session_Nm; ?></option>
                              <?php 
                        }
                  ?>
                </select>

                        <!-- <input type="text" name="acad_year" id="acad_year" class="form-control" value="<?php echo $stu_list->acad_year;?> " >-->
                    </div> 
                </div>

                  <div class="row col-md-offset-2">
                    <div class="col-md-4 form-group ">
                        <label>Passing Year</label>

                    </div>
                    <div class="col-md-4 form-group">

                        <input type="text" name="pass_year" id="pass_year" class="form-control" value="<?php echo $stu_list->pass_year;?> " >
                    </div>
                </div>
                <div class="row col-md-offset-2">
                    <div class="col-md-4 form-group ">
                        <label>Status</label>

                    </div>
                    <div class="col-md-4 form-group">
                        <select name='syear' id='syear' class='form-control' >
                        <option value='none'>Select</option>
                        <option value='passed_aisse_cbse'>PASSED AISSE  CBSE</option>
                        <option value='passed_aissc_cbse'>PASSED AISSC  CBSE</option>
                  
                                </select>

                        <!-- <input type="text" name="status" id="status" class="form-control" value="<?php echo $stu_list->STATUS;?> " > -->
                    </div>
                </div>
                 <div class="row col-md-offset-2">
                    <div class="col-md-4 form-group ">
                        <label>Certificate Issue Date</label>

                    </div>
                    <div class="col-md-4 form-group">

                        <input type="text" name="certificate_date" id="certificate_date" class="form-control" value="<?php echo $stu_list->certificate_date;?> " >
                    </div>
                </div>

                <div class="row col-md-offset-2">
                    <div class="col-md-4 form-group ">
                        <label>Nationalify</label>

                    </div>
                    <div class="col-md-4 form-group">

                        <input type="text" name="nationality" id="nationality" class="form-control" value="<?php echo $stu_list->nationality;?> " >
                    </div>
                </div>





            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>

<script>
  $( function() {
    

     $('#certificate_date').datepicker({
        format: "dd-mm-yyyy",
        autoclose: true
     });

     $('#stu_dob').datepicker({
        format: "dd-mm-yyyy",
        autoclose: true
     });


     $('#admn_dt').datepicker({
        format: "dd-mm-yyyy",
        autoclose: true
     });

     $('#pass_year').datepicker({
        format: "mm-yyyy",
        autoclose: true
     });

      $('#left_school').datepicker({
        format: "dd-mm-yyyy",
        autoclose: true
     });

     

  } );
  </script>