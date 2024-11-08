<?php

//     echo "<pre>";
//     print_r($result);
//     $keys = array_keys($result['earning']);
//     // var_export($keys);
//     print_r($keys);
//     echo $keys[0];
//     echo $result['earning'][$keys[0]];
// die;
?>

<style type="text/css">
    .table td,
    .table>tbody>tr>td,
    .table>tbody>tr>th,
    .table>tfoot>tr>td,
    .table>tfoot>tr>th,
    .table>thead>tr>td,
    .table>thead>tr>th {
        padding: 5px !important;
        white-space: nowrap;
    }

    .table>thead>tr>th,
    .table>tbody>tr>th,
    .table>tfoot>tr>th,
    .table>thead>tr>td,
    .table>tbody>tr>td,
    .table>tfoot>tr>td {
        color: black;
        font-size: 11px;
    }

    .thead-color {
        background: #337ab7 !important;
        color: white !important;
        text-align: center !important;
    }

    #div1 {
        /* display: inline-block; */
        float: left;
        width: 45%;
    }

    #div2 {
        float: right;
        width: 45%;
    }
</style>
<div style="padding: 25px; background-color: white;border-top: 3px solid #5785c3;">
    <b>Consolidated Report</b>
    <hr>
    <form id="searchForm" method="post" action="<?php echo base_url('salary_report/Consolidated_report'); ?>">
        <div class="row">
            <div class="col-sm-2">
                <div class="form-group">
                    <label>Month and Year</label><span class="req"> *</span>
                    <input type="text" name="date" class="form-control datepicker" id="date" autocomplete="off" value="<?php echo set_value('date'); ?>" required="">
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label></label>
                    <button type="submit" class="btn btn-success form-control" name="search"><i class="fa fa-search"></i> Search</button>
                </div>
            </div>
        </div>
    </form>
    <hr>
    <?php if (isset($result) && !empty($result)) { ?>
        <div class="text-center">
            <a href="<?php echo base_url('salary_report/Consolidated_report/generatePDFReport/' . $year . '/' . $month); ?>" class="btn btn-success" target="_blank"><i class="fa fa-file-pdf-o"></i> Generate PDF Report</a>
        </div>
        <div class="main_div">
            <hr>
            <div id="div1">
                <table class="table table-bordered table-striped">
                    <thead id="header-fixed">
                        <tr>
                            <th class="thead-color">Earning Head</th>
                            <th class="thead-color">Amount Rs.</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        $keys1 = array_keys($result['earning']);
                        foreach ($keys1 as $key => $value) {; ?>
                            <tr style="<?php if ($value == 'TOT EARNING') {
                                            echo "border-top:2px solid;border-bottom:2px solid; font-weight:700";
                                        } else {
                                            echo "";
                                        } ?>;">
                                <td style="text-align:center;"><?php echo $value;  ?></td>
                                <td><?php echo $result['earning'][$value]; ?></td>
                            </tr>
                        <?php
                        } ?>

                    </tbody>
                </table>
            </div>
            <div id="div2">
                <table class="table table-bordered table-striped">
                    <thead id="header-fixed">
                        <tr>
                            <th class="thead-color">Deduction Head</th>
                            <th class="thead-color">Amount Rs.</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        $keys2 = array_keys($result['deduction']);
                        foreach ($keys2 as $key => $value) {; ?>
                            <tr style="<?php if ($value == 'TOT DEDUCTION') {
                                            echo "border-top:2px solid;border-bottom:2px solid; font-weight:700";
                                        } else {
                                            echo "";
                                        } ?>;">
                                <td style="text-align:center;"><?php echo $value;  ?></td>
                                <td><?php echo $result['deduction'][$value]; ?></td>
                            </tr>
                        <?php
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <br>
    <br>
    <div class="clearfix">
    </div>

    <br>
    <br>
    <div>
        <table class="table" style="font-weight: 700;width:50%" >
            <tr>
                <td>Net Pay : TOT EARNING - TOT DEDUCTION =<?php echo number_format($result['earning']['TOT EARNING']-$result['deduction']['TOT DEDUCTION'],0) ?></td>
            </tr>
        </table>
                <br>
                <table class="table" style="font-weight: 700;width:50%" border="1px">
                    <tr style="padding: 10px !important;">
                        <td style="width:40%;">EPF :</td>
                        <td style="width:60%;"><?php echo number_format($result['data']['EPFF']);?></td>
                    </tr>
                    <tr style="padding: 10px !important;">
                        <td style="width:40%;">EPS :</td>
                        <td style="width:60%;"><?php echo number_format($result['data']['EPSS']);?></td>
                    </tr>
                </table>
                    <br>
                <table class="table" style="font-weight: 700;width:50%" border="1px">
                    <tr style="padding: 10px !important;">
                        <td style="width:40%;">EPF Subscribers :</td>
                        <td style="width:60%;"><?php echo number_format($result['data']['EPF COUNT']);?></td>
                    </tr>
                    <tr style="padding: 10px !important;">
                        <td style="width:40%;">EPS Subscribers :</td>
                        <td style="width:60%;"><?php echo number_format($result['data']['EPS COUNT']);?></td>
                    </tr>
                </table>

    </div>
    <?php } else { ?>
        <div class="row">
            <div class="col-sm-12">
                <?php if ($this->session->flashdata('msg')) {
                    echo $this->session->flashdata('msg');
                } ?>
            </div>
        </div>
    <?php } ?>
    


</div>



<script type="text/javascript">
    $(function() {
        $('.datatable').DataTable({
            'paging': false,
            'lengthChange': false,
            'searching': false,
            'ordering': false,
            'info': false,
            'autoWidth': true,
            'pageLength': 25,
            dom: 'Bfrtip',
            buttons: [{
                extend: 'excelHtml5',
                title: 'Consolidated Report',

            }, ],
        })
    });

    $('.datepicker').datepicker({
        format: "M-yyyy",
        autoclose: true,
        startView: "months",
        minViewMode: "months"
    });
</script>