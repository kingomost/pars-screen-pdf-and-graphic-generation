<?php
namespace TOOL\core\analysis;

class ParseHtml {
	
	public static function return_html ($url) {
		
		$result = SetCurl::return_resalt ($url);
		/*
		if (!$result || !mb_strlen($result, 'utf-8')>100) {
			$proxy_list = Proxy::return_list(2);
			if (is_array($proxy_list)) {
				for ($i=0; $i<count($proxy_list); $i++) {
					$result = SetCurl::return_resalt ($url, null, $proxy_list[$i], null);
					if ($result && mb_strlen($result, 'utf-8')>100) break;
				}
			}
		}
		*/
		if ($result || mb_strlen($result, 'utf-8')>100) return $result;
		return false;
		
	}
	
	public static function title ($data) {
		
		preg_match_all("~(\<title\>)(.*)(\<\/title\>)~isU" , $data, $buf);
		if (isset($buf[2][0]) && is_string($buf[2][0])) return $buf[2][0];
		else return false;
		
	}
	
	public static function keywords ($data) {
		
		preg_match_all("~\<meta.{1,100}keywords.{5,10}=(\"|')([^\>]{0,1000})\\1.{0,100}\>~isU" , $data, $buf);
		if (isset($buf[2][0]) && is_string($buf[2][0]))  return $buf[2][0];
		else return false;
		
	}
	
	public static function description ($data) {
		
		preg_match_all("~\<meta.{1,100}description.{5,10}=(\"|')([^\>]{0,1000})\\1.{0,100}\>~isU" , $data, $buf);
		if (isset($buf[2][0]) && is_string($buf[2][0]))  return $buf[2][0];
		else return false;
		
	}
	
	public static function open_graph ($data) {
		
		preg_match_all("~\<\s{0,5}meta\s{1,5}property\s{0,5}=\s{0,5}(\"|')\s{0,5}og:([^\"']{1,20})\\1\s{1,5}content\s{0,5}=\s{0,5}(\"|')\s{0,5}([^\>]{1,400})\\3.{0,5}\>~isU" , $data, $buf);
		if (isset($buf[2]) && count($buf[2])>0 && isset($buf[4]) && count($buf[4])>0) {
			$arr_resalf = array();
			for ($i=0; $i<count($buf[2]) && $i<count($buf[4]); $i++) {
				if (is_string($buf[2][$i]) && is_string($buf[4][$i])) {
					$arr_resalf[$buf[2][$i]] = $buf[4][$i];
				}
			}
			if (count($arr_resalf)>0) return $arr_resalf;
		}
		return false;
		
	}
	
	public static function headings ($data) {
		
		preg_match_all("~\<h([1-6]{1})[^\>]{0,160}>(.*)(?=\<\/h\\1>)~isU", $data, $buf);
		if (isset($buf[1]) && count($buf[1])>0 && isset($buf[2]) && count($buf[2])>0) {
			$arr_resalf = array();
			for ($i=0; $i<count($buf[1]) && $i<count($buf[2]); $i++) {
				if (is_numeric($buf[1][$i]) && is_string($buf[2][$i])) {
					$arr_resalf[strip_tags($buf[2][$i])] = 'h'.$buf[1][$i];
				}
			}
			if (count($arr_resalf)>0) {
				asort($arr_resalf);
				return $arr_resalf;
			} 
		}
		return false;
		
	}
	
	public static function images ($data, $url) {
		
		preg_match_all("~\<img\s{1,7}[^\>]{0,700}\>~isU", $data, $buf);
		if (count($buf[0])>0) {
			$new_buf_resalt = array();
			for ($i=0; $i<count($buf[0]);  $i++) {
				preg_match_all("~\ssrc\s{0,3}=\s{0,3}(\"|')([^\"']{3,})\\1~isU" ,$buf[0][$i], $buf_src);
				preg_match_all("~\salt\s{0,3}=\s{0,3}(\"|')([^\"']{3,})\\1~isU" ,$buf[0][$i], $buf_alt);
				$src = isset($buf_src[2][0]) ? $buf_src[2][0] : '' ;
				$alt = isset($buf_alt[2][0]) ? $buf_alt[2][0] : '' ;
				if ($src !== '') {
					$new_buf_resalt[] = array ('src'=>array($src, ParseHtml::even_link(trim($src), $url)), 'alt'=>$alt);
				}
			}
			return $new_buf_resalt;	
		}
		return false;
		
	}
	
