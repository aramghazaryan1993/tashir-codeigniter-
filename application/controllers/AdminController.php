<?php

class AdminController extends CI_Controller {


    public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->helper('email');
		
	}



	public function index()
	{  
		if($this->session->userdata('session_name') !=true){
		$this->load->view('login');	                                                         }
	    else{
	    	 return    redirect(base_url('index.php/PaymentController/Index'));
	    	 
		     
	    }                                                                                             
	}

	

	public function check(){

		$email    = $this->input->post('email');
		$password = $this->input->post('password');

		if(valid_email($email) and !empty($email)){

		$userID = $this->admin_model->check_model($email,$password);
		if($userID!= -1){
	        $session_data = array(
	          'user_id' => $userID,
	          'session_name' => $email
	        );


	 	    $this->session->set_userdata($session_data);
			redirect(base_url('index.php/PaymentController/Index'));
		}
		else
		{
			redirect(base_url('index.php/AdminController/index'));
		}

        }
        else
        {
           echo '<script type="text/javascript">alert("Խնդրում ենք մուտքագրեք Էլ․ փոստ։");</script>';
           $this->load->view('login');
        }

	}
     

	

	public function logout(){
		$this->session->unset_userdata('session_name');
		$this->session->unset_userdata('user_id');
		redirect(base_url('index.php/AdminController/index'));
	}

	public function validation_email(){
		$this->load->view('email_validation');
	}

	public function replace_password(){
		$this->load->view('forgot_password');
	}

    public function security_code(){
    	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
        return $security_code = substr( str_shuffle( $chars ), 0, 8 );
    }

	public function signup(){
		
        $data['security_code'] = $this->security_code();
		$this->load->view('signup',$data);
	}

	public function add_user(){

		$first_name    = $this->input->post('first_name');
		$last_name     = $this->input->post('last_name');
		$email         = $this->input->post('email');
		$password      = $this->input->post('password');
		$security_code = $this->input->post('security_code');		
        if(valid_email($email) && !empty($email))
        {
        $this->admin_model->add_user_model($first_name,$last_name,$email,$password,$security_code);
        }

	}



    public function check_email(){

        $email = $this->input->post('email');
		 if($this->admin_model->check_email_model($email)){
			echo 'oko';
		}else{
			echo base_url('index.php/AdminController/signup');
		}
    }
    
	public function edit_security_code(){
		 
		 if($this->check_email()==1)
		 {  
		 	 $email = $this->input->post('email');
		 	 $security_code = $this->security_code(); //mail
		 	 $this->admin_model->edit_security_code_model($security_code,$email);
		 	echo 1;
		 }else{
		 	echo 2;
		 }
	}

    public function check_security_code()

    {
        echo $security_code = $this->input->post('security_code');
        $this->admin_model->check_security_code($security_code);
    }

	public function edit_password(){

		$security_code   = $this->input->post('security_code');
		$password        = $this->input->post('password');
        $repeat_password = $this->input->post('repeat_password');

		if($repeat_password == $password)
		{
			 $this->admin_model->edit_password_model($security_code,$password);
             $this->load->view('login');
		 	 echo "<style>#repeat_password{border-color:red;}</style>";
		 }

		 else
		 {
		 	$this->load->view('forgot_password');
		 	$a = '#repeat_password{border-color:red;}';
		 	echo "<style>".$a."</style>";
		 }
       
	}


}	