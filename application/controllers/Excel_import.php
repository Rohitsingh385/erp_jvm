<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Excel_import extends MY_Controller{
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	    $this->load->model('Mymodel','dbcon');
	    $this->load->model('Alam','alam');
	}
	
		public function index()
	{
		
	$this->load->library('PHPExcel');
	if(isset($_FILES["file"]["name"]))
  {
   $path = $_FILES["file"]["tmp_name"];
   $object = PHPExcel_IOFactory::load($path);
   foreach($object->getWorksheetIterator() as $worksheet)
   {
    $highestRow = $worksheet->getHighestRow();
    $highestColumn = $worksheet->getHighestColumn();
	       for($row=2; $row<=$highestRow; $row++)
    {
    $tracking_id=$worksheet->getCellByColumnAndRow(0, $row)->getValue();
	$order_id = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
	$pay_mode = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
	$card_name = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
	$status = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
   	$bank_ref_no=$worksheet->getCellByColumnAndRow(5, $row)->getValue();
	$online_trans = $this->db->query("select * from online_transaction where order_id='$order_id'")->result();
			   
	   if(sizeof($online_trans) !=0 && ($status=='Shipped' || $status=='Successful')){
		$User_Id=$online_trans[0]->ADM_NO;	
		  $chk_duplicat = $this->db->query("select * from daycoll where CHQ_NO !='$order_id' AND ADM_NO='$User_Id'")->result();
		   if(sizeof($chk_duplicat)!=0){
			$admmm=$chk_duplicat[0]->ADM_NO; 
			$orderr=$online_trans[0]->CHQ_NO;
			  echo"<p style='color:red'>$admmm /- $orderr</p><br/>";
			 continue;
		   }
		$admm = $online_trans[0]->ADM_NO;
		$stuu_name = $online_trans[0]->STU_NAME;
        $on_orderid = $online_trans[0]->order_id;
		$on_amt = $online_trans[0]->pay_amount;
		$on_period = $online_trans[0]->PERIOD;
		echo "<p style='color:green'>$User_Id</p></br>";
		//$order_id = $this->session->userdata('tid');
		//$track_id =  $this->session->userdata('track_id');
		$recpt_val = $this->db->query("select max(RECT_NO) as rec_no from daycoll where Collection_Mode=3")->result();
		$rcpt_cnt =  count($recpt_val);
		if($rcpt_cnt == 0)
		{
		    $rcpt = 'COMP00000';
		}
		else{
		     $rcpt = $recpt_val[0]->rec_no;
         }
		
		$data = explode('COMP',$rcpt);
        @$number = $data[1];
		$number++;
        $rcpt_dig = str_pad($number, 5, "0", STR_PAD_LEFT);
		$rcpt_no = 'COMP'.$rcpt_dig;
		
		$this->session->set_userdata('sessionRecepitData',$rcpt_no);
		$ses = $this->session->userdata('sessionRecepitData');
		
		$upt_data = array(
			'tracking_id' => $tracking_id,
			'bank_ref_no' => $bank_ref_no,
			'order_status' => 'Success',
			'failure_msg' => "",
			'pay_mode' => $pay_mode,
			'card_name' => $card_name,
			//'status_code' => $status_code,
			'status_msg' =>'respon_update',
			'rcv_amt' =>'400',
			'payment_status' =>  'response_rcpt'
		);
		
	   $this->dbcon->update('online_transaction',$upt_data,"order_id='$order_id'");
		$pre_due = 0;
			$today_date = date('Y-m-d H:i:s');
			$dycl_chk = $this->db->query("select * from daycoll where CHQ_NO='$order_id'")->result();
		   $dychk_cnt = count($dycl_chk);
			 if($dychk_cnt == 0)
			{	
			$daycall = array(
			'RECT_NO'  => $ses,
			'RECT_DATE' => $online_trans[0]->trans_date,
			'STU_NAME' => $online_trans[0]->STU_NAME,
			'STUDENTID' => $online_trans[0]->STUDENTID,
			'ADM_NO' => $online_trans[0]->ADM_NO,
			'CLASS' => $online_trans[0]->CLASS,
			'SEC' => $online_trans[0]->SEC,
			'ROLL_NO' => $online_trans[0]->ROLL_NO,
			'PERIOD' => $online_trans[0]->PERIOD,
			'TOTAL' => $online_trans[0]->TOTAL,
			'fee1' => $online_trans[0]->Fee1,
			'fee2' => $online_trans[0]->Fee2,
			'fee3' => $online_trans[0]->Fee3,
			'fee4' => $online_trans[0]->Fee4,
			'fee5' => $online_trans[0]->Fee5,
			'fee6' => $online_trans[0]->Fee6,
			'fee7' => $online_trans[0]->Fee7,
			'fee8' => $online_trans[0]->Fee8,
			'fee9' => $online_trans[0]->Fee9,
			'fee10' => $online_trans[0]->Fee10,
			'fee11' => $online_trans[0]->Fee11,
			'fee12' => $online_trans[0]->Fee12,
			'fee13' => $online_trans[0]->Fee13,
			'fee14' => $online_trans[0]->Fee14,
			'fee15' => $online_trans[0]->Fee15,
			'fee16' => $online_trans[0]->Fee16,
			'fee17' => $online_trans[0]->Fee17,
			'fee18' => $online_trans[0]->Fee18,
			'fee19' => $online_trans[0]->Fee19,
			'fee20' => $online_trans[0]->Fee20,
			'fee21' => $online_trans[0]->Fee21,
			'fee22' => $online_trans[0]->Fee22,
			'fee23' => $online_trans[0]->Fee23,
			'fee24' => $online_trans[0]->Fee24,
			'fee25' => $online_trans[0]->Fee25,
			'Session_Year' =>$online_trans[0]->Session_Year,
			'Collection_Mode' => 3,
			'Payment_Mode' => 'ONLINE',
			'Bank_Name' => 'CC Avenue',
            'User_Id'         => $User_Id,
             'CHQ_NO' => $order_id,
             'Narr' => 'N/A',
             'TAmt' => 0,
			'Pay_Date'=> date('Y-m-d'),
             'Fee_Book_No' => 0
			);
			$admmm=$online_trans[0]->ADM_NO;
			$this->dbcon->insert('daycoll',$daycall);
			$mrrt=array('MAR_ATT'=>$ses);
			$this->dbcon->update('student',$mrrt,"ADM_NO='$admmm'");
			$upd_dat=array('Pay_Date'=> date('Y-m-d'));
			$this->dbcon->update('online_transaction',$upd_dat,"order_id='$order_id'");
				 
		}	 
				 
		 }else{
	
	   }
   			}
			}

   		}
	}
 
}