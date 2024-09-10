<?php

class User_model extends CI_Model
{

	public function __construct()
	{

		parent::__construct();

	}

	public function getData(
		$table,
		$field = '',
		$condition = '',
		$order = '',
		$group = '',
		$limit = '',
		$result = ''
	) {
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


	public function managelist($table,$field,$condition){

		$this->db->select($field);
		$this->db->where($condition);
		$this->db->join("hobbies","hobbies.id=users.hobby");
	
		$result = $this->db->get($table)->result();
        return $result;

	}

	// public function managelist($table,$field){

	// 	$this->db->select($field);
	// 	$this->db->join("users","users.id=guests.user_id","left");
	// 	$this->db->join("states","states.id=guests.state_id","left");
	// 	$this->db->join("cities","cities.id=guests.city_id","left");
	// 	$this->db->join("countries","countries.id=guests.country_id","left");
	// 	$this->db->join("hobbies","hobbies.id=guests.hobby_id","left");
	// 	$result = $this->db->get($table)->result();
    //     return $result;

	// }



	public function saveData($table, $data, $condition = '')
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

	public function delete($table, $condition){
		$this->db->where($condition);
		$this->db->delete($table);
	}
	public function ExportData($table,$fields='',$condition='')
	{
		$output = '';
		//Get column names from table
		$columns = array();
		if(!empty($fields))
		{
			$columns = explode(",",$fields);
			$output .= $fields;
		}
		$output .="\n";
		// get records against column from table
		if($fields !='')
			$this->db->select($fields);
		if($condition !='')
			$this->db->where($condition);
		$return = $this->db->get($table) ->result();
		foreach($return as $row)
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
		$filename ="user_export_".$date.".csv";
		header('Content-Disposition: attachment;filename="'.$filename.'";');
	}
	
	public function update_status($User_id,$data) {
		$this->db->set($data);
		$this->db->where('id', $User_id);
		return $this->db->update('users', $data);
	}

}

?>