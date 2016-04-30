<style type="text/css">
	<?=file_get_contents(DIR.DIR_SEPARATOR.'template'.DIR_SEPARATOR.'bootstrap'.DIR_SEPARATOR.'css'.DIR_SEPARATOR.'bootstrap.min.css')?>
</style>
<style type="text/css">
	body {
		background: url(<?=DIR.DIR_SEPARATOR.'template'.DIR_SEPARATOR?>code_0.jpg) no-repeat fixed;
	}
	.align_center {
		text-align: center;
	}
	#base_content {
		margin-top: 25px;
		margin-bottom: 40px;
		display: none;
		background-color: transparent;
	}
	div#bazis_menu {
		margin-bottom: 40px;
	}
	div.menu {
		padding: 5px 20px;
		border-top: 2px solid #8b8989;
		border-bottom: 2px solid #8b8989;
	}
	div.foother {
		margin-top: 20px;
		margin-bottom: 0;
		padding: 5px 20px;
		border-top: 2px solid #8b8989;
		border-bottom: 2px solid #8b8989;
		text-align: center;
	}
	div.menu div div, div.menu div form div, div.menu div form div input {
		display: inline-block;
	}
	div.menu_link {
		text-transform: uppercase;
		font-size: 16pt;
	}
	div.menu_link a {
		text-transform: uppercase;
		text-decoration: none;
		color: #444444;
	}
	div.menu_link div.activ a {
		color: #000000;
		font-weight: bold;
	}
	div.menu_link a:hover {
		color: #222222;
	}
	div.lang_form  input {
		font-size: 16pt;
		text-transform: uppercase;
		border: none;
		background:  transparent;
		color: #666666;
	}
	div.lang_form  input:hover{
		color: #222222;
	}
	div.lang_form  div.activ input {
		color: #000000;
	}
	div.menu div.lang_form {
		float: right;
		width: 45%;
	}
	div.menu div.menu_link {
		float: left;
		width: 45%;
	}
	div.menu div.menu_link div {
		float: left;
		width: 50%;
	}
	div.menu div.lang_form form {
		float: right;
		margin-left: 15px;
	}
	div.form_analysis {
		margin: 10px 0 50px 0;
		padding: 0 20%;
	}
	div.form_analysis span button {
		padding-left: 30px;
		padding-right: 30px;
	}
	div.hello_about {
		text-align: justify;
	}
	div.domain_and_data h1 {
		margin: 10px 0 40px 0;
		font-size: 22pt;
		text-align: center;
	}
	div.modal_view_screen img {
		cursor: pointer;
	}
	div.border_for_div, div.panel, div.panel-default{
		border: 2px solid #8b8989;
		border-radius: 5px;
		padding: 5px 15px;
	}
	div.info_group {
		margin: 20px 0;
	}

	div.block_acc_link {
		padding: 2px 0;
		text-align: center;
	}
	div.block_acc_link  a {
		display: inline-block;
		width: 100%;
		text-decoration: none;
		color: #000000;
		font-size: 18pt;
	}
	div.block_acc_link  a:hover, div.block_acc_link  a:visited {
		text-decoration: none;
		color: #00000f;
	}

	div.collapse table {
		width: 100%;
		border-collapse: collapse;
	}
	div.collapse table tr {
		border: 1px solid #e8ded5;
	}
	div.collapse table tr td {
		padding: 0 5px 0 15px;
		border: 1px solid #e8ded5;
	}
	div.collapse table tr td  a{
		color: #1e213d;
	}
	div.modal_view_screen {
		margin: 40px 0;
	}
	a.link_archiv {
		text-decoration: none;
		color: #444444;
	}
	a.link_archiv:hover {
		color: #000000;
	}
	div.archiv_block {
		margin-bottom: 20px;
		border: 1px solid #8b8989; 
		border-radius: 5px; 
		padding: 7px; 
		background-color: #ffffff; 
		opacity: 0.9;
		overflow: hidden;
	}
	div.archiv_block:hover {
		opacity: 1.0;
	}

