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
						<label>Nume</label>
						<input class="form-control" name="first_name" id="first_name" value="<?=htmlspecialchars($item['first_name'])?>">
					</div>
					<div class="form-group">
						<label>Prenume</label>
						<input class="form-control" name="last_name" id="last_name" value="<?=htmlspecialchars($item['last_name'])?>">
					</div>
					<div class="form-group">
						<label>Email</label>
						<input class="form-control" name="email" id="email" value="<?=htmlspecialchars($item['email'])?>">
					</div>
					<div class="form-group">
						<label>Nume de utilizator</label>
						<input class="form-control" name="username" id="username" value="<?=htmlspecialchars($item['username'])?>">
					</div>
					<div class="form-group">
						<label>Slug</label>
						<input class="form-control" name="slug" id="slug" value="<?=htmlspecialchars($item['slug'])?>">
					</div>
					<div class="form-group">
						<label>Parola</label>
						<input type="password" class="form-control" name="password" id="password" value="">
					</div>

					<div class="clear"></div>
					<?=$this->load->view('partial/images.php', array(
						'images' => $user_images,
						'endpoint' => base_url(array("admin.php", "users", "upload")),
						'delete' => base_url(array("admin.php", "users", "delete_image")),
						'folder' => 'users'
					), true)?>
					<div class="clear"></div>

					<?=lang_tabs($lang, 1)?>
					<div class="tab-content">
						<?php foreach($lang as $i=>$v) { ?>
							<div class="tab-pane fade in <?=($i == 0 ? 'active' : '')?>" id="<?=$v['id']?>1">
								<div class="form-group">
									<label>Description</label>
									<textarea class="form-control" name="description[<?=$v['id']?>]" id="description[<?=$v['id']?>]" style="height: 250px;"><?=htmlspecialchars($item['description'][$v['id']])?></textarea>
								</div>

								<script type='text/javascript'>
									CKEDITOR.replace('description[<?=$v['id']?>]',
										{
											filebrowserBrowseUrl : '<?=$this->config->item('base_url')?>resources/admin/ckeditor/ckfinder/ckfinder.html',
											filebrowserImageBrowseUrl : '<?=$this->config->item('base_url')?>resources/admin/ckeditor/ckfinder/ckfinder.html?Type=Images',
											filebrowserFlashBrowseUrl : '<?=$this->config->item('base_url')?>resources/admin/ckeditor/ckfinder/ckfinder.html?Type=Flash',
											filebrowserUploadUrl : '<?=$this->config->item('base_url')?>resources/admin/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
											filebrowserImageUploadUrl : '<?=$this->config->item('base_url')?>resources/admin/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
											filebrowserFlashUploadUrl : '<?=$this->config->item('base_url')?>resources/admin/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
											enterMode : CKEDITOR.ENTER_DIV,
											toolbarStartupExpanded : true,
											height : 350,
											SkinPath : '<?=$this->config->item('base_url')?>resources/admin/ckeditor/ckeditor/skins/kama/'
										});
								</script>
							</div>
						<?php } ?>
						</div>
					</div>

					<div class="form-group">
						<div style="float: left; width: 50px;"><label>Public</label></div>
						<div style="float: left; margin-left: 30px;"><input type="radio" name="active" id="active_yes" value="1" <?=($item['active'] == 1 ? "checked" : "")?> > <label for="enabled_yes">da</label></div>
						<div style="float: left; margin-left: 30px;"><input type="radio" name="active" id="active_no" value="0" <?=($item['active'] == 0 ? "checked" : "")?> > <label for="enabled_no">nu</label></div>
					</div>
					<div class="clear"></div>
					<br/>
					<a href="<?=base_url(array("admin.php", "users"));?>" class="btn btn-outline btn-primary">Înapoi</a>
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

set_seo("first_name", "slug");
</script>