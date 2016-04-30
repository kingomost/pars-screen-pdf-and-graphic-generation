<?php
namespace TOOL\core\render;

use TOOL\config\Config;

class Box {
	
	private static $all_replace = [
									'{{{BLOCK_0}}}',
									'{{{BLOCK_1}}}',
									'{{{BLOCK_2}}}',
									'{{{BLOCK_3}}}',
									'{{{BLOCK_4}}}',
							];
	
	public static function layer (array $lang, $title = '', $keywords = '', $description = '') {
		
		ob_start();
		include ('layer.php');
		$buf = ob_get_contents();
		ob_end_clean();
		return $buf;
		
	}
	
	public static function menu (array $url, array $lang, array $arr_info, $page = false) {
		
		$all_lang = Config::$lang;
		ob_start();
		include ('menu.php');
		$buf = ob_get_contents();
		ob_end_clean();
		return $buf;
		
	}
	
	public static function form_analysis (array $lang) {
		
		ob_start();
		include ('form_analysis.php');
		$buf = ob_get_contents();
		ob_end_clean();
		return $buf;
		
	}
	
	public static function hello_about (array $arr_info) {
		
		ob_start();
		include ('hello_about.php');
		$buf = ob_get_contents();
		ob_end_clean();
		return $buf;
		
	}
	
	public static function temporarily ($arr_info, $arr_data) {
		
		ob_start();
		include ('temporarily.php');
		$buf = ob_get_contents();
		ob_end_clean();
		return $buf;
		
	}
	
	public static function b_1 ($arr_info, $arr_data) {
		
		ob_start();
		include ('b_1.php');
		$buf = ob_get_contents();
		ob_end_clean();
		return $buf;
		
	}
	
	public static function b_2 ($arr_info, $arr_data) {
		
		ob_start();
		include ('b_2.php');
		$buf = ob_get_contents();
		ob_end_clean();
		return $buf;
		
	}
	
	public static function b_3 ($arr_info, $arr_data) {
		
		ob_start();
		include ('b_3.php');
		$buf = ob_get_contents();
		ob_end_clean();
		return $buf;
		
	}
	
	public static function a_1 ($arr_info, $arr_data, $lang) {
		
		ob_start();
		include ('a_1.php');
		$buf = ob_get_contents();
		ob_end_clean();
		return $buf;
		
	}
	
	public static function error ($url, $arr_info, $lang) {
		
		ob_start();
		include ('error.php');
		$buf = ob_get_contents();
		ob_end_clean();
		return $buf;
		
	}
	
	public static function pdf_note($lang, $arr_data, $arr_info) {
		
		ob_start();
		include ('pdf_note.php');
		$buf = ob_get_contents();
		ob_end_clean();
		return $buf;
		
	}
	
}

?>