<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<div id="page-wrapper">
	<br/>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading" style="height: 50px;">
					<strong><?=$title?></strong>
					<br/>
					Foloseşte drag &amp; drop pentru ordonarea etichetelor
					<br/><br/>
				</div>
				<form role="form" method="post">
				<!-- /.panel-heading -->
				<div class="panel-body">
					
					<div class="list_order">
					<ul id="list_labels">
					<?php $nr = sizeof($labels);
						foreach($labels as $i=>$v) { ?>
					    <li id="<?=$v['id']?>">
					        <span>
					        <number><?=($i+1)?>.</number>
					        <i class="fa fa-circle" style="color: <?=$v['color']?>"></i>
					        <a href="<?=base_url(array("admin.php", "labels", "add", $v['id']));?>"><?=htmlspecialchars($v['title'])?></a>
                            </span>
                            </li>
					<?php } ?>
					</ul>
					</div>
					
					<div class="clear"></div>
					<a href="<?=base_url(array("admin.php", "labels"));?>" class="btn btn-outline btn-primary">Înapoi</a>
							
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

$("#list_labels").sortable({stop: function( event, ui ) {get_order();}});

function get_order() {
    var obj = $("#list_labels");
	if($(obj).children().length > 0) {
		var objs = new Array();
		$(obj).children().each(function(id, val) {
			objs.push($(this).attr("id"));
		}).promise().done(
			function() {
				if(objs.join(",").length > 0) {
					$.ajax({
					    url: "<?=$this->config->item("live_path")?>/admin.php/labels/save_order",
						type: "POST",
						data: {
							labels:objs
						},
						success: function(response) {
							$.jGrowl("Ordinea etichetelor a fost salvată");
						}
					});
				}
			}
		);
	}
}

</script>