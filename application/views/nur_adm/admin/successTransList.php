<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Successfull Transaction List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Transaction List</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <table class='table'>
                        <tr>
                            <th>Start Date</th>
                            <td><input type='text' id='start_date' class='form-control datepicker' onchange='filterdata1(this.value)' autocomplete='off'></td>
                            <th>End Date</th>
                            <td><input type='text' id='end_date' class='form-control datepicker' onchange='filterdata1(this.value)' disabled autocomplete='off'></td>
                            <th>Verified Status</th>
                            <td>
                                <select id='verified_status' class='form-control' onchange='filterdata(this.value)'>
                                    <option value='all'>All</option>
                                    <option value='1'>Verified</option>
                                    <option value='0'>Pending</option>
                                    <option value='2'>Rejected</option>
                                </select>
                            </td>
                            <th>Class</th>
                            <td>
                                <select id='filterClass' class='form-control' onchange='filterdata(this.value)'>
                                    <option value='all'>All</option>
                                    <option value='Pre-Nursery'>Pre-Nursery</option>
                                    <option value='Nursery'>Nursery</option>
                                    <option value='Prep'>Prep</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Father's Name</th>
                                    <th>Registration No.</th>
                                    <th>Mobile</th>
                                    <th>Pay Trans Id</th>
                                    <th>Pay Trans Date</th>
                                    <th>Verified Status</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    $('.datepicker').datepicker({
        format: 'dd-M-yyyy',
        autoclose: true,
    });
    $(document).ready(function() {
        var verified_status = $("#verified_status").find(":selected").val();
        var cls = $('#filterClass').find(":selected").val();
        var start_date = $("#start_date").val();
        var end_date = $("#end_date").val();
        getData(verified_status, cls, start_date, end_date);

        $("#verify").click(function() {
            alert("jhlhjk");
            $.toast({
                heading: 'Success',
                text: 'Student Verified Successfully',
                showHideTransition: 'slide',
                icon: 'success',
                position: 'top-right',
            })
        });

        $("#reject").click(function() {
            alert("jhlhjk");

            $.toast({
                heading: 'Rejected',
                text: 'Student Rejected Successfully',
                showHideTransition: 'fade',
                icon: 'error',
                position: 'top-right',

            })
        });

        $("#suces_menu").addClass('active');

    });

    // $("#filterClass").change(function() {
    function filterdata(value) {
        var verified_status = $("#verified_status").find(":selected").val();
        var cls = $('#filterClass').find(":selected").val();
        var start_date = $("#start_date").val();
        var end_date = $("#end_date").val();
        getData(verified_status, cls, start_date, end_date);
    }

    function filterdata1(value) {
        $("#end_date").prop('disabled', false);
        var verified_status = $("#verified_status").find(":selected").val();
        var cls = $('#filterClass').find(":selected").val();
        var start_date = $("#start_date").val();
        var end_date = $("#end_date").val();
        getData(verified_status, cls, start_date, end_date);
    }
    // });

    function getData(par1, par2, par3, par4) {
        // alert("class "+par2);

        var verified_status = par1;
        var cls = par2;
        var start_date = par3;
        var end_date = par4;
        $('#example1').DataTable({
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                'url': '<?= base_url() ?>adm_nur/reports/SuccessTransReport/index_api',
                'data': {
                    start_date: start_date,
                    end_date: end_date,
                    verified_status: verified_status,
                    cls: cls,
                    // etc..
                },
            },
            'columns': [{
                    data: 'stu_name'
                },
                {
                    data: 'stu_father_name'
                },
                {
                    data: 'reg_no'
                },
                {
                    data: 'contact_no',
                },
                {
                    data: 'pay_trans_id_final',
                },
                {
                    data: 'pay_trans_date_final',
                },
                {
                    data: 'verified_status',
                }
            ],
            'ordering': false,
            dom: 'Bfrtip',
            buttons: {
                dom: {
                    button: {
                        tag: 'button',
                        className: ''
                    }
                },
                buttons: [{
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel-o" aria-hidden="true"></i> EXCEL',
                        title: 'TOTAL REGISTERED STUDENTS',
                        className: 'btn btn-success',
                        extension: '.xlsx',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5,6]
                        }
                    },
                    {
                        extend: 'pdf',
                        title: 'TOTAL REGISTERED STUDENTS',
                        className: 'btn btn-primary',
                        action: function(e, dt, button, config) {
                            var query = dt.search();
                            window.open("<?php echo base_url('adm_nur/reports/SuccessTransReport/downloadTransactionPDF'); ?>");
                        },
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    }
                ]
            },
            "bDestroy": true
        });
    }
</script>