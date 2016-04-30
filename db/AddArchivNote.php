<?php
namespace TOOL\core\db;

use \TOOL\config\ConfigDB;
use \TOOL\config\Config;

class AddArchivNote {
	
	public static function return_list ($time_start) {
		
		try {
			$connect = new \PDO(ConfigDB::$host_db_name, ConfigDB::$user, ConfigDB::$pass);
			$connect->query("SET NAMES utf8 COLLATE utf8_general_ci");
		} catch (\PDOException $e) {
			print "Error DB: " . $e->getMessage() . "<br/>";
			return false;
		}
		//$count = $connect->quote(Config::$archiv_note_count + 1);
		//$sql = "SELECT DISTINCT domain, url FROM domain;";
		$time = $time_start;
		$count = Config::$archiv_ajax_add + 1;
		$sql = "SELECT A.id, A.domain, A.url, A.time 
					FROM domain A 
						WHERE time=(
										SELECT MAX(B.time)
											FROM domain B
												WHERE A.domain=B.domain AND B.time <= $time 
									)
							ORDER BY time DESC LIMIT $count;";
		$row_0 = $connect->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
		$resalt_arr = [];
		for ($i=0; $i<count($row_0); $i++) {
			$id = $connect->quote($row_0[$i]['id']);
			$sql = "SELECT scrin_nout, scrin_smart
					FROM data
						WHERE id=$id LIMIT 1";
			$buf = $connect->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
			$resalt_arr[$i] = array_merge_recursive($row_0[$i], $buf[0]);
		}
		return $resalt_arr;
		
	}
	
}


?>