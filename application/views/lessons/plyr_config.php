<link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/plyr/plyr.css">
<script src="<?php echo base_url(); ?>assets/global/plyr/plyr.js"></script>
<script>
    var player = new Plyr('#player', {
        youtube: {
    // Options for YouTube player
    controls: 1, // Show YouTube controls
    modestBranding: false, // Show YouTube logo
    showinfo: 1, // Show video title and uploader on play
    rel: 1, // Show related videos at the end
    iv_load_policy: 3, // Do not show video annotations
    cc_load_policy: 1, // Show captions by default
    autoplay: false, // Do not autoplay
    loop: false, // Do not loop the video
    mute: false, // Do not mute the video
    start: 0, // Start at this time (in seconds)
    end: null // End at this time (in seconds)
  }
    });
</script>

<!-- Video preview start -->
<style type="text/css">
    .plyr__progress video {
        width: 180px !important;
        height: auto !important;
        position: absolute !important;
        bottom: 30px !important;
        z-index: 1 !important;
        border-radius: 10px !important;
        border: 2px solid #fff !important;
        display: none;
        background-color: #000;
    }

    .plyr__progress video:hover {
        display: none !important;
    }

    video:not(.plyr:fullscreen video) {
        width: 100%;
        max-height: auto !important;
        max-height: 567px !important;
        border-radius: 5px;
    }
</style>
<script type="text/javascript">
    if ($('video#player').length) {
        const progress = document.querySelector('.plyr__progress');
        if ($('.plyr__progress video').length == 0) {
            $('.plyr__progress').append($('.plyr__video-wrapper').html());
            var previewProgressVideoObject = document.querySelector('.plyr__progress video');
        }

        // Handle hover event on the progress bar
        progress.addEventListener('mousemove', function(event) {
            if ($('.plyr__progress .plyr__poster').length > 0) {
                $('.plyr__progress .plyr__poster').remove();
            }

            const rect = progress.getBoundingClientRect();
            const offsetX = event.clientX - rect.left;
            const percent = (offsetX / rect.width) * 100;

            // Calculate the time corresponding to the hovered position
            const duration = player.duration;
            const time = (duration * percent) / 100;

            // Update the preview position and show it
            previewProgressVideoObject.style.left = $('.plyr__tooltip').css('left').replace('px', '') - 90 + 'px'; //`${percent-10.5}%`;
            previewProgressVideoObject.style.display = 'block';

            // Seek the video to the corresponding time
            //player.currentTime = time;
            previewProgressVideoObject.currentTime = time;
        });

        // Handle mouse leave event on the progress bar
        progress.addEventListener('mouseleave', function() {
            // Hide the preview
            previewProgressVideoObject.style.display = 'none';
        });
    }
</script>
<!-- video preview ended -->


<!-- Update Watch history and set current duration-->
<script type="text/javascript">
    let lesson_id = '<?php echo $lesson_details['id']; ?>';
    let course_id = '<?php echo $course_details['id']; ?>';
    var currentProgress = '<?php echo lesson_progress($lesson_details['id']); ?>';
    let previousSavedDuration = 0;
    let currentDuration = 0;


    //const player = new Plyr('#player');
    if (typeof player === 'object' && player !== null) {
        setInterval(function() {
            currentDuration = parseInt(player.currentTime);
            if (lesson_id && course_id && (currentDuration % 5) == 0 && previousSavedDuration != currentDuration) {
                previousSavedDuration = currentDuration;

                $.ajax({
                    type: 'POST',
                    url: '<?php echo site_url('home/update_watch_history_with_duration'); ?>',
                    data: {
                        lesson_id: lesson_id,
                        course_id: course_id,
                        current_duration: currentDuration
                    },
                    success: function(response) {
                        var responseVal = JSON.parse(response);
                        console.log(responseVal);
                        console.log(responseVal.course_progress);
                    }
                });
            }

            //console.log('Avoid Server Call'+currentDuration);
        }, 900);
    }


    //Play from previous duration
    <?php $student_id = $this->session->userdata('user_id'); ?>
    <?php $watched_duration = $this->db->get_where('watched_duration', ['watched_lesson_id' => $lesson_details['id'], 'watched_student_id' => $student_id])->row_array(); ?>
    var previous_duration = <?php echo isset($watched_duration['current_duration']) && $watched_duration['current_duration'] > 0 ? $watched_duration['current_duration'] : 0; ?>;
    var previousTimeSetter = setInterval(function() {
        //player.duration //Total duration of current video
        if (player.playing == false && player.currentTime != previous_duration) {
            player.currentTime = previous_duration;
            console.log(previous_duration);
            console.log(player.currentTime);
        } else {
            clearInterval(previousTimeSetter);
        }
    }, 200);

    $(document).ready(function() {
      setTimeout(function(){
        $('.remove_video_src').remove();
      }, 2000);
    });
</script>