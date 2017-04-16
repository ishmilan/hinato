<?php
class Cards_model extends Hinato_model {
	public function __construct(){
		parent::__construct();
	}
	function addComment($comment){
		$this->db->insert('comments',$comment);
	}
	function getComments($list){
		$this->db->where('list',$list);
		$this->db->order_by('date','DESC');
		return $this->db->get('comments')->result_array();
	}
	function setComment($id,$comment){
		$this->db->where('id_comment',$id);
		$this->db->update('comments',$comment);
	}
	function delComment($id){
		$this->db->where('id_comment',$id);
		$this->db->delete('comments');
	}
}
