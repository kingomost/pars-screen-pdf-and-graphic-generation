<div class="form_analysis">
	<form action="http://<?=DOMAIN?>/analysis" method="post">
		<input type="hidden" name="lang" value="<?=$lang[0]?>">
		<div class="input-group" id="domain_group">
		  <input class="form-control" type="url" name="domain" placeholder="http://domain.com">
	<!--                  <input type="text" class="form-control" placeholder="site..." disabled="disabled">-->
		  <span class="input-group-btn">
			<button class="btn btn-default" type="submit" id="domain_button" onClick="return analyzer();">
	<!--                    <button class="btn btn-default" type="button"  disabled="disabled">-->
				<span id="start_analize" class="glyphicon glyphicon-search" aria-hidden="true"></span>
			</button>
		  </span>
		</div>
	</form>
	
</div>