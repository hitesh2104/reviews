 
<ol class="breadcrumb bc-3" >
	<li>
		<a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i>Home</a>
	</li>
	<li class="active">
		<strong>Client</strong>
	</li>
</ol>

<div class="pull-left">
	<h2><?php echo $page_title ?></h2>
</div>		
<?php if(is_admin()){ ?>
	<div class="pull-right">
		<div class="col-md-3">
			<a href="<?php echo base_url('users/manager/add'); ?>" class="btn btn-xs btn-primary"><i class="fa fa-plus"></i> Add Managers</a>
		</div>
	</div>
	<?php } ?>
	<div class="clearfix"></div>

	<br />
	<div class="row">
		<form role="form" id="memberList" class="form-horizontal form-groups-bordered" method="POST" >
			<div class="">
				
				<table class="table table-bordered dt_table" id="table-1" data-source="<?php echo $data_source; ?>">
					<thead>
						<?php echo $table_elements ?>
					</thead>
					<tbody></tbody>
					<tfoot>
						<?php echo $table_elements ?>
					</tfoot>
				</table>
				
			</div>
		</form>
	</div>
	<!-- page based script -->


