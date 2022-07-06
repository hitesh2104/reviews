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
<?php include_once 'include/driver_info.php';
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>AH Drivers Test</h1>
    </section>
    <section style="background: #ffffff" class="content" >
        <center><h1>Drivers Skills Test</h1></center>
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
                <button type="button" class="btn btn-primary" onclick="introOne()">Continue</button>
            </div>

        </div>
        <div class="introA" style="display:none;">
            <h2><u>Section A | Reading and Understanding Maps</u></h2>
            <br/>
            <p style="font-size:20px; text-align:justify;">
                 Study the image carefully and answer the questions provided.
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
            <h2><u>Section B | Remembering Road signs</u></h2>
            <br/>
            <p style="font-size:20px; text-align:justify;">
                 Different road signs will appear for 3 seconds on the screen after which it will disappear again. You will then be given 5 road signs out of which you must select the 2 signs that appeared on the screen.
            </p>
            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="startSectionB()">Begin Test</button>
            </div>

        </div>

        <div id="slid" style="display:none;">

            <form method="post" id="questions_form" action="<?= base_url(); ?>test/processTest9">
                <input type="hidden" name="cat_id" value="<?= $catId; ?>"/>
                <input type="hidden" name="type" value="secB" />

                <ul class="questions_list" id="1">
                    <center>
                    <?php
                    $i = 1;
                    foreach ($sectionTwoArr as $key => $secTwoArr) {
                        ?>

                        <li id="que_<?= $i ?>" style=" list-style: none; display: none;">
                            <img src="<?= base_url().$secTwoArr['img1'] ?>">
                            <img src="<?= base_url().$secTwoArr['img2'] ?>">
                        </li>
                        
                        <li id="slide<?php echo ++$key; ?>" class="mit" style="list-style: none; display: none;">
                            <div class="main_question ans_<?php echo $key; ?>">
                                <h3 style="margin-bottom:50px;padding-top:10px;">Select the two signs that were shown above.</h3>
                            </div>
                            <div class="row">
                                <?php foreach ($secTwoArr['option'] as $ans => $option) { ?>
                                <div class="col-md-2">
                                    <div class="img-list ans_<?php echo $key; ?>" >
                                        <label><center><img src="<?= base_url(); ?>images/signs/<?php echo $option; ?>.png" height="100"/><br>
                                        <input class="qradio vertical" name="q<?php echo $i; ?>" type="checkbox" value="<?php echo $ans; ?>" /></center></label>
                                    </div>
                                </div>
                            <?php  } ?>
                            </div>
                        </li>
                        <?php $i++; } ?>
                        </center>
                </ul>

                <a class="control_nextB btn btn-primary" style="opacity: 1;">Next</a>
                <a class="control_prevB btn btn-primary" style="opacity: 1;">Previous</a>

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
            <h2><u>Section C | Rules of the Road</u></h2>
            <br/>
            <p style="font-size:20px; text-align:justify;">
                 This test measures general knowledge of the rules and laws of the road.
            </p>
            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="introA()">Begin Test</button>
            </div>
        </div>

        <div id="slider" style="display:none;">
            <form method="post" id="questions_form" action="<?= base_url(); ?>test/processTest9">
                <input type="hidden" name="type" value="final" />
                <input type="hidden" name="cat_id" value="<?= $catId;?>"/>

                <ul class="questions_list" id="1">
                    <?php foreach ($sectionThreeArr as $key => $secThreeArr) { ?>
                        <li style="text-align: left" id="slide<?= ++$key; ?>">
                            <h4><?= $secThreeArr['qus']; ?></h4>
                            <br/>
                            <div class="row">
                            <?php foreach ($secThreeArr['option'] as $ans => $option) { ?>
                                <div class="col-md-4">
                                <label style="font-weight: 500;">
                                <input name="q<?= $key; ?>" type="radio" style="height: 80px;width: 15px; float: left; margin-right: 10px;    margin-top: -25px;" value="<?= $ans; ?>"/>
                                <span class="blockquote" style="font-size:18px; text-align: justify;"><?= $option; ?></span>
                                </label>
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
        <?php } ?>

    </section>
</div>

<script type="text/javascript">
    $(document).ready(function ($) {
        $("body").addClass("sidebar-collapse");
        //$('.control_nextB').attr('disabled');
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
           //     $('.control_next').attr('disabled','disabled');
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

            if($('#'+Number(currentSlide) + ' input[name=q'+Number(currentSlide)+']:checked').length < 2)
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
        $('#slid').show();
        $('.control_nextB').hide();
        $("#que_1").show();
        $("#que_1").delay(3000).fadeOut("fast");
        $("#slide1").delay(4000).fadeIn("slow");
        $('.control_nextB').show();
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

</script>