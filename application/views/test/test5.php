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
        //height: 1000px;
        //background: #ccc;
        text-align: center;
        //line-height: 300px;
    }
    
    .intro1{
        height: 440px;
    }
    .intro2{
        height: 470px;
    }
    .t3_row{ height: 30px;}
    .t3_q{ float: left; width: 750px; padding-top: 6px; padding-left: 20px;}
    .t3_t{ padding-top: 5px; float: left; border-left: solid 1px #ffd1cf; height: 25px; text-align: center; width: 60px;}
    .t3_f{ padding-top: 5px; float: left; border-left: solid 1px #ffd1cf; height: 25px; text-align: center; width: 60px;}
    .t3_dark_line{ background-color: #f5f5f5;}
    #t3_title{ font-weight: bold; color: #000; font-size: 13px;}
    #t3_title:hover{ background-color: #fff;}
    .t3_row:hover{ background-color: #ffd1cf;}
</style>

<?php include_once 'include/test3_info.php';
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1> Individual Personality Type (IPT)</h1>
    </section>
    <section style="background: #ffffff" class="content">
        <center><h1>Individual Personality Type</h1></center>
        <div class="intro1" style="display:block;">
            <h2><u>Introduction</u></h2>
            <br/>
            <p style="font-size:20px; text-align:justify;">
                Please read each statement carefully and select whether it applies to you (TRUE) or does not apply (FALSE) to you.
            </p>
            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="introOne()">Begin Test</button>
            </div>

        </div>
        <div id="slider" style="display:none;">
            <form method="post" id="questions_form" action="<?= base_url(); ?>test/processTest5">
                <input type="hidden" name="type" value="final"/>
                <input type="hidden" name="cat_id" value="<?= $catId;?>"/>
                <ul class="questions_list">
                    <li style="text-align: left; margin-left: 250px;">
                        <!--  -->
                        <div class="t3_row" id="t3_title">
                          <div class="t3_q">Question</div>
                          <div class="t3_t text-center">True</div>
                          <div class="t3_f text-center">False</div>
                        </div>
                        <?php 
                            $row=1;
                            $i=0;
                            $ans_i =-1;
                            foreach ($behaviours as $key=> $val)
                            {
                                $i+=1;
                                $ans_i+=1;
                            ?>
                        
                        <div class='t3_row <?php if($i%2){ echo "t3_dark_line"; } ?>' style="font-size: small;" id="<?php echo $i;?>" >
                            <div class="t3_q"><?php echo $val["title"];  ?></div>

                            <div class="t3_t text-center" id="<?php echo $i;?>">
                                <input type="radio" style="margin-left: 25px;" class="checkbox" name="<?php echo 'q'.$i;?>" value="1" />
                            </div>

                            <div class="t3_f text-center" id="<?php echo $i;?>">
                                <input type="radio" style="margin-left: 25px;" class="checkbox" name="<?php echo 'q'.$i;?>" value="0" />
                            </div>
                        </div>
                        <?php } ?>
      
                      <!--   <div class="clear"></div> -->
                        <br><br>
                        <div class="buttons text-center">
                         <input type="button" class="btn btn-primary btn-lg" id="test3" value="Continue" />
                        </div>
                        <br>   
                      </form>
                        <!--  -->
                    </li>
                </ul>
            </form>
        </div>
    </section>
</div>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(document).ready(function() {
    
    $("#test3").click(function(){
        incorrect = false;
        
        $('.t3_row').each(function() {
            
            var q_id = $(this).attr("id");
            var bgOn = $(this).css('background-color');
            if(q_id!="t3_title")
            {
                if($('input[name="q'+q_id+'"]:checked').length)
                {
                    
                }
                else
                {
                    $('html,body').animate({scrollTop: $(this).offset().top-150},'slow',function(){
                        $('.t3_row#'+q_id).animate({backgroundColor: "#930"}, 100);
                        $('.t3_row#'+q_id).animate({backgroundColor: bgOn}, 500);
                    });
                    
                    incorrect = true;
                    return false;
                }
            }
        });
        
        if(incorrect){
            return false;
        }
        $("#questions_form").submit();   
    });
});

    function introOne() {
        $('.intro1').hide();
        $('#slider').show();
        $("body").addClass("sidebar-collapse");
    }


</script>
<script>
    
</script>