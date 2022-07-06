<style type="text/css">
    @import url(http://fonts.googleapis.com/css?family=Open+Sans:400,300,600);  

    #slider {
        position: relative;
        overflow: hidden;
        margin: 20px auto 0 auto;
        border-radius: 4px;
    }

    #slider ul {
        position: relative;
        margin: 0;
        padding: 0;
        height: 640px;
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
        top: 90%;
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

    a.control_prevB, a.control_nextB {
        position: absolute;
        top: 80%;
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

    a.control_prevB:hover, a.control_nextB:hover {
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

    button.control_prevB {
        border-radius: 4px;
    }

    a.control_nextB {
        right: 15px;
        border-radius: 4px;
    }

    a.control_nextB {
        right: 15px;
        border-radius: 4px;
    }

    .intro1{
        height: 440px;
    }
    .intro2{
        height: 470px;
    }
</style>
<?php include_once 'include/learning_2_info.php';
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Learning Potential</h1>
    </section>
    <section style="background: #ffffff" class="content" >
        <center><h1>Learning Agility Profile</h1></center>
        
    <?php 

    if($sacId=="A"){ ?>
        <div id="confirmTest" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-body">
                    <p>Are you sure you want to begin the test? Remember, you can’t go back to the instructions when you begin with the test. Your time limit for this test is 4 minutes</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" onclick="beginTest()">Begin</button>
                        <button type="button" class="btn btn-primary" onclick="backToInstrction()">Back to Instruction</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="intro1" style="display:block;height: auto;">
            <h2><u>Introduction</u></h2>
            <br/>
            <p style="text-align:justify;">Welcome to the Learning Agility Profile assessment, or LAP in short. The LAP assesses your potential to learn new information using four learning type tests.<br><br></p>
            <p>The four tests comprises of the following:</p>
            <ul>
                <li>Reasoning</li>
                <li>Memory</li>
                <li>Spatial</li>
                <li>Numerical</li>
            </ul>
            <p>All four tests will be explained to you in each section where you will also be able to practice some examples before starting with the test.</p>
            <br>
            <p>Please take note of the following:</p>
            <ol>
                <li>The assessment will take approximately 20 minutes to complete, so please ensure you have enough time to complete the assessment.</li>
                <li>Please turn off your cellphone and/or any other device that might break your concentration or interrupt you in any way.</li>
                <li>You do not need a calculator or a pen and paper, everything will be done online.</li>
                <li>Please read the instructions carefully and practice the example questions before proceeding with the test.</li>
                <li>Once you’ve started with the actual test, you won’t be able to go back to the instructions. </li>
            </ol>
            <div class="clearfix"></div>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="introOne()">Next</button>
            </div>

        </div>
        <div class="introA test_instruction" style="display:none;">
            <h2><u>Instructions | Reasoning</u></h2>
            <br/>
            <p style="text-align:justify;">
                The reasoning test measures your ability to solve a range of basic reasoning challenges within a short time frame. <br><br>
                This test has 24 questions which you must answer within 4 minutes.<br><br>
                Click on “Do Example” to practice a couple of questions before you start with the test. If you understand the instructions and want to begin with the test immediately, click on “Begin Test”.
            </p>
            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="doExample1()">Do Example</button>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmTest">Begin Test</button>
            </div>
        </div>

        <div class="exm1" style="display:none;">
            <h2><u>Example 1:</u></h2>
            <br/>
            <h3><u>If John is taller than Sue, and Sue is taller than Peter, then</u></h3>
            <br/>
            <p style="text-align:justify;">
                <label style="font-weight: normal;"><input type="radio" name="exm1" id="" onclick="checkAnswer('a','a')"> a. John is taller than Peter</label><br>
                <label style="font-weight: normal;"><input type="radio" name="exm1" id="" onclick="checkAnswer('b','a')"> b. Sue is shorter than Peter</label><br>
                <label style="font-weight: normal;"><input type="radio" name="exm1" id="" onclick="checkAnswer('c','a')"> c. Peter is taller than John</label>
            </p>
            <br><br>
            <div class="alert alert-success solution1" style="display: none;">
                <b>Solution</b><br>
                <p>Peter is taller than Sue and Sue is taller than Peter, that means that John must be taller than Peter as well.</p>
                    
                John = tallest<br>
                Sue = 2nd tallest<br>
                Peter = shortest

            </div>

            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="backToInstrction()">Back to instructions</button>
                <button type="button" class="btn btn-success" onclick="solution1()">Explain the solution</button>
                <button type="button" class="btn btn-primary" onclick="doExample2()">Try 2<sup>nd</sup> example</button>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmTest">Begin Test</button>
            </div>
        </div>

        <div class="exm2" style="display:none;">
            <h2><u>Example 2:</u></h2>
            <br/>
            <h3><u>If Sue is older than Bob, but younger than Ben, then</u></h3>
            <br/>
            <p style="text-align:justify;">
                <label style="font-weight: normal;"><input type="radio" name="exm2" onclick="checkAnswer('a','c')" id="">a. Bob is the oldest</label><br>
                <label style="font-weight: normal;"><input type="radio" name="exm2" onclick="checkAnswer('b','c')" id="">b. Sue is the youngest</label><br>
                <label style="font-weight: normal;"><input type="radio" name="exm2" onclick="checkAnswer('c','c')" id="">c. Ben is the oldest</label>
            </p>
            <br><br>
            <div class="alert alert-success solution2" style="display: none;">
                <b>Solution</b><br>
                <p>Ben will be the oldest because Sue is younger than him and Sue is also older than Bob.</p>
                    
                Ben = oldest<br>
                Sue = 2<sup>nd</sup> oldest<br>
                Bob = Youngest

            </div>
            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="backToInstrction()">Back to instructions</button>
                <button type="button" class="btn btn-success" onclick="solution2()">Explain the solution</button>
                <button type="button" class="btn btn-primary" onclick="doExample1()">Try 1<sup>st</sup> example</button>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmTest">Begin Test</button>
            </div>
        </div>

        <div id="slider" style="display:none;">
            <div style="font-size:18px; text-align: center;">Time Remaining: <div id="timer"></div></div>
            <form method="post" id="questions_form" action="<?= base_url(); ?>test/processTest3">
                <input type="hidden" name="type" value="secA" />
                <input type="hidden" name="cat_id" value="<?= $catId;?>"/>

                <ul class="questions_list" id="1">
                    <?php foreach ($sectionOneArr as $key => $secOneArr) { ?>
                        <li style="text-align: left; margin-top: 150px;" id="slide<?= ++$key; ?>">
                            <h4 class="text-center"><?= $secOneArr['qus']; ?></h4>
                            <br/>
                            <div class="row text-center">
                            <?php foreach ($secOneArr['option'] as $ans => $option) { ?>
                                <div class="col-md-4">
                                <label>
                                <input name="q<?= $key; ?>" type="radio" value="<?= $ans; ?>"/>
                                <span style="font-size:18px;"><?= $option; ?></span>
                                </label>
                                </div>
                            <?php } ?>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
                <a class="control_next btn btn-primary" onclick="changeMapNextImage()" style="opacity: 1;top : 80% !important;">Next</a>
                <a class="control_prev btn btn-primary" onclick="changeMapPreviousImage()" style="opacity: 1;top : 80% !important;">Previous</a>
            </form>
        </div>  
        <?php } 
    if($sacId=="B"){ ?>
        <div id="confirmTest" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-body">
                    <p>Are you sure you want to begin the test? Remember, you can’t go back to the instructions when you begin with the test. Your time limit for this test is 4 minutes</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" onclick="startSectionB()">Begin</button>
                        <button type="button" class="btn btn-primary" onclick="backToInstrction()">Back to Instruction</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="intro1 " style="display:block;">
            
            <center><h3 class="text-center"><u>You have successfully completed section A. Please click on Continue to complete section B.</u></h2></center>
            <div class="clearfix"></div>
            <br/><br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="introOne()">Continue</button>
            </div>

        </div>
        <div class="introA test_instruction" style="display:none;">
            <h2><u>Instructions | Memory</u></h2>
            <br/>
            <p style="text-align:justify;">
                The Memory test assesses your ability to accurately recall information.<br>
                This section has 24 questions and a total time limit of 4 minutes. <br>
                An image will appear on the screen which you must memorise within 5 seconds. After 5 seconds, the image will disappear and you will be presented with 4 possible answers. You have 10 seconds to choose the correct answer. After 10 seconds, the system will automatically proceed to the next question.<br><br>

                Click on “Do Example” to practice a couple of questions before you start with the test. If you understand the instructions and want to begin with the test immediately, click on “Begin Test”.
            </p>
            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="doExample1()">Do Example</button>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmTest">Begin Test</button>
            </div>
        </div>

        <div class="exm1" style="display:none;">
            <h2><u>Example 1:</u></h2>
            <br/>
            <div class="row showbefore">
                <div class="col-md-12 text-center">
                    <h3>Memorize this image and remember which of the 8 blocks in the image is blacked out.</h3>
                    <img src="<?= base_url(); ?>images/LAPEXP/lap-B1-ans.png" height="100" alt="">
                </div>
            </div>
            <br>
            <br>
            <div class="showtimercntr" style="text-align:center"></div>
            <div class="row showafter">
                <h3>Now select the box remembered in the previous image.</h3>
                <br/>
                <div class="col-md-3">
                    <label style="font-weight: normal;"><input type="radio" name="exm1" id="" onclick="checkAnswer('a','c')">
                       <img src="<?= base_url(); ?>images/LAPEXP/lap-B1-1.png" height="100" alt="">
                   </label>
                </div>
                <div class="col-md-3">
                    <label style="font-weight: normal;"><input type="radio" name="exm1" id="" onclick="checkAnswer('b','c')">
                        <img src="<?= base_url(); ?>images/LAPEXP/lap-B1-2.png" height="100" alt="">
                    </label>
                </div>
                <div class="col-md-3">
                    <label style="font-weight: normal;"><input type="radio" name="exm1" id="" onclick="checkAnswer('c','c')">
                        <img src="<?= base_url(); ?>images/LAPEXP/lap-B1-3.png" height="100" alt="">
                    </label>
                </div>
                <div class="col-md-3">
                    <label style="font-weight: normal;"><input type="radio" name="exm1" id="" onclick="checkAnswer('d','c')">
                        <img src="<?= base_url(); ?>images/LAPEXP/lap-B1-4.png" height="100" alt=""> 
                    </label>
                </div>
            </div>
            <br><br>
            <div class="alert alert-success solution1" style="display: none;">
                <b>Solution</b><br>
                <p>The image you had to memorise looked like this:</p>
                <center><img src="<?= base_url(); ?>images/LAPEXP/lap-B1-3.png" height="100" alt=""></center>
            </div>

            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="backToInstrction()">Back to instructions</button>
                <button type="button" class="btn btn-success" onclick="solution1()">Explain the solution</button>
                <button type="button" class="btn btn-primary" onclick="doExample2()">Try 2<sup>nd</sup> example</button>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmTest">Begin Test</button>
            </div>
        </div>

        <div class="exm2" style="display:none;">
            <h2><u>Example 2:</u></h2>
            <br/>
            <div class="row showbefore">
                <div class="col-md-12 text-center">
                    <h3>Memorize this image and remember which of the 8 blocks in the image is blacked out.</h3>
                    <img src="<?= base_url(); ?>images/LAPEXP/lap-B2-1.png" height="100" alt="">
                </div>
            </div>
            <br>
            <div class="showtimercntr" style="text-align:center"></div>
            <div class="row showafter">
                <h3>Now select the box remembered in the previous image.</h3>
                <br>
                <br/>
                <div class="col-md-3">
                    <label style="font-weight: normal;"><input type="radio" name="exm2" id="" onclick="checkAnswer('a','a')">
                       <img src="<?= base_url(); ?>images/LAPEXP/lap-B2-1.png" height="100" alt="">
                   </label>
                </div>
                <div class="col-md-3">
                    <label style="font-weight: normal;"><input type="radio" name="exm2" id="" onclick="checkAnswer('b','a')">
                        <img src="<?= base_url(); ?>images/LAPEXP/lap-B2-2.png" height="100" alt="">
                    </label>
                </div>
                <div class="col-md-3">
                    <label style="font-weight: normal;"><input type="radio" name="exm2" id="" onclick="checkAnswer('c','a')">
                        <img src="<?= base_url(); ?>images/LAPEXP/lap-B2-3.png" height="100" alt="">
                    </label>
                </div>
                <div class="col-md-3">
                    <label style="font-weight: normal;"><input type="radio" name="exm2" id="" onclick="checkAnswer('d','a')">
                        <img src="<?= base_url(); ?>images/LAPEXP/lap-B2-4.png" height="100" alt=""> 
                    </label>
                </div>
            </div>
            <br><br>
            <div class="alert alert-success solution2" style="display: none;">
                <b>Solution</b><br>
                <p>The image you had to memorise looked like this:</p>
                <center><img src="<?= base_url(); ?>images/LAPEXP/lap-B2-1.png" height="100" alt=""></center>
            </div>

            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="backToInstrction()">Back to instructions</button>
                <button type="button" class="btn btn-success" onclick="solution2()">Explain the solution</button>
                <button type="button" class="btn btn-primary" onclick="doExample1()">Try 1<sup>st</sup> example</button>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmTest">Begin Test</button>
            </div>
        </div>

        <div id="slid" style="display:none;">
            <div style="font-size:18px; text-align: center;">Time Remaining: <div id="timer"></div></div>
            <form method="post" id="questions_form" action="<?= base_url(); ?>test/processTest3">
                <input type="hidden" name="cat_id" value="<?= $catId; ?>"/>
                <input type="hidden" name="type" value="secB" />

                <ul class="questions_list" id="1">
                    <center>
                    <?php
                    //echo '<pre>';print_r($sectionTwoArr);die;
                    $i = 1;
                    foreach ($sectionTwoArr as $key => $secTwoArr) {
                        ?>

                        <li id="que_<?= $i ?>" style=" list-style: none; display: none;">
                            <img src="<?= base_url().$secTwoArr['img'] ?>">
                        </li>
                        
                        <li id="slide<?php echo ++$key; ?>" class="mit" style="list-style: none; display: none;">
                            <div class="main_question ans_<?php echo $key; ?>">
                                <h3 style="margin-bottom:30px;padding-top:10px;">Select the correct image.</h3>
                            </div>
                            <div class="row">
                                <?php foreach ($secTwoArr['option'] as $ans => $option) { ?>
                                <div class="col-md-3">
                                    <div class="img-list ans_<?php echo $key; ?>" >
                                        <label>
                                        <center><img src="<?= base_url(); ?>images/memory/<?php echo $option; ?>.png" height="100"/><br>
                                        <input class="qradio vertical" name="q<?php echo $i; ?>" type="checkbox" value="<?php echo $ans; ?>" /></center>
                                        </label>
                                    </div>
                                </div>
                            <?php  } ?>
                            </div>
                        </li>
                        <?php $i++; } ?>
                        </center>
                </ul>

                <a class="control_nextB btn btn-primary"  style="opacity: 1;">Next</a>
                <a class="control_prevB btn btn-primary" style="opacity: 1;">Previous</a>
        </div>
    <?php  }
    if($sacId=="C"){ ?>
        <div id="confirmTest" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-body">
                    <p>Are you sure you want to begin the test? Remember, you can’t go back to the instructions when you begin with the test. Your time limit for this test is 5 minutes</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" onclick="startSectionC()">Begin</button>
                        <button type="button" class="btn btn-primary" onclick="backToInstrction()">Back to Instruction</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="intro1" style="display:block;">
            <h2 class="text-center"><u>You have successfully completed section B. Please click on Continue to complete section C.</u></h2>
            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="introOne()">Continue</button>
            </div>

        </div>
        <div class="introA test_instruction" style="display:none;">
            <h3><u>Instructions | Spatial Orientation</u></h3>
            <br/>
            <p style="text-align:justify;">

                This section assesses your potential to quickly and accurately compare shapes in your mind and find the correct answer by turning the images clock or anti-clock wise.
                <br><br>
                You will receive 4 images with 9 squares, some of the squares will have a a letter from the alphabet. Look at the first image, then turn this image clock- or anti-clockwise in your head. When you turn the image, it will resemble two of the images next to it, one of the images will not look the same regardless of how many times you turn the image. 
                <br><br><br>
                The correct answer is the image that does not look the same as the others regardless of how many times you turn it.
                <br><br><br>
                This section has 20 questions and a total time limit of 5 minutes. 
                <br><br><br>
                Click on “Do Example” to practice a couple of questions before you start with the test. If you understand the instructions and want to begin with the test immediately, click on “Begin Test”.
                <br><br>

                <!-- This section assesses your potential to quickly and accurately compare shapes in your mind and find the correct answer by turning the images clock or anti-clock wise. 
                <br>You will receive 4 images with 9 squares each, some of the squares will have a small circle or the letter “R. Look at the first image, then turn this image clock- or anti-clockwise in your head. When you turn the image, it will resemble two of the images next to it, with one image being the a mirror image. 
                
                <br>You are required to identify the mirror image.
                
                <br>This section has 7 questions and a total time limit of 5 minutes. 
                
                <br>Click on “Do Example” to practice a couple of questions before you start with the test. If you understand the instructions and want to begin with the test immediately, click on “Begin Test”. -->

            </p>
            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="doExample1()">Do Example</button>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmTest">Begin Test</button>
            </div>
        </div>

        <div class="exm1" style="display:none;">
            <h2>Please practice the following examples</h2>
            <br/>
            <h3>Example 1:</h3>
            <br/>
            <div class="row text-center">
                <div class="col-md-3" style="border-right: 5px solid red;">
                    <img src="<?= base_url() ?>images/LAPEXP/lap-C1-1.png" height="100" alt="">
                </div>
                <div class="col-md-3">
                    <label style="font-weight: normal;"><input type="radio" name="exm1" id="" onclick="checkAnswer('b','d')">
                        <img src="<?= base_url() ?>images/LAPEXP/lap-C1-2.png" height="100" alt=""><br>
                    </label>
                </div>
                <div class="col-md-3">
                    <label style="font-weight: normal;"><input type="radio" name="exm1" id="" onclick="checkAnswer('c','d')">
                        <img src="<?= base_url() ?>images/LAPEXP/lap-C1-3.png" height="100" alt="">
                    </label>
                </div>
                <div class="col-md-3">
                    <label style="font-weight: normal;"><input type="radio" name="exm1" id="" onclick="checkAnswer('d','d')">
                        <img src="<?= base_url() ?>images/LAPEXP/lap-C1-4.png" height="100" alt=""><br>
                    </label>
                </div>
            </div>
            <br><br>
             <div class="alert alert-success solution1" style="display: none;">
                <b>Solution</b><br>
                <p>If you turn image A once clockwise, it will be exactly the same as image B. If you turn it clockwise again, it will look exactly like image C. However, doesn’t matter how many times you turn image A, B or C, it will never look like image D. So the correct answer is D</p>
                <center><img src="<?= base_url() ?>images/LAPEXP/lap-C1-4.png" height="100" alt=""></center>
            </div>

            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="backToInstrction()">Back to instructions</button>
                <button type="button" class="btn btn-success" onclick="solution1()">Explain the solution</button>
                <button type="button" class="btn btn-primary" onclick="doExample2()">Try 2<sup>nd</sup> example</button>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmTest">Begin Test</button>
            </div>
        </div>

        <div class="exm2" style="display:none;">
            <h2>Please practice the following examples</h2>
            <br/>
            <h3>Example 2:</h3>
            <br/>
            <div class="row text-center">
                <div class="col-md-3" style="border-right: 5px solid red;">
                    <img src="<?= base_url() ?>images/LAPEXP/lap-C2-1.png" height="100" alt="">
                </div>
                <div class="col-md-3">
                    <label style="font-weight: normal;"><input type="radio" name="exm1" id="" onclick="checkAnswer('b','b')">
                        <img src="<?= base_url() ?>images/LAPEXP/lap-C2-2.png" height="100" alt=""><br>
                    </label>
                </div>
                <div class="col-md-3">
                    <label style="font-weight: normal;"><input type="radio" name="exm1" id="" onclick="checkAnswer('c','a')">
                        <img src="<?= base_url() ?>images/LAPEXP/lap-C2-3.png" height="100" alt="">
                    </label>
                </div>
                <div class="col-md-3">
                    <label style="font-weight: normal;"><input type="radio" name="exm1" id="" onclick="checkAnswer('d','a')">
                        <img src="<?= base_url() ?>images/LAPEXP/lap-C2-4.png" height="100" alt=""><br>
                    </label>
                </div>
            </div>
            <br><br>
            <div class="alert alert-success solution2" style="display: none;">
                <b>Solution</b><br>
                <p>If you turn the first image clock or anti-clockwise, you will notice that image B and C is the same as the first image. However, regardless of how many times you turn the first image, it will never look like image A.
                <br>Image A is the mirror image, so the correct answer is image A</p>
                <center><img src="<?= base_url() ?>images/LAPEXP/lap-C2-1.png" height="100" alt=""></center>
            </div>

            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="backToInstrction()">Back to instructions</button>
                <button type="button" class="btn btn-success" onclick="solution2()">Explain the solution</button>
                <button type="button" class="btn btn-primary" onclick="doExample1()">Try 1<sup>st</sup> example</button>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmTest">Begin Test</button>
            </div>
        </div>

        <div id="slider" style="display:none;">
        <div style="font-size:18px; text-align: center;">Time Remaining: <div id="timer"></div></div>
            <form method="post" id="questions_form" action="<?= base_url(); ?>test/processTest3">
                <input type="hidden" name="type" value="secC" />
                <input type="hidden" name="cat_id" value="<?= $catId;?>"/>

                <ul class="questions_list" id="1">
                    <?php foreach ($sectionThreeArr as $key => $secThreeArr) { ?>
                        <li style="text-align: left" id="slide<?= ++$key; ?>">
                            <div class="row text-center">
                            <?php foreach ($secThreeArr['option'] as $ans => $option) { ?>
                                <div class="col-md-3" <?= $ans=="a" ? "style='border-right:5px solid red;'" : "" ?> >
                                    <?php if($ans=="a"){ ?>
                                    <label>
                                        <img src="<?= base_url() ?>images/spatial/<?= $option ?>.png" alt="">
                                        </label>
                                    <?php } else { ?>
                                        <label>
                                        <img src="<?= base_url() ?>images/spatial/<?= $option ?>.png" alt=""><br>
                                        <input name="q<?= $key; ?>" type="radio" value="<?= $ans; ?>"/>
                                        </label>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
                <a class="control_next btn btn-primary"  style="opacity: 1; top : 80% !important;">Next</a>
                <a class="control_prev btn btn-primary" style="opacity: 1; top : 80% !important;">Previous</a>
            </form>
        </div>  
    <?php  }
        
    if($sacId=="D"){ ?>
        <div id="confirmTest" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-body">
                    <p>Are you sure you want to begin the test? Remember, you can’t go back to the instructions when you begin with the test. Your time limit for this test is 4 minutes</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" onclick="beginTest()">Begin</button>
                        <button type="button" class="btn btn-primary" onclick="backToInstrction()">Back to Instruction</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="intro1" style="display:block;">
            <h2 class="text-center"><u>You have successfully completed section C. Please click on Continue to complete section D.</u></h2>
            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="introOne()">Continue</button>
            </div>
        </div>
        <div class="introA test_instruction" style="display:none;">
            <h2><u>Instructions | Numerical</u></h2>
            <br/>
            <p style="text-align:justify;">
            The numerical test measures your ability to solve basic basic numerical problems within a short time-frame. 
            <br>This section has 21 questions and a total time limit of 4 minutes. 
            <br>Click on “Do Example” to practice a couple of questions before you start with the test. If you understand the instructions and want to begin with the test immediately, click on “Begin Test”.
            </p>
            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="doExample1()">Do Example</button>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmTest">Begin Test</button>
            </div>
        </div>

        <div class="exm1" style="display:none;">
            <h2>Please study the following numerical problem and select the correct answer.</h2>
            <br/>
            <h3>Example 1:</h3>
            <br/>
            <h3><p>
                Difference: 3<br>
                Criteria: Lowest
            </p></h3>
            <br/>
            <p style="text-align:justify;">
                <label style="font-weight: normal;"><input type="radio" name="exm1" id="" onclick="checkAnswer('a','a')"> a. 1</label><br>
                <label style="font-weight: normal;"><input type="radio" name="exm1" id="" onclick="checkAnswer('b','a')"> b. 4</label><br>
                <label style="font-weight: normal;"><input type="radio" name="exm1" id="" onclick="checkAnswer('c','a')"> c. 6</label>
            </p>
            <div class="alert alert-success solution1" style="display: none;">
                <b>Solution</b><br>
                <p>The difference you need to look for is 3. Look at the options and determine which of the three has a difference of 3. In this example you will see that it’s the difference between the 1 and the 4 (4 – 1 = 3), thus eliminating the 6. The criteria ask for the lowest option number between the 4 and the 1, making it the correct</p>
            </div>

            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="backToInstrction()">Back to instructions</button>
                <button type="button" class="btn btn-success" onclick="solution1()">Explain the solution</button>
                <button type="button" class="btn btn-primary" onclick="doExample2()">Try 2<sup>nd</sup> example</button>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmTest">Begin Test</button>
            </div>
        </div>

        <div class="exm2" style="display:none;">
            <h2>Please study the following numerical problem and select the correct answer.</h2>
            <br/>
            <h3>Example 1:</h3>
            <br/>
            <h3><p>
                Difference: 6<br>
                Criteria: Highest
            </p></h3>
            <br/>
            <p style="text-align:justify;">
                <label style="font-weight: normal;"><input type="radio" name="exm1" id="" onclick="checkAnswer('a','b')"> a. 15</label><br>
                <label style="font-weight: normal;"><input type="radio" name="exm1" id="" onclick="checkAnswer('b','b')"> b. 21</label><br>
                <label style="font-weight: normal;"><input type="radio" name="exm1" id="" onclick="checkAnswer('c','b')"> c. 28</label>
            </p>
            <div class="alert alert-success solution2" style="display: none;">
                <b>Solution</b><br>
                <p>The difference you need to find is 6. The difference between 21 and 28 is 7, the difference between 15 and 28 is 13, and the difference between 15 and 21 is 6. Now that you have determined the numbers to use (15 and 21), the criteria is to select the highest between the 15 and 21, which is 21. </p>
            </div>

            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="backToInstrction()">Back to instructions</button>
                <button type="button" class="btn btn-success" onclick="solution2()">Explain the solution</button>
                <button type="button" class="btn btn-primary" onclick="doExample1()">Try 1<sup>st</sup> example</button>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmTest">Begin Test</button>
            </div>
        </div>

        <div id="slider" style="display:none;">
            <div style="font-size:18px; text-align: center;">Time Remaining: <div id="timer"></div></div>
            <form method="post" id="questions_form" action="<?= base_url(); ?>test/processTest3">
                <input type="hidden" name="type" value="final" />
                <input type="hidden" name="cat_id" value="<?= $catId;?>"/>

                <ul class="questions_list" id="1">
                    <?php foreach ($sectionFourArr as $key => $secFourArr) { ?>
                        <li style="text-align: left;" id="slide<?= ++$key; ?>">
                            <h4 class="text-center"><?= $secFourArr['qus1']; ?></h4>
                            <h4 class="text-center"><?= $secFourArr['qus2']; ?></h4>
                            <br/>
                            <div class="text-center">
                            <?php foreach ($secFourArr['option'] as $ans => $option) { ?>
                            <label>
                                <input name="q<?= $key; ?>" type="radio" value="<?= $ans; ?>"/>
                                <span style="font-size:18px;"><?= $option; ?></span>
                            </label>
                                <br>
                            <?php } ?>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
                <a class="control_next btn btn-primary"  style="opacity: 1; top : 50% !important;">Next</a>
                <a class="control_prev btn btn-primary" style="opacity: 1;top : 50% !important;">Previous</a>
            </form>
        </div>  
    <?php } ?>

    </section>
</div>

<script type="text/javascript">
    $(document).ready(function ($) {
        $("body").addClass("sidebar-collapse");
       // $('.control_nextB').attr('disabled');
        <?php if($sacId != "B"){ ?>
            var slideCount = $('#slider ul li').length;
            var slideWidth = $('#slider ul li').width();
            var slideHeight = $('#slider ul li').height() - 110;
            var sliderUlWidth = slideCount * slideWidth;
            $('#slider').css({width: slideWidth, height: slideHeight});
            $('#slider ul').css({width: sliderUlWidth, marginLeft: -slideWidth});
            $('#slider ul li:last-child').prependTo('#slider ul');
        <?php } ?>

        <?php if($sacId != "B"){ ?>
            $(".content").css("min-height","350px");
        <?php } ?>

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

        $('a.control_next').click(function (){

            $('.control_next').removeAttr('disabled');
            var slidesUL = $(".questions_list");
            var NumberOfSlides = $(slidesUL).find("li").size();
            var currentSlide = $(slidesUL).attr("id");
            var validateInput = $('input[name="q' + currentSlide + '"]:checked').length;
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

        $('a.control_nextB').click(function (){

            $('.control_nextB').removeAttr('disabled');
            var slidesUL = $(".questions_list");
            var NumberOfSlides = $(slidesUL).find("li.mit").size();
            var currentSlide = $(slidesUL).attr("id");
            var currmit=currentSlide;

            if($('#'+Number(currentSlide) + ' input[name=q'+Number(currentSlide)+']:checked').length < 1)
            {
                return false;
            }

            if (NumberOfSlides > currentSlide) {
                currentSlide = Number(currentSlide) + 1;
                $(slidesUL).attr('id', currentSlide);
            } else {
                $("#questions_form").submit();
                return true;
            }

            $("#slide"+currmit).fadeOut("fast");
            $('.control_nextB').hide();
            $("#que_"+currentSlide).show("slow");
            $("#que_"+currentSlide).delay(3000).fadeOut("fast");
            $("#slide"+currentSlide).delay(4000).fadeIn("slow");
            $('.control_nextB').show();
            
        });

    });

    function introOne() {
        $('.intro1').hide();
        $('.introA').css('display','block');
    }

    function introA() {
        $('.introA').hide();
        $('.exm1').show();
    }
    function exm1() {
        $('.exm1').hide();
        $('.exm2').show();
    }
    function exm2()
    {
        $('.exm2').hide();
        $('#slider').show();
        sectionStartTimer();
    }

</script>

<script type="text/javascript">
    function changeMapNextImage() {
        var questionId = $(".questions_list").attr("id");
        questionId = Number(questionId) + 1;
        
        // if (questionId > 5 && questionId <= 10) {
        //     $("#map2").show();
        //     $("#map1").hide();
        //     $("#map3").hide();
        // } else if (questionId >= 11 && questionId <= 15) {
        //     $("#map3").show();
        //     $("#map1").hide();
        //     $("#map2").hide();
        // } else if (questionId <= 5) {
        //     $("#map1").show();
        //     $("#map2").hide();
        //     $("#map3").hide();
        // }

        var previous = Number(questionId) - 1;

        $(".que_" + previous).hide();
        $(".ans_" + previous).hide();
        $(".que_" + questionId).show();
        $(".que_" + questionId).delay(3000).fadeOut("slow");
        $(".ans_" + questionId).delay(3000).fadeIn(500);
    }

    function changeMapPreviousImage() {
        var questionId = $(".questions_list").attr("id") - 1;
        if (questionId > 5 && questionId <= 10) {
            $("#map2").show();
            $("#map1").hide();
            $("#map3").hide();
        } else if (questionId >= 11 && questionId <= 15) {
            $("#map3").show();
            $("#map1").hide();
            $("#map2").hide();
        } else if (questionId <= 5) {
            $("#map1").show();
            $("#map2").hide();
            $("#map3").hide();
        }

        if (questionId != 0) {
            var next = Number(questionId) + 1;
            $(".que_" + next).hide();
            $(".ans_" + next).hide();
            $(".que_" + questionId).show();
            $(".que_" + questionId).delay(3000).fadeOut("slow");
            $(".ans_" + questionId).delay(3000).fadeIn(500);
        }
    }

    function startSectionB()
    {
        $('.exm1').hide();
        $('.exm2').hide();
        $('#slid').show();

        $(".solution1,solution2").hide();
        $('.intro1').hide();
        $('.introA').hide();

        $('.control_nextB').hide();
        $("#que_1").show();
        $("#que_1").delay(3000).fadeOut("fast");
        $("#slide1").delay(4000).fadeIn("slow");
        $('.control_nextB').show();
        $("#confirmTest").modal('hide');
        sectionStartTimer();

    }

   $('.qradio input[type=checkbox]').change(function(){
       if($(this).siblings(':checked').length >=2){
           this.checked = false;
       }
   });

    $('.ans_1 input[type=checkbox]').change(function () {
        var i = 0;
        $('.ans_1 input:checkbox:checked').each(function () {
            i++;
        });
        if (i > 2) {
            this.checked = false;
        }
    });

    $('.qradio input[type=checkbox]').change(function () {
        var i = 0;
        $('.qradio input:checkbox:checked').each(function () {
            i++;
        });
        if (i > 2) {
            this.checked = false;
        }
    });

    function sectionStartTimer() {
        var minutes = 60 * 4, display = $('#timer');
        startSectionTimer(minutes, display);
        }
        function startSectionTimer(duration, display) {
            var timer = duration, minutes, seconds;
            setInterval(function () {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                //display.text(minutes + ":" + seconds);
                document.getElementById('timer').innerHTML = minutes + ":" + seconds;

                if (--timer < 0) {
                    timer = duration;
                }
                if (timer == 0) {
                    
                    var input = $("<input>").attr("type", "hidden").attr("name", "timeout").val("timeout");
                    $('#questions_form').append($(input));
                    alert("timeout Please try again");
                    $("#questions_form").submit();
                }
            }, 1000);
        }


        function backToInstrction(){
            $(".solution1").hide();
            $(".solution2").hide();
            $(".test_instruction").show();
            $(".exm1,.exm2").hide();
            $("#slider").hide();
            $("#confirmTest").modal('hide');
        }

        function doExample1(){
            $(".solution1").hide();
            $(".solution2").hide();
            $('.intro1').hide();
            $('.introA').hide();
            $('.exm1').show();
            $('.exm2').hide();
            showAfter();                
        }
        function doExample2(){
            $(".solution1").hide();
            $(".solution2").hide();
            $('.intro1').hide();
            $('.introA').hide();
            $('.exm1').hide();
            $('.exm2').show();
            showAfter();    
        }

        function solution1(){
            $(".solution1").hide();
            $(".solution2").hide();
            $(".solution1").show();
            $('.showbefore').hide();
            $('.showafter').show();            
        }

        function solution2(){
            $(".solution1").hide();
            $(".solution2").hide();
            $(".solution2").show();
            $('.showbefore').hide();
            $('.showafter').show();
        }

        function showAfter(){
            $('.showbefore').show();
            //$('.showtimercntr').html('Options visible in 4 seconds.').fadeIn();
            let cnt = 4;
            var myTmr = setInterval(function(){
                //$('.showtimercntr').html('Options visible in '+cnt+' seconds.');
                cnt--;
            },1000);

            if($('.showafter').length>0){
                $('.showafter').hide();
                setTimeout(function(){
                    $('.showafter').fadeIn();
                    $('.showbefore').fadeOut();
                    $('.showtimercntr').fadeOut();
                    clearInterval(myTmr);
                },5000);
            }
        }

        function checkAnswer(selectAns,correctAns){
            $(".solution1").hide();
            $(".solution2").hide();
            if(selectAns == correctAns){
                alert('correct');
            }else{
                alert('This is not the correct answer, please try again');
            }
        }

        function beginTest(testType){
            $(".solution1").hide();
            $(".solution2").hide();
            $('.intro1').hide();
            $('.introA').hide();
            $('.exm1').hide();
            $('.exm2').hide();
            $('#slider').show();
            $("#confirmTest").modal('hide');
            sectionStartTimer();
        }
                
                function sectionCStartTimer() {
                var minutes = 60 * 5, display = $('#timer');
                startSectionTimer(minutes, display);
                }
                
                function startSectionC(){
                $(".solution1").hide();
                $(".solution2").hide();
                $('.intro1').hide();
                $('.introA').hide();
                $('.exm1').hide();
                $('.exm2').hide();
                $('#slider').show();
                $("#confirmTest").modal('hide');
                sectionCStartTimer();
                }
                

</script>
