<div id="page-wrapper">
	<br/>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading" style="height: 50px;">
					<?=$title?>
				</div>
				<form role="form" method="post">
				<!-- /.panel-heading -->
				<div class="panel-body">
					
					<br/>
					<?php echo validation_errors(); ?>
					
					<div class="form-group">
						<label>Nume</label>
						<input class="form-control" name="localitate" id="localitate" value="<?=htmlspecialchars($item['localitate'])?>">
					</div>
					<div class="form-group">
						<label>Judeţ</label>
						<select name="id_judet" id="id_judet" class="form-control select-mini">
							<option value="0">- selectează judeţul -</option>
							<?php foreach ($judete as $judet_item): ?>
								<option value="<?=htmlspecialchars($judet_item['id_judet'])?>" <?=($item['id_judet'] == $judet_item['id_judet'] ? "selected" : "")?> ><?=htmlspecialchars($judet_item['judet'])?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="form-group">
						<label>Regiune</label>
						<select name="id_region" id="id_region" class="form-control select-mini">
							<option value="0">- selectează regiunea -</option>
							<?php foreach ($regions as $region_item): ?>
								<option value="<?=htmlspecialchars($region_item['id'])?>" <?=($item['id_region'] == $region_item['id'] ? "selected" : "")?> ><?=htmlspecialchars($region_item['name'])?></option>
							<?php endforeach ?>
						</select>
					</div>
					
					<div class="clear"></div>
					<a href="<?=base_url(array("admin.php", "localities"));?>" class="btn btn-outline btn-primary">Înapoi</a>
					<input type="submit" class="btn btn-primary" value="Salvează">
					
				</div>
				</form>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-12 -->
	</div>
	
</div>
<!-- /#page-wrapper -->
