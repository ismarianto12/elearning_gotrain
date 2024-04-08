<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body py-2">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('BigBlueButton Live Class Settings'); ?>
                </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>


<div class="row ">
    <div class="col-md-6">
    	<div class="card">
    		<div class="card-body">
		    	<form action="<?php echo site_url('admin/bbb_live_class_settings/update'); ?>" method="post" enctype="multipart/form-data">
		    		<div class="form-group">
		    			<label for="endpoint"><?php echo get_phrase('BigBlueButton Endpoint'); ?></label>
		    			<input value="<?php echo get_settings('bbb_setting', true)['endpoint'] ?? ''; ?>" type="text" class="form-control" name="endpoint" id="endpoint" placeholder="https://example.bigbluemeeting.com/bigbluebutton/" required>
		    		</div>

		    		<div class="form-group">
		    			<label for="secret"><?php echo get_phrase('BigBlueButton Shared Secret or Salt'); ?></label>
		    			<input value="<?php echo get_settings('bbb_setting', true)['secret'] ?? ''; ?>" type="text" class="form-control" name="secret" id="secret" placeholder="6IBNH5btxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" required>
		    		</div>

					<div class="form-group mt-4">
						<button class="btn btn-success"><?php echo get_phrase('Save Changes'); ?></button>
					</div>
		    	</form>
		    </div>
		</div>
	</div>
</div>