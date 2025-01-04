<div class="col-sm-1">
	<select name="<?=$name?>" class="form-control">
		<option value=""><?=htmlspecialchars($title)?></option>
		<?php foreach($values as $i=>$v) { ?>
		<option value="<?=$i?>" <?=(!is_null($value) && $value == $i ? 'selected' : '')?> ><?=htmlspecialchars($v)?></option>
		<?php } ?>
	</select>
</div>