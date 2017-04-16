<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function index(){
		if ( file_exists("application/config/db.conf.php")) {
			$this->load->view('head');
			$this->load->view('menu');
			$this->load->view('welcome');
			$this->load->view('footer');
		}else{
			redirect("/Admin");
		}
		// $this->load->database();
		// $user=array('email' => 'me@localhost','alias' => 'me','pass' => password_hash("rasmuslerdorf", PASSWORD_DEFAULT) );
		// $this->db->insert('users',$user);

	}
}
