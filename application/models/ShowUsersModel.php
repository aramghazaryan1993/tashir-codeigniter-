<?php
class ShowUsersModel extends CI_Model {
   

   public function show_user_model($get_user_id)
      {
		$query = $this->db->query("select * from tbl_users where ifnull(user_type,0)<>1 and id='$get_user_id' ");
		return $query->result_array();
	  }

   public function show_user_permissions($get_user_id)
	 {
	 	try {
	 		  if($get_user_id=="")
	 		  {
	 		  	throw new Exception("Օգտագործողը գտնված չէ", 0);	 
	 		  }

	  		  $sql ="select PJ.id, PJ.name, permission_type from tbl_users U 
				inner join tbl_permissions P on P.user_id=U.id
				inner join tbl_projects PJ on PJ.id=P.project_id where U.id='$get_user_id' ";

			  $result=$this->db->query($sql);
 	  		  
 	  		  if (!$result)
			  {
			        $error = $this->db->error(); 
			        throw new Exception($error['message']);
			  }
	  		  
	  		   $a = $result->result_array();

   	     	   return $a;


			}
			catch (Exception $e) 
			{
				$this->db->query('insert into tbl_log(description) values("'.$e->getMessage().'  show_user_permissions()");');
				echo $e->getMessage().'  show_user_permissions()';
			}
	   
	 }

	 public function AddPermission($project_id,$permission_type,$user_id)
	 {
	 	try {
	 		  if($project_id=="" || $permission_type=="" || $user_id=="")
	 		  {
	 		  	throw new Exception("Տվյալները ճիշտ լրացված չեն։", 0);	 
	 		  }
			  
			  //throw new Exception($sql,0);
			  $checkingResult = $this->db->query("select 1 from tbl_permissions where project_id=
			  	$project_id and user_id=$user_id");
 	
 			  if ($checkingResult->num_rows() > 0)
 			  {
	  			 throw new Exception("Նշված պրոյեկտին հասանելիություն արդեն տրամադրված է:", 0);	 
 			  }


	  		  $this->db->trans_start();

	  		  $sql ="insert into tbl_permissions (user_id,project_id,permission_type)
				values($user_id,$project_id,$permission_type);";
	  		  
	  		

 	  		  if (!$this->db->query($sql))
			  {
			        $error = $this->db->error(); 
			        throw new Exception($error['message']);
			  }
	  		  

			  $result = $this->db->query("select max(id) as id from tbl_permissions;");

	  		   $a = $result->result_array();
   	     	   $this->db->trans_complete();

   	     	   return $user_id;


			}
			catch (Exception $e) 
			{
				$this->db->trans_rollback();
				$this->db->query('insert into tbl_log(description) values("'.$e->getMessage().'  AddPermission()");');
				echo $e->getMessage().'  AddPermission()';
			}
	   
	 }	

	 public function edit_user_permission($project_id,$permission_type,$user_id)
	 {
	 	try {
	 		  if($project_id=="" || $permission_type=="" || $user_id=="")
	 		  {
	 		  	throw new Exception("Տվյալները ճիշտ լրացված չեն։", 0);	 
	 		  }
			  
			  //throw new Exception($sql,0);
			  $checkingResult = $this->db->query("select 1 from tbl_permissions where project_id=
			  	$project_id and user_id=$user_id");
 	
 			  if ($checkingResult->num_rows() == 0)
 			  {
	  			 throw new Exception("Նշված պրոյեկտին հասանելիություն տրամադրված չէ:", 0);	 
 			  }


	  		  $this->db->trans_start();

			$sql ="update tbl_permissions set permission_type=$permission_type where user_id=$user_id and 
				project_id=$project_id";
	  		  
	  		
			//throw new Exception($sql,0);

 	  		  if (!$this->db->query($sql))
			  {
			        $error = $this->db->error(); 
			        throw new Exception($error['message']);
			  }
	  		  

			  $result = $this->db->query("select max(id) as id from tbl_permissions;");

	  		   $a = $result->result_array();
   	     	   $this->db->trans_complete();

   	     	   return $user_id;


			}
			catch (Exception $e) 
			{
				$this->db->trans_rollback();
				$this->db->query('insert into tbl_log(description) values("'.$e->getMessage().'  edit_user_permission()");');
				echo $e->getMessage().'  edit_user_permission()';
			}
	   
	 }	

	  public function delete_user_permission($project_id,$user_id)
	 {
	 	try {
	 		  if($project_id=="" || $user_id=="")
	 		  {
	 		  	throw new Exception("Տվյալները գտնված չեն։", 0);	 
	 		  }
			  
 	  		$this->db->trans_start();
	  		$sql ="delete from tbl_permissions where user_id=$user_id and project_id=$project_id";  
	  		
			//throw new Exception($sql,0);

 	  		  if (!$this->db->query($sql))
			  {
			        $error = $this->db->error(); 
			        throw new Exception($error['message']);
			  }
	  		  

			  $result = $this->db->query("select max(id) as id from tbl_permissions;");

	  		   $a = $result->result_array();
   	     	   $this->db->trans_complete();

   	     	   return $user_id;


			}
			catch (Exception $e) 
			{
				$this->db->trans_rollback();
				$this->db->query('insert into tbl_log(description) values("'.$e->getMessage().'  delete_user_permission()");');
				echo $e->getMessage().'  delete_user_permission()';
			}
	   
	 }	


   public function delete_user_model($user_id)
   {
           try
		{
	   		$this->db->delete('tbl_users', array('id' => $user_id)); 
		}
	   
 		catch (Exception $e) 
		{
			echo $e->getMessage();
	    }
         
   }

   public function edit_user_model($first_name,$last_name,$email,$user_id)
   {
       
			$data = array(
			        'first_name' => $first_name,
				    'last_name'  => $last_name,
				    'email'      => $email
				         );

	   		$this->db->where('id', $user_id);
	   		$this->db->update('tbl_users', $data);
	   		
		}
	   
 		
         
   


}


