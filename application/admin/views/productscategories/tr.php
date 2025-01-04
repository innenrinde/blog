<tr class="odd gradeX" id="tr<?=$id?>">
	<td style="padding-left: <?=($level*30)?>px;">
		<a href="<?=base_url(array("admin.php", "productscategories", "add", $id));?>" class="btn btn-link"><?=htmlspecialchars($name)?></a></td>
	</td>
	<td align="center"><?php if($enabled == 1) { ?><span class="glyphicon glyphicon-ok"></span><?php } else { ?>-<?php }?></td>
	<td align="center" nowrap>
		<a href="<?=base_url(array("admin.php", "productscategories", "add", $id));?>" class="btn btn-primary">Editează</a>
		<a href="javascript:;" rel="<?=htmlspecialchars($name)?>" id="del<?=$id?>" onclick="delete_record(<?=$id?>)" class="btn btn-danger">Şterge</a>
	</td>
</tr>