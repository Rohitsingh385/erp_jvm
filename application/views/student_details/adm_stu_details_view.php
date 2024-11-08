<style type="text/css">
    .table>thead>tr>th,
    .table>tbody>tr>th,
    .table>tfoot>tr>th,
    .table>thead>tr>td,
    .table>tbody>tr>td,
    .table>tfoot>tr>td {
        color: black;
    }

    .error {
        color: red;
    }

    .loader {
        position: fixed;
        top: 50%;
        left: 50%;
        border: 16px solid #f3f3f3;
        /* Light grey */
        border-top: 16px solid #3498db;
        /* Blue */
        border-radius: 50%;
        width: 120px;
        height: 120px;
        animation: spin 2s linear infinite;
        z-index: 999;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    @media print {
        .hide-print {
            display: none;
        }
    }

    .table>thead>tr>th,
    .table>tbody>tr>th,
    .table>tfoot>tr>th,
    .table>thead>tr>td,
    .table>tbody>tr>td,
    .table>tfoot>tr>td {
        color: black;
        padding: 5px !important;
        font-size: 12px;
    }

    .thead-color {
        background: #337ab7 !important;
        color: white !important;
    }

    .table>thead>tr>th,
    .table>tbody>tr>th,
    .table>tfoot>tr>th,
    .table>thead>tr>td,
    .table>tbody>tr>td,
    .table>tfoot>tr>td {
        font-size: 14px;
        padding: 5px;
        white-space: nowrap;
    }
</style>

<div id="printableArea">
    <div class="table-responsive">
        <table class='table table-bordered table-striped'>
            <thead>
                <tr>
                    <th class="text-center thead-color">SL NO.</th>
<th class="text-center thead-color">ADM. NO.</th>
                    <th class="text-center thead-color">STU. ID</th>
                    <th class="text-center thead-color">NAME</th>
                    <th class="text-center thead-color">FATHER'S NAME</th>
                    <th class="text-center thead-color">MOTHER'S NAME</th>
                    <th class="text-center thead-color">CONTACT NO.</th>
                </tr>
            </thead>

            <tbody>
                <?php
        
                foreach ($getStuData as $key => $val) { ?>
                    <tr>
						<td>
                            <center><?php echo $key+1; ?></center>
                           
                        </td>
                        <td>
                           
                            <form action="<?php echo base_url('Adm_stu/goToStuPage/') ?>" method='POST' onsubmit="return confirm('Are you sure you want to submit this form?');">
                                <input style='text-transform: uppercase;' type='text' name='admno' placeholder="Adm. No. as XXXX/XXXX" required>
                                <input type='hidden' name='id' value='<?php echo $val['id']; ?>'>
                                <input type='hidden' name='class' value='<?php echo $class; ?>'>
                                <input type='submit' value='GO' class='btn btn-success btn-sm'>
                            </form>
                        </td>
               
                        <td><?php echo $val['id']; ?></td>
                        <td><?php echo $val['stu_nm']; ?></td>
                        <td><?php echo $val['f_name']; ?></td>
                        <td><?php echo $val['m_name']; ?></td>
                        <td><?php echo $val['mobile']; ?></td>
                    </tr>
                <?php
                } ?>
            </tbody>
        </table>
    </div>
</div>

<br><br>
<br>