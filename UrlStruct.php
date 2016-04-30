<?php
namespace TOOL\core;

use TOOL\config\Config;

class UrlStruct {
	
	public static function return_url_arr ($url = false) {
		
		if ($url === false) $url = $_SERVER['REQUEST_URI'];
		
		$buf	= explode('/',mb_strtolower($url));
		$buf	= array_values(array_diff($buf, array('', ' ')));
		if (UrlStruct::clear_redirect($buf)) return $buf;
		
	}
	
	public static function clear_redirect ($buf) {
		
		if ( count($buf)===0 || 
			(count($buf)===1 && (preg_match('~index\..*~', $buf[0]))) ||
			(count($buf)===2 && ($buf[0] === 'index' && $buf[1] === Config::$default_lang)) ||
			(count($buf)===2 && (preg_match('~index\..*~', $buf[0]) && $buf[1] === Config::$default_lang)) ) {
			header('Location: http://'.\DOMAIN.'/index');
			exit;
		} elseif ( count($buf)===2 && (preg_match('~index\..*~', $buf[0]) && $buf[1] !== Config::$default_lang && in_array($buf[1], Config::$lang))) {
			header('Location: http://'.\DOMAIN.'/index/'.$buf[1]);
			exit;
		}
		return true;
		
	}
	
}

?>