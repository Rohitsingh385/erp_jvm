<?php
error_reporting(0);
?>
<style type="text/css">
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

    #edit_div-transition {
        transition: all 0.3s ease-in-out;
        transform: translateX(100%);
    }

    #edit_div-transition.show {
        transform: translateX(0);
    }
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Stoppage Category Master</a> <i class="fa fa-angle-right"></i></li>
</ol>
<!--four-grids here-->
<div style="padding: 25px; background-color: white; border-top:3px solid #5785c3;">

    <div class="row">
        <div class="col-md-3">
            <?php
            if ($this->session->flashdata('msg')) :
            ?>
                <div class="alert alert-success" role="alert" id="msg">
                    <strong><?php echo $this->session->flashdata('msg'); ?></strong>
                </div>
            <?php endif; ?>
            <?php
            if ($this->session->flashdata('edit')) :
            ?>
                <div class="alert alert-success" role="alert" id="edit">
                    <strong><?php echo $this->session->flashdata('edit'); ?></strong>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4" style="border-right: 1px solid #5785C3;" id="add_div">
                    <h3>Add Stoppage Category</h3>
                    <hr>
                    <form method="post" action="<?php echo base_url('Bus_incharge_entry/save_stoppage'); ?>">
                        <div class="mb-3">
                            <label for="">Group</label>
                            <input type="text" name="group" id="group" class="form-control" oninput="this.value = this.value.toUpperCase()" maxlength="1" onchange="CheckGroup(this.value)">
                        </div>
                        <div class="mb-3">
                            <label for="">Descriptionn</label>
                            <input type="text" class="form-control" name="desc" id="desc">
                        </div>
                        <div class="mb-3">
                            <label for="">Amount</label>
                            <input type="text" class="form-control" name="amt" id="amt">
                        </div>
                        <div class="mb-3">
                            <br>
                            <input type="submit" name="submit" id="submit" value="Add" class="btn btn-success">
                        </div>
                    </form>
                </div>

                <div class="col-md-4" style="border-right: 1px solid #5785C3;" id="edit_div" hidden>
                    <h3>Edit Stoppage Category</h3>
                    <hr>
                    <form method="post" action="<?php echo base_url('Bus_incharge_entry/edit_stoppage'); ?>">
                        <div class="mb-3">
                            <label for="">Group</label>
                            <input type="text" name="group1" id="group1" class="form-control" oninput="this.value = this.value.toUpperCase()" maxlength="1" onchange="CheckGroup(this.value)" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="">Description</label>
                            <input type="text" class="form-control" name="desc1" id="desc1">
                        </div>
                        <div class="mb-3">
                            <label for="">Amount</label>
                            <input type="text" class="form-control" name="amt1" id="amt1">
                        </div>
                        <div class="mb-3">
                            <br>
                            <input type="submit" name="submit1" id="submit1" value="SAVE" class="btn btn-success">
                            <button name="Cancel" id="Cancel" value="Cancel" class="btn btn-danger" onclick="cancelEditStoppageCategory()">CANCEL EDIT</button>
                        </div>
                    </form>
                </div>

                <div class="col-sm-8">
                    <h3>Stoppage Category Details</h3>
                    <hr>
                    <table class="table table-bordered dataTable table-striped">
                        <thead style="background: #d2d6de;">
                            <tr>
                                <th style="background: #337ab7; color: white !important;" class="text-center">S. No</th>
                                <th style="background: #337ab7; color: white !important;">Stoppage Group</th>
                                <th style="background: #337ab7; color: white !important;">Description</th>
                                <th style="background: #337ab7; color: white !important;">Amount</th>
                                <th style="background: #337ab7; color: white !important;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($StoppageGroup as $key => $value) {
                            ?>
                                <tr>
                                    <td>
                                        <center><?php echo $i; ?></center>
                                    </td>
                                    <td>
                                        <center><?php echo $value->Stoppage_Group; ?>
                                    </td>
                                    <td>
                                        <center><?php echo $value->Descriptionn; ?>
                                    </td>
                                    <td>
                                        <center><?php echo $value->Amt; ?>
                                    </td>
                                    <td>
                                        <a title='EDIT' href='javascript:void(0);' onclick="editdata('<?php echo $value->Stoppage_Group; ?>', '<?php echo $value->Descriptionn; ?>', '<?php echo $value->Amt; ?>')"><i class="fa fa-pencil-square-o" aria-hidden="true" style='color:black;font-size:16px;'></i></a>&emsp;&emsp;&emsp;
                                        <a title='DELETE' href='javascript:void(0);' onclick="deletedata('<?php echo $value->Stoppage_Group; ?>', '<?php echo $value->Descriptionn; ?>', '<?php echo $value->Amt; ?>')"><i class="fa fa-trash" aria-hidden="true" style='color:red;font-size:16px;'></i></a>
                                    </td>
                                </tr>
                            <?php
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="inner-block">

