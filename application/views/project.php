<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Manage Projects</h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <a href="<?=base_url();?>project/create" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;Add Project</a>
                        <?php if ($this->session->userdata('logged_in')['user_id'] == 609) {?>
                        <a href="<?=base_url();?>candidate/Personality_Teanamics_Validation" class="btn btn-success" target="_blank"><i class="fa fa-file-excel"></i>&nbsp;Export Excel</a>
                        <?php }?>
                        <div class="box-tools">
                            <div style="width:200px;" class="input-group">
                                <input type="text" placeholder="Search" class="form-control input-sm pull-right" name="table_search">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php messageAlert();?>
                    <div class="box-body">
                        <div id="loaderDiv"></div>
                        <div class="table-responsive" id="project-container">

                        </div><!-- /.box-body -->
                    </div>
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section>
</div>

<script type="text/javascript">
    $(function () {
        loadProject(1);  //For first time page load default results
    });

    function loadProject(page) {
        $("#loaderDiv").html(ajaxLoader);
        $.ajax({
            type: "POST",
            url: "<?=base_url() . 'project/loadProject';?>",
            data: "page=" + page,
            success: function (msg) {
                $("#project-container").html(msg);
                $("#loaderDiv").html('');
            }
        });
    }

    function changeStatus(projectId, status) {
        var statusVal = 'active';
        var statusProject = 'active';
        if (status === 0) {
            statusVal = 'inactive';
            statusProject = 'pause';
        }
        $.ajax({
            url: "<?=base_url() . 'project/changeStatus';?>",
            type: "POST",
            data: {'project_id': projectId, 'status': statusVal, 'project_status' : statusProject },
            success: function (data) {
                if (data === 'active') {
                    $('#status-div-' + projectId).html("<a href='javascript:void(0)' onclick='changeStatus(" + projectId + ",0)'><img alt='active' src='<?=base_url();?>images/green-dot.png' /></a> ");
                } else {
                    $('#status-div-' + projectId).html("<a href='javascript:void(0)' onclick='changeStatus(" + projectId + ",1)'><img alt='inactive' src='<?=base_url();?>images/red-dot.png'/></a> ");
                }
            }
        });
    }

</script>