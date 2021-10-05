<?php
class PaymentModel extends CI_Model
{
	

	public function __construct()
	{
		parent::__construct();
		
	}

	public function GetPayments($startDate,$endDate,$product_id,$product_description,$productName,$projectName,$supplierName,$minPrice,$maxPrice,$sortOrder,$userID) 
	{
		try
		{
		   $sql = "call pr_search_payments('$startDate','$endDate','$product_id','$product_description',
		   '$productName','$projectName','$supplierName','$minPrice','$maxPrice','$sortOrder',$userID)";
		   //return $sql;
		   $result = $this->db->query($sql);

		  
		   if (!$result)
		   {
		        $error = $this->db->error(); 
		        throw new Exception($error['message']);
		   }

	   	   return $result;
   	   	}

		catch (Exception $e) 
		{
			$this->db->query('insert into tbl_log(description) values("'.$e->getMessage().'  GetPayments()");');
			echo $e->getMessage().'  GetPayments()';
	    }

	 }

	public function GetPaymentByID($paymentID) 
	{
		try 
		{
		   $sql = "SELECT PD.id product_id,PJ.id project_id,S.id supplier_id, P.registration_date, PD.name productName, p.description,    
					PJ.name projectName, S.name supplierName,
					price,quantity FROM tbl_payments P 
					INNER JOIN tbl_suppliers S ON P.supplier_id=S.id
					INNER JOIN tbl_products PD ON PD.ID=P.product_id
					INNER JOIN tbl_projects PJ ON PJ.id=P.project_id    WHERE P.id=$paymentID;";
		   $result = $this->db->query($sql);

		   $a = $result->result_array();
		   
	   	   return $a;
		}

		catch (Exception $e) 
		{
			echo $e->getMessage() ;
	    }

	 }

 	public function GetMinMaxPrices($startDate,$endDate,$payment_id,$product_description,$productName,$projectName,$supplierName,$minPrice,$maxPrice,$userID) 
	{
		try 
		{
		   $sql = "call pr_get_min_max_prices('$startDate','$endDate','$payment_id','$product_description',
		   '$productName','$projectName','$supplierName','$minPrice','$maxPrice',$userID)";
		   $result = $this->db->query($sql);

		   $a = $result->result_array();
		   

	   	   return $a;
		}

		catch (Exception $e) 
		{
			echo "<div style='color:red;'> ".$e->getMessage() ."</div>";
	    }

	 }

	 public function SavePayment($productID,$supplierID,$projectID,$description,$registrationDate,$price,$quantity,$userID)
	 {
	 	try {
	 		
	 		  if($productID=="" || $supplierID=="" || $projectID =="" 
	 		  	 || $registrationDate=="" || $price =="" || $quantity=="")
	 		  {
	 		  	throw new Exception("Տվյալները ճիշտ լրացված չեն։", 0);	 
	 		  }

	 		  if($price<0 )
	 		  {
	 		  	throw new Exception("Գինը չի կարող լինել բացասական մեծություն։", 0);	 	
	 		  }

	 		  if($quantity<0)
	 		  {
	 		  	throw new Exception("Քանակը չի կարող լինել բացասական մեծություն։", 0);	 	
	 		  }

	 		  if($userID=="")
	 		  {
	 		  	throw new Exception("Մուտքագրողը լրացված չէ։", 0);	 	
	 		  }

			  $checkingResult = $this->db->query("select 1 from tbl_products where id ='$productID' ");
 			  if ($checkingResult->num_rows() == 0)
 			  {
	  			 throw new Exception("Պրոդուկտը մուտքագրված չէ։", 0);	 
 			  }

 			  $checkingResult = $this->db->query("select 1 from tbl_projects where id ='$projectID' ");
 			  if ($checkingResult->num_rows() == 0)
 			  {
	  			 throw new Exception("Պրոյեկտը մուտքագրված չէ։", 0);	 
 			  }

 			  $checkingResult = $this->db->query("select 1 from tbl_suppliers where id ='$supplierID' ");
 			  if ($checkingResult->num_rows() == 0)
 			  {
	  			 throw new Exception("Մատակարարը մուտքագրված չէ։", 0);	 
 			  }
			
     		  $this->db->trans_start();
 		  	  $a="insert into tbl_payments(product_id,supplier_id,project_id,description,registration_date,price,quantity,user_id) 
			  		values($productID,$supplierID,$projectID,'$description','$registrationDate',
			  		$price,$quantity,$userID);";
			  		
		  	//throw new Exception($a, 0);	
 		  	 
 		  	 $this->db->query($a);
 		  	 

 		  	 
 			  $result = $this->db->query("select max(id)  as id from tbl_payments;");

			   $a = $result->result_array();
   	     	   $this->db->trans_complete();
			   return $a[0]["id"];
			}

			catch (Exception $e) 
			{
				$this->db->trans_rollback();
				echo $e->getMessage();
				
		    }
	   
	 }

  	 public function updatePayment($paymentID,$productID,$projectID,$supplierID,$paymentDescription,$price,$quantity,$registrationDate,$userID)
	 {
	 	try {

	 			$checkingResult = $this->db->query("select 1 from tbl_payments where id = $paymentID");

				if($checkingResult->num_rows() == 0)
				{
					throw new Exception("Գործարքը գտնված չէ։", 0);				
				}

				if($productID=="" || $supplierID=="" || $projectID =="" 
		 		  	 || $registrationDate=="" || $price =="" || $quantity=="")
		 		{
		 		  	throw new Exception("Տվյալները ճիշտ լրացված չեն։", 0);	 
		 		}

		 		  if($price<0 )
		 		{
		 		  	throw new Exception("Գինը չի կարող լինել բացասական մեծություն։", 0);	 	
		 		}

		 		if($userID=="")
		 		{
		 			throw new Exception("Մուտքագրողը լրացված չէ։", 0);	 	
		 		}

		 		  if($quantity<0)
		 		{
		 		  	throw new Exception("Քանակը չի կարող լինել բացասական մեծություն։", 0);	 	
		 		}

				  $checkingResult = $this->db->query("select 1 from tbl_products where id ='$productID' ");
	 			  if ($checkingResult->num_rows() == 0)
	 			{
		  			 throw new Exception("Պրոդուկտը մուտքագրված չէ։", 0);	 
	 			}

	 			$checkingResult = $this->db->query("select 1 from tbl_projects where id ='$projectID' ");
	 			  if ($checkingResult->num_rows() == 0)
	 			{
		  			 throw new Exception("Պրոյեկտը մուտքագրված չէ։", 0);	 
	 			}

	 			$checkingResult = $this->db->query("select 1 from tbl_suppliers where id ='$supplierID' ");
	 			if ($checkingResult->num_rows() == 0)
	 			{
		  			 throw new Exception("Մատակարարը մուտքագրված չէ։", 0);	 
	 			}

				$res = $this->db->query("update tbl_payments set product_id = $productID, project_id = $projectID, supplier_id = $supplierID, description = '$paymentDescription', price = $price, quantity = $quantity, registration_date = '$registrationDate'  where id = $paymentID");
	            
	        	return $paymentID;
			}
			catch (Exception $e) 
			{
				echo $e->getMessage();
			}
   
	 }

	public function DeletePayment($paymentID) 
	{

		try
		{
	   		$this->db->delete('tbl_payments', array('id' => $paymentID)); 
		}
	   
 		catch (Exception $e) 
		{
			echo $e->getMessage();
	    }

	 }	
}


