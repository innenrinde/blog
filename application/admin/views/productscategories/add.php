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
						<label>Categorie parinte</label>
						<select class="form-control" name="id_parent" id="id_parent">
							<option value="0">- categorie principala -</option>
							<?php foreach($categories as $i=>$v) { ?>
								<option value="<?=$v['id']?>" <?=($v['id'] == $item['id_parent'] ? "selected" : "")?> ><?=htmlspecialchars($v['name'])?></option>
								<?php if(sizeof($v['childs']) > 0) { ?>
									<?php foreach($v['childs'] as $ii=>$vv) { ?>
										<option value="<?=$vv['id']?>" <?=($vv['id'] == $item['id_news_category'] ? "selected" : "")?> >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=htmlspecialchars($vv['title'])?></option>
									<?php } ?>
								<?php } ?>
							<?php } ?>
						</select>
					</div>
					
					<div class="form-group">
						<label>Denumire</label>
						<input class="form-control" name="name" id="name" value="<?=htmlspecialchars($item['name'])?>">
					</div>
					<div class="form-group">
						<label>URL</label>
						<input class="form-control" name="url" id="url" value="<?=htmlspecialchars($item['url'])?>">
					</div>
					<div class="form-group">
						<label>Ordine</label>
						<input class="form-control" name="order" id="order" value="<?=htmlspecialchars($item['order'])?>" style="width: 100px;">
					</div>
					<div class="clear"></div>
					<div class="form-group">
						<div style="float: left; width: 50px;"><label>Public</label></div>
						<div style="float: left; margin-left: 30px;"><input type="radio" name="enabled" id="enabled_yes" value="1" <?=($item['enabled'] == 1 ? "checked" : "")?> > <label for="enabled_yes">da</label></div>
						<div style="float: left; margin-left: 30px;"><input type="radio" name="enabled" id="enabled_no" value="0" <?=($item['enabled'] == 0 ? "checked" : "")?> > <label for="enabled_no">nu</label></div>
					</div>
					<div class="clear"></div>
					<a href="<?=base_url(array("admin.php", "productscategories"));?>" class="btn btn-outline btn-primary">Înapoi</a>
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

<script>
set_seo("title", "url");
</script>