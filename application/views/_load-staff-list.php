<table  class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Staff Full Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($staffResult)) {
            foreach ($staffResult as $value) {
                ?>
                <tr>
                    <td><?= $value->full_name; ?></td>
                    <td><?= $value->email; ?></td>
                    <td><?= $value->phone_no; ?></td>
                    <td id="status-div-<?= $value->id; ?>">
                        <?php if ($value->status == 'active') { ?>
                            <a href='javascript:void(0)' onclick='changeStatus("<?= $value->id; ?>", 0)'><img alt="active" src='<?= base_url(); ?>images/green-dot.png' /></a>
                        <?php } else { ?>
                            <a href='javascript:void(0)' onclick='changeStatus("<?= $value->id; ?>", 1)'><img alt="inactive" src='<?= base_url(); ?>images/red-dot.png' /></a>
                        <?php } ?>   
                    </td>
                    <td>
                        <ul  class="list-inline">
                            <li><a href="<?= base_url() . 'staff/update/' . $value->id; ?>"><i class="fa fa-edit"></i></a></li>
                            <li><a href="javascript:void(0)"><i class="fa fa-trash"></i></a></li>
                        </ul>
                    </td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr><td colspan="5"><div class="alert alert-danger error-alert">No staff found.</div></td></tr>
        <?php } ?>
    </tbody>
</table>

<?php
//echo get_pagination(6, 5, 1);?>