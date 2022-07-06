<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Test Administrator</h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <a href="<?= base_url(); ?>staff/create" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;Test Administrator</a>
                        <div class="box-tools">
                            <div style="width:200px;" class="input-group">
                                <input type="text" placeholder="Search" class="form-control input-sm pull-right" name="table_search">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php messageAlert(); ?>
                    <div class="box-body">
                        <div id="loaderDiv"></div>
                        <div class="table-responsive" id="staff-container">

                        </div><!-- /.box-body -->
                    </div>
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section>
</div>

<script type="text/javascript">
    $(function () {
        loadStaff(1);  //For first time page load default results
    });

    function loadStaff(page) {
        $("#loaderDiv").html(ajaxLoader);
        $.ajax({
            type: "POST",
            url: "<?= base_url() . 'staff/loadStaff'; ?>",
            data: "page=" + page,
            success: function (msg) {
                $("#staff-container").html(msg);
                $("#loaderDiv").html('');
            }
        });
    }
    
    function changeStatus(staffId, status) {
        var statusVal = 'active';
        if (status === 0) {
            statusVal = 'inactive';
        }
        $.ajax({
            url: "<?= base_url() . 'staff/changeStatus'; ?>",
            type: "POST",
            data: {'staff_id': staffId, 'status': statusVal},
            success: function (data) {
                if (data === 'active') {
                    $('#status-div-' + staffId).html("<a href='javascript:void(0)' onclick='changeStatus(" + staffId + ",0)'><img alt='active' src='<?= base_url(); ?>images/green-dot.png' /></a> ");
                } else {
                    $('#status-div-' + staffId).html("<a href='javascript:void(0)' onclick='changeStatus(" + staffId + ",1)'><img alt='inactive' src='<?= base_url(); ?>images/red-dot.png'/></a> ");
                }
            }
        });
    }

</script>