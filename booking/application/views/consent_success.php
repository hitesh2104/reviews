<style>
.consent_form_background{
	padding: 30px;
	background-color: #ffffff;
	border: 1px solid #dcdcdc;
	color: black;
}
body.login-page{
	background: #f5f5f5;
}
canvas.jSignature { height: 200px !important; }
</style>
<div class="login-container">
	<div class="login-header login-caret">
		<div class="login-content">
			<a href="javascript:;" class="logo" >
				<img src="<?php echo base_url();?>assets/images/logo.png" width="200" alt="" />
			</a>
		</div>
	</div>
	<div class="login-progressbar">
		<div></div>
	</div>
	<div class="login-form">
		<div class="col-md-9 col-md-offset-2 consent_form_background">
			<form method="post" action="<?php echo $form_action ?>" role="form" id="form_register"  data-parsley-validate enctype='multipart/form-data'  >
				<h1 class="text-success">Success</h1>
				<hr>
				<h3 class="text-center text-success">
					<i class="fa fa-check"  style="font-size: 50px;"></i> 	
				</h3>
				<h4 class="text-center">Thank you for completing the consent form. You will receive further correspondence from the assessment team within 24 hours. </h4>
				<br><br>
			
				
			</form>
		</div>
	</div>
</div>
