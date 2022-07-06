<table  class="table table-bordered table-striped" id="dataTable">
    <thead>
        <tr>
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
                    <td><?= $value->credit_request; ?></td>
                    <td><?= $value->credit_approved ? $value->credit_approved : '-'; ?></td>
                    <td><?= date('d/m/Y', strtotime($value->created_at)); ?></td>
                    <td><u><?= ucfirst($value->status); ?></u></td>
        <td>
            <ul  class="list-inline">
                <li><a href="#"><i class="fa fa-trash"></i></a></li>
            </ul>
        </td>
        </tr>
        <?php
    }
} else {
    ?>
    <tr><td colspan="5"><div class="alert alert-danger error-alert">No record found.</div></td></tr>
<?php } ?>
</tbody>
</table>

<?php
//echo get_pagination(6, 5, 1);
?>