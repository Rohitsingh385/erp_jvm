<style>
  @-webkit-keyframes spin {
    0% {
      -webkit-transform: rotate(0deg);
    }

    100% {
      -webkit-transform: rotate(360deg);
    }
  }

  @keyframes spin {
    0% {
      transform: rotate(0deg);
    }

    100% {
      transform: rotate(360deg);
    }
  }
</style>

<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="index.html">Allocate Stoppage</a> <i class="fa fa-angle-right"></i></li>
</ol>

<div style="padding: 5px; background-color: white;  border-top:3px solid #5785c3;">
<div class="container">
	<?php
		if($this->session->flashdata('error')):
	 ?>
	<div class="row">
		    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 form-group alert alert-success" role="alert" id="error">
			  <strong><?php echo $this->session->flashdata('error'); ?></strong>
			</div> 
	</div>
		   <?php endif; ?>	  
  <form method="post" action="<?php echo base_url('student_transport/Bus_transport/show_student'); ?>">
    <div class="row">
      <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 form-group">
        <label>Admission Number</label>
        <input type="text" name="adm_no" id="adm_no" value="" placeholder="Admission Number" class="form-control">
      </div>

      <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 form-group">
        <br>
        <center>
          <button type="submit" class="btn btn-success">DISPLAY</button>
        </center>
      </div>
    </div>
  </form>
  </div>
  <div id="load_data" style="overflow:auto;">
    <!-- table  starts-->

    <br><br>

    <?php if (!empty($trans_report)) {
      $vehical_no = "";
    ?>
      <div class="container">
        <h3><span style="color:red;">In case of only one transport row, please allocate first then delete the previous one.</span></h3>
      </div>
      <br>
      <div class="container">
        <table class="table table-striped" id="example" style="width: 90%;">
          <thead>
            <tr>
              <!-- <th width="3%">SLNO</th>  -->
              <th>Adm Nu.</th>
              <th>Name</th>
              <th>Class/Sec</th>
              <th> Old<br>Stoppage</th>
              <th>New <br>Alloted</th>
              <th>From <br>Month</th>
              <th>To<br> Month</th>
              <th>Bus No</th>
              <th>Created By</th>
              <th>Created Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1;
            foreach ($trans_report as $p) {
              $st_nm_old = $this->stm->get_stoppage_name($p->OLD_STOPNO);
              $st_nm_new = $this->stm->get_stoppage_name($p->NEW_STOPNO);
              $cnm = $this->dbcon->select('login_details', '*', "user_id='$p->USER_ID'");
            ?>
              <tr>
                <!--  <td><?php //echo $i;
                          ?></td>    -->
                <td><?php echo strtoupper($p->ADM_NO); ?></td>
                <td><?php echo strtoupper($FIRST_NM); ?></td>
                <td><?php echo strtoupper($DISP_CLASS . '/' . $DISP_SEC); ?></td>
                <td><?php echo strtoupper($st_nm_old[0]->STOPPAGE); ?></td>
                <td><?php echo strtoupper($st_nm_new[0]->STOPPAGE); ?></td>
                <td><?php echo strtoupper($p->FROM_APPLICABLE_MONTH); ?></td>
                <td><?php echo strtoupper($p->TO_APPLICABLE_MONTH); ?></td>
                <td><?php echo strtoupper($p->BUS_NO); ?></td>
                <td><?php echo strtoupper($cnm[0]->emp_name); ?></td>
                <td><?php echo (date("d-m-Y", strtotime($p->CREATED_DATE))); ?></td>

                <td><button type="button" class="btn btn-danger" onclick="delFunction('<?php echo $p->ID; ?>','<?php echo $p->ADM_NO; ?>');">Delete</button></td>
              </tr>
            <?php $i++;
            } ?>
          </tbody>
        </table>
        <br><br>
        <?php $c = $CURR_MON . 'FEE';

        if ($c != 'N/A') { ?>
          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
            Allocate New Stoppage
          </button>
        <?php } ?>
      </div>
      <!-- end of table -->
    <?php } ?>
  </div>
