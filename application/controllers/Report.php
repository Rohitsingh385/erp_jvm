<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends MY_Controller{
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	    $this->load->model('Mymodel','dbcon');
		
	}
	public function typeofreports(){
		$this->fee_template('Reports/reports');
	}
	public function daily_monthlycollecion()
	{
		$user_id = $this->dbcon->select('daycoll','DISTINCT(User_Id)');
		for($i=1;$i<=25;$i++)
		{
			$feehead[$i] = $this->dbcon->select('feehead','*',"ACT_CODE='$i'");
		}
		$data = array(
			'user_id' => $user_id,
			'feehead1' => $feehead[1],
			'feehead2' => $feehead[2],
			'feehead3' => $feehead[3],
			'feehead4' => $feehead[4],
			'feehead5' => $feehead[5],
			'feehead6' => $feehead[6],
			'feehead7' => $feehead[7],
			'feehead8' => $feehead[8],
			'feehead9' => $feehead[9],
			'feehead10' => $feehead[10],
			'feehead11' => $feehead[11],
			'feehead12' => $feehead[12],
			'feehead13' => $feehead[13],
			'feehead14' => $feehead[14],
			'feehead15' => $feehead[15],
			'feehead16' => $feehead[16],
			'feehead17' => $feehead[17],
			'feehead18' => $feehead[18],
			'feehead19' => $feehead[19],
			'feehead20' => $feehead[20],
			'feehead21' => $feehead[21],
			'feehead22' => $feehead[22],
			'feehead23' => $feehead[23],
			'feehead24' => $feehead[24],
			'feehead25' => $feehead[25]
		);
		$this->fee_template('Reports/daily_monthlycollecion',$data);
	}
	
	public function classwise_comp(){

		$query="select count(DISP_CLASS)cnt,DISP_CLASS from student as paid_st where MAR_ATT !='0' AND CLASS IN ('6','7','8','9','10','11','12') GROUP BY DISP_CLASS";
		$payed_student = $this->db->query($query)->result();
		foreach ($payed_student as $key => $vll){
			$class=$vll->DISP_CLASS;
		$total_class="select count(DISP_CLASS)cnt_total from student where  DISP_CLASS='$class' AND Student_Status='ACTIVE'";
			$total_class = $this->db->query($total_class)->result();
		$total_stu=$total_class[0]->cnt_total;
			$payed_student[$key]->total_stu =$total_stu;
		}
		$data=array('result'=>$payed_student);
		$this->fee_template('Reports/daily_monthlycollecion_comp_class',$data);
	}
		
	public function daily_monthlycollecion_comp()
	{ 
		$class = $this->dbcon->select('daycoll','DISTINCT(CLASS)');
		$SEC = $this->dbcon->select('daycoll','DISTINCT(SEC)');
		
		$user_id = $this->dbcon->select('daycoll','DISTINCT(User_Id)');
		for($i=1;$i<=25;$i++)
		{
			$feehead[$i] = $this->dbcon->select('feehead','*',"ACT_CODE='$i'");
		}
		$data = array(
			 'class' =>$class,
			'SEC' =>$SEC,
			'user_id' => $user_id,
			'feehead1' => $feehead[1],
			'feehead2' => $feehead[2],
			'feehead3' => $feehead[3],
			'feehead4' => $feehead[4],
			'feehead5' => $feehead[5],
			'feehead6' => $feehead[6],
			'feehead7' => $feehead[7],
			'feehead8' => $feehead[8],
			'feehead9' => $feehead[9],
			'feehead10' => $feehead[10],
			'feehead11' => $feehead[11],
			'feehead12' => $feehead[12],
			'feehead13' => $feehead[13],
			'feehead14' => $feehead[14],
			'feehead15' => $feehead[15],
			'feehead16' => $feehead[16],
			'feehead17' => $feehead[17],
			'feehead18' => $feehead[18],
			'feehead19' => $feehead[19],
			'feehead20' => $feehead[20],
			'feehead21' => $feehead[21],
			'feehead22' => $feehead[22],
			'feehead23' => $feehead[23],
			'feehead24' => $feehead[24],
			'feehead25' => $feehead[25]
		);
		$this->fee_template('Reports/daily_monthlycollecion_comp',$data);
	}
	public function daily_monthlycollecion_comp_pp()
	{ 
		$class = $this->dbcon->select('student','DISTINCT(DISP_CLASS)CLASS',"CLASS in ('6','7','8','9','10','11','12')");
		$SEC = $this->dbcon->select('student','DISTINCT(DISP_SEC) SEC',"CLASS in ('6','7','8','9','10','11','12')");
		
		
		$data = array(
			 'class' =>$class,
			'SEC' =>$SEC,
			
		);
		$this->fee_template('Reports/daily_monthlycollecion_comp_pp',$data);
	}
	public function cmp_classwise(){
	$class			  = $this->input->post('class');
	$SEC			  = $this->input->post('SEC');
	$p_type			  = $this->input->post('p_type');
		if($class=='All'){
		$class='';
		}else{
		$class="AND student.DISP_CLASS='$class'";
		}
		if($SEC=='All'){
		$SEC='';
		}else{
		$SEC="AND student.DISP_SEC='$SEC'";
		}
		if($p_type=='All'){
		$p_type='';
		}else if($p_type =='PAID'){
		$p_type="AND student.MAR_ATT !='0'";
		}else{
		$p_type="AND student.MAR_ATT ='0'";
		}
		
		$query="select student.DISP_CLASS,student.DISP_SEC,student.ROLL_NO,student.FIRST_NM,student.ADM_NO,daycoll.RECT_NO,daycoll.RECT_DATE,daycoll.CHQ_NO from student LEFT JOIN daycoll on student.MAR_ATT=daycoll.RECT_NO where student.CLASS in ('6','7','8','9','10','11','12') AND  student.Student_Status='ACTIVE' $class $SEC $p_type";
		$result=$this->db->query($query)->result_array();
	?>
<table style='width:100%' class='table' id='example'>
	<thead> <tr>
		<TH style='color:white !important'>S.NO.</TH>
		<TH style='color:white !important'>NAME</TH>
		<TH style='color:white !important'>ADM_NO</TH>
		<TH style='color:white !important'>ROLL NO</TH>
		<TH style='color:white !important'>CLASS</TH>
		<TH style='color:white !important'>SEC</TH>
		<TH style='color:white !important'>STATUS</TH>
		<TH style='color:white !important'>RECT NO</TH>
		<TH style='color:white !important'>RECT DATE</TH>
		<TH style='color:white !important'>TRANSACTION ID</TH>
	
	</tr></thead>
	<tbody>
	<?php  
		$sn=1;
		foreach($result as $key){
		$pp=($key['RECT_NO']=='')?"<b style='color:red'>UNPAID</b>":"<b style='color:green'>PAID</b>";
		$date_rct=($key['RECT_NO']!='')?date('d-M-Y',strtotime($key['RECT_DATE'])):"";
echo"<tr><td>".$sn."</td><td>".$key['FIRST_NM']."</td><td>".$key['ADM_NO']."</td><td>".$key['ROLL_NO']."</td><td>".$key['DISP_CLASS']."</td><td>".$key['DISP_SEC']."</td><td>".$pp."</td><td>".$key['RECT_NO']."</td><td>".$date_rct."</td><td>".$key['CHQ_NO']."</td></tr>";
		$sn++;	
	} ?>
	</tbody>
</table>
<script>
$(document).ready(function() {
    $('#example').DataTable({
        dom: 'Bfrtip',
        buttons: [
			/* {
                extend: 'copyHtml5',
				title: 'Daily Collection Reports',
               
            }, */
			{
                extend: 'excelHtml5',
				title: 'Computer Fee Report',
                
            },
			/* {
                extend: 'csvHtml5',
				title: 'Daily Collection Reports',
                
            }, */
			/* {
                extend: 'pdfHtml5',
				title: 'Daily Collection Reports',
                
            }, */
        ]
    });
 });
</script>
<?php
	
	}
	public function single_date_class()
	{
		$collectiontype    = $this->input->post('collectiontype');
		$feecollectiontype = $this->input->post('feecollectiontype');
		$collectioncounter = $this->input->post('collectioncounter');
		$single			   = $this->input->post('single');
		$class			   = $this->input->post('class');
		$SEC			   = $this->input->post('SEC');
		$cls="";
		if($class !="All"){
		$cls="AND CLASS='$class'";
		}
		$scs="";
		if($SEC !="All"){
		$scs="AND SEC='$SEC'";
		}
		
		
		$date_type=$single;
		for($i=1;$i<=25;$i++)
		{
			$feehead[$i] = $this->dbcon->select('feehead','*',"ACT_CODE='$i'");
		}
		
		if($feecollectiontype=='All')
		{
			$data1 = $this->dbcon->select('daycoll','*',"Collection_Mode=3 AND RECT_DATE='$date_type' $cls $scs");
			
			$array = array(
				'data1'     => $data1,
				'feehead1'  => $feehead[1],
				'feehead2'  => $feehead[2],
				'feehead3'  => $feehead[3],
				'feehead4'  => $feehead[4],
				'feehead5'  => $feehead[5],
				'feehead6'  => $feehead[6],
				'feehead7'  => $feehead[7],
				'feehead8'  => $feehead[8],
				'feehead9'  => $feehead[9],
				'feehead10' => $feehead[10],
				'feehead11' => $feehead[11],
				'feehead12' => $feehead[12],
				'feehead13' => $feehead[13],
				'feehead14' => $feehead[14],
				'feehead15' => $feehead[15],
				'feehead16' => $feehead[16],
				'feehead17' => $feehead[17],
				'feehead18' => $feehead[18],
				'feehead19' => $feehead[19],
				'feehead20' => $feehead[20],
				'feehead21' => $feehead[21],
				'feehead22' => $feehead[22],
				'feehead23' => $feehead[23],
				'feehead24' => $feehead[24],
				'feehead25' => $feehead[25]
			);
			$this->load->view('Reports/daily_collection_report_class',$array);
		}
		else if($feecollectiontype=='Monthly')
		{
			$data1 = $this->dbcon->select('daycoll','*',"ADM_NO!='NONE' && mid(period,1,4)!='MISL' && mid(period,1,3)!='PRE' && User_Id LIKE '$collectioncounter' && Collection_Mode='$collectiontype' && RECT_DATE='$date_type' $cls $scs");
			$array = array(
				'data1'     => $data1,
				'feehead1'  => $feehead[1],
				'feehead2'  => $feehead[2],
				'feehead3'  => $feehead[3],
				'feehead4'  => $feehead[4],
				'feehead5'  => $feehead[5],
				'feehead6'  => $feehead[6],
				'feehead7'  => $feehead[7],
				'feehead8'  => $feehead[8],
				'feehead9'  => $feehead[9],
				'feehead10' => $feehead[10],
				'feehead11' => $feehead[11],
				'feehead12' => $feehead[12],
				'feehead13' => $feehead[13],
				'feehead14' => $feehead[14],
				'feehead15' => $feehead[15],
				'feehead16' => $feehead[16],
				'feehead17' => $feehead[17],
				'feehead18' => $feehead[18],
				'feehead19' => $feehead[19],
				'feehead20' => $feehead[20],
				'feehead21' => $feehead[21],
				'feehead22' => $feehead[22],
				'feehead23' => $feehead[23],
				'feehead24' => $feehead[24],
				'feehead25' => $feehead[25]
			);
			$this->load->view('Reports/daily_collection_report_class',$array);
		}
		else if($feecollectiontype=='MISL')
		{
			$data1 = $this->dbcon->select('daycoll','*',"mid(period,1,4)='MISL' && User_Id LIKE '$collectioncounter' && Collection_Mode='$collectiontype' && RECT_DATE='$date_type' $cls $scs");
			$array = array(
				'data1'     => $data1,
				'feehead1'  => $feehead[1],
				'feehead2'  => $feehead[2],
				'feehead3'  => $feehead[3],
				'feehead4'  => $feehead[4],
				'feehead5'  => $feehead[5],
				'feehead6'  => $feehead[6],
				'feehead7'  => $feehead[7],
				'feehead8'  => $feehead[8],
				'feehead9'  => $feehead[9],
				'feehead10' => $feehead[10],
				'feehead11' => $feehead[11],
				'feehead12' => $feehead[12],
				'feehead13' => $feehead[13],
				'feehead14' => $feehead[14],
				'feehead15' => $feehead[15],
				'feehead16' => $feehead[16],
				'feehead17' => $feehead[17],
				'feehead18' => $feehead[18],
				'feehead19' => $feehead[19],
				'feehead20' => $feehead[20],
				'feehead21' => $feehead[21],
				'feehead22' => $feehead[22],
				'feehead23' => $feehead[23],
				'feehead24' => $feehead[24],
				'feehead25' => $feehead[25]
			);
			$this->load->view('Reports/daily_collection_report_class',$array);
		}
		else if($feecollectiontype=='NONE')
		{
			$data1 = $this->dbcon->select('daycoll','*',"ADM_NO='NONE' && User_Id LIKE '$collectioncounter' && Collection_Mode='$collectiontype' && RECT_DATE='$date_type' $cls $scs");
			$array = array(
				'data1'     => $data1,
				'feehead1'  => $feehead[1],
				'feehead2'  => $feehead[2],
				'feehead3'  => $feehead[3],
				'feehead4'  => $feehead[4],
				'feehead5'  => $feehead[5],
				'feehead6'  => $feehead[6],
				'feehead7'  => $feehead[7],
				'feehead8'  => $feehead[8],
				'feehead9'  => $feehead[9],
				'feehead10' => $feehead[10],
				'feehead11' => $feehead[11],
				'feehead12' => $feehead[12],
				'feehead13' => $feehead[13],
				'feehead14' => $feehead[14],
				'feehead15' => $feehead[15],
				'feehead16' => $feehead[16],
				'feehead17' => $feehead[17],
				'feehead18' => $feehead[18],
				'feehead19' => $feehead[19],
				'feehead20' => $feehead[20],
				'feehead21' => $feehead[21],
				'feehead22' => $feehead[22],
				'feehead23' => $feehead[23],
				'feehead24' => $feehead[24],
				'feehead25' => $feehead[25]
			);
			$this->load->view('Reports/daily_collection_report_class',$array);
		} 
		else
		{
			$data1 = "dada";
		}
	}
	public function single_date()
	{
		$collectiontype    = $this->input->post('collectiontype');
		$feecollectiontype = $this->input->post('feecollectiontype');
		$collectioncounter = $this->input->post('collectioncounter');
		$single			   = $this->input->post('single');
		$date_type=$single;
		for($i=1;$i<=25;$i++)
		{
			$feehead[$i] = $this->dbcon->select('feehead','*',"ACT_CODE='$i'");
		}
		
		if($feecollectiontype=='All')
		{
			$data1 = $this->dbcon->select('daycoll','*',"Collection_Mode=3 AND RECT_DATE='$date_type'");
			
			$array = array(
				'data1'     => $data1,
				'feehead1'  => $feehead[1],
				'feehead2'  => $feehead[2],
				'feehead3'  => $feehead[3],
				'feehead4'  => $feehead[4],
				'feehead5'  => $feehead[5],
				'feehead6'  => $feehead[6],
				'feehead7'  => $feehead[7],
				'feehead8'  => $feehead[8],
				'feehead9'  => $feehead[9],
				'feehead10' => $feehead[10],
				'feehead11' => $feehead[11],
				'feehead12' => $feehead[12],
				'feehead13' => $feehead[13],
				'feehead14' => $feehead[14],
				'feehead15' => $feehead[15],
				'feehead16' => $feehead[16],
				'feehead17' => $feehead[17],
				'feehead18' => $feehead[18],
				'feehead19' => $feehead[19],
				'feehead20' => $feehead[20],
				'feehead21' => $feehead[21],
				'feehead22' => $feehead[22],
				'feehead23' => $feehead[23],
				'feehead24' => $feehead[24],
				'feehead25' => $feehead[25]
			);
			$this->load->view('Reports/daily_collection_report',$array);
		}
		else if($feecollectiontype=='Monthly')
		{
			$data1 = $this->dbcon->select('daycoll','*',"ADM_NO!='NONE' && mid(period,1,4)!='MISL' && mid(period,1,3)!='PRE' && User_Id LIKE '$collectioncounter' && Collection_Mode='$collectiontype' && RECT_DATE='$date_type'");
			$array = array(
				'data1'     => $data1,
				'feehead1'  => $feehead[1],
				'feehead2'  => $feehead[2],
				'feehead3'  => $feehead[3],
				'feehead4'  => $feehead[4],
				'feehead5'  => $feehead[5],
				'feehead6'  => $feehead[6],
				'feehead7'  => $feehead[7],
				'feehead8'  => $feehead[8],
				'feehead9'  => $feehead[9],
				'feehead10' => $feehead[10],
				'feehead11' => $feehead[11],
				'feehead12' => $feehead[12],
				'feehead13' => $feehead[13],
				'feehead14' => $feehead[14],
				'feehead15' => $feehead[15],
				'feehead16' => $feehead[16],
				'feehead17' => $feehead[17],
				'feehead18' => $feehead[18],
				'feehead19' => $feehead[19],
				'feehead20' => $feehead[20],
				'feehead21' => $feehead[21],
				'feehead22' => $feehead[22],
				'feehead23' => $feehead[23],
				'feehead24' => $feehead[24],
				'feehead25' => $feehead[25]
			);
			$this->load->view('Reports/daily_collection_report',$array);
		}
		else if($feecollectiontype=='MISL')
		{
			$data1 = $this->dbcon->select('daycoll','*',"mid(period,1,4)='MISL' && User_Id LIKE '$collectioncounter' && Collection_Mode='$collectiontype' && RECT_DATE='$date_type'");
			$array = array(
				'data1'     => $data1,
				'feehead1'  => $feehead[1],
				'feehead2'  => $feehead[2],
				'feehead3'  => $feehead[3],
				'feehead4'  => $feehead[4],
				'feehead5'  => $feehead[5],
				'feehead6'  => $feehead[6],
				'feehead7'  => $feehead[7],
				'feehead8'  => $feehead[8],
				'feehead9'  => $feehead[9],
				'feehead10' => $feehead[10],
				'feehead11' => $feehead[11],
				'feehead12' => $feehead[12],
				'feehead13' => $feehead[13],
				'feehead14' => $feehead[14],
				'feehead15' => $feehead[15],
				'feehead16' => $feehead[16],
				'feehead17' => $feehead[17],
				'feehead18' => $feehead[18],
				'feehead19' => $feehead[19],
				'feehead20' => $feehead[20],
				'feehead21' => $feehead[21],
				'feehead22' => $feehead[22],
				'feehead23' => $feehead[23],
				'feehead24' => $feehead[24],
				'feehead25' => $feehead[25]
			);
			$this->load->view('Reports/daily_collection_report',$array);
		}
		else if($feecollectiontype=='NONE')
		{
			$data1 = $this->dbcon->select('daycoll','*',"ADM_NO='NONE' && User_Id LIKE '$collectioncounter' && Collection_Mode='$collectiontype' && RECT_DATE='$date_type'");
			$array = array(
				'data1'     => $data1,
				'feehead1'  => $feehead[1],
				'feehead2'  => $feehead[2],
				'feehead3'  => $feehead[3],
				'feehead4'  => $feehead[4],
				'feehead5'  => $feehead[5],
				'feehead6'  => $feehead[6],
				'feehead7'  => $feehead[7],
				'feehead8'  => $feehead[8],
				'feehead9'  => $feehead[9],
				'feehead10' => $feehead[10],
				'feehead11' => $feehead[11],
				'feehead12' => $feehead[12],
				'feehead13' => $feehead[13],
				'feehead14' => $feehead[14],
				'feehead15' => $feehead[15],
				'feehead16' => $feehead[16],
				'feehead17' => $feehead[17],
				'feehead18' => $feehead[18],
				'feehead19' => $feehead[19],
				'feehead20' => $feehead[20],
				'feehead21' => $feehead[21],
				'feehead22' => $feehead[22],
				'feehead23' => $feehead[23],
				'feehead24' => $feehead[24],
				'feehead25' => $feehead[25]
			);
			$this->load->view('Reports/daily_collection_report',$array);
		} 
		else
		{
			$data1 = "dada";
		}
	}
		public function mult_date_class()
	{
		
		$collectiontype = $this->input->post('collectiontype');
		$feecollectiontype = $this->input->post('feecollectiontype');
		$collectioncounter = $this->input->post('collectioncounter');
		$multiple_date1	   = $this->input->post('multiple_date1');
		$multiple_date2	   = $this->input->post('multiple_date2');
		$class			   = $this->input->post('class');
		$SEC			   = $this->input->post('SEC');
		$cls="";
		if($class !="All"){
		$cls="AND CLASS='$class'";
		}
		$scs="";
		if($SEC !="All"){
		$scs="AND SEC='$SEC'";
		}
		
	
		for($i=1;$i<=25;$i++)
		{
			$feehead[$i] = $this->dbcon->select('feehead','*',"ACT_CODE='$i'");
		}
		
		if($feecollectiontype=='All')
		{
			
			$data1 = $this->dbcon->select('daycoll','*',"Collection_Mode='3' $cls $scs AND RECT_DATE BETWEEN '$multiple_date1' AND '$multiple_date2'");

			$array = array(
				'data1'     => $data1,
				'feehead1'  => $feehead[1],
				'feehead2'  => $feehead[2],
				'feehead3'  => $feehead[3],
				'feehead4'  => $feehead[4],
				'feehead5'  => $feehead[5],
				'feehead6'  => $feehead[6],
				'feehead7'  => $feehead[7],
				'feehead8'  => $feehead[8],
				'feehead9'  => $feehead[9],
				'feehead10' => $feehead[10],
				'feehead11' => $feehead[11],
				'feehead12' => $feehead[12],
				'feehead13' => $feehead[13],
				'feehead14' => $feehead[14],
				'feehead15' => $feehead[15],
				'feehead16' => $feehead[16],
				'feehead17' => $feehead[17],
				'feehead18' => $feehead[18],
				'feehead19' => $feehead[19],
				'feehead20' => $feehead[20],
				'feehead21' => $feehead[21],
				'feehead22' => $feehead[22],
				'feehead23' => $feehead[23],
				'feehead24' => $feehead[24],
				'feehead25' => $feehead[25]
			);
			$this->load->view('Reports/daily_collection_report_class',$array);
		}
		else if($feecollectiontype=='Monthly')
		{
			$data1 = $this->dbcon->select('daycoll','*',"ADM_NO!='NONE' && mid(period,1,4)!='MISL' && mid(period,1,3)!='PRE' && User_Id LIKE '$collectioncounter' && Collection_Mode='$collectiontype' $cls $scs AND RECT_DATE BETWEEN '$multiple_date1' AND '$multiple_date2'");
			$array = array(
				'data1'     => $data1,
				'feehead1'  => $feehead[1],
				'feehead2'  => $feehead[2],
				'feehead3'  => $feehead[3],
				'feehead4'  => $feehead[4],
				'feehead5'  => $feehead[5],
				'feehead6'  => $feehead[6],
				'feehead7'  => $feehead[7],
				'feehead8'  => $feehead[8],
				'feehead9'  => $feehead[9],
				'feehead10' => $feehead[10],
				'feehead11' => $feehead[11],
				'feehead12' => $feehead[12],
				'feehead13' => $feehead[13],
				'feehead14' => $feehead[14],
				'feehead15' => $feehead[15],
				'feehead16' => $feehead[16],
				'feehead17' => $feehead[17],
				'feehead18' => $feehead[18],
				'feehead19' => $feehead[19],
				'feehead20' => $feehead[20],
				'feehead21' => $feehead[21],
				'feehead22' => $feehead[22],
				'feehead23' => $feehead[23],
				'feehead24' => $feehead[24],
				'feehead25' => $feehead[25]
			);
			$this->load->view('Reports/daily_collection_report_class',$array);
		}
		else if($feecollectiontype=='MISL')
		{
			$data1 = $this->dbcon->select('daycoll','*',"mid(period,1,4)='MISL' && User_Id LIKE '$collectioncounter' && Collection_Mode='$collectiontype' $cls $scs AND RECT_DATE BETWEEN '$multiple_date1' AND '$multiple_date2'");
			$array = array(
				'data1'     => $data1,
				'feehead1'  => $feehead[1],
				'feehead2'  => $feehead[2],
				'feehead3'  => $feehead[3],
				'feehead4'  => $feehead[4],
				'feehead5'  => $feehead[5],
				'feehead6'  => $feehead[6],
				'feehead7'  => $feehead[7],
				'feehead8'  => $feehead[8],
				'feehead9'  => $feehead[9],
				'feehead10' => $feehead[10],
				'feehead11' => $feehead[11],
				'feehead12' => $feehead[12],
				'feehead13' => $feehead[13],
				'feehead14' => $feehead[14],
				'feehead15' => $feehead[15],
				'feehead16' => $feehead[16],
				'feehead17' => $feehead[17],
				'feehead18' => $feehead[18],
				'feehead19' => $feehead[19],
				'feehead20' => $feehead[20],
				'feehead21' => $feehead[21],
				'feehead22' => $feehead[22],
				'feehead23' => $feehead[23],
				'feehead24' => $feehead[24],
				'feehead25' => $feehead[25]
			);
			$this->load->view('Reports/daily_collection_report_class',$array);
		}
		else if($feecollectiontype=='NONE')
		{
			$data1 = $this->dbcon->select('daycoll','*',"ADM_NO='NONE' && User_Id LIKE '$collectioncounter' && Collection_Mode='$collectiontype'  $cls $scs AND RECT_DATE BETWEEN '$multiple_date1' AND '$multiple_date2'");
			$array = array(
				'data1'     => $data1,
				'feehead1'  => $feehead[1],
				'feehead2'  => $feehead[2],
				'feehead3'  => $feehead[3],
				'feehead4'  => $feehead[4],
				'feehead5'  => $feehead[5],
				'feehead6'  => $feehead[6],
				'feehead7'  => $feehead[7],
				'feehead8'  => $feehead[8],
				'feehead9'  => $feehead[9],
				'feehead10' => $feehead[10],
				'feehead11' => $feehead[11],
				'feehead12' => $feehead[12],
				'feehead13' => $feehead[13],
				'feehead14' => $feehead[14],
				'feehead15' => $feehead[15],
				'feehead16' => $feehead[16],
				'feehead17' => $feehead[17],
				'feehead18' => $feehead[18],
				'feehead19' => $feehead[19],
				'feehead20' => $feehead[20],
				'feehead21' => $feehead[21],
				'feehead22' => $feehead[22],
				'feehead23' => $feehead[23],
				'feehead24' => $feehead[24],
				'feehead25' => $feehead[25]
			);
			$this->load->view('Reports/daily_collection_report_class',$array);
		} 
		else
		{
			$data1 = "dada";
		}
	}
	public function mult_date()
	{
		$collectiontype = $this->input->post('collectiontype');
		$feecollectiontype = $this->input->post('feecollectiontype');
		$collectioncounter = $this->input->post('collectioncounter');
		$multiple_date1	   = $this->input->post('multiple_date1');
		$multiple_date2	   = $this->input->post('multiple_date2');
		
		// Declare an empty array 
		$array_date = array(); 
		  
		// Use strtotime function 
		$Variable1 = strtotime($multiple_date1); 
		$Variable2 = strtotime($multiple_date2); 
		  
		// Use for loop to store dates into array 
		// 86400 sec = 24 hrs = 60*60*24 = 1 day 
		for ($currentDate = $Variable1; $currentDate <= $Variable2;  
										$currentDate += (86400)) { 
											  
		$Store = date('Y-m-d', $currentDate); 
		$array_date[] = $Store; 
		}
		$count_date = count($array_date);
		
		for($i=1;$i<=25;$i++)
		{
			$feehead[$i] = $this->dbcon->select('feehead','*',"ACT_CODE='$i'");
		}
		
		if($feecollectiontype=='All')
		{
			$data_array = array();
			for($i=0;$i<$count_date;$i++)
			{
				$data1 = $this->dbcon->selectSingleData('daycoll','DISTINCT(RECT_DATE)AS RECT_DATE, min(RECT_NO) AS RECT_NO_start, MAX(RECT_NO) AS RECT_NO_end, sum(TOTAL) AS TOTAL, sum(Fee1) AS Fee1, SUM(Fee2) AS Fee2, SUM(Fee3)Fee3, sum(Fee4)Fee4, sum(Fee5)Fee5, sum(Fee6)Fee6, sum(Fee7)Fee7, sum(Fee8)Fee8, sum(Fee9)Fee9, sum(Fee10)Fee10, sum(Fee11)Fee11, SUM(Fee12)Fee12, sum(Fee13)Fee13, SUM(Fee14)Fee14, SUM(Fee15)Fee15, sum(Fee16)Fee16, sum(Fee17)Fee17, sum(Fee18)Fee18, sum(Fee19)Fee19, sum(Fee20)Fee20, sum(Fee21)Fee21, sum(Fee22)Fee22, SUM(Fee23)Fee23, sum(Fee24)Fee24, SUM(Fee25)Fee25',"Collection_Mode=$collectiontype AND User_Id LIKE '$collectioncounter' AND RECT_DATE='$array_date[$i]'");
				$data_array[] = $data1;
			}
			
			$array = array(
				'data_array'=> $data_array,
				'feehead1'  => $feehead[1],
				'feehead2'  => $feehead[2],
				'feehead3'  => $feehead[3],
				'feehead4'  => $feehead[4],
				'feehead5'  => $feehead[5],
				'feehead6'  => $feehead[6],
				'feehead7'  => $feehead[7],
				'feehead8'  => $feehead[8],
				'feehead9'  => $feehead[9],
				'feehead10' => $feehead[10],
				'feehead11' => $feehead[11],
				'feehead12' => $feehead[12],
				'feehead13' => $feehead[13],
				'feehead14' => $feehead[14],
				'feehead15' => $feehead[15],
				'feehead16' => $feehead[16],
				'feehead17' => $feehead[17],
				'feehead18' => $feehead[18],
				'feehead19' => $feehead[19],
				'feehead20' => $feehead[20],
				'feehead21' => $feehead[21],
				'feehead22' => $feehead[22],
				'feehead23' => $feehead[23],
				'feehead24' => $feehead[24],
				'feehead25' => $feehead[25]
			);
			$this->load->view('Reports/monthly_collection_report',$array);
		}
		else if($feecollectiontype=='Monthly')
		{
			$data_array = array();
			for($i=0;$i<$count_date;$i++)
			{
				$data1 = $this->dbcon->selectSingleData('daycoll','DISTINCT(RECT_DATE)AS RECT_DATE, min(RECT_NO) AS RECT_NO_start, MAX(RECT_NO) AS RECT_NO_end, sum(TOTAL) AS TOTAL, sum(Fee1) AS Fee1, SUM(Fee2) AS Fee2, SUM(Fee3)Fee3, sum(Fee4)Fee4, sum(Fee5)Fee5, sum(Fee6)Fee6, sum(Fee7)Fee7, sum(Fee8)Fee8, sum(Fee9)Fee9, sum(Fee10)Fee10, sum(Fee11)Fee11, SUM(Fee12)Fee12, sum(Fee13)Fee13, SUM(Fee14)Fee14, SUM(Fee15)Fee15, sum(Fee16)Fee16, sum(Fee17)Fee17, sum(Fee18)Fee18, sum(Fee19)Fee19, sum(Fee20)Fee20, sum(Fee21)Fee21, sum(Fee22)Fee22, SUM(Fee23)Fee23, sum(Fee24)Fee24, SUM(Fee25)Fee25',"ADM_NO!='NONE' && mid(period,1,4)!='MISL' && mid(period,1,3)!='PRE' && User_Id LIKE '$collectioncounter' && Collection_Mode='$collectiontype' && RECT_DATE='$array_date[$i]'");
				$data_array[] = $data1;
			}
			
			$array = array(
				'data_array'=> $data_array,
				'feehead1'  => $feehead[1],
				'feehead2'  => $feehead[2],
				'feehead3'  => $feehead[3],
				'feehead4'  => $feehead[4],
				'feehead5'  => $feehead[5],
				'feehead6'  => $feehead[6],
				'feehead7'  => $feehead[7],
				'feehead8'  => $feehead[8],
				'feehead9'  => $feehead[9],
				'feehead10' => $feehead[10],
				'feehead11' => $feehead[11],
				'feehead12' => $feehead[12],
				'feehead13' => $feehead[13],
				'feehead14' => $feehead[14],
				'feehead15' => $feehead[15],
				'feehead16' => $feehead[16],
				'feehead17' => $feehead[17],
				'feehead18' => $feehead[18],
				'feehead19' => $feehead[19],
				'feehead20' => $feehead[20],
				'feehead21' => $feehead[21],
				'feehead22' => $feehead[22],
				'feehead23' => $feehead[23],
				'feehead24' => $feehead[24],
				'feehead25' => $feehead[25]
			);
			$this->load->view('Reports/monthly_collection_report',$array);
		}
		else if($feecollectiontype=='MISL')
		{
			$data_array = array();
			for($i=0;$i<$count_date;$i++)
			{
				$data1 = $this->dbcon->selectSingleData('daycoll','DISTINCT(RECT_DATE)AS RECT_DATE, min(RECT_NO) AS RECT_NO_start, MAX(RECT_NO) AS RECT_NO_end, sum(TOTAL) AS TOTAL, sum(Fee1) AS Fee1, SUM(Fee2) AS Fee2, SUM(Fee3)Fee3, sum(Fee4)Fee4, sum(Fee5)Fee5, sum(Fee6)Fee6, sum(Fee7)Fee7, sum(Fee8)Fee8, sum(Fee9)Fee9, sum(Fee10)Fee10, sum(Fee11)Fee11, SUM(Fee12)Fee12, sum(Fee13)Fee13, SUM(Fee14)Fee14, SUM(Fee15)Fee15, sum(Fee16)Fee16, sum(Fee17)Fee17, sum(Fee18)Fee18, sum(Fee19)Fee19, sum(Fee20)Fee20, sum(Fee21)Fee21, sum(Fee22)Fee22, SUM(Fee23)Fee23, sum(Fee24)Fee24, SUM(Fee25)Fee25',"mid(period,1,4)='MISL' && User_Id LIKE '$collectioncounter' && Collection_Mode='$collectiontype' && RECT_DATE='$array_date[$i]'");
				$data_array[] = $data1;
			}
			
			$array = array(
				'data_array'=> $data_array,
				'feehead1'  => $feehead[1],
				'feehead2'  => $feehead[2],
				'feehead3'  => $feehead[3],
				'feehead4'  => $feehead[4],
				'feehead5'  => $feehead[5],
				'feehead6'  => $feehead[6],
				'feehead7'  => $feehead[7],
				'feehead8'  => $feehead[8],
				'feehead9'  => $feehead[9],
				'feehead10' => $feehead[10],
				'feehead11' => $feehead[11],
				'feehead12' => $feehead[12],
				'feehead13' => $feehead[13],
				'feehead14' => $feehead[14],
				'feehead15' => $feehead[15],
				'feehead16' => $feehead[16],
				'feehead17' => $feehead[17],
				'feehead18' => $feehead[18],
				'feehead19' => $feehead[19],
				'feehead20' => $feehead[20],
				'feehead21' => $feehead[21],
				'feehead22' => $feehead[22],
				'feehead23' => $feehead[23],
				'feehead24' => $feehead[24],
				'feehead25' => $feehead[25]
			);
			$this->load->view('Reports/monthly_collection_report',$array);
		}
		else if($feecollectiontype=='NONE')
		{
			$data_array = array();
			for($i=0;$i<$count_date;$i++)
			{
				$data1 = $this->dbcon->selectSingleData('daycoll','DISTINCT(RECT_DATE)AS RECT_DATE, min(RECT_NO) AS RECT_NO_start, MAX(RECT_NO) AS RECT_NO_end, sum(TOTAL) AS TOTAL, sum(Fee1) AS Fee1, SUM(Fee2) AS Fee2, SUM(Fee3)Fee3, sum(Fee4)Fee4, sum(Fee5)Fee5, sum(Fee6)Fee6, sum(Fee7)Fee7, sum(Fee8)Fee8, sum(Fee9)Fee9, sum(Fee10)Fee10, sum(Fee11)Fee11, SUM(Fee12)Fee12, sum(Fee13)Fee13, SUM(Fee14)Fee14, SUM(Fee15)Fee15, sum(Fee16)Fee16, sum(Fee17)Fee17, sum(Fee18)Fee18, sum(Fee19)Fee19, sum(Fee20)Fee20, sum(Fee21)Fee21, sum(Fee22)Fee22, SUM(Fee23)Fee23, sum(Fee24)Fee24, SUM(Fee25)Fee25',"ADM_NO='NONE' && User_Id LIKE '$collectioncounter' && Collection_Mode='$collectiontype' && RECT_DATE='$array_date[$i]'");
				$data_array[] = $data1;
			}
			
			$array = array(
				'data_array'=> $data_array,
				'feehead1'  => $feehead[1],
				'feehead2'  => $feehead[2],
				'feehead3'  => $feehead[3],
				'feehead4'  => $feehead[4],
				'feehead5'  => $feehead[5],
				'feehead6'  => $feehead[6],
				'feehead7'  => $feehead[7],
				'feehead8'  => $feehead[8],
				'feehead9'  => $feehead[9],
				'feehead10' => $feehead[10],
				'feehead11' => $feehead[11],
				'feehead12' => $feehead[12],
				'feehead13' => $feehead[13],
				'feehead14' => $feehead[14],
				'feehead15' => $feehead[15],
				'feehead16' => $feehead[16],
				'feehead17' => $feehead[17],
				'feehead18' => $feehead[18],
				'feehead19' => $feehead[19],
				'feehead20' => $feehead[20],
				'feehead21' => $feehead[21],
				'feehead22' => $feehead[22],
				'feehead23' => $feehead[23],
				'feehead24' => $feehead[24],
				'feehead25' => $feehead[25]
			);
			$this->load->view('Reports/monthly_collection_report',$array);
		} 
		else
		{
			$data1 = "dada";
		}
	}
	// function calling for the genetating pdf //
	public function daily_report()
	{
		ini_set('display_errors',-1);
		$collectiontype    = $this->input->post('ct1');
		$feecollectiontype = $this->input->post('fct1');
		$collectioncounter = $this->input->post('cc1');
		$single			   = $this->input->post('sd1');
		$date_type=$single;
		for($i=1;$i<=25;$i++)
		{
			$feehead[$i] = $this->dbcon->select('feehead','*',"ACT_CODE='$i'");
		}
		$School_setting = $this->dbcon->select('school_setting','*');
		$session_master = $this->dbcon->select('session_master','*',"Active_Status=1");
		$account = $this->dbcon->select('accg','*');
		if($feecollectiontype=='All')
		{
			$data1 = $this->dbcon->select('daycoll','*',"Collection_Mode='$collectiontype' AND User_Id LIKE '$collectioncounter' AND RECT_DATE='$date_type'");
			
			$array = array(
				'data1'     => $data1,
				'feehead1'  => $feehead[1],
				'feehead2'  => $feehead[2],
				'feehead3'  => $feehead[3],
				'feehead4'  => $feehead[4],
				'feehead5'  => $feehead[5],
				'feehead6'  => $feehead[6],
				'feehead7'  => $feehead[7],
				'feehead8'  => $feehead[8],
				'feehead9'  => $feehead[9],
				'feehead10' => $feehead[10],
				'feehead11' => $feehead[11],
				'feehead12' => $feehead[12],
				'feehead13' => $feehead[13],
				'feehead14' => $feehead[14],
				'feehead15' => $feehead[15],
				'feehead16' => $feehead[16],
				'feehead17' => $feehead[17],
				'feehead18' => $feehead[18],
				'feehead19' => $feehead[19],
				'feehead20' => $feehead[20],
				'feehead21' => $feehead[21],
				'feehead22' => $feehead[22],
				'feehead23' => $feehead[23],
				'feehead24' => $feehead[24],
				'feehead25' => $feehead[25],
				'School_setting' => $School_setting,
				'feecollectiontype' => $feecollectiontype,
				'collectioncounter' => $collectioncounter,
				'account'	=> $account,
				'date_type' => $date_type
			);
			$this->load->view('Reports/daily_collection_pdf',$array);
			
			$html = $this->output->get_output();
			$this->load->library('pdf');
			$this->dompdf->loadHtml($html);
			$this->dompdf->set_option('isRemoteEnabled', true);
			$this->dompdf->setPaper('A3', 'landscape');
			$this->dompdf->render();
			$this->dompdf->stream("daily_all_report.pdf", array("Attachment"=>0));
			
			// $html = $this->output->get_output();
			// $this->load->library('pdf');
			// $this->dompdf->loadHtml($html);
			// $this->dompdf->setPaper('A3', 'landscape');
			// $this->dompdf->render();
			// $this->dompdf->stream("daily_all_report.pdf", array("Attachment"=>0));
			
		}
		else if($feecollectiontype=='Monthly')
		{
			$data1 = $this->dbcon->select('daycoll','*',"ADM_NO!='NONE' && mid(period,1,4)!='MISL' && mid(period,1,3)!='PRE' && User_Id LIKE '$collectioncounter' && Collection_Mode='$collectiontype' && RECT_DATE='$date_type'");
			$array = array(
				'data1'     => $data1,
				'feehead1'  => $feehead[1],
				'feehead2'  => $feehead[2],
				'feehead3'  => $feehead[3],
				'feehead4'  => $feehead[4],
				'feehead5'  => $feehead[5],
				'feehead6'  => $feehead[6],
				'feehead7'  => $feehead[7],
				'feehead8'  => $feehead[8],
				'feehead9'  => $feehead[9],
				'feehead10' => $feehead[10],
				'feehead11' => $feehead[11],
				'feehead12' => $feehead[12],
				'feehead13' => $feehead[13],
				'feehead14' => $feehead[14],
				'feehead15' => $feehead[15],
				'feehead16' => $feehead[16],
				'feehead17' => $feehead[17],
				'feehead18' => $feehead[18],
				'feehead19' => $feehead[19],
				'feehead20' => $feehead[20],
				'feehead21' => $feehead[21],
				'feehead22' => $feehead[22],
				'feehead23' => $feehead[23],
				'feehead24' => $feehead[24],
				'feehead25' => $feehead[25],
				'School_setting' => $School_setting,
				'feecollectiontype' => $feecollectiontype,
				'collectioncounter' => $collectioncounter,
				'account'	=> $account,
				'date_type' => $date_type
			);
			$this->load->view('Reports/daily_collection_pdf',$array);
			
			$html = $this->output->get_output();
			$this->load->library('pdf');
			$this->dompdf->loadHtml($html);
			$this->dompdf->setPaper('A3', 'landscape');
			$this->dompdf->render();
			$this->dompdf->stream("Daily_Monthly.pdf", array("Attachment"=>0));
			
		}
		else if($feecollectiontype=='MISL')
		{
			$data1 = $this->dbcon->select('daycoll','*',"mid(period,1,4)='MISL' && User_Id LIKE '$collectioncounter' && Collection_Mode='$collectiontype' && RECT_DATE='$date_type'");
			$array = array(
				'data1'     => $data1,
				'feehead1'  => $feehead[1],
				'feehead2'  => $feehead[2],
				'feehead3'  => $feehead[3],
				'feehead4'  => $feehead[4],
				'feehead5'  => $feehead[5],
				'feehead6'  => $feehead[6],
				'feehead7'  => $feehead[7],
				'feehead8'  => $feehead[8],
				'feehead9'  => $feehead[9],
				'feehead10' => $feehead[10],
				'feehead11' => $feehead[11],
				'feehead12' => $feehead[12],
				'feehead13' => $feehead[13],
				'feehead14' => $feehead[14],
				'feehead15' => $feehead[15],
				'feehead16' => $feehead[16],
				'feehead17' => $feehead[17],
				'feehead18' => $feehead[18],
				'feehead19' => $feehead[19],
				'feehead20' => $feehead[20],
				'feehead21' => $feehead[21],
				'feehead22' => $feehead[22],
				'feehead23' => $feehead[23],
				'feehead24' => $feehead[24],
				'feehead25' => $feehead[25],
				'School_setting' => $School_setting,
				'feecollectiontype' => $feecollectiontype,
				'collectioncounter' => $collectioncounter,
				'account'	=> $account,
				'date_type' => $date_type
			);
			$this->load->view('Reports/daily_collection_pdf',$array);
			
			$html = $this->output->get_output();
			$this->load->library('pdf');
			$this->dompdf->loadHtml($html);
			$this->dompdf->setPaper('A3', 'landscape');
			$this->dompdf->render();
			$this->dompdf->stream("Daily_Misl.pdf", array("Attachment"=>0));
		}
		else if($feecollectiontype=='NONE')
		{
			$data1 = $this->dbcon->select('daycoll','*',"ADM_NO='NONE' && User_Id LIKE '$collectioncounter' && Collection_Mode='$collectiontype' && RECT_DATE='$date_type'");
			$array = array(
				'data1'     => $data1,
				'feehead1'  => $feehead[1],
				'feehead2'  => $feehead[2],
				'feehead3'  => $feehead[3],
				'feehead4'  => $feehead[4],
				'feehead5'  => $feehead[5],
				'feehead6'  => $feehead[6],
				'feehead7'  => $feehead[7],
				'feehead8'  => $feehead[8],
				'feehead9'  => $feehead[9],
				'feehead10' => $feehead[10],
				'feehead11' => $feehead[11],
				'feehead12' => $feehead[12],
				'feehead13' => $feehead[13],
				'feehead14' => $feehead[14],
				'feehead15' => $feehead[15],
				'feehead16' => $feehead[16],
				'feehead17' => $feehead[17],
				'feehead18' => $feehead[18],
				'feehead19' => $feehead[19],
				'feehead20' => $feehead[20],
				'feehead21' => $feehead[21],
				'feehead22' => $feehead[22],
				'feehead23' => $feehead[23],
				'feehead24' => $feehead[24],
				'feehead25' => $feehead[25],
				'School_setting' => $School_setting,
				'feecollectiontype' => $feecollectiontype,
				'collectioncounter' => $collectioncounter,
				'account'	=> $account,
				'date_type' => $date_type
			);
			$this->load->view('Reports/daily_collection_pdf',$array);
			
			$html = $this->output->get_output();
			$this->load->library('pdf');
			$this->dompdf->loadHtml($html);
			$this->dompdf->setPaper('A3', 'landscape');
			$this->dompdf->render();
			$this->dompdf->stream("Daily_None.pdf", array("Attachment"=>0));
			
		} 
		else
		{
			$data1 = "dada";
		}
	}
	public function monthly_report()
	{
		ini_set('display_errors',-1);
		$collectiontype    = $this->input->post('ct2');
		$feecollectiontype = $this->input->post('fct2');
		$collectioncounter = $this->input->post('cc2');
		$single			   = $this->input->post('sd2');
		$double			   = $this->input->post('sdf2');
		
		// Declare an empty array 
		$array_date = array(); 
		  
		// Use strtotime function 
		$Variable1 = strtotime($single); 
		$Variable2 = strtotime($double); 
		  
		// Use for loop to store dates into array 
		// 86400 sec = 24 hrs = 60*60*24 = 1 day 
		for ($currentDate = $Variable1; $currentDate <= $Variable2;  
										$currentDate += (86400)) { 
											  
		$Store = date('Y-m-d', $currentDate); 
		$array_date[] = $Store; 
		}
		$count_date = count($array_date);
		
		for($i=1;$i<=25;$i++)
		{
			$feehead[$i] = $this->dbcon->select('feehead','*',"ACT_CODE='$i'");
		}
		$School_setting = $this->dbcon->select('school_setting','*');
		$session_master = $this->dbcon->select('session_master','*',"Active_Status=1");
		$account = $this->dbcon->select('accg','*');
		if($feecollectiontype=='All')
		{
			$data_array = array();
			for($i=0;$i<$count_date;$i++)
			{
				$data1 = $this->dbcon->selectSingleData('daycoll','DISTINCT(RECT_DATE)AS RECT_DATE, min(RECT_NO) AS RECT_NO_start, MAX(RECT_NO) AS RECT_NO_end, sum(TOTAL) AS TOTAL, sum(Fee1) AS Fee1, SUM(Fee2) AS Fee2, SUM(Fee3)Fee3, sum(Fee4)Fee4, sum(Fee5)Fee5, sum(Fee6)Fee6, sum(Fee7)Fee7, sum(Fee8)Fee8, sum(Fee9)Fee9, sum(Fee10)Fee10, sum(Fee11)Fee11, SUM(Fee12)Fee12, sum(Fee13)Fee13, SUM(Fee14)Fee14, SUM(Fee15)Fee15, sum(Fee16)Fee16, sum(Fee17)Fee17, sum(Fee18)Fee18, sum(Fee19)Fee19, sum(Fee20)Fee20, sum(Fee21)Fee21, sum(Fee22)Fee22, SUM(Fee23)Fee23, sum(Fee24)Fee24, SUM(Fee25)Fee25',"Collection_Mode=$collectiontype AND User_Id LIKE '$collectioncounter' AND RECT_DATE='$array_date[$i]'");
				$data_array[] = $data1;
			}
			$collection_type = $this->dbcon->select('daycoll','*',"Collection_Mode=$collectiontype AND User_Id LIKE '$collectioncounter' AND RECT_DATE>='$single' AND RECT_DATE<='$double'");
			$array = array(
				'data_array'=> $data_array,
				'feehead1'  => $feehead[1],
				'feehead2'  => $feehead[2],
				'feehead3'  => $feehead[3],
				'feehead4'  => $feehead[4],
				'feehead5'  => $feehead[5],
				'feehead6'  => $feehead[6],
				'feehead7'  => $feehead[7],
				'feehead8'  => $feehead[8],
				'feehead9'  => $feehead[9],
				'feehead10' => $feehead[10],
				'feehead11' => $feehead[11],
				'feehead12' => $feehead[12],
				'feehead13' => $feehead[13],
				'feehead14' => $feehead[14],
				'feehead15' => $feehead[15],
				'feehead16' => $feehead[16],
				'feehead17' => $feehead[17],
				'feehead18' => $feehead[18],
				'feehead19' => $feehead[19],
				'feehead20' => $feehead[20],
				'feehead21' => $feehead[21],
				'feehead22' => $feehead[22],
				'feehead23' => $feehead[23],
				'feehead24' => $feehead[24],
				'feehead25' => $feehead[25],
				'fromdate'  => $single,
				'todate'    => $double,
				'School_setting' => $School_setting,
				'feecollectiontype' => $feecollectiontype,
				'collectioncounter' => $collectioncounter,
				'account'	=> $account,
				'collection_type' => $collection_type
			);
			$this->load->view('Reports/monthly_collection_pdf',$array);
			
			$html = $this->output->get_output();
			$this->load->library('pdf');
			$this->dompdf->loadHtml($html);
			$this->dompdf->setPaper('A3', 'landscape');
			$this->dompdf->render();
			$this->dompdf->stream("Monthly_report_all.pdf", array("Attachment"=>0));
			
		}
		else if($feecollectiontype=='Monthly')
		{
			$data_array = array();
			for($i=0;$i<$count_date;$i++)
			{
				$data1 = $this->dbcon->selectSingleData('daycoll','DISTINCT(RECT_DATE)AS RECT_DATE, min(RECT_NO) AS RECT_NO_start, MAX(RECT_NO) AS RECT_NO_end, sum(TOTAL) AS TOTAL, sum(Fee1) AS Fee1, SUM(Fee2) AS Fee2, SUM(Fee3)Fee3, sum(Fee4)Fee4, sum(Fee5)Fee5, sum(Fee6)Fee6, sum(Fee7)Fee7, sum(Fee8)Fee8, sum(Fee9)Fee9, sum(Fee10)Fee10, sum(Fee11)Fee11, SUM(Fee12)Fee12, sum(Fee13)Fee13, SUM(Fee14)Fee14, SUM(Fee15)Fee15, sum(Fee16)Fee16, sum(Fee17)Fee17, sum(Fee18)Fee18, sum(Fee19)Fee19, sum(Fee20)Fee20, sum(Fee21)Fee21, sum(Fee22)Fee22, SUM(Fee23)Fee23, sum(Fee24)Fee24, SUM(Fee25)Fee25',"ADM_NO!='NONE' && mid(period,1,4)!='MISL' && mid(period,1,3)!='PRE' && User_Id LIKE '$collectioncounter' && Collection_Mode='$collectiontype' && RECT_DATE='$array_date[$i]'");
				$data_array[] = $data1;
			}
			$collection_type = $this->dbcon->select('daycoll','*',"ADM_NO!='NONE' && mid(period,1,4)!='MISL' && mid(period,1,3)!='PRE' && User_Id LIKE '$collectioncounter' && Collection_Mode='$collectiontype' && RECT_DATE>='$single' AND RECT_DATE<='$double'");
			$array = array(
				'data_array'=> $data_array,
				'feehead1'  => $feehead[1],
				'feehead2'  => $feehead[2],
				'feehead3'  => $feehead[3],
				'feehead4'  => $feehead[4],
				'feehead5'  => $feehead[5],
				'feehead6'  => $feehead[6],
				'feehead7'  => $feehead[7],
				'feehead8'  => $feehead[8],
				'feehead9'  => $feehead[9],
				'feehead10' => $feehead[10],
				'feehead11' => $feehead[11],
				'feehead12' => $feehead[12],
				'feehead13' => $feehead[13],
				'feehead14' => $feehead[14],
				'feehead15' => $feehead[15],
				'feehead16' => $feehead[16],
				'feehead17' => $feehead[17],
				'feehead18' => $feehead[18],
				'feehead19' => $feehead[19],
				'feehead20' => $feehead[20],
				'feehead21' => $feehead[21],
				'feehead22' => $feehead[22],
				'feehead23' => $feehead[23],
				'feehead24' => $feehead[24],
				'feehead25' => $feehead[25],
				'fromdate'  => $single,
				'todate'    => $double,
				'School_setting' => $School_setting,
				'feecollectiontype' => $feecollectiontype,
				'collectioncounter' => $collectioncounter,
				'account'	=> $account,
				'collection_type' => $collection_type
			);
			$this->load->view('Reports/monthly_collection_pdf',$array);
			
			$html = $this->output->get_output();
			$this->load->library('pdf');
			$this->dompdf->loadHtml($html);
			$this->dompdf->setPaper('A3', 'landscape');
			$this->dompdf->render();
			$this->dompdf->stream("Monthly_Reports.pdf", array("Attachment"=>0));
			
		}
		else if($feecollectiontype=='MISL')
		{
			$data_array = array();
			for($i=0;$i<$count_date;$i++)
			{
				$data1 = $this->dbcon->selectSingleData('daycoll','DISTINCT(RECT_DATE)AS RECT_DATE, min(RECT_NO) AS RECT_NO_start, MAX(RECT_NO) AS RECT_NO_end, sum(TOTAL) AS TOTAL, sum(Fee1) AS Fee1, SUM(Fee2) AS Fee2, SUM(Fee3)Fee3, sum(Fee4)Fee4, sum(Fee5)Fee5, sum(Fee6)Fee6, sum(Fee7)Fee7, sum(Fee8)Fee8, sum(Fee9)Fee9, sum(Fee10)Fee10, sum(Fee11)Fee11, SUM(Fee12)Fee12, sum(Fee13)Fee13, SUM(Fee14)Fee14, SUM(Fee15)Fee15, sum(Fee16)Fee16, sum(Fee17)Fee17, sum(Fee18)Fee18, sum(Fee19)Fee19, sum(Fee20)Fee20, sum(Fee21)Fee21, sum(Fee22)Fee22, SUM(Fee23)Fee23, sum(Fee24)Fee24, SUM(Fee25)Fee25',"mid(period,1,4)='MISL' && User_Id LIKE '$collectioncounter' && Collection_Mode='$collectiontype' && RECT_DATE='$array_date[$i]'");
				$data_array[] = $data1;
			}
			$collection_type = $this->dbcon->select('daycoll','*',"mid(period,1,4)='MISL' && User_Id LIKE '$collectioncounter' && Collection_Mode='$collectiontype' && RECT_DATE>='$single' AND RECT_DATE<='$double'");
			$array = array(
				'data_array'     => $data_array,
				'feehead1'  => $feehead[1],
				'feehead2'  => $feehead[2],
				'feehead3'  => $feehead[3],
				'feehead4'  => $feehead[4],
				'feehead5'  => $feehead[5],
				'feehead6'  => $feehead[6],
				'feehead7'  => $feehead[7],
				'feehead8'  => $feehead[8],
				'feehead9'  => $feehead[9],
				'feehead10' => $feehead[10],
				'feehead11' => $feehead[11],
				'feehead12' => $feehead[12],
				'feehead13' => $feehead[13],
				'feehead14' => $feehead[14],
				'feehead15' => $feehead[15],
				'feehead16' => $feehead[16],
				'feehead17' => $feehead[17],
				'feehead18' => $feehead[18],
				'feehead19' => $feehead[19],
				'feehead20' => $feehead[20],
				'feehead21' => $feehead[21],
				'feehead22' => $feehead[22],
				'feehead23' => $feehead[23],
				'feehead24' => $feehead[24],
				'feehead25' => $feehead[25],
				'fromdate'  => $single,
				'todate'    => $double,
				'School_setting' => $School_setting,
				'feecollectiontype' => $feecollectiontype,
				'collectioncounter' => $collectioncounter,
				'account'	=> $account,
				'collection_type' => $collection_type
			);
			$this->load->view('Reports/monthly_collection_pdf',$array);
			
			$html = $this->output->get_output();
			$this->load->library('pdf');
			$this->dompdf->loadHtml($html);
			$this->dompdf->setPaper('A3', 'landscape');
			$this->dompdf->render();
			$this->dompdf->stream("Monthly_Misl.pdf", array("Attachment"=>0));
		}
		else if($feecollectiontype=='NONE')
		{
			$data_array = array();
			for($i=0;$i<$count_date;$i++)
			{
				$data1 = $this->dbcon->selectSingleData('daycoll','DISTINCT(RECT_DATE)AS RECT_DATE, min(RECT_NO) AS RECT_NO_start, MAX(RECT_NO) AS RECT_NO_end, sum(TOTAL) AS TOTAL, sum(Fee1) AS Fee1, SUM(Fee2) AS Fee2, SUM(Fee3)Fee3, sum(Fee4)Fee4, sum(Fee5)Fee5, sum(Fee6)Fee6, sum(Fee7)Fee7, sum(Fee8)Fee8, sum(Fee9)Fee9, sum(Fee10)Fee10, sum(Fee11)Fee11, SUM(Fee12)Fee12, sum(Fee13)Fee13, SUM(Fee14)Fee14, SUM(Fee15)Fee15, sum(Fee16)Fee16, sum(Fee17)Fee17, sum(Fee18)Fee18, sum(Fee19)Fee19, sum(Fee20)Fee20, sum(Fee21)Fee21, sum(Fee22)Fee22, SUM(Fee23)Fee23, sum(Fee24)Fee24, SUM(Fee25)Fee25',"ADM_NO='NONE' && User_Id LIKE '$collectioncounter' && Collection_Mode='$collectiontype' && RECT_DATE='$array_date[$i]'");
				$data_array[] = $data1;
			}
			$collection_type = $this->dbcon->select('daycoll','*',"ADM_NO='NONE' && User_Id LIKE '$collectioncounter' && Collection_Mode='$collectiontype' && RECT_DATE>='$single' AND RECT_DATE<='$double'");
			$array = array(
				'data_array'=> $data_array,
				'feehead1'  => $feehead[1],
				'feehead2'  => $feehead[2],
				'feehead3'  => $feehead[3],
				'feehead4'  => $feehead[4],
				'feehead5'  => $feehead[5],
				'feehead6'  => $feehead[6],
				'feehead7'  => $feehead[7],
				'feehead8'  => $feehead[8],
				'feehead9'  => $feehead[9],
				'feehead10' => $feehead[10],
				'feehead11' => $feehead[11],
				'feehead12' => $feehead[12],
				'feehead13' => $feehead[13],
				'feehead14' => $feehead[14],
				'feehead15' => $feehead[15],
				'feehead16' => $feehead[16],
				'feehead17' => $feehead[17],
				'feehead18' => $feehead[18],
				'feehead19' => $feehead[19],
				'feehead20' => $feehead[20],
				'feehead21' => $feehead[21],
				'feehead22' => $feehead[22],
				'feehead23' => $feehead[23],
				'feehead24' => $feehead[24],
				'feehead25' => $feehead[25],
				'fromdate'  => $single,
				'todate'    => $double,
				'School_setting' => $School_setting,
				'feecollectiontype' => $feecollectiontype,
				'collectioncounter' => $collectioncounter,
				'account'	=> $account,
				'collection_type' => $collection_type
			);
			$this->load->view('Reports/monthly_collection_pdf',$array);
			
			$html = $this->output->get_output();
			$this->load->library('pdf');
			$this->dompdf->loadHtml($html);
			$this->dompdf->setPaper('A3', 'landscape');
			$this->dompdf->render();
			$this->dompdf->stream("Monthly_None.pdf", array("Attachment"=>0));
			
		} 
		else
		{
			$data1 = "dada";
		}
	}
	public function Fee_Defaulter_List(){
		$month_master = $this->dbcon->select('feegeneration','DISTINCT(Month_NM)');
		$class = $this->dbcon->select('classes','*');
		$sec = $this->dbcon->select('sections','*');
		$array = array(
			'month_master' => $month_master,
			'class' => $class,
			'sec' => $sec
			);
		$this->fee_template('Reports/defaulter_list',$array);
	}
	public function Fee_head_Defaulter_List(){
		$month_master = $this->dbcon->select('feegeneration','DISTINCT(Month_NM)');
		$class = $this->dbcon->select('classes','*');
		$sec = $this->dbcon->select('sections','*');
		$feehead = $this->dbcon->select('feehead','SHNAME');
		$array = array(
			'month_master' => $month_master,
			'class' => $class,
			'sec' => $sec,
			'feehead' => $feehead
			);
		$this->fee_template('Reports/defaulter_headwise_list',$array);
	}
}