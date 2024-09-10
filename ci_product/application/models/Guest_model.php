
<?php

class Guest_model extends CI_Model{

    public function __construct(){

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

	public function delete($table, $condition){
		$this->db->where($condition);
		$this->db->delete($table);
	}

	public function get_states($country_id) {

        $this->db->where('country_id', $country_id);
		$states = $this->db->get('states')->result_array();
		return $states;

		
	}
	public function get_cities($state_id) {

        $this->db->where('state_id', $state_id);
		$cities = $this->db->get('cities')->result_array();
		return $cities;
	}

	public function managelist($table,$field){

		$this->db->select($field);
		$this->db->join("users","users.id=guests.user_id","left");
		$this->db->join("states","states.id=guests.state_id","left");
		$this->db->join("cities","cities.id=guests.city_id","left");
		$this->db->join("countries","countries.id=guests.country_id","left");
		$this->db->join("hobbies","hobbies.id=guests.hobby_id","left");
		$result = $this->db->get($table)->result();
        return $result;

	}

	public function GetGuestsData($table,$fields='',$condition='',$order='')
	{
		$this->db->select($fields);
		$this->db->join('users','users.id = guests.user_id','left');
		$this->db->join('countries','countries.id = guests.country_id','left');
		$this->db->join('states','states.id = guests.state_id','left');
		$this->db->join('cities','cities.id = guests.city_id','left');
		$this->db->join('hobbies','hobbies.id = guests.hobby_id','left');
		if(!empty($condition)){
			$this->db->where($condition);
		}
		if($order !=''){
			$this->db->order_by($order);
		}
		$return = $this->db->get($table)->result();
		return $return;
	}


	public function guestManagelist($table,$field,$user_id){
		$this->db->where("user_id",$user_id);
		$this->db->select($field);
		$this->db->join("states","states.id=guests.state_id","left");
		$this->db->join("cities","cities.id=guests.city_id","left");
		$this->db->join("countries","countries.id=guests.country_id","left");
		$this->db->join("hobbies","hobbies.id=guests.hobby_id","left");
		$result = $this->db->get($table)->result();
        return $result;

	}

	public function viewlist($table,$field,$condition){

		$this->db->select($field);
		$this->db->where($condition);
		$this->db->join("states","states.id=guests.state_id","left");
		$this->db->join("cities","cities.id=guests.city_id","left");
		$this->db->join("countries","countries.id=guests.country_id","left");
		$this->db->join("hobbies","hobbies.id=guests.hobby_id","left");
		$result = $this->db->get($table)->result();
        return $result;

	}

// 	public function GetexportData($table, $fields = '', $condition = '', $result = '')
// {
//     $this->db->select($fields);
// 	$this->db->join("states","states.id=guests.state_id","left");
// 	$this->db->join("cities","cities.id=guests.city_id","left");
// 	$this->db->join("countries","countries.id=guests.country_id","left");
// 	$this->db->join("hobbies","hobbies.id=guests.hobby_id","left");
    
//     if ($condition != '') {
//         $this->db->where($condition);
//     }
    
//     if ($result != '') {
//         $return = $this->db->get($table)->row();
//     } else {
//         $return = $this->db->get($table)->result();
//     }
    
//     return $return;
// }

// public function ExportData($table,$fields='',$condition='')
// 	{
// 		$id = explode(",",$condition);
// 		$output = '';
// 		//Get column names from table
// 		$columns = array();
// 		if(!empty($fields))
// 		{
// 			$columns = explode(",",$fields);
// 			$output .= $fields;
// 		}
// 		$output .="\n";
// 		for($j=0; $j<count($id); $j++){
			
//             $data[] = $this->GetexportData(
//                 "guests",
//                 "guests.name,guests.email_address,guests.address,guests.dob,guests.gender,guests.photo,countries.country_name,cities.city_name,states.state_name,hobbies.hobby_title,guests.status, guests.created",
//                 "guests.id = '" . $id[$j] . "'",
//                 ""
//             );
// 		}
// 		foreach($data as $row)
// 		{
// 			for($i=0; $i< count($columns); $i++)
// 			{
// 				$field = $columns[$i];
// 				$output .= str_replace(",","|",$row->$field).",";
// 			}
// 			$output .="\n";
// 		}
// 		echo($output);
// 		//Export data in to csv format
// 		header('Content-type: application/csv');
// 		$date= date('Y-m-d-H:i:s');
// 		$filename ="leads_export_".$date.".csv";
// 		header('Content-Disposition: attachment;filename="'.$filename.'";');
// 	}

	public function getGuestOfperticulerUser(
		$table,
		$field = '',
		$condition = '',
		$order = '',
		$group = '',
		$limit = '',
		$result = '',
		$user_id=''
	) {
		if ($field != '')
			$this->db->select($field);

		if ($condition != '')
			$this->db->where($condition);
		if ($order != '')
			$this->db->order_by($order);

			if ($user_id !== null) {
				$this->db->where('user_id', $user_id);
			}
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

	public function GetGuestsexportData($table,$fields='',$condition='',$result='')
	{
		$this->db->select($fields);
		$this->db->join('users','users.id = guests.user_id','left');
		$this->db->join('countries','countries.id = guests.country_id','left');
		$this->db->join('states','states.id = guests.state_id','left');
		$this->db->join('cities','cities.id = guests.city_id','left');
		$this->db->join('hobbies','hobbies.id = guests.hobby_id','left');
		if(!empty($condition)){
			$this->db->where($condition);
		}
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
		$guestid = explode(",",$condition);

		$output = '';
		//Get column names from table
		$columns = array();
		if(!empty($fields))
		{
			$columns = explode(",",$fields);
			$output .= $fields;
		}
		$output .="\n";

		//print_r($guestid ); //exit;
		// get records against column from table
		for($j=0; $j<count($guestid) ;$j++){
			$data[] = $this->GetGuestsexportData("guests","users.name as username,guests.name,guests.email_address,guests.address,guests.details_about_guest,guests.dob,countries.country_name as country,states.state_name as state,cities.city_name as city,guests.hobby_id as hobby,guests.gender,guests.status,guests.created","guests.id='".$guestid[$j]."'","1");
		}

		// print_r($data); exit;


		foreach($data as $row)
		{	
			for($i=0; $i< count($columns); $i++)
			{
				$field = $columns[$i];
				// To get hobby_title against hobby_id
				$hobbyid ='';
				if($columns[$i] == 'hobby')
				{
					// print_r($columns); exit();
					$field = $columns[$i];
					$hobbyid = $row->hobby;
					$gethobby = explode(",",$hobbyid);
					$hobbycount= count($gethobby);
					$hobby_title = " ";
					for($j=0;$j<$hobbycount;$j++)
					{
						$hobbycollect= $this->Guest_model->GetData("hobbies","hobby_title","id= '".$gethobby[$j]."'","","hobby_title","","");
						foreach($hobbycollect as $hobbyrow)
						{
							$hobby_title .= $hobbyrow->hobby_title; 
						}
						if($j<$hobbycount-1)
						{
							$hobby_title .= ", ";
						} 
					}
					$output .= str_replace(","," | ",$hobby_title).",";
					// print_r($output); exit();
				}
				else
				{
					$output .= str_replace(",","|",$row->$field).",";
				}
			}
			$output .="\n";
		}
		//print_r($output); exit();
		echo($output);
		//Export data in to csv format
		header('Content-type: application/csv');
		$date= date('Y-m-d-H:i:s');
		$filename ="guest_export_".$date.".csv";
		header('Content-Disposition: attachment;filename="'.$filename.'";');
	}


	public function update_status($table,$data,$Guest_id){
		$this->db->set($data);
		$this->db->where("id",$Guest_id);
		return $this->db->update($table,$data);

	}

	public function ImportData($record)
	{
		if(count($record)  > 0)
		{	
			$this->db->select('*');
			$this->db->where('email_address',$record[1]);
			$return = $this->db->get('guests');
			$response = $return->result_array();

			if(count($response) == 0)
			{
				$import = array(
					'token' => md5("guests_token".time().rand(1000,9999)),
					'country_id' => trim($record[0]),
					'state_id' => trim($record[1]),
					'city_id' => trim($record[2]),
					'hobby_id' => $record[3],
					'user_id' => trim($record[4]),
					'name' => ucwords(trim($record[5])),
					'email_address' => strtolower(trim($record[6])),
					'address' => ucwords(trim($record[7])),
					'details_about_guest' => ucwords(trim($record[8])),
					'dob' => date('Y-m-d',strtotime(trim($record[9]))),
					'gender' => trim($record[10]),
					
					'created' => date("Y-m-d H:i:s"),
				);
				$this->db->insert('guests',$import);
			}
		}
	} 


}
?>