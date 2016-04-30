<?php

namespace TOOL\core;

trait ConfigTables {
	
	public static $table_domain 			= 'domain';
	public static $table_data 				= 'data';
	public static $table_analysis 			= 'multi_lang';
	
	public static $crete_table_domain 		= ' id 				INT PRIMARY KEY AUTO_INCREMENT,
												time 			INT NOT NULL,
												domain 			VARCHAR(255) NOT NULL,
												url 			VARCHAR(255) NOT NULL UNIQUE';
	public static $crete_table_data 		= ' id 				INT PRIMARY KEY AUTO_INCREMENT,
												scrin_1366 		VARCHAR(255) DEFAULT NULL,
												scrin_320 		VARCHAR(255) DEFAULT NULL,
												scrin_nout 		VARCHAR(255) DEFAULT NULL,
												scrin_smart		VARCHAR(255) DEFAULT NULL,
												parse_html 		MEDIUMTEXT DEFAULT NULL,
												title			TEXT DEFAULT NULL,
												keywords		TEXT DEFAULT NULL,
												description		TEXT DEFAULT NULL,
												open_graph		MEDIUMTEXT DEFAULT NULL,
												headings		MEDIUMTEXT DEFAULT NULL,
												images			MEDIUMTEXT DEFAULT NULL,
												text_vs_html	TEXT DEFAULT NULL,
												flash			MEDIUMTEXT DEFAULT NULL,
												frame			MEDIUMTEXT DEFAULT NULL,
												all_link		MEDIUMTEXT DEFAULT NULL,
												grafic_link		TEXT DEFAULT NULL,
												frequency_word	MEDIUMTEXT DEFAULT NULL,
												html_version	VARCHAR(255) DEFAULT NULL,
												robots_txt		TEXT DEFAULT NULL,
												site_map		MEDIUMTEXT DEFAULT NULL,
												
												usabiliti		VARCHAR(255) DEFAULT NULL,
												doc_struct		VARCHAR(255) DEFAULT NULL,
												pdf_doc			VARCHAR(255) DEFAULT NULL';
	public static $crete_table_analysis		= ' id 				INT PRIMARY KEY AUTO_INCREMENT,
												razdel	 		VARCHAR(255) NOT NULL,
												status 			INT NOT NULL,
												en				TEXT DEFAULT NULL,
												ru				TEXT DEFAULT NULL,
												fr				TEXT DEFAULT NULL,
												UNIQUE (razdel, status)';
	
	public static $row_table_analysis		= [
												['home', 10, 'Home', 'Главная', 'Home'],
												['archive', 10, 'Archive', 'Архив', 'Archives'],
												['error', 10, 'Error.', 'Ошибка.', 'Erreur.'],
												['not_found', 10, 'Not found: ', 'Не найдено: ', 'Pas trouvé: '],
												['this_page_not_found', 10, 'This page can not be found.', 'Эта страница не найдена.', 'Cette page ne peut pas être trouvée.'],
												
												['about', 100, 
													'Only the main page:
													<br><br>
													<ul>
														<li>content</li>
														<li>the frequency of use of words</li>
														<li>links</li>
														<li>pictures</li>
														<li>the structure of the document</li>
														<li>pdf version of the report</li>
														<li>useful resources for more analytics</li>
													</ul><br>', 
													'Только главная страница: 
													<br><br>
													<ul>
														<li>контент</li>
														<li>частотность использования слов</li>
														<li>ссылки</li>
														<li>картинки</li>
														<li>структура документа</li>
														<li>pdf версия отчета</li>
														<li>полезные ресурсы для дополнительной аналитики</li>
													</ul><br>', 
													'Seule la page principale:
													<br><br>
													<ul>
														<li>contenu</li>
														<li>la fréquence d\'utilisation des mots</li>
														<li>liens</li>
														<li>images</li>
														<li>la structure du document</li>
														<li>version pdf du rapport</li>
														<li>ressources utiles pour plus d\'analyse</li>
													</ul><br>'
												],

												['site', 100, 'Site', 'Сайт', 'Site Web'],
												
												['contents', 100, 'Contents', 'Контент', 'Contenu'],
												['contents_title', 200, 'Title', 'Название', 'Titre'],
												['contents_keywords', 200, 'Keywords', 'Ключевые слова', 'Mots clés'],
												['contents_description', 200, 'Description', 'Описание', 'La description'],
												['contents_headings', 200, 'Headings', 'Заголовки', 'Rubriques'],
												
												['frequency', 100, 'The frequency of words', 'Частотность слов', 'La fréquence des mots'],
												['frequency_words', 300, 'Words', 'Слова', 'Paroles'],
												['frequency_text', 300, 'In the text', 'В тексте', 'Dans le texte'],
												['frequency_meta', 300, 'Meta, attributs, etc.', 'Meta, attributs, etc.', 'Meta, attributs, etc.'],
												
												['links', 100, 'Links', 'Ссылки', 'Lien'],
												['links_vnesh_vnytr', 200, 'External, internal', 'Внешние, внутренние', 'Externe, interne'],
												['links_vnytr', 300, 'Internal', 'Внутренние', 'Interne'],
												['links_vnesh', 300, 'External', 'Внешние', 'Externe'],
												['links_follow_nofollow', 200, 'Follow, nofollow', 'Индексируемые, неиндексируемые', 'Follow, nofollow'],
												['links_nofollow', 300, 'Nofollow', 'Неиндексируемые', 'Nofollow'],
												['links_follow', 300, 'Follow', 'Индексируемые', 'Follow'],
												['links_vnytr', 200, 'Internal', 'Внутренние', 'Interne'],
												['links_vnesh', 200, 'External', 'Внешние', 'Externe'],
												
												['img', 100, 'Pictures', 'Картинки', 'Photos'],
												
												['doc_struct', 100, 'Document Structure', 'Структура документа', 'Document Structure'],
												['doc_struct_text_vs_html', 200, 'Text and code', 'Текст и код', 'Texte et Code'],
												['doc_struct_all_simbol', 300, 'Number of characters', 'Всего символов', 'Nombre de personnages'],
												['doc_struct_clear_text', 300, 'Read the text', 'Читаемого текста', 'Lire le texte'],
												['doc_struct_persent_txt', 300, 'The percentage of readable text', 'Процент читаемого текста', 'Le pourcentage de texte lisible'],
												['doc_struct_open_graph', 200, 'Used Open Graph', 'Используется Open Graph', 'Occasion Open Graph'],
												
												['in_pdf', 100, 'Report in PDF', 'Отчет в PDF', 'Rapport en PDF'],
												['good_resurs', 100, 'Useful resources', 'Полезные ресурсы', 'Ressources utiles'],
											];
	
	
}

?>