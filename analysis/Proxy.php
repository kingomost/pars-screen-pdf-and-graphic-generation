<?php
namespace TOOL\core\analysis;

class Proxy {
	
	public static function return_resalt ($url, $data=null, $proxy=null, $options=null) {
		
		$process = curl_init ($url);
		if(!is_null($data)) {
			curl_setopt($process, CURLOPT_POST, 1);
			curl_setopt($process, CURLOPT_POSTFIELDS, $data);
		}
		if(!is_null($options)) {
			curl_setopt_array($process,$options);
		}
		if(!is_null($proxy)) {
			curl_setopt($process, CURLOPT_PROXY, $proxy);
		}
		if(mb_substr_count($url,'https://','utf-8')>0) {
			curl_setopt($process, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($process, CURLOPT_SSL_VERIFYHOST, false);
		}
		curl_setopt($process, CURLOPT_HEADER, 0);
		curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($process, CURLOPT_COOKIEFILE, 'cookies.txt');
		curl_setopt($process, CURLOPT_COOKIEJAR, 'cookies.txt');
		curl_setopt($process, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; U; FreeBSD i386; ru-RU; rv:1.9.1.10) Gecko/20100625 Firefox/3.5.10');
		curl_setopt ($process , CURLOPT_REFERER , 'http://google.com/');
		curl_setopt($process, CURLOPT_CONNECTTIMEOUT,4);
		curl_setopt($process, CURLOPT_TIMEOUT, 4);
		@curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);
		$resalt = curl_exec($process);
		curl_close($process);
		return $resalt;
		
	} 
	
	public static function return_list($count = 3) {
		
		$bad_proxy = [];
		$proxy_list = [];
		$list = explode ("\r\n", trim(file_get_contents(DIR.DIR_SEPARATOR.'core'.DIR_SEPARATOR.'analysis'.DIR_SEPARATOR.'proxy_list.txt')));
		$list = array_values(array_unique($list));
		$rand_keys = array_rand($list, $count*4);
		for ($i=0; $i<count($rand_keys); $i++) {
			$buf_proxy = str_replace( array( "\n", "\r", " " ), '', $list[$rand_keys[$i]]);
			$buf = Proxy::return_resalt ('https://2ip.ru', null, $buf_proxy, null);
			preg_match_all("~\<big\s*id=\"d_clip_button\"\>([^\<]{7,27})\<\/big\>~", $buf, $preg_ip);
			if (isset($preg_ip[1][0])) {
				$ip=$preg_ip[1][0];
				if ($ip === array_shift(explode(":", $buf_proxy))) $proxy_list[] = $buf_proxy;
				else $bad_proxy[] = $buf_proxy;
			} else {
				$bad_proxy[] = $buf_proxy;
			}
			if (count($proxy_list) >= $count) break;
		}
		$list = array_diff ($list, $bad_proxy);
		Proxy::file_o_w_c (DIR.DIR_SEPARATOR.'core'.DIR_SEPARATOR.'analysis'.DIR_SEPARATOR.'proxy_list.txt', implode("\r\n", $list));
		if (count($proxy_list)>0) return $proxy_list;
		return false;
		
	}
	
	public static function file_o_w_c ($f_name, $f_data, $f_mode = 'w') {
		
		$descript = fopen ($f_name, $f_mode);
		flock($descript, LOCK_EX);
		$res = fwrite ($descript, $f_data);
		flock($descript, LOCK_UN);
		fflush ($descript);
		fclose ($descript);
		return $res;
		
	}
	
}

?>