<form action="<?php echo site_url('admin/upload_theme'); ?>" method="post" enctype="multipart/form-data">
    <div class="form-group mb-3">
        <label><?php echo get_phrase('zip_file'); ?></label>
        <div class="input-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="theme_zip" name="theme_zip" required onchange="changeTitleOfImageUploader(this)" required accept=".zip">
                <label class="custom-file-label" for="theme_zip"><?php echo get_phrase('upload_theme_file'); ?></label>
            </div>
        </div>
        <small class="badge badge-light">EX: theme.zip</small>
    </div>

    <button type="submit" class="btn btn-primary"><?php echo get_phrase('install_theme'); ?></button>
</form>