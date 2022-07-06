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
        <?php if($sacId!="D") { ?>
        height: 670px;
        <?php } else { ?>
        height: 390px;
        <?php } ?>
        //background: #ccc;
        text-align: center;
        //line-height: 300px;
    }

    a.control_prev, a.control_next {
        position: absolute;
        <?php if($sacId!="D") { ?>
        top: 90%;
        <?php } ?>
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
<?php require_once("include/error_checking_info.php"); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1></h1>
    </section>

    <?php if($sacId=="A"){ ?>
    <section style="background: #ffffff" class="content">
        <center><h1>Accuracy Skills Test (AST)</h1></center>
        <div class="intro1" style="display:block;">
            <h2><u>Section A</u></h2><br>
            <h2><u>Introduction</u></h2>
            <br/>
            <ul>
                <li>This test has been designed to measure your ability to spot errors and accurately transfer information from one table to the next.</li>
                <li>Please read the instructions carefully before continuing with the tests.</li>
                <li>Click on Continue....</li>
            </ul>
            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="introOne()">Continue</button>
            </div>

        </div>
        <div class="intro2" style="display:none;">
            <h2>Section A</h2>
            <br/>
            <ul>
                <li>In this section you will see two tables. The second table is transposed from the first table. Compare the two tables and answer the questions that follows.</li>
                <li>There is no time-limit</li>
                <li>If you are ready, click on Begin Test.</li>
            </ul>
            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="introTwo()">Begin Test</button>
            </div>

        </div>
        
        <div id="slider" style="display:none;">
            <form method="post" id="questions_form" action="<?= base_url(); ?>test/processTest10">
                <input type="hidden" name="type" value="secA"/>
                <input type="hidden" name="cat_id" value="<?= $catId;?>"/>
                <table width="90%" border="2" class="" align="center" style="margin:0 auto;margin-top:15px;">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Surname</th>
                            <th>Email</th>
                            <th>Telephone</th>
                            <th>Area</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Suzanne</td>
                            <td>Kirkwood</td>
                            <td>skirkwoord@hibbit.com</td>
                            <td>27 01153311220</td>
                            <td>Joburg</td>
                        </tr>
                        <tr>
                            <td>Elizabeth</td>
                            <td>Smith</td>
                            <td>esmith@trueme.co.au</td>
                            <td>55 05142333090</td>
                            <td>New York</td>
                        </tr>
                        <tr>
                            <td>Graeme</td>
                            <td>Martinez</td>
                            <td>graemem@globals.net</td>
                            <td>45 09233097400</td>
                            <td>London</td>
                        </tr>
                        <tr>
                            <td>Frederick</td>
                            <td>Robenson</td>
                            <td>fredrob@mikerowsof.com</td>
                            <td>39 08655450001</td>
                            <td>Singapore</td>
                        </tr>
                        <tr>
                            <td>Patrick</td>
                            <td>Patricks</td>
                            <td>ppatrick@typelas.co.sa</td>
                            <td>17 01200300200</td>
                            <td>Canada</td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <table width="90%" border="2" align="center">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Surname</th>
                            <th>Email</th>
                            <th>Telephone</th>
                            <th>Area</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Suzane</td>
                            <td>Kirkwood</td>
                            <td>skirkwoord@hobbit.com</td>
                            <td>+27 01153331220</td>
                            <td>Joburg</td>
                        </tr>
                        <tr>
                            <td>Grahame</td>
                            <td>Martines</td>
                            <td>graemem@globals.net</td>
                            <td>+45 09233097400</td>
                            <td>London</td>
                        </tr>
                        <tr>
                            <td>Patrick</td>
                            <td>Patrics</td>
                            <td>patrickp@typelas.co.za</td>
                            <td>+17 01200330200</td>
                            <td>Canada</td>
                        </tr>
                        <tr>
                            <td>Elisabeth</td>
                            <td>Smit</td>
                            <td>esmith@trueme.com</td>
                            <td>+55 05142333090</td>
                            <td>Singapore</td>
                        </tr>
                        <tr>
                            <td>Frederick</td>
                            <td>Robinson</td>
                            <td>fredrob@mikerowsoft.com</td>
                            <td>+39 08655450001</td>
                            <td>New York</td>
                        </tr>
                    </tbody>
                </table>
                <h2 class="text-center" style="color:#666;">Looking at the transposed table (table 2), answer the following questions</h2>
                <br>
                <ul class="questions_list" id="1">
                    <?php foreach ($sectionOneArr as $key => $secOneArr) { ?>
                        <li style="text-align: left" id="slide<?= ++$key; ?>">
                            <h2 class="text-center"><?= $secOneArr['qus']; ?></h2>
                            <br/>
                            <div class="row text-center">
                            <?php foreach ($secOneArr['option'] as $ans => $option) { ?>
                                <div class="col-md-4">
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
        <section style="background: #e1e1e1" class="content">
        <center><h1>Accuracy Skills Test (AST)</h1></center>
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
            <h2>Section B</h2>
            <br/>
            <h4>Instructions</h4>
            <br>
            <ul>
                <li>In this section you will see two tables. The second table is transposed from the first table. Compare the two tables and answer the question that follows.</li>
                <li>When you are ready, please click on Begin Test.</li>
            </ul>
            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="introTwo()">Continue</button>
            </div>

        </div>
        
        <div id="slider" style="display:none">
            <form method="post" id="questions_form" action="<?= base_url(); ?>test/processTest10">
                <input type="hidden" name="type" value="secB"/>
                <input type="hidden" name="cat_id" value="<?= $catId;?>"/>
                <div>
                <table width="90%" border="2" class="" align="center" style="margin:0 auto;margin-top:15px;">
                    <tbody><tr>
                        <th>&nbsp;</th>
                        <th>2008</th>
                        <th>2009</th>
                        <th>2010</th>
                        <th>2011</th>
                        <th>2012</th>
                    </tr>
                    <tr>
                        <td><strong>Soap</strong></td><td>844</td><td>580</td><td>759</td><td>623</td><td>87</td>
                    </tr>
                    <tr>
                        <td><strong>Clothes</strong></td><td>904</td><td>141</td><td>276</td><td>209</td><td>761</td>
                    </tr>
                    <tr>
                        <td><strong>Games</strong></td><td>630</td><td>309</td><td>733</td><td>534</td><td>95</td>
                    </tr>
                    <tr>
                        <td><strong>Beds</strong></td><td>592</td><td>680</td><td>533</td><td>756</td><td>242</td>
                    </tr>
                    <tr>
                        <td><strong>Electronics</strong></td><td>396</td><td>63</td><td>248</td><td>612</td><td>4</td>
                    </tr>
                    <tr>
                        <td><strong>Furniture</strong></td><td>87</td><td>378</td><td>17</td><td>443</td><td>45</td>
                    </tr>
                    <tr>
                        <td><strong>Cell phones</strong></td><td>869</td><td>37</td><td>603</td><td>125</td><td>492</td>
                    </tr>
                    <tr>
                        <td><strong>Food</strong></td><td>684</td><td>434</td><td>602</td><td>514</td><td>384</td>
                    </tr>
                </tbody></table>
                <table width="90%" border="2" class="" align="center" style="margin:0 auto;margin-top:15px;">
                    <tbody><tr>
                        <th>&nbsp;</th>
                        <th>Soap</th>
                        <th>Clothes</th>
                        <th>Games</th>
                        <th>Beds</th>
                        <th>Electronics</th>
                        <th>Furniture</th>
                        <th>Cell phones</th>
                        <th>Food</th>
                    </tr>
                    <tr>
                        <td><strong>2008</strong></td><td>844</td><td>904</td><td>630</td><td>592</td><td>396</td><td>78</td><td>896</td><td>684</td>
                    </tr>
                    <tr>
                        <td><strong>2009</strong></td><td>580</td><td>414</td><td>309</td><td>680</td><td>63</td><td>378</td><td>73</td><td>343</td>
                    </tr>
                    <tr>
                        <td><strong>2010</strong></td><td>759</td><td>276</td><td>733</td><td>533</td><td>248</td><td>7</td><td>603</td><td>602</td>
                    </tr>
                    <tr>
                        <td><strong>2011</strong></td><td>632</td><td>290</td><td>534</td><td>756</td><td>612</td><td>433</td><td>125</td><td>541</td>
                    </tr>
                    <tr>
                        <td><strong>2012</strong></td><td>87</td><td>761</td><td>95</td><td>242</td><td>4</td><td>45</td><td>492</td><td>483</td>
                    </tr>
                </tbody></table>
            </div>
                <h2 class="text-center" style="color: #666;">Looking at the transposed table (table 2), how many mistakes do you spot in:</h2>
                <ul class="questions_list" id="1">
                    <?php foreach ($sectionTwoArr as $key => $secTwoArr) { ?>
                        <li style="text-align: left; height: 700px;" id="slide<?= ++$key; ?>">
                            <h3 class="text-center"><?= $secTwoArr['qus']; ?></h3>
                            <br/>
                            <div class="row text-center">
                            <?php foreach ($secTwoArr['option'] as $ans => $option) { ?>
                                <div class="col-md-2">
                                <label>
                                    <input name="q<?= $key; ?>" type="radio" value="<?= ++$ans; ?>"/>
                                    <span style="font-size:18px;"><?= $option; ?></span><br/>
                                </div>
                                </label>
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
        <section style="background: #e1e1e1" class="content">
        <center><h1>Accuracy Skills Test (AST)</h1></center>
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
            <h2>Section C | Typing Accuracy</h2>
            <br/>
            <h4>Instructions</h4>
            <br>
            <ul>
                <li>In this test you will be provided with columns where you have to retype certain information. You must retype the information EXACTLY as per table.</li>
                <li>Please click on Continue when you are ready.</li>
            </ul>
            <br>
            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="introTwo()">Continue</button>
            </div>

        </div>
        
        <div id="slider" style="display:none">
            <form method="post" id="questions_form" action="<?= base_url(); ?>test/processTest10">
                <input type="hidden" name="type" value="secC"/>
                <input type="hidden" name="cat_id" value="<?= $catId;?>"/>
                <div class="text-center">
                    <img src="<?= base_url() ?>/images/errchk_question.png" height="300" alt="">
                </div>
                <br>
                <ul class="questions_list" id="1">
                    <?php foreach ($sectionThreeArr as $key => $secThreeArr) { ?>
                        <li style="text-align: left" id="slide<?= ++$key; ?>">
                            <h3 class="text-center"><?= $secThreeArr['qus']; ?></h3>
                            <br/>
                            <div class="text-center">
                                <span>Answer : </span> <input type="text" class="qtext" name="q<?php echo $key; ?>" id="q_<?php echo $key; ?>" autocomplete="off" />
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
        <section style="background: #e1e1e1" class="content">
        <center><h1>Accuracy Skills Test (AST)</h1></center>
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
            <h2>Section D | Spelling</h2>
    
            <h4>Instructions</h4>
            
            <ul>
                <li>In this section you will be presented with four common English words. You have to select the word that is spelt correctly.</li>
                <li>Please click on Continue to start with the test.</li>
            </ul>
            <br>
            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="introTwo()">Continue</button>
            </div>

        </div>
        
        <div id="slider" style="display:none">
            <form method="post" id="questions_form" action="<?= base_url(); ?>test/processTest10">
                <input type="hidden" name="type" value="final"/>
                <input type="hidden" name="cat_id" value="<?= $catId;?>"/>
                <br>
                <ul class="questions_list" id="1">
                    <?php 
                    $number_to_alpha_options = array("0" => "a", "1" => "b", "2" => "c", "3" => "d");
                    foreach ($sectionFourArr as $key => $secFourArr) { ?>
                            <li style="text-align: left;height: 600px !important;" id="slide<?= ++$key; ?>">
                                <h2 class="text-center"><?= $secFourArr['qus']; ?></h2>
                                <br/>
                                <div class="row text-center">
                                    <?php
                                    foreach ($secFourArr['option'] as $ans => $option) { ?>
                                        <div class="col-md-3">
                                        <label>
                                            <span style="font-size:18px;"><?= $option; ?></span>
                                            <? /* ?> <input name="q<?= $key; ?>" type="radio" value="<?= ++$ans; ?>" /> <? */ ?>
                                            <input name="q<?= $key; ?>" type="radio" value="<?php echo $number_to_alpha_options[$ans]; ?>" />
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
    }
 
</script>