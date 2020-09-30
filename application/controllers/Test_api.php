<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test_api extends CI_Controller {

	
	public function index()
	{
		$this->load->view('api_views');
	}

	public function action()
	{
		
        if ($this->input->post('data_action')) 
		{               
		   $data_action=$this->input->post('data_action');
           

           if ($data_action=="Delete") 
           {
              $api_url="http://localhost/restdemo/api/delete_data";
	          $form_data=array('user_id'=>$this->input->post('user_id'));

	         $client=curl_init($api_url);
	         curl_setopt($client, CURLOPT_POST, true);
	         curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
	         curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
	         $response=curl_exec($client);
	         curl_close($client);
	         echo $response;
           }   
              
	       if ($data_action=="Fetch_single") 
		   {
		       $api_url="http://localhost/restdemo/api/fetch_single";
			   $form_data=array('user_id'=>$this->input->post('user_id'));

			        $client=curl_init($api_url);
			        curl_setopt($client, CURLOPT_POST, true);
			        curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
			        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
			        $response=curl_exec($client);
			        curl_close($client);
			        echo $response;
		   }
		   if ($data_action=="Insert") 
		   {
		       $api_url="http://localhost/restdemo/api/insert";  
		       $form_data=array('first_name'=>$this->input->post('first_name'),
                         'last_name'=>$this->input->post('last_name'),
                         'email'=>$this->input->post('email'),
                         'password'=> $this->input->post('password'),
                         'phone_no'=>$this->input->post('phone_no'),
                         'role_type'=>$this->input->post('role_type'),
                         'from_date'=>$this->input->post('from_date'),
                         'to_date'=>$this->input->post('to_date'));
        
		        $client=curl_init($api_url);
		        curl_setopt($client, CURLOPT_POST, true);
		        curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
		        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		        $response=curl_exec($client);
		        curl_close($client);
		        echo $response;    
		   }

		   if ($data_action=="fetch_all") 
		   { 
		   		$url="http://localhost/restdemo/api";
		   		$client=curl_init($url);
		   		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		   		$response=curl_exec($client);
		   		curl_close($client);
		   		$result=json_decode($response);
		   		$output="";
		   		if (count($result)>0) 
		   		{
		   		   foreach ($result as $row) 
		   		   {
		   		   	 $output.='
		   		   	    <tr>
			                <td>'.$row->first_name.'</td>
			                <td>'.$row->last_name.'</td>
			                <td>'.$row->email.'</td>
			                <td>'.$row->phone_no.'</td>
			                <td>'.$row->role_type.'</td>
			                <td>'.$row->from_date.'</td>
			                <td>'.$row->to_date.'</td>
			                <td><button type="button" name="edit" class="btn btn-warning btn-xs edit" id="'.$row->user_id.'">Edit</button></td>
			               <td> <button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row->user_id.'">Delete</button>
			                </td>
			            </tr>

		   		   	 ';
		   		   }
		   		}
		   		else
		   		{
	              $output='
	               <tr>
	               <td>No data found</td>
	               </tr>
	              ';
		   		}
		   		echo $output;
		   }
		  if ($data_action=="filter") 
		   {
		   	    $url="http://localhost/restdemo/api/filterdata";
		   	    $form_data=array('role_type'=>$this->input->post('role_type'));
		   		$client=curl_init($url);
		   		curl_setopt($client, CURLOPT_POST, true);
			    curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
		   		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		   		$response=curl_exec($client);
		   		curl_close($client);
		   		$result=json_decode($response);
		   		$output="";
		   		if (count(array($result))>0) 
		   		{
		   		   foreach ($result as $row) 
		   		   {
		   		   	 $output.='
		   		   	    <tr>
			                <td>'.$row->first_name.'</td>
			                <td>'.$row->last_name.'</td>
			                <td>'.$row->email.'</td>
			                <td>'.$row->phone_no.'</td>
			                <td>'.$row->role_type.'</td>
			                <td>'.$row->from_date.'</td>
			                <td>'.$row->to_date.'</td>
			                <td><button type="button" name="edit" class="btn btn-warning btn-xs edit" id="'.$row->user_id.'">Edit</button></td>
			               <td> <button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row->user_id.'">Delete</button>
			                </td>
			            </tr>

		   		   	 ';
		   		   }
		   		}
		   		else
		   		{
	              $output='
	               <tr>
	               <td>No data found</td>
	               </tr>
	              ';
		   		}
		   		echo $output;
		   }	
		   		
	    }
	}

	public function update()
	{
		$data_action=$this->input->post('data_action');
		if ($data_action=="Edit") 
		   {
		       $api_url="http://localhost/restdemo/api/update_data";
		       $form_data=array('user_id'=>$this->input->post('user_id'),
		       	         'first_name'=>$this->input->post('first_name'),
                         'last_name'=>$this->input->post('last_name'),
                         'email'=>$this->input->post('email'),
                         'password'=> $this->input->post('password'),
                         'phone_no'=>$this->input->post('phone_no'),
                         'role_type'=>$this->input->post('role_type'),
                         'from_date'=>$this->input->post('from_date'),
                         'to_date'=>$this->input->post('to_date'));
			        $client=curl_init($api_url);
			        curl_setopt($client, CURLOPT_POST, true);
			        curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
			        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
			        $response=curl_exec($client);
			        curl_close($client);
			        echo $response;
		   }    
	}

   
}

