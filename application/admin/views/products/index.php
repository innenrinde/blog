<div id="page-wrapper">
	<br/>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading" style="height: 50px;">
					<div style="float: right;">
						<a href="<?=base_url(array("admin.php", "products", "add"));?>" class="btn btn-info btn-sm">+ Adaugă produs</a>
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
									<th width="1%"></th>
									<th width="1%"></th>
									<th><?=order('a.name', 'Produs')?></th>
									<th nowrap align="right"><?=order('a.price', 'Preţ')?></th>
									<th nowrap align="right"><?=order('a.price_promo', 'Preţ redus')?></th>
									<th nowrap align="right"><?=order('a.tva', 'TVA')?></th>
									<th>Categorii</th>
									<th nowrap width="1%"><?=order('a.promoted', 'Promovat')?></th>
									<th nowrap width="1%"><?=order('a.enabled', 'Public')?></th>
									<th width="1%">&nbsp;</th>
								</tr>
							</thead>
							<tbody>
							<?php foreach ($rows as $row): ?>
								<tr class="odd gradeX" id="tr<?=$row['id']?>">
									<td align="center">
										<?=show_labels($row['labels'], $row['labels_title'])?>
									</td>
									<td>
										<img src="<?=$this->config->item("live_path")?>/files/products/thumb/<?=$row['image_file']?>" width="50">
									</td>
									<td><a href="<?=base_url(array("admin.php", "products", "add", $row['id']));?>"><?=htmlspecialchars($row['name'])?></a></td>
									<td nowrap align="right">
										<?=$row['price']?> <?=$row['currency']?>
									</td>
									<td nowrap align="right">
										<?=$row['price_promo']?> <?=$row['currency']?>
									</td>
									<td nowrap align="right">
										<?=$row['tva']?> %
									</td>
									<td nowrap><?=$row['categories']?></td>
									<td align="center"><?php if($row['promoted'] == 1) { ?><span class="glyphicon glyphicon-ok"></span><?php } else { ?>-<?php }?></td>
									<td align="center"><?php if($row['enabled'] == 1) { ?><span class="glyphicon glyphicon-ok"></span><?php } else { ?>-<?php }?></td>
									<td align="center" nowrap>
										<a href="<?=base_url(array("admin.php", "products", "add", $row['id']));?>" class="btn btn-primary">Editează</a>
										<a href="javascript:;" rel="<?=htmlspecialchars($row['name'])?>" id="del<?=$row['id']?>" onclick="delete_record(<?=$row['id']?>)" class="btn btn-danger">Şterge</a>
									</td>
								</tr>
							<?php endforeach ?>
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
				<h4 class="modal-title" id="gridSystemModalLabel">Şterge stire</h4>
			</div>
			<div class="modal-body">
				Eşti sigur că doreşti să ştergi produsul <b><span id="modal_content"></span></b>?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Închide</button>
				<button type="button" class="btn btn-primary" id="delete_btn">Şterge</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
  
<script>
var id_product = 0;
$("#delete_btn").click(function() {
		delete_record_confirm();
});

function delete_record(id) {
	$("#modal_content").html($("#del"+id).attr("rel"));
	$("#stergeAlertDialog").modal("show");
	id_product = id;
}

function delete_record_confirm() {
	$("#stergeAlertDialog").modal("hide");
	
	$.ajax({
        url: "<?=base_url(array("admin.php", "products", "delete"));?>",
        type :"POST",
        data: {
        	id_product:id_product
        },
        success: function(response) {
        	console.log(response);
        	$("#tr"+id_product).slideUp();
			$.jGrowl("Produsul a fost şters");
        }
    });
}
</script>