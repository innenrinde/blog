<form method="post">
	<div class="" style="width: 300px; margin:auto; margin-top: 30px;">
		<div class="panel panel-default">
			<div class="panel-heading" style="text-align: center;">
				<?=$title?>
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				
				<div class="form-group">
					<label>User</label>
					<input type="text" class="form-control" name="user" id="user" value="<?=htmlspecialchars($user)?>">
				</div>
				
				<div class="form-group">
					<label>Password</label>
					<input type="password" class="form-control" name="password" id="password" value="">
				</div>
				
				<div class="form-group" style="text-align:center;">
					<input type="submit" name="login" value="Login" class="btn btn-primary">
				</div>
				
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
</form>

<div class="modal fade" role="dialog" aria-labelledby="gridSystemModalLabel" id="stergeAlertDialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="gridSystemModalLabel">Şterge hotel</h4>
			</div>
			<div class="modal-body">
				Eşti sigur că doreşti să ştergi hotelul <b><span id="modal_content"></span></b>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Închide</button>
				<button type="button" class="btn btn-primary" id="delete_btn">Şterge</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
  
<script>
var id_hotel = 0;
$("#delete_btn").click(function() {
		delete_record_confirm();
});

function delete_record(id) {
	$("#modal_content").html($("#del"+id).attr("rel"));
	$("#stergeAlertDialog").modal("show");
	id_hotel = id;
}

function delete_record_confirm() {
	$("#stergeAlertDialog").modal("hide");
	
	$.ajax({
        url: "<?=base_url(array("admin.php", "hotels", "delete"));?>",
        type :"POST",
        data: {
        	id_hotel:id_hotel
        },
        success: function(response) {
        	$("#tr"+id_hotel).slideUp();
			$.jGrowl("Hotelul a fost şters");
        }
    });
}
</script>