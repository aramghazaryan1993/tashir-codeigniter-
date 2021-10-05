<?php

class ProjectController extends CI_Controller {
         
         public function __Construct()
         {
         	parent::__Construct();
         	
         	 $this->load->model('ProjectModel');
             $this->load->library('serviceClass');
             $this->userID=$this->session->userdata('user_id');
             date_default_timezone_set('Asia/Yerevan');
         }
         
         

         public function Index()
         {
            $startDate=date('Y-m-d',strtotime("-7 days"));
            $endDate =date("Y-m-d") ;
            $project_id="";
            $project_description="";
            $projectName="";
            $autocompleteMode=0;

            $result = $this->ProjectModel->GetProjects
            ($startDate,$endDate,$project_id,$project_description,$projectName,$this->userID,$autocompleteMode);
            
            $data['list'] = $result;
            $data['userID']=$this->userID;

            $this->load->view('show_project',$data);
         
         }

          public function ShowProjects()
         {
            //$this->show_user_list();
            $startDate=$this->input->post('start_date');
            $endDate =$this->input->post('end_date');
            $project_id=$this->input->post('project_id');
            $project_description=$this->input->post('project_description');
            $projectName=$this->input->post('project_name');
            $autocompleteMode=0;

            
            $result = $this->ProjectModel->GetProjects
            ($startDate,$endDate,$project_id,$project_description,$projectName,$this->userID,$autocompleteMode);
            
            $data['list'] =  $result;
            $data['userID']=$this->userID;
            $this->load->view('search_table',$data);
         
         }

         public function GetProjectIdByName()
         {
            $name=$this->input->post('name');  

            $result = $this->ProjectModel->GetProjectIdByName($name);
            echo $result;
         }

         public function ShowProjectsAjax()
         {
            $projectName = $this->input->get('get_project_name', TRUE);
            $startDate="";
            $endDate ="";
            $project_id="";
            $project_description="";
            $autocompleteMode=1;
            $result =  $this->ProjectModel->GetProjects
            ($startDate,$endDate,$project_id,$project_description,$projectName,$this->userID,$autocompleteMode);
                       
            echo $this->serviceclass->GetAutoCompleteList($result);
            
         }

         Public function SaveProject()
         {
            $name=$this->input->post('get_project_name');
            $registrationDate=$this->input->post('get_project_date');
            $description =$this->input->post('get_project_discripshen');
            echo $this->ProjectModel->SaveProject($name,$description,$registrationDate,$this->userID);
         }

        Public function UpdateProject()
        {
            $projectID=$this->input->post('id');
            $name=$this->input->post('name');
            $description=$this->input->post('description');
            $registrationDate=$this->input->post('registrationDate');
            echo $this->ProjectModel->UpdateProject($projectID,$name,$description,$registrationDate,$this->userID);
        }

        function DeleteProject()
        {
            $id = $this->input->post('delete_id');
            echo $this->ProjectModel->DeleteProject($id);
        }

	}
      

