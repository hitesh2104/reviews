<table  class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Project Name</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Total Active Candidates</th>
            <th>Test completed By Candidate</th>
            <th>Status</th>
            <th>Action</th>
            <th>Candidates</th>
            <th>Generate Link</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($projectResult)) {
            foreach ($projectResult as $value) {
                $registeredCandidate = $this->common->getRegisteredCandidate($value->id);
                $testCompleted = $this->common->getTotalTestCompleted($value->id);
                ?>
                <tr>
                    <td><?= $value->project_name; ?></td>
                    <td><?= $value->start_date; ?></td>
                    <td><?= $value->end_date; ?></td>
                    <td><?= $registeredCandidate; ?></td>
                    <td><?= $testCompleted; ?></td>
                    <!--  -->
                        <td id="status-div-<?= $value->id; ?>" style="text-align: center">
                        <?php if ($value->status == 'active') { ?>
                            <a href='javascript:void(0)' onclick='changeStatus("<?= $value->id; ?>", 0)'><img alt="active" src='<?= base_url(); ?>images/green-dot.png' /></a>
                        <?php } else if ($value->status == 'pause') { ?>
                            <a href='javascript:void(0)' onclick='changeStatus("<?= $value->id; ?>", 1)'><img alt="inactive" src='<?= base_url(); ?>images/red-dot.png' /></a>
                        <?php
                        } else {
                            echo $value->status;
                        }
                        ?>
                    </td>
                    <!--  -->
                    <td>
                        <ul  class="list-inline">
                            <li><a href="<?= base_url() . 'project/update/' . $value->id; ?>"><i class="fa fa-edit"></i></a></li>
								<?php if(strpos($value->test_list, '20')) { ?>
                             <a href="<?=base_url();?>candidate/candidate_excel_report/<?= $value->id; ?>" style="margin-left: 10px;" title="Download Sales Report"><i class="fa fa-file-excel-o"></i></a>
                            <?php } ?>
                        </ul>
                    </td>
                    <td>
                        <ul  class="list-inline">
                            <li><a href="<?= base_url() . 'project/getProjectCandidate/' . $value->id; ?>"><i class="fa fa-users"></i></a></li>
                        </ul>
                    </td>
                    <td>
                        <ul  class="list-inline">
                            <li>
                                <?php if ($value->status == 'active') { ?>
                                <span id="<?= $value->id ?>" onclick="Glink(<?= $value->id ?>)" style="display: block; cursor: pointer; color: #3c8dbc;"><i class="fa fa-link"></i></span>
                                <?php } ?>
                            </li>
                        </ul>
                    </td>
                    
                </tr>
                <?php
            }
        } else {
            ?>
            <tr><td colspan="7"><div class="alert alert-danger error-alert">No project found.</div></td></tr>
        <?php } ?>
    </tbody>
</table>

<?php
//echo get_pagination(6, 5, 1);?>


<script type="text/javascript">
        function Glink(id)
        {
            $.ajax({
                url: "<?= base_url() ?>project/generateLink/"+id,
                method : "post",
                success : function(msg)
                {
                    alert('project link '+msg+' sent to your email.');
                }
            });
        }
</script>