<div id="page-wrapper">
	<br/>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading" style="height: 50px;">
					<div style="float: right;">
					    <a href="<?=base_url(array("admin.php", "properties", "order"));?>" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-sort"></span> Setează ordinea</a>
						<a href="<?=base_url(array("admin.php", "properties", "add"));?>" class="btn btn-info btn-sm">+ Adaugă o proprietate</a>
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
									<th><?=order('name', 'Nume')?></th>
									<th style="text-align:center;"><?=order('order', 'Ordine')?></th>
									<th style="text-align:center;"><?=order('enabled', 'Public')?></th>
									<th width="1%">&nbsp;</th>
								</tr>
							</thead>
							<tbody>
							<?php foreach ($properties as $item): ?>
								<tr class="odd gradeX" id="tr<?=$item['id']?>">
									<td>
										<a href="<?=base_url(array("admin.php", "properties", "add", $item['id']));?>" class="btn btn-link"><?=htmlspecialchars($item['name'])?></a></td>
									</td>
									<td align="center"><?=$item['order']?></td>
									<td align="center"><?php if($item['enabled'] == 1) { ?><span class="glyphicon glyphicon-ok"></span><?php } else { ?>-<?php }?></td>
									<td align="center" nowrap>
										<a href="<?=base_url(array("admin.php", "properties", "add", $item['id']));?>" class="btn btn-primary">Editează</a>
										<a href="javascript:;" rel="<?=htmlspecialchars($item['name'])?>" id="del<?=$item['id']?>" onclick="delete_record(<?=$item['id']?>)" class="btn btn-danger">Şterge</a>
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
				<h4 class="modal-title" id="gridSystemModalLabel">Şterge proprietatea</h4>
			</div>
			<div class="modal-body">
				Eşti sigur că doreşti să ştergi proprietatea <b><span id="modal_content"></span></b>?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Închide</button>
				<button type="button" class="btn btn-primary" id="delete_btn">Şterge</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
  
<script>
var id_property = 0;
$("#delete_btn").click(function() {
	delete_record_confirm();
});

function delete_record(id) {
	$("#modal_content").html($("#del"+id).attr("rel"));
	$("#stergeAlertDialog").modal("show");
	id_property = id;
}

function delete_record_confirm() {
	$("#stergeAlertDialog").modal("hide");
	
	$.ajax({
        url: "<?=base_url(array("admin.php", "properties", "delete"));?>",
        type :"POST",
        data: {
        	id_property:id_property
        },
        success: function(response) {
        	$("#tr"+id_property).slideUp();
			$.jGrowl("Proprietatea a fost ştearsă");
        }
    });
}
</script>