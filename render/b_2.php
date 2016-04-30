<div class="modal_view_screen">
<?php
if (is_file(DIR.DIR_SEPARATOR.$arr_data['scrin_nout']) && is_file(DIR.DIR_SEPARATOR.$arr_data['scrin_smart'])) {
?>
<img src="http://<?=DOMAIN?>/<?=$arr_data['scrin_nout']?>" style="background-color: transparent; border: none; width: 65%" data-toggle="modal" data-target="#img_screen_nout" class="hover_point">
<div id="img_screen_nout" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<img src="http://<?=DOMAIN?>/<?=$arr_data['scrin_1366']?>" width="100%" height="auto">
		</div>
	</div>
</div>
<img src="http://<?=DOMAIN?>/<?=$arr_data['scrin_smart']?>" style="background-color: transparent; border: none; width: 32%" data-toggle="modal" data-target="#img_screen_smartfon" class="hover_point">
<div id="img_screen_smartfon" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<img src="http://<?=DOMAIN?>/<?=$arr_data['scrin_320']?>" width="100%" height="auto">
		</div>
	</div>
</div>
<?php
} elseif (is_file(DIR.DIR_SEPARATOR.$arr_data['scrin_nout']) && !is_file(DIR.DIR_SEPARATOR.$arr_data['scrin_smart'])) {
?>
<img src="http://<?=DOMAIN?>/<?=$arr_data['scrin_nout']?>" style="background-color: transparent; border: none; width: 95%" data-toggle="modal" data-target="#img_screen_nout" class="hover_point">
<div id="img_screen_nout" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<img src="http://<?=DOMAIN?>/<?=$arr_data['scrin_1366']?>" width="100%" height="auto">
		</div>
	</div>
</div>
<?php
} else {
?>
<img src="http://<?=DOMAIN?>/<?=$arr_data['scrin_smart']?>" style="background-color: transparent; border: none; width: 95%" data-toggle="modal" data-target="#img_screen_smartfon" class="hover_point">
<div id="img_screen_smartfon" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<img src="http://<?=DOMAIN?>/<?=$arr_data['scrin_320']?>" width="100%" height="auto">
		</div>
	</div>
</div>
<?php
}
?>
</div>