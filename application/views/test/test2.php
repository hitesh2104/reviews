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
        height: 550px;
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
<?php include_once 'include/mira_info.php';
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Matrix of Intellectual Reasoning Assessment (MIRA)</h1>
    </section>
    <section style="background: #ffffff" class="content">
    <center><h1>Matrices of Intellectual Reasoning Assessment</h1></center>
    <?php if($sacId=="A"){ ?>
        <div class="intro1" style="display:block;">
            <h2><u>Introduction</u></h2>
            <br/>
            <p style="font-size:20px; text-align:justify;">
                The Matrices of Intellectual Reasoning Assessment (MIRA) measures your ability to think conceptually and to solve various abstract problems. This test is divided into 2 sections; each section has 25 questions and a time limit of 25 minutes per section. Please read the instructions carefully before you start with the test. Once the test starts, you won???t be able to go back to the instructions.
            </p>
            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="introOne()">Instructions</button>
            </div>

        </div>

        <div class="introA" style="display:none;">
            <h2><u>Instructions | Section A</u></h2>
            <br/>
            <p style="font-size:20px; text-align:justify;">
                 This section requires you to select the image that is missing from the matrices by selecting from the Options A, B, C or D.

                    Study each row or column to learn more about the sequence or pattern.
            </p>
            <br />
            <img src="<?= base_url().'images/mira_sec_a/sec-a-img.png' ?>" height="150" width="700">

            <div class="clearfix"></div>
            <br/>
            <p style="font-size:20px; text-align:justify;">
                The correct answer in this example is option "A". You will notice that in row 1 and row 3, the images turn anti-clockwise.

                When you are ready, please click on Begin Test to start with Section A.
            </p>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="introA()">Begin Test</button>
            </div>
        </div>
    
        <div id="slider" style="display:none">
            <form method="post" id="questions_form" action="<?= base_url(); ?>test/processTest2">
                <input type="hidden" name="type" value="secA"/>
                <input type="hidden" name="cat_id" value="<?= $catId;?>"/>
                <div style="font-size:18px; text-align: center;">Time Remaining: <div id="timer"></div></div>
                <ul class="questions_list" id="1">
                    <?php foreach ($sectionOneArr as $key => $secOneArr) { ?>
                        <li style="text-align: center; id="slide<?= ++$key; ?>">
                            <h4><img src="<?= base_url().'images/mira_sec_a/'.$secOneArr['qus'].'.png'; ?>" height="220" width="330"></h4>
                            <br/>
                            <div class="row">
                                <?php foreach ($secOneArr['option'] as $ans => $option) { ?>
                                <div class="col-md-3">
                                    <label>
                                    <img src="<?= base_url().'images/mira_sec_a/'.$option.'.png' ?>" height="60"><br>
                                    <input name="q<?= $key; ?>" type="radio" value="<?= $ans; ?>"/>
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
    <?php } ?>
    <?php if($sacId=="B"){ ?>
        <div class="intro1" style="display:block;"><br>
            <h3 class="text-center"><u>You have successfully completed section A. Please click on Continue to complete section B.</u></h2>
            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="introOne()">Continue</button>
            </div>

        </div>

        <div class="introA" style="display:none;">
            <h2><u>Instructions | Section B</u></h2>
            <br/>
            <p style="font-size:20px; text-align:justify;">
                This section requires you to select the image that follows in the sequence. Study the first 3 images, then select the image from option A, B or C that follows in the sequence
            </p>
            <br />
            <img src="<?= base_url().'images/mira_sec_b/sec-b-img.png' ?>" height="220" width="100%">

            <div class="clearfix"></div>
            <br/>
            <p style="font-size:20px; text-align:justify;">
                The correct answer in this example is "B". The image in the outer circle is moving clock-wise, on block at a time.

                When you are ready, please click on Begin Test to start with Section B
            </p>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="introA()">Begin Test</button>
            </div>
        </div>

        <div id="slider" style="display:none">
        <div style="font-size:18px; text-align: center;">Time Remaining: <div id="timer"></div></div>
            <form method="post" id="questions_form" action="<?= base_url(); ?>test/processTest2">
                <input type="hidden" name="type" value="final"/>
                <input type="hidden" name="cat_id" value="<?= $catId;?>"/>
                <ul class="questions_list" id="1">
                    <?php foreach ($sectionTwoArr as $key => $secOneArr) { ?>
                        <li style="text-align: center; id="slide<?= ++$key; ?>">
                            <h4><img src="<?= base_url().'images/mira_sec_b/'.$secOneArr['qus'].'.png'; ?>" height="250" width="600"></h4>
                            <br/>
                            <div class="row">
                                <?php foreach ($secOneArr['option'] as $ans => $option) { ?>
                                
                                <div class="col-md-4">
                                <label>
                                    <img src="<?= base_url().'images/mira_sec_b/'.$option.'.png' ?>" height="80"><br>
                                    <input name="q<?= $key; ?>" type="radio" value="<?= $ans; ?>"/>
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
    <?php } ?>
    </section>
</div>

<script type="text/javascript">
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
        $('a.control_next').click(function () {
            $('.control_next').removeAttr('disabled');
            var slidesUL = $(".questions_list");
            var NumberOfSlides = $(slidesUL).find("li").size();
            var currentSlide = $(slidesUL).attr("id");
            var validateInput = $('input[name="q' + currentSlide + '"]:checked').length;
            if (validateInput == 0) {
               // $('.control_next').attr('disabled','disabled');
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
   
</script>
<script>
    function introOne() {
            $('.intro1').hide();
            $('.introA').css('display','block');
    }

    function introA() {
        $('.intro1').hide();
        $('.introA').hide();
        $('#slider').show();
        sectionStartTimer();
    }

    function sectionStartTimer() {
        var minutes = 60 * 25, display = $('#timer');
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