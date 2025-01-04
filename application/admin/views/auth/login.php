<!--
<h1><?php echo lang('login_heading');?></h1>
<p><?php echo lang('login_subheading');?></p>

<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open("auth/login");?>

  <p>
    <?php echo lang('login_identity_label', 'identity');?>
    <?php echo form_input($identity);?>
  </p>

  <p>
    <?php echo lang('login_password_label', 'password');?>
    <?php echo form_input($password);?>
  </p>

  <p>
    <?php echo lang('login_remember_label', 'remember');?>
    <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
  </p>


  <p><?php echo form_submit('submit', lang('login_submit_btn'));?></p>

<?php echo form_close();?>

<p><a href="forgot_password"><?php echo lang('login_forgot_password');?></a></p>
-->








<form method="post" action="<?=$this->config->item("live_path")?>/admin.php/auth/login">
	<div class="" style="width: 300px; margin:auto; margin-top: 30px;">
		<div class="panel panel-default">
			<div class="panel-heading" style="text-align: center;">
				<?=$title?>
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				
				<div id="infoMessage"><?php echo $message;?></div>
				
				<div class="form-group">
					<label>User</label>
					<input type="text" class="form-control" name="identity" id="identity" value="">
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

