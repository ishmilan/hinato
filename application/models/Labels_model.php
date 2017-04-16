<?php
class Cards_model extends Hinato_model {
	public function __construct(){
		parent::__construct();
	}
	function addLabel($label){
		$this->db->insert('labels',$label);
	}
	function getLabels($board){
		$this->db->where('board',$board);
		return $this->db->get('labels')->result_array();
	}
	function setLabel($id,$label){
		$this->db->where('id_label',$id);
		$this->db->update('labels',$label);
	}
	function delLabel($id){
		$this->db->where('id_label',$id);
		$this->db->delete('labels');
	}
	function addCardLabel($card,$label){
		$data['card']=$card;
		$data['label']=$label;
		$this->db->insert('card_labels',$data);
	}
	function getCardLabels($card){
		$query="SELECT name,color_foreground,color_background FROM labels l INNER JOIN card_labels cl ON l.id_label=cl.label WHERE cl.card='".$card."';"
		return $this->db->query($query)->result_array();
	}
	function delCardLabel($id){
		$this->db->where('card',$id);
		$this->db->delete('card_labels');
	}
}
