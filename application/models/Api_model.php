<?php 
/**
 * 
 */
class Api_model extends CI_Model
{
	
	/*function __construct(argument)
	{
		# code...
	}*/
	public function get_all_data()
	{
		$this->db->order_by('user_id','DESC');
		return $this->db->get('user_table');

	}
	public function insert_api_data($data)
	{
		$this->db->insert('user_table',$data);
	}
	public function get_user_data($id)
	{
       $this->db->where('user_id',$id);
       $query=$this->db->get('user_table');
       return $query->result_array();
	}
	public function delete_user_data($id)
	{
       $this->db->where('user_id',$id);
       $query=$this->db->delete('user_table');
	}

	public function update_data($id,$data)
	{
       $this->db->where('user_id',$id);
       $query=$this->db->update('user_table',$data);
      
	}
	public function get_filter_data($role)
	{
	   $this->db->where('role_type',$role);
       return $this->db->get('user_table');
       
	}
}