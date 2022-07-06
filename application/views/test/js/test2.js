$(document).ready(function() {
	
	$('.row input').each(function() {
		$(this).attr('disabled','disabled');
	});
	
	$('.row').each(function() {

		var rowID = $(this).attr("rid");
		if(rowID!="1"){
			$(this).fadeTo('slow', 0.3);
		}else{
			$(this).find("input").attr('disabled','');
		}
		
	});
	
	$('.row input').each(function() {

		if($(this).val()>0){
			$(this).attr('disabled','');
			var rowID = $(this).parent().attr("rid");
			$('#r'+rowID).fadeTo('slow', 1);
			$('#r'+rowID).find("input").attr('disabled','');
			check_row(rowID);
		}
		
	});
	
	
	function check_row(rowID){
		finished = true;
		$('#r'+rowID+' input').each(function() {
			ival = $(this).val();
			if(!ival){
				finished = false;
			}	
		});
		
		if(finished){
			var iNextRowId = Number(rowID)+1;
			$('#r'+iNextRowId+' input').each(function() {
				$(this).attr('disabled','');
			});
			$('#r'+iNextRowId).find('input').filter(':visible:first').focus();
			$('#r'+iNextRowId).fadeTo('slow', 1);
		}
	}

	//keydow
	$('.rating input').keyup(function(){
		var arr = [ 1,2,3,4 ];
		var ival = $(this).val();
		var currentBehaviour = $(this).parent().attr("id");
		var nextBehaviour = Number(currentBehaviour)+1;
		var textfield_id = $(this).attr("id");
		var rowBox = $(this).parent().parent();
		var rowId = $(rowBox).attr("rid");
		
		var chosen = "carrot";
		var chosenList = new Array();
		var ino =0;
		$('#r'+rowId+' input').each(function() {
			
			var inor = ino+=1;
			var ctextfield_id = $(this).attr("id");
			if(textfield_id!=ctextfield_id){
				cval = $(this).val();
				if(!cval){ var cval=0; }
				chosenList.push(cval);
				
				/*if(inor==4){
					chosenList+= cval;
				}else{
					chosenList+= cval+',';
				}*/
			}
		});
		
		var i=0;
		while (i<=2){
		  
		  if(chosenList[i]==ival){
		  	$(this).val("");
			return false;
		  }
		  i++;
		}
		

		
		//alert(chosenList);
		
	    //$(".color_line").html(chosenList);
		var leelist = [ chosenList ];

		//var leelist = Array(chosenList);
		
		//alert(Number(ival));
		//alert(leelist);
		//alert(contains(leelist, Number(ival)));
		//contains(leelist, Number(ival));
		//alert(jQuery.inArray(Number(ival),leelist));
		
		
		//check if alrady choosen
		if(jQuery.inArray(Number(ival),chosenList)== -1) {
			//$(this).val("");
		}else{
			//$(".rating#"+nextBehaviour+' input').focus();
			
		}
		
		//return false;

		if(jQuery.inArray(Number(ival),arr)== -1) {
			$(this).val("");
		}else{
			$(".rating#"+nextBehaviour+' input').focus();
		}
		
		var finished = true;
		
		var rn = Number(rowId);
		var NextRowId = Number(rowId)+1;
		
		
		$('#r'+rowId+' input').each(function() {
			ival = $(this).val();
			if(!ival){
				finished = false;
				return false;
			}

		});
		
		
		if(finished){
			$('#r'+NextRowId+' input').each(function() {
				$(this).attr('disabled','');
			});
			$('#r'+NextRowId).find('input').filter(':visible:first').focus();
			$('#r'+NextRowId).fadeTo('slow', 1);
			
			//save the current info
			var dataString = $("#test2").serialize() + "&testID=2";
				
			$.ajax({
				type: "POST",
				url: 'includes/save_test.php',
				data: dataString,
				success: function(html) {
				}
			});
			
			
		}
		
	});
	
	$("#test2").submit(function(){
		
		incorrect = false;
		
		$('.row input').each(function() {
			ival = $(this).val();
			if(!ival){
				incorrect = true;
				$(this).focus();
				return false;
			}
			
			

		});
		
		if(incorrect){
			return false;
		}
		
	});

});

