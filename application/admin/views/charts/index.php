<div id="page-wrapper">
	<br/>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading" style="height: 50px;">
					<div style="float: right;">
						<a href="<?=base_url(array("admin.php", "charts", "add"));?>" class="btn btn-info btn-sm">+ Adaugă un grafic</a>
					</div>
					<?=$title?>
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
					<div class="dataTable_wrapper">
						<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
								    <th width="1%"></th>
									<th>Titlu</th>
									<th width="1%" style="text-align: center;">Data</th>
									<th width="1%" style="text-align: center;">Public</th>
									<th width="1%">&nbsp;</th>
								</tr>
							</thead>
							<tbody>
							<?php foreach ($charts as $item): ?>
								<tr class="odd gradeX" id="tr<?=$item['id']?>">
									<td><img src="<?=$this->config->item("live_path")?>/resources/admin/charts/<?=$item['type']?>.png"></td>
									<td>
									    <a href="<?=base_url(array("admin.php", "charts", "add", $item['id']));?>"><?=htmlspecialchars($item['title'])?></a>
									    <?php if(strlen($item['category_name']) > 0) { ?>
									        <br/><i class="fa fa-file-o"></i> <small><?=$item['category_name']?></small>
									    <?php } ?>
									</td>
									<td align="center" nowrap>
									    <?=($item['date'] == "0000-00-00 00:00:00" ? "" : date("d.m.Y H:i", strtotime($item['date'])))?>
									</td>
									<td align="center"><?php if($item['enabled'] == 1) { ?><span class="glyphicon glyphicon-ok"></span><?php } else { ?>-<?php }?></td>
									<td align="center" nowrap>
										<a href="<?=base_url(array("admin.php", "charts", "add", $item['id']));?>" class="btn btn-primary">Editează</a>
										<a href="javascript:;" rel="<?=htmlspecialchars($item['title'])?>" id="del<?=$item['id']?>" onclick="delete_record(<?=$item['id']?>)" class="btn btn-danger">Şterge</a>
									</td>
								</tr>
							<?php endforeach; ?>
							</tbody>
						</table>
						<ul class="pagination pagination-sm" style="margin: 0px; float: right;"><?=$this->pagination->create_links();?></ul>
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
				<h4 class="modal-title" id="gridSystemModalLabel">Şterge grafic</h4>
			</div>
			<div class="modal-body">
				Eşti sigur că doreşti să ştergi graficul <b><span id="modal_content"></span></b> din ferma de date?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Închide</button>
				<button type="button" class="btn btn-primary" id="delete_btn">Şterge</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
  
<script>
var id_chart = 0;
$("#delete_btn").click(function() {
		delete_record_confirm();
});

function delete_record(id) {
	$("#modal_content").html($("#del"+id).attr("rel"));
	$("#stergeAlertDialog").modal("show");
	id_chart = id;
}

function delete_record_confirm() {
	$("#stergeAlertDialog").modal("hide");
	
	$.ajax({
        url: "<?=base_url(array("admin.php", "charts", "delete"));?>",
        type :"POST",
        data: {
        	id: id_chart
        },
        success: function(response) {
        	$("#tr"+id_chart).slideUp();
			$.jGrowl("Graficul a fost şters");
        }
    });
}
</script>