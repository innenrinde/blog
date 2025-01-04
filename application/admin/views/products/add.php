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
					
					<div class='col-sm-8'>
						<div class="form-group">
							<label>Denumire</label>
							<input class="form-control" name="name" id="name" value="<?=htmlspecialchars($item['name'])?>">
						</div>
					</div>
					<div class='col-sm-2'>
						<div class="form-group">
							<label>Greutate</label>
							<input class="form-control" name="weight" id="weight" value="<?=htmlspecialchars($item['weight'])?>">
						</div>
					</div>
					<div class='col-sm-2'>
						<div class="form-group">
							<label>Greutate UM</label>
							<input class="form-control" name="weight_unit" id="weight_unit" value="<?=htmlspecialchars($item['weight_unit'])?>">
						</div>
					</div>
					
					<div class='col-sm-2'>
						<div class="form-group">
							<label>Cod</label>
							<input class="form-control" name="code" id="code" value="<?=htmlspecialchars($item['code'])?>">
						</div>
					</div>
					<div class='col-sm-2'>
						<div class="form-group">
							<label>Preţ</label>
							<input class="form-control" name="price" id="price" value="<?=htmlspecialchars($item['price'])?>">
						</div>
					</div>
					<div class='col-sm-2'>
						<div class="form-group">
							<label>Preţ redus</label>
							<input class="form-control" name="price_promo" id="price_promo" value="<?=htmlspecialchars($item['price_promo'])?>">
						</div>
					</div>
					<div class='col-sm-2'>
						<div class="form-group">
							<label>TVA (%)</label>
							<input class="form-control" name="tva" id="tva" value="<?=htmlspecialchars($item['tva'])?>">
						</div>
					</div>
					<div class='col-sm-2'>
						<div class="form-group">
							<label>Monedă</label>
							<input class="form-control" name="currency" id="currency" value="<?=htmlspecialchars($item['currency'])?>">
						</div>
					</div>
					
					<div class='col-sm-12'>
						<div class="form-group">
							<label>Proprietăţi</label>
							<ul>
							<?php foreach($properties as $i=>$v) { ?>
								<li class='col-sm-3'><input type="checkbox" name="property[<?=$v['id']?>]" id="property[<?=$v['id']?>]" value="<?=$v['id']?>" <?=(in_array($v['id'], $selected_properties) ? "checked" : "")?> > <?=str_replace("<br/>", " ", $v['name'])?></li>
							<?php } ?>
							</ul>
						</div>
					</div>
					
					<div class="clear"></div>
					
					<div class='col-sm-12'>
						<div class="form-group">
							<label>Listă de proprietăţi personalizate</label>
							<textarea class="form-control" name="properties" id="properties" style="height: 200px;"><?=htmlspecialchars($item['properties'])?></textarea>
						</div>
					</div>
					
					<div class='col-sm-12'>
						<div class="form-group">
							<label>Descriere</label>
							<textarea class="form-control" name="description" id="description" style="height: 200px;"><?=htmlspecialchars($item['description'])?></textarea>
						</div>
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
							height : 400,
							SkinPath : '<?=$this->config->item('base_url')?>ckeditor/ckeditor/skins/kama/'
						});
					</script>
					
					<div class='col-sm-12'>
						<div class="form-group">
							<label>Termeni şi condiţii de utilizare</label>
							<textarea class="form-control" name="terms_and_conditions" id="terms_and_conditions" style="height: 200px;"><?=htmlspecialchars($item['terms_and_conditions'])?></textarea>
						</div>
					</div>
					
					<script type='text/javascript'>
						CKEDITOR.replace('terms_and_conditions',
						{
							filebrowserBrowseUrl : '<?=$this->config->item('base_url')?>ckeditor/ckfinder/ckfinder.html',
							filebrowserImageBrowseUrl : '<?=$this->config->item('base_url')?>ckeditor/ckfinder/ckfinder.html?Type=Images',
							filebrowserFlashBrowseUrl : '<?=$this->config->item('base_url')?>ckeditor/ckfinder/ckfinder.html?Type=Flash',
							filebrowserUploadUrl : '<?=$this->config->item('base_url')?>ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
							filebrowserImageUploadUrl : '<?=$this->config->item('base_url')?>ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
							filebrowserFlashUploadUrl : '<?=$this->config->item('base_url')?>ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
							enterMode : CKEDITOR.ENTER_DIV,
							toolbarStartupExpanded : true,
							height : 200,
							SkinPath : '<?=$this->config->item('base_url')?>ckeditor/ckeditor/skins/kama/'
						});
					</script>
					
					<div class='col-sm-12'>
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
                                        <img src="<?=$this->config->item('base_url')?>files/products/thumb/<?=$item['image_file']?>" title="<?=htmlspecialchars($item['image_title'])?>" id="image_file" style="cursor: pointer;">
                                        <script>
                                            $("#image_file").click(function() {
                                                    var base_url = "<?=$this->config->item('base_url')?>files/products/";
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
					</div>
					
					<div class='col-sm-12'>
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
					</div>
					
					<div class='col-sm-12'>
						<div class="form-group">
							<label>Link Youtube</label>
							<input class="form-control" name="youtube" id="youtube" value="<?=htmlspecialchars($item['youtube'])?>">
						</div>
					</div>
					
					<div class='col-sm-12'>
						<div class="form-group">
							<label>Categorii</label>
							<ul><?=$categories?></ul>
						</div>
					</div>
					
					<div class="clear"></div>
					
					<div class='col-sm-12'>
						<div class="form-group">
							<label>Etichete</label>
							<ul>
							<?php foreach($labels as $i=>$v) { ?>
								<li class='col-sm-12'><input type="checkbox" name="label[<?=$v['id']?>]" id="label[<?=$v['id']?>]" value="<?=$v['id']?>" <?=(in_array($v['id'], $selected_labels) ? "checked" : "")?> > <label for="label[<?=$v['id']?>]" class="fa fa-circle" style="color: <?=$v['color']?>;" title="<?=$v['title']?>"></label> <?=$v['title']?></li>
							<?php } ?>
							</ul>
						</div>
					</div>
					
					<div class="clear"></div>
					
					<div class='col-sm-4'>
						<div class="form-group">
							<div style="float: left; width: 50px;"><label>Promovat</label></div>
							<div style="float: left; margin-left: 30px;"><input type="radio" name="promoted" id="promoted_yes" value="1" <?=($item['promoted'] == 1 ? "checked" : "")?> > <label for="promoted_yes">da</label></div>
							<div style="float: left; margin-left: 30px;"><input type="radio" name="promoted" id="promoted_no" value="0" <?=($item['promoted'] == 0 ? "checked" : "")?> > <label for="promoted_no">nu</label></div>
						</div>
					</div>
					
					<div class="clear"></div>
					
					<div class='col-sm-4'>
						<div class="form-group">
							<div style="float: left; width: 50px;"><label>Public</label></div>
							<div style="float: left; margin-left: 30px;"><input type="radio" name="enabled" id="enabled_yes" value="1" <?=($item['enabled'] == 1 ? "checked" : "")?> > <label for="enabled_yes">da</label></div>
							<div style="float: left; margin-left: 30px;"><input type="radio" name="enabled" id="enabled_no" value="0" <?=($item['enabled'] == 0 ? "checked" : "")?> > <label for="enabled_no">nu</label></div>
						</div>
					</div>
					
					<div class="clear"></div>
					<br/>
					<a href="<?=base_url(array("admin.php", "products"));?>" class="btn btn-outline btn-primary">Înapoi</a>
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

set_seo("name", "url");

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
</script>