<div id="col_base_content">
<?php
	use \TOOL\config\Config;

	if (is_array($arr_data) && count($arr_data)>0) {
		$count = count($arr_data)>Config::$archiv_note_count ? count($arr_data)-1 : count($arr_data) ;
		for ($i=0; $i<$count; $i++) {
?>
	<div class="archiv_block">
	<?php
		if ($arr_data[$i]['scrin_nout'] && $arr_data[$i]['scrin_nout']!==false && $arr_data[$i]['scrin_nout']!=='') {
	?>
		<a href="http://<?=DOMAIN?>/<?=$arr_data[$i]['url']?><?=$lang[1]?>">
			<img src="http://<?=DOMAIN?>/<?=$arr_data[$i]['scrin_nout']?>" style="margin: 3px 3px 3px 10px; background-color: transparent; border: none; height: <?=mt_rand(65, 67)?>px; float: left;">
		</a>
	<?php
		}
	?>
	
	<?php
		if ($arr_data[$i]['scrin_smart'] && $arr_data[$i]['scrin_smart']!==false && $arr_data[$i]['scrin_smart']!=='') {
	?>
		<a href="http://<?=DOMAIN?>/<?=$arr_data[$i]['url']?><?=$lang[1]?>">
			<img src="http://<?=DOMAIN?>/<?=$arr_data[$i]['scrin_smart']?>" style="margin: 0; background-color: transparent; border: none; height: <?=mt_rand(85, 88)?>px; float: left;">
		</a>
	<?php
		}
	?>
	<h4 style="padding-top: 3px; margin-left: 250px;">
		<?=date('d.m.Y', $arr_data[$i]['time'])?>
	</h4>
	<h4 style="margin-left: 210px;">
		<br>
		<a href="http://<?=DOMAIN?>/<?=$arr_data[$i]['url']?><?=$lang[1]?>" class="link_archiv">
			<b><?=$arr_data[$i]['domain']?></b>
		</a>
	</h4>
	<div style="clear: both;"></div>
	</div>
<?php
		}
	} else {
?>
		<div style="clear: both;"></div>	
		<h2><?='INFO no archiv note'?></h2>
<?php
	}
?>
</div>
	<?php
		if (count($arr_data)>Config::$archiv_note_count) {
	?>
		<div style="display: block; text-align: center;" id="add_new_note">
			<a href="" id="last_time" class="link_archiv" name="<?=$arr_data[count($arr_data)-1]['time']?>" onClick="return addNotes(this.name)">
				<span class="glyphicon glyphicon-plus" style="font-size: 500%;" aria-hidden="true"></span>
			</a>
		</div>
		<div style="display: none; text-align: center;"  id="add_new_note_preloader">
			<span class="glyphicon glyphicon-refresh" style="font-size: 500%; color: #444444;" aria-hidden="true"></span>
		</div>
	<?php
		}
	?>