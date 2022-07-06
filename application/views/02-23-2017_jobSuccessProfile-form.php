<style>
#compBox th, #compBox td { padding-left:10px; }
.even {
    background: #f1f1f1 none repeat scroll 0 0;
}
.odd {
    background: #e5e5e5 none repeat scroll 0 0;
}
.rowHead{
	background:#015D9C; color:#FFFFFF; height:28px;
}

/*---------- bubble tooltip -----------*/
a.tt{
    position:relative;
    z-index:24;
    color:#015D9C;
    text-decoration:none;
}
a.tt span{ display: none; }

/*background:; ie hack, something must be changed in a for ie to execute it*/

a.tt:hover span.tooltip{
    display:block;
    position:absolute;
    top:12px; left:15px;
	padding: 0px;
	width:200px;
	color: #FFFFFF;
	background:#CCCCCC;
	border:1px solid #999999;	
	font-size:12px;
	text-align:left;
	text-wrap:normal;
	font-style:italic;
	filter: alpha(opacity:90);
	KHTMLOpacity: 2.90;
	MozOpacity: 2.90;
	opacity: 2.90;
}
/*a.tt:hover span.top{
	display: block;
	padding: 30px 8px 0;
    background: url(bubble.gif) no-repeat top;
}*/
a.tt:hover span.middle{ /* different middle bg for stretch */
	display: block;
	padding: 6px; 
	background: #222D32; 
}
/*a.tt:hover span.bottom{
	display: block;
	padding:3px 8px 10px;
	color: #548912;
    background: url(bubble.gif) no-repeat bottom;
}*/
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Update Job Success Profile Details</h1>    
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">             
                <div class="box box-primary">
                    <div class="box-body">
	                    <?php echo form_open('jsp/jspSection/'.$jspId,array('id'=>'jspForm', 'name'=>'jspForm', "method"=>"post")); ?>
                            <?= messageAlert(); ?>
                            <div class="row">
                                <div class="col-md-8 col-lg-6">                 
                                    <div class="form-group">
                                        <label>Please select Job family:</label>                                        
                                        <select name="job_family" id="job_family" class="form-control" onchange="createNewRecord('job_family', this.value);">
	                                        <option value="">Please Select</option>
                                            <option value="0">Create New</option>
                                      <?php foreach($familyList as $val){
												$selected = (!empty($jspData['job_family']) && $jspData['job_family'] == $val)?'selected="selected"':'';
										  		echo '<option value="'.$val.'" '.$selected.'>'.$val.'</option>';
									  		}?>
                                        </select>    
                                        <?= form_error('job_family', '<span class="error_msg" for="job_family" generated="true">', '</span>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Role Title:</label>                      
                                        <select name="job_title" id="job_title" class="form-control" onchange="createNewRecord('job_title', this.value);">
                                            <option value="">Please Select</option>
                                      <?php //$jobTitleArr = array('HR Assistant', 'HR Manager', 'Marketing Consultant', 'IT Technician');
										  	//$jobTitleArr = array_merge($jobTitleArr, (isset($ddList['job_title'])?$ddList['job_title']:array()));
											if(isset($roleList)){
												echo '<option value="0">Create New</option>';
												foreach($roleList as $val){
													$selected = (!empty($jspData['job_title']) && $jspData['job_title'] == $val['job_title'])?'selected="selected"':'';
													echo '<option value="'.$val['job_title'].'" '.$selected.'>'.$val['job_title'].'</option>';
												}
									  		}?>
                                        </select>
                                        <?= form_error('job_title', '<span class="error_msg" for="job_title" generated="true">', '</span>'); ?>
                                    </div>                  
                                    <div class="form-group">
                                        <label>Level of Complexity (LoW):</label>                                    	<select name="level_of_gomplexity" class="form-control">
                                            <option value="">Please Select</option>
                                      <?php $lowArr = array(1, 2, 3, 4, 5);
									  		foreach($lowArr as $val){
												$selected = (!empty($jspData['level_of_gomplexity']) && $jspData['level_of_gomplexity'] == $val)?'selected="selected"':'';
										  		echo '<option value="'.$val.'" '.$selected.'>SST Level '.$val.'</option>';
									  		}?>
                                      	</select>
                                        <?= form_error('level_of_gomplexity', '<span class="error_msg" for="level_of_gomplexity" generated="true">', '</span>'); ?>
                                    </div>   
                                    <strong>Behavioural Competencies:</strong><br />
                                    <span class="text-red">(Please select 7 Impact Competencies and 7 Essential Competencies)</span>
                                    <div class="form-group">
                                        <table width="100%" border="1" id="compBox">
                                            <tr class="rowHead">
                                                <th>Name</th>
                                                <th width="20%">Impact</th>
                                                <th width="20%">Essential</th>
                                            </tr>
                              <?php	if(isset($competencyArr) && !empty($competencyArr)){	$flag = 0;
									  $impactCompArr = isset($jspData['impact_competencies'])?explode(',', $jspData['impact_competencies']):array();
									  $importantCompArr = isset($jspData['important_competencies'])?explode(',', $jspData['important_competencies']):array();
							  			foreach($competencyArr as $key => $compVal){	$flag++;
											if($flag==1){ $class="odd"; }else{ $class="even"; $flag=0;} 
							  ?>
                                           	<tr class="<?php echo $class; ?>">
                                                <td><?php echo $compVal['competency']; ?>
                                                	<span style="float:right;"><a href="#"  class="tt" ><i class="fa fa-fw fa-info-circle"></i>
                                                    <span class="tooltip"><span class="top"></span><span class="middle"><?php echo $compVal['definition']; ?></span><span class="bottom"></span></span>
                                                    </a></span>
                                                </td>
                                                <td><input type="checkbox" name="impact_competencies[]" id="impact<?php echo $key; ?>" value="<?php echo $compVal['code']; ?>" onclick="countCompetency('impact', <?php echo $key; ?>,'important');" <?php echo in_array($compVal['code'], $impactCompArr)?'checked="checked"':''; ?> ></td>
                                            	<td><input type="checkbox" name="important_competencies[]" id="important<?php echo $key; ?>"  value="<?php echo $compVal['code']; ?>" onclick="countCompetency('important', <?php echo $key; ?>,'impact');" <?php echo in_array($compVal['code'], $importantCompArr)?'checked="checked"':''; ?> ></td>
                                           	</tr>
                               <?php 	}
							  		} ?>
                                        </table>
                                  </div>  
                                    <div class="row">
                                        <div class="col-sm-6">  
                                            <div class="form-group">
                                                <label>Competency Counter:</label><br />                      
                                                Impact Competencies <strong style="margin-left:23px;"> [<span class="impactComp"><?php echo $impactComp = isset($jspData['impact_competencies_counter'])?$jspData['impact_competencies_counter']:0; ?></span>]</strong>
                                                <input type="hidden" class="form-control" id="impactComp" name="impact_competencies_counter" value="<?php echo $impactComp; ?>"><br />
                                                
                                                Essential Competencies <strong style="margin-left:5px;"> [<span class="importantComp"><?php echo $importantComp = isset($jspData['important_competencies_counter'])?$jspData['important_competencies_counter']:0; ?></span>]</strong>
                                                <input type="hidden" class="form-control" id="importantComp" name="important_competencies_counter" value="<?php echo $importantComp; ?>">
                                                
                                            </div> </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="jspId" id="jspId" value="<?php echo $jspId; ?>"/>
                            <input class="btn btn-warning" type="submit" value="<?php echo ($jspId>0)?'UPDATE':'SUBMIT'; ?>" name="submit" />    
                            <a href="<?= base_url(); ?>jsp" class="btn btn-default">CANCEL</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="http://code.jquery.com/jquery-migrate-1.0.0.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js" type="text/javascript"></script>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/start/jquery-ui.css" rel="Stylesheet" type="text/css" />
<script src="<?= base_url(); ?>js/validate.js"></script>
<script type="text/javascript">
// Validation form
$(document).ready(function() {
	// validate signup form on keyup and submit
	$("#jspForm").validate({
		errorElement: "span",
		errorClass: "error_msg",
		rules: {  
			job_family:	{	required: true	},
			job_title:	{	required: true	},			
		},
		submitHandler: function(form) {
			var totalImpact = 0;
			var totalImportant = 0;
			
			$("input[name='impact_competencies[]']:checked:enabled").each(function() {
				totalImpact++;
		  	});
			
			$("input[name='important_competencies[]']:checked:enabled").each(function() {
				totalImportant++;
		  	});
			if(totalImpact<7 || totalImportant<7){
				alert('Please select min and max 7 for both Impact and Essential.');
				return false;
			}
			

			postData = $("#jspForm").serialize();
			$.ajax({
				type: "POST",
				url: "<?php echo base_url() . 'jsp/jspSection/'.$jspId.'/'.$isClone; ?>",
				data: postData, //{jspId: jspId, jobFamily: jobFamily, jobTitle: jobTitle},
			}).done(function( result ) { 
				if(result == 1){
					alert('Job title already exists in your JSP list.\n Please select or create new.');
					$('#job_family').focus();
					return false;
				}else{
					window.location.href = "<?php echo base_url().'jsp/'; ?>";
				}
			});
		}
	});
			
}); 

// Count Competencies
function countCompetency(colType, id, opstComp){
	var compCount = parseInt($("#"+colType+"Comp").val());	
	if($("#"+colType+id).is(":checked")){
		if(compCount>6){
			$("#"+colType+id).attr("checked", false);
			alert('Please select min and max 7 for both Impact and Essential.');
			return false;
		}
		$("#"+colType+"Comp").val(compCount+1);
		$("."+colType+"Comp").html(compCount+1);
		
		//check another
		
		if($("#"+opstComp+id).is(":checked")){
			var compCount = parseInt($("#"+opstComp+"Comp").val());	
			$("#"+opstComp+id).attr("checked", false);
			$("#"+opstComp+"Comp").val(compCount-1);
			$("."+opstComp+"Comp").html(compCount-1);
		}
	}else{
		$("#"+colType+"Comp").val(compCount-1);
		$("."+colType+"Comp").html(compCount-1);
	}
}

// Create New Record
function createNewRecord(jobType, val) { 
	if(val==0 && val!=''){
		if(jobType == 'job_family'){
			$('#job_title').prop('selectedIndex',0);
		}
		$('#'+jobType).prop('selectedIndex',0);
		var newName = prompt("Please enter new name", "");
		if (newName != null) {
			$('#'+jobType).append('<option value="'+newName+'" selected="selected">'+newName+'</option>');
			job_family = $("#job_family option:selected").val();
			job_title = $("#job_title option:selected").val();			
			$.ajax({
				type: "POST",
				url: "<?php echo base_url() . 'jsp/addNewData'; ?>",
				data: {job_family: job_family, job_title: job_title},
				success: function (newId) {
					if(jobType == 'job_family'){
						loadRoleByFamily(val);
					}
				}
			});
		}
	}else if(jobType == 'job_family'){
		loadRoleByFamily(val);
	}
}

// Load role by family
function loadRoleByFamily(jobFamily) { 
	$.ajax({
		type: "POST",
		url: "<?php echo base_url() . 'jsp/getRoleListByFamily'; ?>",
		data: {job_family: jobFamily},
		success: function (roleList) {
			$("#job_title").html(roleList);
		}
	});
}
</script>