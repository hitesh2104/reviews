<table  class="table table-bordered table-striped" id="dataTable">
    <thead>
        <tr>
            <th>Candidate Name</th>
            <th>Client Name</th>
            <!-- <th>Client Admin</th> -->
            <th>Project Name</th>
            <!--th>test list</th-->
            <th width="5%">Status</th>
            <th width="5%">Action</th>
        </tr>
    </thead>
    <tfoot style=" display: table-header-group;">
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th> 
            <th></th>
        </tr>
    </tfoot>
    <tbody>
        <?php
        if (!empty($candidateResult)) {

            foreach ($candidateResult as $value) {
                ?>
                <tr>
                    
                    <td>
                    <a href="<?= base_url() ?>candidate/candidate_details/<?= base64_encode($value->candidate_id) ?>"><?= $value->candidate_name; ?></a>
                    </td>
                     <td><?= $value->client_name?$value->client_name:'-'; ?></td>
                    <!-- <td><?= $value->client_admin_name?$value->client_admin_name:'-'; ?></td>  -->
                    <td><?= $value->project_name; ?></td>
                    <!--td><?= $value->test_list; ?></td-->
                    <td id="status-div-<?= $value->candidate_id; ?>" style="text-align: center">
                        <?php if ($value->candidate_status == 'active') { ?>
                            <a href='javascript:void(0)' onclick='changeStatus("<?= $value->candidate_id; ?>", 0)'><img alt="active" src='<?= base_url(); ?>images/green-dot.png' /></a>
                        <?php } else if ($value->candidate_status == 'inactive') { ?>
                            <a href='javascript:void(0)' onclick='changeStatus("<?= $value->candidate_id; ?>", 1)'><img alt="inactive" src='<?= base_url(); ?>images/red-dot.png' /></a>
                        <?php
                        } else {
                            echo $value->candidate_status;
                        }
                        ?>
                    </td>
                    <td>
                        <ul  class="list-inline">
                            <!--<li><a href="#"><i class="fa fa-eye"></i></a></li>-->
                            <li><a href="<?= base_url() . 'candidate/update/' . base64_encode($value->candidate_id); ?>"><i class="fa fa-edit"></i></a></li>
                            <!--<li><a href="#">pause</a></li>-->
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

//echo get_pagination(6, 5, 1);

?>