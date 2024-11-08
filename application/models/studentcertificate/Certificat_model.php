<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Certificat_model extends CI_model{

	public function get_session_year()
	{
		$sql="SELECT *FROM session_master ORDER BY Session_ID desc";
		$query = $this->db->query($sql);
		if($query->num_rows() == 0)	return FALSE; 
			return $query->result();  

	}
	public function get_class_list()
	{
		$sql="SELECT Class_No,CLASS_NM FROM classes";
		$query = $this->db->query($sql);
		if($query->num_rows() == 0)	return FALSE; 
			return $query->result();  

	}
	function get_student_list($tbl,$syear,$classes){

		$sql="SELECT * FROM $tbl WHERE session_year=? AND stu_class=?";
	
	$query = $this->db->query($sql,array($syear,$classes));
		if($query->num_rows() == 0)	return FALSE; 
			return $query->result();  
		}

		function get_student_list_withoutsyear($tbl,$classes){

		$sql="SELECT * FROM $tbl WHERE stu_class=? ";
	
	$query = $this->db->query($sql,array($classes));
		if($query->num_rows() == 0)	return FALSE; 
			return $query->result();  
		}
	function get_student_list_withoutsyear_new($tbl,$classes,$syear){

		$sql="SELECT * FROM $tbl WHERE stu_class=? and session_year=?";
	
	$query = $this->db->query($sql,array($classes,$syear));
		if($query->num_rows() == 0)	return FALSE; 
			return $query->result();  
		}

		function get_student_list_inrange($tbl,$classes,$admn_one,$admn_two){

		$sql="SELECT * FROM $tbl WHERE stu_class=? AND adm_no BETWEEN ? AND ? ";
	
	$query = $this->db->query($sql,array($classes,$admn_one,$admn_two));
		if($query->num_rows() == 0)	return FALSE; 
			return $query->result();  
		}
		function get_student_list_inrange_new($tbl, $classes, $admn_one, $admn_two, $syear)
	{

		$sql = "SELECT * FROM $tbl WHERE stu_class=? AND adm_no BETWEEN ? AND ?  and session_year=?";

		$query = $this->db->query($sql, array($classes, $admn_one, $admn_two, $syear));
		if ($query->num_rows() == 0)	return FALSE;
		return $query->result();
	}

		function get_student_individual($tbl,$adm_no){

		$sql="SELECT  
a.ADM_NO AS reg_no,
a.FIRST_NM AS stu_name,
a.FATHER_NM AS fname,a.MOTHER_NM AS mname,a.ADM_DATE,
NULL AS admit_class,
a.BIRTH_DT,
NULL AS left_school,
a.disp_class AS studying_class,
NULL AS acad_year,
NULL AS pass_year,
NULL AS STATUS,
NULL AS certificate_date,
a.NATION AS nationality
FROM $tbl a  WHERE a.ADM_NO=?";
	
	$query = $this->db->query($sql,array($adm_no));
		if($query->num_rows() == 0)	return FALSE; 
			return $query->row();  
		}


	function insert($data)
	{
		if($this->db->insert('tc_bridge_table',$data))
			return $this->db->insert_id();
		else
			return FALSE;
	}

	function check_bridge_status($syear,$classes){

		$sql="SELECT * FROM tc_bridge_table where session_year=? AND class_no=?";
		$query = $this->db->query($sql,array($syear,$classes));
		if($query->num_rows() == 0)	return FALSE; 
			return $query->row();  
		}

		function check_charcert_status($tbl, $syear,$classes){

			$sql="SELECT * FROM $tbl where session_year=? AND stu_class=?";
		$query = $this->db->query($sql,array($syear,$classes));
		if($query->num_rows() == 0)	return FALSE; 
			return $query->result();  

		}
			
			
	

	function insert_student_list_student_tc($syear,$classes)
	{
		$sql="INSERT INTO student_tc(adm_no,stu_nm,mother_nm,father_nm,adm_date,class_admitted,
BIRTH_DT,left_school,studied_class,acad_year,pass_year,STATUS,cer_issue_date,
nationality,create_on,user_id,session_year,stu_class,remarks1,remarks2)
SELECT  
a.ADM_NO AS reg_no,
a.FIRST_NM AS stu_name,
a.FATHER_NM AS fname,a.MOTHER_NM AS mname,a.ADM_DATE,
NULL AS admit_class,
a.BIRTH_DT,
NULL AS left_school,
a.disp_class AS studying_class,
NULL AS acad_year,
NULL AS pass_year,
NULL AS STATUS,
NULL AS certificate_date,
a.NATION AS nationality,
NULL AS create_on,
NULL AS user_id,
$syear as session_year,
$classes as stu_class,
NULL AS remarks1,
NULL AS remarks2
FROM student a  WHERE a.class=?";
$query = $this->db->query($sql,array($classes));
		 if ($this->db->affected_rows() > 0) {
            return True;
        } else {
            return false;
        }

		}

		function insert_student_list_tpstudent_tc($syear,$classes)
	{
		$sql="INSERT INTO tpstudent_tc(adm_no,stu_nm,mother_nm,father_nm,adm_date,class_admitted,
BIRTH_DT,left_school,studied_class,acad_year,pass_year,STATUS,cer_issue_date,
nationality,create_on,user_id,session_year,stu_class,remarks1,remarks2)
SELECT  
a.ADM_NO AS reg_no,
a.FIRST_NM AS stu_name,
a.FATHER_NM AS fname,a.MOTHER_NM AS mname,a.ADM_DATE,
NULL AS admit_class,
a.BIRTH_DT,
NULL AS left_school,
a.disp_class AS studying_class,
NULL AS acad_year,
NULL AS pass_year,
NULL AS STATUS,
NULL AS certificate_date,
a.NATION AS nationality,
NULL AS create_on,
NULL AS user_id,
$syear as session_year,
$classes as stu_class,
NULL AS remarks1,
NULL AS remarks2
FROM tpstudent a  WHERE a.class=?";
$query = $this->db->query($sql,array($classes));
		 if ($this->db->affected_rows() > 0) {
            return True;
        } else {
            return false;
        }
    }


    //==========================================
    function get_student_list_old($tbl,$classes)
	{
		$sql=" SELECT  
a.ADM_NO AS reg_no,
a.FIRST_NM AS stu_name,
a.FATHER_NM AS fname,a.MOTHER_NM AS mname,a.ADM_DATE,
(select class_nm from classes where class_no=a.adm_class) AS admit_class,
a.BIRTH_DT,
NULL AS left_school,
a.disp_class AS studying_class,
NULL AS acad_year,
NULL AS pass_year,
NULL AS STATUS,
NULL AS certificate_date,
a.NATION AS nationality,
NULL AS create_on,
NULL AS user_id,
NULL AS remarks1,
NULL AS remarks2
FROM $tbl a  WHERE a.class=?";
$query = $this->db->query($sql,array($classes));
		//echo $query;die;
		if($query->num_rows() == 0)	return FALSE; 
			return $query->result();  
    }


     function insert_batch($tbl,$data)
	{
		if($this->db->insert_batch($tbl,$data))
			return TRUE;
		else
			return FALSE;
	}
	function get_tc_number(){

		$sql="SELECT tcno FROM adm_no";
		$query = $this->db->query($sql);
		if($query->num_rows() == 0)	return FALSE; 
			return $query->row()->tcno;  

	}
	function get_tc_details()
	{

		$sql = "SELECT tchead ,current_year FROM adm_no";
		$query = $this->db->query($sql);
		if ($query->num_rows() == 0)	return FALSE;
		return $query->result();
	}
	function get_char_certificate_number(){

		$sql="SELECT chartno FROM adm_no";
		$query = $this->db->query($sql);
		if($query->num_rows() == 0)	return FALSE; 
			return $query->row()->chartno;  

	}
	function update_tc_number($tc){
		  $sql = "update adm_no set tcno=".$tc;
        $query = $this->db->query($sql);
        
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
	}
	function update_charcert_number($cno){
		  $sql = "update adm_no set chartno=".$cno;
        $query = $this->db->query($sql);
        
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
	}
	
	function number_to_string($num){
		$number = $num;
$number1 = $number;
$no = floor($number);
$hundred = null;
$digits_1 = strlen($no); //to find lenght of the number
$i = 0;
// Numbers can stored in array format
$str = array();

$words = array('0' => '', '1' => 'One', '2' => 'Two',
'3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
'7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
'10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
'13' => 'Thirteen', '14' => 'Fourteen',
'15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
'18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
'30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
'60' => 'Sixty', '70' => 'Seventy',
'80' => 'Eighty', '90' => 'Ninety');

$digits = array('', 'Hundred', 'Thousand', 'lakh', 'Crore');
//Extract last digit of number and print corresponding number in words till num becomes 0
while ($i < $digits_1)
{
$divider = ($i == 2) ? 10 : 100;
//Round numbers down to the nearest integer
$number =floor($no % $divider);
$no = floor($no / $divider);
$i +=($divider == 10) ? 1 : 2;

if ($number)
{
$plural = (($counter = count($str)) && $number > 9) ? 's' : null;
$hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
$str [] = ($number < 21) ? $words[$number] . " " .
$digits[$counter] .
$plural . " " .
$hundred: $words[floor($number / 10) * 10]. " " .
$words[$number % 10] . " ".
$digits[$counter] . $plural . " " .
$hundred;
}
else $str[] = null;
}

$str = array_reverse($str);
$result = implode('', $str); //Join array elements with a string
return $result;
	}


	function update_student_record($tbl,$dataS,$con)
    {
         if($this->db->update($tbl,$dataS['t2'],$con['t2']))
         {
                    return true;
         } 
            return false;
            
    }

	
}