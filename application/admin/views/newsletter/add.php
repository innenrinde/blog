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
						<label>E-mail</label>
						<input class="form-control" name="email" id="email" value="<?=htmlspecialchars($item['email'])?>">
					</div>
					
					<div class="form-group">
						<div style="float: left; width: 50px;"><label>Confirmat</label></div>
						<div style="float: left; margin-left: 30px;"><input type="radio" name="confirmed" id="confirmed_yes" value="1" <?=($item['confirmed'] == 1 ? "checked" : "")?> > <label for="confirmed_yes">da</label></div>
						<div style="float: left; margin-left: 30px;"><input type="radio" name="confirmed" id="confirmed_no" value="0" <?=($item['confirmed'] == 0 ? "checked" : "")?> > <label for="confirmed_no">nu</label></div>
					</div>
					
					<div class="clear"></div>
					<br/>
					<a href="<?=base_url(array("admin.php", "newsletter"));?>" class="btn btn-outline btn-primary">Înapoi</a>
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