<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<style>
.categories ul {
	list-style-type: none;
	margin: 0px;
	padding: 0px;
}

.categories ul li span i {
	visibility: hidden;
}

.categories ul li span:hover i {
	visibility: visible;
}


.categories ul li a {
	font-weight: bold;
}

.categories ul li a {
	font-weight: bold;
}

.categories ul li span {
	display: block;
	padding: 10px;
	cursor: move;
	margin: 1px;
	border: solid 1px #cacaca;
	background-color: #f8f8f8;
}

.categories ul li ul li span {
}

.categories ul li ul li a {
	font-weight: normal;
	margin-left: 30px;
}

.categories ul li ul li ul li a {
	margin-left: 60px;
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
					Foloseşte drag &amp; drop pentru ordonarea categoriilor şi a subcategoriilor
					<br/><br/>
				</div>
				<form role="form" method="post">
				<!-- /.panel-heading -->
				<div class="panel-body">
					
					<div class="categories"><?=$categories?></div>
					
					<div class="clear"></div>
					<a href="<?=base_url(array("admin.php", "newscategories"));?>" class="btn btn-outline btn-primary">Înapoi</a>
							
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

<?php foreach($id_parents as $i=>$v) { ?>
$("#list<?=$v?>").sortable({stop: function( event, ui ) {get_order($("#list<?=$v?>"));}});
<?php } ?>

function get_order(obj) {
	if($(obj).children().length > 0) {
		var objs = new Array();
		$(obj).children().each(function(id, val) {
			objs.push($(this).attr("id"));
		}).promise().done(
			function() {
				if(objs.join(",").length > 0) {
					$.ajax({
					    url: "<?=$this->config->item("live_path")?>/admin.php/newscategories/save_order",
						type: "POST",
						data: {
							categories:objs
						},
						success: function(response) {
							$.jGrowl("Ordinea categoriilor a fost salvată");
						}
					});
				}
			}
		);
	}
}
</script>