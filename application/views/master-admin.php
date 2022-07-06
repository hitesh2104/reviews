<link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Manage Master Administrator</h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <a href="<?= base_url(); ?>user/masteradmincreate" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;Add Master Administrator</a>
                        <div class="box-tools">
                            <div style="width:200px;" class="input-group">
                                <input type="text" placeholder="Search" class="form-control input-sm pull-right" id="table-search" name="table_search">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php messageAlert(); ?>
                    <div class="box-body">
                        <div id="loaderDiv"></div>
                        <div class="table-responsive" id="admin-container">

                        </div><!-- /.box-body -->
                    </div>
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section>
</div>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(function () {
        loadClient(1);  //For first time page load default results
    });

    function loadClient(page) {
        $("#loaderDiv").html(ajaxLoader);
        $.ajax({
            type: "POST",
            url: "<?= base_url() . 'user/loadMasterAdminList'; ?>",
            data: "page=" + page,
            success: function (msg) {
                $("#admin-container").html(msg);
                $("#loaderDiv").html('');

                //DataTable

                oTable = $('#dataTable').DataTable();
                $("#dataTable_filter").hide();
                $('#table-search').keyup(function(){
                      oTable.search($(this).val()).draw() ;
                })
            }
        });
    }

    function changeStatus(masterAdminId, status) {
        var statusVal = 'active';
        if (status === 0) {
            statusVal = 'inactive';
        }
        $.ajax({
            url: "<?= base_url() . 'user/changeStatus'; ?>",
            type: "POST",
            data: {'user_id': masterAdminId, 'status': statusVal},
            success: function (data) {
                if (data === 'active') {
                    $('#status-div-' + masterAdminId).html("<a href='javascript:void(0)' onclick='changeStatus(" + masterAdminId + ",0)'><img alt='active' src='<?= base_url(); ?>images/green-dot.png' /></a> ");
                } else {
                    $('#status-div-' + masterAdminId).html("<a href='javascript:void(0)' onclick='changeStatus(" + masterAdminId + ",1)'><img alt='inactive' src='<?= base_url(); ?>images/red-dot.png'/></a> ");
                }
            }
        });
    }

</script>