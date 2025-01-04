<script type="text/javascript" src="<?=$this->config->item('base_url')?>resources/admin/ckeditor/ckeditor/ckeditor.js"></script>

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
						<?=lang_tabs($lang, 1)?>
						<div class="tab-content">
							<?php foreach($lang as $i=>$v) { ?>
								<div class="tab-pane fade in <?=($i == 0 ? 'active' : '')?>" id="<?=$v['id']?>1">
									<div class="form-group">
										<label>Title</label>
										<input class="form-control" name="title[<?=$v['id']?>]" id="title[<?=$v['id']?>]" value="<?=htmlspecialchars($item['title'][$v['id']])?>">
									</div>

									<div class="form-group">
										<label>Content</label>
										<textarea class="form-control" name="content[<?=$v['id']?>]" id="content[<?=$v['id']?>]" style="height: 250px;"><?=htmlspecialchars($item['content'][$v['id']])?></textarea>
									</div>

									<script type='text/javascript'>
										CKEDITOR.replace('content[<?=$v['id']?>]',
											{
												filebrowserBrowseUrl : '<?=$this->config->item('base_url')?>resources/admin/ckeditor/ckfinder/ckfinder.html',
												filebrowserImageBrowseUrl : '<?=$this->config->item('base_url')?>resources/admin/ckeditor/ckfinder/ckfinder.html?Type=Images',
												filebrowserFlashBrowseUrl : '<?=$this->config->item('base_url')?>resources/admin/ckeditor/ckfinder/ckfinder.html?Type=Flash',
												filebrowserUploadUrl : '<?=$this->config->item('base_url')?>resources/admin/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
												filebrowserImageUploadUrl : '<?=$this->config->item('base_url')?>resources/admin/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
												filebrowserFlashUploadUrl : '<?=$this->config->item('base_url')?>resources/admin/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
												enterMode : CKEDITOR.ENTER_DIV,
												toolbarStartupExpanded : true,
												height : 500,
												SkinPath : '<?=$this->config->item('base_url')?>resources/admin/ckeditor/ckeditor/skins/kama/'
											});
									</script>

								</div>
							<?php } ?>
						</div>
					</div>

					<div class="form-group">
						<label>URL</label>
						<input class="form-control" name="url" id="url" value="<?=htmlspecialchars($item['url'])?>">
					</div>

					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title" id="seo_link" style="cursor: pointer;">Elemente SEO <span class="glyphicon glyphicon-chevron-down" style="font-size: 10px;"></span></h3>
						</div>
						<div class="panel-body" id="seo" style="display: none;">
							<div class="form-group">
								<label>Meta title</label>
								<input class="form-control" name="seo_title" id="seo_title" value="<?=htmlspecialchars($item['seo_title'])?>">
							</div>
							<div class="form-group">
								<label>Meta description</label>
								<input class="form-control" name="seo_description" id="seo_description" value="<?=htmlspecialchars($item['seo_description'])?>">
							</div>
							<div class="form-group">
								<label>Meta keywords</label>
								<input class="form-control" name="seo_keywords" id="seo_keywords" value="<?=htmlspecialchars($item['seo_keywords'])?>">
							</div>
						</div>
					</div>

					<div class="form-group">
						<label>Ordine</label>
						<input class="form-control" name="order" id="order" value="<?=htmlspecialchars($item['order'])?>" style="width: 80px;">
					</div>

					<?php /*
					<div class="form-group">
						<label>Tip pagina</label>
						<select name="type" id="type" class="form-control" style="width: 300px;">
							<option value="">- selectează categoria -</option>
							<option value="ghid" <?=($item['type'] == 'ghid' ? 'selected="selected"' : '') ?>>Ghizi</option>
							<option value="contact" <?=($item['type'] == 'contact' ? 'selected="selected"' : '') ?>>Pagina contact</option>
						</select>
					</div>
					*/ ?>

					<div class="clear"></div>
					<div class="form-group">
						<div style="float: left; width: 60px;"><label>Public</label></div>
						<div style="float: left; margin-left: 30px;"><input type="radio" name="enabled" id="enabled_yes" value="1" <?=($item['enabled'] == 1 ? "checked" : "")?> > <label for="enabled_yes">da</label></div>
						<div style="float: left; margin-left: 30px;"><input type="radio" name="enabled" id="enabled_no" value="0" <?=($item['enabled'] == 0 ? "checked" : "")?> > <label for="enabled_no">nu</label></div>
					</div>

					<div class="clear"></div>
					<br/>
					<a href="<?=base_url(array("admin.php", "pages"));?>" class="btn btn-outline btn-primary">Înapoi</a>
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

$("#seo_link").click(function() {
		$("#seo_link").children().removeClass("glyphicon-chevron-down");
		$("#seo_link").children().removeClass("glyphicon-chevron-up");
		if($("#seo").css("display") == "none") {
			$("#seo").slideDown();
			$("#seo_link").children().addClass("glyphicon-chevron-up");
		}
		else {
			$("#seo").slideUp();
			$("#seo_link").children().addClass("glyphicon-chevron-down");
		}
});

set_seo("title[<?=$lang[0]['id']?>]", "url");
</script>