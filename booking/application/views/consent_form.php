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
.bootbox-body {
	color: black;
}
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
				<h1>Consent Form</h1>
				<hr>
				<p>
					I hereby agree to undergo the psychometric assessment administered by the Imperial Assessment Centre. I also authorise them to reveal and discuss the results of these assessments with the management of the relevant division/department that requested the assessments. 
					<br><br>
					I understand that the results of the assessments will be used for selection and/or development purposes. I understand that any employment that may be offered to me following the assessment and interview(s) will be totally at the discretion of the company and that said employment will be totally conditional to the written acceptance of terms and conditions of employment.
					<br><br>
					Psychometric tests are governed by the applicable legal entity that ensures validity and reliability of psychometric testing. Although all of these tests have valid and reliable norms, some of the tests are still under development/review as required from the entity governing psychometric tests.
				</p>
				<br><br>
				<h4 class="text-danger"><b>Please read each statement carefully</b></h4>
				<hr>
				<div class="form-steps">
					
					<div class="step current" id="step-1">
						<div class="row col-md-12">
							<div class="form-group">
								<label for="" id="participating" class="control-label"><b>I hereby acknowledge that I am voluntarily participating in the psychometric assessment. <span class="text-danger">*</span></b></label>					
								<br>			
								<input type="radio" name="participating" id="participating_1" required="" value="1"  /> Agree
								<br>
								<input type="radio" name="participating" id="participating_2" required="" value="0"  /> Disagree
							</div>
						</div>
						<div class="clearfix"></div>
						<hr>
						
						<div class="row col-md-12">
							<div class="form-group">
								<label for="" id="compatibility" class="control-label"><b>I hereby agree to release my assessment results to the appropriate individuals to determine my compatibility and competence for performing specific work functions within the organisation. <span class="text-danger">*</span></b></label>					
								<br>			
								<input type="radio" name="compatibility" id="compatibility_1" required="" value="1"  /> Agree
								<br>
								<input type="radio" name="compatibility" id="compatibility_2" required="" value="0"  /> Disagree
							</div>
						</div>
						<div class="clearfix"></div>
						<hr>
						
						<div class="row col-md-12">
							<div class="form-group">
								<label for="" id="confidential" class="control-label"><b>I hereby agree that the results of this assessment can be used for research purposes on a strictly confidential basis. <span class="text-danger">*</span></b></label>					
								<br>			
								<input type="radio" name="confidential" id="confidential_1" required="" value="1"  /> Agree
								<br>
								<input type="radio" name="confidential" id="confidential_2" required="" value="0"  /> Disagree
							</div>
						</div>
						<div class="clearfix"></div>
						<hr>
						
						<div class="row col-md-12">
							<div class="form-group">
								<label for="" id="acknowledge" class="control-label"><b>I hereby acknowledge that I am entitled to feedback, however the cost of the feedback may be at my own expense. <span class="text-danger">*</span></b></label>					
								<br>			
								<input type="radio" name="acknowledge" id="acknowledge_1" required="" value="1"  /> Agree
								<br>
								<input type="radio" name="acknowledge" id="acknowledge_2" required="" value="0"  /> Disagree
							</div>
						</div>
						<div class="clearfix"></div>
						<hr>
						
						<div class="row col-md-12">
							<div class="form-group">
								<label for="" id="administrators" class="control-label"><b>I declare that I feel mentally and physically fit to complete the assessment to the best of my abilities. If I feel unwell during the assessment process, I will inform one of the assessment administrators. <span class="text-danger">*</span></b></label>					
								<br>			
								<input type="radio" name="administrators" id="administrators_1" required="" value="1"  /> Agree
								<br>
								<input type="radio" name="administrators" id="administrators_2" required="" value="0"  /> Disagree
							</div>
						</div>
						<div class="clearfix"></div>
						<hr>
						
						<div class="row col-md-6">
							<div class="form-group">
								<label for="date">Full Name </label>
								<input type="text" class="form-control " name="fullname" id="fullname" required="" placeholder="Full Name" autocomplete="off" />
								
							</div>
						</div>
						<div class="clearfix"></div>
						<hr>
						
						<div class="row col-md-6">
							<div class="form-group">
								<label for="passport_no">ID/Passport number </label>
								<input type="text" class="form-control" name="passport_no" test id="passport_no" placeholder="ID/Passport number" data-mask="phone" autocomplete="off" />
								
							</div>
						</div>
						<div class="clearfix"></div>
						<hr>
						
						<div class="row col-md-6">
							<div class="form-group">
								<label for="date">Date </label>
								<input type="date" class="form-control " name="date" id="date" data-format="yyyy-mm-dd" required placeholder="yyyy-mm-dd" data-mask="phone" autocomplete="off" />
								
							</div>
						</div>
						<div class="clearfix"></div>
						<hr>
						<div class="row col-md-6">
							<div class="form-group">
								<label for="signature_box">Signature </label>
								<div id="signature" style="border: 1px solid #ccc;"></div>
								<a href="javascript:;" class="reset_signature pull-right"><i class="fa fa-refresh"></i> Reset</a>
							</div>
						</div>
						<div class="clearfix"></div>
						<hr>
						<!-- <div class="row col-md-6">
							<div class="form-group">
								<label for="" id="agree_disagree_1" class="control-label"><input type="radio" name="agree_disagree" id="agree_disagree_1" required="" value="1"  /> Agree </label>
								
								<label for="" id="agree_disagree_2" class="control-label"><input type="radio" name="agree_disagree" id="agree_disagree_2" required="" value="0"  /> Disagree </label>
								
							</div>
						</div> -->
						<div class="clearfix"></div>
						<hr>
						<div class="form-group">
							<input type="hidden" id="signature_converted" name="signature_converted" value="">
							<input type="hidden" name="declined_consent" id="declined_consent" value="0">
							<button type="submit" class="btn save_btn btn-success btn-login " >
								<i class="entypo-right-open-mini"></i>
								Submit
							</button>
						</div>
						
						<div class="row consent_success hide" > 
							<div class="col-md-6"> 
								<div class="alert alert-success"><strong>Well done!</strong> You have successfully submitted the Consent Form</div>
							</div>
						</div>
						<div class="row consent_error hide"> 
							<div class="col-md-6"> 
								<div class="alert alert-danger"><strong>Ohh Snap!</strong> There was some error, please try again or contact the administrator.</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>



