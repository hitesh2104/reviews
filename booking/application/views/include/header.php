<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title><?php echo APP_NAME ?> | <?php echo $page_title; ?></title>

    <link rel="stylesheet" href="<?php echo base_url();?>assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/font-icons/entypo/css/entypo.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/font-icons/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/neon-core.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/neon-theme.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/neon-forms.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/custom.css?rand=<?php echo DO_NO_CACHE ?>">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/parsley.css">
    
    <link rel="stylesheet" href="<?php echo base_url()?>assets/js/datatables/dataTables.bootstrap.css"/>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/skins/blue.css">
    <script src="<?php echo base_url();?>assets/js/jquery-1.11.0.min.js"></script>
    <!-- <script>$.noConflict();</script> -->
    <style>
        .dt_table th{
            background: #21b6ee !important;
            color: white !important;
            font-weight: bold;
        }
    </style>
    <script>
        var base_url = '<?php echo base_url(); ?>';
    </script>

</head>
<body class="page-body  page-fade">

    <div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
        
        <div class="sidebar-menu fixed">

            <div class="sidebar-menu-inner">
                
                <header class="logo-env">

                    <!-- logo -->
                    <div class="logo">
                        <a href="<?php echo base_url("home"); ?>" >
                         <img src="<?php echo base_url();?>assets/images/logo.png" width="120" alt="" />
                         <!-- <h4 style="color:white"> <b> <?php echo APP_NAME ?></b></h4> -->
                     </a>
                 </div>

                 <!-- logo collapse icon -->
                 <div class="sidebar-collapse">
                    <a href="#" class="sidebar-collapse-icon"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
                        <i class="entypo-menu"></i>
                    </a>
                </div>

                
                <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
                <div class="sidebar-mobile-menu visible-xs">
                    <a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
                        <i class="entypo-menu"></i>
                    </a>
                </div>

            </header>
            
            
            <ul id="main-menu" class="main-menu">
              <?php // if(is_admin() || is_client()){ ?>
              <li>
                <a href="<?php echo base_url("home"); ?>" >
                    <i class="fa fa-home"></i>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            <?php // } ?>
            <?php if(is_admin() || is_client() || is_client_manager()){ ?>
            <li>
                <a href="<?php echo base_url("bookings/view"); ?>" >
                    <i class="fa fa-calendar-o"></i>
                    <span class="title">View Bookings</span>
                </a>
            </li>
            <?php } ?>
            <?php if(is_admin()  || is_client_manager()){ ?>
            <li>
                <a href="<?php echo base_url("users/view"); ?>" >
                    <i class="entypo-users"></i>
                    <span class="title">View Clients</span>
                </a>
            </li>
            <?php } ?>
              <?php if(is_admin()){ ?>
            <li>
                <a href="<?php echo base_url("users/manager/add"); ?>" >
                    <i class="entypo-users"></i>
                    <span class="title">Add Managers</span>
                </a>
            </li>
            <?php } ?>
            <?php if(is_admin()){ ?>
            <li>
                <a href="<?php echo base_url("products/view"); ?>" >
                    <i class="fa fa-shopping-cart"></i>
                    <span class="title">Products</span>
                </a>
            </li>
            <?php } ?>
            <?php if(is_admin() || is_client()  || is_client_manager()){ ?>
            <li>
                <a href="<?php echo base_url("users/candidates"); ?>" >
                    <i class="fa fa-user"></i>
                    <span class="title">Candidates</span>
                </a>
            </li>
            <?php } ?>
            
            <?php if(is_candidate()){ ?>
            <li>
                <a href="<?php echo base_url("users/profile/edit"); ?>" >
                    <i class="fa fa-user"></i>
                    <span class="title">Edit Profile</span>
                </a>
            </li>
            
            <li>
                <a href="<?php echo base_url('documents') ?>" >
                    <i class="fa fa-folder-open-o"></i>
                    <span class="title">Documents</span>
                </a>
            </li>
            <?php } ?>
            
        </ul>
        
    </div>

</div>

<div class="main-content">
    
    <div class="row">
        
        <!-- Profile Info and Notifications -->
        <div class="col-md-12 col-sm-12 clearfix">
            
            <ul class="user-info pull-right pull-none-xsm">
                
                <!-- Profile Info -->
                <li class="profile-info dropdown"><!-- add class "pull-right" if you want to place this from right -->
                    
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?php
                        
                        echo $this->session->userdata("full_name");  
                        ?> 
                        <i class="entypo-down-open"></i>
                    </a>
                    
                    <ul class="dropdown-menu">
                        
                        <!-- Reverse Caret -->
                        <li class="caret"></li>
                        <?php if(is_admin() || is_client()){ ?>
                        <!-- Profile sub-links -->
                        <li>
                            <a href="<?php echo base_url('users/profile/edit'); ?>">
                                <i class="entypo-user"></i>
                                Edit Profile
                            </a>
                        </li>
                        
                        <li>
                            <a href="<?php echo base_url('users/profile/edit?update_password=1'); ?>">
                                <i class="entypo-mail"></i>
                                Change Password
                            </a>
                        </li>
                        <?php } ?>
                        <li>
                            <a href="<?php echo base_url('logout');?>">
                                <i class="entypo-logout "></i>
                                Log Out 
                            </a>
                        </li>
                    </ul>
                </li>
                
            </ul>
        </div>
    </div>
    
    <hr />