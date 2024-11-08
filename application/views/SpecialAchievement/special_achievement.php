<style type="text/css">

</style>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Special Achievement</a> <i class="fa fa-angle-right"></i></li>
</ol>

<div class='mainb' style="padding: 15px; background-color: white; border-top: 3px solid #5785c3;">
    <div class="row">
        <div class="col-sm-3">
            <label>Session</label>
            <select class="form-control" id="session" onchange='sess(this.value)'>
                <option value=''>Select</option>
                <option value='2021'>2022-2023</option>
            </select>
        </div>

        <div class="col-sm-3">
            <label>Class</label>
            <select class="form-control" id="classs" onchange='getSec(this.value)'>
                <option value=''>Select</option>
            </select>
        </div>

        <div class="col-sm-3">
            <label>Sec</label>
            <select class="form-control" name="sec" id="sec">
                <option value=''>Select</option>
            </select>
        </div>

        <div class="col-sm-3">
            <label>Term</label>
            <select class="form-control" onchange="term(this.value)" id="term">
                <option value=''>Select</option>
                <option value='2'>TERM-2</option>
                <option value='1'>TERM-1</option>
            </select>
        </div>
    </div>

    <div class='row'><br /><br />
        <div class='col-sm-12'>
            <div id='load'></div>
        </div>
    </div>
</div><br />

<script type="text/javascript">
    function sess(val) {
        $('#classs').prop('selectedIndex',0);
        $('#sec').prop('selectedIndex',0);
        $('#term').prop('selectedIndex',0);

        $.ajax({
            url: "<?php echo base_url('SpecialAchievement/getClass'); ?>",
            type: "POST",
            data: {
                val: val
            },
            success: function(ret) {
                $("#classs").html(ret);
            }
        });
    }

    function getSec(val) {
        $('#sec').prop('selectedIndex',0);
        $('#term').prop('selectedIndex',0);
        var session = $("#session").val();
        $.ajax({
            url: "<?php echo base_url('SpecialAchievement/getSection'); ?>",
            type: "POST",
            data: {
                session: session,
                val: val
            },
            success: function(ret) {
                $("#sec").html(ret);
            }
        });
    }

    $("#sec").change(function(){
        $('#term').prop('selectedIndex',0);
    });

    function term(val) {
        // alert(val);
        var session = $("#session").val();
        var classs = $("#classs").val();
        var sec = $("#sec").val();
        $("body").css('opacity', '0.5');
        if (session != '') {
            $.ajax({
                url: "<?php echo base_url('SpecialAchievement/getStu'); ?>",
                type: "POST",
                data: {
                    val: val,
                    session: session,
                    classs: classs,
                    sec: sec
                },
                success: function(ret) {
                    $("#load").html(ret);
                    $("body").css('opacity', '');
                }
            });
        } else {
            alert('Select Session First');
            $("body").css('opacity', '');
        }
    }

</script>