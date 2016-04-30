<!DOCTYPE html>
<html lang="<?=$lang[0]?>">
	<head>
		<meta charset="UTF-8">
		<meta name="keywords" content="<?=$keywords?>" />
		<meta name="description" content="<?=$description?>" />
		<link rel="stylesheet" type="text/css" href="http://<?=DOMAIN?>/template/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="http://<?=DOMAIN?>/template/style.css">
		<title><?=$title?></title>
	</head>
	<body>
		<div class="container" id="zaglushka">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 align_center">
					<br><br><br><img src="http://<?=DOMAIN?>/template/253.gif" /><br><br><br>
				</div>
			</div>
		</div>
		<div class="container" id="base_content">		
			<div class="row" id="bazis_menu">
				<div class="col-xs-12 col-sm-1 col-md-2 col-lg-2"></div>
				<div class="col-xs-12 col-sm-10 col-md-8 col-lg-8">{{{BLOCK_0}}}</div>
				<div class="col-xs-12 col-sm-1 col-md-2 col-lg-2"></div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-1 col-md-2 col-lg-2"></div>
				<div class="col-xs-12 col-sm-10 col-md-8 col-lg-8">
					{{{BLOCK_1}}}
					{{{BLOCK_2}}}
					{{{BLOCK_3}}}
					{{{BLOCK_4}}}
					{{{BLOCK_5}}}
				</div>
				<div class="col-xs-12 col-sm-1 col-md-2 col-lg-2"></div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-1 col-md-2 col-lg-2"></div>
				<div class="col-xs-12 col-sm-10 col-md-8 col-lg-8 foother">
					© <?=DOMAIN?>
				</div>
				<div class="col-xs-12 col-sm-1 col-md-2 col-lg-2"></div>
			</div>
		</div>
		<script type="text/javascript" src="http://<?=DOMAIN?>/template/jquery-1.12.1.min.js"></script>
		<script type="text/javascript" src="http://<?=DOMAIN?>/template/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="http://<?=DOMAIN?>/template/script.js"></script>
	</body>
</html>