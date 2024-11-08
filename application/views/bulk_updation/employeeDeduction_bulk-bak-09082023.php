<br>
<style type="text/css">
  .thead-color{
   background: #bac9e2 !important;
  }
</style>
  <div class="employee-dashboard">
    <?php if(isset($employeeList)) { ?>
      <div class="row"> 
          <div class="col-sm-12">
            <div class="panel panel-default" style="background: #3278ab !important;color: white;font-size: 13px">
              <div class="panel-heading"><i class="fa fa-edit"></i> Employee Payroll Deduction Bulk Updation</div>
			    <br/>
			  <form action="" method='POST'>
			    <div class="row"> 
			  <div class="col-sm-6">
			<select  clASS='form-control' style='margin-left:10px' name='type'required>
			  <option value=''><?php if($type==""){?>--Select---<?php }else{ echo $type;}?></option>
			  <option value='VPF'>VPF</option>
			  <option value='Prof. Tax'>Prof. Tax</option>
			  <option value='Medical'>Medical</option>
			  <option value='TDS'>TDS</option>
			  <option value='House Rent'>House Rent</option>
			  <option value='Elect'>Elect</option>
			  <option value='Security'>Security</option>
			  <option value='Garage'>Garage</option>
				<option value='Staff Welfare Fund'>Staff Welfare Fund</option>
				<option value='Espal Library'>Espal Library</option>
				<option value='Bus Facility'>Bus Facility</option>
				<option value='Other Deduction'>Other Deduction</option>
			
			  </select>
			   
			  </div>
			   <div class="col-sm-6">
			   <input type='submit' class='btn btn-success' value='Display'>
			   </div>
			   <br/>
			   <br/>
			   <br/>
			  
			   </div>
			   </form>
              <div class="table-responsive" style="background: white !important;border:1px solid #3278ab;color: white;">
                  <table class='table table-bordered table-striped dataTable'>
                    <thead>
                      <tr>
                        <th class="thead-color text-center">Employee ID</th>
                        <th class="thead-color text-center">Name</th>
						
							<?php if($type!=""){
							
						?>
							<th class="thead-color text-center"><?php echo $type;?> </th>
							<?php	
						}?>
						
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($employeeList as $key => $value) { ?>
                        <tr>
                          <td class="text-center"><?php echo filter_var($value['EMPID'], FILTER_SANITIZE_NUMBER_INT); ?></td>
                          <td class="text-center"><?php echo $value['EMP_FNAME'] . ' ' .$value['EMP_MNAME'].' ' .$value['EMP_LNAME'] ; ?></td>
						  
						  	  <?php if($type=='VPF'){?>
							<td class="text-center contenteditable" contenteditable="true" onblur="updateDeduction('VPF',<?php echo $value['id']; ?>)" id="VPF_<?php echo $value['id']; ?>"><?php echo $value['VPF']; ?></td>
							  <?php
						  }?>
						  
						  <?php if($type=='Prof. Tax'){?>
						 <td class="text-center contenteditable" contenteditable="true"  onblur="updateDeduction('PROF_TAX',<?php echo $value['id']; ?>)" id="PROF_TAX_<?php echo $value['id']; ?>"><?php echo $value['PROF_TAX']; ?></td>
							  <?php
						  }?>
						  
                         
						  	  <?php if($type=='Medical'){?>
						   <td class="text-center contenteditable" contenteditable="true"  onblur="updateDeduction('MEDICAL_DEDUCT',<?php echo $value['id']; ?>)" id="MEDICAL_DEDUCT_<?php echo $value['id']; ?>"><?php echo $value['MEDICAL_DEDUCT']; ?></td>
							  <?php
						  }?>
						  
                       
						    <?php if($type=='TDS'){?>
					     <td class="text-center contenteditable" contenteditable="true"  onblur="updateDeduction('TDS',<?php echo $value['id']; ?>)" id="TDS_<?php echo $value['id']; ?>"><?php echo $value['tds']; ?></td>
							  <?php
						  }?>
						  
                      <?php if($type=='House Rent'){?>
					   <td class="text-center contenteditable" contenteditable="true"  onblur="updateDeduction('HRA_RENT',<?php echo $value['id']; ?>)" id="HRA_RENT_<?php echo $value['id']; ?>"><?php echo $value['HRA_RENT']; ?></td>
							  <?php
						  }?>
						  
						  
                           <?php if($type=='Elect'){?>
					 <td class="text-center contenteditable" contenteditable="true"  onblur="updateDeduction('HRA_ELECT',<?php echo $value['id']; ?>)" id="HRA_ELECT_<?php echo $value['id']; ?>"><?php echo $value['HRA_ELECT']; ?></td>
							  <?php
						  }?>
						  
						  
                           <?php if($type=='Security'){?>
				      <td class="text-center contenteditable" contenteditable="true"  onblur="updateDeduction('HRA_SECURITY',<?php echo $value['id']; ?>)" id="HRA_SECURITY_<?php echo $value['id']; ?>"><?php echo $value['HRA_SECURITY']; ?></td>
							  <?php
						  }?>
						
                       <?php if($type=='Garage'){?>
				      <td class="text-center contenteditable" contenteditable="true"  onblur="updateDeduction('HRA_GARAGE',<?php echo $value['id']; ?>)" id="HRA_GARAGE_<?php echo $value['id']; ?>"><?php echo $value['HRA_GARAGE']; ?></td>
							  <?php
						  }?>
						  
						    <?php if($type=='Staff Welfare Fund'){?>
				      <td class="text-center contenteditable" contenteditable="true"  onblur="updateDeduction('SWF',<?php echo $value['id']; ?>)" id="SWF_<?php echo $value['id']; ?>"><?php echo $value['SWF']; ?></td>
							  <?php
						  }?>
							
                          <?php if($type=='Espal Library'){?>
				      <td class="text-center contenteditable" contenteditable="true"  onblur="updateDeduction('ESPAL_LIB',<?php echo $value['id']; ?>)" id="ESPAL_LIB_<?php echo $value['id']; ?>"><?php echo $value['ESPAL_LIB']; ?></td>
							  <?php
						  }?>
							       <?php if($type=='Bus Facility'){?>
				      <td class="text-center contenteditable" contenteditable="true"  onblur="updateDeduction('BUS_FACILITY',<?php echo $value['id']; ?>)" id="BUS_FACILITY_<?php echo $value['id']; ?>"><?php echo $value['BUS_FACILITY']; ?></td>
							  <?php
						  }?>
                          <?php if($type=='Other Deduction'){?>
				      <td class="text-center contenteditable" contenteditable="true"  onblur="updateDeduction('OTHER_DETUCTION',<?php echo $value['id']; ?>)" id="OTHER_DETUCTION_<?php echo $value['id']; ?>"><?php echo $value['OTHER_DETUCTION']; ?></td>
							  <?php
						  }?>
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
     $(function () {
    $('.dataTable').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : false,
      'autoWidth'   : true,
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
        
        $.ajax({
          url:'<?php echo base_url('bulk_updation/employeededuction/updateDeduction'); ?>',
          data:{column_name:column_name,emp_id:emp_id,cell_value:cell_value},
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
  </script>