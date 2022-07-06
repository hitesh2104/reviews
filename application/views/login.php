<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Welcome To AssessmentHouse</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="<?= base_url(); ?>css/bootstrap.min.css">
        <link rel="stylesheet" href="<?= base_url(); ?>css/font-awesome.min.css">
        <link rel="stylesheet" href="<?= base_url(); ?>css/ionicons.min.css">
        <link rel="stylesheet" href="<?= base_url(); ?>css/_all-skins.min.css">
        <link rel="stylesheet" href="<?= base_url(); ?>css/AdminLTE.min.css">
        <link rel="stylesheet" href="<?= base_url(); ?>css/custom.css">
    </head>
    <body class="hold-transition login-page" style="background: url(<?= base_url()."images/ahback.png" ?>) no-repeat center center fixed;-webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;">
        <div class="login-box">
            <div class="login-logo">
                <img src="<?= base_url(); ?>/images/logo.png" height="100px">
            </div><!-- /.login-logo -->
            <div class="login-box-body">
                <?php messageAlert(); ?>
                <?php if ($this->session->flashdata('login_error')) { ?>
                    <div class="alert alert-danger error-alert"><?= $this->session->flashdata('login_error'); ?></div>
                <?php } ?>
                <form method="post" id="login-form" name="login-form">
                    <div class="form-group has-feedback">
                        <input type="text" name="username" class="form-control" placeholder="Email or Username" value="<?php
                        if (get_cookie('remember_email')) {
                            echo get_cookie('remember_email');
                        } else {
                            echo '';
                        }
                        ?>"/>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        <?php echo form_error('password', '<span class="error_msg" for="password" generated="true">', '</span>'); ?>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" name="password" class="form-control" placeholder="Password" valu="<?php
                        if (get_cookie('remember_password')) {
                            echo get_cookie('remember_password');
                        } else {
                            echo '';
                        }
                        ?>"/>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        <?php echo form_error('password', '<span class="error_msg" for="password" generated="true">', '</span>'); ?>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="checkbox">
                                <label class="checkbox">
                                    <input type="checkbox" name="remember" <?php
                                    if (get_cookie('remember')) {
                                        echo 'checked="checked"';
                                    }
                                    ?>/> Remember Me
                                </label>
                            </div>
                        </div><!-- /.col -->
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                        </div><!-- /.col -->
                    </div>
                </form>
                <!-- /.social-auth-links -->
                <a href="" data-toggle="modal" data-target="#myModal">I forgot my password</a>
            </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->
        <!-- Forgot Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <form id="forgotform" name="forgot-form" action="<?= base_url('login/forgot_password') ?>" method="post">
                    <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Forgot Password</h4>
                  </div>
                  <div class="modal-body">
                    <input type="text" name="useremail" class="form-control valid" placeholder="Email" aria-required="true" aria-invalid="false">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                  </div>
                    </div>
                </form>
              </div>
            </div>
        <!-- End Forgot Modal -->
        <script src="<?= base_url(); ?>js/jQuery-2.1.4.min.js"></script>
        <script src="<?= base_url(); ?>js/bootstrap.min.js"></script>
        <script src="<?= base_url(); ?>js/app.js"></script>
        <script src="<?= base_url(); ?>js/jquery.validate.min.js"></script>
    </body>
</html>
<script type="text/javascript">
    $(function () {
        $("#forgotform").validate({
            errorElement: "span",
            errorClass: "error_msg",
            rules: {//set rules
                useremail: {
                    required: true,
                    email: true,
                    remote: "<?= base_url('login/check_email'); ?>"
                }
            },
            messages: {//set messages to appear inline
                useremail: {
                    required: "Oops! we need email address.",
                    email: "Oops! email you have entered is incorrect.",
                    remote: "Oops! email you have entered is not found."
                }
            },
            // submitHandler: function() {
            //     $.ajax({
            //         url: form.action,
            //         type: form.method,
            //         data: $(form).serialize(),
            //         success: function(response) {
            //             alert(response);
            //         }            
            //     });
            // },
            highlight: function (element, errorClass) {
                $(element).removeClass(errorClass);
            }
        });

        $("#login-form").validate({
            errorElement: "span",
            errorClass: "error_msg",
            rules: {//set rules
                username: {
                    required: true
                },
                password: {
                    required: true
                }
            },
            messages: {//set messages to appear inline
                username: {
                    required: "Please enter your email or username."
                },
                password: {
                    required: "Please enter your password."
                }
            },
            highlight: function (element, errorClass) {
                $(element).removeClass(errorClass);
            }
        });
        $('.error-alert').delay(5000).fadeOut(400);
    });
</script>
