 var neonLogin = neonLogin || {};
 var erroMessage = 'Error: There was a network issue connecting to the server, please try again.';

 ;(function($, window, undefined)
 {
 	"use strict";
 	
 	$(document).ready(function()
 	{
 		
 		if($("#form_login").length > 0){
 			neonLogin.$container = $("#form_login");
		// Login Form & Validation
		neonLogin.$container.validate({
			rules: {
				username: {
					required: true	
				},
				
				password: {
					required: true
				},
				
			},
			
			highlight: function(element){
				$(element).closest('.input-group').addClass('validate-has-error');
			},
			
			
			unhighlight: function(element)
			{
				$(element).closest('.input-group').removeClass('validate-has-error');
			},
			
			submitHandler: function(ev)
			{
				$(".login-page").addClass('logging-in'); // This will hide the login form and init the progress bar
				
				
				// Hide Errors
				$(".form-login-error").slideUp('fast');

				// We will wait till the transition ends				
				setTimeout(function()
				{
					var random_pct = 25 + Math.round(Math.random() * 30);
					
					// The form data are subbmitted, we can forward the progress to 70%
					neonLogin.setPercentage(40 + random_pct);
					
					// Send data to the server
					$.ajax({
						url: neonLogin.$container.attr('action'),
						method: 'POST',
						data: {
							username: $("input#username").val(),
							password: $("input#password").val(),
						},
						dataType:'JSON',
						error: function()
						{
							
							$(".login-page").removeClass('logging-in');
							
							$(".form-login-error").text(erroMessage);
						},
						success: function(response)
						{
							console.log(response);
							// Login status [success|invalid]
							
							// Form is fully completed, we update the percentage
							neonLogin.setPercentage(100);
							
							// We will give some time for the animation to finish, then execute the following procedures	
								// If login is invalid, we store the 
								var form_error = $(".form-login-error");
								if(response.status == 'invalid')	{
									$(".login-page").removeClass('logging-in');
									form_error.slideDown('fast');
									form_error.find("h3").html("Invalid login");
									form_error.find("p").html(response.message);
									
									neonLogin.resetProgressBar(true);
								} else if(response.status == 'no_active')	{
									$(".login-page").removeClass('logging-in');
									form_error.find("h3").html("Account Suspended");
									form_error.find("p").html(response.message);
									form_error.slideDown('fast');
									
									neonLogin.resetProgressBar(true);
								} else if(response.status == 'deleted')	{
									$(".login-page").removeClass('logging-in');
									form_error.find("h3").html("Account Deleted");
									form_error.find("p").html(response.message);
									form_error.slideDown('fast');
									
									neonLogin.resetProgressBar(true);
								} else if(response.status == 'success'){
									
									form_error.slideUp("fast");
									setTimeout(function() {
										window.location.href = base_url;
									}, 400);
								}
								
							}
						});
				}, 650);
			}
		});
	}
	

	$.validator.addMethod("regx", function(value, element, regexpr) {          
		return regexpr.test(value);
	}, "Please enter a valid pasword.");	

      // update password only members 
      if($("#update_password").length > 0){
      	neonLogin.$container = $("#update_password");
	 		// Login Form & Validation
	 		neonLogin.$container.validate({
	 			rules: {
	 				temp_password: {
	 					required: true	
	 				},
	 				new_password: {
	 					required: true,
	 					minlength: 8,
	 					regx: /(^(?=.*[a-z])(?=.*[A-Z])(?=.*?[0-9])(?=.*?[!#$%&()*+,-./:;<=>?-@[\\\]^_`{|}~]).+$)/
	 				},
	 				re_enter_password: {
	 					required: true,
	 					minlength: 8,
	 					equalTo: '#new_password',
	 					regx: /(^(?=.*[a-z])(?=.*[A-Z])(?=.*?[0-9])(?=.*?[!#$%&()*+,-./:;<=>?-@[\\\]^_`{|}~]).+$)/
	 				},
	 			},
	 			highlight: function(element){
	 				$(element).closest('.input-group').addClass('validate-has-error');
	 			},
	 			unhighlight: function(element)
	 			{
	 				$(element).closest('.input-group').removeClass('validate-has-error');
	 			},
	 			submitHandler: function(ev){ 
	 				$(".login-page").addClass('logging-in'); // This will hide the login form and init the progress bar
					// Hide Errors
					$(".form-login-error").slideUp('fast');
					// We will wait till the transition ends				
					setTimeout(function(){
						var random_pct = 25 + Math.round(Math.random() * 30);
						
						// The form data are subbmitted, we can forward the progress to 70%
						neonLogin.setPercentage(40 + random_pct);
						
						var $old_password = $("input#temp_password");
						var $new_password = $("input#new_password")
						var $re_enter_password = $("input#re_enter_password")
						
						// Send data to the server
						$.ajax({
							url: neonLogin.$container.attr('action'),
							method: 'POST',
							
							data: {
								old_password: $old_password.val(),
								repassword: $re_enter_password.val(),
							},
							error: function()	{
								
								$(".login-page").removeClass('logging-in');
								
								$(".form-login-error").text(erroMessage);
								neonLogin.resetProgressBar(true);
							},
							success: function(response){
								var $response_arr = $.parseJSON(response);
								neonLogin.setPercentage(100);	
								if($response_arr['status'] == 'error')	{
									$("#error_message").html($response_arr['message']);
									$(".login-page").removeClass('logging-in');
									$(".form-login-error").slideDown('fast');
									neonLogin.resetProgressBar(true);
								}
								else if($response_arr['status'] == 'success'){
									$(".form-login-error").hide();
									setTimeout(function() {
										window.location.href = base_url;
									}, 400);
								}
								
							}
						});
					}, 650);
				}
			});
	 	}
	 	
	 	if($("#form_forgot_password").length > 0){
	 		
	 		neonLogin.$container = $("#form_forgot_password");
	 		neonLogin.$container.validate({
	 			rules: {
	 				username: {
	 					required: true	
	 				},
	 			},
	 			
	 			highlight: function(element){
	 				$(element).closest('.input-group').addClass('validate-has-error');
	 			},
	 			
	 			
	 			unhighlight: function(element)
	 			{
	 				$(element).closest('.input-group').removeClass('validate-has-error');
	 			},
	 			
	 			submitHandler: function(ev)
	 			{
				$(".login-page").addClass('logging-in'); // This will hide the login form and init the progress bar
				
				
				// Hide Errors
				$(".form-login-error").slideUp('fast');

				// We will wait till the transition ends				
				setTimeout(function()
				{
					var random_pct = 25 + Math.round(Math.random() * 30);
					
					// The form data are subbmitted, we can forward the progress to 70%
					neonLogin.setPercentage(40 + random_pct);
					
					// Send data to the server
					$.ajax({
						url: neonLogin.$container.attr('action'),
						method: 'POST',
						data: {
							email: $("input#email").val(),
						},
						dataType:'JSON',
						error: function()	{
							
							$(".login-page").removeClass('logging-in');
							
							$(".form-login-error").text(erroMessage);
						},
						success: function(response){
							neonLogin.setPercentage(100);
							
								var form_errors = $(".form-login-error");
								if(response.status == 'invalid')	{
									form_errors.find("h3").html("Invalid Details");
									form_errors.find("p").html(response.message);
									$(".login-page").removeClass('logging-in');
									// form_errors.slideDown('fast');
									neonLogin.resetProgressBar(true);
								} else if(response.status == "inactive"){	
									form_errors.find("h3").html("Account Suspended");
									form_errors.find("p").html(response.message);
									$(".login-page").removeClass('logging-in');
									// form_errors.slideDown('fast');
									neonLogin.resetProgressBar(true);
								} else if(response.status == "deleted"){
									form_errors.find("h3").html("Account Deleted");
									form_errors.find("p").html(response.message);
									$(".login-page").removeClass('logging-in');
									// form_errors.slideDown('fast');
									neonLogin.resetProgressBar(true);
								} else if(response.status == 'success'){
									// Redirect to login page
									form_errors.hide();
									$(".login-page").removeClass('logging-in');
									$(".forgot_response").show();
								}
								
							}
						});
				}, 650);
			}
		});}



		// Lockscreen & Validation
		var is_lockscreen = $(".login-page").hasClass('is-lockscreen');
		
		if(is_lockscreen)
		{
			neonLogin.$container = $("#form_lockscreen");
			neonLogin.$ls_thumb = neonLogin.$container.find('.lockscreen-thumb');
			
			neonLogin.$container.validate({
				rules: {
					
					password: {
						required: true
					},
					
				},
				
				highlight: function(element){
					$(element).closest('.input-group').addClass('validate-has-error');
				},
				
				
				unhighlight: function(element)
				{
					$(element).closest('.input-group').removeClass('validate-has-error');
				},
				
				submitHandler: function(ev)
				{	
					/* 
						Demo Purpose Only 
						
						Here you can handle the page login, currently it does not process anything, just fills the loader.
						*/
						
					$(".login-page").addClass('logging-in-lockscreen'); // This will hide the login form and init the progress bar
					
					// We will wait till the transition ends				
					setTimeout(function()
					{
						var random_pct = 25 + Math.round(Math.random() * 30);
						
						neonLogin.setPercentage(random_pct, function()
						{
							// Just an example, this is phase 1
							// Do some stuff...
							
							// After 0.77s second we will execute the next phase
							setTimeout(function()
							{
								neonLogin.setPercentage(100, function()
								{
									// Just an example, this is phase 2
									// Do some other stuff...
									
									// Redirect to the page
									setTimeout("window.location.href = '../../'", 600);
								}, 2);
								
							}, 820);
						});
						
					}, 650);
				}
			});
		}






		// Login Form Setup
		neonLogin.$body = $(".login-page");
		neonLogin.$login_progressbar_indicator = $(".login-progressbar-indicator h3");
		neonLogin.$login_progressbar = neonLogin.$body.find(".login-progressbar div");
		
		neonLogin.$login_progressbar_indicator.html('0%');
		
		if(neonLogin.$body.hasClass('login-form-fall'))
		{
			var focus_set = false;
			
			setTimeout(function(){ 
				neonLogin.$body.addClass('login-form-fall-init')
				
				setTimeout(function()
				{
					if( !focus_set)
					{
						neonLogin.$container.find('input:first').focus();
						focus_set = true;
					}
					
				}, 550);
				
			}, 0);
		}
		else
		{
			neonLogin.$container.find('input:first').focus();
		}
		
		// Focus Class
		neonLogin.$container.find('.form-control').each(function(i, el)
		{
			var $this = $(el),
			$group = $this.closest('.input-group');
			
			$this.prev('.input-group-addon').click(function()
			{
				$this.focus();
			});
			
			$this.on({
				focus: function()
				{
					$group.addClass('focused');
				},
				
				blur: function()
				{
					$group.removeClass('focused');
				}
			});
		});
		
		// Functions
		$.extend(neonLogin, {
			setPercentage: function(pct, callback)
			{
				pct = parseInt(pct / 100 * 100, 10) + '%';
				
				// Lockscreen
				if(is_lockscreen)
				{
					neonLogin.$lockscreen_progress_indicator.html(pct);
					
					var o = {
						pct: currentProgress
					};
					
					TweenMax.to(o, .7, {
						pct: parseInt(pct, 10),
						roundProps: ["pct"],
						ease: Sine.easeOut,
						onUpdate: function()
						{
							neonLogin.$lockscreen_progress_indicator.html(o.pct + '%');
							drawProgress(parseInt(o.pct, 10)/100);
						},
						onComplete: callback
					});	
					return;
				}
				
				// Normal Login
				neonLogin.$login_progressbar_indicator.html(pct);
				neonLogin.$login_progressbar.width(pct);
				
				var o = {
					pct: parseInt(neonLogin.$login_progressbar.width() / neonLogin.$login_progressbar.parent().width() * 100, 10)
				};
				
				TweenMax.to(o, .7, {
					pct: parseInt(pct, 10),
					roundProps: ["pct"],
					ease: Sine.easeOut,
					onUpdate: function()
					{
						neonLogin.$login_progressbar_indicator.html(o.pct + '%');
					},
					onComplete: callback
				});
			},
			
			resetProgressBar: function(display_errors)
			{
				TweenMax.set(neonLogin.$container, {css: {opacity: 0}});
				
				setTimeout(function()
				{
					TweenMax.to(neonLogin.$container, .6, {css: {opacity: 1}, onComplete: function()
					{
						neonLogin.$container.attr('style', '');
					}});
					
					neonLogin.$login_progressbar_indicator.html('0%');
					neonLogin.$login_progressbar.width(0);
					
					if(display_errors)
					{
						var $errors_container = $(".form-login-error");
						
						$errors_container.show();
						var height = $errors_container.outerHeight();
						
						$errors_container.css({
							height: 0
						});
						
						TweenMax.to($errors_container, .45, {css: {height: height}, onComplete: function()
						{
							$errors_container.css({height: 'auto'});
						}});
						
						// Reset password fields
						neonLogin.$container.find('input[type="password"]').val('');
					}
					
				}, 800);
			}
		});


		// Lockscreen Create Canvas
		if(is_lockscreen)
		{
			neonLogin.$lockscreen_progress_canvas = $('<canvas></canvas>');
			neonLogin.$lockscreen_progress_indicator =  neonLogin.$container.find('.lockscreen-progress-indicator');
			
			neonLogin.$lockscreen_progress_canvas.appendTo(neonLogin.$ls_thumb);
			
			var thumb_size = neonLogin.$ls_thumb.width();
			
			neonLogin.$lockscreen_progress_canvas.attr({
				width: thumb_size,
				height: thumb_size
			});
			
			
			neonLogin.lockscreen_progress_canvas = neonLogin.$lockscreen_progress_canvas.get(0);
			
			// Create Progress Circle
			var bg = neonLogin.lockscreen_progress_canvas,
			ctx = ctx = bg.getContext('2d'),
			imd = null,
			circ = Math.PI * 2,
			quart = Math.PI / 2,
			currentProgress = 0;
			
			ctx.beginPath();
			ctx.strokeStyle = '#eb7067';
			ctx.lineCap = 'square';
			ctx.closePath();
			ctx.fill();
			ctx.lineWidth = 3.0;
			
			imd = ctx.getImageData(0, 0, thumb_size, thumb_size);
			
			var drawProgress = function(current) {
				ctx.putImageData(imd, 0, 0);
				ctx.beginPath();
				ctx.arc(thumb_size/2, thumb_size/2, 70, -(quart), ((circ) * current) - quart, false);
				ctx.stroke();
				
				currentProgress = current * 100;
			}
			
			drawProgress(0/100);
			
			
			neonLogin.$lockscreen_progress_indicator.html('0%');
			
			ctx.restore();
		}
		
	});

})(jQuery, window);