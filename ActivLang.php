<?php
namespace TOOL\core;

use TOOL\config\Config;

class ActivLang {
	
	public static function return_lang (array $url) {
		
		$lang = [Config::$default_lang, ''];
		if (isset($url[1]) && in_array($url[1], Config::$lang)) {
			$lang = ($url[1] === Config::$default_lang) ? [Config::$default_lang, ''] : [$url[1], '/'.$url[1]] ;
		} elseif (isset($_SESSION['lang']) && in_array($_SESSION['lang'], Config::$lang)) {
			$lang = ($_SESSION['lang'] === Config::$default_lang) ? [Config::$default_lang, ''] : [$_SESSION['lang'], '/'.$_SESSION['lang']] ;
		}
		return $lang;
		
	}
	
}

?>