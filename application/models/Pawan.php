<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pawan extends CI_model{
	
	public function select($table,$data,$where=''){
		$this->db->select($data);
		$this->db->from($table);
		if($where != ''){
			$this->db->where($where);
		}
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function delete($tablename)
	{
		$query = $this->db->empty_table($tablename);
		return $query;
	}

	

	public function insert($data,$table){
		$this->db->insert($data,$table);
		return true;
	}

	public function update($table,$data,$where=''){
		$this->db->where($where);
		$this->db->update($table,$data);
		return true;
	}
	
	public function selectA($table,$data,$where=''){
		$this->db->select($data);
		$this->db->from($table);
		if($where != ''){
			$this->db->where($where);
		}
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function numrows($table,$data,$where=''){
		$this->db->select($data);
		$this->db->from($table);
		if($where != ''){
			$this->db->where($where);
		}
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	public function student_data($student_id){
		$query = $this->db->query("select FIRST_NM,MIDDLE_NM,CLASS_NM,ROLL_NO,SECTION_NAME from student a left join sections b on a.ADM_SEC=b.section_no left join classes c on a.ADM_CLASS=c.Class_No
		where ADM_NO='$student_id'");
		return $query->result_array();
	}
	
	public function isuue_detail($adm_no){
		$query = $this->db->query("select a.BName,b.accno,a.IDate,a.Due_date from books_applied a left join bookmaster b on a.BookID=b.B_Code where Admno='$adm_no' and Issued=1");
		return $query->result_array();
	}
	
	public function book_data($acce_no){
		$query = $this->db->query("SELECT a.id as bookid,`BNAME`,`ID_NO`,accno,`AUTHOR`,`PUBLISHER`,`EDITION`,B_Code,`racname`,`Rackno`,book_name as subject_name,book_no FROM `bookmaster` a left join library_call_master b on a.`SUB_ID`=b.id where `accno`='$acce_no'");
		return $query->result_array();
	}
	public function return_detail($acce_no){
		$query = $this->db->query("SELECT a.id,a.BookID,a.Admno,b.FIRST_NM,b.MIDDLE_NM,b.FATHER_NM,a.class,a.BName,a.Due_date,c.SECTION_NAME as ADM_SEC,a.`AppDate`,b.student_image FROM `books_applied` a left JOIN student b on a.Admno=b.ADM_NO left join sections c on b.ADM_SEC=c.section_no where a.Issued='1' and `BookID`='$acce_no'");
		return $query->result_array();
	}
	public function stock_reg(){
		$query = $this->db->query("SELECT a.SUB_ID,count(a.SUB_ID) as instok,(Select book_name from library_call_master where id=a.SUB_ID)as book_name,(Select count(id) from bookmaster where accno=a.accno and flag=1) as totissued,(Select count(id) from bookmaster where SUB_ID=a.SUB_ID and book_status='L') as totlost,(Select count(id) from bookmaster where SUB_ID=a.SUB_ID and book_status='D') as totdmage from bookmaster a GROUP by a.SUB_ID,book_name,totissued,totlost,totdmage order by book_name desc");
		//$str=$this->db->last_query();
		//echo $str;
		//die;
		return $query->result_array();
	}
	
	public function teach_isuue_detail($em_id){
		$query = $this->db->query("select a.BName,b.accno,a.IDate,a.Due_date from books_applied1 a left join bookmaster b on a.BookID=b.B_Code where E_ID='$em_id' and Issued=1");
		return $query->result_array();
	}
	public function tech_return_detail($acce_no){
		$query = $this->db->query("SELECT a.id,b.EMPID,a.`BookID`,b.EMP_FNAME,b.EMP_MNAME,b.EMP_LNAME,b.`FATHERS_NAME`,a.BName,a.Due_date FROM `books_applied1` a left JOIN employee b on a.`E_ID`=b.id where a.Issued='1' and `BookID`='$acce_no'");
		return $query->result_array();
	}
}