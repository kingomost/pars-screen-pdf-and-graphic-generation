<?php
namespace TOOL\core;

use \Spipu\Html2Pdf\Html2Pdf;
use \Spipu\Html2Pdf\Exception\Html2PdfException;
use \Spipu\Html2Pdf\Exception\ExceptionFormatter;

class DoPage {
	
	public static function check (array $url) {
		
		switch ($url[0]) {
			case 'index':
				return DoPage::index($url);
				break;
			case 'archive':
				return DoPage::archive($url);
				break;
			case 'pdf':
				return DoPage::pdf($url);
				break;
			case 'domain-not-found':
				return DoPage::domain_not_found($url);
				break;
			default:
				return DoPage::page($url);
			   return true;
		}
		
	}
	
	private static function page($url) {
		
		$lang 		= ActivLang::return_lang($url);
		$arr_info 	= \TOOL\core\db\TableInfo::return_arr_info($lang);
		$data_note 	= \TOOL\core\db\DataNote::return_data ($url[0]);
		if (!is_array($data_note)) return DoPage::domain_not_found($url);
		$page 		= \TOOL\core\render\View::renderPage($url, $lang, ['arr_info'=>$arr_info, 'data_note' => $data_note, ]);
		return $page;
		
	}
	
	private static function index($url) {
		
		$lang 		= ActivLang::return_lang($url);
		$arr_info 	= \TOOL\core\db\TableInfo::return_arr_info($lang);
		$page 		= \TOOL\core\render\View::renderIndex($url, $lang, ['arr_info'=>$arr_info, ]);
		return $page;
		
	}
	
	private static function archive($url) {
		
		$lang 			= ActivLang::return_lang($url);
		$arr_info 		= \TOOL\core\db\TableInfo::return_arr_info($lang);
		$eleven_list	= \TOOL\core\db\ArchivNote::return_list();
		$page 			= \TOOL\core\render\View::renderArchive($url, $lang, ['arr_info'=>$arr_info, 'eleven_list'=>$eleven_list]);
		return $page;
		
	}
	
	private static function domain_not_found($url) {
		
		$lang 			= ActivLang::return_lang($url);
		$arr_info 		= \TOOL\core\db\TableInfo::return_arr_info($lang);
		$page 			= \TOOL\core\render\View::renderError($url, $lang, ['arr_info'=>$arr_info]);
		return $page;
		
	}
	
	private static function pdf($url) {
		
		$pdf_doc 		= trim($url[1]);
		$lang 			= substr($pdf_doc, 0, 2);
		$page 			= substr($pdf_doc, 3);
		$page 			= str_replace('.pdf', '', $page);
		$arr_info 		= \TOOL\core\db\TableInfo::return_arr_info([$lang, $lang]);
		$data_note 		= \TOOL\core\db\DataNote::return_data ($page);
		if (!is_array($data_note) || !in_array($lang,\TOOL\config\Config::$lang)) return DoPage::domain_not_found($url);
		$pdf_content 	= \TOOL\core\render\View::renderPdf($lang, $data_note);
		//print_r($pdf_content);
		//exit;
		require_once DIR.DIR_SEPARATOR.'core'.DIR_SEPARATOR.'analysis'.DIR_SEPARATOR.'html2pdf'.DIR_SEPARATOR.'vendor'.DIR_SEPARATOR.'autoload.php';
		try {
			$html2pdf 	= new Html2Pdf('P', 'A4', 'fr', true, 'UTF-8', array(15, 5, 15, 5));
			$html2pdf->setDefaultFont('freesans');
			$html2pdf->writeHTML($pdf_content);
			$html2pdf->Output(DIR.DIR_SEPARATOR.'pdf'.DIR_SEPARATOR.$lang.'_'.$page.'.pdf', 'F');
		} catch (Html2PdfException $e) {
			return DoPage::domain_not_found($url);
		}
		if(is_file(DIR.DIR_SEPARATOR.'pdf'.DIR_SEPARATOR.$lang.'_'.$page.'.pdf')) {
			header('Location: http://'.\DOMAIN.'/pdf/'.trim($url[1]));
			exit;
		}
		return DoPage::domain_not_found($url);
		
	}
	
	/*
		private static function page($url) {
		
		$lang 		= ActivLang::return_lang($url);
		$arr_info 	= \TOOL\core\db\TableInfo::return_arr_info($lang);
		//$one_domain	= 
		//if ($one_domain !== false) return (new render\Render($lang))->renderArchive(['arr_info'=>$arr_info, 'one_domain'=>$one_domain]);
		return (new \TOOL\core\render\ClassRend($lang))->renderError();
		
	}
	*/
	
}

?>