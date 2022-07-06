<style type="text/css">
    @import url(http://fonts.googleapis.com/css?family=Open+Sans:400,300,600);	

    #slider {
        position: relative;
        overflow: hidden;
        margin: 20px auto 0 auto;
        border-radius: 4px;
    }
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}
input[type=number] {
    -moz-appearance:textfield;
}
    #slider ul {
        position: relative;
        margin: 0;
        padding: 0;
        height: 200px;
        list-style: none;
    }

    #slider ul li {
        position: relative;
        display: block;
        float: left;
        margin: 0;
        padding: 0;
        width: 1100px;
        height: 570px;
        //background: #ccc;
        text-align: center;
        //line-height: 300px;
    }

    a.control_prev, a.control_next {
        position: absolute;
        top: 70%;
        z-index: 999;
        display: block;
        padding: 10px;
        min-width: 100px;
        height: auto;
        //background: #2a2a2a;
        color: #fff;
        text-decoration: none;
        font-weight: 600;
        font-size: 16px;
        opacity: 0.8;
        cursor: pointer;
    }

    a.control_prev:hover, a.control_next:hover {
        opacity: 1;
        -webkit-transition: all 0.2s ease;
    }


    a.control_prev1, a.control_next1 {
        position: absolute;
        top: 70%;
        z-index: 999;
        display: block;
        padding: 10px;
        min-width: 100px;
        height: auto;
        //background: #2a2a2a;
        color: #fff;
        text-decoration: none;
        font-weight: 600;
        font-size: 16px;
        opacity: 0.8;
        cursor: pointer;
    }

    a.control_prev1:hover, a.control_next1:hover {
        opacity: 1;
        -webkit-transition: all 0.2s ease;
    }

    button.control_prev {
        border-radius: 4px;
    }

    a.control_next {
        right: 15px;
        border-radius: 4px;
    }
    a.control_next1 {
        right: 15px;
        border-radius: 4px;
    }
    #secQuestionHolder
    {
        margin: 0 auto;
        width: 645px;
        height: 50px;
        text-align: center;
    }
    .secQuestion
    {
        float: left;
        border: 1px solid #000000;
        width: 90px;
        height: 30px;
        font-size: 20px;
    }
     table{
        margin-left: 130px;
    }

    table, th,  tr, td {
    border: 2px solid #99c5da;
    border-collapse: collapse;
    }
    
    th {
        background-color: #f0faff;
    }

    .intro1{
        height: 440px;
    }
    .intro2{
        height: 470px;
    }
    .t3_row{ height: 30px; background-color: #f0faff; }
    .t3_q{ float: left; width: 580px; padding-top: 6px; padding-left: 20px; border: 0px;  }
    
    .t3_a{ background-color: #f5f5f5; width: 200px;  }

    #t3_title{ font-weight: bold; color: #000; font-size: 13px;}
    #t3_title:hover{ background-color: #fff;}
</style>
<?php
if($sacId=="E"){
?>
<script src="<?= base_url(); ?>js/test/test4.js"></script>
<?php
require_once 'include/est_info4.php';
}else{
?>
<script src="<?= base_url(); ?>js/test/test20.js"></script>
<?php
require_once("include/sales_apti.php");
}
?>

<?php //require_once("include/sales_apti.php"); ?>
<?php //require_once 'include/est_info4.php';?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Sales Aptitude Skills</h1>
    </section>

    <?php if($sacId=="A"){ ?>
        <section style="background: #ffffff" class="content">
            <div class="intro1" style="display:block;">
                <center><h1>SALESMAP</h1></center>
                <h2><u>Introduction</u></h2>
                <br/>
                <p>Welcome to the SALESMAP assessment. This assessment measures an array of sales related skills, behaviours, values and motivations.</p>
                <br>
                <p>Please take note of the following:</p>
                <ol>
                    <li>The assessment will take approximately 25 minutes to complete, so please ensure you have enough time to complete the assessment.</li>
                    <!-- <li>You have 30 seconds per question, after 30 seconds the test will automatically move to the next question</li> -->
                    <li>This assessment comprises of 5 subtests, sections A, B, C, D and E.</li>
                    <li>Please turn off your cellphone and/or any other device that might break your concentration or interrupt you in any way.</li>
                    <li>You do not need a calculator or a pen and paper, everything will be done online.</li>
                    <li>Please read the instructions carefully</li>
                    <li>Once you’ve started with the actual test, you won’t be able to go back to the instructions.</li>
                  <li>Please do not refresh any of the pages or click on the browsers’ BACK button at any time. The test will reset and you won’t be able to continue with the assessment.</li>

                </ol>
                <div class="clearfix"></div>
                <br/>
                <div style="text-align: center;">
                    <button type="button" class="btn btn-primary" onclick="introOne()">Next</button>
                </div>

            </div>
            <div class="intro2" style="display:none;">
                <center><h2>Section A | Sales Skills</h2></center>
                <br/>
                <h4>Instructions</h4>
                <br>
                <ul>
                    <li>The sales skills test measures your knowledge and skills through a range of sales related questions.</li>
                    <li>You will be presented with a question or a statement with four possible answers. Please read each question/statement carefully and select the correct answer.</li>
                    <li>This test does not have a time limit.</li>
                    <li>When you are ready, please click on “Start”</li>
                </ul>
                <div class="clearfix"></div>
                <br/>
                <div style="text-align: center;">
                    <button type="button" class="btn btn-primary" onclick="introTwo()">Start</button>
                </div>

            </div>
            
            <div id="slider"  style="display:none">
                <form method="post" id="questions_form" action="<?= base_url(); ?>test/processTest20">
                    <input type="hidden" name="type" value="secA"/>
                    <input type="hidden" name="cat_id" value="<?= $catId;?>"/>
                   <!--  <div style="font-size:18px; text-align: center;">Time Remaining: <span id="timer"></span></div>
                    <br><br> -->
                    <h1 class="text-center" style="color:#666;">Please select the correct answer</h1>
                    <br><br>
                    <ul class="questions_list" id="1">
                        <?php foreach ($sectionOneArr as $key => $secOneArr) { ?>
                            <li style="text-align: left" id="slide<?= ++$key; ?>">
                                <h2 class="text-center"><?= $secOneArr['qus']; ?></h2>
                                <br/>
                                <div class="row text-center">
                                <?php foreach ($secOneArr['option'] as $ans => $option) { ?>
                                    <div class="col-md-3">
                                    <label>
                                        <input name="q<?= $key; ?>" type="radio" value="<?= ++$ans; ?>"/>
                                       <span style="font-size:18px;"><?= $option; ?></span><br/>
                                    </label>
                                    </div>
                                <?php } ?>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                    <a class="control_next btn btn-primary"  style="opacity: 1;">Next</a>
                    <a class="control_prev btn btn-primary" style="opacity: 1;">Previous</a>
                </form>
            </div>
        </section>
    <?php } elseif($sacId=="B") { ?>
        <section style="background: #ffffff" class="content">
            <div class="intro2" style="display:block;">
                <center><h1>Section B | Motivations and Values</h1></center>
                <br/>
                <h4>Instructions</h4>
                <br>
                <ul>
                    <li>This test measures your motivators and values at work.</li>
                    <li>There are no correct or incorrect answers, but descriptors that you must rate from most preferred to least preferred.</li>
                    <li>Please rank your motivators and values from 1 – 4, where 1 is the most important descriptor or the descriptor that describes you the best, and 4 the least important descriptor, or the descriptor that describes you the least.</li>
                    <li>This test does not have a time limit.</li>
                    <li>When you are ready, please click on “Start”</li>
                </ul>
                <br/>
                <div class="clearfix"></div>
                <br/>
                <div style="text-align: center;">
                    <button type="button" class="btn btn-primary" onclick="introTwo1()">Start</button>
                </div>

            </div>
            <div class="intro2" style="display:none;">
                <h2>Section B | Sales Values</h2>
                <br/>
                <h4>Instructions</h4>
                <br>
                <ul>
                    <li>There are no right or wrong answers.</li>
                    <li>You should aim to take no more than 10 minutes to complete it. Be certain that you complete this section thinking of yourself in your current situation;</li>
                    <li>You are presented with sets of four descriptors/phrases. Rank the descriptor/phrase from 1 – 4 in order that most describes you in the working environment, where 1 describes you the most, 2 = second most etc.</li>
                    <li>When you are ready, please click on Begin Test.</li>
                </ul>

                   
                <div class="clearfix"></div>
                <br/>
                <div style="text-align: center;">
                    <button type="button" class="btn btn-primary" onclick="introTwo1()">Begin Test</button>
                </div>

            </div>
            
            <div class="sec" style="display:none">
                <form method="post" id="test2" class="form test_wrapper" action="<?= base_url();?>test/processTest20">
                    <input type="hidden" name="type" value="secB"/>
                    <input type="hidden" name="cat_id" value="<?= $catId;?>"/>
                   <!--  <div style="font-size:18px; text-align: center;">Time Remaining: <span id="timer"></span></div>
                    <br><br> -->
                    <div class="panel panel-danger">
                    <div class="panel-body">
                        <strong>Rating scale:</strong>
                        <ul>
                            <li>    1 = Most important/Describes you the most.</li>
                            <li>    2   </li>
                            <li>    3   </li>
                            <li>    4 = Least important/ Describes you the least.</li>
                        </ul>
                    </div>

                </div>
                <div rid="1" id="r1" class="row">

            <?php
                    $row=1;
                    $i=0;
                    $ans_i =-1;
                    foreach ($behaviours as $key=> $val) {
                        $i+=1;
                        $ans_i+=1;
                        
                  ?>
                  
                    <div class="col-md-3" style="display: flex; margin-top: 10px;">
                      <div class="behaviour" style="width:225px;"><?php echo $val["title"];?></div>
                      <div class="rating" style="margin-left: 15px;"  rid="<?php echo $row; ?>" id="<?php echo $i;?>">
                        <input type="number" class="numClass" id="f<?php echo $i;?>" min=1 max=4 style="width:50px;" name="q<?php echo $i;?>"  >
                        <input type="hidden" id="type<?php echo $i;?>" name="types[<?php echo $i;?>]" value="<?php echo $val["types"];  ?>" >
                      </div>
                    </div>

                    <?php if($i % 4== 0){ $row+=1; echo '</div><div rid="'.$row.'" id="r'.$row.'" class="row">';} 
                  }?>
                  <div class="clearfix"></div>
                <div class="buttons text-center" style="margin-top: 30px;">
                 <input type="submit" id="test2" class="color_btn btn_color btn btn-primary" value="Continue"/>
                </div>
                </form>
            </div>
        </section>
    <?php } elseif($sacId=="C") { ?>
        <section style="background: #ffffff" class="content">
            <center><h1>Sales Attributes</h1></center>
            <div class="intro1" style="display:block;">
                <h2 class="text-center"><u>You have successfully completed section B. Please click on Continue to complete section C.</u></h2>
                <br/>
                <div class="clearfix"></div>
                <br/>
                <div style="text-align: center;">
                    <button type="button" class="btn btn-primary" onclick="$('.intro1').hide();$('.intro2').show()">Continue</button>
                </div>

            </div>
            <!-- <div class="intro2" style="display:none;">
                <h2>Section C | Sales Attributes</h2>
                <br/>
                <h4>Instructions</h4>
                <br>
                <ul>
                    <li>Read the behavioural attributes below and select the 5 attributes that describes you the MOST</li>
                    
                </ul>
                
                <div class="clearfix"></div>
                <br/>
                <div style="text-align: center;">
                    <button type="button" class="btn btn-primary" onclick="introTwo()">Begin Test</button>
                </div>
            
            </div> -->
            <div class="intro2" style="display:none;">
                <center><h1>Section C | Behavioural Attributes</h1></center>
                <br/>
                <h4>Instructions</h4>
                <br>
                <ul>
                    <li>This section measures various behavioural attributes that relates to your working environment.</li>
                    <li>On the first page, you will be presented with various behavioural attributes, and you are required to select the 5 attributes that describes you the most.</li>
                    <li>On the second page, you will be presented with the same set of behavioural attributes, but this time you must select the 5 attributes that describes you the least.</li>
                    <li>This test does not have a time limit.</li>
                    <li>When you are ready, please click on “Start”</li>


                </ul>
                <br/>
                <div class="clearfix"></div>
                <br/>
                <br/>
                <div style="text-align: center;">
                    <button type="button" class="btn btn-primary" onclick="$('.intro2').hide();$('#slider1').show()">Start</button>
                </div>

            </div>
            
            <div id="slider1" style="display:none">
                <h3 class="text-center">Read the behavioural attributes below and select the 5 attributes that describes you the MOST</h3>
                    
               
                <form method="post" id="questions_form1"  action="<?= base_url(); ?>test/processTest20">
                    <input type="hidden" name="type" value="secC"/>
                    <input type="hidden" name="cat_id" value="<?= $catId;?>"/>
                    <ul class="questions_list" style="margin-left: 15px !important">
                        <li style="text-align: left;">
                            <table class="table-hover">
                                <thead>
                                    <tr id="heading"> 
                                        <th class="text-center">Question</th>
                                        <th class="text-center" style="width: 100px;">Select</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $i = 1;
                                foreach ($secA as $key => $A) { ?>
                                    <tr class="t3_row" id="<?= $i ?>">
                                        <td class="t3_q">
                                            <?=$A['question'] ?>
                                        </td>
                                        <td class="t3_a">
                                            <div class="text-center">
                                                <!-- <input type="checkbox" onclick='chkcontrol(0);' class="ckb" name="<?="q".$i ?>" value="<?="q".$i ?>"/> -->
                                                <input type="checkbox"  class="ckb" name="most[]" value="<?=$i ?>"/>
                                            </div>
                                        </td>

                                    </tr>
                                   <?php $i++; }  ?>
                                </tbody>
                            </table>

                        </li>
                    </ul>
                    <div class="buttons" style="width: 1100px;margin: 20px auto 0 auto;">
                            <div class="row">
                            <div class="col-md-6 text-left">
                                <input type="button" style="margin: auto;" class="btn btn-primary disabled btn-lg" id="testp" value="Previous" />
                            </div>
                            <div class="col-md-6 text-right">
                                <input type="submit" style="margin: auto;" class="btn btn-primary btn-lg" id="test3" value="Next" />
                            </div>
                            </div>
                        </div>
                </form>
            </div>
        </section> 
    <?php } elseif($sacId=="D") { ?>
        <section style="background: #ffffff" class="content">
            <center><h1>Sales Attributes</h1></center>
            <div class="intro1" style="display:none;">
                <h3 class="text-center"><u>You have successfully completed section C. Please click on Continue to complete section C.</u></h2>
                <br/>
                <div class="clearfix"></div>
                <br/>
                <div style="text-align: center;">
                    <button type="button" class="btn btn-primary" onclick="introOne1()">Continue</button>
                </div>

            </div>
            <div class="intro2" style="display:none;">
                <h2>Section C | Sales Attributes</h2>
                <br/>
                <h4>Instructions</h4>
                <br>
                <ul>
                    <li>Read the behavioural attributes below and select the 5 attributes that describes you the LEAST</li>
                    
                </ul>
                
                <div class="clearfix"></div>
                <br/>
                <div style="text-align: center;">
                    <button type="button" class="btn btn-primary" onclick="introTwo()">Begin Test</button>
                </div>

            </div>
            
            <div id="slider1" style="display:block;">
                <h3 class="text-center">Read the behavioural attributes below and select the 5 attributes that describes you the LEAST</h3>
                    
               
                <form method="post" id="questions_form1"  action="<?= base_url(); ?>test/processTest20">
                    <input type="hidden" name="type" value="secD"/>
                    <input type="hidden" name="cat_id" value="<?= $catId;?>"/>
                    <ul class="questions_list" style="margin-left: 15px !important">
                        <li style="text-align: left;">
                            <table class="table-hover">
                                <thead>
                                    <tr id="heading"> 
                                        <th class="text-center">Question</th>
                                        <th class="text-center" style="width: 100px;">Select</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $i = 1;
                                foreach ($secA as $key => $A) { ?>
                                    <tr class="t3_row" id="<?= $i ?>">
                                        <td class="t3_q">
                                            <?=$A['question'] ?>
                                        </td>
                                        <td class="t3_a">
                                            <div class="text-center">
                                                <!-- <input type="checkbox" onclick='chkcontrol(0);' class="ckb" name="<?="q".$i ?>" value="<?="q".$i ?>"/> -->
                                                <input type="checkbox"  class="ckb" name="least[]" value="<?=$i ?>"/>
                                            </div>
                                        </td>

                                    </tr>
                                   <?php $i++; }  ?>
                                </tbody>
                            </table>

                        </li>
                    </ul>
                    <div class="buttons" style="width: 1100px;margin: 20px auto 0 auto;">
                            <div class="row">
                            <div class="col-md-6 text-left">
                                <input type="button" style="margin: auto;" class="btn btn-primary disabled btn-lg" id="testp" value="Previous" />
                            </div>
                            <div class="col-md-6 text-right">
                                <input type="submit" style="margin: auto;" class="btn btn-primary btn-lg" id="test3" value="Next" />
                            </div>
                            </div>
                        </div>
                </form>
            </div>
        </section> 
    <?php } elseif ($sacId=="E") {?>
        <section style="background: #ffffff" class="content" style="padding-left: 15px;">
            <h1>Section D |Drivers and Engagement</h1>

            <div class="intro1" style="display:block;">
                <br/>
                <h4>Instructions</h4>
                <br>
                <ul>
                    <li>The Drivers and Engagement test measures attributes that keeps you engaged at work, and identify key drivers from your personality. You will be presented with four statements which you need to rate on a 4-point scale, from most important to least important. You must allocate a score to all four statements.</li>
                    <li>The rating scale on this assessment is similar to Section B, however the rating works from 1 - 4, where 1 is the most important descriptor or the descriptor that describes you the best, and 4 is the least important descriptor, or the descriptor that describes you the least.</li>
                    <li>This test does not have a time limit.</li>
                    <li>When you are ready, please click on “Start”</li>
                </ul>
                <div class="clearfix"></div>
                <!--h2><u>Introduction</u></h2-->
                <br/>
                <!-- <p style="font-size:14px; text-align:justify;">
                This will be DIP new instructions:
                The Drivers and Engagement test measures attributes that keeps you engaged at work, and identify key drivers from your personality. You will be presented with four statements which you need to rate on a 4-point scale, from most important to least important. You must allocate a score to all four statements.
                The rating scale on this assessment is similar to Section B, where 1 is the most important descriptor or the descriptor that describes you the best, and 4 is the least important descriptor, or the descriptor that describes you the least.
                This test does not have a time limit.
                When you are ready, please click on “Start<br /><br />
                    <strong>Please use the following scale to rate the statements:</strong>
                    <ul>
                        <li>    1 = Describes you the best.</li>
                        <li>    2   </li>
                        <li>    3   </li>
                        <li>    4 =  Describes you the least.</li>
                    </ul>
                    <strong>Example:</strong><br />
                    <img src="<?php echo base_url()?>images/dip_rule.png" width="100%">
                    
                </p> -->
                <div class="clearfix"></div>
                <br/>
                <div style="text-align: center;">
                    <button type="button" class="btn btn-primary" onclick="$('.intro1').hide();$('.sec').show()">Start</button>
                </div>
            </div>
            

            <div class="clearfix"></div>
            <div class="sec" style="display: none;">
                <div  id="sec" class="row" style="margin-left: auto;">
                    <form method="post" id="test2" class="form test_wrapper"  action="<?= base_url(); ?>test/processTest20">
                        <input type="hidden" name="type" value="secE"/>
                        <input type="hidden" name="cat_id" value="<?= $catId;?>"/>
                        <div class="panel panel-danger">
                            <div class="panel-body">
                                <strong>Rating scale:</strong>
                                <ul>
                                    <li>    1 = Describes you the best.</li>
                                    <li>    2   </li>
                                    <li>    3   </li>
                                    <li>    4 = Describes you the least.</li>
                                </ul>
                            </div>
                        </div>
                        <div rid="1" id="r1" class="row">
                            <?php
                            $row=1;
                            $i=0;
                            $ans_i =-1;
                            foreach ($behaviours as $key=> $val) {
                                $i+=1;
                                $ans_i+=1;
                                
                            ?>
                            <div class="col-md-3" style="display: flex; margin-top: 10px;">
                              <div class="behaviour" style="width:225px;"><?php echo $val["title"];  ?></div>
                              <div class="rating" style="margin-left: 15px;"  rid="<?php echo $row; ?>" id="<?php echo $i;?>">
                                <input type="number" class="numClass" id="f<?php echo $i;?>" min=1 max=4 style="width:50px;" name="q<?php echo $i;?>"  >
                                <input type="hidden" id="type<?php echo $i;?>" name="type1[<?php echo $i;?>]" value="<?php echo $val["type"];  ?>" >
                              </div>
                            </div>
                            <?php if($i % 4== 0){ $row+=1; echo '</div><div rid="'.$row.'" id="r'.$row.'" class="row">';} 
                          }?>
                        <div class="clearfix"></div>
                        <div class="buttons text-center" style="margin-top: 30px;">
                         <input type="submit" id="test2" class="color_btn btn_color btn btn-primary" value="Continue" />
                        </div>    
                    </form>
                </div>
            </div>
        </section>
    <?php
    }elseif($sacId=="F") {?>
        <section style="background: #ffffff" class="content">
            <center><h1>Section E | Interview Questionnaire</h1></center>
            <div class="intro1" style="display:none;">
                <h3 class="text-center"><u>Please answer the following questions.</u></h2>
                <br/>
                <div class="clearfix"></div>
                <br/>
                <div style="text-align: center;">
                    <button type="button" class="btn btn-primary" onclick="introOne()">Continue</button>
                </div>
            </div>
            <div class="intro2" style="display:block;">
                <h2>Section E | Interview Questionnaire</h2>
        
                <h4>Instructions</h4>
                
                <ul>
                    <li>This section consists out of 6 interview questions that you must answer. Please answer the question to the best of your ability, as your answers will be discussed with you by the hiring manager.</li> 
                    <li>Your answers are limited to 100 words only.</li>
                    <li>This test does not have a time limit.</li>
                    <li>When you are ready, please click on “Start”</li>
                </ul>
               
                <div class="clearfix"></div>
                <br/>
                <div style="text-align: center;">
                    <button type="button" class="btn btn-primary" onclick="introTwo()">Start</button>
                </div>

            </div>
            
            <div id="slider" style="display:none">
                <form method="post" id="questions_form" action="<?= base_url(); ?>test/processTest20">
                    <input type="hidden" name="type" value="final"/>
                    <input type="hidden" name="cat_id" value="<?= $catId;?>"/>
                
                    
                    <ul class="questions_list open_list" id="1">
                        <?php $i=1; foreach ($interviewQuestion as $key => $secFourArr) { ?>
                                <li style="text-align: left;height: 600px !important;" id="slide<?= ++$key; ?>">
                                    <h3 class="text-center"><b><?= $secFourArr['qus']; ?></b></h3>
                                    <br/>
                                    <div class="row text-center">
                                        <textarea placeholder="Write Here..." class="wordCount"  id="f<?php echo $i;?>" name="q<?php echo $i;?>" rows="8" cols="90" style="margin-left: 30px" value="" ></textarea>
                                        <p>You left <span class="text_charcnt">100</span> out of 100 words.</p>
                                        

                                        <input type="hidden" id="type<?php echo $i;?>" name="open[<?php echo $i;?>]" value="<?php echo $secFourArr["id"];  ?>" >
                                        
                                        <br/>
                                    </div>
                                </li>
                        <?php $i++; } ?>
                    </ul>
                    <a class="control_next1 btn btn-primary"  style="opacity: 1;">Next</a>
                    <a class="control_prev1 btn btn-primary" style="opacity: 1;">Previous</a>
                </form>
            </div>
        </section>
    <?php  }?> 
</div>

<script type="text/javascript">


    var wordLen = 101,len; // Maximum word length
    $('.wordCount').keydown(function(event) {


        len = $(this).val().split(/[\s]+/);
        if (len.length >= wordLen) { 
            if ( event.keyCode == 46 || event.keyCode == 8 ) {// Allow backspace and delete buttons
            } else if (event.keyCode < 48 || event.keyCode > 57 ) {//all other buttons
                event.preventDefault();
            }
        }
        console.log(len.length + " words are typed out of an available " + wordLen);
        wordsLeft = (wordLen) - len.length;
        console.log(wordsLeft);
        $(this).siblings('p').children('.text_charcnt').html(wordsLeft);
        // if(wordsLeft == 0 || wordsLeft == -1) {
        //     alert('here');
        //     $(this).siblings('p').css({
        //         'background':'red'
        //     }).prepend('<i class="fa fa-exclamation-triangle"></i>');
        // }
    });

    // function wordCounter(obj,showCount){
    //     max = 5;
    //     var v = count_word( $(obj).val());
    //     $('.'+showCount).text(v.words);
    // }

    // function count_word( val ){
    //     var wom = val.match(/\S+/g);
    //     return {
    //         words : wom ? wom.length : 0
    //     };
    // }

    $(document).ready(function ($) {
        $("body").addClass("sidebar-collapse");
        var slideCount = $('#slider ul li').length;
        var slideWidth = $('#slider ul li').width();
        var slideHeight = $('#slider ul li').height() - 110;
        var sliderUlWidth = slideCount * slideWidth;
        $('#slider').css({width: slideWidth, height: slideHeight});
        $('#slider ul').css({width: sliderUlWidth, marginLeft: -slideWidth});
        $('#slider ul li:last-child').prependTo('#slider ul');

        function moveLeft() {
            $('#slider ul').animate({
                left: +slideWidth
            }, 500, function () {
                $('#slider ul li:last-child').prependTo('#slider ul');
                $('#slider ul').css('left', '');
            });
        }
        ;
        function moveRight() {
            $('#slider ul').animate({
                left: -slideWidth
            }, 500, function () {
                $('#slider ul li:first-child').appendTo('#slider ul');
                $('#slider ul').css('left', '');
            });
        }
        ;

        $('a.control_prev').click(function () {
            var slidesUL = $(".questions_list");
            var NumberOfSlides = $(slidesUL).find("li").size();
            var currentSlide = $(slidesUL).attr("id");
            if (currentSlide > 1) {
                currentSlide = Number(currentSlide) - 1;
                $(slidesUL).attr('id', currentSlide);
            } else {
                return false;
            }
            moveLeft();
        });


$('a.control_prev1').click(function () {
            var slidesUL = $(".open_list");
            var NumberOfSlides = $(slidesUL).find("li").size();
            var currentSlide = $(slidesUL).attr("id");
            if (currentSlide > 1) {
                currentSlide = Number(currentSlide) - 1;
                $(slidesUL).attr('id', currentSlide);
            } else {
                return false;
            }
            moveLeft();
        });

        $('a.control_next1').click(function () {

            $('.control_next1').removeAttr('disabled');
            var slidesUL = $(".open_list");
            var NumberOfSlides = $(slidesUL).find("li").size();
            var currentSlide = $(slidesUL).attr("id");

            if($("#f"+currentSlide).length > 0){            
                var curText = $("#f"+currentSlide).val();
                if(curText.trim() == ''){
                    alert('Please answer all the questions');
                    return false;
                }
            }

           if (NumberOfSlides > currentSlide) {
                currentSlide = Number(currentSlide) + 1;
                $(slidesUL).attr('id', currentSlide);
            } else {
                $("#questions_form").submit();
                return true;
            }

            moveRight();
        });

        $('a.control_next').click(function () {
            $('.control_next').removeAttr('disabled');
            var slidesUL = $(".questions_list");
            var NumberOfSlides = $(slidesUL).find("li").size();
            var currentSlide = $(slidesUL).attr("id");
            
            <?php if($sacId=="C") { ?>
            var validateInput = $('input[name="q' + currentSlide + '"]').val().length;
            <?php } else { ?>
            var validateInput = $('input[name="q' + currentSlide + '"]:checked').length;
            <?php } ?>

            if (validateInput == 0) {
              //  $('.control_next').attr('disabled','disabled');
                return false;
            }
            if (NumberOfSlides > currentSlide) {
                currentSlide = Number(currentSlide) + 1;
                $(slidesUL).attr('id', currentSlide);
            } else {
                $("#questions_form").submit();
                return true;
            }
            moveRight();
        });

    });

    function introOne() {
        $('.intro1').hide();
        $('.intro2').show();
    }
 function introTwo1() {
        $('.intro2').hide();
        $('.sec').show();
         <?php if($sacId=="A"){ ?>
             // sectionStartTimer11();
        <?php } elseif ($sacId=="B") { ?>
             sectionStartTimer2();
        <?php } elseif ($sacId=="C") { ?>
            // sectionStartTimer3();
        <?php } elseif ($sacId=="D") { ?>
            // sectionStartTimer4();
        <?php } ?>
    }
    function introTwo() {
        $('.intro2').hide();
        $('#slider').show();

        <?php if($sacId=="A"){ ?>
             // sectionStartTimer11();
        <?php } elseif ($sacId=="B") { ?>
             // sectionStartTimer2();
        <?php } elseif ($sacId=="C") { ?>
            // sectionStartTimer3();
        <?php } elseif ($sacId=="D") { ?>
            // sectionStartTimer4();
        <?php } ?>

    }

    function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.text(minutes + ":" + seconds);

        if (--timer < 0) {
            timer = duration;
        }
        if(timer == 0){
            var input = $("<input>").attr("type", "hidden").attr("name", "timeout").val("timeout");
            $('#questions_form').append($(input));
            alert("timeout Please try again");
            $("#questions_form").submit();
        }
    }, 1000);
}
 
 function sectionStartTimer1(){
        var minutes = 60*17.5, display = $('#timer');
        startTimer(minutes, display);
    }
    function sectionStartTimer2(){
        var minutes = 60 * 10, display = $('#timer');
        startTimer(minutes, display);
    }
    // function sectionStartTimer3(){
    //     var minutes = 60 * 7, display = $('#timer');
    //     startTimer(minutes, display);
    // }
    // function sectionStartTimer4(){
    //     var minutes = 60 * 10, display = $('#timer');
    //     startTimer(minutes, display);
    // }



