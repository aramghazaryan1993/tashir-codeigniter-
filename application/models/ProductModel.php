	<?php
class ProductModel extends CI_Model
{
	

	public function GetProducts($startDate,$endDate,$product_id,$product_description,
		$productName,$userID,$autocompleteMode=0) 
	{
		try {

			   $sql = "call pr_search_products('$startDate','$endDate','$product_id','$product_description',
			   '$productName',$userID,$autocompleteMode)";
			   
			   $result = $this->db->query($sql);
			   
			   if (!$result)
			   {
			        $error = $this->db->error(); 
			        throw new Exception($error['message']);
			   }
			   //throw new Exception($sql,0);
			   return $result;
			}

		catch (Exception $e) 
			{
				$this->db->query('insert into tbl_log(description) values("'.$e->getMessage().'  GetProducts()");');
				echo $e->getMessage().'  GetProducts()';
			}
	}	

	

	 public function SaveProduct($name,$description,$registrationDate,$userID)
	 {
	 	try {
	 		  if($name=="" || $registrationDate=="" )
	 		  {
	 		  	throw new Exception("Տվյալները ճիշտ լրացված չեն։", 0);	 
	 		  }

	 		  if($userID=="")
	 		  {
	 		  	throw new Exception("Մուտքագրողը լրացված չէ։", 0);	 	
	 		  }
			  
			  $checkingResult = $this->db->query("select 1 from tbl_products where name ='$name' ");
 			  
 			  if ($checkingResult->num_rows() > 0)
 			  {
	  			 throw new Exception("Նշված անունով պրոդուկտ արդեն կա։", 0);	 
 			  }


	  		  $this->db->trans_start();

	  		  $sql ="insert into tbl_products(name,description,registration_date,user_id) 
			  		values('$name','$description','$registrationDate',$userID);";
	  		  
	  		

 	  		  if (!$this->db->query($sql))
			  {
			        $error = $this->db->error(); 
			        throw new Exception($error['message']);
			  }

			  $result = $this->db->query("select max(id) as id from tbl_products;");

	  		   $a = $result->result_array();
   	     	   $this->db->trans_complete();

   	     	   return $a[0]["id"];


			}
			catch (Exception $e) 
			{
				$this->db->trans_rollback();
				$this->db->query('insert into tbl_log(description) values("'.$e->getMessage().'  SaveProduct()");');
				echo $e->getMessage().'  SaveProduct()';
			}
	   
	 }	

 	 public function UpdateProduct($productID,$name,$description,$registrationDate,$userID)
	 {
	 	try {
	 			$checkingResult = $this->db->query("select 1 from tbl_products where id = $productID");

				if($checkingResult->num_rows() == 0)
				{
					throw new Exception("Պրոդուկտը գտնված չէ։", 0);				
				}

			    if($userID=="")
	 		    {
	 		     	throw new Exception("Մուտքագրողը լրացված չէ։", 0);	 	
	 		    }

				$result = $this->db->query("update tbl_products set name ='$name', description='$description', 
				  	registration_date='$registrationDate',user_id=$userID where id = $productID");
				
				if (!$result)
			    {
			        $error = $this->db->error(); 
			        throw new Exception($error['message']);
			    }
				return $productID;
			}
			catch (Exception $e) 
			{
				$this->db->query('insert into tbl_log(description) values("'.$e->getMessage().'  updateProduct()");');
				echo $e->getMessage().'  updateProduct()';
			}
	   
	 }

  	 public function GetProductIdByName($name)
	 {
	 	try {
 				
			$res = $this->db->query("select id from tbl_products where name = ifnull('$name','');");

			$row = $res->row();

			if (isset($row))
			{
			    $result = $row->id;
			}
			else
			{
				$result ='0';
			}

			
			return $result;
             

			}
			catch (Exception $e) 
			{
				echo getMessage();
			}
	   
	 }

	 public function DeleteProduct($id) 
	 {
		try
		{
			$sql = "delete from tbl_products where id=$id";
			//throw new Exception("delete from tbl_products where id=$id");
			
	   		$result = $this->db->query($sql);

			if (!$result)
		    {
		        $error = $this->db->error(); 
		        throw new Exception($error['message']);
		    }
		    return $id;
		}
	   
 		catch (Exception $e) 
		{
			$this->db->query('insert into tbl_log(description) values("'.$e->getMessage().'  DeleteProduct()");');
			echo $e->getMessage().'  DeleteProduct()';
	    }

	 }	
}




