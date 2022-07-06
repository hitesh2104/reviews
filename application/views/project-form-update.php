<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Update Project</h1>
        <div class="backbtn">
            <a href="<?= base_url(); ?>project/manageproject" class="btn btn-primary btn-sm">BACK</a>
        </div>       
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">             
                <div class="box box-primary">
                    <div class="box-body">
                        <form method="post" id="project-form">
                            <input type="hidden" name="id" value="<?= $projectData[0]->id; ?>"/>
                            <div class="row">
                                <div class="col-md-8 col-lg-10">                 
                                    <div class="form-group">
                                        <label>Project Name:</label>                      
                                        <input type="text" class="form-control" name="project_name" value="<?= $projectData[0]->project_name; ?>">       
                                        <?= form_error('project_name', '<span class="error_msg" for="project_name" generated="true">', '</span>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Project Description:</label>                      
                                        <textarea type="text" class="form-control" rows="4" name="project_description"><?= $projectData[0]->project_description; ?></textarea>
                                        <?= form_error('project_description', '<span class="error_msg" for="project_description" generated="true">', '</span>'); ?>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">                 
                                            <div class="form-group">
                                                <label>Start Date: </label>                     
                                                <input type="text" class="form-control" name="start_date" value="<?= $projectData[0]->start_date; ?>" id="startDate"> 
                                                <?= form_error('start_date', '<span class="error_msg" for="start_date" generated="true">', '</span>'); ?>
                                            </div> 
                                        </div>   
                                        <div class="col-sm-6">                
                                            <div class="form-group" id="ed" style="<?= empty($projectData[0]->end_date) ? 'display:none;' : ''; ?>" >
                                                <label>End Date: </label>                      
                                                <input type="text" class="form-control" name="end_date" value="<?= $projectData[0]->end_date; ?>" id="endDate">      
                                                <?= form_error('end_date', '<span class="error_msg" for="end_date" generated="true">', '</span>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <label>
                                        <input type="checkbox" value="open" <?= $projectData[0]->end_date=="" ? 'checked' : ''; ?> name="open_project" id="open_chk">
                                        Open Project
                                        </label>
                                    
                                    <div class="<?= $projectData[0]->status != 'active' ? '' : 'hidden' ?>">
                                        <h3>Tests To Be Completed</h3>   
                                        <div id="participantDiv">
                                            <?php
                                            if (!empty($testList)) {
                                                foreach ($testList as $test) {
                                                    ?>
                                                    <label><input type="checkbox" name="test_list[]" value="<?= $test->id; ?>" <?php if (in_array($test->id, explode(',', $projectData[0]->test_list))) echo 'checked'; ?>>&nbsp;<?= $test->test_name; ?>
                                                    </label><br/> 
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>

                                    <?= form_error('test_lists[]', '<span class="error_msg" for="test_lists" generated="true">', '</span>'); ?>
    
                                    <!-- candidate list those are created at project create time -->
									<h3>Job Success Profile</h3> 
                                    <div class="row">
	                                    <div class="col-md-3 col-lg-4">
                                            <select name="job_success_profile" id="job_success_profile" class="form-control">
                                                <option value="">Please Select</option>
                                    <?php	if(isset($familyList) && !empty($familyList)){
                                                foreach($familyList as $val){
													$selected = ($val['job_family'] == $projectData[0]->job_success_profile)?' selected="selected"':'';
                                                    echo '<option value="'.$val['job_family'].'" '.$selected.'>'.$val['job_family'].'</option>';
                                                }
                                            }?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <?php if($candidate_count > 0) { ?>
                                    <h3>Active Candidates</h3>
                                    <div id="field-wrappe">
                                    <?php foreach ($candidates as $key => $value) { ?>
                                        <div class="row">
                                            <div class="col-md-3 col-lg-4">
                                                <div class="form-group">                                                            
                                                    <input type="text" class="form-control" placeholder="Full Name" value="<?= $value->full_name ?>" disabled="" name="">                                               
                                                </div>   
                                            </div>   
                                            <div class="col-md-3 col-lg-4">
                                                <div class="form-group">                                                            
                                                    <input type="text" class="form-control" placeholder="Email" value="<?= $value->email ?>" disabled="" name="">                                               
                                                </div>
                                            </div>
                                        </div>
                                    <?php } } ?>
                                    
                                    <!-- end -->
                                    <h3>Add Candidates</h3>
                                    <div id="field-wrapper">

                                        <div class="row">
                                            <div class="col-md-3 col-lg-4">
                                                <div class="form-group">                                                            
                                                    <input type="text" class="form-control nam" placeholder="Full Name" name="full_name[]">                                               
                                                </div>   
                                            </div>   
                                            <div class="col-md-3 col-lg-4">
                                                <div class="form-group">                                                            
                                                    <input type="text" class="form-control mail" placeholder="Email" name="email[]">                                               
                                                </div>
                                            </div> 
                                            <!-- <div class="col-md-3">
                                                <div class="form-group">                                                            
                                                    <input type="text" class="form-control" placeholder="Phone Number" name="phone_no[]">                                               
                                                </div>
                                            </div> -->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <a href="javascript:void(0);" id="add-button" class="btn btn-primary btn-sm">Add More Candidates</a> 
                                    </div>

                                    <h3>Notification</h3>  <br>
                                    
                                    <div class="row">
                                        <div class="col-sm-10">                
                                            <div class="form-group" id="step1Div">
                                                <label><input type="radio" name="notification" value="1" checked="">&nbsp;Notify me when a candidate completed a test</label><br/>

                                                <label><input type="radio" name="notification" value="2">&nbsp;Do not notify me</label><br/>
                                    </div>     
                                    
                                    <!--<div class="row">
                                     <div class="col-sm-2">                 
                                            <div class="form-group">
                                                <label>Step 1</label>
                                            </div> 
                                        </div>    -->
                                       <!--  <div class="col-sm-10">                
                                            <div class="form-group" id="step1Div">
                                                <input type="radio" name="step_1_report_type" value="1" checked="">&nbsp;Email individual Notification when completed<br/> -->
                                                <!-- <input type="radio" name="step_1_report_type" value="2">&nbsp;Email all Notification per participant when completed<br/>
                                                <input type="radio" name="step_1_report_type" value="3">&nbsp;Email all Notification for all Candidates when completed -->
                                            <!-- </div>
                                        </div>
                                    </div>
                                    <br/> -->
                                  <!--   <div class="row">
                                        <div class="col-sm-2">                 
                                            <div class="form-group">
                                                <label>Step 2</label>
                                            </div> 
                                        </div>   
                                        <div class="col-sm-10">                
                                            <div class="form-group" id="step2Div"> -->
                                         <!--       <span class="hidden">  <input type="radio" name="step_2_report_type" value="1"  checked>&nbsp;Individual report per test</span> -->
                                                <!-- <input type="radio" name="step_2_report_type" value="2">&nbsp;Combined report per participant<br/>
                                                <input type="radio" name="step_2_report_type" value="3">&nbsp;Include executive summary<br/> 
                                            </div>-->
                                        <!-- </div>
                                    </div> -->
                                <!-- </div>
                            </div>
                            <br/> -->
                            <input class="btn btn-warning submit-form" type="submit" id="update" value="Update Project" name="bsubmit"/>   
                            <?php if($projectData[0]->status != "active"){ ?>         
                            <input class="btn btn-success" type="submit" value="Launch Project" id="launch" name="bsubmit" />     
                            <?php } ?>
                            <input type="hidden" name="btnsubmit" id="hid" value="">      
                            <a href="<?= base_url(); ?>project/manageproject" class="btn btn-default">Cancel</a>
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
<script type="text/javascript">
    
    $('document').ready(function(){

        $("#open_chk").change(function() {
            var ischecked= $(this).is(':checked');
            if(ischecked)
                $("#ed").fadeOut(500);
            if(!ischecked)
                $("#ed").fadeIn(500);
        }); 
    });

    $(function () {

        var click;
        var totalc = <?= $candidate_count ?>;

        $("#project-form").validate({
            errorElement: "span",
            errorClass: "error_msg",
            rules: {//set rules
                project_name: {
                    required: true
                },
                project_description: {
                    required: true
                },
                start_date: {
                    required: true
                },
                // end_date: {
                //     depends: function(element)
                //     {
                //         var flag = false;

                //         if($("#open_chk").is(':checked'))
                //         {
                //             flag = true;
                //         }

                //         if(document.getElementById('endDate').value != "")
                //         //if($('input[name="end_date"]').val('') != "")
                //         {
                //             flag = true;   
                //         }

                //         return flag;
                //     }
                // },
                "test_list[]": {
                    required: true
                },
                // "step_1_report_type": {
                //     required: true
                // },
                // "step_2_report_type": {
                //     required: true
                // },
                "notification": {
                    required: true
                },
                // "full_name[]": {
                //     required: true
                // },
                "email[]": {
                    //required: true,
                    email: true
                },
            },
            messages: {//set messages to appear inline
                project_name: {
                    required: "Oops! we need project name."
                },
                project_description: {
                    required: "Oops! we need project description."
                },
                start_date: {
                    required: "Oops! we need project start date."
                },
                // end_date: {
                //     required: "Oops! we need project end date."
                // },
                "test_lists[]": {
                    required: "Oops! you need to select atleast one test."
                },
                // "step_1_report_type": {
                //     required: "Opps! you need to select atleast one step-1 report type."
                // },
                // "step_2_report_type": {
                //     required: "Opps! you need to select atleast one step-2 report type."
                // },
                
                "notification": {
                    required: "Opps! you need to select atleast one notification option."
                },
                "first_name[]": {
                    required: "Participant fullname is required."
                },
                "email[]": {
                    required: "Participant email is required.",
                    email : "Oops! Invalid Email."
                },
            },
            highlight: function (element, errorClass) {
                $(element).removeClass(errorClass);
            },
            errorPlacement: function (error, element) {
                if (element.attr("name") == "test_lists[]") {
                    error.insertAfter('#participantDiv');
                    ;
                } else if (element.attr("name") == "notification") {
                    error.insertAfter('#step1Div');
                } else {
                    //the default error placement for the rest
                    error.insertAfter(element);
                }
            },

            submitHandler: function(form) {
                    $('input[name="btnsubmit"]').val('Launch Project');

                    if(click=='update')
                    {
                        $('input[name="btnsubmit"]').val('');
                        $('input[name="btnsubmit"]').val('Update Project');
                    }

                    var flag=0;
            
                    if ($(".nam").val() == "")
                    {
                        flag=1;
                    }

                    if($(".mail").val()=="")
                    {
                        flag=1;
                    }

                    if(totalc > 0)
                    {
                        flag=0;
                    }

                    if(flag==1)
                    {
                        if(click=='launch')
                        {
                            var msg = 'You did not add any candidates to the project. Click on Continue if you are planning to add candidates later, or if you are going to use the “Generic Link” function. Click on Cancel if you want to add candidates now.';

                            if (confirm(msg)) 
                            {
                                form.submit();
                            }
                            else
                            {
                                return false;
                            }
                        }
                        else
                        {
                            form.submit();
                        }
                    }
                    form.submit();
                }
        });

        $('#update').on("click",function(e){
            e.preventDefault();                

            var end_date=$("#endDate").val();
            if($("#open_chk").is(':checked'))
            {

            }
            else
            {
                var tag='<span id="endDate-error" class="error_msg">Oops! we need project end date.</span>';
                $("#endDate").after(tag);
                if(end_date=="")
                {
                    return false;
                }
                else
                {
                    
                }
            }    

            click='update';

            // $('.nam , .mail').each(function(){
            //     $(this).rules('remove','required');
            // });

            $('#project-form').submit();

        });

        $('#launch').on("click",function(e){
            e.preventDefault(); 

            var end_date=$("#endDate").val();
            if($("#open_chk").is(':checked'))
            {
                
            }
            else
            {
                var tag='<span id="endDate-error" class="error_msg">Oops! we need project end date.</span>';
                $("#endDate").after(tag);
                if(end_date=="")
                {
                    return false;
                }
                else
                {
                    
                }
            }                

           click='launch';
            // $('.nam , .mail').rules('add', {  // dynamically declare the rules
            //     required: true
            // });
            // $('.nam , .mail').each(function(){
            //     $(this).rules('add','required');
            // });

            $('#project-form').submit();

        });

        var maxField = 20; //Input fields increment limitation
        var addButton = $('#add-button'); //Add button selector
        var wrapper = $('#field-wrapper'); //Input field wrapper
        var fieldHTML = '<div class="row">';
        fieldHTML += '<div class="col-md-3 col-lg-4"><div class="form-group">';
        fieldHTML += '<input type="text" class="form-control nam" placeholder="Full Name" name="full_name[]" required="true">';
        fieldHTML += '</div></div>';
        //fieldHTML += '<div class="col-md-2"><div class="form-group">';
        //fieldHTML += '<input type="text" class="form-control" placeholder="Surname" name="last_name[]" required="true">';
        //fieldHTML += '</div></div>';
        fieldHTML += '<div class="col-md-3 col-lg-4"><div class="form-group">';
        fieldHTML += '<input type="text" class="form-control mail" placeholder="Email" name="email[]" required="true">';
        fieldHTML += '</div></div>';
        //fieldHTML += '<div class="col-md-3"><div class="form-group">';
        //fieldHTML += '<input type="text" class="form-control" placeholder="Phone Number" name="phone_no[]">';
        //fieldHTML += '</div></div>';
        fieldHTML += '<div class="col-md-2"><div class="form-group">';
        fieldHTML += '<a href="javascript:void(0);" class="remove-button" class="btn btn-primary btn-sm">Remove</a>';
        fieldHTML += '</div></div></div>';

        var x = 1; //Initial field counter is 1
        $(addButton).click(function () { //Once add button is clicked
            if (x < maxField) { //Check maximum number of input fields
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); // Add field html
            }
        });
        $(wrapper).on('click', '.remove-button', function (e) { //Once remove button is clicked
            e.preventDefault();
            $(this).closest("div.row").remove();//Remove field html
            x--; //Decrement field counter
        });

        //Datepicker script
        $("#startDate").datepicker({
            numberOfMonths: 2,
            onSelect: function (selected) {
                var dt = new Date(selected);
                dt.setDate(dt.getDate() + 1);
                $("#endDate").datepicker("option", "minDate", dt);
            }
        });
        $("#endDate").datepicker({
            numberOfMonths: 2,
            onSelect: function (selected) {
                var dt = new Date(selected);
                dt.setDate(dt.getDate() - 1);
                $("#startDate").datepicker("option", "maxDate", dt);
            }
        });
    });

</script>