	public static function text_vs_html ($data) {
		
		$all_simbol = mb_strlen($data, 'utf-8');
		$text_simbol = mb_strlen(strip_tags($data), 'utf-8');
		$html_simbol = $all_simbol - $text_simbol;
		$persent_txt = round($text_simbol*100/$all_simbol);
		$buf = array ('all_simbol'=>$all_simbol, 'clear_text'=>$text_simbol, 'persent_txt'=>$persent_txt, );
		return $buf;
		
	}
	
	public static function flash ($data, $request) {
		
		preg_match_all("~\<[^\>]*(type)[^\>]{0,5}=[^\>]{0,5}(application)[^\>]{1,20}(flash)[^\>]*\>~isU" ,$data, $buf);
		if (count($buf[0])>0) {
			$new_buf_resalt = array();
			for ($i=0; $i<count($buf[0]);  $i++) {
				preg_match_all("~type\s*(| |=)\s*(| |'|\")\s*([^ \"']{3,})\s*( |'|\")~isU" ,$buf[0][$i], $buf_type);
				preg_match_all("~(data|src)\s*(| |=)\s*(| |'|\")\s*([^ \"']{3,})\s*( |'|\")~isU" ,$buf[0][$i], $buf_data);
				$type = isset($buf_type[3][0]) ? str_replace(array('=', '', ), '', $buf_type[3][0]) : '' ;
				$src = isset($buf_data[4][0]) ? str_replace(array('=', '', ), '', $buf_data[4][0]) : '' ;
				if ($src !== '' && $type !== '') {
					$new_buf_resalt[] = array ($type, $src, ParseHtml::even_link(trim($src),$request));
				}
			}
			if(count($new_buf_resalt)>0) return $new_buf_resalt;
		}
		return false;
		
	}
	
	public static function frame ($data, $request) {
		
		preg_match_all("~\<frame\s[^\>]{0,1000}src[^\>]{0,1000}\>~is" ,$data, $frame);
		preg_match_all("~\<iframe\s[^\>]{0,1000}src[^\>]{0,1000}\>.*\<\/iframe\>~is" ,$data, $iframe);
		//preg_match_all("~\<frameset\s{0,}[^\>]{0,}\>.*(?=\<\/frameset\>)~is" ,$data, $frameset);
		$new_buf_resalt = array();
		if (count($frame[0])>0) {
			for ($i=0; $i<count($frame[0]);  $i++) {
				preg_match_all("~\s*(src)\s*(| |=)\s*(| |'|\")\s*([^ \"']{3,})\s*( |'|\")~isU" ,$frame[0][$i], $buf_src);
				$src = isset($buf_src[4][0]) ? str_replace(array('=', '', ), '', $buf_src[4][0]) : '' ;
				if ($src !== '') {
					$new_buf_resalt[] = array ('frame', $src, ParseHtml::even_link(trim($src),$request));
				}
			}
		}
		if (count($iframe[0])>0) {
			for ($i=0; $i<count($iframe[0]);  $i++) {
				if (isset($frame[0][$i]) && is_string($frame[0][$i])) {
					preg_match_all("~\s*(src)\s*(| |=)\s*(| |'|\")\s*([^ \"']{3,})\s*( |'|\")~isU" ,$frame[0][$i], $buf_src);
					$src = isset($buf_src[4][0]) ? str_replace(array('=', '', ), '', $buf_src[4][0]) : '' ;
					if ($src !== '') {
						$new_buf_resalt[] = array ('iframe', $src, ParseHtml::even_link(trim($src),$request));
					}
				}
				
			}
		}
		if(count($new_buf_resalt)>0) return $new_buf_resalt;
		return false;
		
	}
	
