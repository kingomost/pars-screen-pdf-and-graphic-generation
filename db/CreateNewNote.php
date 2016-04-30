<?php
namespace TOOL\core\db;

use \TOOL\config\ConfigDB;

class CreateNewNote {
	
	public static function create ($obj) {
		
		try {
			$connect = new \PDO(ConfigDB::$host_db_name, ConfigDB::$user, ConfigDB::$pass);
			$connect->query("SET NAMES utf8 COLLATE utf8_general_ci");
		} catch (\PDOException $e) {
			print "Error DB: " . $e->getMessage() . "<br/>";
			return false;
		}
		
		$new_domain_row 	= $connect->prepare("INSERT INTO domain (
																		time, 
																		domain, 
																		url
																	) 
															VALUES (
																		:time, 
																		:domain, 
																		:url
																	)");
		$new_domain_data 	= $connect->prepare("INSERT INTO data 	(
																		scrin_1366, 
																		scrin_320, 
																		scrin_nout,
																		scrin_smart,
																		parse_html,
																		title,
																		keywords,
																		description,
																		open_graph,
																		headings,
																		images,
																		text_vs_html,
																		flash,
																		frame,
																		all_link,
																		grafic_link,
																		frequency_word,
																		html_version,
																		robots_txt,
																		site_map,
																		pdf_doc
																	) 
															VALUES (
																		:scrin_1366, 
																		:scrin_320, 
																		:scrin_nout,
																		:scrin_smart,
																		:parse_html,
																		:title,
																		:keywords,
																		:description,
																		:open_graph,
																		:headings,
																		:images,
																		:text_vs_html,
																		:flash,
																		:frame,
																		:all_link,
																		:grafic_link,
																		:frequency_word,
																		:html_version,
																		:robots_txt,
																		:site_map,
																		:pdf_doc
																	)");
		
		$new_domain_row->bindParam(':time', $obj->time_create);
		$new_domain_row->bindParam(':domain', $obj->domain);
		$new_domain_row->bindParam(':url', $obj->url);
		
		$new_domain_data->bindParam(':scrin_1366', is_array($obj->scrin_1366)?serialize($obj->scrin_1366):$obj->scrin_1366 );
		$new_domain_data->bindParam(':scrin_320', is_array($obj->scrin_320)?serialize($obj->scrin_320):$obj->scrin_320);
		$new_domain_data->bindParam(':scrin_nout', is_array($obj->scrin_nout)?serialize($obj->scrin_nout):$obj->scrin_nout);
		$new_domain_data->bindParam(':scrin_smart', is_array($obj->scrin_smart)?serialize($obj->scrin_smart):$obj->scrin_smart);
		$new_domain_data->bindParam(':parse_html', is_array($obj->parse_html)?serialize($obj->parse_html):$obj->parse_html);
		$new_domain_data->bindParam(':title', is_array($obj->title)?serialize($obj->title):$obj->title);
		$new_domain_data->bindParam(':keywords', is_array($obj->keywords)?serialize($obj->keywords):$obj->keywords);
		$new_domain_data->bindParam(':description', is_array($obj->description)?serialize($obj->description):$obj->description);
		$new_domain_data->bindParam(':open_graph', is_array($obj->open_graph)?serialize($obj->open_graph):$obj->open_graph);
		$new_domain_data->bindParam(':headings', is_array($obj->headings)?serialize($obj->headings):$obj->headings);
		$new_domain_data->bindParam(':images', is_array($obj->images)?serialize($obj->images):$obj->images);
		$new_domain_data->bindParam(':text_vs_html', is_array($obj->text_vs_html)?serialize($obj->text_vs_html):$obj->text_vs_html);
		$new_domain_data->bindParam(':flash', is_array($obj->flash)?serialize($obj->flash):$obj->flash);
		$new_domain_data->bindParam(':frame', is_array($obj->frame)?serialize($obj->frame):$obj->frame);
		$new_domain_data->bindParam(':all_link', is_array($obj->all_link)?serialize($obj->all_link):$obj->all_link);
		$new_domain_data->bindParam(':grafic_link', is_array($obj->grafic_link)?serialize($obj->grafic_link):$obj->grafic_link);
		$new_domain_data->bindParam(':frequency_word', is_array($obj->frequency_word)?serialize($obj->frequency_word):$obj->frequency_word);
		$new_domain_data->bindParam(':html_version', is_array($obj->html_version)?serialize($obj->html_version):$obj->html_version);
		$new_domain_data->bindParam(':robots_txt', is_array($obj->robots_txt)?serialize($obj->robots_txt):$obj->robots_txt);
		$new_domain_data->bindParam(':site_map', is_array($obj->site_map)?serialize($obj->site_map):$obj->site_map);
		$new_domain_data->bindParam(':pdf_doc', is_array($obj->pdf_doc)?serialize($obj->pdf_doc):$obj->pdf_doc);
		
		$new_domain_row->execute();
		$new_domain_data->execute();
		
	}
	
}


?>