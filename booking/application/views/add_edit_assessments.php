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
	<form role="form" id="add_update_assessments" class="form-horizontal form-groups-bordered" method="POST" action="<?php echo isset($form_action) ? $form_action : '';?>" data-parsley-validate>
		<div class="col-md-12">
			<div class="panel panel-primary" data-collapsed="0">
				<div class="panel-heading">
					<div class="panel-title"><?php echo $short_message ?></div>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label for="name" class="col-sm-4 control-label">Name</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" id="name" required name="name" value="<?php echo (isset($assessments_data['name']) && $assessments_data['name']!="") ?  $assessments_data['name'] : ""; ?>">
						</div>
					</div>
					
					
					<!-- <div class="form-group">
						<label for="type" class="col-sm-4 control-label">Type</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" id="type" required name="type" value="<?php echo (isset($assessments_data['type']) && $assessments_data['type']!="") ?  $assessments_data['type'] : ""; ?>">
						</div>
					</div> -->
					
					<div class="form-group">
						<label class="col-sm-4 control-label">Please Select Type</label>
						
						<div class="col-sm-5">
							<select class="form-control" required name="type" id="type" required>
								<option value=""><?php echo 'Please select a type'; ?></option>
								<?php echo $type_list ?>
							</select>
						</div>
					</div>
					
					
					<div class="form-group">
						<label for="description" class="col-sm-4 control-label">Description</label>
						<div class="col-sm-5">
							<textarea class="form-control autogrow" id="description" required name="description" ><?php echo (isset($assessments_data['description']) && $assessments_data['description']!="") ?  $assessments_data['description'] : ""; ?></textarea>
						</div>
					</div>
					
					
					<div class="form-group">
						<label for="cost" class="col-sm-4 control-label">Cost</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" id="cost" required name="cost" value="<?php echo (isset($assessments_data['cost']) && $assessments_data['cost']!="") ?  $assessments_data['cost'] : ""; ?>">
						</div>
					</div>
					
					<!-- <div class="form-group">
						<label for="cost" class="col-sm-4 control-label">Attachment Needed</label>
						<div class=" col-sm-5">
							<div class="radio">
								<label>
									<input type="radio" name="attachment_needed" id="attachment_needed_1" value="1" <?php echo (isset($assessments_data['attachment_needed']) && $assessments_data['attachment_needed']==1) ?  'checked	' : ""; ?> >Yes 
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="attachment_needed" id="attachment_needed_2" value="0" <?php echo (isset($assessments_data['attachment_needed']) && $assessments_data['attachment_needed']==0) ?  'checked' : ""; ?>>No
								</label>
							</div>
						</div>
					</div> -->
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
	$('#add_update_assessments').on("submit", function(event) {
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