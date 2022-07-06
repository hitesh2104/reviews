<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Welcome To AssessmentHouse</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="<?=base_url();?>css/bootstrap.min.css">
        <link rel="stylesheet" href="<?=base_url();?>css/font-awesome.min.css">
        <link rel="stylesheet" href="<?=base_url();?>css/ionicons.min.css">
        <link rel="stylesheet" href="<?=base_url();?>css/_all-skins.min.css">
        <link rel="stylesheet" href="<?=base_url();?>css/AdminLTE.min.css">
        <link rel="stylesheet" href="<?=base_url();?>css/custom.css">
        <link rel="stylesheet" href="<?=base_url()?>css/bootstrap-datetimepicker.min.css">
        <style>
            .signup-box
            {
                margin-left: 9%;
                background-color: white;
                padding: 2%;
            }
            @media (min-width: 1200px)
            {
                .col-lg-6 {
                    margin-left: 25%;
                }
                .img-responsive
                {
                    max-height:80px;
                }
            }

        </style>
    </head>
    <body class="hold-transition register-page">

        <div class="signup-box col-sm-10 col-xs-10 col-md-6 col-lg-6 ">
            <center>
                <div class="signup-logo">
                    <img class="img-responsive" src="<?=base_url();?>/images/logo.png" >
                </div><!-- /.signup-logo -->
            </center>
            <br><br>
            <div class="signup-box-body">
                <?php messageAlert();?>

                <?php if ($this->session->flashdata('register_error')) {?>
                    <div class="alert alert-danger error-alert"><?=$this->session->flashdata('register_error');?></div>
                <?php }?>
                <!-- candidate details form -->
                <form method="post" id="candidate-form" action="<?=base_url()?>login/signUp/<?=$project_id?>">
                            <?=messageAlert();?>
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>First Name:</label>
                                                <input type="text" class="form-control" name="first_name">
                                                <?=form_error('first_name', '<span class="error_msg" for="first_name" generated="true">', '</span>');?>
                                            </div>
                                        </div>
                                        <!-- <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Middle Name:</label>
                                                <input type="text" class="form-control" name="middle_name" value="<?php if (!empty($candidateData[0]->middle_name)) {
	echo $candidateData[0]->middle_name;
}
?>">
                                                <?=form_error('middle_name', '<span class="error_msg" for="middle_name" generated="true">', '</span>');?>
                                            </div>
                                        </div> -->
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Last Name:</label>
                                                <input type="text" class="form-control" name="last_name" >
                                                <?=form_error('last_name', '<span class="error_msg" for="last_name" generated="true">', '</span>');?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Email:</label>
                                        <input type="text" class="form-control" name="email" >
                                        <?=form_error('email', '<span class="error_msg" for="email" generated="true">', '</span>');?>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>ID/Passport Number:</label>
                                                <input type="text" class="form-control" name="id_passport_no" >
                                                <?=form_error('id_passport_no', '<span class="error_msg" for="vat_tax_no" generated="true">', '</span>');?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Date of Birth:</label>
                                        <input type="text" class="form-control" name="dob" onblur="setAge(this.value)" id="dob" >
                                        <?=form_error('dob', '<span class="error_msg" for="dob" generated="true">', '</span>');?>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Gender: </label>
                                                <select name="gender" class="form-control">
                                                    <option value="">Please Select</option>
                                                    <option value="male">  Male</option>
                                                    <option value="female">  Female</option>
                                                </select>
                                                <?=form_error('gender', '<span class="error_msg" for="gender" generated="true">', '</span>');?>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Age: </label>
                                                <input type="text" class="form-control" name="age" id="age"  />
                                                <?=form_error('age', '<span class="error_msg" for="age" generated="true">', '</span>');?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Nationality:</label>
                                                <select name="nationality" class="form-control">
    <option value="Afghanistan"> Afghanistan</option>
    <option value="Albania">  Albania</option>
    <option value="Algeria">  Algeria</option>
    <option value="American Samoa">  American Samoa</option>
    <option value="Andorra">  Andorra</option>
    <option value="Angola">  Angola</option>
    <option value="Anguilla">  Anguilla</option>
    <option value="Antarctica">  Antarctica</option>
    <option value="Antigua and Barbuda">  Antigua and Barbuda</option>
    <option value="Argentina">  Argentina</option>
    <option value="Armenia">  Armenia</option>
    <option value="Aruba">  Aruba</option>
    <option value="Australia">  Australia</option>
    <option value="Austria">  Austria</option>
    <option value="Azerbaijan">  Azerbaijan</option>
    <option value="Bahamas">  Bahamas</option>
    <option value="Bahrain">  Bahrain</option>
    <option value="Bangladesh">  Bangladesh</option>
    <option value="Barbados">  Barbados</option>
    <option value="Belarus">  Belarus</option>
    <option value="Belgium">  Belgium</option>
    <option value="Belize">  Belize</option>
    <option value="Benin">  Benin</option>
    <option value="Bermuda">  Bermuda</option>
    <option value="Bhutan">  Bhutan</option>
    <option value="Bolivia">  Bolivia</option>
    <option value="Bosnia and Herzegowina">  Bosnia and Herzegowina</option>
    <option value="Botswana">  Botswana</option>
    <option value="Bouvet Island">  Bouvet Island</option>
    <option value="Brazil">  Brazil</option>
    <option value="British Indian Ocean Territory">  British Indian Ocean Territory</option>
    <option value="Brunei Darussalam">  Brunei Darussalam</option>
    <option value="Bulgaria">  Bulgaria</option>
    <option value="Burkina Faso">  Burkina Faso</option>
    <option value="Burundi">  Burundi</option>
    <option value="Cambodia">  Cambodia</option>
    <option value="Cameroon">  Cameroon</option>
    <option value="Canada">  Canada</option>
    <option value="Cape Verde">  Cape Verde</option>
    <option value="Cayman Islands">  Cayman Islands</option>
    <option value="Central African Republic">  Central African Republic</option>
    <option value="Chad">  Chad</option>
    <option value="Chile">  Chile</option>
    <option value="China">  China</option>
    <option value="Christmas Island">  Christmas Island</option>
    <option value="Cocos Islands">  Cocos (Keeling) Islands</option>
    <option value="Colombia">  Colombia</option>
    <option value="Comoros">  Comoros</option>
    <option value="Congo">  Congo</option>
    <option value="Congo">  Congo, the Democratic Republic of the</option>
    <option value="Cook Islands">  Cook Islands</option>
    <option value="Costa Rica">  Costa Rica</option>
    <option value="Cota D'Ivoire">  Cote d'Ivoire</option>
    <option value="Croatia">  Croatia (Hrvatska)</option>
    <option value="Cuba">  Cuba</option>
    <option value="Cyprus">  Cyprus</option>
    <option value="Czech Republic">  Czech Republic</option>
    <option value="Denmark">  Denmark</option>
    <option value="Djibouti">  Djibouti</option>
    <option value="Dominica">  Dominica</option>
    <option value="Dominican Republic">  Dominican Republic</option>
    <option value="East Timor">  East Timor</option>
    <option value="Ecuador">  Ecuador</option>
    <option value="Egypt">  Egypt</option>
    <option value="El Salvador">  El Salvador</option>
    <option value="Equatorial Guinea">  Equatorial Guinea</option>
    <option value="Eritrea">  Eritrea</option>
    <option value="Estonia">  Estonia</option>
    <option value="Ethiopia">  Ethiopia</option>
    <option value="Falkland Islands">  Falkland Islands (Malvinas)</option>
    <option value="Faroe Islands">  Faroe Islands</option>
    <option value="Fiji">  Fiji</option>
    <option value="Finland">  Finland</option>
    <option value="France">  France</option>
    <option value="France Metropolitan">  France, Metropolitan</option>
    <option value="French Guiana">  French Guiana</option>
    <option value="French Polynesia">  French Polynesia</option>
    <option value="French Southern Territories">  French Southern Territories</option>
    <option value="Gabon">  Gabon</option>
    <option value="Gambia">  Gambia</option>
    <option value="Georgia">  Georgia</option>
    <option value="Germany">  Germany</option>
    <option value="Ghana">  Ghana</option>
    <option value="Gibraltar">  Gibraltar</option>
    <option value="Greece">  Greece</option>
    <option value="Greenland">  Greenland</option>
    <option value="Grenada">  Grenada</option>
    <option value="Guadeloupe">  Guadeloupe</option>
    <option value="Guam">  Guam</option>
    <option value="Guatemala">  Guatemala</option>
    <option value="Guinea">  Guinea</option>
    <option value="Guinea-Bissau">  Guinea-Bissau</option>
    <option value="Guyana">  Guyana</option>
    <option value="Haiti">  Haiti</option>
    <option value="Heard and McDonald Islands">  Heard and Mc Donald Islands</option>
    <option value="Holy See">  Holy See (Vatican City State)</option>
    <option value="Honduras">  Honduras</option>
    <option value="Hong Kong">  Hong Kong</option>
    <option value="Hungary">  Hungary</option>
    <option value="Iceland">  Iceland</option>
    <option value="India">  India</option>
    <option value="Indonesia">  Indonesia</option>
    <option value="Iran">  Iran (Islamic Republic of)</option>
    <option value="Iraq">  Iraq</option>
    <option value="Ireland">  Ireland</option>
    <option value="Israel">  Israel</option>
    <option value="Italy">  Italy</option>
    <option value="Jamaica">  Jamaica</option>
    <option value="Japan">  Japan</option>
    <option value="Jordan">  Jordan</option>
    <option value="Kazakhstan">  Kazakhstan</option>
    <option value="Kenya">  Kenya</option>
    <option value="Kiribati">  Kiribati</option>
    <option value="Democratic People's Republic of Korea">  Korea, Democratic People's Republic of</option>
    <option value="Korea">  Korea, Republic of</option>
    <option value="Kuwait">  Kuwait</option>
    <option value="Kyrgyzstan">  Kyrgyzstan</option>
    <option value="Lao"> >Lao
    </option>
    <option value="Latvia">  Latvia</option>
    <option value="Lebanon"> selected  Lebanon</option>
    <option value="Lesotho">  Lesotho</option>
    <option value="Liberia">  Liberia</option>
    <option value="Libyan Arab Jamahiriya">  Libyan Arab Jamahiriya</option>
    <option value="Liechtenstein">  Liechtenstein</option>
    <option value="Lithuania">  Lithuania</option>
    <option value="Luxembourg">  Luxembourg</option>
    <option value="Macau">  Macau</option>
    <option value="Macedonia">  Macedonia, The Former Yugoslav Republic of</option>
    <option value="Madagascar">  Madagascar</option>
    <option value="Malawi">  Malawi</option>
    <option value="Malaysia">  Malaysia</option>
    <option value="Maldives">  Maldives</option>
    <option value="Mali">  Mali</option>
    <option value="Malta">  Malta</option>
    <option value="Marshall Islands">  Marshall Islands</option>
    <option value="Martinique">  Martinique</option>
    <option value="Mauritania">  Mauritania</option>
    <option value="Mauritius">  Mauritius</option>
    <option value="Mayotte">  Mayotte</option>
    <option value="Mexico">  Mexico</option>
    <option value="Micronesia">  Micronesia, Federated States of</option>
    <option value="Moldova">  Moldova, Republic of</option>
    <option value="Monaco">  Monaco</option>
    <option value="Mongolia">  Mongolia</option>
    <option value="Montserrat">  Montserrat</option>
    <option value="Morocco">  Morocco</option>
    <option value="Mozambique">  Mozambique</option>
    <option value="Myanmar">  Myanmar</option>
    <option value="Namibia">  Namibia</option>
    <option value="Nauru">  Nauru</option>
    <option value="Nepal">  Nepal</option>
    <option value="Netherlands">  Netherlands</option>
    <option value="Netherlands Antilles">  Netherlands Antilles</option>
    <option value="New Caledonia">  New Caledonia</option>
    <option value="New Zealand">  New Zealand</option>
    <option value="Nicaragua">  Nicaragua</option>
    <option value="Niger">  Niger</option>
    <option value="Nigeria">  Nigeria</option>
    <option value="Niue">  Niue</option>
    <option value="Norfolk Island">  Norfolk Island</option>
    <option value="Northern Mariana Islands">  Northern Mariana Islands</option>
    <option value="Norway">  Norway</option>
    <option value="Oman">  Oman</option>
    <option value="Pakistan">  Pakistan</option>
    <option value="Palau">  Palau</option>
    <option value="Panama">  Panama</option>
    <option value="Papua New Guinea">  Papua New Guinea</option>
    <option value="Paraguay">  Paraguay</option>
    <option value="Peru">  Peru</option>
    <option value="Philippines">  Philippines</option>
    <option value="Pitcairn">  Pitcairn</option>
    <option value="Poland">  Poland</option>
    <option value="Portugal">  Portugal</option>
    <option value="Puerto Rico">  Puerto Rico</option>
    <option value="Qatar">  Qatar</option>
    <option value="Reunion">  Reunion</option>
    <option value="Romania">  Romania</option>
    <option value="Russia">  Russian Federation</option>
    <option value="Rwanda">  Rwanda</option>
    <option value="Saint Kitts and Nevis">  Saint Kitts and Nevis</option>
    <option value="Saint LUCIA">  Saint LUCIA</option>
    <option value="Saint Vincent">  Saint Vincent and the Grenadines</option>
    <option value="Samoa">  Samoa</option>
    <option value="San Marino">  San Marino</option>
    <option value="Sao Tome and Principe">  Sao Tome and Principe</option>
    <option value="Saudi Arabia">  Saudi Arabia</option>
    <option value="Senegal">  Senegal</option>
    <option value="Seychelles">  Seychelles</option>
    <option value="Sierra">  Sierra Leone</option>
    <option value="Singapore">  Singapore</option>
    <option value="Slovakia">  Slovakia (Slovak Republic)</option>
    <option value="Slovenia">  Slovenia</option>
    <option value="Solomon Islands">  Solomon Islands</option>
    <option value="Somalia">  Somalia</option>
    <option value="South Africa"  selected >South Africa</option>
    <option value="South Georgia">  South Georgia and the South Sandwich Islands</option>
    <option value="Span">  Spain</option>
    <option value="SriLanka">  Sri Lanka</option>
    <option value="St. Helena">  St. Helena</option>
    <option value="St. Pierre and Miguelon">  St. Pierre and Miquelon</option>
    <option value="Sudan">  Sudan</option>
    <option value="Suriname">  Suriname</option>
    <option value="Svalbard">  Svalbard and Jan Mayen Islands</option>
    <option value="Swaziland">  Swaziland</option>
    <option value="Sweden">  Sweden</option>
    <option value="Switzerland">  Switzerland</option>
    <option value="Syria">  Syrian Arab Republic</option>
    <option value="Taiwan">  Taiwan, Province of China</option>
    <option value="Tajikistan">  Tajikistan</option>
    <option value="Tanzania">  Tanzania, United Republic of</option>
    <option value="Thailand">  Thailand</option>
    <option value="Togo">  Togo</option>
    <option value="Tokelau">  Tokelau</option>
    <option value="Tonga">  Tonga</option>
    <option value="Trinidad and Tobago">  Trinidad and Tobago</option>
    <option value="Tunisia">  Tunisia</option>
    <option value="Turkey">  Turkey</option>
    <option value="Turkmenistan">  Turkmenistan</option>
    <option value="Turks and Caicos">  Turks and Caicos Islands</option>
    <option value="Tuvalu">  Tuvalu</option>
    <option value="Uganda">  Uganda</option>
    <option value="Ukraine">  Ukraine</option>
    <option value="United Arab Emirates">  United Arab Emirates</option>
    <option value="United Kingdom">  United Kingdom</option>
    <option value="United States">  United States</option>
    <option value="United States Minor Outlying Islands">  United States Minor Outlying Islands</option>
    <option value="Uruguay">  Uruguay</option>
    <option value="Uzbekistan">  Uzbekistan</option>
    <option value="Vanuatu">  Vanuatu</option>
    <option value="Venezuela">  Venezuela</option>
    <option value="Vietnam">  Viet Nam</option>
    <option value="Virgin Islands (British)">  Virgin Islands (British)</option>
    <option value="Virgin Islands (U.S)">  Virgin Islands (U.S.)</option>
    <option value="Wallis and Futana Islands">  Wallis and Futuna Islands</option>
    <option value="Western Sahara">  Western Sahara</option>
    <option value="Yemen">  Yemen</option>
    <option value="Yugoslavia">  Yugoslavia</option>
    <option value="Zambia">  Zambia</option>
    <option value="Zimbabwe">  Zimbabwe</option>
