<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div style="clear:both;"></div>
    <section class="content-header">
        <h1>Dashboard</h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
        <div class="box">
        <div class="box-body">
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
                <div class="col-lg-4 col-xs-6">
                    <div class="small-box bg-blue">
                        <div class="inner">
                            <h3><?= $incommingCreditRequest; ?></h3>
                            <p>Credit Requests</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-stalker"></i>
                        </div>
                    </div>
                </div>
            <?php } elseif (isMasterAdmin()) { ?>

                <div class="col-lg-4 col-xs-6">
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3><?= $clientCount; ?></h3>
                            <p>Clients</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xs-6">
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3><?= $projectCount; ?></h3>
                            <p>Projects Created</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xs-6">
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3><?= $candidateCount; ?></h3>
                            <p>Candidate Registrations</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xs-6">
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3><?= $userCredit ? $userCredit : '0'; ?></h3>
                            <p>Credits</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xs-6">
                    <div class="small-box bg-blue">
                        <div class="inner">
                            <h3><?= $incommingCreditRequest; ?></h3>
                            <p>Credit Requests</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-stalker"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xs-6">
                    <div class="small-box bg-blue" style=" background:#8D8D8D !important;">
                        <div class="inner">
                            <h3><?= $jspCount; ?></h3>
                            <p>Job Success Profile</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                    </div>
                </div>
            <?php } elseif (isClient()) { ?>
                <div class="col-lg-4 col-xs-6">
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3><?= $staffCount; ?></h3>
                            <p>Test Administrators</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xs-6">
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3><?= $projectCount; ?></h3>
                            <p>Projects</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xs-6">
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3><?= $candidateCount; ?></h3>
                            <p>Candidate Registrations</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xs-6">
                    <div class="small-box bg-blue">
                        <div class="inner">
                            <h3><?= $userCredit ? $userCredit : '0'; ?></h3>
                            <p>My Credits</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-stalker"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xs-6">
                    <div class="small-box bg-blue" style=" background:#8D8D8D !important;">
                        <div class="inner">
                            <h3><?= $jspCount; ?></h3>
                            <p>Job Success Profile</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                    </div>
                </div> 
            <?php } elseif (isStaff()) { ?>
                <div class="col-lg-4 col-xs-6">
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3><?= $projectCount; ?></h3>
                            <p>Projects</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xs-6">
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3><?= $candidateCount; ?></h3>
                            <p>Candidate Registrations</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xs-6">
                    <div class="small-box bg-blue" style=" background:#8D8D8D !important;">
                        <div class="inner">
                            <h3><?= $jspCount; ?></h3>
                            <p>Job Success Profile</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        </div>
        </div>
    </section>
</div>