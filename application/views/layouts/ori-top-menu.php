<!-- Main Header -->
<header class="main-header">
    <!-- Logo -->
    <a href="<?= base_url() ?>candidate/test" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>AH</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
            <?= $dashboardTitle; ?>
        </span>
    </a>
    
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation" style="background-color: #ecf0f5;">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                    <img class="pull-right" src="<?= base_url() ?>images/logo.png" height="100" width="" alt="" style="padding: 5px 5px">
                    <a href="#" style="" class="dropdown-toggle" data-toggle="dropdown"> 
                     <!--<img src="<?= base_url(); ?>images/user.jpg" class="user-image" alt="User Image">-->              
                        <span class="hidden-xs pull-right" style="color: #000;"><b>Welcome, <?= getUserName(); ?></b></span>
                    </a>
                    <ul class="dropdown-menu">                
                        <li class="user-body">
                            <?php if (isStaff()) { ?>
                                <a href="<?= base_url(); ?>staff/account"><b>My Account</b></a>
                            <?php } elseif (isCandidate() && ($testCheck != 'register' && $testCheck != 'consent')) { ?>
                                <a href="<?= base_url(); ?>candidate/test"><b>My Test</b></a>
                                <a href="<?= base_url(); ?>candidate/details"><b>My Details</b></a>
                            <?php } else { ?>
                                <a href="<?= base_url(); ?>dashboard/my_account"><b>My Account</b></a>
                            <?php } ?>
                            <a href="<?= base_url(); ?>dashboard/change_password"><b>Setting</b></a>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <!--<div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>-->
                            <div class="pull-right">
                                <a href="<?= base_url(); ?>dashboard/logout" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>