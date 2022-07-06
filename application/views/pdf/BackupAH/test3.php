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
        
        <div class="intro1" style="display:block;">
            <h2><u>Introduction</u></h2>
            <br/>
            <p style="font-size:20px; text-align:justify;">
                 The Learning Potential assessment consists out of 4 sections, each section has a time limit in which you must complete as many questions as possible.<br><br>


                    Please read the instructions for each section carefully and practice the example questions before continuing. As soon as you start with the test, you will not be able to go back to the instructions.<br><br>


                    Please click on Begin Test to start with the first section.
            </p>
            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="introOne()">Begin Test</button>
            </div>

        </div>
        <div class="introA" style="display:none;">
            <h2><u>SECTION A | REASONING</u></h2>
            <br/>
            <p style="font-size:20px; text-align:justify;">
                 This section measure your ability to do basic reasoning within a short time frame.<br><br>


                Please practice the following examples. Make sure you understand exactly what to do before you start with the test.<br><br>


                Click on Next to Continue
            </p>
            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="introA()">Next</button>
            </div>
        </div>

        <div class="exm1" style="display:none;">
            <h2><u>Example 1:</u></h2>
            <br/>
            <h3><u>If John is taller than Sue, and Sue is taller than Peter, then</u></h3>
            <br/>
            <p style="font-size:20px; text-align:justify;">
                 <input type="radio" name="" id="">a. John is taller than Peter<br>
                 <input type="radio" name="" id="">b. Sue is shorter than Peter<br>
                 <input type="radio" name="" id="">c. Peter is taller than John
            </p>
            <br><br>
            <b>The correct answer is a.</b><br>
            <b>Now try the next example:</b><br>

            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="exm1()">Next</button>
            </div>
        </div>

        <div class="exm2" style="display:none;">
            <h2><u>Example 2:</u></h2>
            <br/>
            <h3><u>If Sue is older than Bob, but younger than Ben, then</u></h3>
            <br/>
            <p style="font-size:20px; text-align:justify;">
                 <input type="radio" name="" id="">a. Bob is the oldest<br>
                 <input type="radio" name="" id="">b. Sue is the youngest<br>
                 <input type="radio" name="" id="">c. Ben is the oldest
            </p>
            <br><br>
            <b>The correct answer is c.</b><br>
            <b>If you understand the instructions, you may continue with the assessment. There are a total of 24 questions which must be completed in 4 minutes. Read each sentence carefully and choose the correct option. </b><br>

            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="exm2()">Begin Test</button>
            </div>
        </div>

        <div id="slider" style="display:none;">
        <div style="font-size:18px; text-align: center;">Time Remaining: <div id="timer"></div></div>
            <form method="post" id="questions_form" action="<?= base_url(); ?>test/processTest3">
                <input type="hidden" name="type" value="secA" />
                <input type="hidden" name="cat_id" value="<?= $catId;?>"/>

                <ul class="questions_list" id="1">
                    <?php foreach ($sectionOneArr as $key => $secOneArr) { ?>
                        <li style="text-align: left; margin-top: 100px;" id="slide<?= ++$key; ?>">
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
                <a class="control_next btn btn-primary" onclick="changeMapNextImage()" style="opacity: 1;">Next</a>
                <a class="control_prev btn btn-primary" onclick="changeMapPreviousImage()" style="opacity: 1;">Previous</a>
            </form>
        </div>  
        <?php } 
        if($sacId=="B"){ ?>

        <div class="intro1" style="display:block;">
            
            <center><h3 class="text-center"><u>You have successfully completed section A. Please click on Continue to complete section B.</u></h2></center>
            <div class="clearfix"></div>
            <br/><br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="introOne()">Continue</button>
            </div>

        </div>
        <div class="introA" style="display:none;">
            <h2><u>Section B | Memory</u></h2>
            <br/>
            <p style="font-size:20px; text-align:justify;">
                 This section assesses your ability to recall information. You will receive an image with blocks which you need to memorise in a specific time limit. After the time elapsed, you will be required to select the image you had to memorise.<br><br>


                Please practice the following examples. Make sure you understand exactly what to do before you start with the test.<br><br>


                Click on Next to Continue
            </p>
            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="introA()">Next</button>
            </div>
        </div>

        <div class="exm1" style="display:none;">
            <h2><u>Instructions</u></h2>
            <br/>
            <h3>Below you will see a 8 blocks with one or more blacked out. You have 4 seconds to memorise this image. After 4 seconds you will be required to select the image you had to memorise. </h3>
            <br/>
            <br><br>
            <div class="text-center">
                <img src="<?= base_url() ?>images/memory/eg1-3.png" alt="" height="100">
            </div>
            <br><br>
            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="exm1()">Next</button>
            </div>
        </div>

        <div class="exm2" style="display:none;">
            <h2><u>Example 2:</u></h2>
            <br/>
            <div class="row">
                <div class="col-md-12 text-center">
                    <img src="<?= base_url(); ?>images/memory/eg1-2.png" height="100" alt="">
                </div>
            </div>
            <br>
            <h3><b>Memorize this image and remember which of the 8 blocks in the image is blacked out.</b></h3>
            <br>
            <h3><b>Now select the box remembered in the previous image.</b></h3>
            <br/>
            <div class="row">
                <div class="col-md-3">
                   <img src="<?= base_url(); ?>images/memory/eg1-1.png" height="100" alt=""> 
                </div>
                <div class="col-md-3">
                    <img src="<?= base_url(); ?>images/memory/eg1-2.png" height="100" alt="">
                </div>
                <div class="col-md-3">
                    <img src="<?= base_url(); ?>images/memory/eg1-3.png" height="100" alt="">
                </div>
                <div class="col-md-3">
                   <img src="<?= base_url(); ?>images/memory/eg1-4.png" height="100" alt=""> 
                </div>
            </div>
            <br><br>
            <b>The correct answer is b.</b><br>
            <b>If you understand the instructions, you may continue with the assessment. There are a total of 24 questions which must be completed in 4 minutes.</b><br>

            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="startSectionB()">Begin Test</button>
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
            <div class="intro1" style="display:block;">
            <h3 class="text-center"><u>You have successfully completed section B. Please click on Continue to complete section C.</u></h2>
            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="introOne()">Continue</button>
            </div>

        </div>
        <div class="introA" style="display:none;">
            <h2><u>Section C – Spatial Orientation</u></h2>
            <br/>
            <p style="font-size:20px; text-align:justify;">
                 This section assesses your potential to quickly and accurately use mental visualisation and compare shapes in your mind.<br><br>


                Please practice the following examples. Make sure you understand exactly what to do before you start with the test.<br><br>


                Click on Next to Continue
            </p>
            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="introA()">Next</button>
            </div>
        </div>

        <div class="exm1" style="display:none;">
            <h2>Instructions</h2>
            <br><br>
            <p style="font-size:20px; text-align:justify;">
            You will receive an image with 9 squares, some of the squares will have a small circle or a letter.


            Next to the image, you will have 2 identical images, and one mirror image of the original image. You are required to identify which one of the images is the mirror image.

            </p>
            
            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="exm1()">Next</button>
            </div>
        </div>

        <div class="exm2" style="display:none;">
            <h2>Please practice the following examples</h2>
            <br/>
            <h3>Example 1:</h3>
            <br/>
            <div class="row text-center">
                <div class="col-md-3" style="border-right: 5px solid red;">
                    <img src="<?= base_url() ?>images/spatial/e1-1.png" height="100" alt="">
                </div>
                <div class="col-md-3">
                    <img src="<?= base_url() ?>images/spatial/e1-2.png" height="100" alt=""><br>
                    <input type="radio" name="mit" id="">
                </div>
                <div class="col-md-3">
                    <img src="<?= base_url() ?>images/spatial/e1-3.png" height="100" alt="">
                    <br><input type="radio" name="mit" id="">
                </div>
                <div class="col-md-3">
                    <img src="<?= base_url() ?>images/spatial/e1-4.png" height="100" alt=""><br>
                    <input type="radio" name="mit" id="">
                </div>
            </div>
            <br><br>
            <b>The correct answer is c.</b><br><br>
            <h2>Explanation</h2><br><br>
            <b>If you turn option A anti-clock wise, you will notice it's the same as the original image. If you turn option B clock-wise twice, you will also notice it is the same as the original image. However, when you turn option C either clock or anti-clock wise, you will notice it will never look exactly the same as the original image as it is a mirror image of the original image. </b><br>

            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="exm2()">Begin Test</button>
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
                <a class="control_next btn btn-primary"  style="opacity: 1; top : 50% !important;">Next</a>
                <a class="control_prev btn btn-primary" style="opacity: 1; top : 50% !important;">Previous</a>
            </form>
        </div>  
        <?php  }
        
        if($sacId=="D"){ ?>
            <div class="intro1" style="display:block;">
            <h3 class="text-center"><u>You have successfully completed section C. Please click on Continue to complete section D.</u></h2>
            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="introOne()">Continue</button>
            </div>

        </div>
        <div class="introA" style="display:none;">
            <h2><u>Section D – Numerical Potential</u></h2>
            <br/>
            <p style="font-size:20px; text-align:justify;">
                 This test measures your potential to do basic numerical calculation within a short time-frame.<br><br>


                Please practice the following examples. Make sure you understand exactly what to do before you start with the test.<br><br>


                Click on Next to Continue
            </p>
            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="introA()">Next</button>
            </div>
        </div>

        <div class="exm1" style="display:none;">
            <h2><u>Instructions</u></h2>
            <br/>
            <p style="font-size:20px; text-align:justify;">
                 You will be provided with a number representing the difference between two of the three options. First determine which two of the three numbers the difference score represents, and then select the option based on the criteria given.
            </p>
            <br><br>
            
            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="exm1()">Next</button>
            </div>
        </div>

        <div class="exm2" style="display:none;">
            <h2>Please practice the following examples</h2>
            <br/>
            <h3>Example 2:</h3>
            <br/>
            <h3><p>
                Difference: 3<br>
                Criteria: Lowest
            </p></h3>
            <br/>
            <p style="font-size:20px; text-align:justify;">
                 <input type="radio" name="" id="">a. 1<br>
                 <input type="radio" name="" id="">b. 4<br>
                 <input type="radio" name="" id="">c. 6
            </p>
            <br><br>
            <b>The difference you need to look for is 3. You need to look at the 3 number options and determine which of the three has a difference of 3. In this example you will see that it’s the difference between the 1 and the 4 (4 – 1 = 3), thus eliminating the 6. The criteria ask for the lowest option number which is 1, thus answering 1</b><br>

            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="exm2()">Begin Test</button>
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
        $('.exm2').hide();
        $('#slid').show();
        $('.control_nextB').hide();
        $("#que_1").show();
        $("#que_1").delay(3000).fadeOut("fast");
        $("#slide1").delay(4000).fadeIn("slow");
        $('.control_nextB').show();
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

</script>