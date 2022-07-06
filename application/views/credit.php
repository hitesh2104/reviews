<link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Manage Credit</h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <a href="javascript:void(0);" class="btn btn-danger">&nbsp;Available Credit:&nbsp;<?= $userCredit?$userCredit:'0'; ?></a>
                        <a href="javascript:void(0);" data-target="#credit" data-toggle="modal" class="btn btn-primary">&nbsp;Request Credit</a>
                        <br>
                        <div class="box-tools">
                            <div style="width:200px;" class="input-group">
                                <input type="text" placeholder="Search" class="form-control input-sm pull-right" name="table_search" id="table-search">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php messageAlert(); ?>
                    <div class="box-body">
                        <div id="loaderDiv"></div>
                        <div class="table-responsive" id="credit-container">

                        </div><!-- /.box-body -->
                    </div>
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section>
</div>

<div class="modal fade" id="credit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php if (isMasterAdmin()) { ?>
                    <h4 class="modal-title">Request Credit From System Administrator</h4>
                <?php } elseif (isClient()) { ?>
                    <h4 class="modal-title">Request Credit From Master Administrator</h4>
                <?php } ?>
            </div>
            <form id="credit-form" method="post" action="<?= base_url(); ?>credit/sendcreditrequest">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Credit*</label>                      
                        <input type="text" class="form-control" name="credit_request">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary  pull-left">Send Credit Request</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div>
</div>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(function () {
        loadCredit(1);  //For first time page load default results

        $("#credit-form").validate({
            errorElement: "span",
            errorClass: "error_msg",
            rules: {//set rules
                credit_request: {
                    required: true
                }
            },
            messages: {//set messages to appear inline
                credit_request: {
                    required: "Oops! this field is required."
                }
            }
        });
    });

    function loadCredit(page) {
        $("#loaderDiv").html(ajaxLoader);
        $.ajax({
            type: "POST",
            url: "<?= base_url() . 'credit/loadCredit'; ?>",
            data: "page=" + page,
            success: function (msg) {
                $("#credit-container").html(msg);
                $("#loaderDiv").html('');

                //DataTable

                // oTable = $('#dataTable').DataTable();
                // $("#dataTable_filter").hide();
                // $('#table-search').keyup(function(){
                //       oTable.search($(this).val()).draw() ;
                // })
            }
        });
    }

    function deleteCreditRequest(requestId)
    {
        var isTriggered = 0;
        bootbox.confirm("Are you sure you want to delete this requested credit request? ", function (result) {
            if (result) {
                $.ajax({
                    url: "<?= base_url() . 'credit/declinecreditrequest'; ?>",
                    data: {credit_request_id: requestId},
                    type: "POST",
                    success: function (response) {
                        if (response == 'success') {
                            location.reload();
                        } else {
                            bootbox.alert('Oops! something went wrong, please try again later.');
                        }
                    },
                });
            } else {
                return true;
            }
        });
    }

    function approvePopup(requestId) {
        $('#credit-request-id').val(requestId);
    }

</script>