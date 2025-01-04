<div id="page-wrapper">
	<br/>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading" style="height: 50px;">
					<div style="float: right;">
					    <!--<a href="<?/*=base_url(array("admin.php", "news", "order"));*/?>" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-sort"></span> <?/*=$this->lang->line('set_order')*/?></a>-->
						<a href="<?=base_url(array("admin.php", "news", "add"));?>" class="btn btn-info btn-sm"><?=$this->lang->line('add_news')?></a>
					</div>
					<?=$title?>
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
					<div class="dataTable_wrapper">
						<div class="filters"><?=$filters?></div>
						<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
									<th width="1%"><?=$this->lang->line('crt')?></th>
									<th width="1%"></th>
									<th><?=order('title', $this->lang->line('title'))?></th>
									<th><?=order('category', $this->lang->line('category'))?></th>
									<th><?=order('author_name', $this->lang->line('author'))?></th>
									<th><?=order('date', $this->lang->line('data'))?></th>
									<th width="1%"><?=$this->lang->line('enabled')?></th>
									<th width="1%">&nbsp;</th>
								</tr>
							</thead>
							<tbody>
							<?php foreach ($news as $news_item): ?>
								<tr class="odd gradeX" id="tr<?=$news_item['id']?>">
									<td><?=$this->cpagination->no()?></td>
									<td>
										<?php if(strlen($news_item['thumb_image_name']) > 0) { ?>
											<img src="<?=$this->config->item("live_path")?>/files/news/thumb/<?=$news_item['thumb_image_name']?>" width="130">
										<?php } ?>
									</td>
									<td>
										<b><a href="<?=base_url(array("admin.php", "news", "add", $news_item['id']));?>"><?=htmlspecialchars($news_item['title'])?></a></b>
										<br>
										<?=htmlspecialchars(truncate($news_item['content_short']))?>
									</td>
									<td><?=htmlspecialchars($news_item['category'])?></td>
									<td nowrap><?=htmlspecialchars($news_item['author_name']." ".$news_item['author_surname'])?></td>
									<td><?=($news_item['date'] == "0000-00-00 00:00:00" ? "" : date("d.m.Y H:i", strtotime($news_item['date'])))?></td>

									<td nowrap style="text-align: center;">
										<?php if($news_item['enabled'] == 1) { ?><span class="glyphicon glyphicon-ok"></span><?php } else { ?>-<?php }?>
									</td>

									<td align="center" nowrap>
										<a href="<?=base_url(array("admin.php", "news", "add", $news_item['id']));?>" class="btn btn-primary"><?=$this->lang->line('edit')?></a>
										<a href="javascript:;" rel="<?=htmlspecialchars($news_item['title'])?>" id="del<?=$news_item['id']?>" onclick="delete_record(<?=$news_item['id']?>)" class="btn btn-danger"><?=$this->lang->line('delete')?></a>
									</td>
								</tr>
							<?php endforeach ?>
							</tbody>
						</table>
						<ul class="pagination pagination-sm" style="margin: 0px; float: right;"><?=$this->cpagination->create_links();?></ul>
					</div>
					<!-- /.table-responsive -->

				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-12 -->
	</div>

</div>
<!-- /#page-wrapper -->

<div class="modal fade" role="dialog" aria-labelledby="gridSystemModalLabel" id="stergeAlertDialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="gridSystemModalLabel">Şterge știre</h4>
			</div>
			<div class="modal-body">
				Eşti sigur că doreşti să ştergi ştirea <b><span id="modal_content"></span></b>?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Închide</button>
				<button type="button" class="btn btn-primary" id="delete_btn">Şterge</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
var id_news = 0;
$("#delete_btn").click(function() {
	delete_record_confirm();
});

function delete_record(id) {
	$("#modal_content").html($("#del"+id).attr("rel"));
	$("#stergeAlertDialog").modal("show");
	id_news = id;
}

function delete_record_confirm() {
	$("#stergeAlertDialog").modal("hide");

	$.ajax({
        url: "<?=base_url(array("admin.php", "news", "delete"));?>",
        type :"POST",
        data: {
        	id_news:id_news
        },
        success: function(response) {
        	$("#tr"+id_news).slideUp();
			$.jGrowl("Ştirea a fost ştearsă");
        }
    });
}
</script>