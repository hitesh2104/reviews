<?php
if (!empty($staffData[0]->id)) {
    $heading = 'Update Staff';
    $button = 'UPDATE';
    $disabled = 'disabled';
} else {
    $heading = 'Create Staff';
    $button = 'SAVE';
    $disabled = '';
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?= $heading; ?></h1>   
        <div class="backbtn">
            <a href="<?= base_url(); ?>staff/managestaff" class="btn btn-primary btn-sm">BACK</a>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">             
                <div class="box box-primary">
                    <div class="box-body">
                        <form method="post" id="staff-form">
                            <?= messageAlert(); ?>
                            <div class="row">
                                <div class="col-md-8 col-lg-6">                 
                                    <div class="form-group">
                                        <label>Full Name:</label>                      
                                        <input type="text" class="form-control" name="full_name" value="<?php if (!empty($staffData[0]->full_name)) echo $staffData[0]->full_name; ?>">       
                                        <?= form_error('full_name', '<span class="error_msg" for="client_name" generated="true">', '</span>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Email:</label>                      
                                        <input type="text" class="form-control" name="email" value="<?php if (!empty($staffData[0]->email)) echo $staffData[0]->email; ?>" <?= $disabled; ?>>       
                                        <?= form_error('email', '<span class="error_msg" for="email" generated="true">', '</span>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Phone Number: </label>                     
                                        <input type="text" class="form-control" name="phone_no" value="<?php if (!empty($staffData[0]->phone_no)) echo $staffData[0]->phone_no; ?>" /> 
                                        <?= form_error('phone_no', '<span class="error_msg" for="phone_no" generated="true">', '</span>'); ?>
                                    </div> 
                                </div>
                                <div class="col-md-8 col-lg-6">
                                    <label for="heading">Assign Tests*</label><br>
                                    <?php
                                        if(@$staffData[0]->id=="" ) 
                                        {
                                            foreach ($testlist as $value) { ?>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="test_list[]" id="<?= 'test'.$value->id ?>" value="<?= $value->id ?>" /><?= $value->test_name ?>
                                                </label>
                                            </div>
                                    <?php   }
                                        }
                                        else
                                        {
                                            $tests = array_map("intval",explode(",",$staffData[0]->assign_test));

                                            foreach ($testlist as $value) { ?>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="test_list[]" id="<?= 'test'.$value->id ?>" value="<?= $value->id ?>" <?=
                                                            in_array($value->id,$tests) ? "checked" : "" ; ?>

                                                      /><?= $value->test_name ?>
                                                </label>
                                            </div>
                                           <?php }
                                        }
                                    ?>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="<?php if (!empty($staffData[0]->id)) echo $staffData[0]->id; ?>"/>
                            <input type="hidden" name="client_info_id" value="<?php if (!empty($staffData[0]->client_info_id)) echo $staffData[0]->client_info_id; ?>"/>
                            <input class="btn btn-warning" type="submit" value="<?= $button; ?>" name="submit" />    
                            <a href="<?= base_url(); ?>staff/managestaff" class="btn btn-default">CANCEL</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
    $(function () {
        $("#staff-form").validate({
            errorElement: "span",
            errorClass: "error_msg",
            rules: {//set rules
                full_name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                phone_no: {
                    required: true
                },
                "test_list[]":{
                    required:true
                }
            },
            messages: {//set messages to appear inline
                full_name: {
                    required: "Oops! we need staff full name."
                },
                email: {
                    required: "Oops! we need staff email address.",
                    email: "Oops! email you have entered is incorrect."
                },
                phone_no: {
                    required: "Oops! we need staff phone number."
                }
            }
        });
    });
</script>