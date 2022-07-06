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
        height: 640px;
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

    a.control_prev:hover, a.control_next:hover {
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
    .intro1{
        height: 440px;
    }
    .intro2{
        height: 470px;
    }
</style>
<?php include_once 'include/driver_info.php';
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>AH Drivers Test</h1>
    </section>
    <section style="background: #e1e1e1" class="content">
        
    <?php 

    if($sacId=="A"){ ?>
        
        <div class="intro1" style="display:block;">
            <h2><u>Introduction</u></h2>
            <br/>
            <p style="font-size:20px; text-align:justify;">
                 The AH Drivers Test measures the participant’s ability to read and understand maps, and how effective they can remember road signs.
            </p>
            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="introOne()">Begin Test</button>
            </div>

        </div>
        <div class="introA" style="display:none;">
            <h2><u>Section A | Reading and Understanding Maps</u></h2>
            <br/>
            <p style="font-size:20px; text-align:justify;">
                 Study the attached diagram picture carefully and answer the questions on the answer sheet provided. Please do not answer or make any markings on the diagram picture.
            </p>
            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="introA()">Begin Test</button>
            </div>
        </div>

        <div id="slider" style="display:none;">
            <form method="post" id="questions_form" action="<?= base_url(); ?>test/processTest9">
                <input type="hidden" name="type" value="secA" />
                <input type="hidden" name="cat_id" value="<?= $catId;?>"/>
                <div style="text-align:center;">
                    <!--<div style="font-size:18px">Test will be close in <span id="timer"></span> minutes!</div>-->
                    <img src="<?= base_url(); ?>images/maps/map_1.png" alt="Mechanical Reasoning Question" height="375" id="map1" />
                    <img src="<?= base_url(); ?>images/maps/map_2.png" alt="Mechanical Reasoning Question" height="375" id="map2" style="display:none;" />
                    <img src="<?= base_url(); ?>images/maps/map_3.png" alt="Mechanical Reasoning Question" height="375" id="map3" style="display: none;" />
                </div>

                <ul class="questions_list" id="1">
                    <?php foreach ($sectionOneArr as $key => $secOneArr) { ?>
                        <li style="text-align: left" id="slide<?= ++$key; ?>">
                            <h4><?= $secOneArr['qus']; ?></h4>
                            <br/>
                            <div class="row">
                            <?php foreach ($secOneArr['option'] as $ans => $option) { ?>
                                <div class="col-md-3">
                                <input name="q<?= $key; ?>" type="radio" value="<?= $ans; ?>"/>
                                <span style="font-size:18px;"><?= $option; ?></span>
                                </div>
                            <?php } ?>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
                <a class="control_next btn btn-primary" onclick="changeMapNextImage()" disabled style="opacity: 1;">Next</a>
                <a class="control_prev btn btn-primary" onclick="changeMapPreviousImage()" style="opacity: 1;">Previous</a>
            </form>
        </div>  
        <?php } 
        if($sacId=="B"){ ?>
            
            <div class="test_intro1">
                    <div class="instruction">
                        <p style="font-size:16px; text-align:justify;">
                            You have successfully completed this test. Please click on next to complete the next test.
                        </p>
                    </div>
                    <div class="clear"></div>
                    <input type="submit" class="btn_color btn test_intro2" value="Next">
                </div>

                <div class="test_intro11">
                    <div class="instruction" style="margin:10px 70px 20px 70px;">
                        <h1>Section B | Remembering Road signs</h1>         
                        <p style="font-size:16px; text-align:justify;">
                            Different road signs will appear for 3 seconds on the screen after which it will disappear again. You will then be given 5 road signs out of which you must select the 2 signsthat appeared on the screen. 
                        </p>
                    </div>
                    <div class="clear"></div>
                    <input type="submit" class="btn_color btn test_intro22" value="Continue" style="margin-top:0;">
                </div>

                <div class="test_intro111">
                    <div class="instruction" style="margin:10px 70px 20px 70px;">
                        <h1 style="margin-bottom:0;">Please practice the following examples</h1>
                        <br/>
                        <h2 style="margin-bottom:0;">E.g.These two road signs will appear on your screen for 3 seconds then it will disappear.</h2>
                        <br/>
                        <div style="text-align:center;">
                            <img src="images/signs/eg_left.png" height="150"/>
                            <img src="images/signs/eg_right.png" height="150"/>
                        </div>
                        <br/>
                        <h3>After the above road signs have disappeared, you will have to click on the signs below that were shown.</h3>
                        <h3>From the illustration below, you will then have to select the following cards.</h3>
                        <p style="font-size:16px; text-align:center;">
                        <ul class="inline-block" style="text-align: center;">
                            <li>
                                <img src="images/signs/eg_1.png" height="100"/><br />
                                <input class="qradio vertical m-t-10" name="q1" type="checkbox" />
                            </li>    
                            <li>    
                                <img src="images/signs/eg_2.png" height="100"/><br />
                                <input class="qradio vertical m-t-10" name="q2" type="checkbox"/>
                            </li>
                            <li>    
                                <img src="images/signs/eg_left.png" height="100"/><br />
                                <input class="qradio vertical m-t-10" name="q3" type="checkbox" checked="checked"/>
                            </li>
                            <li>    
                                <img src="images/signs/eg_3.png" height="100"/><br />
                                <input class="qradio vertical m-t-10" name="q4" type="checkbox"/>
                            </li>
                            <li>    
                                <img src="images/signs/eg_right.png" height="100"/><br />
                                <input class="qradio vertical m-t-10" name="q5" type="checkbox" checked="checked"/>
                            </li>
                        </ul>
                        </p><br/>
                        <span>
                            <strong>If you understand the instructions, click on continue to start with the test.</strong><br /><br />
                        </span>
                    </div>
                    <div class="clear"></div>
                    <input type="submit" class="btn_color btn test_intro222" value="Continue" style="margin-top:0;" onclick="startSectionB()">
                </div>

                <form method="post" class="wrapper" id="questions_form" action="test8.php?p=sectionC">
                    <input type="hidden" name="section" value="secB" />
                    <div style="text-align:center;">
                        <div style="text-align:center;" class="que_1">
                            <img src="images/signs/1-3.png" height="250"/>
                            <img src="images/signs/1-4.png" height="250"/>
                        </div>
                        <div style="text-align:center;display:none;" class="que_2">
                            <img src="images/signs/2-1.png" height="250"/>
                            <img src="images/signs/2-3.png" height="250"/>
                        </div>
                        <div style="text-align:center;display:none;" class="que_3">
                            <img src="images/signs/3-2.png" height="250"/>
                            <img src="images/signs/3-5.png" height="250"/>
                        </div>
                        <div style="text-align:center;display:none;" class="que_4">
                            <img src="images/signs/4-4.png" height="250"/>
                            <img src="images/signs/4-1.png" height="250"/>
                        </div>
                        <div style="text-align:center;display:none;" class="que_5">
                            <img src="images/signs/5-5.png" height="250"/>
                            <img src="images/signs/5-2.png" height="250"/>
                        </div>
                        <div style="text-align:center;display:none;" class="que_6">
                            <img src="images/signs/6-4.png" height="250"/>
                            <img src="images/signs/6-3.png" height="250"/>
                        </div>
                        <div style="text-align:center;display:none;" class="que_7">
                            <img src="images/signs/7-3.png" height="250"/>
                            <img src="images/signs/7-4.png" height="250"/>
                        </div>
                        <div style="text-align:center;display:none;" class="que_8">
                            <img src="images/signs/8-5.png" height="250"/>
                            <img src="images/signs/8-1.png" height="250"/>
                        </div>
                        <div style="text-align:center;display:none;" class="que_9">
                            <img src="images/signs/9-3.png" height="250"/>
                            <img src="images/signs/9-5.png" height="250"/>
                        </div>
                        <div style="text-align:center;display:none;" class="que_10">
                            <img src="images/signs/10-2.png" height="250"/>
                            <img src="images/signs/10-5.png" height="250"/>
                        </div>
                    </div>

                    <ul class="questions_list" id="1">
                        <?php
                        $i = 1;
                        foreach ($sectionTwoArr as $key => $secTwoArr) {
                            ?>
                            <li id="slide<?php echo ++$key; ?>">
                                <div class="main_question ans_<?php echo $key; ?>" style="display:none;">
                                    <h1 style="margin-top:170px;padding-top:10px;">Select the two signs that were shown above.</h1>
                                </div>
                                <div style="font-size:50px; text-align:center; display: none; margin-top: 20px;" class="checkClass ans_<?php echo $key; ?>">

                                    <?php if (!empty($secTwoArr['option'])) { ?>
                                        <?php foreach ($secTwoArr['option'] as $ans => $option) { ?>
                                            <div class="img-list ans_<?php echo $key; ?>" style="display: none;">
                                                <img src="images/signs/<?php echo $option; ?>.png" height="100"/>
                                                <input class="qradio vertical" name="q<?php echo $i; ?>" type="checkbox" value="<?php echo $ans; ?>"

                                                       />
                                            </div>
                                            <?php
                                            $i++;
                                        }
                                        ?>
                                        <?php
                                    }
                                    ?>          
                                </div>
                            </li>
                        <?php } ?>
                        <div class="clear"></div>
                    </ul>
                </form>
        
        <?php  }
        
        if($sacId=="C"){ ?>
        CCC
        <?php } ?>

    </section>
</div>

<script type="text/javascript">
    $(document).ready(function ($) {
        var slideCount = $('#slider ul li').length;
        var slideWidth = $('#slider ul li').width();
        var slideHeight = $('#slider ul li').height() - 110;
        var sliderUlWidth = slideCount * slideWidth;
        $('#slider').css({width: slideWidth, height: slideHeight});
        $('#slider ul').css({width: sliderUlWidth, marginLeft: -slideWidth});
        $('#slider ul li:last-child').pre-pendTo('#slider ul');

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
        $('a.control_next').click(function () {
            $('.control_next').removeAttr('disabled');
            var slidesUL = $(".questions_list");
            var NumberOfSlides = $(slidesUL).find("li").size();
            var currentSlide = $(slidesUL).attr("id");
            var validateInput = $('input[name="q' + currentSlide + '"]:checked').length;
            if (validateInput == 0) {
                $('.control_next').attr('disabled','disabled');
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
        $('.introA').css('display','block');
    }

    function introA() {
        $('.intro1').hide();
        $('.introA').hide();
        $('#slider').show();
    }

</script>

<script type="text/javascript">
    function changeMapNextImage() {
        var questionId = $(".questions_list").attr("id");
        questionId = Number(questionId) + 1;
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
        
        var previous = Number(questionId) - 1;

        $(".que_" + previous).hide();
        $(".ans_" + previous).hide();
        $(".que_" + questionId).show();
        $(".que_" + questionId).delay(3000).fadeOut("slow");
        $(".ans_" + questionId).delay(3000).fadeIn(500);

        //For checking only two checkbox after 2-10 que
        $('.ans_' + questionId + ' input[type=checkbox]').change(function () {
            var i = 0;
            $('.ans_' + questionId + ' input:checkbox:checked').each(function () {
                i++;
            });
            if (i > 2) {
                this.checked = false;
            }
        });
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
        $('.introA').hide();
        $('#slider').show();
        $(".que_1").delay(3000).fadeOut("slow");
        $(".ans_1").delay(3000).fadeIn(500);
    }

   $('.checkClass input[type=checkbox]').change(function(){
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


</script>