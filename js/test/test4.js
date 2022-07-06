$(document).ready(function() {

	$('.col-md-3 input').each(function() {
		$(this).attr('disabled','disabled');
	});
	
	$('.col-md-3').each(function() {
		var rowID = $(this).parent(".row").attr("rid");
			console.log(rowID);
		if(rowID!="1"){
			$(this).fadeTo('slow', 0.3);
		}else{
			$(this).find("input").removeAttr('disabled');
		}
		
	});
	
	$('.col-md-3 input').each(function() {
		if($(this).val()>0){
			$(this).removeAttr('disabled');
			var rowID = $(this).parent(".row").attr("rid");
			//$('#r'+rowID).fadeTo('slow', 1);
			$('#r'+rowID).find("input").removeAttr('disabled');
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
				$(this).removeAttr('disabled');
			});
			$('#r'+iNextRowId).find('input').filter(':visible:first').focus();
			$('#r'+iNextRowId).fadeTo('slow', 0);
		}
	}

	//keydow
	$('.rating input[type=number]').keyup(function(){
		var arr = [ 1,2,3,4 ];
		var ival = $(this).val();
		var currentBehaviour = $(this).parent().attr("id");
		var nextBehaviour = Number(currentBehaviour)+1;
		var textfield_id = $(this).attr("id");
		var rowBox = $(this).parent().parent().parent();
		var rowId = $(rowBox).attr("rid");
		
		var chosen = "carrot";
		var chosenList = new Array();
		var ino =0;
		$('#r'+rowId+' input[type=number]').each(function() {
			
			var inor = ino+=1;
			var ctextfield_id = $(this).attr("id");
			if(textfield_id!=ctextfield_id){
				cval = $(this).val();
				if(!cval){ var cval=0; }
				chosenList.push(cval);
				
				/*if(inor==4){
					chsenList+= cval;
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
			$(".rating#"+nextBehaviour+' input[type=number]').focus();
		}
		
		var finished = true;
		
		var rn = Number(rowId);
		var NextRowId = Number(rowId)+1;
		
		
		$('#r'+rowId+' input[type=number]').each(function() {
			ival = $(this).val();
			if(!ival){
				finished = false;
				return false;
			}

		});
		
		
		if(finished){
			$('#r'+NextRowId+' input').each(function() {
				$(this).removeAttr('disabled');
			});
			$('#r'+NextRowId).find('input').filter(':visible:first').focus();
			$('#r'+NextRowId).fadeTo('slow', 1);
			$('#r'+NextRowId+" .col-md-3").fadeTo('slow',1);
			
		}
		
	});
	
	$("#test2").submit(function(){
		
		incorrect = false;
		
		$('.col-md-3 input').each(function() {
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

