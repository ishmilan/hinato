<?php
class Cards_model extends Hinato_model {
	public function __construct(){
		parent::__construct();
	}
	function addCard($list){
		$this->db->insert('cards',$card);
	}
	function getCard($card){
		$this->db->where('id_card',$card);
		return $this->db->get('cards')->result_array();
	}
	function getCards($list){
		$this->db->where('list',$list);
		$this->db->order_by('position','ASC');
		return $this->db->get('cards')->result_array();
	}
	function setCard($id,$card){
		$this->db->where('id_card',$id);
		$this->db->update('cards',$card);
	}
	function delCard($id){
		$this->db->where('id_card',$id);
		$this->db->delete('cards');
	}
}
