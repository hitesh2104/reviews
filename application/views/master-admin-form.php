<?php
if (!empty($masterAdminData[0]->id)) {
    $heading = 'Update Master Administrator';
    $button = 'UPDATE';
    $disabled = 'disabled';
} else {
    $heading = 'Add Master Administrator';
    $button = 'SAVE';
    $disabled = '';
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?= $heading; ?></h1>          
        <div class="backbtn">
            <a href="<?= base_url(); ?>user/managemasteradmin" class="btn btn-primary btn-sm">BACK</a>
        </div>       
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">             
                <div class="box box-primary">
                    <div class="box-header with-border">

                    </div>
                    <div class="box-body">
                        <form method="post" id="admin-form">
                            <div class="row">
                                <div class="col-md-8 col-lg-6">                 
                                    <div class="form-group">
                                        <label>Master Administrator Name*</label>                      
                                        <input type="text" class="form-control" name="full_name" value="<?php if (!empty($masterAdminData[0]->full_name)) echo $masterAdminData[0]->full_name; ?>">       
                                        <?= form_error('full_name', '<span class="error_msg" for="full_name" generated="true">', '</span>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Username*</label>                      
                                        <input type="text" class="form-control" name="username" value="<?php if (!empty($masterAdminData[0]->username)) echo $masterAdminData[0]->username; ?>"  <?= $disabled; ?>>       
                                        <?= form_error('username', '<span class="error_msg" for="username" generated="true">', '</span>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Email Address*</label>                      
                                        <input type="text" class="form-control" name="email" value="<?php if (!empty($masterAdminData[0]->email)) echo $masterAdminData[0]->email; ?>" <?= $disabled; ?>> 
                                        <?= form_error('email', '<span class="error_msg" for="email" generated="true">', '</span>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Phone Number*</label>                      
                                        <input type="text" class="form-control" name="phone_no" value="<?php if (!empty($masterAdminData[0]->phone_no)) echo $masterAdminData[0]->phone_no; ?>">      
                                        <?= form_error('phone_no', '<span class="error_msg" for="phone_no" generated="true">', '</span>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Credits*</label>                      
                                        <input type="text" class="form-control" name="credits" value="<?php if (!empty($masterAdminData[0]->credits)) echo $masterAdminData[0]->credits; ?>">      
                                        <?= form_error('credits', '<span class="error_msg" for="credits" generated="true">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="colmd-8 col-lg-6">
                                    <label for="heading">Assign Tests*</label>
                                    <br>
                                    <?php
                                        if(@$masterAdminData[0]->id=="") 
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
                                            $tests = array_map("intval",explode(",",$masterAdminData[0]->assign_test));

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
                            <input type="hidden" name="id" value="<?php if (!empty($masterAdminData[0]->id)) echo $masterAdminData[0]->id; ?>"/>
                            <button class="btn btn-warning" id="btnsub" type="submit"><?= $button; ?></button>&nbsp;               
                            <a href="<?= base_url(); ?>user/managemasteradmin" class="btn btn-default">CANCEL</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">

    // $('document').ready(function(){
    //     $('#btnsub').click(function(){
    //         var flag=0;
    //         for (var i = 1; i <= 12; i++) {
    //             if($("#test"+i).is(':checked'))
    //             {
    //                 flag++;
    //             }
    //         }

    //         if(flag > 0)
    //         {
    //             alert("Please Check atlist one Test.")
    //             return false;
    //         }
    //     });
    // });

    $(function () {
        $("#admin-form").validate({
            errorElement: "span",
            errorClass: "error_msg",
            rules: {//set rules
                full_name: {
                    required: true
                },
                username: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                phone_no: {
                    required: true
                },
                credits: {
                    required: true
                },
                "test_list[]" : {
                    required: true
                }
            },
            messages: {//set messages to appear inline
                full_name: {
                    required: "Oops! we need master administrator name."
                },
                username: {
                    required: "Oops! we need master administrator username."
                },
                email: {
                    required: "Oops! we need administrator email address.",
                    email: "Oops! email you have entered is incorrect."
                },
                phone_no: {
                    required: "Oops! we need master administrator phone number."
                },
                credits: {
                    required: "Oops! we need master administrator credits."
                },
                "test_list[]" : {
                    required: "Oops! Please assign at list one test."
                }
            }
        });
    });
</script>