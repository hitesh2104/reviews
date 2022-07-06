 
<ol class="breadcrumb bc-3" >
	<li>
		<a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i>Home</a>
	</li>
	<li class="active">
		<strong><?php echo $page_title ?></strong>
	</li>
</ol>

<div class="pull-left">
	<h2><?php echo $page_job_title ?></h2>
</div>		
	
<div class="pull-right">
	<a href="<?php echo base_url("products/add_jobs"); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add Job</a>
</div>
<div class="clearfix"></div>
<br />

<div class="row">
	<form role="form" id="job" class="form-horizontal form-groups-bordered" method="POST" >
		<div class="">
			
			<table class="table table-bordered dt_table" id="table-1" data-source="<?php echo $data_source_1; ?>">
				<thead>
					<?php echo $table_job ?>
				</thead>
				<tbody></tbody>
				<tfoot>
					<?php echo $table_job ?>
				</tfoot>
			</table>
			
		</div>
	</form>
</div>

<!-- <br>
<hr>
<br>
<div class="pull-left">
	<h2><?php // echo $page_assestment_title ?></h2>
</div>		
	
<div class="pull-right">
	<a href="<?php // echo base_url("products/add_assessments"); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add Assessments</a>
</div>

<div class="clearfix"></div>
<br />
<div class="row">
	<form role="form" id="assestments" class="form-horizontal form-groups-bordered" method="POST" >
		<div class="">
			
			<table class="table table-bordered dt_table" id="table-1" data-source="<?php // echo $data_source_2; ?>">
				<thead>
					<?php // echo $table_assessments ?>
				</thead>
				<tbody></tbody>
				<tfoot>
					<?php // echo $table_assessments ?>
				</tfoot>
			</table>
			
		</div>
	</form>
</div> -->

<!-- <br>
<hr>
<br>
<div class="pull-left">
	<h2><?php // echo $page_verification_title ?></h2>
</div>		
	
<div class="pull-right">
	<a href="<?php // echo base_url("products/add_verifications"); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add Verifications</a>
</div>

<div class="clearfix"></div>
<br />
<div class="row">
	<form role="form" id="assestments" class="form-horizontal form-groups-bordered" method="POST" >
		<div class="">
			
			<table class="table table-bordered dt_table" id="table-1" data-source="<?php // echo $data_source_3; ?>">
				<thead>
					<?php // echo $table_verification ?>
				</thead>
				<tbody></tbody>
				<tfoot>
					<?php // echo $table_verification ?>
				</tfoot>
			</table>
			
		</div>
	</form>
</div> -->
<!-- page based script -->


