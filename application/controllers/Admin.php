<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function index(){
		if (!file_exists("application/config/db.conf.php")){
			$this->load->view('installer');
		}else{
			redirect('/');
		}
	}
	public function installer(){
		$db=mysqli_connect($_REQUEST['hostname'],$_REQUEST['username'],$_REQUEST['password']);
		if ($_REQUEST['installDB']=="yes"){
			$sql="CREATE SCHEMA IF NOT EXISTS `".$_REQUEST['database']."`;";
			mysqli_query($db,$sql);
		}
 		$text='<?php
$db[\'default\'][\'hostname\']=\''.$_REQUEST['hostname'].'\';
$db[\'default\'][\'username\']=\''.$_REQUEST['username'].'\';
$db[\'default\'][\'password\']=\''.$_REQUEST['password'].'\';
$db[\'default\'][\'database\']=\''.$_REQUEST['database'].'\';
$db[\'default\'][\'dbprefix\']=\''.$_REQUEST['dbprefix'].'\';';
		$file = fopen("application/config/db.conf.php", "w");
		fwrite($file,$text);
		fclose($file);
		$file = fopen("application/config/sys.env.php", "w");
		fwrite($file,'<?php'."\n".'$_SERVER[\'CI_ENV\']=\''.$_REQUEST['environment'].'\';');
		if ($_REQUEST['installDB']=="yes"){
			$this->load->database();
			include 'application/models/hinato.db.php';
		}
		redirect('/');
	}
}
