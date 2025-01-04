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
										<label>Subtitle</label>
										<input class="form-control" name="subtitle[<?=$v['id']?>]" id="subtitle[<?=$v['id']?>]" value="<?=htmlspecialchars($item['subtitle'][$v['id']])?>">
									</div>

									<div class="form-group">
										<label>Rezumat</label>
										<textarea class="form-control" name="content_short[<?=$v['id']?>]" id="content_short[<?=$v['id']?>]" style="height: 150px;"><?=htmlspecialchars($item['content_short'][$v['id']])?></textarea>
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
						<label>Categorie</label>
						<select class="form-control" name="id_parent" id="id_parent">
							<option value="0">- categorie principala -</option>
							<?php foreach($categories as $i=>$v) { ?>
								<option value="<?=$v['id']?>" <?=($v['id'] == $item['id_news_category'] ? "selected" : "")?> ><?=htmlspecialchars($v['title'])?></option>
								<?php if(isset($v['childs']) && sizeof($v['childs']) > 0) { ?>
									<?php foreach($v['childs'] as $ii=>$vv) { ?>
										<option value="<?=$vv['id']?>" <?=($vv['id'] == $item['id_news_category'] ? "selected" : "")?> >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=htmlspecialchars($vv['title'])?></option>
									<?php } ?>
								<?php } ?>
							<?php } ?>
						</select>
					</div>

					<div class="form-group">
						<label>Data</label>
						<div class='input-group date col-sm-3' id='datetimepicker1'>
							<input type='text' class="form-control" name="date" id="date" value="<?=htmlspecialchars($item['date'])?>" />
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>
					</div>

					<script type="text/javascript">
						$(function () {
							$('#datetimepicker1').datetimepicker({
								locale: 'ro'
							});
						});
					</script>

					<div class="clear"></div>
					<div class="form-group">
						<label>Etichete (separate prin virgulă)</label>
						<input class="form-control" name="labels" id="labels" value="<?=htmlspecialchars($item['labels'])?>">
					</div>

					<div class="clear"></div>

					<?=$this->load->view('partial/images.php', array(
						'images' => $news_images,
						'endpoint' => base_url(array("admin.php", "news", "upload")),
						'delete' => base_url(array("admin.php", "news", "delete_image")),
						'folder' => 'news'
					), true)?>

					<div class="clear"></div>

					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title" id="seo_link" style="cursor: pointer;">Elemente SEO <span class="glyphicon glyphicon-chevron-down" style="font-size: 10px;"></span></h3>
						</div>
						<div class="panel-body" id="seo" style="display: none;">
							<div class="form-group">
								<label>URL</label>
								<input class="form-control" name="url" id="url" value="<?=htmlspecialchars($item['url'])?>">
							</div>
							<div class="form-group">
								<label>Meta title (meta-ul din header, max 20 caractere)</label>
								<input class="form-control" name="seo_title" id="seo_title" value="<?=htmlspecialchars($item['seo_title'])?>">
							</div>
							<div class="form-group">
								<label>Meta description (max 165 caractere)</label>
								<input class="form-control" name="seo_description" id="seo_description" value="<?=htmlspecialchars($item['seo_description'])?>">
							</div>
							<div class="form-group">
								<label>Meta keywords (max 6 locutiuni de cuvinte despartite prin virgula)</label>
								<input class="form-control" name="seo_keywords" id="seo_keywords" value="<?=htmlspecialchars($item['seo_keywords'])?>">
							</div>
						</div>
					</div>
					<div class="clear"></div>
					<div class="form-group">
						<div style="float: left;"><label>Public</label></div>
						<div style="float: left; margin-left: 30px;"><input type="radio" name="enabled" id="enabled_yes" value="1" <?=($item['enabled'] == 1 ? "checked" : "")?> > <label for="enabled_yes">da</label></div>
						<div style="float: left; margin-left: 30px;"><input type="radio" name="enabled" id="enabled_no" value="0" <?=($item['enabled'] == 0 ? "checked" : "")?> > <label for="enabled_no">nu</label></div>
					</div>
					<div class="clear"></div>
					<div class="form-group">
						<label>Autor</label>
						<select name="id_user" id="id_user" class="form-control select-mini">
							<option value="0">- selectează autorul -</option>
							<?php foreach ($users as $user): ?>
								<option value="<?=htmlspecialchars($user['id'])?>" <?=($item['id_user'] == $user['id'] ? "selected" : "")?> ><?=htmlspecialchars($user['first_name']." ".$user['last_name'])?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="clear"></div>
					<a href="javascript:history.back();" class="btn btn-outline btn-primary">Înapoi</a>
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