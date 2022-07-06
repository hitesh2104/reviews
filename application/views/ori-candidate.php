<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Manage Candidates</h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="box-tools">
                            <div style="width:200px;" class="input-group">
                                <input type="text" placeholder="Search" class="form-control input-sm pull-right" name="table_search">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br/><br/>
                    <?php messageAlert(); ?>
                    <div class="box-body">
                        <div id="loaderDiv"></div>
                        <div class="table-responsive" id="participant-container">

                        </div><!-- /.box-body -->
                    </div>
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section>
</div>

<script type="text/javascript">
    $(function () {
        loadCandidate(1);  //For first time page load default results
    });

    function loadCandidate(page) {
        $("#loaderDiv").html(ajaxLoader);
        $.ajax({
            type: "POST",
            url: "<?= base_url() . 'candidate/loadCandidate'; ?>",
            data: "page=" + page,
            success: function (msg) {
                $("#participant-container").html(msg);
                $("#loaderDiv").html('');
            }
        });
    }
    
    function changeStatus(candidateId, status) {
        var statusVal = 'active';
        if (status === 0) {
            statusVal = 'inactive';
        }
        $.ajax({
            url: "<?= base_url() . 'candidate/changeStatus'; ?>",
            type: "POST",
            data: {'candidate_id': candidateId, 'status': statusVal},
            success: function (data) {
                if (data === 'active') {
                    $('#status-div-' + candidateId).html("<a href='javascript:void(0)' onclick='changeStatus(" + candidateId + ",0)'><img alt='active' src='<?= base_url(); ?>images/green-dot.png' /></a> ");
                } else {
                    $('#status-div-' + candidateId).html("<a href='javascript:void(0)' onclick='changeStatus(" + candidateId + ",1)'><img alt='inactive' src='<?= base_url(); ?>images/red-dot.png'/></a> ");
                }
            }
        });
    }

</script>