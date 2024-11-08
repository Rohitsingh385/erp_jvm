<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.html">Remarks Report</a> <i class="fa fa-angle-right"></i></li>
</ol>
<!--four-grids here-->
<div style="padding-left: 25px; background-color: white; border-top:3px solid #337ab7;">
    <div class="row">
        <div class='col-sm-12'>
            <form id="stu_form" method="post" autocomplete='off'>
                <div class='col-sm-3'>
                    <label>Class</label><br />
                    <select class='form-control' name='class' required>
                        <option value="">Select</option>
                        <option value="13">XI</option>
                    </select>
                </div>
                <div class='col-sm-3'>
                    <label>Section</label><br />
                    <select class='form-control' id='sec' name='sec' required>
                        <option value="">Select</option>
                        <option value="1">A</option>
                        <option value="2">B</option>
                        <option value="3">C</option>
                        <option value="4">D</option>
                        <option value="5">E</option>
                        <option value="6">F</option>
						<option value="7">G</option>
                        <option value="8">H</option>
                        <option value="9">I</option>
                        <option value="10">J</option>
                        <option value="11">K</option>
                        <option value="17">L</option>
						<option value="12">M</option>
						<option value="13">N</option>
						<option value="15">R</option>
                    </select>
                </div>
                <div class='col-sm-3'>
                    <label>Result</label><br />
                    <select class='form-control' name='result' required>
                        <option value="">Select</option>
                        <option value="all">All</option>
                        <option value="pass">Pass</option>
                        <option value="detained">Detaind</option>
                        <option value="Compartment">Compartment</option>
                        <option value="Re-test">Retest</option>
                    </select>
                </div>
                <div class='col-sm-3'>
                    <br>
                    <input type="submit" name="submit" id="submit" value="DISPLAY" class="btn btn-success" onclick="show_result()">
                </div>
            </form>
        </div>
        <br>
        <div class='col-sm-12' style="overflow-y:auto;">
            <div id='load_data'></div>
        </div>
    </div><br />
</div>

<div class="clearfix"></div>
<script>
   
    $("#stu_form").on("submit", function(event) {
        event.preventDefault();
        $.ajax({
            url: "<?php echo base_url('report_card/Remarks_report/Show_remarks'); ?>",
            type: "POST",
            data: $("#stu_form").serialize(),
            success: function(data) {
                $("#load_data").html(data);
            }
        });
    });

</script>