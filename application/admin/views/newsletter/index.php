<div id="page-wrapper">
	<br/>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading" style="height: 50px;">
					<div style="float: right;">
						<a href="<?=base_url(array("admin.php", "newsletter", "export"));?>" class="btn btn-success btn-sm"><i class="fa fa-table fa-fw"></i> Exportă .xls</a>
						<a href="<?=base_url(array("admin.php", "newsletter", "add"));?>" class="btn btn-info btn-sm">+ Adaugă un email</a>
					</div>
					<?=$title?>
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
				    <div class="filters"><?=$filters?></div>
					<div class="dataTable_wrapper">
						<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
									<th width="1%">No.</th>
									<th><?=order('email', 'E-mail')?></th>
									<th style="text-align: center;"><?=order('confirmed', 'Confirmat')?></th>
									<th style="text-align: center;"><?=order('date_confirmed', 'Dată confirmare')?></th>
									<th style="text-align: center;"><?=order('date_registered', 'Dată înscriere')?></th>
									<th width="1%">&nbsp;</th>
								</tr>
							</thead>
							<tbody>
							<?php foreach ($newsletter as $item): ?>
								<tr class="odd gradeX" id="tr<?=$item['id']?>">
									<td><?=$this->cpagination->no()?></td>
									<td><a href="<?=base_url(array("admin.php", "newsletter", "add", $item['id']));?>"><?=htmlspecialchars($item['email'])?></a></td>
									<td align="center" nowrap><?php if($item['confirmed'] == 1) { ?><span class="glyphicon glyphicon-ok"></span><?php } else { ?>-<?php }?></td>
									<td align="center" nowrap><?=($item['date_confirmed'] != "0000-00-00 00:00:00" ? date("d.m.Y H:i:s", strtotime($item['date_confirmed'])) : "")?></td>
									<td align="center" nowrap><?=($item['date_registered'] != "0000-00-00 00:00:00" ? date("d.m.Y H:i:s", strtotime($item['date_registered'])) : "")?></td>
									<td align="center" nowrap>
										<a href="<?=base_url(array("admin.php", "newsletter", "add", $item['id']));?>" class="btn btn-primary">Editează</a>
										<a href="javascript:;" rel="<?=htmlspecialchars($item['email'])?>" id="del<?=$item['id']?>" onclick="delete_record(<?=$item['id']?>)" class="btn btn-danger">Şterge</a>
									</td>
								</tr>
							<?php endforeach; ?>
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
				<h4 class="modal-title" id="gridSystemModalLabel">Şterge adresa de e-mail</h4>
			</div>
			<div class="modal-body">
				Eşti sigur că doreşti să ştergi adresa de e-mail <b><span id="modal_content"></span></b>?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Închide</button>
				<button type="button" class="btn btn-primary" id="delete_btn">Şterge</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
  
<script>
var id_newsletter = 0;
$("#delete_btn").click(function() {
		delete_record_confirm();
});

function delete_record(id) {
	$("#modal_content").html($("#del"+id).attr("rel"));
	$("#stergeAlertDialog").modal("show");
	id_newsletter = id;
}

function delete_record_confirm() {
	$("#stergeAlertDialog").modal("hide");
	
	$.ajax({
        url: "<?=base_url(array("admin.php", "newsletter", "delete"));?>",
        type :"POST",
        data: {
        	id: id_newsletter
        },
        success: function(response) {
        	$("#tr"+id_newsletter).slideUp();
			$.jGrowl("Adresa de e-mail a fost ştearsă");
        }
    });
}
</script>