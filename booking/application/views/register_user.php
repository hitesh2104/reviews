<div class="login-container">
	
	<div class="login-header login-caret">
		
		<div class="login-content">
			
			<a href="javascript:;" class="logo" >
				<!-- <h4 style="color:white"> <b> <?php echo APP_NAME ?></b></h4> -->
				<img src="<?php echo base_url();?>assets/images/logo.png" width="200" alt="" />
			</a>
			
			<h3>Create an account</h3>
			
			<!-- progress bar indicator -->
			<!-- <div class="login-progressbar-indicator">
				<h3>43%</h3>
				<span>logging in...</span>
			</div> -->
		</div>
		
	</div>
	
	<div class="login-progressbar">
		<div></div>
	</div>
	
	<div class="login-form">
		
		<div class="login-content">
			
			<form method="post" action="<?php echo $form_action ?>" role="form" id="form_register"  data-parsley-validate enctype='multipart/form-data'  >
				
				<div class="form-register-success">
					<i class="entypo-check"></i>
					<h3>You have been successfully registered.</h3>
					<p>We have emailed you the confirmation link for your account.</p>
				</div>
				
				<div class="form-steps">
					
					<div class="step current" id="step-1">
						
						<!-- <div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="entypo-user"></i>
								</div>
								
								<input type="text" class="form-control required" name="first_name" id="first_name" required="" placeholder="Name" autocomplete="off" />
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="entypo-user"></i>
								</div>
								
								<input type="text" class="form-control required" name="last_name" id="last_name" required="" placeholder="Surname" autocomplete="off" />
							</div>
						</div> -->
						
						<!-- <div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="entypo-users"></i>
								</div>
								
								<input type="text" class="form-control required" name="client_company" id="client_company" required="" placeholder="Client" autocomplete="off" />
							</div>
						</div> -->
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="entypo-user"></i>
								</div>
								
								<input type="text" class="form-control required" name="fullname" id="fullname" required="" placeholder="Full Name" autocomplete="off" />
							</div>
						</div>
						
						<!-- <div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="entypo-pencil"></i>
								</div>
								
								<input type="text" class="form-control required" name="id_number" id="id_number" required="" placeholder="ID number" autocomplete="off" />
							</div>
						</div> -->
						
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="entypo-phone"></i>
								</div>
								
								<input type="text" class="form-control" name="work_phone" id="work_phone" placeholder="Work Telephone Number" data-mask="phone" autocomplete="off" />
							</div>
						</div>
						
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-mobile"></i>
								</div>
								
								<input type="text" class="form-control required" name="cell_phone" id="cell_phone" required placeholder="Cell Number" data-mask="phone" autocomplete="off" />
							</div>
						</div>
						
						<!-- <div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="entypo-newspaper"></i>
								</div>
								
								<input type="text" class="form-control" name="jobtitle" id="jobtitle" placeholder="Job Title"   autocomplete="off" />
							</div>
						</div> -->
						
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="entypo-mail"></i>
								</div>
								
								<input type="email" class="form-control required" name="email" id="email" required="" data-mask="email" placeholder="E-mail" autocomplete="off" />
							</div>
						</div>
						
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="entypo-mail"></i>
								</div>
								
								<input type="text" class="form-control required" name="dealership_name" id="dealership_name" required="" data-mask="dealership_name" placeholder="Dealership Name" autocomplete="off" />
							</div>
						</div>
						
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="entypo-mail"></i>
								</div>
								
								<input type="text" class="form-control required" name="town_city" id="town_city" required="" data-mask="town_city" placeholder="Town/City" autocomplete="off" />
							</div>
						</div>
						
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="entypo-mail"></i>
								</div>
								
								<select type="text" class="form-control required" name="province" id="province" required="" data-mask="province" placeholder="Province" autocomplete="off" >
									<?php echo $province_options ?>
								</select>
							</div>
						</div>
						
						<!-- <div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="entypo-user"></i>
								</div>
								
								<input type="text" class="form-control required" name="username" id="username" required="" data-mask="email" placeholder="Username" autocomplete="off" />
							</div>
						</div> -->
						
						<!-- <div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="entypo-network"></i>
								</div>
								
								<input type="text" class="form-control required" name="company" id="company" required placeholder="Company"   autocomplete="off" />
							</div>
						</div> -->
						
						<!-- <div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="entypo-newspaper"></i>
								</div>
								
								<input type="text" class="form-control" name="position" id="position" placeholder="Position"   autocomplete="off" />
							</div>
						</div> -->
						
						<!-- <div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="entypo-logo-db"></i>
								</div>
								
								<input type="text" class="form-control" name="business_unit" id="business_unit" placeholder="Business Unit"   autocomplete="off" />
							</div>
						</div>
						
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="entypo-window"></i>
								</div>
								
								<input type="text" class="form-control" name="division" id="division" placeholder="Division"   autocomplete="off" />
							</div>
						</div>
						
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="entypo-vcard"></i>
								</div>
								
								<input type="text" class="form-control required" name="cost_center_number" required  id="cost_center_number" placeholder="Cost Center Number"   autocomplete="off" />
							</div>
						</div> -->
						
						<div class="form-group">
							<button type="submit" class="btn save_btn btn-success btn-block btn-login">
								<i class="entypo-right-open-mini"></i>
								Register
							</button>
						</div>
						
					</div>
					
				</div>
				
			</form>
			
			
			<div class="login-bottom-links">
				
				<a href="<?php echo base_url('login');?>" class="link">
					<i class="entypo-lock"></i>
					Return to Login Page
				</a>				
			</div>
			
		</div>
		
	</div>
	
</div>

<script>
	$(document).ready(function() {
		setTimeout(function(){
			$(".page-body").removeClass("login-form-fall loaded");
		},200);
		
		$("input").on("keyup",function(){
			if($(this).hasClass('required')){
				if($(this).val().length > 0){
					 $(this).parents(".input-group").removeAttr('style')
				} else {
					$(this).parents(".input-group").css('border', '1px solid red');
				}
			}
		});
		
		$("#form_register").on('submit',function(event){
			event.preventDefault();
			var obj = $(this);
			
			
			if(obj.parsley().validate()){
				show_loading_bar(35);
				$("#save_btn").attr('disabled', true);
				$.ajax({
					url: obj.attr('action'),
					type: 'POST',
					dataType:'json',
					data: obj.serialize(),
					success : function(response){
						show_loading_bar(100);
						showToastMessage(response.message,response.status);
						if(response.status=='success'){
							$("#save_btn").attr('disabled', false);
							$(".form-register-success").show();
							setTimeout(function(){
								window.location.href = base_url+'/login';
							},5000)
						} 
					},
					error : function(response){
						show_loading_bar(100);
						showToastMessage("<?php echo system_messages()['server_error_message']; ?>",'error');
						$("#save_btn").attr('disabled', false);
					}
				})
			} else {
				
				obj.find("input.parsley-error").each(function(){
					$(this).parents(".input-group").css('border', '1px solid red');
				});
			}
		});
	});
</script>