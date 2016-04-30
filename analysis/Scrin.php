<?php
namespace TOOL\core\analysis;

class Scrin {
	
	public static $phantomjs_prog = DIR.DIR_SEPARATOR.'core'.DIR_SEPARATOR.'analysis'.DIR_SEPARATOR.'phantomjs.exe';
	public static $phantomjs_1366 = DIR.DIR_SEPARATOR.'core'.DIR_SEPARATOR.'analysis'.DIR_SEPARATOR.'rasterize_1366.js';
	public static $phantomjs_320 = DIR.DIR_SEPARATOR.'core'.DIR_SEPARATOR.'analysis'.DIR_SEPARATOR.'rasterize_320.js';
	
	public static function do_scrin_1366 ($url, $dir_file) {
		
		if (is_file($dir_file)) unlink ($dir_file);
		exec(escapeshellcmd(Scrin::$phantomjs_prog.' '.Scrin::$phantomjs_1366.' '.$url.' '.$dir_file));
		
		if (is_file($dir_file)) return true;
		return false;
		
		/*
		if (is_file($dir_file)) {
			return true;
		} else {
			$proxy_list = Proxy::return_list(2);
			if (is_array($proxy_list)) {
				for ($i=0; $i<count($proxy_list); $i++) {
					//exec(escapeshellcmd($phantomjs_prog.' '.$phantomjs_1366.' '.$url.' '.$dir_file.' '.['--proxy=address:port']));
					exec(escapeshellcmd(Scrin::$phantomjs_prog.' '.Scrin::$phantomjs_1366.' '.$url.' '.$dir_file.' '.['--proxy='.$proxy_list[$i]]));
					if (is_file($dir_file)) return true;
				}
			} else {
				return false;
			}
		}
		return false;
		*/
	}
	
	public static function do_scrin_320 ($url, $dir_file) {
		
		if (is_file($dir_file)) unlink ($dir_file);
		exec(escapeshellcmd(Scrin::$phantomjs_prog.' '.Scrin::$phantomjs_320.' '.$url.' '.$dir_file));
		
		if (is_file($dir_file)) return true;
		return false;
		/*
		if (is_file($dir_file)) {
			return true;
		} else {
			$proxy_list = Proxy::return_list(2);
			if (is_array($proxy_list)) {
				for ($i=0; $i<count($proxy_list); $i++) {
					//exec(escapeshellcmd($phantomjs_prog.' '.$phantomjs_1366.' '.$url.' '.$dir_file.' '.['--proxy=address:port']));
					exec(escapeshellcmd(Scrin::$phantomjs_prog.' '.Scrin::$phantomjs_320.' '.$url.' '.$dir_file.' '.['--proxy='.$proxy_list[$i]]));
					if (is_file($dir_file)) return true;
				}
			} else {
				return false;
			}
		}
		return false;
		*/
	}
	
