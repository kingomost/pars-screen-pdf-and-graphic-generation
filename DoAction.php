<?php
namespace TOOL\core;

use TOOL\config\Config;
use TOOL\core\db\AddArchivNote;

class DoAction {
	
	public static function check (array $url) {
		
		switch ($url[0]) {
			case 'add':
				if ( !is_numeric($_POST['last_time']) ) return false;
				return DoAction::add();
				break;
			case 'lang':
				if ( empty($_POST['this_page']) || empty($_POST['lang_new']) ) return false;
				return DoAction::lang();
				break;
			case 'search':
				if ( empty($_POST['domain']) || empty($_POST['lang']) ) return false;
				return DoAction::search();
				break;
			case 'analysis':
				if ( empty($_POST['domain']) || empty($_POST['lang']) ) return false;
				return DoAction::analysis();
				break;
			default:
			   return false;
		}
		
	}
	
	private static function add () {
		
		$data = AddArchivNote::return_list($_POST['last_time']);
		if (count($data)>Config::$archiv_ajax_add) {
			$next = $data[count($data)-1]['time'];
			unset ($data[count($data)-1]);
		} else {
			$next = false;
		}
		
		for ($i=0; $i<count($data); $i++) {
			$data[$i]['date'] = date('d.m.Y', $data[$i]['time']);
			if (isset($_SESSION['lang']) && in_array($_SESSION['lang'], Config::$lang)) {
				if ($_SESSION['lang'] !== Config::$default_lang) {
					$data[$i]['url'] = $data[$i]['url'].'/'.$_SESSION['lang'];
				}
			}
		}
		
		$arr = [
				'add' => $data,
				'next' => $next,
			];
		$arr = json_encode($arr);
		print_r ($arr);
		exit;
		return false;
		
	}
	
	private static function lang () {
		
		$base_url = UrlStruct::return_url_arr($_POST['this_page']);
		if (in_array($_POST['lang_new'], Config::$lang)) {
			unset($_SESSION['lang']);
			$_SESSION['lang'] = $_POST['lang_new'];
			if ($_POST['lang_new'] === Config::$default_lang) {
				header("Location: http://".\DOMAIN."/".$base_url[2], true);
			} else {
				header("Location: http://".\DOMAIN."/".$base_url[2]."/".$_POST['lang_new'], true);
			}
			exit;
		}
		return false;
		
	}
	
	private static function search () {
		
		
		return false;
		
	}
	
	private static function analysis () {
		
		$analysis = new \TOOL\core\analysis\Core($_POST['domain']);
		$result = $analysis->result();
		if (is_object($result)) \TOOL\core\db\CreateNewNote::create($result);
		if (is_object($result) && is_string($result->url)) $result = $result->url;
		if (is_string($result) && in_array($_POST['lang'], Config::$lang)) {
			if ($_POST['lang'] === Config::$default_lang) header('Location: http://'.\DOMAIN.'/'.$result);
			else header('Location: http://'.\DOMAIN.'/'.$result.'/'.$_POST['lang']);
			exit;
		} else {
			if ($_POST['lang'] === Config::$default_lang) header('Location: http://'.\DOMAIN.'/domain-not-found');
			else header('Location: http://'.\DOMAIN.'/domain-not-found/'.$_POST['lang']);
			exit;
		}
		
	}
	
}

?>