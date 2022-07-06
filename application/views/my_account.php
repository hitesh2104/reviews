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
                <!-- <div class="col-lg-4 col-xs-6">
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3><?= $masterAdminCount; ?></h3>
                            <p>Master Administrators</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-stalker"></i>
                        </div>
                    </div>
                </div> -->
                <?php } ?>
                
                <div class="col-md-6">
                    <table class="table table-responsive table-striped">
                        <tr>
                            <td>Role</td>
                            <td><?= $user_details[0]->role ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><?= $user_details[0]->email ?></td>
                        </tr>
                        <tr>
                            <td>Full Name</td>
                            <td><?= $user_details[0]->full_name ?></td>
                        </tr>
                        <!-- <tr>
                            <td>First Name</td>
                            <td><?= $user_details[0]->first_name ?></td>
                        </tr>
                        <tr>
                            <td>Middle Name</td>
                            <td><?= $user_details[0]->middle_name ?></td>
                        </tr>
                        <tr>
                            <td>Last Name</td>
                            <td><?= $user_details[0]->last_name ?></td>
                        </tr> -->
                        <!-- <tr>
                            <td>Date OF Birth</td>
                            <td><?= $user_details[0]->dob ?></td>
                        </tr> -->
                        <tr>
                            <td>Phone No</td>
                            <td><?= $user_details[0]->phone_no ?></td>
                        </tr>
                        <tr>
                            <td>Credits</td>
                            <td><?= $user_details[0]->credits ?></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td><?= $user_details[0]->status ?></td>
                        </tr>
                    </table>
                </div>
        </div>
    </section>
</div>