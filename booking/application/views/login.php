<style>
body .login-container .login-header.login-caret:after {
    border-top-color: transparent !important;
}

body.login-page .login-bottom-links .link {
	color: #e41717;
	font-weight: bold;
}
body .login-container .login-header {
    background-color: transparent !important;
}
</style>

<div class="login-container" style="background-image: url(<?php echo base_url('assets/images/login-background.jpg') ?>);
background-repeat: no-repeat;
background-size:  100%;
height:100%;
color: white;
">

<div class="login-header login-caret">
	<div class="login-content">
		<a href="javascript:;" class="logo" >
			<img src="<?php echo base_url();?>assets/images/logo.png" width="200" alt="" />
			<!-- <h4 style="color:white"> <b> <?php echo APP_NAME ?></b></h4> -->
		</a>
		<!-- progress bar indicator -->
	</div>
	
</div>

<div class="login-progressbar">
	<div></div>
</div>

<div class="login-form">
	
	<div class="login-content">
		<div class="form-login-error">
			<h3>Invalid login</h3>
			<p></p>
		</div>
		
		
		<form method="post" role="form" id="form_login" action="<?php echo base_url('home/login_check'); ?>">
			
			<div class="form-group">
				
				<div class="input-group">
					<div class="input-group-addon">
						<i class="entypo-user"></i>
					</div>
					
					<input type="text" class="form-control" name="username" id="username" placeholder="Username or Email Id" autocomplete="off" />
				</div>
				
			</div>
			
			<div class="form-group">
				
				<div class="input-group">
					<div class="input-group-addon">
						<i class="entypo-key"></i>
					</div>
					
					<input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off" />
				</div>
				
			</div>
			
			<div class="form-group">
				<button type="submit" class="btn btn-primary btn-block btn-login">
					<i class="entypo-login"></i>
					Log In
				</button>
			</div>
		</form>
		
		<div class="login-bottom-links">
			<a href="<?php echo base_url(); ?>register" class="link pull-left">Register Now?</a> 
			<a href="<?php echo base_url(); ?>forgetpassword" class="link pull-right">Forgot password?</a> 
		</div>
	</div>
</div>
</div>


