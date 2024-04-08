<input type="hidden" name="lesson_type" value="system-audio">
<input type="hidden" name="lesson_provider" value="system_audio">

<div class="form-group">
    <label> <?php echo get_phrase('Audio File'); ?></label>
    <div class="input-group">
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="system_audio_file" name="system_audio_file" onchange="changeTitleOfImageUploader(this)" required>
            <label class="custom-file-label" for="system_audio_file"><?php echo get_phrase('Audio file'); ?></label>
        </div>
    </div>
</div>
<div class="form-group">
    <label for="system_audio_file_duration"><?php echo get_phrase('duration'); ?></label>
    <input type="text" class="form-control" data-toggle='timepicker' data-minute-step="5" name="system_audio_file_duration" id = "system_audio_file_duration" data-show-meridian="false" value="00:00:00" required>
</div>