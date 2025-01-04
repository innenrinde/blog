<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<style>
.list_order ul {
	list-style-type: none;
	margin: 0px;
	padding: 0px;
}

.list_order ul li {
    list-style-type: none;
}

.list_order ul li number {
    display: inline-block;
    width: 25px;
    text-align: center;
}

.list_order ul li img {
    width: 40px;
    border: solid 1px #000;
}

.list_order ul li a {

}

.list_order ul li a.remove {
	font-weight: normal;
	float: right;
}

.list_order ul li span {
	display: block;
	padding: 10px;
	cursor: move;
	margin: 1px;
	border: solid 1px #cacaca;
	background-color: #f8f8f8;
}

.trendline {
    border-top: solid 2px red;
    color: red;
    font-size: 10px;
    margin-bottom: 10px;
}

</style>

<div id="page-wrapper">
	<br/>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading" style="height: 50px;">
					<strong><?=$title?></strong>
					<br/>
					Foloseşte drag &amp; drop pentru ordonarea articolelor
					<br/><br/>
				</div>
				<form role="form" method="post">
				<!-- /.panel-heading -->
				<div class="panel-body">

					<div class="list_order">
					<ul id="list_news">
					<?php $nr = sizeof($news);
						foreach($news as $i=>$v) { ?>
					    <li id="<?=$v['id']?>">
					        <span>
					        <number><?=($i+1)?>.</number>
					        <?php /*if(strlen($v['image_file']) > 0) { */?><!--
                                <img src="<?/*=$this->config->item('base_url')*/?>files/news/thumb/<?/*=$v['image_file']*/?>" title="<?/*=htmlspecialchars($v['image_title'])*/?>">
                            --><?php /*} */?>
                            <a href="<?=base_url(array("admin.php", "news", "add", $v['id']));?>"><?=htmlspecialchars($v['title'])?></a> / <?=date("d.m.Y H:i:s", strtotime($v['date']))?>
                            <a href="javascript:;" onclick="delete_record(<?=$v['id']?>)" class="remove" title="Elimină de pe prima pagină"><i class="fa fa-remove"></i></a>
                            </span>
                            </li>
                            <?php if($i == 14 && $nr > 15) { ?>
                                <li class="trendline">de aici în jos nu se mai văd ştirile pe prima pagină</li>
                            <?php } ?>
					<?php } ?>
					</ul>
					</div>

					<div class="clear"></div>
					<a href="<?=base_url(array("admin.php", "news"));?>" class="btn btn-outline btn-primary">Înapoi</a>

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

$("#list_news").sortable({stop: function( event, ui ) {get_order();}});

function get_order() {
    var obj = $("#list_news");
	if($(obj).children().length > 0) {
		var objs = new Array();
		$(obj).children().each(function(id, val) {
			objs.push($(this).attr("id"));
		}).promise().done(
			function() {
				if(objs.join(",").length > 0) {
					$.ajax({
					    url: "<?=$this->config->item("live_path")?>/admin.php/news/save_order",
						type: "POST",
						data: {
							news:objs
						},
						success: function(response) {
							$.jGrowl("Ordinea articolelor a fost salvată");
						}
					});
				}
			}
		);
	}
}

function delete_record(id) {
	$.ajax({
        url: "<?=base_url(array("admin.php", "news", "remove_home_page"));?>",
        type :"POST",
        data: {
        	id_news:id
        },
        success: function(response) {
        	$("#"+id).slideUp();
			$.jGrowl("Articolul a fost eliminat din listă");
        }
    });
}
</script>