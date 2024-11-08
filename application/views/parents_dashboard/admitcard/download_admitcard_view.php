<style>
label{
	font-size:12px;
	font-weight: bold !important;
}
table{
	padding-right:20px;
}
button.dt-button, div.dt-button, a.dt-button {
	line-height:0.66em;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
	line-height:0.66em;
}
.table > thead > tr > th,
.table > tbody > tr > th,
.table > tfoot > tr > th,
.table > thead > tr > td,
.table > tbody > tr > td,
.table > tfoot > tr > td {
    white-space: nowrap !important;
 }
 

</style>
  <div class="content-wrapper">
   <section class="content">
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Download Admit Card</a> <i class="fa fa-angle-right"></i></li>
</ol>
<div class="row">
<?php if($status->sts=='1'){
echo form_open('parent_dashboard/admitcard/Download_admitcard/download_pdf');
echo form_hidden('adm', $status->AdmNo);
echo form_hidden('class_code', $status->CLASS);
echo form_hidden('sec_code', $status->SEC);
?>
<center>
<input type="submit" class="btn btn-primary" value="Download Admit Card">
 </center>
 <?php echo form_close(); ?>	


<?php } else { ?>
	<div class="alert alert-danger" role="alert">
  <h4 class="alert-heading">Attention!</h4>
  <p>You do not have permission to download Admit card.</p>
  <hr>
  <p class="mb-0">Please Contact Exam In-Charge/Class Teacher/Section In-Charge.</p>
</div>

<?php } ?>	
</div>


</div>
</section>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>