	public static function all_link ($data, $request) {
		
		preg_match_all("~\<a\s[^\>]{1,}\>.*\<\/a\>~isU", $data, $buf);
		if (count($buf[0])>0) {
			$buf_arr = array();
			for ($i=0; $i<count($buf[0]); $i++) {
				preg_match_all("~[^\>]*(\>)(.*)(\<\/a)~isU", $buf[0][$i], $buf_text);
				preg_match_all("~\shref\s{0,3}=\s{0,3}(\"|')([^\"']{1,})\\1~isU", $buf[0][$i], $buf_href);
				preg_match_all("~\sname\s{0,3}=\s{0,3}(\"|')([^\"']{1,})\\1~isU", $buf[0][$i], $buf_name);
				preg_match_all("~\stitle\s{0,3}=\s{0,3}(\"|')([^\"']{1,})\1~isU", $buf[0][$i], $buf_title);
				preg_match_all("~(\<a)[^\>]*rel\s*=\s*(|\"|')\s*nofollow[^\>]*>~isU", $buf[0][$i], $buf_nofollow);
				preg_match_all("~(\<a)[^\>]*download[^\>]*>~isU", $buf[0][$i], $buf_download);
				$buf_text = isset($buf_text[2][0]) ? $buf_text[2][0] : false ;
				$buf_href = isset($buf_href[2][0]) ? $buf_href[2][0] : false ;
				if ($buf_href!==false && substr_count($buf_href, '%')>0) {
					$buf_href = urldecode($buf_href);
				}
				$buf_name = isset($buf_name[2][0]) ? $buf_name[2][0] : false ;
				$buf_title = isset($buf_title[2][0]) ? $buf_title[2][0] : false ;
				$buf_nofollow = isset($buf_nofollow[0][0]) ? true : false ;
				$buf_download = isset($buf_download[0][0]) ? true : false ;
				if (($buf_href && preg_match ("~^#[а-яА-ЯёЁa-zA-Z0-9\.\-_]+$~isU", $buf_href)) ||
						($buf_name && preg_match ("~^[a-zA-Z0-9\-_]+$~isU", $buf_name))) {
					$buf_even_link = '#';
				} else {
					$buf_even_link = $buf_href ? ParseHtml::even_link ($buf_href, $request) : false ;
				}
				$buf_arr[] = array ('text'=>$buf_text,'href'=>$buf_href, 'even_link'=>$buf_even_link, 'title'=>$buf_title,'nofollow'=>$buf_nofollow,'download'=>$buf_download);
			}
			if (count($buf_arr)>0) {
				$vnytr = array ();
				$vnesh = array ();
				for ($i=0; $i<count($buf_arr); $i++) {
					$buf_solanka_arr = array();
					if (preg_match ("~\<img[^\>]{1,}\>~isU", $buf_arr[$i]['text'])) {
						preg_match_all("~\salt\s{0,3}=\s{0,3}(\"|')([^\"']{3,})\\1~isU" ,$buf_arr[$i]['text'], $buf_alt);
						$alt = isset($buf_alt[2][0]) ? $buf_alt[2][0] : '' ;
						$buf_arr[$i]['text'] = 'img ... '.$alt.' ... '.strip_tags($buf_arr[$i]['text']);
					} else {
						$buf_arr[$i]['text'] = strip_tags($buf_arr[$i]['text']);
					}
					if ($buf_arr[$i]['href']!==false && $buf_arr[$i]['even_link']!==false && ParseHtml::vnytrenn_link ($buf_arr[$i]['even_link'], $request)===true) {
						$vnytr[] = $buf_arr[$i];
					} elseif ($buf_arr[$i]['href']!==false && $buf_arr[$i]['even_link']!==false && ParseHtml::vnytrenn_link ($buf_arr[$i]['even_link'], $request)===false) {
						$vnesh[] = $buf_arr[$i];
					}
				}
			} 
			if (count($vnytr)>0 || count($vnesh)>0) {
				return array ('vnytr'=>$vnytr, 'vnesh'=>$vnesh,);
			}
		}
		return false;
		
	}
	
