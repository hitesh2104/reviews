<style>
	footer 
	{
		position: fixed;
		width: 95%;
		bottom: 0;
	}
	i.custom_font_size{
		font-size: 16px;
		margin-right: 20px;
	}
</style>
<div class="row">
	<div class="col-md-12">
		
		<ol class="breadcrumb bc-3" >
			<li>
				<a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i>Home</a>
			</li>
			<li class="active">
				<a href="<?php echo base_url("bookings/view"); ?>"><?php echo $page_title ?></a>
			</li>
			<li class="active">
				<strong><?php echo  $short_message ?></strong>
			</li>
		</ol>
		
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
			<div class="panel-heading">
				<div class="panel-title"><?php echo $short_message ?></div>
			</div>
			<div class="panel-body">
				<div class="form-horizontal form-groups-bordered">
					<!-- <div class="form-group">
						<label class="col-sm-3 control-label">Please select your business unit</label>
						
						<div class="col-sm-5">
							<select class="form-control" name="jobs" id="business_select" disabled >
								<option value=""><?php echo 'Please select your business unit'; ?></option>
								<?php echo $business_unit_options ?>
							</select>
						</div>
					</div> 
					<hr>
				-->
					<!-- <div class="form-group">
						<label class="col-sm-3 control-label">Please select the Job Family</label>
						
						<div class="col-sm-5">
							<select class="form-control" name="jobs" id="family_select" disabled >
								<option value=""><?php echo 'Please select the Job Family'; ?></option>
								<?php echo $job_family_options ?>
							</select>
						</div>
					</div>
					<hr> -->
					<div class="form-group">
						<label class="col-sm-3 control-label">Selected Job</label>
						
						<div class="col-sm-5">
							<select class="form-control" name="jobs" id="job_select" disabled>
								<option value=""><?php echo 'Please select a job'; ?></option>
								<?php echo $job_list ?>
							</select>
						</div>
					</div>
					
					<div class="form-group ">
					<label for="po_number" class="col-sm-3 control-label">PO Number</label>
					<div class="col-sm-2">
						<input type="text" class="form-control" disabled id="po_number" required name="po_number" value="<?php echo (isset($booking_data['po_number']) && $booking_data['po_number']!="") ? $booking_data['po_number'] : ""; ?>">
						
					</div>
				</div>
					<hr>
					<!-- <div class="col-md-6">
						<div class="form-group">
							<label class="col-sm-5 control-label">Please select Skills assessments </label>
							
							<div class="col-sm-7">
								<select class="form-control" name="type" id="type_select" >
									<option value=""><?php echo 'Please select a Skills assessments'; ?></option>
									<?php echo $assessments_type_list ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-5 control-label">Selected Additional Assessments</label>
							<div class=" col-sm-7">
								<?php echo $additional_assessments_content ?>
							</div>
						</div>
					</div> -->
					
					<!-- <div class="col-md-6">
						<br>
						<br>
						<br>
						<div class="form-group pull-left">
							<label class="col-sm-3 control-label">Feedback</label>
							<div class=" col-sm-9">
								<?php echo $feedback_content ?>
							</div>
						</div>
					</div> -->
					<!-- <div class="clearfix"></div>
					<hr> -->
					<!-- <div class="col-md-12">
						<div class="form-group">
							<label class="col-sm-3 control-label">Please select verification type </label>
							
							<div class="col-sm-7">
								<select class="form-control" name="verification_type" id="verification_type" >
									<option value=""><?php echo 'Please select a verification type'; ?></option>
									<?php echo $verification_type_list ?>
								</select>
							</div>
						</div>
						<div class="clearfix">	</div>
						<div class="form-group ">
							<label class="col-sm-3 control-label">Selected Verification checks</label>
							<div class=" col-sm-6">
								<?php echo $verification_content ?>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
					<hr> -->
					
					<div class="row">
						<div class="">
							<div class="form-group">
								<label for="total_cost" class="col-sm-4 control-label">Total Cost</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="total_cost" name="total_cost" value="<?php echo (isset($booking_data['cost']) && $booking_data['cost']!="") ?  $booking_data['cost'] : ""; ?>" disabled>
								</div>
							</div>
						</div>
						<div class="">
							<div class="form-group">
								<label for="total_users" class="col-sm-4 control-label">Total Assessed Candidates</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="total_users" name="total_users" value="<?php echo (isset($booking_data['total_users']) && $booking_data['total_users']!="") ?  $booking_data['total_users'] : ""; ?>" disabled>
								</div>
							</div>
							
						</div>
						
						
						<div class="">
							<div class="form-group">
								<label for="booking_date" class="col-sm-4 control-label">Booking Date</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="booking_date" name="booking_date" value="<?php echo (isset($booking_data['created_date']) && $booking_data['created_date']!="") ?  $booking_data['created_date'] : ""; ?>" disabled>
								</div>
							</div>
							
						</div>
						
						<div class="clearfix"></div>
						<div class="form-group">
							<label for="notes" class="col-sm-4 control-label">Notes or instructions for the assessment team? (optional)</label>
							<div class="col-sm-8">
								<textarea class="form-control" disabled rows="8" id="notes" name="notes" placeholder="Notes"><?php echo (isset($booking_data['notes']) && $booking_data['notes']!="") ?  $booking_data['notes'] : ""; ?></textarea>
							</div>
						</div>
						
						
					</div>
					
					<!-- <div class="row">
						<div class="clearfix"></div>
						<div class="col-md-12 selected_assessment_box <?php echo ($assessment_table_data!='') ? '' : 'hide' ?>">
							<hr class="less_mg">
							<h5><b>Assessments Selected</b></h5>
							<div class="selected_assessment_content">
								<table class="table">
									<thead>
										<tr>
											<th class="col-md-2">Type</th>
											<th>Assessment</th>
										</tr>
									</thead>
									<tbody class="selected_assessment_body"><?php echo $assessment_table_data ?></tbody>
								</table>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="clearfix"></div>
						<div class="col-md-12 selected_verification_box <?php echo ($verification_table_data!='') ? '' : 'hide' ?>">
							<hr class="less_mg">
							<h5><b>Verifications Selected</b></h5>
							<div class="selected_verification_content">
								<table class="table">
									<thead>
										<tr>
											<th class="col-md-2">Type</th>
											<th>Verification</th>
										</tr>
									</thead>
									<tbody class="selected_verification_body"><?php echo $verification_table_data ?></tbody>
								</table>
							</div>
						</div>
					</div> -->
					
				</div>
			</div>
		</div>

		<div class="panel panel-primary" data-collapsed="0">
			<div class="panel-heading">
				<div class="panel-title">  Assessed Candidates</div>
			</div>
			<div class="panel-body">
				<table class="table table-bordered dt_table" id="table-1" data-source="<?php echo $data_source; ?>">
					<thead>
						<?php echo $table_elements ?>
					</thead>
					<tbody></tbody>
					<tfoot>
						<?php echo $table_elements ?>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>


