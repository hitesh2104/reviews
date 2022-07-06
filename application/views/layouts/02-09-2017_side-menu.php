<?php 
$controllerName = $this->uri->segment(2);
$actionName = $this->uri->segment(3);
?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu" style="margin-top: 30px;">   
            <!-- MASTER ADMIN -->
            <?php if(isSystemAdmin()){?>
            <li class="<?php if($controllerName == 'dashboard') echo 'active';?>">
                <a href="<?= base_url(); ?>dashboard"><i class="fa fa-dashboard"></i><span>Dashboard</span></a>
            </li>
            <li class="<?php if($controllerName == 'user') echo 'active';?>">
                <a href="<?= base_url(); ?>user/managemasteradmin"><i class="fa fa-user"></i><span>Master Administrators</span></a>
            </li>
            <li class="<?php if($controllerName == 'user') echo 'active';?>">
                <a href="<?= base_url(); ?>user/userlist"><i class="fa fa-user"></i><span>Users</span></a>
            </li>
            <li class="<?php if($controllerName == 'credit') echo 'active';?>">
                <a href="<?= base_url(); ?>credit/managecreditrequest"><i class="fa fa-user"></i><span>Admin Credit Request</span></a>
            </li>
            <?php } ?>
            <!-- MASTER ADMIN -->
            <?php if(isMasterAdmin()){?>
            <li class="<?php if($controllerName == 'dashboard') echo 'active';?>">
                <a href="<?= base_url(); ?>dashboard"><i class="fa fa-dashboard"></i><span>Dashboard</span></a>
            </li>
            <li class="<?php if($controllerName == 'client') echo 'active';?>">
                <a href="<?= base_url(); ?>client/manageclient"><i class="fa fa-user"></i><span>Clients</span></a>
            </li>
            <li class="<?php if($controllerName == 'project') echo 'active';?>">
                <a href="<?= base_url(); ?>project/manageproject"><i class="fa fa-user"></i><span>Projects</span></a>
            </li>
            <li class="<?php if($controllerName == 'candidate') echo 'active';?>">
                <a href="<?= base_url(); ?>candidate/managecandidate"><i class="fa fa-users"></i><span>Candidates</span></a>
            </li>
            <!-- <li class="<?php if($controllerName == 'report') echo 'active';?>">
                <a href="javascript:void(0);"><i class="fa fa-users"></i><span>Reports</span></a>
            </li> -->
            <li class="<?php if($controllerName == 'credit') echo 'active';?>">
                <a href="<?= base_url(); ?>credit/managecredit"><i class="fa fa-users"></i><span>My Credits</span></a>
            </li>
            <li class="<?php if($controllerName == 'credit') echo 'active';?>">
                <a href="<?= base_url(); ?>credit/managecreditrequest"><i class="fa fa-user"></i><span>Client Credit Request</span></a>
            </li>
            <?php } ?>
            <!-- CLIENT -->
            <?php if(isClient()){?>
            <li class="<?php if($controllerName == 'dashboard') echo 'active';?>">
                <a href="<?= base_url(); ?>dashboard"><i class="fa fa-dashboard"></i><span>Dashboard</span></a>
            </li>
            <li class="<?php if($controllerName == 'staff') echo 'active';?>">
                <a href="<?= base_url(); ?>staff/managestaff"><i class="fa fa-user"></i><span>Test Administrator</span></a>
            </li>
            <li class="<?php if($controllerName == 'project') echo 'active';?>">
                <a href="<?= base_url(); ?>project/manageproject"><i class="fa fa-user"></i><span>Projects</span></a>
            </li>
            <li class="<?php if($controllerName == 'candidate') echo 'active';?>">
                <a href="<?= base_url(); ?>candidate/managecandidate"><i class="fa fa-users"></i><span>Candidates</span></a>
            </li>
            <!-- <li class="<?php if($controllerName == 'report') echo 'active';?>">
                <a href="javascript:void(0);"><i class="fa fa-users"></i><span>Reports</span></a>
            </li> -->
            <li class="<?php if($controllerName == 'credit') echo 'active';?>">
                <a href="<?= base_url(); ?>credit/managecredit"><i class="fa fa-users"></i><span>My Credits</span></a>
            </li>
            <!-- <li class="<?php if($controllerName == 'credit') echo 'active';?>">
                <a href="<?= base_url(); ?>credit/managecreditrequest"><i class="fa fa-user"></i><span>Staff Credit Request</span></a>
            </li> -->
            <?php } ?>
            <!-- STAFF -->
            <?php if(isStaff()){?>
            <li class="<?php if($controllerName == 'dashboard') echo 'active';?>">
                <a href="<?= base_url(); ?>dashboard"><i class="fa fa-dashboard"></i><span>Dashboard</span></a>
            </li>
            <li class="<?php if($controllerName == 'project') echo 'active';?>">
                <a href="<?= base_url(); ?>project/manageproject"><i class="fa fa-user"></i><span>Projects</span></a>
            </li>
            <li class="<?php if($controllerName == 'candidate') echo 'active';?>">
                <a href="<?= base_url(); ?>candidate/managecandidate"><i class="fa fa-users"></i><span>Candidates</span></a>
            </li>
            <!-- <li class="<?php if($controllerName == 'report') echo 'active';?>">
                <a href="javascript:void(0);"><i class="fa fa-users"></i><span>Reports</span></a>
            </li> -->
            <?php } ?>
            <!-- CANDIDATE -->
            <?php if(isCandidate() && ($testCheck != 'register' && $testCheck != 'consent')){?>
            <li class="<?php if($actionName == 'test') echo 'active';?>">
                <a href="<?= base_url(); ?>candidate/test"><i class="fa fa-user"></i><span>My Tests</span></a>
            </li>
            <?php } ?>
        </ul>
    </section>       
</aside>