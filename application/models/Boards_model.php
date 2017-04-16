<?php
class Boards_model extends Hinato_model {
	public function __construct(){
		parent::__construct();
	}
	function addBoard($board,$user){
		$this->db->insert('boards',$board);
	}
	function getBoards($user){
		$query="SELECT name, img_path FROM boards b INNER JOIN members m ON b.id_board=m.board WHERE user='$user';";
		return $this->db->query($query)->result_array();
	}
	function getBoard($board){
		$this->db->where('id_board',$board);
		return $this->db->query($query)->result_array();
	}
	function setBoard($id,$board){
		$this->db->where('id_board',$id);
		$this->db->update('boards',$board);
	}
	function delBoard($id){
		$this->db->where('id_board', $id);
		$this->db->delete('board');
	}
}
