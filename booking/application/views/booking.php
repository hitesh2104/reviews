 
<ol class="breadcrumb bc-3" >
	<li>
		<a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i>Home</a>
	</li>
	<li class="active">
		<strong>Bookings</strong>
	</li>
</ol>

<div class="pull-left">
	<h2><?php echo $page_title ?></h2>
</div>		
<?php if(is_client() && !is_client_manager()){ ?>
<div class="pull-right">
	<a href="<?php echo base_url("bookings/add"); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add New Booking</a>
</div>
<?php } ?>
<div class="clearfix"></div>

<br />
<div class="row">
	<form role="form" id="memberList" class="form-horizontal form-groups-bordered" method="POST" >
		<div class="">
			
			<table class="table table-bordered dt_table" id="table-1" data-source="<?php echo $data_source; ?>">
				<thead>
					<?php echo $table ?>
				</thead>
				<tbody></tbody>
				<tfoot>
					<?php echo $table ?>
				</tfoot>
			</table>
			
		</div>
	</form>
</div>
<!-- page based script -->
<script>
	var link = $("#table-1").data("source");
	$(document).ready(function(event) {
	 
		
		$(document).on("click",".change_status",function(event){
			event.preventDefault();
			<?php if(is_admin()){ ?>
				var $this = $(this);
				show_loading_bar(35);
				$.ajax({
					url: $this.attr('href'),
					type: 'GET',
					dataType : 'JSON',
					success : function(response){
						showToastMessage(response.message,response.status);
						if(response.status == "success"){
							tables[0].fnReloadAjax(link,"",true);
						} 
						show_loading_bar(100);
					},
					error : function(response){
						showToastMessage("<?php echo system_messages()['server_error_message']; ?>",'error');
						show_loading_bar(100);
					},
					
				})
				<?php } ?>
				
			});
	});
</script>


