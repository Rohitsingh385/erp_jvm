<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<style>
    table tr td,
    th {
        color: #000 !important;
        padding: 0px !important;
    }

    body {
        font-family: 'Aldrich', sans-serif;
    }
</style>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Remarks</a> <i class="fa fa-angle-right"></i></li>
</ol>

<div style="padding-left: 25px; background-color: white">
    <div class="row">
        <div class="col-sm-12">
            <table class="table">
                <tr>
                    <th style="width:200px;">Class</th>
                    <th style="width:200px;">Sec</th>
                    <th style="width:200px;">Term</th>
                </tr>


                <tr>
                    <td>
                        <select class="form-control" onchange="classes(this.value)" id="classs">
                            <option value=''>Select</option>
                            <?php
                            if (isset($class_data)) {
                                foreach ($class_data as $data) {
                                    if ($data->Class_No == $log_cls_no) { ?>
                                        <option value="<?php echo $data->Class_No; ?>"><?php echo $data->CLASS_NM; ?></option>
                                    <?php  } else { ?>
                                        <option value="<?php echo $data->Class_No; ?>"><?php echo $data->CLASS_NM; ?></option>
                            <?php  }
                                }
                            }
                            ?>
                        </select>
                    </td>

                    <td>
                        <select class="form-control" name="sec" id="sec" onchange="secc(this.value)">
                            <option value=''>Select</option>
                        </select>
                    </td>

                    <td>
                        <select class="form-control" id="trm" disabled>
                            <option value='1' <?php if ($trm == 1) {
                                                    echo 'selected';
                                                } ?>>TERM-1</option>
                            <option value='2' <?php if ($trm == 2) {
                                                    echo 'selected';
                                                } ?>>TERM-2</option>
                        </select>
                    </td>
                </tr>
            </table>
        </div>

        <form action="<?php echo base_url('Remarks_new/remarks_save') ?>" method="post">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-12">
                        <center><img src="<?php echo base_url('assets/preloader/loading2.gif'); ?>" style="width:120px; display:none;" id="loading2"></center>
                        <div id="stu_list" style="height:400px; overflow:auto;">
                        </div>
                    </div>
                </div>
                <div class="row" id="btn_save" style="display: none;">
                    <div class="col-sm-12">
                        <input type="submit" class="btn btn-success" name="submit" id="submit" value="Save">
                    </div>
                </div>
            </div>
        </form>

    </div>
</div><br /><br />
<div class="clearfix"></div>

<!-- SweetAlert2 -->
<script type="text/javascript" src='../files/bower_components/sweetalert/js/sweetalert2.all.min.js'> </script>
<!-- SweetAlert2 -->
<link rel="stylesheet" href='../files/bower_components/sweetalert/css/sweetalert2.min.css' media="screen" />
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
<!--inner block end here-->
<!--copy rights start here-->

<script>
    $("#remarks").select2({
        allowClear: true,
        width: "resolve"
    });

    function classes(val) {
        // alert(val);
        $.post("<?php echo base_url('Remarks_new/classess'); ?>", {
            val: val
        }, function(data) {
            var fill = $.parseJSON(data);
            $("#sec").html(fill[0]);
        });
    }

    function secc(val) {
        $("#trm option[value='']").prop('selected', true);
        if (val != '') {
            $("#trm").prop('disabled', false);
            $("#btn_save").show();
        } else {
            $("#trm").prop('disabled', true);
            $("#btn_save").hide();
        }
        $("#loading2").show();
        $("#stu_list").html('');
        var classs = $("#classs").val();
        var disp_classs = $("#classs option:selected").text();
        var sec = $("#sec").val();
        var trm = $("#trm").val();
        $.post("<?php echo base_url('Remarks_new/stu_list'); ?>", {
            classs: classs,
            disp_classs: disp_classs,
            sec: sec,
            trm: trm
        }, function(data) {
            $("#loading2").hide();
            $("#stu_list").html(data);
        });
    }
    
</script>