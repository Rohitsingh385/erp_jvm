<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Cross List</a> <i class="fa fa-angle-right"></i> </li>
</ol>
<!-- Content Wrapper. Contains page content -->
<div class='mainb' style="padding: 15px; background-color: white; border-top: 3px solid #5785c3;font-size: 12px;">
  <div class="row">
    <div class='col-sm-6'>
		<label>Class</label><br />
		<select class='form-control' id='clas' onchange='loadSec(this.value)'>
			<option value=''>Select</option>
			<option value='Nursery'>Nursery</option>
			<option value='Prep'>Prep</option>
			<option value='I'>I</option>
			<option value='II'>II</option>
			<option value='III'>III</option>
			<option value='IV'>IV</option>
			<option value='V'>V</option>
		</select>
    </div>
	
	 <div class='col-sm-6'>
		<label>Section</label><br />
		<select class='form-control' id='sec' onchange="loadCrossList()">
			<option value=''>Select</option>
		</select>
	 </div>
  </div><br />
  
  <div class='row'>
	<div class='col-sm-12' id='load'>
	</div>
  </div>
  
  
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <h1>Loading..!</h1>
        </div>
      </div>
    </div>
  </div>
  <!-- End Modal -->
  
</div><br />
	
<script type="text/javascript">
   function loadSec(clas){
	  $.ajax({
		  url: "<?php echo base_url('cross_list/JuniorCrossList/loadSec'); ?>",
		  type: "POST",
		  data: {clas:clas},
		  success: function(res){
			  $("#sec").html(res);
		  }
	  });
   }
   
   function loadCrossList(){
	   let clas = $("#clas").val();
	   let sec  = $("#sec").val();
	   $("#myModal").modal({backdrop: 'static', keyboard: false});
	   $.ajax({
		  url: "<?php echo base_url('cross_list/JuniorCrossList/loadCrossList'); ?>",
		  type: "POST",
		  data: {clas:clas,sec:sec},
		  success: function(res){
			  $("#myModal").modal('hide');
			  $("#load").html(res);
		  }
	  });
   }
</script>