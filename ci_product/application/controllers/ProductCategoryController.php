<?php
class ProductCategoryController extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();
        $this->load->library("form_validation");
        $this->load->model("ProductCategory_model");
    }

    public function create()
    {

        $data = array(
            "name" => set_value("name", $this->input->post("name")),
            "description" => set_value("description", $this->input->post("description")),
            "status" => set_value("status", $this->input->post("status")),

        );

        $this->load->view("productCategory/createProductCategory", $data);
    }

    public function create_action()
    {

        $this->form_validation->set_rules("name", "Product Category", "required|regex_match[/^[a-zA-Z]+$/]");
        $this->form_validation->set_rules("description", "Description", "required");
        $this->form_validation->set_rules("status", "Status", "required");

        if ($this->form_validation->run() == false) {

            $this->create();
        } else {

            $checkexist = $this->ProductCategory_model->getData("product_categories", "category_name", "category_name='" . $this->input->post('name', TRUE) . "'", "", "", "", "");

            if (!empty($checkexist)) {
                $this->session->set_flashdata('warning', 'Leads is already exist');
                redirect("ProductCategoryController/create");

            } else {


                $data = array(

                    "category_name" => $this->input->post("name"),
                    "description" => $this->input->post("description"),
                    "status" => $this->input->post("status"),
                );

                $this->ProductCategory_model->saveData("product_categories", $data);
                $this->session->set_flashdata("success", "Product Category update successfully !");
                redirect("ProductCategoryController/getproductlist");

            }
        }


    }

    public function getproductlist()
    {

        $getlist = $this->ProductCategory_model->getData("product_categories", "", "", "", "", "", "");

        $data = array(

            "allproductcat" => $getlist,
        );

        $this->load->view("productCategory/manageproductCat", $data);
    }

    public function update($id)
    {

        $getproductcat = $this->ProductCategory_model->getData("product_categories", "", "id='" . $id . "'", "", "", "", "1");

        $data = array(
            "id" => set_value("id", $getproductcat->id),
            "name" => set_value("name", $getproductcat->category_name),
            "description" => set_value("description", $getproductcat->description),
            "status" => set_value("status", $getproductcat->status),
        );

        $this->load->view("productCategory/update", $data);

    }
    public function update_action()
    {

        $id = $this->input->post("id");

        $this->form_validation->set_rules("name", "Product Category", "required|regex_match[/^[a-zA-Z]+$/]");
        $this->form_validation->set_rules("description", "Description", "required");
        $this->form_validation->set_rules("status", "Status", "required");

        if ($this->form_validation->run() == false) {

            $this->update($id);

        } else {

            $checkexist = $this->ProductCategory_model->getData("product_categories", "category_name", "category_name='" . $this->input->post('name', TRUE) . "'", "", "", "", "");


            $data = array(
                "category_name" => $this->input->post("name"),
                "description" => $this->input->post("description"),
                "status" => $this->input->post("status"),
            );

            $this->ProductCategory_model->saveData("product_categories", $data, "id='" . $id . "'");

            $this->session->set_flashdata("success", "product category updated successfully");
            redirect("ProductCategoryController/getproductlist");


        }


    }

    public function delete($id)
    {

        $getproductCat = $this->ProductCategory_model->getData("product_categories", "", "id='" . $id . "'", "", "", "", "1");

        $checkproduct = $this->ProductCategory_model->getData("product_subcategories", "", "product_category_id='" . $getproductCat->id . "'", "", "", "", "");

        if (!empty($checkproduct)) {

            $this->session->set_flashdata("warning", "category is mapped with subcaregory");
            redirect("ProductCategoryController/getproductlist");
        } else {

            $this->ProductCategory_model->DeleteData("product_categories", "id='" . $getproductCat->id . "'");
            $this->session->set_flashdata("success", "category deleted successfully");
            redirect("ProductCategoryController/getproductlist");
        }
    }

    public function deleteall_action()
    {
        if (isset($_POST['deleteall'])) {
            if (!empty($this->input->post('selector'))) {
                $id = $this->input->post('selector');
                if (!empty($id)) {
                    $del = 0;
                    $nondel = 0;
                    for ($i = 0; $i < count($id); $i++) {
                        $getsubproduct = $this->ProductCategory_model->GetData("product_categories", "id", "id='" . $id[$i] . "'", "", "", "", "");

                        foreach ($getsubproduct as $getdata) {

                            $checkmap = $this->ProductCategory_model->getdata("product_subcategories", "", "product_category_id='" . $getdata->id . "'", "", "", "", "");
                            if (!empty($checkmap)) {
                                $nondel++;
                            } else {
                                $this->ProductCategory_model->DeleteData("product_categories", "id ='" . $getdata->id . "'");

                                $del++;
                            }
                        }
                    }
                    $massage = $del . " Subproduct record has been deleted" . "<br/>" . $nondel . " Subproduct record not deleted";
                    $this->session->set_flashdata('error', $massage);
                    redirect("ProductCategoryController/getproductlist");
                }
            } else {
                $this->session->set_flashdata('error', 'Check atleast one record to delete');
                redirect("ProductCategoryController/getproductlist");
            }
        }
    }
    public function export()
    {
        $id = $this->input->post('productcatcollectid');
        //   print_r($id); exit;
        $this->ProductCategory_model->ExportData("product_categories", "category_name,description,status,created", $id);
    }


    public function import()
    {
        // Check if form was submitted
        if ($this->input->post('upload') != NULL) {
            // Check if a file was selected
            if (!empty($_FILES['file']['name'])) {
                // Upload configuration
                $config['upload_path'] = 'assets/files';
                $config['allowed_types'] = 'csv';
                $config['max_size'] = '1000';
                $config['file_name'] = $_FILES['file']['name'];

                // Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                // Handle file upload
                if (!$this->upload->do_upload('file')) {
                    // Set error flashdata and redirect
                    $this->session->set_flashdata("error", "File not uploaded");
                    redirect("ProductCategoryController/getproductlist");
                } else {
                    // File successfully uploaded
                    $uploadData = $this->upload->data();
                    $filename = $uploadData['file_name'];

                    // Open the uploaded CSV file
                    $file = fopen("assets/files/" . $filename, "r");
                    $i = 0;
                    $numberOfFields = 2; // Total number of fields
                    $importData_arr = array();
                    $dup = 0; // Variable to count duplicates

                    // Read the CSV file
                    while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                        $num = count($filedata);
                        // print_r($numberOfFields);
                        // print_r("======");
                        if ($numberOfFields == $num) {
                            $importData_arr[$i] = $filedata;
                        }
                        $i++;
                    }
                   ////  print_r($importData_arr);
                   //  exit();
                    fclose($file);

                    $skip = 0;
                    // Insert import data into the database
                    foreach ($importData_arr as $Data) {
                        // Skip the first row (headers)
                        if ($skip != 0) {
                            // Check for duplicates
                            $duplication = $this->ProductCategory_model->GetData("product_categories", "category_name,description", "category_name='" . $Data[0] . "'");

                            if (!empty($duplication)) {
                                $dup++;
                            } else {
                                // Import data if no duplication
                                $this->ProductCategory_model->ImportData($Data);
                            }
                        }
                        $skip++;
                    }

                    // Calculate and set flashdata for records
                    $totalrecords = count(file("assets/files/" . $filename));
                    $this->session->set_flashdata("warning", $dup . " duplicate hobbies record found");
                    $recordimport = ($totalrecords - 1) - $dup;


                    $this->session->set_flashdata("success", $recordimport . " Records imported");
                    $this->session->set_flashdata("info", ($totalrecords - 1) . " Total records");

                    // Redirect to hobby list
                    redirect("ProductCategoryController/getproductlist");
                }
            } else {
                // Set error flashdata for no file selected
                $this->session->set_flashdata("error", "Please select a CSV file");
                redirect("ProductCategoryController/getproductlist");
            }
        }
    }

}
?>