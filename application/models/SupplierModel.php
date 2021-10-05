<?php
class SupplierModel extends CI_Model
{
	

	public function GetSuppliers($startDate,$endDate,$supplier_id,$supplier_description,$supplierName,
		$userID,$autocompleteMode=0) 
	{
		try {
			   $sql = "call pr_search_suppliers('$startDate','$endDate','$supplier_id','$supplier_description',
			   '$supplierName',$userID,$autocompleteMode)";
			   $result = $this->db->query($sql);

		   	   //throw new Exception($sql);
			   if (!$result)
			   {
			        $error = $this->db->error(); 
			        throw new Exception($error['message']);
			   }
			   
			   return $result;
		   	}

	   	catch(Exception $e)
		   	{
			   $this->db->query('insert into tbl_log(description) values("'.$e->getMessage().'  GetSuppliers()");');
				echo $e->getMessage().'  GetSuppliers()';
			}

	 
	}	

	public function SaveSupplier($name,$description,$registrationDate,$userID)
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
	 		  
	 		  $checkingResult = $this->db->query("select 1 from tbl_suppliers where name ='$name' ");
 			  
 			  if ($checkingResult->num_rows() > 0)
 			  {
	  			 throw new Exception("Նշված անունով մատակարար արդեն կա։", 0);	 
 			  }

	  		  $this->db->trans_start();
			  
		  	  $sql="insert into tbl_suppliers(name,description,registration_date,user_id) 
			  		values('$name','$description','$registrationDate',$userID);";
			  
			  if (!$this->db->query($sql))
			  {
			        $error = $this->db->error(); 
			        throw new Exception($error['message']);
			  }
				$result = $this->db->query("select max(id) as id from tbl_suppliers;");

			   	$a = $result->result_array();
     	   		
     	   		$this->db->trans_complete();
			   return $a[0]["id"];

			}

			catch (Exception $e) 
			{
				$this->db->trans_rollback();
				$this->db->query('insert into tbl_log(description) values("'.$e->getMessage().'  SaveSupplier()");');
				echo $e->getMessage().'  SaveSupplier()';
			}
	   
	 }

	 public function UpdateSupplier($supplierID,$name,$description,$registrationDate,$userID)
	 {
	 	try {
	 			$checkingResult = $this->db->query("select 1 from tbl_suppliers where id = $supplierID");

				if($checkingResult->num_rows() == 0)
				{
					throw new Exception("Մատակարարը գտնված չէ։", 0);				
				}

				if($userID=="")
	 		    {
	 		     	throw new Exception("Մուտքագրողը լրացված չէ։", 0);	 	
	 		    }

				$sql ="update tbl_suppliers set name ='$name', description='$description', 
				  	registration_date='$registrationDate',user_id=$userID where id = $supplierID";

				//throw new Exception($sql, 0);	 	

				if (!$this->db->query($sql))
				{
				    $error = $this->db->error(); 
					throw new Exception($error['message']);
				}

				return $supplierID;
			}
			catch (Exception $e) 
			{
				$this->db->trans_rollback();
				$this->db->query('insert into tbl_log(description) values("'.$e->getMessage().'  UpdateSupplier()");');
				echo $e->getMessage().'  UpdateSupplier()';
			}
	   
	 }

	 public function GetSupplierIdByName($name)
	 {
	 	try {
 				
			$res = $this->db->query("select id from tbl_suppliers where name = ifnull('$name','');");

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
				echo $e->getMessage();
			}
	   
	 }

	 public function DeleteSupplier($id) 
	 {
		try
		{
			$sql = "delete from tbl_suppliers where id=$id";
			//throw new Exception("delete from tbl_suppliers where id=$id");
			
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
			$this->db->query('insert into tbl_log(description) values("'.$e->getMessage().'  DeleteSupplier()");');
			echo $e->getMessage().'  DeleteSupplier()';
	    }

	 }		
}




