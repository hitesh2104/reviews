<style>
	footer 
	{
		position: fixed;
		width: 95%;
		bottom: 0;
	}
	#uploadifive-upload_document{
		line-height: 17px !important;
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
	<form role="form" id="add_edit_documents" enctype='multipart/form-data'  class="form-horizontal form-groups-bordered" method="POST" action="<?php echo isset($form_action) ? $form_action : '';?>" data-parsley-validate>
		<div class="col-md-12">
			<div class="panel panel-primary" data-collapsed="0">
				<div class="panel-heading">
					<div class="panel-title"><?php echo $short_message ?></div>
				</div>
				<div class="panel-body">
								
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-9"><b>Assessment Consent Form <a href="<?php echo base_url('uploads/consent_form.pdf'); ?>" download>(Click to download pdf)</a></b></div>
									<div class="col-md-3">
										<div class="form-group">
											
											<input type="file" name="assessment_consent_form" class="form-control file2 inline btn btn-primary" data-label="<i class='fa fa-upload'></i> Attach File"    style="height:auto !important; line-height:auto !important;" >
											
										</div> 
									</div>
									
								</div>
								<div class="clearfix"></div>
								<hr>
								<div class="col-md-12">
									<div class="col-md-9"><b>Copy of ID</b></div>
									<div class="col-md-3">
										<div class="form-group">
											
											<input type="file" name="copy_of_ids" class="form-control file2 inline btn btn-primary" data-label="<i class='fa fa-upload'></i> Attach File"    style="height:auto !important; line-height:auto !important;" >
											
										</div> 
									</div>
									
								</div>
								<div class="clearfix"></div>
								<hr>
								<?php 
								if(!empty($verifications[0])){ ?>
								<div class="col-md-12">
									<div class="col-md-9"><b>Verifications Consent Form <a href="<?php echo base_url('uploads/mie-consent.pdf'); ?>" download>(Click to download pdf)</a> </b></div>
									<div class="col-md-3">
										<div class="form-group">
											
											<input type="file" name="verification_consent_form"  class="form-control file2 inline btn btn-primary" data-label="<i class='fa fa-upload'></i> Attach File"    style="height:auto !important; line-height:auto !important;" >
											
										</div> 
									</div>
									
								</div>
								<div class="clearfix"></div>
								<hr>
								<?php } ?>
								<?php if(in_array('Qualifications', $verification_type)) { ?>
								<div class="col-md-12">
									<h4><b>Qualifications</b></h4>
									<div class="col-md-9"><b>Please upload certified copies of all your qualifications</b></div>
									<div class="col-md-3">
										<div class="form-group">
											
											<input type="file" name="upload_certificate_copy" class="form-control file2 inline btn btn-primary" data-label="<i class='fa fa-upload'></i> Attach File"    style="height:auto !important; line-height:auto !important;" >
											
										</div> 
									</div>
									
								</div>
								<div class="clearfix"></div>
								<hr>
								<?php } ?>
								<?php if(in_array('Reference Checks', $verification_type)) { ?>
								<div class="col-md-12">
									<h4><b>Reference checks</b></h4>
									<div class="col-md-9"><b>Please upload your latest CV, including contactable references.</b></div>
									<div class="col-md-3">
										<div class="form-group">
											
											<input type="file" name="upload_latest_cv" class="form-control file2 inline btn btn-primary" data-label="<i class='fa fa-upload'></i> Attach File"    style="height:auto !important; line-height:auto !important;" >
											
										</div> 
									</div>
									
								</div>
								<div class="clearfix"></div>
								<hr>
								<?php } ?>
								<?php if(in_array('Permits', $verification_type)) { ?>
								<div class="col-md-12">
									<h4><b>Permits</b></h4>
									<div class="col-md-9"><b>1. Please upload a copy of the front page of your passport bearing your biographical information</b></div>
									<div class="col-md-3">
										<div class="form-group">
											
											<input type="file" name="copy_of_passport" class="form-control file2 inline btn btn-primary" data-label="<i class='fa fa-upload'></i> Attach File"    style="height:auto !important; line-height:auto !important;" >
											
										</div> 
									</div>
									<div class="col-md-9"><b>2. Copy of the applicant&#39;s temporary/permanent residence permit</b></div>
									<div class="col-md-3">
										<div class="form-group">
											
											<input type="file" name="copy_of_address"   class="form-control file2 inline btn btn-primary" data-label="<i class='fa fa-upload'></i> Attach File"    style="height:auto !important; line-height:auto !important;" >
											
										</div> 
									</div>
									<div class="col-md-9"><b>3. Copy of permanent residence endorsement (if applicable)</b></div>
									<div class="col-md-3">
										<div class="form-group">
											
											<input type="file" name="copy_of_permanent_address" class="form-control file2 inline btn btn-primary" data-label="<i class='fa fa-upload'></i> Attach File"    style="height:auto !important; line-height:auto !important;" >
											
										</div> 
									</div>
									
								</div>
							<?php } ?>	
							</div>
							
							<div class="clearfix"></div>
							<hr>
							<div class="form-group">
								<div class="col-sm-offset-3 col-sm-6">
									<input type="hidden" name="previous_docs" value='<?php echo $document_list ?>'>
									<button type="submit" name="update" value="update" class="btn btn-primary" id="save_btn"><?php echo isset($btnSubmitText) ? $btnSubmitText : '';?></button>
									<button type="button" name="cancel" value="cancel" class="btn btn-danger cancel" data-redirect="<?php echo isset($btnCancelUrl) ? $btnCancelUrl : ''?>">Cancel</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>

		<script>
			$(document).ready(function() {
				
				<?php if($this->session->flashdata('msg')){ ?>
					showToastMessage("<?php echo $this->session->flashdata('msg') ?>", 'info');
					<?php } ?>
					
					$(document).on("click", '.remove_this_document', function(){
						var re_obj = $(this);
						var ori_html = re_obj.html();
						re_obj.html('<i class="fa fa-spin fa-spinner"></i> Removing...!');
						var file_name = re_obj.data('file_path');
						$.post(base_url+'documents/remove_doc', { file_path : file_name  }, function(data) {
							if(data > 0){
								re_obj.parents('.uploaded_file').remove();
								
							} else {
								showToastMessage("<?php echo system_messages()['server_error_message']; ?>", 'error');
								setTimeout(function(){
									re_obj.html(ori_html);
								}, 500);
							}
						}).fail(function(xhr, status, error) {
							showToastMessage("<?php echo system_messages()['server_error_message']; ?>", 'error');
							setTimeout(function(){
								re_obj.html(ori_html);
							}, 500);
						});
						
					});
					
			/*	$('#add_edit_documents').on("submit", function(event) {
					event.preventDefault();
					var obj = $(this);
					if(obj.parsley().validate()) {
						$.ajax({
							url: obj.attr('action'),
							type: 'POST',
							dataType:'json',
							data: obj.serialize(),
							success: function(response) {
								
								showToastMessage("Document sent successfully.", "success");
								if (response.status == "success") {
									setTimeout("window.location.reload()", 800);
								}
							},
							error: function(response) {
								showToastMessage("<?php echo system_messages()['server_error_message']; ?>", 'error');
							}
						})
					}
				});*/
			});
		</script>
