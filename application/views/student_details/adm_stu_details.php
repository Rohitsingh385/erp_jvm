<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo ''; ?>">Student Information</a> <i class="fa fa-angle-right"></i>Admission student </li>
</ol>

<div class='mainb' style="padding: 15px; background-color: white;border-top: 3px solid #5785c3;">
    <form id="form">
        <div class="row">

            <div class="col-md-3">
                <label for="">Class</label>
                <select class="form-control" onchange="classes(this.value)" name='classs' id="classs" required>
                    <option value=''>Select class</option>
                    <option value='nur'>NUR</option>
                    <option value='iii'>III</option>
                    <option value='xi'>XI</option>
                </select>
            </div>

            <div class="col-md-6">
                <br>
                <input type="submit" name="submit" id="submit" value="submit" class="btn  btn-success">
            </div>

        </div>
        <br>
        <hr>
        <div id="load_data" style="overflow:auto;"></div>
    </form>
</div>
<br>
<hr>
<script>
    $("#form").on("submit", function(event) {
        event.preventDefault();
        $.ajax({
            url: "<?php echo base_url('Adm_stu/get_details'); ?>",
            type: "POST",
            data: $('#form').serialize(),
            success: function(data) {
                $("#load_data").html(data);
            }
        });
    });
</script>