</style>
<page backimg="<?=DIR.DIR_SEPARATOR.'template'.DIR_SEPARATOR?>code_0_pdf.jpg" backimgw="500%" style="font-family: freesans">
		<br><br><br>
		<h1 style="text-align: center; font-family: freesans;">
			<!---<?=$arr_info['site'][100].': '?>--->
			<br>
			<b><?=$arr_data['domain']?></b> (<?=date('d.m.Y', $arr_data['time'])?>)
		</h1>
		<br><br><br>
		<div style="width: 90%; margin-left: 30px;">
			<?php
			if (is_file(DIR.DIR_SEPARATOR.$arr_data['scrin_nout']) && is_file(DIR.DIR_SEPARATOR.$arr_data['scrin_smart'])) {
			?>
				<img src="<?=DIR.DIR_SEPARATOR.$arr_data['scrin_nout']?>" style="background-color: transparent; border: none; width: 70%">
				<img src="<?=DIR.DIR_SEPARATOR.$arr_data['scrin_smart']?>" style="background-color: transparent; border: none; width: 29%">
			<?php
			} elseif (is_file(DIR.DIR_SEPARATOR.$arr_data['scrin_nout']) && !is_file(DIR.DIR_SEPARATOR.$arr_data['scrin_smart'])) {
			?>
				<img src="<?=DIR.DIR_SEPARATOR.$arr_data['scrin_nout']?>?>" style="background-color: transparent; border: none; width: 95%">
			<?php
			} else {
			?>
				<img src="<?=DIR.DIR_SEPARATOR.$arr_data['scrin_smart']?>" style="background-color: transparent; border: none; width: 95%">
			<?php
			}
			?>
		</div>
		
</page>


		<!--- START CONTENT --->
<page backimg="<?=DIR.DIR_SEPARATOR.'template'.DIR_SEPARATOR?>code_0_pdf.jpg" backimgw="500%" style="font-family: freesans">
<div style="width: 100%;">
				<h3 style="text-align: center; font-family: freesans;"><b><?=$arr_info['contents'][100]?></b></h3>
				<br>
				<h4><b><?=$arr_info['contents_title'][200].': '?></b><i><?=(is_string($arr_data['title']) && $arr_data['title']!=='')?$arr_data['title']:'---'?></i></h4>
				<hr style="margin: -2px 0 -15px 0; padding: -2px 0 -15px 0;">
				<h4><b><?=$arr_info['contents_keywords'][200].': '?></b><i><?=(is_string($arr_data['keywords']) && $arr_data['keywords']!=='')?$arr_data['keywords']:'---'?></i></h4>
				<hr style="margin: -2px 0 -15px 0; padding: -2px 0 -15px 0;">
				<h4><b><?=$arr_info['contents_description'][200].': '?></b><i><?=(is_string($arr_data['description']) && $arr_data['description']!=='')?$arr_data['description']:'---'?></i></h4>
				<?php
					$buf = unserialize ($arr_data['headings']);
					if (is_array($buf) && count($buf)>0) {
				?>
					<hr style="margin: -2px 0 -15px 0; padding: -2px 0 -15px 0;">
					<h4><b><?=$arr_info['contents_headings'][200].': '?></b></h4>
					<table style="width: 90%; border-collapse: collapse;">
					<?php
					foreach ($buf as $key=>$value) {
						if (mb_strlen(trim($key), 'utf-8')>5) {
					?>
							<tr style="border: 1px solid #e8ded5;">
								<td style="padding: 0 5px 0 15px; border: 1px solid #e8ded5;"><b><?=$value?></b></td>
								<td style="padding: 0 5px 0 15px; border: 1px solid #e8ded5;"><i><?=$key?></i></td>
							</tr>
					<?php
						}
					}
					?>
					</table>
				<?php
				}
				?>
