<?php
namespace TOOL\core;

use \TOOL\core\ConfigTables;
use \TOOL\config\ConfigDB;

class CheckDB {
	
	public static function check () {
		
		try {
			$connect = new \PDO(ConfigDB::$host_db_name, ConfigDB::$user, ConfigDB::$pass);
			$connect->query("SET NAMES utf8 COLLATE utf8_general_ci");
			$connect->exec("CREATE TABLE IF NOT EXISTS ".ConfigTables::$table_domain." (".ConfigTables::$crete_table_domain.");");
			$connect->exec("CREATE TABLE IF NOT EXISTS ".ConfigTables::$table_data." (".ConfigTables::$crete_table_data.");");
			$connect->exec("CREATE TABLE IF NOT EXISTS ".ConfigTables::$table_analysis." (".ConfigTables::$crete_table_analysis.");");
		} catch (\PDOException $e) {
			print "Error DB: " . $e->getMessage() . "<br/>";
			return false;
		}
		$row_analysis = $connect->query("SELECT COUNT(*) FROM ".ConfigTables::$table_analysis.";");
		if ($row_analysis->fetchColumn()<3) {
			$pre = $connect->prepare("INSERT INTO ".ConfigTables::$table_analysis." (razdel, status, en, ru, fr) VALUES (:razdel, :status, :en, :ru, :fr)");
			$pre->bindParam(':razdel', $razdel);
			$pre->bindParam(':status', $status);
			$pre->bindParam(':en', $en);
			$pre->bindParam(':ru', $ru);
			$pre->bindParam(':fr', $fr);
			for ($i=0; $i<count(ConfigTables::$row_table_analysis); $i++) {
				$razdel = ConfigTables::$row_table_analysis[$i][0];
				$status = ConfigTables::$row_table_analysis[$i][1];
				$en = ConfigTables::$row_table_analysis[$i][2];
				$ru = ConfigTables::$row_table_analysis[$i][3];
				$fr = ConfigTables::$row_table_analysis[$i][4];
				$pre->execute();
			}
		}
		return true;
		
	}
	
}

?>