<style>
footer 
{
	position: fixed;
	width: 95%;
	bottom: 0;
}
</style>
<div class="row">
	<div class="col-md-12">
		
		<ol class="breadcrumb bc-3" >
			<li>
				<a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i>Home</a>
			</li>
			<li class="active">
				<strong><?php echo $page_title ?></strong>
			</li>
		</ol>
		
	</div>
</div>
<div class="row">
	<form role="form" id="add_update_jobs" class="form-horizontal form-groups-bordered" method="POST" action="<?php echo isset($form_action) ? $form_action : '';?>" data-parsley-validate>
		<div class="col-md-12">
			<div class="panel panel-primary" data-collapsed="0">
				<div class="panel-heading">
					<div class="panel-title"><?php echo $short_message ?></div>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label for="full_name" class="col-sm-4 control-label">Full Name</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" id="full_name" required name="fullname" value="<?php echo (isset($job_data['title']) && $job_data['title']!="") ?  $job_data['title'] : ""; ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="work_phone" class="col-sm-4 control-label">Work Phone</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" id="work_phone" data-parsley-type="number" required name="work_phone" value="<?php echo (isset($job_data['work_phone']) && $job_data['work_phone']!="") ?  $job_data['work_phone'] : ""; ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="cell_phone" class="col-sm-4 control-label">Cell Phone</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" id="cell_phone" data-parsley-type="number" required name="cell_phone" value="<?php echo (isset($job_data['cell_phone']) && $job_data['cell_phone']!="") ?  $job_data['cell_phone'] : ""; ?>">
						</div>
					</div>
					
					<div class="form-group">
						<label for="email" class="col-sm-4 control-label">Email Address</label>
						<div class="col-sm-5">
							<input type="email" class="form-control" id="email"  required name="email" value="<?php echo (isset($job_data['email']) && $job_data['email']!="") ?  $job_data['email'] : ""; ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="province" class="col-sm-4 control-label">Province</label>
						<div class="col-sm-5">
							<select type="text" class="form-control required" name="province" id="province" required="" data-mask="province" placeholder="Province" autocomplete="off" >
								<?php echo $province_options ?>
							</select>
						</div>
					</div>
					
				</div>
				
			</div>
		</div>
		<div class="col-md-12">
			<div class="panel-body">
				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-3">
						<button type="submit" name="update" value="update" class="btn btn-primary" id="save_btn"><?php echo isset($btnSubmitText) ? $btnSubmitText : '';?></button>
						<button type="button" name="cancel" value="cancel" class="btn btn-danger cancel" data-redirect="<?php echo isset($btnCancelUrl) ? $btnCancelUrl : ''?>">Cancel</button>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
<script>
	$('#add_update_jobs').on("submit", function(event) {
		event.preventDefault();
		var obj = $(this);
		if(obj.parsley().validate()) {
			$.ajax({
				url: obj.attr('action'),
				type: 'POST',
				dataType:'json',
				data: obj.serialize(),
				success: function(response) {
					//var res = JSON.parse(response);
					showToastMessage(response.message, response.status);
					if (response.status == "success") {
						setTimeout("window.location.replace(base_url + 'users/view')", 2000);
					}
				},
				error: function(response) {
					showToastMessage("<?php echo system_messages()['server_error_message']; ?>", 'error');
				}
			})
		}
	});
</script>