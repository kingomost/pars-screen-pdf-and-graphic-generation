<?php
namespace TOOL\core\db;

use \TOOL\config\ConfigDB;

class DataNote {
	
	public static function return_data ($url) {
		
		try {
			$connect = new \PDO(ConfigDB::$host_db_name, ConfigDB::$user, ConfigDB::$pass);
			$connect->query("SET NAMES utf8 COLLATE utf8_general_ci");
		} catch (\PDOException $e) {
			print "Error DB: " . $e->getMessage() . "<br/>";
			return false;
		}
		$url = $connect->quote($url);
		$sql = "SELECT * FROM domain WHERE url=$url;";
		$row_0 = $connect->query($sql)->fetch(\PDO::FETCH_ASSOC);
		if (!is_array($row_0)) return false;
		$id = $connect->quote($row_0['id']);
		$sql = "SELECT * FROM data WHERE id=$id;";
		$row_1 = $connect->query($sql)->fetch(\PDO::FETCH_ASSOC);
		$data = array_merge_recursive ($row_0, $row_1);
		unset ($data['parse_html']);
		unset ($data['id']);		
		return $data;
		
	}
	
}


?>