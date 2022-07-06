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
        background: red none repeat scroll 0 0;
    }

    .circle:has(> input[type=checkbox]:checked) {
      background-color:red;
    } 

</style>

<?php //include_once 'include/test1_info.php'; 
$quesLimit = 4;
?>

<div class="content-wrapper">
    <section class="content-header">
    </section>
    <?php if($sacId=="A"){ ?>
    <section style="background: #e1e1e1" class="content">
        <div class="intro1" style="display:block;">
            <h2><u>Section A Instructions</u></h2>
            <br/>
            <ul style="font-size: 16px;">
                <li>You will be presented with 4 statements. Please read the statements carefully and rate the questions on how much it applies to you. </li>
                <li>You can only select a rating score once per page, e.g. when you allocate a score of 10 to question 1, you won’t be allowed to allocate a score of 10 again to another question on the same page.</li>
            </ul><br />
            <img  class="img-responsive" src="<?= base_url() ?>images/test_11_instructions.png" width="80%" style="" height="600" /><br /><br /><br/>
            <ul style="font-size: 16px;">
                <li>The scoring in the above image shows question 1 and 3 were rated a 10 which is not allowed.</li>
                <li>Any score may only be used once as indicated in Example A</li>
                <li>The system will not allow you to select the same number twice on the same page</li>
                <li>If you understand the instructions, please click on Begin Test.</li>
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
                                <th width="70%" align="left" style="background:#CCCCCC; font-size:20px;">Questions</th>
                                <th width="30%" align="left" style="background:#CCCCCC; font-size:20px;">Answer</th>
                            </tr>
                    <?php $key=1; $j=0; $sn=0;
                    	//for ($i=1; $i <= count($sectionOneArr) ; $i++) {
						foreach($sectionOneArr as $i => $val){ $sn++;
                            $checked = array();
                            $style = array(); 
                            if(isset($remember_list[$i-1]))
                            {
                                $checked[$remember_list[$i-1]['answer']] = 'checked';
                                $style[$remember_list[$i-1]['answer']] = 'active';
                            }
                            if($j == 4){ $key++;
                        ?>
                            </table>
                            <div style="float: right;">
                                <?php echo "Page ". ($key-1) ." out of ".count($sectionOneArr)/4 ;?>
                            </div>
                        </li>
                            <li style="text-align: left" id="slide<?= $key; ?>" class="table-responsive">
                                <table width="100%" class="table">
                                    <tr>
                                        <th width="70%" align="left" style="background:#CCCCCC; font-size:20px;">Questions</th>
                                        <th width="30%" align="left" style="background:#CCCCCC; font-size:20px;">Answer</th>
                                    </tr>
                            <?php $j=0; }?>
                                    <tr class="info">
                                        <td><?= $sn.". ".$val ?>
	                                        <input type="hidden" value="<?php echo $i; ?>" name="questId[<?php echo $i; ?>]" />
                                        </td>
                                        <td>
                                            <?php

                                                echo '<label class="circle '. @$style[1] .' " id="quesBox_'.$i.'_1" >1&nbsp;&nbsp; <input type="radio" '. @$checked[1] .' id="quesAns_'.$i.'_1"  name="quesAns['.$i.']" value="1" style="display:none;" /></label>&nbsp;&nbsp;';

                                                echo '<label class="circle '. @$style[2] .' " id="quesBox_'.$i.'_2" >2&nbsp;&nbsp; <input type="radio" '. @$checked[2] .' id="quesAns_'.$i.'_2"  name="quesAns['.$i.']" value="2" style="display:none;" /></label>&nbsp;&nbsp;';

                                                echo '<label class="circle '. @$style[3] .' " id="quesBox_'.$i.'_3" >3&nbsp;&nbsp; <input type="radio" '. @$checked[3] .' id="quesAns_'.$i.'_3"  name="quesAns['.$i.']" value="3" style="display:none;" /></label>&nbsp;&nbsp;';

                                                echo '<label class="circle '. @$style[4] .' " id="quesBox_'.$i.'_4" >4&nbsp;&nbsp; <input type="radio" '. @$checked[4] .' id="quesAns_'.$i.'_4"  name="quesAns['.$i.']" value="4" style="display:none;" /></label>&nbsp;&nbsp;';

                                                echo '<label class="circle '. @$style[5] .' " id="quesBox_'.$i.'_5" >5&nbsp;&nbsp; <input type="radio" '. @$checked[5] .' id="quesAns_'.$i.'_5"  name="quesAns['.$i.']" value="5" style="display:none;" /></label>&nbsp;&nbsp;';

                                                echo '<label class="circle '. @$style[6] .' " id="quesBox_'.$i.'_6" >6&nbsp;&nbsp; <input type="radio" '. @$checked[6] .' id="quesAns_'.$i.'_6"  name="quesAns['.$i.']" value="6" style="display:none;" /></label>&nbsp;&nbsp;';

                                                echo '<label class="circle '. @$style[7] .' " id="quesBox_'.$i.'_7" >7&nbsp;&nbsp; <input type="radio" '. @$checked[7] .' id="quesAns_'.$i.'_7"  name="quesAns['.$i.']" value="7" style="display:none;" /></label>&nbsp;&nbsp;';

                                                echo '<label class="circle '. @$style[8] .' " id="quesBox_'.$i.'_8" >8&nbsp;&nbsp; <input type="radio" '. @$checked[8] .' id="quesAns_'.$i.'_8"  name="quesAns['.$i.']" value="8" style="display:none;" /></label>&nbsp;&nbsp;';

                                                echo '<label class="circle '. @$style[9] .' " id="quesBox_'.$i.'_9" >9&nbsp;&nbsp; <input type="radio" '. @$checked[9] .' id="quesAns_'.$i.'_9"  name="quesAns['.$i.']" value="9" style="display:none;" /></label>&nbsp;&nbsp;';

                                                echo '<label class="circle '. @$style[10] .' " id="quesBox_'.$i.'_10" style="padding-left: 2px !important;" >10&nbsp;&nbsp; <input type="radio" '. @$checked[10] .' id="quesAns_'.$i.'_10"  name="quesAns['.$i.']" value="10" style="display:none;" /></label>&nbsp;&nbsp;';
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
    <?php } ?>
    <?php if($sacId=="B"){ ?>
    <section style="background: #e1e1e1" class="content">
        <div class="introA" style="display:block;">
            <h3 class="text-center"><u>You have successfully completed section A. Please click on Continue to complete section B.
            </u></h3>
            <br/>
            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="introA()">Continue</button>
            </div>

        </div>

        <div class="intro1" style="display:none;">
            <h2><u>Section B Instructions</u></h2>
            <br/>
            <ul style="font-size: 16px;">
                <li>Please read each statement carefully and decide how much you agree or disagree
                    with the statement. <br/>Click on Begin Test to start test.
                </li>
                <li>The more a statement applies to you, the higher the score. E.g. If a statement
                    describes you completely, select a higher score. If a statement does not
                    describe you at all, select a lower score.
                </li>
            </ul><br />
            <table width="30%" border="1" cellpadding="0" cellspacing="0" style="margin-left:16px;">
                <tr>
                    <td style="background:#CCCCCC;"><strong>Preference</strong></td>
                    <td style="background:#CCCCCC;"><strong>Rating</strong></td>
                </tr>
                <tr>
                    <td bgcolor="#CCCCCC">Completely Disagree</td>
                    <td bgcolor="#CCCCCC">1</td>
                </tr>
                <tr>
                    <td bgcolor="#CCCCCC">Disagree Somewhat</td>
                    <td bgcolor="#CCCCCC">2</td>
                </tr>
                <tr>
                    <td bgcolor="#CCCCCC">Not Sure</td>
                    <td bgcolor="#CCCCCC">3</td>
                </tr>
                <tr>
                    <td bgcolor="#CCCCCC">Agree Somewhat</td>
                    <td bgcolor="#CCCCCC">4</td>
                </tr>
                <tr>
                    <td bgcolor="#CCCCCC">Agree Completely</td>
                    <td bgcolor="#CCCCCC">5</td>
                </tr>
            </table>
            <br>
            <div class="clearfix"></div>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="introOne()">Begin Test</button>
            </div>

        </div>
        
        <div id="slider" style="display:none">
            <form method="post" id="questions_form" action="<?= base_url(); ?>test/processTest1">
                <input type="hidden" name="type" value="final"/>
                <input type="hidden" name="cat_id" value="<?= $catId;?>"/>
                <!--  -->
                <table width="100%" border="1" cellpadding="0" cellspacing="0" style="margin-bottom:20px;">
                            <tr>
                                <td style="background:#DBDBDB;"></td>
                                <td align="center" style="background:#DBDBDB;">Completely Disagree</td>
                                <td align="center" style="background:#DBDBDB;">Disagree Somewhat</td>
                                <td align="center" style="background:#DBDBDB;">Not Sure</td>
                                <td align="center" style="background:#DBDBDB;">Agree Somewhat</td>
                                <td align="center" style="background:#DBDBDB;">Agree Completely</td>
                            </tr>
                            <tr>
                                <td bgcolor="#CCCCCC"><strong>Points</strong></td>
                                <td align="center" bgcolor="#CCCCCC">1</td>
                                <td align="center" bgcolor="#CCCCCC">2</td>
                                <td align="center" bgcolor="#CCCCCC">3</td>
                                <td align="center" bgcolor="#CCCCCC">4</td>
                                <td align="center" bgcolor="#CCCCCC">5</td>
                            </tr>
                        </table>
                <ul class="questions_list" id="1">
                    <li style="text-align: left" id="slide1">
                        <table width="100%" class="table table-bordered">
                            <tr>
                                <th width="70%" align="left" style="background:#CCCCCC; font-size:20px;">Questions</th>
                                <th width="30%" align="left" style="background:#CCCCCC; font-size:20px;">Answer</th>
                            </tr>
                    <?php 
                    $key=1; $j=0; $sn=0;
                   // for ($i=1; $i <= count($sectionTwoArr) ; $i++) {
					   foreach($sectionTwoArr as $i => $val){ $sn++;
                            $checked = array();
                            $style = array(); 
                            if(isset($remember_list[$i-1])){
                                $checked[$remember_list[$i-1]['answer']] = 'checked';
                                $style[$remember_list[$i-1]['answer']] = 'active';
                            }
                            if($j == 4){ $key++;
                        ?>
                            </table>
                            <div style="float: right;">
                                <?php echo "Page ". ($key-1) ." out of ".count($sectionTwoArr)/4 ;?>
                            </div>
                        </li>
                            <li style="text-align: left" id="slide<?= $key; ?>" class="table-responsive">
                                <table width="100%" class="table">
                                    <tr>
                                        <th width="70%" align="left" style="background:#CCCCCC; font-size:20px;">Questions</th>
                                        <th width="30%" align="left" style="background:#CCCCCC; font-size:20px;">Answer</th>
                                    </tr>
                            <?php $j=0; }?>
                                    <tr class="info">
                                        <td><?= $sn.". ".$val ?>
	                                        <input type="hidden" value="<?php echo $i; ?>" name="questId[<?php echo $i; ?>]" />
                                        </td>
                                        <td>
                                            <?php

                                                echo '<label class="circle '. @$style[1] .' " id="quesBox_'.$i.'_1" >1&nbsp;&nbsp; <input type="radio" '. @$checked[1] .' id="quesAns_'.$i.'_1"  name="quesAns['.$i.']" value="1" style="display:none;" /></label>&nbsp;&nbsp;';

                                                echo '<label class="circle '. @$style[2] .' " id="quesBox_'.$i.'_2" >2&nbsp;&nbsp; <input type="radio" '. @$checked[2] .' id="quesAns_'.$i.'_2"  name="quesAns['.$i.']" value="2" style="display:none;" /></label>&nbsp;&nbsp;';

                                                echo '<label class="circle '. @$style[3] .' " id="quesBox_'.$i.'_3" >3&nbsp;&nbsp; <input type="radio" '. @$checked[3] .' id="quesAns_'.$i.'_3"  name="quesAns['.$i.']" value="3" style="display:none;" /></label>&nbsp;&nbsp;';

                                                echo '<label class="circle '. @$style[4] .' " id="quesBox_'.$i.'_4" >4&nbsp;&nbsp; <input type="radio" '. @$checked[4] .' id="quesAns_'.$i.'_4"  name="quesAns['.$i.']" value="4" style="display:none;" /></label>&nbsp;&nbsp;';

                                                echo '<label class="circle '. @$style[5] .' " id="quesBox_'.$i.'_5" >5&nbsp;&nbsp; <input type="radio" '. @$checked[5] .' id="quesAns_'.$i.'_5"  name="quesAns['.$i.']" value="5" style="display:none;" /></label>&nbsp;&nbsp;';

                                                // echo '<label class="circle '. @$style[6] .' " id="quesBox_'.$i.'_6" >6&nbsp;&nbsp; <input type="radio" id="quesAns_'.$i.'_6"  name="quesAns['.$i.']" value="6" style="display:none;" /></label>&nbsp;&nbsp;';

                                                // echo '<label class="circle '. @$style[7] .' " id="quesBox_'.$i.'_7" >7&nbsp;&nbsp; <input type="radio" id="quesAns_'.$i.'_7"  name="quesAns['.$i.']" value="7" style="display:none;" /></label>&nbsp;&nbsp;';

                                                // echo '<label class="circle '. @$style[8] .' " id="quesBox_'.$i.'_8" >8&nbsp;&nbsp; <input type="radio" id="quesAns_'.$i.'_8"  name="quesAns['.$i.']" value="8" style="display:none;" /></label>&nbsp;&nbsp;';

                                                // echo '<label class="circle '. @$style[9] .' " id="quesBox_'.$i.'_9" >9&nbsp;&nbsp; <input type="radio" id="quesAns_'.$i.'_9"  name="quesAns['.$i.']" value="9" style="display:none;" /></label>&nbsp;&nbsp;';

                                                // echo '<label class="circle '. @$style[10] .' " id="quesBox_'.$i.'_10" style="padding-left: 2px !important;" >10&nbsp;&nbsp; <input type="radio" id="quesAns_'.$i.'_10"  name="quesAns['.$i.']" value="10" style="display:none;" /></label>&nbsp;&nbsp;';
                                            ?>
                                        </td>
                                    </tr>     
                    <?php $j++;  } ?>
                            </table>
                        </li>
                </ul>
                <a class="control_next btn btn-primary"   style="opacity: 1;">Next</a>
                <a class="control_prev btn btn-primary" style="opacity: 1;">Previous</a>
            </form>
        </div>
    </section>
    <?php } ?>
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

        var remember = <?php echo isset($last_remember)?$last_remember:0; ?> ;
        
        if(remember==0 || remember=="" || remember==252)
        {

        }   
        else
        {
            var move = remember/4;
        
            $('.introA').hide();
            $('.intro1').hide();
            $('#slider').show();

            // for (var i = 0; i < move; i++) {
            //     //$("a.control_next").trigger('click');
            //     //$("a.control_next").trigger("click");

            //     $('#slider').find('a.control_next').trigger('click');
            // }





            // $('#slider ul').animate({
            //     left: +(slideWidth*move)
            // }, 500, function () {
            //     $('#slider ul li:first-child').appendTo('#slider ul');
            //     $('#slider ul').css('left', '');
            // });
            for (var i = 0; i <move; i++) {
                if(slideCount <= move)
                    Continue;
                else
                {
                    moveRight();
                }
            }
            var slidesUL = $(".questions_list");
            var currentSlide = $(slidesUL).attr("id");
            currentSlide = Number(currentSlide) + move;
            $(slidesUL).attr('id', currentSlide);

            $(slidesUL).attr('id', move+1);
            

        }     

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
            var firstli = (Number(UL) * 4) - 3;
            var flag=0;
            var to=4;

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
            
            if(valarr.length < to)
            {
                alert("You have to answer all the questions.");
                return 0;
            }
            <?php if($sacId != "B"){ ?>
                if(flag > 0)
                {
                    alert("You are not allowed to select the same number more than once.");
                    return 0;
                }
            <?php } ?>

            var total=0;
            var questions = [];

            for (var i = 0; i < valarr.length; i++) {
                total+=valarr[i];
                questions[i] = firstli+i;
            }

            var sac_id=$("input[name=type]").val();
           

            $.ajax({
                url: "<?= base_url("test/answertest1") ?>",
                data:"total="+total+"&questions="+questions+"&answers="+valarr+"&candidate_id="+<?= $catId; ?>+"&sac_id="+sac_id,
                type:"POST",
                success:function(data)
                {
                    if(data!=1)
                    {
                        return 0;
                    }
                }

            });

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
           // var validateInput = validate();
			var validateInput = checkMinAndMaxTotal(NumberOfSlides, currentSlide);

            if (validateInput == 0) {
            //    $('.control_next').attr('disabled','disabled');
                return false;
            }
            if (NumberOfSlides > currentSlide) {
                currentSlide = Number(currentSlide) + 1;
                $(slidesUL).attr('id', currentSlide);
				moveRight();
            }
        });

        $('.circle').click(function(){
            $(this).css('background-color','red');
            if(!$(this).find('input[type=radio]:checked'))
            {
                $(this).find('input[type=radio]').trigger('click');
            }
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

    function introA()
    {
      $('.introA').hide();
        $('.intro1').show();  
    };

// Check Min and Max total
function checkMinAndMaxTotal(NumberOfSlides, currentSlide){
	var row = 0; var ansValArr = Array(); var isFalse = 0;
	var total=0;
    var questions = Array();
	console.log("#slide"+currentSlide);
	$("#slide"+currentSlide+" input[name*='quesAns']").each(function() {
		//console.log($(this).attr("id")+"___"+$(this).is(':checked'));
		var boxId = $(this).attr("id").replace(/quesAns_/g, 'quesBox_');
	 	if($(this).prop("checked")){	row++;
			var ansVal = $(this).val();
		<?php if($sacId != "B"){ ?>
			if(jQuery.inArray( ansVal, ansValArr )>=0){
				alert("You are not allowed to select the same number more than once.");
				isFalse = 1; 
				return false;
			}
		<?php } ?>		
			total+= parseInt($(this).val());
			ansValArr.push(ansVal);				
		}
	});	
	if(isFalse == 1){ return 0;}
	$("#slide"+currentSlide+" input[name*='quest']").each(function() {
		questions.push($(this).val());
	});	
	
	if(row != <?php echo $quesLimit; ?>){
		if(isFalse == 0){
			alert('Please give answer for all questions.');
		}
		return 0;
	}else if(isFalse == 0){
		//alert(786);
		//$("#testForm").submit();
		
		var sac_id=$("input[name=type]").val();

		for (var i = 0; i < ansValArr.length; i++) {
			//total+=ansValArr[i];
			//questions[i] = ansValArr[i];
		}
		
		$.ajax({
			url: "<?= base_url("test/answertest1") ?>",
			data:"total="+total+"&questions="+questions+"&answers="+ansValArr+"&candidate_id="+<?= $catId; ?>+"&sac_id="+sac_id,
			type:"POST",
			success:function(data)
			{
				if(data!=1){
					return 0;
				}else{
					if (NumberOfSlides > currentSlide) {
					}else{
						$("#questions_form").submit();
						return 1;
					}					
					
				}
			}
		});
	}
	
	/*var total = $("#totalAns").val(); 
	if(total != 8){
		alert('You must allocate 8 points in total. ');
	}else{
		$("#testForm").submit();
	}*/
}	
</script>