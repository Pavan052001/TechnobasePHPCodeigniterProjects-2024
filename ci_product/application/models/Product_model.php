<?php

class Product_model extends CI_Model
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
    public function GetproductData($table, $fields = '', $condition = '')
    {
        $this->db->select($fields);
        $this->db->join('product_subcategories', 'product_subcategories.id = products.product_sub_id');
        $this->db->where($condition);
        $return = $this->db->get($table)->result();
        return $return;
    }

    public function delete($table, $condition)
    {

        $this->db->where($condition);
        $this->db->delete($table);

    }

    public function GetexportData($table,$fields='',$condition='',$result='')
	{
		$this->db->select($fields);
		$this->db->join('product_subcategories','product_subcategories.id=products.product_sub_id');
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
		$id = explode(",",$condition);
		$output = '';
		//Get column names from table
		$columns = array();
		if(!empty($fields))
		{
			$columns = explode(",",$fields);
			$output .= $fields;
		}
		$output .="\n";
		for($j=0; $j<count($id); $j++){
			$data[] = $this->GetexportData("products","product_subcategories.subcategory_name,products.description,products.product_name,products.status,products.created,products.image,products.price","products.id ='".$id[$j]."' and products.product_sub_id = products.id","1");
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
				'product_sub_id' => trim($record[0]),
				'product_name' => ucwords(trim($record[1])),
                'description'=> trim($record[2]),
                'price'=> trim($record[3]),
				'created' => date("Y-m-d H:i:s"),
			);
			$this->db->insert('products',$import);
		}
	} 
}
?>