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
						<input class="form-control" name="name" id="name" value="<?=htmlspecialchars($item['name'])?>">
					</div>
					<div class="form-group">
						<label>Cod</label>
						<input class="form-control" name="code" id="code" value="<?=htmlspecialchars($item['code'])?>">
					</div>
					<div class="form-group">
						<label>Descriere</label>
						<textarea class="form-control" name="description" id="description" style="height: 200px;"><?=htmlspecialchars($item['description'])?></textarea>
					</div>
					
					
					<script type='text/javascript'>
						CKEDITOR.replace('description',
						{
							filebrowserBrowseUrl : '<?=$this->config->item('base_url')?>ckeditor/ckfinder/ckfinder.html',
							filebrowserImageBrowseUrl : '<?=$this->config->item('base_url')?>ckeditor/ckfinder/ckfinder.html?Type=Images',
							filebrowserFlashBrowseUrl : '<?=$this->config->item('base_url')?>ckeditor/ckfinder/ckfinder.html?Type=Flash',
							filebrowserUploadUrl : '<?=$this->config->item('base_url')?>ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
							filebrowserImageUploadUrl : '<?=$this->config->item('base_url')?>ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
							filebrowserFlashUploadUrl : '<?=$this->config->item('base_url')?>ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
							enterMode : CKEDITOR.ENTER_DIV,
							toolbarStartupExpanded : true,
							height : 300,
							SkinPath : '<?=$this->config->item('base_url')?>ckeditor/ckeditor/skins/kama/'
						});
					</script>
					
					
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
									<img src="<?=$this->config->item('base_url')?>files/countries/thumb/<?=$item['image_file']?>" title="<?=htmlspecialchars($item['image_title'])?>" id="image_file" style="cursor: pointer;">
									<script>
										$("#image_file").click(function() {
												var base_url = "<?=$this->config->item('base_url')?>files/countries/";
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
									Nume imagine
								</td>
								<td style="padding: 5px;">
									<input type="text" name="image_name" id="image_name" value="<?=htmlspecialchars($item['image_name'])?>" style="width: 300px;" class="form-control">
								</td>
							</tr>
							<tr>
								<td style="padding: 5px;">
									Titlu imagine
								</td>
								<td style="padding: 5px;">
									<input type="text" name="image_title" id="image_title" value="<?=htmlspecialchars($item['image_title'])?>" style="width: 300px;" class="form-control">
								</td>
							</tr>
						</table>
						</div>
					</div>
					
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title" id="seo_link" style="cursor: pointer;">Elemente SEO <span class="glyphicon glyphicon-chevron-down" style="font-size: 10px;"></span></h3>
						</div>
						<div class="panel-body" id="seo" style="display: none;">
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
						<div style="float: left; width: 50px;"><label>Public</label></div>
						<div style="float: left; margin-left: 30px;"><input type="radio" name="enabled" id="enabled_yes" value="1" <?=($item['enabled'] == 1 ? "checked" : "")?> > <label for="enabled_yes">da</label></div>
						<div style="float: left; margin-left: 30px;"><input type="radio" name="enabled" id="enabled_no" value="0" <?=($item['enabled'] == 0 ? "checked" : "")?> > <label for="enabled_no">nu</label></div>
					</div>
					<div class="clear"></div>
					<a href="<?=base_url(array("admin.php", "countries"));?>" class="btn btn-outline btn-primary">Înapoi</a>
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

</script>