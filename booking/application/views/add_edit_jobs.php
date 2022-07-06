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
						<label for="job_title" class="col-sm-4 control-label">Job title</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" id="job_title" required name="job_title" value="<?php echo (isset($job_data['title']) && $job_data['title']!="") ?  $job_data['title'] : ""; ?>">
						</div>
					</div>
					
				
					<!-- <div class="form-group">
						<label for="job_family" class="col-sm-4 control-label">Job family</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" id="job_family" required name="job_family" value="<?php // echo (isset($job_data['family']) && $job_data['family']!="") ?  $job_data['family'] : ""; ?>">
						</div>
					</div>
					
									
					<div class="form-group">
						<label for="job_description" class="col-sm-4 control-label">Job description</label>
						<div class="col-sm-5">
						<textarea class="form-control autogrow" id="job_description" required name="job_description" ><?php // echo (isset($job_data['description']) && $job_data['description']!="") ?  $job_data['description'] : ""; ?></textarea>
						</div>
					</div> -->
					
				
					<div class="form-group">
						<label for="cost" class="col-sm-4 control-label">Cost</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" id="cost" data-parsley-type="number" required name="cost" value="<?php echo (isset($job_data['cost']) && $job_data['cost']!="") ?  $job_data['cost'] : ""; ?>">
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
						setTimeout("window.location.replace(base_url + 'products/view')", 2000);
					}
				},
				error: function(response) {
					showToastMessage("<?php echo system_messages()['server_error_message']; ?>", 'error');
				}
			})
		}
	});
</script>