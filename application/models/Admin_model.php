<?php
class Admin_model extends CI_Model {



	public function check_model($email,$password){
	 $query = $this->db->get_where('tbl_users', array('email' => $email,'password'=>md5($password)));
	 if($query->num_rows()>0){
	 	return $query->row()->id;	 	 
	 }
	 	return -1;
	}


	public function add_user_model($first_name,$last_name,$email,$password,$security_code){

		 $data = array(
         'first_name'    => $first_name,
         'last_name'     => $last_name,
         'email'         => $email,
         'password'      => md5($password),
         'security_code' => $security_code
		 );
		 $this->db->insert('tbl_users',$data);
		 echo $this->db->insert_id();
	}

	

	public function edit_user_model()
	{

	}

	public function delete_user_model()
	{

	}

	public function check_email_model($email)
	{
    	 
		 $sql = "select 1 as result from tbl_users where email='$email' ";
    	 $query = $this->db->query($sql);
    	
    	 if(isset($query->row()->result)){
    	 return  $query->row()->result;

    	}else{
    		echo 'false';
    	}

    }

    public function edit_security_code_model($security_code,$email){
             
           $this->db->set('security_code', $security_code);
           $this->db->where('email', $email);
           $this->db->update('tbl_users');

	}

    public function check_security_code($security_code)

    {
         $sql = "select 1 as result from tbl_users where security_code='$security_code' ";
    	 $query = $this->db->query($sql);
    	
    	 if(isset($query->row()->result)){
    	 return  $query->row()->result;

    	}else{
    		echo 'false';
    	}  
    }

	public function edit_password_model($security_code,$password){

		  $this->db->set('password', md5($password));
          $this->db->where('security_code', $security_code);
          $this->db->update('tbl_users');
	}





}