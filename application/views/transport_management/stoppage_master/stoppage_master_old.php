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
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <form method="post" action="<?php echo base_url('Bus_incharge_entry/save_stoppage'); ?>">
                        <div class="mb-3">
                            <label for="">Group</label>
                            <input type="text" name="group" id="group" class="form-control" oninput="this.value = this.value.toUpperCase()" maxlength="1" onchange="CheckGroup(this.value)">
                        </div>
                        <div class="mb-3">
                            <label for="">Description</label>
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
                <div class="col-sm-8">
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
                                    <td><?php echo $i; ?></td>

                                    <td><?php echo $value->Stoppage_Group; ?></td>
                                    <td><?php echo $value->Description; ?></td>
                                    <td><?php echo $value->Amt; ?></td>
                                    <td>
                                        <a title='EDIT' href='<?php echo base_url('Add_bus_route/edit_details/' . $value->Route_Id); ?>'><i class="fa fa-pencil-square-o" aria-hidden="true" style='color:black;font-size:16px;'></i></a>&emsp;&emsp;&emsp;&emsp;&emsp;
                                        <a title='DELETE' href='javascript:void(0);' onclick="checkdata(<?php echo $value->Route_Id . ',' . $value->STOPNO . ',' . $value->BusCode . ',' . $value->trip_ID; ?>)"><i class="fa fa-trash-o " aria-hidden="true" style='color:red;font-size:16px;'></i></a>
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

<!-- script-for sticky-nav -->
<script>
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
</script>
<!-- /script-for sticky-nav -->
<!--inner block start here-->
<div class="inner-block">

</div>


<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
<script type="text/javascript">
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
                $('#desc').val(response.description);
                $('#amt').val(response.amount);
            },
        });
    }

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
    $("#msg").fadeOut(6000);
</script>