<div id="page-wrapper">
	<br/>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading" style="height: 50px;">
					<?=$title?>
				</div>
				<form role="form" method="post" enctype="multipart/form-data">
				<!-- /.panel-heading -->
				<div class="panel-body">

					<br/>
					<?php echo validation_errors(); ?>

					<div class="form-group">
						<label>Categorie parinte</label>
						<select class="form-control" name="id_parent" id="id_parent">
							<option value="0">- categorie principala -</option>
							<?php foreach($categories as $i=>$v) { ?>
								<option value="<?=$v['id']?>" <?=($v['id'] == $item['id_parent'] ? "selected" : "")?> ><?=htmlspecialchars($v['title'])?></option>
							<?php } ?>
						</select>
					</div>

					<div class="form-group">
						<?=lang_tabs($lang, 1)?>
						<div class="tab-content">
							<?php foreach($lang as $i=>$v) { ?>
								<div class="tab-pane fade in <?=($i == 0 ? 'active' : '')?>" id="<?=$v['id']?>1">
									<div class="form-group">
										<label>Denumire</label>
										<input class="form-control" name="title[<?=$v['id']?>]" id="title[<?=$v['id']?>]" value="<?=htmlspecialchars($item['title'][$v['id']])?>">
									</div>
								</div>
							<?php } ?>
						</div>
					</div>


					<div class="form-group">
						<label>URL</label>
						<input class="form-control" name="url" id="url" value="<?=htmlspecialchars($item['url'])?>">
					</div>

					<div class="clear"></div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title" id="image_link" style="cursor: pointer;">Imagine <span class="glyphicon glyphicon-chevron-down" style="font-size: 10px;"></span></h3>
						</div>
						<div class="panel-body" id="image_div" style="display: <?=(strlen($item['image_file']) > 0 ? "" : "none")?>;">

						<div class="form-group">
							<table>
								<tr>
									<td><label>Selectează un fişier</label></td>
									<td style="padding-left: 10px;">
										<input type="file" name="image" id="image">
									</td>
									<?php if(strlen($item['image_file']) > 0) { ?>
									<td>
										<input type="checkbox" id="delete_image" name="delete_image" value="1"> <label for="delete_image" style="font-weight: normal;">şterge imaginea actuală</label>
									</td>
									<?php } ?>
								</tr>
							</table>
						</div>

						<table class="">
							<tr>
								<td rowspan="2" style="padding: 5px;">
								<?php if(strlen($item['image_file']) > 0) { ?>
									<img src="<?=$this->config->item('base_url')?>files/categories/thumb/<?=$item['image_file']?>" title="<?=htmlspecialchars($item['image_title'])?>" id="image_file" style="cursor: pointer;">
									<script>
										$("#image_file").click(function() {
												var base_url = "<?=$this->config->item('base_url')?>files/categories/";
												if(this.src == base_url + "thumb/<?=$item['image_file']?>") {
													this.src = base_url + "mediu/<?=$item['image_file']?>"
												}
												else {
													this.src = base_url + "thumb/<?=$item['image_file']?>"
												}
										});
									</script>
								<?php } ?>
								</td>
								<td style="padding: 5px;">
									Descriere foto:
								</td>
								<td style="padding: 5px;">
									<input type="text" name="image_name" id="image_name" value="<?=htmlspecialchars($item['image_name'])?>" style="width: 300px;" class="form-control">
								</td>
							</tr>
							<tr>
								<td style="padding: 5px;">
									Credit foto:
								</td>
								<td style="padding: 5px;">
									<input type="text" name="image_title" id="image_title" value="<?=htmlspecialchars($item['image_title'])?>" style="width: 300px;" class="form-control">
								</td>
							</tr>
						</table>
						</div>
					</div>

					<div class="clear"></div>
					<div class="form-group">
						<label>Ordine</label>
						<input class="form-control" name="order" id="order" value="<?=htmlspecialchars($item['order'])?>" style="width: 100px;">
					</div>
					<div class="clear"></div>
					<div class="form-group">
						<div style="float: left; width: 50px;"><label>Tip</label></div>
						<div style="float: left; margin-left: 30px;"><input type="radio" name="type" id="type_news" value="news" <?=($item['type'] == 'news' ? "checked" : "")?> > <label for="type_news">articole</label></div>
						<div style="float: left; margin-left: 30px;"><input type="radio" name="type" id="type_chart" value="chart" <?=($item['type'] == 'chart' ? "checked" : "")?> > <label for="type_chart">grafice</label></div>
					</div>
					<div class="clear"></div>
					<div class="clear"></div>
					<div class="form-group">
						<div style="float: left; width: 50px;"><label>Permite comentarii</label></div>
						<div style="float: left; margin-left: 30px;"><input type="radio" name="allow_comments" id="allow_comments_yes" value="1" <?=($item['allow_comments'] == '1' ? "checked" : "")?> > <label for="allow_comments_yes">da</label></div>
						<div style="float: left; margin-left: 30px;"><input type="radio" name="allow_comments" id="allow_comments_no" value="0" <?=($item['allow_comments'] == '0' ? "checked" : "")?> > <label for="allow_comments_no">nu</label></div>
					</div>
					<div class="clear"></div>
					<div class="form-group">
						<div style="float: left; width: 50px;"><label>Public</label></div>
						<div style="float: left; margin-left: 30px;"><input type="radio" name="enabled" id="enabled_yes" value="1" <?=($item['enabled'] == 1 ? "checked" : "")?> > <label for="enabled_yes">da</label></div>
						<div style="float: left; margin-left: 30px;"><input type="radio" name="enabled" id="enabled_no" value="0" <?=($item['enabled'] == 0 ? "checked" : "")?> > <label for="enabled_no">nu</label></div>
					</div>
					<div class="clear"></div>
					<a href="<?=base_url(array("admin.php", "newscategories"));?>" class="btn btn-outline btn-primary">Înapoi</a>
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
$("#image_link").click(function() {
		$("#image_link").children().removeClass("glyphicon-chevron-down");
		$("#image_link").children().removeClass("glyphicon-chevron-up");
		if($("#image_div").css("display") == "none") {
			$("#image_div").slideDown();
			$("#image_link").children().addClass("glyphicon-chevron-up");
		}
		else {
			$("#image_div").slideUp();
			$("#image_link").children().addClass("glyphicon-chevron-down");
		}
});

set_seo("title[<?=$lang[0]['id']?>]", "url");
</script>