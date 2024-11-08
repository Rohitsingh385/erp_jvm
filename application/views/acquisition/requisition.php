<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.html">Requisition Management</a> <i class="fa fa-angle-right"></i></li>
</ol>

<style>
    .ui-datepicker-month,
    .ui-datepicker-year {
        padding: 0px;
    }

    .table,
    #thead,
    tr,
    td,
    th {
        text-align: center;
        color: #000 !important;
    }
</style>

<div style="padding: 10px; background-color: white;  border-top:3px solid #5785c3;">

    <form action='<?php echo base_url('acquisition/requisition/requisition_report'); ?>' method='post'>
        <div class="row">
            <div class="col-md-3 form-group">
                <label id='item1'>Item</label>
                <select name='item1' id='item1' class='form-control'>
                    <option value=''>Select</option>
                    <?php foreach ($item as $val) { ?>
                        <option value="<?php echo $val->item_group_name ?>"><?php echo $val->item_group_name; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="col-md-3 form-group">
                <label id='quan1'>Quantity</label>
                <input type="number" name="quan1" id="quan1">
            </div>


        </div>
        <div class="row">
            <div class="col-md-3 form-group">
                <label id='item2'>Item</label>
                <select name='item2' id='item2' class='form-control'>
                    <option value=''>Select</option>
                    <?php foreach ($item as $val) { ?>
                        <option value="<?php echo $val->item_group_name ?>"><?php echo $val->item_group_name; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="col-md-3 form-group">
                <label id='quan2'>Quantity</label>
                <input type="number" name="quan2" id="quan2">
            </div>


        </div>
        <div class="row">
            <div class="col-md-3 form-group">
                <label id='item3'>Item</label>
                <select name='item3' id='item3' class='form-control'>
                    <option value=''>Select</option>
                    <?php foreach ($item as $val) { ?>
                        <option value="<?php echo $val->item_group_name ?>"><?php echo $val->item_group_name; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="col-md-3 form-group">
                <label id='quan3'>Quantity</label>
                <input type="number" name="quan3" id="quan3">
            </div>


        </div>
        <div class="row">
            <div class="col-md-3 form-group">
                <label id='item4'>Item</label>
                <select name='item4' id='item4' class='form-control'>
                    <option value=''>Select</option>
                    <?php foreach ($item as $val) { ?>
                        <option value="<?php echo $val->item_group_name ?>"><?php echo $val->item_group_name; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="col-md-3 form-group">
                <label id='quan4'>Quantity</label>
                <input type="number" name="quan4" id="quan4">
            </div>


        </div>
        <div class="row">
            <div class="col-md-3 form-group">
                <label id='item5'>Item</label>
                <select name='item5' id='item5' class='form-control'>
                    <option value=''>Select</option>
                    <?php foreach ($item as $val) { ?>
                        <option value="<?php echo $val->item_group_name ?>"><?php echo $val->item_group_name; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="col-md-3 form-group">
                <label id='quan5'>Quantity</label>
                <input type="number" name="quan5" id="quan5">
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 form-group">
                <br>
                <button class="btn btn-success" name='disp'>Display</button>
            </div>

            <div class="col-md-3 form-group" style="display: none;">
                <br>
                <a class="btn btn-warning" data-toggle="modal" data-target="#myModal">ADD MORE ITEM</a>
            </div>
        </div>


    </form>


</div>

<br>

<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">ADD ITEM</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form action='<?php echo base_url('acquisition/acquisition/item_save'); ?>' method='post'>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label>Item Name</label>
                            <input type="text" name="itmnm" id="itmnm">
                        </div>
                        <div class="col-md-2 form-group">

                        </div>
                        <div class="col-md-2 form-group">
                            <br>
                            <button class="btn btn-warning" name='save'>Add</button>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<!-- The Modal end -->

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