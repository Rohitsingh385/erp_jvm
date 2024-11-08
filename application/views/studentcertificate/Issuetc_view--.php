<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">School Leaving Certificate</a> <i class="fa fa-angle-right"></i></li>
</ol>
<div class="row">
    <div class="col-md-12">

        <?php echo form_open('studentcertificate/issuetc/show_all_list'); ?>

        <div class="box box-solid box-primary">
            <?php echo form_close(); ?>
            <div class="box-header">
                <h3 class="box-title"></h3>
            </div>
            <input type="hidden" name="tbl_nm" id="tbl_nm" value="<?php echo $table_name; ?>">
            <input type="hidden" name="hclass" id="hclass" value="<?php echo $hclasses; ?>">
            <input type="hidden" name="syear" id="syear" value="<?php echo $syear; ?>">
			
            <div class="box-body">

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="syear">Session Year</label>
                            <select name='syear' id='syear' class='form-control'>
                                <option value=''>Select</option>
                                <?php
                                foreach ($sess_list as $data) {
                                ?>
                                    <option value='<?php echo $data->Session_Nm; ?>'><?php echo $data->Session_Nm; ?></option>
                                <?php
                                }
                                ?>
                            </select>

                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="classes">Class</label>
                            <select name='selclass' id='selclass' class='form-control'>
                                <option value=''>Select</option>

                                <option value='12'>X</option>
                                <option value='14'>XII</option>


                            </select>

                        </div>
                    </div>

                    <div class="col-md-4">
                        <?php echo form_submit('display', 'Display', 'class="btn btn-success"'); ?>
                    </div>




                </div>


            </div>


        </div>






    </div>
    <?php echo form_close(); ?>
</div>


