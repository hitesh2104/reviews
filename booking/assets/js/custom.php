$(document).ready(function() {
	if($("#criteria").length > 0){
		$("#criteria").val('all');
	}
	if($(".criteria").length > 0){
		$(".criteria").val('all');
	}

	if($("#search_value").length > 0){
		$("#search_value").val("");
	}
	
	if($(".master_check1").length > 0){
		$(".master_check1").attr('checked', false);
	}
	
	/*Device Detection */
/*	var isiPad = /ipad/i.test(navigator.userAgent.toLowerCase());
	var isiPhone = /iphone/i.test(navigator.userAgent.toLowerCase());
	var isiPod = /ipod/i.test(navigator.userAgent.toLowerCase());
	var isiDevice = /ipad|iphone|ipod/i.test(navigator.userAgent.toLowerCase());
	var isAndroid = /android/i.test(navigator.userAgent.toLowerCase());
	var isBlackBerry = /blackberry/i.test(navigator.userAgent.toLowerCase());
	var isWebOS = /webos/i.test(navigator.userAgent.toLowerCase());
	var isWindowsPhone = /windows phone/i.test(navigator.userAgent.toLowerCase());*/
	// for enhanced search
	$(document).on("click",".advance_search",function(event){
		$("#open_search_box").removeClass("blind");
	});
	
	$(document).on("change","#criteria",function(event){
		var $obj = $(this);
		$classname  = "."+$obj.val()+"_box";
		$(".hide_option").addClass('blind');
		$($classname).removeClass('blind');
		$("#search_value").val("").trigger("keyup");
		$("#exact_match").attr("checked",false);
		$(".reset_these_options").prop('selectedIndex',0);
	});
	
	$markerArr = {};
	$infoWindowArr  = {};
	$(document).on("click",".map_marker",function(event){
		event.preventDefault();
		var obj = $(this);
		var lat = obj.data("lat");
		var lng = obj.data("long");
		var description = obj.data("description");
		var row_id = obj.data('id');
		if(typeof newopen !== 'undefined'){
			newopen.close();
		}
		newopen = new google.maps.InfoWindow({
			content: description
		});
		
		if($markerArr[row_id] == undefined){
			
			var positionBig = new google.maps.LatLng(lat,lng);
			var temp_marker = new google.maps.Marker({
				position: positionBig,
				map: map,
				icon:base_url+'uploads/images/markers/black_pin24.png',
			});
			
			$markerArr[row_id] = [];
			$markerArr[row_id] = temp_marker;
		}
		
		if($infoWindowArr[row_id] == undefined){
			$infoWindowArr[row_id] = newopen;
		}
		$infoWindowArr[row_id].open(map,$markerArr[row_id]);
		
		$markerArr[row_id].addListener('click', function() {
			$infoWindowArr[row_id].open(map,$markerArr[row_id]);
		});
		
		map.panTo(positionBig);
		map.setZoom(6);
		
		$("body, html").animate({
			scrollTop: 0
		});
		
	})
	
	
	// auto hide alert boxes
	if($(".alert_auto_hide").length > 0){
		setTimeout(function(){
			$(".alert_auto_hide").slideUp("slow",'linear')
		},5000);
	}
	
	$(".cancel").on("click",function(){
		var redirct = $(this).data('redirect');
		window.location.href=redirct;
	})
	
	if($(".dt_table").length > 0){
		i = 0;
		tables = [];
		$(".dt_table").each(function() {
			var lastColumn = ($(this).find('tr th').length/2)-1;
			  //alert(lastColumn);
			  var obj = $(this);
			  var default_ordering = 0;
           /* var targets = [ 0 , lastColumn ];
           if(obj.hasClass('sort_first')){
           	targets = [ lastColumn ];
           }
           if(obj.hasClass('sort_last')){
           
             if(obj.hasClass('sort_first')){
             targets = []; 
             } else {
           		targets = [ 0  ];
             }
          } */
          if(obj.hasClass('sort_second')){
          	default_ordering = 1;
          }
          var breakline = "";
      /*     if( isiPhone || isAndroid || isBlackBerry || isWindowsPhone || isiDevice || isiPod){
           	breakline = " <br /> ";
           }*/
           
           var	default_sort = "desc";
           if(obj.hasClass('sort_asc')){
           	default_sort = "asc";
           }
           
           tables[i] =  obj.dataTable({
           	"lengthMenu": [[10, 25, 50,100, -1], [10, 25, 50,100, "All"]],
           	"iDisplayLength": 25,
           	"bPaginate": true,
           	"bLengthChange": true,
           	"bFilter": true,
           	"bSort": true,
           	"bInfo": true,
           	"bAutoWidth": false,
           	"bProcessing": true,
           	"bServerSide": true,
           	"sAjaxSource": $(this).data("source"),
           	"oLanguage": {
           		"sLoadingRecords": '<div class="text-center"><span class="fa fa-spin fa-refresh text-primary"></span> Loading</div>',
           		"sProcessing": '<div class="text-center"><span class="fa fa-spin fa-refresh text-primary"></span> Loading</div>',
           		"sSearch": 'Search: ',
           		sInfo: "Showing _START_ to _END_ of _TOTAL_ entries",
           		sInfoEmpty: "Showing 0 to 0 of 0 entries",
           		sInfoFiltered: breakline+"",
           	},
           	"aoColumnDefs": [ { "bSortable": false, "aTargets": 'no-sort' }],
           	"order": [[ default_ordering, default_sort ]]
           });
           i++;
           

        });
	}
	
	$(".master_check1,.master_check2").on("change",function(event){
		var obj = $(this);
		var childcheck = obj.parents('table').find('.chlid_check');
		var masterCheck =  event.target.className;
		if(obj.is(':checked')){
			childcheck.prop('checked', true);
			$("."+masterCheck).prop('checked',true);
			
		} else {
			childcheck.prop('checked', false);
			$("."+masterCheck).prop('checked',false);
		}
	})
	
	$(document).on("change",".chlid_check",function(event){
		var obj = $(this)
		var total_len = obj.parents("table").find(".chlid_check").length;
		var chck_len = obj.parents("table").find(".chlid_check:checked").length;
		var parentTr = obj.parents("table").find("thead input:checkbox").attr('class');
		if(obj.is(":checked")){
			if(total_len == chck_len){
				$("."+parentTr).prop('checked', true);
			} 
		} else {
			$("."+parentTr).prop('checked', false);
		}
	});
	// for multiple images
/*	$("#upload_images").uploadifive({
		'auto'             : true,
		'multi'            : true,
		'buttonText'       : "<i class='fa fa-upload'></i>  Browse",
		'buttonClass'      : 'btn btn-primary btn-file',
		'fileType': ["image\/gif","image\/jpeg","image\/png"],
		'fileObjName'      : 'image_upload',
		'uploadScript'     :  base_url+'home/upload/images',
		'onUploadComplete' : function(file, data) {
			var obj = $(this);
			setTimeout(function(){
				$("div.uploadifive-queue-item.complete").fadeOut("linear",function(){
					$(this).remove()
				});
			},2000); 
			
			$("#preview_images").append('<div class="col-sm-3 image_container_box">\
				<article class="album">\
				<input type="hidden" name="uploaded_images[]" value="'+data+'">\
				<header>\
				<a href="'+base_url+""+data+'" target="_blank">\
				<img src="'+base_url+""+data+'">\
				</a>\
				</header>\
				<footer>\
				<div class="album-options">\
				<a class="deleteImage" href="'+base_url+'home/remove_image/?filepath='+data+'" title="Remove This Image">\
				<i class="entypo-trash"></i>\
				</a>\
				</div>\
				</footer>\
				</article>\
				</div>');
		},
		'onError'       : function(errorType) {
			setTimeout(function(){
				$("div.uploadifive-queue-item.error").fadeOut("linear",function(){
					$(this).remove()
				});
			},2000);
		}
	});

// for singles images
$("#upload_images_single").uploadifive({
	'auto'             : true,
	'multi'            : false,
	'buttonText'       : "<i class='fa fa-upload'></i> Select Image",
	'buttonClass'      : 'btn btn-primary ',
	'fileType': ["image\/gif","image\/jpeg","image\/png"],
	'fileObjName'      : 'image_upload',
	'uploadScript'     :  base_url+'home/upload/images',
	'onUploadComplete' : function(file, data) {
		var obj = $(this);
		setTimeout(function(){
			$("div.uploadifive-queue-item.complete").fadeOut("linear",function(){
				$(this).remove()
			});
		},2000); 
		$("#changed_images").attr("src","");
		$("input[name='uploaded_images']").val(data);
		$("#changed_images").attr("src",base_url+""+data);
		$(".deleteImage").removeClass('hide');
	},
	'onError'       : function(errorType) {
		setTimeout(function(){
			$("div.uploadifive-queue-item.error").fadeOut("linear",function(){
				$(this).remove()
			});
		},2000);
	}
});*/

$(".uploadifive_file").uploadifive({
		'auto': true,
		'multi': true,
		'buttonText': "<i class='fa fa-upload'></i> Attach file",
		'buttonClass': 'btn btn-primary ',
		//	'fileType'         : ["application\/pdf"],
		// 'fileTypeExts'      : "*.pdf",
		'fileObjName': 'doc_upload',
		'uploadScript': base_url + 'Documents/upload',
		'onUploadComplete': function (file, data) {
			var obj = $(this);
			setTimeout(function () {
				$("div.uploadifive-queue-item.complete").fadeOut("linear", function () {
					$(this).remove()
				});
			}, 2000);

			$(".uploaded_job_desc_file_path").val(data);
			$(".file_name_preivew").html(data);

		},
		'onError': function (errorType) {
			setTimeout(function () {
				$("div.uploadifive-queue-item.error").fadeOut("linear", function () {
					$(this).remove()
				});
			}, 2000);
		}
	});

$(".upload_document").uploadifive({
	'auto'             : true,
	'multi'            : true,
	'buttonText'       : "<i class='fa fa-upload'></i> Attach file",
	'buttonClass'      : 'btn btn-primary ',
//	'fileType'         : ["application\/pdf"],
	// 'fileTypeExts'      : "*.pdf",
	'fileObjName'      : 'doc_upload',
	'uploadScript'     :  base_url+'Documents/upload',
	'onUploadComplete' : function(file, data) {
		var obj = $(this);
		setTimeout(function(){
			$("div.uploadifive-queue-item.complete").fadeOut("linear",function(){
				$(this).remove()
			});
		},2000); 
		
		var temp = data.split("-##-");
		var original_name =  temp[1];
		$(".report_document_list").append('<div class="uploaded_file col-sm-12">\
			<div class="file_name col-sm-6"><a href="'+ base_url + "/" + data +'" download>'+ file.name +'</a></div>\
			<input type="hidden" name="files[]" value="'+ data +'" />\
			<div class="file_remove_box col-sm-3">\
			<button type="button" class="remove_this_document btn btn-danger"  data-file_path="'+ data +'"><i class="fa fa-trash-o"></i> Remove </button>\
			</div> <div class="clearfix"></div> <hr />\
			</div>');
		
	},
	'onError'       : function(errorType) {
		setTimeout(function(){
			$("div.uploadifive-queue-item.error").fadeOut("linear",function(){
				$(this).remove()
			});
		},2000);
	}
});

setTimeout(function(){
	$(".dt_table").each(function(){
		var obj = $(this);
		
		obj.parent(".col-sm-12").attr("style","overflow-x:auto");
		obj.parents(".row").removeClass("row");
	});
},200);





/*if(isiPad || isiPhone || isAndroid || isBlackBerry || isWindowsPhone || isiDevice || isiPod)
{
	$(".navbar-fixed-top").parents(".desktop-menu").hide();
	$( ".page-container" ).removeClass("horizontal-menu");
	if(isiPad){
		$(".main-content").css('display', 'table-cell');
	}
	
	
	$(".onlyIpad").show();
}
else {  
	$( ".page-container" ).addClass("horizontal-menu");
	$(".onlyIpad").hide();
}*/
/*End of the code */

// enhanced search
$(document).on("keyup","#search_value", function(e){
	if (e.keyCode == 27) {
		$(this).val(""); 	
	} 
	getQuerySearch();
});
$(document).on("change","#exact_match", function(){
	getQuerySearch();
});


}); // ready end

