<div class="login-container">
	<div class="login-header login-caret">
		<div class="login-content">
			<a href="javascript:;" class="logo" >
				<img src="<?php echo base_url();?>assets/images/logo.png" width="200" alt="" />
				<!-- <h4 style="color:white"> <b> <?php echo APP_NAME ?></b></h4> -->
			</a>
		</div>
	</div>
	<div class="login-progressbar">
		<div></div>
	</div>
	<div class="login-form">
		<div class="login-content">
			<div class="form-login-error">
				<h3>Invalid Details</h3>
				<p><?php echo system_messages()['email_mobile_not_found'];?></p>
			</div>
			<form method="post" role="form" id="form_forgot_password" action="<?php echo isset($form_action) ? $form_action : '';?>">
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-user"></i>
						</div>
						<input type="text" class="form-control username" name="email" id="email" placeholder="Email Address" autocomplete="off"/>
					</div>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-block btn-login">
						<i class="entypo-login"></i>
						Submit
					</button>
				</div>
			</form>
			<div class="col-md-12 forgot_response" style="display:none;">
				<blockquote class="blockquote-red">
					<p>
						<strong><?php echo system_messages()['check_email_for_password'];?></strong>
					</p>
				</blockquote>
			</div>
			<div class="login-bottom-links">
				<a href="<?php echo base_url();?>login" class="link">Login</a>
			</div>
		</div>
	</div>
</div>

