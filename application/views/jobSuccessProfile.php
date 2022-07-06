<link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
<style>
table.dataTable{
	width:98%;
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Job Success Profile</h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">     
                <div class="box">
                    <div class="box-header">
	                    <a href="<?php echo base_url(); ?>jsp/jspSection" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add New</a>
                        &nbsp;&nbsp;
                        <a href="javascript:void(0);" onclick="createClone();" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;&nbsp;Clone</a>
                        <!--- <div class="box-tools">
                            <div style="width:200px;" class="input-group">
                                <input type="text" placeholder="Search" class="form-control input-sm pull-right" name="table_search">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div> --->
                    </div>
                    <br/>
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
<script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
$(function () {
	loadJSP(1,"");  //For first time page load default results
});

function loadJSP(page,testId) {
	$("#loaderDiv").html(ajaxLoader);
	$.ajax({
		type: "POST",
		url: "<?php echo base_url() . 'jsp/loadJSP'; ?>",
		data: "page=" + page,
		success: function (msg) {
			$("#participant-container").html(msg);
			$("#loaderDiv").html('');
			
			//data table
			$('#dataTable').DataTable( {
			} );

			//End Datatable
			console.log(msg);
		}
	});
}

function createClone() {
	var cloneId = $("#dataTable input[name='cloneId']:checked").val();
	$.ajax({
		type: "POST",
		url: "<?php echo base_url() . 'jsp/createClone'; ?>",
		data: "cloneId=" + cloneId,
		success: function (newId) {
			if(newId>0){
				window.location.href = "<?php echo base_url().'jsp/jspSection/'; ?>"+newId;
			}
		}
	});
}

function editRecord(url) {
	var isEdit = confirm("Changing this JSP will impact all other reports that used this profile.");
	if (isEdit) {
		window.location.href = url;
	}
}

function deleteRecord(jspId) {
	var isDele = confirm("Deleting this Job Success Profile will not impact any project it was used in, all reports will remain the same.\nAre you sure you want to delete this profile?");
	if (isDele) {
		$.ajax({
			type: "POST",
			url: "<?php echo base_url() . 'jsp/deleteJspRecord'; ?>",
			data: "jspId=" + jspId,
			success: function (newId) {
				if(newId){
					$("#participant-container").html('');
					loadJSP(1,""); 
				}
			}
		});
	}
}
</script>