	public static function frequency_word ($data, $request) {
		
		//PART VISIBLE WORD
		$visible_words = '';
		$arr_visible_words = array ();
		$arr_spets_simbol = array 	( 
										"&nbsp;" => " ", "    " => " ", "   " => " ", "  " => " ", "\r\n " => " ", " \r\n" => " ", "\r\n\r\n" => " ",
										"\r" => " ", "\n" => " ", "\t" => " ", "\v" => " ", "\f" => " ",  "\v" => " ", "\a" => " ", "\e" => " ",  "  " => " ", 
										"Ё" => "Е", "ё" => "е", "«" => '"', "»" => '"',
										);	
		$arr_bad_tag = array 	(
										"~<script.+?<\/script>~ismU"=>" ",
										"~<noscript.+?<\/noscript>~ismU"=>" ",
										"~<iframe.+?<\/iframe>~ismU"=>" ",
										"~\<\!--[^\>]*--\>~ismU"=>" ",
										"~<style.+?<\/style>~ismU"=>" ",
										"~style( |)=(| )('|\")[^'\"]*+('|\")~ismU"=>" ",
										"~<form.+?<\/form>~ismU"=>" ",
										"~<textarea.+?<\/textarea>~ismU"=>" ",
										"~<option.+?<\/option>~ismU"=>" ",
										'~(onMouse[a-z]{2,15}|onClick)([ ]*|)=([ ]*|)"(.*?)"~ismU'=>" ",
										'~(onMouse[a-z]{2,15}|onClick)([ ]*|)=([ ]*|)\'(.*?)\'~ismU'=>" ",
										"~<(\/|)(font|em|span|noindex|nobr|dfn|ins)+>~ismU"=>" ",
										"~<(\/|)(font |em |span |noindex |nobr |dfn |ins)[^>]+>~ismU"=>" ",
										"~<(\/|)(font|em|span|noindex|nobr|dfn|ins)[^>]+>~ismU"=>" ",
										"~(<br>|<br\/>|<br[ ]{0,10}\/>)~ismU"=>" ",
										"~[^\s]{3,150}\.[a-zA-Z]{2,4}(\/[^\s] | )~ismU"=>" ",
										"~ЂЂЂ~ismU"=>" ",									
										);	
		$remove_from_separator = array 	(
										"~<div[^\>]*\>~ismU"=>' ',
										"~<table [^\>]*\>~ismU"=>' ',
										"~<p[^\>]*\>~ismU"=>' ',
										"~<h1([^\>]*)\>~ismU"=>' ',
										"~<h2([^\>]*)\>~ismU"=>' ',
										"~<h3([^\>]*)\>~ismU"=>' ',
										"~<h4([^\>]*)\>~ismU"=>' ',
										"~<h5([^\>]*)\>~ismU"=>' ',
										"~<h6([^\>]*)\>~ismU"=>' ',
										"~<ul([^\>]*)\>~ismU"=>' ',
										"~<li([^\>]*)\>~ismU"=>' ',
										"~<th([^\>]*)\>~ismU"=>' ',
										"~<td([^\>]*)\>~ismU"=>' ',
										"~<tr([^\>]*)\>~ismU"=>' ',
										"~<\/div>~ismU"=>' ',
										"~<\/table>~ismU"=>' ',
										"~<\/p>~ismU"=>' ',
										"~<\/h1>~ismU"=>' ',
										"~<\/h2>~ismU"=>' ',
										"~<\/h3>~ismU"=>' ',
										"~<\/h4>~ismU"=>' ',
										"~<\/h5>~ismU"=>' ',
										"~<\/h6>~ismU"=>' ',
										"~<\/ul>~ismU"=>' ',
										"~<\/li>~ismU"=>' ',
										"~<\/th>~ismU"=>' ',
										"~<\/td>~ismU"=>' ',
										"~<\/tr>~ismU"=>' ',
										"~\<a\s[^\>]{1,}\>~ismU"=>' ',
										"~\<\/a\>~ismU"=>' ',
										"~\<img\s{1,7}[^\>]{1,}\>~ismU"=>' ',
										"~ \s+~ismU"=>' ',
										);
		//$html = preg_replace ("~^.*\<body[^\<\>]{0,}>~ismU", "", html_entity_decode($data));
		$html = preg_replace ("~^.*\<body[^\<\>]{0,}>~ismU", "", $data);
		$html = preg_replace ("~<[^\/]{0,4}\/body[^\<\>]{0,4}.*$~ismU", "", $html);
		foreach ($arr_spets_simbol as $pattern => $replace) {
			$html = str_replace ($pattern, $replace, $html);
		}
		foreach ($arr_bad_tag as $pattern => $replace) {
			$html = preg_replace ($pattern, $replace, $html);
		}
		foreach ($remove_from_separator as $pattern => $replace) {
			$html = preg_replace ($pattern, $replace, $html);
		}
		$html = htmlentities(strip_tags($html));
		//$html = preg_replace ("~&*#(\w|\d)+;~", ' ', $html);
		$html = preg_replace ("~&#\d{3,5};~", ' ', $html);
		$html = preg_replace ("~#\d{3,5};~", ' ', $html);
		$html = preg_replace ("~&\w{2,8}(\d|){0,1};~", ' ', $html);
		//$html = preg_replace ("~[^а-яА-ЯёЁa-zA-Z0-9]+~", ' ', $html);
		$visible_words = preg_replace ("~ \s+~", ' ', $html);
		$visible_words_no_registr = strtolower($visible_words);
		$arr_visible_words = explode(' ', $visible_words);
		$arr_visible_words = array_diff($arr_visible_words, array('', ' ', '  ', ));
		$arr_visible_words = array_unique($arr_visible_words);
		$arr_visible_words = array_values($arr_visible_words);
		$arr_visible_words_no_registr = array_map (function($a){return strtolower ($a);} ,$arr_visible_words);
		//return $visible_words;
		//return $visible_words_no_registr;
		//return $arr_visible_words;
		//return $arr_visible_words_no_registr;
		
		//PART NO VISIBLE WORD
		$meta_and_other = '';
		if (ParseHtml::title($data)!==false) {
			$meta_and_other .= ParseHtml::title($data).' ';
		}
		if (ParseHtml::description($data)!==false) {
			$meta_and_other .= ParseHtml::description($data).' ';
		}
		if (ParseHtml::keywords($data)!==false) {
			$meta_and_other .= ParseHtml::keywords($data).' ';
		}
		preg_match_all("~\stitle\s{0,3}=\s{0,3}(\"|')([^\"']{1,1000})\\1~ismU" ,$data, $all_title);
		$all_title = $all_title[2];
		preg_match_all("~\salt\s{0,3}=\s{0,3}(\"|')([^\"']{1,1000})\\1~ismU" ,$data, $all_alt);
		$all_alt = $all_alt[2];
		$meta_and_other .= implode(' ', $all_title).' ';
		$meta_and_other .= implode(' ', $all_alt).' ';
		$meta_and_other = htmlentities(strip_tags($meta_and_other));
		$meta_and_other = preg_replace ("~&#\d{3,5};~", ' ', $meta_and_other);
		$meta_and_other = preg_replace ("~#\d{3,5};~", ' ', $meta_and_other);
		$meta_and_other = preg_replace ("~&\w{2,8}(\d|){0,1};~", ' ', $meta_and_other);
		$meta_and_other = preg_replace ("~ \s+~", ' ', $meta_and_other);
		$meta_and_other_no_registr = strtolower($meta_and_other);
		$arr_meta_and_other = explode(' ', $meta_and_other);
		$arr_meta_and_other = array_diff($arr_meta_and_other, array('', ' ', '  ', ));
		$arr_meta_and_other = array_unique($arr_meta_and_other);
		$arr_meta_and_other = array_values($arr_meta_and_other);
		$arr_meta_and_other_no_registr = array_map (function($a){return strtolower ($a);} ,$arr_meta_and_other);
		$znaki_prepinania = array('!', '?', ';', '\'', '"', '|', '\\', '/', '>', '<', '(', ')',);
		$resalt = array_merge ($arr_visible_words_no_registr, $arr_meta_and_other_no_registr);
		$resalt = array_map (function($a) use ($znaki_prepinania) {$b=str_replace($znaki_prepinania, ' ', $a); $b = preg_replace ("~ \s+~", ' ', $b); return trim($b);}, $resalt);
		$resalt = array_map (function($a) use ($znaki_prepinania) {$b = preg_replace ("~^(\.|,)+~", '', $a); $b = preg_replace ("~(\.|,)+$~", ' ', $b); return trim($b);}, $resalt);
		$text_array_lower = $resalt;
		//array four
		$array_four = array ();
		for ($i=0; $i<count($text_array_lower); $i++) {
			if (isset($text_array_lower[$i+1]) && isset($text_array_lower[$i+2]) && isset($text_array_lower[$i+3])) {
				$array_four[] = $text_array_lower[$i].' '.$text_array_lower[$i+1].' '.$text_array_lower[$i+2].' '.$text_array_lower[$i+3];
			}
		}
		//array three
		$array_three = array ();
		for ($i=0; $i<count($text_array_lower); $i++) {
			if (isset($text_array_lower[$i+1]) && isset($text_array_lower[$i+2])) {
				$array_three[] = $text_array_lower[$i].' '.$text_array_lower[$i+1].' '.$text_array_lower[$i+2];
			}
		}
		//array two
		$array_two = array ();
		for ($i=0; $i<count($text_array_lower); $i++) {
			if (isset($text_array_lower[$i+1])) {
				$array_two[] = $text_array_lower[$i].' '.$text_array_lower[$i+1];
			}
		}
		$fr_array_four = array_count_values($array_four);
		array_multisort($fr_array_four);
		$fr_array_four = array_reverse ($fr_array_four, true);
		foreach ($fr_array_four as $key=>$value) {
			if ($value<2 || mb_strlen($key, 'utf-8')<23) unset ($fr_array_four[$key]);
		} 
		$fr_array_three = array_count_values($array_three);
		array_multisort($fr_array_three);
		$fr_array_three = array_reverse ($fr_array_three, true);
		foreach ($fr_array_three as $key=>$value) {
			if ($value<2 || mb_strlen($key, 'utf-8')<17) unset ($fr_array_three[$key]);
		} 
		$fr_array_two = array_count_values($array_two);
		array_multisort($fr_array_two);
		$fr_array_two = array_reverse ($fr_array_two, true);
		foreach ($fr_array_two as $key=>$value) {
			if ($value<2 || mb_strlen($key, 'utf-8')<12) unset ($fr_array_two[$key]);
		} 
		$fr_array_one = array_count_values($text_array_lower);
		array_multisort($fr_array_one);
		$fr_array_one = array_reverse ($fr_array_one, true);
		foreach ($fr_array_one as $key=>$value) {
			if ($value<3 || mb_strlen($key, 'utf-8')<5) unset ($fr_array_one[$key]);
		} 
		/*
		
		*/
		$resalt = array_merge ($fr_array_four, $fr_array_three, $fr_array_two, $fr_array_one);
		$new_resalt = array ();
		foreach ($resalt as $text=>$freq) {
			$count_visible = substr_count ($visible_words_no_registr, $text);
			$count_no_visible = substr_count ($meta_and_other_no_registr, $text);
			$stop_pattern = '~((^|\s)(and|the|or)($|\s))|((^(of|on|in|for)\s)|(\s(of|on|in|for)$))~';
			if (($count_visible>0 && $count_no_visible>0 && !preg_match($stop_pattern, $text)) || ($count_visible>3 && !preg_match($stop_pattern, $text))) {
				$new_resalt[] = array ('words'=>$text, 'visible'=>$count_visible, 'no_visible'=>$count_no_visible);
			}
		} 
		$diff_arr = array ();
		if (count($new_resalt)>0) {
			for ($i=0; $i<count($new_resalt); $i++) {
				if (substr_count($new_resalt[$i]['words'],' ')<3) break;
				for ($j=0; $j<count($new_resalt); $j++) {
					if (substr_count($new_resalt[$j]['words'],' ')<3) {
						if (substr_count($new_resalt[$i]['words'],$new_resalt[$j]['words'])>0) $diff_arr[] = $j;
					}
				}
			}
			if (count($diff_arr)>0) {
				for ($i=0; $i<count($diff_arr); $i++) {
					if (isset($new_resalt[$diff_arr[$i]])) unset ($new_resalt[$diff_arr[$i]]);
				}
			}
			if (is_array($new_resalt) && count($new_resalt)>0) {
				$new_resalt = array_values($new_resalt);
				$buf_func = function ($a, $b) {
					if (isset($a['visible']) && isset($a['no_visible']) && isset($b['visible']) && isset($b['no_visible'])) {
						if (is_numeric($a['visible']) && is_numeric($a['no_visible']) && is_numeric($b['visible']) && is_numeric($b['no_visible'])) {
							if (($a['visible']+$a['no_visible'])>($b['visible']+$b['no_visible'])) return -1;
							if (($a['visible']+$a['no_visible'])<($b['visible']+$b['no_visible'])) return 1;
						}
					}
					return 0;
				};
				uasort($new_resalt, $buf_func);
				$new_resalt = array_values($new_resalt);
				return $new_resalt;
			}
			
		}
		return false;
		
	}
	
	
	
	
	public static function even_link ($src, $url) {
		
		//$url - адрес самой страницы, с которой собраны линки
		//$src - собранная ссылка в ее оригинальном виде
		$absolut_link = false;
		if ((stripos($src, 'http://')===false) && (stripos($src, 'https://')===false) && !(stripos($src, '//')===0)) {
			//путь относительный, надо обрабатывать
			//1 - если начинается с буквы или цифры
			if (preg_match("~\A[а-яА-ЯёЁa-zA-Z0-9]{1}.*~", $src)===1) {//начинается от текущего местоположения
				if (count(explode('/',$url))===3) {
					$absolut_link = $url.'/'.$src;
				} elseif (count(explode('/',$url))>3) {
					$arr_req = explode('/',$url);
					array_pop($arr_req);
					$absolut_link = implode('/', $arr_req).'/'.$src;
				}
			} elseif (preg_match("~\A\/{1}.*~", $src)===1) {//начинается с / - те с корня сайта
				$arr_req = explode('/',$url);
				$absolut_link = $arr_req[0].'/'.$arr_req[1].'/'.$arr_req[2].$src;
			} elseif (preg_match("~\A(\.\.\/).*~", $src)===1) {//начинается с ../ - те с подъемами вверх
				$uroven = substr_count($src, '../');
				$arr_req = explode('/',$url);
				if (count($arr_req)===3) {
					$absolut_link = $url.'/'.str_replace('../', '', $src);
				} else {
					for ($i=0; $i<count($uroven); $i++) {
						array_pop($arr_req);
					}
					$absolut_link = implode('/', $arr_req).'/'.str_replace('../', '', $src);
				}
			}
		} else {
			if (stripos($src, '//')===0) $absolut_link = str_replace('//', $url.'/', $src);
			else $absolut_link = $src;
		}
		return $absolut_link;
		
	}
	
