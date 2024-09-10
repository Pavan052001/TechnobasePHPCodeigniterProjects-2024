<?php
class ProductSub_model extends CI_Model
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

    public function GetsubcategoryData($table, $fields = '', $condition = '')
    {
        $this->db->select($fields);
        $this->db->join('product_categories', 'product_categories.id = product_subcategories.product_category_id');
        $this->db->where($condition);
        $return = $this->db->get($table)->result();
        return $return;
    }

    public function GetexportData($table,$fields='',$condition='',$result='')
	{
		$this->db->select($fields);
		$this->db->join('product_categories','product_categories.id=product_subcategories.product_category_id');
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
			$data[] = $this->GetexportData("product_subcategories","product_categories.category_name,product_subcategories.subcategory_name,product_subcategories.description,product_subcategories.status,product_subcategories.created","product_subcategories.id ='".$id[$j]."' and product_subcategories.product_category_id = product_categories.id","1");
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
				'product_category_id' => trim($record[0]),
				'subcategory_name' => ucwords(trim($record[1])),
                'description'=> trim($record[2]),
				'created' => date("Y-m-d H:i:s"),
			);
			$this->db->insert('product_subcategories',$import);
		}
	} 
}
?>