</div><br>
<!-- The Modal -->
<form method="post" action="<?php echo base_url('student_transport/Bus_transport/allocate_stopage'); ?>">
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Bus Stoppage</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="row">
            <div class="col-md-3">
              <CENTER>MONTH</CENTER>
            </div>
            <div class="col-md-6">
              <select class='form-control' name='mon_list' id="mon_list">
                <option value="none" selected="selected">Choose Month</option>
                <option value="04">APR</option>
                <option value="05">MAY</option>
                <option value="06">JUN</option>
                <option value="07">JUL</option>
                <option value="08">AUG</option>
                <option value="09">SEP</option>
                <option value="10">OCT</option>
                <option value="11">NOV</option>
                <option value="12">DEC</option>
                <option value="01">JAN</option>
                <option value="02">FEB</option>
                <option value="03">MAR</option>

              </select>

            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <CENTER>BUS NO</CENTER>
            </div>
            <div class="col-md-6">

            </div>
            <input type="hidden" name="adm_no" id="adm_no" value="<?php echo $adm_no; ?>" class="form-control">
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6 form-group">

              <select class="form-control" name="busno" id="busno">
                <option value="none">Select Stoppage</option>

                <?php
                if ($busno) {

                  foreach ($busno as $p) {
                ?>
                    <option value="<?php echo $p->BusCode; ?>"><?php echo $p->BusNo; ?></option>
                <?php
                  }
                }
                ?>
              </select>
            </div>

          </div>
			
			<!-- trip -->
						<div class="row">
							<div class="col-md-3">
								<CENTER>Select Trip</CENTER>
							</div>
							<div class="col-md-6">

							</div>
							<div class="col-md-6 col-sm-6 col-lg-6 col-xl-6 form-group">

								<select class="form-control" name="trip" id="trip" onchange="selectStoppage(this.value)">
									<option value="none">Select Trip</option>
									<option value="1">Senior</option>
									<option value="2">Junior</option>
									<option value="3">General</option>
								</select>
							</div>

						</div>
          <div class="row">
            <div class="col-md-3">
              <CENTER>STOPPAGE</CENTER>
            </div>
            <div class="col-md-6">

            </div>
            <input type="hidden" name="adm_no" id="adm_no" value="<?php echo $adm_no; ?>" class="form-control">
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6 form-group">

              <select class="form-control" name="selstoppage" id="selstoppage">
                <option value="none">Select Stoppage</option>
              </select>
            </div>

          </div>
          <br />

        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Submit</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>
</form>
<script type="text/javascript">
  $('#form_id').on('submit', function(event) {
    var adm_no = $('#adm_no').val();
    $.ajax({
      url: '<?php echo base_url('student_transport/Bus_transport/show_student'); ?>',
      type: "POST",
      data: $('#form_id').serialize(),
      success: function(data) {
        alert(url);
        $("#load_page").html(data);

      },
    });
  });

  function selectStoppage(val) {
	  var busno = $("#busno").val();
    $.ajax({
      url: '<?php echo base_url('student_transport/Bus_transport/selectStoppage') ?>',
      type: "POST",
      data: {
        val: val,
		  busno: busno
      },

      success: function(data) {
        $("#selstoppage").html(data);
      },

    })
  }

  $(document).ready(function() {
    $('#example').dataTable({
      "scrollX": true
    });

  });

  function delFunction(id, adm_no) {

    if (confirm("Do You want to Delete this Record")) {
      // document.write(id,adm_no );
      $.ajax({
        url: "<?php echo base_url('student_transport/Bus_transport/del_transport') ?>",
        type: 'POST',
        data: {
          'id': id,
          "adm_no": adm_no
        },
        success: function(data) {
          // document.write(data);
          // alert(data);
          data = data.trim();
          if (data == '1') {
            alert("Please allocate first to delete, in case of only one record.");
          } else if (data == '2') {
            alert("You can not delete this record.")
          } else if (data == '3') {
            alert("Record Deleted Successfully.");
            window.location = "<?php echo base_url('student_transport/Bus_transport'); ?>";
          } else if (data == '4') {
            alert("Deletion Problem, Contact ADMIN.");
          }
        }
      });
    }
  }
</script>