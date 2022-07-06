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
        height: 700px;
        //background: #ccc;
        text-align: center;
        //line-height: 300px;
    }

    a.control_prev, a.control_next {
        position: absolute;
        top: 92%;
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
<?php include_once 'include/mechanical_reasoning_info.php';
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Mechanical Skills Test (MST)</h1>
    </section>
    <section style="background: #ffffff" class="content">
        <center><h1>Mechanical Skills Test</h1></center>
        <div class="intro1" style="display:block;">
            <h2><u>Introduction</u></h2>
            <br/>
            <p style="font-size:20px; text-align:justify;">
                This test measures your understanding of principles of mechanics, spatial ability, and cause and effect <br>relationships. Specific item content is wide ranging and includes: wheels, gears, levers, sliding rods,<br> pulleys, weights and fixed pivots.
            </p>
            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="introOne()">Continue</button>
            </div>

        </div>
        <div class="intro2" style="display:none;">
            <h2><u>Instructions</u></h2>
            <br/>
            <p style="font-size:20px; text-align:justify;">
                Study the attached image carefully before answering the questions
                
                You have 10 minutes to complete all 20 questions.
            </p>
            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="introTwo()">Continue</button>
            </div>

        </div>
        <div class="intro3" style="display:none;">
            <h2><u>Please practice the following examples</u></h2>
            <br/>
            <h4>Example 1</h4>
            <br>
            <img src="<?= base_url() ?>images/mc_example_one.png" height="200" alt="">
            <br>
            <br>
            <ul>
                <li>
                    <h4>If gear X is turning clockwise, which way will gear Y turn</h4>
                    <input type="radio" name="" value="" id="">Clockwise <br>
                    <input type="radio" name="" value="" id="">Anti-clockwise
                </li>
            </ul><br>
            <p><b>The correct answer is Anti-clockwise</b></p>
            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="introThree()">Next</button>
            </div>

        </div>
        <div class="intro4" style="display:none;">
            <h4>Example 2</h4>
            <br>
            <img src="<?= base_url() ?>images/mc_example_two.png" height="220" alt="">
            <ul>
                <li>
                    <h4>If gear X is turning clockwise, which way will gear Y turn</h4>
                    <input type="radio" name="" value="" id="">Slower <br />
                    <input type="radio" name="" value="" id="">Faster
                </li>
            </ul><br><br>
            <p><b>The correct answer is Slower</b></p><br>
            <p>If you understand the instructions, click on Begin Test to start with the test.</p>
            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="introFour()">Begin Test</button>
            </div>

        </div>
    
        <div id="slider" style="display:none">
            <div style="font-size:18px; text-align: center;">Time Remaining: <div id="timer"></div>
            <form method="post" id="questions_form" action="<?= base_url(); ?>test/processTest11">
                <input type="hidden" name="type" value="final"/>
                <input type="hidden" name="cat_id" value="<?= $catId;?>"/>
                <img src="<?= base_url() ?>images/mech_question.png" height="350" width="600" alt="">
                <ul class="questions_list" id="1">
                    <?php foreach ($sectionOneArr as $key => $secOneArr) { ?>
                        <li style="text-align: left" id="slide<?= ++$key; ?>">
                            <h3><?= $secOneArr['qus']; ?></h3>
                            <br/>
                            <?php foreach ($secOneArr['option'] as $ans => $option) { ?>
                                <label>
                                <input name="q<?= $key; ?>" type="radio" value="<?= $ans; ?>"/>
                                <span style="font-size:18px;"><?= $option; ?></span>
                                </label>
                                <br/>
                            <?php } ?>
                        </li>
                    <?php } ?>
                </ul>
                <a class="control_next btn btn-primary"  style="opacity: 1;">Next</a>
                <a class="control_prev btn btn-primary" style="opacity: 1;">Previous</a>
            </form>
        </div>
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

    function introTwo() {
        $('.intro2').hide();
        $('.intro3').show();
    }

    function introThree() {
        $('.intro3').hide();
        $('.intro4').show();
    }

    function introFour() {
        $('.intro4').hide();
        $('#slider').show();
        sectionStartTimer();
    }

    function sectionStartTimer() {
        var minutes = 60 * 10, display = $('#timer');
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