<style>
    html * {
        font-size: 11px !important;
        color: #000 !important;
        font-family: Arial !important;
    }
</style>

<table style="width:100%">
    <tr>
        <td>
            <center><img src='assets/school_logo/cbse_logo.jpg' style="margin-left:5%; width:83px;"></center>
        </td>
        <td>
            <center>
                <h1><span style="color:#02933e;font-size:24px !important;">JAWAHAR VIDYA MANDIR</span></h1>Shyamali Colony, Doranda, Ranchi-834002<br />Session- ( 2023-2024 )
            </center>
        </td>
        <td>
            <center><img src='assets/school_logo/cbse_logo.jpg' style="margin-left:5%; width:83px;"></center>
        </td>
    </tr>
</table>
<br><br><hr>
<table style='font-size:11px; width:100%'>


    <thead>
        <tr>
            <th>SlNo</th>
            <th>Item</th>
            <th>Quantity</th>
            <th>Requested by</th>
            <th>Requested Date</th>
           
        </tr>
    </thead>




    <tbody>
        <?php $i = 1;
        foreach ($data as $val) { ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $val->item; ?></td>
                <td><?php echo $val->quantity; ?></td>
                <td><?php echo $val->req_by; ?></td>
                <td><?php echo $val->req_date; ?></td>
                
            </tr>
        <?php $i++;
        }    ?>
    </tbody>

</table>