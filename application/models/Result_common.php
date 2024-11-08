<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Result_common extends CI_model
{

	
	public function get_student_list_class_section_wise($class_no, $sec_no)
	{
		$sql = "SELECT a.ADM_NO,a.CLASS,a.SEC,a.DISP_CLASS,a.DISP_SEC,a.FIRST_NM,a.ROLL_NO,if(SEX=1,'MALE','FEMALE') as GENDER FROM student a
WHERE a.CLASS=? AND a.SEC=? AND a.Student_Status='Active' order by a.ROLL_NO;";
		$query = $this->db->query($sql, array($class_no, $sec_no));
		if ($query->num_rows() == 0)
			return FALSE;
		return $query->result();
	}

	public function get_student_list_class_section_wise_new($class_no, $sec_no)
	{
		$sql = "SELECT * FROM marks_final_2021 WHERE Class_no=? AND sec_no=?";
		$query = $this->db->query($sql, array($class_no, $sec_no));
		if ($query->num_rows() == 0)
			return FALSE;
		return $query->result();
	}
	public function get_student_list_class_section_wise_new_one($class_no, $sec_no, $subject_code)
	{
		$sql = "SELECT * FROM marks_final_2021 WHERE Class_no=? AND sec_no=? and sub_code=?";
		$query = $this->db->query($sql, array($class_no, $sec_no, $subject_code));
		if ($query->num_rows() == 0)
			return FALSE;
		return $query->result();
	}



	function get_student_subjects_class($class_no, $sec_no, $adm_no)
	{

		$sql = "SELECT a.Class_No,a.section_no,a.subject_code,b.SubSName,a.subj_nm,a.opt_code,a.sorting_no
FROM class_section_wise_subject_allocation_2021 a
INNER JOIN subjects b ON b.SubCode=a.subject_code
WHERE a.Class_No=? AND a.section_no=? AND a.opt_code IN (0,1) 
/*AND b.SubCode NOT IN (17,18,19,48,15)*/
UNION
SELECT c.CLASS AS Class_No,c.SEC AS section_no,a.SUBCODE AS subject_code, b.SubSName,
b.SubName AS subj_nm, a.OPTCODE AS opt_code,'99' AS sorting_no
FROM studentsubject_2021 a
INNER JOIN subjects b ON b.SubCode=a.SUBCODE
INNER JOIN student c ON c.ADM_NO=a.Adm_no
WHERE a.Class=? AND a.SEC=? AND a.Adm_no=? AND a.OPTCODE=2;";
		$query = $this->db->query($sql, array($class_no, $sec_no, $class_no, $sec_no, $adm_no));
		if ($query->num_rows() == 0)
			return FALSE;
		return $query->result();
	}
	// 	function get_student_subjects_class_nine_ten($class_no,$sec_no,$adm_no)
	// 	{

	// 		$sql="SELECT a.Class_No,a.section_no,a.subject_code,b.SubSName,a.subj_nm,a.opt_code,a.sorting_no
	// FROM class_section_wise_subject_allocation_2021 a
	// INNER JOIN subjects b ON b.SubCode=a.subject_code
	// WHERE a.Class_No=? AND a.section_no=? AND a.opt_code IN (0,1) 
	// /*AND b.SubCode NOT IN (17,18,19,48,15)*/
	// UNION
	// SELECT c.CLASS AS Class_No,c.SEC AS section_no,a.SUBCODE AS subject_code, b.SubSName,
	// b.SubName AS subj_nm, a.OPTCODE AS opt_code,'99' AS sorting_no
	// FROM studentsubject_2021 a
	// INNER JOIN subjects b ON b.SubCode=a.SUBCODE
	// INNER JOIN student c ON c.ADM_NO=a.Adm_no
	// WHERE a.Class=? AND a.SEC=? AND a.Adm_no=? AND a.OPTCODE=2;";
	// 		$query = $this->db->query($sql,array($class_no,$sec_no,$class_no,$sec_no,$adm_no));
	// 		if($query->num_rows() == 0)	return FALSE; 
	//  		return $query->result();

	// 	}

	function insert($data)
	{
		if ($this->db->insert('marks_final_2021', $data))
			//return TRUE;
			return $this->db->insert_id();
		else
			return FALSE;
	}

	function get_marks($admno, $ecode, $subcode, $classno, $sec)
	{
		$sql = "SELECT a.* FROM marks_2021 a WHERE a.admno=? AND a.ExamC=? AND a.SCode=? and a.Classes=? and a.Sec=?";
		$query = $this->db->query($sql, array($admno, $ecode, $subcode, $classno, $sec));
		if ($query->num_rows() == 0)
			return FALSE;
		return $query->row();
	}
	function get_marks_eleven($admno, $ecode, $subcode, $classno, $sec, $ptype)
	{
		$sql = "SELECT a.* FROM marks_2021 a WHERE a.admno=? AND a.ExamC=? AND a.SCode=? and a.Classes=? and a.Sec=? and a.TYPE=?";
		$query = $this->db->query($sql, array($admno, $ecode, $subcode, $classno, $sec, $ptype));
		if ($query->num_rows() == 0)
			return FALSE;
		return $query->row();
	}
	function get_marks_combined($admno, $ecode, $subcode, $classno, $sec)
	{
		$sql = "SELECT SUM(a.M2)AS M2,SUM(a.M3)AS M3 FROM marks_2021 a WHERE a.admno=? AND a.ExamC=? AND a.SCode in (" . $subcode . ") and a.Classes=? and a.Sec=?";
		$query = $this->db->query($sql, array($admno, $ecode, $classno, $sec));
		if ($query->num_rows() == 0)
			return FALSE;
		return $query->row();
	}

	function update_marks_mt1($admno, $classno, $secno, $subcode, $maxmarks, $marks, $marks_f)
	{


		$sql = "UPDATE marks_final_2021 SET max_mark_m1='" . $maxmarks . "',mtm1='" . $marks . "',mtm1_f='" . $marks_f . "' WHERE adm_no='" . $admno . "' AND class_no='" . $classno . "' AND sec_no='" . $secno . "' AND sub_code='" . $subcode . "'";
		$query = $this->db->query($sql);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	function update_marks_mt2($admno, $classno, $secno, $subcode, $maxmarks, $marks, $marks_f)
	{


		$sql = "UPDATE marks_final_2021 SET max_mark_m2='" . $maxmarks . "',mtm2='" . $marks . "',mtm2_f='" . $marks_f . "' WHERE adm_no='" . $admno . "' AND class_no='" . $classno . "' AND sec_no='" . $secno . "' AND sub_code='" . $subcode . "'";
		$query = $this->db->query($sql);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	// function update_marks_mtm($admno,$classno,$secno,$subcode,$marksmax,$marksm1,$marksm2,$marksm3)
	// {


	// 	$sql = "UPDATE marks_final_2021 SET maxmarks='".$marksmax."',mtmt1='".$marksm1."',mtmt2='".$marksm2."',mtmt3='".$marksm3."' WHERE adm_no='".$admno."' AND class_no='".$classno."' AND sec_no='".$secno."' AND sub_code='".$subcode."'";
	//     $query = $this->db->query($sql);

	//     if ($this->db->affected_rows() > 0) {
	//         return TRUE;
	//     } else {
	//         return FALSE;
	//     }
	// }

	function update_marks_hyearly($admno, $classno, $secno, $subcode, $marksmax, $marks, $marks_f)
	{


		$sql = "UPDATE marks_final_2021 SET  max_mark_hy='" . $marksmax . "',marks_obtained='" . $marks . "',marks_obtained_f='" . $marks_f . "' WHERE adm_no='" . $admno . "' AND class_no='" . $classno . "' AND sec_no='" . $secno . "' AND sub_code='" . $subcode . "'";
		$query = $this->db->query($sql);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	function update_marks_pt($admno, $classno, $secno, $subcode, $marksmax, $marks, $marks_f)
	{


		$sql = "UPDATE marks_final_2021 SET max_mark_pt='" . $marksmax . "',ptm1='" . $marks . "',ptm1_f='" . $marks_f . "' WHERE adm_no='" . $admno . "' AND class_no='" . $classno . "' AND sec_no='" . $secno . "' AND sub_code='" . $subcode . "'";
		$query = $this->db->query($sql);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function update_marks_obtained_total($admno, $classno, $secno, $subcode, $marks)
	{


		$sql = "UPDATE marks_final_2021 SET marks_obtained_total='" . $marks . "' WHERE adm_no='" . $admno . "' AND class_no='" . $classno . "' AND sec_no='" . $secno . "' AND sub_code='" . $subcode . "'";
		$query = $this->db->query($sql);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	function update_marks_obtained_per($admno, $classno, $secno, $subcode, $marks)
	{


		$sql = "UPDATE marks_final_2021 SET marks_obtained_per='" . $marks . "' WHERE adm_no='" . $admno . "' AND class_no='" . $classno . "' AND sec_no='" . $secno . "' AND sub_code='" . $subcode . "'";
		$query = $this->db->query($sql);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function get_high_section($class_no, $sec_no, $examcode, $subcode)
	{
		$sql = "SELECT coalesce(MAX(a.M3),'0') AS hsection FROM marks_2021 a WHERE 
a.Classes=? AND a.Sec=? and a.ExamC=? AND a.SCode=?;";
		$query = $this->db->query($sql, array($class_no, $sec_no, $examcode, $subcode));
		//if($query->num_rows() == 0)	return FALSE; 
		return $query->row();
	}
	function get_high_section_twelve($class_no, $sec_no, $examcode, $subcode, $ptype)
	{
		$sql = "SELECT coalesce(MAX(a.M3),'0') AS hsection FROM marks_2021 a WHERE 
a.Classes=? AND a.Sec=? and a.ExamC=? AND a.SCode=? and a.TYPE=?;";
		$query = $this->db->query($sql, array($class_no, $sec_no, $examcode, $subcode, $ptype));
		//if($query->num_rows() == 0)	return FALSE; 
		return $query->row();
	}
	function get_high_class($class_no, $examcode, $subcode)
	{
		$sql = "SELECT coalesce(MAX(a.M3),'0') AS hclass FROM marks_2021 a WHERE 
a.Classes=? AND a.ExamC=? AND a.SCode=?;";
		$query = $this->db->query($sql, array($class_no, $examcode, $subcode));
		//if($query->num_rows() == 0)	return FALSE; 
		return $query->row();
	}
	function get_high_class_twelve($class_no, $examcode, $subcode, $ptype)
	{
		$sql = "SELECT coalesce(MAX(a.M3),'0') AS hclass FROM marks_2021 a WHERE 
a.Classes=? AND a.ExamC=? AND a.SCode=? and a.TYPE=?";
		$query = $this->db->query($sql, array($class_no, $examcode, $subcode, $ptype));
		//if($query->num_rows() == 0)	return FALSE; 
		return $query->row();
	}

	function update_high_section($admno, $classno, $secno, $subcode, $marks)
	{


		$sql = "UPDATE marks_final_2021 SET high_in_section='" . $marks . "' WHERE adm_no='" . $admno . "' AND class_no='" . $classno . "' AND sec_no='" . $secno . "' AND sub_code='" . $subcode . "'";
		$query = $this->db->query($sql);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function update_high_class($admno, $classno, $secno, $subcode, $marks)
	{


		$sql = "UPDATE marks_final_2021 SET high_in_class='" . $marks . "' WHERE adm_no='" . $admno . "' AND class_no='" . $classno . "' AND sec_no='" . $secno . "' AND sub_code='" . $subcode . "'";
		$query = $this->db->query($sql);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function update_marks_se1($admno, $classno, $secno, $subcode, $marks)
	{


		$sql = "UPDATE marks_final_2021 SET se1='" . $marks . "' WHERE adm_no='" . $admno . "' AND class_no='" . $classno . "' AND sec_no='" . $secno . "' AND sub_code='" . $subcode . "'";
		$query = $this->db->query($sql);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	function update_marks_se2($admno, $classno, $secno, $subcode, $marks)
	{


		$sql = "UPDATE marks_final_2021 SET se2='" . $marks . "' WHERE adm_no='" . $admno . "' AND class_no='" . $classno . "' AND sec_no='" . $secno . "' AND sub_code='" . $subcode . "'";
		$query = $this->db->query($sql);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function update_marks_obtained_total_se($admno, $classno, $secno, $subcode, $marks)
	{


		$sql = "UPDATE marks_final_2021 SET se='" . $marks . "' WHERE adm_no='" . $admno . "' AND class_no='" . $classno . "' AND sec_no='" . $secno . "' AND sub_code='" . $subcode . "'";
		$query = $this->db->query($sql);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	function update_marks_obtained_total_pt($admno, $classno, $secno, $subcode, $marks)
	{


		$sql = "UPDATE marks_final_2021 SET pt_qm='" . $marks . "' WHERE adm_no='" . $admno . "' AND class_no='" . $classno . "' AND sec_no='" . $secno . "' AND sub_code='" . $subcode . "'";
		$query = $this->db->query($sql);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}


	//Fetch Max Marks

	function get_max_marks($examcode, $class_no, $sub_code)
	{
		$sql = "SELECT coalesce(MaxMarks,'0') as MaxMarks FROM maxmarks_2021 WHERE ExamCode=? AND ClassCode=? AND teacher_code=?";
		$query = $this->db->query($sql, array($examcode, $class_no, $sub_code));
		//if($query->num_rows() == 0)	return FALSE; 
		return $query->row();
	}
	function get_max_marks_twelve($examcode, $class_no, $sub_code, $ptype)
	{
		$sql = "SELECT coalesce(MaxMarks,'0') as MaxMarks FROM maxmarks_2021 WHERE ExamCode=? AND ClassCode=? AND teacher_code=? and TYPE=?";
		$query = $this->db->query($sql, array($examcode, $class_no, $sub_code, $ptype));
		//if($query->num_rows() == 0)	return FALSE; 
		return $query->row();
	}

	function update_marks_mtse1($admno, $classno, $secno, $subcode, $marksmax, $marks, $marks_f)
	{
		$sql = "UPDATE marks_final_2021 SET max_mark_se1='" . $marksmax . "',mtse1='" . $marks . "',mtse1_f='" . $marks_f . "' WHERE adm_no='" . $admno . "' AND class_no='" . $classno . "' AND sec_no='" . $secno . "' AND sub_code='" . $subcode . "'";
		$query = $this->db->query($sql);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	function update_marks_mtse2($admno, $classno, $secno, $subcode, $marksmax, $marks, $marks_f)
	{


		$sql = "UPDATE marks_final_2021 SET max_mark_se2='" . $marksmax . "',mtse2='" . $marks . "',mtse2_f='" . $marks_f . "' WHERE adm_no='" . $admno . "' AND class_no='" . $classno . "' AND sec_no='" . $secno . "' AND sub_code='" . $subcode . "'";
		$query = $this->db->query($sql);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function update_total_field_prep($adm_no, $class_no, $sec_no)
	{
		$sql = "UPDATE marks_final_2021 SET total=(SELECT SUM(marks_obtained_total)AS total FROM marks_final_2021 WHERE adm_no='" . $adm_no . "'
		AND class_no=" . $class_no . " AND sec_no=" . $sec_no . " AND sub_code IN (1,2,3,9)) WHERE adm_no='" . $adm_no . "'
		AND class_no=" . $class_no . " AND sec_no=" . $sec_no . "";
		$query = $this->db->query($sql);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	function update_total_field_prep_nine($adm_no, $class_no, $sec_no)
	{
		$sql = "UPDATE marks_final_2021 SET total=(SELECT SUM(marks_obtained_f)AS total FROM marks_final_2021 WHERE adm_no='" . $adm_no . "'
		AND class_no=" . $class_no . " AND sec_no=" . $sec_no . " AND sub_code IN (1,2,3,4,5,6,20,21,22,23)) WHERE adm_no='" . $adm_no . "'
		AND class_no=" . $class_no . " AND sec_no=" . $sec_no . "";
		$query = $this->db->query($sql);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	function update_total_field_prep_ten($adm_no, $class_no, $sec_no)
	{
		$sql = "UPDATE marks_final_2021 SET total=(SELECT SUM(marks_obtained_f)AS total FROM marks_final_2021 WHERE adm_no='" . $adm_no . "'
		AND class_no=" . $class_no . " AND sec_no=" . $sec_no . " AND sub_code IN (47,2,3,4,5,6,20,21,22,23)) WHERE adm_no='" . $adm_no . "'
		AND class_no=" . $class_no . " AND sec_no=" . $sec_no . "";
		$query = $this->db->query($sql);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	function update_total_field_prep_eleven($adm_no, $class_no, $sec_no)
	{
		$sql = "UPDATE marks_final_2021 SET total=(SELECT SUM(marks_obtained_total)AS total FROM marks_final_2021 WHERE adm_no='" . $adm_no . "'
		AND class_no=" . $class_no . " AND sec_no=" . $sec_no . " AND sub_code IN (3,15,16,17,18,19,24,26,27,29,30,35,36,38,39,40,43,45)) WHERE adm_no='" . $adm_no . "'
		AND class_no=" . $class_no . " AND sec_no=" . $sec_no . "";
		$query = $this->db->query($sql);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	function update_total_field_prep_twelve($adm_no, $class_no, $sec_no)
	{
		$sql = "UPDATE marks_final_2021 SET total=(SELECT SUM(marks_obtained_total)AS total FROM marks_final_2021 WHERE adm_no='" . $adm_no . "'
		AND class_no=" . $class_no . " AND sec_no=" . $sec_no . " AND sub_code IN (19,24,25,26,27,29,30,35,36,38,39,40,43,45,51,3,16,17,18)) WHERE adm_no='" . $adm_no . "'
		AND class_no=" . $class_no . " AND sec_no=" . $sec_no . "";
		$query = $this->db->query($sql);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	function update_total_field_prep_new($adm_no, $class_no, $sec_no)
	{
		$sql = "UPDATE marks_final_2021 SET total=(SELECT SUM(marks_obtained_total)AS total FROM marks_final_2021 WHERE adm_no='" . $adm_no . "'
		AND class_no=" . $class_no . " AND sec_no=" . $sec_no . " AND sub_code IN (1,2,3,4,5)) WHERE adm_no='" . $adm_no . "'
		AND class_no=" . $class_no . " AND sec_no=" . $sec_no . "";
		$query = $this->db->query($sql);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	function update_total_field_prep_new_one($adm_no, $class_no, $sec_no)
	{
		$sql = "UPDATE marks_final_2021 SET total=(SELECT SUM(marks_obtained_total)AS total FROM marks_final_2021 WHERE adm_no='" . $adm_no . "'
		AND class_no=" . $class_no . " AND sec_no=" . $sec_no . " AND sub_code IN (1,2,3,4,5,49,50,51,52,53)) WHERE adm_no='" . $adm_no . "'
		AND class_no=" . $class_no . " AND sec_no=" . $sec_no . "";
		$query = $this->db->query($sql);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	function update_total_field_prep_new_one_five($adm_no, $class_no, $sec_no)
	{
		$sql = "UPDATE marks_final_2021 SET total=(SELECT SUM(marks_obtained_total)AS total FROM marks_final_2021 WHERE adm_no='" . $adm_no . "'
		AND class_no=" . $class_no . " AND sec_no=" . $sec_no . " AND sub_code IN (1,2,3,17,18,48,15,19,49,50,51,52,53)) WHERE adm_no='" . $adm_no . "'
		AND class_no=" . $class_no . " AND sec_no=" . $sec_no . "";
		$query = $this->db->query($sql);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	function update_percentage_field_prep($adm_no, $class_no, $sec_no)
	{
		$sql = "UPDATE marks_final_2021 SET percentage=(
			(SELECT total FROM marks_final_2021 WHERE adm_no='" . $adm_no . "'
			AND class_no=" . $class_no . " AND sec_no=" . $sec_no . " LIMIT 1)*100/200
			) WHERE adm_no='" . $adm_no . "'
			AND class_no=" . $class_no . " AND sec_no=" . $sec_no;
		$query = $this->db->query($sql);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	function update_percentage_field_one($adm_no, $class_no, $sec_no)
	{
		$sql = "UPDATE marks_final_2021 SET percentage=(
			(SELECT total FROM marks_final_2021 WHERE adm_no='" . $adm_no . "'
			AND class_no=" . $class_no . " AND sec_no=" . $sec_no . " LIMIT 1)*100/400
			) WHERE adm_no='" . $adm_no . "'
			AND class_no=" . $class_no . " AND sec_no=" . $sec_no;
		$query = $this->db->query($sql);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	function update_percentage_field_two($adm_no, $class_no, $sec_no)
	{
		$sql = "UPDATE marks_final_2021 SET percentage=(
			(SELECT total FROM marks_final_2021 WHERE adm_no='" . $adm_no . "'
			AND class_no=" . $class_no . " AND sec_no=" . $sec_no . " LIMIT 1)*100/500
			) WHERE adm_no='" . $adm_no . "'
			AND class_no=" . $class_no . " AND sec_no=" . $sec_no;
		$query = $this->db->query($sql);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	function update_percentage_field_six($adm_no, $class_no, $sec_no)
	{
		$sql = "UPDATE marks_final_2021 SET percentage=(
			(SELECT total FROM marks_final_2021 WHERE adm_no='" . $adm_no . "'
			AND class_no=" . $class_no . " AND sec_no=" . $sec_no . " LIMIT 1)*100/600
			) WHERE adm_no='" . $adm_no . "'
			AND class_no=" . $class_no . " AND sec_no=" . $sec_no;
		$query = $this->db->query($sql);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	//
	function update_percentage_field_ten($adm_no, $class_no, $sec_no)
	{
		$sql = "UPDATE marks_final_2021 SET percentage=(
			(SELECT total FROM marks_final_2021 WHERE adm_no='" . $adm_no . "'
			AND class_no=" . $class_no . " AND sec_no=" . $sec_no . " LIMIT 1)*100/400
			) WHERE adm_no='" . $adm_no . "'
			AND class_no=" . $class_no . " AND sec_no=" . $sec_no;
		$query = $this->db->query($sql);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	function get_passfail_status_prep($adm_no, $class_no, $sec_no, $sub_code)
	{
		$sql = "SELECT t2.*,IF(t2.marks_obtained_total>=t2.pmarks, 'p', 'f') as pass_fail FROM(
			SELECT t1.*,t1.max_number*40/100 AS pmarks FROM(
			SELECT t.sub_code,
			SUM(t.max_pt+max_se+max_hy)AS max_number,t.marks_obtained_total FROM(
			SELECT a.sub_code,
			a.max_mark_m1/2 AS max_pt,sum(a.max_mark_se1+a.max_mark_se2) AS max_se,a.max_mark_hy AS max_hy,
			a.marks_obtained_total
			 FROM marks_final_2021 a WHERE a.adm_no=? AND a.class_no=? AND a.sec_no=?
			AND a.sub_code=?)t
			)t1
			)t2";

		$query = $this->db->query($sql, array($adm_no, $class_no, $sec_no, $sub_code));
		//if($query->num_rows() == 0)	return FALSE; 
		return $query->row();
	}

	function get_passfail_status_prep_others($adm_no, $class_no, $sec_no, $sub_code)
	{
		$sql = "SELECT t2.*,IF(t2.marks_obtained_total>=t2.pmarks, 'p', 'f') as pass_fail FROM(
			SELECT t1.*,t1.max_number*40/100 AS pmarks FROM(
			SELECT t.sub_code,
			SUM(max_hy)AS max_number,t.marks_obtained_total FROM(
			SELECT a.sub_code,
		    a.max_mark_hy AS max_hy,
			a.marks_obtained_total
			 FROM marks_final_2021 a WHERE a.adm_no=? AND a.class_no=? AND a.sec_no=?
			AND a.sub_code=?)t
			)t1
			)t2";

		$query = $this->db->query($sql, array($adm_no, $class_no, $sec_no, $sub_code));
		//if($query->num_rows() == 0)	return FALSE; 
		return $query->row();
	}
	function get_passfail_status_prep_others_eleven($adm_no, $class_no, $sec_no, $sub_code)
	{
		$sql = "SELECT t2.*,IF(t2.marks_obtained_total>=t2.pmarks, 'p', 'f') as pass_fail FROM(
			SELECT t1.*,t1.max_number*40/100 AS pmarks FROM(
			SELECT t.sub_code,
			SUM(max_hy)AS max_number,t.marks_obtained_total FROM(
			SELECT a.sub_code,
		    a.max_mark_hy AS max_hy,
			a.marks_obtained_total
			 FROM marks_final_2021 a WHERE a.adm_no=? AND a.class_no=? AND a.sec_no=?
			AND a.sub_code=?)t
			)t1
			)t2";

		$query = $this->db->query($sql, array($adm_no, $class_no, $sec_no, $sub_code));
		//if($query->num_rows() == 0)	return FALSE; 
		return $query->row();
	}
	function get_passfail_status_prep_others_twelve($adm_no, $class_no, $sec_no, $sub_code)
	{
		$sql = "SELECT t2.*,IF(t2.marks_obtained_total>=t2.pmarks, 'p', 'f') as pass_fail FROM(
			SELECT t1.*,t1.max_number*40/100 AS pmarks FROM(
			SELECT t.sub_code,
			SUM(max_hy)AS max_number,t.marks_obtained_total FROM(
			SELECT a.sub_code,
		    a.max_mark_hy AS max_hy,
			a.marks_obtained_total
			 FROM marks_final_2021 a WHERE a.adm_no=? AND a.class_no=? AND a.sec_no=?
			AND a.sub_code=?)t
			)t1
			)t2";

		$query = $this->db->query($sql, array($adm_no, $class_no, $sec_no, $sub_code));
		//if($query->num_rows() == 0)	return FALSE; 
		return $query->row();
	}

	function update_passfail_status($admno, $classno, $secno, $subcode, $marks)
	{
		$sql = "UPDATE marks_final_2021 SET passfail='" . $marks . "' WHERE adm_no='" . $admno . "' AND class_no='" . $classno . "' AND sec_no='" . $secno . "' AND sub_code='" . $subcode . "'";
		$query = $this->db->query($sql);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function get_rank_status_prep($adm_no, $class_no, $sec_no)
	{
		$sql = "SELECT t.*,IF(t.fresult>=1, 'n', 'y') as rank_status FROM
		(SELECT t2.*, FIND_IN_SET('f',t2.passfail)as fresult FROM (
			SELECT GROUP_CONCAT(a.passfail)AS passfail FROM marks_final_2021 a WHERE a.adm_no=?
			AND a.class_no=? AND a.sec_no=? AND a.sub_code IN (1,2,3,9)
			)t2)t";
		$query = $this->db->query($sql, array($adm_no, $class_no, $sec_no));
		return $query->row();
	}
	function get_rank_status_prep_other($adm_no, $class_no, $sec_no)
	{
		$sql = "SELECT t.*,IF(t.fresult>=1, 'n', 'y') as rank_status FROM
		(SELECT t2.*, FIND_IN_SET('f',t2.passfail)as fresult FROM (
			SELECT GROUP_CONCAT(a.passfail)AS passfail FROM marks_final_2021 a WHERE a.adm_no=?
			AND a.class_no=? AND a.sec_no=? AND a.sub_code IN (1,2,3,4,5,6)
			)t2)t";
		$query = $this->db->query($sql, array($adm_no, $class_no, $sec_no));
		return $query->row();
	}
	function get_rank_status_prep_other_ten($adm_no, $class_no, $sec_no)
	{
		$sql = "SELECT t.*,IF(t.fresult>=1, 'n', 'y') as rank_status FROM
		(SELECT t2.*, FIND_IN_SET('f',t2.passfail)as fresult FROM (
			SELECT GROUP_CONCAT(a.passfail)AS passfail FROM marks_final_2021 a WHERE a.adm_no=?
			AND a.class_no=? AND a.sec_no=? AND a.sub_code IN (47,2,3,4,5,6)
			)t2)t";
		$query = $this->db->query($sql, array($adm_no, $class_no, $sec_no));
		return $query->row();
	}
	function get_rank_status_prep_other_eleven($adm_no, $class_no, $sec_no)
	{
		$sql = "SELECT t.*,IF(t.fresult>=1, 'n', 'y') as rank_status FROM
		(SELECT t2.*, FIND_IN_SET('f',t2.passfail)as fresult FROM (
			SELECT GROUP_CONCAT(a.passfail)AS passfail FROM marks_final_2021 a WHERE a.adm_no=?
			AND a.class_no=? AND a.sec_no=? AND a.sub_code IN (3,15,16,17,18,19,24,26,27,29,30,35,36,38,39,40,43,45)
			)t2)t";
		$query = $this->db->query($sql, array($adm_no, $class_no, $sec_no));
		return $query->row();
	}
	function get_rank_status_prep_other_twelve($adm_no, $class_no, $sec_no)
	{
		$sql = "SELECT t.*,IF(t.fresult>=1, 'n', 'y') as rank_status FROM
		(SELECT t2.*, FIND_IN_SET('f',t2.passfail)as fresult FROM (
			SELECT GROUP_CONCAT(a.passfail)AS passfail FROM marks_final_2021 a WHERE a.adm_no=?
			AND a.class_no=? AND a.sec_no=? AND a.sub_code IN (19,24,25,26,27,29,30,35,36,38,39,40,43,45,51,3,16,17,18)
			)t2)t";
		$query = $this->db->query($sql, array($adm_no, $class_no, $sec_no));
		return $query->row();
	}
	function get_rank_status_prep_other_five($adm_no, $class_no, $sec_no)
	{
		$sql = "SELECT t.*,IF(t.fresult=1, 'n', 'y') as rank_status FROM
		(SELECT t2.*, FIND_IN_SET('f',t2.passfail)as fresult FROM (
			SELECT GROUP_CONCAT(a.passfail)AS passfail FROM marks_final_2021 a WHERE a.adm_no=?
			AND a.class_no=? AND a.sec_no=? AND a.sub_code IN (1,2,3,17,18,19,48,15,49,50,51,52,53)
			)t2)t";
		$query = $this->db->query($sql, array($adm_no, $class_no, $sec_no));
		return $query->row();
	}
	function update_rank_status($admno, $classno, $secno, $subcode, $marks)
	{
		$sql = "UPDATE marks_final_2021 SET rank='" . $marks . "' WHERE adm_no='" . $admno . "' AND class_no='" . $classno . "' AND sec_no='" . $secno . "' AND sub_code='" . $subcode . "'";
		$query = $this->db->query($sql);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	//================================Class Nine and Ten Starts=================

	function get_student_subjects_class_nine($class_no, $sec_no, $adm_no)
	{

		$sql = "SELECT a.Class_No,a.section_no,a.subject_code,b.SubSName,a.subj_nm,a.opt_code,a.sorting_no
FROM class_section_wise_subject_allocation_2021 a
INNER JOIN subjects b ON b.SubCode=a.subject_code
WHERE a.Class_No=? AND a.section_no=? AND a.opt_code IN (0,1) 
AND b.SubCode NOT IN (17,18,19,48,15)
UNION
SELECT c.CLASS AS Class_No,c.SEC AS section_no,a.SUBCODE AS subject_code, b.SubSName,
b.SubName AS subj_nm, a.OPTCODE AS opt_code,'99' AS sorting_no
FROM studentsubject_2021 a
INNER JOIN subjects b ON b.SubCode=a.SUBCODE
INNER JOIN student c ON c.ADM_NO=a.Adm_no
WHERE a.Class=? AND a.SEC=? AND a.Adm_no=? AND a.OPTCODE=2;";
		$query = $this->db->query($sql, array($class_no, $sec_no, $class_no, $sec_no, $adm_no));
		if ($query->num_rows() == 0)
			return FALSE;
		return $query->result();
	}
	function get_student_subjects_class_ten($class_no, $sec_no, $adm_no)
	{

		$sql = "SELECT a.Class_No,a.section_no,a.subject_code,b.SubSName,a.subj_nm,a.opt_code,a.sorting_no
FROM class_section_wise_subject_allocation_2021 a
INNER JOIN subjects b ON b.SubCode=a.subject_code
WHERE a.Class_No=? AND a.section_no=? AND a.opt_code IN (0,1) 
AND b.SubCode NOT IN (17,18,19,15,16,24)
UNION
SELECT c.CLASS AS Class_No,c.SEC AS section_no,a.SUBCODE AS subject_code, b.SubSName,
b.SubName AS subj_nm, a.OPTCODE AS opt_code,'99' AS sorting_no
FROM studentsubject_2021 a
INNER JOIN subjects b ON b.SubCode=a.SUBCODE
INNER JOIN student c ON c.ADM_NO=a.Adm_no
WHERE a.Class=? AND a.SEC=? AND a.Adm_no=? AND a.OPTCODE=2;";
		$query = $this->db->query($sql, array($class_no, $sec_no, $class_no, $sec_no, $adm_no));
		if ($query->num_rows() == 0)
			return FALSE;
		return $query->result();
	}

	function get_student_subjects_class_eleven($class_no, $sec_no, $adm_no)
	{

		$sql = "SELECT a.Class_No,a.section_no,a.subject_code,b.SubSName,a.subj_nm,a.opt_code,a.sorting_no
FROM class_section_wise_subject_allocation_2021 a
INNER JOIN subjects b ON b.SubCode=a.subject_code
WHERE a.Class_No=? AND a.section_no=?  AND a.applicable_exam='1' AND a.opt_code IN (0,1) 
UNION
SELECT c.CLASS AS Class_No,c.SEC AS section_no,a.SUBCODE AS subject_code, b.SubSName,
b.SubName AS subj_nm, a.OPTCODE AS opt_code,'99' AS sorting_no
FROM studentsubject_2021 a
INNER JOIN subjects b ON b.SubCode=a.SUBCODE
INNER JOIN student c ON c.ADM_NO=a.Adm_no
WHERE a.Class=? AND a.SEC=? AND a.Adm_no=? AND a.OPTCODE=2;";
		$query = $this->db->query($sql, array($class_no, $sec_no, $class_no, $sec_no, $adm_no));
		if ($query->num_rows() == 0)
			return FALSE;
		return $query->result();
	}

	function get_student_subjects_class_sex_eight($class_no, $sec_no, $adm_no)
	{

		$sql = "SELECT a.Class_No,a.section_no,a.subject_code,b.SubSName,a.subj_nm,a.opt_code,a.sorting_no
FROM class_section_wise_subject_allocation_2021 a
INNER JOIN subjects b ON b.SubCode=a.subject_code
WHERE a.Class_No=? AND a.section_no=? AND a.opt_code IN (0,1) 
AND b.SubCode NOT IN (38,12,55,60)
UNION
SELECT c.CLASS AS Class_No,c.SEC AS section_no,a.SUBCODE AS subject_code, b.SubSName,
b.SubName AS subj_nm, a.OPTCODE AS opt_code,'99' AS sorting_no
FROM studentsubject_2021 a
INNER JOIN subjects b ON b.SubCode=a.SUBCODE
INNER JOIN student c ON c.ADM_NO=a.Adm_no
WHERE a.Class=? AND a.SEC=? AND a.Adm_no=? AND a.OPTCODE=2;";
		$query = $this->db->query($sql, array($class_no, $sec_no, $class_no, $sec_no, $adm_no));
		if ($query->num_rows() == 0)
			return FALSE;
		return $query->result();
	}

	function update_marks_mtpt($admno, $classno, $secno, $subcode, $marksmax, $marks, $marks_f)
	{


		$sql = "UPDATE marks_final_2021 SET max_mark_pt='" . $marksmax . "',ptm1='" . $marks . "',ptm1_f='" . $marks_f . "' WHERE adm_no='" . $admno . "' AND class_no='" . $classno . "' AND sec_no='" . $secno . "' AND sub_code='" . $subcode . "'";
		$query = $this->db->query($sql);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	//=================================Class Nine and Ten Ends=================

	//=================================Class TWO to FIVE Starts==========================

	function update_marks_nb($admno, $classno, $secno, $subcode, $maxmarks, $marks, $marks_f)
	{


		$sql = "UPDATE marks_final_2021 SET max_mark_nb='" . $maxmarks . "',nbm1='" . $marks . "',nbm1_f='" . $marks_f . "' WHERE adm_no='" . $admno . "' AND class_no='" . $classno . "' AND sec_no='" . $secno . "' AND sub_code='" . $subcode . "'";
		$query = $this->db->query($sql);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function get_total_subject_wise($adm_no, $class_no, $sec_no, $sub_code)
	{
		$sql = "SELECT a.marks_obtained_per FROM marks_final_2021 a
		WHERE a.adm_no=? AND a.class_no=? AND a.sec_no=? AND a.sub_code=?";
		$query = $this->db->query($sql, array($adm_no, $class_no, $sec_no, $sub_code));

		//echo $this->db->last_query(); die();
		if ($this->db->affected_rows() >= 0) {
			return $query->row();
		} else {
			return false;
		}
	}
	function get_total_subject_wise_nine($adm_no, $class_no, $sec_no, $sub_code)
	{
		$sql = "SELECT a.marks_obtained_f FROM marks_final_2021 a
		WHERE a.adm_no=? AND a.class_no=? AND a.sec_no=? AND a.sub_code=?";
		$query = $this->db->query($sql, array($adm_no, $class_no, $sec_no, $sub_code));

		//echo $this->db->last_query(); die();
		if ($this->db->affected_rows() >= 0) {
			return $query->row();
		} else {
			return false;
		}
	}

	function update_grade_subject_wise($admno, $classno, $secno, $subcode, $grade)
	{
		$sql = "UPDATE marks_final_2021 SET grade='" . $grade . "' WHERE adm_no='" . $admno . "' AND class_no='" . $classno . "' AND sec_no='" . $secno . "' AND sub_code='" . $subcode . "'";
		$query = $this->db->query($sql);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function get_heighest_marks($class_no, $sec_no, $sub_code)
	{
		$sql = "SELECT max(a.marks_obtained_total+0)AS hmax
		FROM marks_final_2021 a WHERE a.class_no=? AND a.sec_no=? AND a.sub_code=?";
		$query = $this->db->query($sql, array($class_no, $sec_no, $sub_code));

		//echo $this->db->last_query(); die();
		if ($this->db->affected_rows() >= 0) {
			return $query->row();
		} else {
			return false;
		}
	}
	function get_average_marks($class_no, $sec_no, $sub_code, $cnt)
	{
		$sql = "SELECT sum(a.marks_obtained_total+0)/$cnt AS havg
		FROM marks_final_2021 a WHERE a.class_no=? AND a.sec_no=? AND a.sub_code=?";
		$query = $this->db->query($sql, array($class_no, $sec_no, $sub_code));

		//echo $this->db->last_query(); die();
		if ($this->db->affected_rows() >= 0) {
			return $query->row();
		} else {
			return false;
		}
	}
	function update_heighest_average($classno, $secno, $subcode, $hmax, $havg)
	{
		$sql = "UPDATE marks_final_2021 SET highest_marks='" . $hmax . "',avg_marks='" . $havg . "' WHERE class_no='" . $classno . "' AND sec_no='" . $secno . "' AND sub_code='" . $subcode . "'";
		$query = $this->db->query($sql);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function update_ability_test($adm_no, $classno, $secno, $ab1, $ab2)
	{
		$sql = "UPDATE marks_final_2021 SET ability_test_one='" . $ab1 . "',ability_test_two='" . $ab2 . "' WHERE adm_no='" . $adm_no . "' AND class_no='" . $classno . "' AND sec_no='" . $secno . "'";
		$query = $this->db->query($sql);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	//=================================Class TWO to FIVE ENDS==========================

	function get_exists($class_no, $sec_no)
	{
		$sql = "SELECT a.* FROM marks_final_2021 a WHERE a.class_no=? AND a.sec_no=? ";
		$query = $this->db->query($sql, array($class_no, $sec_no));

		if ($this->db->affected_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	//===============================Tabulation========================================
	function get_student_list_for_labulation_prep_one($classes, $sec, $subject)
	{
		$sql = "SELECT t.* FROM(
				SELECT a.ADM_NO,a.FIRST_NM,a.ROLL_NO,
			   b.adm_no AS admno,b.mtm1,b.mtm2,b.pt_qm,b.mtse1,b.mtse2,b.marks_obtained,
			   round(b.marks_obtained_total,2) AS marks_obtained_total,
			   round(b.marks_obtained_per,2)as marks_obtained_per,
			   CAST(b.marks_obtained_per AS DECIMAL(10,2)) AS marks_obtained_per1,
			   b.grade
				FROM student a
			   INNER JOIN marks_final_2021 b ON b.adm_no=a.ADM_NO
			   AND b.class_no=a.CLASS AND b.sec_no=a.SEC
			   WHERE a.CLASS=? AND a.SEC=?  AND b.sub_code=?
			   )t ORDER BY t.ROLL_NO";
		$query = $this->db->query($sql, array($classes, $sec, $subject));
		if ($this->db->affected_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	function get_student_list_for_labulation_two_five($classes, $sec, $subject)
	{
		$sql = "SELECT t.* FROM(
				SELECT a.ADM_NO,a.FIRST_NM,a.ROLL_NO,
			   b.adm_no AS admno,b.mtm1,b.mtm2,b.pt_qm,b.se,b.nbm1,b.marks_obtained,
			   round(b.marks_obtained_total,2) AS marks_obtained_total,
			   round(b.marks_obtained_per,2)as marks_obtained_per,
			   CAST(b.marks_obtained_per AS DECIMAL(10,2)) AS marks_obtained_per1,
			   b.grade,b.ptm1
				FROM student a
			   INNER JOIN marks_final_2021 b ON b.adm_no=a.ADM_NO
			   AND b.class_no=a.CLASS AND b.sec_no=a.SEC
			   WHERE a.CLASS=? AND a.SEC=?  AND b.sub_code=?
			   )t ORDER BY t.ROLL_NO";
		$query = $this->db->query($sql, array($classes, $sec, $subject));
		if ($this->db->affected_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	function get_subject_list_class_section_wise($class, $sec)
	{
		$sql = "SELECT a.Class_No,a.section_no,a.subject_code,b.SubSName,a.subj_nm,a.opt_code,a.sorting_no
			FROM class_section_wise_subject_allocation_2021 a
			INNER JOIN subjects b ON b.SubCode=a.subject_code
			WHERE a.Class_No=? AND a.section_no=? AND a.opt_code IN (0)";
		$query = $this->db->query($sql, array($class, $sec));
		if ($this->db->affected_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	function get_subject_list_class_section_wise_eleven($class, $sec)
	{
		$sql = "SELECT t.*
		FROM(
		SELECT a.Class_No,a.section_no,a.subject_code,a.subj_nm,a.sorting_no
		FROM class_section_wise_subject_allocation_2021 a
		WHERE a.Class_No=? AND a.section_no=? AND a.applicable_exam='1'
		GROUP BY a.Class_No,a.subject_code UNION ALL
		SELECT a.Class AS Class_No,a.SEC AS section_no,a.SUBCODE AS subject_code,b.SubName AS subj_nm,'99' AS sorting_no
		FROM studentsubject_2021 a
		INNER JOIN subjects b ON b.SubCode=a.SUBCODE
		WHERE a.Class=? AND a.SEC=? AND a.OPTCODE=2
		GROUP BY a.SUBCODE)t
		GROUP BY t.subj_nm
		ORDER BY t.sorting_no,t.subject_code";
		$query = $this->db->query($sql, array($class, $sec, $class, $sec));
		if ($this->db->affected_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	function get_subject_list_class_section_wise_eleven_wout_subopt_subj($class, $sec)
	{
		$sql = "SELECT t.*
		FROM(
		SELECT a.Class_No,a.section_no,a.subject_code,a.subj_nm,a.sorting_no
		FROM class_section_wise_subject_allocation_2021 a
		WHERE a.Class_No=? AND a.section_no=? AND a.applicable_exam='1' and a.opt_code<>2 and a.subject_code not in (28,33,34,44,62,65)
		GROUP BY a.Class_No,a.subject_code UNION ALL
		SELECT a.Class AS Class_No,a.SEC AS section_no,a.SUBCODE AS subject_code,b.SubName AS subj_nm,'99' AS sorting_no
		FROM studentsubject_2021 a
		INNER JOIN subjects b ON b.SubCode=a.SUBCODE
		WHERE a.Class=? AND a.SEC=? AND a.OPTCODE<>2  and a.SUBCODE not in (28,33,34,44,62,65)
		GROUP BY a.SUBCODE)t
		GROUP BY t.subj_nm
		ORDER BY t.sorting_no,t.subject_code";
		$query = $this->db->query($sql, array($class, $sec, $class, $sec));
		if ($this->db->affected_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	function get_subject_list_class_section_wise_consolidated($class, $sec)
	{
		$sql = "SELECT a.Class_No,a.section_no,a.subject_code,b.SubSName,a.subj_nm,a.opt_code,a.sorting_no
			FROM class_section_wise_subject_allocation a
			INNER JOIN subjects b ON b.SubCode=a.subject_code
			WHERE a.Class_No=? AND a.section_no=? and a.applicable_exam=1 ORDER BY a.sorting_no";
		$query = $this->db->query($sql, array($class, $sec));
		if ($this->db->affected_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	function get_student_list_for_grade_analysis($classes, $sec, $subject)
	{
		$sql = "SELECT t.*
			FROM(
			SELECT a.ADM_NO,a.FIRST_NM,a.ROLL_NO, b.adm_no AS admno,
			ROUND(b.marks_obtained_total,2) AS marks_obtained_total,
			 ROUND(b.marks_obtained_per,2) AS marks_obtained_per, 
			 b.grade,b.sub_code
			FROM student a
			INNER JOIN marks_final_2021 b ON b.adm_no=a.ADM_NO AND b.class_no=a.CLASS AND b.sec_no=a.SEC
			WHERE a.CLASS=? AND a.SEC=? AND b.sub_code=?)t
			ORDER BY t.ROLL_NO";
		$query = $this->db->query($sql, array($classes, $sec, $subject));
		if ($this->db->affected_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	//=====================================================================================

	function get_max_marks_combined($examcode, $class_no, $sub_code)
	{
		$sql = "SELECT coalesce(sum(maxmarks),'0') as MaxMarks FROM maxmarks_2021 
		WHERE ExamCode=? AND ClassCode=? AND teacher_code IN (" . $sub_code . ")";
		$query = $this->db->query($sql, array($examcode, $class_no));
		if ($this->db->affected_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}

	function get_marks_grade_for_grade_analysis($class_no, $sec_no, $subject_code, $adm_no)
	{
		$sql = "SELECT a.marks_obtained,a.grade,a.marks_obtained_total,
		a.marks_obtained_per,a.rank_in_section,a.rank_in_class,a.total,a.percentage,a.rank_in_class,a.nbm1
		 FROM marks_final_2021 a
		WHERE  a.class_no=? AND a.sec_no=?
		AND a.sub_code=? AND a.adm_no=?";
		$query = $this->db->query($sql, array($class_no, $sec_no, $subject_code, $adm_no));
		if ($this->db->affected_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}
	function get_marks_total_for_grade_analysis($class_no, $sec_no, $adm_no)
	{
		$sql = "SELECT a.marks_obtained,a.grade,a.marks_obtained_total, a.marks_obtained_per,a.rank_in_section,a.rank_in_class,a.total,a.percentage,a.rank_in_class,a.nbm1 FROM marks_final_2021 a WHERE a.class_no=?
		AND a.sec_no=?  AND a.adm_no=? GROUP BY a.adm_no";
		$query = $this->db->query($sql, array($class_no, $sec_no, $adm_no));
		if ($this->db->affected_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}

	function get_marks_grade_for_consolidated_analysis($class_no, $sec_no, $subject_code, $adm_no)
	{
		$sql = "SELECT a.*
		 FROM marks a
		WHERE  a.classes=? AND a.sec=?
		AND a.scode=? AND a.admno=? ORDER BY EXAMC";
		$query = $this->db->query($sql, array($class_no, $sec_no, $subject_code, $adm_no));
		if ($this->db->affected_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}
	
	function get_marks_grade_for_consolidated_analysis_new($class_no, $sec_no, $subject_code, $adm_no,$examc)
	{
		$sql = "SELECT a.M2,a.M3 FROM marks_temp a WHERE  a.classes=? AND a.sec=? AND a.scode=? AND a.admno=? AND examc=?";
		$query = $this->db->query($sql, array($class_no, $sec_no, $subject_code, $adm_no,$examc));
		if ($this->db->affected_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}
	
	function get_marks_grade_for_consolidated_analysis_new_iii($class_no, $sec_no, $subject_code, $adm_no,$examc,$trm)
	{
		$sql = "SELECT a.M2,a.M3 FROM marks_temp a WHERE  a.classes=? AND a.sec=? AND a.scode=? AND a.admno=? AND examc=? AND Term=?";
		$query = $this->db->query($sql, array($class_no, $sec_no, $subject_code, $adm_no,$examc,$trm));
		if ($this->db->affected_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}

	//=========================================Function for subject wise result analysis==================

	function get_subject_list($class_no)
	{
		$sql = "SELECT a.Class_No,a.section_no,a.subject_code,b.SubSName,a.subj_nm,a.opt_code,a.sorting_no,
		a.Main_Teacher_Code,c.emp_name
		FROM class_section_wise_subject_allocation_2021 a
		INNER JOIN subjects b ON b.SubCode=a.subject_code
		INNER JOIN login_details_2021 c ON c.user_id=a.Main_Teacher_Code
		WHERE a.Class_No=? AND a.opt_code IN (0) 
		GROUP BY a.subject_code";
		$query = $this->db->query($sql, array($class_no));
		if ($this->db->affected_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	function get_subject_list_five($class_no)
	{
		$sql = "SELECT a.Class_No,a.section_no,a.subject_code,b.SubSName,a.subj_nm,a.opt_code,a.sorting_no,
		a.Main_Teacher_Code,c.emp_name
		FROM class_section_wise_subject_allocation_2021 a
		INNER JOIN subjects b ON b.SubCode=a.subject_code
		INNER JOIN login_details_2021 c ON c.user_id=a.Main_Teacher_Code
		WHERE a.Class_No=? AND a.opt_code IN (0,2) 
		GROUP BY a.subject_code";
		$query = $this->db->query($sql, array($class_no));
		if ($this->db->affected_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	function get_avg_aggregate($class_no, $sec_no, $sub_code)
	{
		$sql = "SELECT sum(a.marks_obtained_total)/COUNT(a.adm_no) AS avg_agg FROM marks_final_2021 a
		WHERE a.class_no=? AND a.sec_no=? AND a.sub_code=?";
		$query = $this->db->query($sql, array($class_no, $sec_no, $sub_code));
		if ($this->db->affected_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}
	function get_above_ninty($class_no, $sec_no, $sub_code)
	{
		$sql = "SELECT count(a.marks_obtained_per) AS above_ninty FROM marks_final_2021 a
		WHERE a.class_no=? AND a.sec_no=? AND a.sub_code=?
		AND a.marks_obtained_per>90";
		$query = $this->db->query($sql, array($class_no, $sec_no, $sub_code));
		if ($this->db->affected_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}
	function get_above_between_seventyfive_ninty($class_no, $sec_no, $sub_code)
	{
		$sql = "SELECT count(a.marks_obtained_per) AS above_sev_ninty FROM marks_final_2021 a
		WHERE a.class_no=? AND a.sec_no=? AND a.sub_code=?
		AND a.marks_obtained_per>=75 AND  a.marks_obtained_per<=90";
		$query = $this->db->query($sql, array($class_no, $sec_no, $sub_code));
		if ($this->db->affected_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}
	function get_above_between_sixty_seventyfive($class_no, $sec_no, $sub_code)
	{
		$sql = "SELECT count(a.marks_obtained_per) AS above_six_sev FROM marks_final_2021 a
		WHERE a.class_no=? AND a.sec_no=? AND a.sub_code=?
		AND a.marks_obtained_per>=60 AND  a.marks_obtained_per<75";
		$query = $this->db->query($sql, array($class_no, $sec_no, $sub_code));
		if ($this->db->affected_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}
	function get_above_between_forty_sixty($class_no, $sec_no, $sub_code)
	{
		$sql = "SELECT count(a.marks_obtained_per) AS above_forty_sixty FROM marks_final_2021 a
		WHERE a.class_no=? AND a.sec_no=? AND a.sub_code=?
		AND a.marks_obtained_per>=40 AND  a.marks_obtained_per<60";
		$query = $this->db->query($sql, array($class_no, $sec_no, $sub_code));
		if ($this->db->affected_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}
	function get_above_between_below_forty($class_no, $sec_no, $sub_code)
	{
		$sql = "SELECT count(a.marks_obtained_per) AS below_forty FROM marks_final_2021 a
		WHERE a.class_no=? AND a.sec_no=? AND a.sub_code=?
		AND a.marks_obtained_per<40 ";
		$query = $this->db->query($sql, array($class_no, $sec_no, $sub_code));
		if ($this->db->affected_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}
	function get_faculty_name($sub_code, $class_no, $sec_no)
	{
		$sql = "SELECT emp_name FROM login_details WHERE user_id=(
			SELECT a.Main_Teacher_Code FROM class_section_wise_subject_allocation_2021 a
			WHERE a.subject_code=? AND a.Class_No=? AND a.section_no=?)";
		$query = $this->db->query($sql, array($sub_code, $class_no, $sec_no));
		if ($this->db->affected_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}
	function get_student_list_class_section_wise_new_for_rank_in_section($class, $sec)
	{
		$sql = "SELECT t.*,DENSE_RANK() OVER(ORDER BY t.percentage DESC) AS rank_place FROM(
			SELECT a.*
			FROM marks_final_2021 a
			WHERE a.class_no=? AND a.sec_no=? AND a.rank='y' GROUP BY a.adm_no)t";
		$query = $this->db->query($sql, array($class, $sec));
		if ($this->db->affected_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	function update_rank_in_section($rank_place, $adm_no, $class_no, $sec_no)
	{
		$sql = "UPDATE marks_final_2021 SET rank_in_section=?
		WHERE adm_no=? AND class_no=? AND sec_no=?";
		$query = $this->db->query($sql, array($rank_place, $adm_no, $class_no, $sec_no));

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	function update_rank_in_class($rank_place, $adm_no, $class_no, $sec_no)
	{
		$sql = "UPDATE marks_final_2021 SET rank_in_class=?
		WHERE adm_no=? AND class_no=? AND sec_no=?";
		$query = $this->db->query($sql, array($rank_place, $adm_no, $class_no, $sec_no));

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function get_student_list_class_section_wise_new_for_rank_in_class($class)
	{
		$sql = "SELECT t.*,DENSE_RANK() OVER(ORDER BY t.percentage DESC) AS rank_place FROM(
			SELECT a.*
			FROM marks_final_2021 a
			WHERE a.class_no=?  AND a.rank='y' GROUP BY a.adm_no)t";
		$query = $this->db->query($sql, array($class));
		if ($this->db->affected_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	//class XI
	function get_student_list_class_section_wise_new_for_rank_in_class_eleven($class, $sec)
	{
		$sql = "SELECT t.*,DENSE_RANK() OVER(ORDER BY t.percentage DESC) AS rank_place FROM(
			SELECT a.*
			FROM marks_final_2021 a
			WHERE a.class_no='" . $class . "' and a.disp_sec in ($sec) AND a.rank='y' GROUP BY a.adm_no)t";


		$query = $this->db->query($sql);
		if ($this->db->affected_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}




	function match_misc_table($passtxt)
	{
		$sql = "SELECT * from misc_password WHERE username='dpsreportcard' AND PASSWORD=?";
		$query = $this->db->query($sql, array($passtxt));
		if ($this->db->affected_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}

	function insert_delete($data)
	{
		if ($this->db->insert('result_delete_status', $data))
			//return TRUE;
			return $this->db->insert_id();
		else
			return FALSE;
	}
	function delete_from_table($class_no, $secno)
	{
		$sql = "DELETE FROM marks_final_2021 WHERE class_no=? and sec_no=?";
		$query = $this->db->query($sql, array($class_no, $secno));
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function get_student_subjects_class_optional($class_no, $sec_no, $adm_no)
	{

		$sql = "SELECT c.CLASS AS Class_No,c.SEC AS section_no,a.SUBCODE AS subject_code, b.SubSName,
b.SubName AS subj_nm, a.OPTCODE AS opt_code,'99' AS sorting_no
FROM studentsubject_2021 a
INNER JOIN subjects b ON b.SubCode=a.SUBCODE
INNER JOIN student c ON c.ADM_NO=a.Adm_no
WHERE a.Class=? AND a.SEC=? AND a.Adm_no=? AND a.OPTCODE=2;";
		$query = $this->db->query($sql, array($class_no, $sec_no, $adm_no));
		if ($query->num_rows() == 0)
			return FALSE;
		return $query->row();
	}
	function get_student_subjects_class_optional_other($class_no, $sec_no, $adm_no)
	{

		$sql = "SELECT c.CLASS AS Class_No,c.SEC AS section_no,a.SUBCODE AS subject_code, b.SubSName,
b.SubName AS subj_nm, a.OPTCODE AS opt_code,'99' AS sorting_no
FROM studentsubject_2021 a
INNER JOIN subjects b ON b.SubCode=a.SUBCODE
INNER JOIN student c ON c.ADM_NO=a.Adm_no
WHERE a.Class=? AND a.SEC=? AND a.Adm_no=? AND a.OPTCODE=2;";
		$query = $this->db->query($sql, array($class_no, $sec_no, $adm_no));
		if ($query->num_rows() == 0)
			return FALSE;
		return $query->result();
	}

	function get_section_nm($sec)
	{
		$sql = "SELECT * FROM sections WHERE section_no=?";

		$query = $this->db->query($sql, array($sec));
		return $query->row();
	}
	function get_student_count($class_no, $sec_no, $sub_code)
	{
		$sql = "SELECT COUNT(a.adm_no)AS cnt FROM marks_final_2021 a WHERE a.class_no=? AND a.sec_no=? AND a.sub_code=?";

		$query = $this->db->query($sql, array($class_no, $sec_no, $sub_code));
		return $query->row();
	}

	function get_top_five($class_no, $sec_no)
	{
		$sql = "SELECT a.adm_no,b.ROLL_NO,b.FIRST_NM,a.marks_obtained_per,a.rank_in_section FROM marks_final_2021 a
		INNER JOIN student b ON b.ADM_NO=a.adm_no
		 WHERE a.class_no=? AND a.sec_no=?
		and RANK='y' 
		GROUP BY a.adm_no
		ORDER BY a.rank_in_section+0 ASC LIMIT 5
		";

		$query = $this->db->query($sql, array($class_no, $sec_no));
		return $query->result();
	}

	function get_student_securing_below_forty($class_no, $sec_no, $sub_code)
	{
		$sql = "SELECT a.adm_no,b.ROLL_NO,b.FIRST_NM,a.marks_obtained_per,a.rank_in_section,a.sub_code FROM marks_final_2021 a
		INNER JOIN student b ON b.ADM_NO=a.adm_no
		 WHERE a.class_no=? AND a.sec_no=? 
		 AND a.sub_code =?
		 AND a.marks_obtained_per<40";

		$query = $this->db->query($sql, array($class_no, $sec_no, $sub_code));
		return $query->result();
	}
	function get_student_securing_below_forty_hello($class_no, $sec_no, $sub_code)
	{
		$sql = "SELECT a.adm_no,b.ROLL_NO,b.FIRST_NM,a.marks_obtained_total,a.rank_in_section,a.sub_code FROM marks_final_2021 a
		INNER JOIN student b ON b.ADM_NO=a.adm_no
		 WHERE a.class_no=? AND a.sec_no=? 
		 AND a.sub_code =?
		 AND a.marks_obtained_per<40";

		$query = $this->db->query($sql, array($class_no, $sec_no, $sub_code));
		return $query->result();
	}
	function get_student_securing_below_forty_new($class_no, $sec_no)
	{
		$sql = "
SELECT a.adm_no,
b.ROLL_NO,
b.FIRST_NM,
SUM(case when a.sub_code='1' then a.marks_obtained END) AS 'English' ,
SUM(case when a.sub_code='2' then a.marks_obtained END) AS 'Hindi' ,
SUM(case when a.sub_code='3' then a.marks_obtained END) AS 'Math' ,
SUM(case when a.sub_code='4' then a.marks_obtained END) AS 'Science' ,
SUM(case when a.sub_code='5' then a.marks_obtained END) AS 'SS' 
 from marks_final_2021 a
INNER JOIN student b ON b.ADM_NO=a.adm_no AND b.CLASS=a.class_no AND b.SEC=a.sec_no
WHERE a.class_no=? AND a.sec_no=? AND a.adm_no IN (
SELECT a.adm_no
 from marks_final_2021 a
INNER JOIN student b ON b.ADM_NO=a.adm_no AND b.CLASS=a.class_no AND b.SEC=a.sec_no
WHERE a.class_no=? AND a.sec_no=? AND a.marks_obtained<a.max_mark_hy*40/100
GROUP BY a.adm_no
ORDER BY b.ROLL_NO
)
GROUP BY a.adm_no
ORDER BY b.ROLL_NO;
		";

		$query = $this->db->query($sql, array($class_no, $sec_no, $class_no, $sec_no));
		return $query->result();
	}

	function get_rank_on_eighty($class_no, $sec_no, $adm_no)
	{
		$sql = " SELECT pp.* FROM(
			SELECT p.*, DENSE_RANK() OVER(
			ORDER BY p.per DESC) AS rank_place
			FROM(
			SELECT t.*, ROUND(t.final_tot*100/400,1) AS per
			FROM(
			SELECT a.adm_no,a.class_no,a.sec_no, SUM(ROUND(a.marks_obtained,0)) AS final_tot
			FROM marks_final_2021 a
			WHERE a.class_no=? AND a.sec_no=? AND a.rank='y'
			GROUP BY a.adm_no)t)p
			)pp
			WHERE pp.adm_no=?";

		$query = $this->db->query($sql, array($class_no, $sec_no, $adm_no));
		return $query->row();
	}

	function get_rank_on_eighty_eleven($class_no, $sec_no, $adm_no)
	{
		$sql = " SELECT pp.* FROM(
			SELECT p.*, DENSE_RANK() OVER(
			ORDER BY p.per DESC) AS rank_place
			FROM(
			SELECT t.*, ROUND(t.final_tot*100/400,1) AS per
			FROM(
			SELECT a.adm_no,a.class_no,a.sec_no, SUM(ROUND(a.marks_obtained,0)) AS final_tot
			FROM marks_final_2021 a
			WHERE a.class_no=? AND a.sec_no=? AND a.rank='y'
			GROUP BY a.adm_no)t)p
			)pp
			WHERE pp.adm_no=?";

		$query = $this->db->query($sql, array($class_no, $sec_no, $adm_no));
		return $query->row();
	}

	function get_maxmark_eleven($class_no, $sec_no, $subject_code)
	{
		$sql = "SELECT max_mark_hy from marks_final_2021 WHERE class_no=? AND sec_no=? AND sub_code=?
		GROUP BY max_mark_hy";
		$query = $this->db->query($sql, array($class_no, $sec_no, $subject_code));
		return $query->row();
	}


	//====================After Exam==================
	function get_subject_list_class_section_wise_consolidated_third_language($class, $sec)
	{
		$sql = "SELECT a.Class_No,a.section_no,a.subject_code,b.SubSName,a.subj_nm,a.opt_code,a.sorting_no
			FROM class_section_wise_subject_allocation_2021 a
			INNER JOIN subjects b ON b.SubCode=a.subject_code
			WHERE a.Class_No=? AND a.section_no=? AND a.opt_code IN (2)";
		$query = $this->db->query($sql, array($class, $sec));
		if ($this->db->affected_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	// 07-02-23
	public function get_marks_grade_for_grade_analysis_annual($class, $sec, $subj, $exam, $admno)
	{
		$sql = "SELECT a.M1,a.M2,a.M3,a.TYPE FROM marks_2021 a WHERE a.Classes=? AND a.Sec=? AND a.SCode=? AND a.Term='TERM-2' AND ExamC=? AND a.admno=?";

		$query = $this->db->query($sql, array($class, $sec, $subj, $exam, $admno));
		if ($this->db->affected_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}


	function subject_wise_tabulation_prep_one($classes, $sec, $subject)
	{
		$sql = "SELECT s.ADM_NO,s.FIRST_NM,s.ROLL_NO,
		(SELECT distinct M2 from marks_2021 WHERE admno=s.ADM_NO and ExamC=1 and SCode='$subject' group by admno)mt1,
		(SELECT distinct M2 from marks_2021 WHERE admno=s.ADM_NO and ExamC=2 and SCode='$subject' group by admno)mt2,
		(SELECT distinct M2 from marks_2021 WHERE admno=s.ADM_NO and ExamC=3 and SCode='$subject' group by admno)mt3,
		(SELECT distinct M2 from marks_2021 WHERE admno=s.ADM_NO and ExamC=4 and SCode='$subject' group by admno)mt4,
		(SELECT distinct M2 from marks_2021 WHERE admno=s.ADM_NO and ExamC=19 and SCode='$subject' group by admno)mt5,
		(SELECT distinct M2 from marks_2021 WHERE admno=s.ADM_NO and ExamC=20 and SCode='$subject' group by admno)mt6,
		
		(SELECT distinct M2 from marks_2021 WHERE admno=s.ADM_NO and ExamC=11 and SCode='$subject' group by admno)se1,
		(SELECT distinct M2 from marks_2021 WHERE admno=s.ADM_NO and ExamC=12 and SCode='$subject' group by admno)se2,
		(SELECT distinct M2 from marks_2021 WHERE admno=s.ADM_NO and ExamC=13 and SCode='$subject' group by admno)se3,
		(SELECT distinct M2 from marks_2021 WHERE admno=s.ADM_NO and ExamC=15 and SCode='$subject' group by admno)se4,
		
		(SELECT distinct M2 from marks_2021 WHERE admno=s.ADM_NO and ExamC=22 and SCode='$subject' and Term='TERM-1' group by admno)nb1,
		(SELECT distinct M2 from marks_2021 WHERE admno=s.ADM_NO and ExamC=22 and SCode='$subject' and Term='TERM-2' group by admno)nb2,

		(SELECT distinct M2 from marks_2021 WHERE admno=s.ADM_NO and ExamC=6 and SCode='$subject' group by admno)first_sem,
		(SELECT distinct M2 from marks_2021 WHERE admno=s.ADM_NO and ExamC=16 and SCode='$subject' group by admno)second_sem
		
		from student s where s.CLASS=? and s.SEC=? AND Student_Status='ACTIVE' ORDER BY s.ROLL_NO ASC";



		$query = $this->db->query($sql, array($classes, $sec));
		if ($this->db->affected_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	function subject_wise_tabulation_two_to_five($classes, $sec, $subject)
	{
		$sql = "SELECT s.ADM_NO,s.FIRST_NM,s.ROLL_NO,
		(SELECT distinct M2 from marks_2021 WHERE admno=s.ADM_NO and ExamC=1 and SCode='$subject' group by admno)mt1,
		(SELECT distinct M2 from marks_2021 WHERE admno=s.ADM_NO and ExamC=2 and SCode='$subject' group by admno)mt2,
		(SELECT distinct M2 from marks_2021 WHERE admno=s.ADM_NO and ExamC=3 and SCode='$subject' group by admno)mt3,
		(SELECT distinct M2 from marks_2021 WHERE admno=s.ADM_NO and ExamC=4 and SCode='$subject' group by admno)mt4,
		(SELECT distinct M2 from marks_2021 WHERE admno=s.ADM_NO and ExamC=19 and SCode='$subject' group by admno)mt5,
		(SELECT distinct M2 from marks_2021 WHERE admno=s.ADM_NO and ExamC=20 and SCode='$subject' group by admno)mt6,
		
		(SELECT distinct M2 from marks_2021 WHERE admno=s.ADM_NO and ExamC=11 and SCode='$subject' group by admno)se1,
		(SELECT distinct M2 from marks_2021 WHERE admno=s.ADM_NO and ExamC=12 and SCode='$subject' group by admno)se2,
		(SELECT distinct M2 from marks_2021 WHERE admno=s.ADM_NO and ExamC=13 and SCode='$subject' group by admno)se3,
		(SELECT distinct M2 from marks_2021 WHERE admno=s.ADM_NO and ExamC=15 and SCode='$subject' group by admno)se4,
		
		(SELECT distinct M2 from marks_2021 WHERE admno=s.ADM_NO and ExamC=22 and SCode='$subject' and Term='TERM-1' group by admno)nb1,
		(SELECT distinct M2 from marks_2021 WHERE admno=s.ADM_NO and ExamC=22 and SCode='$subject' and Term='TERM-2' group by admno)nb2,

		(SELECT distinct M2 from marks_2021 WHERE admno=s.ADM_NO and ExamC=6 and SCode='$subject' group by admno)first_sem,
		(SELECT distinct M2 from marks_2021 WHERE admno=s.ADM_NO and ExamC=16 and SCode='$subject' group by admno)second_sem
		
		from student s where s.CLASS=? and s.SEC=? AND Student_Status='ACTIVE' ORDER BY s.ROLL_NO ASC";



		$query = $this->db->query($sql, array($classes, $sec));
		if ($this->db->affected_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	function prep_to_two_grade_analysis($adm, $subject, $class, $sec)
	{
		$sql = "SELECT s.ADM_NO,s.FIRST_NM,s.ROLL_NO,
		(SELECT distinct M2 from marks_2021 WHERE admno=s.ADM_NO and ExamC=1 and SCode='$subject' AND CLasses='$class' AND sec='$sec' group by admno)mt1,
		(SELECT distinct M2 from marks_2021 WHERE admno=s.ADM_NO and ExamC=2 and SCode='$subject' AND CLasses='$class' AND sec='$sec' group by admno)mt2,
		(SELECT distinct M2 from marks_2021 WHERE admno=s.ADM_NO and ExamC=3 and SCode='$subject' AND CLasses='$class' AND sec='$sec' group by admno)mt3,
		(SELECT distinct M2 from marks_2021 WHERE admno=s.ADM_NO and ExamC=4 and SCode='$subject' AND CLasses='$class' AND sec='$sec' group by admno)mt4,
		(SELECT distinct M2 from marks_2021 WHERE admno=s.ADM_NO and ExamC=19 and SCode='$subject' AND CLasses='$class' AND sec='$sec' group by admno)mt5,
		(SELECT distinct M2 from marks_2021 WHERE admno=s.ADM_NO and ExamC=20 and SCode='$subject' AND CLasses='$class' AND sec='$sec' group by admno)mt6,
		
		(SELECT distinct M2 from marks_2021 WHERE admno=s.ADM_NO and ExamC=11 and SCode='$subject' AND CLasses='$class' AND sec='$sec' group by admno)se1,
		(SELECT distinct M2 from marks_2021 WHERE admno=s.ADM_NO and ExamC=12 and SCode='$subject' AND CLasses='$class' AND sec='$sec' group by admno)se2,
		(SELECT distinct M2 from marks_2021 WHERE admno=s.ADM_NO and ExamC=13 and SCode='$subject' AND CLasses='$class' AND sec='$sec' group by admno)se3,
		(SELECT distinct M2 from marks_2021 WHERE admno=s.ADM_NO and ExamC=15 and SCode='$subject' AND CLasses='$class' AND sec='$sec' group by admno)se4,
		
		(SELECT distinct M2 from marks_2021 WHERE admno=s.ADM_NO and ExamC=22 and SCode='$subject' and Term='TERM-1' AND CLasses='$class' AND sec='$sec' group by admno)nb1,
		(SELECT distinct M2 from marks_2021 WHERE admno=s.ADM_NO and ExamC=22 and SCode='$subject' and Term='TERM-2' AND CLasses='$class' AND sec='$sec' group by admno)nb2,

		(SELECT distinct M2 from marks_2021 WHERE admno=s.ADM_NO and ExamC=6 and SCode='$subject' AND CLasses='$class' AND sec='$sec' group by admno)first_sem,
		(SELECT M2 from marks_2021 WHERE admno=s.ADM_NO and ExamC=16 and SCode='$subject' AND CLasses='$class' AND sec='$sec' group by admno)second_sem
		
		from student s where s.ADM_NO=? ORDER BY s.ROLL_NO ASC";



		$query = $this->db->query($sql, array($adm));
		if ($this->db->affected_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	
function prep_to_two_grade_analysis_new($adm, $subject, $class, $sec)
	{
		$sql = "SELECT s.ADM_NO,s.FIRST_NM,s.ROLL_NO,
		(SELECT M3 from marks_2021 WHERE admno=s.ADM_NO and ExamC=1 and SCode='$subject' AND CLasses='$class' AND sec='$sec')mt1,
		(SELECT M3 from marks_2021 WHERE admno=s.ADM_NO and ExamC=2 and SCode='$subject' AND CLasses='$class' AND sec='$sec')mt2,
		(SELECT M3 from marks_2021 WHERE admno=s.ADM_NO and ExamC=3 and SCode='$subject' AND CLasses='$class' AND sec='$sec')mt3,
		(SELECT M3 from marks_2021 WHERE admno=s.ADM_NO and ExamC=4 and SCode='$subject' AND CLasses='$class' AND sec='$sec')mt4,
		(SELECT M3 from marks_2021 WHERE admno=s.ADM_NO and ExamC=19 and SCode='$subject' AND CLasses='$class' AND sec='$sec')mt5,
		(SELECT M3 from marks_2021 WHERE admno=s.ADM_NO and ExamC=20 and SCode='$subject' AND CLasses='$class' AND sec='$sec')mt6,
		
		(SELECT M3 from marks_2021 WHERE admno=s.ADM_NO and ExamC=11 and SCode='$subject' AND CLasses='$class' AND sec='$sec')se1,
		(SELECT M3 from marks_2021 WHERE admno=s.ADM_NO and ExamC=12 and SCode='$subject' AND CLasses='$class' AND sec='$sec')se2,
		(SELECT M3 from marks_2021 WHERE admno=s.ADM_NO and ExamC=13 and SCode='$subject' AND CLasses='$class' AND sec='$sec')se3,
		(SELECT M3 from marks_2021 WHERE admno=s.ADM_NO and ExamC=15 and SCode='$subject' AND CLasses='$class' AND sec='$sec')se4,
		
		(SELECT M3 from marks_2021 WHERE admno=s.ADM_NO and ExamC=22 and SCode='$subject' and Term='TERM-1' AND CLasses='$class' AND sec='$sec')nb1,
		(SELECT M3 from marks_2021 WHERE admno=s.ADM_NO and ExamC=22 and SCode='$subject' and Term='TERM-2' AND CLasses='$class' AND sec='$sec')nb2,

		(SELECT M3 from marks_2021 WHERE admno=s.ADM_NO and ExamC=6 and SCode='$subject' AND CLasses='$class' AND sec='$sec')first_sem,
		(SELECT M3 from marks_2021 WHERE admno=s.ADM_NO and ExamC=16 and SCode='$subject' AND CLasses='$class' AND sec='$sec')second_sem
		
		from student s where s.ADM_NO=? ORDER BY s.ROLL_NO ASC";



		$query = $this->db->query($sql, array($adm));
		if ($this->db->affected_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	
	function get_marks_2021_xi($adm, $classes, $sec, $subject)
	{
		$sql = "SELECT s.ADM_NO,s.FIRST_NM,s.ROLL_NO,
		(SELECT distinct M2 from marks_2021 WHERE admno=s.ADM_NO and ExamC=1 and SCode='$subject' and admno='$adm' group by admno)mt1,
		(SELECT distinct M2 from marks_2021 WHERE admno=s.ADM_NO and ExamC=2 and SCode='$subject' and admno='$adm' group by admno)mt2,
		(SELECT distinct M2 from marks_2021 WHERE admno=s.ADM_NO and ExamC=3 and SCode='$subject' and admno='$adm' group by admno)mt3,
		(SELECT distinct M2 from marks_2021 WHERE admno=s.ADM_NO and ExamC=4 and SCode='$subject' and admno='$adm' group by admno)mt4,
		(SELECT distinct M2 from marks_2021 WHERE admno=s.ADM_NO and ExamC=19 and SCode='$subject' and admno='$adm' group by admno)mt5,
		(SELECT distinct M2 from marks_2021 WHERE admno=s.ADM_NO and ExamC=20 and SCode='$subject' and admno='$adm' group by admno)mt6,

		(SELECT distinct M2 from marks_2021 WHERE admno=s.ADM_NO and ExamC=6 and SCode='$subject' and admno='$adm' and TYPE='T' group by admno)hy_th,
		(SELECT distinct M2 from marks_2021 WHERE admno=s.ADM_NO and ExamC=6 and SCode='$subject' and admno='$adm' and TYPE='P' group by admno)hy_pr,
		(SELECT distinct M2 from marks_2021 WHERE admno=s.ADM_NO and ExamC=16 and SCode='$subject' and admno='$adm' group by admno)second_sem
		
		from student s where s.CLASS=? and s.SEC=? and Student_Status='ACTIVE' ORDER BY s.ROLL_NO ASC";



		$query = $this->db->query($sql, array($classes, $sec));
		if ($this->db->affected_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	function nur_grade_report($sub, $adm, $exam)
	{
		$sql = "SELECT id,skill_nm,(select distinct(marks) from marks_nur_result where exam_code='$exam'  AND papertype='T' AND TERM='TERM-2' AND subj_id in ($sub) AND sub_skill_id=sub_skill_2021_result.id and admno='$adm')marks FROM sub_skill_2021_result WHERE subj_id IN ($sub)";
		$query = $this->db->query($sql);
		if ($this->db->affected_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	function get_avg_aggregate_new($class_no, $sec_no, $sub_code)
	{
		$sql = "SELECT sum(a.perce)/COUNT(a.admno) AS avg_agg FROM tempgraph a
		WHERE a.class=? AND a.sec=? AND a.subj=?";
		$query = $this->db->query($sql, array($class_no, $sec_no, $sub_code));
		if ($this->db->affected_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}

	function get_above_ninty_new($class_no, $sec_no, $sub_code)
	{
		$sql = "SELECT count(a.perce) AS above_ninty FROM tempgraph a
		WHERE a.class=? AND a.sec=? AND a.subj=?
		AND a.perce>90";
		$query = $this->db->query($sql, array($class_no, $sec_no, $sub_code));
		if ($this->db->affected_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}

	function get_above_between_seventyfive_ninty_new($class_no, $sec_no, $sub_code)
	{
		$sql = "SELECT count(a.perce) AS above_sev_ninty FROM tempgraph a
		WHERE a.class=? AND a.sec=? AND a.subj=?
		AND a.perce>=75 AND  a.perce<=90";
		$query = $this->db->query($sql, array($class_no, $sec_no, $sub_code));
		if ($this->db->affected_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}

	function get_above_between_sixty_seventyfive_new($class_no, $sec_no, $sub_code)
	{
		$sql = "SELECT count(a.perce) AS above_six_sev FROM tempgraph a
		WHERE a.class=? AND a.sec=? AND a.subj=?
		AND a.perce>=60 AND  a.perce<75";
		$query = $this->db->query($sql, array($class_no, $sec_no, $sub_code));
		if ($this->db->affected_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}

	function get_above_between_forty_sixty_new($class_no, $sec_no, $sub_code)
	{
		$sql = "SELECT count(a.perce) AS above_forty_sixty FROM tempgraph a
		WHERE a.class=? AND a.sec=? AND a.subj=?
		AND a.perce>=40 AND  a.perce<60";
		$query = $this->db->query($sql, array($class_no, $sec_no, $sub_code));
		if ($this->db->affected_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}

	function get_above_between_below_forty_new($class_no, $sec_no, $sub_code)
	{
		$sql = "SELECT count(a.perce) AS below_forty FROM tempgraph a
		WHERE a.class=? AND a.sec=? AND a.subj=?
		AND a.perce<40 ";
		$query = $this->db->query($sql, array($class_no, $sec_no, $sub_code));
		if ($this->db->affected_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}
	
			function nur_grade_report_annual($class,$sec,$sub, $skill,$exam,$adm)
	{
		$sql = "SELECT a.admno,a.marks FROM marks_nur_result a
WHERE a.class_no=? AND a.section_no=? AND a.subj_id=? AND a.sub_skill_id=?
AND a.exam_code=? AND a.admno=? ORDER BY a.admno";
		$query = $this->db->query($sql,array($class,$sec,$sub, $skill,$exam,$adm));
		if ($this->db->affected_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}
	function get_particular_student($admno)
	{
		$sql="SELECT * FROM student WHERE adm_no=?";
		$query = $this->db->query($sql, array($admno));
		if ($this->db->affected_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}

	function prep_to_two_grade_analysis_report3($adm, $subject, $class, $sec)
	{
		$sql = "SELECT s.ADM_NO,s.FIRST_NM,s.ROLL_NO,
		(SELECT M3 from marks_2021 WHERE admno=s.ADM_NO and ExamC=3 and SCode='$subject' AND CLasses='$class' AND sec='$sec')mt3,
		(SELECT M3 from marks_2021 WHERE admno=s.ADM_NO and ExamC=4 and SCode='$subject' AND CLasses='$class' AND sec='$sec')mt4,

		(SELECT M3 from marks_2021 WHERE admno=s.ADM_NO and ExamC=13 and SCode='$subject' AND CLasses='$class' AND sec='$sec')se3,
		(SELECT M3 from marks_2021 WHERE admno=s.ADM_NO and ExamC=15 and SCode='$subject' AND CLasses='$class' AND sec='$sec')se4,

		(SELECT M3 from marks_2021 WHERE admno=s.ADM_NO and ExamC=22 and SCode='$subject' and Term='TERM-2' AND CLasses='$class' AND sec='$sec')nb2,

		(SELECT M3 from marks_2021 WHERE admno=s.ADM_NO and ExamC=16 and SCode='$subject' AND CLasses='$class' AND sec='$sec')second_sem
		
		from student s where s.ADM_NO=? ORDER BY s.ROLL_NO ASC";

		$query = $this->db->query($sql, array($adm));
		if ($this->db->affected_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	
}

			
