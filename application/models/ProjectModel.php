<?php
class ProjectModel extends CI_Model
{
	

	public function GetProjects($startDate,$endDate,$project_id,$project_description,$projectName,$userID,$autocompleteMode=0) 
	{
		try {
			   $sql = "call pr_search_projects('$startDate','$endDate','$project_id',
			   '$project_description','$projectName',$userID,$autocompleteMode)";
				//throw new Exception($sql, 0);	
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
				$this->db->query('insert into tbl_log(description) values("'.$e->getMessage().'  GetProjects()");');
				echo $e->getMessage().'  GetProjects()';
			}
	}	

	 public function SaveProject($name,$description,$registrationDate,$userID)
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
     	 	  
     	 	  $checkingResult = $this->db->query("select 1 from tbl_projects where name ='$name' ");
 			  
 			  if ($checkingResult->num_rows() > 0)
 			  {
	  			 throw new Exception("Նշված անունով պրոյեկտ արդեն կա։", 0);	 
 			  }


	  		  $sql ="call pr_add_project('$name','$description','$registrationDate',$userID)";
	  		  
	  		
	  		  $result = $this->db->query($sql);

 	  		  if (!$result)
			  {
			        $error = $this->db->error(); 
			        throw new Exception($error['message']);
			  }

			  $projectID=$result->row()->id;
			  
			   //$this->db->query("SET AUTOCOMMIT=0");
			   //$this->db->trans_start();

			  
/*			  	$result=$this->db->query("select  permission_type from tbl_permissions where user_id = $userID and permission_type = 3  limit 1;");

			  	if(!$result)
			  	{
			  		$permissionType= 3;
			  	}
			  	else
		  		{
		  			$permissionType=2;	
		  		}
			  	

		  		$sql ="insert into tbl_projects(name,description,registration_date,user_id) 
				    values ('$name','$description','$registrationDate',$userID);";
			  	$this->db->query($sql);
			  					
			  	$sql="select max(id) as project_id from tbl_projects;";
			  	$result=$this->db->query($sql);

			  	

			  	$projectID = $result->row()->project_id;
		  		
		  		$sql ="insert into tbl_permissions(user_id,project_id,permission_type) 
				    values ($userID,$projectID,$permissionType); ";
			  	$this->db->query($sql);



			  	$sql ="insert into tbl_permissions(user_id,project_id,permission_type) 
				select id,$projectID,permission_type from tbl_users where user_id in( select user_id from tbl_permissions where permission_type=3 group by user_id)";
				$this->db->query($sql);*/



   	     	   //$this->db->trans_complete();
   	     	   //throw new Exception($sql, 0);	 

			   return $projectID;

			}
			catch (Exception $e) 
			{
			  //$this->db->trans_rollback();
			  //$this->db->trans_complete();
			  $this->db->query('insert into tbl_log(description) values("'.$e->getMessage().'  SaveProject()");');
			  echo $e->getMessage().'  SaveProject()';
			}
	   
	 }

  	 public function UpdateProject($projectID,$name,$description,$registrationDate,$userID)
	 {
	 	try {
	 			$checkingResult = $this->db->query("select 1 from tbl_projects where id = $projectID");

				if($checkingResult->num_rows() == 0)
				{
					throw new Exception("Պրոյեկտը գտնված չէ։", 0);				
				}

				if($userID=="")
	 		    {
	 		     	throw new Exception("Մուտքագրողը լրացված չէ։", 0);	 	
	 		    }

				$result = $this->db->query("update tbl_projects set name ='$name', description='$description', 
				  	registration_date='$registrationDate',user_id=$userID where id = $projectID");

				if (!$result)
			    {
			        $error = $this->db->error(); 
			        throw new Exception($error['message']);
			    }
			    
				return $projectID;
			}
			catch (Exception $e) 
			{
				$this->db->query('insert into tbl_log(description) values("'.$e->getMessage().'  UpdateProject()");');
				echo $e->getMessage().'  UpdateProject()';
			}
	   
	 }

	 public function GetProjectIdByName($name)
	 {
	 	try {
 				
			$res = $this->db->query("select id from tbl_projects where name = ifnull('$name','');");

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


		 public function DeleteProject($id) 
	 {
		try
		{
			$sql = "delete from tbl_projects where id=$id";
			//throw new Exception("delete from tbl_projects where id=$id");
			
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
			$this->db->query('insert into tbl_log(description) values("'.$e->getMessage().'  DeleteProject()");');
			echo $e->getMessage().'  DeleteProject()';
	    }

	 }
}





