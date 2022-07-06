<?php 
$controllerName = $this->uri->segment(2);
if($controllerName == 'details'){
    $heading = 'My Details';
    $buttonLabel = 'UPDATE';
} else {
    $heading = 'Please Register Your Detail';
    $buttonLabel = 'NEXT';
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?= $heading;?></h1>    
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">             
                <div class="box box-primary">
                    <div class="box-body">
                        <form method="post">
                            <?= messageAlert(); ?>
                            <div class="row">
                                <div class="col-md-8 col-lg-6">                 
                                    <div class="form-group">
                                        <label>Full Name:</label>                      
                                        <input type="text" class="form-control" name="full_name" value="<?php if (!empty($candidateData[0]->full_name)) echo $candidateData[0]->full_name; ?>">       
                                        <?= form_error('full_name', '<span class="error_msg" for="client_name" generated="true">', '</span>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Email:</label>                      
                                        <input type="text" class="form-control" name="email" value="<?php if (!empty($candidateData[0]->email)) echo $candidateData[0]->email; ?>" disabled>       
                                        <?= form_error('email', '<span class="error_msg" for="email" generated="true">', '</span>'); ?>
                                    </div>                  

                                    <div class="row">
                                        <div class="col-sm-6">                 
                                            <div class="form-group">
                                                <label>Marital Status: </label>
                                                <select name="marital_status" class="form-control">
                                                    <option value="">Please Select</option>
                                                    <option value="Single" <?php if(!empty($candidateData[0]->marital_status) && $candidateData[0]->marital_status == "Single") echo "selected='selected'"?>>Single</option>
                                                    <option value="Married" <?php if(!empty($candidateData[0]->marital_status) && $candidateData[0]->marital_status == "Married") echo "selected='selected'"?>>Married</option>
                                                </select> 
                                                <?= form_error('marital_status', '<span class="error_msg" for="marital_status" generated="true">', '</span>'); ?>
                                            </div>  
                                        </div>   
                                        <div class="col-sm-6">                
                                            <div class="form-group">
                                                <label>Gender: </label> 
                                                <select name="gender" class="form-control">
                                                    <option value="">Please Select</option>
                                                    <option value="male" <?php if(!empty($candidateData[0]->gender) && $candidateData[0]->gender == "male") echo "selected='selected'"?>>Male</option>
                                                    <option value="female" <?php if(!empty($candidateData[0]->gender) && $candidateData[0]->gender == "female") echo "selected='selected'"?>>Female</option>
                                                </select> 
                                                <?= form_error('gender', '<span class="error_msg" for="gender" generated="true">', '</span>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Age: </label>                     
                                        <input type="text" class="form-control" name="age" value="<?php if (!empty($candidateData[0]->age)) echo $candidateData[0]->age; ?>" /> 
                                        <?= form_error('age', '<span class="error_msg" for="age" generated="true">', '</span>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Phone Number: </label>                     
                                        <input type="text" class="form-control" name="phone_no" value="<?php if (!empty($candidateData[0]->phone_no)) echo $candidateData[0]->phone_no; ?>" /> 
                                        <?= form_error('phone_no', '<span class="error_msg" for="phone_no" generated="true">', '</span>'); ?>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">  
                                            <div class="form-group">
                                                <label>Nationality:</label>                      
                                                <input type="text" class="form-control" name="nationality" value="<?php if (!empty($candidateData[0]->nationality)) echo $candidateData[0]->nationality; ?>">
                                                <?= form_error('nationality', '<span class="error_msg" for="nationality" generated="true">', '</span>'); ?>
                                            </div> </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>ID/Passport Number:</label>                      
                                                <input type="text" class="form-control" name="id_passport_no" value="<?php if (!empty($candidateData[0]->id_passport_no)) echo $candidateData[0]->id_passport_no; ?>">  
                                                <?= form_error('id_passport_no', '<span class="error_msg" for="vat_tax_no" generated="true">', '</span>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Home Language:</label>                      
                                        <input type="text" class="form-control" name="home_language" value="<?php if (!empty($candidateData[0]->home_language)) echo $candidateData[0]->home_language; ?>">       
                                        <?= form_error('home_language', '<span class="error_msg" for="home_language" generated="true">', '</span>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Current Job Title:</label>                      
                                        <input type="text" class="form-control" name="current_job_title" value="<?php if (!empty($candidateData[0]->current_job_title)) echo $candidateData[0]->current_job_title; ?>">       
                                        <?= form_error('current_job_title', '<span class="error_msg" for="current_job_title" generated="true">', '</span>'); ?>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Year Working Experience:</label>                      
                                        <input type="text" class="form-control" name="working_experience" value="<?php if (!empty($candidateData[0]->working_experience)) echo $candidateData[0]->working_experience; ?>">       
                                        <?= form_error('working_experience', '<span class="error_msg" for="working_experience" generated="true">', '</span>'); ?>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="<?php if (!empty($candidateData[0]->id)) echo $candidateData[0]->id; ?>"/>
                            <input class="btn btn-warning" type="submit" value="<?= $buttonLabel;?>" name="submit" />                                   
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>