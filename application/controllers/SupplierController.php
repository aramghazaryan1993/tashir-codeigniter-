<?php
class SupplierController extends CI_Controller {
         
         public function __Construct()
         {
         	parent::__Construct();
         	
         	 $this->load->model('SupplierModel');
             $this->load->library('serviceClass');
             $this->userID=$this->session->userdata('user_id');
             date_default_timezone_set('Asia/Yerevan');
         }
         
         public function Index($startDate="''",$endDate ="''",$supplier_id="''",$supplier_description="''",
            $supplierName="''")
         {
            $startDate=date('Y-m-d',strtotime("-7 days")) ;
            $endDate =date("Y-m-d");
            $supplier_id="";
            $supplier_description="";
            $supplierName="";
            $autocompleteMode=0;
            
            $result = $this->SupplierModel->GetSuppliers
            ($startDate,$endDate,$supplier_id,$supplier_description,$supplierName,$this->userID,$autocompleteMode);

            $data['list'] = $result;
            $data['userID']=$this->userID;
            $this->load->view('show_supplier',$data);
         
         } 
         public function ShowSuppliers($startDate="''",$endDate ="''",$supplier_id="''",$supplier_description="''",
         	$supplierName="''")
         {
            $startDate=$this->input->post('start_date');
            $endDate =$this->input->post('end_date');
            $supplier_id=$this->input->post('supplier_id');
            $supplier_description=$this->input->post('description');
            $supplierName=$this->input->post('supplier_name');
            $autocompleteMode=0;
            
            $result = $this->SupplierModel->GetSuppliers
         	($startDate,$endDate,$supplier_id,$supplier_description,$supplierName,$this->userID,$autocompleteMode);

            $data['list'] = $result;
            $data['userID']=$this->userID;
         	$this->load->view('search_table',$data);
         
         }

         public function GetSupplierIdByName()
         {
            $name=$this->input->post('name');  

            $result = $this->SupplierModel->GetSupplierIdByName($name);
            echo $result;
         }

         public function ShowSuppliersAjax()
         {
            $supplierName = $this->input->get('get_supplier_name', TRUE);
            $startDate="";
            $endDate ="";
            $supplier_id="";
            $supplier_description="";
            $autocompleteMode=1;
            $result =  $this->SupplierModel->GetSuppliers
            ($startDate,$endDate,$supplier_id,$supplier_description,$supplierName,$this->userID,$autocompleteMode);
                       
            echo $this->serviceclass->GetAutoCompleteList($result);
            
         }

         Public function SaveSupplier()
         {
            $name=$this->input->post('get_supplier_name');
            $registrationDate=$this->input->post('get_supplier_date');
            $description =$this->input->post('get_supplier_discripshen');
            echo $this->SupplierModel->SaveSupplier($name,$description,$registrationDate,$this->userID);
         }

        Public function UpdateSupplier()
        {
            $supplierID=$this->input->post('id');
            $name=$this->input->post('name');
            $description=$this->input->post('description');
            $registrationDate=$this->input->post('registrationDate');
            echo $this->SupplierModel->UpdateSupplier($supplierID,$name,$description,$registrationDate,$this->userID);
        }

         function DeleteSupplier()
         {
            $id = $this->input->post('delete_id');
            echo $this->SupplierModel->DeleteSupplier($id);
         }

	}
      

