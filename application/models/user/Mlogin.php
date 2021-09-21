<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MLogin extends CI_Model {
    function __construct()
    {
		parent::__construct();
    }
    
	public function login($username,$password='')
	{
		
		if($username=='') return false;
		if($password=='') return false;


		$this->db->select('*');
		$this->db->where('username', $username);
		$this->db->where('status_id','1');	
		$this->db->from('sys_user');				
		$query = $this->db->get();
		
		if ($query->num_rows() == 1){
			   $row = $query->row();
			   
			   if($row->password==md5($password)){
				   date_default_timezone_set('Asia/Colombo');
				   $login_info = array(
				   	   'user_id'  => $row->user_id,	
					   'user_group_id'  => $row->user_group_id,
                                           'username' =>$row->username,
                                           'name'=>$row->name,
//                                           'epf_number'=>$row->epf_number,
										   'email'=>$row->email,                                   
					   'login' => TRUE);
					   $this->session->set_userdata($login_info);
					   $this->get_user_group_info();
					   $data = array(
						   'timestamp' => date("m/d/Y g:i:s A") ,
						   'user_id' => $row->user_id ,
						   'ip' => $this->input->ip_address()
						);
						$this->db->insert('sys_user_login_history', $data); 
						//$this->db->query('UPDATE product p JOIN client_inventory c ON c.product_id = p.product_id SET p.scm_status =1');
	
					   return true;

			   }else{
					return false;
			   }
			} else{
				return false;	
		    }
	}
	
	private function get_user_group_info(){
		
		$this->db->select('*');
		$this->db->where('user_group_id',$this->session->userdata('user_group_id'));	
		$this->db->from('sys_user_group');	
		$query = $this->db->get();
		$row = $query->row();
		//echo $this->db->last_query();
		if ($query->num_rows() == 1){
		  $user_group_info = array(
			   'user_group'  => $row->user_group,
			   'sys_user_group_id' =>  $row->sys_user_group_id);
			   $this->session->set_userdata($user_group_info);
		}
	}
	

	
	public function get_permission($module_id=0){
		$user_group_id = $this->session->userdata('user_group_id');
		
		$this->db->select('*');
		$this->db->where('user_group_id',$user_group_id);
		$this->db->where('module_id',$module_id);	
		$this->db->from('sys_user_group_module');	
		$query = $this->db->get();

		if ($query->num_rows() == 1)
			return true;
		else
			return false;
	}
	
	public function write_history($data){
		
		$data['user_id'] = ($this->session->userdata('user_id')==''?1:$this->session->userdata('user_id'));
		$this->db->set('datetime', 'NOW()', FALSE);
		$this->db->insert('history', $data); 	
	}
	
	public function read_history($data){
		if ($data['ref'] != "") $this->db->where('ref', $data['ref']);
		if ($data['ref_type'] != "") $this->db->where('ref_type', $data['ref_type']);		
		
		$this->db->order_by('datetime','desc'); 	
		$this->db->from('vw_status'); 	
		return $this->db->get(); 	
	}	

        public function password_match($current_password){
          $this->db->select('password');
          $this->db->where('user_id',$this->session->userdata('user_id'));
          $this->db->from('sys_user');	
          $query=$this->db->get();
          if($query->num_rows()==1){
              $row=$query->row();
              
              if($row->password==$current_password){
                  return TRUE;
                  
              }else{
                  return FALSE;
               }
          
            
        }
        }
        
        public function password_update($current_password){
            $password=array(
                'password'=>$current_password
            );
            $this->db->where('user_id',$this->session->userdata('user_id'));
            $this->db->update('sys_user',$password);
            
        }
		
		public function select_randam_image(){
			$this->db->select('sys_image_id,sys_image_name');
			$this->db->from('sys_image');
			$this->db->order_by('rand()');
			$this->db->limit(1);			
			$return=$this->db->get();

			// var_dump($return->result());
			// echo $this->db->last_query();
			// die();
			return $return;
		}

		public function testSp(){

			$status_id=1;
			$status='Active';

			//SqlServer
			$query = $this->db2->query("SelectStatus '".$status_id."',".$status."");


			//MySql
			// $query = $this->db->query("CALL SelectStatus('1')");
			// $query = $this->db2->query("CALL SelectStatus(?)",$status_id);

			var_dump($query->result());
		}
		
}
