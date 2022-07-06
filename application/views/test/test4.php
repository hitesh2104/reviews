<style type="text/css">
    @import url(http://fonts.googleapis.com/css?family=Open+Sans:400,300,600);	
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}
input[type=number] {
    -moz-appearance:textfield;
}
</style>
<script src="<?= base_url(); ?>js/test/test4.js"></script>
<?php include_once 'include/est_info4.php';
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>DISC Indicator Profile(DIP)</h1>
    </section>
    <section style="background: #ffffff" class="content" style="padding-left: 15px;">
        <h1>DISC Indicator Profile(DIP)</h1>
        <div class="intro1" style="display:block;">
            <!--h2><u>Introduction</u></h2-->
            <br/>
            <p style="font-size:14px; text-align:justify;">
	            The DIP measures your normal behaviour attributes at work. You will be presented with four statements which you need to rate on a 4-point scale, from most important to least important. You must allocate a score to all four statements.<br /><br />
                <strong>Please use the following scale to rate the statements:</strong>
                <ul>
                    <li>    4 = Most important/Describes you the most.</li>
                    <li>    3	</li>
                    <li>    2	</li>
                    <li>    1 = Least important/ Describes you the least.</li>
                </ul>
                <strong>Example:</strong><br />
                
                <picture>
                  <source srcset="../../../images/dip_rule_small.png" media="(max-width: 400px)">
                  <source srcset="../../../images/dip_rule.png">
                  <img src="../../../images/dip_rule.png" width="100%">
                </picture>
                
            </p>
            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="introOne()">Begin Test</button>
            </div>

        </div>
        <div class="clearfix"></div>
        <div class="sec">
          <div  id="sec" class="row" style="margin-left: auto;">
            <form  id="test2" class="form test_wrapper" action="<?= base_url(); ?>test/processTest4" method="post" >
            <input type="hidden" name="cat_id" value="<?= $catId;?>"/>
            <div class="panel panel-danger">
                <div class="panel-body">
                    <strong>Rating scale:</strong>
                    <ul>
                        <li>    4 = Most important/Describes you the most.</li>
                        <li>    3	</li>
                        <li>    2	</li>
                        <li>    1 = Least important/ Describes you the least.</li>
                    </ul>
                </div>

            </div>
            <div rid="1" id="r1" class="row">

        <?php
                $row=1;
                $i=0;
                $ans_i =-1;
                foreach ($behaviours as $key=> $val) {
                    $i+=1;
                    $ans_i+=1;
                    
              ?>
              
                <div class="col-md-3" style="display: flex; margin-top: 10px;">
                  <div class="behaviour" style="width:225px;"><?php echo $val["title"];  ?></div>
                  <div class="rating" style="margin-left: 15px;"  rid="<?php echo $row; ?>" id="<?php echo $i;?>">
                    <input type="number" class="numClass" id="f<?php echo $i;?>" min=1 max=4 style="width:50px;" name="q<?php echo $i;?>"  >
                    <input type="hidden" id="type<?php echo $i;?>" name="type[<?php echo $i;?>]" value="<?php echo $val["type"];  ?>" >
                  </div>
                </div>

                <?php if($i % 4== 0){ $row+=1; echo '</div><div rid="'.$row.'" id="r'.$row.'" class="row">';} 
              }?>
              <div class="clearfix"></div>
            
            
            <div class="buttons text-center" style="margin-top: 30px;">
             <input type="submit" id="test2" class="color_btn btn_color btn btn-primary" value="Continue" />
            </div>    
            
          </form>
          </div>
        </div>
    </section>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('.sec').hide();
    });

    function introOne() {
        $('.intro1').hide();
        $('.sec').show();
        $("body").addClass("sidebar-collapse");
    }
</script>