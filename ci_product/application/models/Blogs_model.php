<?php
class Blogs_model extends CI_Model
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

	public function getlist($table, $field)
	{
		$this->db->select($field);
		$this->db->from($table);
		$this->db->join("blog_categories", "blog_categories.id=blogs.blog_cat_id");
		$quary = $this->db->get()->result();
		return $quary;
	}

	public function GetproductexportData($table,$fields='',$condition='',$result='')
	{
		$this->db->select($fields);
		$this->db->join('blog_categories','blog_categories.id=blogs.blog_cat_id');
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
		$blogid = explode(",",$condition);
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
		for($j=0; $j<count($blogid); $j++){
			$data[] = $this->GetproductexportData("blogs","blog_categories.title,blogs.blog_title,blogs.status,blogs.content,blogs.created","blogs.id='".$blogid[$j]."' and blogs.blog_cat_id = blog_categories.id","1");
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
		$filename ="city_export_".$date.".csv";
		header('Content-Disposition: attachment;filename="'.$filename.'";');
	}

	public function ImportData($record)
	{
		if(count($record)  > 0)
		{
			$import = array(
	
				'blog_cat_id' => trim($record[0]),
				'blog_title' => trim($record[1]),
				'content' => trim($record[2]),
				'created' => date("Y-m-d H:i:s"),
			);
			$this->db->insert('blogs',$import);
		}
	} 

} ?>