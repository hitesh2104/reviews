<?php
$controllerName = $this->uri->segment(2);
if ($controllerName == 'details') {
    $heading = 'My Details';
    $buttonLabel = 'UPDATE';
} else {
    $heading = 'Please Register Your Detail';
    $buttonLabel = 'NEXT';
}
?>
<link rel="stylesheet" href="<?= base_url() ?>css/bootstrap-datetimepicker.min.css">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?= $heading; ?></h1>    
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">             
                <div class="box box-primary">
                    <div class="box-body">
                        <form method="post" id="candidate-form">
                            <?= messageAlert(); ?>
                            <div class="row">
                                <div class="col-md-8 col-lg-6">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>First Name:</label>                      
                                                <input type="text" class="form-control" name="first_name" value="<?php if (!empty($candidateData[0]->first_name)) echo $candidateData[0]->first_name; ?>">       
                                                <?= form_error('first_name', '<span class="error_msg" for="first_name" generated="true">', '</span>'); ?>
                                            </div>  
                                        </div>
                                        <!-- <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Middle Name:</label>                      
                                                <input type="text" class="form-control" name="middle_name" value="<?php if (!empty($candidateData[0]->middle_name)) echo $candidateData[0]->middle_name; ?>">       
                                                <?= form_error('middle_name', '<span class="error_msg" for="middle_name" generated="true">', '</span>'); ?>
                                            </div>  
                                        </div> -->
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Last Name:</label>                      
                                                <input type="text" class="form-control" name="last_name" value="<?php if (!empty($candidateData[0]->last_name)) echo $candidateData[0]->last_name; ?>">       
                                                <?= form_error('last_name', '<span class="error_msg" for="last_name" generated="true">', '</span>'); ?>
                                            </div>  
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Email:</label>                      
                                        <input type="text" class="form-control" name="email" value="<?php if (!empty($candidateData[0]->email)) echo $candidateData[0]->email; ?>" disabled>       
                                        <?= form_error('email', '<span class="error_msg" for="email" generated="true">', '</span>'); ?>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>ID/Passport Number:</label>                      
                                                <input type="text" class="form-control" name="id_passport_no" value="<?php if (!empty($candidateData[0]->id_passport_no)) echo $candidateData[0]->id_passport_no; ?>">  
                                                <?= form_error('id_passport_no', '<span class="error_msg" for="vat_tax_no" generated="true">', '</span>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Date of Birth:</label>                      
                                        <input type="text" class="form-control" name="dob" onblur="setAge(this.value)" id="dob" value="<?php if (!empty($candidateData[0]->dob)) echo $candidateData[0]->dob; ?>">       
                                        <?= form_error('dob', '<span class="error_msg" for="dob" generated="true">', '</span>'); ?>
                                    </div> 
                                    <div class="row">
                                        <div class="col-sm-6">                
                                            <div class="form-group">
                                                <label>Gender: </label> 
                                                <select name="gender" class="form-control">
                                                    <option value="">Please Select</option>
                                                    <option value="male" <?php if (!empty($candidateData[0]->gender) && $candidateData[0]->gender == "male") echo "selected='selected'" ?>>Male</option>
                                                    <option value="female" <?php if (!empty($candidateData[0]->gender) && $candidateData[0]->gender == "female") echo "selected='selected'" ?>>Female</option>
                                                </select> 
                                                <?= form_error('gender', '<span class="error_msg" for="gender" generated="true">', '</span>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">                 
                                            <div class="form-group">
                                                <label>Age: </label>                     
                                                <input type="text" class="form-control" name="age" id="age" value="<?php if (!empty($candidateData[0]->age)) echo $candidateData[0]->age; ?>" /> 
                                                <?= form_error('age', '<span class="error_msg" for="age" generated="true">', '</span>'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">  
                                            <div class="form-group">
                                                <label>Nationality:</label>                      
                                                <select name="nationality" class="form-control">
    <option value="Afghanistan" <?php if (@$candidateData[0]->nationality=="Afghanistan") echo "selected" ?> >Afghanistan</option>
    <option value="Albania" <?php if (@$candidateData[0]->nationality=="Albania") echo "selected" ?>>Albania</option>
    <option value="Algeria" <?php if (@$candidateData[0]->nationality=="Algeria") echo "selected" ?>>Algeria</option>
    <option value="American Samoa" <?php if (@$candidateData[0]->nationality=="American Samoa") echo "selected" ?>>American Samoa</option>
    <option value="Andorra" <?php if (@$candidateData[0]->nationality=="Andorra") echo "selected" ?>>Andorra</option>
    <option value="Angola" <?php if (@$candidateData[0]->nationality=="Angola") echo "selected" ?>>Angola</option>
    <option value="Anguilla" <?php if (@$candidateData[0]->nationality=="Anguilla") echo "selected" ?>>Anguilla</option>
    <option value="Antarctica" <?php if (@$candidateData[0]->nationality=="Antarctica") echo "selected" ?>>Antarctica</option>
    <option value="Antigua and Barbuda" <?php if (@$candidateData[0]->nationality=="Antigua and Barbuda") echo "selected" ?>>Antigua and Barbuda</option>
    <option value="Argentina" <?php if (@$candidateData[0]->nationality=="Argentina") echo "selected" ?>>Argentina</option>
    <option value="Armenia" <?php if (@$candidateData[0]->nationality=="Armenia") echo "selected" ?>>Armenia</option>
    <option value="Aruba" <?php if (@$candidateData[0]->nationality=="Aruba") echo "selected" ?>>Aruba</option>
    <option value="Australia" <?php if (@$candidateData[0]->nationality=="Australia") echo "selected" ?>>Australia</option>
    <option value="Austria" <?php if (@$candidateData[0]->nationality=="Austria") echo "selected" ?>>Austria</option>
    <option value="Azerbaijan" <?php if (@$candidateData[0]->nationality=="Azerbaijan") echo "selected" ?>>Azerbaijan</option>
    <option value="Bahamas" <?php if (@$candidateData[0]->nationality=="Bahamas") echo "selected" ?>>Bahamas</option>
    <option value="Bahrain" <?php if (@$candidateData[0]->nationality=="Bahrain") echo "selected" ?>>Bahrain</option>
    <option value="Bangladesh" <?php if (@$candidateData[0]->nationality=="Bangladesh") echo "selected" ?>>Bangladesh</option>
    <option value="Barbados" <?php if (@$candidateData[0]->nationality=="Barbados") echo "selected" ?>>Barbados</option>
    <option value="Belarus" <?php if (@$candidateData[0]->nationality=="Belarus") echo "selected" ?>>Belarus</option>
    <option value="Belgium" <?php if (@$candidateData[0]->nationality=="Belgium") echo "selected" ?>>Belgium</option>
    <option value="Belize" <?php if (@$candidateData[0]->nationality=="Belize") echo "selected" ?>>Belize</option>
    <option value="Benin" <?php if (@$candidateData[0]->nationality=="Benin") echo "selected" ?>>Benin</option>
    <option value="Bermuda" <?php if (@$candidateData[0]->nationality=="Bermuda") echo "selected" ?>>Bermuda</option>
    <option value="Bhutan" <?php if (@$candidateData[0]->nationality=="Bhutan") echo "selected" ?>>Bhutan</option>
    <option value="Bolivia" <?php if (@$candidateData[0]->nationality=="Bolivia") echo "selected" ?>>Bolivia</option>
    <option value="Bosnia and Herzegowina" <?php if (@$candidateData[0]->nationality=="Bosnia and Herzegowina") echo "selected" ?>>Bosnia and Herzegowina</option>
    <option value="Botswana" <?php if (@$candidateData[0]->nationality=="Botswana") echo "selected" ?>>Botswana</option>
    <option value="Bouvet Island" <?php if (@$candidateData[0]->nationality=="Bouvet Island") echo "selected" ?>>Bouvet Island</option>
    <option value="Brazil" <?php if (@$candidateData[0]->nationality=="Brazil") echo "selected" ?>>Brazil</option>
    <option value="British Indian Ocean Territory" <?php if (@$candidateData[0]->nationality=="British Indian Ocean Territory") echo "selected" ?>>British Indian Ocean Territory</option>
    <option value="Brunei Darussalam" <?php if (@$candidateData[0]->nationality=="Brunei Darussalam") echo "selected" ?>>Brunei Darussalam</option>
    <option value="Bulgaria" <?php if (@$candidateData[0]->nationality=="Bulgaria") echo "selected" ?>>Bulgaria</option>
    <option value="Burkina Faso" <?php if (@$candidateData[0]->nationality=="Burkina Faso") echo "selected" ?>>Burkina Faso</option>
    <option value="Burundi" <?php if (@$candidateData[0]->nationality=="Burundi") echo "selected" ?>>Burundi</option>
    <option value="Cambodia" <?php if (@$candidateData[0]->nationality=="Cambodia") echo "selected" ?>>Cambodia</option>
    <option value="Cameroon" <?php if (@$candidateData[0]->nationality=="Cameroon") echo "selected" ?>>Cameroon</option>
    <option value="Canada" <?php if (@$candidateData[0]->nationality=="Canada") echo "selected" ?>>Canada</option>
    <option value="Cape Verde" <?php if (@$candidateData[0]->nationality=="Cape Verde") echo "selected" ?>>Cape Verde</option>
    <option value="Cayman Islands" <?php if (@$candidateData[0]->nationality=="Cayman Islands") echo "selected" ?>>Cayman Islands</option>
    <option value="Central African Republic" <?php if (@$candidateData[0]->nationality=="Central African Republic") echo "selected" ?>>Central African Republic</option>
    <option value="Chad" <?php if (@$candidateData[0]->nationality=="Chad") echo "selected" ?>>Chad</option>
    <option value="Chile" <?php if (@$candidateData[0]->nationality=="Chile") echo "selected" ?>>Chile</option>
    <option value="China" <?php if (@$candidateData[0]->nationality=="China") echo "selected" ?>>China</option>
    <option value="Christmas Island" <?php if (@$candidateData[0]->nationality=="Christmas Island") echo "selected" ?>>Christmas Island</option>
    <option value="Cocos Islands" <?php if (@$candidateData[0]->nationality=="Cocos (Keeling) Islands") echo "selected" ?>>Cocos (Keeling) Islands</option>
    <option value="Colombia" <?php if (@$candidateData[0]->nationality=="Colombia") echo "selected" ?>>Colombia</option>
    <option value="Comoros" <?php if (@$candidateData[0]->nationality=="Comoros") echo "selected" ?>>Comoros</option>
    <option value="Congo" <?php if (@$candidateData[0]->nationality=="Congo") echo "selected" ?>>Congo</option>
    <option value="Congo" <?php if (@$candidateData[0]->nationality=="Congo, the Democratic Republic of the") echo "selected" ?>>Congo, the Democratic Republic of the</option>
    <option value="Cook Islands" <?php if (@$candidateData[0]->nationality=="Cook Islands") echo "selected" ?>>Cook Islands</option>
    <option value="Costa Rica" <?php if (@$candidateData[0]->nationality=="Costa Rica") echo "selected" ?>>Costa Rica</option>
    <option value="Cota D'Ivoire" <?php if (@$candidateData[0]->nationality=="Cote d'Ivoire") echo "selected" ?>>Cote d'Ivoire</option>
    <option value="Croatia" <?php if (@$candidateData[0]->nationality=="Croatia (Hrvatska)") echo "selected" ?>>Croatia (Hrvatska)</option>
    <option value="Cuba" <?php if (@$candidateData[0]->nationality=="Cuba") echo "selected" ?>>Cuba</option>
    <option value="Cyprus" <?php if (@$candidateData[0]->nationality=="Cyprus") echo "selected" ?>>Cyprus</option>
    <option value="Czech Republic" <?php if (@$candidateData[0]->nationality=="Czech Republic") echo "selected" ?>>Czech Republic</option>
    <option value="Denmark" <?php if (@$candidateData[0]->nationality=="Denmark") echo "selected" ?>>Denmark</option>
    <option value="Djibouti" <?php if (@$candidateData[0]->nationality=="Djibouti") echo "selected" ?>>Djibouti</option>
    <option value="Dominica" <?php if (@$candidateData[0]->nationality=="Dominica") echo "selected" ?>>Dominica</option>
    <option value="Dominican Republic" <?php if (@$candidateData[0]->nationality=="Dominican Republic") echo "selected" ?>>Dominican Republic</option>
    <option value="East Timor" <?php if (@$candidateData[0]->nationality=="East Timor") echo "selected" ?>>East Timor</option>
    <option value="Ecuador" <?php if (@$candidateData[0]->nationality=="Ecuador") echo "selected" ?>>Ecuador</option>
    <option value="Egypt" <?php if (@$candidateData[0]->nationality=="Egypt") echo "selected" ?>>Egypt</option>
    <option value="El Salvador" <?php if (@$candidateData[0]->nationality=="El Salvador") echo "selected" ?>>El Salvador</option>
    <option value="Equatorial Guinea" <?php if (@$candidateData[0]->nationality=="Equatorial Guinea") echo "selected" ?>>Equatorial Guinea</option>
    <option value="Eritrea" <?php if (@$candidateData[0]->nationality=="Eritrea") echo "selected" ?>>Eritrea</option>
    <option value="Estonia" <?php if (@$candidateData[0]->nationality=="Estonia") echo "selected" ?>>Estonia</option>
    <option value="Ethiopia" <?php if (@$candidateData[0]->nationality=="Ethiopia") echo "selected" ?>>Ethiopia</option>
    <option value="Falkland Islands" <?php if (@$candidateData[0]->nationality=="Falkland Islands (Malvinas)") echo "selected" ?>>Falkland Islands (Malvinas)</option>
    <option value="Faroe Islands" <?php if (@$candidateData[0]->nationality=="Faroe Islands") echo "selected" ?>>Faroe Islands</option>
    <option value="Fiji" <?php if (@$candidateData[0]->nationality=="Fiji") echo "selected" ?>>Fiji</option>
    <option value="Finland" <?php if (@$candidateData[0]->nationality=="Finland") echo "selected" ?>>Finland</option>
    <option value="France" <?php if (@$candidateData[0]->nationality=="France") echo "selected" ?>>France</option>
    <option value="France Metropolitan" <?php if (@$candidateData[0]->nationality=="France, Metropolitan") echo "selected" ?>>France, Metropolitan</option>
    <option value="French Guiana" <?php if (@$candidateData[0]->nationality=="French Guiana") echo "selected" ?>>French Guiana</option>
    <option value="French Polynesia" <?php if (@$candidateData[0]->nationality=="French Polynesia") echo "selected" ?>>French Polynesia</option>
    <option value="French Southern Territories" <?php if (@$candidateData[0]->nationality=="French Southern Territories") echo "selected" ?>>French Southern Territories</option>
    <option value="Gabon" <?php if (@$candidateData[0]->nationality=="Gabon") echo "selected" ?>>Gabon</option>
    <option value="Gambia" <?php if (@$candidateData[0]->nationality=="Gambia") echo "selected" ?>>Gambia</option>
    <option value="Georgia" <?php if (@$candidateData[0]->nationality=="Georgia") echo "selected" ?>>Georgia</option>
    <option value="Germany" <?php if (@$candidateData[0]->nationality=="Germany") echo "selected" ?>>Germany</option>
    <option value="Ghana" <?php if (@$candidateData[0]->nationality=="Ghana") echo "selected" ?>>Ghana</option>
    <option value="Gibraltar" <?php if (@$candidateData[0]->nationality=="Gibraltar") echo "selected" ?>>Gibraltar</option>
    <option value="Greece" <?php if (@$candidateData[0]->nationality=="Greece") echo "selected" ?>>Greece</option>
    <option value="Greenland" <?php if (@$candidateData[0]->nationality=="Greenland") echo "selected" ?>>Greenland</option>
    <option value="Grenada" <?php if (@$candidateData[0]->nationality=="Grenada") echo "selected" ?>>Grenada</option>
    <option value="Guadeloupe" <?php if (@$candidateData[0]->nationality=="Guadeloupe") echo "selected" ?>>Guadeloupe</option>
    <option value="Guam" <?php if (@$candidateData[0]->nationality=="Guam") echo "selected" ?>>Guam</option>
    <option value="Guatemala" <?php if (@$candidateData[0]->nationality=="Guatemala") echo "selected" ?>>Guatemala</option>
    <option value="Guinea" <?php if (@$candidateData[0]->nationality=="Guinea") echo "selected" ?>>Guinea</option>
    <option value="Guinea-Bissau" <?php if (@$candidateData[0]->nationality=="Guinea-Bissau") echo "selected" ?>>Guinea-Bissau</option>
    <option value="Guyana" <?php if (@$candidateData[0]->nationality=="Guyana") echo "selected" ?>>Guyana</option>
    <option value="Haiti" <?php if (@$candidateData[0]->nationality=="Haiti") echo "selected" ?>>Haiti</option>
    <option value="Heard and McDonald Islands" <?php if (@$candidateData[0]->nationality=="Heard and Mc Donald Islands") echo "selected" ?>>Heard and Mc Donald Islands</option>
    <option value="Holy See" <?php if (@$candidateData[0]->nationality=="Holy See (Vatican City State)") echo "selected" ?>>Holy See (Vatican City State)</option>
    <option value="Honduras" <?php if (@$candidateData[0]->nationality=="Honduras") echo "selected" ?>>Honduras</option>
    <option value="Hong Kong" <?php if (@$candidateData[0]->nationality=="Hong Kong") echo "selected" ?>>Hong Kong</option>
    <option value="Hungary" <?php if (@$candidateData[0]->nationality=="Hungary") echo "selected" ?>>Hungary</option>
    <option value="Iceland" <?php if (@$candidateData[0]->nationality=="Iceland") echo "selected" ?>>Iceland</option>
    <option value="India" <?php if (@$candidateData[0]->nationality=="India") echo "selected" ?>>India</option>
    <option value="Indonesia" <?php if (@$candidateData[0]->nationality=="Indonesia") echo "selected" ?>>Indonesia</option>
    <option value="Iran" <?php if (@$candidateData[0]->nationality=="Iran (Islamic Republic of)") echo "selected" ?>>Iran (Islamic Republic of)</option>
    <option value="Iraq" <?php if (@$candidateData[0]->nationality=="Iraq") echo "selected" ?>>Iraq</option>
    <option value="Ireland" <?php if (@$candidateData[0]->nationality=="Ireland") echo "selected" ?>>Ireland</option>
    <option value="Israel" <?php if (@$candidateData[0]->nationality=="Israel") echo "selected" ?>>Israel</option>
    <option value="Italy" <?php if (@$candidateData[0]->nationality=="Italy") echo "selected" ?>>Italy</option>
    <option value="Jamaica" <?php if (@$candidateData[0]->nationality=="Jamaica") echo "selected" ?>>Jamaica</option>
    <option value="Japan" <?php if (@$candidateData[0]->nationality=="Japan") echo "selected" ?>>Japan</option>
    <option value="Jordan" <?php if (@$candidateData[0]->nationality=="Jordan") echo "selected" ?>>Jordan</option>
    <option value="Kazakhstan" <?php if (@$candidateData[0]->nationality=="Kazakhstan") echo "selected" ?>>Kazakhstan</option>
    <option value="Kenya" <?php if (@$candidateData[0]->nationality=="Kenya") echo "selected" ?>>Kenya</option>
    <option value="Kiribati" <?php if (@$candidateData[0]->nationality=="Kiribati") echo "selected" ?>>Kiribati</option>
    <option value="Democratic People's Republic of Korea" <?php if (@$candidateData[0]->nationality=="Korea, Democratic People's Republic of") echo "selected" ?>>Korea, Democratic People's Republic of</option>
    <option value="Korea" <?php if (@$candidateData[0]->nationality=="Korea, Republic of") echo "selected" ?>>Korea, Republic of</option>
    <option value="Kuwait" <?php if (@$candidateData[0]->nationality=="Kuwait") echo "selected" ?>>Kuwait</option>
    <option value="Kyrgyzstan" <?php if (@$candidateData[0]->nationality=="Kyrgyzstan") echo "selected" ?>>Kyrgyzstan</option>
    <option value="Lao" <?php if (@$candidateData[0]->nationality=="Lao") echo "selected" ?> >Lao
    </option>
    <option value="Latvia" <?php if (@$candidateData[0]->nationality=="Latvia") echo "selected" ?>>Latvia</option>
    <option value="Lebanon" selected <?php if (@$candidateData[0]->nationality=="Lebanon") echo "selected" ?>>Lebanon</option>
    <option value="Lesotho" <?php if (@$candidateData[0]->nationality=="Lesotho") echo "selected" ?>>Lesotho</option>
    <option value="Liberia" <?php if (@$candidateData[0]->nationality=="Liberia") echo "selected" ?>>Liberia</option>
    <option value="Libyan Arab Jamahiriya" <?php if (@$candidateData[0]->nationality=="Libyan Arab Jamahiriya") echo "selected" ?>>Libyan Arab Jamahiriya</option>
    <option value="Liechtenstein" <?php if (@$candidateData[0]->nationality=="Liechtenstein") echo "selected" ?>>Liechtenstein</option>
    <option value="Lithuania" <?php if (@$candidateData[0]->nationality=="Lithuania") echo "selected" ?>>Lithuania</option>
    <option value="Luxembourg" <?php if (@$candidateData[0]->nationality=="Luxembourg") echo "selected" ?>>Luxembourg</option>
    <option value="Macau" <?php if (@$candidateData[0]->nationality=="Macau") echo "selected" ?>>Macau</option>
    <option value="Macedonia" <?php if (@$candidateData[0]->nationality=="Macedonia, The Former Yugoslav Republic of") echo "selected" ?>>Macedonia, The Former Yugoslav Republic of</option>
    <option value="Madagascar" <?php if (@$candidateData[0]->nationality=="Madagascar") echo "selected" ?>>Madagascar</option>
    <option value="Malawi" <?php if (@$candidateData[0]->nationality=="Malawi") echo "selected" ?>>Malawi</option>
    <option value="Malaysia" <?php if (@$candidateData[0]->nationality=="Malaysia") echo "selected" ?>>Malaysia</option>
    <option value="Maldives" <?php if (@$candidateData[0]->nationality=="Maldives") echo "selected" ?>>Maldives</option>
    <option value="Mali" <?php if (@$candidateData[0]->nationality=="Mali") echo "selected" ?>>Mali</option>
    <option value="Malta" <?php if (@$candidateData[0]->nationality=="Malta") echo "selected" ?>>Malta</option>
    <option value="Marshall Islands" <?php if (@$candidateData[0]->nationality=="Marshall Islands") echo "selected" ?>>Marshall Islands</option>
    <option value="Martinique" <?php if (@$candidateData[0]->nationality=="Martinique") echo "selected" ?>>Martinique</option>
    <option value="Mauritania" <?php if (@$candidateData[0]->nationality=="Mauritania") echo "selected" ?>>Mauritania</option>
    <option value="Mauritius" <?php if (@$candidateData[0]->nationality=="Mauritius") echo "selected" ?>>Mauritius</option>
    <option value="Mayotte" <?php if (@$candidateData[0]->nationality=="Mayotte") echo "selected" ?>>Mayotte</option>
    <option value="Mexico" <?php if (@$candidateData[0]->nationality=="Mexico") echo "selected" ?>>Mexico</option>
    <option value="Micronesia" <?php if (@$candidateData[0]->nationality=="Micronesia, Federated States of") echo "selected" ?>>Micronesia, Federated States of</option>
    <option value="Moldova" <?php if (@$candidateData[0]->nationality=="Moldova, Republic of") echo "selected" ?>>Moldova, Republic of</option>
    <option value="Monaco" <?php if (@$candidateData[0]->nationality=="Monaco") echo "selected" ?>>Monaco</option>
    <option value="Mongolia" <?php if (@$candidateData[0]->nationality=="Mongolia") echo "selected" ?>>Mongolia</option>
    <option value="Montserrat" <?php if (@$candidateData[0]->nationality=="Montserrat") echo "selected" ?>>Montserrat</option>
    <option value="Morocco" <?php if (@$candidateData[0]->nationality=="Morocco") echo "selected" ?>>Morocco</option>
    <option value="Mozambique" <?php if (@$candidateData[0]->nationality=="Mozambique") echo "selected" ?>>Mozambique</option>
    <option value="Myanmar" <?php if (@$candidateData[0]->nationality=="Myanmar") echo "selected" ?>>Myanmar</option>
    <option value="Namibia" <?php if (@$candidateData[0]->nationality=="Namibia") echo "selected" ?>>Namibia</option>
    <option value="Nauru" <?php if (@$candidateData[0]->nationality=="Nauru") echo "selected" ?>>Nauru</option>
    <option value="Nepal" <?php if (@$candidateData[0]->nationality=="Nepal") echo "selected" ?>>Nepal</option>
    <option value="Netherlands" <?php if (@$candidateData[0]->nationality=="Netherlands") echo "selected" ?>>Netherlands</option>
    <option value="Netherlands Antilles" <?php if (@$candidateData[0]->nationality=="Netherlands Antilles") echo "selected" ?>>Netherlands Antilles</option>
    <option value="New Caledonia" <?php if (@$candidateData[0]->nationality=="New Caledonia") echo "selected" ?>>New Caledonia</option>
    <option value="New Zealand" <?php if (@$candidateData[0]->nationality=="New Zealand") echo "selected" ?>>New Zealand</option>
    <option value="Nicaragua" <?php if (@$candidateData[0]->nationality=="Nicaragua") echo "selected" ?>>Nicaragua</option>
    <option value="Niger" <?php if (@$candidateData[0]->nationality=="Niger") echo "selected" ?>>Niger</option>
    <option value="Nigeria" <?php if (@$candidateData[0]->nationality=="Nigeria") echo "selected" ?>>Nigeria</option>
    <option value="Niue" <?php if (@$candidateData[0]->nationality=="Niue") echo "selected" ?>>Niue</option>
    <option value="Norfolk Island" <?php if (@$candidateData[0]->nationality=="Norfolk Island") echo "selected" ?>>Norfolk Island</option>
    <option value="Northern Mariana Islands" <?php if (@$candidateData[0]->nationality=="Northern Mariana Islands") echo "selected" ?>>Northern Mariana Islands</option>
    <option value="Norway" <?php if (@$candidateData[0]->nationality=="Norway") echo "selected" ?>>Norway</option>
    <option value="Oman" <?php if (@$candidateData[0]->nationality=="Oman") echo "selected" ?>>Oman</option>
    <option value="Pakistan" <?php if (@$candidateData[0]->nationality=="Pakistan") echo "selected" ?>>Pakistan</option>
    <option value="Palau" <?php if (@$candidateData[0]->nationality=="Palau") echo "selected" ?>>Palau</option>
    <option value="Panama" <?php if (@$candidateData[0]->nationality=="Panama") echo "selected" ?>>Panama</option>
    <option value="Papua New Guinea" <?php if (@$candidateData[0]->nationality=="Papua New Guinea") echo "selected" ?>>Papua New Guinea</option>
    <option value="Paraguay" <?php if (@$candidateData[0]->nationality=="Paraguay") echo "selected" ?>>Paraguay</option>
    <option value="Peru" <?php if (@$candidateData[0]->nationality=="Peru") echo "selected" ?>>Peru</option>
    <option value="Philippines" <?php if (@$candidateData[0]->nationality=="Philippines") echo "selected" ?>>Philippines</option>
    <option value="Pitcairn" <?php if (@$candidateData[0]->nationality=="Pitcairn") echo "selected" ?>>Pitcairn</option>
    <option value="Poland" <?php if (@$candidateData[0]->nationality=="Poland") echo "selected" ?>>Poland</option>
    <option value="Portugal" <?php if (@$candidateData[0]->nationality=="Portugal") echo "selected" ?>>Portugal</option>
    <option value="Puerto Rico" <?php if (@$candidateData[0]->nationality=="Puerto Rico") echo "selected" ?>>Puerto Rico</option>
    <option value="Qatar" <?php if (@$candidateData[0]->nationality=="Qatar") echo "selected" ?>>Qatar</option>
    <option value="Reunion" <?php if (@$candidateData[0]->nationality=="Reunion") echo "selected" ?>>Reunion</option>
    <option value="Romania" <?php if (@$candidateData[0]->nationality=="Romania") echo "selected" ?>>Romania</option>
    <option value="Russia" <?php if (@$candidateData[0]->nationality=="Russian Federation") echo "selected" ?>>Russian Federation</option>
    <option value="Rwanda" <?php if (@$candidateData[0]->nationality=="Rwanda") echo "selected" ?>>Rwanda</option>
    <option value="Saint Kitts and Nevis" <?php if (@$candidateData[0]->nationality=="Saint Kitts and Nevis<") echo "selected" ?>>Saint Kitts and Nevis</option> 
    <option value="Saint LUCIA" <?php if (@$candidateData[0]->nationality=="Saint LUCIA") echo "selected" ?>>Saint LUCIA</option>
    <option value="Saint Vincent" <?php if (@$candidateData[0]->nationality=="Saint Vincent and the Grenadines") echo "selected" ?>>Saint Vincent and the Grenadines</option>
    <option value="Samoa" <?php if (@$candidateData[0]->nationality=="Samoa") echo "selected" ?>>Samoa</option>
    <option value="San Marino" <?php if (@$candidateData[0]->nationality=="San Marino") echo "selected" ?>>San Marino</option>
    <option value="Sao Tome and Principe" <?php if (@$candidateData[0]->nationality=="Sao Tome and Principe<") echo "selected" ?>>Sao Tome and Principe</option> 
    <option value="Saudi Arabia" <?php if (@$candidateData[0]->nationality=="Saudi Arabia") echo "selected" ?>>Saudi Arabia</option>
    <option value="Senegal" <?php if (@$candidateData[0]->nationality=="Senegal") echo "selected" ?>>Senegal</option>
    <option value="Seychelles" <?php if (@$candidateData[0]->nationality=="Seychelles") echo "selected" ?>>Seychelles</option>
    <option value="Sierra" <?php if (@$candidateData[0]->nationality=="Sierra Leone") echo "selected" ?>>Sierra Leone</option>
    <option value="Singapore" <?php if (@$candidateData[0]->nationality=="Singapore") echo "selected" ?>>Singapore</option>
    <option value="Slovakia" <?php if (@$candidateData[0]->nationality=="Slovakia (Slovak Republic)") echo "selected" ?>>Slovakia (Slovak Republic)</option>
    <option value="Slovenia" <?php if (@$candidateData[0]->nationality=="Slovenia") echo "selected" ?>>Slovenia</option>
    <option value="Solomon Islands" <?php if (@$candidateData[0]->nationality=="Solomon Islands") echo "selected" ?>>Solomon Islands</option>
    <option value="Somalia" <?php if (@$candidateData[0]->nationality=="Somalia") echo "selected" ?>>Somalia</option>
    <option value="South Africa" <?php if (@$candidateData[0]->nationality=="South Africa") echo "selected " ?> selected >South Africa</option>
    <option value="South Georgia" <?php if (@$candidateData[0]->nationality=="South Georgia and the South Sandwich Islands") echo "selected" ?>>South Georgia and the South Sandwich Islands</option>
    <option value="Span" <?php if (@$candidateData[0]->nationality=="Spain") echo "selected" ?>>Spain</option>
    <option value="SriLanka" <?php if (@$candidateData[0]->nationality=="Sri Lanka") echo "selected" ?>>Sri Lanka</option>
    <option value="St. Helena" <?php if (@$candidateData[0]->nationality=="St. Helena") echo "selected" ?>>St. Helena</option>
    <option value="St. Pierre and Miguelon" <?php if (@$candidateData[0]->nationality=="St. Pierre and Miquelon") echo "selected" ?>>St. Pierre and Miquelon</option>
    <option value="Sudan" <?php if (@$candidateData[0]->nationality=="Sudan") echo "selected" ?>>Sudan</option>
    <option value="Suriname" <?php if (@$candidateData[0]->nationality=="Suriname") echo "selected" ?>>Suriname</option>
    <option value="Svalbard" <?php if (@$candidateData[0]->nationality=="Svalbard and Jan Mayen Islands") echo "selected" ?>>Svalbard and Jan Mayen Islands</option>
    <option value="Swaziland" <?php if (@$candidateData[0]->nationality=="Swaziland") echo "selected" ?>>Swaziland</option>
    <option value="Sweden" <?php if (@$candidateData[0]->nationality=="Sweden") echo "selected" ?>>Sweden</option>
    <option value="Switzerland" <?php if (@$candidateData[0]->nationality=="Switzerland") echo "selected" ?>>Switzerland</option>
    <option value="Syria" <?php if (@$candidateData[0]->nationality=="Syrian Arab Republic") echo "selected" ?>>Syrian Arab Republic</option>
    <option value="Taiwan" <?php if (@$candidateData[0]->nationality=="Taiwan, Province of China") echo "selected" ?>>Taiwan, Province of China</option>
    <option value="Tajikistan" <?php if (@$candidateData[0]->nationality=="Tajikistan") echo "selected" ?>>Tajikistan</option>
    <option value="Tanzania" <?php if (@$candidateData[0]->nationality=="Tanzania, United Republic of") echo "selected" ?>>Tanzania, United Republic of</option>
    <option value="Thailand" <?php if (@$candidateData[0]->nationality=="Thailand") echo "selected" ?>>Thailand</option>
    <option value="Togo" <?php if (@$candidateData[0]->nationality=="Togo") echo "selected" ?>>Togo</option>
    <option value="Tokelau" <?php if (@$candidateData[0]->nationality=="Tokelau") echo "selected" ?>>Tokelau</option>
    <option value="Tonga" <?php if (@$candidateData[0]->nationality=="Tonga") echo "selected" ?>>Tonga</option>
    <option value="Trinidad and Tobago" <?php if (@$candidateData[0]->nationality=="Trinidad and Tobago") echo "selected" ?>>Trinidad and Tobago</option>
    <option value="Tunisia" <?php if (@$candidateData[0]->nationality=="Tunisia") echo "selected" ?>>Tunisia</option>
    <option value="Turkey" <?php if (@$candidateData[0]->nationality=="Turkey") echo "selected" ?>>Turkey</option>
    <option value="Turkmenistan" <?php if (@$candidateData[0]->nationality=="Turkmenistan") echo "selected" ?>>Turkmenistan</option>
    <option value="Turks and Caicos" <?php if (@$candidateData[0]->nationality=="Turks and Caicos Islands") echo "selected" ?>>Turks and Caicos Islands</option>
    <option value="Tuvalu" <?php if (@$candidateData[0]->nationality=="Tuvalu") echo "selected" ?>>Tuvalu</option>
    <option value="Uganda" <?php if (@$candidateData[0]->nationality=="Uganda") echo "selected" ?>>Uganda</option>
    <option value="Ukraine" <?php if (@$candidateData[0]->nationality=="Ukraine") echo "selected" ?>>Ukraine</option>
    <option value="United Arab Emirates" <?php if (@$candidateData[0]->nationality=="United Arab Emirates") echo "selected" ?>>United Arab Emirates</option>
    <option value="United Kingdom" <?php if (@$candidateData[0]->nationality=="United Kingdom") echo "selected" ?>>United Kingdom</option>
    <option value="United States" <?php if (@$candidateData[0]->nationality=="United States") echo "selected" ?>>United States</option>
    <option value="United States Minor Outlying Islands" <?php if (@$candidateData[0]->nationality=="United States Minor Outlying Islands") echo "selected" ?>>United States Minor Outlying Islands</option>
    <option value="Uruguay" <?php if (@$candidateData[0]->nationality=="Uruguay") echo "selected" ?>>Uruguay</option>
    <option value="Uzbekistan" <?php if (@$candidateData[0]->nationality=="Uzbekistan") echo "selected" ?>>Uzbekistan</option>
    <option value="Vanuatu" <?php if (@$candidateData[0]->nationality=="Vanuatu") echo "selected" ?>>Vanuatu</option>
    <option value="Venezuela" <?php if (@$candidateData[0]->nationality=="Venezuela") echo "selected" ?>>Venezuela</option>
    <option value="Vietnam" <?php if (@$candidateData[0]->nationality=="Viet Nam") echo "selected" ?>>Viet Nam</option>
    <option value="Virgin Islands (British)" <?php if (@$candidateData[0]->nationality=="Virgin Islands (British)") echo "selected" ?>>Virgin Islands (British)</option>
    <option value="Virgin Islands (U.S)" <?php if (@$candidateData[0]->nationality=="Virgin Islands (U.S.)") echo "selected" ?>>Virgin Islands (U.S.)</option>
    <option value="Wallis and Futana Islands" <?php if (@$candidateData[0]->nationality=="Wallis and Futuna Islands") echo "selected" ?>>Wallis and Futuna Islands</option>
    <option value="Western Sahara" <?php if (@$candidateData[0]->nationality=="Western Sahara") echo "selected" ?>>Western Sahara</option>
    <option value="Yemen" <?php if (@$candidateData[0]->nationality=="Yemen") echo "selected" ?>>Yemen</option>
    <option value="Yugoslavia" <?php if (@$candidateData[0]->nationality=="Yugoslavia") echo "selected" ?>>Yugoslavia</option>
    <option value="Zambia" <?php if (@$candidateData[0]->nationality=="Zambia") echo "selected" ?>>Zambia</option>
    <option value="Zimbabwe" <?php if (@$candidateData[0]->nationality=="Zimbabwe") echo "selected" ?>>Zimbabwe</option>
</select>
                                                <?= form_error('nationality', '<span class="error_msg" for="nationality" generated="true">', '</span>'); ?>
                                            </div> 
                                        </div>
                                        <div class="col-sm-6">                
                                            <div class="form-group">
                                                <label>Ethnicity: </label> 
                                                <select name="ethnicity" class="form-control">
                                                    <option value="">Please Select</option>
                                                    <option value="White" <?php if (!empty($candidateData[0]->ethnicity) && $candidateData[0]->ethnicity == "White") echo "selected='selected'" ?>>White</option>
                                                    <option value="Hispanic or Latino" <?php if (!empty($candidateData[0]->ethnicity) && $candidateData[0]->ethnicity == "Hispanic or Latino") echo "selected='selected'" ?>>Hispanic or Latino</option>
                                                    <option value="Black or African" <?php if (!empty($candidateData[0]->ethnicity) && $candidateData[0]->ethnicity == "Black or African") echo "selected='selected'" ?>>Black or African</option>
                                                    <option value="Native American or American Indian" <?php if (!empty($candidateData[0]->ethnicity) && $candidateData[0]->ethnicity == "Native American or American Indian") echo "selected='selected'" ?>>Native American or American Indian</option>
                                                    <option value="Asian" <?php if (!empty($candidateData[0]->ethnicity) && $candidateData[0]->ethnicity == "Asian") echo "selected='selected'" ?>>Asian</option>
                                                    <option value="Coloured" <?php if (!empty($candidateData[0]->ethnicity) && $candidateData[0]->ethnicity == "Coloured") echo "selected='selected'" ?>>Coloured</option>
                                                    <option value="Other" <?php if (!empty($candidateData[0]->ethnicity) && $candidateData[0]->ethnicity == "Other") echo "selected='selected'" ?>>Other</option>
                                                </select> 
                                                <?= form_error('ethnicity', '<span class="error_msg" for="ethnicity" generated="true">', '</span>'); ?>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-sm-6">                
                                            <div class="form-group">
                                                <label> Highest Education: </label> 
                                                <select name="heighest_education" class="form-control">
                                                    <option value="">Please Select</option>
                                                    <option value="High School" <?php if (!empty($candidateData[0]->heighest_education) && $candidateData[0]->heighest_education == "High School") echo "selected='selected'" ?>>High School</option>
                                                    <option value="College Certificate" <?php if (!empty($candidateData[0]->heighest_education) && $candidateData[0]->heighest_education == "College Certificate") echo "selected='selected'" ?>>College Certificate</option>
                                                    <option value="College Diploma" <?php if (!empty($candidateData[0]->heighest_education) && $candidateData[0]->heighest_education == "College Diploma") echo "selected='selected'" ?>>College Diploma</option>
                                                    <option value="Trade/Technical/Vocational Training" <?php if (!empty($candidateData[0]->heighest_education) && $candidateData[0]->heighest_education == "Trade/Technical/Vocational Training") echo "selected='selected'" ?>>Trade/Technical/Vocational Training</option>
                                                    <option value="Bachelors Degree" <?php if (!empty($candidateData[0]->heighest_education) && $candidateData[0]->heighest_education == "Bachelors Degree") echo "selected='selected'" ?>>Bachelors Degree</option>
                                                    <option value="Honours Degree" <?php if (!empty($candidateData[0]->heighest_education) && $candidateData[0]->heighest_education == "Honours Degree") echo "selected='selected'" ?>>Honours Degree</option>
                                                    <option value="Masters Degree" <?php if (!empty($candidateData[0]->heighest_education) && $candidateData[0]->heighest_education == "Masters Degree") echo "selected='selected'" ?>>Masters Degree</option>
                                                    <option value="Doctorate Degree" <?php if (!empty($candidateData[0]->heighest_education) && $candidateData[0]->heighest_education == "Doctorate Degree") echo "selected='selected'" ?>>Doctorate Degree</option>

                                                </select> 
                                                <?= form_error('heighest_education', '<span class="error_msg" for="heighest_education" generated="true">', '</span>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">                 
                                            <div class="form-group">
                                                <label>Marital Status: </label>
                                                <select name="marital_status" class="form-control">
                                                    <option value="">Please Select</option>
                                                    <option value="Single, Never Married" <?php if (!empty($candidateData[0]->marital_status) && $candidateData[0]->marital_status == "Single, Never Married") echo "selected='selected'" ?>>Single, Never Married</option>
                                                    <option value="Married or Domestic Partnership" <?php if (!empty($candidateData[0]->marital_status) && $candidateData[0]->marital_status == "Married or Domestic Partnership") echo "selected='selected'" ?>>Married or Domestic Partnership</option>
                                                    <option value="Widowed" <?php if (!empty($candidateData[0]->marital_status) && $candidateData[0]->marital_status == "Widowed") echo "selected='selected'" ?>>Widowed</option>
                                                    <option value="Divorced" <?php if (!empty($candidateData[0]->marital_status) && $candidateData[0]->marital_status == "Divorced") echo "selected='selected'" ?>>Divorced</option>
                                                    <option value="Separated" <?php if (!empty($candidateData[0]->marital_status) && $candidateData[0]->marital_status == "Separated") echo "selected='selected'" ?>>Separated</option>
                                                </select> 
                                                <?= form_error('marital_status', '<span class="error_msg" for="marital_status" generated="true">', '</span>'); ?>
                                            </div>  
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">                
                                            <div class="form-group">
                                                <label>Employment status: </label> 
                                                <select name="employment_status" class="form-control">
                                                    <option value="">Please Select</option>
                                                    <option value="Employed Full Time" <?php if (!empty($candidateData[0]->employment_status) && $candidateData[0]->employment_status == "Employed Full Time") echo "selected='selected'" ?>>Employed Full Time</option>
                                                    <option value="Employed Part Time" <?php if (!empty($candidateData[0]->employment_status) && $candidateData[0]->employment_status == "Employed Part Time") echo "selected='selected'" ?>>Employed Part Time</option>
                                                    <option value="Self-Employed" <?php if (!empty($candidateData[0]->employment_status) && $candidateData[0]->employment_status == "Self-Employed") echo "selected='selected'" ?>>Self-Employed</option>
                                                    <option value="Out of work and looking for work" <?php if (!empty($candidateData[0]->employment_status) && $candidateData[0]->employment_status == "male") echo "selected='selected'" ?>>Out of work and looking for work</option>
                                                    <option value="A homemaker" <?php if (!empty($candidateData[0]->employment_status) && $candidateData[0]->employment_status == "A homemaker") echo "selected='selected'" ?>>A homemaker</option>
                                                    <option value="A student" <?php if (!empty($candidateData[0]->employment_status) && $candidateData[0]->employment_status == "A student") echo "selected='selected'" ?>>A student</option>
                                                    <option value="Retired" <?php if (!empty($candidateData[0]->employment_status) && $candidateData[0]->employment_status == "Retired") echo "selected='selected'" ?>>Retired</option>
                                                    <option value="Unable to work" <?php if (!empty($candidateData[0]->employment_status) && $candidateData[0]->employment_status == "Unable to work") echo "selected='selected'" ?>>Unable to work</option>
                                                </select> 
                                                <?= form_error('employment_status', '<span class="error_msg" for="employment_status" generated="true">', '</span>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">                 
                                            <div class="form-group">
                                                <label>Phone Number: </label>                     
                                                <input type="text" class="form-control" name="phone_no" value="<?php if (!empty($candidateData[0]->phone_no)) echo $candidateData[0]->phone_no; ?>" /> 
                                                <?= form_error('phone_no', '<span class="error_msg" for="phone_no" generated="true">', '</span>'); ?>
                                            </div>  
                                        </div>
                                    </div>

                                    <!--                                    <div class="row">
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label>ID/Passport Number:</label>                      
                                                                                    <input type="text" class="form-control" name="id_passport_no" value="<?php if (!empty($candidateData[0]->id_passport_no)) echo $candidateData[0]->id_passport_no; ?>">  
                                    <?= form_error('id_passport_no', '<span class="error_msg" for="vat_tax_no" generated="true">', '</span>'); ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>-->
                                    <div class="form-group">
                                        <label>Home Language:</label>                      
                                        <!-- <input type="text" class="form-control" name="home_language" value="<?php if (!empty(@$candidateData[0]->home_language)) echo @$candidateData[0]->home_language; ?>"> <--><select name="home_language" class="form-control" id="">
                                        <option value="Other" <?php if (@$candidateData[0]->home_language=="Other") echo "selected"; ?> >Other</option>
                                        <option value="Afrikaans" <?php if (@$candidateData[0]->home_language=="Afrikaans") echo "selected"; ?> >Afrikaans</option>
                                        <option value="English" <?php if (@$candidateData[0]->home_language=="English") echo "selected"; ?> >English</option>
                                        <option value="Ndebele" <?php if (@$candidateData[0]->home_language=="Ndebele") echo "selected"; ?> >Ndebele</option>
                                        
                                        <option value="Northern Sotho" <?php if (@$candidateData[0]->home_language=="Northern Sotho") echo "selected"; ?> >Northern Sotho</option>
                                        
                                        <option value="Sotho" <?php if (@$candidateData[0]->home_language=="Sotho") echo "selected"; ?> >Sotho</option>
                                        <option value="Swazi" <?php if (@$candidateData[0]->home_language=="Swazi") echo "selected"; ?> >Swazi</option>
                                        <option value="Tsonga" <?php if (@$candidateData[0]->home_language=="Tsonga") echo "selected"; ?> >Tsonga</option>
                                        <option value="Tswana" <?php if (@$candidateData[0]->home_language=="Tswana") echo "selected"; ?> >Tswana</option>
                                        <option value="Venda" <?php if (@$candidateData[0]->home_language=="Venda") echo "selected"; ?> >Venda</option>
                                        <option value="Xhosa" <?php if (@$candidateData[0]->home_language=="Xhosa") echo "selected"; ?> >Xhosa</option>
                                        <option value="Zulu" <?php if (@$candidateData[0]->home_language=="Zulu") echo "selected"; ?> >Zulu</option>
                                        </select>
                                        <?= form_error('home_language', '<span class="error_msg" for="home_language" generated="true">', '</span>'); ?>
                                    </div>
                                    <!--                                    <div class="form-group">
                                                                            <label>Current Job Title:</label>                      
                                                                            <input type="text" class="form-control" name="current_job_title" value="<?php if (!empty($candidateData[0]->current_job_title)) echo $candidateData[0]->current_job_title; ?>">       
                                    <?= form_error('current_job_title', '<span class="error_msg" for="current_job_title" generated="true">', '</span>'); ?>
                                                                        </div>-->
                                    <!--                                    <div class="form-group">
                                                                            <label>Year Working Experience:</label>                      
                                                                            <input type="text" class="form-control" name="working_experience" value="<?php if (!empty($candidateData[0]->working_experience)) echo $candidateData[0]->working_experience; ?>">       
                                    <?= form_error('working_experience', '<span class="error_msg" for="working_experience" generated="true">', '</span>'); ?>
                                                                        </div>-->
                                </div>
                            </div>
                            <input type="hidden" name="full_name" value="<?php if (!empty($candidateData[0]->full_name)) echo $candidateData[0]->full_name; ?>">
                            <input type="hidden" name="id" value="<?php if (!empty($candidateData[0]->id)) echo $candidateData[0]->id; ?>"/>
                            <input class="btn btn-warning" type="submit" value="<?= $buttonLabel; ?>" name="submit" />                                   
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
<script src="<?= base_url() ?>js/moment-with-locales.min.js"></script>
    <script src="<?= base_url() ?>js/bootstrap-datetimepicker.min.js"></script>
    <script>
        $('#dob').datetimepicker({
               viewMode: 'years',
               format : 'MM-DD-YYYY',
               maxDate: moment()
            });
    </script>
    <script>
        function setAge(d1, d2){
        var mdate = d1.toString();
        console.log(mdate);
        var yearThen = parseInt(mdate.substring(6,10), 10);
        var monthThen = parseInt(mdate.substring(0,2), 10);
        var dayThen = parseInt(mdate.substring(3,5), 10);

        console.log(yearThen+'|'+monthThen+'|'+dayThen);
        
        var today = new Date();
        var birthday = new Date(yearThen, monthThen-1, dayThen);
        
        var differenceInMilisecond = today.valueOf() - birthday.valueOf();
        
        var year_age = Math.floor(differenceInMilisecond / 31536000000);
        var day_age = Math.floor((differenceInMilisecond % 31536000000) / 86400000);
        
        if ((today.getMonth() == birthday.getMonth()) && (today.getDate() == birthday.getDate())) {
            alert("Happy B'day!!!");
        }
        
        var month_age = Math.floor(day_age/30);
        
        day_age = day_age % 30;
        
        if (isNaN(year_age) || isNaN(month_age) || isNaN(day_age)) {
            console.log("Invalid birthday - Please try again!");
        }
        else {
            document.getElementById('age').setAttribute("value",year_age);
        }
        
            
            
        }
    
    </script>
<script type="text/javascript">
    $(function () {

        $("#candidate-form").validate({
            errorElement: "span",
            errorClass: "error_msg",
            rules: {//set rules
                first_name: {
                    required: true
                },
                last_name: {
                    required: true
                },
                id_passport_no: {
                    required : true
                },
                dob: {
                    required: true
                },
                gender: {
                    required: true
                },
             /*   // age: {
                //     required: true
                // }, */
                marital_status: {
                    required: true
                },
                employment_status: {
                    required: true
                },
                phone_no: {
                    required: true
                },
                heighest_education: {
                    required: true
                },
                ethnicity: {
                    required: true
                },
                nationality: {
                    required: true
                },
            },
            messages: {//set messages to appear inline

            }
        });

        // $("#dob").datepicker({
        //         numberOfMonths: 1,
        //         onSelect: function (selected) {
        //             var dt = new Date(selected);
        //             dt.setDate(dt.getDate() + 1);
        //             $("#endDate").datepicker("option", "minDate", dt);
        //         }
        // });
    });
</script>