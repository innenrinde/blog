<script type="text/javascript" src="<?=$this->config->item('base_url')?>resources/admin/ckeditor/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?=$this->config->item('base_url')?>/resources/admin/charts/js/fusioncharts.js"></script>
<link href="https://mjolnic.com/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet">
<script src="https://mjolnic.com/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.js"></script>

<style>
.col-sm-1, .nomargin, .col-sm-6 {
    padding-left: 0px;
    margin-top: 2px;
}
.col-sm-1, .col-sm-2, .col-sm-11, .col-sm-6 {
    margin-top: 2px;
}
.panel {
    margin-bottom: 3px;
}
.left {
    float: left;
    margin-top: 5px;
}
ul.charts {
    float: left;
}
ul.charts li {
    display: inline-block;
    list-style-type: none;
    padding-right: 20px;
}

.right {
    text-align: right;
}

.top-5 {
    padding-top: 5px;
}
</style>

<div id="page-wrapper">
	<br/>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				
				<form role="form" id="form_chart" method="post" enctype="multipart/form-data">
				<div class="panel-heading" style="height: 50px;">
					<label class="left">Tipul graficului:</label>
				    <ul class="charts">
				        <li>
                            <input type="radio" id="line" value="msline" name="json[type]" <?=($item['json']['type'] == "msline" ? "checked" : "")?> >
                            <label for="line"><img src="<?=$this->config->item("live_path")?>/resources/admin/charts/msline.png">
                        </li>
				    	<li>
                            <input type="radio" id="area2d" value="msarea" name="json[type]" <?=($item['json']['type'] == "msarea2d" ? "checked" : "")?> >
                            <label for="area2d"><img src="<?=$this->config->item("live_path")?>/resources/admin/charts/msarea2d.png"></label>
					    </li>
                        <li>
                            <input type="radio" id="bar2d" value="msbar2d" name="json[type]" <?=($item['json']['type'] == "msbar2d" ? "checked" : "")?> >
                            <label for="bar2d"><img src="<?=$this->config->item("live_path")?>/resources/admin/charts/msbar2d.png">
                        </li>
					    <li>
                            <input type="radio" id="column2d" value="mscolumn2d" name="json[type]" <?=($item['json']['type'] == "mscolumn2d" ? "checked" : "")?> >
                            <label for="column2d"><img src="<?=$this->config->item("live_path")?>/resources/admin/charts/mscolumn2d.png">
                        </li>
                        <?php /*
                        <li>
                            <input type="radio" id="chart4" name="chart_type">
                            <label for="chart4"><img src="http://icons.iconarchive.com/icons/oxygen-icons.org/oxygen/32/Actions-office-chart-bar-stacked-icon.png">
                        </li>
                        <li>
                            <input type="radio" id="chart5" name="chart_type">
                            <label for="chart5"><img src="http://icons.iconarchive.com/icons/oxygen-icons.org/oxygen/32/Actions-office-chart-pie-icon.png">
                        </li>
                        <li>
                            <input type="radio" id="chart6" name="chart_type">
                            <label for="chart6"><img src="http://icons.iconarchive.com/icons/oxygen-icons.org/oxygen/32/Actions-office-chart-polar-icon.png">
                        </li>
                        */ ?>
                    </ul>
				</div>
				
				<!-- /.panel-heading -->
				<div class="panel-body">
					
					<?php echo validation_errors(); ?>
					
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title"><strong>Date generale</strong></h3>
						</div>
						<div class="panel-body">
                            <div class="col-sm-1">Titlu</div>
                            <div class="col-sm-11">
                                <input class="form-control" name="title" id="title" value="<?=htmlspecialchars($item['title'])?>">
                            </div>
                            <div class="col-sm-1">Subtitlu</div>
                            <div class="col-sm-11">
                                <input class="form-control" name="json[dataSource][chart][subCaption]" id="json[dataSource][chart][subCaption]" value="<?=htmlspecialchars($item['json']['dataSource']['chart']['subCaption'])?>">
                            </div>
                            <div class="col-sm-1 top-5">Fundal</div>
                            <div class="col-sm-1" style="margin-left: 15px;">
                                <input class="form-control" data-format="hex" name="json[dataSource][chart][bgColor]" id="json_bgColor" value="<?=htmlspecialchars($item['json']['dataSource']['chart']['bgColor'])?>" title="Culoarea de fundal a graficului">
                            </div>
                            <div class="col-sm-1 top-5 right">Lăţime</div>
                            <div class="col-sm-1">
                                <input class="form-control" name="json[width]" id="json[width]" value="<?=htmlspecialchars($item['json']['width'])?>">
                            </div>
                            <div class="col-sm-1 top-5 right">Înălţime</div>
                            <div class="col-sm-1">
                                <input class="form-control" name="json[height]" id="json[height]" value="<?=htmlspecialchars($item['json']['height'])?>">
                            </div>
                            <div class="col-sm-1 top-5 right">Prefix</div>
                            <div class="col-sm-1">
                                <input class="form-control" name="json[dataSource][chart][numberPrefix]" id="json[dataSource][chart][numberPrefix]" value="<?=htmlspecialchars($item['json']['dataSource']['chart']['numberPrefix'])?>" title="Prefixul valorilor din grafic">
                            </div>
                            <div class="col-sm-1 top-5 right">Sufix</div>
                            <div class="col-sm-1">
                                <input class="form-control" name="json[dataSource][chart][numberSuffix]" id="json[dataSource][chart][numberSuffix]" value="<?=htmlspecialchars($item['json']['dataSource']['chart']['numberSuffix'])?>" title="Sufixul valorilor din grafic">
                            </div>
                            <div class="col-sm-1 top-5" style="width: 150px;"><input type="checkbox" value="1" name="json[dataSource][chart][rotatevalues]" id="json[dataSource][chart][rotatevalues]" <?=($item['json']['dataSource']['chart']['rotatevalues'] == 1 ? "checked" : "")?> title="Daca valorile din grafic sunt afisate orizontal sau vertical"> Roteşte valori</div>
                        </div>
					</div>
					
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title"><strong>Axa OX</strong></h3>
						</div>
						<div class="panel-body">
                            <div class="col-sm-1">Denumire</div>
                            <div class="col-sm-11">
                                <input class="form-control" name="json[dataSource][chart][xAxisName]" id="json[dataSource][chart][xAxisName]" value="<?=htmlspecialchars($item['json']['dataSource']['chart']['xAxisName'])?>">
                            </div>
                            
                            <div class="col-sm-2 nomargin">
                                <input class="form-control" readonly="true" value="Etichete">
                                <textarea class="form-control textscroll" name="xAxisName_labels" id="xAxisName_labels" rows="9" placeholder="Etichete"><?=htmlspecialchars($xAxisName_labels)?></textarea>
                                <input class="form-control" data-format="hex" name="json[dataSource][chart][valueFontColor]" id="valueFontColor" placeholder="Culoare valori" value="<?=($item['json']['dataSource']['chart']['valueFontColor'])?>" title="Culoarea valorilor din grafic">
                            </div>
                            
                            <?php for($i = 0; $i < 5; $i++) { ?>
                            <div class="col-sm-2 nomargin">
                                <input class="form-control" name="json_seriesName[]" id="json_seriesName[]" placeholder="Nume serie <?=($i+1)?>" value="<?=(isset($json_seriesName[$i]) ? $json_seriesName[$i] : "")?>">
                                <textarea class="form-control textscroll" name="xAxisName_values[]" id="xAxisName_values[]" rows="9" placeholder="Valori serie <?=($i+1)?>"><?=(isset($xAxisName_values[$i]) ? $xAxisName_values[$i] : "")?></textarea>
                                <input class="form-control" data-format="hex" name="json_paletteColors[]" id="json_paletteColors[]" placeholder="Culoare serie <?=($i+1)?>" value="<?=(isset($json_paletteColors[$i]) ? $json_paletteColors[$i] : "")?>">
                            </div>
                            <?php } ?>
                        </div>
                    </div>
					
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title"><strong>Axa OY</strong></h3>
						</div>
						<div class="panel-body">
                            <div class="col-sm-1">Denumire</div>
                            <div class="col-sm-11">
                                <input class="form-control" name="json[dataSource][chart][yAxisName]" id="json[dataSource][chart][yAxisName]" value="<?=htmlspecialchars($item['json']['dataSource']['chart']['yAxisName'])?>">
                            </div>
                        </div>
                    </div>
					
					<div class="clear"></div>
					<a href="<?=base_url(array("admin.php", "charts"));?>" class="btn btn-outline btn-primary">Înapoi</a>
					<input type="submit" class="btn btn-primary" value="Salvează">
					<input type="button" id="chart_preview" class="btn btn-info" value="Previzualizare">
					
					<br/><br/>
					<div class="form-group">
						<input class="form-control" name="headline" id="headline" placeholder="Headline" value="<?=htmlspecialchars($item['headline'])?>">
					</div>
					
					<div id="chart-container"></div>
					
					<script>
					$("#chart_preview").click(function() {
						load_chart();
					});
					
					function load_chart() {
						var form_data = $("#form_chart").serialize();
						$.ajax({
								url: "<?=base_url(array("admin.php", "charts", "preview"));?>",
								type :"POST",
								data: form_data,
								success: function(response) {
									response = JSON.parse(response);
									if(response.json) {
										var json_chart = response.json;
										// console.log(JSON.stringify(json_chart));
										FusionCharts.ready(function () {
											var customChart = new FusionCharts(json_chart);
                                            customChart.render();
										});
									}
								}
							});
					}
					load_chart();
					
					$(function(){
                        $('#json_bgColor').colorpicker();
                        $("[name='json_paletteColors[]']").colorpicker();
                        $("#valueFontColor").colorpicker();
                    });
                    
                    $("[name='json[type]']").click(function() {
                    	load_chart();
                    });
					</script>
					
					<div class="form-group">
						<input class="form-control" name="note" id="note" placeholder="Notă" value="<?=htmlspecialchars($item['note'])?>">
					</div>
					<div class="form-group">
						<textarea class="form-control" name="description" id="description" style="height: 250px;"><?=htmlspecialchars($item['description'])?></textarea>
					</div>
					
					<script type='text/javascript'>
						CKEDITOR.replace('description',
						{
							filebrowserBrowseUrl : '<?=$this->config->item('base_url')?>resources/admin/ckeditor/ckfinder/ckfinder.html',
							filebrowserImageBrowseUrl : '<?=$this->config->item('base_url')?>resources/admin/ckeditor/ckfinder/ckfinder.html?Type=Images',
							filebrowserFlashBrowseUrl : '<?=$this->config->item('base_url')?>resources/admin/ckeditor/ckfinder/ckfinder.html?Type=Flash',
							filebrowserUploadUrl : '<?=$this->config->item('base_url')?>resources/admin/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
							filebrowserImageUploadUrl : '<?=$this->config->item('base_url')?>resources/admin/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
							filebrowserFlashUploadUrl : '<?=$this->config->item('base_url')?>resources/admin/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
							enterMode : CKEDITOR.ENTER_DIV,
							toolbarStartupExpanded : true,
							height : 300,
							SkinPath : '<?=$this->config->item('base_url')?>resources/admin/ckeditor/ckeditor/skins/kama/'
						});
					</script>
					
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
						<label>Categorie</label>
						<select class="form-control" name="id_news_category" id="id_news_category">
							<option value="0">- categorie principala -</option>
							<?php foreach($categories as $i=>$v) { ?>
								<option value="<?=$v['id']?>" <?=($v['id'] == $item['id_news_category'] ? "selected" : "")?> ><?=htmlspecialchars($v['title'])?></option>
								<?php p($v['childs']);if(sizeof($v['childs']) > 0) { ?>
									<?php foreach($v['childs'] as $ii=>$vv) { ?>
										<option value="<?=$vv['id']?>" <?=($vv['id'] == $item['id_news_category'] ? "selected" : "")?> >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=htmlspecialchars($vv['title'])?></option>
									<?php } ?>
								<?php } ?>
							<?php } ?>
						</select>
					</div>
					<div class="clear"></div>
					<div class="form-group">
						<div style="float: left; width: 50px;"><label>Public</label></div>
						<div style="float: left; margin-left: 30px;"><input type="radio" name="enabled" id="enabled_yes" value="1" <?=($item['enabled'] == 1 ? "checked" : "")?> > <label for="enabled_yes">da</label></div>
						<div style="float: left; margin-left: 30px;"><input type="radio" name="enabled" id="enabled_no" value="0" <?=($item['enabled'] == 0 ? "checked" : "")?> > <label for="enabled_no">nu</label></div>
					</div>
					
					<div class="clear"></div>
					<a href="<?=base_url(array("admin.php", "charts"));?>" class="btn btn-outline btn-primary">Înapoi</a>
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
$('.textscroll').on('scroll', function() {
    $('.textscroll').scrollTop($(this).scrollTop());
});
</script>