</div>
</page>
		<!--- END CONTENT --->



		<!--- START FREQUENCY WORD --->
		
		<?php
		$buf = unserialize ($arr_data['frequency_word']);
		if (is_array($buf) && count($buf)>0) {
			$sravni = function ($first, $second) {
				if ($first['visible'] === $second['visible']) {
					if ($first['no_visible'] === $second['no_visible']) return 0;
					return ($first['no_visible'] > $second['no_visible']) ? -1 : 1 ;
				}
				return ($first['visible'] > $second['visible']) ? -1 : 1 ;
			};
			usort($buf, $sravni);
			?>
<page backimg="<?=DIR.DIR_SEPARATOR.'template'.DIR_SEPARATOR?>code_0_pdf.jpg" backimgw="500%" style="font-family: freesans">
<div style="width: 100%;">
				<h3 style="text-align: center;"><b><?=$arr_info['frequency'][100]?></b></h3>
				<br>
				<table style="width: 90%; border-collapse: collapse;">
					<tr style="border: 1px solid #e8ded5;">
						<td style="width: 50%; text-align: center; padding: 0 5px 0 5px; border: 1px solid #e8ded5;"><b><?=$arr_info['frequency_words'][300]?></b></td>
						<td style="width: 25%; text-align: center; padding: 0 5px 0 5px; border: 1px solid #e8ded5;"><b><?=$arr_info['frequency_text'][300]?></b></td>
						<td style="width: 25%; text-align: center; padding: 0 5px 0 5px; border: 1px solid #e8ded5;"><b><?=$arr_info['frequency_meta'][300]?></b></td>
					</tr>
				<?php
				for ($i=0; $i<count($buf); $i++) {
					?>
					<tr style="border: 1px solid #e8ded5;">
						<td style="padding: 0 5px 0 15px; border: 1px solid #e8ded5;"><i><?=$buf[$i]['words']?></i></td>
						<td style="text-align: center; padding: 0 5px 0 15px; border: 1px solid #e8ded5;"><?=$buf[$i]['visible']?$buf[$i]['visible']:'---'?></td>
						<td style="text-align: center; padding: 0 5px 0 15px; border: 1px solid #e8ded5;"><?=$buf[$i]['no_visible']?$buf[$i]['no_visible']:'---'?></td>
					</tr>
					<?php
				}
				?>
				</table>
</div>
</page>
			<?php
		}
		?>
		<!--- END FREQUENCY WORD --->
		

		<!--- START LINK --->
