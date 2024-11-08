<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parentlogin_XI extends MY_controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('Mymodel','dbcon');
		$this->load->model('Alam','alam');
		error_reporting(0);
	}
	
	public function index(){
		$data['schoolData'] = $this->sumit->fetchSingleData('*','school_setting',array('S_No'=>1));
		$this->load->view('parent/index_xi',$data);
	}
	
	public function loggedIn(){
		$adm  = $this->input->post('user_id');
		$pass = $this->input->post('password');
		
		$data_count = $this->dbcon->checkData('*','class_xi_reg',array('TokenNo'=>$adm,'pwd'=>$pass));
		$school = $this->alam->selectA('school_setting','*');
		if($data_count){
			$data['login_details'] = $this->alam->selectA('class_xi_reg','*',array('TokenNo'=>$adm,'pwd'=>$pass));
			
			$TokenNo       = $data['login_details'][0]['TokenNo'];
			$ID            = $data['login_details'][0]['ID'];
			$set_amt       = $data['login_details'][0]['set_amt'];
			$conven_charge = $data['login_details'][0]['conven_charge'];
			$Sname         = $data['login_details'][0]['Sname'];
			$Email         = $data['login_details'][0]['Email'];
			$Mobile        = $data['login_details'][0]['Mobile'];
			$AdmNo         = $data['login_details'][0]['AdmNo'];
			$Section       = $data['login_details'][0]['Section'];
			
			
			$this->session->set_userdata('token',$TokenNo);
			$this->session->set_userdata('token_no',$ID);
			$this->session->set_userdata('fee_amt',$set_amt);
			$this->session->set_userdata('conven_amt',$conven_charge);
			$this->session->set_userdata('stu_name',$Sname);
			$this->session->set_userdata('email',$Email);
			$this->session->set_userdata('f_mob',$Mobile);
			$this->session->set_userdata('adm_no',$AdmNo);
			$this->session->set_userdata('sec',$Section);
			
			$this->load->view('parents_dashboard/Cbse_Reg/cbse_registration_XI',$data);
		}else{
			$this->session->set_flashdata('msg','<div style="text-align:center; font-size:18px;" class="text-danger">Token No. And Password Is Incorrect !</div>');
			redirect('Parentlogin_XI/index');
		}
	}
	
	public function logout(){
		$this->session->unset_userdata('std_id');
		redirect('Parentlogin_XI/index');
	}
	
	public function upd_data(){
		$minority=$this->input->post('minority');	
		$annual_income=$this->input->post('annual_income');
		$handicap=$this->input->post('handicap');
	    $only_child=$this->input->post('only_child');	
		$adm_no=$this->input->post('admno');	
		$bord_year=$this->input->post('bord_year');
		$borad_name=$this->input->post('borad_name');
		$borad=$this->input->post('borad');
		$candidate_name=$this->input->post('candidate_name');
		$mother_name=$this->input->post('mother_name');
		$father_name=$this->input->post('father_name');
		$dbo=$this->input->post('dbo');
		$dbo=date('Y-m-d',strtotime($dbo));
		$catrgory=$this->input->post('category');
		$stu_adhar_no=$this->input->post('stu_adhar_no');
		$mobile=$this->input->post('mobile');
		$email=$this->input->post('email');
		$board_roll=$this->input->post('board_roll');
		$date_of_adm=$this->input->post('date_of_adm');
		$date_of_adm=date('Y-m-d',strtotime($date_of_adm));
		$admno=str_replace("/","-",$adm_no);
		
		if($_FILES['stu_img']['name'][0]!=""){
		$imgList = array();
		for($i=0; $i<count($_FILES['stu_img']['name']); $i++){
			if(!empty($_FILES['stu_img']['name'][$i])){
			$image              = $_FILES['stu_img']['name'][$i]; 
			$expimage           = explode('.',$image);
			$count              = count($expimage);
			$image_ext          = $expimage[$count-1];
			$image_name         = $admno.'_XI.'.$image_ext;
			$imagepath          = "Cbse_Reg/profile_XI/".$image_name;
			move_uploaded_file($_FILES["stu_img"]["tmp_name"][$i],$imagepath);
			$imgList = $imagepath;
			}else{
				$imagepath  = '';
			}
		    }
	     }
		if($_FILES['stu_sign']['name'][0]!=""){
		$imgList_sign = array();
		for($i=0; $i<count($_FILES['stu_sign']['name']); $i++){
			if(!empty($_FILES['stu_sign']['name'][$i])){
			$image              = $_FILES['stu_sign']['name'][$i]; 
			$expimage           = explode('.',$image);
			$count              = count($expimage);
			$image_ext          = $expimage[$count-1];
			$image_name         = 's_sig'.$admno.'_XI.'.$image_ext;
			$imagepath_s          = "Cbse_Reg/stu_sign_XI/".$image_name;
			move_uploaded_file($_FILES["stu_sign"]["tmp_name"][$i],$imagepath_s);
			$imgList_sign = $imagepath_s;
			}else{
				$imagepath_s  = '';
			}
		}
	}
		if($_FILES['parent_sign']['name'][0]!=""){
		$imgList_parent = array();
		for($i=0; $i<count($_FILES['parent_sign']['name']); $i++){
					if(!empty($_FILES['parent_sign']['name'][$i])){
							$image              = $_FILES['stu_sign']['name'][$i]; 
							$expimage           = explode('.',$image);
							$count              = count($expimage);
							$image_ext          = $expimage[$count-1];
							$image_name         = 'p_sig'.$admno.'_XI.'.$image_ext;
							$imagepath_s          = "Cbse_Reg/parent_sign_XI/".$image_name;
							move_uploaded_file($_FILES["parent_sign"]["tmp_name"][$i],$imagepath_s);
							$imgList_parent = $imagepath_s;
					}else{
						$imagepath_s  = '';
					}
		}
	}
		if($handicap=='yes'){
			$handicap_desc=$this->input->post('handicap_desc');
		}else{
			$handicap_desc="";
		}
	   $saveDataNotice =array(
			'minority'=>$minority,
			'only_child'=>$only_child,
			'handicap'=>$handicap,
			'handicap_type'=>$handicap_desc,
			'annual_income'=>$annual_income,
			'form_save_status'=>1,
			'class_x_board_name'=>$borad_name,
		   'Board'=>$borad,
		   'Sname'=>$candidate_name,
		   'MotherName'=>$mother_name,
		   'FatherName'=>$father_name,
		   'DOB'=>$dbo,
		   'Category'=>$catrgory,
		   'AadhaarCard'=>$stu_adhar_no,
		   'Mobile'=>$mobile,
		   'Email'=>$email,
		   'BoardRollNo'=>$board_roll,
		   'DOA'=>$date_of_adm
		);
		if($_FILES['stu_img']['name'][0]!=""){
			$data=array('stu_img'=> $imgList);
			$saveDataNotice= array_merge($data,$saveDataNotice);
		}
		
		if($_FILES['stu_sign']['name'][0]!=""){
			$data=array('stu_sign'=> $imgList_sign);
			$saveDataNotice= array_merge($data,$saveDataNotice);
		}
		
		if($_FILES['parent_sign']['name'][0]!=""){
			$data=array('parent_sign'=> $imgList_parent);
			$saveDataNotice= array_merge($data,$saveDataNotice);
		}
		
		$this->alam->update('class_xi_reg',$saveDataNotice,"AdmNo='$adm_no'");
		echo 1;
	}
}