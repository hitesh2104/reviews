<table  class="table table-bordered table-striped">





    <thead>
        <tr>
            <th>Candidate Name</th>
            <th>Test Completed</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($candidateResult)) {
            foreach ($candidateResult as $value) {
                ?>
                <tr>
                    
                    <td><?= $value['candidate_name']; ?></td>
                    <td><?= $value['tc'] ?></td>
                    <td id="status-div-<?= $value['candidate_id']; ?>" style="text-align: center">
                        <?php if ($value['candidate_status'] == 'active') { ?>
                            <a href='javascript:void(0)' onclick='changeStatus("<?= $value['candidate_id']; ?>", 0)'><img alt="active" src='<?= base_url(); ?>images/green-dot.png' /></a>
                        <?php } else if ($value['candidate_status'] == 'inactive') { ?>
                            <a href='javascript:void(0)' onclick='changeStatus("<?= $value['candidate_id']; ?>", 1)'><img alt="inactive" src='<?= base_url(); ?>images/red-dot.png' /></a>
                        <?php
                        } else {
                            echo $value['candidate_status'];
                        }
                        ?>
                    </td>
                    <td>
                        <ul  class="list-inline">
            
                            <li><a target="_blank" href="<?= base_url() ?>candidate/candidate_details/<?= base64_encode($value['candidate_id']) ?>" title="Candidate Report"><i class="fa fa-file-pdf-o"></i></a></li>

                            <li><a href="<?= base_url() . 'user/resendLogin/' . $value['candidate_id'] . '/'.$project_id; ?>"><i class="fa fa-fast-forward" title="Resend Login Detail"></i></a></li>
                        </ul>
                    </td>
                </tr>
            <?php
            }
        } else {
            ?>
            <tr><td colspan="7"><div class="alert alert-danger error-alert">No candidate found.</div></td></tr>
<?php } ?>
    </tbody>
</table>

<?php
//echo get_pagination(6, 5, 1);?>