<?php
if (!empty($clientData[0]->id)) {
    $heading = 'Update Client';
    $button = 'UPDATE';
    $disabled = 'disabled';
} else {
    $heading = 'Add Client';
    $button = 'SAVE';
    $disabled = '';
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?= $heading; ?></h1>          
        <div class="backbtn">
            <a href="<?= base_url(); ?>client/manageclient" class="btn btn-primary btn-sm">BACK</a>
        </div>       
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">             
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <!--<h3 class="box-title">Credits : 65</h3>-->
                        <!--<a href="javascript:void(0)" data-target="#credit" data-toggle="modal" class="pull-right btn btn-info btn-sm">Load Credits</a>-->
                    </div>
                    <div class="box-body">
                        <form method="post" id="client-form">
                            <div class="row">
                                <div class="col-md-8 col-lg-6">                 
                                    <div class="form-group">
                                        <label>Client*</label>                      
                                        <input type="text" class="form-control" name="client_name" value="<?php if (!empty($clientData[0]->client_name)) echo $clientData[0]->client_name; ?><?php if (isset($_POST['client_name']) && empty($clientData[0]->client_name)) echo $_POST['client_name']; ?>">       
                                        <?= form_error('client_name', '<span class="error_msg" for="client_name" generated="true">', '</span>'); ?>
                                    </div>
                                    <h3>Administrator Detail</h3>                    
                                    <div class="form-group">
                                        <label>Name & Surname*</label>                     
                                        <input type="text" class="form-control" name="full_name" value="<?php if (!empty($clientData[0]->full_name)) echo $clientData[0]->full_name; ?><?php if (isset($_POST['full_name']) && empty($clientData[0]->full_name)) echo $_POST['full_name']; ?>"> 
                                        <?= form_error('full_name', '<span class="error_msg" for="full_name" generated="true">', '</span>'); ?>
                                    </div>   
                                    <div class="row">
                                        <div class="col-sm-6">                 
                                            <div class="form-group">
                                                <label>Email Address*</label>                     
                                                <input type="text" class="form-control" name="email" value="<?php if (!empty($clientData[0]->email)) echo $clientData[0]->email; ?><?php if (isset($_POST['email']) && empty($clientData[0]->email)) echo $_POST['email']; ?>" <?= $disabled; ?>> 
                                                <?= form_error('email', '<span class="error_msg" for="email" generated="true">', '</span>'); ?>
                                            </div> 
                                        </div>   
                                        <div class="col-sm-6">                
                                            <div class="form-group">
                                                <label>Phone Number*</label>                      
                                                <input type="text" class="form-control" name="phone_no" value="<?php if (!empty($clientData[0]->phone_no)) echo $clientData[0]->phone_no; ?><?php if (isset($_POST['phone_no']) && empty($clientData[0]->phone_no)) echo $_POST['phone_no']; ?>">      
                                                <?= form_error('phone_no', '<span class="error_msg" for="phone_no" generated="true">', '</span>'); ?>
                                            </div>
                                        </div>
                                    </div>                   
                                    <h3>Accounts</h3>
                                    <div class="row">
                                        <div class="col-sm-6">  
                                            <div class="form-group">
                                                <label>Account Email*</label>                      
                                                <input type="text" class="form-control" name="account_email" value="<?php if (!empty($clientData[0]->account_email)) echo $clientData[0]->account_email; ?><?php if (isset($_POST['account_email']) && empty($clientData[0]->account_email)) echo $_POST['account_email']; ?>">
                                                <?= form_error('account_email', '<span class="error_msg" for="account_email" generated="true">', '</span>'); ?>
                                            </div> </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>VAT/TAX Number*</label>                      
                                                <input type="text" class="form-control" name="vat_tax_no" value="<?php if (!empty($clientData[0]->vat_tax_no)) echo $clientData[0]->vat_tax_no; ?><?php if (isset($_POST['vat_tax_no']) && empty($clientData[0]->vat_tax_no)) echo $_POST['vat_tax_no']; ?>">  
                                                <?= form_error('vat_tax_no', '<span class="error_msg" for="vat_tax_no" generated="true">', '</span>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Credits*</label>                      
                                        <input type="text" class="form-control" <?= empty($clientData[0]->id) ? "" : "readonly"; ?> name="credits" value="<?php if (!empty($clientData[0]->credits)) echo $clientData[0]->credits; ?><?php if (isset($_POST['credits']) && empty($clientData[0]->credits)) echo $_POST['credits']; ?>">       
                                        <?= form_error('credits', '<span class="error_msg" for="credits" generated="true">', '</span>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Company Address*</label>                      
                                        <textarea type="text" class="form-control" rows="4" name="company_address"><?php if (!empty($clientData[0]->company_address)) echo $clientData[0]->company_address; ?><?php if (isset($_POST['company_address']) && empty($clientData[0]->company_address)) echo $_POST['company_address']; ?></textarea>
                                        <?= form_error('company_address', '<span class="error_msg" for="company_address" generated="true">', '</span>'); ?>
                                    </div> 
                                </div>
                                <div class="col-md-8 col-lg-6">
                                    <label for="heading">Assign tests*</label><br>
                                    <?php
                                        if(@$clientData[0]->id=="" ) 
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
                                            $tests = array_map("intval",explode(",",$clientData[0]->assign_test));

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
                            <input type="hidden" name="id" value="<?php if (!empty($clientData[0]->id)) echo $clientData[0]->id; ?>"/>
                            <input type="hidden" name="fk_client_admin_id" value="<?php if (!empty($clientData[0]->fk_client_admin_id)) echo $clientData[0]->fk_client_admin_id; ?>"/>
                            <button class="btn btn-warning" type="submit"><?= $button; ?></button>&nbsp;               
                            <a href="<?= base_url(); ?>client/manageclient" class="btn btn-default">CANCEL</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">
    $(function () {
        $("#client-form").validate({
            ignore: ":disabled",
            errorElement: "span",
            errorClass: "error_msg",
            rules: {//set rules
                client_name: {
                    required: true
                },
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
                account_email: {
                    required: true,
                    email: true
                },
                vat_tax_no: {
                    required: true
                },
                credits: {
                    required: true,
                    remote:"<?= base_url('client/check_creadit') ?>"
                },     
                "test_list[]" : {
                    required: true
                },     
                company_address: {
                    required: true
                }           
            },
            messages: {//set messages to appear inline
                client_name: {
                    required: "Oops! we need client name."
                },
                full_name: {
                    required: "Oops! we need administrator full name."
                },
                email: {
                    required: "Oops! we need administrator email address.",
                    email: "Oops! email you have entered is incorrect."
                },
                phone_no: {
                    required: "Oops! we need administrator phone number."
                },
                account_email: {
                    required: "Oops! we need account email address.",
                    email: "Oops! email you have entered is incorrect."
                },
                vat_tax_no: {
                    required: "Opps! you need VAT/TAX number."
                },
                credits: {
                    required: "Oops! we need account credits.",
                    remote: "Oops! You have not enough credit."
                },
                "test_list[]" : {
                    required: "Oops! Please assign at list one test."
                },     
                company_address: {
                    required: "Oops! we need company address."
                }
            }
        });
    });
</script>