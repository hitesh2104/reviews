 
<ol class="breadcrumb bc-3" >
	<li>
		<a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i>Home</a>
	</li>
	<li class="active">
		<strong>Candidates</strong>
	</li>
</ol>

<div class="pull-left">
	<h2><?php echo $page_title ?></h2>
</div>		
<div class="pull-right">
	
</div>
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
