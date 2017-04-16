<?php
class Users_model extends Hinato_model {
	public function __construct(){
		parent::__construct();
	}
	/*CHECK*/
		public function checkEmail($email){
			$this->db->select('email');
			$this->db->from('users');
			$this->db->where('email',$email);
			return $this->db->get()->result_array();
		}
		public function getPasswd($email){
			$this->db->select('pass');
			$this->db->from('users');
			$this->db->where('email',$email);
			return $this->db->get()->result_array();
		}
	/*END OF CHECK*/
	function addUser($user){
		$this->db->insert('users',$user);
	}
	function getUser($index){
		if (strpos($index,"@")>1){
			$this->db->where('email',$index);
		}else{
			$this->db->where('alias',$index);
		}
		return $this->db->get('users')->result_array();
	}
	function setUser($id,$user){
		$this->db->where('id_user',$id);
		$this->db->update('users',$user);
	}
	function delUser($id){
		$this->db->where('id_user', $id);
		$this->db->delete('users');
	}
}