	public static function resize_and_word ($first_file, $to_dir, $to_file, $width, $height, $word=' ', $font_size=44) {
		
		if (is_file($to_dir.DIR_SEPARATOR.$to_file)) unlink ($to_dir.DIR_SEPARATOR.$to_file);
		$obj_text_layer_1_0 = \PHPImageWorkshop\ImageWorkshop::initTextLayer($word, DIR.DIR_SEPARATOR.'core'.DIR_SEPARATOR.'analysis'.DIR_SEPARATOR.'PHPImageWorkshop'.DIR_SEPARATOR.'fonts'.DIR_SEPARATOR.'arial.ttf', $font_size, '888888', 0);
		$obj_text_layer_1_1 = \PHPImageWorkshop\ImageWorkshop::initTextLayer($word, DIR.DIR_SEPARATOR.'core'.DIR_SEPARATOR.'analysis'.DIR_SEPARATOR.'PHPImageWorkshop'.DIR_SEPARATOR.'fonts'.DIR_SEPARATOR.'arial.ttf', $font_size, 'ffffff', 0);
		$obj_text_layer_1_2 = \PHPImageWorkshop\ImageWorkshop::initTextLayer($word, DIR.DIR_SEPARATOR.'core'.DIR_SEPARATOR.'analysis'.DIR_SEPARATOR.'PHPImageWorkshop'.DIR_SEPARATOR.'fonts'.DIR_SEPARATOR.'arial.ttf', $font_size, '222222', 0);
		$layer_1 = \PHPImageWorkshop\ImageWorkshop::initFromPath($first_file);
		$layer_1->cropInPixel($width, $height, 0, 0, 'LT');
		$layer_1->addLayerOnTop($obj_text_layer_1_0, 28, 28, "LB");
		$layer_1->addLayerOnTop($obj_text_layer_1_1, 35, 35, "LB");
		$layer_1->addLayerOnTop($obj_text_layer_1_2, 33, 33, "LB");
		$layer_1->save($to_dir, $to_file,  true, null, 100);
		unset ($obj_text_layer_1_0, $obj_text_layer_1_1, $obj_text_layer_1_2, $layer_1);
		if (is_file($to_dir.DIR_SEPARATOR.$to_file)) return $to_dir.DIR_SEPARATOR.$to_file;
		return false;
		
	}
	
	
	public static function img_in_img ($file_img_1, $file_img_2, $to_dir, $file_resalt, $width, $height, $left, $top) {
		
		if (is_file($to_dir.DIR_SEPARATOR.$file_resalt)) unlink ($to_dir.DIR_SEPARATOR.$file_resalt);
		$obj_img_1 = \PHPImageWorkshop\ImageWorkshop::initFromPath($file_img_1);
		$obj_img_2 = \PHPImageWorkshop\ImageWorkshop::initFromPath($file_img_2);
		$obj_img_2->resizeInPixel($width, $height, false);
		$obj_img_1->addLayerOnTop($obj_img_2, $left, $top, 'LT');
		$obj_img_1->save($to_dir, $file_resalt,  true, null, 70);
		unset ($obj_img_1, $obj_img_2);
		if (is_file($to_dir.DIR_SEPARATOR.$file_resalt)) return $to_dir.DIR_SEPARATOR.$file_resalt;
		return false;
		
	}
	
	 /*
	 Как-то криво - еще больше оперативки жрет
	  $x_o и $y_o - координаты левого верхнего угла выходного изображения на исходном
	  $w_o и h_o - ширина и высота выходного изображения
	  */
  public static function crop($image, $x_o, $y_o, $w_o, $h_o) {
	if (($x_o < 0) || ($y_o < 0) || ($w_o < 0) || ($h_o < 0)) {
		return false;
	}
	list($w_i, $h_i, $type) = getimagesize($image); // Получаем размеры и тип изображения (число)
	$types = array("", "gif", "jpeg", "png"); // Массив с типами изображений
	$ext = $types[$type]; // Зная "числовой" тип изображения, узнаём название типа
	if ($ext) {
		$func = 'imagecreatefrom'.$ext; // Получаем название функции, соответствующую типу, для создания изображения
		$img_i = $func($image); // Создаём дескриптор для работы с исходным изображением
	} else {
		echo 'Некорректное изображение'; // Выводим ошибку, если формат изображения недопустимый
		return false;
	}
	if ($x_o + $w_o > $w_i) $w_o = $w_i - $x_o; // Если ширина выходного изображения больше исходного (с учётом x_o), то уменьшаем её
	if ($y_o + $h_o > $h_i) $h_o = $h_i - $y_o; // Если высота выходного изображения больше исходного (с учётом y_o), то уменьшаем её
	$img_o = imagecreatetruecolor($w_o, $h_o); // Создаём дескриптор для выходного изображения
	imagecopy($img_o, $img_i, 0, 0, $x_o, $y_o, $w_o, $h_o); // Переносим часть изображения из исходного в выходное
	$func = 'image'.$ext; // Получаем функция для сохранения результата
	return $func($img_o, $image); // Сохраняем изображение в тот же файл, что и исходное, возвращая результат этой операции
  }
	
	
}


?>