<?php

class City_model extends CI_Model
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
    public function DeleteData($table, $condition)
    {
        $this->db->where($condition);
        $this->db->delete($table);
    }
    public function GetCitiesData($table, $fields = '')
    {
        $this->db->select($fields);
        $this->db->join('states', 'states.id = cities.state_id','left');
		  $this->db->join('countries', 'countries.id = cities.country_id','left');
       
        $return = $this->db->get($table)->result();
        return $return;
    }

    public function delete($table, $condition)
    {

        $this->db->where($condition);
        $this->db->delete($table);

    }

    // export data

    
    public function GetCitiesexportData($table,$fields='',$condition='',$result='')
	{
		$this->db->select($fields);
		$this->db->join('states','states.id=cities.state_id');
		$this->db->join('countries','countries.id=cities.country_id');
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
		$cityid = explode(",",$condition);
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
		for($j=0; $j<count($cityid); $j++){
			$data[] = $this->City_model->GetCitiesexportData("cities","states.state_name,cities.city_name,cities.status,countries.country_name,cities.created","cities.id='".$cityid[$j]."' and cities.state_id = states.id","1");
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

    public function SampleData($table,$fields='')
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
		
		echo($output);
		//Export data in to csv format
		header('Content-type: application/csv');
		$date= date('Y-m-d-H:i:s');
		$filename ="city_sample_".$date.".csv";
		header('Content-Disposition: attachment;filename="'.$filename.'";');
	}

	public function update_status($table,$data,$city_id){
		$this->db->set($data);
		$this->db->where("id",$city_id);
		return $this->db->update($table,$data);

	}

	public function ImportData($record)
	{
		if(count($record)  > 0)
		{
			$import = array(
				'token' => md5("states_token".time().rand(1000,9999)),
				'country_id' => trim($record[0]),
				'state_id' => trim($record[1]),
				'city_name' => trim($record[2]),
				'created' => date("Y-m-d H:i:s"),
			);
			$this->db->insert('cities',$import);
		}
	} 

}

?>