<script type="text/javascript" src="<?php echo base_url('assets/js/jSignature/flashcanvas.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jSignature/jSignature.min.js'); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>	
<script>
	var success_submit = '';
	
	function disagree_agree(){
		bootbox.confirm({
			message: "We are not allowed to administer psychometric assessments without your consent and agreeing to all the statements. Please select one of the following options",
			buttons: {
				confirm: {
					label: 'Change Answer',
					className: 'btn-success'
				},
				cancel: {
					label: 'Decline Consent',
					className: 'btn-danger'
				}
			},
			callback: function (result) {
				if(result == false){
					$("#declined_consent").val(1);
					form_submit($("#form_register"), 'disagree');
					alert('Thank you for your response. The manager who requested the assessments will be informed accordingly.');
				}  else {
					$("#declined_consent").val(0);
				}
			}
		});
	}
	
	$(document).ready(function() {
		$("#signature").jSignature()
		
		$(".reset_signature").on("click", function(){
			$("#signature").jSignature("reset") // clears the canvas and rerenders the decor on it.
		});
		
		setTimeout(function(){
			$(".page-body").removeClass("login-form-fall loaded");
		},200);
		
		/*$("button_fake_submit").on("click",function(){
			$(".btn-login").attr("disabled", false);
			if($("#form_register").parsley().validate()){
				if($('input[type="radio"][value="0"]:checked').length > 0){}
			}
	});*/
	
	
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
		$(".consent_error").addClass('hide');
		event.preventDefault();
		var obj = $(this);
		$("#signature_converted").val($("#signature").jSignature("getData").replace("data:", ""));
		
		if(obj.parsley().validate()){
			if($('input[type="radio"][value="0"]:checked').length > 0){
				disagree_agree();
				return false;
			}
			form_submit(obj, 'agree');
		} else {
			
			obj.find("input.parsley-error").each(function(){
				$(this).parents(".input-group").css('border', '1px solid red');
			});
		}
	});
});
	function form_submit(obj, flag){
		show_loading_bar(35);
		$("#save_btn").attr('disabled', true);
		$.ajax({
			url: obj.attr('action'),
			type: 'POST',
			dataType:'json',
			data: obj.serialize(),
			success : function(response){
				show_loading_bar(100);
				$(".consent_success").removeClass('hide');
				if(response.status=='success'){
					$("#save_btn").attr('disabled', false);
					$(".form-register-success").show();
					setTimeout(function(){
						if(flag == "disagree"){
							window.location.href  = base_url;	
						} else {
							window.location.href  = base_url + 'home/consent_success/';
						}
					},3000)
				} 
			},
			error : function(response){
				show_loading_bar(100);
				$(".consent_error").removeClass('hide');
				$("#save_btn").attr('disabled', false);
			}
		})
	}
</script>