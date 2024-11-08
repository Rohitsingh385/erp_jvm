<br>
<?php
$date = date('Y') . "-" . $monthList['month_code'] . "-01";
$max_month = date("Y-m-d", strtotime('+1 month', strtotime($date)));
?>
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
                    <div class="panel-heading"><i class="fa fa-edit"></i> Employee Payroll Deduction LIC</div>
                    <br />

                    <div class="table-responsive" style="background: white !important;border:1px solid #3278ab;color: white;">
                        <table class='table table-bordered table-striped dataTable'>
                            <thead>
                                <tr>
                                    <th class="thead-color text-center">Employee ID</th>
                                    <th class="thead-color text-center">Name</th>
                                    <th class="thead-color text-center">POLICY 1<sup>ST</sup> AMT</th>
                                    <th class="thead-color text-center">POLICY 2<sup>ND</sup> AMT</th>
                                    <th class="thead-color text-center">POLICY 3<sup>RD</sup> AMT</th>
                                    <th class="thead-color text-center">POLICY 4<sup>TH</sup> AMT</th>
                                    <th class="thead-color text-center">POLICY 5<sup>TH</sup> AMT</th>
                                    <th class="thead-color text-center">TOTAL AMT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($employeeList as $key => $value) { ?>
                                    <tr>
                                        <td class="text-center"><?php echo filter_var($value['EMPID'], FILTER_SANITIZE_NUMBER_INT); ?></td>
                                        <td class="text-left"><?php echo $value['EMP_FNAME'] . ' ' . $value['EMP_MNAME'] . ' ' . $value['EMP_LNAME']; ?></td>

                                        <?php
                                        $mat_date1 = 0;
                                        $mat_date2 = 0;
                                        $mat_date3 = 0;
                                        $mat_date4 = 0;
                                        $mat_date5 = 0;
                                        $pol_1_amt = 0;
                                        $pol_2_amt = 0;
                                        $pol_3_amt = 0;
                                        $pol_4_amt = 0;
                                        $pol_5_amt = 0;
                                        $total_pol_amt=0;
                                        $mat_date1 = $value['MATURITY_DATE1'];
                                        $mat_date2 = $value['MATURITY_DATE2'];
                                        $mat_date3 = $value['MATURITY_DATE3'];
                                        $mat_date4 = $value['MATURITY_DATE4'];
                                        $mat_date5 = $value['MATURITY_DATE5'];
                                        // $sal_date1=date('Y-m-d',(date('Y').'-'.$monthList['month_code'].'-01'));
                                        if ($mat_date1 < $max_month) {
                                            $pol_1_amt = intval($value['POL_1_AMT'],10);
                                        } else {
                                            $pol_1_amt = 0;
                                        }
                                        if ($mat_date2 < $max_month ) {
                                            $pol_2_amt = intval($value['POL_2_AMT'],10);
                                        } else {
                                            $pol_2_amt = 0;
                                        }
                                        if ($mat_date3 < $max_month) {
                                            $pol_3_amt = intval($value['POL_3_AMT'],10);
                                        } else {
                                            $pol_3_amt = 0;
                                        }
                                        if ($mat_date4 < $max_month) {
                                            $pol_4_amt = intval($value['POL_4_AMT'],10);
                                        } else {
                                            $pol_4_amt = 0;
                                        }
                                        if ($mat_date5 < $max_month) {
                                            $pol_5_amt = intval($value['POL_5_AMT'],10);
                                        } else {
                                            $pol_5_amt = 0;
                                        }

                                        $total_pol_amt=$pol_1_amt+$pol_2_amt+$pol_3_amt+$pol_4_amt+$pol_5_amt;
                                        ?>

                                        <td class="text-center" id="POLICY_1_<?php echo $value['id']; ?>"><?php echo $pol_1_amt; ?></td>

                                        <td class="text-center" id="POLICY_2_<?php echo $value['id']; ?>"><?php echo $pol_2_amt; ?></td>

                                        <td class="text-center" id="POLICY_3_<?php echo $value['id']; ?>"><?php echo $pol_3_amt; ?></td>

                                        <td class="text-center" id="POLICY_4_<?php echo $value['id']; ?>"><?php echo $pol_4_amt; ?></td>

                                        <td class="text-center" id="POLICY_5_<?php echo $value['id']; ?>"><?php echo $pol_5_amt; ?></td>

                                        <td class="text-center" id="TOTAL_<?php echo $value['id']; ?>"><?php echo $total_pol_amt; ?></td>


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

    // $(".contenteditable").keypress(function(e) {
    //     if ((e.which < 48 || e.which > 57) && (e.which != 46)) e.preventDefault();
    // });

    // function updateDeduction(column_name, emp_id) {
    //     var cell_value = $('#' + column_name + '_' + emp_id).text();

    //     $.ajax({
    //         url: '<?php //echo base_url('bulk_updation/employeededuction/updateDeduction'); ?>',
    //         data: {
    //             column_name: column_name,
    //             emp_id: emp_id,
    //             cell_value: cell_value
    //         },
    //         method: "post",
    //         dataType: "json",
    //         success: function() {
    //             $.toast({
    //                 heading: 'Success',
    //                 text: 'Saved Successfully',
    //                 showHideTransition: 'slide',
    //                 icon: 'success',
    //                 position: 'top-right',
    //             });
    //         }
    //     });
    // }
</script>