<style type="text/css">
    <!--
    table.page_header {width: 100%; border: none; background-color: #0071C5; border-bottom: solid 1mm #ccc; padding: 2mm }
    table.page_footer {width: 100%; border: none; background-color: #0071C5; border-top: solid 1mm #ccc; padding: 2mm}
    table.main_page
    {
        padding: 0;
        border: 1px solid #d1d1d1;
        font-size: 11pt;
        background: #FFFFFF;
        text-align: center;
        vertical-align: middle;
    }

    td
    {
        padding: 5px 10px;
        border: solid 1px #D7D7D7;
    }

    td.div
    {
        width: 110px;
        height: 110px;
        text-align: left;
        padding: 0
    }

    td.div div
    {
        margin: auto;
        background: yellow;
        border: solid 2px blue;
        color: red;
        width: 100px;
        height: 65px;
        text-align: center;
    }
    .page_header td {border:none;}
    .page_footer td {border:none;}
    -->
</style>
<page backtop="14mm" backbottom="14mm" backleft="10mm" backright="10mm" style="font-size: 12pt">
    <page_header>
        <table class="page_header">
            <tr>
                <td style="width: 100%; height: 80px;">
                </td>
            </tr>
        </table>
    </page_header>
    <page_footer>
        <table class="page_footer">
            <tr>
                <td style="width: 100%; text-align: center;">
                    Powered by Assessmenthouse.com
                </td>
            </tr>
            <tr>
                <td style="width: 100%; text-align: center">
                    Copyright &copy; Assessmenthouse 
                </td>
            </tr>
        </table>
    </page_footer>
    <br><br><br><br><br><br>
    <div style="text-align: center; width: 100%; height: 50px;">
        <img src="<?= $_SERVER['DOCUMENT_ROOT'] ?>/images/report_image/logo2.png">
        <br>
    </div>

    <div>
        <h1><?= $rTitle ?></h1>
    </div>
    <div>
        <h2><?php echo $uName; ?></h2>
    </div>
    <div>
        <h4>DATE:&nbsp;&nbsp;<span><?php echo date('d/m/Y'); ?></span></h4>
    </div>
    <div><h4>RESULTS:</h4></div>
    <?php
    $img = $_SERVER['DOCUMENT_ROOT'].'/images/report_image/score_'.$score.'.png';
    ?>
    <div style="text-align: center; width: 100%;">
        <img src="<?php echo $img; ?>">
    </div>
    <br/><br/>
    <table style="background: #FFFFFF;" class="main_page">
        <tr style="background-color: lightgray;">
            <td style="width: 33.3%;text-align: center; color: white; background: red;">1 - 3 <br/><b>Low</b></td>
            <td style="width: 33.3%;text-align:center; color: white; background: #ff944d;">4 - 6 <br/><b>Effective</b></td>
            <td style="width: 33.3%;text-align:center; color: white; background: #009900;">7 - 10 <br/><b>Enhanced</b></td>
        </tr>
        <tr>
            <td style="width: 33.3%;text-align: left; color: white; background: red;">
                The candidate might find it very<br/> 
                challenging interpreting and<br/>
                working with verbal information<br/>
                and instructions. The candidate<br/>
                might not always understand and<br/>
                think logically when working with<br/>
                written information.
            </td>
            <td style="width: 33.3%;text-align: left; color: white; background: #ff944d;">
                The candidate should find it fairly<br/>
                easy interpreting and working<br/>
                with verbal information. The<br/>
                candidate should understand and<br/>
                think logically when working with<br/>
                written information.
            </td>
            <td style="width: 33.3%;text-align: left; color: white; background: #009900;">
                The candidate should find it very<br/>
                easy interpreting and working<br/>
                with verbal information and<br/>
                instructions. The candidate<br/>
                should find it exceptionally easy<br/>
                to understand and think logically<br/>
                when working with written<br/>
                information.
            </td>
        </tr>
    </table>
</page>