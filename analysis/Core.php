<?php
namespace TOOL\core\analysis;

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

class Core {
	
	public $post 				= false;
	public $check_post 			= false;
	public $result 				= false;
	
	public $time_create 		= false;//
	public $domain 				= false;//
	public $url 				= false;//
	public $scrin_1366 			= false;//
	public $scrin_320 			= false;//
	public $scrin_nout 			= false;
	public $scrin_smart 		= false;
	public $parse_html 			= false;//
	public $title 				= false;
	public $keywords 			= false;
	public $description 		= false;
	public $open_graph 			= false;
	public $headings 			= false;
	public $images 				= false;
	public $text_vs_html 		= false;
	public $flash 				= false;
	public $frame 				= false;
	public $all_link 			= false;
	public $grafic_link 		= false;
	public $frequency_word 		= false;
	public $html_version 		= false;
	public $pdf_doc 			= false;
	
	//public $usabiliti 		= false;
	//public $doc_struct 		= false;
	
	
	public function __construct ($post) {
		
		$this->post = $post;
		
	}
	
	public function result () {
		
		
		$domain 				= NameDomain::return_clear_domain($this->post);
		$protocol 				= NameDomain::return_protocol($this->post);
		$protocol_request 		= $protocol ? $protocol : 'http://' ;
		$is_www 				= NameDomain::return_is_www($this->post);
		$is_www_request 		= $is_www ? $is_www : '' ;
		
		$file_nout 				= DIR.DIR_SEPARATOR.'core'.DIR_SEPARATOR.'analysis'.DIR_SEPARATOR.'nout.png';
		$file_smartfone 		= DIR.DIR_SEPARATOR.'core'.DIR_SEPARATOR.'analysis'.DIR_SEPARATOR.'smartfon.png';
		
		if (!$domain || $domain == '') return false;
		
		$request_url = 	$protocol_request.$is_www_request.$domain;
		$all_options_url = ['http://'.$domain, 'http://www.'.$domain,	'https://'.$domain,	'https://www.'.$domain,];
		$this->time_create = time();
		$this->url = str_replace('.','-d-o-t-',$domain).'-'.$this->time_create;
		$this->scrin_1366 = Scrin::do_scrin_1366($request_url, DIR.DIR_SEPARATOR.'img'.DIR_SEPARATOR.$this->url.'_scrin_1366.png');
		$this->scrin_320 = Scrin::do_scrin_320($request_url, DIR.DIR_SEPARATOR.'img'.DIR_SEPARATOR.$this->url.'_scrin_320.png');
		$this->parse_html = ParseHtml::return_html($request_url);
		
		if (!$this->parse_html || (!$this->scrin_1366 && !$this->scrin_320)) {
			$all_options_url = array_diff($all_options_url,array($request_url));
			foreach ($all_options_url as $buf) {
				$request_url = $buf;
				$this->scrin_1366 = Scrin::do_scrin_1366($request_url, DIR.DIR_SEPARATOR.'img'.DIR_SEPARATOR.$this->url.'_scrin_1366.png');
				$this->scrin_320 = Scrin::do_scrin_320($request_url, DIR.DIR_SEPARATOR.'img'.DIR_SEPARATOR.$this->url.'_scrin_320.png');
				$this->parse_html = ParseHtml::return_html($request_url);
				if ($this->parse_html && ($this->scrin_1366 || $this->scrin_320)) break;
			}
		}
		if (!$this->parse_html || (!$this->scrin_1366 || !$this->scrin_320)) return false;
		$this->domain = $request_url;
		if ($this->scrin_1366) {
			$this->scrin_1366 = 'img'.DIR_SEPARATOR.$this->url.'_scrin_1366.png';
			Scrin::resize_and_word (DIR.DIR_SEPARATOR.$this->scrin_1366, DIR.DIR_SEPARATOR.'img', $this->url.'_1366_768.png', 1366, 768, '1366 X 768', 164);
			if (is_file(DIR.DIR_SEPARATOR.'img'.DIR_SEPARATOR.$this->url.'_1366_768.png')) {
				$screen_1366_768 = DIR.DIR_SEPARATOR.'img'.DIR_SEPARATOR.$this->url.'_1366_768.png';
				Scrin::img_in_img ($file_nout, $screen_1366_768, DIR.DIR_SEPARATOR.'img', $this->url.'_nout.png', 1140, 640, 257, 73);
				if (is_file(DIR.DIR_SEPARATOR.'img'.DIR_SEPARATOR.$this->url.'_nout.png')) $this->scrin_nout = 'img'.DIR_SEPARATOR.$this->url.'_nout.png';
			}
		}
		if ($this->scrin_320) {
			$this->scrin_320 = 'img'.DIR_SEPARATOR.$this->url.'_scrin_320.png';
			Scrin::resize_and_word (DIR.DIR_SEPARATOR.$this->scrin_320, DIR.DIR_SEPARATOR.'img', $this->url.'_320_480.png', 320, 480, '320 X 480', 44);
			if (is_file(DIR.DIR_SEPARATOR.'img'.DIR_SEPARATOR.$this->url.'_320_480.png')) {
				$screen_320_480 = DIR.DIR_SEPARATOR.'img'.DIR_SEPARATOR.$this->url.'_320_480.png';
				Scrin::img_in_img ($file_smartfone, $screen_320_480, DIR.DIR_SEPARATOR.'img', $this->url.'_smartfon.png', 670, 1195, 105, 170);
				if (is_file(DIR.DIR_SEPARATOR.'img'.DIR_SEPARATOR.$this->url.'_smartfon.png')) $this->scrin_smart = 'img'.DIR_SEPARATOR.$this->url.'_smartfon.png';
			}
		}
		if (!$this->scrin_nout && !$this->scrin_smart)  return false;
		//дальше распарсим HTML
		$this->title 				= ParseHtml::title($this->parse_html);
		$this->keywords 			= ParseHtml::keywords($this->parse_html);
		$this->description 			= ParseHtml::description($this->parse_html);
		$this->open_graph 			= ParseHtml::open_graph($this->parse_html);
		$this->headings 			= ParseHtml::headings($this->parse_html);
		$this->images 				= ParseHtml::images($this->parse_html, $this->domain);
		$this->text_vs_html 		= ParseHtml::text_vs_html($this->parse_html);
		$this->flash 				= ParseHtml::flash($this->parse_html, $this->domain);
		$this->frame 				= ParseHtml::frame($this->parse_html, $this->domain);
		$this->all_link 			= ParseHtml::all_link($this->parse_html, $this->domain);
		$this->frequency_word 		= ParseHtml::frequency_word($this->parse_html, $this->domain);
		
		if (is_array($this->all_link)) {
			//построить графику для LINK и добавить ссылки на них в $return_model
			$return_model = [];
			$obj_grafica = new CreateGrafics($this->all_link, DIR.DIR_SEPARATOR.'img', $this->url);
			$this->grafic_link['grafica_vnytr_vs_vnesh'] 		= $obj_grafica->vnytr_vs_vnesh;
			$this->grafic_link['grafica_nofollow_vs_follow'] 	= $obj_grafica->grafica_nofollow_vs_follow;
		}
		
		$this->html_version 		= ParseHtml::html_version($this->parse_html);
		$this->robots_txt 			= ParseHtml::robots_txt($this->domain);
		$this->site_map 			= ParseHtml::site_map($this->domain, $this->robots_txt);
		
		
		//require_once DIR.DIR_SEPARATOR.'core'.DIR_SEPARATOR.'analysis'.DIR_SEPARATOR.'html2pdf'.DIR_SEPARATOR.'vendor'.DIR_SEPARATOR.'autoload.php';
		$buf_lang = \TOOL\config\Config::$lang;
		for ($i=0; $i<count($buf_lang); $i++) {
			/*
			$pdf_content = \TOOL\core\render\View::renderPdf($buf_lang[$i], $this);
			try {
				//$html2pdf = new Html2Pdf('P', 'A4', 'en');
				$html2pdf = new Html2Pdf('P', 'A4', 'fr', true, 'UTF-8', array(15, 5, 15, 5));
				$html2pdf->setDefaultFont('freesans');
				//$html2pdf->SetFont('times', 'BI', 20, '', 'false');
				$html2pdf->writeHTML($pdf_content);
				$html2pdf->Output(DIR.DIR_SEPARATOR.'img'.DIR_SEPARATOR.$buf_lang[$i].'_'.$this->url.'.pdf', 'F');
			} catch (Html2PdfException $e) {
				return false;
			}
			if(is_file(DIR.DIR_SEPARATOR.'img'.DIR_SEPARATOR.$buf_lang[$i].'_'.$this->url.'.pdf')) {
				$this->pdf_doc[$buf_lang[$i]] = 'img'.DIR_SEPARATOR.$buf_lang[$i].'_'.$this->url.'.pdf';
			}
			*/
			$this->pdf_doc[$buf_lang[$i]] = 'pdf'.DIR_SEPARATOR.$buf_lang[$i].'_'.$this->url.'.pdf';
		}
		
		//print_r ($this);
		
		//exit;
		
		//if (!$this->scrin_1366)  return false;
		
		return $this;
		
	}
	
}

?>