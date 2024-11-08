<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subjectallocation extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->loggedOut();
	}
	public function index()
	{
		// if(!in_array('viewDesignation', permission_data))
		// {
		// 	redirect('payroll/dashboard/dashboard');
		// }

		$data['subjectsList'] =$this->sumit->fetchAllData('*','subjects',array());
		$data['wingList'] =$this->sumit->fetchAllData('*','wing_master',array());
		$data['buildingList'] = $this->sumit->fetchAllData('*,(SELECT Campus_Name FROM campus_master WHERE Campus_ID=w.CAMPUS_MASTER_ID)CAMPUS_NAME','wing_master w',array());
		$this->render_template('timetable/subjectAllocation',$data);
	}
	public function update()
	{
		$id = $this->input->post('wing');
		$data = array(
			'CAMPUS_MASTER_ID'	=> $this->input->post('campus'),
		);

		$updated = $this->sumit->update('wing_master',$data,array('ID'=>$id));
		if($updated)
		{
			$this->session->set_flashdata('msg','<div class="alert alert-success">Record Updated Successfully</div>');
		}
		else
		{
			$this->session->set_flashdata('msg','<div class="alert alert-warning">Updation Failed!</div>');
		}
		redirect('timetable/buildingmaster');
	}

	// public function getSingleData()
	// {
	// 	$id = $this->input->post('id');
	// 	$data = $this->sumit->fetchSingleData('*','wing_master',array('ID'=>$id));
	// 	echo json_encode($data);
	// }

	public function getTeacherList()
	{
		$subject_id = $this->input->post('subject_id');
		$teacher_list_load = $this->input->post('teacher_list_load');
		if($teacher_list_load == 1)
		{
			$teacherList = $this->sumit->fetchAllData('e.EMPID,e.EMP_FNAME,IFNULL(e.EMP_MNAME,"")EMP_MNAME,IFNULL(e.EMP_LNAME,"")EMP_LNAME','employee e',"STATUS=1 AND STAFF_TYPE=1");
		}
		else
		{
			$teacherList = $this->sumit->fetchTwoJoin('s.*,e.EMPID,e.EMP_FNAME,IFNULL(e.EMP_MNAME,"")EMP_MNAME,IFNULL(e.EMP_LNAME,"")EMP_LNAME','subject_preferences s','employee e',"e.EMPID=s.teacher_id","s.subject_code='$subject_id' AND e.STAFF_TYPE=1");

		}
		echo json_encode($teacherList);
	}

	public function getSubjectListByTeacherinTable()
	{
		$teacher_id = $this->input->post('teacher_id');
		$data['subjectList'] = $this->sumit->fetchAllData('subj_nm,Class_name_Roman,Total_Period_inWeek','class_section_wise_subject_allocation',"Main_Teacher_Code='$teacher_id'");
		$this->load->view('timetable/teacherSubjectBundleTable',$data);
	}

	public function getClassTeacherClassDetails()
	{
		$teacher_id = $this->input->post('teacher_id');
		$loginDetails = $this->sumit->fetchSingleData('Class_tech_sts,Class_No,Section_No','login_details',"user_id='$teacher_id'");
		if($loginDetails['Class_tech_sts'] == 1)
		{
			$class_sec_details = $this->sumit->fetchSingleData("(SELECT SECTION_NAME FROM `sections` WHERE section_no='".$loginDetails['Section_No']."')SECTION, CLASS_NM",'classes',"Class_No='".$loginDetails['Class_No']."'");
			echo  ($class_sec_details['CLASS_NM'].' - '.$class_sec_details['SECTION']);
		}
		else
		{
			echo "";
		}
	}

	public function getClassListBySubject()
	{
		$subject_id = $this->input->post('subject_id');
		$classList = $this->sumit->fetchAllData('*','class_section_wise_subject_allocation',"subject_code='$subject_id' ORDER BY Class_No,section_no");
		echo json_encode($classList);
	}

	public function getSubjectDataByClassSecSubcode()
	{
		$class_sec_subcode = $this->input->post('class_sec_subcode');
		$subject_id = $this->input->post('subject_id');

		$getSubjectList = $this->sumit->fetchAllData('*,IFNULL((SELECT EMP_FNAME FROM employee WHERE EMPID=cs.Main_Teacher_Code AND Class_Sec_SubCode='.$class_sec_subcode.' AND subject_code='.$subject_id.'),"")EMP_FNAME,IFNULL((SELECT EMP_MNAME FROM employee WHERE EMPID=cs.Main_Teacher_Code AND Class_Sec_SubCode='.$class_sec_subcode.' AND subject_code='.$subject_id.'),"")EMP_MNAME,IFNULL((SELECT EMP_LNAME FROM employee WHERE EMPID=cs.Main_Teacher_Code AND Class_Sec_SubCode='.$class_sec_subcode.' AND subject_code='.$subject_id.'),"")EMP_LNAME,IFNULL((SELECT EMP_FNAME FROM employee WHERE EMPID=cs.Support_Teacher_Code AND Class_Sec_SubCode='.$class_sec_subcode.' AND subject_code='.$subject_id.'),"")EMP_FNAME_SUPPORT,IFNULL((SELECT EMP_MNAME FROM employee WHERE EMPID=cs.Support_Teacher_Code AND Class_Sec_SubCode='.$class_sec_subcode.' AND subject_code='.$subject_id.'),"")EMP_MNAME_SUPPORT,IFNULL((SELECT EMP_LNAME FROM employee WHERE EMPID=cs.Support_Teacher_Code AND Class_Sec_SubCode='.$class_sec_subcode.' AND subject_code='.$subject_id.'),"")EMP_LNAME_SUPPORT','class_section_wise_subject_allocation cs',"Class_Sec_SubCode='$class_sec_subcode'");

		$totalPeriodSumWithoutMerge = $this->sumit->fetchSingleData('SUM(Total_Period_inWeek)total_sum','class_section_wise_subject_allocation',"Class_Sec_SubCode='$class_sec_subcode' AND Merged_WithSubCode=0");
		$totalPeriodSumWithMerge = $this->sumit->fetchAllData('Total_Period_inWeek,Merged_WithSubCode','class_section_wise_subject_allocation',"Class_Sec_SubCode='$class_sec_subcode' AND Merged_WithSubCode != '0' GROUP BY Total_Period_inWeek,Merged_WithSubCode");
		
		$total = 0;
		if(!empty($totalPeriodSumWithMerge))
		{
			foreach ($totalPeriodSumWithMerge as $key => $value) {
				
				$total += $value['Total_Period_inWeek'];
			}
		}

		$totalPeriodSumWithoutMerge = isset($totalPeriodSumWithoutMerge['total_sum'])?$totalPeriodSumWithoutMerge['total_sum']:0;
		$data['totalSum'] = $totalPeriodSumWithoutMerge + $total;
		$data['subjectData'] = $getSubjectList;
		$this->load->view('timetable/classWiseSubjectinSubjectAllocation',$data);
	}


	public function getClassWithTeacherDetails()
	{
		$subject_id = $this->input->post('subject_id');

		$getSubjectList = $this->sumit->fetchAllData('*,IFNULL((SELECT EMP_FNAME FROM employee WHERE EMPID=cs.Main_Teacher_Code AND Class_Sec_SubCode='.$class_sec_subcode.' AND subject_code='.$subject_id.'),"")EMP_FNAME,IFNULL((SELECT EMP_MNAME FROM employee WHERE EMPID=cs.Main_Teacher_Code AND Class_Sec_SubCode='.$class_sec_subcode.' AND subject_code='.$subject_id.'),"")EMP_MNAME,IFNULL((SELECT EMP_LNAME FROM employee WHERE EMPID=cs.Main_Teacher_Code AND Class_Sec_SubCode='.$class_sec_subcode.' AND subject_code='.$subject_id.'),"")EMP_LNAME,IFNULL((SELECT EMP_FNAME FROM employee WHERE EMPID=cs.Support_Teacher_Code AND Class_Sec_SubCode='.$class_sec_subcode.' AND subject_code='.$subject_id.'),"")EMP_FNAME_SUPPORT,IFNULL((SELECT EMP_MNAME FROM employee WHERE EMPID=cs.Support_Teacher_Code AND Class_Sec_SubCode='.$class_sec_subcode.' AND subject_code='.$subject_id.'),"")EMP_MNAME_SUPPORT,IFNULL((SELECT EMP_LNAME FROM employee WHERE EMPID=cs.Support_Teacher_Code AND Class_Sec_SubCode='.$class_sec_subcode.' AND subject_code='.$subject_id.'),"")EMP_LNAME_SUPPORT','class_section_wise_subject_allocation cs',"Class_Sec_SubCode='$class_sec_subcode'");
		$totalPeriodSumWithoutMerge = $this->sumit->fetchSingleData('SUM(Total_Period_inWeek)total_sum','class_section_wise_subject_allocation',"Class_Sec_SubCode='$class_sec_subcode' AND Merged_WithSubCode=0");
		$totalPeriodSumWithMerge = $this->sumit->fetchAllData('Total_Period_inWeek,Merged_WithSubCode','class_section_wise_subject_allocation',"Class_Sec_SubCode='$class_sec_subcode' AND Merged_WithSubCode != '0' GROUP BY Total_Period_inWeek,Merged_WithSubCode");
		
		$total = 0;
		if(!empty($totalPeriodSumWithMerge))
		{
			foreach ($totalPeriodSumWithMerge as $key => $value) 
			{				
				$total += $value['Total_Period_inWeek'];
			}
		}

		$totalPeriodSumWithoutMerge = isset($totalPeriodSumWithoutMerge['total_sum'])?$totalPeriodSumWithoutMerge['total_sum']:0;
		$data['totalSum'] = $totalPeriodSumWithoutMerge + $total;
		$data['subjectData'] = $getSubjectList;
		$this->load->view('timetable/classWiseSubjectinSubjectAllocation',$data);
	}

}
