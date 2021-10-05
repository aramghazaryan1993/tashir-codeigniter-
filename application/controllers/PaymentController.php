 <?php
include "ShowUsersController.php";
class PaymentController extends CI_Controller {
         
         public function __Construct()
         {
            parent::__Construct();
            
            $this->load->model('PaymentModel');
            $this->userID=$this->session->userdata('user_id');
            date_default_timezone_set('Asia/Yerevan');
          
         }
         
         public function Index()
         {
            $startDate=date('Y-m-d',strtotime("-7 days"));
            $endDate =date("Y-m-d") ;
            $product_id="";
            $product_description="";
            $productName="";
            $projectName="";
            $supplierName="";
            $minPrice="";
            $maxPrice="";
            $sortOrder=1;
            
            $result = $this->PaymentModel->GetPayments
            ($startDate,$endDate,$product_id,$product_description,$productName,$projectName,$supplierName,$minPrice,
               $maxPrice,$sortOrder,$this->userID);
            $data['Payments'] = $result;  
            $this->load->view('index',$data);
            
         }
        

         public function ShowPayments()
         {
            $startDate=$this->input->post('start_date');
            $endDate =$this->input->post('end_date');
            $product_id=$this->input->post('idd');
            $product_description=$this->input->post('description');
            $productName=$this->input->post('product');
            $projectName=$this->input->post('project');
            $supplierName=$this->input->post('supplier');
            $minPrice=$this->input->post('min_price');
            $maxPrice=$this->input->post('max_price');
            $sortOrder=$this->input->post('sort_order');
            
            $result = $this->PaymentModel->GetPayments
            ($startDate,$endDate,$product_id,$product_description,$productName,$projectName,$supplierName,$minPrice,
               $maxPrice,$sortOrder,$this->userID);

            $data['Payments'] = $result;
            $this->load->view('search_table_payment',$data);

         }

           public function GetPaymentByID()
         {
            $paymentID=$this->input->post('payment_id');

            $result=$this->PaymentModel->GetPaymentByID($paymentID);
            echo json_encode($result);

         }

         public function GetMinMaxPrices()
         {
            $startDate=$this->input->post('start_date');
            $endDate =$this->input->post('end_date');
            $payment_id=$this->input->post('idd');
            $product_description=$this->input->post('description');
            $productName=$this->input->post('product');
            $projectName=$this->input->post('project');
            $supplierName=$this->input->post('supplier');
            $minPrice=$this->input->post('min_price');
            $maxPrice=$this->input->post('max_price');

            $result = $this->PaymentModel->GetMinMaxPrices
            ($startDate,$endDate,$payment_id,$product_description,$productName,$projectName,$supplierName,$minPrice,$maxPrice,$this->userID);

            echo json_encode($result); 
         }

         Public function SavePayment(){
            $productID=$this->input->post('get_product_id');
            $projectID=$this->input->post('get_project_id');
            $supplierID=$this->input->post('get_supplier_id');
            $registrationDate=$this->input->post('date');
            $price=$this->input->post('price');
            $quantity=$this->input->post('quantity');
            $description=$this->input->post('payment_description');

           
            echo $this->PaymentModel->SavePayment($productID,$supplierID,$projectID,$description,$registrationDate,
               $price,$quantity,$this->userID);
         }


        Public function updatePayment()
        {
            $paymentID            = $this->input->post('payment_id');
            $productID            = $this->input->post('get_product_id'); 
            $projectID            = $this->input->post('get_project_id');
            $supplierID           = $this->input->post('get_supplier_id');
            $paymentDescription   = $this->input->post('payment_description');
            $price                = $this->input->post('price');
            $quantity             = $this->input->post('quantity');
            $registrationDate     = $this->input->post('date');
           
           echo $this->PaymentModel->updatePayment($paymentID,$productID,$projectID,$supplierID,$paymentDescription,$price,$quantity,$registrationDate,$this->userID);
        }


         
         function DeletePayment()
         {
            $paymentID = $this->input->post('delete_payment_id');
            $this->PaymentModel->DeletePayment($paymentID);
         }

         

}

