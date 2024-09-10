<?php

class BlogCategory_model extends CI_Model
{
	public function __construct()
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

	public function delete($table, $condition)
	{

		$this->db->where($condition);
		$this->db->delete($table);

	}
	public function ExportData($table,$fields='',$condition='')
	{
		$blogcatid = explode(",",$condition);
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
		for($j=0; $j<count($blogcatid); $j++)
		{
			$return[] = $this->GetData("blog_categories","title,description,status,created","id='".$blogcatid[$j]."'","","","","1");
		}
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
		$filename ="country_export_".$date.".csv";
		header('Content-Disposition: attachment;filename="'.$filename.'";');
	}

	

	public function ImportData($record)
	{
		if(count($record)  > 0)
		{
			$import = array(
					'title' => ucwords(trim($record[0])),
					'description' => ucwords(trim($record[1])),
					'created' => date("Y-m-d H:i:s"),
			);
			$this->db->insert('blog_categories',$import);
		}
	} 


}
?>