<style>
footer 
{
	position: fixed;
	width: 95%;
	bottom: 0;
}

.less_mg{
	margin-top: 10px;
	margin-bottom: 10px;
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
	<form role="form" id="add_update_bookings" class="form-horizontal form-groups-bordered" method="POST" action="<?php echo isset($form_action) ? $form_action : '';?>" data-parsley-validate>
		<div class="col-md-12">
			<div class="panel panel-primary" data-collapsed="0">
				<div class="panel-heading">
					<div class="panel-title"><?php echo $short_message ?></div>
				</div>
				<div class="panel-body">
					
					<div class="form-group">
						<label class="col-sm-3 control-label">Please select the Job/Role</label>
						
						<div class="col-sm-5">
							<select class=" select2" name="jobs" id="job_select" required>
								<option value=""><?php echo 'Please select the Job/Role'; ?></option>
								<option value="other" data-cost="0">Other</option>
								<?php echo $job_list ?>
							</select>
						</div>
					</div>
					
					<div class="row hide" id="other_job_block">
					<div class="col-md-12">
					 <div class="form-group ">
						<label for="job_title_field" class="col-sm-3 control-label">Job Title</label>
						<div class="col-md-3 col-sm-3">
							<input type="text" class="form-control" id="job_title_field" placeholder="Enter Your Job Title" required name="job_title_field" value="">
							
						</div>
					</div>
					<div class="form-group ">
						<label for="job_desc_field" class="col-sm-3 control-label">Job Description</label>
						<div class="col-md-3 col-sm-3">
							<textarea class="form-control" id="job_desc_field" rows="3" placeholder="Briefly Describe Your Job Title" name="job_desc_field" value=""></textarea>
							
						</div>
					</div>
				 	<div class="col-md-12">
					<div class="col-md-3"><b>Upload Job Description</b></div>
					<div class="col-md-3 col-sm-3">
						<div class="form-group">
							
							<input type="file" name="copy_of_ids" class="uploadifive_file" data-label="<i class='fa fa-upload'></i>"    style="height:auto !important; line-height:auto !important;" >
							<input type="hidden" class="uploaded_job_desc_file_path" name="uploaded_job_desc_file_path" value="">
						</div> 
					</div>
					<div class="col-md-3">
					<span class="text-muted test-primary" class="file_name_preivew" ></span>
					</div>
					
				</div>
					</div>
					</div>
					
					<div class="form-group ">
						<label for="po_number" class="col-sm-3 control-label">PO Number</label>
						<div class="col-sm-2">
							<input type="text" class="form-control" id="po_number" required name="po_number" value="<?php echo (isset($booking_data['po_number']) && $booking_data['po_number']!="") ? $booking_data['po_number'] : ""; ?>">
							
						</div>
					</div>
					<hr>
					
					<div class="clearfix"></div>
					<div class="form-group">
						<label for="notes" class="col-sm-4 control-label">Notes or instructions for the assessment team? (optional)</label>
						<div class="col-sm-8">
							<textarea class="form-control" rows="8" id="notes" name="notes" placeholder="Notes"><?php echo (isset($booking_data['notes']) && $booking_data['notes']!="") ?  $booking_data['notes'] : ""; ?></textarea>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="form-group ">
						<label for="total_candidates" class="col-sm-3 control-label">Total Candidates</label>
						<div class="col-sm-2">
							<input type="text" class="form-control" min="1" max="15" data-parsley-type="number" id="total_candidates" required name="total_candidates" value="<?php echo (isset($booking_data['total_candidates']) && $booking_data['total_candidates']!="") ?  $booking_data['total_candidates'] : ""; ?><?php echo (empty($booking_data['total_candidates'])) ? "1" : "" ?>">
							
						</div>
					</div>
					<div class="clearfix"></div>
					
					<hr class="less_mg">
					
					<h5><b>Please add candidates to be assessed</b></h5>
					<hr>
					<h5><b>Candidate Details</b></h5>
					<div class="row all_candidates">
						<?php if(empty($candidates[@key($candidates)])){ ?>
							<div class="candidate_box">
								
								<div class="col-md-3 col-sm-3">
									<input type="text" class="form-control" required name="candidate[1][name]" placeholder="Name and Surname">
								</div>
								<div class="col-md-3 col-sm-3">
									<input type="text" class="form-control" required name="candidate[1][id_no]" placeholder="ID Number">
								</div>
								<div class="col-md-3 col-sm-3">
									<input type="text" class="form-control" required name="candidate[1][email]" data-parsley-type="email" placeholder="Email Address">
								</div>
								<div class="col-md-2 col-sm-2">
									<input type="text" class="form-control" required name="candidate[1][cellphone]" placeholder="Cellphone number">
								</div>
								<div class="col-md-1 col-sm-1 hide">
									<a href="javascript:;" class="btn btn-xs btn-success add_more_candidate" title="Add More Candidates"><i class="fa fa-plus"></i> </a>
								</div>
								
								<div class="clearfix"></div>
							</div>
							<?php } else { ?>
								<?php $count=1; foreach($candidates as $key => $candidate){ ?>
									<div class="candidate_box">
										<?php if($count > 1){ ?>
											<hr class="less_mg">
											<?php } ?>
											<div class="col-md-3 col-sm-3">
												<input type="text" class="form-control" required name="candidate[<?php echo $count; ?>][name]" value="<?php echo $candidate['fullname'] ?>" placeholder="Name and Surname">
											</div>
											<div class="col-md-3 col-sm-3">
												<input type="text" class="form-control" required name="candidate[<?php echo $count; ?>][id_no]" value="<?php echo $candidate['id_number'] ?>" placeholder="ID Number">
											</div>
											<div class="col-md-3 col-sm-3">
												<input type="text" class="form-control" required name="candidate[<?php echo $count; ?>][email]" data-parsley-type="email" value="<?php echo $candidate['email'] ?>" placeholder="Email Address">
											</div>
											<div class="col-md-2 col-sm-2">
												<input type="text" class="form-control" required name="candidate[<?php echo $count; ?>][cellphone]" value="<?php echo $candidate['telephone'] ?>" placeholder="Cellphone number">
											</div>
											<input type="hidden" name="candidate[<?php echo $count; ?>][id]" value="<?php echo $candidate['id'] ?>">
											<div class="col-md-1 col-sm-1 hide">
												<a href="javascript:;" class="btn btn-xs btn-success add_more_candidate" title="Add More Candidates"><i class="fa fa-plus"></i> </a>
											</div>
											<div class="clearfix"></div>
										</div>
										<?php $count++;
									} 
								} ?>
							</div>
							
							
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
							
							
							
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="panel-body">
						<div class="clearfix"></div>
						<div class="form-group pull-right">
							<label for="total_cost" class="col-sm-6 control-label"> Total Estimated Cost </label>
							<div class="col-sm-5">
								<input type="text" class="form-control" id="total_cost" readonly required name="total_cost" value="<?php echo (isset($booking_data['cost']) && $booking_data['cost']!="") ?  $booking_data['cost'] : ""; ?>">
							</div>
						</div>
						<div class="clearfix"></div>
						<hr class="less_mg">
						
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
			var $A; var $B=0; $C = 0; var $E = 0; var $F =0;  var $G = 1;
			$(document).ready(function() {
				
				$('#add_update_bookings').parsley({ excluded: "input[type=button], input[type=submit], input[type=reset], input[type=hidden], [disabled], :hidden" });
				
				var $family_select = $("#family_select");
				var $business_select = $("#business_select");
				var $job_select = $("#job_select");
				
				
				<?php if($this->uri->segment(2) == "edit"){ ?>
					var family_value = $job_select.find("option:selected").attr("data-family");
					$job_select.find("option[data-family='"+  family_value  +"']").removeClass('hide');
					var business_select = $family_select.find('option[value="'+ family_value +'"]').attr("data-business");
					$business_select.val(business_select);
					$family_select.find("option[data-business='"+  business_select +"']").removeClass('hide');
					$family_select.val(family_value);
					
					<?php } else { ?>
						$job_select.find("option").removeClass('hide');
						<?php } ?>
						
						var add_remove_counter = $(".candidate_box").length;
						$("#total_candidates").on("keyup", function(){
							var totalC = $(this);
							var total_candidates = totalC.val();
							if(total_candidates != 0){
								
								if($(".candidate_box").length > total_candidates){
									var total_remove =  $(".candidate_box").length - total_candidates; 
									for(var i = 0; i < total_remove; i++){
										$(".candidate_box:last").remove();
									}
								} else {
									var total_new = total_candidates - $(".candidate_box").length;
									for(var i = 1; i <= total_new; i++){
										
										add_remove_counter++;
										$(".all_candidates").append('<div class="candidate_box"><hr class="less_mg"><div class="col-md-3 col-sm-3"><input type="text" class="form-control" required name="candidate['+add_remove_counter+'][name]" placeholder="Name and Surname"></div><div class="col-md-3 col-sm-3"><input type="text" class="form-control" required name="candidate['+add_remove_counter+'][id_no]" placeholder="ID Number"></div> <div class="col-md-3 col-sm-3"> <input type="text" class="form-control" required name="candidate['+add_remove_counter+'][email]" data-parsley-type="email" placeholder="Email Address"></div> <div class="col-md-2 col-sm-2 "> <input type="text" class="form-control" required name="candidate['+add_remove_counter+'][cellphone]" placeholder="Cellphone number"> </div> <div class="col-md-1 col-sm-1"> <a href="javascript:;" class="btn btn-xs btn-danger remove_candidate" title="Remove This Candidates"><i class="fa fa-minus"></i> </a> </div> <input type="hidden" name="candidate['+add_remove_counter+'][id]" value="">	<div class="clearfix"></div></div>')
									}
								}
							}
						});
						
						
						$business_select.on("change", function(){
							var business_obj = $(this);
							$family_select.find("option[value!='']").addClass('hide');
							$family_select.val("");
							$family_select.find("option[data-business='"+ business_obj.val() +"']").removeClass('hide');
						});
						
			/*$family_select.on("change", function(){
				var family_obj = $(this);
				$job_select.find("option[value!='']").addClass('hide');
				$job_select.val("").trigger('change.select2');
				$job_select.find("option[data-family='"+ family_obj.val() +"']").removeClass('hide');
			});*/
			
			
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
			
		// calculate total cost 
		$job_select.on("change",function(event){
			var $job_select_obj = $(this);
			$A =  $job_select_obj.find("option:selected").data("cost");
			calculate_total_cost($A, $B, $C, $E, $F, $G);
			
			if($job_select_obj.val() == "other"){
				$("#other_job_block").removeClass('hide');
			} else {
				$("#other_job_block").addClass('hide');
			}
		});
		
		$("#feedback_manager").on("change",function(){
			if($(this).is(":checked")){
				$E = $(this).data("cost");
			} else {
				$E = 0;
			}
			calculate_total_cost($A, $B, $C, $E, $F, $G);
		})
		$("#feedback_candidate").on("change",function(){
			if($(this).is(":checked")){
				$F = $(this).data("cost");
			} else {
				$F = 0;
			}
			calculate_total_cost($A, $B, $C, $E, $F, $G);
		});
		
		$(".additional_assessments").on("change",function(){
			$B = 0;
			$(".additional_assessments:checked").each(function(){
				$B += $(this).data("cost");
			});
			calculate_total_cost($A, $B, $C, $E, $F, $G);
			
			// only on adding a new booking 
			<?php //if($this->uri->segment(2) == "add"){ ?>
				
				$(".selected_assessment_box").removeClass('hide');
				var $ass_type = $("#type_select option:selected").text();
				var $assess_val = $(this).val();
				if($(this).is(":checked")){
					
					$(".selected_assessment_body").append("<tr class='"+ $ass_type +"_in_table' data-ass_type='"+ $assess_val +"'>\
						<td>"+ $ass_type +"</td>\
						<td>"+ $assess_val +"</td>\
						</tr>\
						");
				} else {
					
					$("tr[data-ass_type='"+ $assess_val +"']").remove();
				// 	console.log($(".selected_assessment_body").html());
				if($.trim($(".selected_assessment_body").html()) == ""){
					$(".selected_assessment_box").addClass('hide');
				}
			}
			<?php //} ?>
		});
		
		
		$(".verifications_list").on("change",function(){
			$C = 0;
			$(".verifications_list:checked").each(function(){
				$C += $(this).data("cost");
			});
			calculate_total_cost($A, $B, $C, $E, $F, $G);
			
			// only on adding a new booking 
			<?php //if($this->uri->segment(2) == "add"){ ?>
				
				$(".selected_verification_box").removeClass('hide');
				var $ass_type = $("#verification_type option:selected").text();
				var $assess_val = $(this).val();
				if($(this).is(":checked")){
					$(".selected_verification_body").append("<tr class='"+ $ass_type +"_in_table' data-ass_type='"+ $assess_val +"'>\
						<td>"+ $ass_type +"</td>\
						<td>"+ $assess_val +"</td>\
						</tr>\
						");
				} else {
					
					$("tr[data-ass_type='"+ $assess_val +"']").remove();
					
					if($.trim($(".selected_verification_body").html()) == ""){
						$(".selected_verification_box").addClass('hide');
					}
				}
				<?php //} ?>
			});
		
		
		
		$("#total_candidates").on("keyup",function(){
			$G = $(this).val();
			calculate_total_cost($A, $B, $C, $E, $F, $G);
		});
		
		
		$('#add_update_bookings').on("submit", function(event) {
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
						setTimeout("window.location.replace(base_url + 'bookings/view')", 2000);
					}
				},
				error: function(response) {
					showToastMessage("<?php echo system_messages()['server_error_message']; ?>", 'error');
				}
			})
			}
		});
		
	//  add more candidiates
	
	$(document).on("click",".remove_candidate",function(){
		var obj = $(this);
		obj.parents(".candidate_box").remove();
		
	});
});

