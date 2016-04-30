<div class="info_group">

	<!--- START CONTENT --->
	<div class="panel panel-default border_for_div">
		<div class="block_acc_link">
			<a data-toggle="collapse" href="#collaps_0" aria-expanded="false" aria-controls="collaps_0">
				<?=$arr_info['contents'][100]?>
			</a>
		</div>
		<div class="collapse" id="collaps_0">
			<br>
			<h4><b><?=$arr_info['contents_title'][200].': '?></b><i><?=(is_string($arr_data['title']) && $arr_data['title']!=='')?$arr_data['title']:'---'?></i></h4>
			<hr>
			<h4><b><?=$arr_info['contents_keywords'][200].': '?></b><i><?=(is_string($arr_data['keywords']) && $arr_data['keywords']!=='')?$arr_data['keywords']:'---'?></i></h4>
			<hr>
			<h4><b><?=$arr_info['contents_description'][200].': '?></b><i><?=(is_string($arr_data['description']) && $arr_data['description']!=='')?$arr_data['description']:'---'?></i></h4>
			<?php
				$buf = unserialize ($arr_data['headings']);
				if (is_array($buf) && count($buf)>0) {
			?>
				<hr>
				<h4><b><?=$arr_info['contents_headings'][200].': '?></b></h4>
				<table>
				<?php
				foreach ($buf as $key=>$value) {
					if (mb_strlen(trim($key), 'utf-8')>5) {
				?>
						<tr><td><b><?=$value?></b></td><td><i><?=$key?></i></td></tr>
				<?php
					}
				}
				?>
				</table>
				<br>
			<?php
			}
			?>
		</div>
	</div>
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
		<div class="panel panel-default border_for_div">
			<div class="block_acc_link">
				<a data-toggle="collapse" href="#collaps_3" aria-expanded="false" aria-controls="collaps_3">
					<?=$arr_info['frequency'][100]?>
				</a>
			</div>
			<div class="collapse" id="collaps_3">
				<br>
				<table>
					<tr>
						<td style="width: 50%;"><b><?=$arr_info['frequency_words'][300]?></b></td>
						<td style="width: 25%; text-align: center;"><b><?=$arr_info['frequency_text'][300]?></b></td>
						<td style="width: 25%; text-align: center;"><b><?=$arr_info['frequency_meta'][300]?></b></td>
					</tr>
				<?php
				for ($i=0; $i<count($buf); $i++) {
					?>
					<tr>
						<td><i><?=$buf[$i]['words']?></i></td>
						<td style="text-align: center;"><?=$buf[$i]['visible']?$buf[$i]['visible']:'---'?></td>
						<td style="text-align: center;"><?=$buf[$i]['no_visible']?$buf[$i]['no_visible']:'---'?></td>
					</tr>
					<?php
				}
				?>
				</table>
				<br>
			</div>
		</div>
		<?php
	}
	?>
	<!--- END FREQUENCY WORD --->
	
	<!--- START LINK --->
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
		<div class="panel panel-default border_for_div">
			<div class="block_acc_link">
				<a data-toggle="collapse" href="#collaps_1" aria-expanded="false" aria-controls="collaps_1">
					<?=$arr_info['links'][100]?>
				</a>
			</div>
			<div class="collapse" id="collaps_1">
				<br>
				
				<div style="width: 45%; float: left; text-align: center;">
					<h4><b><?=$arr_info['links_vnesh_vnytr'][200].': '?></b></h4>
					<?php
					if (is_file(DIR.DIR_SEPARATOR.$buf_img['grafica_vnytr_vs_vnesh'])) {
					?>
						<img src="http://<?=DOMAIN?>/<?=$buf_img['grafica_vnytr_vs_vnesh']?>" style="background-color: transparent; border: none; width: 100%; cursor: pointer;" data-toggle="modal" data-target="#grafica_vnytr_vs_vnesh">
						<div id="grafica_vnytr_vs_vnesh" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<img src="http://<?=DOMAIN?>/<?=$buf_img['grafica_vnytr_vs_vnesh']?>" width="100%" height="auto">
								</div>
							</div>
						</div>
					<?php
					}
					?>
					<table>
						<tr><td><b><?=$arr_info['links_vnytr'][300]?></b></td><td><b><?=$arr_info['links_vnesh'][300]?></b></td></tr>
						<tr><td><?=count($buf['vnytr'])?></td><td><?=count($buf['vnesh'])?></td></tr>
					</table>
				</div>
				
				<div style="width: 45%; float: right; text-align: center;">
					<h4><b><?=$arr_info['links_follow_nofollow'][200].': '?></b></h4>
					<?php
					if (is_file(DIR.DIR_SEPARATOR.$buf_img['grafica_nofollow_vs_follow'])) {
					?>
						<img src="http://<?=DOMAIN?>/<?=$buf_img['grafica_nofollow_vs_follow']?>" style="background-color: transparent; border: none; width: 100%; cursor: pointer;" data-toggle="modal" data-target="#grafica_nofollow_vs_follow">
						<div id="grafica_nofollow_vs_follow" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<img src="http://<?=DOMAIN?>/<?=$buf_img['grafica_nofollow_vs_follow']?>" width="100%" height="auto">
								</div>
							</div>
						</div>
					<?php
					}
					?>
					<table>
						<tr><td><b><?=$arr_info['links_nofollow'][300]?></b></td><td><b><?=$arr_info['links_follow'][300]?></b></td></tr>
						<tr><td><?=$nofollow?></td><td><?=$follow?></td></tr>
					</table>
				</div>
				
				<div style="clear: both;"></div>
				<?php
					if (count($buf['vnytr'])>0) {
						?>
						<hr>
						<h4><b><?=$arr_info['links_vnytr'][200].': '?></b></h4>
						<table>
							<?php
								for ($i=0; $i<count($buf['vnytr']); $i++) {
									?>
									<tr>
										<td><a href="<?=$buf['vnytr'][$i]['even_link']?>" target="_blank" rel="nofollow" title="<?=$buf['vnytr'][$i]['even_link']?>"><?=mb_strlen($buf['vnytr'][$i]['even_link'], 'utf-8')<45?$buf['vnytr'][$i]['even_link']:mb_substr($buf['vnytr'][$i]['even_link'],0,40,'utf-8').'...';?></a></td>
										<td><i title="<?=$buf['vnytr'][$i]['text']?>"><?=mb_strlen($buf['vnytr'][$i]['text'], 'utf-8')<65?$buf['vnytr'][$i]['text']:mb_substr($buf['vnytr'][$i]['text'],0,60,'utf-8').'...';?></i></td>
									</tr>
									<?php
								}
							?>
						</table>
						<?php
					}
					if (count($buf['vnesh'])>0) {
						?>
						<hr>
						<h4><b><?=$arr_info['links_vnesh'][200].': '?></b></h4>
						<table>
							<?php
								for ($i=0; $i<count($buf['vnesh']); $i++) {
									?>
									<tr>
										<td><a href="<?=$buf['vnesh'][$i]['even_link']?>" target="_blank" rel="nofollow" title="<?=$buf['vnesh'][$i]['even_link']?>"><?=mb_strlen($buf['vnesh'][$i]['even_link'], 'utf-8')<45?$buf['vnesh'][$i]['even_link']:mb_substr($buf['vnesh'][$i]['even_link'],0,40,'utf-8').'...';?></a></td>
										<td><i title="<?=$buf['vnesh'][$i]['text']?>"><?=mb_strlen($buf['vnesh'][$i]['text'], 'utf-8')<65?$buf['vnesh'][$i]['text']:mb_substr($buf['vnesh'][$i]['text'],0,60,'utf-8').'...';?></i></td>
									</tr>
									<?php
								}
							?>
						</table>
						<?php
					}
				?>
				<br>
			</div>
		</div>
	<?php
	}
	?>
	<!--- END LINK --->
	
	<!--- START IMG --->
	<?php
	$buf = unserialize ($arr_data['images']);
	if (is_array($buf) && count($buf)>0) {
		?>
		<div class="panel panel-default border_for_div">
			<div class="block_acc_link">
				<a data-toggle="collapse" href="#collaps_2" aria-expanded="false" aria-controls="collaps_2">
					<?=$arr_info['img'][100]?>
				</a>
			</div>
			<div class="collapse" id="collaps_2">
				<br>
				<table>
				<?php
				for ($i=0; $i<count($buf); $i++) {
					?>
					<tr>
						<td><span title="<?=$buf[$i]['src'][1]?>"><?=mb_strlen($buf[$i]['src'][1], 'utf-8')<45?$buf[$i]['src'][1]:mb_substr($buf[$i]['src'][1],0,40,'utf-8').'...';?></span></td>
						<td><i title="<?=$buf[$i]['alt']?>"><?=mb_strlen($buf[$i]['alt'], 'utf-8')<65?$buf[$i]['alt']:mb_substr($buf[$i]['alt'],0,60,'utf-8').'...';?></i></td>
						<td><span class="glyphicon glyphicon-camera" aria-hidden="true" style="margin-right: 10px; cursor: pointer;" data-toggle="modal" data-target="#img_with_site_<?=$i?>"></span></td>
					</tr>
					<div id="img_with_site_<?=$i?>" class="modal fade bs-example-modal-xs" tabindex="-1" role="dialog">
						<div class="modal-dialog modal-xs">
							<div class="modal-content">
								<img src="<?=$buf[$i]['src'][1]?>" width="100%" height="auto">
							</div>
						</div>
					</div>
					<?php
				}
				?>
				</table>
				<br>
			</div>
		</div>
		<?php
	}
	?>
	<!--- END IMG --->
	
	<!--- START STRUCTURA 4 --->
	<?php
	$buf = unserialize ($arr_data['text_vs_html']);
	?>
	<div class="panel panel-default border_for_div">
		<div class="block_acc_link">
			<a data-toggle="collapse" href="#collaps_4" aria-expanded="false" aria-controls="collaps_4">
				<?=$arr_info['doc_struct'][100]?>
			</a>
		</div>
		<div class="collapse" id="collaps_4">
			<br>
			<h4><b><?=$arr_info['doc_struct_text_vs_html'][200].': '?></b></h4>
			<table>
				<tr>
					<td style="width: 34%; text-align: center;"><b><?=$arr_info['doc_struct_all_simbol'][300]?></b></td>
					<td style="width: 33%; text-align: center;"><b><?=$arr_info['doc_struct_clear_text'][300]?></b></td>
					<td style="width: 33%; text-align: center;"><b><?=$arr_info['doc_struct_persent_txt'][300]?></b></td>
				</tr>
				<tr>
					<td style="text-align: center;"><?=$buf['all_simbol']?></td>
					<td style="text-align: center;"><?=$buf['clear_text']?></td>
					<td style="text-align: center;"><?=$buf['persent_txt']?>%</td>
				</tr>
			</table>
			
			<?php
			$buf = unserialize ($arr_data['open_graph']);
			if (is_array($buf) && count($buf)>0) {
			?>
				<hr>
				<h4><b><?=$arr_info['doc_struct_open_graph'][200].': '?></b></h4>
				<table>
				<?php
				//print_r($buf);
				foreach ($buf as $key=>$value) {
				?>
					<tr>
						<td><?=$key?></td>
						<td><?=$value?></td>
					</tr>
				<?php
				}
				?>
				</table>
			<?php
			}
			?>
			
			
			
			<?php
			$abcdfji = 1;
			?>
			
			<?php
			if ($arr_data['html_version']!==false && $arr_data['html_version']!=='' && !is_null($arr_data['html_version'])) {
			?>
				<hr>
				<h4><b><?='HTML: '?></b><i><?=$arr_data['html_version']?></i></h4>
			<?php
			}
			?>
			
			<?php
			if ($arr_data['robots_txt']!==false && $arr_data['robots_txt']!=='' && !is_null($arr_data['robots_txt'])) {
			?>
				<hr>
				<h4><b><?='Robots.txt: '?></b><i><?=$arr_data['domain'].'/robots.txt'?></i></h4>
			<?php
			}
			?>
			
			<?php
			$buf = unserialize ($arr_data['site_map']);
			if (is_array($buf) && count($buf)>0) {
			?>
				<hr>
				<h4><b><?='Sitemap.xml: '?></b></h4>
				<table>
				<?php
				//print_r($buf);
				foreach ($buf as $key=>$value) {
				?>
				<tr>
					<td style="text-align: center;" colspan="2"><b><?=$key?></b></td>
				</tr>
					<?php
					for ($i=0; $i<count($value); $i++) {
					?>
					<tr>
						<td style="text-align: center;"><?=($i+1)?></td>
						<td><?=$value[$i]?></td>
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
			
			<br>
		</div>
	</div>
	<!--- END STRUCTURA --->
	
	<!--- START PDF 5 --->
	<?php
	$buf = unserialize ($arr_data['pdf_doc']);
	if (is_array($buf) && count($buf)===3) {
	?>
	<div class="panel panel-default border_for_div">
		<div class="block_acc_link">
			<a data-toggle="collapse" href="#collaps_5" aria-expanded="false" aria-controls="collaps_5">
				<?=$arr_info['in_pdf'][100]?>
			</a>
		</div>
		<div class="collapse" id="collaps_5">
			<br>
			<table>
				<tr style="border: none;">
					<td style="width: 34%; text-align: center; border: none;">
						<b><?='PDF EN: '?></b>
						<a href="http://<?=DOMAIN?>/<?=$buf['en']?>" target="_blank" title="<?='INFO pdf version EN'?>"><span style="padding: 0 10px; color: #480607;" class="glyphicon glyphicon-open-file" aria-hidden="true"></span></a>
					</td>
					<td style="width: 33%; text-align: center; border: none;">
						<b><?='PDF RU: '?></b>
						<a href="http://<?=DOMAIN?>/<?=$buf['ru']?>" target="_blank" title="<?='INFO pdf version RU'?>"><span style="padding: 0 10px; color: #480607;" class="glyphicon glyphicon-open-file" aria-hidden="true"></span></a>
					</td>
					<td style="width: 33%; text-align: center; border: none;">
						<b><?='PDF FR: '?></b>
						<a href="http://<?=DOMAIN?>/<?=$buf['fr']?>" target="_blank" title="<?='INFO pdf version FR'?>"><span style="padding: 0 10px; color: #480607;" class="glyphicon glyphicon-open-file" aria-hidden="true"></span></a>
					</td>
				</tr>
			</table>
			<br>
		</div>
	</div>
	<?php
	}
	?>
	<!--- END PDF --->
	
	<!--- START GOOD LINK WITH PARAMETR 6 --->
	<!--- вебархив --->
	<!--- какие-нибудь позиции --->
	<!--- анализ --->
	<!--- и т.п. --->
	<?php
	$buf = unserialize ($arr_data['pdf_doc']);
	?>
	<div class="panel panel-default border_for_div">
		<div class="block_acc_link">
			<a data-toggle="collapse" href="#collaps_6" aria-expanded="false" aria-controls="collaps_6">
				<?=$arr_info['good_resurs'][100]?>
			</a>
		</div>
		<div class="collapse" id="collaps_6">
			<br>
			<table>
				<tr style="border: none;">
					<td style="width: 34%; text-align: center; border: none;">
						<b><?='w3.org: '?></b>
						<a href="https://validator.w3.org/nu/?doc=<?=urlencode($arr_data['domain'])?>" target="_blank" title="<?='w3.org'?>"><span style="padding: 0 10px; color: #480607;" class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
					</td>
					<td style="width: 33%; text-align: center; border: none;">
						<b><?='css-validator.org: '?></b>
						<a href="http://www.css-validator.org/validator?uri=<?=urlencode($arr_data['domain'])?>" target="_blank" title="<?='css-validator.org'?>"><span style="padding: 0 10px; color: #480607;" class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
					</td>
					<td style="width: 33%; text-align: center; border: none;">
						<b><?='archive.org: '?></b>
						<a href="https://web.archive.org/web/*/<?=$arr_data['domain']?>" target="_blank" title="<?='archive.org'?>"><span style="padding: 0 10px; color: #480607;" class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
					</td>
				</tr>
			</table>
			<br>
		</div>
	</div>
	<!--- END GOOD LINK WITH PARAMETR --->
	
</div>