// random string generator 

function randomString(length){
	var text = "";
	var possible = 'ABCDEFGHIJKL123245MNOPQRSTUVWXYZ6789abcdefghij#?!@$%&*1334567klmnopqrstuvwxyz#?!@$%&*';
	if(length=="" || length == null){
		length = 8;
	}
	
	for( var i=0; i < length; i++ ){
		text += possible.charAt(Math.floor(Math.random() * possible.length));
	}
	
	while(!text.match(PASSWORD_STRENGTH)){
		text = "";
		for( var i=0; i < length; i++ ){
			text += possible.charAt(Math.floor(Math.random() * possible.length));
		}
	}
	
	return text;
}


// alert messages
function showToastMessage(msg,type){
	var opts = {
		"closeButton": true,
		"debug": false,
		"positionClass": "toast-top-right",
		"toastClass": "black",
		"onclick": null,
		"showDuration": "300",
		"hideDuration": "1000",
		"timeOut": "5000",
		"extendedTimeOut": "5000",
		"showEasing": "swing",
		"hideEasing": "linear",
		"showMethod": "fadeIn",
		"hideMethod": "fadeOut"
	};
	if(type=="success"){
		toastr.success(msg, opts);
	} else if(type=="error"){
		toastr.error(msg, opts);
	}
	else if(type=="warning"){
		toastr.warning(msg, opts);
	}
	else if(type=="info"){
		toastr.info(msg, opts);
	} else {
		toastr.info(msg, opts);
	}
}

function footer_fit(){
	console.log("inner content height "+$(window).height());
	console.log("footer height "+$("footer").height());
	var inner_content = $(window).height();
	var footer_height = $("footer").height();
	$(".inner-content").css('height',(inner_content + footer_height )  );
}


function getQuerySearch(){
	var $source = $("#table-1").data("source")+"?criteria="+$("#criteria").val()+"&query_search="+$("#search_value").val();
	if($("#exact_match").is(":checked")){
		$source+="&exact_match=1";
	}
	if($("#date_range").val()!="" && $("#date_range").length > 0){
		$source+="&range="+$("#date_range").val();
	}
	tables[0].fnReloadAjax($source);
}


function dateAdd(myStartDate){
	var myStartDate = myStartDate.split('/');
	var newEndDate = myStartDate[2]+'-'+myStartDate[1]+'-'+myStartDate[0];
	var d = new Date(newEndDate);
	d.setFullYear(d.getFullYear()+1);
	d.setMonth(d.getMonth()+1);
	var return_Data =  d.getDate()+'/'+d.getMonth()+'/'+d.getFullYear();
	return return_Data;
}
