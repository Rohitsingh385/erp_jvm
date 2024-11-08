<title>Computer Fee Report</title>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.html">Computer Fee Collection</a> <i class="fa fa-angle-right"></i></li>
</ol>
<style>
	.ui-datepicker-month, .ui-datepicker-year
	{
		padding : 0px;
	}
	.table,#thead,tr,td,th
    {
        text-align: center;
        color: #000!important;
    }
</style>


<div style="padding: 10px; background-color: white;  border-top:3px solid #5785c3;">
	
		<div class='row'>
			<div class="col-md-12">
				<table class='table' border=1 id='example'>
					<thead >
					<tr >
						<th style='color:white !important;background-color:#0099cc;font-size:20px'>Class</th>
						<th style='color:white !important;background-color:#0099cc;font-size:20px'>Total Strength</th>
						<th style='color:white !important;background-color:#0099cc;font-size:20px'>Student Paid</th>
						<th style='color:white !important;background-color:#0099cc;font-size:20px'>Paid Amount</th>
						<th style='color:white !important;background-color:#0099cc;font-size:20px'>Unpaid Student</th>
						<th style='color:white !important;background-color:#0099cc;font-size:20px'>Due Amount</th>
					</tr></thead>
					<tbody>
					     <?php
						$total_stu=0;
						$cnt=0;
						$cnt_amt=0;
						$rest_stu=0;
						$rest_amt=0;
						foreach($result as $key=> $val){
					$total_stu +=$val->total_stu;
					$cnt +=$val->cnt;
	        		$cnt_amt +=$val->cnt*400;
					$rest_stu +=$val->total_stu - $val->cnt;
					$rest_amt +=($val->total_stu - $val->cnt)*400;
							?>
						<tr>
						<td><?php echo $val->DISP_CLASS;?></td>
						<td><?php echo $val->total_stu;?></td>
						<td><?php echo $val->cnt;?></td>
						<td><?php echo $val->cnt *400 ;?></td>
						<td><?php echo $val->total_stu - $val->cnt ;?></td>
						<td><?php echo( $val->total_stu - $val->cnt)*400 ;?></td>
						
						</tr>
						
						<?php
							}?>
					</tbody>
					<tfooter >
					<tr>
						<td style='color:white !important;background-color:#0099cc;font-size:20px'>Grand Total </td>
						<td style='color:white !important;background-color:#0099cc;font-size:20px'><?php echo $total_stu; ?></td>
						<td style='color:white !important;background-color:#0099cc;font-size:20px'><?php echo $cnt ;?></td>
						<td style='color:white !important;background-color:#0099cc;font-size:20px'><?php echo $cnt_amt;?></td>
						<td style='color:white !important;background-color:#0099cc;font-size:20px'><?php echo $rest_stu;?></td>
						<td style='color:white !important;background-color:#0099cc;font-size:20px'><?php echo $rest_amt;?></td>
					</tr>
					
					</tfooter>
					</table>
			
			</div>
		
	</div>
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
	$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    } );
} );
	</script>
