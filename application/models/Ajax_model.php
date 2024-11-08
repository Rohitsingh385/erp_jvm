<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ajax_model extends CI_Model
{
	public function fetchAllData($postData)
	{
		$response = array();

		// Read Value
		$draw = $postData['draw'];
		$start = $postData['start'];
		$rowperpage = $postData['length'];
		// echo $rowperpage;die();

		$columnIndex = $postData['order'][0]['column']; // Column index
		$columnName = $postData['columns'][$columnIndex]['data']; // Column name
		// print_r($columnName); die();

		$columnSortOrder = $postData['order'][0]['dir']; // asc or desc
		$searchValue = $postData['search']['value']; // Search value
		// echo"<pre>";
		// print_r($searchValue);
		// $getSearchablefield = ['accno','BNAME','AUTHOR','PUBLISHER','EDITION'];
		$searchQuery = "";
		if ($searchValue != '') {
			$searchQuery = "(accno like '%$searchValue%' or BNAME like '%$searchValue%' or AUTHOR like '%$searchValue%' or PUBLISHER like '%$searchValue%')";
		}

		// Total number of records without filter
		$this->db->select('count(*) as allcount');
		$records = $this->db->get('bookmaster')->result();
		$totalRecords = $records[0]->allcount;

		// Total number of records with filter
		$this->db->select('count(*) as allcount');
		if ($searchQuery != '') {
			$this->db->where($searchQuery);
		}
		$records = $this->db->get('bookmaster')->result();
		$totalRecordswithFilter = $records[0]->allcount;

		// Fetch Records
		$this->db->select('*');
		if ($searchQuery != '') {
			$this->db->where($searchQuery);
		}
		$this->db->order_by($columnName, $columnSortOrder);
		$this->db->limit($rowperpage, $start);
		$records = $this->db->get('bookmaster')->result();

		$data = array();
		$i = $start + 1;
		foreach ($records as $record) {
			$permission = "<ul class='list-unstyled d-flex justify-content-around'>";
			$permission .= "<li><a href='BookMaster/editBookMaster/$record->id'><i class='fa fa-pencil-square' style=' font-size:20px; color:green'></i></a></li>";
			$permission .= "</ul>";
			$data[] = array(
				"id" => $i,
				"accno" => $record->accno,
				"BNAME" => $record->BNAME,
				"AUTHOR" => $record->AUTHOR,
				"PUBLISHER" => $record->PUBLISHER,
				"EDITION" => $record->EDITION,
				"action" => $permission
			);
			$i++;
		}

		// Response
		$response = array(
			"draw" => intval($draw),
			"iTotalRecords" => $totalRecords,
			"iTotalDisplayRecords" => $totalRecordswithFilter,
			"aaData" => $data,
		);

		return $response;
	}
}
