<?php
namespace TOOL\core\analysis;

class NameDomain {
	
	public static function return_clear_domain ($str_domain) {
		
		$resalt = false;
		$domain_word = explode("/",$str_domain);
		$domain_zone = explode("\r\n",file_get_contents(DIR.DIR_SEPARATOR.'core'.DIR_SEPARATOR.'analysis'.DIR_SEPARATOR.'domain_zone.txt'));
			for($i=0;$i<count($domain_word);$i++){
				for($j=0;$j<count($domain_zone);$j++) {
					$zone=explode("\t",$domain_zone[$j]);
					//preg_match ('~.{3,50}'.$zone[0].'$~', $domain_word[$i])
					//strpos($domain_word[$i],$zone[0])
					if(preg_match("~.{3,50}".$zone[0]."$~",$domain_word[$i])){
						$resalt = $domain_word[$i];
						if (preg_match("~\Awww\..{3,50}".$zone[0]."\$~", $resalt)) $resalt = str_replace ("www.", "", $resalt);
						break 2;
					}
				}
			}	
		return $resalt;
		
	}
	
	public static function return_protocol ($str_domain) {
		
		if (preg_match("~\Ahttp://~",$str_domain)) return "http://";
		elseif (preg_match("~\Ahttps://~",$str_domain)) return "https://";
		return false;
		
	}
	
	public static function return_is_www ($str_domain) {
		
		$domain_word=explode("/",$str_domain);
		$domain_zone=explode("\r\n",file_get_contents(DIR.DIR_SEPARATOR.'core'.DIR_SEPARATOR.'analysis'.DIR_SEPARATOR.'domain_zone.txt'));
			for($i=0;$i<count($domain_word);$i++){
				for($j=0;$j<count($domain_zone);$j++) {
					$zone=explode("	",$domain_zone[$j]);
					//preg_match ('~.{3,50}'.$zone[0].'$~', $domain_word[$i])
					//strpos($domain_word[$i],$zone[0])
					if(preg_match("~.{3,50}".$zone[0]."$~",$domain_word[$i])){
						$resalt = $domain_word[$i];
						if (preg_match("~\Awww\..{3,50}".$zone[0]."\$~", $resalt)) {
							return "www.";
						}
					}
				}
			}	
		return false;
		
	}
	
}

?>