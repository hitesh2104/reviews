<link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Manage Credit Request</h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <br>
                        <div class="box-tools">
                            <div style="width:200px;" class="input-group">
                                <input type="text" placeholder="Search" class="form-control input-sm pull-right" name="table_search" id ="table-search">
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

<div class="modal fade" id="credit-approve" tabindex="-1" role="dialog" aria-labelledby="myModalLabe2">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Approve Credit</h4>
            </div>
            <form id="credit-approve-form" method="post" action="<?= base_url(); ?>credit/approvecreditrequest">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Credit*</label>                      
                        <input type="text" class="form-control" id="credit_approved" name="credit_approved">
                        <input type="hidden" name="credit_request_id" id="credit-request-id" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary  pull-left">Approve Credit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div>
</div>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(function () {
        loadCreditRequest(1);  //For first time page load default results

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

        $("#credit-approve-form").validate({
            errorElement: "span",
            errorClass: "error_msg",
            rules: {//set rules
                credit_approved: {
                    required: true,
                    
                     remote: {
                        url: "<?= base_url('client/check_creadit') ?>",
                        type: "get",
                        data: {
                          credits: function() {
                            return $( "#credit_approved" ).val();
                          }
                        }
                      }
                }
            },
            messages: {//set messages to appear inline
                credit_approved: {
                    required: "Oops! this field is required.",
                    remote : "You don’t have enough credits to approve this request, please request credits from your System Administrator."
                }
            }
        });
    });

    function loadCreditRequest(page) {
        $("#loaderDiv").html(ajaxLoader);
        $.ajax({
            type: "POST",
            url: "<?= base_url() . 'credit/loadCreditRequest'; ?>",
            data: "page=" + page,
            success: function (msg) {
                $("#credit-container").html(msg);
                $("#loaderDiv").html('');

                // Dtatable
                oTable = $('#dataTable').DataTable();
                $("#dataTable_filter").hide();
                $('#table-search').keyup(function(){
                      oTable.search($(this).val()).draw() ;
                })
            }
        });
    }

    function changeStatus(clientId, status) {
        var statusVal = 'active';
        if (status === 0) {
            statusVal = 'inactive';
        }
        $.ajax({
            url: "<?= base_url() . 'credit/changeStatus'; ?>",
            type: "POST",
            data: {'client_id': clientId, 'status': statusVal},
            success: function (data) {
                if (data === 'active') {
                    $('#status-div-' + clientId).html("<a href='javascript:void(0)' onclick='changeStatus(" + clientId + ",0)'><img alt='active' src='<?= base_url(); ?>images/green-dot.png' /></a> ");
                } else {
                    $('#status-div-' + clientId).html("<a href='javascript:void(0)' onclick='changeStatus(" + clientId + ",1)'><img alt='inactive' src='<?= base_url(); ?>images/red-dot.png'/></a> ");
                }
            }
        });
    }

    function declineCreditRequest(requestId)
    {
        var isTriggered = 0;
        bootbox.confirm("Are you sure you want to decline this credit request? ", function (result) {
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