</select>
                                                <?=form_error('nationality', '<span class="error_msg" for="nationality" generated="true">', '</span>');?>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Ethnicity: </label>
                                                <select name="ethnicity" class="form-control">
                                                    <option value="">Please Select</option>
                                                    <option value="White">  White</option>
                                                    <option value="Hispanic or Latino">  Hispanic or Latino</option>
                                                    <option value="Black or African">  Black or African</option>
                                                    <option value="Native American or American Indian">  Native American or American Indian</option>
                                                    <option value="Asian">  Asian</option>
                                                    <option value="Coloured">  Coloured</option>
                                                    <option value="Other">  Other</option>
                                                </select>
                                                <?=form_error('ethnicity', '<span class="error_msg" for="ethnicity" generated="true">', '</span>');?>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label> Highest Education: </label>
                                                <select name="heighest_education" class="form-control">
                                                    <option value="">Please Select</option>
                                                    <option value="High School">  High School</option>
                                                    <option value="College Certificate">  College Certificate</option>
                                                    <option value="College Diploma">  College Diploma</option>
                                                    <option value="Trade/Technical/Vocational Training">  Trade/Technical/Vocational Training</option>
                                                    <option value="Bachelors Degree">  Bachelors Degree</option>
                                                    <option value="Honours Degree">  Honours Degree</option>
                                                    <option value="Masters Degree">  Masters Degree</option>
                                                    <option value="Doctorate Degree">  Doctorate Degree</option>

                                                </select>
                                                <?=form_error('heighest_education', '<span class="error_msg" for="heighest_education" generated="true">', '</span>');?>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Marital Status: </label>
                                                <select name="marital_status" class="form-control">
                                                    <option value="">Please Select</option>
                                                    <option value="Single, Never Married">  Single, Never Married</option>
                                                    <option value="Married or Domestic Partnership">  Married or Domestic Partnership</option>
                                                    <option value="Widowed">  Widowed</option>
                                                    <option value="Divorced">  Divorced</option>
                                                    <option value="Separated">  Separated</option>
                                                </select>
                                                <?=form_error('marital_status', '<span class="error_msg" for="marital_status" generated="true">', '</span>');?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Employment status: </label>
                                                <select name="employment_status" class="form-control">
                                                    <option value="">Please Select</option>
                                                    <option value="Employed Full Time">  Employed Full Time</option>
                                                    <option value="Employed Part Time">  Employed Part Time</option>
                                                    <option value="Self-Employed">  Self-Employed</option>
                                                    <option value="Out of work and looking for work">  Out of work and looking for work</option>
                                                    <option value="A homemaker">  A homemaker</option>
                                                    <option value="A student">  A student</option>
                                                    <option value="Retired">  Retired</option>
                                                    <option value="Unable to work">  Unable to work</option>
                                                </select>
                                                <?=form_error('employment_status', '<span class="error_msg" for="employment_status" generated="true">', '</span>');?>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Phone Number: </label>
                                                <input type="text" class="form-control" name="phone_no"  />
                                                <?=form_error('phone_no', '<span class="error_msg" for="phone_no" generated="true">', '</span>');?>
                                            </div>
                                        </div>
                                    </div>

                                    <!--                                    <div class="row">
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label>ID/Passport Number:</label>
                                                                                    <input type="text" class="form-control" name="id_passport_no" value="<?php if (!empty($candidateData[0]->id_passport_no)) {
	echo $candidateData[0]->id_passport_no;
}
?>">
                                    <?=form_error('id_passport_no', '<span class="error_msg" for="vat_tax_no" generated="true">', '</span>');?>
                                                                                </div>
                                                                            </div>
                                                                        </div>-->
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Home Language:</label>
                                        <!-- <input type="text" class="form-control" name="home_language" value="<?php if (!empty($candidateData[0]->home_language)) {
	echo $candidateData[0]->home_language;
}
?>"> <-->
                                        <select name="home_language" class="form-control" id="">
                                        <option value="Other">Other</option>
                                        <option value="Afrikaans">  Afrikaans</option>
                                        <option value="English">  English</option>
                                        <option value="Ndebele">  Ndebele</option>
                                        <option value="Northern Sotho"> Northern Sotho</option>
                                        <option value="Sotho">Sotho</option>
                                        <option value="Swazi"> Swazi</option>
                                        <option value="Tsonga"> Tsonga</option>
                                        <option value="Tswana"> Tswana</option>
                                        <option value="Venda"> Venda</option>
                                        <option value="Xhosa"> Xhosa</option>
                                        <option value="Zulu">  Zulu</option>
                                        </select>
                                        <?=form_error('home_language', '<span class="error_msg" for="home_language" generated="true">', '</span>');?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="current_job_level" class="control-label" required>Current Job Level</label>
                                            <select name="current_job_level" class="form-control">
                                                <option value="administration/entry_level">Administration/Entry level</option>
                                                <option value="junior_management/supervisory">Junior Management/Supervisory</option>
                                                <option value="middle_management">Middle Management</option>
                                                <option value="senior_management">Senior Management</option>
                                                <option value="executive_management">Executive Management</option>
                                                <option value="professional/specialist">Professional/Specialist</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                    <!--                                    <div class="form-group">
                                                                            <label>Current Job Title:</label>
                                                                            <input type="text" class="form-control" name="current_job_title" value="<?php if (!empty($candidateData[0]->current_job_title)) {
	echo $candidateData[0]->current_job_title;
}
?>">
                                    <?=form_error('current_job_title', '<span class="error_msg" for="current_job_title" generated="true">', '</span>');?>
                                                                        </div>-->
                                    <!--                                    <div class="form-group">
                                                                            <label>Year Working Experience:</label>
                                                                            <input type="text" class="form-control" name="working_experience" value="<?php if (!empty($candidateData[0]->working_experience)) {
	echo $candidateData[0]->working_experience;
}
?>">
                                    <?=form_error('working_experience', '<span class="error_msg" for="working_experience" generated="true">', '</span>');?>
                                                                        </div>-->
                                </div>
                            </div>
                            <input type="hidden" class="form-control" name="full_name" >
                            <input type="hidden" name="id">
                            <input class="btn btn-warning" type="submit" value="SignUp" name="submit" />
                        </form>

            </div><!-- /.signup-box-body -->
        </div><!-- /.login-box -->



        <script src="<?=base_url();?>js/jQuery-2.1.4.min.js"></script>
        <script src="<?=base_url();?>js/bootstrap.min.js"></script>
        <script src="<?=base_url();?>js/app.js"></script>
        <script src="<?=base_url();?>js/jquery.validate.min.js"></script>
        <script src="http://code.jquery.com/jquery-migrate-1.0.0.js"></script>

<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/start/jquery-ui.css" rel="Stylesheet" type="text/css" />
<script src="<?=base_url()?>js/moment-with-locales.min.js"></script>
    <script src="<?=base_url()?>js/bootstrap-datetimepicker.min.js"></script>
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
                // full_name:{
                //     required : true
                // },
                id_passport_no: {
                    required : true
                },
                dob: {
                    required: true
                },
                email:{
                    required: true,
                    email : true
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
    </body>
</html>