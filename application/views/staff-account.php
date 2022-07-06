<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>My Account Detail</h1>    
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">             
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Credits : <?php if (!empty($clientData[0]->credits)) echo $clientData[0]->credits; ?></h3>
                    </div>
                    <div class="box-body">
                        <form method="post">
                            <?= messageAlert(); ?>
                            <div class="row">
                                <div class="col-md-8 col-lg-6">                 
                                    <div class="form-group">
                                        <label>Client:</label>                      
                                        <input type="text" class="form-control" name="client_name" value="<?php if (!empty($clientData[0]->client_name)) echo $clientData[0]->client_name; ?>" disabled>       
                                        
                                    </div>
                                    <h3>Accounts</h3>
                                    <div class="row">
                                        <div class="col-sm-6">  
                                            <div class="form-group">
                                                <label>Account Email:</label>                      
                                                <input type="text" class="form-control" name="account_email" value="<?php if (!empty($clientData[0]->account_email)) echo $clientData[0]->account_email; ?>" disabled>
                                                
                                            </div> </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>VAT/TAX Number:</label>                      
                                                <input type="text" class="form-control" name="vat_tax_no" value="<?php if (!empty($clientData[0]->vat_tax_no)) echo $clientData[0]->vat_tax_no; ?>" disabled>  
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Company Address:</label>                      
                                        <textarea type="text" class="form-control" rows="4" name="company_address" disabled><?php if (!empty($clientData[0]->company_address)) echo $clientData[0]->company_address; ?></textarea>
                                        
                                    </div> 
                                    <h3>Administrator Detail</h3>                    
                                    <div class="form-group">
                                        <label>Name & Surname: </label>                     
                                        <input type="text" class="form-control" name="full_name" value="<?php if (!empty($clientData[0]->full_name)) echo $clientData[0]->full_name; ?>" disabled> 
                                        
                                    </div>   
                                    <div class="row">
                                        <div class="col-sm-6">                 
                                            <div class="form-group">
                                                <label>Email Address: </label>                     
                                                <input type="text" class="form-control" name="email" value="<?php if (!empty($clientData[0]->email)) echo $clientData[0]->email; ?>" disabled /> 
                                                
                                            </div> 
                                        </div>   
                                        <div class="col-sm-6">                
                                            <div class="form-group">
                                                <label>Phone Number: </label>                      
                                                <input type="text" class="form-control" name="phone_no" value="<?php if (!empty($clientData[0]->phone_no)) echo $clientData[0]->phone_no; ?>" disabled>      
                                                
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <h3>Staff Detail</h3>                    
                                    <div class="form-group">
                                        <label>Name & Surname: </label>                     
                                        <input type="text" class="form-control" name="full_name" value="<?php if (!empty($staffData[0]->full_name)) echo $staffData[0]->full_name; ?>"> 
                                        <?= form_error('full_name', '<span class="error_msg" for="full_name" generated="true">', '</span>'); ?>
                                    </div>   
                                    <div class="row">
                                        <div class="col-sm-6">                 
                                            <div class="form-group">
                                                <label>Email Address: </label>                     
                                                <input type="text" class="form-control" name="email" value="<?php if (!empty($staffData[0]->email)) echo $staffData[0]->email; ?>" disabled /> 
                                            </div> 
                                        </div>   
                                        <div class="col-sm-6">                
                                            <div class="form-group">
                                                <label>Phone Number: </label>                      
                                                <input type="text" class="form-control" name="phone_no" value="<?php if (!empty($staffData[0]->phone_no)) echo $staffData[0]->phone_no; ?>">      
                                                <?= form_error('phone_no', '<span class="error_msg" for="phone_no" generated="true">', '</span>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="<?php if (!empty($staffData[0]->id)) echo $staffData[0]->id; ?>"/>
                            <button class="btn btn-warning" type="submit">UPDATE</button>&nbsp;               
                            <a href="<?= base_url(); ?>dashboard" class="btn btn-default">CANCEL</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>