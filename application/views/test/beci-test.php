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
       // height: 440px;
    }
    .intro2{
        height: 470px;
    }

    .circle {
        border-radius: 25px;
        height: 20px;
        margin-left: 0px;
        width: 20px;
        //padding: 3px;
        padding-left: 5px;
        padding-right: 0px;
        border: #06C solid 1px;
        background: #39F none repeat scroll 0 0;
        color: #FFFFFF;
        cursor: pointer;
    }
    .active {
        background: #900 none repeat scroll 0 0;
    }
</style>

<?php include_once 'include/test1_info.php'; ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Electrical Skills Test (EST)</h1>
    </section>

    <section style="background: #e1e1e1" class="content">
        <div class="intro1" style="display:block;">
            <h2><u>Section A Instructions</u></h2>
            <br/>
            <ul style="font-size: 16px;">
                <li>You will be presented with 5 statements. Please read the statements carefully and rate the questions on how much it applies to you. </li>
                <li>You can only select a rating score once per page, e.g. when you allocate a score of 8 to question 1, you won’t be allowed to allocate a score of 8 again to another question on the same page.</li>
            </ul><br />
            <img  class="img-responsive" src="<?= base_url() ?>images/instructions.png" width="80%" style="" height="600" /><br /><br /><br/>
            <ul style="font-size: 16px;">
                <li>The scoring in the above image shows question 1 and 3 were rated a 10 which is not allowed.</li>
                <li>Any score may only be used once as indicated in Example A</li>
                <li>The system will not allow you to select the same number twice on the same page</li>
                <li>If you understand the instructions, please click on Continue.</li>
            </ul>
            <div class="clearfix"></div>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="introOne()">Begin Test</button>
            </div>

        </div>
        
        <div id="slider" style="display:none">
            <form method="post" id="questions_form" action="<?= base_url(); ?>test/processTest1">
                <input type="hidden" name="type" value="secA"/>
                <input type="hidden" name="cat_id" value="<?= $catId;?>"/>
                <!--  -->
                <ul class="questions_list" id="1">
                    <li style="text-align: left" id="slide1">
                        <table width="100%" class="table table-bordered">
                            <tr>
                                <th width="63%" align="left" style="background:#CCCCCC; font-size:20px;">Questions</th>
                                <th width="37%" align="left" style="background:#CCCCCC; font-size:20px;">Answer</th>
                            </tr>
                    <?php 
                    $key=0; $j=0;
                    for ($i=1; $i <= count($sectionOneArr) ; $i++) {
                            
                            if($j == 4){
                        ?>
                            </table>
                        </li>
                            <li style="text-align: left" id="slide<?= ++$key; ?>" class="table-responsive">
                                <table width="100%" class="table">
                                    <tr>
                                        <th width="63%" align="left" style="background:#CCCCCC; font-size:20px;">Questions</th>
                                        <th width="37%" align="left" style="background:#CCCCCC; font-size:20px;">Answer</th>
                                    </tr>
                            <?php $j=0; }?>
                                    <tr class="info">
                                        <td><?= $i.". ".$sectionOneArr[$i] ?></td>
                                        <td>
                                            <?php

                                                echo '<label class="circle " id="quesBox_'.$i.'_1" >1&nbsp;&nbsp; <input type="radio" id="quesAns_'.$i.'_1"  name="quesAns['.$i.']" value="1" style="display:none;" /></label>&nbsp;&nbsp;';

                                                echo '<label class="circle " id="quesBox_'.$i.'_2" >2&nbsp;&nbsp; <input type="radio" id="quesAns_'.$i.'_2"  name="quesAns['.$i.']" value="2" style="display:none;" /></label>&nbsp;&nbsp;';

                                                echo '<label class="circle " id="quesBox_'.$i.'_3" >3&nbsp;&nbsp; <input type="radio" id="quesAns_'.$i.'_3"  name="quesAns['.$i.']" value="3" style="display:none;" /></label>&nbsp;&nbsp;';

                                                echo '<label class="circle " id="quesBox_'.$i.'_4" >4&nbsp;&nbsp; <input type="radio" id="quesAns_'.$i.'_4"  name="quesAns['.$i.']" value="4" style="display:none;" /></label>&nbsp;&nbsp;';

                                                echo '<label class="circle " id="quesBox_'.$i.'_5" >5&nbsp;&nbsp; <input type="radio" id="quesAns_'.$i.'_5"  name="quesAns['.$i.']" value="5" style="display:none;" /></label>&nbsp;&nbsp;';

                                                echo '<label class="circle " id="quesBox_'.$i.'_6" >6&nbsp;&nbsp; <input type="radio" id="quesAns_'.$i.'_6"  name="quesAns['.$i.']" value="6" style="display:none;" /></label>&nbsp;&nbsp;';

                                                echo '<label class="circle " id="quesBox_'.$i.'_7" >7&nbsp;&nbsp; <input type="radio" id="quesAns_'.$i.'_7"  name="quesAns['.$i.']" value="7" style="display:none;" /></label>&nbsp;&nbsp;';

                                                echo '<label class="circle " id="quesBox_'.$i.'_8" >8&nbsp;&nbsp; <input type="radio" id="quesAns_'.$i.'_8"  name="quesAns['.$i.']" value="8" style="display:none;" /></label>&nbsp;&nbsp;';

                                                echo '<label class="circle " id="quesBox_'.$i.'_9" >9&nbsp;&nbsp; <input type="radio" id="quesAns_'.$i.'_9"  name="quesAns['.$i.']" value="9" style="display:none;" /></label>&nbsp;&nbsp;';

                                                echo '<label class="circle " id="quesBox_'.$i.'_10" style="padding-left: 2px !important;" >10&nbsp;&nbsp; <input type="radio" id="quesAns_'.$i.'_10"  name="quesAns['.$i.']" value="10" style="display:none;" /></label>&nbsp;&nbsp;';
                                            ?>
                                        </td>
                                    </tr>     
                    <?php $j++;  } ?>
                            </table>
                        </li>
                </ul>
                <a class="control_next btn btn-primary" disabled  style="opacity: 1;">Next</a>
                <a class="control_prev btn btn-primary" style="opacity: 1;">Previous</a>
            </form>
        </div>
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

        function validate()
        {
            var UL = $(".questions_list").attr("id");
            <?php if($sacId=="A"){    ?>
            var firstli = (Number(UL) * 5) - 4;
            <?php } if($sacId=="B"){ ?>
            var firstli = (Number(UL) * 4) - 3;
            <?php } ?>
            
            
            var flag=0;
            <?php if($sacId=="A"){    ?>
            var to=5;
            <?php } if($sacId=="B"){ ?>
            var to=4;
            <?php } ?>

            var valarr=new Array();

            for (var i = firstli; i <= (firstli+to); i++)
            {
                var val=$('input[name="quesAns['+ i +']"]:checked').val();

                if($.inArray(Number(val),valarr) > -1)
                {
                    flag++;
                }

                if(val != undefined)
                {
                    valarr.push(Number(val));        
                }
            }
            console.log(valarr);
            
            if(valarr.length < to)
            {
                alert("Please Give Answer For All Questions.");
                return 0;
            }

            if(flag > 0)
            {
                alert("You are not allowed to select the same number more than once.");
                return 0;
            }
            return 1;
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
            var validateInput = validate();

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

        $('.circle').click(function(){
            $(this).css('background-color','red');
        });

        var checkboxes = $('input[type=radio]:checked');
        $('input[type=radio]')
          .click(function() {
            checkboxes.filter(':not(:checked)').trigger('deselect');
            checkboxes = $('input[type=radio]:checked')
          });
          
          $('input[type=radio]').bind('deselect', function () {
            $(this).parent('.circle').css('background-color','#39F');
        });
    });
    
</script>

<script type="text/javascript">
    function introOne() {
        $('.intro1').hide();
        $('#slider').show();
    };
</script>