<?php
namespace TOOL\core\analysis;

class SetCurl {
	
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
		curl_setopt($process, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; U; FreeBSD i386; en-EN; rv:1.9.1.10) Gecko/20100625 Firefox/3.5.10');
		curl_setopt ($process , CURLOPT_REFERER , 'http://google.com/');
		curl_setopt($process, CURLOPT_CONNECTTIMEOUT, 5);
		curl_setopt($process, CURLOPT_TIMEOUT, 5);
		@curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);
		$resalt = curl_exec($process);
		curl_close($process);
		return $resalt;
		
	}
	
}

?>