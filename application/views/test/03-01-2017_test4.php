<style type="text/css">
    @import url(http://fonts.googleapis.com/css?family=Open+Sans:400,300,600);	
</style>
<script src="<?= base_url(); ?>js/test/test4.js"></script>
<?php include_once 'include/est_info4.php';
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>DISC Indicator Profile(DIP)</h1>
    </section>
    <section style="background: #ffffff" class="content" style="padding-left: 15px;">
        <center><h1>DISC Indicator Profile</h1></center>
        <div class="intro1" style="display:block;">
            <h2><u>Introduction</u></h2>
            <br/>
            <p style="font-size:20px; text-align:justify;">
                <ul>
                    <li>    1. Read the descriptions in each line carefully</li>
                    <li>    2. Givea rating out of4 to eah dription thatdescrib you the most to the least where:</li>
                    <li>    3. You must have only ONE "O", ONE "3", ONE "2" and ONE "1" in each line.</li>
                    <li>    4. Complete all 30 que5tions</li>
                </ul>
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
            <form  id="test2" class="form" action="<?= base_url(); ?>test/processTest4" method="post" class="test_wrapper">
            <input type="hidden" name="cat_id" value="<?= $catId;?>"/>
            <div class="panel panel-danger">
                <div class="panel-body">
                    <p class="text-danger"><strong>"4"</strong> Describes you the most out of description</p>
                    <p class="text-danger"><strong>"1"</strong> Describes you the least out of the four descriptions</p>
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
                    <input type="number" id="f<?php echo $i;?>" min=1 max=4 style="width:50px;" name="q<?php echo $i;?>" >
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