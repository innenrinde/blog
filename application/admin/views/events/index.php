<div id="page-wrapper">
	<br/>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading" style="height: 50px;">
					<div style="float: right;">
						<a href="<?=base_url(array("admin.php", "events", "add"));?>" class="btn btn-info btn-sm">+ Adaugă eveniment</a>
					</div>
					<?=$title?>
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
					<div class="dataTable_wrapper">
						<form action="">
							<table class="table table-striped table-bordered table-hover" id="dataTables-example">
								<thead>
									<tr>
										<th width="1%"></th>
										<th>Titlu</th>
										<th>Ţara</th>
										<th>Organizatori</th>
	                                    <th>Taxa</th>
										<th>Tip</th>
										<th>Recomandat</th>
										<th width="1%">Public</th>
										<th width="1%">&nbsp;</th>
									</tr>
									<tr>
										<th width="1%">
											<input type="submit" value="Filtreaza"/>
										</th>
										<th><input type="text" name="title" value="<?=$filters['title']?>"/></th>
										<th>
											<select name="country" id="country" class="form-control select-mini" style="width: 100px;">
												<option value="0"></option>
												<?php foreach ($countries as $country_item): ?>
													<option value="<?=htmlspecialchars($country_item['id'])?>" <?=($filters['country'] == $country_item['id'] ? "selected" : "")?> ><?=htmlspecialchars($country_item['name'])?></option>
												<?php endforeach ?>
											</select>
										</th>
										<th>
											<input type="text" name="organizers" value="<?=$filters['organizers']?>"/>
										</th>
	                                    <th></th>
										<th>
											<select name="type" id="type" class="form-control  select-mini" style="width: 100px;">
												<option value=""></option>
												<?php foreach ($categories as $category_item): ?>
													<option value="<?=htmlspecialchars($category_item['id'])?>" <?=($filters['type'] == $category_item['id'] ? "selected" : "")?> ><?=htmlspecialchars($category_item['title'])?></option>
												<?php endforeach ?>
											</select>
										</th>
										<th>
											<div style="float: left; margin-left: 30px;">
												<input type="radio" name="featured" id="featured_enabled_yes" value="1" <?=($filters['featured'] == 1 ? "checked" : "")?> > <label for="featured_enabled_yes">da</label>
											</div>
											<div style="float: left; margin-left: 30px;">
												<input type="radio" name="featured" id="featured_enabled_no" value="0" <?=($filters['featured'] == 0 ? "checked" : "")?> > <label for="featured_enabled_no">nu</label>
											</div>
											<div style="float: left; margin-left: 30px;">
												<input type="radio" name="featured" id="featured_enabled_all" value="" <?=($filters['featured'] == '' ? "checked" : "")?> > <label for="featured_enabled_all">toate</label>
											</div>
										</th>
										<th width="1%">
										 	<div style="float: left; margin-left: 30px;">
												<input type="radio" name="enabled" id="enabled_yes" value="1" <?=($filters['enabled'] == 1 ? "checked" : "")?> > <label for="enabled_yes">da</label>
											</div>
											<div style="float: left; margin-left: 30px;">
												<input type="radio" name="enabled" id="enabled_no" value="0" <?=($filters['enabled'] == 0 ? "checked" : "")?> > <label for="enabled_no">nu</label>
											</div>
											<div style="float: left; margin-left: 30px;">
												<input type="radio" name="enabled" id="enabled_all" value="" <?=($filters['enabled'] == '' ? "checked" : "")?> > <label for="enabled_all">toate</label>
											</div>
										
										</th>
										<th width="1%">&nbsp;</th>
									</tr>
								</thead>
								<tbody>
								<?php foreach ($events as $event_item): ?>
									<tr class="odd gradeX" id="tr<?=$event_item['id']?>">
										<td>
											<?php if(strlen($event_item['image_file']) > 0) { ?>
												<img src="<?=$this->config->item('base_url')?>files/events/thumb/<?=$event_item['image_file']?>" title="<?=htmlspecialchars($event_item['image_title'])?>">
											<?php } ?>
										</td>
										<td><a href="<?=base_url(array("admin.php", "events", "add", $event_item['id']));?>" class="btn btn-link"><?=htmlspecialchars($event_item['title'])?></a></td>
										<td><?=htmlspecialchars($event_item['country'])?></td>
										<td><?=htmlspecialchars($event_item['organizers'])?></td>
	                                    <td><?=htmlspecialchars($event_item['taxevent'])?></td>
										<td>
										<?=htmlspecialchars($categories[$event_item['type']]['title'])?></td>
										<td align="center"><?php if($event_item['featured'] == 1) { ?><span class="glyphicon glyphicon-ok"></span><?php } else { ?>-<?php }?></td>
										<td align="center"><?php if($event_item['enabled'] == 1) { ?><span class="glyphicon glyphicon-ok"></span><?php } else { ?>-<?php }?></td>
										<td align="center" nowrap>
											<a href="<?=base_url(array("admin.php", "events", "add", $event_item['id']));?>" class="btn btn-primary">Editează</a>
											<a href="javascript:;" rel="<?=htmlspecialchars($event_item['title'])?>" id="del<?=$event_item['id']?>" onclick="delete_record(<?=$event_item['id']?>)" class="btn btn-danger">Şterge</a>
										</td>
									</tr>
								<?php endforeach ?>
								</tbody>
							</table>
						</form>
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
				<h4 class="modal-title" id="gridSystemModalLabel">Şterge eveniment</h4>
			</div>
			<div class="modal-body">
				Eşti sigur că doreşti să ştergi evenimentul <b><span id="modal_content"></span></b>?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Închide</button>
				<button type="button" class="btn btn-primary" id="delete_btn">Şterge</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
  
<script>
var id_event = 0;
$("#delete_btn").click(function() {
		delete_record_confirm();
});

function delete_record(id) {
	$("#modal_content").html($("#del"+id).attr("rel"));
	$("#stergeAlertDialog").modal("show");
	id_event = id;
}

function delete_record_confirm() {
	$("#stergeAlertDialog").modal("hide");
	
	$.ajax({
        url: "<?=base_url(array("admin.php", "events", "delete"));?>",
        type :"POST",
        data: {
        	id_event:id_event
        },
        success: function(response) {
        	$("#tr"+id_event).slideUp();
			$.jGrowl("Evenimentul a fost şters");
        }
    });
}
</script>