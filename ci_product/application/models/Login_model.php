<?php
class Login_model extends CI_Model
{


	function __construct()
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


}


?>