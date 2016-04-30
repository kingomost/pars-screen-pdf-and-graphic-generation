<?php
namespace TOOL\core\db;

use \TOOL\core\ConfigTables;
use \TOOL\config\ConfigDB;

class TableInfo {
	
	public static function return_arr_info(array $lang) {
		/*
		$arr = [];
		$connect = new \PDO(ConfigDB::$host_db_name, ConfigDB::$user, ConfigDB::$pass);
		$sql = "SELECT razdel, status, ".$lang[0]." FROM ".ConfigTables::$table_analysis.";";
		$rows = $connect->query($sql);

		while ($row = $rows->fetch(\PDO::FETCH_ASSOC)) {
			$arr[$row['razdel']][$row['status']] = $row[$lang[0]];
		}
		return $arr;
		*/
		$resalt_arr 		= [];
		$buf_arr 			= ConfigTables::$row_table_analysis;
		$lang_correct 		= ['en'=>2, 'ru'=>3, 'fr'=>4];
		for($i=0; $i<count($buf_arr); $i++) {
			$resalt_arr [$buf_arr[$i][0]][$buf_arr[$i][1]] = $buf_arr[$i][$lang_correct[$lang[0]]];
		}
		return $resalt_arr;
		
	}
	
}


?>