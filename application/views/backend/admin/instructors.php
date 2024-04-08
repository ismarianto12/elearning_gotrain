<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo $page_title; ?>
                    <a href="<?php echo site_url('admin/instructor_form/add_instructor_form'); ?>" class="btn btn-outline-primary btn-rounded alignToTitle"><i class="mdi mdi-plus"></i><?php echo get_phrase('add_instructor'); ?></a>
                </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row">
  <div class="col-lg-12">
      <div class="card">
        <div class="card-body" data-collapsed="0">
          <h4 class="mb-3 header-title"><?php echo get_phrase('instructor'); ?></h4>
          <table class="table table-striped table-centered w-100" id="server_side_users_data">
            <thead>
              <tr>
                <th>#</th>
                <th><?php echo get_phrase('photo'); ?></th>
                <th><?php echo get_phrase('name'); ?></th>
                <th><?php echo get_phrase('email'); ?></th>
                <th><?php echo get_phrase('Phone'); ?></th>
                <th><?php echo get_phrase('enrolled_courses'); ?></th>
                <th><?php echo get_phrase('actions'); ?></th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
      </div>
    </div>
  </div><!-- end col-->
</div>

<script>
  $(document).ready(function () {
     var table = $('#server_side_users_data').DataTable({
      responsive: true,
      "processing": true,
      "serverSide": true,
      "ajax":{
        "url": "<?php echo base_url('admin/server_side_instructors_data') ?>",
        "dataType": "json",
        "type": "POST",
        "data":{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
      },
      "columns": [
        { "data": "key" },
        { "data": "photo" },
        { "data": "name" },
        { "data": "email" },
        { "data": "phone" },
        { "data": "enrolled_courses" },
        { "data": "action" }
      ]   
    });
   });

  function refreshServersideTable(tableId){
    $('#'+tableId).DataTable().ajax.reload();
  }
</script>