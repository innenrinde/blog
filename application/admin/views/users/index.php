<style>
.avatar {
	width: 70px;
	height: 70px;
	border-radius: 70px;
	overflow: hidden;
	text-align: center;
}
.avatar img {
	width: 70px;
	min-height: 70px;
	margin: auto;
	position: relative;
}
</style>

<div id="page-wrapper">
	<br/>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading" style="height: 50px;">
					<div style="float: right;">
						<a href="<?=base_url(array("admin.php", "users", "add"));?>" class="btn btn-info btn-sm">+ Adaugă utilizator</a>
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
									<th>Nume</th>
									<th>Email</th>
									<th>Username</th>
									<th width="1%">Public</th>
									<th width="1%">&nbsp;</th>
								</tr>
							</thead>
							<tbody>
							<?php foreach ($users as $user_item): ?>
								<tr class="odd gradeX" id="tr<?=$user_item['id']?>">
									<td>
										<?php if(strlen($user_item['thumb_image_name']) > 0) { ?>
											<div class="avatar"><img src="<?=$this->config->item("base_url")?>/files/users/thumb/<?=$user_item['thumb_image_name']?>"></div>
										<?php } ?>
									</td>
									<td>
										<a href="<?=base_url(array("admin.php", "users", "add", $user_item['id']));?>" class="btn btn-link"><?=htmlspecialchars($user_item['first_name']." ".$user_item['last_name'])?></a>
									</td>
									<td><?=htmlspecialchars($user_item['email'])?></td>
									<td><?=htmlspecialchars($user_item['username'])?></td>
									<td align="center"><?php if($user_item['active'] == 1) { ?><span class="glyphicon glyphicon-ok"></span><?php } else { ?>-<?php }?></td>
									<td align="center" nowrap>
										<a href="<?=base_url(array("admin.php", "users", "add", $user_item['id']));?>" class="btn btn-primary">Editează</a>
										<a href="javascript:;" rel="<?=htmlspecialchars($user_item['first_name']." ".$user_item['last_name'])?>" id="del<?=$user_item['id']?>" onclick="delete_record(<?=$user_item['id']?>)" class="btn btn-danger">Şterge</a>
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
				<h4 class="modal-title" id="gridSystemModalLabel">Şterge utilizator</h4>
			</div>
			<div class="modal-body">
				Eşti sigur că doreşti să ştergi utilizatorul <b><span id="modal_content"></span></b>?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Închide</button>
				<button type="button" class="btn btn-primary" id="delete_btn">Şterge</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
var id_user = 0;
$("#delete_btn").click(function() {
		delete_record_confirm();
});

function delete_record(id) {
	$("#modal_content").html($("#del"+id).attr("rel"));
	$("#stergeAlertDialog").modal("show");
	id_user = id;
}

function delete_record_confirm() {
	$("#stergeAlertDialog").modal("hide");

	$.ajax({
        url: "<?=base_url(array("admin.php", "users", "delete"));?>",
        type :"POST",
        data: {
        	id_user:id_user
        },
        success: function(response) {
        	$("#tr"+id_user).slideUp();
			$.jGrowl("Utilizatorul a fost şters");
        }
    });
}
</script>