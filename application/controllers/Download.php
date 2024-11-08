<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Download extends MY_Controller{
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Alam','alam');
	}
	
	public function index(){
		$data['secData'] = $this->alam->selectA('temp_cbse_reg','distinct(sec)',"1='1' order by sec");
		$this->render_template('download/download',$data);
	}
	
	public function profile_download(){
		$sec = $this->input->post('value');
		$data = $this->alam->selectA('temp_cbse_reg','photo,(select SECTION_NAME from sections where section_no=temp_cbse_reg.sec)secnm',"sec='$sec'");
		$secnm = $data[0]['secnm'];
		
		$path = 'assets/sections_ix/'.$secnm;
		mkdir($path,0755, true);
		foreach($data as $key => $val){
			$img = explode('/',$val['photo']);
			$img = $img[2];
			copy($val['photo'], $path.'/'.$img);
		}
	}
}