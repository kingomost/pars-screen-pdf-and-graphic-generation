<?php
	//print_r($arr_info);
?>
<div class="domain_and_data">
	<h1>
		<?=$arr_info['site'][100].': '?>
		<br>
		<b><?=$arr_data['domain']?></b> (<?=date('d.m.Y', $arr_data['time'])?>)
	</h1>
</div>