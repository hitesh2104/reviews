<table  class="table table-bordered table-striped" data-order="[[ 0, &quot;desc&quot; ]]" id="dataTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Contact Number</th>
            <th>Credit Request</th>
            <th>Credit Approved</th>
            <th>Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($creditResult)) {
            foreach ($creditResult as $value) {
                ?>
                <tr>
                    <td><?= $value->id; ?></td>
                    <td><?= $value->full_name; ?></td>
                    <td><?= $value->email; ?></td>
                    <td><?= $value->phone_no; ?></td>
                    <td><?= $value->credit_request; ?></td>
                    <td><?= $value->credit_approved?$value->credit_approved:'-'; ?></td>
                    <td><?= date('d/m/Y', strtotime($value->created_at)); ?></td>
                    <td><u><?= ucfirst($value->status); ?></u></td>
                    <td>
                        <ul  class="list-inline">
                        <?php if($value->status == 'active'){ ?>
                            <li><a href="javascript:void(0);" data-target="#credit-approve" data-toggle="modal" class="btn btn-success" onclick="approvePopup(<?= $value->id; ?>);">Approve</a></li>
                            <li><a href="javascript:void(0);" onclick="declineCreditRequest(<?= $value->id; ?>);" class="btn btn-danger">Decline</a></li>
                        <?php } else { ?>
                        <li><a href="#"><i class="fa fa-trash"></i></a></li>
                       <?php } ?>
                        </ul>
                    </td>
                </tr>
            <?php
            }
        } else {
            ?>
            <tr><td colspan="8"><div class="alert alert-danger error-alert">No record found.</div></td></tr>
<?php } ?>
    </tbody>
</table>

<?php
//echo get_pagination(6, 5, 1);
?>