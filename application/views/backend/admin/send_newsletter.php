

<form action="<?php echo site_url('admin/newsletters/send'); ?>" method="post">
	<div class="form-group">
		<label for="send_to"><?php echo get_phrase('Send To'); ?></label>
		<select id="send_to" name="send_to" class="form-control select2" onchange="is_selected_user(this)">
			<option value="selected_user"><?php echo get_phrase('Selected user'); ?></option>
			<option value="all"><?php echo get_phrase('All users'); ?></option>
			<option value="student"><?php echo get_phrase('All student'); ?></option>
			<option value="instructor"><?php echo get_phrase('All instructor'); ?></option>
			<option value="all_subscriber"><?php echo get_phrase('Newsletter subscriber'); ?> (<?php echo get_phrase('All subscriber'); ?>)</option>
			<option value="registered_subscriber"><?php echo get_phrase('Newsletter subscriber'); ?> (<?php echo get_phrase('Registered user'); ?>)</option>
			<option value="non_registered_subscriber"><?php echo get_phrase('Newsletter subscriber'); ?> (<?php echo get_phrase('Non registered user'); ?>)</option>
		</select>
	</div>

	<div class="form-group" id="select_newsletter_user">
        <label for="multiple_user_id"><?php echo get_phrase('Select your users'); ?></label>
        <select class="server-side-select2" action="<?php echo base_url('admin/get_select2_user_data'); ?>" name="user_id[]" multiple="multiple">
        </select>
	</div>

	<div class="form-group">
		<label for="newsletter_subject"><?php echo get_phrase('Subject'); ?></label>
		<input type="text" value="<?php echo $newsletter['subject'] ?>" name="subject" class="form-control" id="newsletter_subject" required>
	</div>

	<div class="form-group">
		<label for="newsletter_description"><?php echo get_phrase('Description'); ?></label>
		<textarea name="description" id="newsletter_description"><?php echo $newsletter['description'] ?></textarea>
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-success"><i class="mdi mdi-send  mdi-rotate-315"></i> <?php echo get_phrase('Send'); ?></button>
	</div>
</form>

<script type="text/javascript">
	initSummerNote(['#newsletter_description']);
	$(".select2").select2();

	$(".server-side-select2" ).each(function() {
      var actionUrl = $(this).attr('action');
      $(this).select2({
        ajax: {
          url: actionUrl,
          dataType: 'json',
          delay: 1000,
          data: function (params) {
            return {
              searchVal: params.term // search term
            };
          },
          processResults: function (response) {
            return {
              results: response
            };
          }
        },
        placeholder: 'Search here',
        minimumInputLength: 1,
      });
    });

    function is_selected_user(e){
    	if($(e).val() == 'selected_user'){
    		$('#select_newsletter_user').show();
    	}else{
    		$('#select_newsletter_user').hide();
    	}
    }
</script>