function startTimer1(duration, display) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.text(minutes + ":" + seconds);

        if (--timer < 0) {
            timer = duration;
        }
        if(timer == 0){
            var input = $("<input>").attr("type", "hidden").attr("name", "timeout").val("timeout");
            $('#questions_form').append($(input));
            alert("timeout Please try again");
            //$("#questions_form").submit();
            moveRight();
        }
    }, 1000);
}

 function sectionStartTimer11(){
        var minutes = 60*17.5, display = $('#timer');
        startTimer(minutes, display);
    }

</script>

<script>
        function introOne1() {
        $('.intro1').hide();
        $('#slider1').show();
        $("body").addClass("sidebar-collapse");
    }
</script>
<script>
    $(document).ready(function() {
    $("body").addClass("sidebar-collapse");

    $("#test3").click(function(){
        
        $('.t3_row').each(function() {
            
            var q_id = $(this).attr("id");
            var bgOn = $(this).css('background-color');
            if(q_id!="heading")
            {
                if($('input[name="q'+q_id+'"]:checked').length)
                {
                    
                }
                else
                {
                    $('html,body').animate({scrollTop: $(this).offset().top-150},'slow',function(){
                        $('.t3_row#'+q_id).animate({backgroundColor: "#930"}, 100);
                        $('.t3_row#'+q_id).animate({backgroundColor: bgOn}, 500);
                    });
                    
                    
                    return false;
                }
            }
        });
        
        
        $("#questions_form").submit();   
    });
});
</script>
<script type="text/javascript">
    $('.ckb').on('change', function() {
   if($('.ckb:checked').length > 5) {
    alert("Please Select only Five");
       this.checked = false;
   }
});
// function chkcontrol(j) {
// var total=0;
// var check=$('.ckb');
// for(var i=0; i < check.length; i++){
// if(check[i].checked){
// total =total +1;
// }
// if(total > 5){
// alert("Please Select only Five");
// check[j].checked = false ;
// return false;
// }

// }
// } </script>
