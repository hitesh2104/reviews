<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div style="clear:both;"></div>
    <section class="content-header">
        <h1>My Account</h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <?php if (isSystemAdmin()) { ?>
                <div class="col-lg-4 col-xs-6">
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3><?= $masterAdminCount; ?></h3>
                            <p>Master Administrators</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-stalker"></i>
                        </div>
                    </div>
                </div>
                <?php } ?>
                
                <div class="col-md-8">
                    <?php if(@$message!=""){ echo $message; } ?>
                    <form class="form-horizontal" action="<?= base_url() ?>dashboard/change_password" method="post">

                      <div class="form-group">
                        <label class="control-label col-sm-4" for="pwd">Old Password:</label>
                        <div class="col-sm-8"> 
                          <input type="password" name="oldpass" class="form-control" id="oldpwd" placeholder="Enter Old Password">
                          <span class="text-danger" id="oldtext"></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-sm-4" for="pwd">New Password:</label>
                        <div class="col-sm-8"> 
                          <input type="password" name="newpass" class="form-control" id="newpwd" placeholder="Enter New password">
                          <span class="text-danger" id="newtext"></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-sm-4" for="pwd">Confirm Password:</label>
                        <div class="col-sm-8"> 
                          <input type="password" class="form-control" id="conpwd" placeholder="Enter Confirm Password">
                          <span class="text-danger" id="context"></span>
                        </div>
                      </div>
                      <div class="form-group"> 
                        <div class="col-sm-offset-4 col-sm-10">
                          <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                        </div>
                      </div>
                    </form>
                    
                </div>
        </div>
    </section>
</div>
<script type="text/javascript">
    $('document').ready(function(){
        $('#submit').click(function(){
           var flag=0;
           if($("#oldpwd").val()=="")
           {
                $("#oldtext").html("Please Enter Old Password");
                $("#oldpwd").parent("div").addClass("has-error");
                flag++;
           }

           if($("#newpwd").val()=="")
           {
                $("#newtext").html("Please Enter New Password");
                $("#newpwd").parent("div").addClass("has-error");
                flag++;
           }

           if($("#conpwd").val()=="")
           {
                $("#context").html("Please Enter Confirm Password");
                $("#conpwd").parent("div").addClass("has-error");
                flag++;
           }

           if($("#newpwd").val()!=$("#conpwd").val())
           {
                $("#context").html("Password Not Match");
                $("#conpwd").parent("div").addClass("has-error");
                flag++;
           }

           if(flag > 0)
           {
                return false;
           }
           else
           {
                return true;
           }

        });
    });
</script>