	public static function vnytrenn_link ($even_link, $request) {
	
		if ($even_link==='#') return true;
		$arr_even_link = explode ('/', $even_link);
		$arr_request = explode ('/', $request);
		if (substr_count($arr_even_link[2], '.')===2) {
			$buf = explode ('.', $arr_even_link[2]);
			$domain_even_link = $buf[1].'.'.$buf[2];
		} else {
			$domain_even_link = $arr_even_link[2];
		}
		if (substr_count($arr_request[2], '.')===2) {
			$buf = explode ('.', $arr_request[2]);
			$domain_request = $buf[1].'.'.$buf[2];
		} else {
			$domain_request = $arr_request[2];
		}
		if ($domain_even_link === $domain_request) return true;
		return false;
		
	}
	
	public static function html_version ($data) {
		
		if (preg_match('~\<\s*!\s*DOCTYPE\s+html\s*\>~isU', $data)) return 'HTML 5';
		if (preg_match('~\<\s*!\s*DOCTYPE\s+[^\>]{2,}(HTML\s+4.01)[^\>]{2,}\>~isU', $data)) return 'HTML 4.01';
		if (preg_match('~\<\s*!\s*DOCTYPE\s+[^\>]{2,}(XHTML\s+1.0)[^\>]{2,}\>~isU', $data)) return 'XHTML 1.0';
		if (preg_match('~\<\s*!\s*DOCTYPE\s+[^\>]{2,}(XHTML\s+1.1)[^\>]{2,}\>~isU', $data)) return 'XHTML 1.1';
		return false;
		
	}
	
	public static function robots_txt ($url) {
		
		$result = SetCurl::return_resalt ($url.'/robots.txt');
		if ($result || mb_strlen($result, 'utf-8')>10) return $result;
		return false;
		
	}
	
	public static function site_map ($url, $robots) {
		
		$resalt_arr = [];
		$result = SetCurl::return_resalt ($url.'/sitemap.xml');
		if ($result || mb_strlen($result, 'utf-8')>100) $resalt_arr[$url.'/sitemap.xml'] = ParseHtml::site_map_part($result);
		//проверка, не на субдомене ли мы
		
		//проверка, может в robots указано
		
		if (count($resalt_arr)>0) return $resalt_arr;
		return false;
		
	}
	
	private static function site_map_part ($sitemap_content) {
		
		preg_match_all('~\<loc\>([^\<]+)\<\/loc\>~', $sitemap_content, $arr_map);
		for ($j=0;$j<count($arr_map[1]);$j++) {
			$add_map[]=trim($arr_map[1][$j]);
		}
		$add_map=array_diff($add_map,array(''));
		$add_map = array_values(array_unique($add_map));
		return $add_map;
		
	}
	
}

?>