 
<ol class="breadcrumb bc-3" >
	<li>
		<a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i>Home</a>
	</li>
	<li class="active">
		<strong>Profile</strong>
	</li>
	<li class="active">
		<strong>Edit</strong>
	</li>
</ol>

<div class="pull-left">
	<h2><?php echo $page_title ?></h2>
</div>		

<div class="clearfix"></div>

<br />

<div class="row">
	<div class="col-md-12">
		
		<ul class="nav nav-tabs bordered"><!-- available classes "bordered", "right-aligned" -->
			<li class="<?php echo ($this->input->get('update_password')==1) ? "" : "active" ?>">
				<a href="#profile" data-toggle="tab">
					<span class="visible-xs"><i class="entypo-user"></i></span>
					<span class="hidden-xs">Profile</span>
				</a>
			</li>
			<li class="<?php echo ($this->input->get('update_password')==1) ? "active" : "" ?>">
				<a href="#change_password" data-toggle="tab">
					<span class="visible-xs"><i class="entypo-key"></i></span>
					<span class="hidden-xs">Change Password</span>
				</a>
			</li>
			
			
		</ul>
		
		<div class="tab-content">
			<div class="tab-pane <?php echo ($this->input->get('update_password')==1) ? "" : "active" ?>" id="profile">
				<form role="form" id="edit_profile" class="form-horizontal form-groups-bordered submit_form" method="POST" action="<?php echo isset($profile_action) ? $profile_action : '';?>" data-parsley-validate>
					<?php if(is_admin() || is_client()){ ?>
						<div class="form-group">
							<label for="name" class="col-sm-4 control-label">Name</label>
							<div class="col-sm-5">
								<input type="text" class="form-control" id="name" required name="fullname" value="<?php echo (isset($user_details['fullname']) && $user_details['fullname']!="") ?  $user_details['fullname'] : ""; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="email" class="col-sm-4 control-label">Email Address</label>
							<div class="col-sm-5">
								<input type="email" class="form-control" id="email" required name="email" value="<?php echo (isset($user_details['email']) && $user_details['email']!="") ?  $user_details['email'] : ""; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="telephone" class="col-sm-4 control-label">Work Telephone Number</label>
							<div class="col-sm-5">
								<input type="text" class="form-control" id="telephone" name="telephone" value="<?php echo (isset($user_details['telephone']) && $user_details['telephone']!="") ?  $user_details['telephone'] : ""; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="cell_phone" class="col-sm-4 control-label">Cell Number</label>
							<div class="col-sm-5">
								<input type="text" class="form-control" id="cell_phone" required name="cell_phone" value="<?php echo (isset($user_details['mobile']) && $user_details['mobile']!="") ?  $user_details['mobile'] : ""; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="id_number" class="col-sm-4 control-label">ID number</label>
							<div class="col-sm-5">
								<input type="text" class="form-control" id="id_number" required name="id_number" value="<?php echo (isset($user_details['id_number']) && $user_details['id_number']!="") ?  $user_details['id_number'] : ""; ?>">
							</div>
						</div>
						<?php } ?>
						
						<?php if(is_client_manager()){ ?>
							
							<div class="form-group">
								<label for="full_name" class="col-sm-4 control-label">Full Name</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="full_name" required name="fullname" value="<?php echo (isset($user_details['fullname']) && $user_details['fullname']!="") ?  $user_details['fullname'] : ""; ?>">
								</div>
							</div>
							<div class="form-group">
								<label for="telephone" class="col-sm-4 control-label">Work Phone</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="telephone" data-parsley-type="number" required name="telephone" value="<?php echo (isset($user_details['telephone']) && $user_details['telephone']!="") ?  $user_details['telephone'] : ""; ?>">
								</div>
							</div>
							<div class="form-group">
								<label for="mobile" class="col-sm-4 control-label">Cell Phone</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="mobile" data-parsley-type="number" required name="cell_phone" value="<?php echo (isset($user_details['mobile']) && $user_details['mobile']!="") ?  $user_details['mobile'] : ""; ?>">
								</div>
							</div>
							
							<div class="form-group">
								<label for="email" class="col-sm-4 control-label">Email Address</label>
								<div class="col-sm-5">
									<input type="email" class="form-control" id="email"  required name="email" value="<?php echo (isset($user_details['email']) && $user_details['email']!="") ?  $user_details['email'] : ""; ?>">
								</div>
							</div>
							
							<!-- <div class="form-group">
								<label for="dealership_name" class="col-sm-4 control-label">Dealership Name</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="dealership_name" required name="dealership_name" value="<?php echo (isset($user_details['dealership_name']) && $user_details['dealership_name']!="") ?  $user_details['dealership_name'] : ""; ?>">
								</div>
							</div>
							
							<div class="form-group">
								<label for="town_city" class="col-sm-4 control-label">Town City</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="town_city" required name="town_city" value="<?php echo (isset($user_details['town_city']) && $user_details['town_city']!="") ?  $user_details['town_city'] : ""; ?>">
								</div>
							</div> -->
							
							<div class="form-group">
								<label for="province" class="col-sm-4 control-label">Province</label>
								<div class="col-sm-5">
									<select type="text" class="form-control required" name="province" id="province" required="" data-mask="province" placeholder="Province" autocomplete="off" >
										<?php echo $province_options ?>
									</select>
								</div>
							</div>
							
							
							<?php } ?>
							
							<div class="form-group">
								<label for="modified_date" class="col-sm-4 control-label">Last Updated Date</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="modified_date" disabled  name="modified_date" value="<?php echo (isset($user_details['modified_date']) && $user_details['modified_date']!="") ?  change_date_format($user_details['modified_date'],1) : ""; ?>">
								</div>
							</div>
							
							
							<div class="form-group">
								<div class="col-sm-offset-4 col-sm-3">
									<button type="submit" name="update" value="update" class="btn btn-primary" id="save_btn"><?php echo isset($submit_btn_text) ? $submit_btn_text : '';?></button>
									<button type="button" name="cancel" value="cancel" class="btn btn-danger cancel" data-redirect="<?php echo isset($btnCancelUrl) ? $btnCancelUrl : ''?>">Cancel</button>
								</div>
							</div>
						</form>
						
					</div>
					<div class="tab-pane <?php echo ($this->input->get('update_password')==1) ? "active" : "" ?>" id="change_password">
						
						<form role="form" id="change_password_form" class="form-horizontal form-groups-bordered submit_form" method="POST" action="<?php echo isset($change_password_action) ? $change_password_action : '';?>" data-parsley-validate>
							<div class="form-group">
								<label for="current_password" class="col-sm-4 control-label">Current Password</label>
								<div class="col-sm-5">
									<input type="password" class="form-control" id="current_password" required name="current_password" value="">
								</div>
							</div>
							
							<div class="form-group">
								<label for="new_password" class="col-sm-4 control-label">New Password</label>
								<div class="col-sm-5">
									<input type="password" class="form-control" id="new_password" required name="new_password" value="">
								</div>
							</div>
							
							<div class="form-group">
								<label for="reenter_password" class="col-sm-4 control-label">Re-enter Password</label>
								<div class="col-sm-5">
									<input type="password" class="form-control" id="reenter_password" required data-parsley-equalto="#new_password" data-parsley-equalto-message="Value should be same as new password" name="reenter_password" value="">
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-sm-offset-4 col-sm-3">
									<button type="submit" name="update" value="update" class="btn btn-primary save_btn" id="save_btn"><?php echo isset($submit_btn_text) ? $submit_btn_text : '';?></button>
									<button type="button" name="cancel" value="cancel" class="btn btn-danger cancel" data-redirect="<?php echo isset($btnCancelUrl) ? $btnCancelUrl : ''?>">Cancel</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- page based scripts  -->
		<script>
			$(document).ready(function(event) {
				$('.submit_form').on("submit", function(event) {
					$(".save_btn").attr("disabled",true);
					event.preventDefault();
					var obj = $(this);
					if(obj.parsley().validate()) {
						$.ajax({
							url: obj.attr('action'),
							type: 'POST',
							dataType:'json',
							data: obj.serialize(),
							success: function(response) {
								$(".save_btn").attr("disabled",false);
								showToastMessage(response.message, response.status);
								if (response.status == "success") {
									setTimeout("window.location.reload();", 2000);
								}
							},
							error: function(response) {
								showToastMessage("<?php echo system_messages()['server_error_message']; ?>", 'error');
								$(".save_btn").attr("disabled",false);
							}
						})
					}
				});
			});
		</script>