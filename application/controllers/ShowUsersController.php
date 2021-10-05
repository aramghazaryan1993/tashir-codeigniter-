<?php
class ShowUsersController extends CI_Controller {


    public function __construct()
	{
		parent::__construct();
		$this->load->model('ShowUsersModel');
		$this->load->helper('email');
		date_default_timezone_set('Asia/Yerevan');
	}


	public function show_user_data($get_user_id)
	{
		$data['user_permissions'] = $this->ShowUsersModel->show_user_permissions($get_user_id);
        $data['user_data'] = $this->ShowUsersModel->show_user_model($get_user_id);
        $this->load->view('show_users',$data);
	}

	public function show_user_permissions($get_user_id)
	{
        $data['user_permissions'] = $this->ShowUsersModel->show_user_permissions($get_user_id);
        $data['user_data'] = $this->ShowUsersModel->show_user_model($get_user_id);
        $this->load->view('show_users',$data);
	}

	public function AddPermission()
	{
	    $project_id           = $this->input->post('project_id');
	    $permission_type      = $this->input->post('permission_type');
	    $user_id              = $this->input->post('user_id');

		echo $this->ShowUsersModel->AddPermission($project_id,$permission_type,$user_id);
	}

	public function edit_user_permission()
	{
	    $project_id           = $this->input->post('project_id');
	    $permission_type      = $this->input->post('permission_type');
	    $user_id              = $this->input->post('user_id');

		echo $this->ShowUsersModel->edit_user_permission($project_id,$permission_type,$user_id);
	}

	public function delete_user_permission()
	{
	    $project_id           = $this->input->post('project_id');
	    $user_id              = $this->input->post('user_id');

		echo $this->ShowUsersModel->delete_user_permission($project_id,$user_id);
	}
	

	public function delete_user()
	{
		   $user_id = $this->input->post('delete_user');
           $this->ShowUsersModel->delete_user_model($user_id);
	}

	public function edit_user(){
		
		    $email      = $this->input->post('email');
        
        if(valid_email($email) and !empty($email))
        {
        	$first_name = $this->input->post('first_name');
		    $last_name  = $this->input->post('last_name');
		    $user_id    = $this->input->post('edit_user');

        	$this->ShowUsersModel->edit_user_model($first_name,$last_name,$email,$user_id);
        }

        
	}


  

}