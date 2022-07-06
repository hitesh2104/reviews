<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>My Test</h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <div class="table-responsive" id="test-container">
                            <table  class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Test Name</th>
                                        <th>Test Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
if (!empty($testDetail)) {
	foreach ($testDetail AS $test) {
		$testLink = 'test/begin/' . $test->id . '/' . $test->fk_test_id;
		?>
                                            <tr>
                                                <td><?=$test->test_name;?></td>
                                                <?php if ($test->test_status == 'active') {?>
                                                    <td><a href="<?=base_url() . $testLink;?>">Begin Test</a></td>
                                                    <?php
} elseif ($test->test_status == 'completed') {
			echo '<td>Completed</td>';
		} elseif ($test->test_status == 'progress') {
			?>
                                                    <td><a href="<?=base_url() . $testLink;?>">Resume Test</a></td>
                                                <?php }
		?>
                                            </tr>
                                            <?php
}
} else {
	?>
                                        <tr><td colspan="2"><div class="alert alert-danger error-alert">No test found.</div></td></tr>
                                    <?php }
?>
                                </tbody>
                            </table>
                        </div><!-- /.box-body -->
                    </div>
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section>
</div>