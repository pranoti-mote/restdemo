<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Api_model');
	}
	public function index()
	{
		$data=$this->Api_model->get_all_data();
		echo json_encode($data->result_array());
	}
	public function insert()
	{		
		$this->form_validation->set_rules('first_name', 'first name', 'trim|required'); 
		$this->form_validation->set_rules('last_name', 'last name', 'trim|required');
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email'); 
		$this->form_validation->set_rules('password', 'password', 'trim|required'); 
		$this->form_validation->set_rules('phone_no', 'phone no', 'trim|required|regex_match[/^[0-9]{10}$/]'); 
		$this->form_validation->set_rules('role_type', 'user role ', 'trim|required'); 
		$this->form_validation->set_rules('from_date', 'from date', 'trim|required'); 
	    $this->form_validation->set_rules('to_date', 'to date', 'trim|required');
	    if ($this->form_validation->run()) 
	    {
	     	 $data=array('first_name'=>$this->input->post('first_name'),
                         'last_name'=>$this->input->post('last_name'),
                         'email'=>$this->input->post('email'),
                         'password'=> $this->input->post('password'),
                         'phone_no'=>$this->input->post('phone_no'),
                         'role_type'=>$this->input->post('role_type'),
                         'from_date'=>$this->input->post('from_date'),
                         'to_date'=>$this->input->post('to_date'));
	     	 $this->Api_model->insert_api_data($data);
	     	 $array=array('success'=>true);
	    } 
	    else
	    {
              $array=array('error'=>true,
                          'first_name_error'=>form_error('first_name'),
                          'last_name_error'=>form_error('last_name'),
                          'email_error'=>form_error('email'),
                          'password_error'=>form_error('password'),
                          'phone_no_error'=>form_error('phone_no'),
                          'role_type_error'=>form_error('role_type'),
                          'from_date_error'=>form_error('from_date'),
                          'to_date_error'=>form_error('to_date')
                          );
	    }
	    echo json_encode($array);
	}

	public function fetch_single()
	{
		$id=$this->input->post('user_id');
		if($id) 
		{
			$data=$this->Api_model->get_user_data($id);
			foreach ($data as  $row) 
			{
				$output["user_id"]=$row["user_id"];
				$output["first_name"]=$row["first_name"];
				$output["last_name"]=$row["last_name"];
				$output["email"]=$row["email"];
				$output["password"]=$row["password"];
				$output["phone_no"]=$row["phone_no"];
				$output["role_type"]=$row["role_type"];
				$output["from_date"]=$row["from_date"];
				$output["to_date"]=$row["to_date"];
				
			}
			echo json_encode($output);
		}
	}

    public function update_data()
    {
     	$this->form_validation->set_rules('first_name', 'first name', 'trim|required'); 
		$this->form_validation->set_rules('last_name', 'last name', 'trim|required');
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email'); 
		$this->form_validation->set_rules('password', 'password', 'trim|required'); 
		$this->form_validation->set_rules('phone_no', 'trim|phone no', 'required|regex_match[/^[0-9]{10}$/]'); 
		$this->form_validation->set_rules('role_type', 'user role ', 'trim|required'); 
		$this->form_validation->set_rules('from_date', 'from date', 'trim|required'); 
	    $this->form_validation->set_rules('to_date', 'to date', 'trim|required');
	    if ($this->form_validation->run()) 
	    {
	     	 $data=array('first_name'=>$this->input->post('first_name'),
                         'last_name'=>$this->input->post('last_name'),
                         'email'=>$this->input->post('email'),
                         'password'=> $this->input->post('password'),
                         'phone_no'=>$this->input->post('phone_no'),
                         'role_type'=>$this->input->post('role_type'),
                         'from_date'=>$this->input->post('from_date'),
                         'to_date'=>$this->input->post('to_date'));
	     	 $id=$this->input->post('user_id');
	     	 $this->Api_model->update_data($id,$data);
	     	 $array=array('success'=>true);
	    } 
	    else
	    {
              $array=array('error'=>true,
                          'first_name_error'=>form_error('first_name'),
                          'last_name_error'=>form_error('last_name'),
                          'email_error'=>form_error('email'),
                          'password_error'=>form_error('password'),
                          'phone_no_error'=>form_error('phone_no'),
                          'role_type_error'=>form_error('role_type'),
                          'from_date_error'=>form_error('from_date'),
                          'to_date_error'=>form_error('to_date')
                          );
	    }
	    echo json_encode($array);
     }

    public function delete_data()
    { 
    	$id=$this->input->post('user_id');
    	$this->Api_model->delete_user_data($id);
    	  
        $array=array('success'=>true);
    	
       echo json_encode($array);
    }

    public function filterdata()
    {
        $role=$this->input->post('role_type');
        $data=$this->Api_model->get_filter_data($role);

		echo json_encode($data->result_array());	
    }
}
