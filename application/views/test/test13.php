<style type="text/css">
    @import url(https://fonts.googleapis.com/css?family=Open+Sans:400,300,600); 

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
    
    table{
        margin-left: 130px;
    }

    table, th,  tr, td {
    border: 2px solid #99c5da;
    border-collapse: collapse;
    }
    
    th {
        background-color: #f0faff;
    }

    .intro1{
        height: 440px;
    }
    .intro2{
        height: 470px;
    }
    .t3_row{ height: 30px; background-color: #f0faff; }
    .t3_q{ float: left; width: 580px; padding-top: 6px; padding-left: 20px; border: 0px;  }
    
    .t3_a{ background-color: #f5f5f5; width: 200px;  }

    #t3_title{ font-weight: bold; color: #000; font-size: 13px;}
    #t3_title:hover{ background-color: #fff;}
  
</style>

<?php include_once 'include/test13_info.php';
?>

<div class="content-wrapper">
    <?php if($sacId=="A"){ ?>
    <section style="background: #ffffff" class="content">
    <br>
        <center><h1>Teanamics</h1></center>
        <div class="intro1" style="display:block;">
            <h2><u>Instructions</u></h2>
            <br/>
            <p style="font-size:20px; text-align:justify;">
                Please read each statement carefully and choose how much you agree or disagree with each statement.
            </p>
            <div class="clearfix"></div>
            <br/>
            <div style="text-align: center;">
                <button type="button" class="btn btn-primary" onclick="introOne()">Begin Test</button>
            </div>

        </div>
        
        <div id="slider" style="display: none;">
            <form method="post" id="questions_form" action="<?= base_url(); ?>test/processTest13">
                <input type="hidden" name="type" value="secA"/>
                <input type="hidden" name="cat_id" value="<?= $catId;?>"/>
                <ul class="questions_list">
                    <li style="text-align: left;">
                       
                         <table class="table-hover">
                            <thead>
                                <tr id="heading"> 
                                    <th class="text-center">Question</th>
                                    <th class="text-center" style="width: 100px;">Strongly Disagree</th>
                                    <th class="text-center" style="width: 100px;">Disagree</th>
                                    <th class="text-center" style="width: 100px;">Slightly Disagree</th>
                                    <th class="text-center" style="width: 100px;">Slightly Agree</th>
                                    <th class="text-center" style="width: 100px;">Agree</th>
                                    <th class="text-center" style="width: 100px;">Strongly Agree</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;
                            foreach ($secA as $key => $A) { ?>
                                <tr class="t3_row" id="<?= $i ?>">
                                    <td class="t3_q">
                                        <?= $A['question'] ?>
                                    </td>
                                    <td class="t3_a">
                                        <div class="text-center">
                                            <input type="radio" name="<?= "q".$i ?>" value="1" />
                                        </div>
                                    </td>
                                    <td class="t3_a">
                                        <div class="text-center" >
                                            <input type="radio" name="<?= "q".$i ?>" value="2" />
                                        </div>
                                    </td>
                                    <td class="t3_a">
                                        <div class="text-center" >
                                            <input type="radio" name="<?= "q".$i ?>" value="3" />
                                        </div>
                                    </td>
                                    <td class="t3_a">
                                        <div class="text-center" >
                                            <input type="radio" name="<?= "q".$i ?>" value="4" />
                                        </div>
                                    </td>
                                    <td class="t3_a">
                                        <div class="text-center" >
                                            <input type="radio" name="<?= "q".$i ?>" value="5" />
                                        </div>
                                    </td>
                                    <td class="t3_a">
                                        <div class="text-center" >
                                            <input type="radio" name="<?= "q".$i ?>" value="6" />
                                        </div>
                                    </td>
                                </tr>
                               <?php $i++; }  ?>
                            </tbody>
                        </table>
                        </form>
                        <!--  -->
                    </li>
                    </ul>
                   <div class="clearfix"></div>
                    <br><br>
                    <div class="buttons" style="width: 1100px;margin: 20px auto 0 auto;">
                        <div class="row">
                        <div class="col-md-6 text-left">
                            <input type="button" style="margin: auto;" class="btn btn-primary disabled btn-lg" id="testp" value="Previous" />
                        </div>
                        <div class="col-md-6 text-right">
                            <input type="button" style="margin: auto;" class="btn btn-primary btn-lg" id="test3" value="Next" />
                        </div>
                        </div>
                    </div>
                    <br>
                
            </form>
        </div>
    </section>
    <?php } ?>

    <?php if($sacId=="B"){ ?>
    <section style="background: #ffffff" class="content"> 
    <br>   
    <center><h1>Teanamics</h1></center>
        <div id="slider">
            <form method="post" id="questions_form" action="<?= base_url(); ?>test/processTest13">
                <input type="hidden" name="type" value="secB"/>
                <input type="hidden" name="cat_id" value="<?= $catId;?>"/>
                <ul class="questions_list">
                    <li style="text-align: left;">
                       
                         <table class="table-hover">
                            <thead>
                                <tr id="heading"> 
                                    <th class="text-center">Question</th>
                                    <th class="text-center" style="width: 100px;">Strongly Disagree</th>
                                    <th class="text-center" style="width: 100px;">Disagree</th>
                                    <th class="text-center" style="width: 100px;">Slightly Disagree</th>
                                    <th class="text-center" style="width: 100px;">Slightly Agree</th>
                                    <th class="text-center" style="width: 100px;">Agree</th>
                                    <th class="text-center" style="width: 100px;">Strongly Agree</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;
                            foreach ($secB as $key => $B) { ?>
                                <tr class="t3_row" id="<?= $i ?>">
                                    <td class="t3_q">
                                        <?= $B['question'] ?>
                                    </td>
                                    <td class="t3_a">
                                        <div class="text-center">
                                            <input type="radio" name="<?= "q".$i ?>" value="1" />
                                        </div>
                                    </td>
                                    <td class="t3_a">
                                        <div class="text-center" >
                                            <input type="radio" name="<?= "q".$i ?>" value="2" />
                                        </div>
                                    </td>
                                    <td class="t3_a">
                                        <div class="text-center" >
                                            <input type="radio" name="<?= "q".$i ?>" value="3" />
                                        </div>
                                    </td>
                                    <td class="t3_a">
                                        <div class="text-center" >
                                            <input type="radio" name="<?= "q".$i ?>" value="4" />
                                        </div>
                                    </td>
                                    <td class="t3_a">
                                        <div class="text-center" >
                                            <input type="radio" name="<?= "q".$i ?>" value="5" />
                                        </div>
                                    </td>
                                    <td class="t3_a">
                                        <div class="text-center" >
                                            <input type="radio" name="<?= "q".$i ?>" value="6" />
                                        </div>
                                    </td>
                                </tr>
                               <?php $i++; }  ?>
                            </tbody>
                        </table>
                        
                    </li>
                    </ul>
                   <!-- <div class="clearfix"></div>
                    <br><br>
                    <div class="buttons text-center">
                     <input type="button" style="margin: auto;" class="btn btn-primary btn-lg" id="test3" value="Continue" />
                    </div>
                    <br> -->

                    <div class="clearfix"></div>
                    <br><br>
                    <div class="buttons" style="width: 1100px;margin: 20px auto 0 auto;">
                        <div class="row">
                        <div class="col-md-6 text-left">
                            <button type="text" style="margin: auto;" class="btn btn-primary btn-lg" id="test" name="previous" value="A">Previous</button>
                        </div>
                        <div class="col-md-6 text-right">
                            <input type="button" style="margin: auto;" class="btn btn-primary btn-lg" id="test3" value="Next" />
                        </div>
                        </div>
                    </div>
                    <br>
                
            </form>
        </div>
    </section>
    <?php } ?>

    <?php if($sacId=="C"){ ?>
    <section style="background: #ffffff" class="content"> 
    <br>
        <center><h1>Teanamics</h1></center>   
        <div id="slider">
            <form method="post" id="questions_form" action="<?= base_url(); ?>test/processTest13">
                <input type="hidden" name="type" value="secC"/>
                <input type="hidden" name="cat_id" value="<?= $catId;?>"/>
                <ul class="questions_list">
                    <li style="text-align: left;">
                       
                         <table class="table-hover">
                            <thead>
                                <tr id="heading"> 
                                    <th class="text-center">Question</th>
                                    <th class="text-center" style="width: 100px;">Strongly Disagree</th>
                                    <th class="text-center" style="width: 100px;">Disagree</th>
                                    <th class="text-center" style="width: 100px;">Slightly Disagree</th>
                                    <th class="text-center" style="width: 100px;">Slightly Agree</th>
                                    <th class="text-center" style="width: 100px;">Agree</th>
                                    <th class="text-center" style="width: 100px;">Strongly Agree</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;
                            foreach ($secC as $key => $C) { ?>
                                <tr class="t3_row" id="<?= $i ?>">
                                    <td class="t3_q">
                                        <?= $C['question'] ?>
                                    </td>
                                    <td class="t3_a">
                                        <div class="text-center">
                                            <input type="radio" name="<?= "q".$i ?>" value="1" />
                                        </div>
                                    </td>
                                    <td class="t3_a">
                                        <div class="text-center" >
                                            <input type="radio" name="<?= "q".$i ?>" value="2" />
                                        </div>
                                    </td>
                                    <td class="t3_a">
                                        <div class="text-center" >
                                            <input type="radio" name="<?= "q".$i ?>" value="3" />
                                        </div>
                                    </td>
                                    <td class="t3_a">
                                        <div class="text-center" >
                                            <input type="radio" name="<?= "q".$i ?>" value="4" />
                                        </div>
                                    </td>
                                    <td class="t3_a">
                                        <div class="text-center" >
                                            <input type="radio" name="<?= "q".$i ?>" value="5" />
                                        </div>
                                    </td>
                                    <td class="t3_a">
                                        <div class="text-center" >
                                            <input type="radio" name="<?= "q".$i ?>" value="6" />
                                        </div>
                                    </td>
                                </tr>
                               <?php $i++; }  ?>
                            </tbody>
                        </table>
                        <!--  -->
                    </li>
                    </ul>
                   <!-- <div class="clearfix"></div>
                    <br><br>
                    <div class="buttons text-center">
                     <input type="button" style="margin: auto;" class="btn btn-primary btn-lg" id="test3" value="Continue" />
                    </div>
                    <br> -->

                    <div class="clearfix"></div>
                    <br><br>
                    <div class="buttons" style="width: 1100px;margin: 20px auto 0 auto;">
                        <div class="row">
                        <div class="col-md-6 text-left">
                            <button type="text" style="margin: auto;" class="btn btn-primary btn-lg" id="test" name="previous" value="B">Previous</button>
                        </div>
                        <div class="col-md-6 text-right">
                            <input type="button" style="margin: auto;" class="btn btn-primary btn-lg" id="test3" value="Next" />
                        </div>
                        </div>
                    </div>
                    <br>
                
            </form>
        </div>
    </section>
    <?php } ?>

    <?php if($sacId=="D"){ ?>
    <section style="background: #ffffff" class="content">    
    <br>
        <center><h1>Teanamics</h1></center>
        <div id="slider">
            <form method="post" id="questions_form" action="<?= base_url(); ?>test/processTest13">
                <input type="hidden" name="type" value="secD"/>
                <input type="hidden" name="cat_id" value="<?= $catId;?>"/>
                <ul class="questions_list">
                    <li style="text-align: left;">
                       
                         <table class="table-hover">
                            <thead>
                                <tr id="heading"> 
                                    <th class="text-center">Question</th>
                                    <th class="text-center" style="width: 100px;">Strongly Disagree</th>
                                    <th class="text-center" style="width: 100px;">Disagree</th>
                                    <th class="text-center" style="width: 100px;">Slightly Disagree</th>
                                    <th class="text-center" style="width: 100px;">Slightly Agree</th>
                                    <th class="text-center" style="width: 100px;">Agree</th>
                                    <th class="text-center" style="width: 100px;">Strongly Agree</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;
                            foreach ($secD as $key => $D) { ?>
                                <tr class="t3_row" id="<?= $i ?>">
                                    <td class="t3_q">
                                        <?= $D['question'] ?>
                                    </td>
                                    <td class="t3_a">
                                        <div class="text-center">
                                            <input type="radio" name="<?= "q".$i ?>" value="1" />
                                        </div>
                                    </td>
                                    <td class="t3_a">
                                        <div class="text-center" >
                                            <input type="radio" name="<?= "q".$i ?>" value="2" />
                                        </div>
                                    </td>
                                    <td class="t3_a">
                                        <div class="text-center" >
                                            <input type="radio" name="<?= "q".$i ?>" value="3" />
                                        </div>
                                    </td>
                                    <td class="t3_a">
                                        <div class="text-center" >
                                            <input type="radio" name="<?= "q".$i ?>" value="4" />
                                        </div>
                                    </td>
                                    <td class="t3_a">
                                        <div class="text-center" >
                                            <input type="radio" name="<?= "q".$i ?>" value="5" />
                                        </div>
                                    </td>
                                    <td class="t3_a">
                                        <div class="text-center" >
                                            <input type="radio" name="<?= "q".$i ?>" value="6" />
                                        </div>
                                    </td>
                                </tr>
                               <?php $i++; }  ?>
                            </tbody>
                        </table>
                     
                        <!--  -->
                    </li>
                    </ul>
                   <!-- <div class="clearfix"></div>
                    <br><br>
                    <div class="buttons text-center">
                     <input type="button" style="margin: auto;" class="btn btn-primary btn-lg" id="test3" value="Continue" />
                    </div>
                    <br> -->

                    <div class="clearfix"></div>
                    <br><br>
                    <div class="buttons" style="width: 1100px;margin: 20px auto 0 auto;">
                        <div class="row">
                        <div class="col-md-6 text-left">
                            <button type="text" style="margin: auto;" class="btn btn-primary btn-lg" id="test" name="previous" value="C">Previous</button>
                        </div>
                        <div class="col-md-6 text-right">
                            <input type="button" style="margin: auto;" class="btn btn-primary btn-lg" id="test3" value="Next" />
                        </div>
                        </div>
                    </div>
                    <br>
                
            </form>
        </div>
    </section>
    <?php } ?>

    <?php if($sacId=="E"){ ?>
    <section style="background: #ffffff" class="content">
    <br>
        <center><h1>Teanamics</h1></center>    
        <div id="slider">
            <form method="post" id="questions_form" action="<?= base_url(); ?>test/processTest13">
                <input type="hidden" name="type" value="secE"/>
                <input type="hidden" name="cat_id" value="<?= $catId;?>"/>
                <ul class="questions_list">
                    <li style="text-align: left;">
                       
                         <table class="table-hover">
                            <thead>
                                <tr id="heading"> 
                                    <th class="text-center">Question</th>
                                    <th class="text-center" style="width: 100px;">Strongly Disagree</th>
                                    <th class="text-center" style="width: 100px;">Disagree</th>
                                    <th class="text-center" style="width: 100px;">Slightly Disagree</th>
                                    <th class="text-center" style="width: 100px;">Slightly Agree</th>
                                    <th class="text-center" style="width: 100px;">Agree</th>
                                    <th class="text-center" style="width: 100px;">Strongly Agree</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;
                            foreach ($secE as $key => $E) { ?>
                                <tr class="t3_row" id="<?= $i ?>">
                                    <td class="t3_q">
                                        <?= $E['question'] ?>
                                    </td>
                                    <td class="t3_a">
                                        <div class="text-center">
                                            <input type="radio" name="<?= "q".$i ?>" value="1" />
                                        </div>
                                    </td>
                                    <td class="t3_a">
                                        <div class="text-center" >
                                            <input type="radio" name="<?= "q".$i ?>" value="2" />
                                        </div>
                                    </td>
                                    <td class="t3_a">
                                        <div class="text-center" >
                                            <input type="radio" name="<?= "q".$i ?>" value="3" />
                                        </div>
                                    </td>
                                    <td class="t3_a">
                                        <div class="text-center" >
                                            <input type="radio" name="<?= "q".$i ?>" value="4" />
                                        </div>
                                    </td>
                                    <td class="t3_a">
                                        <div class="text-center" >
                                            <input type="radio" name="<?= "q".$i ?>" value="5" />
                                        </div>
                                    </td>
                                    <td class="t3_a">
                                        <div class="text-center" >
                                            <input type="radio" name="<?= "q".$i ?>" value="6" />
                                        </div>
                                    </td>
                                </tr>
                               <?php $i++; }  ?>
                            </tbody>
                        </table>
                        
                        <!--  -->
                    </li>
                    </ul>
                   <!-- <div class="clearfix"></div>
                    <br><br>
                    <div class="buttons text-center">
                     <input type="button" style="margin: auto;" class="btn btn-primary btn-lg" id="test3" value="Continue" />
                    </div>
                    <br> -->

                    <div class="clearfix"></div>
                    <br><br>
                    <div class="buttons" style="width: 1100px;margin: 20px auto 0 auto;">
                        <div class="row">
                        <div class="col-md-6 text-left">
                            <button type="text" style="margin: auto;" class="btn btn-primary btn-lg" id="test" name="previous" value="D">Previous</button>
                        </div>
                        <div class="col-md-6 text-right">
                            <input type="button" style="margin: auto;" class="btn btn-primary btn-lg" id="test3" value="Next" />
                        </div>
                        </div>
                    </div>
                    <br>
                
            </form>
        </div>
    </section>
    <?php } ?>

    <?php if($sacId=="F"){ ?>
    <section style="background: #ffffff" class="content">    
    <br>
        <center><h1>Teanamics</h1></center>
        <div id="slider">
            <form method="post" id="questions_form" action="<?= base_url(); ?>test/processTest13">
                <input type="hidden" name="type" value="secF"/>
                <input type="hidden" name="cat_id" value="<?= $catId;?>"/>
                <ul class="questions_list">
                    <li style="text-align: left;">
                       
                         <table class="table-hover">
                            <thead>
                                <tr id="heading"> 
                                    <th class="text-center">Question</th>
                                    <th class="text-center" style="width: 100px;">Strongly Disagree</th>
                                    <th class="text-center" style="width: 100px;">Disagree</th>
                                    <th class="text-center" style="width: 100px;">Slightly Disagree</th>
                                    <th class="text-center" style="width: 100px;">Slightly Agree</th>
                                    <th class="text-center" style="width: 100px;">Agree</th>
                                    <th class="text-center" style="width: 100px;">Strongly Agree</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;
                            foreach ($secF as $key => $F) { ?>
                                <tr class="t3_row" id="<?= $i ?>">
                                    <td class="t3_q">
                                        <?= $F['question'] ?>
                                    </td>
                                    <td class="t3_a">
                                        <div class="text-center">
                                            <input type="radio" name="<?= "q".$i ?>" value="1" />
                                        </div>
                                    </td>
                                    <td class="t3_a">
                                        <div class="text-center" >
                                            <input type="radio" name="<?= "q".$i ?>" value="2" />
                                        </div>
                                    </td>
                                    <td class="t3_a">
                                        <div class="text-center" >
                                            <input type="radio" name="<?= "q".$i ?>" value="3" />
                                        </div>
                                    </td>
                                    <td class="t3_a">
                                        <div class="text-center" >
                                            <input type="radio" name="<?= "q".$i ?>" value="4" />
                                        </div>
                                    </td>
                                    <td class="t3_a">
                                        <div class="text-center" >
                                            <input type="radio" name="<?= "q".$i ?>" value="5" />
                                        </div>
                                    </td>
                                    <td class="t3_a">
                                        <div class="text-center" >
                                            <input type="radio" name="<?= "q".$i ?>" value="6" />
                                        </div>
                                    </td>
                                </tr>
                               <?php $i++; }  ?>
                            </tbody>
                        </table>
                        
                        <!--  -->
                    </li>
                    </ul>
                   <!-- <div class="clearfix"></div>
                    <br><br>
                    <div class="buttons text-center">
                     <input type="button" style="margin: auto;" class="btn btn-primary btn-lg" id="test3" value="Continue" />
                    </div>
                    <br> -->

                    <div class="clearfix"></div>
                    <br><br>
                    <div class="buttons" style="width: 1100px;margin: 20px auto 0 auto;">
                        <div class="row">
                        <div class="col-md-6 text-left">
                            <button type="text" style="margin: auto;" class="btn btn-primary btn-lg" id="test" name="previous" value="E">Previous</button>
                        </div>
                        <div class="col-md-6 text-right">
                            <input type="button" style="margin: auto;" class="btn btn-primary btn-lg" id="test3" value="Next" />
                        </div>
                        </div>
                    </div>
                    <br>
                
            </form>
        </div>
    </section>
    <?php } ?>


    <?php if($sacId=="G"){ ?>
    <section style="background: #ffffff" class="content">    
    <br>
        <center><h1>Teanamics</h1></center>
        <div id="slider">
            <form method="post" id="questions_form" action="<?= base_url(); ?>test/processTest13">
                <input type="hidden" name="type" value="secG"/>
                <input type="hidden" name="cat_id" value="<?= $catId;?>"/>
                <ul class="questions_list">
                    <li style="text-align: left;">
                       
                         <table class="table-hover">
                            <thead>
                                <tr id="heading"> 
                                    <th class="text-center">Question</th>
                                    <th class="text-center" style="width: 100px;">Strongly Disagree</th>
                                    <th class="text-center" style="width: 100px;">Disagree</th>
                                    <th class="text-center" style="width: 100px;">Slightly Disagree</th>
                                    <th class="text-center" style="width: 100px;">Slightly Agree</th>
                                    <th class="text-center" style="width: 100px;">Agree</th>
                                    <th class="text-center" style="width: 100px;">Strongly Agree</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;
                            foreach ($secG as $key => $G) { ?>
                                <tr class="t3_row" id="<?= $i ?>">
                                    <td class="t3_q">
                                        <?= $G['question'] ?>
                                    </td>
                                    <td class="t3_a">
                                        <div class="text-center">
                                            <input type="radio" name="<?= "q".$i ?>" value="1" />
                                        </div>
                                    </td>
                                    <td class="t3_a">
                                        <div class="text-center" >
                                            <input type="radio" name="<?= "q".$i ?>" value="2" />
                                        </div>
                                    </td>
                                    <td class="t3_a">
                                        <div class="text-center" >
                                            <input type="radio" name="<?= "q".$i ?>" value="3" />
                                        </div>
                                    </td>
                                    <td class="t3_a">
                                        <div class="text-center" >
                                            <input type="radio" name="<?= "q".$i ?>" value="4" />
                                        </div>
                                    </td>
                                    <td class="t3_a">
                                        <div class="text-center" >
                                            <input type="radio" name="<?= "q".$i ?>" value="5" />
                                        </div>
                                    </td>
                                    <td class="t3_a">
                                        <div class="text-center" >
                                            <input type="radio" name="<?= "q".$i ?>" value="6" />
                                        </div>
                                    </td>
                                </tr>
                               <?php $i++; }  ?>
                            </tbody>
                        </table>
                        
                        <!--  -->
                    </li>
                    </ul>
                   <!-- <div class="clearfix"></div>
                    <br><br>
                    <div class="buttons text-center">
                     <input type="button" style="margin: auto;" class="btn btn-primary btn-lg" id="test3" value="Continue" />
                    </div>
                    <br> -->

                    <div class="clearfix"></div>
                    <br><br>
                    <div class="buttons" style="width: 1100px;margin: 20px auto 0 auto;">
                        <div class="row">
                        <div class="col-md-6 text-left">
                            <button type="text" style="margin: auto;" class="btn btn-primary btn-lg" id="test" name="previous" value="F">Previous</button>
                        </div>
                        <div class="col-md-6 text-right">
                            <input type="button" style="margin: auto;" class="btn btn-primary btn-lg" id="test3" value="Next" />
                        </div>
                        </div>
                    </div>
                    <br>
                
            </form>
        </div>
    </section>
    <?php } ?>


    <?php if($sacId=="H"){ ?>
    <section style="background: #ffffff" class="content">    
    <br>
        <center><h1>Teanamics</h1></center>
        <div id="slider">
            <form method="post" id="questions_form" action="<?= base_url(); ?>test/processTest13">
                <input type="hidden" name="type" value="final"/>
                <input type="hidden" name="cat_id" value="<?= $catId;?>"/>
                <ul class="questions_list">
                    <li style="text-align: left;">
                       
                         <table class="table-hover">
                            <thead>
                                <tr id="heading"> 
                                    <th class="text-center">Question</th>
                                    <th class="text-center" style="width: 100px;">Strongly Disagree</th>
                                    <th class="text-center" style="width: 100px;">Disagree</th>
                                    <th class="text-center" style="width: 100px;">Slightly Disagree</th>
                                    <th class="text-center" style="width: 100px;">Slightly Agree</th>
                                    <th class="text-center" style="width: 100px;">Agree</th>
                                    <th class="text-center" style="width: 100px;">Strongly Agree</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;
                            foreach ($secH as $key => $H) { ?>
                                <tr class="t3_row" id="<?= $i ?>">
                                    <td class="t3_q">
                                        <?= $H['question'] ?>
                                    </td>
                                    <td class="t3_a">
                                        <div class="text-center">
                                            <input type="radio" name="<?= "q".$i ?>" value="1" />
                                        </div>
                                    </td>
                                    <td class="t3_a">
                                        <div class="text-center" >
                                            <input type="radio" name="<?= "q".$i ?>" value="2" />
                                        </div>
                                    </td>
                                    <td class="t3_a">
                                        <div class="text-center" >
                                            <input type="radio" name="<?= "q".$i ?>" value="3" />
                                        </div>
                                    </td>
                                    <td class="t3_a">
                                        <div class="text-center" >
                                            <input type="radio" name="<?= "q".$i ?>" value="4" />
                                        </div>
                                    </td>
                                    <td class="t3_a">
                                        <div class="text-center" >
                                            <input type="radio" name="<?= "q".$i ?>" value="5" />
                                        </div>
                                    </td>
                                    <td class="t3_a">
                                        <div class="text-center" >
                                            <input type="radio" name="<?= "q".$i ?>" value="6" />
                                        </div>
                                    </td>
                                </tr>
                               <?php $i++; }  ?>
                            </tbody>
                        </table>
                        
                        <!--  -->
                    </li>
                    </ul>
                   <!-- <div class="clearfix"></div>
                    <br><br>
                    <div class="buttons text-center">
                     <input type="button" style="margin: auto;" class="btn btn-primary btn-lg" id="test3" value="Continue" />
                    </div>
                    <br> -->

                    <div class="clearfix"></div>
                    <br><br>
                    <div class="buttons" style="width: 1100px;margin: 20px auto 0 auto;">
                        <div class="row">
                        <div class="col-md-6 text-left">
                            <button type="text" style="margin: auto;" class="btn btn-primary btn-lg" id="test" name="previous" value="G">Previous</button>
                        </div>
                        <div class="col-md-6 text-right">
                            <input type="button" style="margin: auto;" class="btn btn-primary btn-lg" id="test3" value="Next" />
                        </div>
                        </div>
                    </div>
                    <br>
                
            </form>
        </div>
    </section>
    <?php } ?>



</div>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
        function introOne() {
        $('.intro1').hide();
        $('#slider').show();
        $("body").addClass("sidebar-collapse");
    }
</script>
<script>
    $(document).ready(function() {
    $("body").addClass("sidebar-collapse");

    $("#test3").click(function(){
        incorrect = false;
        
        $('.t3_row').each(function() {
            
            var q_id = $(this).attr("id");
            var bgOn = $(this).css('background-color');
            if(q_id!="heading")
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


</script>
