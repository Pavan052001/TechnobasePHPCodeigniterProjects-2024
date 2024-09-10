<?php
class ProductSubController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("ProductSub_model");
        $this->load->library("form_validation");

    }
    public function create()
    {

        $getallcategory = $this->ProductSub_model->getData("product_categories", "", "", "", "", "", "");

        $data = array(
            "allCategory" => $getallcategory,
            "category" => set_value("category_id", $this->input->post("category_id")),
            "name" => set_value("name", $this->input->post("name")),
            "description" => set_value("description", $this->input->post("description")),
            "status" => set_value("status", $this->input->post("status")),
        );
        $this->load->view("productSubcategory/createProductSub", $data);

    }


    public function create_action()
    {

        $this->form_validation->set_rules("name", "Product sub-Category", "required");
        $this->form_validation->set_rules("description", "description", "required");
        $this->form_validation->set_rules("status", "status", "required");
        $this->form_validation->set_rules("category_id", "Product category", "required");


        if ($this->form_validation->run() == false) {
            $this->create();

        } else {

            $checkexist= $this->ProductSub_model->getData("product_subcategories","subcategory_name","subcategory_name='".$this->input->post('name', TRUE)."'","","","","");
           
            if(!empty($checkexist)){
                $this->session->set_flashdata('warning', 'Product is already exist');
                redirect("ProductController/update/".$id);
 
            }else{

            $data = array(
                "product_category_id" =>ucfirst($this->input->post("category_id")),
                "subcategory_name" => $this->input->post("name"),
                "description" => $this->input->post("description"),
                "status" => $this->input->post("status"),
            );

            $this->ProductSub_model->SaveData("product_subcategories", $data);
            $this->session->set_flashdata("success", "subcategory created successfully");
            redirect("ProductSubController/getlist");


        }
    }
    }

    public function getlist()
    {

        $getAllsub = $this->ProductSub_model->GetsubcategoryData("product_subcategories", "product_subcategories.subcategory_name,product_subcategories.description,product_subcategories.id,product_subcategories.status,product_categories.category_name", "product_subcategories.product_category_id=product_categories.id");

        //   print_r($getAllsub);
        //   exit;
        $data = array(
            "getAllsub" => $getAllsub,

        );

        $this->load->view("productSubcategory/managelist", $data);
    }

    public function update($id)
    {
        $getallcategory = $this->ProductSub_model->getData("product_categories", "", "", "", "", "", "");
        $getsub = $this->ProductSub_model->getData("product_subcategories", "", "id='" . $id . "'", "", "", "", "1");

        $data = array(
            "allCategory" => $getallcategory,
            "id" => set_value("id", $getsub->id),
            "category_id" => set_value("category_id", $getsub->product_category_id),
            "name" => set_value("name", $getsub->subcategory_name),
            "description" => set_value("description", $getsub->description),
            "status" => set_value("status", $getsub->status),
        );

        $this->load->view("productSubcategory/update", $data);


    }

    public function update_action()
    {

        $id = $this->input->post("id");
        $this->form_validation->set_rules("name", "Product sub-Category", "required");
        $this->form_validation->set_rules("description", "description", "required");
        $this->form_validation->set_rules("status", "status", "required");
        $this->form_validation->set_rules("category_id", "Product category", "required");

        if ($this->form_validation->run() == false) {
            $this->update($id);

        } else {

            $data = array(
                "subcategory_name" => $this->input->post("name"),
                "description" => $this->input->post("description"),
                "status" => $this->input->post("status"),
                "product_category_id" => $this->input->post("category_id"),
            );

            $this->ProductSub_model->saveData("product_subcategories", $data, "id='" . $id . "'");
            $this->session->set_flashdata("success", "subcategory updated successfully");
            redirect("ProductSubController/getlist");

        }
    }

    public function delete($id)
    {

        $getsub = $this->ProductSub_model->getData("product_subcategories", "", "id ='" . $id . "'", "", "", "", "1");

        $checkmapsub = $this->ProductSub_model->getData("products", "", "product_sub_id='" . $getsub->id . "'", "", "", "", "");

        if (!empty($checkmapsub)) {
            $this->session->set_flashdata('warning', 'sub-product is already mapped');
            redirect("ProductSubController/getlist");
        } else {
            $this->ProductSub_model->DeleteData("product_subcategories", "id ='" . $getsub->id . "'");
            $this->session->set_flashdata("success", "subcategory deleted successfully");
            redirect("ProductSubController/getlist");
        }

    }

    public function deleteall_action()
	{	
		if(isset($_POST['deleteall']))
		{
			if(!empty($this->input->post('selector')))
			{
				$id = $this->input->post('selector');
				if(!empty($id))
				{	$del=0;$nondel=0;
					for($i=0;$i<count($id);$i++)
					{
						$getsubproduct = $this->ProductSub_model->GetData("product_subcategories","id","id='".$id[$i]."'","","","","");
                       
						foreach($getsubproduct as $getdata)
						{
                           
							$checkmap = $this->ProductSub_model->getdata("products","","product_sub_id='".$getdata->id."'","","","","");
							if(!empty($checkmap))
							{
								$nondel++;
							}
							else
							{
								$this->ProductSub_model->DeleteData("product_subcategories","id ='".$getdata->id."'");

								$del++; 
							}
						}
					}  
					$massage= $del." Subproduct record has been deleted"."<br/>".$nondel." Subproduct record not deleted";
					$this->session->set_flashdata('error',$massage);
                    redirect("ProductSubController/getlist");
				}
			}
			else
			{
				$this->session->set_flashdata('error','Check atleast one record to delete');
                redirect("ProductSubController/getlist");
			}
		}
	}

    public function export()
	{
		$id = $this->input->post('subcollectid');
        //   print_r($id); exit;
		$this->ProductSub_model->ExportData("product_subcategories","subcategory_name,category_name,description,status,created",$id);
	}

    public function import()
	{
		//if form submit or not
		if($this->input->post('upload') != NULL){
			//$data = array();
			if($_FILES['file']['name']){
				$config['upload_path'] = 'assets/files';
				$config['allowed_types'] = 'csv';
				$config['max_size'] = '1000';
				$config['file_name'] = $_FILES['file']['name'];
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				// print_r($this->upload->do_upload('file')); exit();
                if (!$this->upload->do_upload('file')){
					$this->session->set_flashdata("error","File not uploaded");
					redirect("ProductSubController/getlist");
					
				}else{
					$uploadData = $this->upload->data();
					$filename = $uploadData['file_name'];
					//reading upload file

                    // print_r($filename); exit;
					$file = fopen("assets/files/".$filename,"r");
					$i = 0;

                    // print_r($file); exit;
					$numberOfFields = 3; // total number of fields
					$importData_arr = array();
                    while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                        $num = count($filedata);
                       //  print_r($numberOfFields);
                        // print_r("======");
                        if ($numberOfFields == $num) {
                            $importData_arr[$i] = $filedata;
                        }
                        $i++;

                    
                    }
                    //   print_r($importData_arr);
                    //   exit();
                    fclose($file);
					$skip = 0; $dup = 0; $exist = 0 ;
					//insert import data
					//print_r($importData_arr); exit();
					foreach($importData_arr as $Data){	
						//skip first row
						if($skip != 0){
							$checkexist = $this->ProductSub_model->GetData("product_categories","id,category_name","category_name = '".$Data[0]."'","","","","");
							
							if(empty($checkexist))
							{
								$exist++;
							}
							else
							{
								$duplication = $this->ProductSub_model->GetsubcategoryData("product_subcategories","product_subcategories.subcategory_name","product_subcategories.subcategory_name ='".$Data[1]."' and product_categories.category_name='".$Data[0]."'");
								if(!empty($duplication))
								{
									$dup++;
								}
								else
								{
									foreach($checkexist as $exists)
									{							
										$Data[0] = $exists->id;
									}
									//print_r($stateData); exit();
									$this->ProductSub_model->ImportData($Data);									
								}
							}
						}
						$skip++;
						}
						$totalrecords = count(file("assets/files/".$filename));
						$this->session->set_flashdata("warning",$dup." Duplicate suncategory record found");
						if(!empty($exist))
						{	
							$this->session->set_flashdata("error",$exist." category not found");
						}
						if(!empty($checkexist->id) || $i > 0 )
						{
							$recordimport = ($totalrecords-1)-$dup-$exist;
							$this->session->set_flashdata("success",$recordimport." Records imported");
						}
						$this->session->set_flashdata("info",($totalrecords-1)." Total records");
						redirect("ProductSubController/getlist");
				}
			}else{
				$this->session->set_flashdata("error","Please select csv file");	
				redirect("ProductSubController/getlist");
			}
		}
	}

}
?>