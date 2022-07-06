<table class="table table-bordered table-striped" id="dataTable" width="100%">
  <thead>
    <tr>
      <th>Select</th>
      <th>Job Title</th>
      <th>Job Family</th>
      <th>Date Created</th>
      <th>Action</th>
    </tr>
  </thead>
  <tfoot style=" display: table-header-group;">
    <tr>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
    </tr>
  </tfoot>
  <tbody>
<?php	
if (!empty($jspResult)) {
	foreach ($jspResult as $value) {	 ?>
        <tr>
	      <td width="3%"><input type="radio" name="cloneId" id="cloneId" value="<?php echo $value->jsp_id; ?>" /> </td>
          <td width="35%"><?= $value->job_title; ?></td>
          <td width="35%"><?= $value->job_family; ?></td>
          <td width="15%"><?= $this->commanfunction->dateChanger('-', '/', $value->created_at); ?></td>
          <td><ul  class="list-inline">
              <!--<li><a href="#"><i class="fa fa-eye"></i></a></li>-->
              <li><a href="javascript:void(0);" onclick="editRecord('<?php echo base_url() . 'jsp/jspSection/' . $value->jsp_id; ?>');"><i class="fa fa-edit"></i></a></li>
              <!--<li><a href="#">pause</a></li>-->
            </ul></td>
        </tr>
<?php
	}
}else{
?>
    <tr>
      <td colspan="7"><div class="alert alert-danger error-alert">No candidate found.</div></td>
    </tr>
<?php } ?>
  </tbody>
</table>
<?php #echo get_pagination(6, 5, 1); ?>
