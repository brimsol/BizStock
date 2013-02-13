<div class="row">
	<div class="span4 offset4">
		<div id="welcome_login_form_alert" class="alert"></div>
		<form class="form-horizontal" id="welcome_login_form" method="post" accept-charset="utf-8"
		action="/welcome/login">
			<fieldset>
				<legend>
					Admin Login
				</legend>

				<div class="control-group">
					<label class="control-label" style="margin-left:0px;" for="username">Username</label>
					<div class="controls">
						<input class="input-medium" value="<?php echo set_value('username'); ?>" name="username" id="username" type="text">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" style="margin-left:0px;" for="password">Password</label>
					<div class="controls">
						<input class="input-medium"  name="password" id="password" type="password">
					</div>
				</div>
				
				<div class="form-actions">
					<input type="submit" class="btn btn-large btn-primary" style="margin-left:0px;" value="Login" name="" />
					<!-- &nbsp;&nbsp;<a href="/user_controller/register_user" style="font-size: 12px">Sign Up</a> -->
				</div>
			</fieldset>
		</form>
	</div>
</div>
