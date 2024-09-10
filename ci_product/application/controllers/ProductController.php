<?php

class ProductController extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();
        $this->load->model("Product_model");
    }

    public function create()
    {

        $getAllSub = $this->Product_model->GetData("product_subcategories", "", "", "subcategory_name", "", "", "");

        $data = array(
            "getAlldata" => $getAllSub,
            "subcategory_id" => set_value("subcategory_id", $this->input->post("subcategory_id")),
            "name" => set_value("name", $this->input->post("name")),
            "price" => set_value("price", $this->input->post("price")),
            "description" => set_value("description", $this->input->post("description")),
            "status" => set_value("status", $this->input->post("status")),

        );

        $this->load->view("products/createProduct", $data);
    }

    public function create_action()
    {

        $this->form_validation->set_rules("subcategory_id", "Product sub-category", "required");
        $this->form_validation->set_rules("name", "Product Name", "required");
        $this->form_validation->set_rules("description", "Description", "required");
        $this->form_validation->set_rules("price", "Price", "required");
        $this->form_validation->set_rules("status", "Status", "required");
        if($_FILES['image']['error']==4)
        {
            $this ->form_validation->set_rules('image','Product image','required');
        } 

        

        if ($this->form_validation->run() == false) {
            $this->create();
        } else {

            $checkexist= $this->Product_model->getData("products","product_name","product_name='".$this->input->post('name', TRUE)."'","","","","");
           
            if(!empty($checkexist)){
                $this->session->set_flashdata('warning', 'Product is already exist');
                redirect("ProductController/create");
 
            }else{



            if ($_FILES['image']['error'] == 0) {

                $config['upload_path'] = './uploads/productimage';
                $config['allowed_types'] = 'jpg|png';
                $config['max_size'] = 2048; // 2MB
                $config['max_width'] = 160000;
                $config['max_height'] = 120000;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if (!$this->upload->do_upload('image')) {
                    $error = array('error' => $this->upload->display_errors());

                    $this->load->view('register', $error);
                    $this->session->set_flashdata('error', 'Unable to upload Image ');
                } else {
                    $data = array('upload' => $this->upload->data());

                    $image = $data['upload']['file_name'];


                }
            }

            $data = array(

                "product_sub_id" => $this->input->post("subcategory_id"),
                "product_name" => $this->input->post("name"),
                "description" => $this->input->post("description"),
                "price" => $this->input->post("price"),
                "status" => $this->input->post("status"),
                "image" => $image,

            );

            $this->Product_model->savedata("products", $data);
            $this->session->set_flashdata("success", "product created successfully");

            redirect("ProductController/manageproducts");

        }
    }
    }
    public function manageproducts()
    {

        $getallproducts = $this->Product_model->GetproductData("products", "products.id,products.product_name,products.description,products.price,products.image,products.status,product_subcategories.subcategory_name", "products.product_sub_id=product_subcategories.id");

        //   print_r($getallproducts); exit;

        $data = array(

            "getallproducts" => $getallproducts,
        );

        $this->load->view("products/manageproduct", $data);
    }

    public function update($id)
    {

        $getAllsubCat = $this->Product_model->getdata("product_subcategories", "", "", "", "", "", "");
        $getperticulerproduct = $this->Product_model->getdata("Products", "", "id='" . $id . "'", "", "", "", "1");
        //    print_r($getperticulerproduct->image); exit;

        //    print_r($getAllsubCat); exit;

        $data = array(
            "getAllsubCat" => $getAllsubCat,
            "subcategory_id" => set_value("subcategory_id", $getperticulerproduct->id),
            "id" => set_value("id", $getperticulerproduct->id),
            "name" => set_value("name", $getperticulerproduct->product_name),
            "description" => set_value("description", $getperticulerproduct->description),
            "price" => set_value("price", $getperticulerproduct->price),
            "image" => set_value("image", $getperticulerproduct->image),
            "status" => set_value("status", $getperticulerproduct->status),

        );

        $this->load->view("products/update", $data);
    }

    public function update_action()
    {

        $id = $this->input->post("id");

        $this->form_validation->set_rules("subcategory_id", "Product sub-category", "required");
        $this->form_validation->set_rules("name", "Product Name", "required");
        $this->form_validation->set_rules("description", "Description", "required");
        $this->form_validation->set_rules("price", "Price", "required");
        $this->form_validation->set_rules("status", "status", "required");

        if ($this->form_validation->run() == false) {
            $this->update($id);
        } else {

            $checkexist= $this->Product_model->getData("products","product_name","product_name='".$this->input->post('name', TRUE)."'","","","","");
           
            // if(!empty($checkexist)){
            //     $this->session->set_flashdata('warning', 'Product is already exist');
            //     redirect("ProductController/update/".$id);
 
            // }else{

            $oldproductimage = $this->Product_model->GetData("products", "", "id ='" . $id . "'", "", "", "", "1");

            $oldimage = $oldproductimage->image;

            // print_r($oldimage); exit ;


            if ($_FILES['image']['error'] == 0) {


                $config['upload_path'] = './uploads/productimage';
                $config['allowed_types'] = 'jpg|png';
                $config['max_size'] = 2048; // 2MB
                $config['max_width'] = 16000;
                $config['max_height'] = 12000;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if (!$this->upload->do_upload('image')) {
                    $error = array('error' => $this->upload->display_errors());

                    $this->load->view('register', $error);
                    $this->session->set_flashdata('error', 'Unable to upload Image ');
                } else {

                    if (file_exists('./uploads/userimage/' . $oldimage)) {
                        unlink('./uploads/userimage/' . $oldimage);
                    }
                    $data = array('upload' => $this->upload->data());

                    $image = $data['upload']['file_name'];
                }
            } else {
                $image = $oldimage;

            }

            $data = array(
                "product_sub_id" => $this->input->post("subcategory_id"),
                "product_name" => $this->input->post("name"),
                "price" => $this->input->post("price"),
                "status" => $this->input->post("status"),
                "description" => $this->input->post("description"),
                "image" => $image,
            );

            $this->Product_model->savedata("products", $data, "id='" . $id . "'");

            $this->session->set_flashdata("success", "produuct update successfully");

            redirect("ProductController/manageproducts");

        }
   // }

    }

    public function delete($id)
    {

        $getproduct = $this->Product_model->getData("products", "", "id='" . $id . "'", "", "", "", "1");

        $image = $getproduct->image;

        $this->Product_model->Delete("products", "id ='" . $getproduct->id . "'");
        unlink("uploads/productimage/" . $image);
        $this->session->set_flashdata('error', 'City has been deleted successfully');
        redirect("ProductController/manageproducts");
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
						$getproduct = $this->Product_model->GetData("products","id","id='".$id[$i]."'","","","","");
                        $image = $getproduct->image;
						foreach($getproduct as $getdata)
						{
                           
							
							if(empty($getproduct))
							{
								$nondel++;
							}
							else
							{
								$this->Product_model->Delete("products","id ='".$getdata->id."'");

                                unlink("uploads/productimage/".$image);
								$del++; 
							}
						}
					}  
					$massage= $del." product record has been deleted"."<br/>".$nondel." product record not deleted";
					$this->session->set_flashdata('error',$massage);
                    redirect("ProductController/manageproducts");
				}
			}
			else
			{
				$this->session->set_flashdata('error','Check atleast one record to delete');
                redirect("ProductController/manageproducts");
			}
		}
	}

    public function export()
	{
		$id = $this->input->post('productcollectid'); 
        //  print_r($id); exit;
		$this->Product_model->ExportData("products","subcategory_name,product_name,description,price,image,status,created",$id);
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
					redirect("ProductController/manageproducts");
					
				}else{
					$uploadData = $this->upload->data();
					$filename = $uploadData['file_name'];
					//reading upload file

                    // print_r($filename); exit;
					$file = fopen("assets/files/".$filename,"r");
					$i = 0;

                    // print_r($file); exit;
					$numberOfFields = 4; // total number of fields
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
							$checkexist = $this->Product_model->GetData("product_subcategories","id,subcategory_name","subcategory_name = '".$Data[0]."'","","","","");
							//print_r($this->db->last_query()); exit();
							if(empty($checkexist))
							{
								$exist++;
							}
							else
							{
								$duplication = $this->Product_model->GetproductData("products","products.product_name","products.product_name ='".$Data[1]."' and product_subcategories.subcategory_name='".$Data[0]."'");
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
									$this->Product_model->ImportData($Data);									
								}
							}
						}
						$skip++;
						}
						$totalrecords = count(file("assets/files/".$filename));
						$this->session->set_flashdata("warning",$dup." Duplicate product record found");
						if(!empty($exist))
						{	
							$this->session->set_flashdata("error",$exist." subcategory not found");
						}
						if(!empty($checkexist->id) || $i > 0 )
						{
							$recordimport = ($totalrecords-1)-$dup-$exist;
							$this->session->set_flashdata("success",$recordimport." Records imported");
						}
						$this->session->set_flashdata("info",($totalrecords-1)." Total records");
						redirect("ProductController/manageproducts");
				}
			}else{
				$this->session->set_flashdata("error","Please select csv file");	
				redirect("ProductController/manageproducts");
			}
		}
	}
}



?>