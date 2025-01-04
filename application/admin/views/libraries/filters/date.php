<div class='input-group col-sm-2'>
	<div class='input-group date' id='datetimepicker<?=$name?>start'>
		<input type='text' class='form-control' name='f<?=$name?>start' value='<?=htmlspecialchars($value1)?>' placeholder='de la' />
		<span class='input-group-addon'>
			<span class='glyphicon glyphicon-calendar'></span>
		</span>
	</div>
</div>

<div class='input-group col-sm-2'>
	<div class='input-group date' id='datetimepicker<?=$name?>end'>
		<input type='text' class='form-control' name='f<?=$name?>end' value='<?=htmlspecialchars($value2)?>' placeholder='până la' />
		<span class='input-group-addon'>
			<span class='glyphicon glyphicon-calendar'></span>
		</span>
	</div>
</div>

<script type="text/javascript">
	$(function () {
		$("#datetimepicker<?=$name?>start").datetimepicker({
			locale: "ro"
		});
		$("#datetimepicker<?=$name?>end").datetimepicker({
			locale: "ro"
		});
	});
</script>