<?php if ($this->session->flashdata('error')) { ?>

        <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <strong><?php echo $this->session->flashdata('error'); ?></strong>
        </div>

<?php } ?>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Character Certificate</a> <i class="fa fa-angle-right"></i></li>
</ol>
<div class="row">
    <div class="col-md-12">  

        <?php echo form_open('studentcertificate/Issuecharacter/show_all_list'); ?>

        <div class="box box-solid box-primary">
            <?php echo form_close(); ?>
            <div class="box-header">
                <h3 class="box-title"></h3>
            </div>
<input type="hidden" name="tbl_nm" id="tbl_nm" value="<?php echo $table_name;?>">
<input type="hidden" name="hclass" id="hclass" value="<?php echo $hclasses;?>">
			<input type="hidden" name="syear" id="syear" value="<?php echo $syear; ?>">
            <div class="box-body">

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="syear">Session Year</label>
                            <select name='syear' id='syear' class='form-control' >
                  <option value=''>Select</option>
                  <?php
                  foreach($sess_list as $data){
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
                    <br>
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
    <div id="allatonce">
         <center>
    <button type="button" class="btn btn-success" onclick="window.location='<?php echo site_url("studentcertificate/Issuecharacter/generatepdf/".$table_name.'/'.$hclasses.'/'.$syear);?>'" target="_blank" >Generate PDF</button>
    </center>
    </div>
    <?php echo form_open('studentcertificate/Issuecharacter/download_range');?>
    <input type="hidden" name="tbl_nmr" id="tbl_nmr" value="<?php echo $table_name;?>">
<input type="hidden" name="hclassr" id="hclassr" value="<?php echo $hclasses;?>">
<input type="hidden" name="syear" id="syear" value="<?php echo $syear; ?>">
    <div id="inrange">
        <div class="row col-md-offset-2">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="admno">From Adm. No.</label>
                   <input type="text" name="adm_no_one" id="adm_no_one" value="" class="form-control"> 
                </div>
            </div>
             <div class="col-md-3">
                <div class="form-group">
                    <label for="admno">To Adm. No.</label>
                    <input type="text" name="adm_no_two" id="adm_no_two" value="" class="form-control"> 
                </div>
            </div>
              <div class="col-md-3">
                <div class="form-group">
                     <br>
            <input type="submit" class="btn btn-success" value="Generate PDF">
                </div>
            </div>
        </div>
          <?php echo form_close(); ?>
        
    </div>

    <div class="row">
        <div class="col-md-12 ">
            <div class="box box-solid box-primary">
                <div class="table-responsive">                  
                    <h2 class="page-header"><span style="color:red">Character Certificate Data are on TC based, if found any discrepancy, check TC</span></h2>
                    <table class="table table-bordered" id="ex_mod">
                        <thead>
							<tr>
                                <td align="center" style="width:50%" ></td>
                                <td align="center"></td>
                                <td align="center"></td>
                                <td align="center"></td>
                                <td align="center" ></td>
                                <td align="center"></td>
                                <td align="center"></td>
                                <td align="center"></td>
                            <td align="center"></td>
                                <td align="center"> </td>
                                <td align="center">
								<input type="text" name="issuedate" id="issuedate" class="datePickercid" placeholder="set date" Size="7">
                                 <button onclick="SaveIssueDate()" name="submit" id="submit" class="btn-success btn-sm">SET DATE</button>
								</td>
                                <td align="center"></td>
                                
                            </tr>
                            <tr>
                                <td align="center" style="width:50%" >Sl No.</td>
                                <td align="center">Character Cert. No.</td>
                                <td align="center">Sl. No.</td>
                                <td align="center">Admission No.</td>
                                <td align="center" >Student's Name</td>
                                <td align="center">Father's Name</td>
                                <td align="center">Mother's Name</td>
                                <td align="center">Date of Admission</td>
                            <td align="center">Date on which Student left the school</td>
                                <td align="center">Class </td>
                                <td align="center">Certificate Issue Date</td>
                                <td align="center">Action</td>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1;foreach ($stu_list as $b) { ?>
                                <tr >
                                     <td align="center"><?php echo ($i); ?></td>
                                     <td><?php echo ($b->CERT_NO); ?></td>
                                     <td><?php echo ($b->slno); ?></td>
                                    <td><?php echo ($b->ADM_NO); ?></td>
                                    <td><?php echo ($b->S_NAME); ?></td>
                                     <td><?php echo ($b->F_NAME); ?></td>
                                     <td><?php echo ($b->M_Name); ?></td>
             <td><?php echo date("d-m-Y", strtotime($b->Adm_Date));?></td>

<?php 
if ($b->End_DATE!='1970-01-01') 
{
        $end_date = date("d-m-Y", strtotime($b->End_DATE));
} else {
        $end_date = '';
}
?>


             <td><?php echo $end_date; ?></td>
<?php 
if (!empty($b->Issued_Date && $b->Issued_Date != '0000-00-00' && $b->Issued_Date != '30-11--0001' && $b->Issued_Date!='0001--00-30')) 
{
        $dob = date("d-m-Y", strtotime($b->Issued_Date));
} else {
        $dob = '';
}
?>


            <td><?php echo $b->class_name; ?></td>
            <td><input type="text" name="certi_date" id="certi_date-<?php echo $i;?>" class="datePickercd" value="<?php echo $dob;?> " Size="20px" style="height:50px;"></td>
            <td><button type="button" class="btn btn-success " onclick="save('<?php echo $b->id;?>','<?php echo $b->ADM_NO;?>','<?php echo $i;?>')">SAVE</button></td> 
                                     
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
    $(document).ready(function () {

        $('#ex_mod').dataTable();

        $('#inrange').hide();
        $('#allatonce').hide();

        });
</script>


<script>
  $( function() {
    

   

     $('.datePickercd').datepicker({
        format: "dd-mm-yyyy",
        autoclose: true
     });
	  
	  $('.datePickercid').datepicker({
        format: "dd-mm-yyyy",
        autoclose: true
     });

  } );
  </script>

  <script type="text/javascript">
      
      function save(id,regno,row)
      {
         id=id;
         adm_no=regno;        
         certi_date=$('#certi_date-'+row).val();
         tbl_nm=$('#tbl_nm').val();

         $.ajax({
                    url: '<?php echo site_url('studentcertificate/Issuecharacter/save_individual_student') ?>',
                    type: "POST",
data: {"id": id, "adm_no": adm_no, "certi_date": certi_date, "tbl_nm":tbl_nm},
                    success: function (data)
                    {
                         //alert(data);
                        if (data) {
                            alert("Record Saved Successfully.");
                        }
                        else
                        {
                            alert("Error");
                        }

                    }



                });
         

      }
	  function SaveIssueDate() {
        var issuedate = $('.datePickercid').val();
        var cls = $('#hclassr').val();
        var year = $('#syear').val();
        $.ajax({
            url: '<?php echo site_url('studentcertificate/Issuecharacter/update_issuedate') ?>',
            method: "POST",
            data: {
                "issuedate": issuedate,
                "cls": cls,
                "year": year,
            },
            success: function(response) {
                alert("Record Saved Successfully!");
                window.location.reload();
                }
        });
    }
      
    
  </script>

  <script type="text/javascript">
   
    $(".astro").change(function(){
        var val = $(".astro:checked").val();
        if(val=="range"){
            $('#inrange').show();
            $('#allatonce').hide();
        }
        if(val=="all"){
            $('#inrange').hide();
            $('#allatonce').show();
        }
    });
   
</script>
