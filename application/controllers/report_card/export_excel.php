<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Export_excel extends MY_controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Alam','alam');
		error_reporting(0);
	}
	
	public function index(){
		$data['getSec'] = $this->alam->selectA('temp_class_viii_rc','distinct(sec)');
		$this->render_template('report_card/excel_export/index',$data);
	}
	
	public function fetchData(){
		$class = $this->input->post('class');
		$sec   = $this->input->post('sec');
		
		$getData = $this->alam->selectA('temp_class_viii_rc','*',"class='$class' AND sec='$sec'");
		?>
			<table class='table' id='example'>
				<thead>
					<tr>
						<th style='background:#5785c3; color:#fff !important;'>Adm. No.</th>
						<th style='background:#5785c3; color:#fff !important;'>Class</th>
						<th style='background:#5785c3; color:#fff !important;'>Sec</th>
						<th style='background:#5785c3; color:#fff !important;'>Roll</th>
						<th style='background:#5785c3; color:#fff !important;'>Grand Total</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						foreach($getData as $key => $val){
							?>
								<tr>
									<td><?php echo $val['admno']; ?></td>
									<td><?php echo $val['class']; ?></td>
									<td><?php echo $val['sec']; ?></td>
									<td><?php echo $val['roll_no']; ?></td>
									<td><?php echo $val['tot']; ?></td>
								</tr>
							<?php
						}
					?>
				</tbody>
			</table>
			
			<script>
				$(document).ready(function() {
					$('#example').DataTable( {
						 dom: 'Bfrtip',
						 searching:false,
						 paging:false,
						 buttons: [
							{
								extend: 'excelHtml5',
								title: 'VIII-'+'<?php echo $sec; ?>'
							},
						 ]
					} );
				} );
			</script>
		<?php
	}
}