function calculate_total_cost($A = 0, $B = 0, $C = 0, $E = 0, $F = 0, $G = 0){
	$A =  $("#job_select").find("option:selected").data("cost");
	// console.log("A = " + $A);  
	if($("#feedback_manager").is(":checked")){
		$E = $("#feedback_manager").data("cost");
	} else {
		$E = 0;
	}
	// console.log("E = " + $E);  
	
	if($("#feedback_candidate").is(":checked")){
		$F = $("#feedback_candidate").data("cost");
	} else {
		$F = 0;
	}
	
	// console.log("F = " + $F);  
	
	$B = 0;
	$(".additional_assessments:checked").each(function(){
		$B += $(this).data("cost");
	});
	// console.log("B = " + $B);  
	
	
	$C = 0;
	$(".verifications_list:checked").each(function(){
		$C += parseFloat($(this).data("cost"));
	});
	$C = Math.round($C * 100) / 100;
	// console.log("C = " + ($C * 100) /  100);
	
	$G = $("#total_candidates").val();
	// console.log("G = " + $G);  
	
		// var total_cost = ((($A+$B+$E)*$G) + ($F));
		var total_cost = ( ($G * ($A + $B + $F)) + ($C + $E) );
		total_cost = Math.round(total_cost * 100) / 100;
		
		if($("#job_select").val() == "other"){
			total_cost = 0;
		}
		
		$("#total_cost").val(total_cost);
	}
	
</script>