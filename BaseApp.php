<?php
namespace TOOL\core;

use TOOL\core\CheckDB;

class BaseApp {
	
	private $data_send = 'ERROR';
	
	public function __construct () {
		
		if (!CheckDB::check()) {
			print_r ('ERROR DB or TABLES');
			exit;
		}
		$url_struct = UrlStruct::return_url_arr();
		if (!DoAction::check($url_struct)) $this->data_send = DoPage::check($url_struct);
		
	}
	
	public function send () {
		
		if ($this->data_send === 'ERROR' || $this->data_send === false) {
			header("HTTP/1.1 404 Not Found");//HTTP/1.0 || HTTP/2
			exit;
		}
		echo $this->data_send;
		exit;
		
	}
	
}

?>