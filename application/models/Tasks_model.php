<?php
class Cards_model extends Hinato_model {
	public function __construct(){
		parent::__construct();
	}
	function addTask($task){
		$this->db->insert('tasks',$task);
	}
	function getTasks($card){
		$this->db->where('card',$card);
		$this->db->order_by('position','ASC');
		return $this->db->get('tasks')->result_array();
	}
	function setTask($id,$task){
		$this->db->where('id_task',$id);
		$this->db->update('tasks',$task);
	}
	function delTask($id){
		$this->db->where('id_task',$id);
		$this->db->delete('tasks');
	}
}