<page backimg="<?=DIR.DIR_SEPARATOR.'template'.DIR_SEPARATOR?>code_0_pdf.jpg" backimgw="500%" style="font-family: freesans">
<div style="width: 100%;">
		<?php
		$buf = unserialize ($arr_data['all_link']);
		$buf_img = unserialize ($arr_data['grafic_link']);
		//if (is_array($buf) && count($buf)>0 && 
				//isset($buf_img['grafica_vnytr_vs_vnesh']) && 
				//isset($buf_img['grafica_nofollow_vs_follow']) && 
				//is_file(DIR.DIR_SEPARATOR.$buf_img['grafica_vnytr_vs_vnesh']) && 
				//is_file(DIR.DIR_SEPARATOR.$buf_img['grafica_nofollow_vs_follow'])) {
		if (is_array($buf) && count($buf)>0 && 
				isset($buf_img['grafica_vnytr_vs_vnesh']) && 
				isset($buf_img['grafica_nofollow_vs_follow'])) {
					$follow = 0;
					$nofollow = 0;
					/*
					for ($i=0; $i<count($buf['vnytr']); $i++) {
						if ($buf['vnytr'][$i]['nofollow'] === false) $follow++;
						else $nofollow++;
					}
					*/
					for ($i=0; $i<count($buf['vnesh']); $i++) {
						if ($buf['vnesh'][$i]['nofollow'] === false) $follow++;
						else $nofollow++;
					}
					
		?>
			<h3 style="text-align: center;"><b><?=$arr_info['links'][100]?></b></h3>
			<br>
			<table style="width: 100%;">
				<tr>
					<td style="width: 50%;">
						<h4 style="text-align: center;"><b><?=$arr_info['links_vnesh_vnytr'][200].': '?></b></h4>
						<?php
						if (is_file(DIR.DIR_SEPARATOR.$buf_img['grafica_vnytr_vs_vnesh'])) {
						?>
							<img src="<?=DIR.DIR_SEPARATOR.$buf_img['grafica_vnytr_vs_vnesh']?>" style="background-color: transparent; border: none; width: 95%">
						<?php
						}
						?>
						<table style="width: 90%; border-collapse: collapse;">
							<tr style="border: 1px solid #e8ded5;">
								<td style="text-align: center; width: 50%; padding: 0 5px 0 15px; border: 1px solid #e8ded5;"><b><?=$arr_info['links_vnytr'][300]?></b></td>
								<td style="text-align: center; width: 50%; padding: 0 5px 0 15px; border: 1px solid #e8ded5;"><b><?=$arr_info['links_vnesh'][300]?></b></td>
							</tr>
							<tr style="border: 1px solid #e8ded5;">
								<td style="text-align: center; width: 50%; padding: 0 5px 0 15px; border: 1px solid #e8ded5;"><?=count($buf['vnytr'])?></td>
								<td style="text-align: center; width: 50%; padding: 0 5px 0 15px; border: 1px solid #e8ded5;"><?=count($buf['vnesh'])?></td>
							</tr>
						</table>
					</td>
					<td style="width: 50%;">
						<h4 style="text-align: center;"><b><?=$arr_info['links_follow_nofollow'][200].': '?></b></h4>
						<?php
						if (is_file(DIR.DIR_SEPARATOR.$buf_img['grafica_nofollow_vs_follow'])) {
						?>
							<img src="<?=DIR.DIR_SEPARATOR.$buf_img['grafica_nofollow_vs_follow']?>" style="background-color: transparent; border: none; width: 95%">
						<?php
						}
						?>
						<table style="width: 90%; border-collapse: collapse;">
							<tr style="border: 1px solid #e8ded5;">
								<td style="text-align: center; width: 50%; padding: 0 5px 0 15px; border: 1px solid #e8ded5;"><b><?=$arr_info['links_nofollow'][300]?></b></td>
								<td style="text-align: center; width: 50%; padding: 0 5px 0 15px; border: 1px solid #e8ded5;"><b><?=$arr_info['links_follow'][300]?></b></td>
							</tr>
							<tr style="border: 1px solid #e8ded5;">
								<td style="text-align: center; width: 50%; padding: 0 5px 0 15px; border: 1px solid #e8ded5;"><?=$nofollow?></td>
								<td style="text-align: center; width: 50%; padding: 0 5px 0 15px; border: 1px solid #e8ded5;"><?=$follow?></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			
			<?php
				if (count($buf['vnytr'])>0) {
					?>
					<hr style="margin: -2px 0 -15px 0; padding: -2px 0 -15px 0;">
					<h4><b><?=$arr_info['links_vnytr'][200].': '?></b></h4>
					<table style="width: 90%; border-collapse: collapse;">
						<?php
							for ($i=0; $i<count($buf['vnytr']); $i++) {
								?>
								<tr style="border: 1px solid #e8ded5;">
									<td style="padding: 0 5px 0 15px; border: 1px solid #e8ded5;"><a style="color: #444444;" href="<?=$buf['vnytr'][$i]['even_link']?>" target="_blank" rel="nofollow" title="<?=$buf['vnytr'][$i]['even_link']?>"><?=mb_strlen($buf['vnytr'][$i]['even_link'], 'utf-8')<45?$buf['vnytr'][$i]['even_link']:mb_substr($buf['vnytr'][$i]['even_link'],0,40,'utf-8').'...';?></a></td>
									<td style="padding: 0 5px 0 15px; border: 1px solid #e8ded5;"><i title="<?=$buf['vnytr'][$i]['text']?>"><?=mb_strlen($buf['vnytr'][$i]['text'], 'utf-8')<65?$buf['vnytr'][$i]['text']:mb_substr($buf['vnytr'][$i]['text'],0,60,'utf-8').'...';?></i></td>
								</tr>
								<?php
							}
						?>
					</table>
					<?php
				}
				if (count($buf['vnesh'])>0) {
					?>
					<hr style="margin: -2px 0 -15px 0; padding: -2px 0 -15px 0;">
					<h4><b><?=$arr_info['links_vnesh'][200].': '?></b></h4>
					<table style="width: 100%; border-collapse: collapse;">
						<?php
							for ($i=0; $i<count($buf['vnesh']); $i++) {
								?>
								<tr style="border: 1px solid #e8ded5;">
									<td style="padding: 0 5px 0 15px; border: 1px solid #e8ded5;"><a style="color: #444444;" href="<?=$buf['vnesh'][$i]['even_link']?>" target="_blank" rel="nofollow" title="<?=$buf['vnesh'][$i]['even_link']?>"><?=mb_strlen($buf['vnesh'][$i]['even_link'], 'utf-8')<45?$buf['vnesh'][$i]['even_link']:mb_substr($buf['vnesh'][$i]['even_link'],0,40,'utf-8').'...';?></a></td>
									<td style="padding: 0 5px 0 15px; border: 1px solid #e8ded5;"><i title="<?=$buf['vnesh'][$i]['text']?>"><?=mb_strlen($buf['vnesh'][$i]['text'], 'utf-8')<65?$buf['vnesh'][$i]['text']:mb_substr($buf['vnesh'][$i]['text'],0,60,'utf-8').'...';?></i></td>
								</tr>
								<?php
							}
						?>
					</table>
					<?php
				}
			?>
			<br>
		<?php
		}
		?>
