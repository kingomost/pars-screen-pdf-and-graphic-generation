<?php

$arr_serialise = ['headings', 'text_vs_html', 'all_link', 'grafic_link', 'frequency_word', 'images', 'open_graph',];

foreach ($arr_data as $key=>$value) {
	
	echo '<br/>';
	
	echo '---'.$key.'---';
	echo '<br/>';
	if (in_array($key, $arr_serialise)) $value = unserialize ($value);
	print_r ($value);
	echo '<br/>';
	echo '<hr/>';
	
}

?>