</div>

<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

<script>
    function CheckGroup(val) {

        $.ajax({
            url: "<?php echo base_url('Bus_incharge_entry/CheckGroup'); ?>",
            method: "POST",
            data: {
                val: val
            },
            success: function(data) {
                if (data == 1) {
                    Command: toastr["error"]("Group Name Already Exist", "Warning")
                    toastr.options = {
                        "closeButton": true,
                        "debug": true,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": true,
                        "onclick": null,
                        "showDuration": "100",
                        "closeDuration": "1000",
                        "timeOut": "3000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    $('#group').val("");
                }
            },
        });
    }

    function checkdata(stoppagegroup) {
        $.ajax({
            url: "<?php echo base_url('Bus_incharge_entry/delete_stoppagegroup'); ?>",
            type: "POST",
            data: {
                stoppagegroup: stoppagegroup
            },
            success: function(data) {
                if (data == 1) {
                    Command: toastr["error"]("Student Exists! Kindly Reallocate Student First", "Warning")
                }

                else {
                    Command: toastr["success"]("Stoppage Deleted From Corresponding Route", "Success")

                }
            }
        });
    }

    $(document).ready(function() {
        var navoffeset = $(".header-main").offset().top;
        $(window).scroll(function() {
            var scrollpos = $(window).scrollTop();
            if (scrollpos >= navoffeset) {
                $(".header-main").addClass("fixed");
            } else {
                $(".header-main").removeClass("fixed");
            }
        });

    });

    function selectDes(val) {
        $.ajax({
            url: "<?php echo base_url('Bus_incharge_entry/Select_desc'); ?>",
            method: "POST",
            data: {
                val: val
            },
            success: function(data) {
                // Parse the JSON response
                var response = JSON.parse(data);
                // Update the #desc and #amt input fields
                $('#desc').val(response.Descriptionn);
                $('#amt').val(response.amount);
            },
        });
    }

    function deletedata(group, desc, amt) {
        // Confirm the deletion
        if (confirm("Are you sure you want to delete this stoppage group?")) {
            // Send an AJAX request to delete the stoppage group
            $.ajax({
                url: "<?php echo base_url('Bus_incharge_entry/delete_stoppage'); ?>",
                type: "POST",
                data: {
                    group: group,
                    desc: desc,
                    amt: amt
                },
                success: function(response) {
                    // Handle the successful deletion
                    if (response == 1) {
                        Command: toastr["success"]("Stoppage Group Deleted", "Success")
                        // Reload the page or update the table dynamically
                        location.reload();
                    }
                    else {
                        Command: toastr["success"]("Error deleting stoppage group. Please try again.", "Success")
                        location.reload();
                    }
                },
                error: function() {
                    // Handle the deletion error
                    alert("Error deleting stoppage group. Please try again.");
                }
            });
        }
    }

    function editdata(group, desc, amt) {
        $("#add_div").hide();
        var group = $('#group1').val(group);
        var desc = $('#desc1').val(desc);
        var amt = $('#amt1').val(amt);
        $("#edit_div").show();
    }

    function editStoppageCategory(routeId, stopNo, busCode, tripId) {
        // Get the necessary elements
        var originalEditDiv = document.getElementById('original-edit-div');
        var editDiv = document.getElementById('edit-div');
        var groupInput = document.getElementById('group');
        var descInput = document.getElementById('desc');
        var amtInput = document.getElementById('amt');
        var submitButton = document.getElementById('submit');

        // Hide the original edit div
        originalEditDiv.hidden = true;

        // Show the edit div with transition
        editDiv.classList.add('edit-div-transition');
        editDiv.classList.add('show');
        editDiv.hidden = false;

        // Populate the input fields with the current values
        groupInput.value = stopNo;
        descInput.value = '<?php echo $value->Descriptionn; ?>';
        amtInput.value = '<?php echo $value->Amt; ?>';

        // Change the submit button text to "Edit"
        submitButton.value = 'Edit';
    }

    function cancelEditStoppageCategory() {
        // Get the necessary elements
        var originalEditDiv = document.getElementById('add_div');
        var editDiv = document.getElementById('edit_div');

        // Show the original edit div
        originalEditDiv.hidden = false;

        // Reset the form fields
        document.getElementById('group').value = '';
        document.getElementById('desc').value = '';
        document.getElementById('amt').value = '';
    }

    $("#msg").fadeOut(6000);
</script>