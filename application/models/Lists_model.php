<?php
class Lists_model extends Hinato_model {
	public function __construct(){
		parent::__construct();
	}
	function addList($list){
		$this->db->insert('lists',$list);
	}
	function getLists($board){
		$this->db->where('board',$board);
		$this->db->order_by('position','ASC');
		return $this->db->get('lists')->result_array();
	}
	function setList($id,$list){
		$this->db->where('id_list',$id);
		$this->db->update('lists',$list);
	}
	function delList($id){
		$this->db->where('id_list',$id);
		$this->db->delete('lists');
	}
}
