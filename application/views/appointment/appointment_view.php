<head>
    <style>
        label {
            color: black;
        }
        .card {
        margin: 0 auto; /* Added */
        float: none; /* Added */
        margin-bottom: 10px; /* Added */
        }
        body{
            background-color: blueviolet !important;
            background-image: linear-gradient(180deg, #aa4b6b, #6b6b83);
        }
    </style>

    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
<div class="card border-dark my-5 align-items-center" style="width:70%;">
    <div class="card-body  text-center">

        <form action="<?php echo base_url('appointment/save_'); ?>" method="POST" enctype="multipart/form-data">
            <center>
                <h3>APPOINTMENT FORM</h3>
            </center>
            <div class="row" style="padding:15px">

                <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 form-group">
                    <label>Department </label>
                    <select name="dept" id="dept" required class="form-control form-select" onchange="selectConcernedPer(this.value);">
                        <option value="">Select</option>
                        <?php foreach ($department as $dept) {
                        ?>
                            <option value="<?php echo $dept->ID; ?>"><?php echo $dept->NAME; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 form-group">
                    <label>Appointment Date</label>
                    <input type="date" name="appointment_date" required id="datepicker1" class="form-control datepicker" autocomplete="off" value="<?php echo date('Y-m-d'); ?>">
                </div>

                <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 form-group">
                    <label>Time</label>
                    <input type="text" name="appointment_time" required id="timepicker" class="form-control">
                </div>

            </div>

            <div class="row" style="padding:15px">

                <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 form-group">
                    <label>Concerned Person </label>
                    <select name="conPer" id="conPer" required class="form-control form-select">
                        <option value="">Select</option>
                    </select>
                </div>



                <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 form-group">
                    <label>Name</label>
                    <input type="text" name="name" id="name" class="form-control" autocomplete="off">
                </div>

                <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 form-group">
                    <label>Mobile No.</label>
                    <input type="text" name="mobNo" id="mobNo" class="form-control" autocomplete="off" maxlength="10">
                </div>

            </div>

            <div class="row" style="padding:15px">

                <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 form-group">
                    <label>Email id</label>
                    <input type="email" name="email" id="email" class="form-control" autocomplete="off">
                </div>

                <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 form-group">
                    <label>Purpose</label>
                    <input type="text" name="purpose" id="purpose" class="form-control" autocomplete="off">
                </div>

                <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 form-group">
                    <label>Visitor Type </label>
                    <select name="vistor" id="vistor" required class="form-control form-select" autocomplete="off">
                        <option value="">Select</option>
                        <option value="Parents">Parents</option>
                        <option value="Guardians">Guardians</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
            </div>
            <div class="row" style="padding:15px">
                <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 form-group">
                    <label>Address </label>
                    <textarea name="add" id="add" cols="15" rows="5" class="form-control"></textarea autocomplete="off">
            </div>

            <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 form-group">
                <label>Photograph(Visitor)</label>
                <input type="file" class="form-control" name="document" class="form-control" id="documents">
            </div>

            <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 form-group">
                <br>
                <input type="submit" class="btn btn-success" name="submit" class="form-control" id="submit" value="Submit">
            </div>
        </div>

    </form>
    </div>
</div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!-- jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- jQuery UI CSS -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<!-- jQuery UI JS -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<!-- jQuery Timepicker CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.2.17/jquery.timepicker.min.css">

<!-- jQuery Timepicker JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.2.17/jquery.timepicker.min.js"></script>



<script>
        // Initialize timepicker
        $("#timepicker").timepicker();

    function selectConcernedPer(val) {
        $.post("<?php echo ('appointment/selectConcPer'); ?>", {
            val: val
        }, function(data) {
            $("#conPer").html(data);
        });
    }
</script>