<script>
	$(document).ready(function() {
		var $family_select = $("#family_select");
		var $business_select = $("#business_select");
		var $job_select = $("#job_select");
		var family_value = $job_select.find("option:selected").attr("data-family");
		console.log(family_value);
		$job_select.find("option[data-family='"+  family_value  +"']").removeClass('hide');
		var business_select = $family_select.find('option[value="'+ family_value +'"]').attr("data-business");
		console.log(business_select);
		$business_select.val(business_select);
		$family_select.find("option[data-business='"+  business_select +"']").removeClass('hide');
		$family_select.val(family_value);
		
		$("#type_select").on("change",function(){
			var type_select = $(this);
			$('.assesment_check').addClass('hide');
			
			if(type_select.val() == ""){
				$(".type_select_value").addClass('hide');
			} else {
				$(".type_select_value").removeClass('hide');
				$('.assesment_check').each(function(){
					if($(this).data("assessmenttype") == type_select.val()){
						$(this).removeClass('hide');
					}
				});
			}
		});
		
		$("#verification_type").on("change",function(){
			var type_select = $(this);
			$('.verification_check').addClass('hide');
			if(type_select.val() == ""){
				$(".type_verification_value").addClass('hide');
			} else {
				$(".type_verification_value").removeClass('hide');
				$('.verification_check').each(function(){
					if($(this).data("type") == type_select.val()){
						$(this).removeClass('hide');
					}
				});
			}
		})
	});
</script>






