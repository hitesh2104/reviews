<link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
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
                        <!--- <div class="box-tools">
                            <div style="width:200px;" class="input-group">
                                <input type="text" placeholder="Search" class="form-control input-sm pull-right" name="table_search">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div> --->
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
<script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(function () {
        loadCandidate(1,"");  //For first time page load default results
    });


    function loadCandidate(page,testId) {
        $("#loaderDiv").html(ajaxLoader);
        $.ajax({
            type: "POST",
            url: "<?= base_url() . 'candidate/loadCandidate'; ?>",
            data: "page=" + page + "&testId=" + testId,
            success: function (msg) {
                $("#participant-container").html(msg);
                $("#loaderDiv").html('');
                
                //data table
                $('#dataTable').DataTable( {
			        initComplete: function () {
			            this.api().columns([1,2]).every( function () {
			                var column = this;
			                var select = $('<select class="form-control"><option value=""></option></select>')
			                    .appendTo( $(column.footer()).empty() )
			                    .on( 'change', function () {
			                        var val = $.fn.dataTable.util.escapeRegex(
			                            $(this).val()
			                        );
			 
			                        column
			                            .search( val ? '^'+val+'$' : '', true, false )
			                            .draw();
			                    } );
			 
			                column.data().unique().sort().each( function ( d, j ) {
			                    select.append( '<option value="'+d+'">'+d+'</option>' )
			                } );
			            } );
			            // expre 

			            	this.api().columns([0]).every( function () {
			                var column = this;
			                var that = this;
			                var title = $(this).text();
			                var select = $('<input class="form-control" type="text" placeholder="Search '+title+'" />')
			                    .appendTo( $(column.footer()).empty() )
			                   
			                    .on( 'keyup change', function () {

					            if ( that.search() !== this.value) {
					                that
					                     
					                    .search(this.value)
					                    .draw();
					            }

					        } );
			            } );
			           
					    // 

                        //select test
                        // expre 
			        }
			    } );

                //End Datatable
                console.log(msg);
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
            data: {'participant_id': candidateId, 'status': statusVal},
            success: function (data) {
                if (data === 'active') {
                    $('#status-div-' + candidateId).html("<a href='javascript:void(0)' onclick='changeStatus(" + candidateId + ",0)'><img alt='active' src='<?= base_url(); ?>images/green-dot.png' /></a> ");
                } else {
                    $('#status-div-' + candidateId).html("<a href='javascript:void(0)' onclick='changeStatus(" + candidateId + ",1)'><img alt='inactive' src='<?= base_url(); ?>images/red-dot.png'/></a> ");
                }
            }
        });
    }

    function mit(no,va)
    {
        loadCandidate(no,va);  //For Search By Test
        //$("#mts option:eq"(va)).attr('selected', 'selected');

    }

</script>
<script>

        $('#mts').on('change', function() {
            alert("2");
            var testId=this.value;
            console.log(testId);
           // loadCandidate(1);
        });
</script>