<style type="text/css">
  .table>thead>tr>th,
  .table>tbody>tr>th,
  .table>tfoot>tr>th,
  .table>thead>tr>td,
  .table>tbody>tr>td,
  .table>tfoot>tr>td {
    color: black;
    padding: 5px !important;
  }

  .table>thead>tr>th,
  .table>tbody>tr>th,
  .table>tfoot>tr>th,
  .table>thead>tr>td,
  .table>tbody>tr>td,
  .table>tfoot>tr>td {
    white-space: nowrap !important;
    font-size: 12px;
  }

  i {
    color: white !important;
  }

  button.dt-button,
  div.dt-button,
  a.dt-button {
    line-height: 0.66em;
  }

  .dataTables_wrapper .dataTables_paginate .paginate_button.current,
  .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
    line-height: 0.66em;
  }

  .alert-danger {
    color: #721c24;
    background-color: #f8d7da;
    border-color: #f5c6cb;
  }

  .alert {
    position: relative;
    padding: .75rem 1.25rem;
    margin-bottom: 1rem;
    border: 1px solid transparent;
    border-radius: .25rem;
  }
</style>
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="#">Human Resource </a> <i class="fa fa-angle-right"></i> Employee</li>
</ol>
<!-- Content Wrapper. Contains page content -->
<div style="background-color: white;padding: 20px;border-top: 3px solid #5785c3;">
  <div class="row">
    <div class="col-sm-12">
      <div class="" style="padding-bottom: 20px;">
        <section class="content">
          <div class="box box-primary">
            <div class="row margin">
              <div class="col s12 m12 l12 center">
                <?php if ($this->session->flashdata('msg')) { ?>
                  <p class="alert alert-danger">
                    <?php echo $this->session->flashdata('msg'); ?>
                  </p>
                <?php } ?>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <a href="<?php echo base_url('employee/employee/create'); ?>" class="btn btn-black"><i class="fa fa-plus"></i> Add New Employee</a><br><br>

              <form method="POST" action="<?php echo base_url('employee/Employee'); ?>">
                <div class="row">
                  <div class="col-md-6">
                    <label>Gender</label>
                    <select name="selgender" id="selgender" class="form-control">
                      <option value="">Select</option>
                      <option value="1">Male</option>
                      <option value="2">Female</option>
                    </select>
                  </div>
                  <!-- <div class="col-md-6">
                  <label>Role</label>
                  <select name="selrole" id="selrole"  class="form-control" >
                    <option value="">Select</option>
                    <?php foreach ($roleList as $r) { ?>
                    <option value="<?php echo $r['ID']; ?>"><?php echo $r['NAME']; ?></option>
                    <?php } ?>
                  </select>
                </div> -->
                  <div class="col-md-6">
                    <label>Designation</label>
                    <select name="seldesignation" id="seldesignation" class="form-control">
                      <option value="">Select</option>
                      <?php foreach ($designation as $r) { ?>
                        <option value="<?php echo $r['Sno']; ?>"><?php echo $r['DESIG']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div><br>
                <div class="row">
                  <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">SHOW</button>
                  </div>
                </div>
              </form>
            </div>
            <br><br>
            <div class="table-responsive">
              <table class="table table-striped table-bordered dataTable">
                <thead>
                  <tr>
                    <th style="background: #337ab7; color: white !important;">Action</th>
                    <th style="background: #337ab7; color: white !important;">Employee ID</th>
                    <th style="background: #337ab7; color: white !important;">Name</th>
                    <th style="background: #337ab7; color: white !important;">Date of Joining</th>
                    <th style="background: #337ab7; color: white !important;">Date of Birth</th>
                    <th style="background: #337ab7; color: white !important;">Gender</th>
                    <th style="background: #337ab7; color: white !important;">Mobile</th>
                    <th style="background: #337ab7; color: white !important;">Role</th>
                    <th style="background: #337ab7; color: white !important;">Designation</th>
                    <th style="background: #337ab7; color: white !important;">Wing</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($employeeDetails as $key => $value) { ?>
                    <tr>
                      <td>
                        <a href="<?php echo base_url('employee/employee/view/') . $value['id']; ?>" class="btn-xs btn-black" data-toggle="tooltip" title="View Employee Details"><i class="fa fa-bars"></i></a> &nbsp; &nbsp;
                        <a href="<?php echo base_url('employee/employee/update/') . $value['id']; ?>" class="btn-xs btn-danger" data-toggle="tooltip" title="Edit Employee Details"><i class="fa fa-edit"></i></a> &nbsp; &nbsp;
                        <a href="<?php echo base_url('employee/payroll_details/update/') . $value['id']; ?>" class="btn-xs btn-success" data-toggle="tooltip" title="Edit Payroll Details" data-placement="left"><i class="fa fa-money"></i></a>
                      </td>
                      <td><?php echo $value['EMPID']; ?></td>
                      <td><?php echo $value['EMP_FNAME'] . ' ' . $value['EMP_MNAME'] . ' ' . $value['EMP_LNAME']; ?></td>
                      <td><?php echo date("d-M-Y", strtotime($value['D_O_J'])); ?></td>
                      <td><?php echo date("d-M-Y", strtotime($value['D_O_B'])); ?></td>
                      <td><?php echo $gender[$value['SEX']]; ?></td>
                      <td><?php echo $value['C_MOBILE']; ?></td>
                      <td><?php echo $value['Role_name']; ?></td>
                      <td><?php echo $value['DESIG']; ?></td>
                      <td><?php echo $value['wing_master_name']; ?></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>


            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </section>
      </div>
    </div>
  </div>
</div>
<br><br>
<br><br>
<script type="text/javascript">
  $(function() {
    $('.dataTable').DataTable({
      'paging': true,
      'lengthChange': true,
      'searching': true,
      'ordering': true,
      'info': true,
      'autoWidth': true,
      "pageLength": 50,
      dom: 'Bfrtip',
      buttons: [{
          extend: 'excelHtml5',
          title: 'Employee Report',

        },
        {
          extend: 'pdfHtml5',
          title: 'Employee Report',

        },
      ]
    })
  });

  $('.dataTable tbody').on('click', 'tr', function() {
    $(this).toggleClass('selected');
  });

  $(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
  });
</script>