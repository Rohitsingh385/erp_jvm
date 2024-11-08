<br>
<style type="text/css">
  .thead-color{
   background: #bac9e2 !important;
  }
	 button.dt-button, div.dt-button, a.dt-button {
	  padding:2px;
  }
  .dataTables_paginate .paginate_button.current {
	 padding:2px;  
  }
</style>
  <div class="employee-dashboard">
    <?php 

	
	if(isset($employeeList)) { ?>
      <div class="row"> 
          <div class="col-sm-12">
            <div class="panel panel-default" style="background: #3278ab !important;color: white;font-size: 13px">
              <div class="panel-heading"><i class="fa fa-edit"></i> Arrear Bulk Updation</div>
			    <br/>
			  <form action="" method='POST'>
			     
                      <div class="row">
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Month</label><span class="req"> *</span>
                            <input type="text" name="month_year" class="form-control datepicker" id="date" autocomplete="off" required="" value="<?php echo set_value('month_year'); ?>">
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label></label>
                            <button type="submit" class="btn btn-success form-control search_btn" name="display" onclick="processingFun()"><i class="fa fa-eye"></i> Display</button>
                          </div>
                        </div>
                      </div>
                 
			   </form>
              <div class="table-responsive" style="background: white !important;border:1px solid #3278ab;color: white;">
                  <table class='table table-bordered table-striped dataTable'>
                    <thead>
                      <tr>
                        <th class="thead-color text-center">Employee ID</th>
                        <th class="thead-color text-center">Name</th>
						<th class="thead-color text-center">ARREAR BASIC</th>
						  <th class="thead-color text-center">ARREAR DA</th>
						  <th class="thead-color text-center">ARREAR HRA</th>
						  <th class="thead-color text-center">ARREAR TA</th>
						  <th class="thead-color text-center">ARREAR FIXED ALLOWANCE</th>
						  <th class="thead-color text-center">ARREAR SHIFT ALLOWANCE</th>
						 </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($employeeList as $value) {
						  ?>
                        <tr>
                          <td class="text-center"><?php echo $value['EMPLOYEE_ID']; ?> </td>
                          <td class="text-center"><?php echo $value['EMP_NAME']; ?></td>
						  <td class="text-center contenteditable" contenteditable="true" onblur="updateDeduction('ARREAR_BASIC',<?php echo $value['EMPLOYEE_ID']; ?>)" id="ARREAR_BASIC_<?php echo $value['EMPLOYEE_ID']; ?>"><?php echo $value['ARREAR_BASIC']; ?></td>
					
						 <td class="text-center contenteditable" contenteditable="true"  onblur="updateDeduction('ARREAR_DA',<?php echo $value['EMPLOYEE_ID']; ?>)" id="ARREAR_DA_<?php echo $value['EMPLOYEE_ID']; ?>"><?php echo $value['ARREAR_DA']; ?></td>
							
						  
                         
						  	
						   <td class="text-center contenteditable" contenteditable="true"  onblur="updateDeduction('ARREAR_HRA',<?php echo $value['EMPLOYEE_ID']; ?>)" id="ARREAR_HRA_<?php echo $value['EMPLOYEE_ID']; ?>"><?php echo $value['ARREAR_HRA']; ?></td>
							
						  
                       
						 
					     <td class="text-center contenteditable" contenteditable="true"  onblur="updateDeduction('ARREAR_TA',<?php echo $value['EMPLOYEE_ID']; ?>)" id="ARREAR_TA_<?php echo $value['EMPLOYEE_ID']; ?>"><?php echo $value['ARREAR_TA']; ?></td>
							
						  
                      
					   <td class="text-center contenteditable" contenteditable="true"  onblur="updateDeduction('ARREAR_FIXED_ALLOW',<?php echo $value['EMPLOYEE_ID']; ?>)" id="ARREAR_FIXED_ALLOW_<?php echo $value['EMPLOYEE_ID']; ?>"><?php echo $value['ARREAR_FIXED_ALLOW']; ?></td>
							
						  
                           
					 <td class="text-center contenteditable" contenteditable="true"  onblur="updateDeduction('ARREAR_SHIFT_ALLOW',<?php echo $value['EMPLOYEE_ID']; ?>)" id="ARREAR_SHIFT_ALLOW_<?php echo $value['EMPLOYEE_ID']; ?>"><?php echo $value['ARREAR_SHIFT_ALLOW']; ?></td>
							
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
<?php 
$time=strtotime($month_year);
		$month=date("m",$time);
		$year=date("Y",$time);
?>
<script type="text/javascript">
	 var month_year="<?php echo $month_year;?>";
		 
	
		 var month="<?php echo $month;?>";
		    month = parseInt(month);
		 var year="<?php echo $year;?>";
		if(month !="<?php echo $current_month;?>" || year !="<?php echo $current_year;?>"){
			$('.contenteditable').attr("contenteditable",false);
			
		}
	
     $(function () {
    $('.dataTable').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : false,
      'autoWidth'   : true,
		dom: 'Bfrtip',
		
		buttons: [
			{
				extend: 'excelHtml5',
				title: 'Student Details',
			},
			{
				extend: 'pdfHtml5',
				title: 'Student Details',
			},
		]
    })
  });

     $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
      });

     $(".contenteditable").keypress(function(e) {
          if ((e.which < 48 || e.which > 57) && (e.which != 46)) e.preventDefault();
      });

     function updateDeduction(column_name,emp_id)
     {
		 
        var cell_value = $('#'+column_name+'_'+emp_id).text();
        var month_year="<?php echo $month_year;?>";
		 
		 var month="<?php echo $month;?>";
		 var month=parseInt(month);
		 var year="<?php echo $year;?>";
		if(month=="<?php echo $current_month;?>" && year=="<?php echo $current_year;?>"){
		 $.ajax({
          url:'<?php echo base_url('bulk_updation/Arrear_bulk/updateDeduction_both'); ?>',
          data:{column_name:column_name,emp_id:emp_id,cell_value:cell_value,month_year:month_year},
          method:"post",
          dataType:"json",
          success:function()
          {
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
		 
     }
	
	var st_date = '<?php echo $current_year.'-'.$current_month.'-1'; ?>';
var end_dt = '<?php echo $current_year.'-'.$current_month.'-'.$total_days; ?>';
var startDate = new Date(st_date);
var endDate = new Date(end_dt);
$(".datepicker").datepicker({
 format: 'M-yyyy',
    autoclose: true,
    startView: "months", 
    minViewMode: "months"
   //startDate: startDate,
  // endDate: endDate
});
  </script>