</div>
</page>
		<!--- END LINK --->
		
		<!--- START IMG --->
		<?php
		$buf = unserialize ($arr_data['images']);
		if (is_array($buf) && count($buf)>0) {
		?>
<page backimg="<?=DIR.DIR_SEPARATOR.'template'.DIR_SEPARATOR?>code_0_pdf.jpg" backimgw="500%" style="font-family: freesans">
<div style="width: 100%;">
			<h3 style="text-align: center;"><b><?=$arr_info['img'][100]?></b></h3>
			<br>
			<table  style="width: 90%; border-collapse: collapse;">
			<?php
			for ($i=0; $i<count($buf); $i++) {
			?>
				<tr style="border: 1px solid #e8ded5;">
					<td style="padding: 0 5px 0 15px; border: 1px solid #e8ded5;"><a style="color: #444444;" href="<?=$buf[$i]['src'][1]?>" target="_blank" rel="nofollow"><span title="<?=$buf[$i]['src'][1]?>"><?=mb_strlen($buf[$i]['src'][1], 'utf-8')<45?$buf[$i]['src'][1]:mb_substr($buf[$i]['src'][1],0,40,'utf-8').'...';?></span></a></td>
					<td style="padding: 0 5px 0 15px; border: 1px solid #e8ded5;"><i title="<?=$buf[$i]['alt']?>"><?=mb_strlen($buf[$i]['alt'], 'utf-8')<65?$buf[$i]['alt']:mb_substr($buf[$i]['alt'],0,60,'utf-8').'...';?></i></td>
				</tr>
			<?php
			}
			?>
			</table>
</div>
</page>
		<?php
		}
		?>
		<!--- END IMG --->

		<!--- START STRUCTURA 4 --->
