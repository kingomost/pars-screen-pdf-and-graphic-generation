<?php
namespace TOOL\core\render;

class View {
	
	public static function renderIndex (array $url, array $lang, array $arr) {
		
		$arr_info 			= $arr['arr_info'];
		$title 				= 'SEO TOOL';
		$keywords 			= '';
		$description 		= '';
		$layer 				= Box::layer($lang, $title, $keywords, $description);
		$menu 				= Box::menu($url, $lang, $arr_info, 'index');
		$form				= Box::form_analysis($lang);
		$about				= Box::hello_about($arr_info);
		$result				= preg_replace('~{{{BLOCK_0}}}~', $menu, $layer);
		$result				= preg_replace('~{{{BLOCK_1}}}~', $form, $result);
		$result				= preg_replace('~{{{BLOCK_2}}}~', $about, $result);
		$result				= preg_replace('~{{{[^}]*}}}~', '', $result);
		return $result;
		
	}
	
	public static function renderPage (array $url, array $lang, array $arr) {
		
		$arr_info 			= $arr['arr_info'];
		$arr_data			= $arr['data_note'];
		$title 				= 'SEO site analysis: '.$arr_data['domain'];
		$keywords 			= $arr_data['domain'].', SEO, site analysis';
		$description 		= 'SEO Site Analysis '.$arr_data['domain'].' made on '.date('l jS \of F Y h:i:s A', $arr_data['time']);
		$layer 				= Box::layer($lang, $title, $keywords, $description);
		$menu 				= Box::menu($url, $lang, $arr_info, $arr_data['url']);
		$result				= preg_replace('~{{{BLOCK_0}}}~', $menu, $layer);
		$result				= preg_replace('~{{{BLOCK_1}}}~', Box::b_1($arr_info, $arr_data), $result);
		$result				= preg_replace('~{{{BLOCK_2}}}~', Box::b_2($arr_info, $arr_data), $result);
		$result				= preg_replace('~{{{BLOCK_3}}}~', Box::b_3($arr_info, $arr_data), $result);
		$result				= preg_replace('~{{{[^}]*}}}~', '', $result);
		return $result;
		
	}
	
	public static function renderPdf ($lang, $arr_data) {
		
		$arr_info 	= \TOOL\core\db\TableInfo::return_arr_info([$lang, $lang]);
		return Box::pdf_note($lang, $arr_data, $arr_info);
		
	}
	
	public static function renderArchive (array $url, array $lang, array $arr) {
		
		$arr_info 			= $arr['arr_info'];
		$eleven_list		= $arr['eleven_list'];
		$title 				= 'SEO site analysis: '.'Archive';
		$keywords 			= 'Archive: '.', SEO, site analysis';
		$description 		= 'SEO Site Analysis '.'Archive';
		$layer 				= Box::layer($lang, $title, $keywords, $description);
		$menu 				= Box::menu($url, $lang, $arr_info, 'archive');
		$result				= preg_replace('~{{{BLOCK_0}}}~', $menu, $layer);
		$result				= preg_replace('~{{{BLOCK_1}}}~', Box::a_1($arr_info, $eleven_list, $lang), $result);
		$result				= preg_replace('~{{{[^}]*}}}~', '', $result);
		return $result;
		
	}
	
	
	public static function renderError (array $url, array $lang, array $arr) {
		
		$arr_info 			= $arr['arr_info'];
		$layer 				= Box::layer($lang, 'Error', 'Error', 'Error');
		$menu 				= Box::menu($url, $lang, $arr_info, 'error');
		$result				= preg_replace('~{{{BLOCK_0}}}~', $menu, $layer);
		$result				= preg_replace('~{{{BLOCK_1}}}~', Box::error($url, $arr_info, $lang), $result);
		$result				= preg_replace('~{{{[^}]*}}}~', '', $result);
		return $result;
		
	}
	
}

?>