<?php $bbb_meeting = $this->db->where('course_id', $course_details['id'])->get('bbb_meetings')->row_array(); ?>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="bbb_meeting_id"><?php echo get_phrase('Meeting ID'); ?></label>
            <input value="<?php echo $bbb_meeting['meeting_id'] ?? '' ?>" type="text" class="form-control" id="bbb_meeting_id" placeholder="gs5smxxxxxxxxxx">
        </div>

        <div class="form-group">
            <label for="bbb_moderator_pw"><?php echo get_phrase('Moderator Password'); ?></label>
            <input value="<?php echo $bbb_meeting['moderator_pw'] ?? '' ?>" type="text" class="form-control" id="bbb_moderator_pw" placeholder="xxxxxx">
        </div>

        <div class="form-group">
            <label for="bbb_viewer_pw"><?php echo get_phrase('Viewer Password'); ?></label>
            <input value="<?php echo $bbb_meeting['viewer_pw'] ?? '' ?>" type="text" class="form-control" id="bbb_viewer_pw" placeholder="xxxxxx">
        </div>

        <div class="form-group">
            <label for="bb_meeting_instruction"><?php echo get_phrase('Instructions for students'); ?></label>
            <textarea id="bb_meeting_instruction"><?php echo $bbb_meeting['instructions'] ?? '' ?></textarea>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mt-5 pt-5 text-center">
            <div class="alert alert-info w-75 text-center ml-auto mr-auto mb-4">
                <strong><?php echo get_phrase('Attention!'); ?></strong><br>
                <?php echo get_phrase('Give some instructions to keep your students informed about the meeting'); ?>
            </div>
            <button type="button" onclick="save_bbb_meeting()" class="btn btn-info w-75 mb-2"><?php echo get_phrase('Save Meeting Info'); ?></button>
            <button type="button" onclick="start_bbb_meeting()" class="btn btn-success w-75"><?php echo get_phrase('Start Meeting'); ?></button>
        </div>
    </div>
</div>

<script>
    $(function() {
        initSummerNote(['#bb_meeting_instruction']);
    });

    function save_bbb_meeting(){
        var bbb_meeting_id = $('#bbb_meeting_id').val();
        var bbb_moderator_pw = $('#bbb_moderator_pw').val();
        var bbb_viewer_pw = $('#bbb_viewer_pw').val();
        var bbb_instructions = $('#bb_meeting_instruction').val();

        if (bbb_moderator_pw == '' || bbb_viewer_pw == '' || bbb_meeting_id == '') {
            error_notify('<?php echo get_phrase("Meeting ID and password can not be empty"); ?>');
        } else if (bbb_moderator_pw == bbb_viewer_pw) {
            error_notify('<?php echo get_phrase("Moderator and viewer password can not be same"); ?>');
        } else {
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url('user/save_bbb_meeting/' . $course_details['id']); ?>',
                data: {
                    'bbb_meeting_id': bbb_meeting_id,
                    'bbb_moderator_pw': bbb_moderator_pw,
                    'bbb_viewer_pw': bbb_viewer_pw,
                    'instructions': bbb_instructions
                },
                success: function(response) {
                    success_notify(response);
                }
            });
        }
    }

    function start_bbb_meeting() {
        $.ajax({
            type: 'GET',
            url: '<?php echo site_url('user/start_bbb_meeting/' . $course_details['id']); ?>',
            success: function(response) {
                window.open(response, '_blank');
            }
        });
    }
</script>