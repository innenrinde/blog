<div id="page-wrapper">
	<br/>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading" style="height: 50px;">
					<div style="float: right;">
						<a href="<?=base_url(array("admin.php", "localities", "add"));?>" class="btn btn-info btn-sm">+ Adaugă localitate</a>
					</div>
					<?=$title?>
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
					<div class="dataTable_wrapper">
						<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
									<th>Denumire</th>
									<th>Judeţ</th>
									<th>Regiune</th>
									<th width="1%">&nbsp;</th>
								</tr>
							</thead>
							<tbody>
							<?php foreach ($localities as $item): ?>
								<tr class="odd gradeX" id="tr<?=$item['id_localitate']?>">
									<td><a href="<?=base_url(array("admin.php", "localities", "add", $item['id_localitate']));?>" class="btn btn-link"><?=htmlspecialchars($item['localitate'])?></a></td>
									<td><?=htmlspecialchars($item['judet'])?></td>
									<td><?=htmlspecialchars($item['region'])?></td>
									<td align="center" nowrap>
										<a href="<?=base_url(array("admin.php", "localities", "add", $item['id_localitate']));?>" class="btn btn-primary">Editează</a>
										<a href="javascript:;" rel="<?=htmlspecialchars($item['localitate'])?>" id="del<?=$item['id_localitate']?>" onclick="delete_record(<?=$item['id_localitate']?>)" class="btn btn-danger">Şterge</a>
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
				<h4 class="modal-title" id="gridSystemModalLabel">Şterge localitate</h4>
			</div>
			<div class="modal-body">
				Eşti sigur că doreşti să ştergi localitatea <b><span id="modal_content"></span></b>?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Închide</button>
				<button type="button" class="btn btn-primary" id="delete_btn">Şterge</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
  
<script>
var id_locality = 0;
$("#delete_btn").click(function() {
		delete_record_confirm();
});

function delete_record(id) {
	$("#modal_content").html($("#del"+id).attr("rel"));
	$("#stergeAlertDialog").modal("show");
	id_locality = id;
}

function delete_record_confirm() {
	$("#stergeAlertDialog").modal("hide");
	
	$.ajax({
        url: "<?=base_url(array("admin.php", "localities", "delete"));?>",
        type :"POST",
        data: {
        	id_locality:id_locality
        },
        success: function(response) {
        	$("#tr"+id_locality).slideUp();
			$.jGrowl("Localitatea a fost ştearsă");
        }
    });
}
</script>