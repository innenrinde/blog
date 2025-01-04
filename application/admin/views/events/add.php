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
						<label>Titlu</label>
						<input class="form-control" name="title" id="title" value="<?=htmlspecialchars($item['title'])?>">
					</div>
					<div class="form-group">
						<label>Ţara</label>
						<select name="id_country" id="id_country" class="form-control select-mini">
							<option value="0">- selectează ţara -</option>
							<?php foreach ($countries as $country_item): ?>
								<option value="<?=htmlspecialchars($country_item['id'])?>" <?=($item['id_country'] == $country_item['id'] ? "selected" : "")?> ><?=htmlspecialchars($country_item['name'])?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="form-group">
						<label>Regiune</label>
						<select id="id_region" name="id_region" class="form-control select-mini" data="<?=$item['id_region']?>">
							<option value="0">- selectează regiune -</option>
						</select>
					</div>
					<div class="form-group">
						<label>Localitate</label>
						<select id="id_locality" name="id_locality" class="form-control select-mini" data="<?=$item['id_locality']?>">
							<option value="0">- selectează localitate -</option>
						</select>
					</div>
					<div class="form-group">
						<label>Organizatori</label>
						<input class="form-control" name="organizers" id="organizers" value="<?=htmlspecialchars($item['organizers'])?>">
					</div>
                    <div class="form-group">
						<label>Taxa</label>
						<input class="form-control" name="taxevent" id="taxevent" value="<?=htmlspecialchars($item['taxevent'])?>">
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
									<img src="<?=$this->config->item('base_url')?>files/events/thumb/<?=$item['image_file']?>" title="<?=htmlspecialchars($item['image_title'])?>" id="image_file" style="cursor: pointer;">
									<script>
										$("#image_file").click(function() {
												var base_url = "<?=$this->config->item('base_url')?>files/events/";
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
						<label>Tip eveniment</label>
						<select name="type" id="type" class="form-control" style="width: 300px;">
							<option value="">- selectează categoria -</option>
							<?php foreach ($categories as $category_item): ?>
								<option value="<?=htmlspecialchars($category_item['id'])?>" <?=($item['type'] == $category_item['id'] ? "selected" : "")?> ><?=htmlspecialchars($category_item['title'])?></option>
							<?php endforeach ?>
						</select>
					</div>
					
					<div class="clear"></div>
					<div class="form-group">
						<div style="float: left; width: 60px;"><label>Recomandat</label></div>
						<div style="float: left; margin-left: 30px;"><input type="radio" name="featured" id="featured_enabled_yes" value="1" <?=($item['featured'] == 1 ? "checked" : "")?> > <label for="featured_enabled_yes">da</label></div>
						<div style="float: left; margin-left: 30px;"><input type="radio" name="featured" id="featured_enabled_no" value="0" <?=($item['featured'] == 0 ? "checked" : "")?> > <label for="featured_enabled_no">nu</label></div>
					</div>
					
					<div class="clear"></div>
					<div class="form-group">
						<div style="float: left; width: 60px;"><label>Public</label></div>
						<div style="float: left; margin-left: 30px;"><input type="radio" name="enabled" id="enabled_yes" value="1" <?=($item['enabled'] == 1 ? "checked" : "")?> > <label for="enabled_yes">da</label></div>
						<div style="float: left; margin-left: 30px;"><input type="radio" name="enabled" id="enabled_no" value="0" <?=($item['enabled'] == 0 ? "checked" : "")?> > <label for="enabled_no">nu</label></div>
					</div>
					
					<div class="clear"></div>
					<div class="form-group">
						<div style="float: left; width: 60px;"><label>Inscrire activata</label></div>
						<div style="float: left; margin-left: 30px;"><input type="radio" name="subscribe_enabled" id="subscribe_enabled_yes" value="1" <?=($item['subscribe_enabled'] == 1 ? "checked" : "")?> > <label for="subscribe_enabled_yes">da</label></div>
						<div style="float: left; margin-left: 30px;"><input type="radio" name="subscribe_enabled" id="subscribe_enabled_no" value="0" <?=($item['subscribe_enabled'] == 0 ? "checked" : "")?> > <label for="subscribe_enabled_no">nu</label></div>
					</div>
					
					<div class="clear"></div>
					<br/>
					<a href="<?=base_url(array("admin.php", "events"));?>" class="btn btn-outline btn-primary">Înapoi</a>
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

$("#id_country").change(function() {
	$id_region = $("#id_region")
	$id_region.html('');
	var html = '<option value="0"> selectează regiune -</option>';
	var cid = this.value;
	var selectedRegion = $id_region.attr("data");
	$.each(regions, function( index, region ) {
	  if (cid == region.id_country) {
	  	html += '<option value="' + region.id + '"' + (selectedRegion == region.id ? "selected" : '') + '>' + region.name + '</option>';
	  }
	});
	$id_region.html(html);
});

$("#id_region").change(function() {
	$locality = $("#id_locality");
	$locality.html('');
	var html = '<option value="0"> selectează localitate -</option>';
	var region_id = this.value;
	var selectedLocality = $locality.attr("data");
	$.each(localities, function( index, locality ) {
	  if (region_id == locality.id_region) {
	  	html += '<option value="' + locality.id_localitate + '"' + (selectedLocality == locality.id_localitate ? "selected" : '') + '>' + locality.localitate + '</option>';
	  }
	});
	$locality.html(html);
});

$(document).ready(function() {
	$("#id_country").change();
	$("#id_region").change();
});

var regions = <? echo json_encode($regions)?>;
var localities = <? echo json_encode($localities)?>;
</script>