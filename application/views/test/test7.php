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
        <?php if($sacId=="A"){ ?>    
        height: 670px;
        <?php } else { ?>
        height: 550px;
        <?php } ?>
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
<?php include_once 'include/ability_verbal_info.php';
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Introduction</h1>
    </section>
    <?php if($sacId=="A"){ ?>
    <section style="background: #ffffff" class="content">
        <center><h1>Verbal Skills Test</h1></center>
        <div class="intro1" style="display:block;">
            <h2><u>Introduction</u></h2>
            <br/>
            <ul>
                <li>This assessment measures your verbal reasoning ability. It contains a four sections, each section   measuring different components of your verbal reasoning.
                </li>
                <li>Each section has practice examples which you must complete before continuing. If you do not understand after attempting the examples, please ask your administrator for assistance.</li>
                <li>Once you begin with the test, you will not be allowed to ask anyone for assistance.</li>
                <li>Each section has it's own time limit in which you must complete as many questions as possible.</li>
                <li>Click on Next....</li>
            </ul>
            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="introOne()">Next</button>
            </div>
        </div>
        <div class="introA" style="display:none;">
            <h2><u>Instructions | Section A</u></h2>
            <br/>
            <p style="font-size:20px; text-align:justify;">
                Please study the examples below before you start with the assessment:
                
                By following the Example rules below, please answer the questions which are 

                based on the example rules:
            </p>
            <br />
                
    <img src="<?= base_url() ?>images/Section_A_Instruction.png" alt="" height="268" width="1100">

            <br>

            <h3>Example Questions</h3>
            <br>
            <p>1.  If John wears a short pants</p>
                <ul>
                    <li>a.  He must have white socks</li>
                    <li>b.  His shirt must have buttons</li>
                    <li>c.  The pants will be red</li>
                    </ul>
                <br>
            <p>The correct answer is “c”. The rules says that if a pants is short, it must be red.</p>


            <!--  -->
            <br/>
            <p>2.  If Sue’s shirt is Blue</p>
            <ul>
                <li>a.  It will have buttons</li>
                <li>b.  It’s actually red</li>
                <li>c.  It has no buttons</li>
            </ul>
            <br>
            <p>The correct answer is “a”. The rules says that blue means white, and white shirts always has buttons.</p>
            <br>
            <b>If you understand the instructions, you may proceed. Please note you have 4 minutes to complete this section: </b>
            <br>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="introA()">Begin Test</button>
            </div>
            <div class="clearfix"></div>
        </div>

        <div id="slider" style="display:none;">
            <form method="post" id="questions_form" action="<?= base_url(); ?>test/processTest7">
                <input type="hidden" name="type" value="secA"/>
                <input type="hidden" name="cat_id" value="<?= $catId;?>"/>
                <div style="font-size:18px; text-align: center;">Time Remaining: <span id="timer"></span></div>
                <center>
                <img src="<?= base_url() ?>images/av_question1.png" alt="" height="268" width="853">
                <h3 style="padding-top:10px;">Using the above rules, answer the following questions</h3>
                </center>
                <ul class="questions_list" id="1">
                    <?php foreach ($sectionOneArr as $key => $secOneArr) { ?>
                        <li style="text-align: left" id="slide<?= ++$key; ?>">
                            <center>
                            <h4><?= $secOneArr['qus']; ?></h4>
                            <br/>
                            <div class="row">
                            <?php foreach ($secOneArr['option'] as $ans => $option) { ?>
                                <div class="col-md-3">
                                <label>
                                    <input name="q<?= $key; ?>" type="radio" value="<?= $option; ?>"/>
                                    <span style="font-size:18px;"><?= $option; ?></span><br/>
                                </label>
                                </div>
                            <?php } ?>
                            </div>
                            </center>
                        </li>
                    <?php } ?>
                </ul>-
                <a class="control_next btn btn-primary" style="opacity: 1;">Next</a>
                <a class="control_prev btn btn-primary" style="opacity: 1;">Previous</a>
            </form>
        </div>
    </section>
    <?php } ?>
    <?php if($sacId=="B"){ ?>
    <section style="background: #e1e1e1" class="content">
    <center><h1>Verbal Skills Test</h1></center>
        <div class="intro1" style="display:block;">
            <h3 class="text-center"><u>You have successfully completed section A. Please click on Continue to complete section B.</u></h2>
            <br/>
            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="introOne()">Continue</button>
            </div>

        </div>

        <div class="introA" style="display:none;">
            <h2><u>Instructions | Section B</u></h2>
            <br>
            <p>
                In this section, you will receive a paragraph to read through with a set of questions. The answers to these questions can be found in the paragraph.
            </p>
            <br><br>
            <p>You have 7 minutes to complete this section.</p>
            <br/>

            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="introA()">Begin Test</button>
            </div>
        </div>

        <div id="slider" style="display:none">
            <form method="post" id="questions_form" action="<?= base_url(); ?>test/processTest7">
                <input type="hidden" name="type" value="secB"/>
                <input type="hidden" name="cat_id" value="<?= $catId;?>"/>
                <div style="font-size:18px; text-align: center;">Time Remaining: <span id="timer"></span></div>
                
                <p style="text-align:justify;margin:30px;font-size:16px;">
                    Myriad factors contribute to making a business successful - strategy, dedicated employees, good information systems, excellent implementation. However, today's successful companies at all levels have one thing in common - like Nike they are strongly customer-focused and heavily committed to marketing. These companies share an absolute dedication to sensing, serving and satisfying the needs of customers in well-defined target markets. They motivate everyone in the organization to deliver high quality and superior value for their customers, leading to high levels of customer satisfaction. These organizations know that if they take care of their customers, market share and profits will follow. Marketing, more than any other business function, deals with customers. Creating customer value and satisfaction are at the very heart of modern marketing thinking and practice. The goal of marketing is to attract new customers by promising superior value, and to keep current customers by delivering satisfaction.
                </p>
                <ul class="questions_list" id="1">
                    <?php foreach ($sectionTwoArr as $key => $secTwoArr) { ?>
                        <li style="text-align: left" id="slide<?= ++$key; ?>">
                            <h3 class="text-center"><?= $secTwoArr['qus']; ?></h3>
                            <br/>
                            <div class="row text-center">
                            <?php foreach ($secTwoArr['option'] as $ans => $option) { ?>
                                <div class="col-md-3">
                                <label>
                                    <input name="q<?= $key; ?>" type="radio" value="<?= $option; ?>"/>
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
    <?php } ?>
                <?php if($sacId=="C"){ ?>
                <section style="background: #e1e1e1" class="content" style="height: 324px;">
                <center><h1>Verbal Skills Test</h1></center>
                <div class="intro1" style="display:block;">
                <h2><u>Introduction</u></h2>
                <br/>
                <p style="font-size:20px; text-align:justify;">
                You have successfully completed section B. Please click on Continue to complete section C.
                </p>
                <div class="clearfix"></div>
                <br/>
                <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="introOne()">Continue</button>
                </div>
                
                </div>
                
                <div class="introA" style="display:none;">
                <h2><u>Instructions | Section C</u></h2>
                <br/>
                <p style="font-size:20px; text-align:justify;">
                In this section, you will receive a short statement. You will then receive 5 other statements where two of the 5 statements together will proof the short statement.
                </p>
                <br>
                
                <h3>Example 1</h3>
                <p>Joe has brown hair.</p>

                <br>
                <ul>
                <li> <b> 1: </b> Joe has long hair. </li>
                <li> <b> 2: </b> Sarah has brown hair. </li>
                <li> <b> 3: </b> Sarah is ten years old. </li>
                <li> <b> 4: </b> Joe’s hair is the same colour as Sarah. </li>
                <li> <b> 5: </b> Joe has short hair.</li>
                
                </ul>
                <br>
                
                <p>The correct answer is 2 and 4. If Sarah’s hair is brown, and Joe’s hair is the same colour as Sarah’s hair, it will proof the original statement that Joe’s hair is brown.</p>
                
                <!--  -->
                <br/>
                
                <h3>Example 2</h3>

                <p>Eric wears long pants</p>
                <br>
                <ul>
                <li> 1.  Eric wears a jacket</li>
                <li> 2.  People only wears a jacket with long pants</li>
                <li> 3.  Eric’s pants is brown</li>
                <li> 4.  Eric is tall</li>
                <li> 5.  Eric wears formal shoes</li>
                
                </ul>
                <br>
                <p>The correct answer is 1 and 2. If people only wears a jacket with long pants, and Eric is wearing a jacket, then it proofs that Eric is wearing long pants.</p>
                <br>
                <b>If you understand the instructions, you may continue with the test. You have 5 minutes to complete this assessment. </b>
                <br>
                <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="introA()">Begin Test</button>
                </div>
                <div class="clearfix"></div>
                </div>
                
                <div id="slider" style="display:none">
                <form method="post" id="questions_form" action="<?= base_url(); ?>test/processTest7">
                <input type="hidden" name="type" value="secC"/>
                <input type="hidden" name="cat_id" value="<?= $catId;?>"/>
                <div style="font-size:18px; text-align: center;">Time Remaining: <span id="timer"></span></div>
                <ul class="questions_list" id="1">
                <?php foreach ($sectionThreeArr as $key => $secThreeArr) { ?>
                <li style="text-align: left;" id="slide<?= ++$key; ?>">
                <h3><?= $secThreeArr['qus']; ?></h3>
                <br/>
                <?php foreach ($secThreeArr['option'] as $ans => $option) { ?>
                <label>
                <input name="q<?= $key; ?>" type="checkbox" value="<?= $option; ?>"/>
                <span style="font-size:18px;"><?= $option; ?></span>
                </label>
                <br>
                <?php } ?>
                </li>
                <?php } ?>
                </ul>
                <a class="control_next btn btn-primary"  style="opacity: 1; top:60%;">Next</a>
                <a class="control_prev btn btn-primary" style="opacity: 1; top:60%;">Previous</a>
                </form>
                </div>
                </section>
                <?php } ?>
                <?php if($sacId=="D") { ?>
                <section style="background: #e1e1e1" class="content">
                <center><h1>Verbal Skills Test</h1></center>
                <div class="intro1" style="display:block;">
                <h2><u>Introduction</u></h2>
                <br/>
                <p style="font-size:20px; text-align:justify;">
                You have successfully completed section C. Please click on Continue to complete section D.
                </p>
                <div class="clearfix"></div>
                <br/>
                <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="introOne()">Continue</button>
                </div>
                </div>
                
                <div class="introA" style="display:none;">
                <h2><u>Section D | SYNONYMS</u></h2>
                <br/>
                <p style="font-size:20px; text-align:justify;">
                In the following questions you have to identify one option that is the most similar to the word presented. Select the option (either A, B, C, or D) that matches your answer. There is only one correct answer. The following examples will show you how to answer the questions.
                </p>
                <br>
                
                <h3>Example 1</h3>
                <br>
                <p>Which is most similar to Shirt</p>
                <br>
                <ul>
                <li>A. Blouse</li>
                <li>B. Pants</li>
                <li>C. Sock</li>
                <li>D. Shoe</li>
                </ul>
                <br>
                
                <p>The correct answer is A.</p>
                
                <!--  -->
                <br>
                <p>Example 2</p>
                <br/>
                <p>Which is most similar to Acceptable</p>
                <br>
                <ul>
                <li> A. Poor</li>
                <li> B. Average</li>
                <li> C. Adequate</li>
                <li> D. Welcome</li>
                </ul>
                <br>
                <p>The correct answer is C.</p>
                <br>
                <b>If you understand the instructions, you may continue with the test.</b>
                <br>
                <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="introA()">Begin Test</button>
                </div>
                <div class="clearfix"></div>
                </div>
                
                <div id="slider" style="display:none">
                <form method="post" id="questions_form" action="<?= base_url(); ?>test/processTest7">
                <input type="hidden" name="type" value="secD"/>
                <input type="hidden" name="cat_id" value="<?= $catId;?>"/>
                <div style="font-size:18px; text-align: center;"> <span id="timer"></span></div>
                <h3 class="text-center">Select the word that has THE SAME meaning as the given word.</h3>
                <ul class="questions_list" id="1" style="vertical-align: center;">
                <?php foreach ($sectionFourArr as $key => $secFourArr) { ?>
                <li id="slide<?= ++$key; ?>">
                <h3 class="text-center"><b><?= $secFourArr['qus']; ?></b></h3>
                <br/>
                <div class="row">
                <?php foreach ($secFourArr['option'] as $ans => $option) { ?>
                <div class="col-md-3">
                <label>
                <input name="q<?= $key; ?>" type="radio" value="<?= $option; ?>"/>
                <span style="font-size:18px;"><?= $option; ?></span><br/>
                </label>
                </div>
                <?php } ?>
                </div>
                </li>
                <?php } ?>
                </ul>
                <a class="control_next btn btn-primary"  style="opacity: 1; top:50%;">Next</a>
                <a class="control_prev btn btn-primary" style="opacity: 1; top:50%;">Previous</a>
                </form>
                </div>
                </section>
                <?php } ?>
                <?php if($sacId=="E"){ ?>
                <section style="background: #e1e1e1" class="content">
                <center><h1>Verbal Skills Test</h1></center>
                <div class="intro1" style="display:block;">
                <h2><u>Introduction</u></h2>
                <br/>
                <p style="font-size:20px; text-align:justify;">
                You have successfully completed section D. Please click on Continue to complete section E.
                </p>
                <div class="clearfix"></div>
                <br/>
                <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="introOne()">Continue</button>
                </div>
                </div>
                
                <div class="introA" style="display:none;">
                <h2><u>Section E | OPPOSITES</u></h2>
                <br/>
                <p style="font-size:20px; text-align:justify;">
                In the following questions you have to identify one option that is the Opposite of the word presented.  Select item A, B, C, or D that matches your answer. The following examples will show you how to answer the questions.
                </p>
                <br>
                
                <h3>Example 1</h3>
                <br>
                <p>Word: Difficult</p>
                <br>
                <ul>
                <li>A. Easy</li>
                <li>B. Worry</li>
                <li>C. Hard</li>
                <li>D. Quick</li>
                </ul>
                <br>
                
                <p>The correct answer is A.</p>
                
                <!--  -->
                <br>
                <p>Example 2</p>
                <br/>
                <p>Word: Best</p>
                <br>
                <ul>
                <li>A. Last</li>
                <li>B. First</li>
                <li>C. Worst</li>
                <li>D. Give</li>
                
                </ul>
                <br>
                <p>The correct answer is C.</p>
                <br>
                <b>Please select the word that means the OPPOSITE of the word provided. There is only one correct answer.</b>
                <br>
                <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="introA()">Begin Test</button>
                </div>
                <div class="clearfix"></div>
                </div>
                
                <div id="slider" style="display:none">
                <form method="post" id="questions_form" action="<?= base_url(); ?>test/processTest7">
                <input type="hidden" name="type" value="final"/>
                <input type="hidden" name="cat_id" value="<?= $catId;?>"/>
                <div style="font-size:18px; text-align: center;"><span id="timer"></span></div>
                <h3 class="text-center">Select the word that has THE OPPOSITE meaning as the given word.</h3>
                <ul class="questions_list" id="1" style="vertical-align: center;">
                <?php foreach ($sectionFiveArr as $key => $secFiveArr) { ?>
                <li id="slide<?= ++$key; ?>">
                <h3 class="text-center"><b><?= $secFiveArr['qus']; ?></b></h3>
                <br/>
                <div class="row">
                <?php foreach ($secFiveArr['option'] as $ans => $option) { ?>
                <div class="col-md-3">
                <label>
                <input name="q<?= $key; ?>" type="radio" value="<?= $option; ?>"/>
                <span style="font-size:18px;"><?= $option; ?></span><br/>
                </label>
                </div>
                <?php } ?>
                </div>
                </li>
                <?php } ?>
                </ul>
                <a class="control_next btn btn-primary"  style="opacity: 1; top:50%;">Next</a>
                <a class="control_prev btn btn-primary" style="opacity: 1; top:50%;">Previous</a>
                </form>
                </div>
                </section>
                <?php } ?>

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

            <?php if($sacId=="C"){ ?>
                if (validateInput != 2) 
                {
                 //   $('.control_next').attr('disabled','disabled');
                    alert("Please select Two Options.");
                    return false;
                }
            <?php } else { ?>
                if (validateInput == 0) 
                {
                 //   $('.control_next').attr('disabled','disabled');
                    return false;
                }
            <?php } ?>

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
        <?php if($sacId=="D" || $sacId=="E"){ ?>
//            sectionStartTimer3();
        <?php }
         elseif($sacId=="C"){ ?>
            sectionStartTimer2();
        <?php }
            elseif($sacId=="B"){ ?>
            sectionStartTimer4();
            <?php }
        else { ?>
            sectionStartTimer1();
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
        var minutes = 60 * 2, display = $('#timer');
        startTimer(minutes, display);
    }
    function sectionStartTimer2(){
        var minutes = 60 * 5, display = $('#timer');
        startTimer(minutes, display);
    }
    function sectionStartTimer3(){
        var minutes = 60 * 4, display = $('#timer');
        startTimer(minutes, display);
                }
                
function sectionStartTimer4(){
var minutes = 60 * 7, display = $('#timer');
startTimer(minutes, display);
}
</script>