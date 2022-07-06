<table  class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Client</th>
            <th>Client Administrator</th>
            <th>Email</th>
            <th>Contact Number</th>
            <th>Credits</th>
            <th style="text-align: center;">Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($clientResult)) {
            foreach ($clientResult as $value) {
                ?>
                <tr>
                    <td><?= $value->client_name; ?></td>
                    <td><?= $value->full_name; ?></td>
                    <td><?= $value->email; ?></td>
                    <td><?= $value->phone_no; ?></td>
                    <td><?= $value->credits; ?></td>
                    <td id="status-div-<?= $value->id; ?>" style="text-align: center">
                        <?php if ($value->status == 'active') { ?>
                            <a href='javascript:void(0)' onclick='changeStatus("<?= $value->id; ?>", 0)'><img alt="active" src='<?= base_url(); ?>images/green-dot.png' /></a>
                        <?php } else { ?>
                            <a href='javascript:void(0)' onclick='changeStatus("<?= $value->id; ?>", 1)'><img alt="inactive" src='<?= base_url(); ?>images/red-dot.png' /></a>
                        <?php } ?>   
                    </td>
                    <td>
                        <ul  class="list-inline">
                            <!--<li><a href="#"><i class="fa fa-eye"></i></a></li>-->
                            <li><a href="<?= base_url() . 'client/update/' . base64_encode($value->id); ?>"><i class="fa fa-edit"></i></a></li>
                            <!--<li><a href="#"><i class="fa fa-trash"></i></a></li>-->
                        </ul>
                    </td>
                </tr>
            <?php
            }
        } else {
            ?>
            <tr><td colspan="7"><div class="alert alert-danger error-alert">No record found.</div></td></tr>
<?php } ?>
    </tbody>
</table>

<?php
//echo get_pagination(6, 5, 1);?>