<?php if (!empty($stu_list)) { ?>
    <br>
    <div class="row">
        <div class="col-md-12 ">
            <div class="row col-md-offset-2">

                <div class="col-md-3">
                    <div class="form-group">
                        <input type="radio" name="astro" class="astro" value="all"> Download All at once<br><br>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <input type="radio" name="astro" class="astro" value="range"> Download In Range
                    </div>
                </div>
            </div>



        </div>
    </div>
    <!-- <a href="<?php base_url('Issuetc/view') ?>">
        view</a> -->

    <div id="allatonce">
        <center>
            <button formtarget="_blank" type="button" class="btn btn-success" onclick="window.location='<?php echo site_url("studentcertificate/issuetc/generatepdf/" . $table_name . '/' . $hclasses); ?>'" >Generate PDF</button>
        </center>
    </div>
    <?php echo form_open('studentcertificate/issuetc/download_range'); ?>
    <input type="hidden" name="tbl_nmr" id="tbl_nmr" value="<?php echo $table_name; ?>">
    <input type="hidden" name="hclassr" id="hclassr" value="<?php echo $hclasses; ?>">
    <input type="hidden" name="syear" id="syear" value="<?php echo $syear; ?>">

    <div id="inrange">
        <div class="row col-md-offset-2">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="admno">From Admission Number</label>
                    <input type="text" name="adm_no_one" id="adm_no_one" value="" class="form-control">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="admno">To Admission Number</label>
                    <input type="text" name="adm_no_two" id="adm_no_two" value="" class="form-control">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <br>
                    <input type="submit" class="btn btn-success" formtarget="_blank" value="Generate PDF">
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>

    </div>

    <div class="row">
        <div class="col-md-12 ">
            <div class="box box-solid box-primary">
                <div class="table-responsive">
                    <h2 class="page-header"></h2>
                    <table class="table table-bordered" id="ex_mod">
                        <thead>
                            <tr>
                                <td align="center" style="width:50%">Sl No.</td>
                                <td align="center">TC No.</td>
                                <td align="center">Registration No.</td>
                                <td align="center">Student's Name</td>
                                <td align="center">Mother's Name</td>
                                <td align="center">Father's Name</td>
                                <td align="center">Date of Admission</td>
                                <td align="center">Class in which admitted</td>
                                <td align="center">Date of Birth</td>
                                <td align="center">Date on which Student left the school</td>
                                <td align="center">Class in which student studied</td>
                                <td align="center">Academic Year</td>
                                <td align="center">Passing Year</td>
                                <td align="center">Status</td>
                                <td align="center">Certificate Issue Date</td>
                                <td align="center">Nationality</td>
                                <td align="center">Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($stu_list as $b) { ?>
                                <tr>
                                    <td><?php echo ($i); ?></td>
                                    <td><?php echo ($b->tcno); ?></td>
                                    <td><?php echo ($b->adm_no); ?></td>
                                    <td><input type="text" name="sname" id="sname-<?php echo $i; ?>" value="<?php echo ($b->stu_nm); ?>" Size="20px" style="height:50px;"></td>

                                    <td><input type="text" name="mname" id="mname-<?php echo $i; ?>" value="<?php echo ($b->mother_nm); ?>" Size="20px" style="height:50px;"> </td>

                                    <td><input type="text" name="fname" id="fname-<?php echo $i; ?>" value="<?php echo ($b->father_nm); ?>" Size="20px" style="height:50px;"></td>

                                    <td><input type="text" name="doa" id="doa-<?php echo $i; ?>" class="datePickerdoa" value="<?php echo date("d-m-Y", strtotime($b->adm_date)); ?>" Size="20px" style="height:50px;"></td>

                                    <td>
                                        <select name='admit_class' id='admit_class-<?php echo $i; ?>'>
                                            <option value=''>Select</option>
                                            <?php
                                            foreach ($class_list as $data) {
                                            ?>
                                                <option value="<?php echo $data->CLASS_NM; ?>" <?php if ($data->CLASS_NM == $b->class_admitted) {
                                                                                                    echo ' selected="selected"';
                                                                                                } ?>> <?php echo $data->CLASS_NM; ?> </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <!-- <input type="text" name="cadmitted" id="cadmitted" value="<?php echo ($b->admit_class); ?>" Size="20px"> -->
                                    </td>

                                    <td><input type="text" name="dob-<?php echo $i; ?>" class="datePickerdob" id="dob-<?php echo $i; ?>" value="<?php echo date("d-m-Y", strtotime($b->BIRTH_DT)); ?>" Size="20px" style="height:50px;"></td>

                                    <td><input type="text" name="lschool" id="lschool-<?php echo $i; ?>" class="datePickerls" value="<?php echo date("d-m-Y", strtotime($b->left_school)); ?>" Size="20px" style="height:50px;"></td>

                                    <td><input type="text" name="sclass" id="sclass-<?php echo $i; ?>" value="<?php echo $b->studied_class; ?>" Size="20px" style="height:50px;"></td>

                                    <td><!-- <input type="text" name="acad_year" id="acad_year" value="<?php echo $b->acad_year; ?>" Size="20px"> -->
                                        <select name='acad_year' id='acad_year-<?php echo $i; ?>'>
                                            <option value=''>Select</option>
                                            <?php
                                            foreach ($sess_list as $data) {
                                            ?>
                                                <option value="<?php echo $data->Session_Nm; ?>" <?php if ($data->Session_Nm == $b->acad_year) {
                                                                                                        echo ' selected="selected"';
                                                                                                    } ?>> <?php echo $data->Session_Nm; ?> </option>

                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </td>

                                    <td><input type="text" name="pass_year" id="pass_year-<?php echo $i; ?>" class="datePickerpy" value="<?php echo $b->pass_year; ?>" Size="20px" style="height:50px;"></td>

                                    <td><!-- <input type="text" name="status" id="status" value="<?php echo $b->STATUS; ?>" Size="20px"> -->

                                        <select name='syear' id='syear-<?php echo $i; ?>'>
                                            <option value='none'>Select</option>
                                            <!--  <option value='passed_aisse_cbse'>PASSED AISSE  CBSE</option>
                <option value='passed_aissce_cbse'>PASSED AISSCE  CBSE</option>
                    -->
                                            <option value="passed_aisse_cbse" <?php if ("passed_aisse_cbse" == $b->status) {
                                                                                    echo ' selected="selected"';
                                                                                } ?>> PASSED AISSE CBSE </option>
                                            <option value="passed_aissce_cbse" <?php if ("passed_aissce_cbse" == $b->status) {
                                                                                    echo ' selected="selected"';
                                                                                } ?>> PASSED AISSCE CBSE </option>

                                        </select>


                                        <!-- <input type="text" name="status" id="status" class="form-control" value="<?php echo $stu_list->STATUS; ?> " > -->


                                    </td>

                                    <td><input type="text" name="certi_date" id="certi_date-<?php echo $i; ?>" class="datePickercd" value="<?php echo empty($b->cer_issue_date) ? "" :  date("d-m-Y", strtotime($b->cer_issue_date)); ?> " Size="20px" style="height:50px;"></td>


                                    <td><input type="text" name="nationality" id="nationality-<?php echo $i; ?>" value="<?php echo $b->nationality; ?>" Size="20px" style="height:50px;"></td>
                                    <td><button type="button" class="btn btn-success " onclick="save('<?php echo $b->id; ?>','<?php echo $b->adm_no; ?>','<?php echo $i; ?>')">SAVE</button></td>

                                </tr>
                            <?php $i++;
                            }
                            ?>
                        </tbody>

                    </table>

                </div>
            </div>

        </div>
    </div>
<?php } ?>

<script>
    $(document).ready(function() {

        $('#ex_mod').dataTable();

        $('#inrange').hide();
        $('#allatonce').hide();

    });
</script>


<script>
    $(function() {


        // $('#certi_date').datepicker({
        //    format: "dd-mm-yyyy",
        //    autoclose: true
        // });

        $('.datePickercd').datepicker({
            format: "dd-mm-yyyy",
            autoclose: true
        });

        // $('#dob').datepicker({
        //    format: "dd-mm-yyyy",
        //    autoclose: true
        // });

        $('.datePickerdob').datepicker({
            format: "dd-mm-yyyy",
            autoclose: true
        });


        // $('#doa').datepicker({
        //    format: "dd-mm-yyyy",
        //    autoclose: true
        // });

        $('.datePickerdoa').datepicker({
            format: "dd-mm-yyyy",
            autoclose: true
        });



        // $('#pass_year').datepicker({
        //    format: "mm-yyyy",
        //    autoclose: true
        // });

        $('.datePickerpy').datepicker({
            format: "mm-yyyy",
            autoclose: true
        });

        //  $('#lschool').datepicker({
        //    format: "dd-mm-yyyy",
        //    autoclose: true
        // });

        $('.datePickerls').datepicker({
            format: "dd-mm-yyyy",
            autoclose: true
        });



    });
</script>

<script type="text/javascript">
    function save(id, regno, row) {
        id = id;
        adm_no = regno;
        sname = $('#sname-' + row).val();
        mname = $('#mname-' + row).val();
        fname = $('#fname-' + row).val();
        doa = $('#doa-' + row).val();
        admit_class = $('#admit_class-' + row).val();
        dob = $('#dob-' + row).val();
        lschool = $('#lschool-' + row).val();
        sclass = $('#sclass-' + row).val();
        acad_year = $('#acad_year-' + row).val();
        pass_year = $('#pass_year-' + row).val();
        syear = $('#syear-' + row).val();
        certi_date = $('#certi_date-' + row).val();
        nationality = $('#nationality-' + row).val();

        tbl_nm = $('#tbl_nm').val();

        $.ajax({
            url: '<?php echo site_url('studentcertificate/issuetc/save_individual_student') ?>',
            type: "POST",
            data: {
                "id": id,
                "adm_no": adm_no,
                "sname": sname,
                "mname": mname,
                "fname": fname,
                "doa": doa,
                "admit_class": admit_class,
                "dob": dob,
                "lschool": lschool,
                "sclass": sclass,
                "acad_year": acad_year,
                "pass_year": pass_year,
                "syear": syear,
                "certi_date": certi_date,
                "nationality": nationality,
                "tbl_nm": tbl_nm
            },
            success: function(data) {
                //alert(data);
                if (data) {
                    alert("Record Saved Successfully.");
                } else {
                    alert("Error");
                }

            }



        });


    }
</script>

<script type="text/javascript">
    $(".astro").change(function() {
        var val = $(".astro:checked").val();
        if (val == "range") {
            $('#inrange').show();
            $('#allatonce').hide();
        }
        if (val == "all") {
            $('#inrange').hide();
            $('#allatonce').show();
        }
    });
</script>