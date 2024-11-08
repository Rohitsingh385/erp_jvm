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
    <li class="breadcrumb-item"><a href="index.html">Award List</a> <i class="fa fa-angle-right"></i></li>
</ol>
<div class="loader" style="display:none;"></div>
<div style="padding: 10px; background-color: white;  border-top:3px solid #5785c3;">
    <form id="form" method="post">
        <div class="row">
            <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 form-group">
                <label>Select Session</label>
                <select class="form-control" required name="sesion" id="sesion">
                    <option value="">Select Session</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                </select>
            </div>
            <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 form-group">
                <label>Select Ward Employee</label>
                <select class="form-control" required name="eward" id="eward">
                    <option value="">Select Emp</option>
                    <?php
                    if ($eward) {
                        foreach ($eward as $class_data) {
                    ?>
                            <option value="<?php echo $class_data->HOUSENO; ?>"><?php echo $class_data->HOUSENAME; ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 form-group">
                <center>
                    <br />
                    <button type="submit" class="btn btn-success">DISPLAY</button>
                    <p class="btn btn-success" onclick="download()" id="download" style="display:none;"><i class="fa fa-file-pdf-o"></i> Download</p>
                </center>
            </div>

        </div>

    </form>
    <br />
    <div id="load_data" style="overflow:auto;"></div>
</div><br />
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
<link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" />
<script>
    function classchange(vl) {

        $.post("<?php echo base_url('Other_report/class_details'); ?>", {
            'class': vl
        }, function(data) {
            $("#sec_name").html(data);
        });
    }

    $("#form").on("submit", function(event) {
        event.preventDefault();
        $.ajax({
            url: "<?php echo base_url('ward_report/find_details_sw'); ?>",
            type: "POST",
            data: $('#form').serialize(),
            beforeSend: function() {
                $('.loader').show();
                $('body').css('opacity', '0.5');
            },
            success: function(data) {
                $('.loader').hide();
                $('body').css('opacity', '1.0');
                $("#load_data").html(data);
                $('#download').show(1000);

            },
        });
    });

    function download() {
        var eward = $('#eward').val();
		var session = $('#sesion').val();

        window.location = "<?php echo base_url('ward_report/pdf_sw'); ?>" + '/' + eward + session;
    }
</script>