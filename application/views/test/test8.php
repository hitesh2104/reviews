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
    .intro1{
        height: 440px;
    }
    .intro2{
        height: 470px;
    }
</style>
<?php require_once("include/numerical_reasoning_basic_info_14_6.php"); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Numerical Skills</h1>
    </section>

    <?php if($sacId=="A"){ ?>
    <section style="background: #ffffff" class="content">
        <center><h1>Numerical Skills Test</h1></center>
        <div class="intro1" style="display:block;">
            <h2><u>Introduction</u></h2>
            <br/>
            <ul>
                <li>This assessment measures your numerical reasoning ability. It contains a three sections, each section measuring different components of your numerical ability.</li>
                <li>Once you begin with the test, you will not be allowed to ask anyone for assistance.</li>
                <li>Each section has it's own time limit in which you must complete as many questions as possible.</li>
                <li>Click on Begin Test....</li>
            </ul>
            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="introOne()">Begin Test</button>
            </div>

        </div>
        <div class="intro2" style="display:none;">
            <h2>Section A | Basic Calculations</h2>
            <br/>
            <h4>Instructions</h4>
            <br>
            <ul>
                <li>You will be given a basic numerical problem which you must solve.</li>
                <li>You are NOT ALLOWED to use a calculator. If you use a calculator, you will be cheating.</li>
                <li>You are allowed to use a pen and paper.</li>
                <li>This section of the test has it's own of 3 minutes. When you click on Begin Test, the timer will start counting down. If you run out of time, the test will automatically stop and take you to the next section.</li>
                <li>If you are ready, click on Begin Test.</li>
            </ul>
            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="introTwo()">Begin Test</button>
            </div>

        </div>
        
        <div id="slider" style="display:none">
            <form method="post" id="questions_form" action="<?= base_url(); ?>test/processTest8">
                <input type="hidden" name="type" value="secA"/>
                <input type="hidden" name="cat_id" value="<?= $catId;?>"/>
                <div style="font-size:18px; text-align: center;">Time Remaining: <span id="timer"></span></div>
                <br><br>
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
        <center><h1>Numerical Skills Test</h1></center>
        <div class="intro1" style="display:block;">
            <h3 class="text-center"><u>You have successfully completed section A. Please click on Continue to complete section B.</u></h2>
            <br/>
            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="introOne()">Continue</button>
            </div>

        </div>
        <div class="intro2" style="display:none;">
            <h2>Section B | Interpreting Graphs</h2>
            <br/>
            <h4>Instructions</h4>
            <br>
            <ul>
                <li>In this section, you will see two graphs representing sales for the 2014 and 2015 period.</li>
                <li>Please answer the questions using these graphs.</li>
                <li>This section of the test has it's own time limit of 5 minutes. When you click on Begin Test, the timer will start counting down. If you run out of time, the test will automatically stop and take you to the next section.</li>
                <li>When you are ready, please click on Begin Test.</li>
            </ul>
            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="introTwo()">Begin Test</button>
            </div>

        </div>
        
        <div id="slider" style="display:none">
            <form method="post" id="questions_form" action="<?= base_url(); ?>test/processTest8">
                <input type="hidden" name="type" value="secB"/>
                <input type="hidden" name="cat_id" value="<?= $catId;?>"/>
                <div style="font-size:18px; text-align: center;">Time Remaining: <span id="timer"></span></div><br>
                <center>
                <img src="<?= base_url() ?>images/nrb_sectionb_chart.jpg" name="Question" id="Question" height="350" >
                </center>
                <br>
                <ul class="questions_list" id="1">
                    <?php foreach ($sectionTwoArr as $key => $secTwoArr) { ?>
                        <li style="text-align: left; height: 700px;" id="slide<?= ++$key; ?>">
                            <h3 class="text-center"><?= $secTwoArr['qus']; ?></h3>
                            <br/>
                            <div class="row text-center">
                            <?php foreach ($secTwoArr['option'] as $ans => $option) { ?>
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
    <?php } elseif($sacId=="C") { ?>
    
        <section style="background: #ffffff" class="content">
        <center><h1>Numerical Skills Test</h1></center>
        <div class="intro1" style="display:block;">
            <h3 class="text-center"><u>You have successfully completed section B. Please click on Continue to complete section C.</u></h2>
            <br/>
            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="introOne()">Continue</button>
            </div>

        </div>
        <div class="intro2" style="display:none;">
            <h2>Section C | Patterns and Relationships</h2>
            <br/>
            <h4>Instructions</h4>
            <br>
            <ul>
                <li>In this section, you must determine the number that comes in the open block to complete the pattern and/or relationship of the other numbers.</li>
                <li>Using your keyboard, please type in the number that is missing.</li>
                <li>You are not allowed to use a calculator.</li>
                <li>This section of the test has it's own time limit of 7 minutes. When you click on Begin Test, the timer will start counting down. If you run out of time, the test will automatically stop and take you to the next section.</li>
            </ul>
            <br/>
            <h4>Instructions</h4>
            <br>
            <img src="<?= base_url() ?>images/nrb_sectionc_example.png" name="Example" id="Question" height="40" width="100%">
            <br><br><br>
            <p>The missing number in this sequence is 3.<br>Please click on Begin Test if you understand the instructions.</p>
            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="introTwo()">Begin Test</button>
            </div>

        </div>
        
        <div id="slider" style="display:none">
            <form method="post" id="questions_form" action="<?= base_url(); ?>test/processTest8">
                <input type="hidden" name="type" value="secC"/>
                <input type="hidden" name="cat_id" value="<?= $catId;?>"/>
                <div style="font-size:18px; text-align: center;">Time Remaining: <span id="timer"></span></div>
                <br><br>
                <h2 class="text-center">Enter the missing number...</h2>
                <br><br>

                <ul class="questions_list" id="1">
                    <?php foreach ($sectionThreeArr as $key => $secThreeArr) { ?>
                        <li style="text-align: left" id="slide<?= ++$key; ?>">
                            <div id="secQuestionHolder">
                                <?php
                                $g = 0;
                                foreach ($secThreeArr['qus'] as $qusVal) {
                                    ++$g;
                                    ?>
                                    <div class="secQuestion"><?php echo $qusVal; ?></div>
                                <?php } ?>
                                <br />
                            </div>
                            <br><br>
                            <div class="text-center">
                                <span>Answer : </span> <input type="text" class="qtext" name="q<?php echo $key; ?>" id="q_<?php echo $key; ?>" size="5" tabindex="-1" autocomplete="off" />
                            </div>
                        </li>
                    <?php } ?>
                </ul>
                <a class="control_next btn btn-primary"  style="opacity: 1;">Next</a>
                <a class="control_prev btn btn-primary" style="opacity: 1;">Previous</a>
            </form>
        </div>
    </section>
    <?php } elseif($sacId=="D") {?>
        <section style="background: #ffffff" class="content">
        <center><h1>Numerical Skills Test</h1></center>
        <div class="intro1" style="display:block;">
            <h3 class="text-center"><u>You have successfully completed section C. Please click on Continue to complete section D.</u></h2>
            <br/>
            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="introOne()">Continue</button>
            </div>
        </div>
        <div class="intro2" style="display:none;">
            <h2>Section D | Ability Numerical</h2>
    
            <h4>Instructions</h4>
            
            <ul>
                <li>This section of the test has it's own time limit of 10 minutes. When you click on Begin Test, the timer will start counting down. If you run out of time, the test will automatically stop and take you to the next section.</li>
            </ul>
                
            <img src="<?= base_url() ?>images/table_test4.png" name="Example" id="Question" height="180" width="100%">
            <br>
            <div class="text-center">
                <p>How far is Bloem from Paarl?</p><br>
                <input type="radio" name="" id="">443<br>
                <input type="radio" name="" id="">1022<br>
                <input type="radio" name="" id="">1148<br>
                <b>The correct answer is "1022".</b>
            </div>
            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="introTwo()">Continue</button>
            </div>

        </div>
        
        <div id="slider" style="display:none">
            <form method="post" id="questions_form" action="<?= base_url(); ?>test/processTest8">
                <input type="hidden" name="type" value="final"/>
                <input type="hidden" name="cat_id" value="<?= $catId;?>"/>
                <div style="font-size:18px; text-align: center;">Time Remaining: <span id="timer"></span></div>
                <br>
                <h4 class="text-center">Please study the table below and answer the questions below:</h4>
                <br>
                <img src="<?= base_url() ?>images/table_test4.png" alt="" height="190" width="100%;">
                <ul class="questions_list" id="1">
                    <?php foreach ($sectionFourArr as $key => $secFourArr) { ?>
                            <li style="text-align: left;height: 600px !important;" id="slide<?= ++$key; ?>">
                                <h3><b><?= $secFourArr['qus']; ?></b></h3>
                                <br/>
                                <div class="row text-center">
                                    <?php
                                    foreach ($secFourArr['option'] as $ans => $option) { ?>
                                        <div class="col-md-3">
                                        <label>
                                            <span style="font-size:18px;"><?= $option; ?></span>
                                            <input name="q<?= $key; ?>" type="radio" value="<?= ++$ans; ?>" />
                                        </label>
                                        </div>
                                    <?php } ?>
                                    <br/>
                                </div>
                            </li>
                    <?php } ?>
                </ul>
                <a class="control_next btn btn-primary"  style="opacity: 1;">Next</a>
                <a class="control_prev btn btn-primary" style="opacity: 1;">Previous</a>
            </form>
        </div>
    </section>
    <?php }?>
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

    function introTwo() {
        $('.intro2').hide();
        $('#slider').show();

        <?php if($sacId=="A"){ ?>
            sectionStartTimer1();
        <?php } elseif ($sacId=="B") { ?>
            sectionStartTimer2();
        <?php } elseif ($sacId=="C") { ?>
            sectionStartTimer3();
        <?php } elseif ($sacId=="D") { ?>
            sectionStartTimer4();
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
        var minutes = 60 * 3, display = $('#timer');
        startTimer(minutes, display);
    }
    function sectionStartTimer2(){
        var minutes = 60 * 5, display = $('#timer');
        startTimer(minutes, display);
    }
    function sectionStartTimer3(){
        var minutes = 60 * 7, display = $('#timer');
        startTimer(minutes, display);
    }
    function sectionStartTimer4(){
        var minutes = 60 * 10, display = $('#timer');
        startTimer(minutes, display);
    }
</script>