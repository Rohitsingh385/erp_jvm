<style>
    .loader {
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid #3498db;
        width: 120px;
        height: 120px;
        margin: 0px auto;
        z-index: 999;
        -webkit-animation: spin 2s linear infinite;
        /* Safari */
        animation: spin 2s linear infinite;
    }

    /* Safari */
    @-webkit-keyframes spin {
        0% {
            -webkit-transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.html">Topper list </a> <i class="fa fa-angle-right"></i></li>
</ol>
<div class="loader" style="display:none;"></div>
<div style="padding: 10px; background-color: white;  border-top:3px solid #5785c3;">
    <form id="form" method="post">
        <div class="row">
            <div class="col-md-3 col-sm-3 col-lg-3 col-xl-3 form-group">
                <label>Select Class</label>
                <select class="form-control" required name="class_name" id="class_name" onchange="selectSub(this.value)">
                    <option value="">Select Class</option>
                    <?php
                    foreach ($class as $class_data) {
                    ?>
                        <option value="<?php echo $class_data->Class_No; ?>"><?php echo $class_data->CLASS_NM; ?></option>
                    <?php
                    }

                    ?>
                </select>
            </div>

            <div class="col-md-3 col-sm-3 col-lg-3 col-xl-3 form-group">
                <label>Subject</label><br />
                <select class='form-control' id='sub' name='sub' required onchange="selectExam(this.value)">
                    <option value="">Select</option>
                </select>
            </div>

            <div class="col-md-3 col-sm-3 col-lg-3 col-xl-3 form-group">
                <label>Exam Type</label>
                <select class="form-control" required name="exam_type" id="exam_type">
                    <option value="">Select Exam Type</option>
                    <!-- <?php
                    foreach ($exammaster as $exam) {
                    ?>
                        <option value="<?php echo $exam->ExamCode; ?>"><?php echo $exam->ExamName; ?></option>
                    <?php
                    }

                    ?> -->
                </select>
            </div>
            <div class="col-md-3 col-sm-3 col-lg-3 col-xl-3 form-group">
                <label>Term</label>
                <select class="form-control" required name="term" readonly>
                    <option value="TERM-1" selected>Annual</option>
                    <option value="TERM-2">TERM-2</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
                <center>
                    <button type="submit" class="btn btn-success">DISPLAY</button>
                </center>
            </div>
        </div>
    </form>
    <br />
    <div id="load_data" style="overflow:auto;"></div>
</div><br />
<script>
    function selectSub(val) {
        $.ajax({
            url: "<?php echo base_url('report_card/Topper_10/getSub'); ?>",
            type: "POST",
            data: {
                val: val
            },
            success: function(ret) {
                $("#sub").html(ret);
            }
        });
    }
	
	 function selectExam(val) {
        var cls = $("#class_name").val();
        $.ajax({
            url: "<?php echo base_url('report_card/Topper_10/Select_Exam'); ?>",
            type: "POST",
            data: {
                val: val,
                cls :cls
            },
            success: function(ret) {
                $("#exam_type").html(ret);
            }
        });
    }

    $("#form").on("submit", function(event) {
        event.preventDefault();
        $.ajax({
            url: "<?php echo base_url('report_card/Topper_10/find_details'); ?>",
            type: "POST",
            data: $('#form').serialize(),
            success: function(data) {
                $('body').css('opacity', '1.0');
                $("#load_data").html(data);
            },
        });
    });

</script>