<page backimg="<?=DIR.DIR_SEPARATOR.'template'.DIR_SEPARATOR?>code_0_pdf.jpg" backimgw="500%" style="font-family: freesans">
<div style="width: 100%;">
		<?php
		$buf = unserialize ($arr_data['text_vs_html']);
		?>
		<h3 style="text-align: center;"><b><?=$arr_info['doc_struct'][100]?></b></h3>
		<br>
		<h4><b><?=$arr_info['doc_struct_text_vs_html'][200].': '?></b></h4>
		<table  style="width: 100%; border-collapse: collapse;">
			<tr>
				<td style="width: 34%; text-align: center; padding: 0 5px 0 15px; border: 1px solid #e8ded5;"><b><?=$arr_info['doc_struct_all_simbol'][300]?></b></td>
				<td style="width: 33%; text-align: center; padding: 0 5px 0 15px; border: 1px solid #e8ded5;"><b><?=$arr_info['doc_struct_clear_text'][300]?></b></td>
				<td style="width: 33%; text-align: center; padding: 0 5px 0 15px; border: 1px solid #e8ded5;"><b><?=$arr_info['doc_struct_persent_txt'][300]?></b></td>
			</tr>
			<tr>
				<td style="text-align: center; padding: 0 5px 0 15px; border: 1px solid #e8ded5;"><?=$buf['all_simbol']?></td>
				<td style="text-align: center; padding: 0 5px 0 15px; border: 1px solid #e8ded5;"><?=$buf['clear_text']?></td>
				<td style="text-align: center; padding: 0 5px 0 15px; border: 1px solid #e8ded5;"><?=$buf['persent_txt']?>%</td>
			</tr>
		</table>
		
		<?php
		$buf = unserialize ($arr_data['open_graph']);
		if (is_array($buf) && count($buf)>0) {
		?>
			<hr style="margin: -2px 0 -15px 0; padding: -2px 0 -15px 0;">
			<h4><b><?=$arr_info['doc_struct_open_graph'][200].': '?></b></h4>
			<table  style="width: 100%; border-collapse: collapse;">
			<?php
			//print_r($buf);
			foreach ($buf as $key=>$value) {
			?>
				<tr>
					<td style="width: 20%; padding: 0 5px 0 15px; border: 1px solid #e8ded5;"><?=$key?></td>
					<td style="width: 80%; padding: 0 5px 0 15px; border: 1px solid #e8ded5;"><i><?=$value?></i></td>
				</tr>
			<?php
			}
			?>
			</table>
		<?php
		}
		?>
		
		<?php
		if ($arr_data['html_version']!==false && $arr_data['html_version']!=='' && !is_null($arr_data['html_version'])) {
		?>
			<hr style="margin: -2px 0 -15px 0; padding: -2px 0 -15px 0;">
			<h4><b><?='HTML: '?></b><i><?=$arr_data['html_version']?></i></h4>
		<?php
		}
		?>
		
		<?php
		if ($arr_data['robots_txt']!==false && $arr_data['robots_txt']!=='' && !is_null($arr_data['robots_txt'])) {
		?>
			<hr style="margin: -2px 0 -15px 0; padding: -2px 0 -15px 0;">
			<h4><b><?='Robots.txt: '?></b><i><?=$arr_data['domain'].'/robots.txt'?></i></h4>
		<?php
		}
		?>
		
		<?php
		$buf = unserialize ($arr_data['site_map']);
		if (is_array($buf) && count($buf)>0) {
		?>
			<hr style="margin: -2px 0 -15px 0; padding: -2px 0 -15px 0;">
			<?php
			//print_r($buf);
			foreach ($buf as $key=>$value) {
			?>
			<h4><b><?='Sitemap.xml: '?></b><?=$key?></h4>
			<table  style="width: 100%; border-collapse: collapse;">
			<?php
				for ($i=0; $i<count($value); $i++) {
			?>
				<tr>
					<td style="text-align: center; padding: 0 5px 0 15px; border: 1px solid #e8ded5;"><?=($i+1)?></td>
					<td style="padding: 0 5px 0 15px; border: 1px solid #e8ded5;"><?=$value[$i]?></td>
				</tr>
				<?php
				}
				?>
			<?php
			}
			?>
		</table>
		<?php
		}
		?>
</div>
</page>
		<!--- END STRUCTURA --->

