<style type="text/css">
@import url(https://fonts.googleapis.com/css?family=Open+Sans:400,300,600);
            
            #slider {
            position: relative;
            overflow: hidden;
            margin: 20px auto 0 auto;
            border-radius: 4px;
            height: 550px !important;
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
            height: 550px !important;
            //background: #ccc;
            text-align: center;
            //line-height: 300px;
            }
            
            div.mblocks{
            position: absolute;
            top: 50%;
            z-index: 999;
            padding: 10px;
            height: auto;
            font-weight: 600;
            font-size: 16px;
            opacity: 0.8;
            cursor: pointer;
            }
            div.mblocks div{
            margin-left: 1px;
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
            <?php include_once 'include/test16_mira.php';?>
            <div class="content-wrapper">
            <section class="content-header">
            <!-- <h2>Matrices of Intellectual Reasoning (MIRA COMPLEX)</h2> -->
            </section>
            <section style="background: #ffffff" class="content">
            <center><h2>Matrices of Intellectual Reasoning (MIRA COMPLEX)</h2></center>
            <?php if ($sacId == "A") {?>
            <div class="intro1" style="display:block;">
            <h2><u>Introduction</u></h2>
            <br/>
            <p style="font-size:20px; text-align:justify;">
            <p>The Matrices of Intellectual Reasoning (MIRA COMPLEX) measures your ability to think conceptually and to solve problems. This test is divided into three sections:</p>
            <p>Section A has 13 questions and a time limit of 13 minutes</p>
            <p>Section B has 11 questions and a time limit of 11 minutes</p>
            <p>Section C is in a game format with no time limit, but usually takes about 30 minutes to complete.</p>
            <br>
            <p>Please click on the Instructions button below to go to the instructions for section A.</p>
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
            <img src="<?=base_url() . 'images/mira_complex_sec_a/sec-a-img.png'?>" height="150" width="700">
            
            <div class="clearfix"></div>
            <br/>
            <p style="font-size:20px; text-align:justify;">
            The correct answer in this example is option "A". You will notice that in row 1 and row 3, the images turn anti-clockwise.
            
            When you are ready, please click on Begin Test to start with Section A.
            </p>
            <div style="text-align: center;">
            <button type="button" class="btn btn-primary" onclick="introA(13)">Begin Test</button>
            </div>
            </div>
            
            <div id="slider" style="display:none">
            <form method="post" id="questions_form" action="<?=base_url();?>test/processTest16">
            <input type="hidden" name="type" value="secA"/>
            <input type="hidden" name="cat_id" value="<?=$catId;?>"/>
            <div style="font-size:18px; text-align: center;">Time Remaining: <div id="timer"></div></div>
            <ul class="questions_list" id="1">
            <?php foreach ($sectionOneArr as $key => $secOneArr) {?>
            <li style="text-align: center; id="slide<?=++$key;?>">
            <h4><img src="<?=base_url() . 'images/mira_complex_sec_a/' . $secOneArr['img'] . '.png';?>" height="220" width="330"></h4>
            <br/>
            <div class="row">
            <?php foreach ($secOneArr['option'] as $ans => $option) {?>
            <div class="col-md-3">
            <label>
            <img src="<?=base_url() . 'images/mira_complex_sec_a/' . $option . '.jpg'?>" height="80"><br>
            <input name="q<?=$key;?>" type="radio" value="<?=$ans;?>"/>
            </label>
            </div>
            <?php }?>
            </div>
            </li>
            <?php }?>
            </ul>
            <a class="control_next btn btn-primary"  style="opacity: 1;">Next</a>
            <a class="control_prev btn btn-primary" style="opacity: 1;">Previous</a>
            </form>
            </div>
            <?php }?>
            <?php if ($sacId == "B") {?>
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
            <img src="<?=base_url() . 'images/mira_complex_sec_b/sec-b-img.png'?>" height="250" width="100%">
            
            <div class="clearfix"></div>
            <br/>
            <p style="font-size:20px; text-align:justify;">
            The correct answer in this example is "B". The image in the outer circle is moving clock-wise, on block at a time.
            
            When you are ready, please click on Begin Test to start with Section B
            </p>
            <div style="text-align: center;">
            <button type="button" class="btn btn-primary" onclick="introA(11)">Begin Test</button>
            </div>
            </div>
            
            <div id="slider" style="display:none">
            <div style="font-size:18px; text-align: center;">Time Remaining: <div id="timer"></div></div>
            <form method="post" id="questions_form" action="<?=base_url();?>test/processTest16">
            <input type="hidden" name="type" value="secB"/>
            <input type="hidden" name="cat_id" value="<?=$catId;?>"/>
            <ul class="questions_list" id="1">
            <?php foreach ($sectionTwoArr as $key => $secOneArr) {?>
            <li style="text-align: center; id="slide<?=++$key;?>">
            <h4><img src="<?=base_url() . 'images/mira_complex_sec_b/' . $secOneArr['img'] . '.jpg';?>" height="220" width="600"></h4>
            <br/>
            <div class="row">
            <?php foreach ($secOneArr['option'] as $ans => $option) {?>
            
            <div class="col-md-4">
            <label>
            <img src="<?=base_url() . 'images/mira_complex_sec_b/' . $option . '.jpg'?>" height="150"><br>
            <input name="q<?=$key;?>" type="radio" value="<?=$ans;?>"/>
            </label>
            </div>
            
            
            <?php }?>
            </div>
            </li>
            <?php }?>
            </ul>
            <a class="control_next btn btn-primary"  style="opacity: 1;">Next</a>
            <a class="control_prev btn btn-primary" style="opacity: 1;">Previous</a>
            </form>
            </div>
            <?php }?>
            <?php if ($sacId == "C") {?>
            <div class="intro1" style="display:block;"><br>
            <h3 class="text-center"><u>You have successfully completed section B. Please click on Continue to complete section C.</u></h2>
            <div class="clearfix"></div>
            
            <div style="text-align: center;">
            <button type="button" class="btn btn-primary" onclick="introOneC()">Continue</button>
            </div>
            </div>
            
            <div class="intro2" style="display: none;">
            <h2><u>Instructions | Section C</u></h2>
            <br/>
            <ul>
            <li><h3>In this section you are required to sort a deck of cards into 5 different boxes.</h3></li>
            
            <li><h3>You must decide in which box each card must go, after which the system will give you feedback.</h3></li>
            
            <li><h3>The boxes are labeled A, B, C, D and E. </h3></li>
            
            <li><h3>The system will indicate if you selected the correct or incorrect box, except for Box E where you will not receive feedback. </h3></li>
            
            <li><h3>You cannot go back to the previous question or review previous answers. Once you selected a box, the system will give you feedback and immediately continue to the next card. </h3></li>
            
            
            </ul>
            <div class="clearfix"></div>
            <div style="text-align: center;">
            <button type="button" class="btn btn-primary" onclick="introTwoC()">Next</button>
            </div>
            </div>
            
            <div class="intro3" style="display: none;">
            <div class="row text-center">
            <div class="col-md-4 col-md-offset-4">
            <img width="182" height="252" src="<?=base_url() . 'images/RAP_MIRA_COMPLEX/example_card.png'?>" id="exmImg" data-idd="3" /><br>
            </div>
            </div>
            <br>
            
            <div class="row">
            <div class="col-md-12 text-center">
            <h2 id="exmresult" class="text-info">
            <p>To demonstrate how you will receive feedback on your answers, the system will ask you to select specific boxes that will show you what to expect when you do this test. You have to decide in which box this card must go. For the sake of this example, let’s assume the correct box is box C. Please move this card to box C.</p>
            </h2>
            </div>
            
            <div class="col-md-1"></div>
            
            <div class="col-md-2 text-center">
            <label>
            <img width="80" height="80" src="<?=base_url() . 'images/RAP_MIRA_COMPLEX/block/box_A.png'?>" alt="" class="img img-responsive">
            <input name="section" class="sectionCExm" type="checkbox" value="1"/>
            </label>
            </div>
            
            <div class="col-md-2 text-center">
            <label>
            <img width="80" height="80" src="<?=base_url() . 'images/RAP_MIRA_COMPLEX/block/box_B.png'?>" alt="" class="img img-responsive">
            <input name="section" class="sectionCExm" type="checkbox" value="2"/>
            </label>
            </div>
            
            <div class="col-md-2 text-center">
            <label>
            <img width="80" height="80" src="<?=base_url() . 'images/RAP_MIRA_COMPLEX/block/box_C.png'?>" alt="" class="img img-responsive">
            <input name="section" class="sectionCExm" type="checkbox" value="3"/>
            </label>
            </div>
            
            <div class="col-md-2 text-center">
            <label>
            <img width="80" height="80" src="<?=base_url() . 'images/RAP_MIRA_COMPLEX/block/box_D.png'?>" alt="" class="img img-responsive">
            <input name="section" class="sectionCExm" type="checkbox" value="4"/>
            </label>
            </div>
            
            <div class="col-md-2 text-center">
            <label>
            <img width="80" height="80" src="<?=base_url() . 'images/RAP_MIRA_COMPLEX/block/box_E.png'?>" alt="" class="img img-responsive">
            <input name="section" class="sectionCExm" type="checkbox" value="5"/>
            </label>
            </div>
            
            <div class="col-md-1"></div>
            </div>
            
            <br>
            <div class="row">
            <div class="col-md-10  col-md-offset-1">
            <button type="button" class="btn btn-primary pull-right" style="display: none;" id="introM" onclick="introM()">Continue</button>
            </div>
            </div>
            
            </div>
            <div class="clearfix"></div>
            
            <div class="intro4" style="display: none;">
            <h2>Before you begin, please note the following:</h2>
            <br/>
            <ul>
            <li>This test has no time limit, however, please do not spend too much time on a question.</li>
            
            <li>If you are unsure about how to do the test, please go back and read the instructions carefully before starting this test. Once you start this test, you will not be able to go back to the instructions. </li>
            
            <li>You are not allowed to make any notes. Everything must be done in your head. </li>
            
            <li>Remember, this test is not about passing or failing, but learning more about your problem solving styles.</li>
            
            </ul>
            <div class="clearfix"></div>
            <div style="text-align: left;">
            <button type="button" class="btn btn-primary pull-left" onclick="backCA()">Back to Instruction</button>
            <button type="button" class="btn btn-primary pull-right" onclick="introC()">Begin Test</button>
            </div>
            <br><br>
            </div>
            
            <div id="slider" style="display:none; height: 550px !important;">
            <center>
            <!-- <div style="font-size:18px; text-align: center;">Time Remaining: <div id="timer"></div></div> -->
            <form method="post" id="questions_form" action="<?=base_url();?>test/processTest16">
            <input type="hidden" name="type" value="final"/>
            <input type="hidden" name="cat_id" value="<?=$catId;?>"/>
            <input type="hidden" name="total_moves" id="total_moves">
            <input type="hidden" name="total_correct" id="total_correct">
            <input type="hidden" name="average_time" id="average_time">
            <input type="hidden" name="block_sequence" id="block_sequence">
            <input type="hidden" name="total_nff" id="total_nff">
            </form>
            <ul class="" id="1">
            <?php foreach ($sectionThreeArr as $key => $cards) {?>
            <li style="text-align: center;" id="slide<?=++$key;?>" data-idd="<?=$cards['ans']?>">
            <div class="col-md-4 col-md-offset-4">
            <img height="352" src="<?=base_url() . 'images/MIRACOMPLEX_2/' . $cards['card']?>"><br>
            </div>
            </li>
            <?php }?>
            </ul>
            
            <div class="row mblocks">
            <div class="col-md-12">
            <h2 id="cresult" style="color: red;"></h2>
            </div>
            
            <div class="col-md-1"></div>
            
            <div class="col-md-2 text-center">
            <label>
            <img src="<?=base_url() . 'images/RAP_MIRA_COMPLEX/block/box_A.png'?>" alt="" class="img img-responsive">
            <input name="section" class="sectionCAns" type="checkbox" value="1"/>
            </label>
            </div>
            
            <div class="col-md-2 text-center">
            <label>
            <img src="<?=base_url() . 'images/RAP_MIRA_COMPLEX/block/box_B.png'?>" alt="" class="img img-responsive">
            <input name="section" class="sectionCAns" type="checkbox" value="2"/>
            </label>
            </div>
            
            <div class="col-md-2 text-center">
            <label>
            <img src="<?=base_url() . 'images/RAP_MIRA_COMPLEX/block/box_C.png'?>" alt="" class="img img-responsive">
            <input name="section" class="sectionCAns" type="checkbox" value="3"/>
            </label>
            </div>
            
            <div class="col-md-2 text-center">
            <label>
            <img src="<?=base_url() . 'images/RAP_MIRA_COMPLEX/block/box_D.png'?>" alt="" class="img img-responsive">
            <input name="section" class="sectionCAns" type="checkbox" value="4"/>
            </label>
            </div>
            
            <div class="col-md-2 text-center">
            <label>
            <img src="<?=base_url() . 'images/RAP_MIRA_COMPLEX/block/box_E.png'?>" alt="" class="img img-responsive">
            <input name="section" class="sectionCAns" type="checkbox" value="5"/>
            </label>
            </div>
            
            <div class="col-md-1"></div>
            
            </div>
            
            </center>
            
            
            </div>
            <?php }?>
            </section>
            </div>
            
            <script type="text/javascript">
            var secondsC = 0;
            var slid = 1;
            var correctC = 0;
            var correctTotal = 0;
            var total_nff = 0;
            var cblock = [];
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
                              };
                              
                              function moveRight() {
                              $('#slider ul').animate({
                                                      left: -slideWidth
                                                      }, 500, function () {
                                                      $('#slider ul li:first-child').appendTo('#slider ul');
                                                      $('#slider ul').css('left', '');
                                                      });
                              };
                              
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
                              
                              // Section C
                              var exmC = 0;
                              var exmI = 0;
                              var exm5 = 0;
                              
                              $(".sectionCExm").on('click',function(){
                                                   $(".sectionCExm").prop('disabled','disabled');
                                                   
                                                   var correct = $("#exmImg").attr('data-idd');
                                                   var selected = $(this).val();
                                                   var msg = '';
                                                   var msg1 = '';
                                                   
                                                   if(correct == selected)
                                                   {
                                                   exmC++;
                                                   msg = '<p class="text-success">Correct !</p>';
                                                   msg1 = '<p>You will notice that the system indicated that this was the correct answer. Now, please move the card to box A.</p>';
                                                   }
                                                   else{
                                                   $("#exmresult").html('');
                                                   exmI++;
                                                   msg = '<p class="text-danger">Incorrect !</p>';
                                                   msg1 = '<p>You will notice that the system indicated that this was the incorrect answer. Now, please move the card to box E.</p>';
                                                   }
                                                   
                                                   if(selected == 5)
                                                   {
                                                   exm5++;
                                                   msg = "<p>You will notice that the system did not give you any feedback. You will recall from your instructions that you will only receive feedback from boxes A, B, C and D.</p>";
                                                   msg1 = '<p>You will notice that the system did not give you any feedback. You will recall from your instructions that you will only receive feedback from boxes A, B, C and D.</p>';
                                                   }
                                                   // if(selected != 3 && selected != 5)
                                                   // {
                                                   //     $("#exmresult").html('');
                                                   // }
                                                   $("#exmresult").prepend(msg);
                                                   setTimeout(function(){
                                                              if (selected == 3) {
                                                              $("#exmresult").html('');
                                                              }
                                                              
                                                              if(selected == 3){
                                                              $("#exmresult").prepend(msg1);
                                                              }
                                                              else if (selected == 5) {}
                                                              else{
                                                              $("#exmresult").append(msg1);
                                                              }
                                                              
                                                              if (selected != 5) {
                                                              $(".sectionCExm").prop('disabled',false);
                                                              $(".sectionCExm").removeAttr('checked');
                                                              }
                                                              
                                                              if(exmC > 0 && exmI > 0 && exm5 > 0)
                                                              {
                                                              $('#introM').css('display','block');
                                                              }
                                                              }, 5000);
                                                   
                                                   });
                              
                              $(".sectionCAns").on('click',function(){
                                                   $(".sectionCAns").prop('disabled','disabled');
                                                   var correct = $("#slide"+slid).attr('data-idd');
                                                   var selected = $(this).val();
                                                   var flag = 0;
                                                   cblock.push(selected);
                                                   if(correct == selected)
                                                   {
                                                   correctC++;
                                                   correctTotal++;
                                                   flag=1;
                                                   }
                                                   if(selected != 5){
                                                   if(flag==1)
                                                   {
                                                   $("#cresult").prepend('<p class="text-success">Correct !</p>');
                                                   } else {
                                                   correctC = 0;
                                                   $("#cresult").prepend('<p class="text-danger">Incorrect !</p>');
                                                   }
                                                   } else if(selected == 5){
                                                      if(total_nff <= 20){
                                                            total_nff++;
                                                      }
                                                   }
                                                   setTimeout(function(){
                                                              $(".sectionCAns").prop('checked',false);
                                                              $("#cresult").html('');
                                                              if(correctC == 7 || slid == 156)
                                                              {
                                                              var ctime = secondsC;
                                                              
                                                              var average_time = (ctime-(slid*5))/slid;
                                                              
                                                              $("#total_moves").val(slid);
                                                              $("#total_correct").val(correctTotal);
                                                              $("#average_time").val(average_time);
                                                              $("#block_sequence").val(cblock);
                                                              $("#total_nff").val(total_nff);
                                                              
                                                              $("#questions_form").submit();
                                                              return;
                                                              }
                                                              slid++;
                                                              moveRight();
                                                              $(".sectionCAns").prop('disabled',false);
                                                              }, 4000);
                                                   });
                              });
            </script>
            <script>
            function introOneC() {
            $('.intro1').hide();
            $('.intro2').css('display','block');
            }
            
            function introTwoC() {
            $('.intro2').hide();
            $('.intro3').css('display','block');
            }
            
            function introThreeC() {
            $('.intro3').hide();
            $('.intro4').css('display','block');
            }
            
            function introOne() {
            $('.intro1').hide();
            $('.introA').css('display','block');
            }
            
            function introA(timer) {
            $('.intro1').hide();
            $('.introA').hide();
            $('#slider').show();
            sectionStartTimer(timer);
            }
            
            function sectionStartTimer(timer) {
            var minutes = 60 * timer, display = $('#timer');
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
            
            // Section C
            
            function introC() {
            $('.intro1').hide();
            $('.intro4').hide();
            $('.introA').hide();
            $('#slider').show();
            sectionStartCTimer();
            }
            
            function introM(){
            msg = '';
            msg1 = '';
            exmC = 0;
            exmI = 0;
            exm5 = 0;
            $(".sectionCExm").prop('disabled',false);
            $(".sectionCExm").removeAttr('checked');
            $("#introM").hide();
            $("#exmresult").html('<p>To demonstrate how you will receive feedback on your answers, the system will ask you to select specific boxes that will show you what to expect when you do this test. You have to decide in which box this card must go. For the sake of this example, let’s assume the correct box is box C. Please move this card to box C.</p>');
            $('.intro3').hide();
            $('.intro4').show();
            }
            
            function backCA(){
            $('.intro2').show();
            $('.intro3').hide();
            $('.intro4').hide();
            $('.introA').hide();
            $('#slider').hide();
            }
            
            function sectionStartCTimer() {
            setInterval(function(){
                        secondsC++;
                        },1000);
            }
            </script>
