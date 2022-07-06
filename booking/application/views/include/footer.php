    <!-- Footer -->
    <footer class="main">
        
        &copy; <?php echo Date("Y") ?> <strong></strong>  <?php echo APP_NAME ?>
        
    </footer>
</div>


<!-- Sample Modal (Default skin) -->

<div class="modal fade" id="upload_report_model" tabindex="-1" role="camera_sold" aria-hidden="true">
    <div class="modal-dialog">
        <!-- <form action="<?php // echo base_url('home/camera_sold'); ?>" method="POST" id="camera_sold_form"  data-parsley-validate> -->
            
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title"><b>Reports</b> </h4>
                </div>
                <div class="modal-body">
                    <form role="form" id="add_edit_documents" enctype='multipart/form-data'  class="form-horizontal form-groups-bordered" method="POST" action="<?php echo base_url('users/save_document');?>" data-parsley-validate style="margin-bottom: 40px;">
                        <div class=" col-md-12 text-center content_loading"><i class="fa fa-spinner fa-spin fa-2x"></i> Loading..</div>
                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="report_document_list"></div>
                            </div>
                        </div>
                        <?php if(is_admin()){ ?>
                            <div class="col-md-12 col-sm-12">
                                <div class="col-md-3 col-sm-3"><b>Report </b></div>
                                <div class="col-md-9 col-sm-9">
                                    <div class="form-group">
                                        <input type="file" name="upload_report" class=" inline btn btn-primary upload_document" >
                                    </div> 
                                </div>
                            </div>
                            <input type="hidden" name="popup_client_id" id="popup_client_id" class="popup_client_id" value="">
                            <button name="save_documents" value="save_documents" class="btn btn-success save_documents" id="save_documents">Save Documents</button>
                            <?php } ?>
                        </form>
                        
                        <div class="clearfix"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn default" data-dismiss="modal">Close</button>
                    </div>
                </div>
                <!-- </form> -->
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <div class="modal fade" id="attached_doc_modal" tabindex="-1" role="camera_sold" aria-hidden="true">
            <div class="modal-dialog">
                <!-- <form action="<?php // echo base_url('home/camera_sold'); ?>" method="POST" id="camera_sold_form"  data-parsley-validate> -->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title"><b>Documents</b> </h4>
                        </div>
                        <div class="modal-body">
                            <div class=" col-md-12 text-center content_loading"><i class="fa fa-spinner fa-spin fa-2x"></i> Loading..</div>
                            
                            <div class="document_list"></div>
                            
                            <div class="clearfix"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    <!-- </form> -->
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>



            <link rel="stylesheet" href="<?php echo base_url('assets/js/select2/select2-bootstrap.css'); ?>">
            <link rel="stylesheet" href="<?php echo base_url('assets/js/select2/select2.css'); ?>">
            <!-- Bottom scripts (common) -->
            <script src="<?php echo base_url();?>assets/js/gsap/main-gsap.js"></script>
            <script src="<?php echo base_url();?>assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
            <script src="<?php echo base_url();?>assets/js/bootstrap.js"></script>
            <script src="<?php echo base_url();?>assets/js/joinable.js"></script>
            <script src="<?php echo base_url();?>assets/js/resizeable.js"></script>
            <script src="<?php echo base_url();?>assets/js/neon-api.js"></script>

            <script src="<?php echo base_url(); ?>assets/js/uploadifive.min.js"></script>
            <script src="<?php echo base_url('assets/js/select2/select2.min.js'); ?>"></script>

            <!-- Imported scripts on this page -->
            <script src="<?php echo base_url(); ?>assets/js/datatables/jquery.dataTables.min.js"></script>
            <script src="<?php echo base_url(); ?>assets/js/datatables/dataTables.bootstrap.min.js"></script>
            <script src="<?php echo base_url(); ?>assets/js/datatables/fnReloadAjax.js"></script>
            <script src="<?php echo base_url();?>assets/js/toastr.js"></script>
            <script src="<?php echo base_url(); ?>assets/js/parsley.min.js"></script>

            <!-- JavaScripts initializations and stuff -->
            <script src="<?php echo base_url();?>assets/js/neon-custom.js"></script>

            <script src="<?php echo base_url();?>assets/js/custom.php"></script>

            <!-- Demo Settings -->
            <script src="<?php echo base_url();?>assets/js/neon-demo.js"></script>

        </body>
        </html>


        <!-- modal for the page -->


        <!-- page based script -->
        <script>
            $(document).ready(function() {
                $(document).on("click", '.fetch_user_documents', function(){
                    
                    $(".document_list").hide();
                    $(".content_loading").show();
                    $(".verification_docs").html('')
                    $(".document_list").html('')
                    var cli_obj = $(this);
                    var client_id = cli_obj.data("id");
                    $.getJSON(base_url + 'users/get_documents/' + client_id, function(data) {
                        if(data.status !==0 ){
                            setTimeout(function(){
                                $(".content_loading").hide();
                                $(".verification_docs").html(data.verification_list);
                                $(".document_list").show();
                                
                                $(".document_list").html(data.uploaded_docs);
                                
                            },400);
                        }
                    });
                });
                
                $(document).on("click", '.upload_reports', function(){
                    
                    $(".report_document_list").hide();
                    $(".content_loading").show();
                    $(".report_document_list").html('')
                    var cli_obj = $(this);
                    var client_id = cli_obj.data("id");
                    $("#popup_client_id").val(client_id);
                    $.get(base_url + 'users/get_reports/' + client_id, function(data) {
                        setTimeout(function(){
                            $(".content_loading").hide(); 
                            $(".report_document_list").show();
                            $(".report_document_list").append(data);
                            if(data == ""){
                                $(".report_document_list").html('No data found');
                            }
                            
                        },200);
                    });
                    
                });
                
                $('#add_edit_documents').on("submit", function(event) {
                    event.preventDefault();
                    var obj = $(this);
                    if(obj.parsley().validate()) {
                        $.ajax({
                            url: obj.attr('action'),
                            type: 'POST',
                            dataType:'json',
                            data: obj.serialize(),
                            success: function(response) {
                                showToastMessage("Report uploaded.", "success");
                                
                            },
                            error: function(response) {
                                showToastMessage("<?php echo system_messages()['server_error_message']; ?>", 'error');
                            }
                        })
                    }
                });
                
                $(document).on("click", '.remove_this_document', function(){
                        var re_obj = $(this);
                        var ori_html = re_obj.html();
                        re_obj.html('<i class="fa fa-spin fa-spinner"></i> Removing...!');
                        var file_name = re_obj.data('file_path');
                        $.post(base_url+'documents/remove_doc', { file_path : file_name  }, function(data) {
                            if(data > 0){
                                re_obj.parents('.uploaded_file').remove();
                                
                            } else {
                                showToastMessage("<?php echo system_messages()['server_error_message']; ?>", 'error');
                                setTimeout(function(){
                                    re_obj.html(ori_html);
                                }, 500);
                            }
                        }).fail(function(xhr, status, error) {
                            showToastMessage("<?php echo system_messages()['server_error_message']; ?>", 'error');
                            setTimeout(function(){
                                re_obj.html(ori_html);
                            }, 500);
                        });
                        
                    });
            });
        </script>

