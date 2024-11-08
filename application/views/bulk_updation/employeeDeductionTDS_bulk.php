<br>
<style type="text/css">
    .thead-color {
        background: #bac9e2 !important;
    }

    tr:nth-child(even) {
        background-color: lightblue !important;
    }
</style>
<div class="employee-dashboard">
    <?php if (isset($employeeList)) { ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default" style="background: #3278ab !important;color: white;font-size: 13px">
                    <div class="panel-heading"><i class="fa fa-edit"></i> Employee Payroll TDS Deduction Bulk Updation</div>
                    <br />
                    <div class="table-responsive" style="background: white !important;border:1px solid #3278ab;color: white;">
                        <table class='table table-bordered table-striped dataTable'>
                            <thead>
                                <tr>
                                    <th class="thead-color text-center">Employee ID</th>
                                    <th class="thead-color text-center">Name</th>
                                    <th class="thead-color text-center">TDS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($employeeList as $key => $value) { ?>
                                    <tr>
                                        <td class="text-center"><?php echo filter_var($value['EMPID'], FILTER_SANITIZE_NUMBER_INT); ?></td>
                                        <td class="text-left"><?php echo $value['EMP_FNAME'] . ' ' . $value['EMP_MNAME'] . ' ' . $value['EMP_LNAME']; ?></td>


                                        <td class="text-center contenteditable" contenteditable="true" onblur="updateDeduction('TDS',<?php echo $value['id']; ?>)" id="TDS_<?php echo $value['id']; ?>"><?php echo $value['TDS']; ?></td>

                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<br>

<script type="text/javascript">
    $(function() {
        $('.dataTable').DataTable({
            'paging': false,
            'lengthChange': false,
            'searching': true,
            'ordering': false,
            'info': false,
            'autoWidth': true,
        })
    });

    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });

    $(".contenteditable").keypress(function(e) {
        if ((e.which < 48 || e.which > 57) && (e.which != 46)) e.preventDefault();
    });

    function updateDeduction(column_name, emp_id) {
        var cell_value = $('#' + column_name + '_' + emp_id).text();

        $.ajax({
            url: '<?php echo base_url('bulk_updation/employeedeductionTDS/updateDeduction'); ?>',
            data: {
                column_name: column_name,
                emp_id: emp_id,
                cell_value: cell_value
            },
            method: "post",
            dataType: "json",
            success: function() {
                $.toast({
                    heading: 'Success',
                    text: 'Saved Successfully',
                    showHideTransition: 'slide',
                    icon: 'success',
                    position: 'top-right',
                });
            }
        });
    }
</script>