<?php 

class Hobby_model extends CI_Model{

     public function __construct(){
        parent::__construct();
        
     }
    public function GetData($table,$field='',$condition='',$order='',$group='',$limit='',$result='')
	{
		if($field !='')
			$this->db->select($field);
		if($condition !='')
			$this->db->where($condition);
		if($order !='')
			$this->db->order_by($order);
		if($limit !='')
			$this->db->limit($limit);
		if($group !='')
			$this->db->group_by($group);
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
	public function SaveData($table,$data,$condition='')
	{
		$DataArray = array();
		$table_fields = $this->db->list_fields($table);
		foreach($data as $field=>$value)
		{
			if(in_array($field,$table_fields))
			{
				$DataArray[$field] = $value;
			}
		}
		if($condition !='')
		{
			$DataArray['modified']=date("Y-m-d H:i:s");
			$this->db->where($condition);
			$this->db->update($table, $DataArray);
		}
		else
		{
			$DataArray['created']=date("Y-m-d H:i:s");
			$this->db->insert($table, $DataArray);
		}
	}

	public function deleteHobby($table,$condition){

        $this->db->where($condition);
        $this->db->delete($table);

    }

	public function ExportData($table,$fields='',$condition='')
	{
		$hobbyid = explode(",",$condition);
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
		for($j=0; $j<count($hobbyid); $j++)
		{
			$return[] = $this->GetData("hobbies","hobby_title,status,created","id='".$hobbyid[$j]."'","","","","1");
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
		$filename ="hobby".$date.".csv";
		header('Content-Disposition: attachment;filename="'.$filename.'";');
	}

	public function update_status($hobby_id,$data) {
		$this->db->set($data);
		$this->db->where('id', $hobby_id);
		return $this->db->update('hobbies', $data);
	}

	public function save_hobbies($hobbies) {
		foreach ($hobbies as $hobby) {
			$data = array(
				'hobby_title' => $hobby
			);
			$this->db->insert('hobbies', $data);
		}
		return true; // Or return some status or message
	}

	public function ImportData($record)
	{
		if(count($record)  > 0)
		{	
			$this->db->select('*');
			$this->db->where('hobby_title',$record[0]);
			$return = $this->db->get('hobbies');
			$response = $return->result_array();

			if(count($response) == 0)
			{
				$import = array(
					'token' => md5("hobbies_token".time().rand(1000,9999)),
					'hobby_title' => ucwords(trim($record[0])),
					'created' => date("Y-m-d H:i:s"),
				);
				$this->db->insert('hobbies',$import);
			}
		}
	} 
	
}
?>