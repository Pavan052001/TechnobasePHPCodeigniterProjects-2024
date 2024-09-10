<?php

class State_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}
	public function GetData($table, $field = '', $condition = '', $order = '', $group = '', $limit = '', $result = '')
	{
		if ($field != '')
			$this->db->select($field);
		if ($condition != '')
			$this->db->where($condition);
		if ($order != '')
			$this->db->order_by($order);
		if ($limit != '')
			$this->db->limit($limit);
		if ($group != '')
			$this->db->group_by($group);
		if ($result != '') {
			$return = $this->db->get($table)->row();
		} else {
			$return = $this->db->get($table)->result();
		}
		return $return;
	}
	public function SaveData($table, $data, $condition = '')
	{
		$DataArray = array();
		$table_fields = $this->db->list_fields($table);
		foreach ($data as $field => $value) {
			if (in_array($field, $table_fields)) {
				$DataArray[$field] = $value;
			}
		}
		if ($condition != '') {
			$DataArray['modified'] = date("Y-m-d H:i:s");
			$this->db->where($condition);
			$this->db->update($table, $DataArray);
		} else {
			$DataArray['created'] = date("Y-m-d H:i:s");
			$this->db->insert($table, $DataArray);
		}

	}
	public function DeleteData($table, $condition)
	{
		$this->db->where($condition);
		$this->db->delete($table);
	}
	public function GetStatesData($table, $fields = '', $condition = '')
	{
		$this->db->select($fields);
		$this->db->join('countries', 'countries.id=states.country_id');
		$this->db->where($condition);
		$return = $this->db->get($table)->result();
		return $return;
	}

	public function delete($table, $condition)
	{

		$this->db->where($condition);
		$this->db->delete($table);

	}

	public function GetStatesexportData($table,$fields='',$condition='',$result='')
	{
		$this->db->select($fields);
		$this->db->join('countries','countries.id=states.country_id');
		$this->db->where($condition);
		if($result !='')
		{
			$return = $this->db->get($table) ->row();
		}
		else
		{
			$return = $this->db->get($table) ->result();
		}
		return $return;
	}
	public function ExportData($table,$fields='',$condition='')
	{
		$stateid = explode(",",$condition);
		$output = '';
		//Get column names from table
		$columns = array();
		if(!empty($fields))
		{
			$columns = explode(",",$fields);
			$output .= $fields;
		}
		$output .="\n";
		for($j=0; $j<count($stateid); $j++){
			$data[] = $this->state_model->GetStatesexportData("states","countries.country_name,states.state_name,states.status,states.created","states.id ='".$stateid[$j]."' and states.country_id = countries.id","1");
		}
		foreach($data as $row)
		{
			for($i=0; $i< count($columns); $i++)
			{
				$field = $columns[$i];
				$output .= str_replace(",","|",$row->$field).",";
			}
			$output .="\n";
		}
		echo($output);
		//Export data in to csv format
		header('Content-type: application/csv');
		$date= date('Y-m-d-H:i:s');
		$filename ="state_export_".$date.".csv";
		header('Content-Disposition: attachment;filename="'.$filename.'";');
	}

	public function ImportData($record)
	{
		if(count($record)  > 0)
		{
			$import = array(
				'token' => md5("states_token".time().rand(1000,9999)),
				'country_id' => trim($record[0]),
				'state_name' => ucwords(trim($record[1])),
				'created' => date("Y-m-d H:i:s"),
			);
			$this->db->insert('states',$import);
		}
	} 
}
?>