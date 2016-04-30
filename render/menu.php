<?php
	$class_link_index = 'no_activ';
	$class_link_archive = 'no_activ';
	if ($page === 'index') {$class_link_index = 'activ';}
	if ($page === 'archive') {$class_link_archive = 'activ';}
?>
<div class="menu">
	<div class="menu_link">
		<div class="<?=$class_link_index?>">
			<a href="http://<?=DOMAIN?>/index<?=$lang[1]?>"><?=$arr_info['home'][10]?></a>
		</div>
		<div class="<?=$class_link_archive?>">
			<a href="http://<?=DOMAIN?>/archive<?=$lang[1]?>"><?=$arr_info['archive'][10]?></a>
		</div>
	</div>
	<div class="lang_form">
		<?php 
			$activ_url = "http://".DOMAIN."/".implode('/', $url);
			$class_lang_form = 'no_activ';
			$disabled = '';
			for ($i=0; $i<count($all_lang); $i++) {
				if ($all_lang[$i] === $lang[0]) {
					$class_lang_form = 'activ';
					$disabled = ' disabled';
				} else {
					$class_lang_form = 'no_activ';
					$disabled = '';
				}
		?>
			<form action="http://<?=DOMAIN?>/lang" method="post">
                <input type="hidden" name="this_page" value="<?=$activ_url?>">
                <input type="hidden" name="lang_new" value="<?=$all_lang[$i]?>">
				<div class="<?=$class_lang_form?>">
					<input type="submit" value="<?=strtoupper($all_lang[$i])?>"<?=$disabled?>>
				</div>
			</form>
		<?php 
			} 
		?>
	</div>
	<div style="clear: both;"></div>
</div>