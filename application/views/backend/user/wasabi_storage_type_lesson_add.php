<input type="hidden" name="lesson_type" value="wasabi-video">
<input type="hidden" name="lesson_provider" value="wasabi">

<div class="form-group">
    <label> <?php echo get_phrase('upload_video_file'); ?></label>
    <div class="input-group">
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="video_file_for_wasabi_storage" name="video_file_for_wasabi_storage" onchange="changeTitleOfImageUploader(this)" required>
            <label class="custom-file-label" for="video_file_for_wasabi_storage"><?php echo get_phrase('select_a_video_file'); ?></label>
        </div>
    </div>
    <small class="badge badge-primary"><?php echo 'maximum_upload_size'; ?>: <?php echo ini_get('upload_max_filesize'); ?></small>
    <small class="badge badge-primary"><?php echo 'post_max_size'; ?>: <?php echo ini_get('post_max_size'); ?></small>
    <small class="badge badge-secondary"><?php echo '"post_max_size" '.get_phrase("has_to_be_bigger_than").' "upload_max_filesize"'; ?></small>
</div>
<div class="form-group">
    <label><?php echo get_phrase('duration'); ?></label>
    <input type="text" class="form-control" data-toggle='timepicker' data-minute-step="5" name="wasabi_duration" id = "wasabi_duration" data-show-meridian="false" value="00:00:00" required>
</div>
