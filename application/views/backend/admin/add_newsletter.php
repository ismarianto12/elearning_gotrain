<form action="<?php echo site_url('admin/newsletters/add'); ?>" method="post">
	<div class="form-group">
		<label for="newsletter_subject"><?php echo get_phrase('Subject'); ?></label>
		<input type="text" name="subject" class="form-control" id="newsletter_subject" required>
	</div>

	<div class="form-group">
		<label for="newsletter_description"><?php echo get_phrase('Description'); ?></label>
		<textarea name="description" id="newsletter_description"></textarea>
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-success"><?php echo get_phrase('Save'); ?></button>
	</div>
</form>

<script type="text/javascript">
	initSummerNote(['#newsletter_description']);
</script>