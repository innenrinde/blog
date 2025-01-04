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
						<label>Denumire</label>
						<input class="form-control" name="name" id="name" value="<?=htmlspecialchars($item['name'])?>">
					</div>
					
					<div class="form-group">
						<label>Prescurtare</label>
						<input class="form-control" name="short" id="short" value="<?=htmlspecialchars($item['short'])?>">
					</div>
					
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
									<img src="<?=$this->config->item('base_url')?>files/languages/<?=$item['image_file']?>" title="" id="image_file" style="width: 50px;">
								<?php } ?>
								</td>
							</tr>
						</table>
						</div>
					</div>
					
					<div class="clear"></div>
					<div class="form-group">
						<div style="float: left; width: 100px;"><label>Arată în site</label></div>
						<div style="float: left; margin-left: 30px;"><input type="radio" name="show_on_site" id="show_on_site_yes" value="1" <?=($item['show_on_site'] == 1 ? "checked" : "")?> > <label for="show_on_site_yes">da</label></div>
						<div style="float: left; margin-left: 30px;"><input type="radio" name="show_on_site" id="show_on_site_no" value="0" <?=($item['show_on_site'] == 0 ? "checked" : "")?> > <label for="show_on_site_no">nu</label></div>
					</div>
					
					<div class="clear"></div>
					<div class="form-group">
						<div style="float: left; width: 50px;"><label>Public</label></div>
						<div style="float: left; margin-left: 30px;"><input type="radio" name="enabled" id="enabled_yes" value="1" <?=($item['enabled'] == 1 ? "checked" : "")?> > <label for="enabled_yes">da</label></div>
						<div style="float: left; margin-left: 30px;"><input type="radio" name="enabled" id="enabled_no" value="0" <?=($item['enabled'] == 0 ? "checked" : "")?> > <label for="enabled_no">nu</label></div>
					</div>
					
					<div class="clear"></div>
					<br/>
					<a href="<?=base_url(array("admin.php", "languages"));?>" class="btn btn-outline btn-primary">Înapoi</a>
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
</script>