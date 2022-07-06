<?php 
$isJsp = !empty($projectData[0]->job_success_profile)?1:0;
?>
<!-- Content Wrapper. Contains page content -->
<style>
.test_result{ border: 1px solid #fff; moz-border-radius: 7px; -webkit-border-radius: 7px; -khtml-border-radius: 7px; border-radius: 7px; position: relative; float: left; width: 168px; height: 214px; background-color: #f1f1f1; margin-right: 10px; margin-bottom: 10px; }
.test_result:hover{ background-color: #e1e1e1; -webkit-border-radius: 4px; -khtml-border-radius: 4px; border-radius: 4px; position: relative; border: 1px solid #fff -moz-box-shadow: rgba(200,200,200,0.7) 0 1px 10px -1px; -webkit-box-shadow: rgba(200,200,200,0.7) 0 1px 5px -1px; -khtml-box-shadow: rgba(200,200,200,0.7) 0 1px 10px -1px; box-shadow: rgba(200,200,200,0.7) 0 1px 10px -1px; cursor: pointer;}
.t_pic{ position: absolute; z-index:2; top: 0px; width: 100%; height: 100%;}
.t_pic{  z-index:2; top: 0px; width: 100%; height: 100%;}
.t_pic img{ width: 100%; }
    .t_info{ position: absolute; z-index: 3; width: 100%; height: 100%;}
.t_info h3{ color: #fff; font-size: 13px; padding-top: 50px; height: 30px; text-align: center; padding-left: 20px; padding-right: 20px; margin-bottom: 0px;}
.t_info h4{ color: #fff; font-size: 11px; padding-top: 50px; text-align: center; padding-left: 30px; padding-right: 30px;}
</style>
<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Manage Candidates</h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">     
                <div class="box pull-left">
                    <div class="box-header">
                    <div class="box-body">
                        <h2>User Information</h2>
                        <br><br>
                        <form class="form-horizontal">
                          <div class="form-group">
                            <label class="control-label col-sm-2" for="name">Name</label>
                            <div class="col-sm-6">
                              <input type="text" class="form-control" id="name" disabled value="<?= $general_details[0]->full_name ?>">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Email:</label>
                            <div class="col-sm-6">
                              <input type="email" class="form-control" id="email" value="<?= $general_details[0]->email ?>" disabled>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-sm-2" for="phone_no">Phone No:</label>
                            <div class="col-sm-6">
                            <input type="phone_no" class="form-control" id="phone_no" value="<?= $general_details[0]->phone_no ?>" disabled>
                            </div>
                          </div>
                        </form>
                        <br><br>
                        <h2>Manage Tests</h2>
                        <br>
                        <form action="<?= base_url() ?>candidate/update_test/<?= $general_details[0]->id ?>" method="post" onsubmit="return formSubmit();">
                        <?php 
                        $completedTest = 0; 
                        foreach ($test_details as $value): 
							if($value->status=="completed"){	$completedTest++;	}
						?>
                            <div class="checkbox">
                                <label>
                                    <input type="hidden" name="<?= $value->fk_test_id ?>" value="no">
                                    <input type="checkbox" name="<?= $value->fk_test_id ?>" value="yes" id="<?= $value->fk_test_id ?>" class="checkbox mfl t_<?= $value->fk_test_id ?>" <?= $value->status=="completed" ? "checked" : "" ?>> <?= $value->test_name ?>
                                </label>
                            </div>
                        <?php endforeach;
	
							if($isJsp == 1){
								echo '<div class="checkbox">
									<label>
										<input name="exc_summary" value="no" type="hidden">
										<input name="exc_summary" value="exc_summary" id="0" class="checkbox mfl t_0" type="checkbox"> Executive Summary (EXS)                                	</label>
								</div>';
							}
						?>
                        <br>
                        <button class="btn btn-danger" type="submit" >Reset Test</button>
                        <label class="btn btn-primary" onclick="rfmSubmit()">Integrate Report</label>
                        <!-- Executive Summary  -->
                        <?php 
							if($isJsp == 1){
								echo '<a href="" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Conclusion</a>';
							}
						?>
                        </form>
                        
                        <div id="myModal" class="modal fade" role="dialog">
                          <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Please Enter Summary</h4>
                              </div>
                                <form action="<?= base_url() ?>candidate/exe_summary" target="_blank" method="post" id="exc">

                              <div class="modal-body">
                                    <textarea name="content" class="form-control"  style="min-width: 100%"><?= @$general_details[0]->exc_summary ?></textarea>
                                    <input type="hidden" name="project_id" value="<?= $general_details[0]->fk_project_id ?>">
                                    <input type="hidden" name="user_id" value="<?= $value->fk_candidate_id ?>">
                                    <input type="hidden" name="full_name" value="<?= $general_details[0]->full_name ?>">
                                    <input type="hidden" name="first_name" value="<?= $general_details[0]->first_name ?>">
                                    <input type="hidden" name="last_name" value="<?= $general_details[0]->last_name ?>">
                                    <input type="hidden" name="age" value="<?= $general_details[0]->age ?>">
                                    <input type="hidden" name="gender" value="<?= $general_details[0]->gender ?>">
                                    <input type="hidden" name="home_language" value="<?= $general_details[0]->home_language ?>">
                                    <input type="hidden" name="ethnicity" value="<?= $general_details[0]->ethnicity ?>">
                                    <input type="hidden" name="heighest_education" value="<?= $general_details[0]->heighest_education ?>">

                                    <?php foreach ($test_details as $value) {
                                        if($value->status=="completed")
                                        {
                                           echo '<input type="hidden" name="test[]" value="'. $value->test_name. '">';
                                        }
                                    } ?>
                                
                              </div>
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Generate Report</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                              </form>
                            </div>

                          </div>
                        </div>

                        <br><br>
                        <h2>Tests Results</h2>
                        <br>
                        <div class="row">
                            <div class="col-md-2" <?php echo ($isJsp == 1)?'':'style="display:none;"'; ?> >
                                <div class="test_result">
                                    <div class="t_pic">
                                        <img src="<?= base_url(); ?>images/book.png">
                                    </div>
                                    <div class="t_info">
                                        <h3>Executive Summary (EXS)</h3>
                                        <h4></h4>
                                    </div>
                                </div>
                                <div class="complete text-center">
                                    <?php if(empty($general_details->exc_summary)){ ?>
                                    <label class="" style="color:#3c8dbc; cursor: pointer; font-weight: 500 !important;" <?php echo ($isJsp==1)?((count($test_details)) == $completedTest)?'onclick="excSubmit()"':'':'onclick="excSubmit()"'; ?> >
                                    EXS</label>
                                    <?php } ?>
                                    <br>
                                </div>
                            </div>
                            
                            <?php foreach ($test_details as $value): ?>
                            <!-- <div class="col-md-2">
                                <div class="test_result">
                                    <div class="t_pic">
                                        <img src="<?= base_url(); ?>images/book.png">
                                    </div>
                                    <div class="t_info">
                                        <h3>Executive Summary</h3>
                                        <h4><?= $value->status=="completed" ? $value->test_result : "NOT COMPLETED" ?></h4>
                                    </div>
                                </div> -->

                                <div class="col-md-2">
                                    <div class="test_result">
                                        <div class="t_pic">
                                            <img src="<?= base_url(); ?>images/book.png">
                                        </div>
                                        <div class="t_info">
                                            <h3><?= $value->test_name ?></h3>
                                            <h4><?= $value->status=="completed" ? "" : "NOT COMPLETED" ?></h4>
                                        </div>
                                    </div>
                                    <div class="complete text-center">
                                        <?php if($value->status=="completed"){ ?>
                                        <a style="margin-top: 50px; margin-bottom: 50px;" target="_new" href="<?= base_url() ?>candidate/download_report?u_name=<?= $general_details[0]->full_name ?>&amp;title=<?= $value->test_name ?>&amp;file=SST1&amp;score=<?= $value->test_result ?>&amp;test_id=<?= $value->fk_test_id ?>&amp;user_id=<?= $value->fk_candidate_id ?> &amp;created_date=<?= $value->created_at ?>" class="print_pdf_old"><?= $value->test_short_name ?></a>
                                        <?php }else { echo ' <a style="margin-top: 50px; margin-bottom: 50px;">&nbsp;</a>'; } ?>
                                        <br><br>
                                    </div>
                                </div>        

                            <?php endforeach ?>
                        </div>
                        <br><br>
                        
                        <!-- combine report model -->
                        
                        <div id="myModal1" class="modal fade" role="dialog">
                          <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Please Enter Summary</h4>
                              </div>
                              <form action="<?= base_url() ?>candidate/combine_report" target="_blank" id="rfm" method="post">
                              	  <div class="modal-body">
                                    <div class="row hidden">
                                    <?php foreach ($test_details as $value){ 
											if($value->status=="completed"){
									?>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" id="r<?= $value->fk_test_id ?>" value="<?= $value->fk_test_id ?>" class="r_<?= $value->fk_test_id ?>" name="test_list[]" <?= $value->status=="completed" ? "checked" : "" ?> /><?= "    ".$value->test_name ?>
                                             </label>
                                            <br>
                                        </div>
                                    <?php 	}
										}
									
										if($isJsp == 1){
											echo '<div class="checkbox">
													<label>
														<input type="checkbox" id="r0" value="exc_summary" class="r_0" name="test_list[]" >
													</label>
													<br>
                                            	</div> ';
										}
									?>
                                    </div>
                                    <br><br>
                                    <!-- <textarea name="content1" class="form-control"  style="min-width: 100%"></textarea> -->
                                    <input type="hidden" name="project_id" value="<?= $general_details[0]->fk_project_id ?>">
                                    <input type="hidden" name="user_id" value="<?= $value->fk_candidate_id ?>">
                                    <input type="hidden" name="full_name" value="<?= $general_details[0]->full_name ?>">
                                    <input type="hidden" name="first_name" value="<?= $general_details[0]->first_name ?>">
                                    <input type="hidden" name="last_name" value="<?= $general_details[0]->last_name ?>">
                                    <input type="hidden" name="age" value="<?= $general_details[0]->age ?>">
                                    <input type="hidden" name="gender" value="<?= $general_details[0]->gender ?>">
                                    <input type="hidden" name="home_language" value="<?= $general_details[0]->home_language ?>">
                                    <input type="hidden" name="ethnicity" value="<?= $general_details[0]->ethnicity ?>">
                                    <input type="hidden" name="heighest_education" value="<?= $general_details[0]->heighest_education ?>">
                                    <?php foreach ($test_details as $value) {
                                        if($value->status=="completed")
                                        {
                                           echo '<input type="hidden" name="test[]" value="'. $value->test_name. '">';
                                        }
                                    } ?>
                             	  </div>
                                  <div class="modal-footer">
                                    <button type="submit" id="gr" class="btn btn-primary">Generate Report</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  </div>
                              </form>
                            </div>

                          </div>
                        </div>
                        <!-- End combine report -->
                        
                    </div>
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section>
</div>
<script>
            CKEDITOR.replace( 'content' );
          //  CKEDITOR.replace( 'content1' );
</script>

<script type="text/javascript">
$(document).ready(function(){
	$('.mfl').change(function(event) {
		event.preventDefault();
		var id = $(this).attr('id');
		$('#r'+id).trigger('click');
		if ($(this).is(':checked')) {
			$('#r'+id).attr('checked','checked');
		} else {
			$('#r'+id).removeAttr('checked');   
		}
	});
});
	
function formSubmit(){
	t=confirm("Are you sure you want to reset the tests? \nResetting the tests will permanently remove all the results for the selected tests");
	if(t){	return true; }else{	return false;	}
}

function rfmSubmit(){
	document.getElementById("rfm").submit();
}

function excSubmit(){
    document.getElementById("exc").submit();
}
</script> 