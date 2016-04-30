<h2><?=$arr_info['error'][10]?></h2>
<br>
<h3>
	<?php
	if (!empty($_POST['domain'])) {
	?>
		<b><?=$arr_info['not_found'][10]?></b><?=$_POST['domain']?>
	<?php
	} else {
	?>
		<b><?=$arr_info['not_found'][10]?></b><?=$arr_info['this_page_not_found'][10]?>
	<?php
	}
	?>
</h3>
<br>
<br>