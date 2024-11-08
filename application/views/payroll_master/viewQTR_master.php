<style>
    th {
        background-color: lightblue !important;
    }
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Square Feet Master</a> <i class="fa fa-angle-right"></i></li>
</ol>
<!--four-grids here-->
<div style="padding: 10px; background-color: white; border-top:3px solid #5785c3;">

   

    <div class='col-sm-3'>
        <!-- <a href="<?php //echo base_url('payroll/master/Sqtmaster/add'); 
                        ?>" class='btn btn-warning'>Add New</a><br /><br /><br /> -->
        <button type="button" class="btn btn-warning btn" data-toggle="modal" data-target="#myModal">Add New</button> <br> <br>
    </div>

    <table class="table table-bordered" id="example">
        <thead>
            <tr>
                <th>Sl. No.</th>
                <th>SQ. FT.</th>
                <th>RENT</th>
                <th>SECURITY</th>
                <th>GARAGE</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($sqt_details) {
                $i = 1;
                foreach ($sqt_details as $data) {
            ?>
                    <tr>
                        <td class="contenteditable" contenteditable="true" onblur="updateSqrt('ID',<?php echo $data['ID'] ?>)" id="ID_<?php echo $data['ID']; ?>"><?php echo $i; ?></td>

                        <td class="contenteditable" contenteditable="true" onblur="updateSqrt('SQFT',<?php echo $data['ID'] ?>)" id="SQFT_<?php echo $data['ID']; ?>"><?php echo $data['SQFT']; ?></td>

                        <td class="contenteditable" contenteditable="true" onblur="updateSqrt('RENT',<?php echo $data['ID'] ?>)" id="RENT_<?php echo $data['ID']; ?>"><?php echo $data['RENT']; ?></td>

                        <td class="contenteditable" contenteditable="true" onblur="updateSqrt('SECURITY',<?php echo $data['ID'] ?>)" id="SECURITY_<?php echo $data['ID']; ?>"><?php echo $data['SECURITY']; ?></td>

                        <td class="contenteditable" contenteditable="true" onblur="updateSqrt('GARAGE',<?php echo $data['ID'] ?>)" id="GARAGE_<?php echo $data['ID']; ?>"><?php echo $data['GARAGE']; ?></td>



                    </tr>
            <?php
                    $i++;
                }
            }
            ?>
        </tbody>
    </table>
</div><br /><br />
<div class="clearfix"></div>

<!--inner block start here-->
<div class="inner-block">

</div>

<form action="<?php echo base_url('payroll/master/Sqtmaster/add'); ?>" method="POST">
    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="color: green;">ADD NEW RECORD</h4>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="sqtft">SQ. FT.</label>
                            <input type="text" autocomplete="off" name="sqtft" id="sqtft" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="sqtft">RENT</label>
                            <input type="text" autocomplete="off" name="rent" id="rent" class="form-control">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="sqtft">SECURITY</label>
                            <input type="text" autocomplete="off" name="sec" id="sec" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="sqtft">GARAGE</label>
                            <input type="text" autocomplete="off" name="garage" id="garage" class="form-control">
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <button type="submit" type="submit" class="btn btn-success">ADD</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
</form>


<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
    $(".contenteditable").keypress(function(e) {
        if ((e.which < 48 || e.which > 57) && (e.which != 46)) e.preventDefault();
    });

    function updateSqrt(column_name, emp_id) {

        var cell_value = $('#' + column_name + '_' + emp_id).text();


        $.ajax({
            url: '<?php echo base_url('payroll/master/Sqtmaster/updateSQT'); ?>',
            data: {
                column_name: column_name,
                emp_id: emp_id,
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
</script>