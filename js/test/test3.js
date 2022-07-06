$(document).ready(function() {
	
	$("#test3").submit(function(){
		console.log("yes");
		incorrect = false;
		
		$('.t3_row').each(function()
		{	
			var q_id = $(this).attr("id");
			var bgOn = $(this).css('background-color');
			if(q_id!="t3_title")
			{
				if($('input[name="'+q_id+'"]:checked').length)
				{
				}
				else
				{
					$('html,body').animate({scrollTop: $(this).offset().top-150},'slow',function(){
						$('.t3_row#'+q_id).animate({backgroundColor: "#930"}, 1000);
						$('.t3_row#'+q_id).animate({backgroundColor: bgOn}, 2000);
					});
					
					incorrect = true;
					return false;
				}
			}
		});

		if(incorrect){
			return false;
		}

	});
});